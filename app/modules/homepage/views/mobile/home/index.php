<?php if (isset($slide) && is_array($slide) && count($slide)) { ?>

    <div id="main" class="wrapper">
        <div class="swiper-container slider-main">
            <div class="swiper-wrapper">

                <?php foreach ($slide as $key => $val) { ?>
                    <div class="swiper-slide"><img src="<?php echo $val['src'] ?>"
                                                   alt="<?php echo $val['title'] ?>"></div>
                <?php } ?>

            </div>
            <div class="swiper-pagination"></div>
            <!-- <div class="swiper-pagination fraction"></div> -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            <span class="fraction"></span>
        </div>

    </div>
<?php } ?>


<section class="filter-product  ">
    <div class="container">
        <div class="title-title center">
            <h2 class="title-primary"><?php echo $this->fcSystem['title_title1'] ?></h2>

        </div>
        <?php echo $this->load->view('homepage/mobile/common/search') ?>
    </div>
</section>
<?php if (isset($sanphammoi) && is_array($sanphammoi) && count($sanphammoi)) { ?>

    <section class="product-new product-new1">
        <div class="container">
            <div class="title-title center">
                <h2 class="title-primary">Sản phẩm mới về</h2>
            </div>
            <div class="nav-product-new">
                <div class="row">
                    <?php foreach ($sanphammoi as $key => $val) {
                        $title = $val['title'];
                        $href = rewrite_url($val['canonical'], TRUE, TRUE);
                        $getPrice = getPriceFrontend(array('productDetail' => $val));
                        $listAlbums = json_decode($val['albums'], TRUE);
                        $json = [];
                        $json[] = array('attribute', 'attribute.id = attribute_relationship.attrid', 'full');
                        $json[] = array('attribute_catalogue', 'attribute_catalogue.id = attribute.catalogueid', 'full');
                        $listColor = $this->Autoload_Model->_get_where(array(
                            'select' => 'attribute.color',
                            'table' => 'attribute_relationship',
                            'where' => array('moduleid' => $val['id'], 'attribute_catalogue.issearch' => 1, 'module' => 'product'),
                            'join' => $json,
                            'order_by' => 'attribute.order asc, attribute.id desc'), true);
                        ?>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="item-large">
                                <div class="item1">

                                    <div class="slider-large">
                                        <div class="item" data-hash="one">
                                            <a href="<?php echo $href ?>"><img src="<?php echo $val['image'] ?>"
                                                                               alt="<?php echo $title ?>"
                                                                               style="width: 100%;height: 287px;object-fit: cover"></a>
                                        </div>

                                    </div>
                                    <?php if (isset($listColor) && is_array($listColor) && count($listColor)) { ?>
                                        <div class="slider-small">
                                            <?php foreach ($listColor as $keyC => $valC) { ?>
                                                <a href="javascript:void(0)"
                                                   style="background: <?php echo $valC['color'] ?>">
                                                </a>
                                            <?php } ?>

                                        </div>
                                    <?php } ?>
                                    <div class="nav-item1">
                                        <h3 class="title-product"><a href="<?php echo $href ?>"><?php echo $title ?></a>
                                        </h3>
                                        <p class="price"><?php echo $getPrice['price_final'] ?></p>
                                    </div>


                                </div>

                            </div>
                        </div>
                    <?php } ?>


                    <?php /*<div class="xemtatca">
                    <a href="">Xem tất cả</a>
                </div>*/ ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<?php if (isset($product_catalog_ishome) && is_array($product_catalog_ishome) && count($product_catalog_ishome)) { ?>
    <?php foreach ($product_catalog_ishome as $key => $val) {
        $title = $val['title'];
        $href = rewrite_url($val['canonical'], TRUE, TRUE); ?>
        <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>

            <section class="accessories-home  ">
                <div class="container">
                    <div class="title-title center">
                        <h2 class="title-primary"><?php echo $title ?></h2>

                    </div>
                    <div class="nav-accessories-home">

                        <?php foreach ($val['post'] as $keyP => $valP) {
                            $titleP = $valP['title'];
                            $hrefP = rewrite_url($valP['canonical'], TRUE, TRUE);
                            $getPrice = getPriceFrontend(array('productDetail' => $valP));
                            $json = [];
                            $json[] = array('attribute', 'attribute.id = attribute_relationship.attrid', 'full');
                            $json[] = array('attribute_catalogue', 'attribute_catalogue.id = attribute.catalogueid', 'full');
                            $listColor = $this->Autoload_Model->_get_where(array(
                                'select' => 'attribute.color',
                                'table' => 'attribute_relationship',
                                'where' => array('moduleid' => $valP['id'], 'attribute_catalogue.issearch' => 1, 'module' => 'product'),
                                'join' => $json,
                                'order_by' => 'attribute.order asc, attribute.id desc'), true);
                            ?>
                            <div class="item-large">
                                <div class="item1">

                                    <div class="slider-large">
                                        <div class="item">
                                            <a href="<?php echo $hrefP ?>"><img src="<?php echo $valP['image'] ?>"
                                                                                alt="<?php echo $valP['title'] ?>"></a>
                                        </div>


                                    </div>

                                    <div class="nav-item1">
                                        <h3 class="title"><a
                                                    href="<?php echo $hrefP ?>"><?php echo $valP['title'] ?></a></h3>
                                        <p class="price"><?php echo $getPrice['price_final'] ?></p>
                                    </div>
                                    <?php if (isset($listColor) && is_array($listColor) && count($listColor)) { ?>
                                        <div class="slider-small">
                                            <?php foreach ($listColor as $keyC => $valC) { ?>
                                                <a href="javascript:void(0)"
                                                   style="background: <?php echo $valC['color'] ?>">
                                                </a>
                                            <?php } ?>

                                        </div>
                                    <?php } ?>


                                </div>

                            </div>
                        <?php } ?>

                        <div class="clearfix"></div>
                    </div>
                    <div class="xemtatca">
                        <a href="<?php echo $href ?>">Xem tất cả</a>
                    </div>
                </div>
            </section>
        <?php } ?>
    <?php } ?>
<?php } ?>

