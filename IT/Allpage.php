<?php
session_start();

include 'cafes.php';

if (!isset($cafes) || !is_array($cafes)) {
  $cafes = [];
}

$selectedCategories = isset($_GET['category']) ? $_GET['category'] : [];
$selectedRating = isset($_GET['rating']) ? $_GET['rating'] : "";
$selectedDistricts = isset($_GET['district']) ? $_GET['district'] : [];

$filteredCafes = array_filter($cafes, function($cafe) use ($selectedCategories, $selectedRating, $selectedDistricts) {

  $categoryMatch =
    empty($selectedCategories) ||
    in_array($cafe['category'], $selectedCategories);

  $ratingMatch = true;

  if ($selectedRating == "5") {
    $ratingMatch = $cafe['rating'] == 5;
  }

  if ($selectedRating == "4") {
    $ratingMatch = $cafe['rating'] >= 4;
  }

  $districtMatch =
    empty($selectedDistricts) ||
    in_array($cafe['district'], $selectedDistricts);

  return $categoryMatch && $ratingMatch && $districtMatch;
});
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8" />

  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
  />

  <title>All Cafes | Fanjalah</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />

  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet"
  />

  <link rel="stylesheet" href="../css/style.css" />

  <link rel="stylesheet" href="../css/category.css" />

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

      <a href="../pages/index.html">
        Home
      </a>

      <a class="admin-link-active" href="Allpage.php">
        All Cafes
      </a>

      <a href="../pages/index.html#contact">
        Contact
      </a>

      <a href="../pages/index.html#about">
        About
      </a>

    </nav>

    <?php if(isset($_SESSION["user_id"])): ?>

  <a href="../Pages/logout.php" class="nav-btn">
    Logout
  </a>

<?php else: ?>

  <a href="../Pages/login.php" class="nav-btn">
    Login
  </a>

<?php endif; ?>

  </header>

  <section class="allcafes-hero">

    <h1>
      Discover Study Cafes In Riyadh
    </h1>

    <p>
      Curated cafes for focus, comfort and productivity.
    </p>

  </section>

  <section class="page-layout">

    <form class="filter-sidebar" method="GET">

      <h2>Filters</h2>

      <div class="filter-group">

        <h3>Category</h3>

        <label>
          <input
            type="checkbox"
            name="category[]"
            value="Coffee"
            <?= in_array("Coffee", $selectedCategories) ? "checked" : "" ?>
          >
          Coffee
        </label>

        <label>
          <input
            type="checkbox"
            name="category[]"
            value="Study"
            <?= in_array("Study", $selectedCategories) ? "checked" : "" ?>
          >
          Study
        </label>

        <label>
          <input
            type="checkbox"
            name="category[]"
            value="Brunch"
            <?= in_array("Brunch", $selectedCategories) ? "checked" : "" ?>
          >
          Brunch
        </label>

        <label>
          <input
            type="checkbox"
            name="category[]"
            value="Rooftop"
            <?= in_array("Rooftop", $selectedCategories) ? "checked" : "" ?>
          >
          Rooftop
        </label>

      </div>

      <div class="filter-group">

        <h3>Rating</h3>

        <label>
          <input
            type="radio"
            name="rating"
            value="5"
            <?= $selectedRating == "5" ? "checked" : "" ?>
          >
          5 Stars
        </label>

        <label>
          <input
            type="radio"
            name="rating"
            value="4"
            <?= $selectedRating == "4" ? "checked" : "" ?>
          >
          4+ Stars
        </label>

      </div>

      <div class="filter-group">

        <h3>District</h3>

        <label>
          <input
            type="checkbox"
            name="district[]"
            value="Olaya"
            <?= in_array("Olaya", $selectedDistricts) ? "checked" : "" ?>
          >
          Olaya
        </label>

        <label>
          <input
            type="checkbox"
            name="district[]"
            value="Hittin"
            <?= in_array("Hittin", $selectedDistricts) ? "checked" : "" ?>
          >
          Hittin
        </label>

        <label>
          <input
            type="checkbox"
            name="district[]"
            value="Malqa"
            <?= in_array("Malqa", $selectedDistricts) ? "checked" : "" ?>
          >
          Malqa
        </label>

      </div>

      <button class="apply-btn" type="submit">
        Apply Filters
      </button>

    </form>

    <main class="cafes-content">

      <h2 class="section-title">
        All Cafes
      </h2>

      <div class="cafes-grid">

        <?php if(empty($filteredCafes)): ?>

          <p>No cafes found.</p>

        <?php else: ?>

          <?php foreach($filteredCafes as $cafe): ?>

            <div class="card">

              <img src="<?= $cafe['img']; ?>" />

              <div class="card-body">

                <h3>
                  <?= $cafe['name']; ?>
                </h3>

                <p>
                  <?= $cafe['ratingText']; ?>
                </p>

                <div class="chips">

                  <?php foreach($cafe['tags'] as $tag): ?>

                    <span>
                      <?= $tag; ?>
                    </span>

                  <?php endforeach; ?>

                </div>

                <a
                  href="<?= $cafe['link']; ?>"
                  class="see-btn"
                >
                  See More
                </a>

              </div>

            </div>

          <?php endforeach; ?>

        <?php endif; ?>

      </div>

    </main>

  </section>

  <footer class="site-footer" id="about">

    <div class="footer-grid">

      <div>

        <h3>About</h3>

        <p>
          Helping students discover better study cafes in Riyadh.
        </p>

      </div>

      <div id="contact">

        <h3>Contact</h3>

        <p>info@fanjalah.com</p>

        <p>Riyadh Saudi Arabia</p>

      </div>

      <div>

        <h3>Quick Links</h3>

        <p>Home</p>

        <p>All Cafes</p>

        <p>Admin</p>

      </div>

    </div>

    <div class="footer-bottom">
      © Fanjalah
    </div>

  </footer>

</body>
</html>