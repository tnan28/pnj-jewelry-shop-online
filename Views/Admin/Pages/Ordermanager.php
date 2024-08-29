<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
<form action="../../AddOrder/index/">
    <button type="submit" class="btn btn-primary" data-mdb-ripple-init>Tạo Đơn Hàng</button>
</form>
<?php if (!$data['Orders']) : ?>
    <h1>Không tồn tại hóa đơn</h1>
<?php else : ?>
    <table style="font-size: 1.3rem;" id="Data_OrderManager" class="stripe" style="width:100%">
        <thead>
            <tr>
                <th>Tên Khách Hàng</th>
                <th>Số điện thoại</th>
                <th>Ngày Tạo</th>
                <th>Tổng Hóa Đơn</th>
                <th>Trạng Thái </th>
                <th>Chức Năng</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['Orders'] as $order) : ?>

                <tr>
                    <td><?php echo ($order['CUSTOMERNAME']) ?></td>
                    <td><?php echo ($order['PHONENUMBER']) ?></td>
                    <td><?php echo DateTime::createFromFormat('Y-m-d H:i:s.u', $order['CREATEAT'])->format('d-m-Y g:ia') ?></td>
                    <td><?php echo number_format(($order['TOTAL'])) . ' đ' ?></td>
                    <td>
                        <?php
                        switch ($order['STATUS']) {
                            case 0:
                                echo "<span class='badge badge-info'>Chưa xác nhận</span>";
                                break;
                            case 1:
                                echo "<span class='badge badge-primary'>Đã xác nhận</span>";
                                break;
                            case 2:
                                echo "<span class='badge badge-success'>Đã nhận hàng</span>";
                                break;
                            case 3:
                                echo "<span class='badge badge-danger'>Đã hủy đơn</span>";
                                break;
                        }
                        ?>
                    </td>
                    <td style="display: flex;align-items: center;">
                        <a href="../../OrderDetail/OrderDetailID/<?php echo $order['ORDERID'] ?>">
                            <button class="btn btn-info">Xem chi tiết</button>
                        </a>
                        <select data-id="<?php echo $order['ORDERID'] ?>" class="selectAccept" style="outline: none;
                            border: none; border-radius: 8px;border: 1px solid gray; margin-left: 10px; width: 170px;
                            padding: 5px;
                            ">
                            <option>Chọn tình trạng đơn hàng</option>
                            <option <?php echo ($order['STATUS'] > 1 ?  "disabled" : "") ?> <?php echo ($order['STATUS'] == 1 ?  "selected" : "") ?> value="1">
                                Xác nhận đơn hàng
                            </option>
                            <option <?php echo ($order['STATUS'] > 2 ?  "disabled" : "") ?> <?php echo ($order['STATUS'] == 2 ?  "selected" : "") ?> value="2">
                                Xác nhận đã giao hàng
                            </option>
                            <option <?php echo ($order['STATUS'] == 2 ?  "disabled" : "") ?> <?php echo ($order['STATUS'] == 3 ?  "selected" : "") ?> value="3">
                                Hủy đơn hàng
                            </option>
                        </select>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>

    <?php endif ?>
    <script>
        document.querySelectorAll(".selectAccept").forEach(select => {
            select.addEventListener('change', () => {
                $.ajax({
                    type: "POST",
                    url: "http://localhost:8080/PNJSHOP/Orders/StatusOrder/",
                    data: JSON.stringify({
                        ID: select.getAttribute("data-id"),
                        Status: select.value
                    }),
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.Status === 200) {
                            location.reload();
                        }

                    }
                });
            })
        })
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/autofill/2.7.0/js/dataTables.autoFill.min.js"></script>
    <script>
        new DataTable('#Data_OrderManager', {
            layout: {
                bottomEnd: {
                    paging: {
                        boundaryNumbers: false
                    }
                }
            }
        });
    </script>