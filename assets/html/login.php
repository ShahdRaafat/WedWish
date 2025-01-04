<?php
$conn = mysqli_connect("localhost", "root", "", "project");
if (!$conn) {
    echo mysqli_connect_error();
}

session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $query = "SELECT * FROM user WHERE email='$email' AND password='$pass' ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result)>0) {
        $row=mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name']=$row['name'];
        header('location:../../index.php');
    } else {
        header('location:signin.php');
    }
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
</head>

<body>
    <!-- Home Button -->
    <a href="../../index.php" class="home-btn">Home</a>
    <div class="container">
        <main class="login-box">
            <h1 class="heading">Login to Your Account</h1>

            <!-- Login Form -->
            <form method="POST" action="">
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-input" required
                        placeholder="Enter your email" autocomplete="email">
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-input" required
                        placeholder="Enter your password" autocomplete="current-password">
                </div>

                <button type="submit" class="btn-primary" name="login">
                    Login
                </button>
                <a href="signin.php" style="color:#d39fa4; margin-top:15px;">don't have an account? register</a>
            </form>
        </main>
    </div>
</body>

</html>