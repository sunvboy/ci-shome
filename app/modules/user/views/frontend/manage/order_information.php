<script>
    $("body").removeAttr('class');
    $("body").attr('class', "account customer-account-edit page-layout-2columns-left add-padding-header iMenu loading-active-12 loading-actived");


</script>
<main id="maincontent" class="page-main">


    <div class="columns">
        <div class="column main">
            <div class="page-title-wrapper">
                <h1 class="page-title"><span class="base">Thông tin đơn hàng #<?php echo $detailorder['code'] ?></span>
                </h1>
            </div>

            <div class="message success empty"><span>Mã đơn hàng #<?php echo $detailorder['code'] ?></span></div>
            <div id="onepage-checkout">
                <div id="onepage-checkout-desktop"><!---->
                    <div class="checkout-desktop">
                        <div class="onepage-checkout"><!---->
                            <div id="info-customer" class="formCheckout">

                                <div class="infor-customer" style="padding: 0px">
                                    <div class="title-block">
                                        <span style="margin-left: 0px">THÔNG TIN KHÁCH HÀNG</span>
                                    </div>

                                    <div class="personal-information" style="padding: 0px">
                                        <div class="wapper">

                                            <div class="information">
                                                <div class="title-input">Họ tên*</div>
                                                <input type="text" name="fullname" value="<?php echo $detailorder['fullname']?>"
                                                       class="saveinfo input-text b0" autocomplete="off" readonly
                                                       placeholder="Họ và tên">


                                            </div>
                                            <div class="information half-column">
                                                <div class="title-input">Email</div>
                                                <input type="text" name="email" value="<?php echo $detailorder['email']?>"
                                                       class="saveinfo input-text b0"
                                                       placeholder="Nhập địa chỉ Email, không bắt buộc" readonly
                                                       autocomplete="off">


                                            </div>
                                            <div class="information half-column">
                                                <div class="title-input">Số điện thoại*</div>

                                                <input type="text" name="phone" value="<?php echo $detailorder['phone']?>"
                                                       class="saveinfo input-text b0" autocomplete="off" readonly
                                                       placeholder="Số điện thoại">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="address-information" style="padding: 0px">
                                    <div class="title-block"><span style="margin-left: 0px"> ĐỊA CHỈ NHẬN HÀNG</span>
                                    </div>
                                    <div class="personal-information" style="padding: 0px">
                                        <div class="wapper">
                                            <div class="select information half-column">
                                                <div class="title-input" >Tỉnh/thành phố</div>
                                                <input type="text" name="fullname" value="<?php echo $detailorder['address_city'] ?>"
                                                       class="saveinfo input-text b0" autocomplete="off" readonly
                                                       placeholder="Họ và tên">
                                            </div>
                                            <div class="select information half-column">
                                                <div class="title-input">Quận/huyện</div>
                                                <input type="text" name="fullname" value="<?php echo $detailorder['address_distric']?>"
                                                       class="saveinfo input-text b0" autocomplete="off" readonly
                                                       placeholder="Họ và tên">
                                            </div>

                                            <div class="information">
                                                <div class="title-input">Địa chỉ cụ thể*</div>
                                                <input type="text" name="fullname" value="<?php echo $detailorder['address_detail']?>"
                                                       class="saveinfo input-text b0" autocomplete="off" readonly
                                                       placeholder="Họ và tên">
                                            </div>
                                            <script>
                                                var cityid = '<?php echo !empty($this->FT_auth['cityid'])?$this->FT_auth['cityid']:$this->input->post('cityid'); ?>';
                                                var districtid = '<?php echo !empty($this->FT_auth['districtid'])?$this->FT_auth['districtid']:$this->input->post('districtid') ?>';
                                                var wardid = '<?php echo $this->input->post('wardid') ?>';
                                            </script>
                                            <div class="information note">
                                                <div class="title-input">Ghi chú</div>
                                                <?php echo form_textarea('note', set_value('note',$detailorder['note']), 'class="note saveinfo" placeholder="Hãy để lại lời nhắn" autocomplete="off"'); ?>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="right-container">
                                <div style="position: static; top: auto; bottom: auto; left: auto; width: auto; z-index: 20;">
                                    <div class="sidebar__inner">
                                        <div class="product-contaniner">
                                            <div class="items-cart">
                                                <div id="form-update-cart" class="cart_listheader">

                                                    <?php if (isset($data_order['list_product']) && is_array($data_order['list_product']) && count($data_order['list_product'])) { ?>
                                                        <?php foreach ($data_order['list_product'] as $key => $val) {
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
                                                            <div class="item">
                                                                <a href="javascript:void(0)" class="product-name">
                                                                    <h2> <?php echo $title ?></h2>
                                                                </a>
                                                                <div class="column-left"><img
                                                                            src="<?php echo $image ?>"
                                                                            alt="<?php echo $title ?>"
                                                                            class="product-image"></div>
                                                                <div class="product-detail">
                                                                    <?php
                                                                    $jsonEND = explode('<br>', $val['options']['attr']);
                                                                    ?>
                                                                    <?php if(!empty($jsonEND)){ ?>
                                                                    <div class="product-description">
                                                                        <?php foreach ($jsonEND as $k => $v) { if ($v != '') {$jsonENDQ = explode(':', $v);?>

                                                                        <div class="items-options " >
                                                                            <p class="title"><?php echo $jsonENDQ[0]?></p>
                                                                            <p class="title" style="text-align: right;"> <?php echo $jsonENDQ[1]?></p>
                                                                        </div>
                                                                        <?php } ?>
                                                                        <?php } ?>
                                                                    </div>

                                                                    <?php } ?>

                                                                    <div class="price-total">
                                                                        <span class="title">Giá tiền</span>
                                                                        <span class="product-price price"><?php echo $quantity ?> x <?php echo addCommas($val['price']) ?>&nbsp;₫</span>
                                                                    </div>
                                                                    <div class="product-qty"><span class="title">Số lượng</span>
                                                                        <div class="pull-right"><!---->
                                                                            <div class="qty-button ">
                                                                                <div class="qty-input"><?php echo $quantity ?></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        <?php }
                                                    } ?>
                                                </div>
                                            </div>
                                            <div class="price-container">
                                                <?php
                                                $total_cart = (isset($data_order['cart']['total_cart'])) ? $data_order['cart']['total_cart'] : 0;
                                                $total_cart_promo = (isset($data_order['cart']['total_cart_promo'])) ? $data_order['cart']['total_cart_promo'] : $total_cart;
                                                $total_cart_coupon = (isset($data_order['cart']['total_cart_coupon'])) ? $data_order['cart']['total_cart_coupon'] : $total_cart_promo;
                                                $discount_promo = $total_cart_promo - $total_cart;
                                                $discount_coupon = $total_cart_coupon - $total_cart_promo;

                                                $total_cart = addCommas($total_cart);
                                                $total_cart_promo = addCommas($total_cart_promo);
                                                $total_cart_coupon = addCommas($total_cart_coupon);

                                                $discount_promo = addCommas($discount_promo);
                                                $discount_coupon = addCommas($discount_coupon);
                                                $discount_other = (isset($data_order['cart']['discount_other'])) ? $data_order['cart']['discount_other'] : 0;

                                                ?>

                                                <div class="price-block product">
                                                    <div class="pull-left label-price">Giá tạm tính</div>
                                                    <div class="pull-right price-right"><span
                                                                class="price cart_totalprice"><?php echo $total_cart . 'đ' ?></span>
                                                    </div>
                                                </div>
                                                <div class="price-block product">
                                                    <div class="pull-left label-price">Khuyến mại</div>
                                                    <div class="pull-right price-right"><span
                                                                class="price js_discount_coupon"><?php echo addCommas($discount_coupon) . ' đ' ?></span>
                                                    </div>
                                                </div>
                                                <div class="price-block grand">
                                                    <div class="pull-left label-price">Thành tiền</div>
                                                    <div class="pull-right"><!---->
                                                        <div class="grand-total price-right cart_total_counpon">
                                                            <?php echo $total_cart_coupon . 'đ' ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="sidebar sidebar-main">
            <div class="block block-collapsible-nav">
                <div class="title block-collapsible-nav-title">
                    <strong>Thông tin đơn hàng #<?php echo $detailorder['code'] ?></strong>
                </div>
                <div class="content block-collapsible-nav-content" id="block-collapsible-nav">
                    <ul class="nav items">
                        <li class="nav item "><a href="information.html">Thông tin tài khoản</a></li>

                        <li class="nav item "><a href="change-pass.html">Đổi mật khẩu</a></li>
                        <li class="nav item current"><a href="order-history.html">Đơn đặt hàng của tôi</a></li>
                        <li class="nav item"><a href="logout.html">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
            <div class="block account-nav">
                <div class="title account-nav-title">
                    <strong></strong>
                </div>
                <div class="content account-nav-content" id="account-nav">
                </div>
            </div>
        </div>

    </div>
</main>
<style>
    .label-primary, .badge-primary {
        background-color: #3a88be;
        color: #FFFFFF;
    }

    .label-info, .badge-info {
        background-color: #23c6c8;
        color: #FFFFFF;
    }

    .label-danger, .badge-danger {

        background-color: #ed5565;

        color: #FFFFFF;

    }

    .label-success,
    .badge-success {

        background-color: #155724;

        color: #FFFFFF;

    }

    .label-warning,
    .badge-warning {

        background-color: #f8ac59;

        color: #FFFFFF;

    }

    .label {
        display: inline;
        padding: .2em .6em .3em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25em;
    }
</style>


