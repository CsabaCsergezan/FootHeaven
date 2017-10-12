<?php
  session_start();
  $username = null;
  $isadmin = false;
  if(isset($_SESSION['user'])) {
    $username = $_SESSION['user']['username'];
    $isadmin = $_SESSION['user']['admin'] === 1;
  }

  require_once 'db.php';
  $link_to_db = get_db();

  $result =
    mysqli_query($link_to_db, "SELECT id, name, price, picture FROM `products`");

  $products = array();

  if ($result) {
    while ($product_row = mysqli_fetch_row($result)) {
        $products[] = array(
          'id' => (int)$product_row[0],
          'name' => $product_row[1],
          'price' => $product_row[2],
          'picture' => $product_row[3],
        );
    }
  }
?>

<div class="header">
<?php require_once 'header.php'; ?>
</div>
<br />

<div class="body">
  <div id="container_carousel">
    <img class="slides" src="pic1.jpg" />
    <img class="slides" src="pic2.jpg" />
    <img class="slides" src="pic3.jpg" />

    <button class="btn" onclick="plusIndex(-1)" id="btn1">&#10094;</button>
    <button class="btn" onclick="plusIndex(1)" id="btn2">&#10095;</button>

  </div>

  <script>
    var index = 1;

    function plusIndex(n) {
    index = index + n;
    showImage(index);
    }
    showImage(0);
    function showImage(n) {
      var i;
      var x = document.getElementsByClassName("slides");

      if(n > x.length) {
        index = 1;
      }
      if(n < 1) {
        index = x.length;
      }
      for(i=0;i<x.length;i++) {
        x[i].style.display = "none";
      }
      x[index-1].style.display = "block";
    }

    autoSlide();

    function autoSlide() {
      var i;
      var x = document.getElementsByClassName("slides");

      for(i=0;i<x.length;i++) {
        x[i].style.display = "none";
      }
      index++;
      if(index > x.length) {
        index = 1
      }
      x[index-1].style.display = "block";
      setTimeout(autoSlide,3000);
    }
  </script>
  <br />


  <p />
  <?php if (count($products) === 0): ?>
    <h2>No product in DB</h2>
  <?php else: ?>
       <table class="table table-hover-cells">
        <tbody>
          <tr>
          <?php
            $counter = 1;
            foreach ($products as $product): ?>
            <td class="td-hover">
              <center>
              <div class="prod_picture">
                <img height="175" width="200" src="<?=$product['picture']; ?>" />
              </div>
              <div class="prod_name">
                <h2><?=$product['name']; ?></h2>
              </div>
              <div class="prod_about">
                <p><?=$product['about']; ?></p>
              </div>
              <div class="prod_price">
                <p><?=$product['price']; ?>$</p>
              </div>
              <br />
              <div class="prod_link">
                <?php if ($username): ?>
                  <a href="add_to_cart.php?id=<?=$product['id']; ?>">Add to cart</a>
                <?php endif; ?>
              </div>
              </center>
            </td>
            <?php
              if ($counter % 4 == 0) {
              echo '</tr><tr>';
            }
              $counter++;
            ?>
          <?php endforeach; ?>
          </tr>
        </tbody>
      </table>
  <?php endif; ?>

  <hr>
  <p style="text-align: center;"> Copyright &#169 FootHaven , all rights reserved.</p>
</div>