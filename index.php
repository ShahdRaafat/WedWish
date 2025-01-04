<?php

$conn = mysqli_connect("localhost", "root", "", "project");

if (!$conn) {

    echo mysqli_connect_error();

}

session_start();



// Check if the user is logged in

if (isset($_SESSION['user_id'])) {

    // If logged in, retrieve email or username from session

    $user_id=$_SESSION['user_id'];

    $user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;

    $email = isset($_SESSION['email']) ? $_SESSION['email'] : null;

} else {

    // If not logged in, set email and username as null

    $user_name = null;

    $email = null;

}



// Handle logout request

if (isset($_GET['logout'])) {

    session_unset();  // Unset session variables

    session_destroy(); // Destroy the session

    header("Location: index.php"); // Redirect to login page
     exit();

}


// number of cart items 
$items=0;
if(isset($user_id)){
$q_query = "SELECT * FROM cart WHERE user_id = $user_id";
$q_result = mysqli_query($conn, $q_query);
if (mysqli_num_rows($q_result) > 0) {
    while ($item = mysqli_fetch_assoc($q_result)) {
        $items=$items+$item['quantity'];


}}}
                               


?>

<!DOCTYPE html>
<html lang="en" style="  scroll-behavior: smooth;">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WedWish</title>

    <!-- Css Links -->
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/normalize.css" />

    <!--Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400..900&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;0,900;1,400&display=swap"
        rel="stylesheet" />

</head>

<body>

    <header>
        <div class="container">
            <nav>
                <div class="logo">
                    <img src="assets/images/logo.png" alt="website logo" />
                </div>
                <i class="fa-solid fa-bars menu"></i>
                <div class="items">
                    <ul class="links">
                        <li class="link"><a href="#home" class="active-link">Home</a></li>
                        <li class="link">
                            <a href="#dresses">Products</a>
                        </li>
                        <li class="link"><a href="#about-us">About us</a></li>
                        <li class="link"><a href="#dresses">Services</a></li>
                        <li class="link"><a href="#reviews">Reviews</a></li>
                        <li class="link"><a href="#contact">Contact</a></li>
                    </ul>
                    <div class="icons">
                        <!-- If logged in, show email greeting and logout button -->

                        <?php if ($user_name): ?>

                        <span class="email">Hello, <?php echo htmlspecialchars($user_name); ?>!</span>

                        <a href="?logout=true" class="btn login--btn">

                            <i class="fa-solid fa-right-from-bracket"></i>

                            <p>Logout</p>

                        </a>

                        <?php else: ?>

                        <!-- If not logged in, show login button -->

                        <a href="assets/html/login.php" class="btn login--btn">

                            <i class="fa-solid fa-user"></i>

                            <p>Login</p>

                        </a>

                        <?php endif; ?>
                        </a>
                        <div class="shopping-cart-icon">
                            <?php
                                $href= isset($user_id)?"cart":"login";
                            ?>

                            <a href="assets\html\<?php echo $href?>.php"><i
                                    class="fa-solid fa-cart-shopping cart"></i></a>
                            <span class="cart-count"><?php echo $items;?></span>
                        </div>
                        <?php

                        if(isset($user_id) && $user_id == 1){

                        ?>

                        <a href="assets/html/dashboard.php" class="dashboard">Dashboard</a>

                        <?php

                        }

                        ?>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- Start Landing -->
    <div class="landing" id="home">

        <div class="text" id="about-us">
            <h1>WedWish, All You Need for Your Day</h1>
            <p>Welcome to our wedding boutique! Discover dresses, decorations, accessories, and planning tips to make
                your special day unforgettable. Shop now and create lasting memories!</p>
        </div>
    </div>
    <!-- End Landing -->
    <!-- Start Dresses -->

    <section class="dresses" id="dresses">

        <div class="container">

            <div class="main-heading">

                <h2>Wedding Dresses</h2>

            </div>

            <div class="card-holder">

                <div class="card-deck">


                    <?php

    $query='SELECT * FROM `products` where category="dress"';

$result=mysqli_query($conn,$query);

