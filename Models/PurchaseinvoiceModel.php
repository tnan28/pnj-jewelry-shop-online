<?php
class PurchaseInvoiceModel extends ModelBase
{
    public function GetAllPurChaseInvoice()
    {
        $query = "SELECT p.PURCHASEINVOICEID,p.TOTAL,p.CREATEAT,a.SUPPLIERNAME,p.STATUS FROM purchaseinvoices as p
            JOIN suppliers as a ON a.SUPPLIERID = p.SUPPLIERID ";
        return $this->Query(query: $query, values: null)->fetchAll();
    }
    public function LoadSupplierAPI()
    {
        $query = "SELECT SUPPLIERID,SUPPLIERNAME FROM suppliers";
        return $this->Query(query: $query, values: null)->fetchAll();
    }
    public function CreatePurchaseInvoice($products)
    {
        $uuid = uniqid("", true);
        $query = "INSERT INTO `purchaseinvoices`(`PURCHASEINVOICEID`, `TOTAL`, `CREATEAT`, `SUPPLIERID`,`STATUS`)
                 VALUES (?,?,?,?,0)";
        $this->Query(query: $query, values: [$uuid, null,  date('Y-m-d H:i:s'), $products['orders']['supplier']]);
        foreach ($products['orders']['products'] as $product) {
            $uuidDetail = uniqid("", true);
            $queryDetail = "INSERT INTO `purchaseinvoice_detail`(`PURCHASEINVOICE_DETAILID`, `TOTAL`, `QUANTITY`, `PURCHASEINVOICEID`, `PRODUCT_SIZEID`)
                 VALUES (?,?,?,?,?)";
            $this->Query(query: $queryDetail, values: [$uuidDetail, $product['price'], $product['quality'], $uuid, $product['productId']]);
        }
    }
    public function Confirm_delivery($id)
    {
        $query = "SELECT PRODUCT_SIZEID, quantity FROM purchaseinvoice_detail WHERE PURCHASEINVOICEID = ?";
        $result = $this->Query(query: $query, values: [$id]);
        while ($row = $result->fetch()) {
            $product_size_id = $row['PRODUCT_SIZEID'];
            $delivered_quantity = $row['quantity'];
            $update_query = "UPDATE product_size SET quantity = quantity + ? WHERE PRODUCT_SIZEID = ?";
            $this->Query(query: $update_query, values: [
                $delivered_quantity, $product_size_id
            ]);
        }
        $query = "UPDATE purchaseinvoices SET STATUS = 1  WHERE PURCHASEINVOICEID = ?";
        $result =  $this->Query(query: $query, values: [$id])->rowCount();
        return $result;
    }
    public function GetPurchaseInvoiceByID($id)
    {
        $query = "SELECT * FROM purchaseinvoices
                    JOIN suppliers as s ON purchaseinvoices.SUPPLIERID = s.SUPPLIERID
                    WHERE PURCHASEINVOICEID = ?";
        return $this->Query($query, [$id])->fetch(PDO::FETCH_OBJ);
    }
    public function GetPurchaseInvoiceByDetailByID($id)
    {
        $query = "SELECT p.PRODUCTNAME,s.DESCRIPTION_SIZE, pd.QUANTITY, pd.TOTAL FROM purchaseinvoice_detail as pd
                    JOIN product_size as pz on pz.PRODUCT_SIZEID = pd.PRODUCT_SIZEID
                    JOIN products as p on pz.PRODUCTID = p.PRODUCTID
                    JOIN size as s on s.SIZEID = pz.SIZEID
                    WHERE PURCHASEINVOICEID = ?";
        return $this->Query($query, [$id])->fetchAll(PDO::FETCH_OBJ);
    }
}
