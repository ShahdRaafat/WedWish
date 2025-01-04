<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "project");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['uname']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['uemail']);
    $message = mysqli_real_escape_string($conn, $_POST['userMessage']);

    // Validate inputs
    if (empty($name) || empty($phone) || empty($email) || empty($message)) {
        echo "All fields are required.";
        exit();
    }

    // Insert into the database
    $query = "INSERT INTO contact_messages (name, phone, email, message) VALUES ('$name', '$phone', '$email', '$message')";
    if (mysqli_query($conn, $query)) {
        // Redirect to the index page
        header("Location: ../../index.php#contact"); // Replace '/index.php' with the relative path to your index page if needed
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>