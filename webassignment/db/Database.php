<?php
class Database
{
    private $host = 'localhost';  // Typically 'localhost' for local servers
    private $db_name = 'product_app';  // Replace with your database name
    private $username = 'root';  // Default username for XAMPP
    private $password = '';      // Default password for XAMPP (empty)

    public $conn;

    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
