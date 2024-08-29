<?php
require_once './Middlewares/Authentication.php';

class PurchaseInvoice extends ControllerBase
{
    private $PurchaseInvoiceModel;
    private $AuthModel;
    private $Middleware;
    public function __construct()
    {
        $this->AuthModel  = $this->Model("Authentication");
        $this->Middleware = new Middleware();
        $this->PurchaseInvoiceModel = $this->Model("PurchaseInvoiceModel");
    }
    public function index()
    {
        $this->Middleware->AuthenticationAdmin($this->AuthModel);

        $result = $this->PurchaseInvoiceModel->GetAllPurChaseInvoice();
        $this->View('index', 'Admin', [
            "Page" => "PurchaseInvoiceManager",
            "PurchaseInvoices" => $result,
        ]);
    }
    public function LoadSupplierAPI()
    {
        $this->Middleware->AuthenticationAdmin($this->AuthModel);

        $result = $this->PurchaseInvoiceModel->LoadSupplierAPI();
        header('Content-type: application/json');
        echo json_encode(["data" => $result]);
    }
    public function Confirm_delivery($id)
    {
        $this->Middleware->AuthenticationAdmin($this->AuthModel);

        $this->PurchaseInvoiceModel->Confirm_delivery($id);
        $this->index();
    }
    public function Detail($id)
    {
        $model = $this->Model("PurchaseInvoiceModel");
        $PurchaseInvoice = $model->GetPurchaseInvoiceByID($id);
        $PurchaseInvoiceDetail = $model->GetPurchaseInvoiceByDetailByID($id);
        $this->View("index", "Admin", [
            "Page" => "DetailInvoice",
            "PurchaseInvoice" => $PurchaseInvoice,
            "PurchaseInvoiceDetail" => $PurchaseInvoiceDetail,
        ]);
    }
}
