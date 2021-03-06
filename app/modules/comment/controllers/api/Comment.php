<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . '/libraries/REST_Controller.php';

class Comment extends REST_Controller
{

    public $module;

    function __construct()
    {
        parent::__construct();
        $this->fc_lang = $this->config->item('fc_lang');
        $this->load->library(array('configbie'));
        $this->load->library(array('myconstant'));
        $this->load->library('nestedsetbiefrontend', array('table' => 'comment'));
    }

    public function listComment_get()
    {
        header("Access-Control-Allow-Origin: *");
        $perpage = !empty($this->input->get('perpage')) ? $this->input->get('perpage') : 20;
        $page = $this->input->get('page');
        $module = $this->input->get('module');
        $moduleid = $this->input->get('moduleid');
        $parentid = $this->input->get('parentid');
        $idNoneComments = $this->input->get('idNoneComments');
        $page = ($page <= 0) ? 1 : $page;
        $page = $page - 1;


        if(!empty($moduleid)){
            $array = array( 'module' => $module, 'detailid' => $moduleid, 'parentid' => $parentid);
        }else{
            $array = array('parentid' => $parentid);
        }
        $totalRow = $this->Autoload_Model->_get_where(array(
            'select' => 'id',
            'table' => 'comment',
            'where' => $array,
            'count' => TRUE,
        ), TRUE);
        $listComment = $this->Autoload_Model->_get_where(array(
            'select' => 'comment.id,comment.created,comment.comment,comment.parentid,customer.fullname as fullname,customer.avatar as avatar',
            'table' => 'comment',
            'where' => $array,
            'where_not_in' => $idNoneComments,
            'where_in_field' => 'comment.id',
            'join' => array(array('customer','customer.id = comment.customerid','left join')),
            'limit' => $perpage,
            'start' => ($page * $perpage),
            'order_by' => 'comment.id desc',
        ), TRUE);
        if($parentid == 0 && isset($listComment) && is_array($listComment) && count($listComment)){
            foreach ($listComment as $k=>$v){
                $listComment[$k]['child'] = $this->Autoload_Model->_get_where(array(
                    'select' => 'comment.id,comment.created,comment.comment,comment.parentid,customer.fullname as fullname,customer.avatar as avatar',
                    'table' => 'comment',
                    'where' => array('parentid'=>$v['id']),
                    'join' => array(array('customer','customer.id = comment.customerid','left join')),
                    'limit' => $perpage,
                    'start' => ($page * $perpage),
                    'order_by' => 'comment.id desc',
                ), TRUE);
                $listComment[$k]['count_parent_comment'] = $this->Autoload_Model->_get_where(array(
                    'select' => 'id',
                    'table' => 'comment',
                    'where' => array('parentid' => $v['id']),
                    'count' => TRUE,
                ), TRUE);
            }
        }


        
        $totalPage = ceil($totalRow / $perpage);
        $message = [
            'status' => 200,
            'totalRow' => $totalRow,
            'totalPage' => $totalPage,
            'data' => !empty($listComment) ? $listComment : '',
            'message' => "Data Successful"
        ];
        $this->response($message, REST_Controller::HTTP_OK);
    }




    public function createComment_post()
    {
        header('Content-type: application/x-www-form-urlencoded');
        header("Access-Control-Allow-Origin: *");
        $_POST = json_decode(file_get_contents('php://input'), TRUE);

        // Load Authorization Token Library
        $this->load->library('Authorization_Token');

        /**
         * User Token Validation
         */
        $is_valid_token = $this->authorization_token->validateToken();
        if (!empty($is_valid_token) AND $is_valid_token['status'] === TRUE)
        {
            $this->load->library('form_validation');
            $this->form_validation->CI =& $this;
            $this->form_validation->set_error_delimiters(' ', ' /');
            if($_POST['parentid'] ==0){
                $this->form_validation->set_rules('moduleid', 'ID b??i vi???t l?? tr?????ng b???t bu???c', 'trim|required');
                $this->form_validation->set_rules('module', 'Module l?? tr?????ng b???t bu???c', 'trim|required');
            }
            $this->form_validation->set_rules('comment', 'N???i dung b??nh lu???n l?? tr?????ng b???t bu???c', 'trim|required');
            if ($this->form_validation->run($this)) {
                $auth = $this->Autoload_Model->_get_where(array(
                    'select' => 'id, email, fullname, email',
                    'table' => 'customer',
                    'where' => array(
                        'id' => $is_valid_token['data']->id,
                    ),
                ));
                $_insert = array(
                    'title' => '',
                    'customerid' => $auth['id'],
                    'fullname' => $auth['fullname'],
                    'email' => $auth['email'],
                    'module' => $_POST['module'],
                    'detailid' => $_POST['moduleid'],
                    'parentid' => isset($_POST['parentid']) ? $_POST['parentid'] : 0,
                    'comment' => $_POST['comment'],
                    'publish' => 0,
                    'created' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
                    'alanguage' => $this->fc_lang,
                );

                // pre($_insert);die;
                $insertId = $this->Autoload_Model->_create(array(
                    'table' => 'comment',
                    'data' => $_insert,
                ));
                if ($insertId > 0) {
                    $this->nestedsetbiefrontend->Get('level ASC, order ASC');
                    $this->nestedsetbiefrontend->Recursive(0, $this->nestedsetbiefrontend->Set());
                    $this->nestedsetbiefrontend->Action();

                    $data = $this->Autoload_Model->_get_where(array(
                        'select' => 'comment.id,comment.created,comment.comment,comment.parentid,customer.fullname as fullname,customer.avatar as avatar',
                        'table' => 'comment',
                        'where' => array('comment.id' => $insertId),
                        'join' => array(array('customer','customer.id = comment.customerid','left join'))
                    ));
                    // Success
                    $message = [
                        'status' => 200,
                        'data' => $data,
                        'message' => "B??nh lu???n b??i vi???t th??nh c??ng"
                    ];
                    $this->response($message, REST_Controller::HTTP_OK);
                }else{
                    // Error
                    $message = [
                        'status' => 500,
                        'message' => "ERROR not create"
                    ];
                    $this->response($message, REST_Controller::HTTP_NOT_FOUND);
                }
            }else{
                // Form Validation Errors
                $message = array(
                    'status' => 500,
                    'message' => validation_errors()
                );
                $this->response($message, REST_Controller::HTTP_NOT_FOUND);
            }


        } else {
            $this->response(['status' => 500, 'message' => $is_valid_token['message'] ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function updateArticle_post()
    {


    }

    public function deleteArticle_post()
    {


    }
}
