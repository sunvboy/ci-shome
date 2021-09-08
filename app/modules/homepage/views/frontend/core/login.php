<?php if (!isset($this->FT_auth['id'])) { ?>
    <?php
    $customer = isset($_COOKIE['cookieLogin'])?$_COOKIE['cookieLogin']:NULL;
    $customer = json_decode($customer,TRUE);
    if(!empty($customer['password']) && !empty($customer['email'])){
        $customer_auth = $this->Autoload_Model->_get_where(array(
            'select' => 'email,account',
            'table' => 'customer',
            'where' => array(
                'email' => $customer['email'],
                'password' => $customer['password'],
            ),
        ));
    }
    ?>
    <section class="top-content wow fadeInUp">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-61">
                    <div class="image" style="text-align: center">
                        <div style="position: relative">
                            <img style="position: absolute;top: 100px;right: 155px; z-index: 999;width: auto" src="template/frontend/images/icon-avatar.png" alt="icon avatar">
                            <img src="template/frontend/images/before.png" alt="before" style="width: auto">
                            <img style="position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%);border-radius: 100%;width: 260px;height: 260px;object-fit: cover" src="<?php echo $this->fcSystem['banner_image2']?>" alt="avatar">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-62">
                    <div class="top-content-right">
                        <h3 class="title">- Đăng nhập -</h3>
                        <div class="nav-content-right">
                            <form role="form" id="login_form" method="post">
                                <div class="login-error alert"></div>
                                <?php echo form_input('email', set_value('email',!empty($customer_auth)?$customer_auth['email']:''), 'id="input_email" placeholder="Email(Tài khoản đăng nhập)" autocomplete="off" required');?>
                                <?php echo form_password('password', set_value('password',!empty($customer_auth)?$customer_auth['account']:''), 'id="input_password" placeholder="Mật khẩu" autocomplete="off" required');?>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p class="ghinho"><input type="checkbox" value="1" id="cookieLogin" name="cookieLogin" <?php echo !empty($customer_auth)?'checked':''?>>Ghi nhớ tài khoản</p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="link-login">
                                            <a href="register.html">Đăng ký</a> | <a href="forgot-password.html">Quên mật khẩu</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="center">
                                    <input type="submit" value="Đăng nhập" id="btn-submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } else {  ?>
    <div class="wrapper main-home-login">
        <section class="top-content wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                        <div class="image top-content-right">
                            <h3 class="title1 title1-mobile">Xin chào, bạn đã đăng nhập thành công!</h3>
                            <div style="position: relative">
                                <img style="position: absolute;top: 100px;right: 155px; z-index: 999;" src="template/frontend/images/icon-avatar.png" alt="icon avatar">
                                <img src="template/frontend/images/before.png" alt="before">
                                <img style="position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%);border-radius: 100%;width: 260px;height: 260px;" src="<?php echo !empty($this->FT_auth['images'])?$this->FT_auth['images']:'template/avatar.png' ?>" alt="<?php echo $this->FT_auth['fullname'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                        <div class="top-content-right">
                            <h3 class="title1 title1-pc">Xin chào, bạn đã đăng nhập thành công!</h3>
                            <h4 class="name-title"><?php echo $this->FT_auth['fullname'] ?></h4>
                            <p class="date">Ngày tham gia <?php echo $this->FT_auth['created'] ?></p>
                            <ul>
                                <li>
                                    <a href="information.html">Thông tin tài khoản</a>
                                </li>
                                <li><a href="change-pass.html">Đổi mật khẩu</a></li>
                                <li>
                                    <a href="history.html">Lịch sử</a>
                                </li>
                            </ul>
                            <a href="logout.html" class="login-out">Đăng xuất</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
<?php } ?>



