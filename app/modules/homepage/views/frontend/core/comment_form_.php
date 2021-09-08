<?php
$comment_view = comment(array('id' => $productDetail['id'], 'module' => 'product'));
$averagePoint = 0;
$totalComment = 0;
$arrayRate5 = $arrayRate4 = $arrayRate3 = $arrayRate2 = $arrayRate1 = 0;
$arrayRate5PT = $arrayRate4PT = $arrayRate3PT = $arrayRate2PT = $arrayRate1PT = 0;
if (isset($comment_view) && is_array($comment_view) && count($comment_view)) {
    $averagePoint = round($comment_view['statisticalRating']['averagePoint']);
    $totalComment = $comment_view['statisticalRating']['totalComment'];
    $arrayRate5 = $comment_view['statisticalRating']['arrayRate'][5];
    if($arrayRate5>0){
        $arrayRate5PT = ($arrayRate5/$totalComment)*100;
    }
    $arrayRate4 = $comment_view['statisticalRating']['arrayRate'][4];
    if($arrayRate4>0){
        $arrayRate4PT = ($arrayRate4/$totalComment)*100;
    }
    $arrayRate3 = $comment_view['statisticalRating']['arrayRate'][3];
    if($arrayRate3>0){
        $arrayRate3PT = ($arrayRate3/$totalComment)*100;
    }
    $arrayRate2 = $comment_view['statisticalRating']['arrayRate'][2];
    if($arrayRate2>0){
        $arrayRate2PT = ($arrayRate2/$totalComment)*100;
    }
    $arrayRate1 = $comment_view['statisticalRating']['arrayRate'][1];
    if($arrayRate1>0){
        $arrayRate1PT = ($arrayRate1/$totalComment)*100;
    }
}
?>




