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
    mysqli_query($link_to_db, "SELECT id, username, admin FROM `users`");

  $users = array();

  if ($result) {
    while ($user_row = mysqli_fetch_row($result)) {
        $users[] = array(
          'id' => (int)$user_row[0],
          'username' => $user_row[1],
          'admin' => (int)$user_row[2],
        );
    }
  }
?>

<?php require_once 'header.php'; ?>


<h2>Users administration</h2>
<a href="user_create.php">Create new user</a>

<?php if (count($users) === 0): ?>
  <h2>No users in DB</h2>
<?php else: ?>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Admin</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
        <tr>
          <td><?=$user['id']; ?></td>
          <td><?=$user['username']; ?></td>
          <td><?=$user['admin'] === 1 ? 'true' : 'false' ; ?></td>
          <td>
            <a href="user_edit.php?id=<?=$user['id']; ?>">Edit</a>
            /
            <a href="user_delete.php?id=<?=$user['id']; ?>">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

<hr>
<p style="text-align: center;"> Copyright &#169 FootHaven , all rights reserved.</p>