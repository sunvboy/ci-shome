<script>
    $("body").removeAttr('class');
    $("body").attr('class', "page-with-filter page-products categorypath-nem category-nem catalog-category-view page-layout-2columns-left add-padding-header iMenu loading-active-12 loading-actived");


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
                <li class="<?php if ($key == count($breadcrumb) - 1) echo 'item category3'; ?>">
                    <a href="<?php echo $href; ?>" title="<?php echo $title; ?>" style="font-size: 24px;
    font-weight: 600;
    color: #2d2e7f; "><?php echo $title; ?></a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
<main id="maincontent" class="page-main">



    <div id="shomesolution-product-filter"><!----> <!---->
        <div class="row">
            <?php echo $this->load->view('product/frontend/catalogue/filter'); ?>


            <div class="block product-list">
                <div class="head-filter-sorter">
                    <div class="toolbar-sorter sorter">
                        <div class="fillter-wapper">
                            <a href="javascript:void(0)" class="filter-mobile"><i class="fa fa-filter"></i> <span>Tìm theo nhu cầu</span></a>
                        </div>
                        <div class="sorter-desktop">
                            <select name="sort" id="sorter" class="sorter-options">
                                <option value="id|desc"
                                        <?php if (!empty($_GET['sort'])){ ?><?php if ($_GET['sort'] == 'id|desc'){ ?>selected<?php } ?><?php } ?>>
                                    Sản phẩm mới
                                </option>
                                <option value="price|asc"
                                        <?php if (!empty($_GET['sort'])){ ?><?php if ($_GET['sort'] == 'price|asc'){ ?>selected<?php } ?><?php } ?>>
                                    Giá cao đến thấp
                                </option>
                                <option value="price|desc"
                                        <?php if (!empty($_GET['sort'])){ ?><?php if ($_GET['sort'] == 'price|desc'){ ?>selected<?php } ?><?php } ?>>
                                    Giá thấp đến cao
                                </option>
                            </select>
                            <?php
                            $hrefCatalogue = rewrite_url($detailCatalogue['canonical'], true, true);
                            ?>
                            <script>
                                $(function () {

                                    $('.filter-mobile').on('click', function () {
                                        $('.block.filter').addClass('open');

                                    });
                                    $('.close-filter').on('click', function () {
                                        $('.block.filter').removeClass('open');

                                    });
                                    $('#sorter').on('change', function () {
                                        var url = $(this).val();
                                        if (url) {
                                            if (url == '') {
                                                window.location = '<?php echo $hrefCatalogue?>';

                                            } else {
                                                window.location = '<?php echo $hrefCatalogue?>?sort=' + url;

                                            }
                                        }
                                        return false;
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <?php
                $banner_ = slide(array('keyword' => 'banner-catalogue'), $this->fc_lang);

                ?>

                <?php if (isset($banner_) && count($banner_) && is_array($banner_)) { ?>
                <div class="row">

                    <div id="block-banner-top" class="block-banner-top">
                        <div class="block-banner-list block-banner-list-mobile owl-loaded owl-drag">

                            <?php
                            foreach ($banner_ as $k => $v) {
                                ?>
                                <div class="banner-list-items"><a href="<?php echo $v['link'] ?>" target="_blank"><img
                                                src="<?php echo $v['src'] ?>" width="787"
                                                height="238" alt="<?php echo $v['title'] ?>"></a></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <div class="row" id="ajax-content">
                    <?php if (isset($productList) && is_array($productList) && count($productList)) { ?>
                        <?php foreach ($productList as $key => $val) { ?>
                            <?php echo itemArrange($val) ?>
                        <?php } ?>
                    <?php } ?>


                </div>

                <div class="load-more view-mores">
                    <div class="toolbar toolbar-blog-posts" style="text-align: center; width: 100%;">
                        <div class="pages pagination text-center" id="pagination">
                            <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="category-view" style="display: block;">
        <div class="columns catalog-overview">

            <div class="column-main">
                <div class="category-description">
                    <h1><?php echo $detailCatalogue['title'] ?></h1>
                    <?php echo $detailCatalogue['description'] ?>
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

    .pagination a:hover:not(.active) {
        background-color: #ddd;
    }
</style>