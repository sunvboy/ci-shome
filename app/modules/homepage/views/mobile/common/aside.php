<?php
if (!$tintuc = $this->cache->get('tintuc')) {
    $tintuc = $this->Autoload_Model->_get_where(array(
        'select' => 'id, title, slug, canonical, lft, rgt',
        'table' => 'article_catalogue',
        'where' => array('ishome' => 1, 'publish' => 0, 'parentid' => 0, 'alanguage' => $this->fc_lang)), true);
    if (isset($tintuc) && is_array($tintuc) && count($tintuc)) {
        foreach ($tintuc as $key => $val) {

            $tintuc[$key]['post'] = $this->Autoload_Model->_condition(array(
                'module' => 'article',
                'select' => '`object`.`id`, `object`.`title`, `object`.`slug`, `object`.`canonical`, `object`.`image`, `object`.`created`',
                'where' => '`object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\'',
                'catalogueid' => $val['id'],
                'limit' => 4,
                'order_by' => '`object`.`order` asc, `object`.`id` asc',
            ));
        }
    }
    $this->cache->save('tintuc', $tintuc, 300);
} else {
    $tintuc = $tintuc;
}
?>
<?php

$dropdown = $this->Autoload_Model->_get_where(array('table' => 'product_catalogue', 'select' => 'id, title,canonical', 'order_by' => 'order ASC,id DESC', 'limit' => 11, 'where' => array('publish' => 0, 'parentid' => 0, 'alanguage' => $this->fc_lang)), true);
if (isset($dropdown) && is_array($dropdown) && count($dropdown)) {
    foreach ($dropdown as $key => $val) {

        $dropdown[$key]['child'] = $this->Autoload_Model->_get_where(array('table' => 'product_catalogue', 'select' => 'id, title,canonical', 'order_by' => 'order ASC,id DESC', 'where' => array('publish' => 0, 'parentid' => $val['id'], 'alanguage' => $this->fc_lang)), true);
    }
}

?>


<style>
    .sidebar .left-category .nav-category{
        position: inherit;
        display: block;
    }
    .sidebar .left-category ul li a{
        padding-left: 0px;

    }
    .sidebar .left-category .nav-category{
        width: 100%;
    }
</style>


<div class="col-md-3 col-sm-12 col-xs-12">



    <aside class="sidebar">
        <div class="item">
            <h2 class="title-primary1">Danh mục sản phẩm</h2>

            <div class="nav-item-new">
                <?php if (isset($dropdown) && is_array($dropdown) && count($dropdown)) { ?>
                    <div class="left-category">
                        <div class="nav-category">
                            <ul>
                                <?php foreach ($dropdown as $key => $val) {
                                    $href = rewrite_url($val['canonical'], TRUE, TRUE); ?>
                                    <li>
                                        <a href="<?php echo $href ?>"><?php echo $val['title'] ?></a>
                                        <?php if (isset($val['child']) && is_array($val['child']) && count($val['child'])) { ?>
                                            <div class="submenu-category">
                                                <div class="top-submenu">
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <ul>
                                                                <?php $i = 0;
                                                                foreach ($val['child'] as $keyue => $value) {
                                                                $i++;
                                                                $hrefvalue = rewrite_url($value['canonical'], TRUE, TRUE); ?>
                                                                <li>
                                                                    <a href="<?php echo $hrefvalue ?>"><?php echo $value['title'] ?></a>
                                                                </li>
                                                                <?php if ($i % 5 == 0){ ?></ul>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <ul><?php } ?>
                                                                <?php } ?>
                                                            </ul>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        <?php } ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>

                <?php } ?>



            </div>
        </div>
        <?php if (isset($tintuc) && is_array($tintuc) && count($tintuc)) { ?>
            <?php foreach ($tintuc as $key => $val) {
                $hrefT = rewrite_url($val['canonical'], true, true); ?>
                <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
                    <div class="item">
                        <h2 class="title-primary1"><?php echo $val['title'] ?> nổi bật</h2>

                        <div class="nav-item-new">
                            <?php foreach ($val['post'] as $keyP => $valP) {
                                $href = rewrite_url($valP['canonical'], true, true); ?>
                                <div class="item2 ">
                                    <div class="row">
                                        <div class="col-md-5 col-xs-5 col-sm-5">
                                            <div class="image">
                                                <a href="<?php echo $href ?>"><img src="<?php echo $valP['image'] ?>"  alt="<?php echo $valP['title'] ?>" style="height: auto"></a>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-xs-7 col-sm-7" style="padding: 0px">
                                            <h3 class="title2"><a href="<?php echo $href ?>"><?php echo $valP['title'] ?> </a>
                                            </h3>
                                        </div>
                                    </div>



                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>
        <div class="item-fb">
            <div class="fb-page" data-href="<?php echo $this->fcSystem['social_facebook']?>" data-tabs="timeline" data-width=""
                 data-height="200" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false"
                 data-show-facepile="true">
                <blockquote cite="<?php echo $this->fcSystem['social_facebook']?>" class="fb-xfbml-parse-ignore"><a
                        href="<?php echo $this->fcSystem['social_facebook']?>">Facebook</a></blockquote>
            </div>
        </div>
    </aside>
</div>

