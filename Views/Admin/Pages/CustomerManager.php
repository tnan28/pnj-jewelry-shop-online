<?php
if (!$data['Customers']) : ?>
    <h1>Không tồn tại khách hàng</h1>
<?php else : ?>
    <table style="font-size: 1.3rem;" id="Customer" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Họ và tên</th>
                <th>Số điện thoại</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['Customers'] as $customer) : ?>
                <tr>
                    <td><?php echo $customer['CUSTOMERNAME'] ?></td>
                    <td><?php echo $customer['PHONENUMBER'] ?></td>
                    <td><?php echo $customer['EMAIL'] ?></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>