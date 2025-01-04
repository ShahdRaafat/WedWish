<?php
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "project");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    die('User not logged in. Please log in to proceed.');
}
$user_id = $_SESSION['user_id'];

// Remove a product from the cart
if (isset($_GET['remove'])) {
    $product_id = intval($_GET['remove']); // Sanitize input
    $remove_query = "DELETE FROM cart WHERE product_id = $product_id AND user_id = $user_id";
    if (mysqli_query($conn, $remove_query)) {
        header("Location: cart.php"); // Redirect to refresh the cart
        exit;
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}

// Add a product to the cart
if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']); // Sanitize input

    // Fetch product details
    $name_query = "SELECT * FROM products WHERE id = $product_id";
    $result = mysqli_query($conn, $name_query);

    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        $name = $product['name'];
        $image = $product['image'];
        $price = $product['price'];
        $category = $product['category'];

        // Check if the product is already in the user's cart
        $q_query = "SELECT product_id FROM cart WHERE user_id = $user_id AND product_id = $product_id";
        $q_result = mysqli_query($conn, $q_query);

        if (mysqli_num_rows($q_result) > 0) {
            // Product already exists in the cart
            header("Location: cart.php"); // Redirect without an alert
        } else {
            // Add product to cart
            $insert_query = "INSERT INTO cart (user_id, product_id, name, image, price, category, quantity) 
                             VALUES ($user_id, $product_id, '$name', '$image', $price, '$category', 1)";
            if (mysqli_query($conn, $insert_query)) {
                header("Location: cart.php"); // Redirect after adding to cart
                exit;
            } else {
                echo 'Error: ' . mysqli_error($conn);
            }
        }
    } else {
        echo '<script>alert("Error: Product not found.");</script>';
    }
}
// Quantity update in cart
if (isset($_GET['product_id']) && isset($_GET['action'])) {
    $product_id = $_GET['product_id'];
    $action = $_GET['action'];

    // Get current quantity in the cart
    $check_query = "SELECT quantity FROM cart WHERE user_id = $user_id AND product_id = $product_id";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $item = mysqli_fetch_assoc($check_result);
        $current_quantity = $item['quantity'];

        // Increase or decrease the quantity
        if ($action == "increase") {
            $new_quantity = $current_quantity + 1;
        } elseif ($action == "decrease" && $current_quantity > 1) {
            $new_quantity = $current_quantity - 1;
        } else {
            $new_quantity = $current_quantity; // If quantity is 1, don't decrease
        }

        // Update the cart with new quantity
        $update_query = "UPDATE cart SET quantity = $new_quantity WHERE user_id = $user_id AND product_id = $product_id";
        if (mysqli_query($conn, $update_query)) {
            header("Location: cart.php"); // Redirect to reload the page with updated cart
            exit;
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    $first_name = mysqli_real_escape_string($conn, $_POST['firstName']);
    $last_name = mysqli_real_escape_string($conn, $_POST['lastName']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['paymentMethod']);

    // Insert order into the checkout table
    $insert_checkout_query = "INSERT INTO checkout (firstName, lastName, address, city, paymentMethod) 
                               VALUES ('$first_name', '$last_name', '$address', '$city', '$payment_method')";

    if (mysqli_query($conn, $insert_checkout_query)) {
        $_SESSION['order_success'] = true; // Set session flag
        $order_id = mysqli_insert_id($conn); // Get the new order ID

        // Clear the cart after checkout
        $clear_cart_query = "DELETE FROM cart WHERE user_id = $user_id";
        mysqli_query($conn, $clear_cart_query);

        // Redirect
        header("Location: cart.php");
        exit;
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart & Checkout</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="stylesheet" href="../css/normalize.css" />
    <link rel="stylesheet" href="../css/cart.css" />
</head>

<body>
    <!-- Home Button -->
    <a href="../../index.php" class="home-btn">Home</a>
    <div class="container">
        <h1>Shopping Cart & Checkout</h1>
        <div class="grid-layout">
            <div class="main-content">
                <!-- Shopping Cart Section -->
                <div class="card cart-section">
                    <h2>Shopping Cart</h2>
                    <div id="cart-items" class="cart-items">
                        <?php
                        $query = "SELECT * FROM cart WHERE user_id = $user_id";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            while ($item = mysqli_fetch_assoc($result)) {
                                $category_folder = ($item['category'] === "dress") ? "dress" :
                                                   (($item['category'] === "access") ? "access" : "decor");
                        ?>
                        <div class="cart-item">
                            <img src="uploads/<?php echo $category_folder; ?>/<?php echo $item['image']; ?>"
                                alt="<?php echo htmlspecialchars($item['name']); ?>" class="cart-item-image">
                            <div class="cart-item-details">
                                <h3 class="cart-item-name"><?php echo htmlspecialchars($item['name']); ?></h3>
                                <p class="cart-item-price">$<?php echo number_format($item['price'], 2); ?></p>
                                <div class="quantity-controls">
                                    <form action="cart.php" method="get" style="display: inline;">
                                        <input type="hidden" name="product_id"
                                            value="<?php echo $item['product_id']; ?>" />
                                        <button type="submit" name="action" value="decrease"
                                            class="quantity-button minus">-</button>
                                        <span><?php echo $item['quantity']; ?></span>
                                        <button type="submit" name="action" value="increase"
                                            class="quantity-button plus">+</button>
                                    </form>
                                </div>
                                <a class="remove-button" href="cart.php?remove=<?php echo $item['product_id']; ?>">
                                    <i class="fa-solid fa-trash"></i> Remove
                                </a>
                            </div>
                        </div>

                        <?php
                            }
                        } else {
                            echo "<p>Your cart is empty.</p>";
                        }
                        ?>
                    </div>
                </div>

                <!-- Checkout Form Section -->
                <div class="card checkout-section">
                    <h2>Checkout</h2>
                    <form id="checkout-form" class="checkout-form" method="POST">
                        <div class="form-section">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="firstName">First Name</label>
                                    <input type="text" id="firstName" name="firstName" required>
                                </div>
                                <div class="form-group">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" id="lastName" name="lastName" required>
                                </div>
                                <div class="form-group full-width">
                                    <label for="address">Address</label>
                                    <input type="text" id="address" name="address" required>
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" id="city" name="city" required>
                                </div>
                                <div class="form-group">
                                    <label for="method">Payment Method</label>
                                    <select name="paymentMethod" id="method" required>
                                        <option value="d" selected>Cash on Delivery</option>
                                        <option value="c">Credit Card</option>
                                        <option value="p">PayPal</option>
                                    </select>
                                </div>
                                <button type="submit" name="checkout" class="button-primary btn--show-modal">Place
                                    Order</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="sidebar">
                <div class="card order-summary">
                    <h2>Order Summary</h2>
                    <div class="summary-details">
                        <div class="summary-row">
                            <?php
                            $query = "SELECT * FROM cart WHERE user_id = $user_id";
                            $total = 0;
                            $shipping=0;
                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) > 0) {
                                while ($item = mysqli_fetch_assoc($result)) {
                                    $total += $item['price'] * $item['quantity'];
                                }
                                $shipping=10;
                            }
                            ?>
                            <span>Subtotal</span>
                            <span id="subtotal">$<?php echo number_format($total, 2); ?></span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping</span>

                            <span id="shipping"><?php echo $shipping?></span>
                        </div>
                        <div class="summary-row total">
                            <span>Total</span>
                            <span id="total">$<?php echo number_format($total + $shipping, 2); ?></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="overlay hidden">
        <div class="modal">
            <button class="btn--close-modal">&times;</button>
            <h2 class="modal__header">
                🎉 Your order has been confirmed
            </h2>
            <p>Thank you for choosing WedWish 👰🤵</p>
        </div>
    </div>


    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const overlay = document.querySelector(".overlay");
        const btnCloseModal = document.querySelector(".btn--close-modal");
        const openModal = function() {
            overlay.classList.remove("hidden");
        };

        <?php if (isset($_SESSION['order_success']) && $_SESSION['order_success']){ ?>
        openModal(); // Show the modal
        <?php $_SESSION['order_success'] = false; // Reset the session flag to ensure that the modal won't appear again on the next page load 
    }?>

        const closeModal = function() {
            overlay.classList.add("hidden"); // Hide the modal
        };

        // Modal close button
        btnCloseModal.addEventListener("click", closeModal);

        // Click outside the modal to close
        overlay.addEventListener("click", closeModal);

        // Close modal on pressing Escape
        document.addEventListener("keydown", function(e) {
            if (e.key === "Escape" && !overlay.classList.contains("hidden")) {
                closeModal();
            }
        });
    });
    </script>


</body>

</html>