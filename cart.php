<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../includes/db.php';

$user_id = $_SESSION['user_id'];

// Add to Cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

    $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$user_id, $product_id]);
    $cart_item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cart_item) {
        $new_quantity = $cart_item['quantity'] + $quantity;
        $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$new_quantity, $user_id, $product_id]);
    } else {
        $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $product_id, $quantity]);
    }
}

// Remove from Cart
if (isset($_POST['remove_from_cart'])) {
    $product_id = $_POST['product_id'];
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$user_id, $product_id]);
}

// Update Quantity
if (isset($_POST['update_quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$quantity, $user_id, $product_id]);
}

// Fetch cart items
$stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_cost = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - ConserveCo</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #014421;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.25);
            color: #333;
        }

        h2 {
            text-align: center;
            font-size: 2.5rem;
            color: #014421;
            margin-bottom: 30px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
        }

        .cart-item img {
            width: 120px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 20px;
        }

        .item-details {
            flex-grow: 1;
        }

        .item-name {
            font-size: 1.3rem;
            font-weight: bold;
            color: #014421;
        }

        .item-price {
            font-size: 1.1rem;
            margin-top: 5px;
            color: #444;
        }

        .item-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .item-actions input[type="number"] {
            width: 60px;
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .item-actions button {
            background-color: #014421;
            color: #fff;
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .item-actions button:hover {
            background-color: #012f16;
        }

        .total-cost {
            font-size: 1.8rem;
            font-weight: bold;
            text-align: center;
            color: #014421;
            margin: 30px 0;
        }

        .cart-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .cart-actions a {
            background-color: #014421;
            color: #fff;
            padding: 12px 24px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .cart-actions a:hover {
            background-color: #012f16;
        }

        .empty-cart {
            text-align: center;
            font-size: 1.3rem;
            color: #777;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Your Cart</h2>

    <?php if (empty($cart_items)) : ?>
        <p class="empty-cart">Your cart is empty.</p>
    <?php else : ?>
        <?php
        $product_ids = array_column($cart_items, 'product_id');
        $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
        $stmt = $conn->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
        $stmt->execute($product_ids);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as $product) {
            $quantity = 0;
            foreach ($cart_items as $cart_item) {
                if ($cart_item['product_id'] == $product['id']) {
                    $quantity = $cart_item['quantity'];
                    break;
                }
            }

            $total_cost += $product['price'] * $quantity;

            echo "
            <div class='cart-item'>
                <img src='../images/{$product['image']}' alt='{$product['name']}'>
                <div class='item-details'>
                    <div class='item-name'>{$product['name']}</div>
                    <div class='item-price'>₹" . number_format($product['price'], 2) . " x $quantity</div>
                </div>
                <div class='item-actions'>
                    <form method='POST'>
                        <input type='hidden' name='product_id' value='{$product['id']}'>
                        <input type='number' name='quantity' value='$quantity' min='1' required>
                        <button type='submit' name='update_quantity'>Update</button>
                    </form>
                    <form method='POST'>
                        <input type='hidden' name='product_id' value='{$product['id']}'>
                        <button type='submit' name='remove_from_cart'>Remove</button>
                    </form>
                </div>
            </div>";
        }
        ?>
        <div class="total-cost">Total: ₹<?= number_format($total_cost, 2); ?></div>

        <div class="cart-actions">
            <a href="../index.php">← Back to Shop</a>
            <a href="checkout.php">Proceed to Checkout →</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
