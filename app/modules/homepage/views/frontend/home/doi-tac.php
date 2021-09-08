<script>
    $("body").removeAttr('class');
    $("body").attr('class', "partner-index-index page-layout-1column add-padding-header iMenu loading-active-12 loading-actived");


</script>
<main id="maincontent" class="page-main">

    <div class="columns">
        <div class="column main">
            <div class="brand-container">
                <div class="brand-top">
                    <div class="block featured-brands-block">
                        <div class="block-title">
                            <strong class="label"><?php echo $this->fcSystem['partner_title'] ?></strong>
                        </div>
                        <div class="page-desc"><p><?php echo $this->fcSystem['partner_title_2'] ?></p>
                        </div>
                    </div>

                </div>

                <div class="brand-main">
                    <div class="block">
                        <div class="block-content">
                            <div class="brand-alphabet-list">
                                <div class="brand-inner">
                                    <div class="brand-list" data-role="brand-list">
                                        <div class="brand-group">

                                            <?php
                                            $slide_doitac = slide(array('keyword' => 'doi-tac'), $this->fc_lang);

                                            ?>

                                            <?php if (isset($slide_doitac)) { ?>
                                                <?php foreach ($slide_doitac as $k => $v) {
                                                    if ($k <= 3) { ?>
                                                        <div class="brand-item col-lg-6 col-md-6 col-sm-6 col-xs-24"
                                                             data-label="<?php echo $v['title'] ?>">
                                                            <div class="brand-item-inner">
                                                                <div class="item-top">
                                                                    <a class="brand-link"
                                                                       style="padding-bottom: calc(100% - 2px)"
                                                                       href="<?php echo $v['link'] ?>" target="_blank"
                                                                       title="<?php echo $v['title'] ?>">
                                                                        <img class="brand-img zoom-eff"
                                                                             alt="<?php echo $v['title'] ?>"
                                                                             src="<?php echo $v['src'] ?>">
                                                                    </a>
                                                                </div>
                                                                <div class="item-bottom" style="min-height: 60px;">
                                                                    <a class="brand-name"
                                                                       href="<?php echo $v['link'] ?>"
                                                                       target="_blank"
                                                                       title="<?php echo $v['title'] ?>">
                                                                        <?php echo $v['title'] ?> </a>
                                                                    <div class="brand-desc"><?php echo $v['description'] ?>
                                                                    </div>
                                                                    <!--<div class="count">10 products</div>-->
                                                                    <div class="cdz-buttons-container">
                                                                        <div class="cdz-buttons-inner">
                                                                            <a target="_blank"
                                                                               href="<?php echo $v['link'] ?>"
                                                                               class="view-more-button"
                                                                               title="Xem Chi Tiết">
                                                                                Xem Chi Tiết
                                                                            </a>
                                                                        </div>
                                                                    </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>