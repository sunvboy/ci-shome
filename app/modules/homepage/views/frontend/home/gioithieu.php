<!-- Featured Title -->
<div id="featured-title" class="featured-title clearfix">
    <div id="featured-title-inner" class="container clearfix">
        <div class="featured-title-inner-wrap">
            <div id="breadcrumbs">
                <div class="breadcrumbs-inner">
                    <div class="breadcrumb-trail">
                        <a href="<?php echo base_url() ?>" class="trail-begin">Trang chủ</a>

                        <span class="sep">|</span>
                        <a href="<?php echo $this->fcSystem['banner_link'] ?>"
                           class="trail-begin"><?php echo $this->fcSystem['banner_aboutus'] ?></a>

                    </div>
                </div>
            </div>
            <div class="featured-title-heading-wrap">
                <h1 class="feautured-title-heading">
                    <?php echo $this->fcSystem['banner_aboutus'] ?>
                </h1>
            </div>
        </div><!-- /.featured-title-inner-wrap -->
    </div><!-- /#featured-title-inner -->
</div>
<!-- End Featured Title -->

<!-- Main Content -->
<div id="main-content" class="site-main clearfix">
    <div id="content-wrap" class="container">
        <div id="site-content" class="site-content clearfix">
            <div id="inner-content" class="inner-content-wrap">
                <div class="themesflat-spacer clearfix" data-desktop="61" data-mobile="60" data-smobile="60"></div>

                <?php
                $visaochonchungtoi = $this->Autoload_Model->_get_where(array(
                    'select' => 'id, title,description',
                    'table' => 'page_catalogue',
                    'limit' => 1,
                    'where' => array('ishome' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)), true);
                if (isset($visaochonchungtoi) && is_array($visaochonchungtoi) && count($visaochonchungtoi)) {
                    foreach ($visaochonchungtoi as $key => $val) {
                        $visaochonchungtoi[$key]['post'] = $this->Autoload_Model->_condition(array(
                            'module' => 'page',
                            'select' => '`object`.`id`, `object`.`title`, `object`.`description`',
                            'where' => '`object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\' ',
                            'catalogueid' => $val['id'],
                            'limit' => 3,
                            'order_by' => '`object`.`order` asc, `object`.`id` desc',
                        ));
                    }
                }
                ?>

                <?php if (isset($visaochonchungtoi) && is_array($visaochonchungtoi) && count($visaochonchungtoi)) { ?>
                    <?php foreach ($visaochonchungtoi as $key => $val) { ?>
                        <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
                            <div class="themesflat-headings style-2 clearfix">
                                <h2 class="heading"><?php echo $val['title'] ?></h2>
                                <div class="sep has-width w80 accent-bg clearfix"></div>
                                <p class="sub-heading line-height-24 text-777 margin-top-28 margin-right-12"><?php echo $val['description'] ?></p>
                            </div>
                            <div class="themesflat-spacer clearfix" data-desktop="28" data-mobile="35"
                                 data-smobile="35"></div>
                            <div class="themesflat-row gutter-15 clearfix">
                                <?php foreach ($val['post'] as $keyP => $valP) { ?>
                                    <div class="col span_1_of_4">
                                        <div class="themesflat-spacer clearfix" data-desktop="0" data-mobile="0"
                                             data-smobile="35"></div>
                                        <div class="themesflat-content-box clearfix" data-margin="0 0px 0 0px"
                                             data-mobilemargin="0 0 0 0">
                                            <div class="themesflat-icon-box icon-top align-center has-width w95 circle light-bg accent-color border-light padding-inner pd33 style-1 clearfix">
                                                <div class="icon-wrap">
                                                    <i class="<?php if($keyP==0){?>autora-icon-quality<?php }else if($keyP==1){ ?>autora-icon-time<?php }else{?>autora-icon-author<?php }?>"></i>
                                                </div>
                                                <div class="text-wrap">
                                                    <h5 class="heading"><a
                                                                href="javascript:void(0)"><?php echo $valP['title'] ?></a>
                                                    </h5>
                                                    <div class="sep clearfix"></div>
                                                    <p class="sub-heading"><?php echo $valP['description'] ?></p>
                                                </div>
                                            </div><!-- /.themesflat-icon-box -->
                                        </div><!-- /.themesflat-content-box -->
                                    </div><!-- /.col -->
                                <?php } ?>

                            </div><!-- /.themesflat-row -->
                        <?php } ?>
                    <?php } ?>
                <?php } ?>


                <?php
                $OURHISTORY = $this->Autoload_Model->_get_where(array(
                    'select' => 'id, title,description',
                    'table' => 'page_catalogue',
                    'limit' => 1,
                    'where' => array('isaside' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)), true);
                if (isset($OURHISTORY) && is_array($OURHISTORY) && count($OURHISTORY)) {
                    foreach ($OURHISTORY as $key => $val) {
                        $OURHISTORY[$key]['post'] = $this->Autoload_Model->_condition(array(
                            'module' => 'page',
                            'select' => '`object`.`id`, `object`.`title`, `object`.`description`',
                            'where' => '`object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\' ',
                            'catalogueid' => $val['id'],
                            'order_by' => '`object`.`order` asc, `object`.`id` desc',
                        ));
                    }
                }
                ?>
                <?php if (isset($OURHISTORY) && is_array($OURHISTORY) && count($OURHISTORY)) { ?>
                    <?php foreach ($OURHISTORY as $key => $val) { ?>
                        <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
                            <div class="themesflat-spacer clearfix" data-desktop="45" data-mobile="35" data-smobile="35"></div>
                            <div class="themesflat-headings style-2 clearfix">
                                <h2 class="heading"><?php echo $val['title'] ?></h2>
                                <div class="sep has-width w80 accent-bg clearfix"></div>
                            </div>
                            <div class="themesflat-spacer clearfix" data-desktop="24" data-mobile="35"
                                 data-smobile="35"></div>
                            <div class="themesflat-row separator drank clearfix">
                                <div class="span_1_of_6 separator-solid">
                                    <?php $i=0; foreach ($val['post'] as $keyP => $valP) { $i++;?>
                                        <div class="flat-content-wrap pd26">
                                            <div class="title"><?php echo $valP['title'] ?></div>
                                            <p><?php echo $valP['description'] ?></p>
                                        </div>
                                        <?php if($i%2==0){?></div><div class="span_1_of_6 separator-solid"><?php }?>
                                    <?php }?>

                                </div><!-- /.col -->
                            </div><!-- /.themesflat-row -->
                        <?php } ?>
                    <?php } ?>
                <?php } ?>

                <?php
                $OURCOREVALUES = $this->Autoload_Model->_get_where(array(
                    'select' => 'id, title,description',
                    'table' => 'page_catalogue',
                    'limit' => 1,
                    'where' => array('isfooter' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)), true);
                if (isset($OURCOREVALUES) && is_array($OURCOREVALUES) && count($OURCOREVALUES)) {
                    foreach ($OURCOREVALUES as $key => $val) {
                        $OURCOREVALUES[$key]['post'] = $this->Autoload_Model->_condition(array(
                            'module' => 'page',
                            'select' => '`object`.`id`, `object`.`title`, `object`.`description`',
                            'where' => '`object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\' ',
                            'catalogueid' => $val['id'],
                            'order_by' => '`object`.`order` asc, `object`.`id` desc',
                        ));
                    }
                }
                ?>
                <?php if (isset($OURCOREVALUES) && is_array($OURCOREVALUES) && count($OURCOREVALUES)) { ?>
                    <?php foreach ($OURCOREVALUES as $key => $val) { ?>
                        <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
                            <div class="themesflat-spacer clearfix" data-desktop="38" data-mobile="35"
                                 data-smobile="35"></div>
                            <div class="themesflat-headings style-2 clearfix">
                                <h2 class="heading"><?php echo $val['title'] ?></h2>
                                <div class="sep has-width w80 accent-bg clearfix"></div>
                            </div>
                            <div class="themesflat-spacer clearfix" data-desktop="35" data-mobile="35"
                                 data-smobile="35"></div>
                            <div class="themesflat-content-box" data-margin="0 0 0 0" data-mobilemargin="0 0 0 0">
                                <div class="themesflat-accordions style-3 has-icon icon-left iconstyle-2 our-background clearfix">
                                    <?php $i = 0;
                                    foreach ($val['post'] as $keyP => $valP) {
                                        $i++; ?>
                                        <div class="accordion-item <?php if ($keyP == 0) { ?>active<?php } ?>">
                                            <h3 class="accordion-heading"><span class="inner"><?php echo $valP['title']?></span></h3>
                                            <div class="accordion-content">
                                                <div><?php echo $valP['description']?>
                                                </div>
                                            </div>
                                        </div><!-- /.accordion-item -->
                                    <?php } ?>


                                </div><!-- /.themesflat-accordion -->
                            </div><!-- /.themesflat-content-box -->

                        <?php } ?>
                    <?php } ?>
                <?php } ?>
                <div class="themesflat-spacer clearfix" data-desktop="80" data-mobile="60" data-smobile="60"></div>
            </div><!-- /#inner-content -->
        </div><!-- /#site-content -->

    </div><!-- /#content-wrap -->
</div><!-- /#main-content -->
