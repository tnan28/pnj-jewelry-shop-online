<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="../../Public/css/Admin/login.css">

</head>

<body>
    <div class="container">
        <div>
            <label for="">UserName</label>
            <input type="text" placeholder="UserName" id="username" required name="username">
        </div>
        <div>
            <label for="">Password</label>
            <input type="password" placeholder="Password" id="password" required name="password">
        </div>
        <div class="login">
            <button id="loginButton">Đăng nhập</button>
        </div>
        <div style="width: 100%; display: flex; justify-content: flex-end;">
            <a href="">Quên mật khẩu</a>
        </div>
    </div>
</body>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('#loginButton').click(function() {
            var username = $('#username').val();
            var password = $('#password').val();
            $.ajax({
                type: "POST",
                url: "http://localhost:8080/PNJSHOP/AuthenticationAdmin/AdminLogin/",
                data: JSON.stringify({
                    username: username,
                    password: password
                }),
                dataType: "json",
                contentType: "application/json",
                success: function(response) {
                    console.log(response);
                    if (response.status == 200) {
                        window.location.href = "../../Admin/index/";
                    }

                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);

                }
            });
        });
    });
</script>

</html>