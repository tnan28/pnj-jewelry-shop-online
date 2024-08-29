<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../Public/css/config.index.css">
    <link rel="stylesheet" href="../../Public/css/Home/header.css">
    <link rel="stylesheet" href="../../Public/css/Home/footer.css">
    <link rel="stylesheet" href="../../Public/css/Home/detail.css">
    <link rel="stylesheet" href="../../Public/css/Home/cart.css">
    <style>
        #modal_Search {
            z-index: 10000000;
            position: fixed;
            top: 0;
            width: 100%;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
        }

        .boxSearch {
            z-index: 1;
            width: 50%;
            margin-bottom: 5px;
            margin-top: 20px;


        }

        .boxSearch input {
            border-radius: 8px;
            width: 100%;
            padding: 5px 10px;
            font-size: 1.2rem;
            outline: none;
            border: none;
        }

        #modal_Search_item {
            z-index: 1;
            border-radius: 8px;
            padding: 10px 20px;
            background-color: #fff;
            width: 50%;
            height: 86%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        #modal_Search #modal_Search_item .boxImg {
            width: 110px;
            height: 110px;
        }

        #modal_Search #modal_Search_item .boxImg img {
            border-radius: 10px;
            width: 110px;
            height: 110px;

        }

        #modal_Search #modal_Search_item .item {

            display: flex;
            margin: 10px 0;
        }

        #modal_Search #modal_Search_item .item .info {
            margin-left: 10px;
        }

        #modal_Search #modal_Search_item .item .info h5 {
            font-size: 1.2rem;
            font-weight: bold;
        }

        #modal_Search #modal_Search_item .item .info .price p {
            font-size: .8rem;
            font-weight: 400;
            color: #003468;
        }
    </style>
</head>

<body>
    <div id="modal_Search">
        <div id="Modal_Child" style="width: 100%; height: 100%; display: flex; justify-content: center; flex-direction: column;
        align-items: center;">
            <div class="boxSearch">
                <input id="input_boxSearch" type="text" placeholder="Tìm kiếm sản phẩm">
            </div>
            <div id="modal_Search_item">
                <div id="loading" style="display: none;">Loading...</div>
            </div>
        </div>
    </div>
    <div class="app">
        <?php require_once './Views/Home/Layout/Header.php' ?>
        <main style="margin-top: 150px;">
            <div class="container">
                <?php require_once './Views/Home/Pages/' . $data["Page"] . ".php" ?>
            </div>
        </main>
        <?php require_once './Views/Home/Layout/Footer.php' ?>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var inputField = document.getElementById('Search_input');
    var modal = document.getElementById('modal_Search');

    inputField.addEventListener('focus', function() {
        inputField.value = "";
        input_boxSearch.focus();
        modal.style.display = 'block';
    });

    window.addEventListener('click', function(event) {
        if (event.target.parentElement === modal) {
            modal.style.display = 'none';
        }
    });
    const input_boxSearch = document.querySelector("#input_boxSearch");

    function debounce(func, delay) {
        let timerId;
        return function(...args) {
            if (timerId) {
                clearTimeout(timerId);
            }
            timerId = setTimeout(() => {
                func.apply(this, args);
            }, delay);
        };
    }

    function callAPI() {
        document.getElementById('loading').style.display = 'block';

        setTimeout(function() {
            $.ajax({
                type: "POST",
                url: "http://localhost:8080/PNJSHOP/Home/SearchProductAPI/",
                data: JSON.stringify({
                    keySearch: input_boxSearch.value
                }),
                dataType: "json",
                success: function(response) {
                    if (response.Status === 200) {
                        const list = document.querySelector("#modal_Search_item");
                        list.innerHTML = "";
                        if (response.Products) {
                            response.Products.forEach(element => {
                                const a = document.createElement("a");
                                a.href = `../../Detail/ProductId/${element.PRODUCTID}`;
                                a.innerHTML = `
                            <div class="item">
                                <div class="boxImg">
                                    <img src="../../Public/Image/Products/${element.IMAGE_1}" alt="Ảnh">
                                </div>
                                <div class="info">
                                    <div class="name">
                                        <h5>${element.PRODUCTNAME}</h5>
                                    </div>
                                    <div class="price">
                                        <p> Giá bán: ${VND.format(element.PRICE)}</p>
                                    </div>
                                </div>
                            </div>
                            -------------------------------------------------------------------------------------------------------------------------------------------------------------------
                        `
                                list.appendChild(a);
                            });
                        } else {
                            const h5 = document.createElement("h5");
                            h5.innerText = "Sản phẩm không tồn tại!"
                            list.appendChild(h5);
                        }

                    }
                }
            });
            document.getElementById('loading').style.display = 'none';
        }, 2000);
    }
    var debounceInput = debounce(function() {
        callAPI();
    }, 1000);
    input_boxSearch.addEventListener('input', debounceInput);
</script>

<script src="../../Public/js/Location.js"></script>
<script>
    const VND = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
        currencyDisplay: 'code'
    });

    function updatePrice(selectedSize) {
        var selectedPrice = selectedSize.getAttribute("data-price");
        document.getElementById("product-price").innerText = "Giá: " + VND.format(selectedPrice);
    }
</script>

</html>