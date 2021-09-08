<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->helper(array('myfrontendcart'));

    }
    public function render_ship(){
        $cityid = $this->input->post('cityid');
        $districtid = $this->input->post('districtid');
        $shipVal = render_ship(array(
            'cityid' => $cityid,
            'districtid' => $districtid,
        ));
        echo $shipVal;die;
    }


    public function render_discount_ship(){
        $this->load->helper(array('myfrontendcart'));
        $data= renderDataProductInCart();
        $qty = $data['cart']['total_quantity'];
        $total_cart = $data['cart']['total_cart'];
        $cityid = $this->input->post('cityid');
        $districtid = $this->input->post('districtid');
        // laasy danh sachs id sản phẩm
        $listId = [];
        if(isset($data) && check_array($data)){
            foreach ($data['list_product'] as $key => $val) {
                $listId[] = $val['option']['id'];
            }
        }
        $discount_value = render_discount_ship(array(
            'listId' => $listId,
            'cityid' => $cityid,
            'districtid' => $districtid,
            'qty' => $qty,
        ));
        echo $discount_value;die;
    }
    public function wishlistadd(){
        $id = $this->input->post('id');
        $customerid = $this->input->post('customerid');
        $productCustomer = $this->Autoload_Model->_get_where(array(
            'select' => 'id',
            'table' => 'customer',
            'where' => array('id' => $customerid),
        ));
        if(!isset($productCustomer) || is_array($productCustomer) == false || count($productCustomer) == 0){
            $result = 0;
            $success = 0;
            $error = 'Thành viên không tồn tại';
        }
        $check = $this->Autoload_Model->_get_where(array(
            'select' => 'id',
            'table' => 'customer_wishlist',
            'where' => array('customerid' => $customerid,'productid' => $id),
        ));
        if(!isset($check) || is_array($check) == false || count($check) == 0){
            $_insert = array(
                'customerid' => $customerid,
                'productid' => $id,
                'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
            );
            $insertId = $this->Autoload_Model->_create(array(
                'table' => 'customer_wishlist',
                'data' => $_insert,
            ));
            if($insertId > 0){
                $result = 1;
                $success = 'Đã thêm sản phẩm vào mục sản phẩm yêu thích';
                $error = '';
            }
        }else{
            $result = 0;
            $success = '';
            $error = 'Đã tồn tại sản phẩm mục sản phẩm yêu thích';
        }
        echo json_encode(array(

            'result' => $result,
            'success' => $success,
            'error' => $error,
        ));die();
    }
    public function delele_wishlistadd(){
        $id = $this->input->post('id');
        $customerid = $this->input->post('customerid');
        $this->Autoload_Model->_delete(array(
            'where' => array('customerid' => $customerid,'productid' => $id),
            'table' => 'customer_wishlist',
        ));
        echo json_encode(array(
            'result' => 1,
            'success' => 'Xóa thành công',
            'error' => 0,
        ));die();
    }
    public function addCartFunction(){

        $this->load->library("cart");
        $id = $this->input->post('id');
        $quantity = $this->input->post('quantity');
        $attr = $this->input->post('mattrai');
        $productDetail = $this->Autoload_Model->_get_where(array(
            'select' => 'id,title,price,price_contact, price_sale,price_contact,price_input',
            'table' => 'product',
            'where' => array('id' => $id, 'publish' => 0),
        ));
        $attributeDetail = $this->Autoload_Model->_get_where(array(
            'select' => 'title,id',
            'table' => 'attribute',
            'where' => array('id' => $attr, 'publish' => 0),
        ));
        $price_final = 0;
        if($productDetail['price'] > 0 && $productDetail['price_sale'] == 0){
            $price_final = $productDetail['price'];
        }
        if($productDetail['price'] > 0 && $productDetail['price_sale'] > 0 ){
            $price_final = $productDetail['price_sale'];
        }
        $data = array(
            //"id" => 'SKU-prd-'.$productDetail['id'].'-attrids-',
            "id" => $productDetail['id'],
            "name" => trim($productDetail['title']),
            "qty" => $quantity,
            "price" => $price_final,
            "giagoc" => $productDetail['price_input'],
            "attrID" => !empty($attributeDetail)?$attributeDetail['id']:'',
            "option" => array(
                "id" => $productDetail['id'],
                "attrids" => $this->input->post('attrids'),
                "content" => '',
                "promotionalid" => ''
            ),
            "options" => array(
                "mattrai" => !empty($attributeDetail)?$attributeDetail['title']:'',
                "matphai" => !empty($this->input->post('matphai'))?$this->input->post('matphai'):'',
                "color" =>  !empty($this->input->post('color'))?$this->input->post('color'):'',
            ),
        );
        // Them san pham vao gio hang
        if($this->cart->insert($data)){
            $result = "true";
        }else{
            $result = "false";
        }


        /* $this->load->library("cart");
        $cart=$this->cart->contents();
        echo "<pre>";var_dump($cart);die;*/
        /*
        $html_header_cart = '';
        $datacart = renderDataProductInCart(array('coupon' => true));
        if(isset($datacart['list_product']) && is_array($datacart['list_product']) && count($datacart['list_product'])){
            foreach($datacart['list_product'] as $key => $val){
                $info = getPriceFrontend(array('productDetail' => $val['detail']));
                $image = getthumb((isset($val['version']['image']) && $val['version']['image'] != '' && $val['version']['image'] != 'template/not-found.png') ? $val['version']['image'] : $val['detail']['image']);
                $title =  $val['detail']['title'].' '.((isset($val['version']['title'])) ? $val['version']['title'] : '');
                $href = rewrite_url($val['detail']['canonical']);
                $html_header_cart = $html_header_cart.'<li class="js_data_prd" data-rowid="'.$val['rowid'].'" data-quantity="'.$val['qty'].'">
                                        <table class="table table-striped">
                                            <tbody>



                                            <tr>
                                                <td class="text-center" style="width:70px">
                                                    <a href="'.$href.'">
                                                        <img src="'.$image.'" style="width:70px" alt="'.$title.'" title="'.$title.'" class="preview">
                                                    </a>
                                                </td>
                                                <td class="text-left"> <a class="cart_product_name" href="'.$href.'">'.$title.'</a>
                                                </td>
                                                <td class="text-center">x'.$val['qty'].'</td>
                                                <td class="text-center">'. $info['price_final'].'</td>

                                                <td class="text-right">
                                                    <a class="fa fa-times fa-delete js_del_prd" ></a>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </li>';
            }
        }*/


        echo json_encode(array(
            //'html_header_cart' => $html_header_cart,
            'total_cart' => $this->cart->total_items(),
            //'total' => number_format($this->cart->total()),
            'result' => $result,
        ));die();
    }
	public function addCart(){

        $this->load->library("cart");
		$post = $this->input->post();
		$post['attrids'] = str_replace(';','-',$post['attrids']);
		$post['promotionalid'] = str_replace(',','-',$post['promotionalid']);
		$data = array(
            "id" => $post['id'],
            "name" => cutnchar($post['name'], 15),
            "qty" => (!isset($post['quantity'])) ? 1 : $post['quantity'],
            "price" => (!isset($post['price'])) ? 0 : $post['price'],
            "option" => array(
                "id" => $post['id'],
                "attrids" => $post['attrids'],
                "content" => $post['content'],
                "promotionalid" => $post['promotionalid']
            ),
            "options" => array(
                "attr" => $post['option'],

            )
        );
		//echo "<pre>";var_dump($data);die;

        // Them san pham vao gio hang
        if($this->cart->insert($data)){
            $result = "true";
        }else{
            $result = "false";
        }
        $html_header_cart = '';
        $datacart = renderDataProductInCart(array('coupon' => true));
        //echo "<pre>";var_dump($datacart);die;
        if(isset($datacart['list_product']) && is_array($datacart['list_product']) && count($datacart['list_product'])){
            foreach($datacart['list_product'] as $key => $val){
                $html_header_cart = $html_header_cart.htmlItemCart($val);
            }
        }
        echo json_encode(array(
            'html_header_cart' => $html_header_cart,
            'total_cart' => $this->cart->total_items(),
            'total' => addCommas((isset($datacart['cart']['total_cart'])) ? $datacart['cart']['total_cart'] : 0),
            'result' => $result,
        ));die();
	}

    public function refeshCart(){
        $result = 'true';
        $notifi = '';
        $param = $this->input->post('param');
        $this->load->library("cart");
        $this->load->helper(array('myfrontendcart'));
        if(isset($param)){
            $data = $this->cart->contents();
            foreach($data as $key => $item){
                if($key == $param['rowid']){
                    $update = array("rowid" => $item['rowid'], "qty" => $param['quantity']);
                }
            }
            if(isset($update)){
                $this->cart->update($update);
            }
        }

        // thêm CP vào session
        $type = $this->input->post('type');
        if($type == 'add'){
            $code_cp = trim($this->input->post('code_cp'));
            $data = renderDataProductInCart(array('coupon' => true));
            $checkCoupon = checkCoupon($code_cp, $data);

            $result = $checkCoupon['result'];
            $notifi = ($checkCoupon['notifi'] != '') ? $checkCoupon['notifi'] : 'Thêm mới mã Coupon thành công';
            if(isset($code_cp) && $code_cp != ''){
                $this->load->library("session");
                $coupon = $this->session->userdata("coupon");
                if(!isset($coupon) || !is_array($coupon) || count($coupon) == 0 ){
                    $coupon = array( 0 => $code_cp );
                }else{
                    array_push($coupon, $code_cp);
                    $coupon = array_unique($coupon);
                }

                $this->session->set_userdata("coupon", $coupon);
            }
        }

        if($type == 'del_coupon'){
            $code_cp = trim($this->input->post('code_cp'));
            if(isset($code_cp) && $code_cp != ''){
                $this->load->library("session");
                $list_coupon = $this->session->userdata("coupon");
                if(isset($list_coupon) && is_array($list_coupon) && count($list_coupon)){
                    foreach ($list_coupon as $key => $coupon) {
                        if($coupon == $code_cp){
                             unset($list_coupon[$key]);
                        }
                    }
                }
                $this->session->set_userdata("coupon", $list_coupon);
                $notifi = "Xóa mã coupon thành công";
            }
        }
        // lấy lại thông tin giỏ hàng
        $data = renderDataProductInCart(array('coupon' => true));
        // lấy ra danh sách sản phẩm mới
        $list_product = $data['list_product'];
        $cart = $data['cart'];
        $html = $html_header_cart = $html_giohang='';
        if(isset($list_product) && is_array($list_product) && count($list_product)){
            foreach($list_product as $key => $val){
                $html = $html.htmlItemCart($val);
            }
        }
        // lấy ra danh sách CTKM
        $html_promo = '';
        if(isset($cart['promotion']) && is_array($cart['promotion']) && count($cart['promotion'])){
            foreach ($cart['promotion'] as $key => $value){
                $html_promo = $html_promo.$value;
            }
        }
        $total_cart = (isset($cart['total_cart'])) ? $cart['total_cart'] : 0;
        $total_cart_promo = (isset($cart['total_cart_promo'])) ? $cart['total_cart_promo'] : $total_cart;
        $total_cart_coupon = (isset($cart['total_cart_coupon'])) ? $cart['total_cart_coupon'] : $total_cart_promo;

        $discount_promo = $total_cart_promo - $total_cart;
        $discount_coupon = $total_cart_coupon - $total_cart_promo;
        $total_cart = addCommas($total_cart);
        $total_cart_promo = addCommas($total_cart_promo);
        $total_cart_coupon_val = $total_cart_coupon;
        $total_cart_coupon = addCommas($total_cart_coupon);
        $discount_promo = addCommas($discount_promo);
        $discount_coupon = addCommas($discount_coupon);

        // lấy ra danh sách cuopon hợp lệ
        $html_coupon = '';
        $list_coupon = isset($data['cart']['list_coupon']) ? $data['cart']['list_coupon'] : '';
        if(isset($list_coupon) && is_array($list_coupon) && count($list_coupon)){
            foreach ($list_coupon as $key => $value) {
                $html_coupon =  $html_coupon.' <div style="margin-bottom: 10px">
                            <div ><b>Mã'.$key.'</b>: '.$value['promo_detail'].'<a href=javascript:void(0)"" class="js_del_coupon_payment" style="color: red" data-coupon ="'.$key.'">Xóa</span></div></div>';
            }
        }
        echo json_encode(array(
            'result' => $result,
            'notifi' => $notifi,
            'html' => (isset($html))?$html:'',
            //'html_header_cart' => (isset($html_header_cart))?$html_header_cart:'',
            'total_quantity' => $cart['total_quantity'],
            'total' => $total_cart,
            //'cart_promo' => addCommas((isset($cart['total_cart_promo'])) ? $cart['total_cart_promo'] : $cart['total_cart']),
            'cart_coupon' => addCommas($total_cart_coupon),
            //'html_cart_coupon' => (isset($html_coupon))?$html_coupon:'',
            //'html_giohang' => (isset($html_giohang))?$html_giohang:'',
            //'list_promo' => $html_promo,
            'html_coupon' => (isset($html_coupon))?$html_coupon:'',
            'discount_coupon' => $discount_coupon,

        ));die();

    }



    public function refeshPayment(){

        $result = 'true';
        $notifi = '';
        $param = $this->input->post('param');
        $this->load->library("cart");
        $this->load->helper(array('myfrontendcart'));
        if(isset($param)){
            $data = $this->cart->contents();
            foreach($data as $key => $item){
                if($key == $param['rowid']){
                    $update = array("rowid" => $item['rowid'], "qty" => $param['quantity']);
                }
            }
            if(isset($update)){
                $this->cart->update($update);
            }
        }

        // thêm CP vào session
        $type = $this->input->post('type');
        if($type == 'add'){
            $code_cp = trim($this->input->post('code_cp'));
            $data = renderDataProductInCart(array('coupon' => true));
            $checkCoupon = checkCoupon($code_cp, $data);
            $result = $checkCoupon['result'];
            $notifi = ($checkCoupon['notifi'] != '') ? $checkCoupon['notifi'] : 'Thêm mới mã Coupon thành công';
            if(isset($code_cp) && $code_cp != ''){
                $this->load->library("session");
                $coupon = $this->session->userdata("coupon");
                if(!isset($coupon) || !is_array($coupon) || count($coupon) == 0 ){
                    $coupon = array( 0 => $code_cp );
                }else{
                    array_push($coupon, $code_cp);
                    $coupon = array_unique($coupon);
                }
                $this->session->set_userdata("coupon", $coupon);
            }
        }

        if($type == 'del_coupon'){
            $code_cp = trim($this->input->post('code_cp'));
            if(isset($code_cp) && $code_cp != ''){
                $this->load->library("session");
                $list_coupon = $this->session->userdata("coupon");
                if(isset($list_coupon) && is_array($list_coupon) && count($list_coupon)){
                    foreach ($list_coupon as $key => $coupon) {
                        if($coupon == $code_cp){
                             unset($list_coupon[$key]);
                        }
                    }
                }
                $this->session->set_userdata("coupon", $list_coupon);
                $notifi = "Xóa mã coupon thành công";
            }
        }
        // lấy lại thông tin giỏ hàng
        $data = renderDataProductInCart(array('coupon' => true));
        // lấy ra danh sách sản phẩm mới
        $list_product = $data['list_product'];
        $cart = $data['cart'];
        $html = '';


        // lấy ra danh sách cuopon hợp lệ
        $html_coupon = '';
        $list_coupon = isset($data['cart']['list_coupon']) ? $data['cart']['list_coupon'] : '';
        if(isset($list_coupon) && is_array($list_coupon) && count($list_coupon)){
           foreach ($list_coupon as $key => $value) {
                $html_coupon =  $html_coupon.' <div style="margin-bottom: 10px">
                            <div><b>Mã'.$key.'</b>: '.$value['promo_detail'].'<a href="javascript:void(0)" style="color: red" class="js_del_coupon_payment" data-coupon ="'.$key.'">Xóa</span></div></div>';
            }
        }
        $total_cart = (isset($cart['total_cart'])) ? $cart['total_cart'] : 0;

        $total_cart_promo = (isset($cart['total_cart_promo'])) ? $cart['total_cart_promo'] : $total_cart;

        $total_cart_coupon = (isset($cart['total_cart_coupon'])) ? $cart['total_cart_coupon'] : $total_cart_promo;



        $discount_promo = $total_cart_promo - $total_cart;

        $discount_coupon = $total_cart_coupon - $total_cart_promo;

        $total_cart = addCommas($total_cart);

        $total_cart_promo = addCommas($total_cart_promo);



        $total_cart_coupon_val = $total_cart_coupon;

        $total_cart_coupon = addCommas($total_cart_coupon);

        $discount_promo = addCommas($discount_promo);

        $discount_coupon = addCommas($discount_coupon);
        if(isset($list_product) && is_array($list_product) && count($list_product)){
            foreach($list_product as $key => $val){
                $html = $html.htmlItemCart($val);
            }
        }

        echo json_encode(array(
            'result' => $result,
            'notifi' => $notifi,
            'html' => (isset($html))?$html:'',
            'total_quantity' => isset($cart['total_quantity']) ? $cart['total_quantity'] : 0,
            'total' => $total_cart ,
//            'cart_promo' => $total_cart_promo,
            'cart_coupon' => addCommas($total_cart_coupon),
            'html_coupon' => (isset($html_coupon))?$html_coupon:'',
//            'cart_coupon_val' => $total_cart_coupon_val,
//            'discount_promo' => $discount_promo,
            'discount_coupon' => $discount_coupon,
            'list_coupon' => (isset($html_coupon))?$html_coupon:'',

        ));die();

    }
}
