<?php
require_once 'Product.php';

class Furniture extends Product {
    private $height;
    private $width;
    private $length;

    public function __construct($conn, $sku, $name, $price, $height, $width, $length) {
        parent::__construct($conn, $sku, $name, $price);
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    public function getAttributes() {
        return "{$this->height}{$this->width}{$this->length}";
    }
}
?>

