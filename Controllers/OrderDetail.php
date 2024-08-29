<?php
require_once './Middlewares/Authentication.php';

class OrderDetail extends ControllerBase
{
    private $AuthModel;
    private $Middleware;
    public function __construct()
    {
        $this->AuthModel  = $this->Model("Authentication");
        $this->Middleware = new Middleware();
    }
    public function OrderDetailID($id)
    {
        $this->Middleware->AuthenticationAdmin($this->AuthModel);
        $model = $this->Model("OrderModel");
        $Products = $model->DetailOrder_GetDetailProduct($id);
        $Users = $model->DetailOrder_GetInfoUser($id);
        $Payment = $model->DetailOrder_GetPaymentMethod($id);
        $this->View("index", "Admin", [
            "Page" => "OrderDetailManager",
            "Products" => $Products,
            "Users" => $Users,
            "Payment" => $Payment,
        ]);
    }
}
