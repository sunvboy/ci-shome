<div id="reviews" class="customer-review">



    <div>
         <div class="col-md-6">

        <div id="add-review" class="add-customer-review">

            <div class="content-block">

                <form action="" method="post" id="review-form" class="review-form" novalidate>



                    <div class="mark-star">

                        <div class="product-infor-bottom"><img src="<?php echo $productDetail['image'] ?>"

                                                               alt="<?php echo $productDetail['title'] ?>"

                                                               style="width: 120px;height: 120px">

                            <h3 class="title"><?php echo $productDetail['title'] ?></h3>

                        </div>

                        <fieldset class="field required review-field-ratings">

                            <div class="control">

                                <div id="product-review-table" class="nested">

                                    <div class="field choice review-field-rating">

                                        <div class="number-rating font-bold-stag">0/5

                                        </div>

                                        <div class="control review-control-vote"><input

                                                    type="radio" name="starRating"

                                                    id="Đánh_giá_tổng_thể_1" value="1"

                                                    class="radio"> <label

                                                    for="Đánh_giá_tổng_thể_1"

                                                    title="1 star"

                                                    id="Đánh_giá_tổng_thể_1_label"

                                                    class="rating-1"><span>1 star</span></label>

                                            <input type="radio" name="starRating"

                                                   id="Đánh_giá_tổng_thể_2" value="2"

                                                   class="radio"> <label

                                                    for="Đánh_giá_tổng_thể_2"

                                                    title="2 stars"

                                                    id="Đánh_giá_tổng_thể_2_label"

                                                    class="rating-2"><span>2 stars</span></label>

                                            <input type="radio" name="starRating"

                                                   id="Đánh_giá_tổng_thể_3" value="3"

                                                   class="radio"> <label

                                                    for="Đánh_giá_tổng_thể_3"

                                                    title="3 stars"

                                                    id="Đánh_giá_tổng_thể_3_label"

                                                    class="rating-3"><span>3 stars</span></label>

                                            <input type="radio" name="starRating"

                                                   id="Đánh_giá_tổng_thể_4" value="4"

                                                   class="radio"> <label

                                                    for="Đánh_giá_tổng_thể_4"

                                                    title="4 stars"

                                                    id="Đánh_giá_tổng_thể_4_label"

                                                    class="rating-4"><span>4 stars</span></label>

                                            <input type="radio" name="starRating"

                                                   id="Đánh_giá_tổng_thể_5" value="5"

                                                   class="radio"> <label

                                                    for="Đánh_giá_tổng_thể_5"

                                                    title="5 stars"

                                                    id="Đánh_giá_tổng_thể_5_label"

                                                    class="rating-5"><span>5 stars</span></label>

                                            <span class="error-validate"></span></div>

                                        <div class="review-text font-bold-stag">Đánh

                                            giá

                                        </div>

                                    </div>

                                </div>

                                <input type="hidden" name="validate_rating" value="" class="validate-rating"></div>

                        </fieldset>

                    </div>

                    <div class="add-review">

                        <fieldset class="fieldset review-fieldset">

                        <span id="input-message-box">

                              <div class="error hidden">

                                    <div class="alert alert-danger"></div>

                                </div>

                                <div class="success hidden">

                                    <div class="alert alert-success"></div>

                                </div>

                        </span>

                            <div class="first-row">

                                <div class="field review-field-nickname">

                                    <div class="control">

                                        <?php echo form_input('comment_name', htmlspecialchars_decode(html_entity_decode(set_value('comment_name', isset($this->FT_auth['id']) ? $this->FT_auth['fullname'] : ''))), 'placeholder="Họ tên" class="input-text review-input" autocomplete="off"'); ?>

                                    </div>

                                </div>



                            </div>

                            <div class="field review-field-text">

                                <div class="control">

                                    <?php echo form_textarea('comment_note', htmlspecialchars_decode(html_entity_decode(set_value('comment_note'))), 'placeholder="Nội dung bình luận" class="info-form-comment uk-width-1-1" autocomplete="off"'); ?>



                                </div>

                            </div>

                        </fieldset>

                        <button type="submit" id="devvn_cmt_submit"

                                class="action submit review-form-actions js_comment_submit"

                                data-module="<?php echo $module; ?>"

                                data-detailid="<?php echo $productDetail['id']; ?>">

                            <span>Gửi nhận xét</span></button>



                    </div>

                </form>

            </div>

        </div>

    </div>



    <?php  if(svl_ismobile() != 'is mobile'){?>

    <div class="col-md-6">

        <div class="box-thong-tin-thanh-toan">



            <div class="content-thong-tin-thanh-toan">

                <div class="row lec">

                    <div class="left-thong-tin-thanh-toan col-md-6"><img src="<?php echo $productDetail['image']; ?>"

                                                                         style="padding: 15px;object-fit: contain">

                    </div>

                    <div class="col-md-6">

                        <div class="title-thong-tin-tt"

                             style="color: #d89b0f;"><?php echo $this->fcSystem['title_title_7'] ?>

                        </div>

                        <div class="text-thong-tin-tt"><?php echo $this->fcSystem['title_title_8'] ?></div>

                        <form method="post" id="advisory_form" name="post" action="product-contact.html">

                            <div class="error"></div>

                            <div class="item-thong-tin-tt"><input type="text" class="fullname" name="fullname" id="name"

                                                                  placeholder="Họ &amp; tên" required=""></div>

                            <div class="item-thong-tin-tt"><input type="text" class="phone" name="phone" id="phone"

                                                                  placeholder="Số điện thoại" required=""></div>

                            <div class="item-thong-tin-tt"><textarea name="message" class="message" id="content"

                                                                     placeholder="Thông tin cần tư vấn"

                                                                     required=""></textarea>

                            </div>

                            <button class="btn-thong-tin-tt" type="submit" style="border: 0px">nhận quà ngay!</button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <?php }?>

    </div>
   




    <div style="clear: both"></div>



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

        if ($arrayRate5 > 0) {

            $arrayRate5PT = round(($arrayRate5 / $totalComment) * 100);

        }

        $arrayRate4 = $comment_view['statisticalRating']['arrayRate'][4];

        if ($arrayRate4 > 0) {

            $arrayRate4PT = round(($arrayRate4 / $totalComment) * 100);

        }

        $arrayRate3 = $comment_view['statisticalRating']['arrayRate'][3];

        if ($arrayRate3 > 0) {

            $arrayRate3PT = round(($arrayRate3 / $totalComment) * 100);

        }

        $arrayRate2 = $comment_view['statisticalRating']['arrayRate'][2];

        if ($arrayRate2 > 0) {

            $arrayRate2PT = round(($arrayRate2 / $totalComment) * 100);

        }

        $arrayRate1 = $comment_view['statisticalRating']['arrayRate'][1];

        if ($arrayRate1 > 0) {

            $arrayRate1PT = round(($arrayRate1 / $totalComment) * 100);

        }

    }

    ?>

    <div class="product-review-bottom" id="product-review-bottom">

        <div class="head-block">

            <div class="title-block">

                <span>Phản Hồi Khách hàng (<span><?php echo $totalComment ?></span>)</span> <!----></div>

        </div>



        <div class="content-block">

            <div class="review-wrapper commentlist">

            </div>

        </div>

    </div>



    <?php  if(svl_ismobile() == 'is mobile'){?>

        <div class="clearfix"></div>

        <div class="col-md-6">

            <div class="box-thong-tin-thanh-toan">



                <div class="content-thong-tin-thanh-toan">

                    <div class="row lec">

                        <div class="left-thong-tin-thanh-toan col-md-6"><img src="<?php echo $productDetail['image']; ?>"

                                                                             style="padding: 15px;object-fit: contain">

                        </div>

                        <div class="col-md-6">

                            <div class="title-thong-tin-tt"

                                 style="color: #d89b0f;"><?php echo $this->fcSystem['title_title_7'] ?>

                            </div>

                            <div class="text-thong-tin-tt"><?php echo $this->fcSystem['title_title_8'] ?></div>

                            <form method="post" id="advisory_form" name="post" action="product-contact.html">

                                <div class="error"></div>

                                <div class="item-thong-tin-tt"><input type="text" class="fullname" name="fullname" id="name"

                                                                      placeholder="Họ &amp; tên" required=""></div>

                                <div class="item-thong-tin-tt"><input type="text" class="phone" name="phone" id="phone"

                                                                      placeholder="Số điện thoại" required=""></div>

                                <div class="item-thong-tin-tt"><textarea name="message" class="message" id="content"

                                                                         placeholder="Thông tin cần tư vấn"

                                                                         required=""></textarea>

                                </div>

                                <button class="btn-thong-tin-tt" type="submit" style="border: 0px">nhận quà ngay!</button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>



    <?php }?>

