<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../Public/css/config.index.css">
    <link rel="stylesheet" href="../../Public/css/Customer/login.css">
</head>

<body>
    <div id="wrapper">
        <form class="form" id="form-login" method="post" action="../../VerifyPhoneNumber/index/" name="form_login">
            <img class="pnjimage" src="../../Public/Image/Common/pnjlogo.jpg" style="text-align: justify;">
            <h1 class="form-heading" style="color: #475569; line-height: 1;">Chào mừng trở lại</h1>
            <p style="text-align: center; color: gray;">Vui lòng đăng nhập để tiếp tục</p>
            <div class="form-group">
                <input name="phoneNumber" type="text" pattern="[0-9]+([.,][0-9]+)?" title="Chỉ chấp nhận số" class="form-input" placeholder="Số điện thoại của bạn">
                <p style="color:blue">Bạn muốn nhận OTP qua:</p>
            </div>
            <input type="submit" value="SMS" class="form-submit">
            <div style="color:gray">Lợi ích khi đăng nhập/đăng kí MyPNJ</div>
            <ul class="list">
                <li><i class="fa-solid fa-circle-check"></i> Xem lịch sử giao dịch và hóa đơn điện tử</li>
                <li><i class="fa-solid fa-circle-check"></i> Xem được ưu đãi dành riêng cho quý khách</li>
            </ul>
            <div style="display: flex; justify-content: flex-end;">
                <a href="../../LoginManager/index/" style="color: blue;">Đăng nhập cho người quản lý</a>
            </div>
        </form>

    </div>
</body>

</html>