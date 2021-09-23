<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;
require APPPATH . '/libraries/REST_Controller.php';
class Catalogue extends REST_Controller {


	public $module;
	function __construct() {
		parent::__construct();
		$this->load->library(array('configbie'));
		$this->load->helper(array('myfrontendcommon'));
		$this->load->library('nestedsetbie', array('table' => 'product_catalogue'));
        $this->fc_lang = $this->config->item('fc_lang');
	}
	public function view_get(){
        $this->load->library('Authorization_Token');
        $is_valid_token = $this->authorization_token->validateToken();

        $isAttr = (int)$this->input->get('isAttr');
        $catalogueid = (int)$this->input->get('id');
        $canonical = $this->input->get('slug');
        $page =  ($this->input->get('page')) ? $this->input->get('page') : 1;
        $perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : 20;
        $brand = ($this->input->get('brand')) ? $this->input->get('brand') : '';
        $keyword = $this->db->escape_like_str($this->input->get('keyword'));
        $attr = !empty($this->input->get('attr')) ? $this->input->get('attr') : '';
        $sort = !empty($this->input->get('sort')) ? $this->input->get('sort') : '';
        if(!empty($catalogueid)){
            $detailCatalogue = $this->Autoload_Model->_get_where(array(
                'select' => 'id, title, level, lft, rgt, parentid, brand_json, image_json, attrid, canonical,description,meta_title,meta_description',
                'table' => 'product_catalogue',
                'where' => array('alanguage' => $this->fc_lang),
                'query' => 'id = '.$catalogueid,
            ));
        }
        if(!empty($canonical)){
            $detailCatalogue = $this->Autoload_Model->_get_where(array(
                'select' => 'id, title, level, lft, rgt, parentid, brand_json, image_json, attrid, canonical,description,meta_title,meta_description',
                'table' => 'product_catalogue',
                'where' => array('alanguage' => $this->fc_lang),
                'query' => '`canonical` = \'' . $canonical . '\'',
            ));
        }

		if(!isset($detailCatalogue) || is_array($detailCatalogue) == false || count($detailCatalogue) == 0){
            $message = [
                'status' => 500,
                'message' => 'Danh mục sản phẩm không tồn tại'
            ];
            $this->response($message, REST_Controller::HTTP_OK);
		}else{
            $product = $this->Autoload_Model->_get_where(array(
                'select' => 'MAX(tb1.price) as max_price, MIN(tb1.price) as min_price',
                'table' => 'product as tb1',
                'where' => array('tb1.publish' => 0,'tb1.alanguage' => $this->fc_lang),
                'join' => array(array('catalogue_relationship as tb3', 'tb1.id = tb3.moduleid AND tb3.module = "product"', 'inner')),
                'query' => 'tb3.catalogueid = '.$detailCatalogue['id'],
                'distinct' => 'true',
            ));
            $data['min_price'] = ($product['min_price'] != '') ? $product['min_price'] : 0;
            $data['max_price'] = ($product['max_price'] != '') ? $product['max_price'] : 0;
            $json = [];
            $data['from'] = 0;
            $data['to'] = 0;
            $param['min_price'] = ($this->input->get('min_price')) ? $this->input->get('min_price') : $data['min_price'];
            $param['max_price'] = ($this->input->get('max_price')) ? $this->input->get('max_price') : $data['max_price'];
            $data['post_min_price'] = $param['min_price'];
            $data['post_max_price'] = $param['max_price'];
            $query = '';
            $order_by = 'tb1.order asc,tb1.id desc';
            if(!empty($sort) ){
                $sort = explode('|', $sort);
                $order_by =  'tb1.'.$sort[0].' '.$sort[1];
            }

            if(!empty($detailCatalogue['id'])){
                $temp = $this->Autoload_Model->_get_where(array(
                    'select' => 'id, attrid',
                    'table' => 'product_catalogue',
                    'query' => 'lft >= '.$detailCatalogue['lft'].' AND '.'rgt <= '.$detailCatalogue['rgt'],
                ), true);

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
            if(!empty($brand)){
                $query = $query.' AND tb1.brandid =  '.$brand;
            }
            // xử lí điều kiện lọc thuộc tính
            if(!empty($attr)){
                $attribute = [];
                $attr = explode(';',$attr) ;
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
                $config['per_page'] = $perpage;
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
                if($page >= 2){
                    $data['canonical'] = $config['base_url'].'/trang-'.$page.$this->config->item('url_suffix');
                }
                $page = $page - 1;
                $data['from'] = ($page * $config['per_page']) + 1;
                $data['to'] = ($config['per_page']*($page+1) > $config['total_rows']) ? $config['total_rows']  : $config['per_page']*($page+1);
                $productList = $this->Autoload_Model->_get_where(array(
                    'distinct' => 'true',
                    'select' => 'tb1.id, tb1.id as productid, tb1.title, tb1.canonical, tb1.price, tb1.price_sale, tb1.price_contact, tb1.image, tb1.image_json, tb1.description, tb1.brandid',
                    'table' => 'product as tb1',
                    'where' => array('tb1.publish' => 0,'tb1.alanguage' => $this->fc_lang),
                    'limit' => $config['per_page'],
                    'start' => $page * $config['per_page'],
                    'keyword' => $keyword,
                    'join' => $json,
                    'query' => $query,
                    'order_by' => $order_by,
                ), true);
                if(!empty($isAttr)){
                    $attribute_catalogue = getListAttr($detailCatalogue['attrid']);
                }
                if(isset($productList) && is_array($productList) && count($productList)){
                    foreach ($productList as $k=>$v){
                        $productList[$k]['list_image'] = json_decode(base64_decode($v['image_json']), TRUE);
                        if(!empty($_GET['isbrand'])){
                            $productList[$k]['detailBrand'] = $this->Autoload_Model->_get_where(array(
                                'select' => 'id, title, canonical',
                                'table' => 'product_brand',
                                'where' => array('id' => $v['brandid'],'alanguage' => $this->fc_lang),
                            ));

                        }
                        if(!empty($_GET['isCmt'])){
                            $comment = comment(array('id' => $v['id'], 'module' => 'product'));
                            $totalComment = 0;
                            if (isset($comment) && is_array($comment) && count($comment)) {
                                $productList[$k]['totalComment'] = $comment['statisticalRating']['totalComment'];
                            }

                        }
                        if (!empty($is_valid_token) AND $is_valid_token['status'] === TRUE){
                            $productList[$k]['wishlist'] = $this->Autoload_Model->_get_where(array(
                                'select' => 'id',
                                'table' => 'customer_wishlist',
                                'where' => array('customerid' => $is_valid_token['data']->id,'productid' =>$v['id']),
                                'count' => TRUE
                            ));

                        }
                    }
                }

                $message = [
                    'status' => 200,
                    'totalRow' => !empty($config['total_rows'])?$config['total_rows']:0,
                    'totalPage' => $totalPage,
                    'data' => !empty($productList) ? $productList : '',
                    'category' => !empty($detailCatalogue) ? $detailCatalogue : '',
                    'attribute_catalogue' => !empty($attribute_catalogue) ? $attribute_catalogue : '',
                    'message' => "Data Successful"
                ];
                $this->response($message, REST_Controller::HTTP_OK);
            }else{
                $message = [
                    'status' => 200,
                    'totalRow' => 0,
                    'totalPage' => 0,
                    'data' => '',
                    'category' => !empty($detailCatalogue) ? $detailCatalogue : '',
                    'message' => "Data Successful"
                ];
                $this->response($message, REST_Controller::HTTP_OK);
            }
        }

	}



}