</div>

<script>

    var module = '<?php echo $module ?>';

    var moduleid = '<?php echo $productDetail['id']?>';

    listComment(module, moduleid, $('.js_list_comment').attr('data-page'));



    function listComment(module, moduleid, page) {

        var uri = 'listComment.html';

        $.post(uri, {module: module, moduleid: moduleid, page: page},

            function (data) {

                var json = JSON.parse(data);

                $('.commentlist').html(json.listComment);

                $('.woocommerce-pagination').html(json.paginationList);

                if(json.total == 0){



                    $('#product-review-bottom').css('display','none')

                }else{

                    $('#product-review-bottom').css('display','block')



                }

            });

    }



    $(document).on('click', '.ajax-pagination  a', function () {

        var page = $(this).attr('data-ci-pagination-page');

        listComment(module, moduleid, page);

        return false;

    });

    $(document).ready(function () {

        var time;

        $(document).on('click', 'input[name="starRating"]', function () {

            $('input[name="validate_rating"]').val($(this).val());

        });

        $(document).on('click', '.js_comment_submit', function () {

            //lấy thông tin comment: tên, nội dung

            let _this = $(this);

            let formCmt = $('#review-form');

            let cmtName = formCmt.find('input[name="comment_name"]').val();

            let cmtContent = formCmt.find('textarea[name="comment_note"]').val();

            let dataRate = formCmt.find('input[name="validate_rating"]').val();

            let loader = formCmt.find('.bg-loader');

            let param = {

                'fullname': cmtName,

                'comment': cmtContent,

                'rate': dataRate,

                'module': _this.attr('data-module'),

                'detailid': _this.attr('data-detailid'),

            };

            loader.show();

            clearTimeout(time);

            time = setTimeout(function () {

                let ajaxUrl = "sentcomment.html";

                $.ajax({

                    method: "POST",

                    url: ajaxUrl,

                    data: {param: param, cmtName: cmtName, cmtContent: cmtContent},

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

                            setTimeout(function () {

                                window.location.href = window.location.href;

                            }, 5000);



                        }

                    }

                });

            }, 300);



            return false;

        });

    });





</script>

<style>

    .alert {

        padding: 15px;

        margin-bottom: 20px;

        border: 1px solid transparent;

        border-radius: 4px;

    }



    .alert-danger {

        color: #a94442;

        background-color: #f2dede;

        border-color: #ebccd1;

    }



    .alert-success {

        color: #3c763d;

        background-color: #dff0d8;

        border-color: #d6e9c6;

    }

</style>