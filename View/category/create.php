<?php
require(__DIR__ . '/../../Config/init.php');

$categoryController = new CategoryController();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate category_name
    if (empty($_POST["category_name"])) {
        $errors['category_name'] = "Category Name is required";
    } else {
        $category_name = $_POST["category_name"];
    }

    // If there are no validation errors, proceed with creating the category
    if (empty($errors)) {
        $data = ['category_name' => $category_name];

        if ($categoryController->create($data)) {
            echo "<script>alert('Category added successfully!')</script>";
            header("Location: ../../indexCategory.php");
            exit();
        } else {
            echo "<script>alert('Failed to add category!')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 50px;
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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

    <div class="container form-container">
        <div class="card p-4">
            <h2 class="text-center mb-4">Add New Category</h2>
            
            <form method="POST">
                <div class="mb-3">
                    <label for="category_name" class="form-label">Category Name</label>
                    <input type="text" name="category_name" class="form-control" id="category_name" 
                        value="<?php echo htmlspecialchars($category_name ?? ''); ?>" placeholder="Enter category name">
                    <?php if (isset($errors['category_name'])): ?>
                        <div class="text-danger mt-1"><?php echo $errors['category_name']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Create Category</button>
                    <a href="../../indexCategory.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
