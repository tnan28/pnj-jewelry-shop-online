<?php
require_once './Middlewares/Authentication.php';

class AddPurchaseInvoice extends ControllerBase
{
    private $ProductModel;
    private $PurchaseInvoiceManagerModel;
    private $AuthModel;
    private $Middleware;
    public function __construct()
    {
        $this->AuthModel  = $this->Model("Authentication");
        $this->Middleware = new Middleware();
        $this->ProductModel = $this->Model('ProductManagerModel');
        $this->PurchaseInvoiceManagerModel = $this->Model('PurchaseInvoiceModel');
    }
    public function index()
    {
        $this->Middleware->AuthenticationAdmin($this->AuthModel);

        $this->View("index", "Admin", [
            "Page" => "AddPurchaseinvoiceManager",
            "Products" => $this->ProductModel->GetAllProducts(),
        ]);
    }
    public function CreatePurchaseInvoice()
    {
        $this->Middleware->AuthenticationAdmin($this->AuthModel);
        $postData = file_get_contents("php://input");
        $jsonData = json_decode($postData, true);
        $this->PurchaseInvoiceManagerModel->CreatePurchaseInvoice($jsonData);
        header('Content-Type: application/json; charset=utf8');
        echo json_encode([
            "Message" => "Successfully created purchase invoice",
            "status" => "success"
        ]);
    }
}
