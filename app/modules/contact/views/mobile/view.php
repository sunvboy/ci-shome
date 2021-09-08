<div id="main" class="wrapper main-new main-new-detail">

    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="<?php echo base_url()?>">Trang chủ  /</a></li>
                <li><a href="lien-he.html">Liên hệ</a></li>
            </ul>
        </div>
    </div>
    <div id="main-contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="map-contact">
                        <?php echo $this->fcSystem['contact_map']?>

                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="content-contact">
                        <h1 class="title-contact"><?php echo $this->fcSystem['homepage_company']?></h1>
                        <ul class="adress-contact">
                            <li><span>Địa chỉ: </span><?php echo $this->fcSystem['contact_address']?></li>
                            <li><span>Hotline: </span><?php echo $this->fcSystem['contact_hotline']?></li>
                            <li><span>Email:</span><?php echo $this->fcSystem['contact_email']?></li>
                            <li><span>Website: </span><?php echo $this->fcSystem['contact_website']?></li>
                        </ul>
                    </div>
                    <div class="form-contat">
                        <p class="desc">Please fill up the form and send to us. Our consultants will respond to you as soon as possible.<br>
                            Thanks you!
                        </p>
                        <form action="contact/frontend/contact/ajaxSendcontact.html" method="post" id="formAdmission">
                            <div class="row">
                                <div class="col-md-12"><div class="error"></div></div>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" placeholder="Họ tên" name="fullname" class="fullname">
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" placeholder="Điện thoại" class="phone" name="phone">
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" placeholder="Địa chỉ" class="address" name="address">
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" placeholder="Email" class="email" name="email">
                                </div>
                            </div>

                            <textarea name="message" cols="40" rows="10" class="message" placeholder="Nội dung"></textarea>
                            <div class="send-contact">

                                <div class="item">
                                    <input type="submit" value="Gửi đi">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </div>




</div>
<script>

    $(document).ready(function () {

        $('#formAdmission .error').hide();
        var uri = $('#formAdmission').attr('action');
        $('#formAdmission').on('submit', function () {
            var postData = $(this).serializeArray();
            $.post(uri, {
                post: postData,
                fullname: $('#formAdmission .fullname').val(),
                phone: $('#formAdmission .phone').val(),
                email: $('#formAdmission .email').val(),
                address: $('#formAdmission .address').val(),
                message: $('#formAdmission .message').val(),
            }, function (data) {
                var json = JSON.parse(data);
                $('#formAdmission .error').show();
                if (json.error.length) {
                    $('#formAdmission .error').removeClass('alert alert-success').addClass('alert alert-danger');
                    $('#formAdmission .error').html('').html(json.error);
                } else {
                    $('#formAdmission .error').removeClass('alert alert-danger').addClass('alert alert-success');

                    $('#formAdmission .error').html('').html(json.message);

                    $('#formAdmission').trigger("reset");

                    setTimeout(function () {

                        location.reload();

                    },3000);

                }

            });

            return false;

        });

    });

</script>