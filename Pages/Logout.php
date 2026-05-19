<?php
session_start();

session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">

  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
  >

  <title>Logout | Fanjalah</title>

  <link rel="stylesheet" href="../css/style.css">

  <meta http-equiv="refresh" content="2;url=../IT/Allpage.php">

</head>

<body
  style="
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    font-family:Poppins,sans-serif;
    background:#ebe7dc;
  "
>

  <div
    style="
      background:white;
      padding:40px;
      border-radius:20px;
      box-shadow:0 10px 30px rgba(0,0,0,0.1);
      text-align:center;
    "
  >

    <h1>
      Logout Successful
    </h1>

    <p>
      Redirecting to All Cafes...
    </p>

  </div>

</body>
</html>