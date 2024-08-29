<?php

class CustomerModel extends ModelBase
{
    public function GetAll()
    {
        $query = "SELECT * FROM `customer`";
        return $this->Query($query, null)->fetchAll();
    }
    public function GetCustomerByID($id)
    {
        $query = "SELECT * FROM `customer` WHERE CUSTOMERID = ?";
        return $this->Query($query, [$id])->fetch(PDO::FETCH_ASSOC);
    }
    public function AddCustomer($name, $phoneNumber, $email)
    {
        $query = "SELECT `CUSTOMERID` FROM `customer` WHERE `PHONENUMBER` = ?";
        $existingCustomer = $this->Query($query, [$phoneNumber])->fetch(PDO::FETCH_ASSOC);
        if ($existingCustomer) {
            $customerId = $existingCustomer['CUSTOMERID'];
        } else {
            $insertQuery = "INSERT INTO `customer`(`CUSTOMERID`,`CUSTOMERNAME`, `PHONENUMBER`, `EMAIL`)
                        VALUES (?,?,?,?)";
            $uuid = uniqid();
            $this->Query($insertQuery, [$uuid, $name, $phoneNumber, $email]);
            $customerId = $uuid;
        }
        return  $customerId;
    }
    public function UpdateCustomer($name, $phoneNumber, $email)
    {
        $query = "SELECT `CUSTOMERID` FROM `customer` WHERE `PHONENUMBER` = ?";
        $existingCustomer = $this->Query($query, [$phoneNumber])->fetch(PDO::FETCH_ASSOC);
        if ($existingCustomer) {
            $customerId = $existingCustomer['CUSTOMERID'];
            $queryUpdate = "UPDATE customer set CUSTOMERNAME = ?, PHONENUMBER = ?,EMAIL = ?
                WHERE CUSTOMERID = ?";
            $this->Query($queryUpdate, [$name, $phoneNumber, $email, $customerId]);
        } else {
            $insertQuery = "INSERT INTO `customer`(`CUSTOMERID`,`CUSTOMERNAME`, `PHONENUMBER`, `EMAIL`)
                        VALUES (?,?,?,?)";
            $uuid = uniqid();
            $this->Query($insertQuery, [$uuid, $name, $phoneNumber, $email]);
            $customerId = $uuid;
        }
        return  $customerId;
    }
}
