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
?>

<?php require_once 'header.php'; ?>

<?php
//validate product id
$is_valid_id = true;

if (false === array_key_exists('id', $_GET)) {
  $is_valid_id = false;
} else {
  $id = (int)$_GET['id'];

  if ($id === 0) {
    $is_valid_id = false;
  } else {
    require_once 'db.php';
    $link_to_db = get_db();

    $product_result =
      mysqli_query($link_to_db,"DELETE FROM `products` WHERE `products`.`id` = $id");

    if ($product_result) {
      echo '<h1>Product with id ' . $id . ' deleted!</h1>';
    }
  }
}

if (false === $is_valid_id): ?>
  <h2>Invalid product id</h2>
<?php return; endif; ?>

<hr>
<p style="text-align: center;"> Copyright &#169 FootHaven , all rights reserved.</p>