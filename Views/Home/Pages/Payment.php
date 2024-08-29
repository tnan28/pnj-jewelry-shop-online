<?php
$currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$orderID = basename($currentUrl);
$amounts = array_map(function ($item) {
    return $item['PRICE'];
}, $data['OrderDetail']);
?>

<div id="success_order">
    <h4>Đặt hàng thành công</h4>
</div>
<div class="info-cart" style="display: flex;">
    <div class="cart-left">
        <h3>THÔNG TIN ĐƠN HÀNG #<?php echo $data['ID'] ?></h3>
        <?php if (!$data['OrderDetail']) : ?>
            <h1 style="font-size: 1.6rem; text-align: center;">Không có sản phẩm trong giỏ hàng</h1>
        <?php else : ?>
            <?php foreach ($data['OrderDetail'] as $item) : ?>
                <div class="item">
                    <div class="img" style="width: 400px;">
                        <img style="width: 100%; height: 200px" src="../../Public/Image/Products/<?php echo $item['IMAGE_1']; ?>" alt="ảnh">
                    </div>
                    <div class="info">
                        <div>
                            <h6><?php echo $item['PRODUCTNAME']; ?></h6>
                        </div>
                        <div class="form">
                            <div>
                                <span>Số lượng: </span>
                                <p>X<?php echo $item['QUANTITY'] ?></p>
                            </div>
                            <div>
                                <span>Đơn Giá:</span>
                                <p> <?php echo number_format($item['PRICE']); ?>đ</p>
                            </div>
                            <div>
                                <span>Tổng giá:</span>
                                <p class="total_detail"> <?php echo number_format($item['TOTALDETAIL']); ?>đ</p>
                            </div>
                            <div>
                                <span>Kích thước:</span>
                                <p><?php echo $item['DESCRIPTION_SIZE'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <div>
            <div class="pay" style="margin-top: 10px; display: flex; justify-content: space-between;">
                <p style="font-weight: bold;">Thành tiền: </p>
                <p class="total" style="color: red; font-weight: bold;"><?php echo number_format(array_sum($amounts)) ?>đ</p>
            </div>
        </div>
    </div>
    <div class="cart-right">
        <div>
            <h5>Thông tin người nhận</h5>
            <div>
                <ul class="info">
                    <li>Người nhận hàng: <?php echo $data['Customer']->CUSTOMERNAME ?></li>
                    <li>Số điện thoại: <?php echo $data['Customer']->PHONENUMBER ?></li>
                    <li>Địa chỉ nhận hàng: <?php echo $data['Customer']->ADDRESS ? $data['Customer']->ADDRESS : "Nhận tại cửa hàng" ?></li>
                </ul>
            </div>
        </div>
        <div>
            <h5>Hình thức thanh toán</h5>
            <div class="Payment_select">
                <a href="../../StatusPayment/ReceiveStore/">
                    <button class="button_payment" <?php echo $data['Payment'] ? "disabled" : "" ?> id="PaymentShipping" type="button" class="btn btn-primary" data-mdb-ripple-init>
                        Thanh toán khi nhận hàng
                    </button>
                </a>
                <form action="../../Payment/PaymentOnlineATM/<?php echo $orderID ?>" method="POST" target="_blank" enctype="application/x-www-form-urlencoded">
                    <button class="button_payment" id="atm" type="submit" class="btn btn-primary" data-mdb-ripple-init>Thanh toán qua ngân hàng</button>
                </form>
            </div>
            <div style="margin-top: 10px;">
                <span>Lưu ý: <i style="color: red;"> Hình thức nhận hàng tận nơi sẽ phải thực hiện thanh toán trước</i></span>
            </div>
        </div>
    </div>
</div>
<style>
    #success_order {
        width: 100%;
        height: 50px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #D6FBBD;
        border-radius: 8px;
        margin-top: -10px;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    }

    #success_order h4 {
        color: #0D1117;
        font-weight: 500;
    }

    .info {
        margin-left: 20px;
        list-style-type: disc;
    }

    .info li {
        margin: 20px 0;
    }

    .Payment_select {
        display: flex;
        justify-content: space-between;
    }

    .Payment_select .button_payment {
        width: 400px;
    }

    .button_payment {
        background-color: #fff;
        padding: 20px 30px;
        border: none;
        outline: none;
        border-radius: 6px;
        box-shadow: rgba(67, 71, 85, 0.27) 0px 0px 0.25em, rgba(90, 125, 188, 0.05) 0px 0.25em 1em;
        transition: 0.5s;
        background:
            linear-gradient(to bottom right, #FD8451, #FFBD6F) no-repeat calc(200% - var(--i, 0) * 100%) 100% / 200% calc(100% * var(--i, 0) + .08em);
        transition: .3s calc(var(--i, 0) * .3s), background-position .3s calc(.3s - calc(var(--i, 0) * .3s));

    }

    .button_payment:hover {
        --i: 1;
        color: white;
        background-image: linear-gradient(to bottom right, #FD8451, #FFBD6F);
        box-shadow: rgba(0, 0, 0, 0.09) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
    }
</style>