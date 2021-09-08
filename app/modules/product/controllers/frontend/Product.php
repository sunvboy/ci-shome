<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	public $module;
	function __construct() {
		parent::__construct();
		$this->load->helper(array('myfrontendcommon'));
		$this->load->library('nestedsetbie', array('table' => 'product_catalogue'));
		$this->fc_lang = $this->config->item('fc_lang');
	}

	public function view($id = 0){
		$id = (int)$id;
        $publish_time = gmdate('Y-m-d H:i:s', time() + 7*3600);

        //chi tiết sản phẩm
		$productDetail = $this->Autoload_Model->_get_where(array(
			'select' => '*',
			'table' => 'product',
			'where' => array('publish_time <=' =>  $publish_time,'id' => $id, 'publish' => 0,'alanguage' => $this->fc_lang),
		));

        if(!isset($productDetail) || is_array($productDetail) == false || count($productDetail) == 0){
            $this->session->set_flashdata('message-danger', 'Sản phẩm không tồn tại');
            redirect(BASE_URL);
        }

		//lấy danh sách comment
		$temp = '';
		//khối mở rộng
		$extend_description = json_decode($productDetail['extend_description'], true);
		// print_r($extend_description);die;
		if(isset($extend_description) && is_array($extend_description) && count($extend_description)){
			foreach($extend_description as $key => $val){
				foreach($val as $keyChild => $valChild){
					if($key == 'title') $temp[$keyChild]['title'] = $valChild;
					else $temp[$keyChild]['desc'] = $valChild;
				}
			}
			krsort($extend_description['title']);
			krsort($extend_description['description']);
			$data['extend_description'] = $extend_description;
		}
		$data['prdExtendDesc'] = $temp;


		$productVersion = $this->Autoload_Model->_get_where(array(
			'select' => 'price_version',
			'table' => 'product_version',
			'where' => array('productid' => $id),
		));
		if(isset($productVersion) && check_array($productVersion)){
			$productDetail['price_version'] = $productVersion['price_version'];
		}

		$getDetailListPrd = getDetailListPrd(array('productList' => array(0 => $productDetail)));

		$productDetail = $getDetailListPrd[0];
		$productDetail['info'] = getPriceFrontend(array('productDetail' => $productDetail));
		//lấy danh sách tag
		$data['tag'] = $this->Autoload_Model->_get_where(array(
			'select' => 'tb1.id , tb1.title, tb1.canonical',
			'table' => 'tag as tb1',
			'join' => array(
				array('tag_relationship as tb2' , 'tb2.tagid = tb1.id', 'inner'),
			),
			'where' => array(
				'publish' => 0,
				'tb2.module' => 'product',
				'tb2.moduleid' => $id,
				'tb1.alanguage' => $this->fc_lang
			),
		), true);


		// xư li đương dân tơi san phâm
		$detailCatalogue = $this->Autoload_Model->_get_where(array(
			'select' => 'id, title, canonical, image, lft, rgt, description, article_json',
			'table' => 'product_catalogue',
			'where' => array('id' => $productDetail['catalogueid'],'alanguage' => $this->fc_lang),
		));

		$data['breadcrumb'] = $this->Autoload_Model->_get_where(array(
			'select' => 'id, title, slug, canonical, lft, rgt',
			'table' => 'product_catalogue',
			'where' => array('lft <=' => $detailCatalogue['lft'],'rgt >=' => $detailCatalogue['lft'],'alanguage' => $this->fc_lang),
			'limit' => 1,
			'order_by' => 'lft ASC, order ASC'
		), TRUE);

		// câp nhât lươt xem tư nhiên
		updateView($productDetail['id'], $productDetail['viewed']);


		//xư li khôi phiên ban, thuộc tính
		$getBlockAttr = getBlockAttr($productDetail);
		$data['attr'] = isset($getBlockAttr['attr']) ? $getBlockAttr['attr'] : '';
		$data['color'] = isset($getBlockAttr['color']) ? $getBlockAttr['color'] : '';
		$data['version'] = isset($getBlockAttr['version']) ? $getBlockAttr['version'] : '';

		// xư li khối bán buôn
		$data['product_wholesale'] = $this->Autoload_Model->_get_where(array(
			'select' => 'id, quantity_start, quantity_end, price_wholesale',
			'table' => 'product_wholesale',
			'where' => array('productid ' => $id),
		), TRUE);

		// lây ra thông tin chương trinh khuyên mại
		if(empty($productDetail['price_sale']) && empty($productDetail['price_contact'])){
			$promotion_relationship = $this->Autoload_Model->_get_where(array(
				'select' => 'id, title ,discount_value, discount_type, discount_moduleid, use_common, promotionalid, condition_type, condition_value, condition_type_1, condition_value_1, module, freeship, freeshipAll, cityid, start_date, end_date, (SELECT canonical FROM promotional WHERE promotional.id = promotional_relationship.promotionalid) as canonical',
				'table' => 'promotional_relationship',
				'where' => array('moduleid' => $productDetail['id'], 'module' => 'product'),
			), true);
			$block_promotional = array();
			if(isset($promotion_relationship) && is_array($promotion_relationship) && count($promotion_relationship)){
				foreach ($promotion_relationship as $key => $value) {
					$promotion = json_decode(getPromotional($value, 0), true);
					$detail_discount[$value['promotionalid']] = $promotion['detail'];
					$title[$value['promotionalid']] = $value['title'];
					$canonical[$value['promotionalid']] = $value['canonical'];
					$use_common[$value['promotionalid']] = $value['use_common'];
				}

				if(isset($use_common) && is_array($use_common) && count($use_common)){
					foreach ($use_common as $key => $value) {
						$block_promotional[$value][$key]['detail'] = isset($detail_discount[$key])? $detail_discount[$key] : '';
						$block_promotional[$value][$key]['canonical'] = $canonical[$key];
						$block_promotional[$value][$key]['title'] = $title[$key];
					};
				}
			}
			$data['block_promotional'] = $block_promotional;
		}
		$data['list_version'] = $this->Autoload_Model->_get_where(array(
			'select' => 'id, title, productid, attribute1, attribute2, price_version, image',
			'table' => 'product_version',
			'where' => array('productid ' => $id),
		), TRUE);

		$data['data_info'] = base64_encode(json_encode(array(
                'product_wholesale'=> (isset($data['product_wholesale']))? $data['product_wholesale']: '',
			'product_version'=> (isset($data['list_version']))? $data['list_version']: '',
			'promotional'=> (isset($promotion_relationship))? $promotion_relationship: '',
		)));
		// $data['relatedProduct'] = getListPrd(array('value' => $productDetail['catalogueid'], 'field' => 'catalogueid', 'select' => 'image, version_json'));
		// if(isset($data['relatedProduct']) && check_array($data['relatedProduct'])){
			// foreach ($data['relatedProduct'] as $key => $value) {
				// $getBlockAttr1 = getBlockAttr($value);
				// $data['relatedProduct'][$key]['attr'] = $getBlockAttr1['attr'];
				// $data['relatedProduct'][$key]['version'] = $getBlockAttr1['version'];
			// }
		// }

		//sản phẩm liên quan

        $relaList = $this->Autoload_Model->_get_where(array(
            'select' => 'id, title,canonical, image,  price,price_contact, price_sale',
            'table' => 'product',
            'limit' => 5,
            'order_by' => 'id desc',
            'where' => array( 'publish_time <=' =>  $publish_time,'publish' => 0,'catalogueid' => $detailCatalogue['id'],'id !=' => $id,'alanguage' => $this->fc_lang),
        ), true);

		$relaList = getDetailListPrd(array('productList' => $relaList));
		foreach ($relaList as $key => $value) {
	        $commnet = comment(array('id' => $id, 'module' => 'product'));
	         $relaList[$key]['rate'] = 0;
	        $relaList[$key]['totalComment'] = 0;
			if(isset($commnet) && is_array($commnet) && count($commnet)){
				$relaList[$key]['rate'] = round($commnet['statisticalRating']['averagePoint']);
				$relaList[$key]['totalComment'] = round($commnet['statisticalRating']['totalComment']);
			}
			$relaList[$key]['info'] = getPriceFrontend(array('productDetail' => $value));
		}
		$data['relaList'] = $relaList;
		//end sản phẩm liên quan
		$list_rela = json_decode($productDetail['prd_rela'], true);
		$care = $this->Autoload_Model->_get_where(array(
			'select' => 'id, id as productid, title,canonical, image, publish, order, price,	price_contact, price_sale, quantity_cuoi_ki, quantity_dau_ki, catalogue, (SELECT account FROM user WHERE user.id = product.userid_created) as user_created, version, viewed, catalogueid, (SELECT title FROM product_catalogue WHERE product_catalogue.id = product.catalogueid) as catalogue_title, viewed,description, image_json, (SELECT title FROM product_brand WHERE product_brand.id = product.brandid) as brand, (SELECT title FROM product_catalogue WHERE product_catalogue.id = product.catalogueid) as catalogue, code, version_json, unlimited_sale, image_color_json, model, made_in, video, extend_description, prd_rela',
			'table' => 'product',
			'where_in' => $list_rela,
			'limit' => 4,
			'where' => array( 'publish' => 0,'image !=' => '','alanguage' => $this->fc_lang),
		), true);
		$data['care'] = $care;

		$data['module'] = 'product';
		$data['moduleid'] = $productDetail['id'];
		$data['productDetail'] = $productDetail;
		$data['meta_title'] = !empty($productDetail['meta_title'])?$productDetail['meta_title']:$productDetail['title'];
		$data['meta_description'] = !empty($productDetail['meta_description'])?$productDetail['meta_description']:cutnchar(strip_tags($productDetail['description']), 320);
		$data['meta_image'] = !empty($productDetail['image'])?base_url($productDetail['image']):'';
		$data['detailCatalogue'] = $detailCatalogue;
		$data['canonical'] = rewrite_url($productDetail['canonical'], TRUE, TRUE);
		$data['og_type'] = 'product';
        $data['attroldISHOME'] = $this->Autoload_Model->_get_where(array(
            'select' => 'attribute.id ,attribute.title,attribute_catalogue.title as titleC',
            'table' => 'attribute_relationship',
            'join' => array(
                array('attribute', 'attribute.id = attribute_relationship.attrid', 'right'),
                array('attribute_catalogue', 'attribute.catalogueid = attribute_catalogue.id', 'right'),
            ),
            'where' => array(
                'attribute.publish' => 0,
                'attribute_relationship.module' => 'product',
                'attribute_catalogue.ishome' => 1,
                'attribute_relationship.moduleid' => $productDetail['id'],
            ),
        ), true);
        $data['getCatalogueAttr'] = [];
        if (is_array($data['list_version']) && count($data['list_version']) && isset($data['list_version'])) {
            $data['getCatalogueAttr'] = $this->Autoload_Model->_get_where(array(
                'select' => '(SELECT title FROM attribute_catalogue WHERE attribute_catalogue.id = attribute.catalogueid) as titleC',
                'table' => 'attribute',
                'where' => array('id' => $data['list_version'][0]['attribute1'])
            ));
        }

        if(svl_ismobile() == 'is mobile'){
            $data['template'] = 'product/frontend/product/dev/mobile';
        }else{
            $data['template'] = 'product/frontend/product/view';
        }

        $this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);

	}
    public function dev($id = 8){
        $id = (int)$id;
        $publish_time = gmdate('Y-m-d H:i:s', time() + 7*3600);

        //chi tiết sản phẩm
        $productDetail = $this->Autoload_Model->_get_where(array(
            'select' => '*',
            'table' => 'product',
            'where' => array('publish_time <=' =>  $publish_time,'id' => $id, 'publish' => 0,'alanguage' => $this->fc_lang),
        ));

        if(!isset($productDetail) || is_array($productDetail) == false || count($productDetail) == 0){
            $this->session->set_flashdata('message-danger', 'Sản phẩm không tồn tại');
            redirect(BASE_URL);
        }

        //lấy danh sách comment
        $temp = '';
        //khối mở rộng
        $extend_description = json_decode($productDetail['extend_description'], true);
        // print_r($extend_description);die;
        if(isset($extend_description) && is_array($extend_description) && count($extend_description)){
            foreach($extend_description as $key => $val){
                foreach($val as $keyChild => $valChild){
                    if($key == 'title') $temp[$keyChild]['title'] = $valChild;
                    else $temp[$keyChild]['desc'] = $valChild;
                }
            }
            krsort($extend_description['title']);
            krsort($extend_description['description']);
            $data['extend_description'] = $extend_description;
        }
        $data['prdExtendDesc'] = $temp;


        $productVersion = $this->Autoload_Model->_get_where(array(
            'select' => 'price_version',
            'table' => 'product_version',
            'where' => array('productid' => $id),
        ));
        if(isset($productVersion) && check_array($productVersion)){
            $productDetail['price_version'] = $productVersion['price_version'];
        }

        $getDetailListPrd = getDetailListPrd(array('productList' => array(0 => $productDetail)));

        $productDetail = $getDetailListPrd[0];
        $productDetail['info'] = getPriceFrontend(array('productDetail' => $productDetail));
        //lấy danh sách tag
        $data['tag'] = $this->Autoload_Model->_get_where(array(
            'select' => 'tb1.id , tb1.title, tb1.canonical',
            'table' => 'tag as tb1',
            'join' => array(
                array('tag_relationship as tb2' , 'tb2.tagid = tb1.id', 'inner'),
            ),
            'where' => array(
                'publish' => 0,
                'tb2.module' => 'product',
                'tb2.moduleid' => $id,
                'tb1.alanguage' => $this->fc_lang
            ),
        ), true);


        // xư li đương dân tơi san phâm
        $detailCatalogue = $this->Autoload_Model->_get_where(array(
            'select' => 'id, title, canonical, image, lft, rgt, description, article_json',
            'table' => 'product_catalogue',
            'where' => array('id' => $productDetail['catalogueid'],'alanguage' => $this->fc_lang),
        ));

        $data['breadcrumb'] = $this->Autoload_Model->_get_where(array(
            'select' => 'id, title, slug, canonical, lft, rgt',
            'table' => 'product_catalogue',
            'where' => array('lft <=' => $detailCatalogue['lft'],'rgt >=' => $detailCatalogue['lft'],'alanguage' => $this->fc_lang),
            'limit' => 1,
            'order_by' => 'lft ASC, order ASC'
        ), TRUE);

        // câp nhât lươt xem tư nhiên
        updateView($productDetail['id'], $productDetail['viewed']);


        //xư li khôi phiên ban, thuộc tính
        $getBlockAttr = getBlockAttr($productDetail);
        $data['attr'] = isset($getBlockAttr['attr']) ? $getBlockAttr['attr'] : '';
        $data['color'] = isset($getBlockAttr['color']) ? $getBlockAttr['color'] : '';
        $data['version'] = isset($getBlockAttr['version']) ? $getBlockAttr['version'] : '';

        // xư li khối bán buôn
        $data['product_wholesale'] = $this->Autoload_Model->_get_where(array(
            'select' => 'id, quantity_start, quantity_end, price_wholesale',
            'table' => 'product_wholesale',
            'where' => array('productid ' => $id),
        ), TRUE);

        // lây ra thông tin chương trinh khuyên mại
        if(empty($productDetail['price_sale']) && empty($productDetail['price_contact'])){
            $promotion_relationship = $this->Autoload_Model->_get_where(array(
                'select' => 'id, title ,discount_value, discount_type, discount_moduleid, use_common, promotionalid, condition_type, condition_value, condition_type_1, condition_value_1, module, freeship, freeshipAll, cityid, start_date, end_date, (SELECT canonical FROM promotional WHERE promotional.id = promotional_relationship.promotionalid) as canonical',
                'table' => 'promotional_relationship',
                'where' => array('moduleid' => $productDetail['id'], 'module' => 'product'),
            ), true);
            $block_promotional = '';
            if(isset($promotion_relationship) && is_array($promotion_relationship) && count($promotion_relationship)){
                foreach ($promotion_relationship as $key => $value) {
                    $promotion = json_decode(getPromotional($value, 0), true);
                    $detail_discount[$value['promotionalid']] = $promotion['detail'];
                    $title[$value['promotionalid']] = $value['title'];
                    $canonical[$value['promotionalid']] = $value['canonical'];
                    $use_common[$value['promotionalid']] = $value['use_common'];
                }

                if(isset($use_common) && is_array($use_common) && count($use_common)){
                    foreach ($use_common as $key => $value) {
                        $block_promotional[$value][$key]['detail'] = $detail_discount[$key];
                        $block_promotional[$value][$key]['canonical'] = $canonical[$key];
                        $block_promotional[$value][$key]['title'] = $title[$key];
                    };
                }
            }
            $data['block_promotional'] = $block_promotional;
        }
        $data['list_version'] = $this->Autoload_Model->_get_where(array(
            'select' => 'id, title, productid, attribute1, attribute2, price_version, image',
            'table' => 'product_version',
            'where' => array('productid ' => $id),
        ), TRUE);

        $data['data_info'] = base64_encode(json_encode(array(
            'product_wholesale'=> (isset($data['product_wholesale']))? $data['product_wholesale']: '',
            'product_version'=> (isset($data['list_version']))? $data['list_version']: '',
            'promotional'=> (isset($promotion_relationship))? $promotion_relationship: '',
        )));
        // $data['relatedProduct'] = getListPrd(array('value' => $productDetail['catalogueid'], 'field' => 'catalogueid', 'select' => 'image, version_json'));
        // if(isset($data['relatedProduct']) && check_array($data['relatedProduct'])){
        // foreach ($data['relatedProduct'] as $key => $value) {
        // $getBlockAttr1 = getBlockAttr($value);
        // $data['relatedProduct'][$key]['attr'] = $getBlockAttr1['attr'];
        // $data['relatedProduct'][$key]['version'] = $getBlockAttr1['version'];
        // }
        // }

        //sản phẩm liên quan

        $relaList = $this->Autoload_Model->_get_where(array(
            'select' => 'id, title,canonical, image,  price,price_contact, price_sale',
            'table' => 'product',
            'limit' => 5,
            'order_by' => 'id desc',
            'where' => array( 'publish_time <=' =>  $publish_time,'publish' => 0,'catalogueid' => $detailCatalogue['id'],'id !=' => $id,'alanguage' => $this->fc_lang),
        ), true);

        $relaList = getDetailListPrd(array('productList' => $relaList));
        foreach ($relaList as $key => $value) {
            $commnet = comment(array('id' => $id, 'module' => 'product'));
            $relaList[$key]['rate'] = 0;
            $relaList[$key]['totalComment'] = 0;
            if(isset($commnet) && is_array($commnet) && count($commnet)){
                $relaList[$key]['rate'] = round($commnet['statisticalRating']['averagePoint']);
                $relaList[$key]['totalComment'] = round($commnet['statisticalRating']['totalComment']);
            }
            $relaList[$key]['info'] = getPriceFrontend(array('productDetail' => $value));
        }
        $data['relaList'] = $relaList;
        //end sản phẩm liên quan
        $list_rela = json_decode($productDetail['prd_rela'], true);
        $care = $this->Autoload_Model->_get_where(array(
            'select' => 'id, id as productid, title,canonical, image, publish, order, price,	price_contact, price_sale, quantity_cuoi_ki, quantity_dau_ki, catalogue, (SELECT account FROM user WHERE user.id = product.userid_created) as user_created, version, viewed, catalogueid, (SELECT title FROM product_catalogue WHERE product_catalogue.id = product.catalogueid) as catalogue_title, viewed,description, image_json, (SELECT title FROM product_brand WHERE product_brand.id = product.brandid) as brand, (SELECT title FROM product_catalogue WHERE product_catalogue.id = product.catalogueid) as catalogue, code, version_json, unlimited_sale, image_color_json, model, made_in, video, extend_description, prd_rela',
            'table' => 'product',
            'where_in' => $list_rela,
            'limit' => 4,
            'where' => array( 'publish' => 0,'image !=' => '','alanguage' => $this->fc_lang),
        ), true);
        $data['care'] = $care;

        $data['module'] = 'product';
        $data['moduleid'] = $productDetail['id'];
        $data['productDetail'] = $productDetail;
        $data['meta_title'] = !empty($productDetail['meta_title'])?$productDetail['meta_title']:$productDetail['title'];
        $data['meta_description'] = !empty($productDetail['meta_description'])?$productDetail['meta_description']:cutnchar(strip_tags($productDetail['description']), 320);
        $data['meta_image'] = !empty($productDetail['image'])?base_url($productDetail['image']):'';
        $data['detailCatalogue'] = $detailCatalogue;
        $data['canonical'] = rewrite_url($productDetail['canonical'], TRUE, TRUE);
        $data['og_type'] = 'product';
        $data['attroldISHOME'] = $this->Autoload_Model->_get_where(array(
            'select' => 'attribute.id ,attribute.title,attribute_catalogue.title as titleC',
            'table' => 'attribute_relationship',
            'join' => array(
                array('attribute', 'attribute.id = attribute_relationship.attrid', 'right'),
                array('attribute_catalogue', 'attribute.catalogueid = attribute_catalogue.id', 'right'),
            ),
            'where' => array(
                'attribute.publish' => 0,
                'attribute_relationship.module' => 'product',
                'attribute_catalogue.ishome' => 1,
                'attribute_relationship.moduleid' => $productDetail['id'],
            ),
        ), true);
        $data['getCatalogueAttr'] = [];
        if (is_array($data['list_version']) && count($data['list_version']) && isset($data['list_version'])) {
            $data['getCatalogueAttr'] = $this->Autoload_Model->_get_where(array(
                'select' => '(SELECT title FROM attribute_catalogue WHERE attribute_catalogue.id = attribute.catalogueid) as titleC',
                'table' => 'attribute',
                'where' => array('id' => $data['list_version'][0]['attribute1'])
            ));
        }

        if(svl_ismobile() == 'is mobile'){
            $data['template'] = 'product/frontend/product/dev/mobile';
        }else{
            $data['template'] = 'product/frontend/product/dev/pc';
        }

        $this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);

    }

}
