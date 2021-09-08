<?php /*<section class="schedule-home">
    <div class="container-fluid">
        <div class="content-schedule-home">
            <h3 class="title">ĐẶT LỊCH TƯ VẤN THIẾT KẾ VÀ KHẢO SÁT DỰ ÁN VỚI <span><?php echo $this->fcSystem['homepage_brandname']?></span> </h3>
            <div class="nav-content-schedule">
                <form action="contact/frontend/contact/create" id="mailsubricre">
                    <div class="error"></div>

                    <input type="text" name="fullname" class="fullname" placeholder="Tên của bạn" required style="color: #fff">
                    <input type="text" name="phone" class="phone" placeholder="Điện thoại liên hệ" required style="color: #fff">
                    <input type="text" name="email" class="email" placeholder="Địa chỉ email của bạn" style="color: #fff">
                    <input type="text" name="message" class="message" placeholder="Nội dung tư vấn" style="color: #fff">
                    <div class="center">
                        <input type="submit" value="Gửi yêu cầu">
                    </div>

                </form>

            </div>
            <p class="desc center"> <?php echo $this->fcSystem['description_des']?></p>

        </div>
    </div>
</section>*/?>

<div class="form-footer">
    <h3 class="title2">Đăng kí nhận bản tin khuyến mãi định kì</h3>
    <form action="contact/frontend/contact/create" id="mailsubricre">
        <div class="error"></div>

        <div style="position: relative">
            <input type="text" name="email" class="email" placeholder="Vui lòng điền emai của quý khách vào đây">
            <input type="submit" value="Đăng ký">

        </div>
    </form>
</div>