<?php
require_once './Middlewares/Authentication.php';

class Employee extends ControllerBase
{
    private $employeeModel;
    private $AuthModel;
    private $Middleware;
    public function __construct()
    {
        $this->AuthModel  = $this->Model("Authentication");
        $this->Middleware = new Middleware();
        $this->employeeModel = $this->Model("EmployeeModel");
    }
    public function index()
    {
        $this->Middleware->AuthenticationAdmin($this->AuthModel);
        $EmployeeList = $this->employeeModel->GetAll();
        $this->View("index", "Admin", [
            "Page" => "EmployeeManager",
            "EmployeeList" => $EmployeeList,
        ]);
    }
    public function DeleteEmployee($id)
    {
        $this->Middleware->AuthenticationAdmin($this->AuthModel);
        $this->employeeModel->RemoveEmployee($id);
        $this->index();
    }
    public function DetailEmployee($id)
    {
        $this->Middleware->AuthenticationAdmin($this->AuthModel);
        $this->View("index", "Admin", [
            "Page" => "UpdateEmployeeManager",
            "Employee" => $this->employeeModel->GetEmployeeById($id)
        ]);
    }
    public function UpdateEmployee()
    {
        $this->Middleware->AuthenticationAdmin($this->AuthModel);
        $postData = file_get_contents("php://input");
        $jsonData = json_decode($postData, true);
        $this->employeeModel->UpdateEmployee($jsonData['ID'], $jsonData['EmployeeName'], $jsonData['PhoneNumber'], $jsonData['Email'], $jsonData['Salary']);
        header('Content-Type: application/json; charset=utf8');
        echo json_encode([
            "Message" => "Successfully Update employee",
            "status" => 200,
        ]);
    }
}
