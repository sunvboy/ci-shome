<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;
require APPPATH . '/libraries/REST_Controller.php';
class Api extends REST_Controller {

    public $module;
    function __construct() {
        parent::__construct();
        $this->fc_lang = $this->config->item('fc_lang');

    }
    public function error404(){
        $message = [
            'status' => 404,
            'message' => "404 Page Not Found"
        ];
        $this->response($message, REST_Controller::HTTP_NOT_FOUND);

    }
    public function fcSystem_get(){
        $message = [
            'status' => 200,
            'data' => !empty($this->fcSystem) ? $this->fcSystem : '',
            'message' => "Data Successful"
        ];
        $this->response($message, REST_Controller::HTTP_OK);
    }
    public function menu_get(){
        $keyword = $this->input->get('keyword');
        $main_nav = navigation(array('keyword' => $keyword, 'output' => 'array'), $this->fc_lang);
        if(!empty($keyword)){
            $message = [
                'status' => 200,
                'data' => !empty($main_nav) ? $main_nav : '',
                'message' => "Data Successful"
            ];
            $this->response($message, REST_Controller::HTTP_OK);
        }else{
            $message = [
                'status' => 500,
                'message' => "No data menu"
            ];
            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function actCheckSlug_get(){
        $slug = $this->input->get('slug');
        $table = $this->input->get('table');
        if(!empty($slug) && !empty($table)){

            $data = $this->Autoload_Model->_get_where(array(
                'select' => 'id, canonical, title,description,meta_title,meta_description',
                'table' => $table,
                'where' => array('canonical' => $slug),
            ));
            $message = [
                'status' => 200,
                'data' => !empty($data) ? $data : '',
                'message' => "Data Successful"
            ];
            $this->response($message, REST_Controller::HTTP_OK);
        }else{
            $message = [
                'status' => 500,
                'message' => "No data menu"
            ];
            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function sitemap_get(){
        $routerList = $this->Autoload_Model->_get_where(array(
            'select' => 'canonical',
            'table' => 'router',
        ), true);
        if(!empty($routerList) && !empty($routerList)){
            $message = [
                'status' => 200,
                'data' => !empty($routerList) ? $routerList : '',
                'message' => "Data Successful"
            ];
            $this->response($message, REST_Controller::HTTP_OK);
        }else{
            $message = [
                'status' => 500,
                'message' => "No data menu"
            ];
            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
        }
    }

}
