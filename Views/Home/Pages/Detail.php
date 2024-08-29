<div class="detail">
    <div class="detail_left">
        <div class="detail_left-listImage">
            <div>
                <img src="../../Public/Image/Products/<?php echo $data['Product'][0]['Image_1'] ?>" alt="">
            </div>
            <div>
                <img src="../../Public/Image/Products/<?php echo $data['Product'][0]['Image_2'] ?>" alt="">
            </div>
            <div>
                <img src="../../Public/Image/Products/<?php echo $data['Product'][0]['Image_3'] ?>" alt="">
            </div>
            <div>
                <img src="../../Public/Image/Products/<?php echo $data['Product'][0]['Image_4'] ?>" alt="">
            </div>
        </div>
        <div class="detail_left-image">
            <div>
                <img src="../../Public/Image/Products/<?php echo $data['Product'][0]['Image_1'] ?>" alt="">
            </div>
        </div>
    </div>
    <div class="detail_right">
        <div>
            <h5><?php echo $data['Product'][0]['PRODUCTNAME'] ?></h5>
        </div>
        <div>
            <p>Mã: <?php echo strtoupper($data['Product'][0]['PRODUCTID']) ?> </p>
        </div>

        <div class="price">
            <p id="product-price" style="font-size: 18px; color: #003468;">Giá: <?php echo number_format($data['Product'][0]['PRICE']) . ' ' . "VNĐ"; ?> </p>
        </div>
        <form action="../../Cart/AddCart/" method="post" name="Add-cart">
            <div class="size">
                <p>Chọn kích cỡ </p>
                <?php
                foreach ($data['Product'] as $product) { ?>
                    <input type="radio" class="size" name="productSizeID" id="<?php echo $product['SIZEID'] ?>" value="<?php echo $product['PRODUCT_SIZEID'] ?>" data-price="<?php echo $product['PRICESIZE'] ?>" onchange="updatePrice(this)">
                    <label for="<?php echo $product['SIZEID'] ?>"><span><?php echo $product['SIZENAME'] ?></span></label>
                <?php
                }
                ?>
            </div>
            <div>
                <button type="submit" class="Add-to-card">
                    THÊM VÀO GIỎ HÀNG
                    <p>Quý khách vui lòng chọn kích cỡ tại giỏ hàng</p>
                </button>
            </div>
        </form>
        <ul>
            <li> <i class=" fa-sharp fa-solid fa-circle-check "></i>Giá sản phẩm thay đổi tuỳ trọng lượng vàng và đá</li>
            <li> <i class=" fa-sharp fa-solid fa-circle-check "></i>Miễn phí giao nhanh Toàn Quốc 1-7 ngày</li>
        </ul>
    </div>
</div>