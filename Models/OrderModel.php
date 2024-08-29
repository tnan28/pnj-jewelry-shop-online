<?php

class OrderModel extends ModelBase
{
    public function GetAll()
    {
        $query = "SELECT ORDERID,TOTAL,CREATEAT,C.PHONENUMBER, C.CUSTOMERNAME as CUSTOMERNAME, STATUS FROM orders AS O
                    JOIN customer AS C ON C.CUSTOMERID = O.CUSTOMERID ORDER BY CREATEAT DESC";
        return $this->Query($query, null)->fetchAll();
    }
    public function GetOrderByID($OrderID)
    {
        $query = "SELECT * FROM orders WHERE ORDERID = ?";
        return $this->Query($query, [$OrderID])->fetch(PDO::FETCH_ASSOC);
    }
    public function DetailOrder_GetDetailProduct($id)
    {
        $query = "SELECT P.PRODUCTNAME,SI.DESCRIPTION_SIZE,OD.QUANTITY, PZ.PRICE, OD.TOTAL as TOTALDETAIL,P.IMAGE_1, PZ.PRICE , O.TOTAL  FROM orderdetail AS OD
                    JOIN orders AS O ON O.ORDERID = OD.ORDERID
                    JOIN product_size AS PZ ON PZ.PRODUCT_SIZEID = OD.PRODUCT_SIZEID
                    JOIN products AS P ON P.PRODUCTID = PZ.PRODUCTID
                    JOIN size AS SI ON SI.SIZEID = PZ.SIZEID
                    WHERE O.ORDERID = ?";
        return $this->Query($query, [$id])->fetchAll();
    }
    public function DetailOrder_GetInfoUser($id)
    {
        $query = "SELECT c.CUSTOMERNAME,c.PHONENUMBER,c.EMAIL,s.SHIPPINGMETHODNAME,o.ADDRESS FROM orders as o
                    JOIN customer as c on c.CUSTOMERID = o.CUSTOMERID
                    JOIN shippingmethods as s on s.SHIPPINGMETHODID = o.SHIPPINGMETHODID
                    WHERE o.ORDERID =  ?";
        return $this->Query($query, [$id])->fetchObject();
    }
    public function DetailOrder_GetPaymentMethod($id)
    {
        $query = "SELECT py.PAYMENTMETHODNAME,pyo.STATUS from paymentmethod_order as pyo
                    JOIN orders as o on o.ORDERID = pyo.ORDERID
                    JOIN paymentmethods as py on py.PAYMENTMETHODID = pyo.PAYMENTMETHODID
                    WHERE o.ORDERID = ?";
        return $this->Query($query, [$id])->fetch(PDO::FETCH_OBJ);
    }
    public function AcceptStatusOrder($id, $status)
    {
        $query = "UPDATE orders set STATUS = ? WHERE ORDERID = ?";
        $this->Query($query, [$status, $id]);
        if ($status === 2) {
            $queryUpdate = "UPDATE paymentmethod_order SET STATUS = CURRENT_TIME() WHERE ORDERID = ?";
            $this->Query($queryUpdate, [$id]);
        }
    }
    public function AddOrder($id)
    {
        $uuid = uniqid();
        $queryOrder = "INSERT INTO `orders`(`ORDERID`, `CREATEAT`, `STATUS`, `ADDRESS`, `CUSTOMERID`, `SHIPPINGMETHODID`)
                        VALUES (?,CURRENT_TIME(),?,?,?,?)";
        $result = $this->Query($queryOrder, [$uuid, 0, null, $id, 1]);
        if ($result !== false && $result->rowCount() > 0) {
            return $uuid;
        } else {
            echo "Không thể tạo đơn hàng mới.";
            return false;
        }
    }
    public function CheckOrder($id)
    {
        $query = "SELECT * FROM `orders`
                WHERE ORDERID = ? AND SHIPPINGMETHODID = 2";
        return $this->Query($query, [$id])->fetchAll(PDO::FETCH_OBJ);
    }
    public function GetHistoryOrder($customerID)
    {
        $query = "SELECT
                 o.ORDERID, p.PRODUCTNAME,p.IMAGE_1,pz.PRICE,od.QUANTITY,od.TOTAL,o.CREATEAT
                FROM `orderdetail` as od
                    JOIN product_size as pz on pz.PRODUCT_SIZEID = od.PRODUCT_SIZEID
                    JOIN products as p on p.PRODUCTID = pz.PRODUCTID
                    JOIN orders as o on o.ORDERID = od.ORDERID
                WHERE o.CUSTOMERID = ?
                ORDER BY o.CREATEAT DESC
                ";
        return $this->Query($query, [$customerID])->fetchAll(PDO::FETCH_OBJ);
    }
}
