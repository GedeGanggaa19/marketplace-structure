<?php
require_once(__DIR__ . '/Config/init.php');

// Menyiapkan CategoryController untuk mengambil data kategori
$categoryController = new CategoryController();
$categories = $categoryController->index(); // Mengambil semua kategori

// Handle restore kategori yang dihapus
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["restoreCategoryId"])) {
    $categoryController->restore($_POST["restoreCategoryId"]);
    header("Location: indexCategory.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category List</title>
    <!-- Sertakan CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-success {
            background-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .table-container {
            margin-top: 30px;
        }

        .table {
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead {
            background-color: #343a40;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
        }

        .card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .card-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

        .card-body {
            padding: 20px;
        }

        .no-categories {
            text-align: center;
            padding: 20px;
            color: #888;
        }

        .btn-group {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .btn-group a {
            text-decoration: none;
        }

        .table thead th {
            text-align: center;
        }

        .restore {
            margin-top: 20px;
            
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <!-- Navigation Buttons -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h4">Category Dashboard</h1>
            <div class="btn-group">
                <a href="index.php" class="btn btn-primary">Back to Index</a>
                <a href="View/category/create.php" class="btn btn-success">Add New Category</a>
            </div>
        </div>

        <!-- Category Table -->
        <?php if (!empty($categories)): ?>
            <div class="table-container">
                <div class="card">
                    <div class="card-header">
                        Category List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($categories as $category): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($category['id']); ?></td>
                                            <td><?php echo htmlspecialchars($category['category_name']); ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="View/category/detail.php?id=<?php echo $category['id']; ?>" class="btn btn-success btn-sm">Detail</a>
                                                    <a href="View/category/update.php?id=<?php echo $category['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                                    <a href="View/category/delete.php?id=<?php echo $category['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="no-categories">
                <p>No categories available at the moment.</p>
            </div>
        <?php endif; ?>

        <form method="POST">
            <input type="hidden" name="restoreCategoryId" value="<?php echo $category['id']; ?>">
            <button type="submit" class="btn btn-secondary restore">Restore</button>
        </form>
    </div>
</body>

</html>