<?php if (isset($sanphambanchay) && is_array($sanphambanchay) && count($sanphambanchay)) { ?>

    <section class="selling-products">
        <div class="container">
            <div class="title-title center">
                <h2 class="title-primary">Sản phẩm bán chạy</h2>
            </div>
            <div class="nav-selling-products">
                <div class="row">
                    <?php foreach ($sanphammoi as $key => $val) {
                        $title = $val['title'];
                        $href = rewrite_url($val['canonical'], TRUE, TRUE);
                        $getPrice = getPriceFrontend(array('productDetail' => $val));
                        $listAlbums = json_decode($val['albums'], TRUE);
                        $json = [];
                        $json[] = array('attribute', 'attribute.id = attribute_relationship.attrid', 'full');
                        $json[] = array('attribute_catalogue', 'attribute_catalogue.id = attribute.catalogueid', 'full');
                        $listColor = $this->Autoload_Model->_get_where(array(
                            'select' => 'attribute.color',
                            'table' => 'attribute_relationship',
                            'where' => array('moduleid' => $val['id'], 'attribute_catalogue.issearch' => 1, 'module' => 'product'),
                            'join' => $json,
                            'order_by' => 'attribute.order asc, attribute.id desc'), true);
                        ?>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="item-selling">

                                <div class="slider-large ">
                                    <div class="item" data-hash="anh1">
                                        <a href="<?php echo $href ?>"><img src="<?php echo $val['image'] ?>"
                                                                           alt="<?php echo $title ?>"></a>
                                    </div>


                                </div>

                                <div class="nav-item1">
                                    <h3 class="title-product"><a href="<?php echo $href ?>"><?php echo $title ?></a>
                                    </h3>
                                    <p class="price"><?php echo $getPrice['price_final'] ?></p>
                                </div>
                                <?php if (isset($listColor) && is_array($listColor) && count($listColor)) { ?>
                                    <div class="slider-small">
                                        <?php foreach ($listColor as $keyC => $valC) { ?>
                                            <a href="javascript:void(0)"
                                               style="background: <?php echo $valC['color'] ?>">
                                            </a>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>


                </div>
            </div>
        </div>
    </section>
<?php } ?>

<?php if (isset($tintuc) && is_array($tintuc) && count($tintuc)) { ?>
    <?php foreach ($tintuc as $key => $val) {
        $hrefT = rewrite_url($val['canonical'], true, true); ?>
        <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
            <section class="new-page-home">
                <div class="container">
                    <div class="title-title center">
                        <h2 class="title-primary"><?php echo $val['title'] ?></h2>

                    </div>
                    <div class="slider-new owl-carousel">
                        <?php foreach ($val['post'] as $keyP => $valP) {
                            $href = rewrite_url($valP['canonical'], true, true); ?>
                            <div class="item">
                                <div class="image">
                                    <a href="<?php echo $href ?>"><img src="<?php echo $valP['image'] ?>"
                                                                       alt="<?php echo $valP['title'] ?>"></a>
                                </div>
                                <h3 class="title"><a href="<?php echo $href ?>"><?php echo $valP['title'] ?></a></h3>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </section>

        <?php } ?>
    <?php } ?>
<?php } ?>
<section class="register-home">
    <div class="container">
        <div class="title-title center">
            <h2 class="title-primary">Đăng ký tư vấn</h2>
        </div>
        <div class="nav-register-home">
            <form action="contact/frontend/contact/create" id="mailsubricre" class="form-footer">
                <div class="row">
                    <div class="error"></div>

                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="text" class="fullname" name="fullname" placeholder="Họ và tên">
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="text" class="email" name="email" placeholder="Email">
                    </div>
                </div>
                <input type="submit" value="Đăng ký ngay">
            </form>
        </div>
    </div>
</section>