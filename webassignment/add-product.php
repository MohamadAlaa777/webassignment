<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light">

    <div class="container my-5">
        <h1 class="mb-4 text-primary">Add Product</h1>

        <form id="product_form" action="save-product.php" method="POST" class="bg-white p-4 shadow-sm rounded">
            <div class="mb-3">
                <label for="sku" class="form-label">SKU:</label>
                <input type="text" id="sku" name="sku" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price ($):</label>
                <input type="number" id="price" name="price" class="form-control" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="productType" class="form-label">Type:</label>
                <select id="productType" name="productType" class="form-select" required>
                    <option value="">Select type</option>
                    <option value="DVD">DVD</option>
                    <option value="Book">Book</option>
                    <option value="Furniture">Furniture</option>
                </select>
            </div>

            <div id="typeSpecificFields" class="mb-3"></div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Cancel</button>
            </div>
        </form>
    </div>

    <script src="js/add-product.js"></script>
</body>

</html>
