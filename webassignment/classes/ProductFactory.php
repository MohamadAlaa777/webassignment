<?php
require_once 'DVD.php';
require_once 'Book.php';
require_once 'Furniture.php';

class ProductFactory {
    public static function createProduct($conn, $type, $sku, $name, $price, $attributes) {
        switch ($type) {
            case 'DVD':
                return new DVD($conn, $sku, $name, $price, $attributes['size']);
            case 'Book':
                return new Book($conn, $sku, $name, $price, $attributes['weight']);
            case 'Furniture':
                return new Furniture($conn, $sku, $name, $price, $attributes['height'], $attributes['width'], $attributes['length']);
            default:
                throw new Exception("Invalid product type.");
        }
    }
}
?>
