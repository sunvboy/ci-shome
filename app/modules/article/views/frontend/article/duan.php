<!-- Featured Title -->
<div id="featured-title" class="featured-title clearfix">
    <div id="featured-title-inner" class="container clearfix">
        <div class="featured-title-inner-wrap">
            <div id="breadcrumbs">
                <div class="breadcrumbs-inner">
                    <div class="breadcrumb-trail">
                        <a href="<?php echo base_url() ?>" class="trail-begin">Trang chủ</a>
                        <?php foreach ($breadcrumb as $key => $val) { ?>
                            <?php
                            $title = $val['title'];
                            $href = rewrite_url($val['canonical'], true, true);
                            ?>
                            <span class="sep">|</span>
                            <span class="trail-end"><?php echo $title; ?></span>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="featured-title-heading-wrap">
                <h1 class="feautured-title-heading">
                    <?php echo $detailCatalogue['title'] ?>
                </h1>
            </div>
        </div><!-- /.featured-title-inner-wrap -->
    </div><!-- /#featured-title-inner -->
</div>
<!-- End Featured Title -->

<!-- Main Content -->
<div id="main-content" class="site-main clearfix">
    <div id="content-wrap">
        <div id="site-content" class="site-content clearfix">
            <div id="inner-content" class="inner-content-wrap">
                <div class="page-content">
                    <!-- PROJECT DETAIL -->
                    <div class="row-project-detail">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="themesflat-spacer clearfix" data-desktop="10" data-mobile="10" data-smobile="10"></div>
                                    <div class="detail-inner-wrap">

                                        <div class="detail-gallery">
                                            <div class="themesflat-spacer clearfix" data-desktop="21" data-mobile="21" data-smobile="21"></div>
                                            <div class="row">
                                                <div class="col-md-2">

                                                </div>
                                                <div class="col-md-8">
                                                    <?php $listi = json_decode($detailArticle['albums'],TRUE);?>
                                                    <?php if(!empty($listi)){?>
                                                        <?php /* <div class="themesflat-gallery style-2 has-arrows arrow-center arrow-circle offset-v-82 has-thumb w185 clearfix" data-gap="0" data-column="1" data-column2="1" data-column3="1" data-auto="false">
                                                            <div class="owl-carousel owl-theme">
                                                                <?php foreach ($listi as $key=>$val){?>
                                                                    <div class="gallery-item" >
                                                                        <div class="inner">
                                                                            <div class="thumb">
                                                                                <img src="<?php echo $val['images']?>" alt="Image">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php }?>
                                                            </div>
                                                        </div><!-- /.themesflat-cousel-box -->*/?>

                                                        <div id="sync1" class="owl-carousel owl-theme">
                                                            <?php foreach ($listi as $key=>$val){?>
                                                                <div class="item"><img src="<?php echo $val['images']?>" alt="Image"></div>
                                                            <?php }?>
                                                        </div>
                                                        <div class="themesflat-spacer clearfix" data-desktop="10" data-mobile="10" data-smobile="10"></div>

                                                        <div id="sync2" class="owl-carousel owl-theme">
                                                            <?php foreach ($listi as $key=>$val){?>

                                                                <div class="item"><img src="<?php echo $val['images']?>" alt="Image"></div>
                                                            <?php }?>

                                                        </div>
                                                        <style>
                                                            #sync1 img{

                                                                height: 450px;
                                                                object-fit: cover;
                                                            }
                                                            #sync2 img{

                                                                height: 100px;
                                                                object-fit: cover;
                                                            }
                                                            @media (max-width: 767px) {
                                                                #sync1 img{

                                                                    height: 200px;
                                                                    object-fit: cover;
                                                                }
                                                                #sync2 img{

                                                                    height: 50px;
                                                                    object-fit: cover;
                                                                }
                                                            }
                                                        </style>

                                                    <?php }?>



                                                </div>
                                                <div class="col-md-2">
                                                </div>

                                            </div>



                                            <div class="themesflat-spacer clearfix" data-desktop="40" data-mobile="40" data-smobile="40"></div>
                                            <div class="flat-content-wrap style-3 clearfix">
                                                <h5 class="title"><?php echo $detailArticle['title']; ?></h5>
                                                <div class="sep has-width w60 accent-bg margin-top-18 clearfix"></div>
                                                <div class="margin-top-28 post-contentA">
                                                    <?php echo $detailArticle['description']; ?>
                                                    <div style="clear: both;height: 20px;"></div>
                                                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                                        <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                                                        <a class="a2a_button_facebook"></a>
                                                        <a class="a2a_button_twitter"></a>
                                                        <a class="a2a_button_google_plus"></a>
                                                        <a class="a2a_button_skype"></a>
                                                    </div>
                                                    <script async src="https://static.addtoany.com/menu/page.js"></script>
                                                    <div style="clear: both;height: 20px;"></div>
                                                    <div style="margin: 0px -8px">
                                                        <div class="fb-comments" data-href="<?php echo $canonical?>" data-numposts="20" data-width="1170"></div>
                                                    </div>
                                                    <style>
                                                        .post-contentA img {
                                                            max-width: 100% !important;
                                                            height: auto !important;
                                                        }
                                                    </style>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="themesflat-spacer clearfix" data-desktop="58" data-mobile="60" data-smobile="60"></div>
                                </div>
                            </div><!-- /.row -->

                            <?php if(isset($articles_same)){?>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="themesflat-lines style-1 line-full line-solid clearfix"><span class="line"></span></div>
                                    <div class="themesflat-spacer clearfix" data-desktop="46" data-mobile="35" data-smobile="35"></div>
                                    <div class="themesflat-headings style-2 clearfix">
                                        <h2 class="heading"><?php echo $detailCatalogue['title'] ?> liên quan</h2>
                                        <div class="sep has-width w80 accent-bg margin-top-3 clearfix"></div>
                                    </div><!-- /.themesflat-heading -->
                                    <div class="themesflat-spacer clearfix" data-desktop="35" data-mobile="35" data-smobile="35"></div>
                                    <div class="themesflat-carousel-box data-effect has-arrows arrow-top arrow75 arrow-circle arrow-style-2 clearfix" data-gap="30" data-column="3" data-column2="2" data-column3="1" data-auto="false">
                                        <div class="owl-carousel owl-theme">
                                            <?php foreach ($articles_same as $keyP => $valP) {
                                            $href = rewrite_url($valP['canonical'], true, true); ?>
                                            <div class="themesflat-project style-1 clearfix">
                                                <div class="project-item">
                                                    <div class="inner">
                                                        <div class="thumb data-effect-item has-effect-icon w40 offset-v-43 offset-h-46">
                                                            <a href="<?php echo $href ?>"><img src="<?php echo $valP['image'] ?>" alt="<?php echo $valP['title'] ?>" style="width: 100%;height: 210px;object-fit: cover"></a>
                                                            <div class="text-wrap text-center">
                                                                <h5 class="heading"><a href="<?php echo $href ?>"><?php echo $valP['title'] ?></a></h5>
                                                                <?php /* <div class="elm-meta">
                                                                    <span><a href="#">Architecture</a></span>
                                                                    <span><a href="#">Building</a></span>
                                                                </div>*/?>
                                                            </div>
                                                            <?php /*<div class="elm-link">
                                                                <a href="#" class="icon-1 icon-search"></a>
                                                                <a href="#" class="icon-1"></a>
                                                            </div>*/?>
                                                            <div class="overlay-effect bg-color-3"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- /.themesflat-project -->
                                            <?php } ?>

                                        </div>
                                    </div><!-- /.themesflat-carousel-box -->
                                    <div class="themesflat-spacer clearfix" data-desktop="80" data-mobile="60" data-smobile="60"></div>
                                </div>
                            </div>

                            <?php } ?>



                        </div><!-- /.container -->
                    </div>
                    <!-- END PROJECT DETAIL -->
                </div><!-- /.page-content -->

            </div><!-- /#inner-content -->
        </div><!-- /#site-content -->
    </div><!-- /#content-wrap -->
</div><!-- /#main-content -->
