<?php $main_nav = navigation(array('keyword' => 'main', 'output' => 'array'), $this->fc_lang); ?>
<?php $main_mobile = navigation(array('keyword' => 'mobile', 'output' => 'array'), $this->fc_lang); ?>

<header id="header-site">

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <a href="<?php echo base_url() ?>" class="logo">
                    <img src="<?php echo $this->fcSystem['homepage_logo'] ?>"
                         alt="<?php echo $this->fcSystem['homepage_company'] ?>" style="height: 57px">
                </a>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="header-right">
                    <div class="search-holine">
                        <div class="cart-top"><a href="thanh-toan.html"><img src="template/frontend/images/icon2.png" alt="giỏ hàng"><span
                                        class="stt cart_count"><?php echo $this->cart->total_items(); ?></a> </span>
                        </div>
                        <button class="click-search" data-toggle="modal" data-target="#myModal"><i class="fas fa-search"></i></button>

                        <div class="clearfix"></div>

                    </div>

                </div>
            </div>
        </div>
        <div class="main-menu">
            <!-- begin mobile -->
            <div class="wrapper cf">
                <style>
                    #main-nav{
                        display: none;
                    }
                </style>
                <nav id="main-nav">
                    <ul class="second-nav">

                        <?php if (isset($main_nav) && is_array($main_nav) && count($main_nav)) { ?>
                            <?php foreach ($main_nav as $key => $val) { ?>
                                <li>
                                    <a href="<?php echo $val['link']; ?>"><?php echo $val['title']; ?></a>
                                    <?php if (isset($val['children']) && is_array($val['children']) && count($val['children'])) { ?>
                                        <ul class="submenu">
                                            <?php foreach ($val['children'] as $keyItem => $valItem) { ?>
                                                <li>
                                                    <a href="<?php echo $valItem['link'] ?>"><?php echo $valItem['title'] ?></a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                        <?php } ?>

                    </ul>
                </nav>
                <a class="toggle">
                    <span></span>
                </a>
            </div>
            <!-- end mobile -->
            <?php if (isset($main_mobile) && is_array($main_mobile) && count($main_mobile)) { ?>

            <ul>
                <?php foreach ($main_mobile as $key => $val) { ?>
                <li><a href="<?php echo $val['link']; ?>"><?php echo $val['title']; ?></a></li>
                <?php } ?>

            </ul>
            <?php } ?>

        </div>
    </div>
</header>