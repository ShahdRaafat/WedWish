<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$conn = new mysqli('localhost', 'root', '', 'Project');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $price = $conn->real_escape_string($_POST['price']);
    $category = $conn->real_escape_string($_POST['category']);
    $image = $_FILES['image'];

    // Validate inputs
    if (empty($name) || empty($price) || empty($category) || empty($image['name'])) {
        die('All fields are required.');
    }

    // Handle the image upload
    $targetDir = __DIR__ . "/uploads/$category/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true); // Create the category folder if it doesn't exist
    }

    $imageName = uniqid() . "_" . basename($image['name']);
    $targetFile = $targetDir . $imageName;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($image['tmp_name'], $targetFile)) {
        // Insert the product into the database
        $query = "INSERT INTO products (name, price, image, category) VALUES ('$name', '$price', '$imageName', '$category')";
        if ($conn->query($query)) {
            header("Location: dashboard.php");
            exit();
        } else {
            die('Database error: ' . $conn->error);
        }
    } else {
        die('Failed to upload image.');
    }
}

$conn->close();
?>