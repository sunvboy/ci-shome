<script>
    $("body").removeAttr('class');
    $("body").attr('class', "customer-account-login page-layout-1column add-padding-header iMenu loading-active-12 loading-actived");


</script>
<main id="maincontent" class="page-main">


    <div class="page-title-wrapper">
        <h1 class="page-title"><span class="base" data-ui-id="page-title-wrapper">Khách hàng đăng nhập</span></h1>
    </div>

    <div class="columns">
        <div class="column main">
            <div class="login-container">
                <div class="block block-customer-social-login">
                    <div class="block-title">
                        <strong id="block-customer-login-heading" role="heading" aria-level="2">Đăng Nhập</strong>
                        <div class="field note">Sử dụng tài khoản Facebook hoặc Google</div>
                    </div>
                    <div class="block-content" aria-labelledby="block-customer-social-login-heading">
                        <div class="actions-toolbar social-btn">
                            <?php $google_login_url = $this->google->get_login_url(); ?>
                            <?php $facebook_login_url = $this->facebook->get_loginfb_url(); ?>
                            <a class="btn btn-block btn-social btn-facebook" href="<?php echo $facebook_login_url?>"><span class="fa fa-facebook"></span> Facebook </a>
                            <a class="btn btn-block btn-social btn-google" href="<?php echo $google_login_url?>"><span class="fa fa-google"></span> Google </a>
                        </div>
                    </div>
                </div>
                <div class="block block-customer-login">
                    <div class="block-title">
                        <strong id="block-customer-login-heading" role="heading" aria-level="2">Khách hàng đã đăng ký</strong>
                        <div class="field note">Vui lòng đăng nhập nếu bạn đã có tài khoản</div>
                    </div>
                    <div class="block-content" aria-labelledby="block-customer-login-heading">
                        <form class="form form-login" action="" method="post" id="login-form">
                            <fieldset class="fieldset login">
                                <?php
                                if(null !== show_flashdata()){
                                    $flash = show_flashdata();
                                }
                                ?>
                                <?php if(isset($flash) && is_array($flash) && count($flash) && $flash['message'] != ''){ ?>
                                    <div class="alert alert-success"><?php echo $flash['message']?></div>
                                <?php }?>


                                <?php
                                $error = validation_errors();
                                echo (!empty($error) && isset($error)) ? '<div class="alert alert-danger">'.$error.'</div>' : '';
                                ?>
                                <div class="field email required">
                                    <label class="label" for="email"><span>Email</span></label>
                                    <div class="control">

                                        <?php echo form_input('email', set_value('email'), 'class="input-text" placeholder="Email(Tài khoản đăng nhập)" autocomplete="off"');?>

                                    </div>
                                </div>
                                <div class="field password required">
                                    <label for="pass" class="label"><span>Mật khẩu</span></label>
                                    <div class="control">

                                        <?php echo form_password('password', set_value('password'), 'class="input-text" placeholder="Mật khẩu" autocomplete="off"');?>

                                    </div>
                                </div>
                                <div class="actions-toolbar">
                                    <div class="primary">
                                        <input type="submit" name="login" class="action login primary" value="Đăng nhập" style="font-size: 14px">

                                    </div>
                                    <div class="secondary"><a class="action remind"  href="forgot-password.html"><span>Bạn quên mật khẩu?</span></a>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="block block-new-customer">
                    <div class="block-title">
                        <strong id="block-new-customer-heading" role="heading" aria-level="2">Khách hàng mới</strong>
                    </div>
                    <div class="block-content" aria-labelledby="block-new-customer-heading">
                        <p>Tạo tài khoản có nhiều lợi ích: kiểm tra nhanh hơn, giữ nhiều hơn một địa chỉ, theo dõi các
                            đơn đặt hàng và nhiều hơn nữa.</p>
                        <div class="actions-toolbar">
                            <div class="primary">
                                <a href="register.html" class="action create primary"><span>Tạo tài khoản</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
