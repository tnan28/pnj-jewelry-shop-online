<?php

require_once './Middlewares/Authentication.php';

class CustomerManager extends ControllerBase
{
    private $CustomerModel;
    private $AuthModel;
    private $Middleware;
    public function __construct()
    {
        $this->AuthModel  = $this->Model("Authentication");
        $this->Middleware = new Middleware();
        $this->CustomerModel = $this->Model("CustomerModel");
    }
    public function index()
    {
        $this->Middleware->AuthenticationAdmin($this->AuthModel);
        $result = $this->CustomerModel->GetAll();
        $this->View("index", "Admin", [
            "Page" => "CustomerManager",
            "Customers" => $result
        ]);
    }
}
