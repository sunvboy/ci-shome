<div id="main" class="wrapper main-car-detail main-cars-list" style="margin-top: 20px;">

    <div id="main-contact">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="content-contact" style="color: #fff;">
                        <p class="thank-you"><?php echo $this->lang->line('Thankyoufor')?></p>
                        <h1 class="title-contact"><?php echo $this->fcSystem['homepage_company']; ?></h1>
                        <ul class="adress-contact" style="l">
                            <li><span>Địa chỉ: </span><?php echo $this->fcSystem['contact_address']; ?></li>
                            <li><span>Số điện thoại: </span><?php echo $this->fcSystem['contact_hotline']; ?></li>
                            <li><span>Email:</span><?php echo $this->fcSystem['contact_email']; ?></li>
                        </ul>
                    </div>
                    <div class="map-contact">
                        <?php echo $this->load->view('contact/frontend/contact/maps'); ?>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="form-contat">
                        <p class="desc" style="    color: #fff;"><?php echo $this->lang->line('Pleasefillup')?><br>
                            <?php echo $this->lang->line('Thanksyou')?>
                        </p>
                        <form action="contact/frontend/contact/ajaxSendcontact.html" method="post" id="formAdmission">
                            <div class="error" ></div>
                            <input type="text" placeholder="Họ và tên" name="fullname" class="fullname form-control">
                            <input type="text" placeholder="Email" name="email" class="email form-control">
                            <input type="text" placeholder="Số điện thoại" name="phone" class="phone form-control">
                            <input type="text" placeholder="Địa chỉ" name="address" class="address form-control">
                            <textarea name="message" cols="40" rows="10" placeholder="Nội dung" class="message form-control"></textarea>
                            <div class="send-contact">

                                <div class="item">
                                    <input type="submit" value="<?php echo $this->lang->line('Send')?>" class="btn btn-danger">
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
<style>
    .adress-contact{
        list-style: none;padding: 0px;margin: 0px
    }
    .title-contact{
        font-size: 20px;
        font-weight: bold;
        line-height: 25px;
    }
    .map-contact{
        margin-top: 20px;
    }
    #formAdmission input,#formAdmission textarea{
        margin-bottom: 10px;
    }
    @media (max-width: 767px) {
        .form-contat{
            margin-top: 20px;
        }

    }
</style>
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