<div class="danhgia content-detail-course" id="danhgia">
    <div class="">
        <div class="contant-danhgia">
            <div class="star-box">
                <aside class="rating-left">
                    <div class="item1">
                        <div class="star-average">
                            <h3 class="title1">Đánh giá <?php echo ($averagePoint) ? review_render((int)$averagePoint) : 'Rất tốt'; ?></h3>
                            <p class="so-danhgia"><?php echo $averagePoint?>/5</p>
                            <p class="start" style="margin: 0px">

                                    <span class="rating lStar" disabled data-stars="5"  data-default-rating="<?php echo $averagePoint?>" data-rating="<?php echo $averagePoint?>"></span>

                            </p>
                            <p class="nhanxet">(<?php echo $totalComment?> nhận xét)</p>
                        </div>
                    </div>
                    <div class="item2">
                        <div class="star-line ">
                            <span class="star-type left">5 <i class="fas fa-star"></i></span>

                            <div class="star-bar" data-percent="0%">
                                <div class="star-barsub" style="width: <?php echo $arrayRate5PT?>%; "></div>
                            </div>
                            <span class="star-type right "><b> <?php echo $arrayRate5PT?>%</b> | <?php echo $arrayRate5?> đánh giá</span>
                        </div>
                        <div class="star-line ">
                            <span class="star-type left">4 <i class="fas fa-star"></i></span>

                            <div class="star-bar" data-percent="8%">
                                <div class="star-barsub" style="width: <?php echo $arrayRate4PT?>%;"></div>
                            </div>
                            <span class="star-type right "><b><?php echo $arrayRate4PT?>%</b> | <?php echo $arrayRate4?> đánh giá</span>
                        </div>
                        <div class="star-line ">
                            <span class="star-type left">3 <i class="fas fa-star"></i></span>

                            <div class="star-bar" data-percent="0%">
                                <div class="star-barsub" style="width: <?php echo $arrayRate3PT?>%; "></div>
                            </div>
                            <span class="star-type right "><b><?php echo $arrayRate3PT?>%</b> | <?php echo $arrayRate3?> đánh giá</span>
                        </div>
                        <div class="star-line ">
                            <span class="star-type left">2 <i class="fas fa-star"></i></span>

                            <div class="star-bar" data-percent="0%">
                                <div class="star-barsub" style="width: <?php echo $arrayRate2PT?>%; "></div>
                            </div>
                            <span class="star-type right "><b><?php echo $arrayRate2PT?>%</b> | <?php echo $arrayRate2?> đánh giá</span>
                        </div>
                        <div class="star-line ">
                            <span class="star-type left">1 <i class="fas fa-star"></i></span>

                            <div class="star-bar" data-percent="0%">
                                <div class="star-barsub" style="width: <?php echo $arrayRate1PT?>%;"></div>
                            </div>
                            <span class="star-type right "><b><?php echo $arrayRate1PT?>%</b> | <?php echo $arrayRate1?> đánh giá</span>
                        </div>
                    </div>
                    <div class="item3">
                        <span>Đánh giá sản phẩm</span>
                        <button type="button" class="btn" data-toggle="modal" data-target="#myModal">Viết đánh giá
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </aside>
            </div>
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>Đánh Giá</h3>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" class="form uk-form" id="form-front-comment">
                                <div class="form-group">
                                    <div class="error hidden">
                                        <div class="alert alert-danger"></div>
                                    </div>
                                    <div class="success hidden">
                                        <div class="alert alert-success"></div>
                                    </div>
                                </div>
                                <?php echo form_textarea('comment_note', htmlspecialchars_decode(html_entity_decode(set_value('comment_note'))), 'placeholder="Nội dung bình luận" class="info-form-comment uk-width-1-1" autocomplete="off"'); ?>
                                <span class="rating-c"><b>Bạn cảm thấy sản phẩm như thế nào?(chọn sao nhé):</b></span>
                                <div class="ips">
                                    <input type="hidden" class="data-rate" name="data-rate"  value="<?php echo ($this->input->post('data-rate')) ? (int)$this->input->post('data-rate') : 5; ?>">
                                    <span id="myRating" class="rating lStar" data-stars="5"  data-default-rating="<?php echo ($this->input->post('data-rate')) ? (int)$this->input->post('data-rate') : 5; ?>" data-rating="<?php echo ($this->input->post('data-rate')) ? (int)$this->input->post('data-rate') : 5; ?>"></span>
                                    <div class="title-rating rsStar"><?php echo ($this->input->post('data-rate')) ? review_render((int)$this->input->post('data-rate')) : 'Rất tốt'; ?></div>
                                    <div class="clr"></div>
                                </div>
                                <div class="if">
                                    <?php echo form_input('comment_name', htmlspecialchars_decode(html_entity_decode(set_value('comment_name',isset($this->FT_auth['id'])?$this->FT_auth['fullname']:''))), 'placeholder="Họ tên" class="input-form" autocomplete="off"'); ?>
                                    <?php echo form_input('comment_phone', htmlspecialchars_decode(html_entity_decode(set_value('comment_phone',isset($this->FT_auth['id'])?$this->FT_auth['phone']:''))), 'placeholder="Số điện thoại" class="input-form" autocomplete="off"'); ?>
                                    <?php echo form_input('comment_email', htmlspecialchars_decode(html_entity_decode(set_value('comment_email',isset($this->FT_auth['id'])?$this->FT_auth['email']:''))), 'placeholder="Email" class="input-form" autocomplete="off"'); ?>
                                    <input style="background: #52b858;border-color: #52b858;" type="submit" class="button button-comment submit js_comment_submit"  id="btn-review-send" value="GỬI ĐÁNH GIÁ NGAY" data-module="<?php echo $module; ?>" data-detailid="<?php echo $productDetail['id']; ?>"/>
                                    <button style="height: 35px;
    background: #ef0024;
    border: 1px solid #ef0024;
    color: #fff;
    padding: 0 16px;
    border-radius: 3px;" type="button" class="btn btn-danger" data-dismiss="modal">ĐÓNG</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="comment-list js_list_comment">


        </div>
        <div class="js_list_pagination">

        </div>
    </div>

</div>


