<?php
  class Products{
    static function addProduct(){
        global $mysqli;
        
        if(isset($_SESSION['loggedin']) && Accounts::isAdmin() === true){
          $product = SELF::sanitize();
          $result = SELF::validate($product);

          if($result === true){
            $query_string = "INSERT INTO products(name, price, manufacturer, stock) VALUES ('{$product['name']}', {$product['price']}, '{$product['manufacturer']}', {$product['stock']})";
            $db_result = $mysqli->query($query_string);
            return $db_result;
          }
          else{
            return $result;
          }
        }
        else{
          return "access denied";
        }
    }

    static function removeProduct($product_id){
      
    }

    static function updateProduct($product_id){

    }

    static function getProduct($product_id){

    }

    static function getAllProducts(){
        global $mysqli;

        $query_string = "SELECT * FROM products";
        $results = $mysqli->query($query_string);

        if ($results->num_rows > 0) {
          return $results;
        }
        else{
          return "an error occurred - no results";
        }
          
        return "You must be logged in and possess admin access rights to see the inventory.";
    }

    private function sanitize(){
      $product = array(
        "name" => filter_var($_POST['name'], FILTER_SANITIZE_STRING),
        "price" => floatval(filter_var($_POST['price'], FILTER_SANITIZE_STRING)),
        "manufacturer" => filter_var($_POST['manufacturer'], FILTER_SANITIZE_STRING),
        "stock" => intval(filter_var($_POST['stock'], FILTER_SANITIZE_STRING))
      );

      return $product;
    }

    private function validate($prod){
      $isValid = true;

      try{
        if(strlen($prod['name']) < 3){
          throw new Exception("invalid product name");
        }

        if($prod['price'] <= 0 || $prod['price'] > 100000){
          throw new Exception("invalid price");
        }

        if(strlen($prod['manufacturer']) < 3){
          throw new Exception("invalid manufacturer");
        }

        if($prod['stock']  < 0 || $prod['stock'] > 100000){
          throw new Exception("invalid stock");
        }
      }
      catch(Exception $e){
        return "error: " . $e->getMessage();
      }

      return $isValid = true;
    }
  }

?>