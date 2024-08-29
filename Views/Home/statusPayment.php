<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
</head>
<style>
    body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
    }

    h1 {
        color: #88B04B;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-weight: 900;
        font-size: 40px;
        margin-bottom: 10px;
    }

    p {
        color: #404F5E;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-size: 20px;
        margin: 0;
    }

    i {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left: -15px;
    }

    .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
    }

    a {
        text-decoration: none;
    }

    a:hover {
        color: #404F5E;
        transition: 1s;
    }
</style>

<body>
    <div class="card">
        <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
            <?php if ($data['Message'] === "Successful.") : ?>
                <i class="checkmark">✓</i>
            <?php else : ?>
                <i style=" color: red;" class="checkmark">X</i>
            <?php endif; ?>
        </div>
        <?php if ($data['Message'] === "Successful.") : ?>
            <h1>Thanh toán đơn hàng thành công</h1>
        <?php else : ?>
            <h1>Thanh toán đơn hàng Thất bại</h1>
        <?php endif; ?>
        <a style="margin-right: 10px;" href="../Home/index/">Quay về trang chủ</a>
        <a href="../Customer/login/">Đăng nhập để kiểm tra đơn hàng</a>
    </div>

</body>

</html>