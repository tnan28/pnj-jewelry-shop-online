<?php

class OrderDetailModel extends ModelBase
{
    public function AddOrderDetail($products, $idOrder)
    {
        foreach ($products as $product) {
            $query = "INSERT INTO `orderdetail`(`ORDERDETAILID`, `QUANTITY`,`ORDERID`, `PRODUCT_SIZEID`)
             VALUES (UUID(),?,?,?)";
            $this->Query($query, [$product['quantity'], $idOrder, $product['product_size_id']]);
        }
    }
}
