<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;
require APPPATH . '/libraries/REST_Controller.php';
class Catalogue extends REST_Controller {

    public $module;
    function __construct() {
        parent::__construct();
        $this->fc_lang = $this->config->item('fc_lang');
        $this->load->library(array('configbie'));
    }
    public function listArticleByCatalogue_get()
    {
        header("Access-Control-Allow-Origin: *");
        $perpage = !empty($this->input->get('perpage')) ? $this->input->get('perpage') : 20;
        $page = $this->input->get('page');
        $page = ($page <= 0) ? 1 : $page;
        $page = $page - 1;
        $catalogueid = $this->input->get('catalogueid');
        $slug = $this->input->get('slug');
        $keyword = $this->input->get('keyword');
        $order_by = $this->input->get('order_by');
        if (empty($order_by)) {
            $order_by = '`object`.`order` asc,`object`.`id` desc';
        }
        if (!empty($keyword)) {
            $keyword = '(`object`.`title` LIKE \'%' . $keyword . '%\')';
        }
        if (!empty($catalogueid)) {
            $where = array('id' => $catalogueid,'publish' => 0, 'alanguage' => $this->fc_lang);
        }else{
            $where = array('canonical' => $slug,'publish' => 0, 'alanguage' => $this->fc_lang);

        }
        
        $detailCatalogue = $this->Autoload_Model->_get_where(array(
            'select' => 'id,title,description,image,canonical,meta_title,meta_description',
            'table' => 'article_catalogue',
            'where' => $where,
        ));
        if (!isset($detailCatalogue) && !is_array($detailCatalogue)) {
            $message = [
                'status' => 500,
                'message' => "No data article"
            ];
            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
        }else{
            $totalRow = $this->Autoload_Model->_condition(array(
                'module' => 'article',
                'select' => '`object`.`id`',
                'where' => '`object`.`alanguage` = \'' . $this->fc_lang . '\' AND `object`.`publish` = 0',
                'keyword' => $keyword,
                'catalogueid' => $detailCatalogue['id'],
                'count' => TRUE,
            ));
            $listArticle = $this->Autoload_Model->_condition(array(
                'module' => 'article',
                'select' => '`object`.`id`, `object`.`title`, `object`.`slug`,`object`.`canonical`, `object`.`description`,`object`.`image`, `object`.`catalogueid`, `object`.`catalogue`, `object`.`publish`,  `object`.`created`, `object`.`order`, `object`.`viewed`, (SELECT avatar FROM user WHERE user.id = object.userid_created) as user_avatar, (SELECT fullname FROM user WHERE user.id = object.userid_created) as user_created, (SELECT title FROM article_catalogue WHERE article_catalogue.id = object.catalogueid) as catalogue_title',
                'where' => '`object`.`alanguage` = \'' . $this->fc_lang . '\' AND `object`.`publish` = 0',
                'keyword' => $keyword,
                'catalogueid' => $detailCatalogue['id'],
                'limit' => $perpage,
                'start' => ($page * $perpage),
                'order_by' => $order_by,
            ));
            if(isset($listArticle) && is_array($listArticle) && count($listArticle)){
                foreach ($listArticle as $k=>$v){
                    $catalogue = json_decode($v['catalogue'], TRUE);
                    if(isset($catalogue) && is_array($catalogue) && count($catalogue)){
                        $listArticle[$k]['listCatalogue'] = $this->Autoload_Model->_get_where(array(
                            'select' => 'id, title, slug, canonical',
                            'table' => 'article_catalogue',
                            'where_in' => json_decode($v['catalogue'], TRUE),
                            'where_in_field' => 'id',
                        ), TRUE);
                    }
                }
            }
            $totalPage = ceil($totalRow / $perpage);
            $message = [
                'status' => 200,
                'totalRow' => $totalRow,
                'totalPage' => $totalPage,
                'data' => !empty($listArticle) ? $listArticle : '',
                'category' => !empty($detailCatalogue) ? $detailCatalogue : '',
                'message' => "Data Successful"
            ];
            $this->response($message, REST_Controller::HTTP_OK);
        }
    }

}
