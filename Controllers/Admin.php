<?php
require_once './Middlewares/Authentication.php';
class Admin extends ControllerBase
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
        $model = $this->Model("ProductManagerModel");
        $data = $model->GetAllProduct();
        $this->View("index", "Admin", [
            "Page" => "ProductsManager",
            "Products" => $data,
        ]);
    }
    public function DeleteProduct()
    {
        $this->Middleware->AuthenticationAdmin($this->AuthModel);

        $productID = $_POST['ProductID'];
        $model = $this->Model("ProductManagerModel");
        $data = $model->DeleteProduct($productID);
        $this->index();
    }
    public function DetailProduct($id)
    {
        $this->Middleware->AuthenticationAdmin($this->AuthModel);

        $model = $this->Model("ProductManagerModel");
        $data = $model->DetailProduct($id);
        $this->View("index", "Admin", [
            "Page" => "DetailProductManager",
            "Product" => $data,
        ]);
    }
    public function SearchProduct()
    {
        $this->Middleware->AuthenticationAdmin($this->AuthModel);
        $keySearch = $_POST['keySearch'];
        if (!empty($keySearch)) {
            $model = $this->Model("ProductManagerModel");
            $data = $model->SearchProduct($keySearch);
            $this->View("index", "Admin", [
                "Page" => "ProductsManager",
                "Products" => $data,
            ]);
        } else {
            $this->index();
        }
    }
}
