<?php
class Home extends ControllerBase
{
    public function index()
    {
        $modelProduct = $this->Model("Product");
        $pagination = $modelProduct->Pagination();
        $products = $modelProduct->GetProductPagination(1, 8);
        $this->View("index", "Home", [
            "Page" => "Product",
            "Pagination" => $pagination,
            "Products" => $products,
            "CurrentPage" => 1,
        ]);
    }
    public function Category($id)
    {
        $modelProduct = $this->Model("Product");
        $products = $modelProduct->GetProductPaginationByIDCategory($id, 1, 8);
        $pagination = $modelProduct->PaginationIDCategory($id);

        $this->View("index", "Home", [
            "Page" => "ProductCategory",
            "Pagination" => $pagination,
            "Products" => $products,
            "CurrentPage" => 1,
            "ID" => $id,

        ]);
    }
    public function CategoryPage($id)
    {
        $page = $_GET['page'];
        $pageNumber = (int)$page;
        $modelProduct = $this->Model('Product');
        $products = $modelProduct->GetProductPaginationByIDCategory($id, $pageNumber, 8);
        $pagination = $modelProduct->PaginationIDCategory($id);
        $this->View("index", "Home", [
            "Page" => "ProductCategory",
            "Products" => $products,
            "Pagination" => $pagination,
            "CurrentPage" => $pageNumber,
            "ID" => $id,
        ]);
    }
    public function Page($page)
    {
        $pageNumber = (int)$page;
        $modelProduct = $this->Model('Product');
        $products = $modelProduct->GetProductPagination($pageNumber, 8);
        $pagination = $modelProduct->Pagination();
        $this->View("index", "Home", [
            "Page" => "Product",
            "Products" => $products,
            "Pagination" => $pagination,
            "CurrentPage" => $pageNumber
        ]);
    }
    public function SearchProductAPI()
    {
        $postData = file_get_contents("php://input");
        $jsonData = json_decode($postData, true);
        $modelProduct = $this->Model("Product");
        $result = $modelProduct->SearchProduct($jsonData['keySearch']);
        header('Content-Type: application/json; charset=utf8');
        echo json_encode([
            "Status" => 200,
            "Products" => $result,
        ]);
    }
}
