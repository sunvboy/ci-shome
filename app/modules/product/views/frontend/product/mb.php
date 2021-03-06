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
                                                                                <span>Xem t???t c???<p>(<?php echo count($list_image) ?>)</p></span>
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
                                                        <?php $title_2 =  $getCatalogueAttr['titleC'] ?>
                                                    <?php } ?>
                                                <?php } ?>

                                                <?php if(!empty($attroldISHOME) || !empty($list_version)){?>
                                                <div class="button-select-option">Ch???n <?php echo $title_1?>/<?php echo $title_2?></div>

                                                <div class="color-watchs-mobile product attibute overview">


                                                    <div class="size-thick js_addtribute">


                                                        <?php
                                                        if (isset($attroldISHOME) && count($attroldISHOME) && is_array($attroldISHOME)) {
                                                            $attrFinalDOCUNG = groupValue($attroldISHOME, 'titleC');
                                                        } else {
                                                            $attrFinalDOCUNG = [];
                                                        }
                                                        ?>
                                                        <?php if (is_array($attrFinalDOCUNG) && count($attrFinalDOCUNG) && isset($attrFinalDOCUNG)) { ?>
                                                            <?php foreach ($attrFinalDOCUNG as $keyP => $valP) { ?>
                                                                <?php if (is_array($valP) && count($valP) && isset($valP)) { ?>
                                                                    <div class="items-option">
                                                                        <span class="label"><?php echo $keyP ?></span>
                                                                        <div data-v-138dff1d="" class="v-select">
                                                                            <?php foreach ($valP as $key => $val) { if($key==0){?>
                                                                                <button data-v-138dff1d="" type="button" class="v-select-toggle">
                                                                                    <div class="title-attr-2">
                                                                                        <?php echo $val['title'] ?>
                                                                                    </div>
                                                                                    <div data-v-138dff1d="" class="arrow-down"></div>
                                                                                </button>
                                                                            <?php } ?>
                                                                            <?php } ?>

                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>

                                                        <?php if (is_array($list_version) && count($list_version) && isset($list_version)) { ?>
                                                            <?php if (is_array($getCatalogueAttr) && count($getCatalogueAttr) && isset($getCatalogueAttr)) { ?>
                                                                <div class="items-option">
                                                                    <span class="label"><?php echo $getCatalogueAttr['titleC'] ?></span>
                                                                    <div data-v-138dff1d="" class="v-select">
                                                                        <?php foreach ($list_version as $key => $val) {
                                                                            if ($key == 0) { ?>
                                                                                <button data-v-138dff1d="" type="button" class="v-select-toggle">
                                                                                    <div data-v-138dff1d="" class="title-attr-1">
                                                                                        <?php echo $val['title'] ?>
                                                                                    </div>
                                                                                    <div data-v-138dff1d="" class="arrow-down"></div>
                                                                                </button>
                                                                            <?php } ?>
                                                                        <?php } ?>



                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>


                                                </div>


                                                <?php }?>

                                            </div>

                                            <div class="price-mobie">
                                                <div class="price-status active-freeship">
                                                    <div class="price-freeship">
                                                        <div class="final-price"><span
                                                                    class="price"><?php echo $prd_info['price_final'] ?></span>
                                                        </div> <!---->
                                                    </div>
                                                    <div class="freeship-product">Freeship</div>
                                                </div>
                                            </div>
                                            <div class="intro">
                                                <div class="star">
                                                    <div>
                                                        <div class="product-reviews-summary short">
                                                            <div class="rating-summary">
                                                                <span class="label"><span>X???p h???ng:</span></span>
                                                                <div class="rating-result" title="4/5">
                                                                    <span style="width:80%"><span>4/5</span></span>
                                                                </div>
                                                                <span>(<?php echo $totalComment ?> ??a??nh gia??)</span>
                                                            </div>
                                                            <div class="reviews-actions">
                                                                <a class="action view"
                                                                   href="<?php echo $canonical ?>#reviews"><?php echo $totalComment ?>
                                                                    &nbsp;<span>????nh gi??</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <!---->
                                                <div class="product-key">M?? s???n ph???m:
                                                    <span><?php echo $productDetail['code'] ?></span></div>
                                            </div>
                                            <div class="infor-mobile">

                                                <div class="product-brand">
                                                    <div>H??ng: <a href=""><?php echo $productDetail['thuonghieu'] ?></a>
                                                    </div>

                                                </div>
                                                <div class="status">
                                                    <span class="instock"><span><?php if ($productDetail['highlight'] == 0) { ?>C??n h??ng<?php } else if ($productDetail['highlight'] == 1) { ?>
                                                                <span style="color: red">H???t h??ng</span><?php } ?></span></span>
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
                                                        Nh???p<span><?php echo $getKM['code'] ?></span>:&nbsp;
                                                        <?php echo $promotional1['detail'] ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="product attibute overview">

                                                <div class="options-attribute-product">
                                                    <div class="product-option-mobile-top">
                                                        <div class="mobile-pr-top">
                                                            <div class="product-images">
                                                                <div class="product-image-single">
                                                                    <div class="item image">
                                                                        <img style="height: auto" src="<?php echo $productDetail['image'] ?>" alt="<?php echo $productDetail['title'] ?>"></div>
                                                                </div>
                                                            </div>
                                                            <div class="info-product-canvas">
                                                                <h2 class="titles"><?php echo $productDetail['title'] ?></h2>
                                                                <span class="">
                                                                    <div class="popup-price">
                                                                        <div class="price-status">
                                                                            <div class="final-price">
                                                                                <span class="price">
                                                                                    <?php echo $prd_info['price_final'] ?>
                                                                                </span>
                                                                            </div>
                                                                        </div>

                                                    </div>
                                                    <div class="number-qty"><div
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
                                                                                                class="fa fa-plus"></i></button></div></div></div></div></span>
                                                            </div>
                                                        </div>




                                                        <?php echo $this->load->view('product/frontend/product/folder/attrSELECT') ?>
                                                        <style>
                                                            .product-detail-main-content .product-detail-first-block .product-detail .product.attibute.overview .items-option .v-select .v-dropdown-container ul{
                                                                padding: 0px;
                                                            }
                                                        </style>



                                                    </div>
                                                    <div class="button-select-close">????ng</div>
                                                </div>



                                            </div>

                                        </div>
                                    </div> <!----></div>
                                <div class="bottom-bar">
                                    <div class="items-block">
                                        <div class="hotline-mobile">
                                            <a href="tel:<?php echo $this->fcSystem['contact_hotline'] ?>">
                                                <img src="template/icon_phone_bottom.svg"><span>G???i ??i???n</span></a>
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
                                            <h2 class="title-block font-bold-stag">?????c ??i???m s???n ph???m</h2>
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

                                            <div class="description-view-content c???ntent-desctiption hide-content">
                                                <div class="c???ntent-desctiptions">
                                                    <?php if ($productDetail['description'] != '') { ?>
                                                        <section class="section">
                                                            <div class="section-content relative">
                                                                <?php echo $productDetail['description']; ?>
                                                            </div>
                                                        </section>
                                                    <?php } ?>
                                                    <?php if ($productDetail['content'] != '') { ?>
                                                        <section class="section information-product">
                                                            <h3 class="section-title"><span style="color: #2b3984;">Th??ng tin chi ti???t s???n ph???m</span>
                                                            </h3>
                                                            <div class="section-content relative">
                                                                <div class="item-des-product">
                                                                    <?php echo $productDetail['content']; ?>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    <?php } ?>
                                                    <style>
                                                        .c???ntent-desctiptions img {
                                                            height: auto !important;
                                                            max-width: 100%;
                                                        }
                                                    </style>
                                                    <style xml="space">
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
                                                <a class="learn-more"><span class="circle"><span
                                                                class="icon arrow"></span></span> <span
                                                            class="button-text">Xem th??m</span></a>
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
    $('.button-select-close').click(function () {
        $('#product-detail-main-content').toggleClass('active-canvas-option-pr')

    })
    $('.option-mobiles').click(function () {
        $('#product-detail-main-content').toggleClass('active-canvas-option-pr')

    })


</script>