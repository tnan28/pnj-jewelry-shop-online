<div>
    <h1>
        Hóa đơn nhập hàng

    </h1>
    <div>
        <a href="../../AddPurchaseInvoice/index/">
            <button type="button" class="btn btn-primary" data-mdb-ripple-init>Thêm đơn hàng</button>
        </a>
    </div>
    <div>
        <table style="font-size: 1.3rem; margin: 0 auto;" id="PurchaseInvoice" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Mã hóa đơn</th>
                    <th>Ngày tạo</th>
                    <th>Tổng tiền</th>
                    <th>Nhà cung cấp</th>
                    <th>Trạng thái giao hàng</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data["PurchaseInvoices"] as $result) : ?>
                    <tr>
                        <td><?php echo $result['PURCHASEINVOICEID'] ?></td>
                        <td><?php echo DateTime::createFromFormat('Y-m-d H:i:s.u', $result['CREATEAT'])->format('d-m-Y g:ia') ?></td>
                        <td><?php echo number_format($result['TOTAL']) . " đ" ?></td>
                        <td><?php echo $result['SUPPLIERNAME'] ?></td>
                        <td>
                            <?php if ($result['STATUS'] == 0) : ?>
                                <span class="badge rounded-pill badge-primary">Chưa giáo hàng</span>
                            <?php else : ?>
                                <span class="badge rounded-pill badge-success">Đã giao hàng</span>
                            <?php endif ?>
                        </td>
                        <td>
                            <a href="../Detail/<?php echo $result['PURCHASEINVOICEID'] ?>"> <button type="button" class="btn btn-primary" data-mdb-ripple-init>Xem chi tiết</button></a>
                            <a class="<?php echo $result["STATUS"] == 0 ? "" : "disabled" ?>" href="../Confirm_delivery/<?php echo $result['PURCHASEINVOICEID'] ?>"> <button type="button" class="btn btn-primary" data-mdb-ripple-init>Xác nhận giao hàng</button></a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>
<style>
    .disabled.disabled {
        pointer-events: none;
        cursor: not-allowed
    }

    .disabled button {
        opacity: 0.6;
    }
</style>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script>
    new DataTable('#PurchaseInvoice');
</script>