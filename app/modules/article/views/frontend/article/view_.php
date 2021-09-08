<div id="main" class="wrapper main-car-detail main-cars-list">
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="<?php echo base_url()?>"><?php echo $this->lang->line('home')?> </a></li>
                <?php foreach ($breadcrumb as $key => $val) { ?>
                    <?php
                    $title = $val['title'];
                    $href = rewrite_url($val['canonical'], true, true);
                    ?>
                    <li><a href="<?php echo $href ?>"> / <?php echo $title ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="main-new-detail">
        <div class="container">
            <h1 style="font-size: 20px;font-weight: bold;line-height: 25px"><?php echo $detailArticle['title']; ?></h1>
            <p class="date">Ngày đăng: <?php echo $detailArticle['created']; ?></p>
            <div class="content-new-detail">
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
                    <div class="fb-comments" data-href="<?php echo $canonical?>" data-numposts="20" data-width="1140"></div>
                </div>
                <style>
                    .content-new-detail img {
                        max-width: 100% !important;
                        height: auto !important;
                    }
                </style>
                <div class="clearfix"></div>
                <h2 style="font-size: 22px;font-weight: bold">Bài viết cùng chuyên mục</h2>
                <ul class="ttm-list">
                    <?php foreach ($articles_same as $keyP => $valP) {
                        $href = rewrite_url($valP['canonical'], true, true); ?>
                        <li><a href="<?php echo $href ?>"><i class="fa fa-check"></i><span class="ttm-list-li-content"><?php echo $valP['title'] ?></span></a></li>
                    <?php } ?>

                </ul>
            </div>

        </div>
    </div>


</div>
<style>
    .ttm-list{
        list-style: none;
        padding: 0px;
        margin: 0px;
    }
    .ttm-list-li-content{
        padding-left: 5px;
    }
</style>

