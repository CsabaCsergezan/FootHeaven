<?php
session_start();
if (isset($_SESSION['user'])) {
  header('Location: index.php');
  die();
}
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = sha1($_POST['password']);
  $repassword = sha1($_POST['repassword']);

  if ($password === $repassword) {

    require_once 'db.php';
    $link_to_db = get_db();

    $insert_query = "INSERT INTO users (`username`, `password`) VALUES ('$username', '$password');";
    $result = mysqli_query($link_to_db, $insert_query) or die(mysqli_error($link_to_db));

    if ($result) {
      $_SESSION['user'] = array(
        'username' => $username,
        'admin' => 0,
      );
      header('Location: index.php');
      die();
    }
  }
  echo "Passwords did not match!";
}
?>

<?php require_once 'header.php'; ?>

<div class="login_registration">
  <h2>Registration</h2>

  <form method="post">
    <p>Enter username<br />
    <input type="text" placeholder="Username" value="" name="username" required/>
    <p>Enter password<br />
    <input type="password" placeholder="Password" value="" name="password" required/>
    <p>Retype password<br />
    <input type="password" placeholder="Retype password" value="" name="repassword" required/>
    <p />
    <button type="submit">Register</button>
  </form>
</div>

<hr>
<p style="text-align: center;"> Copyright &#169 FootHaven , all rights reserved.</p>