<?php
class Product extends ModelBase
{
    public function GetAllProduct()
    {

        $query = "SELECT PRODUCTID,PRODUCTNAME,PRICE FROM products";
        $result = $this->Query($query, null)->fetchAll();
        return $result;
    }
    public function Pagination()
    {

        $query = "SELECT COUNT(*) FROM products";
        $result = $this->Query($query, null)->fetchColumn();
        $row = $result;
        if ($row > 8) {
            $row = ceil($row / 8);
        } else {
            $row = 1;
        }
        return $row;
    }
    public function GetProductPagination($pageNumber, $pageSize)
    {
        $offset = (int) ($pageNumber - 1) * $pageSize;

        $query = "SELECT * FROM products WHERE is_delete = 0 LIMIT $pageSize OFFSET $offset ";
        $result = $this->Query($query, null)->fetchAll();
        return $result;
    }
    public function PaginationIDCategory($IDCategory)
    {

        $query = "SELECT COUNT(*) FROM products where CATEGORY_ATTRIBUTES_DETAILID = ?";
        $result = $this->Query($query, [$IDCategory])->fetchColumn();
        $row = $result;
        if ($row > 8) {
            $row = ceil($row / 8);
        } else {
            $row = 1;
        }
        return $row;
    }
    public function GetProductPaginationByIDCategory($id, $pageNumber, $pageSize)
    {
        $offset = (int) ($pageNumber - 1) * $pageSize;

        $query = "SELECT * FROM products WHERE is_delete = 0 AND CATEGORY_ATTRIBUTES_DETAILID = ? LIMIT $pageSize OFFSET $offset ";
        $result = $this->Query($query, [$id])->fetchAll();
        return $result;
    }
    public function GetProductByID($id)
    {

        $query = "SELECT p.Image_1, p.Image_2, p.Image_3, p.Image_4, p.Image_5,
                    p.PRODUCTID, ps.PRODUCT_SIZEID, p.PRODUCTNAME, s.SIZENAME, s.SIZEID, p.PRICE, ps.PRICE as PRICESIZE
                    FROM PRODUCTS p
                    JOIN product_Size ps ON p.PRODUCTID = ps.PRODUCTID
                    JOIN size s on ps.SIZEID = s.SIZEID
                    where p.PRODUCTID = ? ";
        $result = $this->Query($query, [$id])->fetchAll();
        return $result;
    }
    public function SearchProduct($keySearch)
    {

        $query = "SELECT * FROM PRODUCTS WHERE IS_DELETE = 0 AND ProductName LIKE ? LIMIT 5 ";
        $result = $this->Query($query, ["%" . $keySearch . "%"])->fetchAll();
        return $result;
    }
    public function GetProductByCategoryID($id)
    {
        $query = "SELECT * FROM PRODUCTS WHERE CATEGORY_ATTRIBUTES_DETAILID = ?";
        $result = $this->Query($query, [$id])->fetchAll();
        return $result;
    }
    public function GetSize_API()
    {
        $query = "SELECT * FROM size";
        $result = $this->Query($query, null)->fetchAll();
        return $result;
    }
}
