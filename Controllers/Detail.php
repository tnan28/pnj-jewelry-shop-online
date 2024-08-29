<?php

class Detail extends ControllerBase
{
    public function ProductId($id)
    {
        $modelProduct = $this->Model("Product");
        $product = $modelProduct->GetProductByID($id);
        $this->View("index", "Home", [
            "Page" => "Detail",
            "Product" => $product,
        ]);
    }
}
