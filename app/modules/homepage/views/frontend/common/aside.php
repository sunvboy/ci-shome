<div class="col-md-3 col-sm-4 col-xs-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
    <div class="clearfix visible-xs" style="height: 40px"></div>
    <div class="form-aside">
        <h2 class="title-footer">Đăng ký học</h2>
        <div class="clearfix"></div>
        <form action="contact/frontend/contact/create" id="mailsubricreH">
            <div class="form-group error"></div>

            <div class="form-group">
                <input placeholder="Họ và tên" name="fullname" class="fullname form-control" required>
            </div>
            <div class="form-group">
                <input placeholder="Họ và tên" name="fullname" class="fullname form-control" required>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" style="background: #005596;border-color: #005596">ĐĂNG
                    KÝ NGAY
                </button>
            </div>
            <script>
                $(document).ready(function () {
                    $('#mailsubricreH .error').hide();
                    var uri = $('#mailsubricreH').attr('action');
                    $('#mailsubricreH').on('submit', function () {
                        var postData = $(this).serializeArray();
                        $.post(uri, {
                            post: postData,
                            fullname: $('#mailsubricreH .fullname').val(),
                            phone: $('#mailsubricreH .phone').val(),
                        }, function (data) {
                            var json = JSON.parse(data);
                            $('#mailsubricreH .error').show();
                            if (json.error.length) {
                                $('#mailsubricreH .error').removeClass('alert alert-success').addClass('alert alert-danger');
                                $('#mailsubricreH .error').html('').html(json.error);
                            } else {

                                $('#mailsubricreH .error').removeClass('alert alert-danger').addClass('alert alert-success');
                                $('#mailsubricreH .error').html('').html('Đăng ký thành công.');
                                $('#mailsubricreH').trigger("reset");
                                setTimeout(function () {
                                    location.reload();
                                }, 3000);
                            }
                        });
                        return false;
                    });
                });
            </script>
        </form>


    </div>
    <div class="clearfix" style="height: 30px"></div>

    <?php
    $tintucNews = $this->Autoload_Model->_get_where(array(
        'select' => 'id, title,canonical,description',
        'table' => 'article_catalogue',
        'where' => array('ishome' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)), true);
    if (isset($tintucNews) && is_array($tintucNews) && count($tintucNews)) {
        foreach ($tintucNews as $key => $val) {
            $tintucNews[$key]['post'] = $this->Autoload_Model->_condition(array(
                'module' => 'article',
                'select' => '`object`.`id`, `object`.`title`, `object`.`image`, `object`.`canonical`, `object`.`description`, `object`.`created`, `object`.`viewed`',
                'where' => '`object`.`publish_time` <= \'' . gmdate('Y-m-d H:i:s', time() + 7*3600) . '\' AND `object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\' ',
                'catalogueid' => $val['id'],
                'limit' => 5,
                'order_by' => '`object`.`id` desc',
            ));
        }
    }
    ?>
    <?php if (isset($tintucNews) && is_array($tintucNews) && count($tintucNews)) { ?>
        <?php foreach ($tintucNews as $key => $val) { ?>
            <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
                <div class="form-aside">
                    <h2 class="title-footer">Bài viết mới nhất</h2>
                    <div class="clearfix"></div>
                    <div class="listArticles">

                        <?php foreach ($val['post'] as $keyP => $valP) { ?>
                            <div class="item">
                                <div class="item-b-1">
                                    <a href="<?php echo $valP['canonical'] . '.html' ?>"><img class="w_100" style="height: 174px;object-fit: cover" src="<?php echo $valP['image'] ?>"  alt="<?php echo $valP['title'] ?>"></a>

                                </div>
                                <div class="item-b-2">
                                    <h3>
                                        <a style="font-size: 18px;color: #005596;line-height: 20px;" href="<?php echo $valP['canonical'] . '.html' ?>"><?php echo $valP['title'] ?></a>
                                    </h3>
                                    <p><i><?php echo $valP['created'] ?></i></p>

                                </div>
                            </div>
                            <div class="clearfix" style="height: 20px"></div>
                        <?php } ?>

                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    <?php } ?>


</div>
