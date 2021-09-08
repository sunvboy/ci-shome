<div id="topcontent" class="top-main-wrapper">
    <div class="widget block block-static-block">
        <div class="slideshow-container not-display-on-desktop"></div>
    </div>
    <div class="widget block block-static-block">
        <div class="slideshow-container not-display-on-mobile">
            <div id="homepage-slider">
                <div class="header-homepage-slider container">
                    <div class="row">
                        <?php if (isset($slide) && is_array($slide) && count($slide)) { ?>

                            <div class="slider-block">
                                <div class="slider-image owl-carousel owl-theme owl-loaded owl-drag">
                                    <?php foreach ($slide as $key => $val) { ?>
                                        <div class="item-image"><a href="<?php echo $val['link'] ?>"><img
                                                        src="<?php echo $val['src'] ?>"
                                                        alt="<?php echo $val['title'] ?>"></a>
                                        </div>
                                    <?php } ?>

                                </div>
                                <div class="detail-slider owl-carousel owl-theme owl-loaded owl-drag">
                                    <?php foreach ($slide as $key => $val) { ?>
                                        <div class="item-caption">
                                            <div><p class="title font-bold-stag"><?php echo $val['title'] ?></p>
                                                <p class="description"><?php echo $val['description'] ?></p></div>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                        <?php } ?>
                        <?php if (isset($albums) && is_array($albums) && count($albums)) { ?>

                            <div class="listing-block">

                                <?php foreach ($albums as $key => $val) {
                                    if ($key <= 2) { ?>
                                        <div class="image"><a href="<?php echo $val['link'] ?>"><img
                                                        src="<?php echo $val['src'] ?>" width="787"
                                                        alt="<?php echo $val['title'] ?>"
                                                        height="238"></a>
                                        </div>
                                    <?php } ?>
                                <?php } ?>


                                <style>
                                    body #shomesolution-flash-sales-new .sales-of p {
                                        display: none;
                                    }
                                </style>
                                <style>
                                    #shomesolution-flash-sales-new .hot-deal .VueCarousel .VueCarousel-wrapper .VueCarousel-slide .product-item-details .status-ship .ship > span.color-green {
                                        display: inline-block;
                                    }
                                </style>
                            </div>
                        <?php } ?>


                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div id="shomesolution-homepage" class="shomesolution-homepage">


    <?php
    $listBrand = $this->Autoload_Model->_get_where(array(
        'select' => 'id, title,canonical,image',
        'table' => 'product_brand',
        'where' => array('publish' => 0, 'ishome' => 1, 'alanguage' => $this->fclang),
        'limit' => 11,
        'order_by' => 'order asc,id desc',
    ), TRUE);
    ?>
    <?php if (isset($listBrand) && is_array($listBrand) && count($listBrand)) { ?>
        <div id="HomepageBrand" class="section-tabs-brand items-6 mb20 loaded">
            <div class="container">
                <div class="wapper-items"><h2><?php echo $this->fcSystem['title_title_5']?></h2>
                    <div class="section-brand">

                        <?php /*  <div class="item"><a href="/brand/amando?src=brand-select"> <img  src="https://media.shomesolution.com/wysiwyg/v2-new/Amando.png" alt=""></a>
                        <div class="content-hover"><span class="sub-title">Mua 1</span><span class="title">Tặng 1</span><a href="/brand/amando?src=brand-select">Xem ngay</a>
                        </div>
                    </div>*/ ?>
                        <?php foreach ($listBrand as $key => $val) {
                            $href = rewrite_url($val['canonical'], TRUE, TRUE); ?>
                            <div class="item"><a href="<?php echo $href ?>"><img src="<?php echo $val['image'] ?>"
                                                                                 alt="<?php echo $val['title'] ?>"></a>
                            </div>
                        <?php } ?>

                        <div class="item view-more desktop"><a style="padding: 0px" href="<?php echo $this->fcSystem['link_xemthem']?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="203.25" height="128"
                                 viewBox="0 0 203.25 128">
                                <g id="btn-view-more" transform="translate(-1101.5 -1371)">
                                    <path id="Path_1100" data-name="Path 1100"
                                          d="M0,1H203.25V106a23.13,23.13,0,0,1-23.257,23H0Z"
                                          transform="translate(1101.5 1370)" fill="#e5f6ff"></path>
                                    <text id="Xem_thêm" data-name="Xem thêm" transform="translate(1135 1441)"
                                          fill="#20315c" font-size="16" font-family="Averta" font-weight="600"
                                          letter-spacing="0.116em">
                                        <tspan x="0" y="0">XEM THÊM</tspan>
                                    </text>
                                    <g id="Group_2161" data-name="Group 2161" transform="translate(1240.721 1295.543)">
                                        <g id="Group_2160" data-name="Group 2160" transform="translate(0 132)">
                                            <path id="Path_1099" data-name="Path 1099"
                                                  d="M27.2,137.9h0l-5.616-5.589a1.075,1.075,0,0,0-1.516,1.524l3.77,3.752H1.075a1.075,1.075,0,1,0,0,2.149h22.76l-3.77,3.752a1.075,1.075,0,0,0,1.516,1.524l5.616-5.589h0A1.076,1.076,0,0,0,27.2,137.9Z"
                                                  transform="translate(0 -132)" fill="#20315c"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    <?php } ?>



    <?php /*if (isset($product_catalog_ishome) && is_array($product_catalog_ishome) && count($product_catalog_ishome)) { ?>
        <?php foreach ($product_catalog_ishome as $key => $val) {
            if (isset($val['post']) && is_array($val['post']) && count($val['post'])) {
                if ($key == 0) {
                    $href = rewrite_url($val['canonical'], TRUE, TRUE); ?>
                    <div class="section-product mb20 loaded">
                        <div class="container">
                            <div class="add-background-white">
                                <div class="cdz-block-titles mobile"><h2 class="title-block "><?php echo $val['title'] ?></h2>
                                </div>
                                <div class="product-wapper row">
                                    <div class="col-md-6 hidden-xs">
                                        <p><a href="<?php echo $href ?>"><img src="<?php echo $val['image'] ?>"
                                                                              width="295"
                                                                              height="855"></a>
                                        </p>
                                    </div>
                                    <div class="col-md-18">
                                        <div class="row product-listing grid">

                                            <?php foreach ($val['post'] as $k => $v) { ?>
                                                <div class="col-sm-8 flex product-item col-md-8 col-xs-12 item">

                                                    <?php echo itemProduct($v)?>

                                                </div>
                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    <?php }*/ ?>


    <?php if (isset($HomeCategoryNem) && is_array($HomeCategoryNem) && count($HomeCategoryNem)) { ?>
        <div id="HomeCategoryNem" class="section-tabs-brand items-4 mb20 loaded">
            <div class="container">
                <?php
                $slide_bep = slide(array('keyword' => 'combo-bep'), $this->fc_lang);
                ?>
                <?php if (isset($slide_bep) && is_array($slide_bep) && count($slide_bep)) { ?>
                    <div class="wapper-items"><h2><?php echo $this->fcSystem['title_title_1']?></h2>
                        <div class="row">


                            <?php foreach ($slide_bep as $k=>$v){?>
                                <div class="col-md-8 col-xs-24 col-sm-8">
                                    <a href="<?php echo $v['link'] ?>"><img style="margin-bottom: 5px" src="<?php echo $v['src'] ?>" width="787" alt="banner" height="238"></a>
                                </div>
                            <?php }?>


                        </div>

                    </div>
                <?php }?>
                <div class="wapper-items"><h2><?php echo $this->fcSystem['title_title_2']?></h2>
                    <div class="section-brand">
                        <?php foreach ($HomeCategoryNem as $key => $val) { ?>
                            <div class="item">
                                <a href="<?php echo $val['link'] ?>" style="border-bottom: 0px"> <img src="<?php echo $val['src'] ?>" alt="<?php echo $val['title'] ?>">
                                    <div style="width: 100%;text-align: center;font-weight: bold;margin-top: 10px"><?php echo $val['title'] ?></div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="banner-image ">
                        <?php if ($this->fcSystem['banner_tragop_pc'] != '') { ?>
                            <img class="desktop" src="<?php echo $this->fcSystem['banner_tragop_pc'] ?>" width="1200"
                                 height="146" alt="trả góp pc">
                        <?php } ?>
                        <?php iF ($this->fcSystem['banner_tragop_mobile'] != '') { ?>
                            <img class="mobile" src="<?php echo $this->fcSystem['banner_tragop_mobile'] ?>"
                                 alt="trả góp mobile">
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    <?php } ?>


    <?php if (isset($product_catalog_ishome) && is_array($product_catalog_ishome) && count($product_catalog_ishome)) { ?>
        <?php foreach ($product_catalog_ishome as $key => $val) {
            if (isset($val['post']) && is_array($val['post']) && count($val['post'])) {
                if ($key == 1) {
                    $href = rewrite_url($val['canonical'], TRUE, TRUE); ?>
                    <div class="section-product mb20 loaded">
                        <div class="container">
                            <div class="add-background-white">
                                <div class="cdz-block-titles mobile"><h2
                                            class="title-block "><?php echo $val['title'] ?></h2>
                                </div>
                                <div class="product-wapper row">
                                    <div class="col-md-6 hidden-xs">
                                        <p><a href="<?php echo $href ?>"><img src="<?php echo $val['image'] ?>"
                                                                              width="295"
                                                                              height="855"></a>
                                        </p>
                                    </div>
                                    <div class="col-md-18">
                                        <div class="row product-listing grid">

                                            <?php foreach ($val['post'] as $k => $v) { ?>
                                                <div class="col-sm-8 flex product-item col-md-8 col-xs-12 item">

                                                    <?php echo itemProduct($v)?>

                                                </div>
                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    <?php } ?>



    <?php if (isset($HomepageSize) && is_array($HomepageSize) && count($HomepageSize)) { ?>
        <?php
        $slide_tam = slide(array('keyword' => 'combo-tam'), $this->fc_lang);
        ?>
        <div id="HomepageSize" class="section-tabs-brand items-5 mb20 loaded">
            <div class="container">

                <?php if (isset($slide_tam) && is_array($slide_tam) && count($slide_tam)) { ?>
                <div class="wapper-items"><h2><?php echo $this->fcSystem['title_title_3']?></h2>
                    <div class="row">


                        <?php foreach ($slide_tam as $k=>$v){?>
                            <div class="col-md-8 col-xs-24 col-sm-8">
                                <a href="<?php echo $v['link'] ?>"><img style="margin-bottom: 5px" src="<?php echo $v['src'] ?>" width="787" alt="banner" height="238"></a>
                            </div>
                        <?php }?>

                    </div>

                </div>
                <?php }?>



                <div class="wapper-items"><h2><?php echo $this->fcSystem['title_title_4']?></h2>
                    <div class="section-brand">
                        <?php foreach ($HomepageSize as $key => $val) { ?>

                           <div class="item">
                               <a href="<?php echo $val['link'] ?>" style="border-bottom: 0px"> <img src="<?php echo $val['src'] ?>"
                                                                                                     alt="<?php echo $val['title'] ?>">
                                   <div style="width: 100%;text-align: center;font-weight: bold;margin-top: 10px"><?php echo $val['title'] ?></div>

                               </a>

                           </div>
                        <?php } ?>

                    </div>
                    <div class="banner-image">
                        <?php if ($this->fcSystem['banner_tragop_pc'] != '') { ?>
                            <img class="desktop" src="<?php echo $this->fcSystem['banner_365_pc'] ?>" width="1200"
                                 height="146" alt="trả góp pc">
                        <?php } ?>
                        <?php iF ($this->fcSystem['banner_tragop_mobile'] != '') { ?>

                            <img class="mobile" src="<?php echo $this->fcSystem['banner_365_mobile'] ?>"
                                 alt="trả góp mobile">
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    <?php } ?>


    <?php if (isset($product_catalog_ishome) && is_array($product_catalog_ishome) && count($product_catalog_ishome)) { ?>
        <?php foreach ($product_catalog_ishome as $key => $val) {
            if (isset($val['post']) && is_array($val['post']) && count($val['post'])) {
                if ($key == 0) {
                    $href = rewrite_url($val['canonical'], TRUE, TRUE); ?>
                    <div class="section-product mb20 loaded">
                        <div class="container">
                            <div class="add-background-white">
                                <div class="cdz-block-titles mobile"><h2
                                            class="title-block "><?php echo $val['title'] ?></h2>
                                </div>
                                <div class="product-wapper row">
                                    <div class="col-md-6 hidden-xs">
                                        <p><a href="<?php echo $href ?>"><img src="<?php echo $val['image'] ?>"
                                                                              width="295"
                                                                              height="855"></a>
                                        </p>
                                    </div>
                                    <div class="col-md-18">
                                        <div class="row product-listing grid">

                                            <?php foreach ($val['post'] as $k => $v) { ?>
                                                <div class="col-sm-8 flex product-item col-md-8 col-xs-12 item">

                                                    <?php echo itemProduct($v)?>

                                                </div>
                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    <?php } ?>


    <div class="shomesolution-blog-list">
        <div class="container">
            <div id="shomesolution-blog-list" class="loaded" dataload="true">
                <div class="blog-wapper row">
                    <?php if (isset($tintuc) && is_array($tintuc) && count($tintuc)) { ?>
                        <?php foreach ($tintuc as $key => $val) {
                            $hrefT = rewrite_url($val['canonical'], true, true); ?>
                            <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
                                <div class="col-md-16">


                                    <div class="title-blog"><h2><?php echo $val['title'] ?></h2> <a
                                                href="<?php echo $hrefT ?>" class="desktop">Xem tất cả</a>
                                    </div>

                                    <div class="content-blog">
                                        <div class="right-column">
                                            <?php foreach ($val['post'] as $keyP => $valP) {
                                                $href = rewrite_url($valP['canonical'], true, true); ?>
                                                <div class="item-blog">
                                                    <div class="image-blog">
                                                        <a href="<?php echo $href ?>"><img
                                                                    src="<?php echo $valP['image'] ?>"
                                                                    alt="<?php echo $valP['title'] ?>"
                                                                    style="height: 74px;object-fit: cover"></a>
                                                    </div>
                                                    <div class="detail-blog"><h3 class="name-blog "><a
                                                                    href="<?php echo $href ?>"><?php echo $valP['title'] ?></a>
                                                        </h3>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="read-more">
                                        <a href="<?php echo $hrefT ?>" class="mobile">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="128.234" height="19"
                                                 viewBox="0 0 128.234 19">
                                                <g id="ic-view-more" transform="translate(-1138 -1425)">
                                                    <g id="Group_2286" data-name="Group 2286">
                                                        <text id="Xem_tất_cả" data-name="Xem tất cả"
                                                              transform="translate(1138 1441)" fill="#20315c"
                                                              font-size="16"
                                                              font-family="Averta" font-weight="600">
                                                            <tspan x="0" y="0">XEM TẤT CẢ</tspan>
                                                        </text>
                                                        <g id="Group_2161" data-name="Group 2161"
                                                           transform="translate(1238.721 1295.543)">
                                                            <g id="Group_2160" data-name="Group 2160"
                                                               transform="translate(0 132)">
                                                                <path id="Path_1099" data-name="Path 1099"
                                                                      d="M27.2,137.9h0l-5.616-5.589a1.075,1.075,0,0,0-1.516,1.524l3.77,3.752H1.075a1.075,1.075,0,1,0,0,2.149h22.76l-3.77,3.752a1.075,1.075,0,0,0,1.516,1.524l5.616-5.589h0A1.076,1.076,0,0,0,27.2,137.9Z"
                                                                      transform="translate(0 -132)"
                                                                      fill="#20315c"></path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>

                    <?php if (isset($danhmuc) && is_array($danhmuc) && count($danhmuc)) { ?>
                        <?php foreach ($danhmuc as $key => $val) {
                            $hrefT = rewrite_url($val['canonical'], true, true); ?>
                            <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
                                <div class="col-md-8">
                                    <div class="blog-wappers">
                                        <div class="title-blog">
                                            <h2><?php echo $val['title'] ?></h2>
                                            <a class="desktop" href="<?php echo $hrefT ?>">Xem tất cả</a>
                                        </div>
                                        <div class="content-blog video">
                                            <?php foreach ($val['post'] as $keyP => $valP) {
                                                $href = rewrite_url($valP['canonical'], true, true); ?>
                                                <div class="item-blog ">
                                                    <div class="image-blog"><a
                                                                href="<?php echo $href ?>"
                                                                target="_blank"><img
                                                                    style="height: 74px;object-fit: cover"
                                                                    src="<?php echo $valP['image'] ?>"
                                                                    width="100" height="74"></a></div>
                                                    <div class="detail-blog">
                                                        <h3 class="name-blog "><a
                                                                    href="<?php echo $href ?>"><?php echo $valP['title'] ?></a>
                                                        </h3>
                                                    </div>
                                                </div>
                                            <?php } ?>


                                        </div>
                                    </div>
                                </div>

                            <?php } ?>
                        <?php } ?>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
    <div class="shomesolution-store-locator">
        <div class="container">
            <div id="shomesolution-store-locator">
                <?php if (svl_ismobile() != 'is mobile') { ?>
                    <div class="store-text-desktop" style="position: relative">
                        <div style="    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    width: 100%;">
                            <div class="number-store item">
                                <div class="total-store"><span style="color: #d89b0f">Địa chỉ</span></div><p style="color: #d89b0f">cửa hàng</p>

                                <p>trên toàn quốc</p></div>
                            <div class="find-store item">
                                <a href="stores.html">Tìm cửa hàng gần nhất</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="store-image">
                    <img src="<?php echo $this->fcSystem['store_image'] ?>" alt="banner-store">
                </div>
                <?php if (svl_ismobile() == 'is mobile') { ?>
                    <div class="store-text-desktop">
                        <div class="number-store item" style="display: unset">


                            <div class="total-store" style="width: 100%"><span style="color: #d89b0f">Địa chỉ</span></div>
                            <p style="color: #d89b0f">cửa hàng</p>
                            <p>trên toàn quốc</p></div>
                        <div class="find-store item" style="margin-left: 0px;margin-right: 0px">
                            <a href="stores.html">Tìm cửa hàng gần nhất</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

