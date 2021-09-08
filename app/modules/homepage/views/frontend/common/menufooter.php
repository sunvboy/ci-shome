
<?php $main_nav = navigation(array('keyword' => 'footer', 'output' => 'array'), $this->fc_lang); ?>
<?php if (isset($main_nav) && is_array($main_nav) && count($main_nav)) { ?>


    <div class="row row-small footer-wrap-top">

        <?php foreach ($main_nav as $key => $val) { ?>
            <?php if (isset($val['children']) && is_array($val['children']) && count($val['children'])) { ?>
                <div id="col-572913587" class="col medium-3 small-6 large-3">
                    <div class="col-inner">


                        <p class="header-menu-footer"><strong><?php echo $val['title']; ?></strong></p>
                        <ul>
                            <?php foreach ($val['children'] as $keyItem => $valItem) { ?>
                                <li><a href="<?php echo $valItem['link'] ?>"><?php echo $valItem['title'] ?></a></li>
                            <?php } ?>
                        </ul>

                    </div>
                </div>
            <?php } ?>
        <?php } ?>

    </div>

<?php } ?>