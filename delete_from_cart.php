<?php
session_start();
if(!isset($_SESSION['user'])) {
  header('Location: index.php');
  die();
}

$id = (int)$_GET['id'];
if (isset($_SESSION['ids_in_cart'])) {
  $_SESSION['ids_in_cart'] = array_diff($_SESSION['ids_in_cart'], array($id));
}

header('Location: cart.php');
die();
?>

<hr>
<p style="text-align: center;"> Copyright &#169 FootHaven , all rights reserved.</p>