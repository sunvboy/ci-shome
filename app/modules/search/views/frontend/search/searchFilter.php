<div id="main" class="wrapper main-services">
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="<?php echo base_url() ?>"><?php echo $this->lang->line('home') ?> </a></li>

                <li><a href="javascript:void(0)"> / Kết quả tìm kiếm</a></li>

            </ul>
        </div>
    </div>



    <section class="last-rental wow fadeInUp">
        <div class="container">
            <div class="center">
                <h2 class="title-primary">Kết quả tìm kiếm</h2>
            </div>
            <?php if (isset($productList) && is_array($productList) && count($productList)) { ?>

                <div class="row">

                    <?php foreach ($productList as $keyP => $valP) {
                        $title = $valP['title'];
                        $href = rewrite_url($valP['canonical'], TRUE, TRUE);
                        $getPrice = getPriceFrontend(array('productDetail' => $valP));
                        $description = cutnchar(strip_tags($valP['description']), 100);
                        $getSupport = $this->Autoload_Model->_get_where(array(
                            'select' => 'fullname,image',
                            'table' => 'support',
                            'where' => array('id' => $valP['supportID']),
                        ));
                        $getArea = $this->Autoload_Model->_get_where(array(
                            'select' => 'title',
                            'table' => 'product_area',
                            'where' => array('id' => $valP['productAreaID']),
                        ));
                        if ($valP['donvi'] == 1) {
                            $donvi = 'day';

                        } else if ($valP['donvi'] == 2) {
                            $donvi = 'month';
                        } else if ($valP['donvi'] == 3) {
                            $donvi = 'year';
                        }

                        ?>

                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="item" style="margin-bottom: 15px">
                                <div class="image">
                                    <a href="<?php echo $href ?>"><img src="<?php echo $valP['image'] ?>"
                                                                       alt="<?php echo $title ?>"></a>
                                </div>
                                <div class="nav-image">
                                    <h3 class="title"><a href="<?php echo $href ?>"><?php echo $title ?> </a></h3>
                                    <div class="price-adress">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <span class="price">$ <?php echo $getPrice['price_final'] ?>
                                                    / <?php echo $donvi ?></span>
                                            </div>
                                            <?php if (!empty($getArea)) { ?>

                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <span class="adress-item"><i
                                                            class="fas fa-map-marker-alt"></i><?php echo $getArea['title'] ?></span>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <p class="desc"><?php echo $description ?></p>
                                    <div class="avt-add-to-cart">
                                        <div class="row">
                                            <?php if (!empty($getSupport)) { ?>
                                                <div class="col-md-6 col-sm-12 cl-xs-12">
                                                    <div class="avt">
                                                        <img src="<?php echo $getSupport['image'] ?>"
                                                             alt="<?php echo $getSupport['fullname'] ?>"><?php echo $getSupport['fullname'] ?>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                            <div class="col-md-6 col-sm-12 cl-xs-12">
                                                <div class="add-to-cary">
                                                    <button onclick="location.href='<?php echo $href ?>';"><?php echo $this->lang->line('view_more') ?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>


                </div>
            <?php } ?>
            <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>

        </div>
    </section>
    <?php

    if (!$i_catacon = $this->cache->get('i_catacon')) {
        $i_catacon = slide(array('keyword' => 'partner'), $this->fc_lang);
        $this->cache->save('i_catacon', $i_catacon, 200);
    } else {
        $i_catacon = $i_catacon;
    }
    ?>
    <?php if (isset($i_catacon) && is_array($i_catacon) && count($i_catacon)) { ?>

        <div class="band-logo wow fadeInUp">
            <div class="container">
                <div class="slider-logo owl-carousel">

                    <?php foreach ($i_catacon as $key => $val) { ?>

                        <div class="item">
                            <a href="<?php echo $val['link'] ?>" target="_blank"> <img src="<?php echo $val['src'] ?>"></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>


</div>