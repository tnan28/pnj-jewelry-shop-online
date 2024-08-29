<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../Public/css/config.index.css">
    <link rel="stylesheet" href="../../Public/css/Customer/Customer.css">
    <link rel="stylesheet" href="../../Public/css/Customer/login.css">
    <link rel="stylesheet" href="../../Public/css/Customer/home.css">
    <link rel="stylesheet" href="../../Public/css/Customer/history.css">

</head>

<body>

    <div>
        <div class="container-fluid customer ">
            <div class="row">
                <?php require_once './Views/Customer/Layout/header.php' ?>

                <div class="col-sm-9 header-right">
                    <?php require_once './Views/Customer/Layout/Nav.php' ?>

                    <div class="customer_main" style="margin-left: 380px; margin-top: 70px; width: 100%;">
                        <?php require_once './Views/Customer/Pages/' . $data["Page"] . ".php" ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>