<?php 
  
  if(isset($_GET['action'])){
    $action = $_GET['action'];

    switch($action){
      case 'add':
          $product_id = $_GET['product_id'];
          $result = Cart::addToCart($product_id);
        
          if($result === true){
            echo "product added to cart successfully " . $result;
          }
          else{
            echo "server error: " . $result;
          }
        break;

      case "view":
        include "view/cart.php";
        break;

      case "checkout":
        include "view/checkout.php";
        break;

      default:
        break;
    }
  }

?>