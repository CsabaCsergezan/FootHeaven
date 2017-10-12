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

<div class="user_creat_edit">
  <h2>User creation</h2>

  <?php
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = sha1($_POST['password']);

    require_once 'db.php';
    $link_to_db = get_db();


    $insert_query = "INSERT INTO users (`username`, `password`) VALUES ('$username', '$password');";
    $result = mysqli_query($link_to_db, $insert_query) or die(mysqli_error($link_to_db));

    if ($result) {
      echo '<h2>User ' . $username . ' successfully created!</h2>';
    }
  }
  ?>

  <form method="post">
    <p>Enter username<br />
    <input type="text" placeholder="Username" value="" name="username" required/>
    <p>Enter user password<br />
    <input type="password" placeholder="Password" value="" name="password" required/>
    <p />
    <button type="submit">Submit</button>
  </form>
</div>

<hr>
<p style="text-align: center;"> Copyright &#169 FootHaven , all rights reserved.</p>