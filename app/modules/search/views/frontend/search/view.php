<script>
    $("body").removeAttr('class');
    $("body").attr('class', "page-products catalogsearch-result-index page-layout-1column add-padding-header iMenu loading-active-12 loading-actived");


</script>
<main id="maincontent" class="page-main">

    <div class="page-title-wrapper">
        <h1 class="page-title">
            <span class="base" data-ui-id="page-title-wrapper">Kết quả tìm kiếm: '<?php echo $this->input->get('keyword')?>'</span></h1>
    </div>

    <div class="columns">
        <div class="column main"><input name="form_key" type="hidden" value="YHnlRIH4MbfVJx1c">


            <div class="search results has-product">
                <div class="count-header">
                    Có
                    <span class="count-pr"><?php echo $total_rows?></span><span> kết quả</span> với từ khoá "<span class="text-value"><?php echo $this->input->get('keyword')?></span>"
                </div>
                <?php /*<div class="search-header-top desktop">
                    <div class="count-wapper">
                        <div class="all-count">Tất cả (<span>97</span>)</div>
                    </div>
                    <dl class="block">
                        <dt class="title">Related search terms</dt>
                        <dd class="item">
                            <a href="https://shomesolution.com/catalogsearch/result/?q=nem+cho+tre+giuong+2+tang">nem cho tre
                                giuong 2 tang</a>
                        </dd>
                        <dd class="item">
                            <a href="https://shomesolution.com/catalogsearch/result/?q=N%E1%BB%87m+1+m%C3%A9t+2">Nệm 1 mét
                                2</a>
                        </dd>
                        <dd class="item">
                            <a href="https://shomesolution.com/catalogsearch/result/?q=nem+cao+tre+giuong+2+tr%E1%BA%AFng">nem
                                cao tre giuong 2 trắng</a>
                        </dd>
                    </dl>
                </div>*/?>
                <div class="block-products-list widget block block-static-block">
                    <div class="products wrapper grid products-grid">
                        <div class="desktop_4" id="category-products-grid">
                            <ol class="products list items product-items same-height">
                                <?php if (isset($productList) && is_array($productList) && count($productList)) { ?>
                                <?php foreach ($productList as $keyPost => $valPost) { ?>
                                <?php
                                $title = $valPost['title'];
                                $href = rewrite_url($valPost['canonical'], TRUE, TRUE);
                                $image = $valPost['image'];
                                $getPrice = getPriceFrontend(array('productDetail' => $valPost));
                                $comment = comment(array('module' => 'product', 'id' => $valPost['id']));
                                if (isset($comment) && is_array($comment) && count($comment)) {
                                    $prd_rate = (float)$comment['statisticalRating']['averagePoint'];
                                }
                                ?>
                                <li class="item product product-item">
                                    <div class="product-item-info" data-container="product-grid">
                                        <div class="cdz-product-top">
                                            <a href="<?php echo $href?>"
                                               class="product photo product-item-photo" tabindex="-1">
<span class="main-image">
<span class="product-image-container" style="width:240px;">
<span class="product-image-wrapper" style="padding-bottom: 100%;">
<img class="product-image-photo"
     src="<?php echo $image ?>" width="240"
     height="240" alt="<?php echo $title ?>"></span>
</span>
</span>
                                                <span class="hover-image">
<span class="product-image-container" style="width:240px;">
<span class="product-image-wrapper" style="padding-bottom: 100%;">
<img class="product-image-photo"
     src="<?php echo $image ?>" width="240"
     height="240" alt="<?php echo $title ?>"></span>
</span>
</span>
                                            </a>
                                        </div>
                                        <?php /*<div class="cdz-hover-section" style="display: none;">

                                            <div class="cdz-product-wishlist show-tooltip">
                                                <a href="#" class="action towishlist" title="Yêu thích"
                                                   aria-label="Yêu thích"
                                                   data-post="{&quot;action&quot;:&quot;https:\/\/shomesolution.com\/wishlist\/index\/add\/&quot;,&quot;data&quot;:{&quot;product&quot;:&quot;3554&quot;,&quot;uenc&quot;:&quot;aHR0cHM6Ly92dWFuZW0uY29tL2NhdGFsb2dzZWFyY2gvcmVzdWx0Lz9xPW4lRTElQkIlODdt&quot;}}"
                                                   data-action="add-to-wishlist" role="button">
                                                    <span>Yêu thích</span>
                                                </a>
                                            </div>
                                            <ul class="cdz-product-labels" style="display: none;">
                                                <li class="label-item discount-percent">
                                                    <div class="label-content discount-percent-product-3554"></div>
                                                </li>
                                            </ul>
                                        </div>*/?>
                                        <div class="product details product-item-details active-freeship">
                                            <h3 class="product-item-link">
                                                <a href="<?php echo $href?>">
                                                    <?php echo $title ?> </a>
                                            </h3>
                                            <div class="price-freeship">
                                                <div class="price-box price-final_price">
                                                    <div class="normal-price 12">
                                                        <label class="label-status listing" style="display : none;">Chỉ
                                                            Còn</label>
                                                        <label class="label-status detail"
                                                               style="display : none;">Giá</label>
                                                        <span class="price-container price-final_price tax">
<span class="price-wrapper "><span
            class="price"><?php echo $getPrice['price_final'] ?></span></span>
</span>
                                                    </div>
                                                </div>


                                                <div class="freeship-product">Freeship</div>
                                            </div>
                                            <div class="product-item-inner">

                                            </div>

                                            <div class="view-detail">
                                                <a href="<?php echo $href?>"
                                                   title="Mua Ngay">
                                                    Mua Ngay </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php } ?>
                                <?php } ?>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="toolbar toolbar-blog-posts" style="text-align: center; width: 100%;">
                    <div class="pages pagination text-center" id="pagination">
                        <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>

                    </div>
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