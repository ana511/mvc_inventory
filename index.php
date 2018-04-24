<?php 
  session_start();

  include 'model/products.php';
  include 'model/accounts.php';
  include 'model/cart.php';

  if(!isset($_SESSION["token"]))
    $_SESSION["token"] = md5(uniqid(mt_rand(), true));

  include "model/connect.php";
  include 'view/header.php';


  if(isset($_GET['page'])){
    $page = $_GET['page'];

    switch($page){
      case 'home':
        $products = Products::getAllProducts();
        include 'view/home.php';
        break;

      case 'contact':
        include 'view/contact.php';
        break;

      case 'about':
        include 'view/about.php';
        break;

      case 'authentication':
        include 'controller/authentication.php';
        break;

      case 'inventory':
        include 'controller/inventory.php';
        break;

      case 'cart':
        include 'controller/cart.php';
        break;

      default : 
        break;
    }
  }
  else{
    include 'view/home.php';
  }

  include 'view/footer.php';

?>