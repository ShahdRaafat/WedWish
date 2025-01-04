<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$conn = new mysqli('localhost', 'root', '', 'Project'); 

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Fetch products from the database
$query = "SELECT * FROM products"; // Fetching from the same table
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <!-- CSS Links -->
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

    <!-- Add some basic styling for the buttons -->
    <style>
    .btn {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #45a049;
    }

    .btn-edit,
    .btn-delete {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-edit:hover,
    .btn-delete:hover {
        background-color: #45a049;
    }

    img {
        border-radius: 5px;
    }
    </style>
</head>

<body>
    <!-- Home Button -->
    <a href="../../index.php" class="home-btn">Home</a>
    <div class="container dashboard-container">
        <h1>Product Management</h1>

        <!-- Add Product Form -->
        <div class="form-container">
            <h2>Add New Product</h2>
            <form class="product-form" action="add_product.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Product Name" required>
                    <input type="number" step="0.01" name="price" placeholder="Price" required>
                    <input type="file" name="image" accept="image/*" required>
                    <input type="text" name="category" placeholder="Category" required>
                </div>
                <button type="submit" class="btn btn--add-product">
                    <span class="icon">+</span>
                    Add Product
                </button>
            </form>
        </div>

        <!-- Products Table -->
        <h2>Product List</h2>
        <div class="table-container">
            <table class="products-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php
                            // Determine the category subfolder
                            $src = $row['category'];
                            ?>
                            <img src="uploads/<?php echo htmlspecialchars($src); ?>/<?php echo htmlspecialchars($row['image']); ?>"
                                alt="<?php echo htmlspecialchars($row['name']); ?>" width="100">
                        </td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td>$<?php echo number_format($row['price'], 2); ?></td>
                        <td><?php echo htmlspecialchars($row['category']); ?></td>
                        <td>
                            <div class="actions">
                                <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">Edit</a>
                                <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="btn btn-delete"
                                    onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="5">No products found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php $conn->close(); ?>
</body>

</html>