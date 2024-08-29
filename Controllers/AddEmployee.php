<?php
require_once './Middlewares/Authentication.php';

class AddEmployee extends ControllerBase
{
    private $AuthModel;
    private $Middleware;
    public function __construct()
    {
        $this->AuthModel  = $this->Model("Authentication");
        $this->Middleware = new Middleware();
    }
    public function index()
    {
        $this->Middleware->AuthenticationAdmin($this->AuthModel);
        $this->View("index", "admin", [
            "Page" => "AddEmployeeManager",
        ]);
    }
    public function AddEmployeeAPI()
    {
        $this->Middleware->AuthenticationAdmin($this->AuthModel);
        $postData = file_get_contents("php://input");
        $jsonData = json_decode($postData, true);
        $model = $this->Model("EmployeeModel");
        $result =  $model->AddEmployee($jsonData['EmployeeName'], $jsonData['PhoneNumber'], $jsonData['Email'], $jsonData['Salary']);

        header('Content-Type: application/json; charset=utf8');
        echo json_encode([
            "Message" => "Successfully created new employee",
            "status" => 200,
        ]);
    }
}
