<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;
require APPPATH . '/libraries/REST_Controller.php';
class Order extends REST_Controller
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
            $detailOrder = $this->Autoload_Model->_get_where(array(
                'table' => 'order',
                'select' => 'id,code,payment, fullname, created, total_cart_final, status,quantity, fullname , phone, email, note, address_detail , cart_json,ship,
				(SELECT name FROM vn_province WHERE order.cityid = vn_province.provinceid) as address_city, 
				(SELECT name FROM vn_district WHERE order.districtid = vn_district.districtid) as address_distric, 
				(SELECT name FROM vn_ward WHERE order.wardid = vn_ward.wardid) as address_ward',
                'where' => array('userid'=>$customerid,'id' => $_GET['id']),
            ));
            if(isset($detailOrder) && is_array($detailOrder) && count($detailOrder)){
                $detailOrder['data_order'] = json_decode(base64_decode($detailOrder['cart_json']), true);
                $message = [
                    'status' => 200,
                    'data' => !empty($detailOrder) ? $detailOrder : '',
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
                'table' => 'order',
                'select' => 'id',
                'where' => array('userid'=>$customerid),
                'count' => TRUE,
            ));
            $listOrder = $this->Autoload_Model->_get_where(array(
                'table' => 'order',
                'select' => 'id,code,quantity,total_cart_final,status,created,fullname,userid',
                'where' => array('userid'=>$customerid),
                'limit' => $perpage,
                'start' => ($page * $perpage),
                'order_by' => 'id desc',
            ),TRUE);
            $totalPage = ceil($totalRow / $perpage);
            $message = [
                'status' => 200,
                'totalRow' => $totalRow,
                'totalPage' => $totalPage,
                'data' => !empty($listOrder) ? $listOrder : '',
                'message' => "Data Successful"
            ];
            $this->response($message, REST_Controller::HTTP_OK);

        } else {
            $this->response(['status' => FALSE, 'message' => $is_valid_token['message'] ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

}