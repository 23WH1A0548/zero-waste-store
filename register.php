<?php
include('../includes/db.php');
session_start();

if (isset($_POST['register'])) {
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role       = 'user';

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo "<script>alert('Email is already registered!');</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, phone, password, role) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$first_name, $last_name, $email, $phone, $password, $role]);

        $_SESSION['user_id'] = $conn->lastInsertId();
        header("Location: ../index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register - Conserve Co</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #014421; /* Forest Green */
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #333;
    }

    .container {
      background-color: #fff;
      border-radius: 10px;
      display: flex;
      max-width: 900px;
      width: 100%;
      overflow: hidden;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .form-section {
      flex: 1;
      padding: 40px;
    }

    .form-section h2 {
      margin-bottom: 25px;
      color: #014421;
    }

    form label {
      display: block;
      margin-top: 15px;
      font-weight: 600;
    }

    form input {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    button[type="submit"] {
      width: 100%;
      margin-top: 25px;
      padding: 12px;
      background-color: #014421;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 1em;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button[type="submit"]:hover {
      background-color: #012f16;
    }

    .image-section {
      flex: 1;
      background-image: url('https://i.pinimg.com/736x/24/a8/e6/24a8e662abae46b7b1a06f2b594c6cae.jpg');
      background-size: cover;
      background-position: center;
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
    <div class="form-section">
      <h2>Register</h2>
      <form method="POST">
        <label>First Name</label>
        <input type="text" name="first_name" required>
        
        <label>Last Name</label>
        <input type="text" name="last_name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Phone Number</label>
        <input type="text" name="phone" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="register">Register</button>
      </form>
    </div>
    <div class="image-section"></div>
  </div>
</body>
</html>
