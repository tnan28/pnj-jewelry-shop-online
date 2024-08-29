<?php

class ProductManagerModel extends ModelBase
{
    public function GetAllProduct()
    {
        $query = "SELECT * FROM products WHERE is_delete != 1 ";
        return $this->Query($query, null)->fetchAll();
    }
    public function DeleteProduct($id)
    {
        $query = "UPDATE PRODUCTS SET is_delete = 1 WHERE PRODUCTID = ?";
        return $this->Query($query, [$id]);
    }
    public function DetailProduct($id)
    {
        $query = "SELECT * FROM products WHERE PRODUCTID = ?";
        return $this->Query($query, [$id])->fetchAll(PDO::FETCH_ASSOC);
    }
    public function SearchProduct($keySearch)
    {
        $query = "SELECT * FROM products WHERE PRODUCTNAME LIKE ? AND is_delete != 1";
        return $this->Query($query, ["%" . $keySearch . "%"])->fetchAll();
    }
    private function saveBase64Image($base64_image)
    {
        $output_dir = 'Public/Image/Products/';

        $image_data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64_image));


        $new_image_name = uniqid() . '.png';


        $image_path = $output_dir . $new_image_name;

        file_put_contents($image_path, $image_data);

        return $new_image_name;
    }
    private function AddProductSize($productSizes, $productID)
    {
        foreach ($productSizes as $size) {
            $query = " INSERT INTO product_Size VALUES(UUID(),?,?,?,?)";
            $this->Query($query, [$size['sizePrice'], 0, $size['sizeName'], $productID]);
        }
    }
    public function AddProduct($products)
    {
        foreach ($products as $product) {
            $image_paths = [];
            $query = "INSERT INTO products (PRODUCTID,PRODUCTNAME,PRICE,IS_DELETE,IMAGE_1,IMAGE_2,
                IMAGE_3,IMAGE_4,IMAGE_5,CATEGORY_ATTRIBUTES_DETAILID) VALUES (?,?,?,0,?,?,?,?,?,?)";
            foreach ($product['Images'] as $img) {
                foreach ($product['Images'] as $img) {
                    $image_paths[] = self::saveBase64Image($img);
                }
            }
            $uuid = uniqid();
            $this->Query(
                $query,
                [
                    $uuid,
                    $product['ProductName'],
                    $product['ProductPrice'],
                    $image_paths[0] ?? null,
                    $image_paths[1] ?? null,
                    $image_paths[2] ?? null,
                    $image_paths[3] ?? null,
                    $image_paths[4] ?? null,
                    $product['ProductCategoryDetail'],
                ]
            );
            self::AddProductSize($product['Sizes'], $uuid);
        }
    }
    public function GetAllProducts()
    {
        $query = "SELECT ps.PRODUCT_SIZEID, P.PRODUCTNAME,ps.QUANTITY,S.DESCRIPTION_SIZE FROM product_size as ps
                JOIN products AS P ON P.PRODUCTID = ps.PRODUCTID
                JOIN SIZE AS S ON S.SIZEID = ps.SIZEID ORDER BY ps.QUANTITY";
        return $this->Query($query, null)->fetchAll();
    }
    public function GetAllProductsUnder10()
    {
        $query = "SELECT ps.PRODUCT_SIZEID, P.PRODUCTNAME,ps.QUANTITY,S.DESCRIPTION_SIZE FROM product_size as ps
                    JOIN products AS P ON P.PRODUCTID = ps.PRODUCTID
                    JOIN SIZE AS S ON S.SIZEID = ps.SIZEID
                    WHERE ps.QUANTITY < 10";
        return $this->Query($query, null)->fetchAll();
    }
    public function GetProductByID($id)
    {
        $query = "SELECT s.DESCRIPTION_SIZE , ps.PRODUCT_SIZEID,ps.PRICE,ps.QUANTITY from product_size as ps
                    join size as s on s.SIZEID = ps.SIZEID
                    where PRODUCTID = ?";
        return $this->Query($query, [$id])->fetchAll(PDO::FETCH_OBJ);
    }
    public function GetCategoryByProductID($id)
    {
        $query = "SELECT category_attributes_detail.CATEGORY_ATTRIBUTES_DETAILID,category_attributes_detail.CATEGORY_ATTRIBUTES_DETAILNAME FROM category_attributes_detail 
            JOIN products on products.CATEGORY_ATTRIBUTES_DETAILID = category_attributes_detail.CATEGORY_ATTRIBUTES_DETAILID
            WHERE products.PRODUCTID = ?";
        return $this->Query($query, [$id])->fetchAll(PDO::FETCH_OBJ);
    }
    public function UpdateProduct($id, $productName, $price, $size)
    {
        $query = "UPDATE products set PRODUCTNAME = ? ,PRICE = ? WHERE products.PRODUCTID = ?";
        $result = $this->Query($query, [$productName, $price, $id])->rowCount();
        if ($result > 0) {
            foreach ($size as $size) {
                $querySize = "UPDATE product_size set PRICE = ? WHERE PRODUCT_SIZEID = ?";
                $this->Query($querySize, [$size['PRICE'], $size['PRODUCTSIZEID']]);
            }
        }
    }
}
