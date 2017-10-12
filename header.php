<html>
<head>
    <title>FootHeaven</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
  <script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
  <script src="node_modules/tether/dist/js/tether.min.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">FootHeaven</a>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="male.php">Male</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="female.php">Female</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="sale.php">Sale</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
      </li>
      <?php if ($isadmin): ?>
        <li class="nav-item">
          <a class="nav-link" href="product_list.php">Product list</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="user_list.php">User list</a>
        </li>
      <?php endif; ?>
    </ul>
    <span class="navbar-text">
        <?php if ($username): ?>
          Welcome <?=$username; ?>!
          <a href="log_out.php">Log out</a>
          |
          <a href="cart.php"><img src="cart.png" width="25px"; height="25px;"></a>
        <?php else : ?>
          <a href="login.php">Login</a>
          |
          <a href="register.php">Registration</a>
        <?php endif; ?>
    </span>
  </div>
</nav>
<br />
</body>