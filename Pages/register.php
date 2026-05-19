<?php
session_start();

require_once __DIR__ . '/../IT/db.php';

if (!isset($conn) || !$conn) {
  die("Database connection failed");
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = trim($_POST["name"]);
  $email = trim($_POST["email"]);
  $password = $_POST["password"];
  $gender = $_POST["gender"];
  $age = $_POST["age"];

  $hashedPassword =
    password_hash($password, PASSWORD_DEFAULT);

  $check = mysqli_prepare(
    $conn,
    "SELECT id FROM users WHERE email = ?"
  );

  mysqli_stmt_bind_param($check, "s", $email);

  mysqli_stmt_execute($check);

  $result = mysqli_stmt_get_result($check);

  if (mysqli_num_rows($result) > 0) {

    $message = "Email already exists";

  } else {

    $countQuery = mysqli_query(
      $conn,
      "SELECT COUNT(*) AS total FROM users"
    );

    $countRow = mysqli_fetch_assoc($countQuery);

    $role =
      ($countRow["total"] == 0)
      ? "admin"
      : "user";

    $stmt = mysqli_prepare(
      $conn,
      "INSERT INTO users
      (name, email, password, gender, age, role)
      VALUES (?, ?, ?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
      $stmt,
      "ssssis",
      $name,
      $email,
      $hashedPassword,
      $gender,
      $age,
      $role
    );

    if (mysqli_stmt_execute($stmt)) {

      header("Location: login.php");

      exit();

    } else {

      $message = "Registration failed";

    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8" />

  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
  />

  <title>Create Account | Fanjalah</title>

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

    <h1>Create Account</h1>

    <p>
      Join Fanjalah today
    </p>

    <div class="hero-card login-image">

      <img
        src="https://images.unsplash.com/photo-1509042239860-f550ce710b93"
      />

    </div>

  </div>

  <div class="login-box-modern">

    <h2>Register</h2>

    <form method="POST">

      <div class="form-group">

        <label>Name</label>

        <input
          name="name"
          type="text"
          placeholder="Enter name"
          required
        />

      </div>

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

      <div class="form-group">

        <label>Gender</label>

        <select name="gender" required>

          <option value="">
            Select Gender
          </option>

          <option value="Male">
            Male
          </option>

          <option value="Female">
            Female
          </option>

        </select>

      </div>

      <div class="form-group">

        <label>Age</label>

        <input
          name="age"
          type="number"
          placeholder="Enter age"
          required
        />

      </div>

      <button type="submit" class="login-submit">
        Create Account
      </button>

      <p style="color:red; margin-top:10px;">
        <?= $message ?>
      </p>

    </form>

    <div style="margin-top:20px; text-align:center;">

      <p>
        Already have an account?
      </p>

      <a href="login.php">
        Login
      </a>

    </div>

  </div>

</section>

</body>
</html>