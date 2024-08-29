<?php
require_once './Middlewares/Authentication.php';

class DetailProductManager extends ControllerBase
{
    private $AuthModel;
    private $Middleware;
    public function __construct()
    {
        $this->AuthModel  = $this->Model("Authentication");
        $this->Middleware = new Middleware();
    }
    public function index($id)
    {
        $this->Middleware->AuthenticationAdmin($this->AuthModel);
        $model = $this->Model("ProductManagerModel");
        $category = $model->GetCategoryByProductID($id);
        $ProductSize = $model->GetProductByID($id);
        $result = $model->DetailProduct($id);
        $this->View("index", "admin", [
            "Page" => "DetailProductManager",
            "Products" => $result,
            "Category" => $category,
            "ProductSize" => $ProductSize,
            "Category" => $category,
        ]);
    }
}
