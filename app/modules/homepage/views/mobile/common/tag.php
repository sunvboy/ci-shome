<?php
if (!$tagArticle = $this->cache->get('tagArticle')) {
    $tagArticle = $this->Autoload_Model->_get_where(array(
        'select' => 'id, title,image,created,canonical,description, (SELECT title FROM article_catalogue WHERE article_catalogue.id = article.catalogueid) as catalogue_title',
        'table' => 'article',
        'limit' => 7,
        'order_by' => 'order asc,id desc',
        'where' => array('highlight' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)), true);
    $this->cache->save('tagArticle', $tagArticle, 200);
} else {
    $tagArticle = $tagArticle;
}


if (!$tagHome = $this->cache->get('tagHome')) {
    $tagHome = $this->Autoload_Model->_get_where(array(
        'select' => 'id, title',
        'table' => 'tag_catalogue',
        'limit' => 2,
        'order_by' => 'order asc,id desc',
        'where' => array('publish' => 0, 'alanguage' => $this->fc_lang)), true);
    if (isset($tagHome) && is_array($tagHome) && count($tagHome)) {
        foreach ($tagHome as $key => $val) {
            $tagHome[$key]['post'] = $this->Autoload_Model->_get_where(array(
                'select' => 'id, title,canonical',
                'table' => 'tag',
                'where' => array('catalogueid' => $val['id'], 'publish' => 0, 'alanguage' => $this->fc_lang)), true);
        }
    }
    $this->cache->save('tagHome', $tagHome, 200);
} else {
    $tagHome = $tagHome;
}
?>
    <section class="category-new">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <?php if (isset($tagHome) && is_array($tagHome) && count($tagHome)) { ?>
                        <?php foreach ($tagHome as $key => $val) {
                            if ($key == 0) { ?>
                                <div class="item-category">
                                    <h2 class="title-primary1"><?php echo $val['title'] ?></h2>
                                    <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>

                                        <div class="nav-item-category">
                                            <?php foreach ($val['post'] as $keyP => $valP) {
                                                $href = rewrite_url($valP['canonical'], TRUE, TRUE); ?>

                                                <a href="<?php echo $href ?>"><?php echo $valP['title'] ?></a>
                                            <?php } ?>


                                        </div>
                                    <?php } ?>

                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>


                </div>


                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?php if (isset($tagArticle) && is_array($tagArticle) && count($tagArticle)) { ?>

                        <div class="category-new-center">

                            <?php foreach ($tagArticle as $key => $val) {
                                $href = rewrite_url($val['canonical'], TRUE, TRUE);
                                $description = cutnchar(strip_tags($val['description']), 300);

                                ?>
                                <?php if ($key <= 2) { ?>

                                    <div class="item">
                                        <div class="row">
                                            <div class="col-md-5 col-sm-5 col-xs-12">
                                                <div class="image">
                                                    <a href="<?php echo $href ?>"><img src="<?php echo $val['image'] ?>"
                                                                                       alt="<?php echo $val['title'] ?>"></a>
                                                </div>
                                            </div>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <div class="nav-image">
                                                    <h3 class="title"><a
                                                            href="<?php echo $href ?>"><?php echo $val['title'] ?></a>
                                                    </h3>

                                                    <p class="cat-item"><?php echo $val['catalogue_title'] ?></p>

                                                    <p class="desc"><?php echo $description ?> </p>

                                                    <p class="date"><?php echo show_time($val['created'], 'd') ?>
                                                        Tháng <?php echo show_time($val['created'], 'm') ?>
                                                        Năm <?php echo show_time($val['created'], 'Y') ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>

                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <?php if (isset($tagHome) && is_array($tagHome) && count($tagHome)) { ?>
                        <?php foreach ($tagHome as $key => $val) {
                            if ($key == 1) { ?>
                                <div class="item-category">
                                    <h2 class="title-primary1"><?php echo $val['title'] ?></h2>
                                    <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>

                                        <div class="nav-item-category">
                                            <?php foreach ($val['post'] as $keyP => $valP) {
                                                $href = rewrite_url($valP['canonical'], TRUE, TRUE); ?>

                                                <a href="<?php echo $href ?>"><?php echo $valP['title'] ?></a>
                                            <?php } ?>


                                        </div>
                                    <?php } ?>

                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php if (isset($tagArticle) && is_array($tagArticle) && count($tagArticle)) { ?>

    <section class="new-home tag-new-home">
        <div class="container-fluid">
            <div class="content-new-home">
                <div class="row">

                    <?php foreach ($tagArticle as $key => $val) {
                        $href = rewrite_url($val['canonical'], TRUE, TRUE);
                        $description = cutnchar(strip_tags($val['description']), 300);

                        ?>
                        <?php if ($key > 2) { ?>
                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="item">
                                    <div class="image">
                                        <a href="<?php echo $href ?>"><img src="<?php echo $val['image'] ?>"
                                                                           alt="<?php echo $val['title'] ?>"></a>
                                    </div>
                                    <div class="nav-image">
                                        <h3 class="title"><?php echo $val['title'] ?></h3>

                                        <p class="date"><?php echo show_time($val['created'], 'd') ?>
                                            Tháng <?php echo show_time($val['created'], 'm') ?>
                                            Năm <?php echo show_time($val['created'], 'Y') ?></p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                        <?php } ?>
                    <?php } ?>

                </div>
            </div>
        </div>
    </section>
<?php } ?>