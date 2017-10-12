<?php
  session_start();
  $username = null;
  $isadmin = false;
  if(isset($_SESSION['user'])) {
    $username = $_SESSION['user']['username'];
    $isadmin = $_SESSION['user']['admin'] === 1;
  }

  require_once 'db.php';
  $link_to_db = get_db();

  $result =
    mysqli_query($link_to_db, "SELECT id, name, price, sale, picture FROM `products` WHERE sale = 1");

  $products = array();

  if ($result) {
    while ($product_row = mysqli_fetch_row($result)) {
        $products[] = array(
          'id' => (int)$product_row[0],
          'name' => $product_row[1],
          'price' => $product_row[2],
          'sale' => $product_row[3],
          'picture' => $product_row[4],
        );
    }
  }
?>

<?php require_once 'header.php'; ?>

  <center><h2>Sale%</h2></center>

<p />
<?php if (count($products) === 0): ?>
  <h2>Nothing at sale.</h2>
<?php else: ?>
     <table class="table table-hover-cells">
      <tbody>
        <tr>
        <?php
          $counter = 1;
          foreach ($products as $product): ?>
          <td class="td-hover">
            <center>
            <div class="prod_picture">
              <img height="175" width="200" src="<?=$product['picture']; ?>" />
            </div>
            <div class="prod_name">
              <h2><?=$product['name']; ?></h2>
            </div>
            <div class="prod_about">
              <p><?=$product['about']; ?></p>
            </div>
            <div class="prod_price">
              <p><?=$product['price']; ?>$</p>
            </div>
            <br />
            <div class="prod_link">
              <?php if ($username): ?>
                <a href="add_to_cart.php?id=<?=$product['id']; ?>">Add to cart</a>
              <?php endif; ?>
            </div>
            </center>
          </td>
          <?php
            if ($counter % 4 == 0) {
            echo '</tr><tr>';
          }
            $counter++;
          ?>
        <?php endforeach; ?>
        </tr>
      </tbody>
    </table>
<?php endif; ?>

<hr>
<p style="text-align: center;"> Copyright &#169 FootHaven , all rights reserved.</p>