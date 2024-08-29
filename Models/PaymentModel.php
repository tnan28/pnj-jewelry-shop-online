<?php

class PaymentModel extends ModelBase
{
    public function GetAll()
    {
        $query = "SELECT * FROM paymentmethods";
        return $this->Query($query, null)->fetchAll();
    }
}
