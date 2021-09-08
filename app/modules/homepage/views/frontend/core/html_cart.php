<?php
$this->load->helper(array('myfrontendcart'));
$cart = $this->cart->contents();
$datacart = renderDataProductInCart(array('coupon' => true));
?>
<div id="mini-cart-block">
    <div class="minicart">
        <div class="title-cart">
            <div class="cart-icon" id="cart-icon-cart">Giỏ Hàng</div>
            <div class="close-minicart" id="close-minicart-cart"><span></span> <span></span></div>
        </div>
        <div>
            <div class="mini-cart-items">
                <div class="content-minicart">
                    <div class="items-cart">
                        <form method="post" id="form-update-cart" action="" class="cart_listheader">

                            <?php if (isset($datacart['list_product']) && is_array($datacart['list_product']) && count($datacart['list_product'])) {
                                foreach ($datacart['list_product'] as $key => $val) { ?>
                                    <?php echo htmlItemCart($val);?>
                                <?php } ?>
                            <?php } ?>

                        </form>
                    </div>
                    <div class="price-container">
                        <div class="price-block product">
                            <div class="pull-left label-price">Giá tạm tính</div>
                            <div class="pull-right price-right subtotal-price"><span
                                        class="price cart_totalprice"><?php echo addCommas($datacart['cart']['total_cart']) ?>&nbsp;₫</span>
                            </div>
                        </div>
                        <div class="price-block grand">
                            <div class="pull-left label-price">Tổng tiền</div>
                            <div class="pull-right grand-total price-right"><!---->
                                <div class="price cart_totalprice"><?php echo addCommas($datacart['cart']['total_cart']) ?> ₫</div>
                            </div>
                        </div>
                        <div class="button-action"><a href="thanh-toan.html" class="button-steps">
                                <div class="text">
                                    Tiếp tục thanh toán
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>