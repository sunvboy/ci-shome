<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;
require APPPATH . '/libraries/REST_Controller.php';
class User extends REST_Controller {

	public $module;
	function __construct() {
		parent::__construct();
		$this->module = 'user';
		$this->fc_lang = $this->config->item('fc_lang');
		$this->load->library(array('configbie'));
	}
    public function detailUser_get()
    {
        header('Content-type: application/x-www-form-urlencoded');
        header("Access-Control-Allow-Origin: *");
        $this->load->library('Authorization_Token');
        $is_valid_token = $this->authorization_token->validateToken();
        if (!empty($is_valid_token) AND $is_valid_token['status'] === TRUE)
        {
            $id = $is_valid_token['data']->id;
            $data = $this->Autoload_Model->_get_where(array(
                'select' => 'id,fullname,email,avatar,address,phone,(SELECT count(id) FROM customer_address WHERE customer_address.customerid=customer.id) AS count_address',
                'table' => 'customer',
                'where' => array(
                    'id' => $id,
                ),
            ));
            $message = [
                'status' => 200,
                'data' => $data,
            ];
            $this->response($message, REST_Controller::HTTP_OK);
        } else {
            $this->response(['status' => FALSE, 'message' => $is_valid_token['message'] ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
	public function login_post(){
        header('Content-type: application/x-www-form-urlencoded');
        header("Access-Control-Allow-Origin: *");
        if(empty($_POST['postman'])){
            $_POST = json_decode(file_get_contents('php://input'), TRUE);
        }
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;
        $this->form_validation->set_error_delimiters('','/');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('password','Mật khẩu','trim|required|callback__CheckAuth');

        if($this->form_validation->run() == TRUE){
            $auth = $this->Autoload_Model->_get_where(array(
                'select' => 'id, email, fullname, email, password, salt,verify,publish,avatar,address,phone',
                'table' => 'customer',
                'where' => array(
                    'email' => $_POST['email'],
                ),
            ));
            if (!empty($auth) AND $auth != FALSE)
            {
                $this->load->library('Authorization_Token');
                // Generate Token
                $token_data['id'] = $auth['id'];
                $token_data['time'] = time();
                $user_token = $this->authorization_token->generateToken($token_data);
                $return_data = [
                    'id' => $auth['id'],
                    'fullname' => $auth['fullname'],
                    'phone' => $auth['phone'],
                    'address' => $auth['address'],
                    'avatar' => $auth['avatar'],
                    'token' => $user_token,
                ];
                // Login Success
                $message = [
                    'status' => 200,
                    'data' => $return_data,
                    'message' => "User login successful"
                ];
                $this->response($message, REST_Controller::HTTP_OK);
            }

        }else{
            $message = array(
                'status' => 500,
                'message' => validation_errors()
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }

	}
	public function register_post(){
        header('Content-type: application/x-www-form-urlencoded');
        header("Access-Control-Allow-Origin: *");
        $_POST = json_decode(file_get_contents('php://input'), TRUE);
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;
        $this->form_validation->set_error_delimiters('',' / ');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback__Email');
        $this->form_validation->set_rules('fullname', 'Họ và tên', 'trim|required');
        $this->form_validation->set_rules('phone', 'Số điện thoại','trim|required|max_length[10]|min_length[10]|callback__Phone');
        $this->form_validation->set_rules('address', 'Địa chỉ','trim|required');
        $this->form_validation->set_rules('password','Mật khẩu','trim|required|min_length[6]|max_length[12]');
        if($this->form_validation->run() == TRUE){
            $password = $this->input->post('password');
            $salt = random();
            $password = password_encode($password, $salt);
            $_insert = array(
                'email' => $this->input->post('email'),
                'password' => $password,
                'salt' => $salt,
                'created' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
                'fullname' => $this->input->post('fullname'),
                'phone' =>  $this->input->post('phone'),
                'account' => $this->input->post('password'),
                'address' => $this->input->post('address'),
                'avatar' => '/api/template/not-found.png',
                'verify' => '',
                'publish' => 1,
            );
            $this->db->insert('customer', $_insert);
            $resultid = $this->db->insert_id();
            if ($resultid > 0) {
                $message = [
                    'status' => 200,
                    'message' => "Register user successful"
                ];
                $this->response($message, REST_Controller::HTTP_OK);
            }else{
                $message = array(
                    'status' => 500,
                    'message' => 'ERROR Register user'
                );
                $this->response($message, REST_Controller::HTTP_OK);

            }
        }else{
            $message = array(
                'status' => 500,
                'message' => validation_errors()
            );
            $this->response($message, REST_Controller::HTTP_OK);
        }
	}
    public function changPassword_post(){
        header('Content-type: application/x-www-form-urlencoded');
        header("Access-Control-Allow-Origin: *");
        if(empty($_POST['isPostman'])){
            $_POST = json_decode(file_get_contents('php://input'), TRUE);
        }
        $this->load->library('Authorization_Token');
        $is_valid_token = $this->authorization_token->validateToken();
        if (!empty($is_valid_token) AND $is_valid_token['status'] === TRUE)
        {
            //$_POST = json_decode(file_get_contents('php://input'), TRUE);
            $this->load->library('form_validation');
            $this->form_validation->CI =& $this;
            $this->form_validation->set_error_delimiters('',' / ');
            $this->form_validation->set_rules('password', 'Mật khẩu cũ', 'trim|required|min_length[6]');
            $this->form_validation->set_rules('newpassword', 'Mật khẩu mới', 'trim|required|min_length[6]|max_length[12]');
            $this->form_validation->set_rules('renewpassword', 'Xác nhận mật khẩu mới', 'trim|required|min_length[6]|max_length[12]|matches[newpassword]');
            if($this->form_validation->run() == TRUE){
                $password = $this->input->post('password');
                $id = $is_valid_token['data']->id;
                $customer = $this->Autoload_Model->_get_where(array(
                    'select' => 'salt,password',
                    'table' => 'customer',
                    'where' => array('id' => $id),
                ));
                $password_encode = password_encode($password, $customer['salt']);

                if ($customer['password'] != $password_encode) {

                    $message = array(
                        'status' => 500,
                        'message' => 'Mật khẩu hiện tại không đúng'
                    );
                    $this->response($message, REST_Controller::HTTP_OK);
                }else{
                    $salt = random();
                    $password = password_encode($this->input->post('newpassword'), $salt);
                    $_update = array(
                        'salt' => $salt,
                        'password' => $password,
                        'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                        'remote_addr' => $_SERVER['REMOTE_ADDR'],
                        'account' => $this->input->post('renewpassword'),
                        'updated' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
                    );
                    $this->Autoload_Model->_update(array(
                        'where' => array('id' => $id),
                        'table' => 'customer',
                        'data' => $_update,
                    ));
                    $message = array(
                        'status' => 200,
                        'message' => 'Thay đổi mật khẩu thành công'
                    );
                    $this->response($message, REST_Controller::HTTP_OK);
                }


            }else{
                $message = array(
                    'status' => 500,
                    'message' => !empty(validation_errors())?validation_errors():'Error'
                );
                $this->response($message, REST_Controller::HTTP_OK);
            }
        } else {
            $this->response(['status' => FALSE, 'message' => $is_valid_token['message'] ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function editProfile_post(){
        $_POST = json_decode(file_get_contents('php://input'), TRUE);
        header('Content-type: application/x-www-form-urlencoded');
        header("Access-Control-Allow-Origin: *");
        $this->load->library('Authorization_Token');
        $is_valid_token = $this->authorization_token->validateToken();
        if (!empty($is_valid_token) AND $is_valid_token['status'] === TRUE)
        {
            //$_POST = json_decode(file_get_contents('php://input'), TRUE);
            $this->load->library('form_validation');
            $this->form_validation->CI =& $this;
            $this->form_validation->set_error_delimiters('',' / ');
            $this->form_validation->set_rules('fullname', 'Họ và tên', 'trim|required');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'trim|required|max_length[11]|min_length[9]|is_natural');
            $this->form_validation->set_rules('address', 'Địa chỉ', 'trim|required');
            if($this->form_validation->run() == TRUE){
                $id = $is_valid_token['data']->id;
                $detailAvatar = $this->Autoload_Model->_get_where(array(
                    'select' => 'avatar',
                    'table' => 'customer',
                    'where' => array(
                        'id' => $id,
                    ),
                ));
                $phone = $this->input->post('phone');
                $count = $this->Autoload_Model->_get_where(array(
                    'select' => 'phone',
                    'table' => 'customer',
                    'where' => array(
                        'phone' => $phone,
                        'id !=' => $id,
                    ),
                ));
                if (!empty($count)) {
                    $message = array(
                        'status' => 500,
                        'message' => 'Số điện thoại đã tồn tại'
                    );
                }else{
                    $this->Autoload_Model->_update(array(
                        'where' => array('id' => $id),
                        'table' => 'customer',
                        'data' => array(
                            'avatar' => !empty($this->input->post('avatar'))?$this->input->post('avatar'):$detailAvatar['avatar'],
                            'fullname' => $this->input->post('fullname'),
                            'phone' => $this->input->post('phone'),
                            'address' => $this->input->post('address'),
                            'updated' => gmdate('Y-m-d H:i:s', time() + 7 * 3600)),
                    ));
                    $data = $this->Autoload_Model->_get_where(array(
                        'select' => 'id,fullname,email,avatar,address,phone',
                        'table' => 'customer',
                        'where' => array(
                            'id' => $id,
                        ),
                    ));
                    $message = array(
                        'status' => 200,
                        'message' => 'Cập nhập thông tin thành công',
                        'data' => $data
                    );
                }
                $this->response($message, REST_Controller::HTTP_OK);

            }else{
                $message = array(
                    'status' => 500,
                    'message' => validation_errors()
                );
                $this->response($message, REST_Controller::HTTP_OK);
            }
        } else {
            $this->response(['status' => FALSE, 'message' => $is_valid_token['message'] ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function uploadAvatar_post(){
        header('Content-type: application/x-www-form-urlencoded');
        header("Access-Control-Allow-Origin: *");
        $this->load->library('Authorization_Token');
        $is_valid_token = $this->authorization_token->validateToken();
        if (!empty($is_valid_token) AND $is_valid_token['status'] === TRUE)
        {
            $config['upload_path']          = 'upload/images/upload';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $config['max_width']            = 3000;
            $config['max_height']           = 3000;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('file'))
            {
                $error = array('error' => $this->upload->display_errors());
                $message = array(
                    'status' => 500,
                    'message' => strip_tags($error['error'])
                );
                $this->response($message, REST_Controller::HTTP_OK);
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                $message = array(
                    'status' => 200,
                    'message' => "Upload file thành công",
                    'data'=>'/api/'.$config['upload_path'].'/'.$data['upload_data']['file_name']
                );
                $this->response($message, REST_Controller::HTTP_OK);
            }
        } else {
            $this->response(['status' => 500, 'message' => $is_valid_token['message'] ], REST_Controller::HTTP_NOT_FOUND);
        }



    }
    public function _CheckAuth(){
		$email = $this->input->post('email');
		//Kiểm tra xem cơ sở dữ liệu có tài khoản nào phù hợp không.
		$auth = $this->Autoload_Model->_get_where(array(
			'select' => 'id, email, fullname, email, password, salt,verify,publish',
			'table' => 'customer',
			'where' => array(
				'email' => $email,
			),
		));
		if(!isset($auth) || is_array($auth) == FALSE || count($auth) == 0){
			$this->form_validation->set_message('_CheckAuth','Tài khoản không tồn tại');
			return FALSE;
		}

		if (isset($auth) && $auth['verify'] != '') {
			$this->form_validation->set_message('_CheckAuth', 'Tài khoản chưa được xác minh');
			return FALSE;
		}
        if (isset($auth) && $auth['publish'] == 0) {
			$this->form_validation->set_message('_CheckAuth', 'Tài khoản đang chờ xét duyệt');
			return FALSE;
		}
		//Kiểm tra tiếp là mật khẩu có đúng hay không.
		$password = $this->input->post('password');
		$passwordCompare = password_encode($password, $auth['salt']);
		if($passwordCompare != $auth['password']){
			$this->form_validation->set_message('_CheckAuth','Mật khẩu không chính xác');
			return FALSE;
		}
		return TRUE;
	}
	public function _Email()
	{
		$email = $this->input->post('email');
		$count = $this->Autoload_Model->_get_where(array(
			'select' => 'email',
			'table' => 'customer',
			'where' => array(
				'email' => $email,
			),
		));
		if (!empty($count)) {
			$this->form_validation->set_message('_Email', 'Tên đăng nhập đã tồn tại');
			return false;
		}
		return true;
	}
	public function _Phone()
	{
		$phone = $this->input->post('phone');
		$count = $this->Autoload_Model->_get_where(array(
			'select' => 'phone',
			'table' => 'customer',
			'where' => array(
				'phone' => $phone,
			),
		));
		if (!empty($count)) {
			$this->form_validation->set_message('_Phone', 'Số điện thoại đã tồn tại');
			return false;
		}
		return true;
	}
}