if(mysqli_num_rows($result)){

    while($dress_product=mysqli_fetch_assoc($result)){

?>



                    <div class="card">

                        <img class="card-img" src="assets\html\uploads\dress\<?php echo $dress_product['image'];?>"
                            alt="Wedding Dress">

                        <div class="shopping-cart-icon">



                            <form
                                action="<?php echo isset($user_id) ? 'assets/html/cart.php?product_id=' . $dress_product['id'] : 'assets/html/login.php'; ?>"
                                method="post">



                                <button type="submit" name="submit" value="<?php echo $dress_product['id']; ?>"
                                    style="background:none; border:none;">

                                    <i class="fa-solid fa-cart-shopping cart"></i>

                                </button>

                            </form>



                        </div>

                        <div class="card-body">

                            <h4 class="card-title"><?php echo $dress_product['name'];?></h4>

                            <h6 class="card-price"><?php echo $dress_product['price'];?>$</h6>

                            <ul class="card-size">

                                <li><button>XS</button></li>

                                <li><button>S</button></li>

                                <li><button>M</button></li>

                                <li><button>L</button></li>

                                <li><button>XL</button></li>

                            </ul>

                        </div>

                    </div>

                    <?php

    }

}

?>

    </section>
    <!-- End Dresses -->

    <!-- Start Accessories -->

    <section class="accessories" id="accessories">

        <div class="container">

            <div class="main-heading">

                <h2>Wedding Accessories</h2>

            </div>

            <div class="card-holder">




                <div class="card-deck">

                    <?php

$query='SELECT * FROM `products` where category="access"';

$res=mysqli_query($conn,$query);

if(mysqli_num_rows($res)){

while($access_product=mysqli_fetch_assoc($res)){

?>

                    <div class="card">

                        <img class="card-img" src="assets\html\uploads\access\<?php echo $access_product['image'];?>"
                            alt="Wedding Dress">

                        <div class="shopping-cart-icon">

                            <form
                                action="<?php echo isset($user_id) ? 'assets/html/cart.php?product_id=' . $access_product['id'] : 'assets/html/login.php'; ?>"
                                method="post">

                                <button type="submit" name="submit" value="<?php echo $access_product['id']; ?>"
                                    style="background:none; border:none;">

                                    <i class="fa-solid fa-cart-shopping cart"></i>

                                </button>

                            </form>

                        </div>

                        <div class="card-body">

                            <h4 class="card-title"><?php echo $access_product['name'];?></h4>

                            <h6 class="card-price"><?php echo $access_product['price'];?>$</h6>



                        </div>

                    </div>

                    <?php

}

}

?>



    </section>

    <!-- End Accessories -->
    <!-- Start Decorations -->

    <section class="decorations" id="decorations">

        <div class="container">

            <div class="main-heading">

                <h2>Wedding Decorations</h2>

            </div>

            <div class="card-holder">

                <div class="card-deck">

                    <?php

    $query='SELECT * FROM `products` where category="decor"';

$result3=mysqli_query($conn,$query);

if(mysqli_num_rows($result3)){

    while($decor_product=mysqli_fetch_assoc($result3)){

?>

                    <div class="card">

                        <img class="card-img" src="assets\html\uploads\decor\<?php echo $decor_product['image'];?>"
                            alt="Wedding Dress">

                        <div class="shopping-cart-icon">

                            <form
                                action="<?php echo isset($user_id) ? 'assets/html/cart.php?product_id=' . $decor_product['id'] : 'assets/html/login.php'; ?>"
                                method="post">



                                <button type="submit" name="submit" value="<?php echo $decor_product['id']; ?>"
                                    style="background:none; border:none;">

                                    <i class="fa-solid fa-cart-shopping cart"></i>

                                </button>

                            </form>

                        </div>

                        <div class="card-body">

                            <h4 class="card-title"><?php echo $decor_product['name'];?></h4>

                            <h6 class="card-price"><?php echo $decor_product['price'];?>$</h6>

                        </div>

                    </div>

                    <?php

    }

}

