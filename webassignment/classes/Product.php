<?php
abstract class Product {
    protected $sku;
    protected $name;
    protected $price;
    protected $conn;

    public function __construct($conn, $sku, $name, $price) {
        $this->conn = $conn;
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
    }

    abstract public function getAttributes();
}
?>
