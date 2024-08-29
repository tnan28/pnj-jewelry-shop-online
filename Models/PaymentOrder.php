<?php
class PaymentOrder extends ModelBase
{
    public function CreatePaymentOrder($orderID, $payment)
    {
        $query = "INSERT INTO paymentmethod_order VALUES(?,?,?)";
        return $this->Query($query, [$payment, $orderID, null])->rowCount();
    }
    public function SetPaymentStatus($orderID, $status)
    {
        if ($status != null) {
            $query = "UPDATE paymentmethod_order SET STATUS= CURRENT_TIME() WHERE ORDERID=?";
            return $this->Query($query, [$orderID])->rowCount();
        } else {
            $query = "UPDATE paymentmethod_order SET STATUS= ? WHERE ORDERID=?";
            return $this->Query($query, [$status, $orderID])->rowCount();
        }
    }
}
