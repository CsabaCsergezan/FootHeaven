<?php
session_start();
if(!isset($_SESSION['user'])) {
  header('Location: index.php');
  die();
}

$id = (int)$_GET['id'];
if (!isset($_SESSION['ids_in_cart'])) {
  $_SESSION['ids_in_cart'] = array($id);
} else {
  $_SESSION['ids_in_cart'][] = $id;
}
header('Location: cart.php');
die();
