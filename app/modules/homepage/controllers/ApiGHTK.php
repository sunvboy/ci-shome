<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;
require APPPATH . '/libraries/REST_Controller.php';
class ApiGHTK extends REST_Controller {

    public $module;
    function __construct() {
        parent::__construct();
        $this->fc_lang = $this->config->item('fc_lang');

    }
    //tính phí vận chuyển
    public function shipment_get(){


        $pick_address = !empty($_GET['pick_address'])?$_GET['pick_address']:'';
        $pick_province = !empty($_GET['pick_province'])?$_GET['pick_province']:'';
        $pick_district = !empty($_GET['pick_district'])?$_GET['pick_district']:'';
        $pick_ward = !empty($_GET['pick_ward'])?$_GET['pick_ward']:'';
        $pick_street = !empty($_GET['pick_street'])?$_GET['pick_street']:'';
        $province = !empty($_GET['province'])?$_GET['province']:'';
        $district = !empty($_GET['district'])?$_GET['district']:'';
        $ward = !empty($_GET['ward'])?$_GET['ward']:'';
        $address = !empty($_GET['address'])?$_GET['address']:'';
        $weight = !empty($_GET['weight'])?$_GET['weight']:'';
        $price = !empty($_GET['price'])?$_GET['price']:'';
        $transport = !empty($_GET['transport'])?$_GET['transport']:'';
        $deliver_option = !empty($_GET['deliver_option'])?$_GET['deliver_option']:'';
        $detailCity = $this->Autoload_Model->_get_where(array(
            'select' =>  'name',
            'table' => 'vn_province',
            'where' => array('provinceid' => $province),
        ),);
        $detailDistrict = $this->Autoload_Model->_get_where(array(
            'select' =>  'name',
            'table' => 'vn_district',
            'where' => array('districtid' => $district),
        ));
        $detailWard = $this->Autoload_Model->_get_where(array(
            'select' =>  'name',
            'table' => 'vn_ward',
            'where' => array('wardid' => $ward),
        ));
        $data = array(
            "pick_address" => 'Thôn Tân Hưng',
            "pick_province" => 'Hưng Yên',
            "pick_district" => 'Khoái Châu',
            "pick_ward" => 'Xã Chí Tân',
            "pick_street" => 'Địa chỉ khác',
            "province" => !empty($detailCity)?$detailCity['name']:'',
            "district" => !empty($detailDistrict)?$detailDistrict['name']:'',
            "ward" => !empty($detailWard)?$detailWard['name']:'',
            "address" => $address,
            "weight" => 1000,
            "value" => $price,
            "deliver_option" => 'none',
            "transport" => 'road'
        );
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => URL_GHTK."/services/shipment/fee?" . http_build_query($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                "Token:".TOKEN_GHTK,
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response,TRUE);
        $message = [
            'status' => 200,
            'data' => !empty($response) ? $response : '',
            'message' => "Data Successful"
        ];
        $this->response($message, REST_Controller::HTTP_OK);
    }


}
