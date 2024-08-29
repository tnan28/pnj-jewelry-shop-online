<?php
require_once './Middlewares/Authentication.php';
class AddProduct extends ControllerBase
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
        $this->View("index", "Admin", [
            "Page" => "AddProductManager",
        ]);
    }
    public function SearchProduct()
    {
        $this->Middleware->AuthenticationAdmin($this->AuthModel);
        $keySearch = $_POST['keySearch'] ?? "";
        $modelProduct = $this->Model("ProductManagerModel");
        $result = $modelProduct->SearchProduct($keySearch);
        header('Content-type: application/json');
        echo json_encode(["data" => $result]);
    }

    public function AddNewProduct()
    {
        $this->Middleware->AuthenticationAdmin($this->AuthModel);
        $postData = file_get_contents("php://input");
        $jsonData = json_decode($postData, true);
        $modelProduct = $this->Model("ProductManagerModel");
        $result =  $modelProduct->AddProduct($jsonData['products']);
        header('Content-type: application/json');
        echo json_encode([
            "Message" => "Thêm thành công",
            "status" => 200
        ]);
    }
}
