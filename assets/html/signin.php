<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$conn = new mysqli('localhost', 'root', '', 'project'); // Replace 'project' with your database name

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Initialize a success or error message
$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate inputs
    if (!empty($name) && !empty($email) && !empty($password)) {
        // Hash the password for security
        // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into the database
        $query = "INSERT INTO user (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            $message = "<div class='success-message'>Registration successful! Redirecting to login...</div>";
            // Redirect to the login page after 3 seconds
            header("Refresh: 3; URL=login.php");
        } else {
            $message = "<div class='error-message'>Error: " . $stmt->error . "</div>";
        }

        $stmt->close();
    } else {
        $message = "<div class='error-message'>Please fill in all the fields.</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- CSS Links -->
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="stylesheet" href="../css/normalize.css" />
    <link rel="stylesheet" href="../css/login.css" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400..900&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;0,900;1,400&display=swap"
        rel="stylesheet" />
    <style>
        .success-message {
            color: green;
            font-size: 16px;
            margin-bottom: 10px;
        }
        .error-message {
            color: red;
            font-size: 16px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <!-- Home Button -->
    <a href="../../index.php" class="home-btn">Home</a>
<div class="container">
    <main class="login-box">
        <h1 class="heading">Register a New Account</h1>

        <!-- Display success or error message -->
        <?php if (!empty($message)): ?>
            <?php echo $message; ?>
        <?php endif; ?>

        <form id="registerForm" method="POST" action="">
            <div class="form-group">
                <label class="form-label" for="name">Full Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    class="form-input" 
                    required 
                    placeholder="Enter your full name"
                    autocomplete="name"
                >
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-input" 
                    required 
                    placeholder="Enter your email"
                    autocomplete="email"
                >
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-input" 
                    required 
                    placeholder="Enter your password"
                    autocomplete="new-password"
                >
            </div>

            <button type="submit" class="btn-primary">
                Register
            </button>
        </form>
    </main>
</div>
</body>
</html>
