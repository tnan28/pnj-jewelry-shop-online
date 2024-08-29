<?php
class ModelBase
{
    private $serverName = "localhost";
    private $port = "3306";
    private $username = "root";
    private $password = "root";
    private $database = "pnj_shop";
    public $conn;
    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->serverName;port={$this->port};dbname=$this->database", $this->username, $this->password);
            $this->conn->exec("set names utf8mb4");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Kết nối thất bại: " . $e->getMessage());
        }
    }
    public function Query($query, $values = array())
    {
        try {
            $stmt = $this->conn->prepare($query);
            if (empty($values)) {
                $stmt->execute();
            } else {
                $stmt->execute($values);
            }
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Lỗi truy vấn: " . $e->getMessage());
        }
    }
}
