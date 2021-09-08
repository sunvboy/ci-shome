<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;
require APPPATH . '/libraries/REST_Controller.php';
class Product extends REST_Controller {
    public $module;
    function __construct() {
        parent::__construct();
        $this->fc_lang = $this->config->item('fc_lang');
    }
	public function view_get(){
        $slug = $this->input->get('slug');
        $publish_time = gmdate('Y-m-d H:i:s', time() + 7*3600);
        $product = [];
        //chi tiết sản phẩm
		$productDetail = $this->Autoload_Model->_get_where(array(
			'select' => 'id,title,description,viewed,image_json,price,price_sale,price_contact,catalogueid,brandid,content,meta_description,meta_title,image,canonical',
			'table' => 'product',
			'where' => array('publish_time <=' =>  $publish_time,'canonical' => $slug, 'publish' => 0,'alanguage' => $this->fc_lang),
		));
        if(!isset($productDetail) || is_array($productDetail) == false || count($productDetail) == 0){
            $message = [
                'status' => 500,
                'message' => 'Sản phẩm không tồn tại'
            ];
            $this->response($message, REST_Controller::HTTP_OK);
        }else{
            // câp nhât lươt xem tư nhiên
            updateView($productDetail['id'], $productDetail['viewed']);
            $comment = comment(array('id' => $productDetail['id'], 'module' => 'product'));
            $prd_rate = $totalComment = 0;
            if (isset($comment) && is_array($comment) && count($comment)) {
                $prd_rate = round($comment['statisticalRating']['averagePoint']);
                $totalComment = $comment['statisticalRating']['totalComment'];
            }
            $list_image = json_decode(base64_decode($productDetail['image_json']), TRUE);
            $detailCatalogue = $this->Autoload_Model->_get_where(array(
                'select' => 'id, title, canonical',
                'table' => 'product_catalogue',
                'where' => array('id' => $productDetail['catalogueid'],'alanguage' => $this->fc_lang),
            ));
            $detailBrand = $this->Autoload_Model->_get_where(array(
                'select' => 'id, title, canonical',
                'table' => 'product_brand',
                'where' => array('id' => $productDetail['brandid'],'alanguage' => $this->fc_lang),
            ));
            $relaList = $this->Autoload_Model->_get_where(array(
                'select' => 'id, title,canonical, image,  price,price_contact, price_sale',
                'table' => 'product',
                'limit' => 5,
                'order_by' => 'id desc',
                'where' => array( 'publish_time <=' =>  $publish_time,'publish' => 0,'catalogueid' => $detailCatalogue['id'],'id !=' => $productDetail['id'],'alanguage' => $this->fc_lang),
            ), true);
            $this->load->library('Authorization_Token');
            $is_valid_token = $this->authorization_token->validateToken();
            if (!empty($is_valid_token) AND $is_valid_token['status'] === TRUE){
                if(isset($relaList) && is_array($relaList) && count($relaList)){
                    foreach ($relaList as $k=>$v) {
                        $relaList[$k]['wishlist'] = $this->Autoload_Model->_get_where(array(
                            'select' => 'id',
                            'table' => 'customer_wishlist',
                            'where' => array('customerid' => $is_valid_token['data']->id, 'productid' => $v['id']),
                            'count' => TRUE
                        ));
                    }
                }
            }
            $product['id']  = $productDetail['id'];
            $product['title']  = $productDetail['title'];
            $product['canonical']  = $productDetail['canonical'];
            $product['image']  = $productDetail['image'];
            $product['description']  = $productDetail['description'];
            $product['content']  = $productDetail['content'];
            $product['meta_title']  = $productDetail['meta_title'];
            $product['meta_description']  = $productDetail['meta_description'];
            $product['price']  = $productDetail['price'];
            $product['price_contact']  = $productDetail['price_contact'];
            $product['price_sale']  = $productDetail['price_sale'];
            $product['totalComment']  = $totalComment;
            $product['prd_rate']  = $prd_rate;
            $product['list_image']  = !empty($list_image)?$list_image:'';
            $product['detailCatalogue']  = !empty($detailCatalogue)?$detailCatalogue:'';
            $product['detailBrand']  = !empty($detailBrand)?$detailBrand:'';
            $product['relaList']  = !empty($relaList)?$relaList:'';

            $message = [
                'status' => 200,
                'data' => $product,
                'message' => "Data Successful"
            ];
            $this->response($message, REST_Controller::HTTP_OK);
        }
	}
}

