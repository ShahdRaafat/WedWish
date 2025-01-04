<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$conn = new mysqli('localhost', 'root', '', 'Project');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Fetch the product to edit
$product = [
    'id' => '',
    'name' => '',
    'image' => '',
    'price' => '',
    'category' => ''
];

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    $query = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    }
}

// Handle the form submission for updating the product
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);
    $price = floatval($_POST['price']);
    $category = $conn->real_escape_string($_POST['category']);
    $image = $_FILES['image']['name'];

    // Handle image upload
    $targetDir = __DIR__ . "/uploads/$category/";

    if ($image) {
        // Move the new uploaded image
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        // Update the product with the new image
        $query = "UPDATE products SET name = '$name', image = '$image', price = $price, category = '$category' WHERE id = $id";
    } else {
        // If no new image, retain the existing image
        $image = $product['image'];
        $query = "UPDATE products SET name = '$name', price = $price, category = '$category' WHERE id = $id";
    }

    $conn->query($query);

    // Redirect to the dashboard after updating
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="stylesheet" href="../css/normalize.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400..900&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;0,900;1,400&display=swap"
        rel="stylesheet" />
</head>

<body>
    <div class="container dashboard-container edit-container">
        <h1>Edit Product</h1>

        <!-- Edit Product Form -->
        <div class="form-container" id="edit-form">
            <h2>Product Name: <?php echo $product['name']; ?></h2>
            <form class="product-form" action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

                <label class="form-label" for="name">Product Name:</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($product['name']); ?>"
                    required>

                <label class="form-label" for="price">Price:</label>
                <input type="number" step="0.01" name="price" id="price"
                    value="<?php echo htmlspecialchars($product['price']); ?>" required>

                <label class="form-label" for="category">Category:</label>
                <input type="text" name="category" id="category"
                    value="<?php echo htmlspecialchars($product['category']); ?>" required>

                <label class="form-label" for="image">Product Image:</label>
                <input type="file" name="image" id="image" accept="image/*">

                <button type="submit" class="btn btn--update">Update Product</button>
            </form>
        </div>
    </div>
</body>

</html>

<?php
$conn->close();
?>