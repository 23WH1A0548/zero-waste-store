<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - ConserveCo</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #014421;
            margin: 0;
            padding: 0;
            color: #fff;
        }

        .container {
            max-width: 700px;
            margin: 50px auto;
            background-color: #fff;
            color: #333;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            color: #014421;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1em;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        button {
            background-color: #014421;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background 0.3s ease;
            width: 100%;
        }

        button:hover {
            background-color: #012f16;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #014421;
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .summary-box {
            background: #f4f4f4;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .summary-box p {
            margin: 8px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (!isset($_POST['continue_to_payment'])): ?>
            <h2>Shipping Details</h2>
            <form method="POST">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" required>

                <label for="address">Shipping Address</label>
                <textarea id="address" name="address" required></textarea>

                <label for="city">City</label>
                <input type="text" id="city" name="city" required>

                <label for="state">State</label>
                <input type="text" id="state" name="state" required>

                <label for="zip">Zip Code</label>
                <input type="text" id="zip" name="zip" required>

                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" required>

                <button type="submit" name="continue_to_payment">Place Order</button>
            </form>
            <a href="cart.php" class="back-link">← Back to Cart</a>
        <?php else: ?>
            <h2>Order Summary & Payment</h2>
            <div class="summary-box">
                <p><strong>Name:</strong> <?= htmlspecialchars($_POST['full_name']) ?></p>
                <p><strong>Address:</strong> <?= htmlspecialchars($_POST['address']) ?></p>
                <p><strong>City:</strong> <?= htmlspecialchars($_POST['city']) ?></p>
                <p><strong>State:</strong> <?= htmlspecialchars($_POST['state']) ?></p>
                <p><strong>Zip:</strong> <?= htmlspecialchars($_POST['zip']) ?></p>
                <p><strong>Phone:</strong> <?= htmlspecialchars($_POST['phone']) ?></p>
            </div>

            <form action="payment_process.php" method="POST">
                <!-- Hidden fields to pass shipping data -->
                <?php foreach ($_POST as $key => $value): ?>
                    <input type="hidden" name="<?= htmlspecialchars($key) ?>" value="<?= htmlspecialchars($value) ?>">
                <?php endforeach; ?>

                <label for="payment_method">Choose Payment Method</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="">-- Select Payment Option --</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="upi">UPI</option>
                    <option value="cod">Cash on Delivery</option>
                </select>

                <button type="submit">Confirm & Pay</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
