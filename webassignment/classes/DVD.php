<?php
require_once 'Product.php';

class DVD extends Product {
    private $size;

    public function __construct($conn, $sku, $name, $price, $size) {
        parent::__construct($conn, $sku, $name, $price);
        $this->size = $size;
    }

    public function getAttributes() {
        return $this->size . " MB";
    }
}
?>
