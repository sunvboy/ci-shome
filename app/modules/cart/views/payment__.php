<div id="show_flashdata_frontend" style="display: none;"></div>

<div class="banner" data-header="">
    <div class="wrap">
        <div class="shop logo logo--center">

            <a href="<?php echo base_url()?>">
                <img class="logo__image  logo__image--medium " alt="<?php echo $this->fcSystem['homepage_company']?>" src="<?php echo $this->fcSystem['homepage_logoFooter']?>">
            </a>

        </div>
    </div>
</div>
<button class="order-summary-toggle" bind-event-click="Bizweb.StoreCheckout.toggleOrderSummary(this)">
    <div class="wrap">
        <h2>
            <label class="control-label">Đơn hàng</label>
            <label class="control-label hidden-small-device">
                (2 phẩm)
            </label>
            <label class="control-label visible-small-device inline">
                (2)
            </label>
        </h2>

    </div>
</button>
<form method="post" action="" data-toggle="validator" class="content stateful-form formCheckout">
    <div class="wrap">
        <div class="sidebar">
            <div class="sidebar_header">
                <h2>
                    <label class="control-label">Đơn hàng (2 sản phẩm)</label>
                </h2>
                <hr class="full_width">
            </div>
            <div class="sidebar__content">
                <div class="order-summary order-summary--product-list ">
                    <div class="summary-body summary-section summary-product">
                        <div class="summary-product-list">
                            <table class="product-table">
                                <tbody>

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

                                        $image = getthumb(
                                            ($versionImage != '')
                                                ? $versionImage
                                                : $val['detail']['image']
                                        );

                                        // $title =  $val['detail']['title'].' '.((isset($val['version']['title'])) ? $val['version']['title'] : '');
                                        $title = $val['detail']['title'];

                                        $href = rewrite_url($val['detail']['canonical']);
                                        $content = $val['content'];
                                        $description_litter = cutnchar(strip_tags($val['detail']['description']), 400);
                                        $price_final = getPriceFinal($val['detail'], true);
                                        $money_row = $price_final * $quantity;
                                        $money_row = addCommas($money_row);
                                        ?>

                                        <tr class="product product-has-image clearfix">
                                            <td>
                                                <div class="product-thumbnail">
                                                    <div class="product-thumbnail__wrapper">

                                                        <img src="<?php echo $image?>" class="product-thumbnail__image" alt="<?php echo $title ?>">

                                                    </div>
                                                    <span class="product-thumbnail__quantity" aria-hidden="true"><?php echo $quantity ?></span>
                                                </div>
                                            </td>
                                            <td class="product-info">
                                                <span class="product-info-name"><?php echo $title ?></span>

                                            </td>
                                            <td class="product-price text-right">
                                                <?php echo $money_row ?>₫
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>

                                </tbody>
                            </table>
                            <div class="order-summary__scroll-indicator">
                                Cuộn chuột để xem thêm
                                <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <hr class="m0">
                </div>

                <div class="order-summary order-summary--total-lines">
                    <div class="summary-section border-top-none--mobile">
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


                        <div class="total-line total-line-total clearfix" style="border-top: 0px">
                                <span class="total-line-name pull-left">
                                    Tổng cộng
                                </span>
                            <span class="total-line-price pull-right" id="price_tt">
                                    <?php echo $total_cart_coupon ?>₫
                                </span>
                        </div>
                    </div>
                </div>
                <div class="form-group clearfix hidden-sm hidden-xs ">
                    <div class="field__input-btn-wrapper mt10">
                        <a class="previous-link " href="javascript:void(0)" onclick="goBack()">
                            <i class="fa fa-angle-left fa-lg" aria-hidden="true"></i>
                            <span>Quay về</span>
                        </a>
                        <input class="btn btn-primary btn-checkout" type="submit" name="create" value="ĐẶT HÀNG">
                        <input class="btn btn-primary btn-loading" value="DỮ LIỆU ĐANG ĐƯỢC XỬ LÝ..." style="display: none;">

                    </div>
                </div>

            </div>
        </div>
        <div class="main" role="main">
            <div class="main_header">
                <div class="shop logo logo--center">

                    <a href="<?php echo base_url()?>">
                        <img class="logo__image  logo__image--medium " alt="<?php echo $this->fcSystem['homepage_company']?>" src="<?php echo $this->fcSystem['homepage_logoFooter']?>">
                    </a>

                </div>
            </div>
            <div class="main_content">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="section" define="{billing_address: {&quot;address1&quot;:null,&quot;address2&quot;:null,&quot;city&quot;:&quot;&quot;,&quot;company&quot;:null,&quot;country&quot;:&quot;Việt Nam&quot;,&quot;first_name&quot;:null,&quot;last_name&quot;:null,&quot;name&quot;:&quot;&quot;,&quot;full_name&quot;:&quot;&quot;,&quot;phone&quot;:null,&quot;phone_number&quot;:null,&quot;province&quot;:&quot;&quot;,&quot;province_code&quot;:&quot;&quot;,&quot;district&quot;:&quot;&quot;,&quot;district_code&quot;:&quot;&quot;,&quot;ward&quot;:&quot;&quot;,&quot;ward_code&quot;:&quot;&quot;,&quot;zip&quot;:null,&quot;country_code&quot;:&quot;VN&quot;}}">
                            <div class="section__header">
                                <div class="layout-flex layout-flex--wrap">
                                    <h2 class="section__title layout-flex__item layout-flex__item--stretch">
                                        <i class="fa fa-id-card-o fa-lg section__title--icon hidden-md hidden-lg" aria-hidden="true"></i>
                                        <label class="control-label">Thông tin mua hàng</label>
                                    </h2>
                                </div>
                            </div>
                            <div class="section__content">
                                <?php $error = validation_errors(); echo !empty($error)?'<div class="alert alert-danger">'.$error.'</div>':'';?>


                                <div class="form-group">
                                    <label class="field__input-wrapper">
                                        <?php echo form_input('email', set_value('email'), 'class="field__input form-control" placeholder="Nhập địa chỉ Email, không bắt buộc" autocomplete="off"'); ?>

                                    </label>

                                </div>

                                <div class="billing">
                                    <div>
                                        <div class="form-group">
                                            <div class="field__input-wrapper">
                                                <?php echo form_input('fullname', set_value('fullname'), 'class="field__input form-control" autocomplete="off" placeholder="Họ và tên"'); ?>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="field__input-wrapper">
                                                <?php echo form_input('phone', set_value('phone'), 'class="field__input form-control" autocomplete="off" placeholder="Số điện thoại"'); ?>

                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="field__input-wrapper">
                                                <?php echo form_input('address_detail', set_value('address_detail'), 'class="field__input form-control" placeholder="Nhập địa chỉ đầy đủ: Số nhà, tên đường" autocomplete="off"'); ?>

                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="field__input-wrapper field__input-wrapper--select">
                                                <?php
                                                $listCity = getLocation(array(
                                                    'select' => 'name, provinceid',
                                                    'table' => 'vn_province',
                                                    'field' => 'provinceid',
                                                    'text' => 'Chọn Tỉnh/Thành Phố'
                                                ));
                                                ?>
                                                <?php echo form_dropdown('cityid', $listCity, '', 'class="field__input field__input--select form-control filter-dropdown"  id="city" placeholder="" autocomplete="off"');?>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="field__input-wrapper field__input-wrapper--select">


                                                <select name="districtid" id="district" class="field__input field__input--select form-control filter-dropdown location">
                                                    <option value="">Chọn Quận/Huyện</option>
                                                </select>

                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            var cityid = '<?php echo $this->input->post('cityid'); ?>';
                            var districtid = '<?php echo $this->input->post('districtid') ?>';
                            var wardid = '<?php echo $this->input->post('wardid') ?>';
                        </script>
                        <div class="section">
                            <div class="section__content">
                                <div class="form-group m0">
                                    <div>
                                        <label class="field__input-wrapper" style="border: none">
                                            <?php echo form_textarea('note', set_value('note'), 'class="field__input form-control m0" placeholder="Hãy để lại lời nhắn" autocomplete="off"');?>

                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">

                        <div class="section payment-methods">
                            <div class="section__header">
                                <h2 class="section__title">
                                    <i class="fa fa-credit-card fa-lg section__title--icon hidden-md hidden-lg" aria-hidden="true"></i>
                                    <label class="control-label">Thanh toán</label>
                                </h2>
                            </div>
                            <div class="section__content">
                                <div class="content-box">

                                    <div class="content-box__row">
                                        <div class="radio-wrapper">
                                            <div class="radio__input">
                                                <input class="input-radio" type="radio" value="Thanh toán khi giao hàng (COD)" name="payment" id="payment_method_439881" checked="">
                                            </div>
                                            <label class="radio__label" for="payment_method_439881">
                                                <span class="radio__label__primary">Thanh toán khi giao hàng (COD)</span>

                                            </label>
                                        </div>
                                        <!-- /radio-wrapper-->
                                    </div>
                                    <div class="content-box__row">
                                        <div class="radio-wrapper">
                                            <div class="radio__input">
                                                <input class="input-radio" type="radio" value="Chuyển khoản qua ngân hàng" name="payment" id="payment_method_ck">
                                            </div>
                                            <label class="radio__label" for="payment_method_ck">
                                                <span class="radio__label__primary">Chuyển khoản qua ngân hàng</span>
                                            </label>
                                        </div>
                                        <!-- /radio-wrapper-->
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="section hidden-md hidden-lg">

                            <div class="text-center mt20">
                                <a class="previous-link" href="javascript:void(0)" onclick="goBack()">
                                    <i class="fa fa-angle-left fa-lg" aria-hidden="true"></i>
                                    <span>Quay về </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</form>
