<h1>Thêm sản phẩm</h1>
<div>
    <div style="display: flex; justify-content: space-between;">
        <div style="width: 200px;" class="form-outline" data-mdb-input-init>
            <input type="number" min="1" value="1" id="countColumn" class="form-control" />
            <label class="form-label" for="countColumn">Số lượng sản phẩm</label>
        </div>
        <div>
            <button id="btnAdd" type="button" class="btn btn-primary" data-mdb-ripple-init>Thêm sản phẩm</button>
        </div>
    </div>
    <div id="products" style="margin-top: 30px;"></div>
</div>
<style>
    #products .itemAddProduct {
        display: flex;
        flex-wrap: wrap;
    }

    #products .itemAddProduct>div {
        flex: 1 1 100%;

    }

    #products .itemAddProduct>div>.uploadImgLIST {
        border: 1px solid blue;
        padding: 10px 20px;
        margin-bottom: 10px;
        border-radius: 8px;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    }

    #products .itemAddProduct>div:nth-child(1):nth-child(n+2):nth-child(-n+2) {
        display: flex;
        justify-content: center;
    }

    #products .itemAddProduct>div .infoProduct {
        width: 400px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 10px 0;
    }

    #products .itemAddProduct>div .infoProduct label {
        font-size: 1.4rem;
    }

    #products .itemAddProduct>div input {
        border: none;
        outline: none;
        border: 1px solid gray;
        font-size: 1.3rem;
        padding: 5px 10px;
        border-radius: 8px;
        width: 300px;
    }

    #products .itemAddProduct>div>select {
        outline: none;
        border: none;
        border: 1px solid gray;
        padding: 10px 20px;
        font-size: 1.4rem;
        border-radius: 6px;
    }

    #products .itemAddProduct>div:nth-child(4) {
        order: 1;
    }

    #products .itemAddProduct>div:nth-child(3) {
        margin: 10px 0;
        font-size: 1.4rem;
    }

    #products .itemAddProduct>div:nth-child(4) table {
        font-size: 1.4rem;
        width: 60%;
    }

    #products .itemAddProduct>div:nth-child(4) table tbody tr td {
        padding: 10px 0;
    }
