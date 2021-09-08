<?php
$docan = $this->Autoload_Model->_get_where(array(
    'select' => 'id, title',
    'table' => 'attribute',
    'where' => array('catalogueid' => 30, 'publish' => 0, 'alanguage' => $this->fc_lang),
    'order_by' => 'order asc, id desc'), true);
$dogian = $this->Autoload_Model->_get_where(array(
    'select' => 'id, title',
    'table' => 'attribute',
    'where' => array('catalogueid' => 31, 'publish' => 0, 'alanguage' => $this->fc_lang),
    'order_by' => 'order asc, id desc'), true);
$dactinhsanpham = $this->Autoload_Model->_get_where(array(
    'select' => 'id, title',
    'table' => 'attribute',
    'where' => array('catalogueid' => 	33, 'publish' => 0, 'alanguage' => $this->fc_lang),
    'order_by' => 'order asc, id desc'), true);
$mausac = $this->Autoload_Model->_get_where(array(
    'select' => 'id, title,color',
    'table' => 'attribute',
    'where' => array('catalogueid' => 	32, 'publish' => 0, 'alanguage' => $this->fc_lang),
    'order_by' => 'order asc, id desc'), true);
?>
<style>
    .nav-checkbox{
        padding-bottom: 20px;
    }
</style>

