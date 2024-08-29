<style>
    #Purchase {
        display: flex;
        align-items: center;
    }

    #Purchase p {
        font-size: 1.3rem;

    }

    #Purchase select {
        border: none;
        outline: none;
        font-size: 1.3rem;
        padding: 10px 8px;
        border: 1px solid gray;
        border-radius: 10px;
        margin-left: 10px;
    }

    #PurchaseInvoiceManager {
        font-size: 1.2rem;
    }

    #order .productName {
        font-weight: bold;
    }

    #order ul div {
        display: flex;
        flex-direction: column;
    }

    #order ul div li {
        margin: 10px 0;
        display: flex;
        justify-content: space-between;
        width: 250px;
        font-size: 1.4rem;
        align-items: center;
    }

    #order ul div li input {
        outline: none;
        border: none;
        border-radius: 8px;
        border: 1px solid gray;
        padding: 6px 8px;
        margin-left: 0;
    }
</style>
<h1>Nhập hàng</h1>
<div id="Purchase" style="display: flex; align-items: center;">
    <p>Chọn nhà cung cấp</p>
    <select name="" id="supplier"></select>
</div>
<div id="PurchaseInvoiceManager">
    <div style="display: flex; justify-content: space-between;">
        <div style="margin-right: 30px; width: 900px;">
            <h5>Sản phẩm</h5>
            <div>
                <button type="button" id="generateInvoiceBtn" class="btn btn-primary" data-mdb-ripple-init>Thêm vào hóa đơn</button>
            </div>
            <table id="PurchaseInvoice">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="" id="checkAllProducts"></th>
                        <th>Tên sản phẩm</th>
                        <th>Kích cỡ</th>
                        <th>Số lượng trong kho</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['Products'] as $product) : ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="" class="productCheckbox">
                            </td>
                            <td data-id="<?php echo $product['PRODUCT_SIZEID'] ?>">
                                <?php echo ($product['PRODUCTNAME']) ?>
                            </td>
                            <td><?php echo ($product['DESCRIPTION_SIZE']) ?></td>
                            <td><?php echo ($product['QUANTITY']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div style="width: calc(100% - 680px);">
            <h3>Hóa đơn nhập hàng</h3>
            <div id="order"></div>
            <div>
                <button type="button" id="createOrder" class="btn btn-primary" data-mdb-ripple-init>Tạo hóa đơn</button>
            </div>
        </div>
    </div>

</div>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script>
    new DataTable('#PurchaseInvoice');
    new DataTable('#PurchaseInvoiceA');
    new DataTable('#PurchaseInvoiceB');
</script>
<script>
    $.ajax({
        type: "GET",
        url: "http://<?php echo $_SERVER['HTTP_HOST'] ?>/PNJSHOP/PurchaseInvoice/LoadSupplierAPI/",
        dataType: "json",
        success: function(response) {
            console.log(response.data);
            const data = response.data;

            data.forEach(value => {
                const option = document.createElement("option");
                option.setAttribute('value', value.SUPPLIERID)
                option.innerText = value.SUPPLIERNAME;
                document.querySelector("#supplier").appendChild(option);
            })
        }
    });

    const checkAll = (checkAll, ListCheckBox) => {
        checkAll.addEventListener('change', function() {
            ListCheckBox.forEach(checkbox => {
                checkbox.checked = checkAll.checked;
            });
        });
    }
    const checkProduct = (checkAll, ListCheckBox) => {
        ListCheckBox.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var allChecked = true;
                ListCheckBox.forEach(function(checkbox) {
                    if (!checkbox.checked) {
                        allChecked = false;
                    }
                });
                checkAll.checked = allChecked;
            });
        });
    }
    const LoadProducts = (selectedProducts) => {
        const productRows = document.getElementById('order');
        productRows.innerHTML = "";
        selectedProducts.forEach(select => {
            const row = document.createElement('ul');
            row.innerHTML = `
                <li class="productName" data-id="${select.productId}">${select.productName}</li>
                <li>Kích cỡ: <b>${select.productSize}</b></li>
                <div>
                    <li>
                        <label>Số lượng</label>
                        <input class="quantity" type="number" name="" id="">
                    </li>
                    <li>
                        <label>Giá</label>
                        <input class="price" type="number" name="" id="">
                    </li>
                </div>
                <li>Xóa</li>
    `;
            productRows.appendChild(row);
        });
    }
    const isProductExists = (productId, productList) => {
        return productList.some(product => product.productId === productId);
    }

    var selectedProducts = [];

    const isCheckBox = (id, ListCheckBox) => {
        document.getElementById(id).addEventListener('click', () => {
            ListCheckBox.forEach(checkbox => {
                if (checkbox.checked) {
                    var productRow = checkbox.parentNode.parentNode;
                    var productId = productRow.cells[1].getAttribute('data-id');
                    var productName = productRow.cells[1].textContent.trim();
                    var productSize = productRow.cells[2].textContent.trim();
                    if (!isProductExists(productId, selectedProducts)) {
                        selectedProducts.push({
                            productId,
                            productName,
                            productSize
                        });
                    }
                }
            });
            LoadProducts(selectedProducts);
        });
    }

    const checkAllCheckboxProduct = document.getElementById('checkAllProducts');
    const productCheckboxes = document.querySelectorAll('.productCheckbox');
    checkAll(checkAllCheckboxProduct, productCheckboxes);
    checkProduct(checkAllCheckboxProduct, productCheckboxes);
    isCheckBox("generateInvoiceBtn", productCheckboxes);
    document.getElementById("createOrder").addEventListener('click', () => {
        const CreateOrder = {};
        const supplier = document.getElementById('supplier').value;
        const arrProduct = [];
        selectedProducts.forEach((select, index) => {
            const quality = document.querySelectorAll('.quantity');
            const price = document.querySelectorAll('.price');

            arrProduct.push({
                productId: select.productId,
                quality: quality[index].value,
                price: price[index].value
            });
        })
        CreateOrder.supplier = supplier;
        CreateOrder.products = arrProduct;
        // call api
        console.log(JSON.stringify({
            orders: CreateOrder
        }));
        $.ajax({
            type: "POST",
            url: "http://<?php echo $_SERVER['HTTP_HOST'] ?>/PNJSHOP/AddPurchaseInvoice/CreatePurchaseInvoice/",
            data: JSON.stringify({
                orders: CreateOrder,
            }),
            dataType: "json",
            contentType: "application/json",
            success: function(response) {
                console.log("return data:", response);
                if (response.status = "success") {
                    window.location.href = "../../PurchaseInvoice/index/";
                }
            },
            error: function(xhr, status, error) {

                console.error("Request failed: " + error);
            }
        });
    })
</script>