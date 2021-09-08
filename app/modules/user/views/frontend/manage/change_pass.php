<script>
    $("body").removeAttr('class');
    $("body").attr('class', "account customer-account-edit page-layout-2columns-left add-padding-header iMenu loading-active-12 loading-actived");


</script>
<main id="maincontent" class="page-main">



    <div class="columns">
        <div class="column main">
            <div class="page-title-wrapper">
                <h1 class="page-title">
                    <span class="base" data-ui-id="page-title-wrapper">Đổi mật khẩu</span></h1>
            </div>


            <form class="form-address-edit" action="" method="post" id="form-validate" enctype="multipart/form-data">


                <div>
                    <fieldset class="fieldset">

                        <legend class="legend"><span>Đổi mật khẩu</span></legend>

                        <?php
                        $error = validation_errors();
                        echo (!empty($error) && isset($error)) ? '<div class="alert alert-danger">'.$error.'</div>' : '';
                        ?>

                        <div class="field telephone required">
                            <label for="telephone" class="label"><span>Mật khẩu cũ</span>
                            </label>
                            <div class="control">
                                <?php echo form_password('password', set_value('password'), 'placeholder="Mật khẩu cũ" class="input-text required-entry  " placeholder="" autocomplete="off"');?>
                            </div>
                        </div>

                        <div class="field telephone required">
                            <label for="telephone" class="label"><span>Mật khẩu mới</span>
                            </label>
                            <div class="control">
                                <?php echo form_password('newpassword', set_value('newpassword'), 'placeholder="Mật khẩu mới" class="input-text required-entry  " placeholder="" autocomplete="off"');?>
                            </div>
                        </div>
                        <div class="field telephone required">
                            <label for="telephone" class="label"><span>Nhập lại mật khẩu mới</span>
                            </label>
                            <div class="control">
                                <?php echo form_password('renewpassword', set_value('renewpassword'), 'placeholder="Xác nhận mật khẩu mới" class="input-text required-entry" placeholder="" autocomplete="off"');?>
                            </div>
                        </div>


                    </fieldset>
                </div>
                <div style="clear: both"></div>
                <div class="actions-toolbar" style="margin-top: 10px">
                    <div class="primary">

                        <input type="submit" name="update" class="action save primary" value="Cập nhập" style="font-size: 15px">

                    </div>

                </div>
            </form>

        </div>
        <div class="sidebar sidebar-main">
            <div class="block block-collapsible-nav">
                <div class="title block-collapsible-nav-title">
                    <strong>Đổi mật khẩu</strong>
                </div>
                <div class="content block-collapsible-nav-content" id="block-collapsible-nav">
                    <ul class="nav items">
                        <li class="nav item "><a href="information.html">Thông tin tài  khoản</a></li>

                        <li class="nav item current"><a href="change-pass.html">Đổi mật khẩu</a> </li>
                        <li class="nav item"><a href="order-history.html">Đơn đặt hàng của tôi</a> </li>
                        <li class="nav item"><a href="logout.html">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
            <div class="block account-nav">
                <div class="title account-nav-title">
                    <strong></strong>
                </div>
                <div class="content account-nav-content" id="account-nav">
                </div>
            </div>
        </div>

    </div>
</main>
<script>
    $('.block-collapsible-nav-title').click(function () {
        $('#block-collapsible-nav').toggleClass('active');



    })
</script>
<style>
    #block-collapsible-nav.active{
        display: block !important;

    }
</style>