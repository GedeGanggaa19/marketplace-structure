<?php
require_once(__DIR__ . '/../../Config/init.php');

$categoryController = new CategoryController();
$categoryDetails = [];

// Get the category ID from the URL
if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];
    $categoryDetails = $categoryController->show($categoryId);
}

// Handle deletion if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmDelete'])) {
    if ($categoryController->destroy($categoryId)) {
        echo "<script>
                alert('Category deleted successfully!');
                window.location.href = '../../indexCategory.php';
            </script>";
        exit();
    } else {
        echo "<script>alert('Failed to delete category. Please try again later.')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Category</title>
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
            background-color: #dc3545;
            color: white;
            text-align: center;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
        .btn-danger:hover {
            background-color: #a71d2a;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Delete Category</h2>
            </div>
            <div class="card-body">
                <?php if (!empty($categoryDetails)): ?>
                    <p class="text-center">Are you sure you want to delete the category <strong>"<?php echo htmlspecialchars($categoryDetails['category_name']); ?>"</strong>?</p>
                    <div class="d-flex justify-content-center gap-2">
                        <form method="POST">
                            <button type="submit" name="confirmDelete" class="btn btn-danger">Confirm Delete</button>
                        </form>
                        <a href="../../indexCategory.php" class="btn btn-secondary">Cancel</a>
                    </div>
                <?php else: ?>
                    <p class="text-center">Category not found.</p>
                    <div class="text-center">
                        <a href="../../indexCategory.php" class="btn btn-secondary">Back to Category List</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>
