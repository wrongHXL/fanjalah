<?php
session_start();

require_once __DIR__ . "/../IT/db.php";
if (!isset($conn)) {
  die("ERROR: db.php loaded, but \$conn was not created.");
}

if (!$conn) {
  die("ERROR: Database connection failed.");
}

if (!isset($_SESSION["user_id"])) {
  header("Location: ../Pages/login.php");
  exit();
}

if ($_SESSION["role"] != "admin") {
  die("Access Denied. Admins only.");
}

$totalUsersQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");

if (!$totalUsersQuery) {
  die("SQL Error: " . mysqli_error($conn));
}

$totalUsers = mysqli_fetch_assoc($totalUsersQuery)["total"];

$usersQuery = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");

if (!$usersQuery) {
  die("SQL Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">

  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
  >

  <title>Admin Panel | Fanjalah</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">

  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet"
  >

  <link rel="stylesheet" href="../css/style.css">

</head>

<body>

<div class="blur b1"></div>
<div class="blur b2"></div>

<aside class="admin-sidebar">

  <div>

    <div class="brand">

      <div class="logo">☕</div>

      <h2>Dashboard</h2>

    </div>

    <ul class="admin-menu">

      <li class="active">
        <a href="#dashboard">
          Dashboard
        </a>
      </li>

      <li>
        <a href="#manage-cafes">
          Manage Cafes
        </a>
      </li>

      <li>
        <a href="#add-cafe">
          Add Cafe
        </a>
      </li>

      <li>
        <a href="#reviews">
          Reviews
        </a>
      </li>

      <li>
        <a href="#users">
          Users
        </a>
      </li>

    </ul>

  </div>

  <a href="logout.php" class="admin-logout">
    Logout
  </a>

</aside>

<section id="dashboard" class="admin-stats">

  <div class="admin-card">

    <h3>9</h3>

    <p>Total Cafes</p>

  </div>

  <div class="admin-card">

    <h3>4</h3>

    <p>Top Rated</p>

  </div>

  <div class="admin-card">

    <h3>0</h3>

    <p>Pending Reviews</p>

  </div>

  <div class="admin-card">

    <h3>
      <?= $totalUsers ?>
    </h3>

    <p>Users</p>

  </div>

</section>

<section id="manage-cafes" class="admin-box">

  <h2>Manage Cafes</h2>

  <table class="admin-table">

    <tr>

      <th>Cafe</th>

      <th>Area</th>

      <th>Rating</th>

      <th>Status</th>

      <th>Actions</th>

    </tr>

    <tr>

      <td>MKTH</td>

      <td>Riyadh</td>

      <td>4.6</td>

      <td>

        <span class="status approved">
          Approved
        </span>

      </td>

      <td>

        <button class="edit-btn">
          Edit
        </button>

        <button class="delete-btn">
          Delete
        </button>

      </td>

    </tr>

  </table>

</section>

<section id="add-cafe" class="admin-box">

  <h2>Add New Cafe</h2>

  <form
    class="admin-form"
    method="POST"
    enctype="multipart/form-data"
  >

    <input
      name="cafe_name"
      placeholder="Cafe Name"
      required
    >

    <input
      name="location"
      placeholder="Location"
      required
    >

    <select
      name="study_friendly"
      required
    >

      <option value="">
        Study Friendly?
      </option>

      <option value="Yes">
        Yes
      </option>

      <option value="No">
        No
      </option>

    </select>

    <input
      name="wifi_quality"
      placeholder="WiFi Quality"
    >

    <input
      name="rating"
      type="number"
      step="0.1"
      min="0"
      max="5"
      placeholder="Rating"
    >

    <input
      name="image"
      type="file"
    >

    <textarea
      name="description"
      placeholder="Description"
    ></textarea>

    <button type="submit">
      Add Cafe
    </button>

  </form>

</section>

<section id="reviews" class="admin-box">

  <h2>Reviews</h2>

  <p>No reviews yet.</p>

</section>

<section id="users" class="admin-box">

  <h2>Users</h2>

  <table class="admin-table">

    <tr>

      <th>ID</th>

      <th>Name</th>

      <th>Email</th>

      <th>Gender</th>

      <th>Age</th>

      <th>Role</th>

      <th>Joined</th>

    </tr>

    <?php while($user = mysqli_fetch_assoc($usersQuery)): ?>

    <tr>

      <td>
        <?= $user["id"] ?>
      </td>

      <td>
        <?= $user["name"] ?>
      </td>

      <td>
        <?= $user["email"] ?>
      </td>

      <td>
        <?= $user["gender"] ?>
      </td>

      <td>
        <?= $user["age"] ?>
      </td>

      <td>
        <?= $user["role"] ?>
      </td>

      <td>
        <?= $user["created_at"] ?>
      </td>

    </tr>

    <?php endwhile; ?>

  </table>

</section>

</body>
</html>