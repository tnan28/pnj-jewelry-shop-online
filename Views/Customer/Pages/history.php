<div class="history-customer">
    <h3>Đơn hàng của bạn</h3>
    <div>
        <?php

        function Format($dateString)
        {
            $dateTime = DateTime::createFromFormat('Y-m-d H:i:s.u', $dateString);
            return $dateTime->format('d-m-Y h:ia');
        }
        ?>
        <?php
        if (count($data['History']) > 0) : ?>
            <?php
            foreach ($data['History'] as $history) {
            ?>
                <div style="margin: 20px 0;">
                    <div>
                        <p class="time">Thời gian: <?php echo Format($history->CREATEAT) ?></p>
                    </div>
                    <div class="history_customer-item">
                        <div class="item_top">
                            <h3>Mã đơn hàng: #<?php echo ($history->ORDERID) ?></h3>
                            <h3>Kênh online</h3>
                        </div>
                        <div class="item_mid">

                            <div class="img">
                                <img src="../../Public/Image/Products/<?php echo $history->IMAGE_1 ?>" alt="">

                            </div>
                            <div class="info_Product">
                                <p><?php echo $history->PRODUCTNAME ?></p>
                                <p><?php echo number_format($history->PRICE, 0, '', ',') . "VNĐ" ?> <span>X<?php echo $history->QUANTITY ?> </span></p>
                            </div>
                        </div>
                        <div class="item_bot">
                            <h3><?php echo number_format($history->TOTAL, 0, '', ',') . "VNĐ"  ?></h3>
                            <h3>Đã hủy</h3>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php else : ?>
            <h5>Bạn chưa mua sản phẩm nào</h5>
        <?php endif; ?>
    </div>
</div>