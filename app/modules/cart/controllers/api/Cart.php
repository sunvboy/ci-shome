<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . '/libraries/REST_Controller.php';

class Cart extends REST_Controller
{

    public $module;

    function __construct()
    {
        parent::__construct();
        $this->fc_lang = $this->config->item('fc_lang');
        $this->load->library(array('configbie'));
    }


    public function payment_post()
    {
        $_POST = json_decode(file_get_contents('php://input'), TRUE);
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;
        $this->form_validation->set_error_delimiters('','/');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('fullname', 'Họ và tên', 'trim|required');
        $this->form_validation->set_rules('phone','Số điện thoại', 'trim|required|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('address', 'Địa chỉ', 'trim|required');
        $this->form_validation->set_rules('cityid', 'Tỉnh/Thành phố', 'trim|required');
        $this->form_validation->set_rules('districtid', 'Quận/Huyện', 'trim|required');
        $this->form_validation->set_rules('wardid', 'Phường/Xã', 'trim|required');
        if($this->form_validation->run($this)){
            $_insert = array(
                'ship' => $this->input->post('ship'),
                'code' => CodeRender('order'),
                'fullname' => $this->input->post('fullname'),
                'phone' => $this->input->post('phone'),
                'email' => !empty($this->input->post('email'))?$this->input->post('email'):'',
                'note' => !empty($this->input->post('message'))?$this->input->post('message'):'',
                'cityid' => !empty($this->input->post('cityid'))?$this->input->post('cityid'):'',
                'districtid' => !empty($this->input->post('districtid'))?$this->input->post('districtid'):'',
                'wardid' => $this->input->post('wardid'),
                'payment' => $this->input->post('payment'),
                'address_detail' => $this->input->post('address'),
                'quantity' => $this->input->post('quantity'),
                'total_cart_final' => str_replace('.', '',$this->input->post('total_cart_final')),
                'cart_json' => base64_encode(json_encode($this->input->post('cart_json'))),
                'userid' => !empty($this->input->post('userid')) ? $this->input->post('userid') : '',
                'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
                'status' => 'pending',
            );
            $resultid = $this->Autoload_Model->_create(array(
                'table' => 'order',
                'data' => $_insert,
            ));

            if($resultid > 0) {

                foreach ($this->input->post('cart_json') as $key => $product) {
                    $_insert_relationship[] = array(
                        'orderid' => $resultid,
                        'module' => 'product',
                        'title' => $product['title'],
                        'moduleid' => $product['id'],
                        'image' => $product['image'],
                        'quantity' => $product['quantity'],
                        'price_final' => $product['price'],
                        'created' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
                    );
                }
                $this->Autoload_Model->_create_batch(array(
                    'table' => 'order_relationship',
                    'data' => $_insert_relationship,
                ));

            }
            $message = [
                'status' => 200,
                'data' => $resultid,
                'message' =>  'Bạn đã tạo đơn hàng thành công, vui lòng kiểm tra email'
            ];
            $this->response($message, REST_Controller::HTTP_OK);

        }else{
            $message = [
                'status' => 500,
                'message' =>  validation_errors()
            ];
            $this->response($message, REST_Controller::HTTP_OK);
        }



    }

    public function detailPayment_get()
    {
        $id = $_GET['id'];
        if(!empty($id)){
            $detailorder = $this->Autoload_Model->_get_where(array(
                'select' => 'id,code,payment, fullname, created, total_cart_final, status,quantity, fullname , phone, email, note, address_detail , cart_json,ship,
				(SELECT name FROM vn_province WHERE order.cityid = vn_province.provinceid) as address_city, 
				(SELECT name FROM vn_district WHERE order.districtid = vn_district.districtid) as address_distric, 
				(SELECT name FROM vn_ward WHERE order.wardid = vn_ward.wardid) as address_ward',
                'table' => 'order',
                'where' => array('id' => $id),
            ));

            if(!isset($detailorder) || is_array($detailorder) == false || count($detailorder) == 0){
                $message = [
                    'status' => 200,
                    'message' =>  "ERROR not ID"

                ];
                $this->response($message, REST_Controller::HTTP_OK);
            }else{
                $detailorder['data_order'] = json_decode(base64_decode($detailorder['cart_json']), true);
                $message = [
                    'status' => 200,
                    'data' => $detailorder,
                ];
                $this->response($message, REST_Controller::HTTP_OK);
            }
        }else{
            $message = [
                'status' => 200,
                'message' =>  "ERROR not ID"
            ];
            $this->response($message, REST_Controller::HTTP_OK);
        }



    }


}
