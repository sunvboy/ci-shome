<footer id="footer-site">
    <div class="footer-1">
        <div class="container">
            <div class="wp-ft">
                <h3 class="h3-title-ft"><?php echo $this->fcSystem['homepage_company'] ?></h3>
                <p>Địa chỉ: <?php echo $this->fcSystem['contact_address'] ?></p>
                <p>Số điện thoại: <?php echo $this->fcSystem['contact_hotline'] ?></p>
                <p>Email: <?php echo $this->fcSystem['contact_email'] ?></p>
                <p>Website: <?php echo $this->fcSystem['contact_website'] ?></p>
                <p>Giờ làm việc: <?php echo $this->fcSystem['contact_timelv'] ?></p>

                <div class="link-xh">
                    <ul>

                        <li><a href="<?php echo $this->fcSystem['social_facebook'] ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="<?php echo $this->fcSystem['social_twitter'] ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="<?php echo $this->fcSystem['social_instagram'] ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="<?php echo $this->fcSystem['social_google_plus'] ?>" target="_blank"><i class="fab fa-google"></i></a></li>
                        <li><a href="<?php echo $this->fcSystem['social_youtube'] ?>" target="_blank"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copy-right">
        <div class="container">
            <div class="wp-copy text-center" style="color: #fff">
                Bản quyền thuộc về <?php echo $this->fcSystem['homepage_company'] ?> Thiết kế website bởi <a href="https://ovn-admin.vn/" target="_blank" style="color: #fff">Tâm
                    Phát</a>
            </div>
        </div>
    </div>
</footer>
<div class="toolbar">
    <div class="inner">
        <a class="zalo" href="http://zalo.me/<?php echo $this->fcSystem['social_zalo'] ?>" target="_blank"><img src="template/mobile/images/icon-zalo.png" alt="zalo"></a>
        <a class="fone" href="tel:<?php echo $this->fcSystem['contact_hotline'] ?>"><img src="template/mobile/images/phone.png" alt="<?php echo $this->fcSystem['contact_hotline'] ?>"></a>
        <a class="messenger" href="<?php echo $this->fcSystem['social_facebookm'] ?>" target="_blank"><img src="template/mobile/images/mes.png" alt="message"></a>
    </div>
</div>
<div id="myModal" class="modal-search modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <div class="modal-body">
                <form action="tim-kiem.html" method="get">
                    <input type="text" name="key" placeholder="Nhập từ khóa cần tìm kiếm...">
                    <input type="submit" value="Tìm kiếm">
                </form>
            </div>

        </div>

    </div>
</div>

<a id="scrollUp"><i class="fa fa-angle-up"></i></a>
<script type="text/javascript" src="template/mobile/js/bootstrap.min.js"></script>
<script type="text/javascript" src="template/mobile/js/swiper.min.js"></script>
<script type="text/javascript" src="template/mobile/js/owl.carousel.min.js"></script>
<script src="template/mobile/js/all.js"></script>
<script src="template/mobile/js/hc-offcanvas-nav.js"></script>
<script type="text/javascript" src="template/mobile/js/main.js"></script>
