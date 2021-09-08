<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends MY_Controller {



    public $module;
    function __construct() {
        parent::__construct();
        $this->load->library(array('configbie'));
        $this->load->helper(array('myfrontendcommon'));
        $this->load->library('nestedsetbie', array('table' => 'product_brand'));
        $this->fc_lang = $this->config->item('fc_lang');
    }
    public function view($catalogueid = 0, $page = 1){

        $data['page'] = $page;

        $catalogueid = (int)$catalogueid;
        $seoPage = '';


        $detailCatalogue = $this->Autoload_Model->_get_where(array(
            'select' => '*',
            'table' => 'product_brand',
            'where' => array('alanguage' => $this->fc_lang),
            'query' => 'id = '.$catalogueid,
        ));

        if(!isset($detailCatalogue) || is_array($detailCatalogue) == false || count($detailCatalogue) == 0){
            $this->session->set_flashdata('message-danger', 'Danh mục sản phẩm không tồn tại');
            redirect(BASE_URL);
        }



        $param['sort'] = ($this->input->get('sort')) ? $this->input->get('sort') : '';

        $order_by = 'tb1.order asc,tb1.id desc';
        if(!empty($param['sort']) ){
            $sort = explode('|', $param['sort']);
            $order_by =  'tb1.'.$sort[0].' '.$sort[1];
        }

        $config['total_rows'] = $this->Autoload_Model->_get_where(array(
            'select' => 'tb1.id',
            'table' => 'product as tb1',
            'where' => array('tb1.brandid' => $catalogueid,'tb1.publish' => 0,'tb1.alanguage' => $this->fc_lang),
            'distinct' => 'true',
            'count' =>TRUE,
        ));

        $data['total_rows'] = $config['total_rows'];
        $data['totalPage'] = $data['per_page'] = 0;
        $config['base_url']  = '';
        if($config['total_rows'] > 0){
            $this->load->library('pagination');

            $config['base_url'] = rewrite_url($detailCatalogue['canonical'], false, true) ;
            $config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');

            $config['prefix'] = 'trang-';

            $config['first_url'] = $config['base_url'].$config['suffix'];
            $config['per_page'] = 16;
            $config['uri_segment'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['full_tag_open'] = '<div class="pagenavi">';
            $config['full_tag_close'] = '</div>';
            $config['first_tag_open'] = '';
            $config['first_tag_close'] = '';
            $config['last_tag_open'] = '';
            $config['last_tag_close'] = '';
            $config['cur_tag_open'] = '<a class="active">';
            $config['cur_tag_close'] = '</a>';
            $config['next_tag_open'] = '';
            $config['next_tag_close'] = '';
            $config['prev_tag_open'] = '';
            $config['prev_tag_close'] = '';
            $config['num_tag_open'] = '';
            $config['num_tag_close'] = '';
            $this->pagination->initialize($config);
            $data['PaginationList'] = $this->pagination->create_links();
            $totalPage = ceil($config['total_rows']/$config['per_page']);
            $data['totalPage'] = $totalPage;
            $page = ($page <= 0)?1:$page;
            $page = ($page > $totalPage)?$totalPage:$page;
            $seoPage = ($page >= 2) ? '-Trang '.$page : '';
            if($page >= 2){
                $data['canonical'] = $config['base_url'].'/trang-'.$page.$this->config->item('url_suffix');
            }
            $page = $page - 1;
            $data['from'] = ($page * $config['per_page']) + 1;
            $data['to'] = ($config['per_page']*($page+1) > $config['total_rows']) ? $config['total_rows']  : $config['per_page']*($page+1);
            $productList = $this->Autoload_Model->_get_where(array(
                'distinct' => 'true',
                'select' => 'tb1.id, tb1.title, tb1.canonical, tb1.price, tb1.price_sale, tb1.price_contact, tb1.image, tb1.order,tb1.content,tb1.brandid',
                'table' => 'product as tb1',
                'where' => array('tb1.brandid' => $catalogueid,'tb1.publish' => 0,'tb1.image !=' => '','tb1.alanguage' => $this->fc_lang),
                'limit' => $config['per_page'],
                'start' => $page * $config['per_page'],
                'order_by' => $order_by,
            ), true);
            $data['productList'] = $productList;


        }



        $data['meta_title'] = (!empty($detailCatalogue['meta_title'])?$detailCatalogue['meta_title']:$detailCatalogue['title']).$seoPage;
        $data['meta_description'] = (!empty($detailCatalogue['meta_description'])?$detailCatalogue['meta_description']:cutnchar(strip_tags($detailCatalogue['description']), 255)).$seoPage;
        $data['meta_image'] = !empty($detailCatalogue['image'])?base_url($detailCatalogue['image']):'';
        if(!isset($data['canonical']) || empty($data['canonical'])){
            $data['canonical'] = $config['base_url'].$this->config->item('url_suffix');
        }

        $data['detailCatalogue'] = $detailCatalogue;
        $data['template'] = 'product/frontend/brand/view';
        $this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);

    }


}
