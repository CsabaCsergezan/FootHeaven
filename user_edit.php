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
  <h2>User edit</h2>

  <?php
  //validate user id
  $is_valid_id = true;
  $user = array();

  if (false === array_key_exists('id', $_GET)) {
    $is_valid_id = false;
  } else {
    $id = (int)$_GET['id'];

    if ($id === 0) {
      $is_valid_id = false;
    } else {
      require_once 'db.php';
      $link_to_db = get_db();

      $user_result =
        mysqli_query($link_to_db, "SELECT id, username, admin FROM `users` WHERE id=$id");

      if ($user_result) {
        $user_row = mysqli_fetch_row($user_result);

        if ($user_row) {
          $user['id'] = (int)$user_row[0];
          $user['username'] = $user_row[1];
          $user['admin'] = (int)$user_row[2];
        } else {
          $is_valid_id = false;
        }
      } else {
        $is_valid_id = false;
      }
    }
  }



  if (false === $is_valid_id): ?>
    <h1>Invalid user id</h1>
  <?php return; endif; ?>


  <?php
  // update logic
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $admin = array_key_exists('admin', $_POST) && $_POST['admin'] === 'Yes' ? 1 : 0;


    require_once 'db.php';
    $link_to_db = get_db();

    $update_query = "UPDATE `users` SET `username` = '$username', `admin` = '$admin', `modified_time` = CURRENT_TIME() WHERE `users`.`id` = $id;";
    $result = mysqli_query($link_to_db, $update_query) or die(mysqli_error($link_to_db));

    if ($result) {
      echo '<h2>User ' . $username . ' successfully updated!</h2>';

      $user_result =
        mysqli_query($link_to_db, "SELECT id, username, admin FROM `users` WHERE id=$id");
      if ($user_result) {
        $user_row = mysqli_fetch_row($user_result);
        if ($user_row) {
          $user['id'] = (int)$user_row[0];
          $user['username'] = $user_row[1];
          $user['admin'] = (int)$user_row[2];
        }
      }
    }
  }
  ?>

  <form method="post">
    <input type="hidden" name="id" value="<?=$user['id'];?>" />
    <p>Enter username<br />
    <input type="text" placeholder="Username" value="<?=$user['username'];?>" name="username" />
    <p>Admin<br />
    <input type="checkbox" name="admin" value="Yes" <?php echo $user['admin'] === 1 ? 'checked' : ''; ?> />
    <p />
    <button type="submit">Submit</button>
  </form>
</div>

<hr>
<p style="text-align: center;"> Copyright &#169 FootHaven , all rights reserved.</p>