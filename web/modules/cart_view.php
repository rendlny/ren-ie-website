<?php
include $_SERVER['DOCUMENT_ROOT'].'/web/start.php';
use Controllers\ItemController;

$current_page = 'Cart';
$cartRows = NULL;

if(isset($_SESSION['cart'])){
  foreach ($_SESSION['cart'] as $cartItem) {
    $item = ItemController::getItemByCode($cartItem['code']);
    $cartRows .= '
      <tr>
        <td>'.$item->title.'</td>
        <td>'.$cartItem['quantity'].'</td>
        <td></td>
      </tr>
    ';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <?php include '../assets/php/head.php'; ?>
  <body>
    <div id="ms-preload" class="ms-preload">
      <div id="status">
        <div class="spinner">
          <div class="dot1"></div>
          <div class="dot2"></div>
        </div>
      </div>
    </div>
    <div class="ms-site-container">
      <?php
        include '../assets/php/header.php';
        include '../assets/php/navbar.php';
      ?>

      <div>
        <table>
          <thead>
            <tr>
              <th>Item</th>
              <th>Qty</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <?=$cartRows?>
          </tbody>
        </table>
      </div>

      <?php
        include '../assets/php/footer.php';
      ?>
    </div> <!-- ms-site-container -->
    <?php include '../assets/php/sidebar.php'; ?>
    <script src="/web/assets/js/plugins.min.js"></script>
    <script src="/web/assets/js/app.min.js"></script>
    <script src="/web/assets/js/ecommerce.js"></script>
    <script src="/web/assets/js/jquery.matchHeight.js" type="text/javascript"></script>
  </body>
</html>
