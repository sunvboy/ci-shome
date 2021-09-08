<script>
    $("body").removeAttr('class');
    $("body").attr('class', "contact-index-index page-layout-1column loading-active-12 loading-actived");


</script>
<main id="maincontent" class="page-main" style="margin-top: 20px">

    <div class="columns">
        <div class="column main">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="page-title"><span class="base">Liên hệ với chúng tôi</span></h1>

                    <div>
                        <h3><?php echo $this->fcSystem['homepage_company']; ?></h3>
                        <?php echo $this->fcSystem['contact_contact']; ?>


                    </div>
                    <br>
                    <br>
                    <form action="contact/frontend/contact/ajaxSendcontact.html" method="post" id="formAdmission">

                        <fieldset class="fieldset">
                            <legend class="legend"><span>Viết cho chúng tôi</span></legend>
                            <br>
                            <div class="field note no-label">Gửi lời nhắn cho chúng tôi. Chúng tôi sẽ trả lời bạn nhanh nhất có thể.
                            </div>
                            <div class="error" ></div>

                            <div class="field name required">
                                <div class="control">
                                    <input type="text" placeholder="Họ và tên" name="fullname" class="input-text fullname">
                                </div>
                            </div>
                            <div class="field email required">
                                <div class="control">
                                    <input type="text" placeholder="Email" name="email" class="email input-text">

                                </div>
                            </div>
                            <div class="field telephone">
                                <div class="control">
                                    <input type="text" placeholder="Số điện thoại" name="phone" class="phone input-text">

                                </div>
                            </div>
                            <div class="field telephone">
                                <div class="control">

                                    <input type="text" placeholder="Địa chỉ" name="address" class="address input-text">

                                </div>
                            </div>
                            <div class="field comment required">
                                <div class="control">
                                    <textarea name="message" placeholder="Nội dung" class="message input-text" cols="5" rows="3"></textarea>

                                </div>
                            </div>
                        </fieldset>
                        <div class="actions-toolbar">
                            <div class="primary">
                                <button type="submit" title="Gửi" class="action submit primary">
                                    <span>Gửi</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-12">
                    <?php echo $this->fcSystem['contact_map']; ?>


                </div>
            </div>
        </div>
    </div>
</main>
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
<style>
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }
    .alert-success {
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
    }
    .alert-danger {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
    }
</style>