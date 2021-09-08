<div class="col-md-3 col-sm-3 col-xs-12">
    <div class="sidebar-right">
        <?php
        if (!$xemNhieu = $this->cache->get('xemNhieu')) {
            $xemNhieu = $this->Autoload_Model->_get_where(array(
                'select' => 'id, title,image,viewed,canonical,created',
                'table' => 'article',
                'order_by' => 'viewed desc',
                'limit' => 5,
                'where' => array('publish' => 0, 'alanguage' => $this->fc_lang)), true);
            $this->cache->save('xemNhieu', $xemNhieu, 200);
        } else {
            $xemNhieu = $xemNhieu;
        }
        ?>
        <?php if (isset($xemNhieu) && is_array($xemNhieu) && count($xemNhieu)) {?>
            <div class="item-sb">
                <h2 class="title-primary1">Bài viết xem nhiều nhất</h2>

                <div class="content-Handbook-right box">

                    <?php foreach ($xemNhieu as $key => $val) {
                        $href = rewrite_url($val['canonical'], TRUE, TRUE);
                        $canonical  = $href;
                        ?>
                        <div class="item">
                            <div class="image">
                                <a href="<?php echo $href?>"><img src="<?php echo $val['image'] ?>" alt="<?php echo $val['title'] ?>"></a>
                            </div>
                            <div class="nav-image">
                                <h3 class="title"><a href="<?php echo $href?>"><?php echo $val['title'] ?></a></h3>

                                <p class="date"><?php echo show_time($val['created'], 'd') ?>
                                    Tháng <?php echo show_time($val['created'], 'm') ?>
                                    Năm <?php echo show_time($val['created'], 'Y') ?></p>
                            </div>
                            <div class="clearfix"></div>
                            <ul class="list-share">
                                <li><div class="fb-like" data-href="<?php echo $canonical?>" data-width="" data-layout="button" data-action="like" data-size="small" data-share="true"></div></li>
                                <?php if($val['viewed'] > 0){?>
                                    <li style="display: flex;align-items: center;"><?php echo $val['viewed'] ?>
                                        <img src="template/frontend/noithat-PC/images/i3.png" alt="<?php echo $val['viewed'] ?>">
                                    </li>
                                <?php }?>
                            </ul>
                        </div>
                    <?php }?>



                </div>

            </div>
        <?php }?>
        <div class="item-sb">
            <?php echo $this->load->view('homepage/frontend/common/experience-right') ?>

        </div>


    </div>


</div>