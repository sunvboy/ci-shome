<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller {

	public $module;
	function __construct() {
		parent::__construct();
		$this->load->helper(array('myfrontendcart'));
		$this->load->helper(array('myfrontendcommon'));
		$this->load->library('nestedsetbie', array('table' => 'product_catalogue'));
        $this->fc_lang = $this->config->item('fc_lang');

    }
	public function payment(){
        //$this->cart->destroy();

        $check = $this->cart->contents();
        //echo "<pre>";var_dump($check);die;
        if(!isset($check) || is_array($check) == false || count($check) == 0){
            $this->session->set_flashdata('message-danger', 'Không tồn tại giỏ hàng');
            redirect(BASE_URL);
        }
		$data = renderDataProductInCart(array('coupon' => true));
		if($this->input->post('create')){
			$this->load->library('form_validation');
			$this->form_validation->CI =& $this;
			$this->form_validation->set_error_delimiters('','/');
			$this->form_validation->set_rules('fullname', 'Họ và tên', 'trim|required');
			// $this->form_validation->set_rules('first_name', 'Họ', 'trim|required');
			// $this->form_validation->set_rules('last_name', 'Tên', 'trim|required');
            $this->form_validation->set_rules('phone','Số điện thoại', 'trim|required|max_length[10]|min_length[10]');
			// $this->form_validation->set_rules('cityid', 'Tỉnh/Thành phố', 'trim|required');
			$this->form_validation->set_rules('address_detail', 'Địa chỉ cụ thể', 'trim|required');
//			$this->form_validation->set_rules('delivery-time', 'Thời gian giao hàng', 'trim|required');
//			$this->form_validation->set_rules('payment', 'Hình thức thanh toán', 'trim|required');
			if($this->form_validation->run($this)){
				$extend['mst'] = $this->input->post('mst');
				$extend['company'] = $this->input->post('company');
				$extend['company_address'] = $this->input->post('company-address');
				$extend['fullname_receive'] = $this->input->post('fullname_receive');
				$extend['phone_receive'] = $this->input->post('phone_receive');
				$extend['phone_2_receive'] = $this->input->post('phone_2_receive');
				$extend['address_receive'] = $this->input->post('address_receive');
				$extend['email_receive'] = $this->input->post('email_receive');
				$extend['cityid_receive'] = $this->input->post('cityid_receive');
				$extend['districtid_receive'] = $this->input->post('districtid_receive');
				$extend['wardid_receive'] = $this->input->post('wardid_receive');
				$cart = $data['cart'];
				$total_cart = (isset($cart['total_cart'])) ? $cart['total_cart'] : 0;
                $total_cart_promo = (isset($cart['total_cart_promo'])) ? $cart['total_cart_promo'] : $total_cart;
                $total_cart_coupon = (isset($cart['total_cart_coupon'])) ? $cart['total_cart_coupon'] : $total_cart_promo;
                $discount_promo = $total_cart_promo - $total_cart;
                $discount_coupon = $total_cart_coupon - $total_cart_promo;
                $total_cart = addCommas($total_cart);
                $total_cart_promo = addCommas($total_cart_promo);
                $total_cart_coupon = addCommas($total_cart_coupon);
                $discount_promo = addCommas($discount_promo);
                $discount_coupon = addCommas($discount_coupon);

                // tính giá ship
                $cityid = $this->input->post('cityid');
		        $districtid = $this->input->post('districtid');
		        $shipVal = render_ship(array(
		            'cityid' => $cityid,
		            'districtid' => $districtid,
		        ));
		        $qty = $data['cart']['total_quantity'];
				//lấy id của sản phẩm trong giỏ hàng
		        $listId = [];
		        if(isset($data) && check_array($data)){
		            foreach ($data['list_product'] as $key => $val) {
		                $listId[] = $val['option']['id'];
		            }
		        }
				//check số tiền được giảm phí vận chuyển chương trình khuyến mại hoặc coupon
		        $discount_value = render_discount_ship(array(
		            'listId' => $listId,
		            'cityid' => $cityid,
		            'districtid' => $districtid,
		            'qty' => $qty,
		            'total_cart' => $total_cart,
		        ));

		        $totalShip = ($shipVal > $discount_value) ? ($shipVal - $discount_value) : 0;

				$extend['totalShip'] = $this->input->post('totalShip');
		        $extend['shipDiscount'] = $this->input->post('discount_value');
		        $extend['shipVal'] = $this->input->post('shipVal');

				$_insert = array(
					'ship' => $totalShip,
					'code' => CodeRender('order'),
					'fullname' => $this->input->post('fullname'),
					// 'fullname' => $this->input->post('first_name').' '.$this->input->post('last_name'),
//					'paymentCataId' => $this->input->post('payment'),
//					'delivery_time' => $this->input->post('delivery-time'),
					'phone' => $this->input->post('phone'),
//					'phone_other' => $this->input->post('phone_other'),
					'email' => !empty($this->input->post('email'))?$this->input->post('email'):'',
					'note' => !empty($this->input->post('note'))?$this->input->post('note'):'',
					'cityid' => !empty($this->input->post('cityid'))?$this->input->post('cityid'):'',
					'districtid' => !empty($this->input->post('districtid'))?$this->input->post('districtid'):'',
					'payment' => $this->input->post('payment'),
					//'wardid' => $this->input->post('wardid'),
					'address_detail' => $this->input->post('address_detail'),
					'quantity' => $data['cart']['total_quantity'],
					'total_cart_final' => str_replace('.', '',$total_cart_coupon),
					'cart_json' => base64_encode(json_encode($data)),
					'extend_json' =>  base64_encode(json_encode($extend)),
					'promotional_detail' => isset($data['cart']['promotion']) ? json_encode($data['cart']['promotion']) : '',
					'coupon_json' => isset($data['cart']['list_coupon']) ? json_encode($data['cart']['list_coupon']) : '',
					'userid' => isset($this->FT_auth['id']) ? $this->FT_auth['id'] : '',
					'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
					'status' => 'pending',
				);

				$resultid = $this->Autoload_Model->_create(array(
					'table' => 'order',
					'data' => $_insert,
				));
				if($resultid > 0){
                    // trừ số lượng mã cuopon
                    if(isset($data['cart']['list_coupon']) && is_array($data['cart']['list_coupon']) && count($data['cart']['list_coupon'])){

                        foreach ($data['cart']['list_coupon'] as $key => $value) {


                            $check_list_coupon = $this->Autoload_Model->_get_where(array(
                                'select' => 'not_limmit',
                                'table' => 'promotional',
                                'where' => array('code'=>$key)
                            ));
                            if($check_list_coupon['not_limmit'] == ''){
                                updateInt(array(
                                    'module' => 'promotional',
                                    'field' => 'limmit_code',
                                    'where' => array('code' => $key),
                                    'minus' => 1,
                                ));
                            }




                        }
                    }
					foreach ($data['list_product'] as $key => $product) {
						$_insert_relationship[] = array(
							'orderid' => $resultid,
							'module' => 'product',
							'title' => $product['detail']['title'],
							'moduleid' => $product['detail']['id'],
							'image' => $product['detail']['image'],
							'attrids' => $product['option']['attrids'],
							'quantity' => $product['qty'],
							'price_final' => getPriceFinal($product['detail']),
							'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
						);
					}
					$this->Autoload_Model->_create_batch(array(
						'table' => 'order_relationship',
						'data' => $_insert_relationship,
					));

					// GỬI MAIL
					$this->load->helper('mymail');
					$this->load->library(array('mailbie'));
					$detailorder = $this->Autoload_Model->_get_where(array(
						'select' => 'id,code,payment, fullname, created, updated, order, total_cart_final, status,	quantity, promotional_detail, fullname , phone, email, note, address_detail, (SELECT name FROM vn_province WHERE order.cityid = vn_province.provinceid) as address_city, (SELECT name FROM vn_district WHERE order.districtid = vn_district.districtid) as address_distric, extend_json',
						'table' => 'order',
						'where' => array('id' => $resultid),
					));
					// pre($data['list_product']);
					$image = site_url($product['detail']['image']);
					$image = substr( $image, 0, strlen($image) - 5);
    				$productListDes = '';
    				foreach ($data['list_product'] as $key => $product) {
    					$content = isset($product['detail']['content']) ? $product['detail']['content'] :'';
    					$productListDes = $productListDes.'<tr>
    						<td style="padding:5px 9px"><img style="width:40px ; height: 40px" src="'.$image.'"></td>
    						<td style=" padding:5px 9px">'.$product['detail']['title'].$content.'</td>
    						<td style="text-align:right ; padding:5px 9px">'.addCommas($product['detail']['price']).' đ</td>
    						<td style="text-align:center ; padding:5px 9px">'.$product['qty'].'</td>
    						<td style="text-align:right ; padding:5px 9px">'.addCommas($product['detail']['price'] - getPriceFinal($product['detail'])).' đ</td>
    						<td style="text-align:right ; padding:5px 9px">'.addCommas(getPriceFinal($product['detail'])).' đ</td>
    					</tr>';
					}

					if(!empty($detailorder['address_receive']))
						$address = $detailorder['address_receive'].' - '.$detailorder['wardid_receive'].' - '.$detailorder['districtid_receive'].' - '.$detailorder['cityid_receive'];
					else{
						$address = $detailorder['address_detail'].' - '.$detailorder['address_detail'].' - '.$detailorder['address_distric'].' - '.$detailorder['address_city'];
					}

					$cc = '';
					for ($i=1; $i < 5 ; $i++) {
						$email = isset($this->fcSystem['contact_email_'.$i]) ? $this->fcSystem['contact_email_'.$i] : '';
						if(!empty($email)){
							$cc = $cc.', '.$email;
						}
					}


					$this->mailbie->sent(array(
						'to' => $this->fcSystem['contact_email'],
                        'cc' => isset($_POST['email'])?$_POST['email'].','.$this->fcSystem['contact_email']:$this->fcSystem['contact_email'] ,
						'subject' => 'Xác nhận đặt hàng thành công tại hệ thống website: '.$this->fcSystem['contact_website'],
						'message' => mail_html(array(
							'header' => 'Thông tin đặt hàng',
							'fullname' => $detailorder['fullname'],
							'email' => $detailorder['email'],
							'p_phone' => $detailorder['phone'],
							'address' => $address,
							'total_price' => $detailorder['total_cart_final'],
							'total_price_coupon' => $total_cart_coupon,
							'discount_coupon' => $discount_coupon,
							'payment_code' => $detailorder['code'],
							'payment_created' => $detailorder['created'],
							'payment' => $detailorder['payment'],
							'fee' => $totalShip,
							'product' => $productListDes,
							'web' => $this->fcSystem['contact_website'],
							'hotline' => $this->fcSystem['contact_hotline'],
							'phone' => $this->fcSystem['contact_hotline'],
							'logo' => base_url($this->fcSystem['homepage_logo']),
							'brandname' => $this->fcSystem['contact_website'],
							'system_email' => $this->fcSystem['contact_email'],
							'system_address' => $this->fcSystem['contact_address'],
						))
					));
//					if($this->input->post('payment') == 10){
//						redirect('payment/frontend/paypal');
//						$module = modules::run($routers['uri'], $routers['param']['id'], $page);
//					}


					//trừ số lượng sản phẩm trong kho
                    /*if(!empty($data['list_product'])){
                        foreach ($data['list_product'] as $key=>$val){
                            $quantityDetail = $this->Autoload_Model->_get_where(array(
                                'table' => 'product_quantity',
                                'where' => array('productID' =>$val['id'],'attrid' => $val['attrID']),
                                'select' => 'id,quantity'
                            ));
                            $this->Autoload_Model->_update(array(
                                'table' => 'product_quantity',
                                'where' => array('productID' =>$val['id'],'attrid' => $val['attrID']),
                                'data' => array('quantity' => (int)$quantityDetail['quantity']-(int)$val['qty'])
                            ));
                        }

                    }*/
                    //end
                    $this->cart->destroy();
                    $this->session->set_userdata("coupon", '');
                    setcookie('payment' . FC_ENCRYPTION, json_encode(array('id' => $resultid,)), time() + (86400 * 30), '/');
                    $this->session->set_flashdata('message-success', 'Bạn đã tạo đơn hàng thành công, vui lòng kiểm tra email');
                    redirect('dat-mua-thanh-cong');
				}
			}
		};
		// pre($data);
		$data['meta_title'] = 'Thanh toán';

       if(svl_ismobile() == 'is mobile'){
            $data['template'] = 'cart/payment_mobile';
        }else{
           $data['template'] = 'cart/payment';

        }

        $this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);


	}
    public function success(){
        $payment = isset($_COOKIE['payment' . FC_ENCRYPTION]) ? $_COOKIE['payment' . FC_ENCRYPTION] : NULL;
        if (!isset($payment) || empty($payment)) {
            $this->session->set_flashdata('message-danger', 'Đơn hàng không tồn tại');
            redirect(base_url());
        }
        $_paymentid = json_decode($payment, TRUE);
        $_payment = $this->Autoload_Model->_get_where(array(
            'select' => 'id,code,payment,cart_json,created, fullname, created, updated, order, total_cart_final, status,	quantity, promotional_detail, fullname , phone, email, note, address_detail, (SELECT name FROM vn_province WHERE order.cityid = vn_province.provinceid) as address_city, (SELECT name FROM vn_district WHERE order.districtid = vn_district.districtid) as address_distric, (SELECT name FROM vn_ward WHERE order.wardid = vn_ward.wardid) as address_ward, extend_json',
            'table' => 'order',
            'where' => array(
                'id' => $_paymentid['id'],
            ),
        ));
        if (!isset($_payment) || !is_array($_payment) || count($_payment) == 0) {
            $this->session->set_flashdata('message-danger', 'Đơn hàng không tồn tại');
            redirect(base_url());

        }

        $data['data_order'] = json_decode(base64_decode($_payment['cart_json']), true);

        $data['list_product'] = $data['data_order']["list_product"];
        $data['cart'] = $data['data_order']["cart"];


        $data['payment'] = $_payment;
        $data['meta_title'] = 'Đặt mua thành công';
        $data['template'] = 'cart/success';
        $this->load->view('homepage/frontend/layout/cart', isset($data)?$data:NULL);
    }
	public function cart(){
        $check=$this->cart->contents();
        if(!isset($check) || is_array($check) == false || count($check) == 0){
            $this->session->set_flashdata('message-danger', 'Không tồn tại giỏ hàng');
            redirect(BASE_URL);
        }
		// pre($_SESSION,1);
		$data = renderDataProductInCart(array('coupon' => true));
		$data['meta_title'] = 'Giỏ hàng';
		$data['template'] = 'cart/cart';
		$this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);
	}
	public function quantity(){
        $value = $this->input->post('value');
        $productid = $this->input->post('productid');
        $quantityRow = $this->Autoload_Model->_get_where(array(
            'table' => 'product_quantity',
            'where' => array('productID' =>$productid,'attrid' => $value),
            'select' => 'quantity'
        ));

        $html = '';
        if (isset($quantityRow) && is_array($quantityRow) && count($quantityRow)) {
            if($quantityRow['quantity'] > 0){
                for ($i=1;$i <= (int)$quantityRow['quantity'];$i++){
                    $html .='<option value="'.$i.'">'.$i.'</option>';
                }
            }else{
                $html .= '0';
            }

        }
        echo $html;die;


    }

}
