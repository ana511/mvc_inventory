<div class="home">    
  <h1>Hello World</h1>

  <?php

    if(isset($_SESSION['loggedin'])){
      echo "<p>Welcome, {$_SESSION['username']}</p>";
    }

    if(gettype($products) !== 'string'){
      echo "<div class='products_list'>";

      while($product = $products->fetch_assoc()) {
        echo "<div>";
          echo "<span>name: {$product['name']}</span>";
          echo "<span>price:{$product['price']}</span>";
          echo "<span>manufacturer: {$product['manufacturer']}</span>";
          echo "<span>stock: {$product['stock']}</span>";

          if(isset($_SESSION['loggedin'])){
            echo "<a href='#' data-product-id='{$product['id']}'>Add to cart</a>";
          }

        echo "</div>";
      }

      echo "</div>";
    }
    else{
      echo "Unable to retrieve products: " . $products; 
    }


    if(isset($_SESSION['cart'])){
      var_dump($_SESSION['cart']['products']);
    }
  ?>
</div>
