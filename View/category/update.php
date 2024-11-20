<?php
include(__DIR__ . '/../../Config/init.php');

$categoryController = new CategoryController();
$errors = [];

// Get the category ID from the URL and retrieve category details
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $categoryDetails = $categoryController->show($id);
    $category_name = $categoryDetails['category_name'] ?? '';
}

// Handle form submission for updating the category
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate category_name
    if (empty($_POST["category_name"])) {
        $errors['category_name'] = "Category Name is required";
    } else {
        $category_name = $_POST["category_name"];
    }

    // If there are no validation errors, proceed with updating the category
    if (empty($errors)) {
        $data = ['category_name' => $category_name];

        if ($categoryController->update($id, $data)) {
            header("Location: ../../indexCategory.php");
            exit();
        } else {
            echo "Error updating category.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            text-align: center;
            font-size: 1.5rem;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <div class="card">
                <div class="card-header">
                    Update Category
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" name="category_name" class="form-control" id="category_name" 
                                value="<?php echo htmlspecialchars($category_name); ?>" placeholder="Enter new category name">
                            <?php if (isset($errors['category_name'])): ?>
                                <div class="text-danger mt-1"><?php echo $errors['category_name']; ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Update Category</button>
                            <a href="../../indexCategory.php" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