<script src="template/cart/js/jquery-2.1.3.min.js?20171025" type="text/javascript"></script>
<script src="template/cart/js/bootstrap.min.js?20171025" type="text/javascript"></script>
<script>
    $('.btn-loading').hide();

    $(".formCheckout").submit(function(e) {

        $('.btn-checkout').hide();
        $('.btn-loading').show();

    });
</script>
<script>
    $('.error').hide();
    $('#apply_gift_code').click(function(){
        var giftcode = $('input[name="discount_code"]').val();
        $.post('http://tenzi.ovn-admin.vn/products/ajax/cart/apply_gift_code.html', {
            giftcode: giftcode
        },function(data){
            var json = JSON.parse(data);
            $('.error').show();
            if(json.error.length){
                $('#giftcode_value').addClass('d-none').attr('data-type', json.typeoff).attr('data-value', json.result).attr('data-price', json.price);
                $('.error').removeClass('alert alert-success').addClass('alert alert-danger');
                $('.error').html('').html(json.error);
            }else{
                $('#giftcode_value').removeClass('d-none').attr('data-type', json.typeoff).attr('data-value', json.result).attr('data-price', json.price);
                $('#giftcode-uppercase').html('-' + number_format(json.price, 0, '.', '.')+ ' đ');
                $('#giftcode_value').find('input').attr('value', json.price);
                $('.error').removeClass('alert alert-danger').addClass('alert alert-success');
                $('.error').html('').html(json.message);
            }
            load_total_price_cart();
        });
        return false;
    });
    function load_total_price_cart(){
        var giftcode = parseInt($('input[name="giftcode_value"]').val());
        var total = parseInt($('#total_cart_money').val());
        $('#price_tt').html(number_format(( total  - giftcode ), 0, '.', '.')+' đ');
        $('#total_total').attr('value', (total  - giftcode));
    }

</script>
<script>
    function number_format (number, decimals, dec_point, thousands_sep) {
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
<script type="text/javascript">
    function goBack() {
        window.history.back()
    }
    $(document).ready(function () {


        $("input:checkbox").on('click', function() {
            var $box = $(this);
            if ($box.is(":checked")) {
                var group = "input:checkbox[name='" + $box.attr("name") + "']";
                $(group).prop("checked", false);
                $box.prop("checked", true);
            } else {
                $box.prop("checked", false);
            }
        });
    });
</script>
<script>
    setTimeout(function(){
        jQuery('#show_flashdata_frontend').fadeOut().empty();
    }, 5000);
</script>
<style>
    #show_flashdata_frontend{
        position: fixed;
        right: 0px;
        top: 100px;
        z-index: 999999;
    }
</style>
