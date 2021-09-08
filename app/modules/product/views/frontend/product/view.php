<?php
$prd_title = $productDetail['title'];
$prd_code = $productDetail['code'];
$prd_info = getPriceFrontend(array('productDetail' => $productDetail));

$prd_href = rewrite_url($productDetail['canonical']);
$comment = comment(array('id' => $productDetail['id'], 'module' => 'product'));
$prd_rate = $totalComment = 0;
if (isset($comment) && is_array($comment) && count($comment)) {
    $prd_rate = round($comment['statisticalRating']['averagePoint']);
    $totalComment = $comment['statisticalRating']['totalComment'];
}

$list_image = json_decode(base64_decode($productDetail['image_json']), TRUE);
?>
<div id="js_prd_info" data-info="<?php echo $data_info ?>"
     data-price="<?php echo $productDetail['price'] ?>"
     data-id="<?php echo $productDetail['id'] ?>"
     data-name="<?php echo $productDetail['title'] ?>"
     data-redirect="true">

</div>
<div id="quantity" data-quantity="1"></div>

<script>
    $("body").removeAttr('class');
    $("body").attr('class', "page-product-configurable catalog-product-view product-nem-foam-tempur-original-prima page-layout-1column add-padding-header loading-active-12 loading-actived");
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"/>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<div class="wrapper-breadcrums">
    <div class="breadcrumbs">
        <ul class="items">
            <li class="item home">
                <a href="<?php echo base_url() ?>">Trang chủ </a>
            </li>
            <?php foreach ($breadcrumb as $key => $val) { ?>
                <?php
                $title = $val['title'];
                $href = rewrite_url($val['canonical'], true, true);
                ?>
                <li class="<?php if ($key == count($breadcrumb) - 1) echo 'uk-active'; ?>"><a
                            href="<?php echo $href; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
<main id="maincontent" class="page-main" style="max-width: 100%">

    <div class="columns">
        <div class="column main">
            <div class="product-main-content">
                <div id="product-detail"><!---->
                    <div>
                        <div id="product-detail-main-content" class="product-detail-main-content">
                            <div  class="form-addtocart"><!---->
                                <div class="product-detail-first-block">
                                    <div class="block-detail-top" style="width: 100%;max-width: 100%">

                                        <div class="col-md-5 col-sm-12 col-xs-12">
                                            <div class="column-left">
                                                <div class="product-images">
                                                    <div class="product-image-single"><!---->
                                                        <div class="item image"><img
                                                                    src="<?php echo $productDetail['image']; ?>"
                                                                    style="height: 396.6px;object-fit: contain">
                                                        </div>
                                                    </div>
                                                    <div class="product-image-thumbnail">
                                                        <?php if (isset($list_image) && is_array($list_image) && count($list_image)) { ?>
                                                            <?php foreach ($list_image as $key => $val) {
                                                                if ($key <= 3) { ?>
                                                                    <a class="item-image" data-fancybox="gallery"
                                                                       href="<?php echo $val; ?>">
                                                                        <img class="image-thumbs-effect"
                                                                             src="<?php echo $val; ?>"
                                                                             style="height: 67px;object-fit: cover">
                                                                    </a>
                                                                <?php } else if ($key == 4) { ?>

                                                                    <a class="item-image" data-fancybox="gallery"
                                                                       href="<?php echo $val; ?>">
                                                                        <img class="image-thumbs"
                                                                             src="<?php echo $val; ?>"
                                                                             style="height: 67px;object-fit: cover">

                                                                        <div class="view-more-image">
                                                                            <span>Xem tất cả<p>(<?php echo count($list_image) ?>)</p></span>
                                                                        </div>
                                                                    </a>
                                                                <?php } ?>


                                                            <?php }
                                                        } ?>


                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-7 col-xs-12">
                                            <div class="product-detail">
                                                <h1 class="title"><?php echo $productDetail['title']; ?></h1>

                                                <div class="intro">
                                                    <div class="star">
                                                        <a href="<?php echo $canonical ?>#reviews" class="empty-review"><img src="template/frontend/images/pencil.svg"  alt="Viết nhận xét"> Viết nhận xét
                                                        </a>
                                                    </div>
                                                    <div class="product-brand">
                                                        <div>Hãng: <a href="javascript:void(0)"><?php echo $productDetail['thuonghieu'] ?></a></div>
                                                    </div>
                                                    <div class="product-key">Mã sản phẩm:<span><?php echo $productDetail['code']; ?></span></div>
                                                </div>
                                                <div class="price-status active-freeship">
                                                    <div class="price-freeship">
                                                        <div class="final-price"><span class="price"><del><span><?php echo $prd_info['price_old'] ?></span></del><?php echo $prd_info['price_final'] ?></span>
                                                        </div> <!---->
                                                    </div>
                                                    <div class="freeship-product">Freeship</div>
                                                </div>
                                                <div class="textprice-detail-product"><p style="margin-bottom: 0px"><?php echo $this->fcSystem['title_title_9']?></p></div>
                                                <?php $getKM = $this->Autoload_Model->_get_where(array(
                                                    'select' => 'id,  catalogue, title, canonical, created, image_json, (SELECT fullname FROM user WHERE user.id = promotional.userid_created) as user_created, module, start_date, end_date, publish, discount_type, discount_value, condition_value, condition_type, freeship, freeshipAll, condition_value_1, condition_type_1, use_common, code, limmit_code, cityid, discount_moduleid, hightlight',
                                                    'table' => 'promotional',
                                                    'where' => array('publish' => 1),
                                                ));
                                                if (!empty($getKM)) {
                                                    $promotional1 = json_decode(getPromotional($getKM), true);
                                                    ?>
                                                    <div class="block-discounts">
                                                        <div class="block-discount">
                                                            Nhập <span><?php echo $getKM['code'] ?></span>:&nbsp;
                                                            <?php echo $promotional1['detail'] ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                                <div class="product attibute overview">
                                                    <div class="options-attribute-product">
                                                        <div class="product-option-mobile-top">
                                                            <?php echo $this->load->view('product/frontend/product/folder/attrSELECT') ?>

                                                            <div class="number-product-block"></div>
                                                        </div>
                                                    </div>

                                                    <div class="number-qty hidden">
                                                        <div class="plus-minus-box">
                                                            <label for="input-group-field"
                                                                   class="label-status"><span>Số lượng</span></label>
                                                            <div class="input-group plus-minus-input">
                                                                <div class="input-group-button">
                                                                    <button type="button"
                                                                            class="button hollow circle minus js_quantity_minus">
                                                                        <i aria-hidden="true"
                                                                           class="fa fa-minus"></i>
                                                                    </button>
                                                                    <input id="input-group-field" type="number"
                                                                           name="quantity" min="1" max="5" value="1"
                                                                           class="qty-input js_quantity">

                                                                    <button type="button"
                                                                            class="button hollow circle plus js_quantity_plus">
                                                                        <i aria-hidden="true"
                                                                           class="fa fa-plus"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="status">Tình trạng: <span
                                                                    class="instock"><span><?php if ($productDetail['highlight'] == 0) { ?>Còn hàng<?php } else if ($productDetail['highlight'] == 1) { ?>
                                                                        <span style="color: red">Hết hàng</span><?php } ?></span></span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <?php if ($productDetail['highlight'] == 0) { ?>

                                                            <div class="actions" style="margin-top: 0px">
                                                                <div class="button-action hidden">
                                                                    <button type="button" title="MUA NGAY" class="set-paymentmethod">Mua trả góp 0%
                                                                        <span>Trả góp qua thẻ tín dụng</span>
                                                                    </button>
                                                                    <button type="button" title="MUA NGAY" class="set-paymentmethod">Thanh toán VNPAY <span>ATM nội địa | QRcode</span>
                                                                    </button>
                                                                </div>

                                                                <div class="button-actions">
                                                                    <button type="button" title="MUA NGAY" id="buy-now" class="js_buy" data-price="<?php echo $productDetail['price'] ?>">
                                                                        <div class="text"><!---->
                                                                            Mua ngay<span>Thanh toán tiền mặt khi nhận hàng tại nhà</span>
                                                                        </div>
                                                                    </button>
                                                                </div>
                                                                <div style="clear: both"></div>
                                                                <a href="tel:<?php echo $this->fcSystem['contact_hotline'] ?>"
                                                                   class="btn btn_phone" type="button"><span>Liên hệ trực tiếp để có giá tốt hơn</span></a>
                                                                <div style="clear: both"></div>

                                                                <div class="box_support">
                                                                    <p class="hotline">CHƯƠNG TRÌNH KHUYẾN MÃI</p>
                                                                    <a href="javascript:void(0)"><p class="value text-nhapnhay">Giảm tới 70%</p></a>
                                                                    <div class="product-call-requests">
                                                                        <form method="post" name="subscribe_form" id="subscribe_form" action="phone-contact.html">
                                                                            <div class="error"></div>

                                                                            <div style="position: relative">
                                                                                <label class="ty-control-group__title">
                                                                                    <input class="ty-input-text-full cm-number phone" name="phone" size="50" type="tel" maxlength="11"  autocomplete="off" minlength="8" placeholder="Nhập số điện thoại"></label>
                                                                                <button type="submit" class="ty-btn ty-btn cm-call-requests subscribe-btn">
                                                                                    Đăng ký ngay
                                                                                </button>
                                                                            </div>
                                                                            <span class="call-note">Chúng tôi sẽ gọi lại cho quý khách</span>
                                                                        </form>
                                                                    </div>
                                                                </div>

                                                                <div style="clear: both"></div>
                                                                <div class="whotline">
                                                                    <li>
                                                                        <div class="boxx_li">
                                                                            <span>Tổng đài tư vấn (8:00 - 19:00)</span><a
                                                                                    href="tel:<?php echo $this->fcSystem['contact_hotline'] ?>">
                                                                                <p
                                                                                        class="tdtv"><?php echo $this->fcSystem['contact_hotline'] ?></p>
                                                                            </a>

                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="boxx_li">
                                                                            <span>Hotline (24/24)</span><a
                                                                                    href="tel:<?php echo $this->fcSystem['contact_phone'] ?>">
                                                                                <p
                                                                                        class="hotline"><?php echo $this->fcSystem['contact_phone'] ?></p>
                                                                            </a>

                                                                        </div>
                                                                    </li>
                                                                </div>
                                                            </div>

                                                        <?php } else { ?>
                                                            <div>
                                                                <div class="status-outofstock">
                                                                    <div class="button-group-1">
                                                                        <a href="tel:<?php echo $this->fcSystem['contact_hotline'] ?>">
                                                                            <img style="width: 16px;height: auto;"
                                                                                 src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDE2IDI0Ij48Zz48Zz48Zz48cGF0aCBmaWxsPSIjMjkyYmI3IiBkPSJNMTQuNDEgMjEuMzg5bC0xLjUyMyAxLjIzNGExLjcxIDEuNzEgMCAwIDEtMS4yMTYuMzljLTIuMTA0LS4xNzEtNS4yODgtMS44MjMtOC41MDUtOC43MjFDLS4wNTEgNy4zOTMuNzMgMy44OTMgMS45NTIgMi4xN2ExLjcxMyAxLjcxMyAwIDAgMSAxLjA4Mi0uNjgybDEuOTI0LS4zNzNhLjUwNi41MDYgMCAwIDEgLjU4OS4zNzhsLjYyIDIuNTUyLjUyMiAyLjE0YS41MS41MSAwIDAgMS0uMzM3LjYwM2wtMS44MTQuNTg2Yy0uNTUuMTcyLS44OS43MjMtLjc5NyAxLjI5MmwuMDM4LjI0NGMuMTMyLjg3NC4yOTYgMS45NiAxLjQ0NCA0LjQyIDEuMTQ3IDIuNDYgMS44NzQgMy4yODUgMi40NTggMy45NDdsLjE2My4xODdjLjM3Ni40MzcgMS4wMTYuNTMxIDEuNTAyLjIybDEuNjE0LTEuMDEzYS41MS41MSAwIDAgMSAuNjc5LjEzbDIuODYgMy44OTNhLjUwNi41MDYgMCAwIDEtLjA5LjY5M3ptLjYyNS0xLjA4NmwtMi44Ni0zLjg5NGExLjE3MyAxLjE3MyAwIDAgMC0xLjU2NC0uMjk3bC0xLjYxNSAxLjAxNGEuNS41IDAgMCAxLS42NS0uMDkzbC0uMTY2LS4xOTFjLS41NTctLjYzMS0xLjI0OC0xLjQxNi0yLjM1NC0zLjc4OXMtMS4yNjQtMy40MDgtMS4zOS00LjIzOGwtLjAzOC0uMjUxYS41MDEuNTAxIDAgMCAxIC4zNDQtLjU2bDEuODE0LS41ODVjLjU4Mi0uMTkuOTItLjc5NC43NzgtMS4zOUw2LjE5IDEuMzM3YTEuMTY3IDEuMTY3IDAgMCAwLTEuMzU4LS44N0wyLjkwOC44MzhhMi4zNyAyLjM3IDAgMCAwLTEuNDk2Ljk0OUMuMDg5IDMuNjUzLS43ODUgNy4zODUgMi41NjYgMTQuNTcyYzIuNjY1IDUuNzE1IDUuMzc1IDcuOTc4IDcuNTIgOC43NThhNS44NjMgNS44NjMgMCAwIDAgMS41My4zNDEgMi4zNjkgMi4zNjkgMCAwIDAgMS42ODktLjUzNmwxLjUyNC0xLjIzMmExLjE2NyAxLjE2NyAwIDAgMCAuMjA2LTEuNnoiLz48L2c+PGc+PHBhdGggZmlsbD0iIzI5MmJiNyIgZD0iTTExLjU0NCA2LjI1NGE1LjYzMiA1LjYzMiAwIDAgMSAzLjM2MyA3LjIxLjMzLjMzIDAgMSAwIC42MjIuMjI3IDYuMjk0IDYuMjk0IDAgMCAwLTMuNzU4LTguMDYuMzMuMzMgMCAxIDAtLjIyNy42MjN6Ii8+PC9nPjxnPjxwYXRoIGZpbGw9IiMyOTJiYjciIGQ9Ik0xMC44NjUgOC4xMmEzLjY0NCAzLjY0NCAwIDAgMSAyLjE3NiA0LjY2NS4zMy4zMyAwIDEgMCAuNjIyLjIyNiA0LjMwNyA0LjMwNyAwIDAgMC0yLjU3MS01LjUxMy4zMy4zMyAwIDEgMC0uMjI3LjYyMnoiLz48L2c+PGc+PHBhdGggZmlsbD0iIzI5MmJiNyIgZD0iTTEwLjE4NiA5Ljk4NWMuODU4LjMxNCAxLjMgMS4yNjIuOTkgMi4xMjFhLjMzLjMzIDAgMSAwIC42MjEuMjI2IDIuMzIgMi4zMiAwIDAgMC0xLjM4NC0yLjk2OS4zMy4zMyAwIDEgMC0uMjI3LjYyMnoiLz48L2c+PC9nPjwvZz48L3N2Zz4=">
                                                                            <?php echo $this->fcSystem['contact_hotline'] ?>
                                                                        </a>
                                                                        <a href="<?php echo $this->fcSystem['social_facebookm'] ?>"
                                                                           target="_blank"
                                                                           class="button-chat">
                                                                            <img style="width: 16px;height: auto;"
                                                                                 src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyMCIgdmlld0JveD0iMCAwIDI0IDIwIj48Zz48Zz48cGF0aCBmaWxsPSIjMjkyYmI3IiBkPSJNMS44MjIgMy43OTJhMi4yNTcgMi4yNTcgMCAwIDEgMi4yNTUtMi4yNTVoMTUuOWEyLjI1NyAyLjI1NyAwIDAgMSAyLjI1NSAyLjI1NXY4LjIxMmEyLjI1NyAyLjI1NyAwIDAgMS0yLjI1NSAyLjI1NWgtLjI2MWEuODkuODkgMCAwIDAtLjg3NSAxLjA0N2wuNTY4IDMuMTUzLTQuMDItMy44MTVhMS4zOTUgMS4zOTUgMCAwIDAtLjk2NC0uMzg1SDQuMDc3YTIuMjU3IDIuMjU3IDAgMCAxLTIuMjU1LTIuMjU0ek00LjA3Ny41MjVBMy4yNyAzLjI3IDAgMCAwIC44MSAzLjc5MnY4LjIxM2EzLjI3IDMuMjcgMCAwIDAgMy4yNjcgMy4yNjZoMTAuMzQ4Yy4xIDAgLjE5NS4wMzguMjY3LjEwN2w0LjQ4IDQuMjUxYS44MDMuODAzIDAgMCAwIDEuMzQ1LS43MjZsLS42NTQtMy42MzJoLjExNGEzLjI3IDMuMjcgMCAwIDAgMy4yNjctMy4yNjZWMy43OTJBMy4yNyAzLjI3IDAgMCAwIDE5Ljk3Ny41MjVoLTE1Ljl6Ii8+PC9nPjwvZz48L3N2Zz4=">
                                                                            Gửi tin nhắn
                                                                        </a>
                                                                    </div>

                                                                    <div class="number-phone">
                                                                        <p class="title-head">HẾT Hàng</p>
                                                                        <p>Gọi/chat với chúng tôi để nhận tư vấn
                                                                            thêm</p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        <?php } ?>

                                                    </div>


                                                </div>

                                            </div>

                                        </div>
                                        <div class="col-md-3 col-sm-5 col-xs-12">
                                            <?php
                                            $listAddress = $this->Autoload_Model->_get_where(array(
                                                'table' => 'support',
                                                'select' => 'address,fullname,lat,long,cityid,(SELECT name FROM vn_province WHERE support.cityid = vn_province.provinceid) as address_city',
                                                'where' => array('publish' => 0),
                                                'where_in_field' => json_decode($productDetail['store'], TRUE),
                                                'where_in' => 'id',
                                            ), true);

                                            ?>
                                            <?php if (isset($listAddress) && count($listAddress) && is_array($listAddress)) { ?>

                                                <div class="map-bt">
                                                    <div class="label">Hệ
                                                        thống <?php echo $this->fcSystem['homepage_brandname'] ?>
                                                        gần bạn:
                                                    </div>
                                                    <div class="scroll-map-bt" id="locations"
                                                         style="height: 250px; transition-duration: 3s;">


                                                        <?php foreach ($listAddress as $k => $v) { ?>
                                                            <div class="list-see"
                                                                 data-latlon="21.281831, 106.197414">
                                                                <div class="box-see-more-news"><i
                                                                            class="fa fa-map-marker"></i>
                                                                    <a href="https://www.google.com/maps/dir/__origLatitude__,__origLongitude__/<?php echo $v['lat'] ?>,<?php echo $v['long'] ?>/@<?php echo $v['lat'] ?>,<?php echo $v['long'] ?>"

                                                                       target="_blank">
                                                                        <div class="box-see-text"><p>
                                                                                SHOWROOM <?php echo $v['fullname'] ?>
                                                                                <br>
                                                                                Địa chỉ: <?php echo $v['address'] ?>
                                                                            </p>
                                                                        </div>
                                                                    </a></div>
                                                            </div>
                                                        <?php } ?>


                                                    </div>

                                                </div>
                                            <?php } ?>
                                            <div style="clear: both"></div>
                                            <?php
                                            $slide_loiich = slide(array('keyword' => 'loi-ich'), $this->fc_lang);

                                            ?>
                                            <?php if (isset($slide_loiich) && is_array($slide_loiich) && count($slide_loiich)) { ?>

                                                <div class="why-buy">
                                                    <div class="label">Lợi ích khi mua hàng
                                                        tại <?php echo $this->fcSystem['homepage_brandname'] ?>
                                                    </div>
                                                    <div style="clear: both"></div>

                                                    <div class="wsupport-s">
                                                        <?php foreach ($slide_loiich as $key => $val) { ?>
                                                            <li>
                                                                <img src="<?php echo $val['src'] ?>"
                                                                     alt=" <?php echo $val['title'] ?>">
                                                                <p> <?php echo $val['title'] ?> </p></li>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                        </div>

                                    </div>

                                </div>
                                <div style="clear: both"></div>
                                <?php $total = 0; $listUudai = json_decode($productDetail['albums'],TRUE);?>
                                <?php if(isset($listUudai) && count($listUudai) && is_array($listUudai)){  if (!empty($listUudai[0]['title'])) {?>
                                    <div class="f lqt">
                                        <div class="fl lqt-tit flexCen">
                                            <p><b>Nhận quà tại showroom cho đơn hàng tương ứng</b>Khi mua <?php echo $productDetail['title']?></p>
                                            <span>TẶNG</span>
                                        </div>
                                        <div class="fl lqt-data flexJus">



                                            <?php foreach ($listUudai as $k=>$v){   if (empty($v['description'])) continue;
                                             $total += (int)trim($v['description']);?>
                                                <a href="javascript:void(0)" rel="nofollow" title="<?php echo $v['title']?>">
                                                    <div>
                                                        <h5><?php echo $v['title']?></h5>
                                                        <p>Trị giá <span><?php echo number_format(trim($v['description']),'0',',','.')?>₫</span></p>
                                                        <img src="<?php echo $v['images']?>" alt="<?php echo $v['title']?>"></div>
                                                </a>
                                            <?php }?>

                                        </div>
                                        <div class="fl lqt-total flexCen">
                                            <p>Tổng giá trị quà tặng<b><?php echo number_format($total,'0',',','.')?>₫</b></p>
                                        </div>
                                    </div>
                                <?php }?>
                                <?php }?>
                            </div>
                            <div class="overlay-option"></div>
                        </div>
                        <div id="product-detail-product-info-detail" class="product-detail-product-info-detail">


                            <div class="product-info-detailed">

                                <div class="main-column">






                                    <div class="main-description-product">
                                        <div class="head-block"><h2 class="title-block">Đặc điểm sản phẩm</h2></div>
                                        <div class="content-block main-description">

                                            <?php
                                            $attrold = $this->Autoload_Model->_get_where(array(
                                                'select' => 'attribute.id ,attribute.title,(SELECT title FROM attribute_catalogue WHERE attribute.catalogueid = attribute_catalogue.id) as titleC,(SELECT ishome FROM attribute_catalogue WHERE attribute.catalogueid = attribute_catalogue.id) as ishomeC',
                                                'table' => 'attribute_relationship',
                                                'join' => array(
                                                    array('attribute', 'attribute.id = attribute_relationship.attrid', 'right'),
                                                    array('attribute_catalogue', 'attribute_catalogue.id = attribute.catalogueid', 'right'),
                                                ),
                                                'where' => array(
                                                    'attribute_catalogue.highlight' => 1,
                                                    'attribute.publish' => 0,
                                                    'attribute_relationship.module' => 'product',
                                                    'attribute_relationship.moduleid' => $productDetail['id'],
                                                ),
                                            ), true);
                                            ?>

                                            <?php
                                            if (isset($attrold) && count($attrold) && is_array($attrold)) {
                                                $attrFinal = groupValue($attrold, 'titleC');
                                            }
                                            ?>
                                            <?php if (isset($attrFinal) && count($attrFinal) && is_array($attrFinal)) { ?>

                                                <div class="additional-attributes-product">
                                                    <div class="content-blocks">
                                                        <div class="additional-attributes">

                                                            <?php foreach ($attrFinal as $k => $v) { ?>
                                                                <div class="attribute-item">
                                                                    <div class="col label">
                                                                        <span><?php echo $k ?></span>
                                                                    </div>
                                                                    <div class="col data">
                                                                        <?php $i = 0;
                                                                        foreach ($v as $kp => $vp) {
                                                                            $i++; ?>
                                                                            <?php echo $vp['title'] ?>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>

                                                            <?php } ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>


                                            <div class="description-view-content cọntent-desctiption hide-content">
                                                <div class="cọntent-desctiptions">

                                                    <?php if ($productDetail['description'] != '') { ?>
                                                        <section class="section">
                                                            <div class="section-content relative">
                                                                <?php echo $productDetail['description']; ?>
                                                            </div>
                                                        </section>
                                                    <?php } ?>
                                                    <?php if ($productDetail['content'] != '') { ?>
                                                        <section class="section information-product">

                                                            <div class="section-content relative">
                                                                <div class="item-des-product">
                                                                    <?php echo $productDetail['content']; ?>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    <?php } ?>
                                                    <style xml="space">
                                                        table {
                                                            width: 100% !important;
                                                        }

                                                        .item-des-product img, section-content. img {
                                                            max-width: 100% !important;
                                                            height: auto !important;
                                                        }

                                                        <!--
                                                        .additional-attributes-wrapper.table-wrapper {
                                                            display: none;
                                                        }

                                                        .product.attribute.description {
                                                            width: 100%;
                                                            font-family: "Open Sans", sans-serif;
                                                        }

                                                        .product.attribute.description [class*="col-"] {
                                                            position: relative;
                                                            margin: 0;
                                                            padding: 0 15px;
                                                            width: 100%;
                                                        }

                                                        .product.attribute.description .row {
                                                            width: 100%;
                                                            margin: 0;
                                                            -js-display: flex;
                                                            display: -ms-flexbox;
                                                            display: flex;
                                                            -ms-flex-flow: row wrap;
                                                            flex-flow: row wrap;
                                                            -ms-flex-align: center !important;
                                                            align-items: center !important;
                                                            -ms-flex-item-align: center !important;
                                                            -ms-grid-row-align: center !important;
                                                            align-self: center !important;
                                                            vertical-align: middle !important;
                                                        }

                                                        .col-3 {
                                                            -webkit-box-flex: 0;
                                                            -ms-flex: 0 0 25%;
                                                            flex: 0 0 25%;
                                                            max-width: 25%;
                                                        }

                                                        .col-4 {
                                                            -webkit-box-flex: 0;
                                                            -ms-flex: 0 0 33.333%;
                                                            flex: 0 0 33.333%;
                                                            max-width: 33.333%;
                                                        }

                                                        .col-9 {
                                                            -webkit-box-flex: 0;
                                                            -ms-flex: 0 0 75%;
                                                            flex: 0 0 75%;
                                                            max-width: 75%;
                                                        }

                                                        .service-product {
                                                            width: 70%;
                                                            margin: 0 auto;
                                                        }

                                                        .title-product {
                                                            text-align: center
                                                        }

                                                        .title-product h3 {
                                                            font-size: 20px;
                                                            font-weight: 600;
                                                        }

                                                        .more-infor .box-text {
                                                            padding: 10px
                                                        }

                                                        .more-infor .box-text h4 {
                                                            margin-bottom: 0;
                                                            font-weight: 500;
                                                        }

                                                        .service-product .box-image {
                                                            margin: 0 auto;
                                                        }

                                                        .service-product .box-text-inner {
                                                            margin-top: 10px
                                                        }

                                                        .service-product p {
                                                            margin: 0
                                                        }

                                                        .information-product .section-title {
                                                            text-align: center;
                                                            z-index: 9;
                                                            font-size: 20px;
                                                            font-weight: 600;
                                                            color: #555;
                                                            text-transform: uppercase;
                                                            position: relative;
                                                        }

                                                        .information-product .section-title:before, .information-product .section-title:after {
                                                            content: "";
                                                            display: block;
                                                            width: 25%;
                                                            height: 2px;
                                                            opacity: .1;
                                                            background-color: currentColor;
                                                            position: absolute;
                                                            top: 12px;
                                                        }

                                                        .information-product .section-title:after {
                                                            right: 0;
                                                        }

                                                        .information-product .section-content {
                                                            margin: 20px 0;
                                                            color: #333;
                                                        }

                                                        .information-product .section-content .item-des-product:not(:last-child) {
                                                            border-bottom: 2px solid #eee;
                                                            margin-bottom: 30px
                                                        }

                                                        .information-product .section-content .item-des-product .label-product {
                                                            font-weight: 400;
                                                            font-family: "Open Sans", sans-serif;
                                                            font-size: 26px;

                                                        }

                                                        .information-product .section-content .item-des-product .roimportantw {
                                                            -ms-flex-align: center;
                                                            align-items: center;
                                                            -ms-flex-item-align: center;
                                                            -ms-grid-row-align: center;
                                                            align-self: center;
                                                            vertical-align: middle;
                                                        }

                                                        .information-product .section-content .item-des-product .des-product {
                                                            font-size: 16px;
                                                            line-height: 25px
                                                        }

                                                        .information-product .section-content .item-des-product .des-product b {
                                                            font-weight: 600;
                                                        }

                                                        @media (max-width: 767px) {
                                                            .information-product .section-content .item-des-product:not(:last-child) {
                                                                padding-bottom: 30px;
                                                            }

                                                            .product.attribute.description [class*="col-"] {
                                                                padding: 0 8px;
                                                            }

                                                            .item-service {
                                                                display: none;
                                                            }

                                                            .col-mobile {
                                                                -webkit-box-flex: 0;
                                                                -ms-flex: 0 0 100%;
                                                                flex: 0 0 100%;
                                                                max-width: 100%;
                                                            }

                                                            .information-product .section-content {
                                                                margin: 30px 0;
                                                            }
                                                        }

                                                        @media (max-width: 767px) and (min-width: 480px) {
                                                            .more-infor {
                                                                display: none;
                                                            }
                                                        }

                                                        @media (max-width: 479px ) {
                                                            .col-small-mobile {
                                                                -webkit-box-flex: 0;
                                                                -ms-flex: 0 0 100%;
                                                                flex: 0 0 100%;
                                                                max-width: 100%;
                                                            }

                                                        }

                                                        --></style>
                                                </div>
                                            </div>
                                            <div class="load-more view-mores">
                                                <div class="background-loadmore"></div>
                                                <a class="learn-more"><span class="circle"><span
                                                                class="icon arrow"></span></span> <span
                                                            class="button-text">Xem thêm</span></a>
                                            </div>
                                        </div>
                                    </div>



                                    <div id="col_qu" style="width: 100%;background: #fff;    float: left;">
                                        <?php echo $this->load->view('product/frontend/product/folder/comment') ?>
                                    </div>

                                    <?php if (isset($relaList) && is_array($relaList) && count($relaList)) { ?>
                                        <div class="product-features widget block block-static-block">
                                            <div>
                                                <div class="head-block"><h2 class="title-block font-bold-stag">SẢN
                                                        PHẨM BÁN
                                                        CHẠY</h2></div>
                                                <div class="content-block block-products-list">
                                                    <div class="style-2 products-grid slick-initialized">

                                                        <?php foreach ($relaList as $keyPost => $valPost) {
                                                            $title = $valPost['title'];
                                                            $href = rewrite_url($valPost['canonical'], TRUE, TRUE);
                                                            $image = $valPost['image'];
                                                            $getPrice = getPriceFrontend(array('productDetail' => $valPost)); ?>

                                                            <div class="col-md-6">
                                                                <div class="product-items">
                                                                    <div class="product-item"
                                                                         style="border-bottom: 0px">
                                                                        <div class="product-item-info">
                                                                            <div class="cdz-product-top">
                                                                                <a href="<?php echo $href ?>"
                                                                                   tabindex="0">
                                                                                    <img src="<?php echo $image ?>"
                                                                                         alt="<?php echo $title ?>" style="height: 160px;object-fit: contain">
                                                                                </a>
                                                                            </div>
                                                                            <div class="product details product-item-details active-freeship">
                                                                                <h3 class="product-item-link"><a
                                                                                            href="<?php echo $href ?>"
                                                                                            class="product-item-link"
                                                                                            tabindex="0"><?php echo $title ?></a>
                                                                                </h3>
                                                                                <div class="price-freeship">
                                                                                    <div class="price-product price-box price-final_price">
                                                                                        <div class="new-price">
                                                                                            <span class="price"><?php echo $getPrice['price_final'] ?></span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="freeship-product">
                                                                                        Freeship
                                                                                    </div>
                                                                                </div>
                                                                                <div class="view-detail"><a
                                                                                            href="<?php echo $href ?>"
                                                                                            tabindex="0">Mua
                                                                                        Ngay</a></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
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
    $('.v-select-toggle').click(function () {
        $('.v-dropdown-container').hide();
        $(this).parent().find('.v-dropdown-container').show()

    });
    $('.load-more').click(function () {
        $('.description-view-content').removeClass('hide-content');
        $('.load-more').hide();

    });

    $('[data-fancybox="gallery"]').fancybox({

        buttons: [
            "slideShow",
            'fullScreen',
            'thumbs',
            'zoom',
            "close"
        ],


        thumbs: {
            autoStart: true, // Display thumbnails on opening
            hideOnClose: true, // Hide thumbnail grid when closing animation starts
        },

    });
</script>
<style type="text/css">
    *[data-v-138dff1d] {
        box-sizing: border-box;
    }

    input[data-v-138dff1d] {
        width: 100%;
    }

    ul[data-v-138dff1d] {
        font-size: 12px;
        color: #424242;
        text-align: left;
        list-style: none;
        background-color: #fff;
        background-clip: padding-box;
        padding: 0px;
        margin: 2px 0px 0px 0px;
    }

    .v-select[data-v-138dff1d] {
        position: relative;
        width: 100%;
        height: 30px;
        cursor: pointer;
    }

    .v-select.disabled[data-v-138dff1d] {
        cursor: not-allowed;
    }

    .v-select.disabled .v-select-toggle[data-v-138dff1d] {
        background-color: #f8f9fa;
        border-color: #f8f9fa;
        opacity: 0.65;
        cursor: not-allowed;
    }

    .v-select.disabled .v-select-toggle[data-v-138dff1d]:focus {
        outline: 0 !important;
    }

    .v-select-toggle[data-v-138dff1d] {
        display: flex;
        justify-content: space-between;
        user-select: none;
        padding: 0.375rem 0.75rem;
        color: #212529;
        background-color: #f8f9fa;
        border-color: #d3d9df;
        width: 100%;
        text-align: right;
        white-space: nowrap;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 12px;
        font-family: inherit, sans-serif;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: background-color, border-color, box-shadow, 0.15s ease-in-out;
        cursor: pointer;
    }

    .v-select-toggle[data-v-138dff1d]:hover {
        background-color: #e2e6ea;
        border-color: #dae0e5;
    }

    .arrow-down[data-v-138dff1d] {
        display: inline-block;
        width: 0;
        height: 0;
        margin-left: 0.255em;
        margin-top: 7px;
        vertical-align: 0.255em;
        content: "";
        border-top: 0.3em solid;
        border-right: 0.3em solid transparent;
        border-bottom: 0;
        border-left: 0.3em solid transparent;
    }

    .v-dropdown-container[data-v-138dff1d] {
        position: absolute;
        width: 100%;
        background: red;
        padding: 0.5rem 0;
        margin: 0.125rem 0 0;
        color: #212529;
        text-align: left;
        list-style: none;
        background-color: #fff;
        background-clip: padding-box;
        border-radius: 0.25rem;
        border: 1px solid rgba(0, 0, 0, 0.15);
        z-index: 1000;
    }

    .v-dropdown-item[data-v-138dff1d] {
        text-decoration: none;
        line-height: 25px;
        padding: 0.5rem 1.25rem;
        user-select: none;
    }

    .v-dropdown-item[data-v-138dff1d]:hover:not(.default-option) {
        background-color: #f8f9fa;
    }

    .v-dropdown-item.disabled[data-v-138dff1d] {
        color: #9a9b9b;
    }

    .v-dropdown-item.selected[data-v-138dff1d] {
        background-color: #007bff;
        color: #fff;
    }

    .v-dropdown-item.selected[data-v-138dff1d]:hover {
        background-color: #007bff;
        color: #fff;
    }

    .v-dropdown-item.disabled[data-v-138dff1d] {
        cursor: not-allowed;
    }

    .v-dropdown-item.disabled[data-v-138dff1d]:hover {
        background-color: #fff;
    }

    .v-bs-searchbox[data-v-138dff1d] {
        padding: 4px 8px;
    }

    .v-bs-searchbox .form-control[data-v-138dff1d] {
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .catalog-product-view .product-detail-product-info-detail .product-info-detailed .main-column .customer-review > div {
        width: 100%;
        float: left;
        display: flex;
        align-items: center;
    }
    /*# sourceMappingURL=vue-bootstrap-select.vue.map */
</style>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
<script>
    $(function () {
        $('.lazy').Lazy();
        $('a[href*=#]:not([href=#])').click(function () {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top - 64
                    }, 500);
                    $(".navMB > li > a").removeClass("active");
                    $(this).addClass("active");
                    return false;
                }
            }
        });
    });


</script>
<?php echo $this->load->view('product/frontend/product/css') ?>
<script>
    $(document).ready(function () {
        $('#subscribe_form .error').hide();
        var uri = $('#subscribe_form').attr('action');
        $('#subscribe_form').on('submit', function () {
            var postData = $(this).serializeArray();
            $.post(uri, {post: postData,phone: $('#subscribe_form .phone').val()}, function (data) {
                var json = JSON.parse(data);
                $('#subscribe_form .error').show();
                if (json.error.length) {
                    $('#subscribe_form .error').removeClass('alert alert-success').addClass('alert alert-danger');
                    $('#subscribe_form .error').html('').html(json.error);
                } else {

                    $('#subscribe_form .error').removeClass('alert alert-danger').addClass('alert alert-success');
                    $('#subscribe_form .error').html('').html('Đăng ký thành công.');
                    $('#subscribe_form').trigger("reset");
                    setTimeout(function () {
                        location.reload();
                    }, 5000);
                }
            });
            return false;
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#advisory_form .error').hide();
        var uri = $('#advisory_form').attr('action');
        $('#advisory_form').on('submit', function () {
            var postData = $(this).serializeArray();
            $.post(uri, {post: postData, fullname: $('#advisory_form .fullname').val(),phone: $('#advisory_form .phone').val(),message: $('#advisory_form .message').val()}, function (data) {
                var json = JSON.parse(data);
                $('#advisory_form .error').show();
                if (json.error.length) {
                    $('#advisory_form .error').removeClass('alert alert-success').addClass('alert alert-danger');
                    $('#advisory_form .error').html('').html(json.error);
                } else {

                    $('#advisory_form .error').removeClass('alert alert-danger').addClass('alert alert-success');
                    $('#advisory_form .error').html('').html('Đăng ký thành công.');
                    $('#advisory_form').trigger("reset");
                    setTimeout(function () {
                        location.reload();
                    }, 5000);
                }
            });
            return false;
        });
    });
</script>
