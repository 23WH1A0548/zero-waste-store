<?php
include('../includes/db.php');
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: ../index.php");
        exit();
    } else {
        $error_message = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Conserve Co</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #014421; /* Forest Green */
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      background-color: #fff;
      border-radius: 10px;
      display: flex;
      max-width: 850px;
      width: 100%;
      overflow: hidden;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.25);
    }

    .image-section {
      flex: 1;
      background-image: url('https://i.pinimg.com/736x/0b/f2/45/0bf2450b0a718c63ff641fde1aa1a993.jpg');
      background-size: cover;
      background-position: center;
    }

    .form-section {
      flex: 1;
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .form-section h2 {
      margin-bottom: 20px;
      color: #014421;
      text-align: center;
    }

    label {
      font-weight: 600;
      margin-top: 10px;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      margin-bottom: 15px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 1em;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #014421;
      color: white;
      font-size: 1em;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #012f16;
    }

    .error-message {
      color: #d32f2f;
      text-align: center;
      margin-top: 10px;
    }

    .register-link {
      text-align: center;
      margin-top: 15px;
      font-size: 0.95em;
    }

    .register-link a {
      color: #014421;
      text-decoration: underline;
    }

    .register-link a:hover {
      color: #026c35;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }
      .image-section {
        height: 250px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="image-section"></div>
    <div class="form-section">
      <h2>Login</h2>
      <form method="POST">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="login">Login</button>
      </form>
      <?php if (isset($error_message)): ?>
        <p class="error-message"><?= htmlspecialchars($error_message); ?></p>
      <?php endif; ?>
      <p class="register-link">Don't have an account? <a href="register.php">Register here</a></p>
    </div>
  </div>
</body>
</html>
