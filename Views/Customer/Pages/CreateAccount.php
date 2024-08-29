<div style="width: 100%;">
    <div class="customer_header-home">
        <h2 class="menu-item">Đăng ký tài khoản</h2>
    </div>
    <div class="customer_content-home ">
        <div class="customer_left-home ">
            <div class="info-top">
            </div>
            <div class="info-bot">
                <div>
                    <label for="name">Họ và tên</label>
                    <input type="text" id="Name">
                </div>
                <div>
                    <label for="Email">Địa chỉ email</label>
                    <input type="text" id="Email">
                </div>
            </div>
            <div style="display: flex; justify-content: center;">
                <button id="registerAcc">Đăng ký tài khoản</button>
            </div>
        </div>

    </div>
</div>
<style>
    #registerAcc {
        padding: 10px 20px;
        border: none;
        outline: none;
        border-radius: 8px;
        border: 1px solid rgb(0, 0, 0, 0.5);
        background-color: blue;
        color: white;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php session_start(); ?>
<script>
    document.querySelector("#registerAcc").addEventListener("click", () => {
        const name = document.querySelector("#Name");
        const Email = document.querySelector("#Email");
        const PhoneNumber = "<?php echo $_SESSION['phoneNumber'] ?>";

        $.ajax({
            type: "POST",
            url: "http://localhost:8080/PNJSHOP/Customer/CreateAccountAPILogin/",
            data: JSON.stringify({
                CUSTOMERNAME: name.value,
                EMAIL: Email.value,
                PHONENUMBER: PhoneNumber,
            }),
            success: function(response) {
                if (response.status === 200) {
                    alert("Tạo tài khoản thành công");
                    window.location.href = "../../Customer/index/";
                }
            }
        });

    })
</script>