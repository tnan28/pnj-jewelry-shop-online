<div id="CreateOrder">
    <h1>Tạo Đơn Hàng</h1>
    <form action="../../CreateOrder/index/" method="post">
        <div>
            <div class="info">
                <h2>Thông tin khách hàng</h2>
                <div>
                    <label for="">
                        Họ Và Tên:
                    </label>
                    <input type="text" name="customer_name" placeholder="Nhập họ và tên">
                </div>
                <div>
                    <label for="">
                        Số điện thoại:
                    </label>
                    <input type="text" name="phone_number" placeholder="Nhập số điện thoại">
                </div>
                <div>
                    <label for="">
                        Email:
                    </label>
                    <input type="text" name="email" placeholder="Nhập Email">
                </div>
            </div>
        </div>
        <div class="CreateOrder_Details">
            <input class="searchProduct" type="text" placeholder="Tìm kiếm sản phẩm">
            <div class="searchProduct_Result">
                <div class="loader"></div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Kích thước</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Đơn Giá</th>
                        <th scope="col">Thành Tiền</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <input hidden name="data" value="<?php echo htmlspecialchars(serialize($data['Products'])); ?>">
                    <?php if (!$data['Products']) : ?>
                        <tr>
                            <td colspan="7">
                                <h1>Không có sản phẩm</h1>
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($data['Products'] as $index => $product) : ?>
                            <tr>
                                <td scope="row"><?php echo $index + 1 ?></td>
                                <td class="text_product">
                                    <?php echo $product[0]['PRODUCTNAME']; ?>
                                </td>

                                <td>
                                    <select name="size_<?php echo $index ?>" onchange="updatePrice(this)">
                                        <option value="">Chọn kích cỡ</option>
                                        <?php foreach ($product as $dataSize) : ?>
                                            <option data-price="<?php echo $dataSize['PRICESIZE'] ?>" value="<?php echo $dataSize['PRODUCT_SIZEID'] ?>"> <?php echo $dataSize['SIZENAME'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <input class="quantity" type="number" name="quantity_<?php echo $index ?>" value="1" onchange="updateSum(this)">
                                </td>
                                <td class="product-price"><?php echo number_format($product[0]['PRICE']); ?></td>
                                <td class="SumPrice"><?php echo number_format($product[0]['PRICE']); ?></td>
                                <td>
                                    <a href="../DeleteOrderDetail/<?php echo $index ?>">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <tr>
                        <td colspan="6">Tổng số lượng</td>
                        <td id="productCount"><?php echo count($data['Products']) ?></td>
                    </tr>
                    <tr>
                        <td colspan="6">Tổng tiền</td>
                        <td id="total">0</td>
                    </tr>
                </tbody>
            </table>
            <div style="display: flex;width: 100%; justify-content: flex-end;">
                <button style="font-size: 1.2rem; padding: 15px 30px;" type="Submit" class="btn btn-primary" data-mdb-ripple-init>Tạo Đơn Hàng</button>
            </div>
        </div>

    </form>
</div>