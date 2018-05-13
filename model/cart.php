<?php

  class Cart{
    private function add(){

    }

    static function addToCart($product_id){
      $product_id = SELF::sanitize();
      $isValid = SELF::validate($product_id);
      
      if($isValid === true){
        if(isset($_SESSION['cart'])){
          if(isset($_SESSION['cart']['products'][$product_id])){
            $_SESSION['cart']['products'][$product_id]['qty']++;
            $_SESSION['cart']['total'] += $_SESSION['cart']['products'][$product_id]['price'] * $_SESSION['cart']['products'][$product_id]['qty'];
            $_SESSION['cart']['numItems']++;

            return true;
          }
          else{
            $product = Products::getProduct($product_id);

            if(gettype($product) !== 'string'){
              $product['qty'] = 1;
              array_push($_SESSION['cart']['products'], $product);
              $_SESSION['cart']['total'] += $product['price'] * $product['qty'];
              $_SESSION['cart']['numItems']++;

              return true;
            }
            else{
              return "unable to find product in db";
            }
          }
        }
        else{
          $product = Products::getProduct($product_id);

          if(gettype($product) !== 'string'){
            $product['qty'] = 1;
            $_SESSION['cart']['products'] = array($product['id'] => $product);
            $_SESSION['cart']['total'] = $product['price'];
            $_SESSION['cart']['numItems'] = 1;

            return true;
          }
          else{
            return "unable to find product in db";
          }
        }
      }
      else{
        return "invalid data";
      }
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