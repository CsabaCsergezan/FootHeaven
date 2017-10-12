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

<div class="prod_creat_edit">
  <h2>Product edit</h2>

  <?php
  //validate product id
  $is_valid_id = true;
  $product = array();

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
        mysqli_query($link_to_db, "SELECT id, name, price, sale, gender, picture FROM `products` WHERE id=$id");

      if ($product_result) {
        $product_row = mysqli_fetch_row($product_result);

        if ($product_row) {
          $product['id'] = (int)$product_row[0];
          $product['name'] = $product_row[1];
          $product['price'] = $product_row[2];
          $product['sale'] = (int)$product_row[3];
          $product['gender'] = $product_row[4];
          $product['picture'] = $product_row[5];
        } else {
          $is_valid_id = false;
        }
      } else {
        $is_valid_id = false;
      }
    }
  }



  if (false === $is_valid_id): ?>
    <h1>Invalid product id</h1>
  <?php return; endif; ?>


  <?php
  // update logic
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $sale = array_key_exists('sale', $_POST) && $_POST['sale'] === 'Yes' ? 1 : 0;
    $gender = $_POST['gender'];
    $picture = $_POST['picture'];


    require_once 'db.php';
    $link_to_db = get_db();

    $update_query = "UPDATE `products` SET `name` = '$name', `price` = '$price', `sale` = '$sale', `gender` = '$gender', `picture` = '$picture', `modified_time` = CURRENT_TIME() WHERE `products`.`id` = $id;";
    $result = mysqli_query($link_to_db, $update_query) or die(mysqli_error($link_to_db));

    if ($result) {
      echo '<h2>Product ' . $name . ' successfully updated!</h2>';

      $product_result =
        mysqli_query($link_to_db, "SELECT id, name, price, sale, gender, picture FROM `products` WHERE id=$id");
      if ($product_result) {
        $product_row = mysqli_fetch_row($product_result);
        if ($product_row) {
          $product['id'] = (int)$product_row[0];
          $product['name'] = $product_row[1];
          $product['price'] = $product_row[2];
          $product['sale'] = (int)$product_row[3];
          $product['gender'] = $product_row[4];
          $product['picture'] = $product_row[5];
        }
      }
    }
  }
  ?>


  <form method="post">
    <input type="hidden" name="id" value="<?=$product['id'];?>" />
    <span>Enter name</span><br />
    <input type="text" placeholder="Product name" value="<?=$product['name'];?>" name="name" />
    <p />
    <span>Price</span><br />
    <input type="text" placeholder="Product price" name="price" value="<?=$product['price'];?>" />
    <p />
    <span>Sale</span><br />
    <input type="checkbox" name="sale" value="Yes" <?php echo $product['sale'] === 1 ? 'checked' : ''; ?> />
    <p />
    <span>Choose gender</span><br />
    <select name="gender">
      <option <?=$product['gender'] === 'u' ? 'selected="selected"' : ''; ?> value="u">unisex</option>
      <option <?=$product['gender'] === 'm' ? 'selected="selected"' : ''; ?> value="m">male</option>
      <option <?=$product['gender'] === 'f' ? 'selected="selected"' : ''; ?> value="f">female</option>
    </select>
    <p />
    <span>Picture URL</span><br />
    <input type="text" placeholder="Porduct picture URL" value="<?=$product['picture'];?>" name="picture" />
    <p />
    <button type="submit">Submit</button>
  </form>
</div>

<hr>
<p style="text-align: center;"> Copyright &#169 FootHaven , all rights reserved.</p>