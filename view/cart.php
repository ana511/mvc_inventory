<div class="cart">
  <h1>Shopping Cart</h1>

  <?php
    $subtotal = 0;

    if(isset($_SESSION['cart']) && sizeof($_SESSION['cart']['products']) > 0){
      echo "<table>";
        echo "<thead>";
          echo "<tr>";
            echo "<th>id</th>";
            echo "<th>name</th>";
            echo "<th>price</th>";
            echo "<th>qty</th>";
            echo "<th>subtotal</th>";
          echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        foreach($_SESSION['cart']['products'] as $product){
          $subtotal = $product['price'] * $product['qty'];

          echo "<tr>";
            echo "<td>{$product['id']}</td>";
            echo "<td>{$product['name']}</td>";
            echo "<td>" . "$" . "{$product['price']}</td>";
            echo "<td>{$product['qty']}</td>";
            echo "<td>$" . "{$subtotal}</td>";
          echo "</tr>";
        }

          echo "<tr>";
            echo "<td colspan='3'></td>";
            echo "<td><strong>total</strong></td>";
            echo "<td><strong>$" . "{$_SESSION['cart']['total']}</strong></td>";
          echo "</tr>";
        echo "</tbody>";
      echo "</table>";
    }
  ?>

  <a class="btn" href="index.php?page=cart&action=checkout">checkout</a>
</div>