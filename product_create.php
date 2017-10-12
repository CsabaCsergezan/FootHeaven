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
  <h2>Product creation</h2>

  <?php
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $gender = $_POST['gender'];
    $picture = $_POST['picture'];

    require_once 'db.php';
    $link_to_db = get_db();


    $insert_query = "INSERT INTO products (`name`, `price`, `gender`, `picture`) VALUES ('$name', '$price', '$gender', '$picture');";
    $result = mysqli_query($link_to_db, $insert_query) or die(mysqli_error($link_to_db));

    if ($result) {
      echo '<h2>Product ' . $name . ' successfully created!</h2>';
    }
  }
  ?>

  <form method="post">
    <span>Enter product name</span><br />
    <input type="text" placeholder="Product name" value="" name="name" required/>
    <p />
    <span>Enter product price</span><br />
    <input type="text" placeholder="Product price" value="" name="price" required/>
    <p />
    <span>Choose gender</span><br />
    <select>
      <option value="u">unisex</option>
      <option value="m">male</option>
      <option value="f">female</option>
    </select>
    <p />
    <p>Enter picture URL<br />
    <input type="text" placeholder="Porduct picture URL" value="" name="picture" required/></p>
    <p />
    <button type="submit">Submit</button>
  </form>
</div>

<hr>
<p style="text-align: center;"> Copyright &#169 FootHaven , all rights reserved.</p>