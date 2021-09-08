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
<div id="reviews">
    <div class="comment_product" id="comments">
        <h5 class="uppercase mt">Đánh giá (<?php echo $totalComment?>)</h5>

        <h2 class="woocommerce-Reviews-title"> <?php echo $totalComment?> đánh giá cho <span><?php echo $productDetail['title']; ?></span></h2>

        <div class="star_box">
            <div class="col-md-9 col-xs-12 col-sm-9">
                <div style="display: flex;align-items: center;">
                    <span class="star_average"><?php echo $averagePoint?></span>
                    <p class="start" style="margin: 0px">

                        <span class="rating lStar" disabled data-stars="5"  data-default-rating="<?php echo $averagePoint?>" data-rating="<?php echo $averagePoint?>"></span>

                    </p>
                    <a href="#reviews" class="woocommerce-review-link hidden-xs" rel="nofollow"><span class="count"><?php echo $totalComment?></span> đánh giá của khách hàng</a>
                </div>

                <div class="reviews_bar">
                    <div class="devvn_review_row">
                        <span class="devvn_stars_value">5<i class="devvn-star"></i></span>
                        <span class="devvn_rating_bar">
                            <span style="background-color: #eee" class="devvn_scala_rating">
                                <span class="devvn_perc_rating" style="width: <?php echo $arrayRate5PT?>%; background-color: #f5a623"></span>
                            </span>
                        </span>
                        <span class="devvn_num_reviews"><b> <?php echo $arrayRate5PT?>%</b> | <?php echo $arrayRate5?> đánh giá</span>
                    </div>
                    <div class="devvn_review_row">
                        <span class="devvn_stars_value">4<i class="devvn-star"></i></span>
                        <span class="devvn_rating_bar">
                            <span style="background-color: #eee" class="devvn_scala_rating">
                                <span class="devvn_perc_rating" style="width: <?php echo $arrayRate4PT?>%; background-color: #f5a623"></span>
                            </span>
                        </span>
                        <span class="devvn_num_reviews"><b><?php echo $arrayRate4PT?>%</b> | <?php echo $arrayRate4?> đánh giá</span>
                    </div>
                    <div class="devvn_review_row">
                        <span class="devvn_stars_value">3<i class="devvn-star"></i></span>
                        <span class="devvn_rating_bar">
                            <span style="background-color: #eee" class="devvn_scala_rating">
                                <span class="devvn_perc_rating" style="width: <?php echo $arrayRate3PT?>%; background-color: #f5a623"></span>
                            </span>
                        </span>
                        <span class="devvn_num_reviews"><b><?php echo $arrayRate3PT?>%</b> | <?php echo $arrayRate3?> đánh giá</span>
                    </div>
                    <div class="devvn_review_row">
                        <span class="devvn_stars_value">2<i class="devvn-star"></i></span>
                        <span class="devvn_rating_bar">
                            <span style="background-color: #eee" class="devvn_scala_rating">
                                <span class="devvn_perc_rating" style="width: <?php echo $arrayRate2PT?>%; background-color: #f5a623"></span>
                            </span>
                        </span>
                        <span class="devvn_num_reviews"><b><?php echo $arrayRate2PT?>%</b> | <?php echo $arrayRate2?> đánh giá</span>
                    </div>
                    <div class="devvn_review_row">
                        <span class="devvn_stars_value">1<i class="devvn-star"></i></span>
                        <span class="devvn_rating_bar">
                            <span style="background-color: #eee" class="devvn_scala_rating">
                                <span class="devvn_perc_rating" style="width: <?php echo $arrayRate1PT?>%; background-color: #f5a623"></span>
                            </span>
                        </span>
                        <span class="devvn_num_reviews"><b><?php echo $arrayRate1PT?>%</b> | <?php echo $arrayRate1?> đánh giá</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-3">
                <a href="javascript:void(0)" title="Đánh giá ngay" class="btn-reviews-now">Đánh giá ngay</a>
            </div>

        </div>
        <div style="clear: both"></div>
        <ol class="commentlist js_list_comment">

        </ol>
        <div class="js_list_pagination"></div>

        <div style="clear: both"></div>

        <div class="devvn_prod_cmt">
            <div class="devvn_cmt_form">
                <form action="" method="post" id="form-front-comment" novalidate="novalidate">
                    <div class="form-group">
                        <div class="error hidden">
                            <div class="alert alert-danger"></div>
                        </div>
                        <div class="success hidden">
                            <div class="alert alert-success"></div>
                        </div>
                    </div>
                    <div class="devvn_cmt_input">
                        <?php echo form_textarea('comment_note', htmlspecialchars_decode(html_entity_decode(set_value('comment_note'))), 'placeholder="Nội dung bình luận" class="info-form-comment uk-width-1-1" autocomplete="off"'); ?>
                    </div>
                    <div class="devvn_cmt_form_bottom ">
                        <div class="ips">
                            <input type="hidden" class="data-rate" name="data-rate"  value="<?php echo ($this->input->post('data-rate')) ? (int)$this->input->post('data-rate') : 5; ?>">
                            <span id="myRating" class="rating lStar" data-stars="5"  data-default-rating="<?php echo ($this->input->post('data-rate')) ? (int)$this->input->post('data-rate') : 5; ?>" data-rating="<?php echo ($this->input->post('data-rate')) ? (int)$this->input->post('data-rate') : 5; ?>"></span>
                            <div class="title-rating rsStar"><?php echo ($this->input->post('data-rate')) ? review_render((int)$this->input->post('data-rate')) : 'Rất tốt'; ?></div>
                            <div class="clr"></div>
                        </div>
                        <div class="devvn_cmt_radio">
                            <label>
                                <input name="devvn_cmt_gender" type="radio" value="male" checked="">
                                <span>Anh</span>
                            </label>
                            <label>
                                <input name="devvn_cmt_gender" type="radio" value="female">
                                <span>Chị</span>
                            </label>
                        </div>
                        <div class="devvn_cmt_input">
                            <?php echo form_input('comment_name', htmlspecialchars_decode(html_entity_decode(set_value('comment_name',isset($this->FT_auth['id'])?$this->FT_auth['fullname']:''))), 'placeholder="Họ tên" class="input-form" autocomplete="off"'); ?>
                        </div>
                        <div class="devvn_cmt_input">
                            <?php echo form_input('comment_email', htmlspecialchars_decode(html_entity_decode(set_value('comment_email',isset($this->FT_auth['id'])?$this->FT_auth['email']:''))), 'placeholder="Email" class="input-form" autocomplete="off"'); ?>
                        </div>
                        <div class="devvn_cmt_submit">

                            <button type="submit" id="devvn_cmt_submit" class="js_comment_submit" data-module="<?php echo $module; ?>" data-detailid="<?php echo $productDetail['id']; ?>">Gửi</button>
                        </div>
                    </div>
                </form>
            </div>

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
    $(document).ready(function () {
        var time;

        $(document).on('click', '.js_comment_submit', function () {
            //lấy thông tin comment: tên, nội dung
            let _this = $(this);
            let formCmt = $('#form-front-comment');
            let cmtName = formCmt.find('input[name="comment_name"]').val();
            let cmtEmail = formCmt.find('input[name="comment_email"]').val();
            let cmtContent = formCmt.find('textarea[name="comment_note"]').val();
            let dataRate = formCmt.find('input.data-rate').val();
            let loader = formCmt.find('.bg-loader');
            let param = {
                'fullname': cmtName,
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
                    data: {param: param, cmtName: cmtName,cmtEmail: cmtEmail, cmtContent: cmtContent},
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
                            setTimeout(function(){ window.location.href = window.location.href; }, 5000);

                        }
                    }
                });
            }, 300);

            return false;
        });
    });
    rating();
    function rating(start = 0, selector = '.rating', inputForm = 'input.data-rate'){
        var input = $(inputForm);
        var ratings = $(selector);
        for (var i = start; i < ratings.length; i++) {
            var r = new SimpleStarRating(ratings[i]);
            ratings[i].addEventListener('rate', function(e) {
                var numStar = e.detail; // tĂ­nh sá»‘ sao
                input.val(numStar);
                get_title_rate(numStar);
            });
        }
    }
    $(document).on('click','.js_btn_reply', function(e){

        let _this = $(this);
        let param = {
            'id' : _this.attr('data-id'),
            'title' : _this.attr('data-title'),
            'module' : module,
            'detailid' : moduleid,
        };
        let reply = get_comment_html(param);
        console.log(reply);
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
        comment += '<div class="ct col-md-12 col-xs-12 col-sm-12 form-group">';
        comment += '<textarea name="comment_note" cols="40" rows="5"  placeholder="Nội dung bình luận" class="form-control" id="cmtreply-content" autocomplete="off"></textarea>';
        comment += '</div>';
        comment += '<div class="if col-md-12 col-xs-12 col-sm-12 form-group">';
        comment += '<div class="row">';
        comment += '<div class="col-md-4 col-xs-12 col-sm-4">';
        comment += '<input type="text" name="comment_name" value=""  placeholder="Họ tên" class="form-control " id="cmtreply-name" autocomplete="off" />';
        comment += '</div>';

        comment += '<div class="col-md-4 col-xs-12 col-sm-4">';
        comment += '<input type="text" name="comment_email" value=""  placeholder="Email" class="form-control " id="cmtreply-email" autocomplete="off" />';
        comment += '</div>';
        comment += '<div class="col-md-4 col-xs-12 col-sm-4">';
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
        let cmtEmail = $('#cmtreply-email').val();
        let cmtContent = $('#cmtreply-content').val();
        let param = {
            'parentid': parentid,
            'fullname': cmtName,
            'email': cmtEmail,
            'comment': cmtContent,
            'rate': 0,
            'module': module,
            'detailid': moduleid,
        };
        let uri = "comment/frontend/comment/sent_comment";
        $.post(uri, {param: param, cmtName: cmtName, cmtEmail: cmtEmail,  cmtContent: cmtContent},
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
</script>
<style>

    #review-title{
    font-size: 20px;
    font-weight: bold;
    color: #ed8d38;}
    .pagination ul{
        list-style: none;
        border-bottom: 0px !important;
    }
    .pagination ul a{
        font-size: 20px !important;

    }
    .pagination {
        display: inline-block;
    }

    .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
    }

    .pagination a.active {
        background-color: #555555;
        color: white;
        border-radius: 5px;
    }

    .pagination a:hover:not(.active) {
        background-color: #ddd;
        border-radius: 5px;
    }
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
        width: 220px;
        float: left;
        margin-bottom: 6px;
    }
</style>
<style>
    .rating{
        font-size: 25px;
    }
    .devvn_prod_cmt {
        max-width: 100%;
        width: 100%;
    }
    .devvn_cmt_form {
        margin: 0 0 20px;
    }
    .devvn_cmt_input textarea {
        height: 100px;
        border-radius: 3px 3px 0 0;
        display: block;
        margin: 0;
    }
    .devvn_cmt_input textarea, .devvn_cmt_input input {
        border: 1px solid #c1bfbf;
        width: 100%;
        padding: 5px 10px;
        border-radius: 3px;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        outline: none;
    }
    .devvn_cmt_form_bottom {
        border: 1px solid #c1bfbf;
        border-top: 0;
        padding: 10px;
        -js-display: flex;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-flow: row nowrap;
        flex-flow: row nowrap;
        -ms-flex-pack: justify;
        justify-content: space-between;
        width: 100%;
    }
    .devvn_cmt_radio {
        -ms-flex: 1;
        flex: 1;
        -ms-flex-negative: 1;
        -ms-flex-preferred-size: auto!important;
        text-align: right;
        padding-top: 7px;
        white-space: nowrap;
    }
    .devvn_cmt_form_bottom .devvn_cmt_input {
        width: 35%;
        padding: 0 5px;
    }
    button#devvn_cmt_submit, button#devvn_cmt_replysubmit {
        width: 100%;
        height: 40px;
        background: #555555;
        border: 0;
        text-transform: uppercase;
        font-weight: 700;
        outline: none;
        border-radius: 3px;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        margin: 0;
        padding: 0 10px;
        font-size: 14px;
        min-height: inherit;
        line-height: 30px;
        white-space: nowrap;
        color: #fff;
    }
    .commentlist li{
        margin-bottom: 20px;
    }
    .commentlist li:last-child .children{
        border-bottom: 0px !important;
    }
    .description p{
        margin: 0px;
    }
    ol, .children {

        list-style: none;
    }

    ol {
        padding: 0px;
        margin: 0px;
    }

    .comment-text {
        margin: 0;
        border: 0;
        border-radius: 0;
        padding: 0;
    }

    .comment-text p.meta {
        margin: 0;
    }

    strong.woocommerce-review__author {
        font-weight: 700;
        display: inline-block;
        text-transform: capitalize;
        color: #000;
        margin: 0 10px 0 0;
    }

    .commentlist li .description {
        font-style: normal;
    }

    .devvn_review_bottom .reply {
        color: #288ad6;
        display: inline-block;
        position: relative;
    }

    time.woocommerce-review__published-date {
        color: #999;
        cursor: unset;
    }

    #comments ol.commentlist ul.children li {
        border-left: 4px solid #efefef;
        padding-left: 10px;
    }

    #comments ol.commentlist li .comment-text {
        margin: 0;
        border: 0;
        border-radius: 0;
        padding: 0;
    }

    #comments ol.commentlist li .comment-text p.meta {
        margin: 0;
    }

    strong.woocommerce-review__author {
        font-weight: 700;
        display: inline-block;
        text-transform: capitalize;
        color: #000;
        margin: 0 10px 0 0;
    }

    span.review_qtv {
        background-color: #eebc49;
        color: #000;
        padding: 3px;
        border-radius: 3px;
        display: inline-block;
        font-size: 11px;
        text-transform: uppercase;
    }

    .devvn_review_mid {
        margin: 0 0 2px;
    }

    .devvn_review_bottom, .comment-reply-link {
        font-size: 14px !important;
    }

    #comments {
        font-family: 'SanFranciscoText-Regular';
        font-size: 20px;
        border-top: 1px solid #dddddd;
        padding-top: 10px;
    }

    #comments h2 {
    }

    h5.uppercase.mt {
        margin: 0 0 10px 0;
        text-transform: none;
        font-size: 23px;

    }

    span.star_average {
        color: #fad31f;
        font-size: 35px;
        vertical-align: middle;
        font-weight: 700;
        text-align: center;
        margin: 0 10px 0 0;
        line-height: 1;
    }

    .star_box {
        border: 1px solid #ddd;
        border-radius: 7px;
        padding: 10px;
        margin: 10px 0 20px;
        overflow: hidden;
        -js-display: flex;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-flow: row nowrap;
        flex-flow: row nowrap;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-pack: justify;
        justify-content: space-between;
        width: 100%;
    }

    .devvn_review_row {
        padding-bottom: 10px;
        position: relative;
        -js-display: flex;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-flow: row nowrap;
        flex-flow: row nowrap;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-pack: justify;
        justify-content: space-between;
        width: 100%;
    }

    span.devvn_stars_value i {
        margin: 0 3px;
    }

    span.devvn_rating_bar {
        -ms-flex: 1;
        flex: 1;
        -ms-flex-negative: 1;
        -ms-flex-preferred-size: auto !important;
        padding: 0 10px;
    }

    span.devvn_scala_rating {
        border-radius: 3px;
        display: inline-block;
        height: 15px;
        background: #eee;
        vertical-align: middle;
        overflow: hidden;
        width: 100%;
    }

    span.devvn_perc_rating {
        height: 15px;
        border-radius: 3px;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        display: inline-block;
        width: 0;
    }

    span.devvn_num_reviews {
        min-width: 150px;
        color: #03a0e2;
        font-size: 18px;
    }

    .reviews_bar {
        line-height: 0;
        margin-top: 10px;
    }

    .star_box_right {
        width: 190px;
        text-align: center;
    }

    #comments a.btn-reviews-now {
        background-color: #ed8d38;
        color: #fff;
        display: inline-block;
        padding: 10px 20px;
        border-radius: 3px;
        text-transform: uppercase;
        font-weight: 700;
        text-decoration: none;
    }
    @media (max-width: 767px) {
        .star_box{
            display: block;
        }
        .devvn_cmt_form_bottom{
            display: block;
        }
        .devvn_cmt_form_bottom .devvn_cmt_input{
            width: 100%;
            margin-bottom: 5px;
            padding: 0px;
        }
        .devvn_cmt_radio{
            display: inline-block;
        }
        .if input{
            margin-bottom: 5px;

        }

    }
</style>