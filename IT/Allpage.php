<?php
session_start();
include 'cafes.php';
if (!isset($cafes) || !is_array($cafes)) {
  $cafes = [];
}

$selectedCategories = $_GET['category'] ?? [];
$selectedRating = $_GET['rating'] ?? "";
$selectedDistricts = $_GET['district'] ?? [];

$filteredCafes = array_filter($cafes, function($cafe) use ($selectedCategories, $selectedRating, $selectedDistricts) {

  $categoryMatch = empty($selectedCategories) || in_array($cafe['category'], $selectedCategories);

  $ratingMatch = true;

  if ($selectedRating == "5") {
    $ratingMatch = $cafe['rating'] == 5;
  }

  if ($selectedRating == "4") {
    $ratingMatch = $cafe['rating'] >= 4;
  }

  $districtMatch = empty($selectedDistricts) || in_array($cafe['district'], $selectedDistricts);

  return $categoryMatch && $ratingMatch && $districtMatch;
});
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
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
        <a href="../pages/index.html">Home</a>
        <a class="admin-link-active" href="Allpage.html">All Cafes</a>
        <a href="../pages/index.html#contact">Contact</a>
        <a href="../pages/index.html#about">About</a>
      </nav>

      <a href="../pages/login.html" class="nav-btn"> Login </a>
    </header>

    <section class="allcafes-hero">
      <h1>Discover Study Cafes In Riyadh</h1>

      <p>Curated cafes for focus, comfort and productivity.</p>
    </section>

    <form class="filter-sidebar" method="GET">

  <h2>Filters</h2>

  <div class="filter-group">

    <h3>Category</h3>

    <label>
      <input type="checkbox" name="category[]" value="Coffee">
      Coffee
    </label>

    <label>
      <input type="checkbox" name="category[]" value="Study">
      Study
    </label>

    <label>
      <input type="checkbox" name="category[]" value="Brunch">
      Brunch
    </label>

    <label>
      <input type="checkbox" name="category[]" value="Rooftop">
      Rooftop
    </label>

  </div>

  <div class="filter-group">

    <h3>Rating</h3>

    <label>
      <input type="radio" name="rating" value="5">
      5 Stars
    </label>

    <label>
      <input type="radio" name="rating" value="4">
      4+ Stars
    </label>

  </div>

  <div class="filter-group">

    <h3>District</h3>

    <label>
      <input type="checkbox" name="district[]" value="Olaya">
      Olaya
    </label>

    <label>
      <input type="checkbox" name="district[]" value="Hittin">
      Hittin
    </label>

    <label>
      <input type="checkbox" name="district[]" value="Malqa">
      Malqa
    </label>

  </div>

  <button class="apply-btn" type="submit">
    Apply Filters
  </button>

</form>

      <main class="cafes-content">
        <h2 class="section-title">All Cafes</h2>

        <div class="cafes-grid">
          <div class="card">
            <img src="./Coffee Pages/Pics/mkth.png" />
            <div class="card-body">
              <h3>MKTH</h3>
              <p>⭐ 4.6 Study Friendly</p>
              <div class="chips">
                <span>WiFi</span>
                <span>Quiet</span>
              </div>
              <a href="./Coffee Pages/cafe-mkth.html" class="see-btn">
                See More
              </a>
            </div>
          </div>

          <div class="card">
            <img src="./Coffee Pages/Pics/Peacock.jpg" />
            <div class="card-body">
              <h3>Peacock</h3>
              <p>⭐ 4.8 Specialty</p>
              <div class="chips">
                <span>Private</span>
                <span>Outlets</span>
              </div>
              <a href="./Coffee Pages/cafe-peacock.html" class="see-btn">
                See More
              </a>
            </div>
          </div>

          <div class="card">
            <img src="./Coffee Pages/Pics/iota.jpg" />
            <div class="card-body">
              <h3>Iota</h3>
              <p>⭐ 4.5 Minimal</p>
              <div class="chips">
                <span>Study</span>
                <span>Focus</span>
              </div>
              <a href="./Coffee Pages/cafe-iota.html" class="see-btn">
                See More
              </a>
            </div>
          </div>

          <div class="card">
            <img src="./Coffee Pages/Pics/kaltura.png" />
            <div class="card-body">
              <h3>Kultura</h3>
              <p>⭐ 4.7 Premium</p>
              <div class="chips">
                <span>Calm</span>
                <span>Private</span>
              </div>
              <a href="./Coffee Pages/cafe-kultura.html" class="see-btn">
                See More
              </a>
            </div>
          </div>

          <div class="card">
            <img src="./Coffee Pages/Pics/Ashjar.png" />
            <div class="card-body">
              <h3>Ashjar</h3>
              <p>⭐ 4.7 Aesthetic</p>
              <div class="chips">
                <span>Study</span>
                <span>WiFi</span>
              </div>
              <a href="./Coffee Pages/cafe-ashjar.html" class="see-btn">
                See More
              </a>
            </div>
          </div>

          <div class="card">
            <img src="./Coffee Pages/Pics/Eventhu.jpg" />
            <div class="card-body">
              <h3>Eventhu</h3>
              <p>⭐ 4.5 Cozy</p>
              <div class="chips">
                <span>Focus</span>
                <span>Coffee</span>
              </div>
              <a href="./Coffee Pages/cafe-eventhu.html" class="see-btn">
                See More
              </a>
            </div>
          </div>

          <div class="card">
            <img src="./Coffee Pages/Pics/Camelstep.png" />
            <div class="card-body">
              <h3>Camel Step</h3>
              <p>⭐ 4.8 Specialty</p>
              <div class="chips">
                <span>Quiet</span>
                <span>Power</span>
              </div>
              <a href="./Coffee Pages/cafe-camelstep.html" class="see-btn">
                See More
              </a>
            </div>
          </div>

          <div class="card">
            <img src="./Coffee Pages/Pics/Veni.png" />
            <div class="card-body">
              <h3>Veni</h3>
              <p>⭐ 4.6 Trendy</p>
              <div class="chips">
                <span>Study</span>
                <span>Private</span>
              </div>
              <a href="./Coffee Pages/cafe-veni.html" class="see-btn">
                See More
              </a>
            </div>
          </div>

          <div class="card">
            <img src="./Coffee Pages/Pics/Origin.png" />
            <div class="card-body">
              <h3>Origin</h3>
              <p>⭐ 4.7 Roastery</p>
              <div class="chips">
                <span>Focus</span>
                <span>Quiet</span>
              </div>
              <a href="./Coffee Pages/cafe-origin.html" class="see-btn">
                See More
              </a>
            </div>
          </div>
        </div>
      </main>
    </section>

    <footer class="site-footer" id="about">
      <div class="footer-grid">
        <div>
          <h3>About</h3>
          <p>Helping students discover better study cafes in Riyadh.</p>
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

      <div class="footer-bottom">© Fanjalah</div>
    </footer>
  </body>
</html>