<script src="plugin\rating\SimpleStarRating.js" type="text/javascript"></script>
<link rel="stylesheet" href="plugin\rating\SimpleStarRating.css">
<script src="plugin\jquery.timeago.js"  type="text/javascript"></script>
<script>
    var module = '<?php echo $module ?>';
    var moduleid = '<?php echo $productDetail['id']?>';
    listComment(module, moduleid, $('.js_list_comment').attr('data-page'));
    function listComment(module, moduleid, page){
        var uri = '<?php echo site_url('comment/frontend/comment/listComment'); ?>';
        $.post(uri, { module: module, moduleid: moduleid, page:page},
            function(data){
                var json = JSON.parse(data);
                $('.js_list_comment').html(json.listComment);
                $('.js_list_pagination').html(json.paginationList);
            });
    }
    $(document).on('click','.ajax-pagination  a',function(){
        var page = $(this).attr('data-ci-pagination-page');
        listComment(module, moduleid, page);
        return false;
    });
    $(document).on('click','.js_btn_reply', function(e){

        let _this = $(this);
        let param = {
            'id' : _this.attr('data-id'),
            'title' : _this.attr('data-title'),
            'module' : module,
            'detailid' : moduleid,
        };
        let reply = get_comment_html(param);
        let replyName = _this.parent().parent().siblings().find('._cmt-name').text();
        let commentAttr = _this.attr('data-comment');
        $('.show-reply').html('');
        $('.js_btn_reply').html('Trả lời');
        $('.js_btn_reply').attr('data-comment', 1);

        if(commentAttr == 1){
            _this.parent().siblings('.show-reply').html(reply);
            let replyTo = _this.parent().siblings('.show-reply').find('.text-reply').text('@'+ replyName + ' : ');
            replyTo.focus();
            textLength = $.trim(_this.parent().siblings('.show-reply').find('.text-reply').val()).length;
            //ban đầu ta ẩn nút gửi cmt
//            _this.parent().siblings('.show-reply').find('.btn-submit').attr('disabled' , '');
            _this.attr('data-comment', 0);
            _this.html('Bỏ comment');
        }else{
            _this.parent().siblings('.show-reply').html('');
            _this.attr('data-comment', 1);
            _this.html('Trả lời');
        }
        e.preventDefault();
    });
    function get_comment_html(param = ''){
        let comment = '';
        comment += '<div class="boxRatingCmt">';
        comment += '<form action="" method="post" class="form uk-form" >';
        comment += '<h2 id="review-title">Trả lời - '+param.title+'</h2>';
        comment += '<div class="form-group">';
        comment += '<div class="error_comm ">';
        comment += '</div>';
        comment += '</div>';
        comment += '<div class="clr"></div>';
        comment += '<div class="ipt row">';
        comment += '<div class="ct col-md-6 col-xs-12 col-sm-6">';
        comment += '<textarea name="comment_note" cols="40" rows="10"  placeholder="Nội dung bình luận" class="form-control" id="cmtreply-content" autocomplete="off"></textarea>';
        comment += '</div>';
        comment += '<div class="if col-md-6 col-xs-12 col-sm-6">';
        comment += '<div class="row">';
        comment += '<div class="col-md-6 col-xs-12 col-sm-6">';
        comment += '<input type="text" name="comment_name" value=""  placeholder="Họ tên" class="form-control " id="cmtreply-name" autocomplete="off" />';
        comment += '</div>';
        comment += '<div class="col-md-6 col-xs-12 col-sm-6">';
        comment += '<input type="text" name="comment_phone" value=""  placeholder="Số điện thoại" class="form-control " id="cmtreply-phone" autocomplete="off" />';
        comment += '</div>';
        comment += '<div class="col-md-6 col-xs-12 col-sm-6">';
        comment += '<input type="text" name="comment_email" value=""  placeholder="Email" class="form-control " id="cmtreply-email" autocomplete="off" />';
        comment += '</div>';
        comment += '<div class="col-md-6 col-xs-12 col-sm-6">';
        comment += '<div class="btn-cmt sent-cmt"><button type="button" name="sent_comment" value="sent_comment" class="btn btn-success btn-submit js_sent_comment" data-parentid = '+param.id+'  >Gửi</button></div>';
        comment += '</div>';
        comment += '</div>';
        comment += '</div>';
        comment += '</div>';
        comment += '</form>';
        comment += '</div>';
        return comment;
    }
    $(document).on('click','.js_sent_comment',function(){
        var parentid = $(this).attr('data-parentid');
        let cmtName = $('#cmtreply-name').val();
        let cmtPhone = $('#cmtreply-phone').val();
        let cmtEmail = $('#cmtreply-email').val();
        let cmtContent = $('#cmtreply-content').val();
        let param = {
            'parentid': parentid,
            'fullname': cmtName,
            'phone': cmtPhone,
            'email': cmtEmail,
            'comment': cmtContent,
            'rate': 0,
            'module': module,
            'detailid': moduleid,
        };
        let uri = "comment/frontend/comment/sent_comment";
        $.post(uri, {param: param, cmtName: cmtName, cmtPhone: cmtPhone,  cmtContent: cmtContent},
            function(data){
                var json = JSON.parse(data);
                if(json.error != ''){
                    $('.error_comm').removeClass('alert alert-success').addClass('alert alert-danger');
                    $('.error_comm').html('').html(json.message);
                }else{
                    $('.error_comm').removeClass('alert alert-danger').addClass('alert alert-success');
                    $('.error_comm').html('').html(json.message);
                    setTimeout(function(){ window.location.href='<?php echo $canonical ?>'; }, 3000);
                }
            });
        return false;
    });
    $(document).ready(function () {
        var time;
        rating();

        $(document).on('click', '#form-front-comment .js_comment_submit', function () {
            //lấy thông tin comment: tên, nội dung
            let _this = $(this);
            let formCmt = $('#form-front-comment');
            let cmtName = formCmt.find('input[name="comment_name"]').val();
            let cmtPhone = formCmt.find('input[name="comment_phone"]').val();
            let cmtEmail = formCmt.find('input[name="comment_email"]').val();
            let cmtContent = formCmt.find('textarea[name="comment_note"]').val();
            let dataRate = formCmt.find('input.data-rate').val();
            let loader = formCmt.find('.bg-loader');
            let param = {
                'fullname': cmtName,
                'phone': cmtPhone,
                'email': cmtEmail,
                'comment': cmtContent,
                'rate': dataRate,
                'module': _this.attr('data-module'),
                'detailid': _this.attr('data-detailid'),
            };
            loader.show();
            clearTimeout(time);
            time = setTimeout(function () {
                let ajaxUrl = "comment/frontend/comment/sent_comment";
                $.ajax({
                    method: "POST",
                    url: ajaxUrl,
                    data: {param: param, cmtName: cmtName, cmtPhone: cmtPhone,  cmtContent: cmtContent},
                    dataType: "json",
                    cache: false,
                    success: function (json) {
                        loader.hide();
                        if (json.error != '') {
                            formCmt.find('.error').removeClass('hidden');
                            formCmt.find('.alert-danger').html('').html(json.message);
                        } else {
                            formCmt.find('.error').addClass('hidden');
                            formCmt.find('.success').removeClass('hidden');
                            formCmt.find('.alert-success').html('').html(json.message);
                            formCmt.find('.cmt-name').val('');
                            formCmt.find('.cmt-content').val('');
                            setTimeout(function(){ window.location.href = window.location.href; }, 1200);

                        }
                    }
                });
            }, 300);

            return false;
        });
    });
