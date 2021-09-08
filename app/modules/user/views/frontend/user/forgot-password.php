<script>
    $("body").removeAttr('class');
    $("body").attr('class', "customer-account-forgotpassword page-layout-1column add-padding-header iMenu loading-active-12 loading-actived");


</script>
<main id="maincontent" class="page-main">


    <div class="page-title-wrapper">
        <h1 class="page-title">
            <span class="base" data-ui-id="page-title-wrapper">Forgot Your Password</span></h1>
    </div>

    <div class="columns">
        <div class="column main"><input name="form_key" type="hidden" value="YHnlRIH4MbfVJx1c">


            <div class="forgot-title">
                <strong id="block-customer-login-heading">
                    Forgot your password </strong>
                <div class="field note">Vui lòng nhập địa chỉ email của bạn dưới đây để nhận được một liên kết đặt lại
                    mật khẩu.
                </div>
            </div>
            <form class="form password forget" action=""  method="post" id="contact_form" novalidate="novalidate">
                <fieldset class="fieldset" data-hasrequired="* Vui lòng điền thông tin bắt buộc">

                    <?php
                    $error = validation_errors();
                    echo (!empty($error) && isset($error)) ? '<div class="alert alert-danger">'.$error.'</div>' : '';
                    ?>
                    <div class="field email required">
                        <label for="email_address" class="label"><span>Email</span></label>
                        <div class="control">
                            <?php echo form_input('email', set_value('email'), 'class="input-text" placeholder="Nhập địa chỉ email của bạn" autocomplete="off" required');?>


                        </div>
                    </div>

                </fieldset>
                <div class="actions-toolbar">
                    <div class="primary">
                        <input type="submit" name="forgot" class="action submit primary" id="submitform" value="Gửi" style="font-size: 15px">
                        <input type="button" class="action submit primary" value="Dữ liệu đang được xử lý..." id="gif" style="font-size: 15px">

                    </div>

                </div>
            </form>
        </div>
    </div>
</main>
<script type="text/javascript">
    $('#gif').hide();
    $('#contact_form').submit(function() {
        $('#submitform').hide();
        $('#gif').show();
        return true;
    });
</script>
