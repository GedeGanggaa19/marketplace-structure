<?php
require_once(__DIR__ . '/../../Config/init.php');

$productController = new ProductController();
$categoryController = new CategoryController();  // Menambahkan categoryController
$productDetails = [];

// Get the product ID from the URL
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $productDetails = $productController->show($productId);
    
    // Retrieve category name using the category ID from the product details
    $categoryName = '';
    if (isset($productDetails['category_id'])) {
        $categoryDetails = $categoryController->show($productDetails['category_id']);
        $categoryName = $categoryDetails['category_name'] ?? 'N/A';  // Menambahkan kategori jika ada
    }
}

// Handle deletion if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmDelete'])) {
    if ($productController->destroy($productId)) {
        echo "<script>
                alert('Product deleted successfully!');
                window.location.href = '../../index.php';
            </script>";
        exit();
    } else {
        echo "<script>alert('Failed to delete product. Please try again later.')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            padding: 20px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #dc3545;
            color: #fff;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .table {
            margin: 0;
        }

        .table th {
            background-color: #f8f9fa;
            text-align: center;
        }

        .table td {
            text-align: center;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #bd2130;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-group {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .cancel-btn {
            margin-top: 10px;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="card w-50">
        <div class="card-header">
            Confirm Product Deletion
        </div>
        <div class="card-body">
            <?php if (!empty($productDetails)): ?>
                <p class="text-center">Are you sure you want to delete the product 
                    <strong>"<?php echo htmlspecialchars($productDetails['product_name']); ?>"</strong>?
                </p>
                <div class="table-responsive">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo htmlspecialchars($productDetails['id']); ?></td>
                                <td><?php echo htmlspecialchars($productDetails['product_name']); ?></td>
                                <td><?php echo htmlspecialchars($categoryName); ?></td>
                                <td><?php echo htmlspecialchars($productDetails['price']); ?></td>
                                <td><?php echo htmlspecialchars($productDetails['stock']); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <form method="POST" class="d-flex justify-content-center mt-3">
                    <div class="btn-group">
                        <button type="submit" name="confirmDelete" class="btn btn-danger">Confirm Delete</button>
                        <a href="../../index.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            <?php else: ?>
                <p class="text-center">Product not found.</p>
                <div class="d-flex justify-content-center">
                    <a href="../../index.php" class="btn btn-secondary">Back to Product List</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>
