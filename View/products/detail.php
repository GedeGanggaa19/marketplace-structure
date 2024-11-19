<?php
require(__DIR__ . '/../../Config/init.php');

// Get the product ID from the URL
$id = $_GET['id'];

$productController = new ProductController();
$categoryController = new CategoryController(); // Menambahkan categoryController

// Fetch product details using the controller
$productDetails = $productController->show($id);

// Fetch category details based on the product's category_id
if (!empty($productDetails)) {
    $categoryDetails = $categoryController->show($productDetails['category_id']); // Mengambil kategori berdasarkan category_id
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        table td,
        table th {
            padding: 8px;
            border: 1px solid #dddddd;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        a {
            display: inline-block;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <a href="../../index.php" class="btn btn-secondary mb-3">Back to Product List</a>

    <?php if (!empty($productDetails)): ?>
        <h2>Product Details</h2>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td><?php echo htmlspecialchars($productDetails['id']); ?></td>
            </tr>
            <tr>
                <th>Product Name</th>
                <td><?php echo htmlspecialchars($productDetails['product_name']); ?></td>
            </tr>
            <tr>
                <th>Category</th>
                <td><?php echo htmlspecialchars($categoryDetails['category_name'] ?? 'Unknown'); ?></td>
            </tr>
            <tr>
                <th>Price</th>
                <td><?php echo htmlspecialchars($productDetails['price']); ?></td>
            </tr>
            <tr>
                <th>Stock</th>
                <td><?php echo htmlspecialchars($productDetails['stock']); ?></td>
            </tr>
        </table>
    <?php else: ?>
        <p>Product not found.</p>
    <?php endif; ?>
</body>

</html>