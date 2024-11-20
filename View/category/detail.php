<?php
include(__DIR__ . '/../../Config/init.php');

$categoryController = new CategoryController();
$categoryDetails = [];

// Get the category ID from the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $categoryDetails = $categoryController->show($id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }
        .card {
            max-width: 600px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #6c757d;
            color: white;
            text-align: center;
            font-size: 1.25rem;
        }
        table th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="../../indexCategory.php" class="btn btn-secondary mb-4">Back to Category List</a>

        <div class="card">
            <div class="card-header">
                Category Details
            </div>
            <div class="card-body">
                <?php if (!empty($categoryDetails)): ?>
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <td><?php echo htmlspecialchars($categoryDetails['id']); ?></td>
                        </tr>
                        <tr>
                            <th>Category Name</th>
                            <td><?php echo htmlspecialchars($categoryDetails['category_name']); ?></td>
                        </tr>
                    </table>
                <?php else: ?>
                    <p class="text-center text-danger">Category not found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>
