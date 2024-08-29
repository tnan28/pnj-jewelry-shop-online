<div id="customer_info">
    <h1>Thông tin tài khoản</h1>
    <div id="info">
        <div>
            <label for="">Họ và tên</label>
            <input id="CustomerName" readonly type="text" value="<?php echo ($data['customer']['CUSTOMERNAME']) ?>">
            <div>
                <p></p>
            </div>
        </div>
        <div>
            <label for="">Số điện thoại</label>
            <input id="CustomerPhoneNumber" readonly type="number" value="<?php echo ($data['customer']['PHONENUMBER']) ?>">
            <div>
                <p></p>
            </div>

        </div>
        <div>
            <label for="">Email</label>
            <input readonly id="CustomerEmail" type="email" value="<?php echo ($data['customer']['EMAIL']) ?>">
            <div>
                <p></p>
            </div>

        </div>
    </div>
    <div>
        <button class="Update">Chỉnh sửa</button>
        <button style="display: none;" class="save">Lưu</button>

    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    const ShowMessageError = (input, message) => {
        const parentNode = input.parentElement;
        const showMessage = parentNode.querySelector("p");
        input.style.border = "1px solid red";
        showMessage.style.color = "red";
        showMessage.style.fontSize = "1.2rem";
        showMessage.textContent = message;
    }
    const ShowMessageSuccess = (input, message) => {
        const parentNode = input.parentElement;
        const showMessage = parentNode.querySelector("p");
        input.style.border = "1px solid green";
        showMessage.textContent = "";
    }
    document.getElementById('CustomerName').addEventListener('input', validateFullName);
    document.getElementById('CustomerEmail').addEventListener('input', validateEmail);
    document.getElementById('CustomerPhoneNumber').addEventListener('input', validatePhone);

    function validateFullName() {
        const fullName = document.querySelector('#CustomerName').value;
        const fullNameRegex = /^[a-zA-ZÀ-ỹ\s]+$/;
        if (fullName.trim()) {
            if (!fullNameRegex.test(fullName)) {
                ShowMessageError(document.getElementById('CustomerName'), "Không được phép có số")
                return false;
            } else {
                ShowMessageSuccess(document.getElementById('CustomerName'), "")
                return true;
            }
        } else {
            ShowMessageError(document.getElementById('CustomerName'), "Không được phép rỗng")
            return false;
        }
    }

    function validateEmail() {
        const email = document.querySelector('#CustomerEmail').value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (email.trim()) {
            if (!emailRegex.test(email)) {
                ShowMessageError(document.getElementById('CustomerEmail'), "Không phải định đạng của Email!")
                return false;
            } else {
                ShowMessageSuccess(document.getElementById('CustomerEmail'), "")
                return true;
            }
        } else {
            ShowMessageError(document.getElementById('CustomerEmail'), "Không được phép để trống!")
            return false;
        }
    }

    function validatePhone() {
        const phone = document.getElementById('CustomerPhoneNumber').value;
        const phoneRegex = /(84|0[3|5|7|8|9])+([0-9]{8})\b/g;

        if (phone.trim()) {
            if (!phoneRegex.test(phone)) {
                ShowMessageError(document.getElementById('CustomerPhoneNumber'), "Không phải định đạng số điện thoại!")
                return false;
            } else {
                ShowMessageSuccess(document.getElementById('CustomerPhoneNumber'), "")
                return true;
            }
        } else {
            ShowMessageError(document.getElementById('CustomerPhoneNumber'), "Không được phép để trống!")
            return false;
        }
    }
</script>
<script>
    const update = document.querySelector(".Update");
    const name = document.querySelector("#CustomerName")
    const phone = document.querySelector("#CustomerPhoneNumber")
    const email = document.querySelector("#CustomerEmail")
    const save = document.querySelector(".save");

    update.addEventListener("click", () => {
        save.style.display = "block";
        update.style.display = "none";
        name.readOnly = false;
        phone.readOnly = false;
        email.readOnly = false;
        name.focus();
    });
    save.addEventListener("click", () => {
        if (validateEmail() && validateFullName() && validatePhone()) {
            $.ajax({
                type: "POST",
                url: "http://localhost:8080/PNJSHOP/Customer/CreateAccountAPI/",
                data: JSON.stringify({
                    CUSTOMERNAME: name.value,
                    PHONENUMBER: phone.value,
                    EMAIL: email.value,
                }),
                dataType: "json",
                success: function(response) {
                    if (response.status = 200) {
                        save.style.display = "none";
                        update.style.display = "block";
                        name.readOnly = true;
                        phone.readOnly = true;
                        email.readOnly = true;
                        alert("Cập nhật thành công!");
                    }

                }
            });

        }
    })
</script>
<style>
    #customer_info h1 {
        font-size: 1.4rem;
    }

    #customer_info #info {
        display: flex;
        flex-direction: column;
    }

    #customer_info #info>div {
        display: flex;
        margin: 10px;
        flex-direction: column;
    }

    #customer_info>div>div input {
        outline: none;
        border: none;
        font-size: 1.2rem;
        border: 1px solid gray;
        border-radius: 8px;
        padding: 5px 10px;
        width: 50%;
    }

    #customer_info button {
        outline: none;
        border: none;
        padding: 10px 20px;
        font-size: 1.2rem;
        border-radius: 8px;
        background-color: blue;
        color: white;
    }
</style>