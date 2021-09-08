<script>
    $("body").removeAttr('class');
    $("body").attr('class', "cms-tra-gop-online cms-page-view page-layout-1column add-padding-header iMenu loading-active-12 loading-actived")

</script>
<main id="maincontent" class="page-main">


    <div class="page-title-wrapper">
        <h1 class="page-title"><span class="base"
                                     data-ui-id="page-title-wrapper"><?php echo $this->fcSystem['link_mota_tragop'] ?></span>
        </h1>
    </div>
    <div class="page messages">
        <div data-placeholder="messages"></div>
    </div>
    <div class="columns">
        <div class="column main">


            <div class="flash-sale-items cdz-best-seller-wrap product-style block-productlist block-borderbottom widget block block-static-block">
                <div class="row">
                    <div class="col-sm-24">
                        <div class="tabs-list bestseller-product">
                            <div class="cdz-block-title row">
                                <div class="banner banner-landing">
                                    <a href="<?php echo $this->fcSystem['link__linkanh_tragop']?>" target="_blank">
                                        <img src="<?php echo $this->fcSystem['link_anh_tragop']?>"  width="877" height="336">
                                    </a>
                                </div>
                                <div class="form-get-coupon">
                                    <form class="wpcf7-form" action="mailsubricre.html" method="post" id="mailsubricre">
                                        <div class="head-form">
                                            <p class="title-form" style="text-align: center;"><span style="font-size: medium; font-family: arial, helvetica, sans-serif;"><?php echo $this->fcSystem['link_tieude_tragop']?></span>
                                            </p>
                                            <p class="price-voucher" style="text-align: center;"><?php echo $this->fcSystem['link_mota_page_tragop']?></p>
                                        </div>
                                        <div class="input-form">
                                            <div class="error"></div>

                                            <input class="input-voucher fullname" name="fullname" size="40" type="text" value="" placeholder="Họ tên">
                                            <input class="input-voucher email" name="email" size="40" type="email" value="" placeholder="Email">
                                            <input id="phone-number" class="input-voucher phone" maxlength="10" name="phone" size="40" type="tel" value=""  placeholder="Số điện thoại">
                                            <input class="button-submit" type="submit" value="Nhận ngay">
                                        </div>
                                        <?php /*<div class="form-success"
                                             style="display: none; margin: 5px 23px 0 23px; border-radius: 10px; font-weight: bold; text-align: center; color: #40c13e;">
                                            <div class="mail-sent-ok" style="display: block;">Đăng kí thành công. Mã
                                                voucher DIGI200KT7
                                            </div>
                                        </div>*/?>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <?php
            if (isset($product_catalog_highlight) && is_array($product_catalog_highlight) && count($product_catalog_highlight)) {
                foreach ($product_catalog_highlight as $keyC => $valC) {
                    if (isset($valC['post']) && is_array($valC['post']) && count($valC['post'])) {

                        ?>
                    <div class="flash-sale-items cdz-best-seller-wrap product-style block-productlist block-borderbottom widget block block-static-block">
                        <div class="row">
                            <div class="col-sm-24">
                                <div class="tabs-list bestseller-product">
                                    <div class="cdz-block-title">
                                        <?php $listI = json_decode($valC['image_json'], TRUE);
                                        if (isset($listI) && is_array($listI) && count($listI)) { ?>
                                            <div class="banner2"
                                                 style="margin-top: 30px; display: flex;">
                                                <div class="row">


                                                    <?php

                                                    foreach ($listI as $kC => $vC) {
                                                        ?>
                                                        <div class="col-md-12"><img src="<?php echo $vC ?>" width="580"  height="170" alt="<?php echo $valC['title']?>">
                                                        </div>
                                                    <?php } ?>


                                                </div>
                                            </div>
                                        <?php } ?>

                                        <div class="tab-content product data items">
                                            <div id="best-seller-tab-1" class="data item content">
                                                <div>
                                                    <div class="block-products-list">
                                                        <div class="products-grid">
                                                            <div class="product-items">

                                                                <?php foreach ($valC['post'] as $k => $val) {
                                                                    $title = $val['title'];
                                                                    $href = rewrite_url($val['canonical'], TRUE, TRUE);
                                                                    $image = $val['image'];
                                                                    $getPrice = getPriceFrontend(array('productDetail' => $val));
                                                                    ?>
                                                                <div class="product-item">
                                                                    <div class="product-item-info active-freeship">
                                                                        <div class="cdz-product-top">
                                                                            <a href="<?php echo $href?>"
                                                                               class="product photo product-item-photo"><img
                                                                                        alt="<?php echo $title?>"
                                                                                       src="<?php echo $image?>"></a>
                                                                            <?php /*<div class="custom-sale-online"></div>
                                                                            <div class="icon-images-pr">
                                                                                <div class="discount-percent 2649"
                                                                                     style="">
                                                                                    -25%
                                                                                </div>
                                                                                <div class="freeship-product">
                                                                                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzMiIgaGVpZ2h0PSIzMiIgdmlld0JveD0iMCAwIDMyIDMyIj4KICA8ZyBpZD0iaWMtZnJlZXNoaXAiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0wLjMwMSkiPgogICAgPGcgaWQ9IlBhdGhfMTAzNSIgZGF0YS1uYW1lPSJQYXRoIDEwMzUiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAuMzAxKSIgZmlsbD0iIzIzOWIyOCI+CiAgICAgIDxwYXRoIGQ9Ik0gMTYgMzEuNSBDIDExLjg1OTgwMDMzODc0NTEyIDMxLjUgNy45Njc0MTAwODc1ODU0NDkgMjkuODg3NzIwMTA4MDMyMjMgNS4wMzk4NDAyMjE0MDUwMjkgMjYuOTYwMTU5MzAxNzU3ODEgQyAyLjExMjI3OTg5MTk2Nzc3MyAyNC4wMzI1OTA4NjYwODg4NyAwLjUgMjAuMTQwMTk5NjYxMjU0ODggMC41IDE2IEMgMC41IDExLjg1OTgwMDMzODc0NTEyIDIuMTEyMjc5ODkxOTY3NzczIDcuOTY3NDEwMDg3NTg1NDQ5IDUuMDM5ODQwMjIxNDA1MDI5IDUuMDM5ODQwMjIxNDA1MDI5IEMgNy45Njc0MTAwODc1ODU0NDkgMi4xMTIyNzk4OTE5Njc3NzMgMTEuODU5ODAwMzM4NzQ1MTIgMC41IDE2IDAuNSBDIDIwLjE0MDE5OTY2MTI1NDg4IDAuNSAyNC4wMzI1OTA4NjYwODg4NyAyLjExMjI3OTg5MTk2Nzc3MyAyNi45NjAxNTkzMDE3NTc4MSA1LjAzOTg0MDIyMTQwNTAyOSBDIDI5Ljg4NzcyMDEwODAzMjIzIDcuOTY3NDEwMDg3NTg1NDQ5IDMxLjUgMTEuODU5ODAwMzM4NzQ1MTIgMzEuNSAxNiBDIDMxLjUgMjAuMTQwMTk5NjYxMjU0ODggMjkuODg3NzIwMTA4MDMyMjMgMjQuMDMyNTkwODY2MDg4ODcgMjYuOTYwMTU5MzAxNzU3ODEgMjYuOTYwMTU5MzAxNzU3ODEgQyAyNC4wMzI1OTA4NjYwODg4NyAyOS44ODc3MjAxMDgwMzIyMyAyMC4xNDAxOTk2NjEyNTQ4OCAzMS41IDE2IDMxLjUgWiIgc3Ryb2tlPSJub25lIi8+CiAgICAgIDxwYXRoIGQ9Ik0gMTYgMSBDIDExLjk5MzM0OTA3NTMxNzM4IDEgOC4yMjY1MjA1MzgzMzAwNzggMi41NjAyNzAzMDk0NDgyNDIgNS4zOTM0MDAxOTIyNjA3NDIgNS4zOTM0MDAxOTIyNjA3NDIgQyAyLjU2MDI3MDMwOTQ0ODI0MiA4LjIyNjUyMDUzODMzMDA3OCAxIDExLjk5MzM0OTA3NTMxNzM4IDEgMTYgQyAxIDIwLjAwNjY0OTAxNzMzMzk4IDIuNTYwMjcwMzA5NDQ4MjQyIDIzLjc3MzQ3OTQ2MTY2OTkyIDUuMzkzNDAwMTkyMjYwNzQyIDI2LjYwNjU5OTgwNzczOTI2IEMgOC4yMjY1MjA1MzgzMzAwNzggMjkuNDM5NzI5NjkwNTUxNzYgMTEuOTkzMzQ5MDc1MzE3MzggMzEgMTYgMzEgQyAyMC4wMDY2NDkwMTczMzM5OCAzMSAyMy43NzM0Nzk0NjE2Njk5MiAyOS40Mzk3Mjk2OTA1NTE3NiAyNi42MDY1OTk4MDc3MzkyNiAyNi42MDY1OTk4MDc3MzkyNiBDIDI5LjQzOTcyOTY5MDU1MTc2IDIzLjc3MzQ3OTQ2MTY2OTkyIDMxIDIwLjAwNjY0OTAxNzMzMzk4IDMxIDE2IEMgMzEgMTEuOTkzMzQ5MDc1MzE3MzggMjkuNDM5NzI5NjkwNTUxNzYgOC4yMjY1MjA1MzgzMzAwNzggMjYuNjA2NTk5ODA3NzM5MjYgNS4zOTM0MDAxOTIyNjA3NDIgQyAyMy43NzM0Nzk0NjE2Njk5MiAyLjU2MDI3MDMwOTQ0ODI0MiAyMC4wMDY2NDkwMTczMzM5OCAxIDE2IDEgTSAxNiAwIEMgMjQuODM2NTU5Mjk1NjU0MyAwIDMyIDcuMTYzNDQwNzA0MzQ1NzAzIDMyIDE2IEMgMzIgMjQuODM2NTU5Mjk1NjU0MyAyNC44MzY1NTkyOTU2NTQzIDMyIDE2IDMyIEMgNy4xNjM0NDA3MDQzNDU3MDMgMzIgMCAyNC44MzY1NTkyOTU2NTQzIDAgMTYgQyAwIDcuMTYzNDQwNzA0MzQ1NzAzIDcuMTYzNDQwNzA0MzQ1NzAzIDAgMTYgMCBaIiBzdHJva2U9Im5vbmUiIGZpbGw9IiMyMzliMjgiLz4KICAgIDwvZz4KICAgIDxnIGlkPSJHcm91cF8xMjA3IiBkYXRhLW5hbWU9Ikdyb3VwIDEyMDciIHRyYW5zZm9ybT0idHJhbnNsYXRlKDQuMTEyIDEwLjE2OCkiPgogICAgICA8cGF0aCBpZD0iUGF0aF82MzAiIGRhdGEtbmFtZT0iUGF0aCA2MzAiIGQ9Ik0tMjE0LjA5Miw1MDYuM2ExLjQ2OCwxLjQ2OCwwLDAsMC0xLjQ2NS0xLjQ3MSwxLjQ2OCwxLjQ2OCwwLDAsMC0xLjQ2NSwxLjQ3MSwxLjQ2OCwxLjQ2OCwwLDAsMCwxLjQ2NSwxLjQ3MUExLjQ2OCwxLjQ2OCwwLDAsMC0yMTQuMDkyLDUwNi4zWiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMjIyLjcxOSAtNDk0LjUyOSkiIGZpbGw9IiNmZmYiLz4KICAgICAgPHBhdGggaWQ9IlBhdGhfNjMxIiBkYXRhLW5hbWU9IlBhdGggNjMxIiBkPSJNNTguMDQ0LDUwNi4zYTEuNDY1LDEuNDY1LDAsMSwwLTEuNDY1LDEuNDcxQTEuNDY4LDEuNDY4LDAsMCwwLDU4LjA0NCw1MDYuM1oiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0zNi43MDYgLTQ5NC41MjkpIiBmaWxsPSIjZmZmIi8+CiAgICAgIDxwYXRoIGlkPSJQYXRoXzYzMiIgZGF0YS1uYW1lPSJQYXRoIDYzMiIgZD0iTS0yNDcuMzQ4LDI4OS4yNjZsLTEuOC0uNzM5LTEuNTIzLTMuNGExLjQzNCwxLjQzNCwwLDAsMC0xLjMwNi0uODQ3aC0xMy40NjZhLjcuNywwLDAsMC0uNy43djEuMzQ2aC43YS43LjcsMCwwLDEsLjcuNy43LjcsMCwwLDEtLjcuN2gtLjd2MS40aDIuNDI0YS43LjcsMCwwLDEsLjcuNy43LjcsMCwwLDEtLjcuN2gtMi40MjR2MS40aC43YS43LjcsMCwwLDEsLjcuNy43LjcsMCwwLDEtLjcuN2gtLjd2MS40MjRhLjcuNywwLDAsMCwuNy43aC4yNjNhMi44NywyLjg3LDAsMCwxLDIuOC0yLjI1OCwyLjg3LDIuODcsMCwwLDEsMi44LDIuMjU4aDcuMTE2YTIuODcsMi44NywwLDAsMSwyLjgtMi4yNTgsMi44NywyLjg3LDAsMCwxLDIuOCwyLjI1OGguNWEuNy43LDAsMCwwLC43LS43di0yLjk4OUEyLjY3NSwyLjY3NSwwLDAsMC0yNDcuMzQ4LDI4OS4yNjZabS02LjcwOC4wMmEuNy43LDAsMCwxLS43LS43VjI4NS41MWgyLjc3NGMuMDEzLDAsMS42NjcsMy42NzcsMS42NjcsMy42NzdhLjY5LjY5LDAsMCwwLC4wNTUuMVoiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDI2OS41NTEgLTI4NC4yNzgpIiBmaWxsPSIjZmZmIi8+CiAgICAgIDxwYXRoIGlkPSJQYXRoXzYzMyIgZGF0YS1uYW1lPSJQYXRoIDYzMyIgZD0iTS0zMDYuMzY5LDQ0Ny44MzdhLjcuNywwLDAsMC0uNy43LjcuNywwLDAsMCwuNy43aDEuMjEydi0xLjRaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgzMDguNTU5IC00NDAuMTk3KSIgZmlsbD0iI2ZmZiIvPgogICAgICA8cGF0aCBpZD0iUGF0aF82MzQiIGRhdGEtbmFtZT0iUGF0aCA2MzQiIGQ9Ik0tMzA2LjM2OSwzODcuOTU0YS43LjcsMCwwLDAtLjcuNy43LjcsMCwwLDAsLjcuN2gxLjIxMnYtMS40WiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMzA4LjU1OSAtMzgzLjExMSkiIGZpbGw9IiNmZmYiLz4KICAgICAgPHBhdGggaWQ9IlBhdGhfNjM1IiBkYXRhLW5hbWU9IlBhdGggNjM1IiBkPSJNLTMzOC4zLDMyOC4wNjdhLjcuNywwLDAsMC0uNy43LjcuNywwLDAsMCwuNy43aDIuN3YtMS40WiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMzM4Ljk5OCAtMzI2LjAyMikiIGZpbGw9IiNmZmYiLz4KICAgIDwvZz4KICA8L2c+Cjwvc3ZnPgo=">
                                                                                    <div class="tooltip-free">
                                                                                        Miễn phí
                                                                                        vận
                                                                                        chuyển
                                                                                        trong
                                                                                        30km
                                                                                    </div>
                                                                                </div>
                                                                            </div>*/?>
                                                                        </div>
                                                                        <div class="product details product-item-details active-tragop">
                                                                            <h3 class="product-item-link">
                                                                                <a href="<?php echo $href?>"><?php echo $title?></a>
                                                                            </h3>
                                                                            <div class="price-freeship">
                                                                                <div class="price-pr">
                                                                                    <div class="price-box price-final_price">

                                                                                        <div class="normal-price 12">
                                                                                            <label class="label-status listing">Chỉ Còn</label>
                                                                                            <label class="label-status detail"
                                                                                                   style="display : none;">Giá</label>


                                                                                            <span class="price-container price-final_price tax">
    <span id="old-price-2649-final_price" class="price-wrapper "><span class="price"><?php echo $getPrice['price_final']?></span></span>
        </span>
                                                                                        </div>

                                                                                        <div class="old-price sly-old-price">
                                                                                            <label class="label-status"
                                                                                                   style="display : none; width: 170px;"></label>


                                                                                            <span class="price-container price-final_price tax">
    <span id="old-price-2649-final_price" class="price-wrapper "><span
                class="price"><?php echo $getPrice['price_old']?></span></span>
        </span>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                                <?php /*<div class="tra-gop-pr">
                                                                                    <span>Trả góp từ</span>
                                                                                    <div class="pricesssss appen">
                                                                                        468.750&nbsp;₫
                                                                                    </div>
                                                                                </div>*/?>
                                                                            </div>
                                                                            <div class="view-detail">
                                                                                <a href="<?php echo $href?>">Xem chi tiết</a>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <?php }?>

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
                <?php } ?>
                <?php } ?>
            <?php } ?>

            <style xml="space">
                .page-main .block-static-block .cdz-block-title {
                    border-bottom: 0px;
                }

                .flash-sale-items .product.data.items > .item.content {
                    margin-top: 0
                }

                .cdz-block-title.row {
                    display: flex;
                    flex-wrap: wrap;
                }

                .cdz-block-title.row .banner {
                    -webkit-box-flex: 0;
                    -ms-flex: 0 0 75%;
                    flex: 0 0 75%;
                    max-width: 75%;
                    padding: 0 10px;
                }

                .cdz-block-title.row .banner2 {
                    -webkit-box-flex: 0;
                    -ms-flex: 0 0 100%;
                    flex: 0 0 100%;
                    max-width: 100%;
                    padding: 0 10px;
                }

                .cdz-block-title.row .form-get-coupon {
                    -webkit-box-flex: 0;
                    -ms-flex: 0 0 25%;
                    flex: 0 0 25%;
                    max-width: 25%;
                    padding: 0 10px;
                }

                .cdz-block-title.row .form-get-coupon .wpcf7-form {
                    padding: 20px 20px 34px;
                    background: #fff;
                    box-shadow: 0 0 10px #ddd;
                }

                .cdz-block-title.row .form-get-coupon .wpcf7-form .head-form {
                    color: #000080;
                }

                .cdz-block-title.row .form-get-coupon .wpcf7-form .head-form .title-form {
                    font-weight: 600;
                    font-size: 22px;
                    line-height: 22px;
                }

                .cdz-block-title.row .form-get-coupon .wpcf7-form .head-form .price-voucher {
                    line-height: 32px;
                    font-weight: 700;
                    font-size: 32px;
                }

                .cdz-block-title.row .form-get-coupon .wpcf7-form .input-form {
                    margin-top: 20px;
                }

                .cdz-block-title.row .form-get-coupon .wpcf7-form .input-form .input-voucher {
                    border: 1px solid #ddd;
                    vertical-align: middle;
                    background-color: #fff;
                    color: #333;
                    box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
                    transition: color 0.3s, border 0.3s, background 0.3s, opacity 0.3s;
                    font-style: normal;
                    padding: 0 10px;
                    margin-bottom: 15px;
                    height: 38px;
                    line-height: 38px;
                }

                .cdz-block-title.row .form-get-coupon .wpcf7-form .input-form .button-submit {
                    border-radius: 0 !important;
                    background-color: #ff2727;
                    color: #fff;
                    width: 100%;
                    border: 0;
                    height: 38px;
                    line-height: 38px;
                    font-size: 18px;
                }

                .wrapper-breadcrums, .page-title-wrapper {
                    display: none;
                }

                @media (max-width: 767px) {
                    #header-general {
                        display: none;
                    }

                    .cdz-block-title.row .banner {
                        -webkit-box-flex: 0;
                        -ms-flex: 0 0 100%;
                        flex: 0 0 100%;
                        max-width: 100%;
                        margin-bottom: 20px;
                    }

                    .cdz-block-title.row .banner2 {
                        -webkit-box-flex: 0;
                        -ms-flex: 0 0 100%;
                        flex: 0 0 100%;
                        max-width: 100%;
                        margin-bottom: 20px;
                    }

                    .cdz-block-title.row .form-get-coupon {
                        -webkit-box-flex: 0;
                        -ms-flex: 0 0 100%;
                        flex: 0 0 100%;
                        max-width: 100%;
                    }
                }

                @media (max-width: 767px){
                    body .page-wrapper .page-main .widget.block.block-static-block .products-grid .product-items:not(.owl-carousel) > .product-item {
                        width: 50% !important;
                    }
                }

                </style>
            <div class="description_tragop" style="font-size: 15px">
                <?php echo $this->fcSystem['link_mota_tragop'] ?>

            </div>

        </div>
    </div>
</main>