<script>
    $("body").removeAttr('class');
    $("body").attr('class', "quickcheckout-index-index page-layout-1column add-padding-header iMenu loading-active-12 loading-actived");
</script>
<main id="maincontent" class="page-main">

    <div class="page-title-wrapper">
        <h1 class="page-title">
            <span class="base" data-ui-id="page-title-wrapper">Thanh toán</span>
        </h1>
    </div>

    <div class="columns">
        <div class="column main">
            <div class="container">
                <div id="onepage-checkout">
                    <div id="onepage-checkout-desktop"><!---->
                        <div class="checkout-desktop">
                            <div class="onepage-checkout"><!---->
                                <form method="POST" action="" id="info-customer" class="formCheckout">
                                    <a href="<?php echo base_url() ?>" class="button-goback"><i
                                                class="fa fa-arrow-left"></i> Tiếp tục mua sắm</a>
                                    <div class="payment-method">
                                        <div class="title-block"><p class="number">1</p>
                                            <span> HÌNH THỨC THANH TOÁN</span></div>
                                        <div class="payment-container check-box-container">
                                            <div class="payment-cod">
                                                <label class="check-box active"><p>Thanh toán tiền mặt khi nhận hàng</p>
                                                    <input type="radio" name="payment" value="cashondelivery" checked>
                                                    <span class="check"></span>
                                                </label>
                                            </div>
                                            <?php /*<div class="payment-vnpay">
                                                <label class="check-box"><p>Thanh toán bằng VNPAY (ATM / Internet Banking / MasterCard)</p>
                                                    <input type="radio" name="payment" value="vnpay">
                                                    <span class="check"></span>
                                                </label>
                                            </div>*/ ?>
                                            <!---->
                                            <div class="bank-transfer">
                                                <label class="check-box">
                                                    <p>Chuyển khoản ngân hàng</p>
                                                    <input type="radio" name="payment" value="banktransfer">
                                                    <span class="check"></span>
                                                </label>
                                                <div class="three-bank" style="display: none">
                                                    <div class="border-top">
                                                        <?php
                                                        $nganhang = $this->Autoload_Model->_get_where(array(
                                                            'select' => 'id, title',
                                                            'table' => 'page_catalogue',
                                                            'where' => array('highlight' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)));
                                                        if (isset($nganhang) && is_array($nganhang) && count($nganhang)) {
                                                            $nganhang['post'] = $this->Autoload_Model->_condition(array(
                                                                'module' => 'page',
                                                                'select' => '`object`.`id`, `object`.`title`, `object`.`image`,  `object`.`description`',
                                                                'where' => '`object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\' ',
                                                                'catalogueid' => $nganhang['id'],
                                                                'limit' => 10,
                                                                'order_by' => '`object`.`order` asc, `object`.`id` desc',
                                                            ));
                                                        }
                                                        ?>
                                                        <?php if (isset($nganhang) && is_array($nganhang) && count($nganhang)) {?>
                                                        <?php if (isset($nganhang['post']) && is_array($nganhang['post']) && count($nganhang['post'])) {?>
                                                        <div class="bank-images">
                                                            <?php foreach ($nganhang['post'] as $k=>$v){?>
                                                                <div class="bank-symbol bank-symbol-vcb<?php echo $v['id']?> <?php if($k==0){?>active<?php }?>" data-title="vcb<?php echo $v['id']?>">
                                                                    <img src="<?php echo $v['image']?>" alt="<?php echo $v['title']?>">
                                                                </div>
                                                            <?php }?>


                                                        </div>
                                                        <div class="bank-infor">
                                                            <?php foreach ($nganhang['post'] as $k=>$v){?>
                                                                <div id="vcb<?php echo $v['id']?>" class="bank-detail vcb<?php echo $v['id']?>" <?php if($k==0){?>style="display: block" <?php }else{?>style="display: none"<?php }?>>
                                                                    <?php echo $v['description']?>
                                                                </div>
                                                            <?php }?>
                                                        </div>
                                                        <?php }?>
                                                        <?php }?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php /*<div class="payment-payoo"><label class="check-box"><p>Trả góp bằng PAYOO
                                                        (Thẻ tín dụng)</p> <input type="radio" name="payment"
                                                                                  value="payoo"> <span
                                                            class="check"></span></label> <!----> <!----></div>*/ ?>
                                            <script>
                                                $('input[name="payment"]').click(function () {
                                                    var value = $(this).val();
                                                    $('.check-box').removeClass('active');
                                                    $(this).parents('.check-box').addClass('active');
                                                    if (value === 'banktransfer') {

                                                        $('.three-bank').show();
                                                    } else {
                                                        $('.three-bank').hide();

                                                    }

                                                });
                                                $('.bank-symbol').click(function () {
                                                    var value = $(this).attr('data-title');
                                                    $('.bank-symbol').removeClass('active');
                                                    $('.bank-symbol-' + value).addClass('active');
                                                    $('.bank-detail').hide();
                                                    $('#' + value).show();
                                                })
                                            </script>
                                        </div>
                                    </div>
                                    <div class="infor-customer">
                                        <div class="title-block">
                                            <p class="number">2</p><span>THÔNG TIN KHÁCH HÀNG</span>
                                        </div>

                                        <div class="personal-information">
                                            <div class="wapper">
                                                <?php $error = validation_errors();
                                                echo !empty($error) ? '<div class="alert alert-danger">' . $error . '</div>' : ''; ?>

                                                <div class="information">
                                                    <div class="title-input">Họ tên*</div>
                                                    <?php echo form_input('fullname', set_value('fullname',!empty($this->FT_auth['fullname'])?$this->FT_auth['fullname']:''), 'class="saveinfo input-text" autocomplete="off" placeholder="Họ và tên"'); ?>


                                                </div>
                                                <div class="information half-column">
                                                    <div class="title-input">Email</div>
                                                    <?php echo form_input('email', set_value('email',!empty($this->FT_auth['email'])?$this->FT_auth['email']:''), 'class="saveinfo input-text" placeholder="Nhập địa chỉ Email, không bắt buộc" autocomplete="off"'); ?>


                                                </div>
                                                <div class="information half-column">
                                                    <div class="title-input">Số điện thoại*</div>

                                                    <?php echo form_input('phone', set_value('phone',!empty($this->FT_auth['phone'])?$this->FT_auth['phone']:''), 'class="saveinfo input-text"  placeholder="Số điện thoại" autocomplete="off"'); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="address-information">
                                        <div class="title-block"><p class="number">3</p><span> ĐỊA CHỈ NHẬN HÀNG</span>
                                        </div>
                                        <div class="personal-information">
                                            <div class="wapper">
                                                <div class="select information half-column">
                                                    <div class="title-input">Chọn tỉnh/thành phố</div>
                                                    <?php
                                                    $listCity = getLocation(array(
                                                        'select' => 'name, provinceid',
                                                        'table' => 'vn_province',
                                                        'field' => 'provinceid',
                                                        'text' => 'Chọn Tỉnh/Thành Phố'
                                                    ));
                                                    ?>
                                                    <?php echo form_dropdown('cityid', $listCity, '', 'class="select-soflow saveinfo"  id="city" placeholder="" autocomplete="off"'); ?>
                                                    <i aria-hidden="true" class="fa fa-caret-down"></i>
                                                </div>
                                                <div class="select information half-column">
                                                    <div class="title-input">Chọn quận/huyện</div>
                                                    <select name="districtid" id="district" class="select-soflow saveinfo location">
                                                        <option value="">Chọn Quận/Huyện</option>
                                                    </select>
                                                    <i aria-hidden="true" class="fa fa-caret-down"></i>
                                                </div>

                                                <div class="information">
                                                    <div class="title-input">Địa chỉ cụ thể*</div>
                                                    <?php echo form_input('address_detail', set_value('address_detail',!empty($this->FT_auth['address'])?$this->FT_auth['address']:''), 'class="saveinfo" placeholder="Nhập địa chỉ đầy đủ: Số nhà, tên đường" autocomplete="off"'); ?>

                                                </div>
                                                <script>
                                                    var cityid = '<?php echo !empty($this->FT_auth['cityid'])?$this->FT_auth['cityid']:$this->input->post('cityid'); ?>';
                                                    var districtid = '<?php echo !empty($this->FT_auth['districtid'])?$this->FT_auth['districtid']:$this->input->post('districtid') ?>';
                                                    var wardid = '<?php echo $this->input->post('wardid') ?>';
                                                </script>
                                                <div class="information note">
                                                    <div class="title-input">Ghi chú</div>
                                                    <?php echo form_textarea('note', set_value('note'), 'class="note saveinfo" placeholder="Hãy để lại lời nhắn" autocomplete="off"'); ?>

                                                </div>
                                            </div>
                                            <div class="button-action">

                                                <input class="success-order btn-checkout" type="submit" name="create"
                                                       value="Hoàn tất mua sắm">
                                                <input class="success-order btn-loading"
                                                       value="DỮ LIỆU ĐANG ĐƯỢC XỬ LÝ..." style="display: none">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="right-container">
                                    <div style="position: static; top: auto; bottom: auto; left: auto; width: auto; z-index: 20;">
                                        <div class="sidebar__inner"><p class="title-block"><span>Giỏ hàng</span></p>
                                            <div class="product-contaniner">
                                                <div class="items-cart">
                                                    <div id="form-update-cart" class="cart_listheader">

                                                        <?php if (isset($list_product) && is_array($list_product) && count($list_product)) {
                                                            foreach ($list_product as $key => $val) { ?>
                                                                <?php echo htmlItemCart($val); ?>
                                                            <?php } ?>
                                                        <?php } ?>

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
                                                <div class="price-container">
                                                    <div class="voucher-block">
                                                        <div id="discount-coupon-form">
                                                            <div class="uk-grid uk-grid-small mb10">

                                                                <div class="uk-width-2-5">

                                                                    <div class="js_list_coupon">

                                                                        <?php if (isset($cart['list_coupon']) && is_array($cart['list_coupon']) && count($cart['list_coupon'])) { ?>

                                                                            <?php foreach ($cart['list_coupon'] as $key => $value) { ?>

                                                                                <div style="margin-bottom: 10px"><?php echo '<b>Mã ' . $key . '</b>: ' . $value['promo_detail'] ?>

                                                                                    <a href="javascripot:void(0)"
                                                                                       data-coupon="<?php echo $key ?>"
                                                                                       style="color: red"
                                                                                       class="js_del_coupon_payment">Xóa</a>

                                                                                </div>

                                                                            <?php }

                                                                        } ?>

                                                                    </div>

                                                                </div>


                                                            </div>
                                                            <div class="pull-left">
                                                                <input type="text" name="coupon"
                                                                       class="js_input_coupon_payment" id="coupon_code"
                                                                       placeholder="Nhập mã giảm giá">
                                                            </div>
                                                            <div class="pull-right price-right">
                                                                <button type="button"
                                                                        class="coupon_button js_btn_coupon_payment">Áp
                                                                    dụng
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="price-block product">
                                                        <div class="pull-left label-price">Giá tạm tính</div>
                                                        <div class="pull-right price-right"><span
                                                                    class="price cart_totalprice"><?php echo addCommas($this->cart->total()) ?>&nbsp;đ</span>
                                                        </div>
                                                    </div>
                                                    <div class="price-block product">
                                                        <div class="pull-left label-price">Khuyến mại</div>
                                                        <div class="pull-right price-right"><span
                                                                    class="price js_discount_coupon"><?php echo $discount_coupon ?>&nbsp;đ</span>
                                                        </div>
                                                    </div>
                                                    <div class="price-block grand">
                                                        <div class="pull-left label-price">Thành tiền</div>
                                                        <div class="pull-right"><!---->
                                                            <div class="grand-total price-right cart_total_counpon"><?php echo $total_cart_coupon ?>
                                                                &nbsp;đ
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

        </div>
    </div>
</main>
<script>
    $('.btn-loading').hide();

    $(".formCheckout").submit(function (e) {

        $('.btn-checkout').hide();
        $('.btn-loading').show();

    });
</script>
<style>
    .inner .js_del_coupon_payment {
        color: red;
        text-decoration: revert;
    }
</style>


<script>
    jQuery('.js_update_quantity').keyup(function () {
        this.value = this.value.replace(/[^0-9\.]/g, '');
    });
</script>
<script>
    function number_format(number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
</script>
<style>
    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .alert {
        position: relative;
        padding: .75rem 1.25rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: .25rem;
    }
</style>


