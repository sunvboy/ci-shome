<?php
$prd_title = $productDetail['title'];
$prd_code = $productDetail['code'];
$prd_info = getPriceFrontend(array('productDetail' => $productDetail));

$prd_href = rewrite_url($productDetail['canonical']);
$comment = comment(array('id' => $productDetail['id'], 'module' => 'product'));
$prd_rate = 0;
$totalComment = 0;
if (isset($comment) && is_array($comment) && count($comment)) {
    $prd_rate = round($comment['statisticalRating']['averagePoint']);
    $totalComment = round($comment['statisticalRating']['totalComment']);
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
<main id="maincontent" class="page-main">


    <div class="columns">
        <div class="column main">
            <div class="product-main-content">
                <div id="product-detail"><!---->
                    <div>
                        <div id="product-detail-main-content"
                             class="product-detail-main-content">
                            <form method="post" action="/qaddtocart/index/add/" class="form-addtocart"><!---->
                                <div options="" class="product-detail-first-block">
                                    <div class="block-detail-top">
                                        <div class="column-left" style="padding: 10px 0px">
                                            <div class="product-images">
                                                <div class="product-image-single">
                                                    <div class="cool-lightbox">
                                                        <div class="cool-lightbox__navigation">
                                                            <a type="button" title="Previous"
                                                               class="cool-lightbox-button cool-lightbox-button--prev"
                                                               data-fancybox="gallery"
                                                               href="<?php echo $productDetail['image']; ?>">
                                                                <div class="cool-lightbox-button__icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                         viewBox="0 0 24 24">
                                                                        <path d="M11.28 15.7l-1.34 1.37L5 12l4.94-5.07 1.34 1.38-2.68 2.72H19v1.94H8.6z"></path>
                                                                    </svg>
                                                                </div>
                                                            </a>
                                                            <a type="button" title="Next"
                                                               class="cool-lightbox-button cool-lightbox-button--next"
                                                               data-fancybox="gallery"
                                                               href="<?php echo $productDetail['image']; ?>">
                                                                <div class="cool-lightbox-button__icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                         viewBox="0 0 24 24">
                                                                        <path d="M15.4 12.97l-2.68 2.72 1.34 1.38L19 12l-4.94-5.07-1.34 1.38 2.68 2.72H5v1.94z"></path>
                                                                    </svg>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <a class="item-image" data-fancybox="gallery"
                                                           href="<?php echo $productDetail['image']; ?>">
                                                            <img class="image-mobile"
                                                                 src="<?php echo $productDetail['image']; ?>"
                                                                 alt="<?php echo $productDetail['title']; ?>"> <!---->
                                                        </a>
                                                        <div style="display: none">
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
                                                </div> <!----> <!---->
                                            </div>
                                        </div>


                                        <div class="product-detail">
                                            <h1 class="title"><?php echo $productDetail['title']; ?></h1>
                                            <div class="option-mobiles">


                                                <?php
                                                $title_1 = $title_2 = '';
                                                if (isset($attroldISHOME) && count($attroldISHOME) && is_array($attroldISHOME)) {
                                                    $attrFinalDOCUNG = groupValue($attroldISHOME, 'titleC');
                                                } else {
                                                    $attrFinalDOCUNG = [];
                                                }
                                                ?>
                                                <?php if (is_array($attrFinalDOCUNG) && count($attrFinalDOCUNG) && isset($attrFinalDOCUNG)) { ?>
                                                    <?php foreach ($attrFinalDOCUNG as $keyP => $valP) { ?>
                                                        <?php if (is_array($valP) && count($valP) && isset($valP)) { ?>
                                                            <?php $title_1 = $keyP ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>

                                                <?php if (is_array($list_version) && count($list_version) && isset($list_version)) { ?>
                                                    <?php if (is_array($getCatalogueAttr) && count($getCatalogueAttr) && isset($getCatalogueAttr)) { ?>
                                                        <?php $title_2 = $getCatalogueAttr['titleC'] ?>
                                                    <?php } ?>
                                                <?php } ?>

                                                <?php if (!empty($attroldISHOME) || !empty($list_version)) { ?>
                                                    <div class="button-select-option">Chọn <?php echo $title_1 ?>
                                                        /<?php echo $title_2 ?></div>




                                                <?php } ?>

                                            </div>

                                            <div class="price-mobie">
                                                <div class="price-status active-freeship" style="border-bottom: 0px !important;padding: 0px;">
                                                    <div class="price-freeship">
                                                        <div class="final-price"><span class="price"><?php echo $prd_info['price_final'] ?></span>
                                                        </div> <!---->
                                                    </div>
                                                    <div class="freeship-product">Freeship</div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <?php $total = 0; $listUudai = json_decode($productDetail['albums'],TRUE)?>
                                            <?php if(isset($listUudai) && count($listUudai) && is_array($listUudai)){  if (!empty($listUudai[0]['title'])){foreach ($listUudai as $k=>$v){ $total += (int)trim($v['description']);}?>
                                                <div class="f lqt">
                                                    <div class="fl lqt-total flexCen" style="background: #dddddd;">
                                                        <div style="text-transform: uppercase;font-size: 15px">Tổng giá trị quà tặng = <b style="color: red;font-size: 20px"><?php echo number_format($total,'0',',','.')?>₫</b></div>
                                                    </div>
                                                    <div class="fl lqt-data flexJus" style="padding: 0px">



                                                        <?php foreach ($listUudai as $k=>$v){ $total += (int)trim($v['description']);?>
                                                            <a href="javascript:void(0)" rel="nofollow" title="<?php echo $v['title']?>">
                                                                <div>
                                                                    <h5><?php echo $v['title']?></h5>
                                                                    <p>Trị giá <span><?php echo $v['description']?>₫</span></p>
                                                                    <img style="margin-top: 0px" src="<?php echo $v['images']?>" alt="<?php echo $v['title']?>"></div>
                                                            </a>
                                                        <?php }?>

                                                    </div>

                                                </div>
                                            <?php }?>
                                            <?php }?>
                                            <div class="clearfix"></div>

                                            <div class="intro">
                                                <div class="star">
                                                    <div>
                                                        <div class="product-reviews-summary short">
                                                            <div class="rating-summary">
                                                                <span class="label"><span>Xếp hạng:</span></span>
                                                                <div class="rating-result" title="4/5">
                                                                    <span style="width:80%"><span>4/5</span></span>
                                                                </div>
                                                                <span>(<?php echo $totalComment ?> Đánh giá)</span>
                                                            </div>
                                                            <div class="reviews-actions">
                                                                <a class="action view"
                                                                   href="<?php echo $canonical ?>#reviews"><?php echo $totalComment ?>
                                                                    &nbsp;<span>Đánh giá</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <!---->
                                                <div class="product-key">Mã sản phẩm:
                                                    <span><?php echo $productDetail['code'] ?></span></div>
                                            </div>
                                            <div class="infor-mobile">

                                                <div class="product-brand">
                                                    <div>Hãng: <a href=""><?php echo $productDetail['thuonghieu'] ?></a>
                                                    </div>

                                                </div>
                                                <div class="status">
                                                    <span class="instock"><span><?php if ($productDetail['highlight'] == 0) { ?>Còn hàng<?php } else if ($productDetail['highlight'] == 1) { ?>
                                                                <span style="color: red">Hết hàng</span><?php } ?></span></span>
                                                </div>

                                            </div> <!---->
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
                                                        Nhập<span><?php echo $getKM['code'] ?></span>:&nbsp;
                                                        <?php echo $promotional1['detail'] ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="textprice-detail-product"><p style="margin-bottom: 0px"><?php echo $this->fcSystem['title_title_9']?></p></div>


                                            <div class="clearfix"></div>

                                            <div class="product attibute overview">

                                                <div class="options-attribute-product">
                                                    <div class="product-option-mobile-top">
                                                        <div class="mobile-pr-top">
                                                            <div class="product-images">
                                                                <div class="product-image-single">
                                                                    <div class="item image">
                                                                        <img style="height: auto"
                                                                             src="<?php echo $productDetail['image'] ?>"
                                                                             alt="<?php echo $productDetail['title'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="info-product-canvas">
                                                                <h2 class="titles"><?php echo $productDetail['title'] ?></h2>
                                                                <div class="popup-price">
                                                                    <div class="price-status">
                                                                        <div class="final-price">
                                                                                <span class="price">
                                                                                    <?php echo $prd_info['price_final'] ?>
                                                                                </span>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="number-qty">
                                                                    <div
                                                                        class="plus-minus-box"><div
                                                                            class="input-group plus-minus-input"><div
                                                                                class="input-group-button"><button
                                                                                    type="button"
                                                                                    class="button hollow circle minus js_quantity_minus"><i
                                                                                        aria-hidden="true"
                                                                                        class="fa fa-minus"></i></button> <input
                                                                                    id="input-group-field"
                                                                                    type="number"
                                                                                    name="quantity" min="1" value="1"
                                                                                    max="5"
                                                                                    class="qty-input js_quantity">
                                                                                <button
                                                                                    type="button"
                                                                                    class="button hollow circle plus js_quantity_plus"><i
                                                                                        aria-hidden="true"
                                                                                        class="fa fa-plus"></i></button></div></div></div></div>
                                                            </div>
                                                        </div>


                                                        <?php echo $this->load->view('product/frontend/product/folder/attrSELECT') ?>
                                                        <style>
                                                            .product-detail-main-content .product-detail-first-block .product-detail .product.attibute.overview .items-option .v-select .v-dropdown-container ul {
                                                                padding: 0px;
                                                            }
                                                        </style>


                                                    </div>
                                                    <div class="button-select-close">Đóng</div>
                                                </div>


                                            </div>
                                            <div class="clearfix"></div>

                                            <a href="tel:<?php echo $this->fcSystem['contact_hotline'] ?>"
                                               class="btn btn_phone" type="button"><span>Liên hệ trực tiếp để có giá tốt hơn</span></a>
                                            <div class="clearfix"></div>


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
                                            <div class="clearfix"></div>
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
                                            <div class="clearfix"></div>

                                            <div class="col-12-mobile">
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
                                                <div class="clearfix"></div>
                                                <?php
                                                $slide_loiich = slide(array('keyword' => 'loi-ich'), $this->fc_lang);

                                                ?>
                                                <?php if (isset($slide_loiich) && is_array($slide_loiich) && count($slide_loiich)) { ?>

                                                    <div class="why-buy">
                                                        <div class="label">Lợi ích khi mua hàng
                                                            tại <?php echo $this->fcSystem['homepage_brandname'] ?>
                                                        </div>
                                                        <div class="clearfix"></div>

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
                                    </div> <!----></div>
                                <div class="bottom-bar">
                                    <div class="items-block">
                                        <div class="hotline-mobile">
                                            <a href="tel:<?php echo $this->fcSystem['contact_hotline'] ?>">
                                                <img src="template/icon_phone_bottom.svg"><span>Gọi điện</span></a>
                                        </div>
                                        <div class="messenger-mobile">
                                            <a href="<?php echo $this->fcSystem['social_facebookm'] ?>" target="_blank">
                                                <img src="template/ic-messenger.svg"><span>Messenger</span></a>
                                        </div>
                                        <button type="submit" class="button-quickcheckout js_buy"
                                                data-price="<?php echo $productDetail['price'] ?>">Mua Online Ngay
                                        </button>
                                    </div>
                                </div>


                            </form>
                            <div class="overlay-option"></div>
                        </div>
                        <div id="product-detail-product-info-detail" class="product-detail-product-info-detail"><!---->
                            <div class="product-info-detailed">
                                <div class="main-column">
                                    <div class="main-description-product">
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
                                        <div class="head-block">
                                            <h2 class="title-block font-bold-stag">Đặc điểm sản phẩm</h2>
                                        </div>
                                        <div class="content-block main-description">

                                            <?php if (isset($attrFinal) && count($attrFinal) && is_array($attrFinal)) { ?>

                                                <div class="additional-attributes-product">
                                                    <div class="content-block">
                                                        <table class="additional-attributess">
                                                            <tbody>
                                                            <?php foreach ($attrFinal as $k => $v) { ?>
                                                                <tr>
                                                                    <th scope="row" class="col label">
                                                                        <span><?php echo $k ?></span></th>
                                                                    <td class="col data"><?php $i = 0;
                                                                        foreach ($v as $kp => $vp) {
                                                                            $i++; ?>
                                                                            <?php echo $vp['title'] ?><br>
                                                                        <?php } ?></td>
                                                                </tr>
                                                            <?php } ?>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div> <!---->

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
                                                            <h3 class="section-title"><span style="color: #2b3984;">Thông tin chi tiết sản phẩm</span>
                                                            </h3>
                                                            <div class="section-content relative">
                                                                <div class="item-des-product">
                                                                    <?php echo $productDetail['content']; ?>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    <?php } ?>

                                                    <style xml="space">
                                                        .cọntent-desctiptions img {
                                                            height: auto !important;
                                                            max-width: 100%;
                                                        }
                                                        table {
                                                            width: 100% !important;
                                                        }

                                                        .item-des-product img {
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
                                                <a class="learn-more"><span class="circle"><span class="icon arrow"></span></span> <span class="button-text">Xem thêm</span></a>
                                            </div>
                                        </div>
                                    </div>
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
                                    <?php echo $this->load->view('product/frontend/product/folder/comment') ?>

                                    <div class="clearfix"></div>


                                    <?php if (isset($relaList) && is_array($relaList) && count($relaList)) { ?>
                                        <div class="product-features widget block block-static-block">
                                            <div class="head-block"><h2 class="title-block font-bold-stag">SẢN PHẨM LIÊN QUAN</h2></div>
                                            <div class="content-block block-products-list">
                                                <div class="style-2 products-grid slick-initialized">

                                                    <div id="slider-home" class="owl-carousel">
                                                        <?php foreach ($relaList as $keyPost => $valPost) {
                                                            $title = $valPost['title'];
                                                            $href = rewrite_url($valPost['canonical'], TRUE, TRUE);
                                                            $image = $valPost['image'];
                                                            $getPrice = getPriceFrontend(array('productDetail' => $valPost)); ?>

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


                                                        <?php } ?>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                </div>
                                <!---->
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
</main>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />

<?php echo $this->load->view('product/frontend/product/css') ?>

<script>
    $(document).ready(function () {
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
        $('.button-select-close').click(function () {
            $('#product-detail-main-content').toggleClass('active-canvas-option-pr')

        });
        $('.option-mobiles').click(function () {
            $('#product-detail-main-content').toggleClass('active-canvas-option-pr')

        });
        $('#slider-home').owlCarousel({
            loop: true,
            margin: 0,
            dots: false,
            nav: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplaySpeed: 1500,
            lazyLoad: true,
            animateOut: 'fadeOut',
            items: 2,
            navText: ['', ''],

        });
        $('#subscribe_form .error').hide();
        var uri = $('#subscribe_form').attr('action');
        $('#subscribe_form').on('submit', function () {
            var postData = $(this).serializeArray();
            $.post(uri, {post: postData, phone: $('#subscribe_form .phone').val()}, function (data) {
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

        $('#advisory_form .error').hide();
        var uri = $('#advisory_form').attr('action');
        $('#advisory_form').on('submit', function () {
            var postData = $(this).serializeArray();
            $.post(uri, {
                post: postData,
                fullname: $('#advisory_form .fullname').val(),
                phone: $('#advisory_form .phone').val(),
                message: $('#advisory_form .message').val()
            }, function (data) {
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
<style>
    @media (max-width: 767px) {
        #slider-home.owl-carousel .owl-nav [class*=owl-]{
            border: 0px;
            background: transparent;
            color: #000;
        }
        body .block-products-list .products-grid .product-items .product-item .product-item-info .product-item-details .product-item-link {
            font-size: 17px;
            line-height: normal;
            height: auto;
        }
        .lec {
            display: unset;
        }

        .content-thong-tin-thanh-toan {
            padding: 5px;
        }

        .product-detail-main-content .product-detail-first-block .column-left, .catalog-product-view .product-detail-product-info-detail .product-info-detailed .main-column {
            padding-right: 0px;
        }
        .product-detail-main-content .product-detail-first-block .product-detail .infor-mobile{
            border-bottom: 0px;
        }
        .btn_phone {
            padding: 14px 0px;

            text-align: center;
        }
        .textprice-detail-product{
            margin-bottom: 0px;
        }
        .whotline li span{
            font-size: 11px;
        }
        .whotline li p.hotline{
            margin-top: 0px !important;
        }
        .whotline {

            padding-bottom: 10px;
        }
        .product-detail-main-content .product-detail-first-block .label {
            font-size: 15px !important;
            font-weight: 600;
            margin-top: 0px;
        }
        .why-buy{
            margin-bottom: 10px;
        }
        .map-bt {
            margin-bottom: 15px;
        }
        .lqt-tit,.lqt-data,.lqt-total{
            width: 100%;
        }
        .lqt-data a{
            width: calc(100% / 3);

        }
        .lqt-data a:last-child{
            border-right: 0px;
        }
        .lqt-data a h5{
            height: auto;
        }
        .flexJus {
            height: auto;
        }
        .lqt-data a img{
            width: 60px;
            height: 60px;
        }
        .lqt-data a h5 {
            height: auto;
            font-size: 13px;
        }


        .lqt-total {
            border-top: 1px solid #dddddd;
            height: auto;
            padding: 10px 0px;
        }
        .lqt {
            margin: 10px 0px;
            height: auto;
            border: 1px solid #ddd;
            float: left;
            width: 100%;
        }
        .lqt-tit, .lqt-data, .lqt-total {
            width: 100%;
            padding: 10px 0px;
        }
        .option-mobiles .button-select-option{
            border-radius: 6px;
        }
    }
</style>
