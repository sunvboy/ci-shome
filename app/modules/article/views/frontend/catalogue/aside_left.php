<div class="col-md-3 col-sm-3 col-xs-12">
    <div class="sidebar-left">


        <?php
        if (!$baivietQuantam = $this->cache->get('baivietQuantam')) {
            $baivietQuantam = $this->Autoload_Model->_get_where(array(
                'select' => 'id, title,image,viewed,canonical',
                'table' => 'article',
                'limit' => 6,
                'where' => array('isaside' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)), true);
            $this->cache->save('baivietQuantam', $baivietQuantam, 200);
        } else {
            $baivietQuantam = $baivietQuantam;
        }
        ?>
        <?php if (isset($baivietQuantam) && is_array($baivietQuantam) && count($baivietQuantam)) {?>
            <div class="item-sb">
                <h2 class="title-primary1">Bài viết quan tâm</h2>



                <div class="content-Handbook-left box">



                    <?php  foreach ($baivietQuantam as $key => $val) {
                        $href = rewrite_url($val['canonical'], TRUE, TRUE);
                        $canonical  = $href;
                        ?>
                        <div class="item">
                            <h3 class="title"><a href=""><?php echo $val['title']?></a></h3>
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
            <?php echo $this->load->view('homepage/frontend/common/experience-left') ?>

        </div>

    </div>


</div>