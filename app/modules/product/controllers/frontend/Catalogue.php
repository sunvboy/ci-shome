<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogue extends MY_Controller {



	public $module;
	function __construct() {
		parent::__construct();
		$this->load->library(array('configbie'));
		$this->load->helper(array('myfrontendcommon'));
		$this->load->library('nestedsetbie', array('table' => 'product_catalogue'));
        $this->fc_lang = $this->config->item('fc_lang');
	}
	public function view($catalogueid = 0, $page = 1){

        $data['page'] = $page;

		$catalogueid = (int)$catalogueid;
		$seoPage = '';

		$product = $this->Autoload_Model->_get_where(array(
            'select' => 'MAX(tb1.price) as max_price, MIN(tb1.price) as min_price',
            'table' => 'product as tb1',
            'where' => array('tb1.publish' => 0,'tb1.alanguage' => $this->fc_lang),
            'join' => array(array('catalogue_relationship as tb3', 'tb1.id = tb3.moduleid AND tb3.module = "product"', 'inner')),
            'query' => 'tb3.catalogueid = '.$catalogueid,
            'distinct' => 'true',
        ));

        $data['min_price'] = ($product['min_price'] != '') ? $product['min_price'] : 0;
        $data['max_price'] = ($product['max_price'] != '') ? $product['max_price'] : 0;


        $json = [];
        $data['from'] = 0;
        $data['to'] = 0;
        $listPerpage = $this->configbie->data('perpage_frontend');
        $perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : current($listPerpage);
        $page = ($this->input->get('page')) ? $this->input->get('page') : $page;
        $keyword = $this->db->escape_like_str($this->input->get('keyword'));
        $param['catalogueid'] = ($this->input->get('catalogueid')) ? $this->input->get('catalogueid') : $catalogueid;
        $param['brand'] = ($this->input->get('brand')) ? $this->input->get('brand') : '';
        $param['attr'] = ($this->input->get('attr')) ? $this->input->get('attr') : '';
        if(isset($param['attr']) ){
        	$attr = explode(';',$param['attr']) ;
	        foreach ($attr as $key => $val) {
		        if ($key % 2 == 1){
		            if($val != '' ){
		                $data['attrList'][] = $val;
		            }
		        }
		    }
		}
        $param['min_price'] = ($this->input->get('min_price')) ? $this->input->get('min_price') : $data['min_price'];
        $param['max_price'] = ($this->input->get('max_price')) ? $this->input->get('max_price') : $data['max_price'];
        $param['sort'] = ($this->input->get('sort')) ? $this->input->get('sort') : '';
        $detailCatalogue = $this->Autoload_Model->_get_where(array(
            'select' => 'id, title, level, lft, rgt, parentid, brand_json, image_json, attrid, canonical,description, image, icon',
            'table' => 'product_catalogue',
            'where' => array('alanguage' => $this->fc_lang),
            'query' => 'id = '.$param['catalogueid'],
        ));

		if(!isset($detailCatalogue) || is_array($detailCatalogue) == false || count($detailCatalogue) == 0){
			$this->session->set_flashdata('message-danger', 'Danh m???c s???n ph???m kh??ng t???n t???i');
			redirect(BASE_URL);
		}


        $data['post_min_price'] = $param['min_price'];
        $data['post_max_price'] = $param['max_price'];

        $query = '';


        $order_by = 'tb1.order asc,tb1.id desc';
        if(!empty($param['sort']) ){
            $sort = explode('|', $param['sort']);
            $order_by =  'tb1.'.$sort[0].' '.$sort[1];
        }

        if(!empty($param['catalogueid'])){
            $temp = $this->Autoload_Model->_get_where(array(
                'select' => 'id, attrid',
                'table' => 'product_catalogue',
                'query' => 'lft >= '.$detailCatalogue['lft'].' AND '.'rgt <= '.$detailCatalogue['rgt'],
            ), true);

            $attrList = getColumsInArray($temp, 'attrid');
            $cataList = getColumsInArray($temp, 'id');
            $str_cata = '';
            if(isset($cataList) && is_array($cataList) && count($cataList)){
                foreach ($cataList as $key => $val) {
                    $str_cata = $str_cata.$val.', ';
                }
            }
            $str_cata = substr( $str_cata, 0, strlen($str_cata) -2);
            $str_cata = '('.$str_cata.')';

            $query = $query.' AND tb3.catalogueid IN  '.$str_cata;
        }
        if(!empty($param['brand'])){
//            $str_brand= '';
//            foreach ($param['brand'] as $key => $value) {
//                $str_brand = $str_brand.$value.', ';
//            }
//            $str_brand = substr( $str_brand, 0, strlen($str_brand) -2);
//            $str_brand = '('.$str_brand.')';
            $query = $query.' AND tb1.brandid =  '.$param['brand'];
        }
        // x???? li?? ??i????u ki????n lo??c thu????c ti??nh
        if(!empty($param['attr'])){
            $attr = explode(';',$param['attr']) ;
            foreach ($attr as $key => $val) {
                if ($key % 2 == 0){
                    if($val != '' ){
                        $attribute[$val][] = $attr[$key +1];
                    }
                }else{
                    continue;
                }
            }
            $total = 0;
            $index = 100;
            foreach ($attribute as $key => $val) {
                $attribute_catalogue = $this->Autoload_Model->_get_where(array(
                    'select' =>'id',
                    'table' =>'attribute_catalogue',
                    'where'=> array('keyword'=> $key),
                ));
                $query = $query.' AND ( ';
                $total++;
                $index ++;
                foreach ($val as $sub => $subs) {
                    $index = $index + $total;
                    $query = $query.' tb_attr_'.$index.'.attrid =  '.$subs.' OR ';
                    $json[] = array('attribute_relationship as tb_attr_'.$index, 'tb1.id = tb_attr_'.$index.'.moduleid AND tb_attr_'.$index.'.module ="product"', 'inner');
                }
                $query = substr( $query,  0, strlen($query) -3 );
                $query = $query.' ) ';
            }
            // $query = $query.' GROUP BY `tb_attr_102`.`moduleid`';
        }
        $json[] = array('catalogue_relationship as tb3', 'tb1.id = tb3.moduleid AND tb3.module = "product"', 'full');
        $json[] = array('promotional_relationship as tb2', 'tb1.id = tb2.moduleid AND tb2.module = "product"', 'left');

        $query = substr( $query,  4, strlen($query));

        $config['total_rows'] = $this->Autoload_Model->_get_where(array(
            'select' => 'tb1.id',
            'table' => 'product as tb1',
            'where' => array('tb1.publish' => 0,'tb1.alanguage' => $this->fc_lang),
            'keyword' => $keyword,
            'join' => $json,
            'query' => $query,
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
            $config['per_page'] = 20;
            $config['uri_segment'] = 2;
            $config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '';
			$config['full_tag_close'] = '';
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
                'select' => 'tb1.image_json,tb1.brandid, tb1.id, tb1.id as productid, tb1.title, tb1.canonical, tb1.price, tb1.price_sale, tb1.price_contact, tb1.image, tb1.order, tb1.thuonghieu, tb1.content',
                'table' => 'product as tb1',
                'where' => array('tb1.publish' => 0,'tb1.alanguage' => $this->fc_lang),
                'limit' => $config['per_page'],
                'start' => $page * $config['per_page'],
                'keyword' => $keyword,
                'join' => $json,
                'query' => $query,
                'order_by' => $order_by,
            ), true);

            /*
            $productList = getDetailListPrd(array('productList' => $productList));

            foreach ($productList as $key => $value) {
                $commnet = comment(array('id' => $value['productid'], 'module' => 'product'));
                $productList[$key]['rate'] = '';
                $productList[$key]['totalComment'] = '';
                if(isset($commnet) && is_array($commnet) && count($commnet)){
                    $productList[$key]['totalComment'] = round($commnet['statisticalRating']['totalComment']);
                    $productList[$key]['rate'] = round($commnet['statisticalRating']['averagePoint']);
                }
                $productList[$key]['info'] = getPriceFrontend(array('productDetail' => $value));
            }*/
	        $data['productList'] = $productList;
            $data['per_page'] = $config['per_page'];

        }




		// x???? li?? ????????ng d????n t????i sa??n ph????m
		$data['breadcrumb'] = $this->Autoload_Model->_get_where(array(
			'select' => 'id, title, slug, canonical, lft, rgt',
			'table' => 'product_catalogue',
			'where' => array('lft <=' => $detailCatalogue['lft'],'rgt >=' => $detailCatalogue['lft'],'alanguage' => $this->fc_lang),
            'limit' => 1,
			'order_by' => 'lft ASC, order ASC'
		), TRUE);


		$data['meta_title'] = (!empty($detailCatalogue['meta_title'])?$detailCatalogue['meta_title']:$detailCatalogue['title']).$seoPage;
		$data['meta_description'] = (!empty($detailCatalogue['meta_description'])?$detailCatalogue['meta_description']:cutnchar(strip_tags($detailCatalogue['description']), 255)).$seoPage;
		$data['meta_image'] = !empty($detailCatalogue['image'])?base_url($detailCatalogue['image']):'';
		if(!isset($data['canonical']) || empty($data['canonical'])){
			$data['canonical'] = $config['base_url'].$this->config->item('url_suffix');
		}

        // s???a l???i bi???n attrid c??
        //  v?? ????y l?? thu???c t??nh c???a c??? nh??m danh m???c con
        $temp = [];
        if(isset($attrList) && check_array($attrList)){
            foreach ($attrList as $key => $val) {
                $temp1 = json_decode($val, true);
                if(isset($temp1) && check_array($temp1)){
                    foreach ($temp1 as $sub => $subs) {
                        $temp[$sub] = (isset($temp[$sub])) ? array_merge($temp[$sub], $subs) : $subs;
                    }
                }
            }
        }
		$data['attribute'] = getListAttr( (check_array($temp)) ? json_encode($temp) : '');
		$data['detailCatalogue'] = $detailCatalogue;


        if(svl_ismobile() == 'is mobile'){
            $data['template'] = 'product/frontend/catalogue/mobile';
            $this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);
        }else{
            $data['template'] = 'product/frontend/catalogue/view';
            $this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);
        }



	}
    public function listCatalogue(){
        $page = (int)$this->input->get('page');
        $param['catalogueid'] = $this->input->get('catalogueid');
        $keyword = $this->db->escape_like_str($this->input->get('keyword'));

        $json = [];
        $data['from'] = 0;
        $data['to'] = 0;
        $perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : 20;
        $query = '';

        if (!empty($param['catalogueid'])) {
            $query = $query . ' AND tb3.catalogueid IN' . ' (' . $param['catalogueid'] . ') AND `tb1`.`alanguage` = \'' . $this->fclang . '\'';
        }


        $json[] = array('catalogue_relationship as tb3', 'tb1.id = tb3.moduleid AND tb3.module = "product"', 'full');
        $query = substr($query, 4, strlen($query));
        $config['total_rows'] = $this->Autoload_Model->_get_where(array(
            'select' => 'tb1.id',
            'table' => 'product as tb1',
            'keyword' => (!empty($keyword)) ? '(tb1.title LIKE \'%' . $keyword . '%\')' : '',
            'join' => $json,
            'query' => $query,
            'distinct' => 'true',
            'count' => TRUE,
        ));


        if ($config['total_rows'] > 0) {
            $this->load->library('pagination');
            $config['base_url'] = '#" data-page="';
            $config['suffix'] = $this->config->item('url_suffix') . (!empty($_SERVER['QUERY_STRING']) ? ('?' . $_SERVER['QUERY_STRING']) : '');
            $config['first_url'] = $config['base_url'] . $config['suffix'];
            $config['per_page'] = $perpage;
            $config['cur_page'] = $page;
            $config['page'] = $page;
            $config['uri_segment'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['full_tag_open'] = '<ul >';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $listPagination = $this->pagination->create_links();
            $totalPage = ceil($config['total_rows'] / $config['per_page']);
            $page = ($page <= 0) ? 1 : $page;
            $page = ($page > $totalPage) ? $totalPage : $page;
            $page = $page - 1;
            $data['from'] = ($page * $config['per_page']) + 1;
            $data['to'] = ($config['per_page'] * ($page + 1) > $config['total_rows']) ? $config['total_rows'] : $config['per_page'] * ($page + 1);
            $listproduct = $this->Autoload_Model->_get_where(array(
                'distinct' => 'true',
                'select' => 'tb1.image_json,tb1.id, tb1.id as productid, tb1.title, tb1.canonical, tb1.price, tb1.price_sale, tb1.price_contact, tb1.image',
                'table' => 'product as tb1',
                'limit' => $config['per_page'],
                'start' => $page * $config['per_page'],
                'keyword' => (!empty($keyword)) ? '(tb1.title LIKE \'%' . $keyword . '%\')' : '',
                'join' => $json,
                'query' => $query,
                'order_by' => 'tb1.id desc',
            ), true);

        }

        $html = '';

        if (isset($listproduct) && is_array($listproduct) && count($listproduct)) {
            $j =0 ;foreach ($listproduct as $key => $val) { $j++;

                $href = rewrite_url($val['canonical'], TRUE, TRUE);
                $getPrice = getPriceFrontend(array('productDetail' => $val));

                $html = $html . '<div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="item">
                            <div class="image">
                                <a href="'.$href.'"><img src="'.$val['image'].'" alt="'.$val['title'].'"></a>
                            </div>
                            <h3 class="title"><a href="'.$href.'">'.$val['title'].'</a></h3>
                            <p class="price"><del>'. $getPrice['price_old'].'</del> <span>'. $getPrice['price_final'].'</span></p>
                        </div>
                    </div>';

                if($j%4==0){$html = $html . '<div class="clearfix"></div>';}
            }
        } else {
            $html = $html . 'Kh??ng t??m th???y d??? li???u';
        }
        echo json_encode(array(
            'pagination' => (isset($listPagination)) ? $listPagination : '',
            'html' => (isset($html)) ? $html : '',
        ));
        die();
    }


}
