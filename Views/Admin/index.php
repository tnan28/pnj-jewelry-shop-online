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
    <link rel="stylesheet" href="../../Public/css/Manager/employee.css">
    <link rel="stylesheet" href="../../Public/css/Manager/importproduct.css">
    <link rel="stylesheet" href="../../Public/css/Admin/orderDetail.css">
    <link rel="stylesheet" href="../../Public/css/Admin/CreateOrder.css">
    <link rel="stylesheet" href="../../Public/css/Admin/AddProduct.css">



    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.4/css/dataTables.dataTables.css">
    <style>
        .btn_option {
            padding: 6px 8px;
            font-size: 10px;
            cursor: pointer;
            border-radius: 6px;
            margin: 0 1px;
        }
    </style>
</head>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

<body>

    <div>
        <div class="container-fluid customer ">
            <div class="row">
                <?php require_once './Views/Admin/Layout/Nav.php' ?>

                <div class="col-sm-10 header-right">
                    <?php require_once './Views/Admin/Layout/header.php' ?>

                    <div class="customer_main" style="overflow-y: auto; height: 720px; margin-left: 260px; margin-top: 70px; width: 100%;">
                        <?php require_once './Views/Admin/Pages/' . $data["Page"] . ".php" ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script src="../../Public/js/dataTables.js"></script>
<script>
    new DataTable('#Data_product', {
        layout: {
            bottomEnd: {
                paging: {
                    boundaryNumbers: false
                }
            }
        }
    });

    function debounce(func, delay) {
        let timeout;
        let loaderTimeout;

        return function executedFunc(...args) {
            const result = document.querySelector(".searchProduct_Result");
            const searchInput = document.querySelector(".searchProduct");
            if (loaderTimeout) {
                clearTimeout(loaderTimeout);
            }
            loaderTimeout = setTimeout(() => {
                const loader = result.querySelector(".loader");
                if (searchInput.value.trim() === "") {
                    if (loader) {
                        loader.remove();
                    }
                }
            }, 300);
            if (searchInput.value.trim() !== "") {
                if (result.querySelector("h1") != null) {
                    result.querySelector("h1").innerHTML = "";

                }
                const loader = result.querySelector(".loader");
                if (!loader) {
                    const loaderDiv = document.createElement("div");
                    loaderDiv.className = "loader";
                    result.appendChild(loaderDiv);
                }
            }
            if (searchInput.value.trim() === "") {
                result.style.display = "none";
            } else {
                result.style.display = "block";
            }

            if (timeout) {
                clearTimeout(timeout);
            }
            timeout = setTimeout(() => {
                func(...args);
                timeout = null;
            }, delay);
        };
    }

    document.querySelector(".searchProduct").addEventListener("keyup", debounce((e) => {
        const result = document.querySelector(".searchProduct_Result");
        const searchInput = document.querySelector(".searchProduct");
        if (searchInput.value.trim() === "") {
            result.style.display = "none";
            result.innerHTML = "";
        } else {
            result.innerHTML = "";
            $.ajax({
                type: "post",
                url: "http://localhost:8080/PNJSHOP/AddProduct/SearchProduct",
                data: {
                    keySearch: e.target.value,
                },
                dataType: "json",
                success: function(response) {
                    if (response.data.length <= 0) {
                        result.innerHTML = "<h1>Không có sản phẩm</h1>";
                    } else {
                        const productsHTML = response.data.map(element => {
                            return `
                                <div class="ProductsSearch">
                                    <p>${element.PRODUCTNAME}</p>
                                    <a href="../AddProduct/${element.PRODUCTID}">Thêm</a>
                                </div>
                            `;
                        });
                        result.innerHTML = productsHTML.join('');
                    }
                }
            });
        }
    }, 600));
    document.querySelectorAll(".add").forEach((item, index) => {
        item.addEventListener('click', () => {
            console.log(item + " - " + index);
        })
    })
</script>
<script>
    const VND = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
        currencyDisplay: 'code'
    });

    function updatePrice(selectElement) {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var price = parseFloat(selectedOption.getAttribute("data-price"));
        var row = selectElement.parentNode.parentNode;
        var priceCell = row.querySelector('.product-price');
        var temp = price;
        priceCell.textContent = VND.format(price);
        updateSum(row);
        updateTotal();
    }

    function updateSum(inputElement) {
        var row = inputElement.parentNode.parentNode;
        var priceCell = row.querySelector('.product-price');
        var price = parseFloat(priceCell.textContent.replace(/\D/g, ''));
        var quantityInput = row.querySelector('.quantity');
        var quantity = parseInt(quantityInput.value);
        if (isNaN(quantity) || quantity <= 0) {
            quantity = 1;
            quantityInput.value = 1;
        }
        var sumCell = row.querySelector('.SumPrice');
        var sum = price * quantity;
        sumCell.textContent = VND.format(sum);
        updateTotal();
    }

    function updateTotal() {
        var sumCells = document.querySelectorAll('.SumPrice');
        var total = 0;
        sumCells.forEach(function(cell) {
            var price = parseFloat(cell.textContent.replace(/\D/g, ''));
            total += price;
        });
        var totalCell = document.getElementById('total');
        totalCell.textContent = VND.format(total);
    }

    function updateProductCount() {
        var quantityInputs = document.querySelectorAll('.quantity');
        var productCount = 0;
        quantityInputs.forEach(function(input) {
            productCount += parseInt(input.value);
        });
        var countCell = document.getElementById('productCount');
        countCell.textContent = productCount;
    }

    document.addEventListener('DOMContentLoaded', function() {
        var sizeSelects = document.querySelectorAll('.optionSize');
        sizeSelects.forEach(function(select) {
            select.addEventListener('change', function() {
                updatePrice(this);
            });
        });
        var quantityInputs = document.querySelectorAll('.quantity');
        quantityInputs.forEach(function(input) {
            input.addEventListener('change', function() {
                updateSum(this);
            });
        });
    });
</script>

<script>
    new DataTable('#Customer', {
        layout: {
            bottomEnd: {
                paging: {
                    boundaryNumbers: false
                }
            }
        }
    });
    new DataTable('#Employee', {
        layout: {
            bottomEnd: {
                paging: {
                    boundaryNumbers: false
                }
            }
        }
    });
</script>




</html>