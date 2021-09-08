<div id="main" class="wrapper main-Experimental">

    <?php
    $idCheck=0;
    $trainghiem = $this->Autoload_Model->_get_where(array(
        'select' => 'id, title,description,image',
        'table' => 'page',
        'where' => array('highlight' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)));

    $listMenu = $this->Autoload_Model->_get_where(array(
        'select' => 'id, title,canonical,image',
        'table' => 'media_catalogue',
        'limit' => 4,
        'where' => array('highlight' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)), true);
    ?>
    <style>
        .top-banner-right {
            position: absolute;
            right: 59px;
            top: 50%;
            transform: translateY(-50%);
            width: 423px;
        }
    </style>
    <div id="banner" class="banner-child">
        <a href="" class="img-banner"><img src="<?php echo $trainghiem['image']?>" alt="<?php echo $trainghiem['title']?>"></a>
        <h3 class="title-category"><a href="javascript:void(0)"><?php echo $trainghiem['title']?> </a></h3>
    </div>
    <?php  if (isset($listMenu) && is_array($listMenu) && count($listMenu)) {?>
    <section class="Experimental-page">
        <div class="container-fluid">
            <h2 class="title-primary1"><?php echo $trainghiem['description']?></h2>

            <div class="nav-Experimental tabs">
                <div class="slider-tab owl-carousel">
                    <?php foreach ($listMenu as $key => $val) { if($key == 0){ $idCheck = $val['id']; }?>
                        <div class="item">
                            <div class="image">
                                <a href="javascript:void(0)" onclick="ajaxCatalogue(<?php echo $val['id']?>)"><img src="<?php echo $val['image']?>" alt="<?php echo $val['title']?>" style="height: 132px;object-fit: cover"></a>
                            </div>
                            <div class="nav-image">
                                <h3 class="title"><a href="javascript:void(0)" onclick="ajaxCatalogue(<?php echo $val['id']?>)"><?php echo $val['title']?></a></h3>
                            </div>
                        </div>
                    <?php }?>


                </div>
            </div>
        </div>
    </section>
    <?php }?>
    <script>
        ajaxCatalogue(<?php echo $idCheck?>);
        function ajaxCatalogue(id){
            $.ajax({
                method: "POST",
                url: 'homepage/home/ajaxCatalogue',
                data: {id: id},
                dataType: "json",
                cache: false,
                success: function(json){
                    $('#tab-1').html(json.html);
                }
            });

        }

    </script>


    <section id="tab-1" class="tab-content current content-Experimental">

    </section>



    <?php
    $publish_time = gmdate('Y-m-d H:i:s', time() + 7*3600);

    $anh360 = $this->Autoload_Model->_get_where(array(
        'select' => 'id, title,canonical',
        'table' => 'media_catalogue',
        'where' => array('ishome' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)), true);
    if (isset($anh360) && is_array($anh360) && count($anh360)) {
        foreach ($anh360 as $key => $val) {
            $anh360[$key]['post'] = $this->Autoload_Model->_condition(array(
                'module' => 'media',
                'select' => '`object`.`id`, `object`.`title`, `object`.`image`, `object`.`canonical`, `object`.`viewed`',
                'where' => '`object`.`publish_time` <= \'' . $publish_time . '\' AND `object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\' ',
                'catalogueid' => $val['id'],
                'limit' => 40,
                'order_by' => '`object`.`order` asc, `object`.`id` asc',
            ));
        }
    }

    if (isset($anh360) && is_array($anh360) && count($anh360)) { ?>
        <?php foreach ($anh360 as $key => $val) {
             ?>
            <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
                <section class="content-Experimental content-Experimental-bottom">
                    <div class="container-fluid">
                        <h2 class="title-primary1">XEM <?php echo $val['title']?></h2>

                        <div class="row">
                            <div class="content-Experimental-right">
                                <?php foreach ($val['post'] as $keyP => $valP) {  $href = rewrite_url($valP['canonical'], TRUE, TRUE);  ?>

                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item1">
                                            <div class="image">
                                                <a href="<?php echo $href ?>" ><img src="<?php echo $valP['image']?>" alt="<?php echo $valP['title']?>"></a>
                                            </div>
                                            <div class="nav-image">
                                                <h3 class="title"><a href="<?php echo $href ?>"><?php echo $valP['title']?></a>
                                                </h3>
                                                <ul>
                                                    <li>
                                                        <div class="fb-like" data-href="<?php echo $href ?>" data-width="" data-layout="button" data-action="like" data-size="small" data-share="true"></div>
                                                    </li>

                                                    <?php if ($valP['viewed'] > 0) { ?>
                                                        <li><?php echo $valP['viewed'] ?> <img src="template/frontend/noithat-PC/images/i3.png" alt="lượt xem">
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>


                            </div>
                        </div>
                    </div>
                </section>

            <?php } ?>
        <?php } ?>
    <?php } ?>



    <?php echo $this->load->view('homepage/frontend/common/tag') ?>


    <?php echo $this->load->view('homepage/frontend/common/mailsubricre') ?>


</div>
