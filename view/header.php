<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <script type="text/javascript" src="assets/js/cart.js"></script>
</head>
<body>
  <header>
    <nav>
      <a href="index.php?page=home">Home</a>
      <a href="index.php?page=about">About</a>
      <a href="index.php?page=contact">Contact</a>
      <a href="index.php?page=authentication">Signin/Signup</a>
      <?php 

      if(isset($_SESSION['loggedin'])){
        echo "<a href='index.php?page=authentication&action=signout'>Logout</a>";
      }

      ?>
    </nav>

    <?php 

      if(isset($_SESSION['cart'])){
        echo "<span style='float:right;'>cart icon</span>";
      }
    ?>

  </header>
  <main>