<form class="filter-aside" method="get" action="tim-kiem-nang-cao.html">
    <div class="nav-filter-product">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="item">
                    <?php if(!empty($docan)){?>
                        <div class="item1">
                            <h3 class="title-top">
                                <span class="title ">Độ cận</span>
                                <span class="choose-title js_all_docan_chon"><i  class="fas fa-check-circle"></i>Chọn tất cả</span>
                                <span class="choose-title js_all_docan_bo" style="color: green;display: none"><i  class="fas fa-check-circle"></i>Bỏ chọn tất cả</span>
                            </h3>
                            <div class="nav-item1">
                                <ul>
                                    <?php foreach ($docan as $key=>$val){?>
                                        <li><a data-id="<?php echo $val['id']?>" href="javascript:void(0)" class="js_docan js_docan<?php echo $val['id']?>" onclick="clickDoCan('<?php echo $val['id']?>')"><?php echo $val['title']?></a></li>
                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                        <input type="hidden" name="docan" id="input_docan" class="form-control">
                    <?php }?>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="item">
                    <?php if(!empty($mausac)){?>
                        <div class="item2" style="width: 100%">
                            <h3 class="title-top"><span class="title">Màu sắc</span>

                                <span class="choose-title js_all_mausac_chon"><i  class="fas fa-check-circle"></i>Chọn tất cả</span>
                                <span class="choose-title js_all_mausac_bo" style="color: green;display: none"><i  class="fas fa-check-circle"></i>Bỏ chọn tất cả</span>

                            </h3>
                            <div class="nav-checkbox">
                                <?php foreach ($mausac as $key=>$val){?>
                                    <div class="checkbox">
                                        <input onclick="clickMauSac('<?php echo $val['id']?>')" class="js_mausac" type="checkbox" value="<?php echo $val['id']?>" id="a<?php echo $val['id']?>">
                                        <label for="a<?php echo $val['id']?>" style="background-color: <?php echo $val['color']?>;border-color: <?php echo $val['color']?>;"></label>
                                        <span style="display: none"><?php echo $val['title']?></span>
                                    </div>

                                <?php }?>



                            </div>
                        </div>
                        <input type="hidden" name="mausac" id="input_color" class="form-control">

                    <?php }?>
                </div>
            </div>
            <div class="clearfix"></div>


            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="item">
                    <?php if(!empty($dogian)){?>
                        <div class="item1 item2">
                            <h3 class="title-top"><span class="title">Độ giãn</span>

                                <span class="choose-title js_all_dogian_chon"><i  class="fas fa-check-circle"></i>Chọn tất cả</span>
                                <span class="choose-title js_all_dogian_bo" style="color: green;display: none"><i  class="fas fa-check-circle"></i>Bỏ chọn tất cả</span>
                            </h3>
                            <div class="nav-item1">
                                <ul>
                                    <?php foreach ($dogian as $key=>$val){?>
                                        <li><a data-id="<?php echo $val['id']?>" href="javascript:void(0)" class="js_dogian js_dogian<?php echo $val['id']?>" onclick="clickDoGian('<?php echo $val['id']?>')"><?php echo $val['title']?></a></li>
                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                        <input type="hidden" name="dogian" id="input_dogian" class="form-control">

                    <?php }?>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="item">
                    <?php if(!empty($dactinhsanpham)){?>
                        <div class="item1 item3" style="margin-top: 0px">
                            <h3 class="title-top"><span class="title">Đặc tính sản phẩm</span>

                                <span class="choose-title js_all_dactinh_chon"><i  class="fas fa-check-circle"></i>Chọn tất cả</span>
                                <span class="choose-title js_all_dactinh_bo" style="color: green;display: none"><i  class="fas fa-check-circle"></i>Bỏ chọn tất cả</span>
                            </h3>
                            <div class="nav-item1">
                                <ul>
                                    <?php foreach ($dactinhsanpham as $key=>$val){?>
                                        <li><a data-id="<?php echo $val['id']?>" href="javascript:void(0)" class="js_dactinh js_dactinh<?php echo $val['id']?>" onclick="clickDacTinh('<?php echo $val['id']?>')"><?php echo $val['title']?></a></li>
                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                        <input type="hidden" name="dactinhsanpham" id="input_dactinh" class="form-control">

                    <?php }?>
                </div>
            </div>

        </div>
    </div>
    <div class="loc-sp">
        <button type="submit" >Lọc sản phẩm</button>
    </div>

</form>
<script>

    function m() {
        let attr = '';
        $('.js_mausac').each(function(){
            if($(this).prop('checked') == true){
                let id = $(this).val();
                attr = attr + 'mau-sac' + ';' + id + ';';
            }
        });
        $('#input_color').val(attr).change();
    }
    function clickMauSac(id){

        if($('.js_mausac'+id).is(':checked')) {
            $(this).prop('checked',true);
        } else {
            $(this).prop('checked',false);
        }

        $('.js_all_mausac_chon').hide();
        $('.js_all_mausac_bo').show();
        m();
    }
    $('.js_all_mausac_chon').click(function () {
        $('.js_mausac').prop('checked',false);
        $('.js_mausac').prop('checked',true);
        $('.js_all_mausac_chon').hide();
        $('.js_all_mausac_bo').show();
        m();
    });
    $('.js_all_mausac_bo').click(function () {
        $('.js_mausac').prop('checked',false);
        $('.js_all_mausac_chon').show();
        $('.js_all_mausac_bo').hide();
        m();
    });

</script>
<script>
    function g() {
        let attr = '';
        $('.js_dogian.active').each(function (key, index) {
            let id = $(this).attr('data-id');
            attr = attr + 'do-gian' + ';' + id + ';';
        });
        $('#input_dogian').val(attr).change();
    }
    function clickDoGian(id){
        $('.js_dogian'+id).toggleClass('active');
        $('.js_all_dogian_chon').hide();
        $('.js_all_dogian_bo').show();
        g();
    }
    $('.js_all_dogian_chon').click(function () {
        $('.js_dogian').removeClass('active');
        $('.js_dogian').addClass('active');
        $('.js_all_dogian_chon').hide();
        $('.js_all_dogian_bo').show();
        g();
    });
    $('.js_all_dogian_bo').click(function () {
        $('.js_dogian').removeClass('active');
        $('.js_all_dogian_bo').hide();
        $('.js_all_dogian_chon').show();
        g();
    })
</script>
<script>
    function e() {
        let attr = '';
        $('.js_docan.active').each(function (key, index) {
            let id = $(this).attr('data-id');
            attr = attr + 'do-can' + ';' + id + ';';
        });
        $('#input_docan').val(attr).change();
    }
    function clickDoCan(id){
        $('.js_docan'+id).toggleClass('active');
        $('.js_all_docan_chon').hide();
        $('.js_all_docan_bo').show();
        e();
    }
    $('.js_all_docan_chon').click(function () {
        $('.js_docan').removeClass('active');
        $('.js_docan').addClass('active');
        $('.js_all_docan_chon').hide();
        $('.js_all_docan_bo').show();
        e();
    });
    $('.js_all_docan_bo').click(function () {
        $('.js_docan').removeClass('active');
        $('.js_all_docan_bo').hide();
        $('.js_all_docan_chon').show();
        e();
    })
</script>
<script>
    function d() {
        let attr = '';
        $('.js_dactinh.active').each(function (key, index) {
            let id = $(this).attr('data-id');
            attr = attr + 'dac-tinh-san-pham' + ';' + id + ';';
        });
        $('#input_dactinh').val(attr).change();
    }
    function clickDacTinh(id){
        $('.js_dactinh'+id).toggleClass('active');
        $('.js_all_dactinh_chon').hide();
        $('.js_all_dactinh_bo').show();
        d();
    }
    $('.js_all_dactinh_chon').click(function () {
        $('.js_dactinh').removeClass('active');
        $('.js_dactinh').addClass('active');
        $('.js_all_dactinh_chon').hide();
        $('.js_all_dactinh_bo').show();
        d();
    });
    $('.js_all_dactinh_bo').click(function () {
        $('.js_dactinh').removeClass('active');
        $('.js_all_dactinh_bo').hide();
        $('.js_all_dactinh_chon').show();
        d();
    })
</script>
