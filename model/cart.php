<?php

  class Cart{
    static function addToCart($product_id){
      global $mysqli;

      $product_id = SELF::sanitize();
      $result = SELF::validate($product_id);

      if($result === true){
        $query_string = "SELECT * FROM products WHERE id='{$product_id}'";
        $db_res = $mysqli->query($query_string);

        if($db_res->num_rows > 0){
          $product = $db_res->fetch_assoc();

          //if CART already exists
          if(isset($_SESSION['cart'])){
            //increment product's quantity to Shopping list
            $_SESSION['cart']['products'][$product_id]['qty']++;
          }
          //CART does not exist
          else{
            $prod = array(
              "name" => $product['name'],
              "price" => $product['price'],
              "qty" => 1,
              "id" => $product['id']
            );

            array_push($_SESSION['cart']['products'], $prod);

          }
        }
        return $mysqli->error;
      }
      else{
        return "invalid product id";
      }

      return true;
    }

    static function removeCart(){

    }

    static function deleteCart(){

    }

    static function updateCart(){

    }

    private function calculateTotal(){

    }

    private function calculateTotalItems(){

    }

    public function totalItems(){

    }

    private function validate(){
      return true;
    }

    private function sanitize(){
      $product_id = $_GET['product_id'];

      return $product_id;
    }
  }

?>