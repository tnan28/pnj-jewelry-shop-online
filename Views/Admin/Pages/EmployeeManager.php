<h1>Danh Sách nhân viên</h1>
<a href="../../AddEmployee/index/">
    <button style="font-size: 1rem;" type="button" class="btn btn-primary" data-mdb-ripple-init>Thêm Nhân Viên</button>
</a>
<?php
if (!$data['EmployeeList']) : ?>
    <h1>Không tồn tại khách hàng</h1>
<?php else : ?>
    <table style="font-size: 1.3rem;" id="Employee" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Họ và tên</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Ngày vào làm</th>
                <th>Lương</th>
                <th>Chức Năng</th>

            </tr>
        </thead>
        <tbody>

            <?php foreach ($data['EmployeeList'] as $employee) : ?>
                <tr>
                    <td><?php echo $employee['FULLNAME'] ?></td>
                    <td><?php echo $employee['PHONENUMBER'] ?></td>
                    <td><?php echo $employee['EMAIL'] ?></td>
                    <td><?php echo DateTime::createFromFormat('Y-m-d H:i:s.u', $employee['HIRE_DATE'])->format('d-m-Y'); ?></td>
                    <td><?php echo number_format($employee['SALARY']) . " đ" ?></td>
                    <td>
                        <a href="../DetailEmployee/<?php echo $employee['EMPLOYEEID'] ?>" data-mdb-tooltip-init title="Xem chi tiết">
                            <button style="font-size: 1.2rem;" type="button" class="btn btn-primary" data-mdb-ripple-init><i class="fa-solid fa-circle-info"></i></button>
                        </a>
                        <a href="../DeleteEmployee/<?php echo $employee['EMPLOYEEID'] ?>" data-mdb-tooltip-init title="Xóa nhân viên">
                            <button style="font-size: 1.2rem;" type="button" class="btn btn-primary" data-mdb-ripple-init><i class="fa-solid fa-trash"></i></button>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>