<?php
  session_start();
  $username = null;
  $isadmin = false;
  if(isset($_SESSION['user'])) {
    $username = $_SESSION['user']['username'];
    $isadmin = $_SESSION['user']['admin'] === 1;
  }
  if (!$isadmin) {
    header('Location: index.php');
    die();
  }


  require_once 'db.php';
  $link_to_db = get_db();

  $result =
    mysqli_query($link_to_db, "SELECT id, name, price, sale, gender, picture FROM `products`");

  $products = array();

  if ($result) {
    while ($product_row = mysqli_fetch_row($result)) {
        $products[] = array(
          'id' => (int)$product_row[0],
          'name' => $product_row[1],
          'price' => $product_row[2],
          'sale' => (int)$product_row[3],
          'gender' => $product_row[4],
          'picture' => $product_row[5],
        );
    }
  }
?>

<?php require_once 'header.php'; ?>

<h2>Product administration</h2>
<a href="product_create.php">Create new product</a>

<?php if (count($products) === 0): ?>
  <h2>No product in DB</h2>
<?php else: ?>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Picture</th>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Sale</th>
        <th>Gender</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $product): ?>
        <tr>
          <td><img height="80" width="75" src="<?=$product['picture']; ?>" /></td>
          <td><?=$product['id']; ?></td>
          <td><?=$product['name']; ?></td>
          <td><?=$product['price']; ?></td>
          <td><?=$product['sale'] === 1 ? 'true' : 'false' ; ?></td>
          <td><?=$product['gender']; ?></td>
          <td>
            <a href="product_edit.php?id=<?=$product['id']; ?>">Edit</a>
            /
            <a href="product_delete.php?id=<?=$product['id']; ?>">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>


<hr>
<p style="text-align: center;"> Copyright &#169 FootHaven , all rights reserved.</p>