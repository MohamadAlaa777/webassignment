<?php
require_once 'db/Database.php';
require_once 'classes/ProductFactory.php';

$database = new Database();
$conn = $database->getConnection();

$sku = $_POST['sku'];
$name = $_POST['name'];
$price = $_POST['price'];
$type = $_POST['productType'];

$attributes = [];
if ($type === 'DVD') {
      $attributes['size'] = $_POST['size'];
} elseif ($type === 'Book') {
      $attributes['weight'] = $_POST['weight'];
} elseif ($type === 'Furniture') {
      $attributes['height'] = $_POST['height'];
      $attributes['width'] = $_POST['width'];
      $attributes['length'] = $_POST['length'];
}

// Check for existing SKU
$sql = "SELECT COUNT(*) FROM products WHERE sku = :sku";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':sku', $sku);
$stmt->execute();
if ($stmt->fetchColumn() > 0) {
      echo "SKU already exists. Please choose a different SKU.";
      exit;
}

// Save product
try {
      $product = ProductFactory::createProduct($conn, $type, $sku, $name, $price, $attributes);
      $sql = "INSERT INTO products (sku, name, price, type, size_mb, weight_kg, height_cm, width_cm, length_cm) VALUES (:sku, :name, :price, :type, :size, :weight, :height, :width, :length)";
      $stmt = $conn->prepare($sql);
      $stmt->execute([
            ':sku' => $sku,
            ':name' => $name,
            ':price' => $price,
            ':type' => $type,
            ':size' => $attributes['size'] ?? null,
            ':weight' => $attributes['weight'] ?? null,
            ':height' => $attributes['height'] ?? null,
            ':width' => $attributes['width'] ?? null,
            ':length' => $attributes['length'] ?? null,
      ]);
      header("Location: index.php");
} catch (Exception $e) {
      echo "Error: " . $e->getMessage();
}
