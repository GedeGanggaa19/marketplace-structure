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
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .table th {
            background-color: #f1f1f1;
            text-align: left;
        }

        .table td {
            text-align: left;
        }

        .btn-secondary {
            margin-top: 10px;
            background-color: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .not-found {
            text-align: center;
            font-size: 18px;
            color: #dc3545;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="card w-50">
        <div class="card-header">
            Product Details
        </div>
        <div class="card-body">
            <?php if (!empty($productDetails)): ?>
                <table class="table">
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
                <a href="../../index.php" class="btn btn-secondary">Back to Product List</a>
            <?php else: ?>
                <p class="not-found">Product not found.</p>
                <div class="d-flex justify-content-center">
                    <a href="../../index.php" class="btn btn-secondary">Back to Product List</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>
