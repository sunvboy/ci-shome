<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends MY_Controller {
	public $module;
	function __construct() {
		parent::__construct();
		$this->load->library(array('configbie'));
		$this->load->helper(array('myfrontendcommon'));
		$this->module = array(
			'article' => 'Bài viết',
			'product' => 'Sản phẩm',
			'media' => 'Thư viện',	
		);
		$this->fc_lang = $this->config->item('fc_lang');
	}
    public function viewNangCao($page = 1){
        $seoPage = '';
        $page = (int)$page;
        $listArray = '';
        if(!empty($_GET['docan'])){
            $listArray = $listArray. $_GET['docan'];
        }
        if(!empty($_GET['mausac'])){
            $listArray = $listArray. $_GET['mausac'];
        }
        if(!empty($_GET['dogian'])){
            $listArray = $listArray. $_GET['dogian'];
        }
        if(!empty($_GET['dactinhsanpham'])){
            $listArray = $listArray. $_GET['dactinhsanpham'];
        }

        $param['attr'] = ($listArray) ? $listArray : '';
        $query = '';
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

        $query = substr( $query,  4, strlen($query));

        $config['total_rows'] = $this->Autoload_Model->_get_where(array(
            'select' => 'tb1.id',
            'table' => 'product as tb1',
            'where' => array('tb1.publish' => 0,'tb1.alanguage' => $this->fc_lang),
            'join' => $json,
            'query' => $query,
            'distinct' => 'true',
            'count' =>TRUE,
        ));
        $data['total_rows'] = $config['total_rows'];
        $config['base_url'] = base_url('tim-kiem-nang-cao');
        if($config['total_rows'] > 0){
            $this->load->library('pagination');
            $config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
            $config['prefix'] = 'trang-';
            $config['first_url'] = $config['base_url'].$config['suffix'];
            $config['per_page'] = 40;
            $config['uri_segment'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['full_tag_open'] = '<ul><li>';
            $config['full_tag_close'] = '</li></ul>';
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
            $page = ($page <= 0)?1:$page;
            $page = ($page > $totalPage)?$totalPage:$page;
            $seoPage = ($page >= 2)?(' - Trang '.$page):'';
            if($page >= 2){
                $data['canonical'] = $config['base_url'].'/trang-'.$page.$this->config->item('url_suffix');
            }
            $page = $page - 1;
            $data['productList'] = $this->Autoload_Model->_get_where(array(
                'distinct' => 'true',
                'select' => 'tb1.image_json,tb1.id, tb1.id as productid, tb1.title, tb1.canonical, tb1.price, tb1.price_sale, tb1.price_contact, tb1.image, tb1.order',
                'table' => 'product as tb1',
                'where' => array('tb1.publish' => 0,'tb1.image !=' => '','tb1.alanguage' => $this->fc_lang),
                'limit' => $config['per_page'],
                'start' => $page * $config['per_page'],
                'join' => $json,
                'query' => $query,
                'order_by' => 'tb1.order asc,tb1.id desc',
            ), true);
        }


        $data['meta_title'] = 'Kết quả tìm kiếm ';

        if(svl_ismobile() == 'is mobile'){
            $data['template'] = 'search/frontend/search/searchNangCao_mobile';
            $this->load->view('homepage/mobile/layout/home', isset($data)?$data:NULL);
        }else{
            $data['template'] = 'search/frontend/search/searchNangCao';
            $this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);
        }


    }
	public function view($page = 1){
		$seoPage = '';
		$page = (int)$page;
		$keyword = $this->db->escape_like_str($this->input->get('keyword'));
        $param['catalogueid'] = $this->input->get('catalogueid');
        $query = '';
        if(!empty($param['catalogueid'])){
            $query = $query.'  tb3.catalogueid IN'.' ('.$param['catalogueid'].')';
        }

		$json = [];
        $json[] = array('catalogue_relationship as tb3', 'tb1.id = tb3.moduleid AND tb3.module = "product"', 'full');
		$module = 'product';
		if(!empty($module)){
			$config['total_rows'] = $this->Autoload_Model->_get_where(array(
				'distinct' => 'true',
				'select' => 'tb1.title',
				'table' =>'product as tb1',
				'join' => $json,
                'query' => $query,
				'keyword' => '(tb1.title LIKE \'%'.$keyword.'%\'  AND `tb1`.`publish` = 0  AND  `tb1`.`alanguage` = \''.$this->fc_lang.'\') ',
				'count'=>true,
			));
			$data['total_rows'] = $config['total_rows'];
			$config['base_url'] = base_url('tim-kiem');
			if($config['total_rows'] > 0){
				$this->load->library('pagination');
				$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
				$config['prefix'] = 'trang-';
				$config['first_url'] = $config['base_url'].$config['suffix'];
				$config['per_page'] = ($module == 'product') ? 30: 30;
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
				$page = ($page <= 0)?1:$page;
				$page = ($page > $totalPage)?$totalPage:$page;
				$seoPage = ($page >= 2)?(' - Trang '.$page):'';
				if($page >= 2){
					$data['canonical'] = $config['base_url'].'/trang-'.$page.$this->config->item('url_suffix');
				}
				$page = $page - 1;
				$data['productList'] = $this->Autoload_Model->_get_where(array(
					'distinct' => 'true',
                    'select' => 'tb1.image_json,tb1.id, tb1.id as productid, tb1.title, tb1.canonical, tb1.price, tb1.price_sale, tb1.price_contact, tb1.image, tb1.order',
                   //'select' => 'tb1.id, tb1.title, tb1.canonical,tb1.image, tb1.description, tb1.order',
					'table' => 'product as tb1',
					'limit' => $config['per_page'],
					'start' => $page * $config['per_page'],
					'keyword' => '(tb1.title LIKE \'%'.$keyword.'%\'  AND `tb1`.`publish` = 0  AND  `tb1`.`alanguage` = \''.$this->fc_lang.'\') ',
					'join' => $json,
                    'query' => $query,
                    'order_by' => 'tb1.order asc, tb1.id desc',
				), true);
			}
			$data['module'] = $module;
		}else{
			$temp = '';
			foreach($this->module as $key => $val){
				$temp[] = array(
					'result' => array(
						'module' => $key,
						'title' => $val,
						'data' => $this->Autoload_Model->_get_where(array(
							'select' => 'tb1.id, tb1.title, tb1.slug, tb1.canonical, tb1.image, tb1.created, tb1.description, tb1.viewed, '.(($key == 'product') ? 'tb1.price, tb1.price_sale, tb1.quantity_dau_ki, tb1.quantity_cuoi_ki' : '').'',
							'table' => $key.' as tb1',
							'query' => '(id IN (SELECT moduleid FROM tag_relationship WHERE module = \''.$key.'\' AND tagid = '.$tagid.'))',
							'where' => array('publish' => 0),
							'limit' => 5,
							'order_by' => 'tb1.id desc, tb1.order asc',
						),TRUE)
					)
				);
			}
			$data['objectTag'] = $temp;
		}
		if(!isset($data['canonical']) || empty($data['canonical'])){
			$data['canonical'] = $config['base_url'].$this->config->item('url_suffix');
		}
		$data['meta_title'] = 'Kết quả tìm kiếm cho từ khóa: '.$this->input->get('keyword').''.$seoPage;
		$data['meta_image'] = !empty($detailTag['image'])?base_url($detailTag['image']):'';

        /*if(svl_ismobile() == 'is mobile'){
            $data['template'] = 'search/frontend/search/view_mobile';
            $this->load->view('homepage/mobile/layout/home', isset($data)?$data:NULL);
        }else{

        }*/
        $data['template'] = 'search/frontend/search/view';
        $this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);

	}
	public function searchFilter($page = 1){
		$seoPage = '';
		$page = (int)$page;
        $param['catalogueid'] = $this->input->get('catalogueid');
        $param['productAreaID'] = $this->input->get('productAreaID');
        $param['code'] = $this->input->get('code');
        $param['attr'] = $this->input->get('attr');
        $query = '';

        //điều kiện lọc danh mục
        if(!empty($param['catalogueid'])){
            $query = $query.'AND tb1.publish = 0 AND tb3.catalogueid IN'.' ('.$param['catalogueid'].')';
        }
        //end
        //điều kiện lọc place
        if(!empty($param['productAreaID'])){
            $query = $query.' AND tb1.productAreaID = '.$param['productAreaID'].'';
        }
        //end
        //điều kiện giá
        $param['start_price'] = (int)str_replace('.','',$this->input->get('minPrice'));
        $param['end_price'] = (int)str_replace('.','',$this->input->get('maxPrice'));
        if(isset($param['start_price']) && !empty($param['end_price'])){
            $query = $query.' AND tb1.price >= '.$param['start_price'].' AND tb1.price <= '.$param['end_price'].' ';
        }
        //end
        //điều kiện lọc code
        if(!empty($param['code'])){
            $query = $query.' AND tb1.code = \''.$param['code'].'\'';
        }
        //end


        // xử lí điều kiện lọc thuôc tinh
        if(!empty($param['attr'])){
            $attr = explode('-', $this->input->get('attr'));

            foreach ($attr as $key => $val) {
                $attribute[$val][] = $attr[$key];
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
                    $query = $query.' tb'.$index.'.attrid =  '.$subs.' OR ';
                    $json[] = array('attribute_relationship as tb'.$index, 'tb1.id = tb'.$index.'.moduleid AND tb'.$index.'.module ="room"', 'inner');
                }
                $query = substr( $query,  0, strlen($query) -3 );
                $query = $query.' ) ';
            }
            $query = $query.' GROUP BY `tb102`.`moduleid`';
        }
        //end
        $json[] = array('catalogue_relationship as tb3', 'tb1.id = tb3.moduleid AND tb3.module = "product"', 'full');
        $query = substr( $query,  4, strlen($query));
        $config['total_rows'] = $this->Autoload_Model->_get_where(array(
            'select' => 'tb1.id',
            'table' => 'product as tb1',
            'join' => $json,
            'query' => $query,
            'distinct' => 'true',
            'count' =>TRUE,
        ));
        if($config['total_rows'] > 0){
            $this->load->library('pagination');
            $config['base_url'] ='#" data-page="';
            $config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
            $config['first_url'] = $config['base_url'].$config['suffix'];
            $config['per_page'] = 30;
            $config['uri_segment'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['full_tag_open'] = '<div class="pagenavi"><ul><li>';
            $config['full_tag_close'] = '</li></ul></div>';
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
            $listPagination = $this->pagination->create_links();
            $totalPage = ceil($config['total_rows']/$config['per_page']);
            $page = ($page <= 0)?1:$page;
            $page = ($page > $totalPage)?$totalPage:$page;
            $page = $page - 1;
            $data['from'] = ($page * $config['per_page']) + 1;
            $data['to'] = ($config['per_page']*($page+1) > $config['total_rows']) ? $config['total_rows']  : $config['per_page']*($page+1);
            $data['productList'] = $this->Autoload_Model->_get_where(array(
                'distinct' => 'true',
                'select' =>'tb1.image, tb1.description, tb1.title, tb1.price, tb1.price_sale,tb1.id, tb1.canonical, tb1.supportID, tb1.productAreaID, tb1.donvi',
                'table' => 'product as tb1',
                'limit' => $config['per_page'],
                'start' => $page * $config['per_page'],
                'join' => $json,
                'query' => $query,
                'order_by' => 'tb1.order asc, tb1.id desc',
            ),true);
        }
		$data['meta_title'] = 'Kết quả tìm kiếm cho từ khóa: '.$this->input->get('keyword').''.$seoPage;
		$data['meta_image'] = !empty($detailTag['image'])?base_url($detailTag['image']):'';
		$data['template'] = 'search/frontend/search/searchFilter';
		$this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);
	}
	
}

