<div class="dashboard">
  <h1>Inventory</h1>

  <div class="row">
    <form method="POST" action="index.php?page=inventory&action=add" id="submit_product">
      <div class="field">
        <label>Name:</label>
        <input type="text" name="name"/>
      </div>
      <div class="field">
        <label>Price:</label>
        <input type="number" name="price"/>
      </div>
      <div class="field">
        <label>Manufacturer:</label>
        <input type="text" name="manufacturer"/>
      </div>
      <div class="field">
        <label>Stock</label>
        <input type="number" name="stock"/>
      </div>
        <input type="submit" value="add product"/>
    </form>

    <?php
      
      echo "<table>";
        echo "<thead>";
          echo "<tr>";
            echo "<td>Name</td>";
            echo "<td>Price</td>";
            echo "<td>Manufacturer</td>";
            echo "<td>Stock</td>";
          echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        if(gettype($products) !== 'string'){
          while($product = $products->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$product['name']}</td>";
            echo "<td>{$product['price']}</td>";
            echo "<td>{$product['manufacturer']}</td>";
            echo "<td>{$product['stock']}</td>";
            echo "</tr>";
          }
        }
        else{
          echo "Unable to retrieve products: " . $products; 
        }

        echo "</tbody>";
      echo "</table>";

    ?>
  </div>

  <a href="index.php?page=authentication&action=signout&csrf=<?php echo $_SESSION['token']?>">sign out</a>
</div>