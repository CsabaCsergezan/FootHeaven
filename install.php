<?php
session_start();
foreach ($_SESSION as $key => $value) {
  unset($_SESSION[$key]);
}
echo '<p>Cleaning up session data!</p>';

require_once 'db.php';
$link_to_db = get_db();

// setup user table
$users_drop_sql = "DROP TABLE IF EXISTS `users`;";

$users_create_sql = "CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$users_insert_sql = "INSERT INTO `users` (`id`, `username`, `password`, `admin`, `created_time`, `modified_time`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, '2017-04-01 20:02:29', NULL),
(2, 'user', '12dea96fec20593566ab75692c9949596833adc9', 0, '2017-04-01 20:02:29', NULL);";

$users_drop_result = mysqli_query($link_to_db, $users_drop_sql);
if ($users_drop_result) {
  echo '<p>User table successfully dropped!</p>';
}

$users_create_result = mysqli_query($link_to_db, $users_create_sql);
if ($users_create_result) {
  echo '<p>User table successfully created!</p>';
}

$users_insert_result = mysqli_query($link_to_db, $users_insert_sql);
if ($users_insert_result) {
  echo '<p>User table successfully populated!</p>';
}


//setup product table
$product_drop_sql = "DROP TABLE IF EXISTS `products`";

$product_create_sql = "CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale` tinyint(1) NOT NULL DEFAULT '0',
  `gender` varchar(1) NOT NULL DEFAULT 'u',
  `picture` varchar(250) NULL DEFAULT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$product_insert_sql = "INSERT INTO `products` (`id`, `name`, `price`, `sale`, `gender`, `picture`, `created_time`, `modified_time`) VALUES
(1, 'Murphy Conard', '158.95', 1, 'm', 'https://sits-pod49.demandware.net/dw/image/v2/AANO_PRD/on/demandware.static/-/Sites-genesco-master/default/dwc835b3c4/large/208681_master.jpg?sw=1590&sh=1497&sm=fit', '2017-08-21 10:04:26', NULL),
(2, 'Converse', '49.95', 1, 'u', 'https://media.journeys.com/images/products/1_52828_MD.JPG', '2017-08-21 10:04:26', NULL),
(3, 'Von Maur Naturalizer', '89.95', 0, 'f', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTNO6haWLsxzz8WzAA-zCnJ-dtJL7G0fdR9WBL-iEcBmZS4pLSCfw', '2017-08-21 10:04:26', NULL),
(4, 'Jordan', '120.95', 0, 'm', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSkdQy7VeISchMPzv-6daakE2yEINj8VHheVyNeEOCFni3p12vobA', '2017-08-21 10:04:26', NULL),
(5, 'Naturalizer Grace', '49.95', 1, 'f', 'http://www.naturalizer.com/productimages/shoes_idec0224649.jpg?trim.threshold=105&width=630&height=480&paddingWidth=60', '2017-08-21 10:04:26', NULL),
(6, 'Naturalizer Sandals', '99.95', 0, 'f', 'http://www.galyshoe.com/wp-content/uploads/2014/05/23/3/1025-Naturalizer-Women-s-Belinda-Sandals-in-Spinach-Turquoise-Smooth-2.jpg', '2017-08-21 10:04:26', NULL),
(7, 'Nike', '49.95', 1, 'f', 'https://i.ebayimg.com/thumbs/images/g/wW8AAOSwnONZCLZi/s-l225.jpg', '2017-08-21 10:04:26', NULL),
(8, 'Nike', '214.54', 0, 'm', 'https://images.nike.com/is/image/DotCom/PDP_THUMB_RETINA/849559_001/air-max-2017-running-shoe.jpg', '2017-08-21 10:04:48', NULL);";


$product_drop_result = mysqli_query($link_to_db, $product_drop_sql);
if ($product_drop_result) {
  echo '<p>Product table successfully dropped!</p>';
}

$product_create_result = mysqli_query($link_to_db, $product_create_sql);
if ($product_create_result) {
  echo '<p>Product table successfully created!</p>';
}

$product_insert_result = mysqli_query($link_to_db, $product_insert_sql);
if ($product_insert_result) {
  echo '<p>Product table successfully populated!</p>';
}

?>

<a href="index.php">Home</a>
