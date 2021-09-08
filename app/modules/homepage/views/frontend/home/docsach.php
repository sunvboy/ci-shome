<main style="padding-bottom: 50px">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumbC">
                    <li>
                        <a href="<?php echo base_url() ?>">Trang chủ</a>
                        <a href="doc-sach.html"> >> <b style="text-transform: uppercase">Đọc sách</b></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
                <div class="box-sach">


                    <?php
                    $anhSach = $this->Autoload_Model->_get_where(array(
                        'select' => 'image_json,title',
                        'table' => 'media',
                        'where' => array('id' => 14, 'publish' => 0)));
                    ?>
                    <?php if (!empty($anhSach)) { ?>
                        <?php $listJson = json_decode($anhSach['image_json'], TRUE) ?>
                        <?php if (isset($listJson) && is_array($listJson) && count($listJson)) { ?>
                            <div class="">
                                <div class="bb-custom-wrapper hidden-sm hidden-xs">
                                    <div id="bb-bookblock" class="bb-bookblock">

                                        <div class='bb-item'>
                                            <?php $i=0; foreach ($listJson as $key=>$val){ $i++;?>
                                            <div class="bb-custom-side bb-custom-side<?php echo $i?> <?php echo $i?>"><img src="<?php echo $val?>" alt="<?php echo $anhSach['title']?>"></div>
                                            <?php if($i%2==0){?></div><div class='bb-item'><?php }?>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <style>
                                        .bb-custom-side img {
                                            width: 100%;
                                            height: 100%;
                                        }

                                    </style>
                                    <nav>
                                        <a id="bb-nav-first" href="#" class="bb-custom-icon bb-custom-icon-first">First page</a>
                                        <a id="bb-nav-prev" href="#" class="bb-custom-icon bb-custom-icon-arrow-left">Previous</a>
                                        <a id="bb-nav-next" href="#" class="bb-custom-icon bb-custom-icon-arrow-right">Next</a>
                                        <a id="bb-nav-last" href="#" class="bb-custom-icon bb-custom-icon-last">Last page</a>
                                    </nav>

                                </div>
                                <div class="hidden">
                                    <section id="slider">
                                        <div class="slider-albums owl-carousel">
                                            <div class="item">
                                                <img src="" alt="">
                                            </div>
                                        </div>
                                    </section>

                                </div>
                                <style>
                                    .slider-albums .owl-next, .slider-albums .owl-prev {
                                        background: none !important;
                                        opacity: .7 !important;
                                        width: 40px !important;
                                        height: 40px !important;
                                    }

                                    .slider-albums i {
                                        background-color: #000;
                                        width: 40px;
                                        height: 40px;
                                        text-align: center;
                                        line-height: 40px;
                                        color: #fff;
                                        font-size: 20px;
                                    }
                                </style>
                            </div>

                            <link rel="stylesheet" type="text/css" href="template/frontend/css/default.css"/>
                            <link rel="stylesheet" type="text/css" href="template/frontend/css/bookblock.css"/>
                            <!-- custom demo style -->
                            <link rel="stylesheet" type="text/css" href="template/frontend/css/demo4.css"/>
                            <script src="template/frontend/js/modernizr.custom.js"></script>
                            <script src="template/frontend/js/jquerypp.custom.js"></script>
                            <script src="template/frontend/js/jquery.bookblock.js"></script>

                            <script>
                                var Page = (function () {

                                    var config = {
                                            $bookBlock: $('#bb-bookblock'),
                                            $navNext: $('#bb-nav-next'),
                                            $navPrev: $('#bb-nav-prev'),
                                            $navFirst: $('#bb-nav-first'),
                                            $navLast: $('#bb-nav-last')
                                        },
                                        init = function () {
                                            config.$bookBlock.bookblock({
                                                speed: 1000,
                                                shadowSides: 0.8,
                                                shadowFlip: 0.4
                                            });
                                            initEvents();
                                        },
                                        initEvents = function () {

                                            var $slides = config.$bookBlock.children();

                                            // add navigation events
                                            config.$navNext.on('click touchstart', function () {
                                                config.$bookBlock.bookblock('next');
                                                return false;
                                            });

                                            config.$navPrev.on('click touchstart', function () {
                                                config.$bookBlock.bookblock('prev');
                                                return false;
                                            });

                                            config.$navFirst.on('click touchstart', function () {
                                                config.$bookBlock.bookblock('first');
                                                return false;
                                            });

                                            config.$navLast.on('click touchstart', function () {
                                                config.$bookBlock.bookblock('last');
                                                return false;
                                            });

                                            // add swipe events
                                            $slides.on({
                                                'swipeleft': function (event) {
                                                    config.$bookBlock.bookblock('next');
                                                    return false;
                                                },
                                                'swiperight': function (event) {
                                                    config.$bookBlock.bookblock('prev');
                                                    return false;
                                                }
                                            });

                                            // add keyboard events
                                            $(document).keydown(function (e) {
                                                var keyCode = e.keyCode || e.which,
                                                    arrow = {
                                                        left: 37,
                                                        up: 38,
                                                        right: 39,
                                                        down: 40
                                                    };

                                                switch (keyCode) {
                                                    case arrow.left:
                                                        config.$bookBlock.bookblock('prev');
                                                        break;
                                                    case arrow.right:
                                                        config.$bookBlock.bookblock('next');
                                                        break;
                                                }
                                            });
                                        };

                                    return {init: init};

                                })();
                            </script>
                            <script>
                                Page.init();
                            </script>
                        <?php } ?>
                    <?php } ?>


                    <div class="clearfix" style="height: 50px"></div>
                    <div class="box-download">
                        <a href="cam-nang-final.pdf" download><img src="template/frontend/images/down.png"
                                                                   alt="download"></a>

                    </div>
                    <div class="clearfix" style="height: 50px"></div>

                    <?php
                    $trichdoan = $this->Autoload_Model->_get_where(array(
                        'select' => 'id, title',
                        'table' => 'page_catalogue',
                        'where' => array('highlight' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)), true);
                    if (isset($trichdoan) && is_array($trichdoan) && count($trichdoan)) {
                        foreach ($trichdoan as $key => $val) {
                            $trichdoan[$key]['post'] = $this->Autoload_Model->_condition(array(
                                'module' => 'page',
                                'select' => '`object`.`id`, `object`.`title`, `object`.`image`, `object`.`description`, `object`.`content`',
                                'where' => '`object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\' ',
                                'catalogueid' => $val['id'],
                                'limit' => 1000,
                                'order_by' => '`object`.`order` asc, `object`.`id` asc',
                            ));
                        }
                    }
                    ?>
                    <?php if (isset($trichdoan) && is_array($trichdoan) && count($trichdoan)) { ?>
                        <?php foreach ($trichdoan as $key => $val) { ?>
                            <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>

                                <div class="box-share">

                                    <div class="row">
                                        <?php foreach ($val['post'] as $keyP => $valP) { ?>

                                            <div class="col-md-4 col-xs-12 col-sm-4">
                                                <div class="item-share">
                                                    <div class="title-share">
                                                        <p>
                                                            <i><?php echo $valP['title'] ?></i>
                                                        </p>
                                                    </div>
                                                    <div class="clearfix" style="height: 7px"></div>
                                                    <div class="social-share">
                                                        <ul>
                                                            <li class="fb" ><a href="javascript:void(0)" onclick="shareOnFacebook('<?php echo $valP['title'] ?>')"></a></li>
                                                            <li class="zalo"><a href="javascript:void(0)"></a></li>
                                                            <li class="gg"><a href="javascript:void(0)"></a></li>
                                                            <li class="tw"><a href="javascript:void(0)"></a></li>
                                                        </ul>
                                                    </div>

                                                </div>

                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>


                </div>

            </div>


        </div>

    </div>


</main>
<script>
        window.fbAsyncInit = function() {
            // init the FB JS SDK
            FB.init({
                appId      : '1250600741961054',                        // App ID from the app dashboard
                status     : true,                                 // Check Facebook Login status
                xfbml      : true                                  // Look for social plugins on the page
            });
            // channelUrl : '//www.your_domain.com/channel.html', // Channel file for x-domain comms
            // Additional initialization code such as adding Event Listeners goes here
        };

        // Load the SDK asynchronously
        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        function shareOnFacebook(title){
            alert(title);
            FB.ui({
                method: 'feed',
                name: '<?php echo $this->fcSystem['homepage_company']?>',
                link: '<?php echo base_url()?>doc-sach.html',
                caption: '',
                title: '',
                quote: title,
                picture: '<?php echo (isset($meta_image) && !empty($meta_image)) ? $meta_image : $this->fcSystem['homepage_logo'] ?>',
                description: "<?php echo (isset($meta_description) && !empty($meta_description))?htmlspecialchars($meta_description):'';?>"
            }, function(response) {
                if(response && response.post_id){}
                else{}
            });
        }

    </script>
