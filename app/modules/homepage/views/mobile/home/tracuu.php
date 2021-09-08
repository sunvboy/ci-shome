<div id="main" class="wrapper main-Handbook">


    <section class="content-Experimental">
        <div class="container-fluid">

            <div class="content-Handbook section-experience">
                <div class="row">
                    <?php echo $this->load->view('article/frontend/catalogue/aside_left') ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <h2 class="title-primary1"><?php echo $detailCatalogue['title'] ?></h2>

                        <div class="content-Handbook-center box" style="background: transparent; border-radius: 0px;margin-bottom: 0px;box-shadow: 0px 0px;padding: 0px;">

                            <?php if($detailCatalogue['id'] == 9){ ?>
                                <div class="thong-tin-bv">

                                    <div class="title-filed"><span class="key">- Họ và tên: </span><span><?php echo $this->input->get('fullname');?></span>
                                    </div>
                                    <div class="title-filed"><span class="key">- Tuổi gia chủ(âm lịch): </span><span><?php echo $this->input->get('tuoi');?></span>
                                    </div>
                                    <div class="title-filed"><span class="key">- Năm dự kiến làm nhà:</span> <span  class="value chi_phi"><?php echo $this->input->get('namdukien');?></span>
                                    </div>
                                </div>
                            <?php }else{?>
                                <div class="thong-tin-bv">

                                    <div class="title-filed"><span class="key">- Tên gia chủ: </span><span><?php echo $this->input->get('fullname');?></span>
                                    </div>
                                    <div class="title-filed"><span class="key">- Giới tính: </span><span><?php echo $this->configbie->data('huongnha',$this->input->get('gioitinh'));?></span>
                                    </div>
                                    <div class="title-filed"><span class="key">- Hướng nhà:</span> <span  class="value chi_phi"><?php echo $this->configbie->data('huongnha',$this->input->get('huongnha'));?></span>
                                    </div>

                                    <div class="title-filed"><span class="key">- Năm sinh gia chủ:</span> <span  class="value chi_phi"><?php echo $this->input->get('tuoi');?></span>
                                    </div>
                                </div>
                            <?php }?>

                            <div style="clear: both;height: 20px;"></div>
                            <div class="desc" style="height: 100% !important;">
                                <?php echo !empty($detailArticle['description'] != '')?$detailArticle['description']:'Dữ liệu đang được cập nhập...' ?>
                            </div>
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
                                <div class="fb-comments" data-href="<?php echo $canonical ?>" data-numposts="20" data-width="1140"></div>
                            </div>
                        </div>
                    </div>
                    <?php echo $this->load->view('article/frontend/catalogue/aside_right') ?>
                </div>
            </div>
        </div>
    </section>
    <?php echo $this->load->view('homepage/frontend/common/tag') ?>
    <?php echo $this->load->view('homepage/frontend/common/mailsubricre') ?>

</div>

<style>
    .thong-tin-bv {
        background: #eeffeb;
        padding: 10px;
        margin: 0 auto;
        border: 1px dashed #ff8d65;
        margin-top: 10px;
        border-radius: 3px;
        font-size: 20px;
        line-height: 28px;
    }
    .thong-tin-bv .key {
        font-weight: bold;
    }
</style>
<style>
    .new-home,.title-title-small{
        display: none;
    }
</style>