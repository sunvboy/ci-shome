<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="row border-bottom">
        <?php $this->load->view('dashboard/backend/common/navbar'); ?>
    </div>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Cập nhập hiển thị</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo site_url('admin'); ?>">Home</a>
                </li>
                <li class="active"><strong>Cập nhập hiển thị</strong></li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <form method="post" action="" class="form-horizontal">
            <div class="row">
                <div class="box-body">
                    <?php $error = validation_errors();
                    echo !empty($error) ? '<div class="alert alert-danger">' . $error . '</div>' : ''; ?>
                </div><!-- /.box-body -->
            </div>
            <?php
            function array_group_by(array $arr, callable $key_selector)
            {
                $result = array();
                foreach ($arr as $i) {
                    $key = call_user_func($key_selector, $i);
                    $result[$key][] = $i;
                }
                return $result;
            }
            $groupedLanOne = array_group_by($listIS, function ($i) {
                return trim($i['module']);
            });
            ?>
            <?php /* if (is_array($groupedLanOne) && isset($groupedLanOne) && count($groupedLanOne)) { ?>
            <ul class="nav nav-pills">
                <?php $i=0; foreach ($groupedLanOne as $key => $val) { $i++;?>
                <li class="<?php if($i==1){?>active<?php }?>"><a data-toggle="pill" href="#menu<?php echo $i?>"><?php echo $key?></a></li>
                <?php }?>
            </ul>
            <?php */?>
            <div >
                <?php $i=0; foreach ($groupedLanOne as $key => $val) { $i++;?>
                <div id="menu<?php echo $i?>" >
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <div class="toolbox">
                                        <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                            <h5><?php echo $key?></h5>
                                            <div class="uk-button">
                                                <button type="button" class="btn btn-primary btn-sm myBtn" data-title="<?php echo $key?>">
                                                    Thêm mới
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ibox-content">
                                    <?php if (is_array($val) && isset($val) && count($val)) { ?>
                                        <?php foreach ($val as $keyC => $valC) { ?>
                                            <div class="form-group">
                                                <div class="col-md-1">
                                                    <div class="switch">
                                                        <div class="onoffswitch">
                                                            <input type="checkbox" <?php echo ($valC['publish'] == 1) ? 'checked=""' : ''; ?> class="onoffswitch-checkbox publish_is"  data-id="<?php echo $valC['id']; ?>" id="publish_is<?php echo $valC['id']; ?>">
                                                            <label class="onoffswitch-label" for="publish_is<?php echo $valC['id']; ?>">
                                                                <span class="onoffswitch-inner"></span>
                                                                <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label class="col-md-1">
                                                    <span><?php echo $valC['is']?></span>
                                                </label>
                                                <div class="col-md-3">
                                                    <input type="text" data-id="<?php echo $valC['id']?>" name="title" value="<?php echo $valC['title']?>"  class="form-control title_is title_is<?php echo $valC['id']?>" placeholder="" autocomplete="off">
                                                </div>

                                            </div>
                                            <div class="hr-line-dashed"></div>
                                        <?php }?>
                                    <?php }?>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </form>
    </div>
    <?php $this->load->view('dashboard/backend/common/footer'); ?>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="color:red;">Thêm mới </h4>
            </div>
            <div class="modal-body">
                <form role="form" id="form_is">
                    <div class="form-group error">

                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="IDtype" name="IDtype">
                    </div>
                    <div class="form-group">
                        <label for="usrname">Tên trường: Ví dụ: ishome,highlight....</label>
                        <input type="text" class="form-control" name="isColum" id="isColum" placeholder="Tên trường">
                    </div>
                    <div class="form-group">
                        <label for="psw">Tiêu đề</label>
                        <input type="text" class="form-control" id="isTitle" placeholder="Tiêu đề">
                    </div>
                    <div class="form-group">
                        <label for="psw">Hiển thị</label>
                        <?php echo form_dropdown('isPublish', array(1=>'Hiển thị',0=>'Không hiển thị'), set_value('isPublish') ,'class="form-control" id="isPublish"'); ?>
                    </div>
                    <button type="submit" class="btn btn-danger">Thêm mới </button>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".myBtn").click(function () {
            var title = $(this).data('title');
            $("#IDtype").val(title);
            $("#myModal").modal();
        });
    });

    $(document).ready(function () {
        $('#form_is .error').hide();
        var uri = 'general/backend/general/ajax_isview';
        $('#form_is').on('submit', function () {
            let IDtype = $('#IDtype').val();
            let isColum = $('#isColum').val();
            let isTitle = $('#isTitle').val();
            let isPublish = $('#isPublish').val();
            $.post(uri, {IDtype: IDtype, isColum:isColum, isTitle:isTitle, isPublish:isPublish}, function (data) {
                var json = JSON.parse(data);
                $('#form_is .error').show();
                if (json.error.length) {
                    $('#form_is .error').removeClass('alert alert-success').addClass('alert alert-danger');
                    $('#form_is .error').html('').html(json.error);
                } else {

                    $('#form_is .error').removeClass('alert alert-danger').addClass('alert alert-success');
                    $('#form_is .error').html('').html('Thêm mới thành công.');
                    $('#form_is').trigger("reset");
                    setTimeout(function () {
                        location.reload();
                    }, 5000);
                }
            });
            return false;
        });
    });

</script>
<script>
    $(document).on('change','.publish_is',function(){
        let _this = $(this);
        let objectid = _this.attr('data-id');
        let formURL = 'general/backend/general/status';
        $.post(formURL, {objectid:objectid},
            function(data){
            });
    });
    var time;
    $(document).on('keyup change','.title_is', function(){
        let id = $('.title_is').attr('data-id');
        let title = $('.title_is'+id).val();
        console.log(id);

        title = title.trim();
        clearTimeout(time);
        if(title.length > 2){
            let formURL = 'general/backend/general/editTitle';
            $.post(formURL, {title:title,id:id});
        }
    });
</script>

<style>
    .modal-header {
        padding: 15px 30px;
        border-bottom: 1px solid #e5e5e5;
    }
    .nav > li.active > a {
        color: #ffffff;
        border-radius: 0px;
    }
</style>
