<link href="template/cart/css/thankyou.css" rel="stylesheet" type="text/css"/>
<style>
    .anyflexbox body, .anyflexbox .content, .anyflexbox .content .wrap, .anyflexbox .main {
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-flex: 1 0 auto;
        -ms-flex: 1 0 auto;
        flex: 1 0 auto;
        width: 100%;
    }

    @media (max-width: 767px) {
        .container {
            width: 100%;
        }

        .shipping-info .col-md-12 {
            padding: 0px;
        }

        .shipping-info .row {
            margin: 0px;
        }

        .customer-info {
            padding-left: 0px;
            padding-right: 0px;
        }

        .order-info {
            margin: 0px;
        }
    }
</style>
<div class="container">
    <div class="header">
        <div class="wrap">
            <div class="shop logo logo--center">

                <a href="<?php echo base_url() ?>">
                    <img class="logo__image  logo__image--medium "
                         alt="<?php echo $this->fcSystem['homepage_company'] ?>"
                         src="<?php echo $this->fcSystem['homepage_logo'] ?>"/>
                </a>

            </div>
        </div>
    </div>
    <div class="main">
        <div class="wrap clearfix">
            <div class="row thankyou-infos">
                <div class="col-md-7 thankyou-message">
                    <div class="thankyou-message-icon unprint">
                        <div class="icon icon--order-success svg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="72px" height="72px">
                                <g fill="none" stroke="#8EC343" stroke-width="2">
                                    <circle cx="36" cy="36" r="35"
                                            style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                                    <path d="M17.417,37.778l9.93,9.909l25.444-25.393"
                                          style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                                </g>
                            </svg>
                        </div>
                    </div>
                    <div class="thankyou-message-text">
                        <h3>Cảm ơn bạn đã đặt hàng</h3>

                        <p style="display: none">

                            Một email xác nhận đã được gửi
                            tới <?php echo !empty($payment['email']) ? $payment['email'] : '-'; ?>. Xin vui lòng kiểm
                            tra email của bạn

                        </p>


                        <p style="font-style: italic;">
                            ĐẶT HÀNG THÀNH CÔNG

                        </p>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12 order-info">
                    <div class="order-summary order-summary--custom-background-color ">
                        <div class="order-summary-header summary-header--thin summary-header--border">
                            <h2>
                                <label class="control-label">Đơn hàng</label>
                                <?php echo '#' . (10000 + $payment['id']); ?>
                                <label class="control-label unprint">(<?php echo number_format($payment['quantity']); ?>
                                    )</label>
                            </h2>

                        </div>
                        <div class="order-items">
                            <div class="summary-body summary-section summary-product">
                                <div class="summary-product-list">
                                    <ul class="product-list">

                                        <?php if (isset($list_product) && is_array($list_product) && count($list_product)) { ?>
                                            <?php foreach ($list_product as $key => $val) { ?>
                                                <?php
                                                $info = getPriceFrontend(array('productDetail' => $val['detail']));
                                                $quantity = $val['qty'];
                                                if (isset($val['version']['image']) && $val['version']['image'] != '') {
                                                    $versionImage = json_decode(base64_decode($val['version']['image']), true);
                                                    if (isset($versionImage) && check_array($versionImage)) {
                                                        foreach ($versionImage as $key => $value) {
                                                            if ($value != '' && $value != 'template/not-found.png') {
                                                                $versionImage = $value;
                                                                break;
                                                            } else {
                                                                $versionImage = '';
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    $versionImage = '';
                                                }

                                                $image = $val['detail']['image'];

                                                // $title =  $val['detail']['title'].' '.((isset($val['version']['title'])) ? $val['version']['title'] : '');
                                                $title = $val['detail']['title'];

                                                $href = rewrite_url($val['detail']['canonical']);
                                                $content = $val['content'];
                                                $description_litter = cutnchar(strip_tags($val['detail']['description']), 400);
                                                $price_final = getPriceFinal($val['detail'], true);
                                                $money_row = $price_final * $quantity;
                                                $money_row = addCommas($money_row);
                                                ?>

                                                <li class="product product-has-image clearfix">
                                                    <div class="product-thumbnail pull-left">
                                                        <div class="product-thumbnail__wrapper">

                                                            <a href="<?php echo $href ?>" target="_blank"><img
                                                                        src="<?php echo $image ?>"
                                                                        alt="<?php echo $title ?>"
                                                                        class="product-thumbnail__image"></a>

                                                        </div>
                                                        <span class="product-thumbnail__quantity unprint"
                                                              aria-hidden="true"><?php echo $quantity ?></span>
                                                    </div>
                                                    <div class="product-info pull-left">
                                                    <span class="product-info-name">
                                                        <a href="<?php echo $href ?>" target="_blank"><?php echo $title ?></a>

                                                    </span>

                                                        <?php
                                                        $jsonEND = explode('<br>', $val['options']['attr']);
                                                        ?>
                                                        <?php if(!empty($jsonEND)){ ?>
                                                            <?php foreach ($jsonEND as $k => $v) { if ($v != '') {$jsonENDQ = explode(':', $v);?>
                                                                <span class="product-info-name">
                                                                <strong><b><?php echo $jsonENDQ[0]?>:</b> <?php echo $jsonENDQ[1]?></strong>

                                                            </span>
                                                            <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>

                                                    </div>
                                                    <strong class="product-price pull-right">
                                                        <?php echo $money_row ?>₫
                                                    </strong>
                                                </li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php

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

                        ?>


                        <div class="summary-section">
                            <div class="total-line total-line-total clearfix" style="margin-bottom: 5px">
                                    <span class="pull-left">
                                        Khuyến mại
                                    </span>
                                <span class="pull-right">
                                        <?php echo $discount_coupon ?> ₫
                                    </span>
                            </div>

                            <div class="total-line total-line-total clearfix">
                                    <span class="total-line-name total-line-name--bold pull-left">
                                        Tổng cộng
                                    </span>
                                <span class="total-line-price pull-right" style="font-weight: bold">
                                        <?php echo $total_cart_coupon ?> ₫
                                    </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-sm-12 customer-info">


                    <div class="shipping-info">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="order-summary-header">
                                    <h2>
                                        <label class="control-label"><b>Thông tin thanh toán</b></label>
                                    </h2>
                                </div>

                            </div>
                            <div class="col-md-12 col-sm-12 ">
                                <div class="order-summary order-summary--white no-border no-padding-top">

                                    <div class="summary-section no-border no-padding-top">

                                        <?php /*<p class="address-name " style="color: #000">
                                            Email: <?php echo !empty($payment['email'])?$payment['email']:'-'; ?>

                                        </p>*/ ?>


                                        <p class="address-address" style="color: #000">
                                            <b>Họ và tên:</b> <?php echo !empty($payment['fullname']) ? $payment['fullname'] : '-'; ?>
                                        </p>


                                        <p class="address-ward" style="color: #000">
                                            <b>Số điện thoại:</b> <?php echo !empty($payment['phone']) ? $payment['phone'] : '-'; ?>
                                        </p>
                                        <p class="address-ward" style="color: #000">
                                            <b>Email:</b> <?php echo !empty($payment['email']) ? $payment['email'] : '-'; ?>
                                        </p>

                                        <p class="address-district" style="color: #000">
                                            <b>Địa chỉ:</b> <?php echo !empty($payment['address_detail']) ? $payment['address_detail'] : '-'; ?>
                                        </p>


                                        <?php /*<p class="address-province" style="color: #000">

                                            Tỉnh/Thành phố: <?php echo !empty($payment['address_city'])?$payment['address_city']:'-'; ?>
                                        </p>




                                        <p class="address-country" style="color: #000">
                                            Quận/Huyện: <?php echo !empty($payment['address_distric'])?$payment['address_distric']:'-'; ?>
                                        </p>*/ ?>


                                        <p class="address-phone" style="color: #000">
                                            <b>Nội dung:</b> <?php echo !empty($payment['note']) ? $payment['note'] : '-'; ?>
                                        </p>
                                        <p class="address-phone" style="color: #000">
                                            <b>Hình thức thanh toán:</b> <?php if($payment['payment']=='cashondelivery'){?>Thanh toán tiền mặt khi nhận hàng<?php }else{?>)?Chuyển khoản ngân hàng<?php }?>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php /*<div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="order-summary order-summary--white no-border">
                                    <div class="order-summary-header">
                                        <h2>
                                            <label class="control-label">Hình thức thanh toán</label>
                                        </h2>
                                    </div>
                                    <div class="summary-section no-border no-padding-top">
                                        <span><?php echo !empty($payment['payment'])?$payment['payment']:'-'; ?></span>
                                    </div>
                                </div>
                            </div>


                        </div>*/ ?>
                    </div>
                    <div class="order-success unprint">
                        <a href="<?php echo base_url() ?>" class="btn btn-primary">
                            Tiếp tục mua hàng
                        </a>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
