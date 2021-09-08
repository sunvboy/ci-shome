<div id="main" class="wrapper main-list-product">

    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="<?php echo base_url() ?>">Trang chủ</a></li>
                <li><a href="javascript:void(0)"> / Kết quả tìm kiếm</a></li>

            </ul>
        </div>
    </div>
    <section class="filter-product  ">
        <div class="container">
            <div class="title-title center">
                <h2 class="title-primary">Kết quả tìm kiếm</h2>
            </div>
        </div>
    </section>
    <section class="product-new">
        <div class="container">

            <div class="nav-product-new">
                <div class="row">

                    <?php if (isset($productList) && is_array($productList) && count($productList)) { ?>
                        <?php foreach ($productList as $key => $val) {

                            $title = $val['title'];
                            $href = rewrite_url($val['canonical'], TRUE, TRUE);
                            $getPrice = getPriceFrontend(array('productDetail' => $val));
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
                                <div class="item-large">
                                    <div class="item1">

                                        <div class="slider-large ">
                                            <div class="item" data-hash="one2">
                                                <a href="<?php echo $href?>"><img src="<?php echo $val['image']?>" alt="<?php echo $val['title']?>"></a>
                                            </div>

                                        </div>

                                        <div class="nav-item1">
                                            <h3 class="title-product"><a href="<?php echo $href?>"><?php echo $val['title']?></a></h3>
                                            <p class="price"><?php echo $getPrice['price_final']?></p>
                                        </div>
                                        <?php if (isset($listColor) && is_array($listColor) && count($listColor)) { ?>
                                            <div class="slider-small">
                                                <?php foreach ($listColor as $keyC => $valC) {?>
                                                    <a href="javascript:void(0)" style="background: <?php echo $valC['color']?>">
                                                    </a>
                                                <?php }?>
                                            </div>
                                        <?php }?>



                                    </div>

                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>


                </div>
            </div>
            <div class="pagenavi ">
                <ul>
                    <li>
                        <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>

                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="filter-product  ">
        <div class="container">

            <?php echo $this->load->view('homepage/mobile/common/search')?>

        </div>
    </section>

</div>
