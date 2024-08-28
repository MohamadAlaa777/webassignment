<?php
require_once 'db/Database.php';

$database = new Database();
$conn = $database->getConnection();

$input = file_get_contents('php://input');
$data = json_decode($input, true);
$ids = $data['ids'];

if (!empty($ids)) {
    // Prepare and execute the DELETE statement
    $ids = implode(',', array_map('intval', $ids));
    $sql = "DELETE FROM products WHERE id IN ($ids)";
    $conn->exec($sql);
    echo "Products deleted successfully.";
} else {
    echo "No products selected for deletion.";
}
?>
