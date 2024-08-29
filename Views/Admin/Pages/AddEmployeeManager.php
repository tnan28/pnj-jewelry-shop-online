<div class="AddEmployee" style="display: flex;justify-content: center; flex-direction: column; width: 100%; align-items: center;">
    <div>
        <h1>
            Thêm nhân viên
        </h1>
    </div>
    <form action="">
        <div>
            <div>
                <label for="">Họ và tên</label>
                <input type="text" placeholder="Họ và tên" id="EMPLOYEENAME">
            </div>
            <p></p>
        </div>
        <div>
            <div>
                <label for="">EMAIL</label>
                <input type="text" placeholder="EMAIL" id="EMAIL">

            </div>
            <p></p>
        </div>

        <div>
            <div>
                <label for="">Số điện thoại</label>
                <input type="text" placeholder="Số điện thoại" id="PHONENUMBER">

            </div>
            <p></p>
        </div>
        <div>
            <div>
                <label for="">Lương</label>
                <input type="number" placeholder="Salary" id="SALARY">
            </div>
            <p></p>
        </div>
        <div class="button_Submit">
            <button>Thêm nhân viên</button>
        </div>
    </form>
</div>
<style>
    .AddEmployee {
        border-radius: 20px;
        justify-content: center;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        padding: 10px 0;
    }

    .AddEmployee form {
        display: flex;
        flex-wrap: wrap;
        width: 70%;
        gap: 30px;
        margin-top: 10px;
    }

    .AddEmployee form div>div {
        width: 400px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .AddEmployee form div label {
        font-size: 1.6rem;
        font-weight: bold;

    }

    .AddEmployee form div input {
        outline: none;
        border: none;
        border-radius: 8px;
        padding: 10px 15px;
        width: 300px;
        border: 1px solid #ccc;
        font-size: 1.4rem;
    }

    .AddEmployee form div input:focus {
        border: 1px solid blue;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    }

    .AddEmployee .button_Submit {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .AddEmployee .button_Submit button {
        outline: none;
        border: none;
        background-color: none;
        padding: 10px 20px;
        font-size: 1.4rem;
        border-radius: 8px;
        border: 1px solid blue;
        color: black;
        transition: .6s;
    }

    .AddEmployee .button_Submit button:hover {
        background-color: blue;
        color: white;
    }
</style>
<script>
    const ShowMessageError = (input, message) => {
        const parentNode = input.parentElement.parentElement;
        const showMessage = parentNode.querySelector("p");
        input.style.border = "1px solid red";
        showMessage.style.color = "red";
        showMessage.style.fontSize = "1.2rem";
        showMessage.textContent = message;
    }
    const ShowMessageSuccess = (input, message) => {
        const parentNode = input.parentElement.parentElement;
        const showMessage = parentNode.querySelector("p");
        input.style.border = "1px solid green";
        showMessage.textContent = "";
    }
    document.getElementById('EMPLOYEENAME').addEventListener('input', validateFullName);
    document.getElementById('EMAIL').addEventListener('input', validateEMAIL);
    document.getElementById('PHONENUMBER').addEventListener('input', validatePhone);
    document.getElementById('SALARY').addEventListener('input', validateSalary);


    function validateSalary() {
        const salary = document.querySelector('#SALARY').value;
        if (salary.trim()) {
            ShowMessageSuccess(document.getElementById('SALARY'), "")
            return true;
        } else {
            ShowMessageError(document.getElementById('SALARY'), "Không được phép để trống")
            return false;
        }
    }

    function validateFullName() {
        const fullName = document.querySelector('#EMPLOYEENAME').value;
        const fullNameRegex = /^[a-zA-ZÀ-ỹ\s]+$/;
        if (fullName.trim()) {
            if (!fullNameRegex.test(fullName)) {
                ShowMessageError(document.getElementById('EMPLOYEENAME'), "Không được phép có số")
                return false;
            } else {
                ShowMessageSuccess(document.getElementById('EMPLOYEENAME'), "")
                return true;
            }
        } else {
            ShowMessageError(document.getElementById('EMPLOYEENAME'), "Không được phép để trống!")
            return false;
        }
    }

    function validateEMAIL() {
        const EMAIL = document.querySelector('#EMAIL').value;
        const EMAILRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (EMAIL.trim()) {
            if (!EMAILRegex.test(EMAIL)) {
                ShowMessageError(document.getElementById('EMAIL'), "Không phải định đạng của EMAIL!")
                return false;
            } else {
                ShowMessageSuccess(document.getElementById('EMAIL'), "")
                return true;
            }
        } else {
            ShowMessageError(document.getElementById('EMAIL'), "Không được phép để trống!")
            return false;
        }
    }

    function validatePhone() {
        const phone = document.getElementById('PHONENUMBER').value;
        const phoneRegex = /(84|0[3|5|7|8|9])+([0-9]{8})\b/g;

        if (phone.trim()) {
            if (!phoneRegex.test(phone)) {
                ShowMessageError(document.getElementById('PHONENUMBER'), "Không phải định đạng số điện thoại!")
                return false;
            } else {
                ShowMessageSuccess(document.getElementById('PHONENUMBER'), "")
                return true;
            }
        } else {
            ShowMessageError(document.getElementById('PHONENUMBER'), "Không được phép để trống!")
            return false;
        }
    }
    document.querySelector('.button_Submit').addEventListener('click', (e) => {
        e.preventDefault();
        validateEMAIL();
        validateFullName();
        validatePhone();
        validateSalary();
        if (validateEMAIL() && validateFullName() && validatePhone() && validateSalary()) {
            const EMPLOYEENAME = document.getElementById('EMPLOYEENAME').value;
            const EMAIL = document.getElementById('EMAIL').value;
            const PHONENUMBER = document.getElementById('PHONENUMBER').value;
            const SALARY = document.getElementById('SALARY').value;
            $.ajax({
                type: "POST",
                url: "http://localhost:8080/PNJSHOP/AddEmployee/AddEmployeeAPI/",
                data: JSON.stringify({
                    EmployeeName: EMPLOYEENAME,
                    Email: EMAIL,
                    PhoneNumber: PHONENUMBER,
                    Salary: SALARY,
                }),
                dataType: "json",
                success: function(response) {
                    if (response.status == 200) {
                        window.location.href = "../../Employee/index/";
                    }
                }
            });
        }
    })
</script>