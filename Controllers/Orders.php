<?php

require_once './Middlewares/Authentication.php';

class Orders extends ControllerBase
{
    private $OrderModel;
    private $AuthModel;
    private $Middleware;
    public function __construct()
    {
        $this->AuthModel  = $this->Model("Authentication");
        $this->Middleware = new Middleware();
        $this->OrderModel = $this->Model("OrderModel");
    }
    public function index()
    {
        $this->Middleware->AuthenticationAdmin($this->AuthModel);
        $result = $this->OrderModel->GetAll();
        $this->View("index", "Admin", [
            "Page" => "OrderManager",
            "Orders" => $result,
        ]);
    }
    public function StatusOrder()
    {
        $this->Middleware->AuthenticationAdmin($this->AuthModel);
        $postData = file_get_contents("php://input");
        $jsonData = json_decode($postData, true);
        $this->OrderModel->AcceptStatusOrder($jsonData['ID'], (int)$jsonData['Status']);
        header('Content-Type: application/json; charset=utf8');
        echo json_encode([
            "Message" => "Success",
            "Status" => 200,
        ]);
    }
}
