<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;
require APPPATH . '/libraries/REST_Controller.php';
class Wishlist extends REST_Controller
{
    public $module;
    function __construct() {
        parent::__construct();
        $this->module = 'user';
        $this->fc_lang = $this->config->item('fc_lang');
        $this->load->library(array('configbie'));
    }
    public function create_post()
    {
        header("Access-Control-Allow-Origin: *");
        $this->load->library('Authorization_Token');
        if(empty($_POST['postman'])){
            $_POST = json_decode(file_get_contents('php://input'), TRUE);
        }
        $is_valid_token = $this->authorization_token->validateToken();
        if (!empty($is_valid_token) AND $is_valid_token['status'] === TRUE)
        {
            $customerid = $is_valid_token['data']->id;
            $check = $this->Autoload_Model->_get_where(array(
                'select' => 'id',
                'table' => 'customer_wishlist',
                'where' => array('customerid' => $customerid,'productid' =>  $this->input->post('productid')),
            ));
            if(!isset($check) || is_array($check) == false || count($check) == 0) {
                $_insert = array(
                    'created' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
                    'productid' => $this->input->post('productid'),
                    'customerid' => $customerid,
                );
                $this->db->insert('customer_wishlist', $_insert);
                $resultid = $this->db->insert_id();
                if ($resultid > 0) {
                    $message = [
                        'status' => 200,
                        'message' => "Đã thích"
                    ];
                }else{
                    $message = [
                        'status' => 500,
                        'message' => "ERROR"
                    ];
                }
            }else{
                $message = [
                    'status' => 500,
                    'message' => "Sản phẩm đã tổn tại trong sản phẩm yêu thích"
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
            $json = [];
            $json[] = array('customer_wishlist as tb2', 'tb1.id = tb2.productid', 'full');
            $totalRow =  $this->Autoload_Model->_get_where(array(
                'select' => 'tb1.id',
                'table' => 'product as tb1',
                'where' => array('tb1.publish' => 0, 'tb2.customerid' => $customerid),
                'join' => $json,
                'distinct' => 'true',
                'count' => TRUE,
            ));
            $listWishlist = $this->Autoload_Model->_get_where(array(
                'table' => 'product as tb1',
                'select' => 'tb2.id as id_wishlist,tb1.id, tb1.title, tb1.canonical, tb1.price, tb1.price_sale, tb1.price_contact, tb1.image, tb1.description',
                'where' => array('tb1.publish' => 0, 'tb2.customerid' => $customerid),
                'limit' => $perpage,
                'start' => ($page * $perpage),
                'order_by' => 'tb2.id desc',
                'join' => $json,

            ),TRUE);
            $totalPage = ceil($totalRow / $perpage);
            $message = [
                'status' => 200,
                'totalRow' => $totalRow,
                'totalPage' => $totalPage,
                'data' => !empty($listWishlist) ? $listWishlist : '',
                'message' => "Data Successful"
            ];
            $this->response($message, REST_Controller::HTTP_OK);

        } else {
            $this->response(['status' => FALSE, 'message' => $is_valid_token['message'] ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function delete_delete($id)
    {
        $this->load->library('Authorization_Token');
        $is_valid_token = $this->authorization_token->validateToken();
        if (!empty($is_valid_token) AND $is_valid_token['status'] === TRUE)
        {
            $id = $this->security->xss_clean($id);
            $customerid = $is_valid_token['data']->id;

            $flag = $this->Autoload_Model->_delete(array(
                'where' => array('customerid' => $customerid,'productid' => $id),
                'table' => 'customer_wishlist',
            ));
            if ($flag > 0) {
                $message = [
                    'status' => 200,
                    'message' => "Đã bỏ thích"
                ];
                $this->response($message, REST_Controller::HTTP_OK);
            }else{
                $message = array(
                    'status' => 500,
                    'message' => "Đã bỏ thích không thành công. Có lỗi xảy ra"
                );
                $this->response($message, REST_Controller::HTTP_OK);
            }
        } else {
            $this->response(['status' => FALSE, 'message' => $is_valid_token['message'] ], REST_Controller::HTTP_OK);
        }
    }
}