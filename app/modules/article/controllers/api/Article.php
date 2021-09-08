<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . '/libraries/REST_Controller.php';

class Article extends REST_Controller
{

    public $module;

    function __construct()
    {
        parent::__construct();
        $this->fc_lang = $this->config->item('fc_lang');
        $this->load->library(array('configbie'));
    }

    public function listArticle_get()
    {
        header("Access-Control-Allow-Origin: *");
        $perpage = !empty($this->input->get('perpage')) ? $this->input->get('perpage') : 20;
        $page = $this->input->get('page');
        $keyword = $this->input->get('keyword');
        $order_by = $this->input->get('order_by');
        $page = ($page <= 0) ? 1 : $page;
        $page = $page - 1;
        if (empty($order_by)) {
            $order_by = 'order asc,id desc';
        }
        if (!empty($keyword)) {
            $keyword = '(title LIKE \'%' . $keyword . '%\')';
        }
        $totalRow = $this->Autoload_Model->_get_where(array(
            'select' => 'id',
            'table' => 'article',
            'query' => '`alanguage` = \'' . $this->fc_lang . '\' AND `publish` = 0',
            'keyword' => $keyword,
            'count' => TRUE,
        ), TRUE);
        $listArticle = $this->Autoload_Model->_get_where(array(
            'select' => 'id,title, catalogueid,catalogue, created, order, viewed, image,canonical,slug,meta_title,meta_description, (SELECT avatar FROM user WHERE user.id = article.userid_created) as user_avatar, (SELECT fullname FROM user WHERE user.id = article.userid_created) as user_created, (SELECT title FROM article_catalogue WHERE article_catalogue.id = article.catalogueid) as catalogue_title,description',
            'table' => 'article',
            'query' => '`alanguage` = \'' . $this->fc_lang . '\' AND `publish` = 0',
            'keyword' => $keyword,
            'limit' => $perpage,
            'start' => ($page * $perpage),
            'order_by' => $order_by,
        ), TRUE);
        if (isset($listArticle) && is_array($listArticle) && count($listArticle)) {
            foreach ($listArticle as $k => $v) {
                $catalogue = json_decode($v['catalogue'], TRUE);
                if (isset($catalogue) && is_array($catalogue) && count($catalogue)) {
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
            'message' => "Data Successful"
        ];
        $this->response($message, REST_Controller::HTTP_OK);
    }

    public function detailArticle_get()
    {
        header("Access-Control-Allow-Origin: *");
        $canonical = $this->input->get('canonical');
        $id = (int)$this->input->get('id');


        if (!empty($canonical)) {
            $where = array('alanguage' => $this->fc_lang, 'publish' => 0, 'canonical' => $canonical);
        }else{
            $where = array('alanguage' => $this->fc_lang, 'publish' => 0, 'id' => $id);
        }


        $listArticle = $this->Autoload_Model->_get_where(array(
            'select' => 'id,title,catalogue,created, viewed, image,canonical,slug,meta_title,meta_description,userid_created, (SELECT avatar FROM user WHERE user.id = article.userid_created) as user_avatar,(SELECT description FROM user WHERE user.id = article.userid_created) as user_description, (SELECT fullname FROM user WHERE user.id = article.userid_created) as user_created, (SELECT title FROM article_catalogue WHERE article_catalogue.id = article.catalogueid) as catalogue_title,description',
            'table' => 'article',
            'where' => $where,
        ));

        if (isset($listArticle) && is_array($listArticle) && count($listArticle)) {
            $listArticle['count_comment'] = $this->Autoload_Model->_get_where(array(
                'select' => 'id',
                'table' => 'comment',
                'where' => array('detailid' => $listArticle['id'], 'module' => 'article'),
                'count' => 'TRUE',
            ));
            $catalogue = json_decode($listArticle['catalogue'], TRUE);
            if (isset($catalogue) && is_array($catalogue) && count($catalogue)) {
                $listArticle['listCatalogue'] = $this->Autoload_Model->_get_where(array(
                    'select' => 'id, title, slug, canonical',
                    'table' => 'article_catalogue',
                    'where_in' => json_decode($listArticle['catalogue'], TRUE),
                    'where_in_field' => 'id',
                ), TRUE);
            }
            $this->Autoload_Model->_update(array(
                'table' => 'article',
                'where' => array('id' => $listArticle['id']),
                'data' => array('viewed' => $listArticle['viewed'] + 1),
            ));
            $message = [
                'status' => 200,
                'data' => !empty($listArticle) ? $listArticle : '',
                'message' => "Data Successful"
            ];
            $this->response($message, REST_Controller::HTTP_OK);
        }else{
            $message = [
                'status' => 500,
                'message' => "Data Error"
            ];
            $this->response($message, REST_Controller::HTTP_OK);

        }

    }

    public function listArticleAuth_get()
    {
        header("Access-Control-Allow-Origin: *");
        $order_by = $this->input->get('order_by');
        $limit = $this->input->get('limit');
        $authid = $this->input->get('authid');
        $id = $this->input->get('id');
        $listArticle = $this->Autoload_Model->_get_where(array(
            'select' => 'id,title, catalogueid,catalogue, created, order, viewed, image,canonical,slug,meta_title,meta_description, (SELECT avatar FROM user WHERE user.id = article.userid_created) as user_avatar, (SELECT fullname FROM user WHERE user.id = article.userid_created) as user_created, (SELECT title FROM article_catalogue WHERE article_catalogue.id = article.catalogueid) as catalogue_title,description',
            'table' => 'article',
            'where' => array('alanguage' => $this->fc_lang, 'publish' => 0, 'userid_created' => $authid, 'id !=' => $id),
            'order_by' => !empty($order_by) ? $order_by : 'order asc,id desc',
            'limit' => !empty($limit) ? $limit : 5,
        ), TRUE);
        if (isset($listArticle) && is_array($listArticle) && count($listArticle)) {
            foreach ($listArticle as $k => $v) {
                $catalogue = json_decode($v['catalogue'], TRUE);
                if (isset($catalogue) && is_array($catalogue) && count($catalogue)) {
                    $listArticle[$k]['listCatalogue'] = $this->Autoload_Model->_get_where(array(
                        'select' => 'id, title, slug, canonical',
                        'table' => 'article_catalogue',
                        'where_in' => json_decode($v['catalogue'], TRUE),
                        'where_in_field' => 'id',
                    ), TRUE);
                }
            }
        }
        $message = [
            'status' => 200,
            'data' => !empty($listArticle) ? $listArticle : '',
            'message' => "Data Successful"
        ];
        $this->response($message, REST_Controller::HTTP_OK);
    }


    public function createArticle_post()
    {

    }

    public function updateArticle_post()
    {


    }

    public function deleteArticle_post()
    {


    }
}
