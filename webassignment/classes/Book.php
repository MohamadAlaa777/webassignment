<?php
require_once 'Product.php';

class Book extends Product {
    private $weight;

    public function __construct($conn, $sku, $name, $price, $weight) {
        parent::__construct($conn, $sku, $name, $price);
        $this->weight = $weight;
    }

    public function getAttributes() {
        return $this->weight . " Kg";
    }
}
?>
