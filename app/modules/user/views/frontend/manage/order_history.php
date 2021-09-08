<script>
    $("body").removeAttr('class');
    $("body").attr('class', "account customer-account-edit page-layout-2columns-left add-padding-header iMenu loading-active-12 loading-actived");


</script>
<main id="maincontent" class="page-main">


    <div class="columns">
        <div class="column main">
            <div class="page-title-wrapper">
                <h1 class="page-title"><span class="base">Đơn đặt hàng của tôi</span></h1>
            </div>


            <?php if (isset($listorder) && is_array($listorder) && count($listorder)) { ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <td class="text-center">STT</td>
                            <td class="text-center">Trạng thái</td>
                            <td class="text-center">Ngày đặt</td>
                            <td class="text-center">Tổng tiền</td>
                            <td class="text-center">#</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($listorder as $key => $val) { ?>
                            <tr>
                                <td class="text-center"><?php echo $key + 1 ?></td>
                                <td class="text-center"><?php echo $this->configbie->data('state_order', $val['status']) ?></td>
                                <td class="text-center"><?php echo gettime($val['created'], 'd-m-Y H:s:i') ?></td>
                                <td class="text-center"><?php echo addCommas($val['total_cart_final']) ?> đ</td>
                                <td class="text-center"><a class="btn btn-info js_open_windown" data-toggle="tooltip" href="order-information.html?id=<?php echo $val['id'] ?>" data-original-title="View">Xem chi tiết</a>
                                </td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>
                <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
            <?php }else{ ?>

            <div class="message info empty"><span>Bạn không đặt đơn hàng nào.</span></div>
            <?php }?>

        </div>
        <div class="sidebar sidebar-main">
            <div class="block block-collapsible-nav">
                <div class="title block-collapsible-nav-title">
                    <strong>Đơn đặt hàng của tôi</strong>
                </div>
                <div class="content block-collapsible-nav-content" id="block-collapsible-nav">
                    <ul class="nav items">
                        <li class="nav item "><a href="information.html">Thông tin tài khoản</a></li>

                        <li class="nav item "><a href="change-pass.html">Đổi mật khẩu</a></li>
                        <li class="nav item current"><a href="order-history.html">Đơn đặt hàng của tôi</a></li>
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
<style>
    .label-primary, .badge-primary {
        background-color: #3a88be;
        color: #FFFFFF;
    }
    .label-info, .badge-info {
        background-color: #23c6c8;
        color: #FFFFFF;
    }
    .label-danger,.badge-danger {

        background-color: #ed5565;

        color: #FFFFFF;

    }
    .label-success,

    .badge-success {

        background-color: #155724;

        color: #FFFFFF;

    }
    .label-warning,

    .badge-warning {

        background-color: #f8ac59;

        color: #FFFFFF;

    }

    .label {
        display: inline;
        padding: .2em .6em .3em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25em;
    }
</style>
<?php /*?>
 <script>
    $('.block-collapsible-nav-title').click(function () {
        $('#block-collapsible-nav').toggleClass('active');


    })
</script>
<style>
    #block-collapsible-nav.active {
        display: block !important;

    }
</style>


<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i></a></li>
        <li><a href="javascript:void(0)">Lịch sử mua hàng</a></li>
    </ul>

    <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
            <h2 class="title">Lịch sử mua hàng</h2>
            <?php if (isset($listorder) && is_array($listorder) && count($listorder)) { ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <td class="text-center">STT</td>
                            <td class="text-center">Số lượng</td>
                            <td class="text-center">Trạng thái</td>
                            <td class="text-center">Ngày đặt</td>
                            <td class="text-right">Tổng tiền</td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($listorder as $key => $val) { ?>

                            <tr>

                                <td class="text-center"><?php echo $key + 1 ?></td>
                                <td class="text-center"><?php echo $val['quantity'] ?></td>
                                <td class="text-center"><?php echo $this->configbie->data('state_order', $val['status']) ?></td>
                                <td class="text-center"><?php echo gettime($val['created'], 'd-m-Y H:s:i') ?></td>
                                <td class="text-right"><?php echo addCommas($val['total_cart_final']) ?> đ</td>
                                <td class="text-center"><a class="btn btn-info js_open_windown" title=""
                                                           data-toggle="tooltip"
                                                           href="order-information.html?id=<?php echo $val['id'] ?>"
                                                           data-original-title="View"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>
                <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
            <?php } ?>
        </div>
        <!--Middle Part End-->
        <!--Right Part Start -->
        <?php echo $this->load->view('user/frontend/manage/aside') ?>
    </div>
</div>
<script>
    $('.js_open_windown').click(function(){
        let h = screen.availHeight;
        let w = screen.availWidth;
        window.open(this.href, 'chorme', 'top='+h*10/100+', left='+w*10/100+', width='+w*80/100+',height='+h*80/100);
        return false;
    });
</script>
 <?php */ ?>