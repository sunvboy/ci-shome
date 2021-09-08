<div id="main" class="wrapper main-new">

    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="<?php echo base_url() ?>">Trang chủ</a></li>


                    <li ><a
                            href="history.html" > / Lịch sử</a>
                    </li>
            </ul>
        </div>
    </div>

    <section class="new-home  wow fadeInUp">
        <div class="container">
            <h2 class="title-pr">Lịch sử</h2>

            <div class="row">
                <?php if (isset($articleList) && is_array($articleList) && count($articleList)) { ?>
                    <?php foreach ($articleList as $key => $val) { ?>
                        <?php
                        $detailArticle = $this->Autoload_Model->_get_where(array(
                            'select' => 'id, title, slug, canonical, catalogueid, description, image, viewed, (SELECT fullname FROM user WHERE user.id = article.userid_created) as fullname, created',
                            'table' => 'article',
                            'where' => array('id' => $val['articleid'],'publish' => 0,'alanguage' => $this->fc_lang),
                        ));
                        ?>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <?php echo itemArticle($detailArticle) ?>
                        </div>
                    <?php } ?>

                <?php } ?>

            </div>
            <?php if(!empty($PaginationList)){?>
                <div class="pagenavi  wow fadeInUp">
                    <ul>
                        <li>
                            <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>

                        </li>
                    </ul>
                </div>
            <?php }?>
        </div>
    </section>


</div>
