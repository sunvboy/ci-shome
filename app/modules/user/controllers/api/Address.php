<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;
require APPPATH . '/libraries/REST_Controller.php';
class Address extends REST_Controller
{
    public $module;
    function __construct() {
        parent::__construct();
        $this->module = 'user';
        $this->fc_lang = $this->config->item('fc_lang');
        $this->load->library(array('configbie'));
    }
    public function detail_get()
    {
        header("Access-Control-Allow-Origin: *");

        $this->load->library('Authorization_Token');
        $is_valid_token = $this->authorization_token->validateToken();
        if (!empty($is_valid_token) AND $is_valid_token['status'] === TRUE)
        {
            $customerid = $is_valid_token['data']->id;
            $listAddress = $this->Autoload_Model->_get_where(array(
                'table' => 'customer_address',
                'select' => 'id,fullname,phone,address,active,cityid,districtid,wardid,type',
                'where' => array('customerid'=>$customerid,'id' => $_GET['id']),
            ));
            if(isset($listAddress) && is_array($listAddress) && count($listAddress)){
                $message = [
                    'status' => 200,
                    'data' => !empty($listAddress) ? $listAddress : '',
                    'message' => "Data Successful"
                ];
            }else{
                $message = [
                    'status' => 500,
                    'message' => "Data ERROR"
                ];
            }

            $this->response($message, REST_Controller::HTTP_OK);

        } else {
            $this->response(['status' => FALSE, 'message' => $is_valid_token['message'] ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function view_get()
    {
        $this->load->library('Authorization_Token');
        $is_valid_token = $this->authorization_token->validateToken();
        if (!empty($is_valid_token) AND $is_valid_token['status'] === TRUE)
        {
            header("Access-Control-Allow-Origin: *");
            $perpage = !empty($this->input->get('perpage')) ? $this->input->get('perpage') : 20;
            $page = $this->input->get('page');
            $page = ($page <= 0) ? 1 : $page;
            $page = $page - 1;
            $customerid = $is_valid_token['data']->id;
            $totalRow = $this->Autoload_Model->_get_where(array(
                'table' => 'customer_address',
                'select' => 'id',
                'where' => array('customerid'=>$customerid),
                'count' => TRUE,
            ));
            $listAddress = $this->Autoload_Model->_get_where(array(
                'table' => 'customer_address',
                'select' => 'id,fullname,phone,address,active,
				(SELECT name FROM vn_province WHERE customer_address.cityid = vn_province.provinceid) as address_city, 
				(SELECT name FROM vn_district WHERE customer_address.districtid = vn_district.districtid) as address_distric, 
				(SELECT name FROM vn_ward WHERE customer_address.wardid = vn_ward.wardid) as address_ward',
                'where' => array('customerid'=>$customerid),
                'limit' => $perpage,
                'start' => ($page * $perpage),
                'order_by' => 'active desc, id desc',
            ),TRUE);
            $totalPage = ceil($totalRow / $perpage);
            $message = [
                'status' => 200,
                'totalRow' => $totalRow,
                'totalPage' => $totalPage,
                'data' => !empty($listAddress) ? $listAddress : '',
                'message' => "Data Successful"
            ];
            $this->response($message, REST_Controller::HTTP_OK);

        } else {
            $this->response(['status' => FALSE, 'message' => $is_valid_token['message'] ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function all_get()
    {
        $this->load->library('Authorization_Token');
        $is_valid_token = $this->authorization_token->validateToken();
        if (!empty($is_valid_token) AND $is_valid_token['status'] === TRUE)
        {
            header("Access-Control-Allow-Origin: *");
            $perpage = !empty($this->input->get('perpage')) ? $this->input->get('perpage') : 20;
            $customerid = $is_valid_token['data']->id;

            $listAddress = $this->Autoload_Model->_get_where(array(
                'table' => 'customer_address',
                'select' => 'id,fullname,phone,address,active,cityid,districtid,wardid,(SELECT name FROM vn_province WHERE customer_address.cityid = vn_province.provinceid) as address_city, 
				(SELECT name FROM vn_district WHERE customer_address.districtid = vn_district.districtid) as address_distric, 
				(SELECT name FROM vn_ward WHERE customer_address.wardid = vn_ward.wardid) as address_ward',
                'where' => array('customerid'=>$customerid),
                'order_by' => 'active desc, id desc',
            ),TRUE);
            $message = [
                'status' => 200,
                'data' => !empty($listAddress) ? $listAddress : '',
                'message' => "Data Successful"
            ];
            $this->response($message, REST_Controller::HTTP_OK);

        } else {
            $this->response(['status' => FALSE, 'message' => $is_valid_token['message'] ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function create_post()
    {
        if(empty($_POST['postman'])){
            $_POST = json_decode(file_get_contents('php://input'), TRUE);
        }
        $this->load->library('Authorization_Token');
        $is_valid_token = $this->authorization_token->validateToken();
        if (!empty($is_valid_token) AND $is_valid_token['status'] === TRUE)
        {
            $this->load->library('form_validation');
            $this->form_validation->CI =& $this;
            $this->form_validation->set_error_delimiters('',' - ');
            $this->form_validation->set_rules('fullname', 'Họ và tên', 'trim|required');
            $this->form_validation->set_rules('phone', 'Số điện thoại','trim|required');
            $this->form_validation->set_rules('address', 'Địa chỉ','trim|required');
            $this->form_validation->set_rules('type', 'Loại địa chỉ','trim|required');
            $this->form_validation->set_rules('cityid', 'Tỉnh/Thành phố', 'trim|required');
            $this->form_validation->set_rules('districtid', 'Quận/Huyện', 'trim|required');
            $this->form_validation->set_rules('wardid', 'Phường/Xã', 'trim|required');
            if($this->form_validation->run() == TRUE){
                $customerid = $is_valid_token['data']->id;

                $_insert = array(
                    'created' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
                    'fullname' => $this->input->post('fullname'),
                    'phone' =>  $this->input->post('phone'),
                    'address' => $this->input->post('address'),
                    'cityid' => $this->input->post('cityid'),
                    'districtid' => $this->input->post('districtid'),
                    'wardid' => $this->input->post('wardid'),
                    'type' => $this->input->post('type'),
                    'active' => $this->input->post('active'),
                    'customerid' => $customerid,
                );
                $this->db->insert('customer_address', $_insert);
                $resultid = $this->db->insert_id();
                if ($resultid > 0) {
                    if(!empty($this->input->post('active'))){
                        $this->Autoload_Model->_update(array(
                            'where' => array('customerid' => $customerid, 'id !=' => $resultid),
                            'table' => 'customer_address',
                            'data' => array('active' => 0),
                        ));
                    }
                    $message = [
                        'status' => 200,
                        'message' => "Thêm mới địa chỉ thành công"
                    ];
                    $this->response($message, REST_Controller::HTTP_OK);
                }else{
                    $message = array(
                        'status' => 500,
                        'message' => "Thêm mới địa chỉ không thành công"
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

        } else {
            $this->response(['status' => FALSE, 'message' => $is_valid_token['message'] ], REST_Controller::HTTP_OK);
        }
    }
    public function update_put()
    {
        $this->load->library('Authorization_Token');
        $is_valid_token = $this->authorization_token->validateToken();
        if (!empty($is_valid_token) AND $is_valid_token['status'] === TRUE)
        {
            $_POST = json_decode($this->security->xss_clean(file_get_contents("php://input")), true);
            $this->load->library('form_validation');

            $this->form_validation->set_data([
                'id' => $this->input->post('id', TRUE),
                'fullname' => $this->input->post('fullname', TRUE),
                'phone' => $this->input->post('phone', TRUE),
                'address' => $this->input->post('address', TRUE),
                'cityid' => $this->input->post('cityid', TRUE),
                'districtid' => $this->input->post('districtid', TRUE),
                'wardid' => $this->input->post('wardid', TRUE),
                'type' => $this->input->post('type', TRUE),
                'active' => $this->input->post('active', TRUE),
            ]);
            $this->form_validation->CI =& $this;
            $this->form_validation->set_error_delimiters('',' / ');
            $this->form_validation->set_rules('id', 'ID', 'required');
            $this->form_validation->set_rules('fullname', 'Họ và tên', 'trim|required');
            $this->form_validation->set_rules('phone', 'Số điện thoại','trim|required');
            $this->form_validation->set_rules('address', 'Địa chỉ','trim|required');
            $this->form_validation->set_rules('type', 'Loại địa chỉ','trim|required');
            $this->form_validation->set_rules('cityid', 'Tỉnh/Thành phố', 'trim|required');
            $this->form_validation->set_rules('districtid', 'Quận/Huyện', 'trim|required');
            $this->form_validation->set_rules('wardid', 'Phường/Xã', 'trim|required');
            if($this->form_validation->run() == TRUE){
                $_update = array(
                    'created' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
                    'fullname' => $this->input->post('fullname'),
                    'phone' =>  $this->input->post('phone'),
                    'address' => $this->input->post('address'),
                    'cityid' => $this->input->post('cityid'),
                    'districtid' => $this->input->post('districtid'),
                    'wardid' => $this->input->post('wardid'),
                    'type' => $this->input->post('type'),
                    'active' => $this->input->post('active'),
                );
                $flag = $this->Autoload_Model->_update(array(
                    'where' => array('id' => $_POST['id']),
                    'table' => 'customer_address',
                    'data' => $_update,
                ));
                if ($flag > 0) {
                    $customerid = $is_valid_token['data']->id;
                    if(!empty($this->input->post('active'))){
                        $this->Autoload_Model->_update(array(
                            'where' => array('customerid' => $customerid, 'id !=' => $_POST['id']),
                            'table' => 'customer_address',
                            'data' => array('active' => 0),
                        ));
                    }
                    $message = [
                        'status' => 200,
                        'message' => "Cập nhập địa chỉ thành công"
                    ];
                    $this->response($message, REST_Controller::HTTP_OK);
                }else{
                    $message = array(
                        'status' => 500,
                        'message' => "Cập nhập địa chỉ không thành công. Có lỗi xảy ra"
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



        } else {
            $this->response(['status' => FALSE, 'message' => $is_valid_token['message'] ], REST_Controller::HTTP_OK);
        }
    }
    public function remove_delete($id)
    {
        $this->load->library('Authorization_Token');
        $is_valid_token = $this->authorization_token->validateToken();
        if (!empty($is_valid_token) AND $is_valid_token['status'] === TRUE)
        {
            $id = $this->security->xss_clean($id);
            $flag = $this->Autoload_Model->_delete(array(
                'where' => array('id' => $id),
                'table' => 'customer_address',
            ));
            if ($flag > 0) {
                $message = [
                    'status' => 200,
                    'message' => "Xóa địa chỉ thành công"
                ];
                $this->response($message, REST_Controller::HTTP_OK);
            }else{
                $message = array(
                    'status' => 500,
                    'message' => "Xóa địa chỉ không thành công. Có lỗi xảy ra"
                );
                $this->response($message, REST_Controller::HTTP_OK);
            }
        } else {
            $this->response(['status' => FALSE, 'message' => $is_valid_token['message'] ], REST_Controller::HTTP_OK);
        }
    }
}