<div id="main" class="wrapper main-Experimental">
    <style>
        .top-banner-right {
            position: absolute;
            right: 59px;
            top: 50%;
            transform: translateY(-50%);
            width: 423px;
        }
    </style>
    <?php /*<div id="banner" class="banner-child">
        <a href="javascript:void(0)" class="img-banner"><img
                src="<?php echo !empty($detailCatalogue['image']) ? $detailCatalogue['image'] : 'template/frontend/noithat-PC/images/banner2.png' ?>"
                alt="<?php echo $detailCatalogue['title'] ?>"></a>

        <h3 class="title-category"><a href="javascript:void(0);"><?php echo $detailCatalogue['title'] ?></a></h3>
        <?php echo $this->load->view('homepage/frontend/common/rightBanner') ?>

    </div>*/ ?>

    <section class="content-Experimental content-Experimental-bottom">
        <div class="container-fluid">
            <h2 class="title-primary1">XEM <?php echo $detailCatalogue['title'] ?></h2>

            <div class="row">
                <div class="content-Experimental-right">


                    <?php if (isset($mediaList) && is_array($mediaList) && count($mediaList)) { ?>
                        <?php foreach ($mediaList as $key => $val) {
                            $href = rewrite_url($val['canonical'], TRUE, TRUE); ?>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <div class="item1">
                                    <div class="image">
                                        <a href="<?php echo $href ?>"><img src="<?php echo $val['image'] ?>"
                                                                           alt="<?php echo $val['title'] ?>"></a>
                                    </div>
                                    <div class="nav-image">
                                        <h3 class="title"><a href="<?php echo $href ?>"><?php echo $val['title'] ?></a>
                                        </h3>
                                        <ul>
                                            <li>
                                                <div class="fb-like" data-href="<?php echo $href ?>" data-width=""
                                                     data-layout="button" data-action="like" data-size="small"
                                                     data-share="true"></div>
                                            </li>

                                            <?php if ($val['viewed'] > 0) { ?>
                                                <li><?php echo $val['viewed'] ?> <img
                                                        src="template/frontend/noithat-PC/images/i3.png" alt="lượt xem">
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <div class="clearfix"></div>
                    <div class="pagenavi" id="pagination">
                        <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>

                    </div>

                </div>
            </div>
        </div>
    </section>


    <?php echo $this->load->view('homepage/frontend/common/tag') ?>


    <?php echo $this->load->view('homepage/frontend/common/mailsubricre') ?>


</div>
