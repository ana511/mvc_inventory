<?php 

  if(isset($_GET['action'])){
    $action = $_GET['action'];

    switch($action){
      case 'add': 
        $result = Products::addProduct();

        if($result === true){
          echo "product was added successfully";
          unset($_SESSION['errorMsg']);
        }
        else{
          echo "unable to add product: " . $result;
        }
        //TODO
        break;

      case 'update':
        break;

      case 'delete':
        break;

      default:
        break;
    }

    $products = Products::getAllProducts();
    include "view/dashboard.php";
  }

?>