<div id="DetailManager">
    <h1>Chi tiết sản phẩm</h1>
    <div id="img">
        <div>
            <img src="../../Public/Image/Products/<?php echo $data['Products'][0]['IMAGE_1'] ?>" alt="">
        </div>
        <div>
            <img src="../../Public/Image/Products/<?php echo $data['Products'][0]['IMAGE_2'] ?>" alt="">
        </div>
        <div>
            <img src="../../Public/Image/Products/<?php echo $data['Products'][0]['IMAGE_3'] ?>" alt="">
        </div>
        <div>
            <img src="../../Public/Image/Products/<?php echo $data['Products'][0]['IMAGE_4'] ?>" alt="">
        </div>
        <div>
            <img src="../../Public/Image/Products/<?php echo $data['Products'][0]['IMAGE_5'] ?>" alt="">
        </div>
    </div>
    <div style="display: flex;">
        <div id="info_product">
            <div>
                <label for="">Tên sản phẩm</label>
                <input id="productName" type="text" value="<?php echo $data['Products'][0]['PRODUCTNAME'] ?>">
                <p></p>
            </div>
            <div>
                <label for="">Giá</label>
                <input id="price" type="number" value="<?php echo $data['Products'][0]['PRICE'] ?>">
                <p></p>
            </div>

            <div>
                <label for="">Danh Mục: <?php echo $data['Category'][0]->CATEGORY_ATTRIBUTES_DETAILNAME ?></label>
            </div>
        </div>
        <div style=" margin-left: 30px; margin-top: 32px;" id="tableSize">
            <label style="font-size: 1.3rem;" for="">Bảng chi tiết kích cỡ sản phẩm</label>
            <table>
                <thead>
                    <th>Kích cỡ</th>
                    <th>Giá</th>
                    <th>Số lượng tồn</th>

                </thead>
                <tbody>
                    <?php foreach ($data['ProductSize'] as $productSize) : ?>
                        <tr>
                            <td>
                                <?php echo $productSize->DESCRIPTION_SIZE ?>
                            </td>
                            <td>
                                <input data-id="<?php echo ($productSize->PRODUCT_SIZEID) ?>" id="SizeID" style="width: 200px;" type="number" value="<?php echo (int) $productSize->PRICE ?>">
                                <p></p>
                            </td>
                            <td><?php echo $productSize->QUANTITY ?></td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
    <div>
        <button id="UpdateProduct" style="font-size: 1.2rem; padding: 10px 20px; width: 300px;" type="button" class="btn btn-primary" data-mdb-ripple-init>
            Sửa sản phẩm
        </button>
    </div>
</div>
<script>
    const Update = document.querySelector("#UpdateProduct");
    const isValid = (input) => {
        const parent = input.parentElement;
        const p = parent.querySelector("p")
        if (input.value.trim()) {
            p.textContent = "";
            return true;
        } else {
            p.style.color = "red";
            p.textContent = "Không được để trống";
            return false;
        }
    }
    Update.addEventListener("click", () => {
        const productName = document.querySelector("#productName");
        const price = document.querySelector("#price");
        const ProductPriceSize = document.querySelectorAll("#SizeID");
        let data = {
            PRODUCTID: null,
            PRODUCTNAME: null,
            PRICE: null,
            SIZES: []
        };
        let isValidProductSize = true;
        ProductPriceSize.forEach(value => {
            if (isValid(value)) {
                data.SIZES.push({
                    PRODUCTSIZEID: value.getAttribute('data-id'),
                    PRICE: value.value
                });
            } else {
                isValidProductSize = false
            }
        });
        isValid(productName);
        isValid(price);
        const check = isValid(productName) && isValid(price) && isValidProductSize ? true : false;
        if (!check) {

        } else {
            data.PRODUCTID = "<?php echo $data['Products'][0]['PRODUCTID'] ?>"
            data.PRODUCTNAME = productName.value;
            data.PRICE = price.value;
            $.ajax({
                type: "POST",
                url: "http://localhost:8080/PNJSHOP/UpdateProduct/index/",
                contentType: "application/json",
                data: JSON.stringify(data),
                success: function(response) {
                    console.log(response);
                    if (response.status == 200) {
                        alert("Chỉnh sửa sản phẩm thành công!");
                        window.location.href = "../../Admin/index/";
                    }
                }
            });
        }


    });
</script>
<style>
    #DetailManager #UpdateProduct {
        outline: none;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        color: white;
    }

    #DetailManager #img {
        display: flex;
        justify-content: space-between;
    }

    #DetailManager table {
        border-collapse: collapse;
        width: 206%;
        font-size: 1.3rem;
    }

    #DetailManager th,
    #DetailManager td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 10px;
        text-align: center;

    }

    #DetailManager th {
        background-color: #f2f2f2;
    }

    #DetailManager tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #DetailManager tr:hover {
        background-color: #dddddd;
    }

    #DetailManager #img img {
        width: 200px;
        height: 200px;
    }

    #DetailManager input,
    #DetailManager select {
        font-size: 1.2rem;
        padding: 5px 10px;
        outline: none;
        border: none;
        border: 1px solid gray;
        border-radius: 8px;
    }

    #DetailManager #info_product {
        margin-top: 20px;
    }

    #DetailManager #info_product div {
        margin: 10px 0;
        width: 300px;
        display: flex;
        flex-direction: column;
        font-size: 1.3rem;

    }
</style>