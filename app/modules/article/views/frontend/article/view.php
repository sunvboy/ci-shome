<script>
    $("body").removeAttr('class');
    $("body").attr('class', "blog-category-suc-khoe-giac-ngu blog-category-view page-layout-1column add-padding-header iMenu loading-active-12 loading-actived");


</script>
<style>
    .blog-post-view .page-title-wrapper{
        width: 100%;
    }
</style>
<main id="maincontent" class="page-main">

    <a id="contentarea" tabindex="-1"></a>
    <div class="page-title-wrapper">
        <h1 class="page-title">
            <span class="base"><?php echo $detailArticle['title']; ?></span>
        </h1>
    </div>
    <div class="page messages">
        <div data-placeholder="messages"></div>
    </div>
    <div class="columns">
        <div class="column main">


            <div class="post-view">
                <div class="post-holder post-holder-1694">
                    <div class="post-image cdz-left">
                        <div class="blog-date"><?php echo $detailArticle['created']; ?></div>
                    </div>
                    <div class="post-header">
                        <div class="post-info clear">


                            <div class="item post-categories">
                                <?php foreach ($breadcrumb as $key => $val) { ?>
                                <?php
                                $title = $val['title'];
                                $href = rewrite_url($val['canonical'], true, true);
                                ?>
                                <a title="<?php echo $title ?>" href="<?php echo $href ?>"><?php echo $title ?></a>
                                <div class="dash">//</div>
                                <?php } ?>
                            </div>


                            <div class="item post-posed-date">

                                <span class="value"><?php echo $detailArticle['created']; ?></span>
                            </div>


                        </div>
                    </div>
                    <div class="post-content">
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
                    </div>
                    <div class="post-footer">
                        <style>
                            .post-content img {
                                max-width: 100% !important;
                                height: auto !important;
                            }
                        </style>
                    </div>

                </div>
            </div>
        </div>

    </div>
</main>
<style>
    .blog-post-view .post-view .post-holder .post-content a{
        border: 0px;
    }
    .page-layout-2columns-right .column.main {
        width: 100%;
        float: left;
        -ms-flex-order: 1;
        -webkit-order: 1;
        order: 1;
        border-right: 0px;
    }
</style>