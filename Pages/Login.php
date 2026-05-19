<?php
session_start();

require_once __DIR__ . '/../IT/db.php';

if (!isset($conn) || !$conn) {
  die("Database connection failed");
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $email = trim($_POST["email"]);
  $password = $_POST["password"];

  $stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM users WHERE email = ?"
  );

  mysqli_stmt_bind_param($stmt, "s", $email);

  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);

  $user = mysqli_fetch_assoc($result);

  if ($user && password_verify($password, $user["password"])) {

    $_SESSION["user_id"] = $user["id"];
    $_SESSION["name"] = $user["name"];
    $_SESSION["email"] = $user["email"];
    $_SESSION["role"] = $user["role"];

    if ($user["role"] == "admin") {

      header("Location: admin.php");

    } else {

      header("Location: ../IT/Allpage.php");

    }

    exit();

  } else {

    $error = "Wrong email or password";

  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8" />

  <meta
    name="viewport"
    content="width=device-width,initial-scale=1.0"
  />

  <title>Login | Fanjalah</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />

  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet"
  />

  <link rel="stylesheet" href="../css/style.css" />

</head>

<body>

<div class="blur b1"></div>
<div class="blur b2"></div>

<header class="nav">

  <div class="brand">

    <div class="logo">☕</div>

    <h2>Fanjalah</h2>

  </div>

  <nav>

    <a href="index.html">
      Home
    </a>

    <a href="../IT/Allpage.php">
      All Cafes
    </a>

    <a href="index.html#contact">
      Contact
    </a>

    <a href="index.html#about">
      About
    </a>

  </nav>

  <?php if(isset($_SESSION["user_id"])): ?>

    <a href="logout.php" class="nav-btn">
      Logout
    </a>

  <?php else: ?>

    <a href="login.php" class="nav-btn">
      Login
    </a>

  <?php endif; ?>

</header>

<section class="login-page">

  <div class="login-left">

    <h1>Welcome Back</h1>

    <p>
      Login to continue using Fanjalah
    </p>

    <div class="hero-card login-image">

      <img
        src="https://images.unsplash.com/photo-1509042239860-f550ce710b93"
      />

    </div>

  </div>

  <div class="login-box-modern">

    <h2>Login</h2>

    <form method="POST">

      <div class="form-group">

        <label>Email</label>

        <input
          name="email"
          type="email"
          placeholder="Enter email"
          required
        />

      </div>

      <div class="form-group">

        <label>Password</label>

        <input
          name="password"
          type="password"
          placeholder="Enter password"
          required
        />

      </div>

      <button type="submit" class="login-submit">
        Login
      </button>

      <p style="color:red; margin-top:10px;">
        <?= $error ?>
      </p>

    </form>

    <div style="margin-top:20px; text-align:center;">

      <p>
        Don't have an account?
      </p>

      <a href="register.php">
        Create Account
      </a>

    </div>

  </div>

</section>

</body>
</html>