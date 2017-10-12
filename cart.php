<?php
session_start();
$username = null;
$isadmin = false;
if(isset($_SESSION['user'])) {
  $username = $_SESSION['user']['username'];
  $isadmin = $_SESSION['user']['admin'] === 1;
}
if(!isset($_SESSION['user'])) {
  header('Location: index.php');
  die();
}

$ids = array();
$count = array();
if(isset($_SESSION['ids_in_cart'])) {
  foreach ($_SESSION['ids_in_cart'] as $id) {
    if (!in_array($id, $ids)) {
      $ids[] = $id;
      $count[$id] = 1;
    } else {
      $count[$id]++;
    }
  }
}
$ids_str = implode(',', $ids);

require_once 'db.php';
$link_to_db = get_db();

$cart_query = "SELECT id, name, price, picture FROM `products` WHERE id in ($ids_str)";
$result = mysqli_query($link_to_db, $cart_query);

$products = array();

if ($result) {
  while ($product_row = mysqli_fetch_row($result)) {
      $products[] = array(
        'id' => (int)$product_row[0],
        'name' => $product_row[1],
        'price' => $product_row[2],
        'picture' => $product_row[3],
      );
  }
}
?>

<?php require_once 'header.php'; ?>

<?php if (count($products) === 0): ?>
  <h2>No products in Cart</h2>
<?php else: ?>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Picture</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $total = 0;
      foreach ($products as $product):
        $total += $product['price'] * $count[$product['id']];
        ?>
        <tr>
          <td><img height="80" width="75" src="<?=$product['picture']; ?>" /></td>
          <td><?=$product['name']; ?></td>
          <td><?=$product['price']; ?></td>
          <td><?=$count[$product['id']]; ?></td>
          <td>
            <a href="delete_from_cart.php?id=<?=$product['id']; ?>">Delete from cart</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div class="row" id="cart_pay">
    <h2>Your total: <?=$total; ?></h2>
    <button id="pay_button">Pay</button>
  </div>
<?php endif; ?>

<hr>
<p style="text-align: center;"> Copyright &#169 FootHaven , all rights reserved.</p>