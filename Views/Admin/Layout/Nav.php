<div class=" nav_Customer col-sm-2" style="height: 100vh; position: fixed; background-color: white;">
    <div class="Customer_header">
        <div class="img">
            <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/01/Icon.png" alt="asdasd">
        </div>
        <div>
            <h3>My PNJ</h3>
        </div>
    </div>
    <div>
        <ul>
            <li>
                <a style="font-size: 1.4rem;" href="../../Employee/index/"><i class="fa-solid fa-users"></i> Quản lý Nhân Viên</a>
            </li>
            <li>
                <a style="font-size: 1.4rem;" href="../../Orders/index/"><i class="fa-solid fa-cart-shopping"></i> Quản lý Đơn Hàng</a>
            </li>
            <li>
                <a style="font-size: 1.4rem;" href="../../PurchaseInvoice/index/"><i class="fa-solid fa-cart-shopping"></i> Quản lý Nhập Hàng</a>
            </li>
            <li>
                <a style="font-size: 1.4rem;" href="../../Admin/index/"><i class="fa-solid fa-box"></i> Quản lý Sản Phẩm</a>
            </li>
            <li>
                <a style="font-size: 1.4rem;" href="../../CustomerManager/index/"><i class="fa-solid fa-user"></i> Quản lý Khách Hàng</a>
            </li>
            <li>
                <button style="outline: none;border: none;
                background-color: transparent;">
                    <span style="display: flex;
                     justify-content: center;">
                        <i style="margin-left: 2px; font-size: 1.4rem;" class="gg-log-out"></i>
                        <p style="margin-left: 15px;margin-top: -3px; font-size: 1.4rem;"> Đăng Xuất</p>
                    </span>
                </button>
            </li>
        </ul>
    </div>
</div>
<link href='https://unpkg.com/css.gg@2.0.0/icons/css/log-out.css' rel='stylesheet'>
<script>
    document.querySelector('button').addEventListener('click', () => {
        $.ajax({
            type: "post",
            url: "http://localhost:8080/PNJSHOP/AuthenticationAdmin/AdminLogout/",
            success: function(response) {
                console.log(response);
                if (response.status == 200) {
                    window.location.href = '/PNJSHOP/LoginManager/index/';
                }
            }
        });
    });
</script>