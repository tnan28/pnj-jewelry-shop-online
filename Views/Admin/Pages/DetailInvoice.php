<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
<div class="DetailPurchaseInvoice">
    <ul>
        <li><b>Mã đơn hàng : </b><?php echo $data["PurchaseInvoice"]->PURCHASEINVOICEID ?></li>
        <li><b>Ngày tạo:</b> <?php echo date("d-m-Y g:ia", strtotime($data["PurchaseInvoice"]->CREATEAT))  ?> </li>
        <li><b>Tổng tiền:</b> <?php echo number_format($data["PurchaseInvoice"]->TOTAL) . "VNĐ" ?></li>
        <li><b>Nhà cung cấp:</b> <?php echo $data["PurchaseInvoice"]->SUPPLIERNAME  ?></li>
        <li><b>Trạng thái đơn hàng:</b>
            <?php echo $data["PurchaseInvoice"]->STATUS == 0 ?
                "<span class='badge rounded-pill badge-primary'>Chưa giao hàng</span>"
                : "<span class='badge rounded-pill badge-success'>Đã giao hàng</span>" ?></li>
    </ul>
</div>
<style>
    .DetailPurchaseInvoice ul {
        font-size: 1.4rem;
        display: flex;
    }

    .DetailPurchaseInvoice ul li {
        margin-right: 10px;
    }

    .DetailPurchaseInvoice a>button {
        font-size: 1.5rem;
    }

    .DetailPurchaseInvoice .disabled.disabled {
        pointer-events: none;
        cursor: not-allowed;
    }

    .disabled button {
        opacity: 0.6;
    }
</style>
<div>
    <table style="font-size: 1.3rem;" id="DetailPurchaseInvoice" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Kích cỡ</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['PurchaseInvoiceDetail'] as $item) : ?>
                <tr>
                    <td><?php echo ($item->PRODUCTNAME) ?></td>
                    <td><?php echo ($item->DESCRIPTION_SIZE) ?></td>
                    <td><?php echo ($item->QUANTITY) ?></td>
                    <td><?php echo (number_format($item->TOTAL)) . " đ" ?></td>
                    <td><?php echo (number_format($item->QUANTITY * $item->TOTAL)) . " đ" ?></td>
                </tr>
            <?php endforeach; ?>
        <tbody>

    </table>
    <div>
        <a class="<?php echo $data["PurchaseInvoice"]->STATUS == 0 ? "" : "disabled" ?>" href="../Confirm_delivery/<?php echo $data["PurchaseInvoice"]->PURCHASEINVOICEID ?>">
            <button type="button" class="btn btn-primary" data-mdb-ripple-init>
                Xác nhận giao hàng
            </button>
        </a>
    </div>
</div>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script>
    new DataTable('#DetailPurchaseInvoice');
</script>