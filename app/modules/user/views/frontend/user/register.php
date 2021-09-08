<script>
    $("body").removeAttr('class');
    $("body").attr('class', "customer-account-create page-layout-1column add-padding-header iMenu loading-active-12 loading-actived");


</script>
<main id="maincontent" class="page-main">


    <div class="page-title-wrapper">
        <h1 class="page-title"><span class="base" data-ui-id="page-title-wrapper">Tạo mới tài khoản khách hàng</span></h1>
    </div>
    <div class="page messages">
        <div data-placeholder="messages"></div>
    </div>
    <div class="columns">
        <div class="column main">
            <div class="block block-customer-social-login">
                <div class="block-title">
                    <strong id="block-customer-login-heading" role="heading" aria-level="2">Đăng Nhập</strong>
                    <div class="field note">Sử dụng tài khoản Facebook hoặc Google</div>
                </div>
                <div class="block-content block-customer-create" aria-labelledby="block-customer-social-login-heading">
                    <div class="actions-toolbar social-btn">
                        <?php $google_login_url = $this->google->get_login_url(); ?>
                        <?php $facebook_login_url = $this->facebook->get_loginfb_url(); ?>
                        <a class="btn btn-block btn-social btn-facebook">
                            <span class="fa fa-facebook" href="<?php echo $facebook_login_url?>"></span> Facebook </a>
                        <a class="btn btn-block btn-social btn-google" href="<?php echo $google_login_url?>">
                            <span class="fa fa-google"></span> Google </a>
                    </div>
                </div>
            </div>
            <div id="register-form-now">
                <div class="block block-register-account">
                    <div class="block-title">
                        <strong id="block-customer-login-heading">
                            HOẶC TẠO TÀI KHOẢN </strong>
                        <div class="field note">
                            Vui lòng điền thông tin phía dưới
                        </div>
                    </div>
                    <form class="form create account form-create-account" action="" method="post" id="contact_form" enctype="multipart/form-data" autocomplete="off" novalidate="novalidate">
                        <input name="form_key" type="hidden" value="EemhjVvt9rj3W6zE">
                        <div class="block-content-register">
                            <fieldset class="fieldset create info">
                                <?php
                                $error = validation_errors();
                                echo (!empty($error) && isset($error)) ? '<div class="alert alert-danger">'.$error.'</div>' : '';
                                ?>
                                <legend class="legend"><span>Thông tin cá nhân</span></legend>
                                <br>
                                <div class="field field-name-lastname required">
                                    <label class="label" for="lastname">
                                        <span>Họ và tên</span>
                                    </label>
                                    <div class="control">

                                        <?php echo form_input('fullname', set_value('fullname'), 'class="input-text required-entry" placeholder="Họ và tên*" autocomplete="off" required');?>

                                    </div>
                                </div>
                                <div class="field field-name-firstname required">
                                    <label class="label" for="firstname">
                                        <span>Số điện thoại</span>
                                    </label>
                                    <div class="control">
                                        <?php echo form_input('phone', set_value('phone'), 'class="input-text required-entry" placeholder="Số điện thoại*" autocomplete="off" required');?>


                                    </div>
                                </div>
                                <div class="field required">
                                    <label for="email_address" class="label"><span>Địa chỉ</span></label>
                                    <div class="control">
                                        <?php echo form_input('address', set_value('address'), 'class="input-text" placeholder="Địa chỉ*" autocomplete="off" required');?>


                                    </div>
                                </div>

                            </fieldset>
                            <fieldset class="fieldset create account"
                                      data-hasrequired="* Vui lòng điền thông tin bắt buộc">
                                <legend class="legend"><span>Thông tin đăng nhập</span></legend>
                                <br>
                                <div class="field field-name-lastname required">
                                    <label class="label" for="lastname">
                                        <span>Email</span>
                                    </label>
                                    <div class="control">
                                        <?php echo form_input('email', set_value('email'), 'class="input-text required-entry" placeholder="Email(Tài khoản đăng nhập)*" autocomplete="off" required');?>


                                    </div>
                                </div>
                                <div class="field field-name-lastname required">
                                    <label class="label" for="lastname">
                                        <span>Mật khẩu</span>
                                    </label>
                                    <div class="control">
                                        <?php echo form_password('password', set_value('password'), 'class="input-text required-entry" placeholder="Mật khẩu*" autocomplete="off" required');?>

                                    </div>
                                </div>

                            </fieldset>
                        </div>
                        <div class="actions-toolbar">
                            <div class="primary">
                                <button type="submit" id="submitform" class="action submit primary" title="Tạo tài khoản" name="register" value="register"><span>Tạo tài khoản</span>
                                </button>
                                <button type="button" id="gif" class="action submit primary"><span>Dữ liệu đang được xử lý...</span>
                                </button>
                            </div>
                            <div class="secondary">
                                <a class="action back" href="login" style="display: block"><span>Đăng nhập</span></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

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