<?php

class EmployeeModel extends ModelBase
{
    public function GetAll()
    {
        $query = "SELECT * FROM `employee`";
        return $this->Query($query, null)->fetchAll();
    }
    public function RemoveEmployee($id)
    {
        $query = "DELETE FROM `employee` WHERE EMPLOYEEID = ?";
        return $this->Query($query, [$id]);
    }
    public function GetEmployeeById($id)
    {
        $query = "SELECT * FROM `employee` WHERE EMPLOYEEID = ?";
        return $this->Query($query, [$id])->fetch(PDO::FETCH_ASSOC);
    }
    public function UpdateEmployee($id, $name, $phoneNumber, $email, $salary)
    {
        $query = "UPDATE `employee` SET FULLNAME = ?,EMAIL = ?,PHONENUMBER = ?, SALARY = ?  WHERE EMPLOYEEID = ?";
        return $this->Query($query, [$name, $email, $phoneNumber, $salary, $id]);
    }
    public function AddEmployee($name, $phoneNumber, $email, $salary)
    {
        $ID = uniqid(true);
        $query = "INSERT INTO employee VALUE (?,?,?,?,?,CURRENT_DATE())";
        return $this->Query($query, [$ID, $name, $email, $phoneNumber, $salary]);
    }
}
