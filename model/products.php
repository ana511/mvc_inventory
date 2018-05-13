<?php
  class Products{
    static function addProduct(){
        global $mysqli;
        
        if(isset($_SESSION['loggedin']) && Accounts::isAdmin() === true){
          $product = SELF::sanitize();
          $result = SELF::validate($product);

          if($result === true){
            $query_string = "INSERT INTO products(name, price, manufacturer, stock) VALUES (?, ?, ?, ?)";
            $statement = $mysqli->prepare($query_string);
            $statement->bind_param("sfsi", $product['name'], $product['price'], $product['manufacturer'], $product['stock']);
            $db_result = $statement->execute();
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
      global $mysqli;

      if(isset($_SESSION['loggedin']) && Accounts::isAdmin() === true){
        $query_string = "DELETE FROM products WHERE id=?";
        $statement = $mysqli->prepare($query_string);
        $statement->bind_param($product_id);

        if($statement->execute() == true)
          return true;
        else
          return "an error occurred: " . $mysqli->error;
      }
      else{
        return "access denied";
      }
    }

    static function updateProduct($product_id){
      global $mysqli;

      if(isset($_SESSION['loggedin']) && Accounts::isAdmin() === true){

      }
      else{
        return "access denied";
      }
    }

    static function getProduct($product_id){
      global $mysqli;

      $id = intval($product_id);
      $query_string = "SELECT * FROM products WHERE id=$id";
      $result = $mysqli->query($query_string);

      if($result->num_rows > 0){
        return $result->fetch_assoc();
      }
      else{
        return "not found";
      }
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