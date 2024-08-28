<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+8bL+8p4YX4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
</head>

<body class="bg-light">

    <?php

    require_once("db/Database.php");
    require_once("classes/ProductFactory.php");

    $database = new Database();
    $conn = $database->getConnection();
    if ($conn === null) {
        echo ("<div class='alert alert-danger' role='alert'>Failed to connect to the database.</div>");
        exit;
    }
    $sql = "SELECT * FROM products ORDER BY id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary">Product List</h1>
            <div>
                <a href="add-product.php" class="btn btn-success me-2">ADD</a>
                <button id="massDelete" class="btn btn-danger">MASS DELETE</button>
            </div>
        </div>

        <div class="row">
            <?php foreach ($products as $product):
                $id = $product['id'];
                $name = htmlspecialchars($product['name']);
                $price = htmlspecialchars($product['price']);
                $sku = htmlspecialchars($product['sku']);
                $type = $product['type'];
                $attributes = [];
                if ($type === 'DVD') {
                    $attributes = ['size' => $product['size']];
                } elseif ($type === 'Book') {
                    $attributes = ['weight' => $product['weight']];
                } elseif ($type === 'Furniture') {
                    $attributes = [
                        'height' => $product['height'],
                        'width' => $product['width'],
                        'length' => $product['length']
                    ];
                }
                $attr = (new ProductFactory())
                    ->createProduct(
                        $conn,
                        $type,
                        $product['sku'],
                        $product['name'],
                        $product['price'],
                        $attributes
                    )
                    ->getAttributes();
                ?>

                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <input type="checkbox" class="form-check-input delete-checkbox" data-id="<?= $id; ?>">
                            <span class="text-secondary"><?= $sku; ?></span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $name; ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $price; ?> $</h6>
                            <p class="card-text"><?= $attr; ?></p>
                            <?php if ($type === 'Furniture'): ?>
                                <p class="card-text">
                                    Dimensions: <?= $attributes['height']; ?> x <?= $attributes['width']; ?> x <?= $attributes['length']; ?> cm
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    </div>

  
</body>
<script>
document.getElementById('massDelete').addEventListener('click', function () {
    // Collect all selected checkboxes
    let checkboxes = document.querySelectorAll('.delete-checkbox:checked');
    let ids = Array.from(checkboxes).map(cb => cb.getAttribute('data-id'));

    if (ids.length > 0) {
        // Send the IDs to the server using AJAX
        fetch('delete-products.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ ids: ids })
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            // Reload the page or remove the deleted products from the DOM
            location.reload();
        })
        .catch(error => console.error('Error:', error));
    } else {
        alert('Please select at least one product to delete.');
    }
});
</script>


</html>