</style>
<script>
    const products = document.getElementById('products');
    const countColumn = document.getElementById('countColumn');
    countColumn.addEventListener('input', function() {
        products.innerHTML = "";
        for (let i = 0; i < this.value; i++) {
            const itemAddProduct = document.createElement('div');
            itemAddProduct.classList.add('itemAddProduct');
            itemAddProduct.style.width = '100%';
            itemAddProduct.innerHTML = `
                <div>
                    <div class="uploadImgLIST">
                        <label for="imgUpload-${i}">
                            <i class="fa-solid fa-plus"></i>
                        </label>
                        <i>Tối đa 5 ảnh</i>
                        <input type="file" class="imgUpload" accept="image/*" name="imgUpload" id="imgUpload-${i}" hidden multiple ">
                        <div class="image-preview"></div>
                    </div>
                    <div class="infoProduct">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" class="ProductName" name="ProductName" placeholder="Tên sản phẩm">
                    </div>
                    <div class="infoProduct">
                        <label for="price">Giá cơ bản</label>
                        <input type="number" class="ProductPrice" name="ProductPrice" id="price"  placeholder="Giá sản phẩm"> 
                    </div>
                </div>
                <div>
                    <select name="category">
                        <option>Chọn danh mục</option>
                    </select>
                    <select name="category_Detail">
                        <option>Chọn danh mục con</option>
                    </select>
                    <select name="category_Detail_Product">
                        <option>Chọn chi tiết danh mục</option>
                     </select>
                </div>
                <div>
                    <label for="size">Kích cỡ</label>
                    <select class="sizeChoice" name="sizeChoice"></select>
                </div>
                <div>
                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <th>
                                        Kích cỡ
                                    </th>
                                    <th>Giá Tùy chọn</th>
                                </tr>
                                
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            `;

            products.appendChild(itemAddProduct);

        }
        // Hàm để xem trước ảnh

        $.ajax({
            type: "GET",
            url: "http://<?php echo $_SERVER['HTTP_HOST'] ?>/PNJSHOP/Category/GetCategory/",
            dataType: "json",
            success: function(response) {
                const category = document.querySelectorAll("select[name='category']");
                category.forEach(element => {
                    const parent = element.parentElement.parentElement;
                    const childNode = parent.querySelector("select[name='category']");
                    response.data.forEach(data => {
                        const option = document.createElement('option');
                        option.value = data.CATEGORYID;
                        option.innerHTML = data.CATEGORYNAME;
                        childNode.appendChild(option);
                    })
                })

            }
        });
        $.ajax({
            type: "GET",
            url: "http://<?php echo $_SERVER['HTTP_HOST'] ?>/PNJSHOP/Size/GetSize/",
            dataType: "json",
            success: function(response) {
                const sizes = document.querySelectorAll("select[name='sizeChoice']");
                sizes.forEach(element => {
                    const parent = element.parentElement.parentElement;
                    const childNode = parent.querySelector("select[name='sizeChoice']");
                    response.data.forEach(data => {
                        const option = document.createElement('option');
                        option.value = data.SIZEID;
                        option.innerHTML = data.DESCRIPTION_SIZE;
                        childNode.appendChild(option);
                    })
                })

            }
        });

        const Category = document.querySelectorAll("select[name='category']");
        Category.forEach(element => {
            element.addEventListener('change', (e) => {
                $.ajax({
                    type: "GET",
                    url: `http://<?php echo $_SERVER['HTTP_HOST'] ?>/PNJSHOP/Category/GetCategoryDetail/${e.target.value}`,
                    dataType: "json",
                    success: function(response) {
                        const parent = element.parentElement.parentElement;
                        const childNode = parent.querySelector("select[name='category_Detail']");
                        childNode.innerHTML = "";
                        response.data.forEach(data => {
                            const option = document.createElement('option');
                            option.value = data.CATEGORY_ATTRIBUTEID;
                            option.innerHTML = data.CATEGORY_ATTRIBUTENAME;
                            childNode.appendChild(option);
                        })

                    }
                });
            })
        })
        const Category_Detail = document.querySelectorAll("select[name='category_Detail']");
        Category_Detail.forEach(element => {
            element.addEventListener('change', (e) => {
                console.log(e.target.value);
                $.ajax({
                    type: "GET",
                    url: `http://<?php echo $_SERVER['HTTP_HOST'] ?>/PNJSHOP/Category/GetCategoryDetail_Product/${e.target.value}`,
                    dataType: "json",
                    success: function(response) {
                        console.log(response.data);
                        const parent = element.parentElement.parentElement;
                        const childNode = parent.querySelector("select[name='category_Detail_Product']");
                        childNode.innerHTML = "";
                        response.data.forEach(data => {
                            const option = document.createElement('option');
                            option.value = data.CATEGORY_ATTRIBUTES_DETAILID;
                            option.innerHTML = data.CATEGORY_ATTRIBUTES_DETAILNAME;
                            childNode.appendChild(option);
                        })

                    }
                });
            })
        })
        const allSelects = document.querySelectorAll('.sizeChoice');
        allSelects.forEach((select, index) => {
            select.addEventListener("change", (e) => {
                const parent = select.parentElement.parentElement;
                const bodyTable = parent.querySelector("tbody");
                const tr = document.createElement("tr");
                tr.innerHTML = `
                        <td>
                            <input type="text" value="${select.value}" readonly name="Size" id="">
                        </td>
                        <td>
                            <input type="number" name="priceSize" id="">
                        </td>

            `
                bodyTable.appendChild(tr);
            })
        });
        const allInputFile = document.querySelectorAll("input[name=imgUpload]");
        allInputFile.forEach((img, index) => {
            img.addEventListener("change", (e) => {
                const uploadContainer = img.parentElement.parentElement.parentElement;
                const imagePreview = uploadContainer.querySelector(".image-preview");
                const files = e.target.files;
                if (files.length > 5) {
                    alert("Tối đa 5 ảnh!")
                    return;
                }
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();

                    reader.onload = (event) => {
                        const imageUrl = event.target.result;
                        const previewImg = document.createElement("img");
                        previewImg.src = imageUrl;
                        previewImg.style.width = '100px';
                        previewImg.style.height = '100px';
                        imagePreview.appendChild(previewImg);
                    };
                    reader.readAsDataURL(file);
                }
            })
        })
    });
    const btn = document.querySelector("#btnAdd");
    btn.addEventListener("click", () => {
        const productName = document.querySelectorAll(".ProductName");
        const price = document.querySelectorAll(".ProductPrice");
        const detail = document.querySelectorAll("select[name=category_Detail_Product]");
        const products = [];
        productName.forEach((name, index) => {
            const sizes = [];
            const Images = [];
            const productNameValue = name.value.trim();
            const priceValue = price[index].value.trim();
            const detailCategory = detail[index].value;
            const sizeParent = name.parentElement.parentElement.parentElement;
            console.log(sizeParent);
            const trs = sizeParent.querySelectorAll("tbody tr");
            const imagePreviews = sizeParent.querySelectorAll(".image-preview img");
            imagePreviews.forEach((img, index) => {
                Images.push(img.src);
            });
            trs.forEach(tr => {
                const input = tr.querySelectorAll("input");
                sizes.push({
                    sizeName: input[0].value,
                    sizePrice: input[1].value,
                })
            })
            if (productNameValue !== '' && priceValue !== '') {
                products.push({
                    ProductName: productNameValue,
                    ProductPrice: priceValue,
                    ProductCategoryDetail: detailCategory,
                    Sizes: sizes,
                    Images: Images,
                });
            }
        });
        console.log(products);
        $.ajax({
            type: "POST",
            url: "http://<?php echo $_SERVER['HTTP_HOST'] ?>/PNJSHOP/AddProduct/AddNewProduct/",
            data: JSON.stringify({
                products: products,
            }),
            dataType: "json",
            contentType: "application/json",
            success: function(response) {

                console.log("return data:", response);
                if (response.status === 200) {
                    alert("Thêm sản phẩm thành công");
                    window.location.href = "../../Admin/index/";
                }
            },
            error: function(xhr, status, error) {

                console.error("Request failed: " + error);
            }
        });
    });
</script>