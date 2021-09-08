<div id="main" class="wrapper" style="padding: 20px 0px">
    <div class="main-product-detail">
        <div class="container">
            <div class="row">
                <div class="contentswrap center_wrap ">
                    <div class="contentswrap_top center_wrap ">
                        <div class="center width_100 text_l">

                            <p class="text_l color_0 size14 padding_b30">
                                Giỏ hàng
                            </p>


                            <div id="sod_bsk">

                                <form name="frmcartlist" id="sod_bsk_list" method="post"
                                      action="https://www.gentlemonster.com/shop/cartupdate.php">
                                    <div class="tbl_head01 tbl_wrap width_100">
                                        <table class=" width_100">
                                            <tbody class="js_list_prd">

                                            <?php if (isset($list_product) && is_array($list_product) && count($list_product)) { ?>
                                                <?php foreach ($list_product as $key => $val) { ?>
                                                    <?php
                                                    $info = getPriceFrontend(array('productDetail' => $val['detail']));
                                                    $image = getthumb((isset($val['version']['image']) && $val['version']['image'] != '' && $val['version']['image'] != 'template/not-found.png') ? $val['version']['image'] : $val['detail']['image']);

                                                    $title = $val['detail']['title'] . ' ' . ((isset($val['version']['title'])) ? $val['version']['title'] : '');

                                                    $href = rewrite_url($val['detail']['canonical']);
                                                    $content = $val['content'];
                                                    $description_litter = cutnchar(strip_tags($val['detail']['description']), 400);
                                                    ?>
                                                    <tr style="border-top:1px solid #000" class="js_data_prd" data-rowid="<?php echo $val['rowid'] ?>" data-quantity="<?php echo $val['qty'] ?>">
                                                        <td class="sod_img" valign="top"
                                                            style="padding:20px 20px 20px 0px; width:120px; text-align:left">
                                                            <a class="cursor_p" href="">
                                                                <img src="<?php echo $image ?>" alt="<?php echo $title ?>">
                                                            </a>
                                                        </td>
                                                        <td class="sod_name text_l color_0" valign="top"
                                                            style="padding:20px 0;">
                                                            <p class=" color_0 margin_b5" style="text-transform: uppercase">
                                                                <?php echo $title ?><br>
                                                                <?php echo $val['options']['color'] ?><br>
                                                                <?php echo $val['options']['size'] ?>
                                                            </p>
                                                            <p class="size9 margin_b20">Giá: <?php echo $info['price_final'] ?></p>
                                                            <a class="size9 margin_t10 cursor_p js_del_prd" href="javascript:void(0)">
                                                                <u class="color_0 ">
                                                                    Xóa
                                                                </u><!--  -->
                                                            </a>
                                                        </td>
                                                        <td valign="top" class="qty_td" style="padding:20px 0;">
                                                            SL: <?php echo $val['qty'] ?>
                                                        </td>
                                                        <td class="td_num" valign="top"
                                                            style="padding:20px 0; text-algin:right; font-weight:bold">
                                                            <p class="text_r">
                                                                Tổng tiền :
                                                                <span id="sell_price_0"><?php echo addCommas(getPriceFinal($val['detail'])*$val['qty']) ?>đ</span>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>


                                    <div id="sod_bsk_act" class="padding_t10" style=" border-top:1px solid #000">
                                        <a href="<?php echo base_url() ?>" class="pull-left"
                                           style=" border-bottom:1px solid #000">
                                            Tiếp tục mua hàng
                                        </a>
                                        <a href="thanh-toan.html" class="productbt_buynow bg_hover_main_fb text_c">
                                            Thanh toán
                                        </a>

                                    </div>

                                </form>

                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<?php /*?>
<?php
$this->fcDevice = $this->config->item('fcDevice');
?>
<div class="ttm-page-title-row">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="page-title-heading">
                        <h1 class="title">Giỏ hàng</h1>
                    </div>
                    <div class="breadcrumb-wrapper">
                        <span class="mr-1"><i class="ti ti-home"></i></span>
                        <a title="Homepage" href="<?php echo base_url()?>">Trang chủ</a>
                        <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                        <span class="ttm-textcolor-skincolor">Giỏ hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="site-main">
    <!-- cart-section -->
    <section class="cart-section clearfix">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-lg-8">
                    <!-- cart_table -->
                    <table class="table  shop_table_responsive <?php if($this->fcDevice !='desktop'){?>cart_table<?php }?>">
                        <thead>
                        <tr>
                            <th class="product-thumbnail">&nbsp;</th>
                            <th class="product-name">Sản phẩm </th>
                            <th class="product-price">Giá</th>
                            <th class="product-quantity">Số lượng</th>
                            <th class="product-subtotal">Thành tiền</th>
                            <th class="product-remove">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody class="js_list_prd">

                        <?php if(isset($list_product) && is_array($list_product) && count($list_product)){ ?>
                        <?php foreach($list_product as $key => $val){ ?>
                        <?php
                        $info = getPriceFrontend(array('productDetail' => $val['detail']));
                        $image = getthumb((isset($val['version']['image']) && $val['version']['image'] != '' && $val['version']['image'] != 'template/not-found.png') ? $val['version']['image'] : $val['detail']['image']);

                        $title =  $val['detail']['title'].' '.((isset($val['version']['title'])) ? $val['version']['title'] : '');

                        $href = rewrite_url($val['detail']['canonical']);
                        $content = $val['content'];
                        $description_litter = cutnchar(strip_tags($val['detail']['description']),400);
                        ?>
                        <tr class="cart_item js_data_prd" data-rowid="<?php echo $val['rowid'] ?>" data-quantity="<?php echo $val['qty'] ?>">
                            <td class="product-thumbnail">
                                <a href="<?php echo $href?>">
                                    <img class="img-fluid" src="<?php echo $image ?>" alt="<?php echo $title ?>" style="width: 75px;height: 75px;object-fit: cover">
                                </a>
                            </td>
                            <td class="product-name" data-title="Product">
                                <a href="<?php echo $href?>"><?php echo $title ?></a>
                            </td>
                            <td class="product-price" data-title="Price">
                                        <span class="Price-amount">
                                            <?php echo addCommas(getPriceFinal($val['detail'])) ?>đ
                                        </span>
                            </td>
                            <td class="product-quantity" data-title="Quantity">
                                <div class="quantity">
                                    <input type="text" value="<?php echo $val['qty'] ?>" name="quantity-number" class="qty js_update_quantity_payment" size="4" autocomplete="off">
                                    <span class="inc btn-abatement">+</span>
                                    <span class="dec btn-augment">-</span>
                                </div>
                            </td>
                            <td class="product-subtotal" data-title="Total">
                                        <span class="Price-amount">
                                            <?php echo addCommas(getPriceFinal($val['detail'])*$val['qty']) ?>đ
                                        </span>
                            </td>
                            <td class="product-remove">
                                <a href="javascript:void(0)" class="remove js_del_prd">×</a>
                            </td>
                        </tr>
                        <?php }?>
                        <?php }?>



                        </tbody>
                        <tr>
                            <td colspan="6" class="actions">
                                <div class="coupon">
                                    <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-icon-btn-left ttm-btn-color-skincolor" href="<?php echo base_url()?>"><i class="ti ti-arrow-left"></i>Tiếp tục mua hàng</a>
                                </div>

                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-4">
                    <?php
                    $datacart = renderDataProductInCart(array('coupon' => true));
                    ?>
                    <!-- cart-collaterals -->
                    <div class="cart-collaterals mt-0" >
                        <div class="">
                            <div class="cart_totals res-767-mt-30">
                                <h5>Tổng tiền<span class="js_total_cart"><?php echo addCommas($datacart['cart']['total_cart']); ?>đ</span></h5>
                            </div>
                            <div class="proceed-to-checkout">
                                <a href="thanh-toan.html" class="checkout-button button">Thanh toán</a>
                            </div>
                        </div>
                    </div><!-- cart-collaterals end-->
                </div>
            </div>
        </div>
    </section><!-- cart-section end-->

</div>
<?php */ ?>
<div class="main-breadcrumb">
	<div class="uk-container uk-container-center">
		<ul class="uk-breadcrumb uk-margin-remove">
			<li><a href="<?php echo BASE_URL ?>" title="Trang chủ">Trang chủ</a></li>
		    <li class="uk-active"><a href="<?php echo rewrite_url('cart/frontend/cart/cart') ?>" title="Giỏ hàng"> Giỏ hàng</a></li>
		</ul>
	</div>
</div>
<div id="cart-wrapper" class="page-body">

	<div class="uk-container uk-container-center fix-container">
		<section class="main-cart">

			<header class="panel-head">
				<div class="title"><h2>Giỏ hàng của bạn(<span class="js_total_prd"><?php echo (isset($cart['total_quantity'])) ? $cart['total_quantity'] : 0; ?></span>)SP</h2></div>
			</header>
			<section class="panel-body">
                <div class="table-responsive">
                    <table class="table_list_prd table-border table-width-100">
                        <thead>
                            <tr>
                                <td style="width: 32%">Ảnh sản phẩm</td>
                                <td style="width: 32%">Tên sản phẩm</td>
                                <td>Số lượng</td>
                                <td>Giá</td>
                                <td>Tổng tiền</td>
                            </tr>
                        </thead>
                        <tbody class="js_list_prd">
                            <?php if(isset($list_product) && is_array($list_product) && count($list_product)){ ?>
                                <?php foreach($list_product as $key => $val){ ?>
                                    <?php 
                                        $info = getPriceFrontend(array('productDetail' => $val['detail']));
                                        $image = getthumb((isset($val['version']['image']) && $val['version']['image'] != '' && $val['version']['image'] != 'template/not-found.png') ? $val['version']['image'] : $val['detail']['image']);

                                        $title =  $val['detail']['title'].' '.((isset($val['version']['title'])) ? $val['version']['title'] : '');

                                        $href = rewrite_url($val['detail']['canonical']);
                                        $content = $val['content'];
                                        $description_litter = cutnchar(strip_tags($val['detail']['description']),400);
                                     ?>
                                    <tr class="js_data_prd" data-rowid="<?php echo $val['rowid'] ?>" data-quantity="<?php echo $val['qty'] ?>">
                                        <td>
                                            <a href="single-product.html"><img src="<?php echo $image ?>" alt="<?php echo $title ?>" title="Cas Meque Metus" class="img-thumbnail"></a>
                                        </td>
                                        <td>
                                            <a href="<?php echo $href ?>"><?php echo $title ?></a>
                                            <?php echo $content ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <div class=" quantity">
                                                <div class="uk-flex">
                                                    <input type="text" name="quantity" value="<?php echo $val['qty'] ?>" size="1" class="form-control input-border js_update_quantity" autocomplete="off" >
                                                    <button type="submit" data-toggle="tooltip" data-direction="top" class="btn btn-primary js_refesh_quantity" data-original-title="Update"><i class="fa fa-refresh"></i></button>
                                                    <button type="button" data-toggle="tooltip" data-direction="top" class="btn btn-danger pull-right js_del_prd" data-original-title="Remove"><i class="fa fa-times-circle"></i></button>
                                                </div>
                                                
                                            </div>
                                        </td>
                                        <td>
                                            <div style ="text-decoration: line-through; color:#999"><?php echo $info['price_old'] ?></div>
                                             <?php echo $info['price_final'] ?>
                                        </td>
                                        <td>
                                             <?php echo addCommas(getPriceFinal($val['detail'])*$val['qty']) ?><sup>₫</sup>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php }else{ ?>
                                <tr>Không có sản phẩm trong giỏ hàng</tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <?php echo (isset($html_gift)) ? $html_gift :'' ?>

                <?php if(isset($cart['promotion']) && is_array($cart['promotion']) && count($cart['promotion'])){ ?>
                    <div class="js_list_promo">
                        <?php foreach ($cart['promotion'] as $key => $value){ ?>
                            <?php echo $value.'<br>' ?>
                        <?php } ?>
                    </div>
                <?php } ?>
			</section>

			<footer class="panel-foot">
                <div class="title"><h2>Tiến hành thanh toán</h2></div>

                <div class="uk-flex uk-flex-middle uk-flex-space-between mb20">
                    <div>
                        <div class="uk-flex uk-flex-middle mb10">
                            <b style=" min-width: 180px" class="main-title">Sử dụng mã giảm giá</b>
                            <input  type="text" class="form-control input-border input-coupon js_input_coupon m-r" placeholder="Nhập mã giả giá (nếu có)">
                            <button type="button" class="btn btn-w-m btn-success js_btn_coupon">Áp dụng</button>
                        </div>
                        <div class="mb10">Mã giảm giá đã thêm vào giỏ hàng</div>
                        <div class="js_list_coupon">
                            <?php if(isset($cart['list_coupon']) && is_array($cart['list_coupon']) && count($cart['list_coupon'])){ ?>
                                <?php foreach ($cart['list_coupon'] as $key => $value) { ?>
                                    <div><?php echo '<b>Mã '.$key.'</b>: '.$value['promo_detail'] ?> <span data-coupon="<?php echo $key ?>" class="js_del_coupon"><i class="fa fa-trash" aria-hidden="true"></i></span></div>
                            <?php }} ?>
                        </div>
                    </div>
                    <table class="table table-border">
                        <tbody>
                            <?php 
                                $total_cart = addCommas((isset($cart['total_cart'])) ? $cart['total_cart'] : 0);
                                $total_cart_promo = addCommas((isset($cart['total_cart_promo'])) ? $cart['total_cart_promo'] : $total_cart);
                                $total_cart_coupon = addCommas((isset($cart['total_cart_coupon'])) ? $cart['total_cart_coupon'] : $total_cart_promo);

                             ?>
                            <tr>
                                <td><strong>Tổng tiền:</strong></td>
                                <td><span class="js_total_cart"><?php echo $total_cart  ?></span><sup>₫</sup></td>
                            </tr>
                            <tr>
                                <td><strong>Tổng tiền sau KM:</strong></td>
                                <td><span class="js_cart_promo"><?php echo  $total_cart_promo ?></span><sup>₫</sup></td>
                            </tr>
                            <tr>
                                <td><strong>Tổng tiền sau CP:</strong></td>
                                <td><span class="js_cart_coupon"><?php echo $total_cart_coupon  ?></span><sup>₫</sup></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                    <a href="<?php echo site_url('') ?>" class="btn btn-continue btn-cart">Tiếp tục mua hàng</a>
                    <?php if(isset($list_product) && is_array($list_product) && count($list_product)){ ?>
                        <a href="<?php echo site_url('thanh-toan') ?>" class="btn btn-payment btn-cart">Thanh toán</a>
                    <?php } ?>
                </div>

			</footer>

		</section>
	</div>
</div>