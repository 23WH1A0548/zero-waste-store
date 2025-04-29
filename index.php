<?php
session_start();
include 'includes/db.php'; // Include the database connection

// Fetch products from the database
$stmt = $conn->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConserveCo - Online Store</title>
    <style>
        /* Global reset and font */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #014421; /* Forest green */
            color: #fff;
        }

        header {
            background-color: #012f16;
            padding: 20px;
        }

        .header-container {
            max-width: 1200px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-container h1 {
            font-size: 1.8rem;
        }

        nav a,
        .logout-button {
            color: #fff;
            margin-left: 20px;
            text-decoration: none;
            font-weight: bold;
            background: none;
            border: none;
            cursor: pointer;
        }

        nav a:hover,
        .logout-button:hover {
            text-decoration: underline;
        }

        .main-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem;
            color: #fff;
        }

        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 30px;
        }

        .product {
            background-color: #ffffff;
            color: #333;
            padding: 20px;
            border-radius: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .product:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .product h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            text-align: center;
        }

        .product p {
            margin-bottom: 10px;
            text-align: center;
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        .product:hover .product-image {
            transform: scale(1.05);
        }

        .add-to-cart-button {
            margin-top: auto;
            padding: 10px 20px;
            background-color: #014421;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        .add-to-cart-button:hover {
            background-color: #012f16;
        }

        footer {
            background-color: #012f16;
            text-align: center;
            padding: 20px;
            margin-top: 50px;
            color: #fff;
        }

        .cart-icon {
            width: 20px;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Welcome to ConserveCo</h1>
            <nav>
                <a href="pages/login.php">Login</a>
                <a href="pages/register.php">Register</a>
                <a href="pages/cart.php">
                    <img src="images/cart-icon.png" alt="Cart" class="cart-icon"> Cart
                </a>
                <form method="POST" style="display:inline;">
                    <button type="submit" name="logout" class="logout-button">Logout</button>
                </form>
            </nav>
        </div>
    </header>

    <div class="main-container">
        <main>
            <h2>Our Products</h2>
            <div class="product-list">
                <?php if (empty($products)) : ?>
                    <p style="color: white;">No products available.</p>
                <?php else : ?>
                    <?php foreach ($products as $product) : ?>
                        <div class="product">
                            <h3><?= htmlspecialchars($product['name']); ?></h3>
                            <p>Price: ₹<?= number_format($product['price'], 2); ?></p>
                            <p><?= htmlspecialchars($product['description']); ?></p>
                            <?php if (!empty($product['image'])) : ?>
                                <img src="images/<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" class="product-image">
                            <?php endif; ?>
                            <form method="POST" action="pages/cart.php">
                                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                <button type="submit" name="add_to_cart" class="add-to-cart-button">Add to Cart</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <footer>
        <p>&copy; <?= date('Y'); ?> ConserveCo. All rights reserved.</p>
    </footer>
</body>
</html>
