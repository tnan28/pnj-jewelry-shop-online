<?php

require_once './Middlewares/Authentication.php';

class UpdateProduct extends ControllerBase
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
        $postData = file_get_contents("php://input");
        $jsonData = json_decode($postData, true);
        $model = $this->Model('ProductManagerModel');
        $model->UpdateProduct($jsonData['PRODUCTID'], $jsonData['PRODUCTNAME'], $jsonData['PRICE'], $jsonData['SIZES']);
        header('Content-Type: application/json; charset=utf8');

        echo json_encode([
            "Message" => "Cập nhật thành công",
            "status" => 200
        ]);
    }
}
