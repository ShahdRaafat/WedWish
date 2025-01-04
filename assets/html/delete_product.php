<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'project'); // Use your database name

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check if product ID is provided in URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute the DELETE query
    $delete_query = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $id);
    $success = $stmt->execute();
    
    if ($stmt->execute()) {
        header('Location: dashboard.php'); // Redirect to home page after successful update
        exit;
    } else {
        echo 'Error: ' . $stmt->error;
    }

    $stmt->close();
} else {
    echo 'Product ID not provided.';
}

$conn->close();
?>
