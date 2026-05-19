<?php

$conn = mysqli_connect("localhost", "root", "", "fanjalah_db");

if (!$conn) {
  die("Database Connection Failed: " . mysqli_connect_error());
}

?>