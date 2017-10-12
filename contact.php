<?php
  session_start();
  $username = null;
  $isadmin = false;
  if(isset($_SESSION['user'])) {
    $username = $_SESSION['user']['username'];
    $isadmin = $_SESSION['user']['admin'] === 1;
  }
 ?>

<?php require_once 'header.php'; ?>

<div id="contact">
  <h2>Contact Us</h2>
  <br />

  <p>If you would like to provide any feedback on our service, please write us at
    <br />
    <a href="mailto:bla.bla@gmail.com">bla.bla[@][gmail].com</a>
  </p>
</div>
<hr>
<p style="text-align: center;"> Copyright &#169 FootHaven , all rights reserved.</p>