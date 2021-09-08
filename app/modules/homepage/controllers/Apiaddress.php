<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;
require APPPATH . '/libraries/REST_Controller.php';
class Apiaddress extends REST_Controller {

    public $module;
    function __construct() {
        parent::__construct();
        $this->fc_lang = $this->config->item('fc_lang');

    }
    //tính phí vận chuyển
    public function address_get(){
        $parentid = $this->input->get('parentid');
        $select = $this->input->get('select');
        $table = $this->input->get('table');
        $parentField = $this->input->get('parentField');
        if(!empty($parentid)){
            $listCity = $this->Autoload_Model->_get_where(array(
                'select' => $select.', name',
                'table' => $table,
                'where' => array($parentField => $parentid),
            ), TRUE);
        }else if(!empty($parentid == 0) && $parentid != ''){
            $listCity = $this->Autoload_Model->_get_where(array(
                'select' =>'name, provinceid',
                'table' => 'vn_province',
                'order_by' => 'name asc'
            ), TRUE);
        }
        $message = [
            'status' => 200,
            'data' => !empty($listCity) ? $listCity : '',
            'message' => "Data Successful"
        ];
        $this->response($message, REST_Controller::HTTP_OK);
    }
}
