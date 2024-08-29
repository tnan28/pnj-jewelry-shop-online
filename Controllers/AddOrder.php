<?php
require_once './Middlewares/Authentication.php';
session_start();
class AddOrder extends ControllerBase
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

        $modelPayment = $this->Model("PaymentModel");
        $products = isset($_SESSION['products']) ? $_SESSION['products'] : array();
        $this->View("index", "Admin", [
            "Page" => "AddOrderManager",
            "Products" => $products,
            "Payments" => $modelPayment->GetAll(),
        ]);
    }

    public function AddProduct($id)
    {
        $this->Middleware->AuthenticationAdmin($this->AuthModel);

        $modelPayment = $this->Model("PaymentModel");
        $modelProduct = $this->Model("Product");
        $list = $modelProduct->GetProductByID($id);

        if (!isset($_SESSION['products'])) {
            $_SESSION['products'] = array();
        }

        array_push($_SESSION['products'], $list);

        $this->View("index", "Admin", [
            "Page" => "AddOrderManager",
            "Products" => $_SESSION['products'],
            "Payments" => $modelPayment->GetAll(),

        ]);
    }
    public function DeleteOrderDetail($index)
    {
        $this->Middleware->AuthenticationAdmin($this->AuthModel);
        if (isset($_SESSION['products']) && isset($_SESSION['products'][$index])) {
            unset($_SESSION['products'][$index]);
            $_SESSION['products'] = array_values($_SESSION['products']);
        }

        $this->index();
    }
}
