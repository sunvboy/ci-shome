<script>
    $("body").removeAttr('class');
    $("body").attr('class', "account customer-account-edit page-layout-2columns-left add-padding-header iMenu loading-active-12 loading-actived");


</script>
<main id="maincontent" class="page-main">



    <div class="columns">
        <div class="column main">
            <div class="page-title-wrapper">
                <h1 class="page-title">
                    <span class="base" data-ui-id="page-title-wrapper">Thêm địa chỉ mới</span></h1>
            </div>


            <form class="form-address-edit" action="" method="post" id="form-validate" enctype="multipart/form-data">

                <?php
                $error = validation_errors();
                echo (!empty($error) && isset($error)) ? '<div class="alert alert-danger">'.$error.'</div>' : '';
                ?>
                <div>
                    <fieldset class="fieldset">

                        <legend class="legend"><span>Thông tin liên hệ</span></legend>
                        <br>
                        <div class="field field-name-lastname required">
                            <label class="label" for="lastname">
                                <span>Email</span>
                            </label>
                            <div class="control">
                                <input type="text" value="<?php echo $detailCustomer['email']?>" class="input-text" readonly autocomplete="off">

                            </div>
                        </div>




                        <div class="field field-name-lastname required">
                            <label class="label" for="lastname">
                                <span>Họ và tên</span>
                            </label>
                            <div class="control">

                                <?php echo form_input('fullname', set_value('fullname',$detailCustomer['fullname']), 'class="input-text required-entry" placeholder="Họ và tên" autocomplete="off"');?>

                            </div>
                        </div>


                        <div class="field telephone required">
                            <label for="telephone" class="label">
<span>
Số Điện thoại </span>
                            </label>
                            <div class="control">
                                <?php echo form_input('phone', set_value('phone',$detailCustomer['phone']), 'class="input-text required-entry" placeholder="Số điện thoại" autocomplete="off"');?>

                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="fieldset">
                        <script>
                            var cityid = '<?php echo $detailCustomer['cityid']; ?>';
                            var districtid = '<?php echo $detailCustomer['districtid'] ?>';
                            var wardid = '<?php echo $detailCustomer['wardid'] ?>';
                        </script>
                        <legend class="legend"><span>Địa chỉ</span></legend>
                        <br>
                        <div class="field region required">
                            <label class="label" for="region_id">
                                <span>Tỉnh/Thành phố</span>
                            </label>
                            <div class="control">

                                <?php
                                $listCity = getLocation(array(
                                    'select' => 'name, provinceid',
                                    'table' => 'vn_province',
                                    'field' => 'provinceid',
                                    'text' => 'Chọn Tỉnh/Thành Phố'
                                ));
                                ?>
                                <?php echo form_dropdown('cityid', $listCity, '', 'class=""  id="city" placeholder="" autocomplete="off" style="font-size: 14px;"');?>

                            </div>
                        </div>
                        <div class="field city required">
                            <label class="label" for="city"><span>Quận/Huyện</span></label>
                            <div class="control">
                                <select name="districtid" id="district" class="select-soflow saveinfo location" style="font-size: 14px">
                                    <option value="">Chọn Quận/Huyện</option>
                                </select>

                            </div>
                        </div>

                        <div class="field street required">
                            <label for="street_1" class="label">
                                <span>Địa chỉ </span>
                            </label>
                            <div class="control">
                                <?php echo form_input('address', set_value('address',$detailCustomer['address']), 'class="input-text required-entry" placeholder="Địa chỉ" autocomplete="off"');?>

                            </div>
                        </div>

                    </fieldset>
                </div>
                <div class="actions-toolbar">
                    <div class="primary">

                        <input type="submit" name="update" class="action save primary" value="Cập nhập" style="font-size: 15px">

                    </div>

                </div>
            </form>

        </div>
        <div class="sidebar sidebar-main">
            <div class="block block-collapsible-nav">
                <div class="title block-collapsible-nav-title">
                    <strong>Tổng quan tài khoản</strong>
                </div>
                <div class="content block-collapsible-nav-content" id="block-collapsible-nav">
                    <ul class="nav items">
                        <li class="nav item current"><a href="information.html">Thông tin tài  khoản</a></li>

                        <li class="nav item"><a href="change-pass.html">Đổi mật khẩu</a> </li>
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