?>



    </section>

    <!-- End Decorations-->


    <!-- testimonials -->
    <section class="testimonials" id="reviews">
        <div class="container">
            <div class="main-heading">
                <h2>Customer Love Letters</h2>
            </div>
            <div class="grid grid--3-cols testimonial-container" id="testimonials">
                <figure class="testimonial">
                    <p class="stars">⭐⭐⭐⭐⭐</p>
                    <blockquote>
                        These fans are lovely. Packaged nicely and appear to be made well!!
                        I would recommend them!
                    </blockquote>
                    <img class="" src="assets\images\candle.jpeg" alt="Candle Wedding Favor" />
                    <div class="testimonial-name">
                        <p><strong>Lauren R.</strong></p>
                        <p><em>New York, NY</em></p>
                    </div>
                </figure>

                <figure class="testimonial">
                    <p class="stars">⭐⭐⭐⭐⭐</p>
                    <blockquote>
                        These fans are lovely. Packaged nicely and appear to be made well!!
                        I would recommend them!
                    </blockquote>
                    <img class="" src="assets\images\fan.jpeg" alt="fan Wedding Favor" />
                    <div class="testimonial-name">
                        <p><strong>Patti S.</strong></p>
                        <p><em>St. Peters, MO</em></p>
                    </div>
                </figure>

                <figure class="testimonial">
                    <p class="stars">⭐⭐⭐⭐⭐</p>
                    <blockquote>
                        These fans are lovely. Packaged nicely and appear to be made well!!
                        I would recommend them!
                    </blockquote>
                    <img class="" src="assets\images\coaster.jpeg" alt="coaster Wedding Favor" />
                    <div class="testimonial-name">
                        <p><strong>Patti S.</strong></p>
                        <p><em>St. Peters, MO</em></p>
                    </div>
                </figure>
                <!-- <figure class="testimonial">4</figure> -->
            </div>
        </div>
    </section>

    <!-- CONTACT US -->
    <section class="contact-bg" id="contact">
        <div class="container">
            <div class="main-heading">
                <h2>Contact Us</h2>
            </div>
            <div class="contact-container">
                <div class="contact" id="b">
                    <div>
                        <p>email</p>
                        <span>wedWish@gmail.com</span>
                    </div>
                    <div>
                        <p>phone</p>
                        <span>000-111-444</span>
                    </div>
                    <div>
                        <p>address</p>
                        <span>1844 Street address</span><br />
                        <span>City, State, 19516</span>
                    </div>
                    <div>
                        <p>social</p>
                        <div class="icons">
                            <i class="fa-brands fa-instagram"></i>
                            <i class="fa-brands fa-facebook-f"></i>
                            <i class="fa-brands fa-twitter"></i>
                            <i class="fa-brands fa-linkedin-in"></i>
                        </div>
                    </div>
                </div>
                <form method="post" class="contact-form" action="assets/html/contact_form_handler.php">
                    <p>
                        We can’t wait to hear from you! Please feel free to share anything
                        you would like me to know about your big day. (If you don’t hear
                        back from me within 48 hours, please check your spam folder)
                    </p>
                    <input type="text" class="inpt" name="uname" placeholder="NAME" required />
                    <input type="tel" class="inpt" name="phone" placeholder="PHONE" required />
                    <input type="email" class="inpt" name="uemail" placeholder="EMAIL" required />
                    <textarea name="userMessage" class="comment" rows="4" cols="50" required
                        placeholder="MESSAGE"></textarea><br />
                    <div class="btn-center">
                        <button class="bttn btn--cnt" type="submit">Submit</button>
                          
                    </div>
                </form>
            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <p>
                WedWish is the ultimate destination for all what you need for your day.
            </p>
            <h5>Feel free to drop us a line at:</h5>
            <h6>WedWish@mail.com</h6>
            <!-- <span>find us on social networks: </span> -->
            <div class="icons">
                <a class="fa-brands fa-instagram"></a>
                <a class="fa-brands fa-facebook-f"></a>
                <a class="fa-brands fa-twitter"></a>
                <a class="fa-brands fa-linkedin-in"></a>
            </div>
        </div>
        </div>
    </footer>
    <script src="assets/js/script.js"></script>
</body>

</html>