</script>
<style>
    .rating{
        font-size: 25px;
    }
    .rsStar {
        display: inline-block;
        margin-left: 10px;
        position: relative;
        background: #52b858;
        color: #fff;
        padding: 2px 8px;
        box-sizing: border-box;
        font-size: 12px;
        border-radius: 2px;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }
    .rsStar:after {
        right: 100%;
        top: 50%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
        border-color: rgba(82,184,88,0);
        border-right-color: #52b858;
        border-width: 6px;
        margin-top: -6px;
    }
    .ips{
        position: relative;
        width: 100%;
        float: left;
        margin-bottom: 6px;
    }
</style>
<?php /*?>
<style>
    .rating-box .rating .star::before {
        width: auto;
        height: auto;
    }
    .boxRatingCmt .ratingLst li .rc {
        margin: 0px;
    }
    .boxRatingCmt .ratingLst li .rc p span {
        margin-right: 0px;
    }
    .boxRatingCmt .ratingLst li .rc i {
        margin-top: -3px;
        font-style: normal;
        line-height: 1.5;
    }
    .boxRatingCmt .ratingLst li .ra a {
        color: #288ad6;
    }
    .boxRatingCmt .ratingLst li.child {
        margin-left: 18px;
        border-left: 4px solid #efefef;
        padding-left: 10px;
    }
    .boxRatingCmt .ratingLst li {
        position: relative;
        margin: 5px 25px 15px 0;
    }
    .boxRatingCmt .ratingLst li .rh span {
        font-weight: bold;
        display: inline-block;
        text-transform: capitalize;
    }
    .boxRatingCmt p{
        margin: 0px;
    }
    .ips{
        width: 100%;
        float: left;
    }
    .boxRatingCmt form .lStar {
        cursor: pointer;
        margin-left: 5px;
        display: block;
        float: left;
    }

    .boxRatingCmt form textarea {
        font-size: 14px;
        color: #999;
        padding: 5px;
        margin: 5px 0;
        width: 100%;
        height: 95px;
        resize: none;
        box-sizing: border-box;
    }
    .boxRatingCmt form input {
        border: 1px solid #ddd;
        border-radius: 4px;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        font-size: 14px;
        padding: 5px;
        margin: 5px 0;
        height: 43px;
        display: inline-block;
        float: left;
        margin-right: 10px;
        color: #333;
        width: 100%;
    }
    .boxRatingCmt form button {
        background: #288ad6;
        border: 1px solid #288ad6;
        border-radius: 4px;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        font-size: 14px;
        color: #fff;
        padding: 9px 0;
        margin: 5px 0;
        box-sizing: border-box;
        display: inline-block;
        text-align: center;
        width: 100%;
    }
</style>
 <?php */?>

