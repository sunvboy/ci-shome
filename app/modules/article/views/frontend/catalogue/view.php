<script>
    $("body").removeAttr('class');
    $("body").attr('class', "blog-category-suc-khoe-giac-ngu blog-category-view page-layout-1column add-padding-header iMenu loading-active-12 loading-actived");


</script>
<div class="wrapper-breadcrums">
    <div class="breadcrumbs">
        <ul class="items">
            <li class="item home">
                <a href="<?php echo base_url() ?>">Trang chủ </a>
            </li>
            <?php foreach ($breadcrumb as $key => $val) { ?>
                <?php
                $title = $val['title'];
                $href = rewrite_url($val['canonical'], true, true);
                ?>
                <li class="<?php if ($key == count($breadcrumb) - 1) echo 'uk-active'; ?>"><a
                            href="<?php echo $href; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
                </li>
            <?php } ?>

        </ul>
    </div>
</div>
<main id="maincontent" class="page-main">


    <a id="contentarea" tabindex="-1"></a>
    <div class="page-title-wrapper">
        <h1 class="page-title"><span class="base"
                                     data-ui-id="page-title-wrapper"><?php echo $detailCatalogue['title'] ?></span></h1>
    </div>
    <div class="page messages">
        <div data-placeholder="messages"></div>
    </div>
    <div class="columns">
        <div class="column main">

            <div class="post-list-wrapper row">
                <div class="post-list" id="cdz-post-list">
                    <?php if (isset($articleList) && is_array($articleList) && count($articleList)) { ?>
                        <?php foreach ($articleList as $key => $val) { ?>
                            <?php
                            $title = $val['title'];
                            $image = $val['image'];
                            $href = rewrite_url($val['canonical'], TRUE, TRUE);
                            $description = cutnchar(strip_tags($val['description']), 500);
                            ?>
                            <li class="post-holder">
                                <div class="post-image cdz-left">
                                    <a href="<?php echo $href; ?>">
                                        <img class="img-responsive" width="840" height="620"
                                             src="<?php echo $image; ?>">
                                    </a>
                                    <div class="blog-date"><?php echo show_time($val['created']) ?></div>
                                </div>
                                <div class="post-details cdz-right">
                                    <div class="post-header">
                                        <div class="post-title-holder clearfix">
                                            <h2 class="post-title">
                                                <a class="post-item-link"
                                                   href="<?php echo $href; ?>"><?php echo $title; ?></a>
                                            </h2>

                                        </div>
                                        <div class="post-info clear">
                                            <div class="items post-short-content">
                                                <p><em><span style="font-family: helvetica; font-size: small;"><?php echo $description; ?></span></em></p>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="post-content">
                                        <a class="post-read-more" href="<?php echo $href; ?>">Xem Thêm </a>
                                    </div>
                                </div>
                                <div class="post-footer">
                                </div>
                            </li>
                        <?php } ?>

                    <?php } ?>
                </div>
            </div>
            <div class="toolbar toolbar-blog-posts">
                <div class="pages pagination">
                    <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>

                </div>
            </div>
        </div>
    </div>
</main>
<style>
    .pagination {
        display: inline-block;
    }

    .pagination a {
        color: #ff;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color .3s;
        border: 1px solid #ddd;
        margin-right: 5px;
    }

    .pagination a.active {
        background-color: #fec400;
        color: white;
        border: 1px solid #fec400;
    }

    .pagination a:hover:not(.active) {background-color: #ddd;}
</style>