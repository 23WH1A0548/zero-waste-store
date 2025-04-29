<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_POST['payment_method'])) {
    header("Location: checkout.php");
    exit();
}

$payment_method = $_POST['payment_method'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Processing - ConserveCo</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #014421;
            color: #fff;
            text-align: center;
            padding: 50px;
        }

        .container {
            background: #fff;
            color: #333;
            padding: 30px;
            max-width: 600px;
            margin: 0 auto;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
        }

        h2 {
            color: #014421;
        }

        img {
            max-width: 300px;
            margin: 20px 0;
        }

        .btn {
            display: inline-block;
            background-color: #014421;
            color: #fff;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #012f16;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($payment_method === 'upi'): ?>
            <h2>Scan to Pay via UPI</h2>
            <p>Use any UPI app to scan this dummy QR code.</p>
            <img src="http://www.emoderationskills.com/wp-content/uploads/2010/08/QR1.jpg" alt="Dummy UPI QR Code">
            <br>
            <a href="thankyou.php" class="btn">I Have Paid</a>
        <?php else: ?>
            <h2>Payment Confirmed!</h2>
            <p>Your order has been placed successfully using <?= htmlspecialchars(ucwords(str_replace('_', ' ', $payment_method))) ?>.</p>
            <a href="thankyou.php" class="btn">Go to Thank You Page</a>
        <?php endif; ?>
    </div>
</body>
</html>
