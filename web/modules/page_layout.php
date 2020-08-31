<?php
include $_SERVER['DOCUMENT_ROOT'].'/web/start.php';
use Controllers\ItemController;

$current_page = 'home.php';

if(isset($_GET['page'])){
  switch($_GET['page']){
    case 'home':
      $current_page = 'home.php';
      $page_title = 'Home';
      $meta_desc = '';
      break;

    case 'about':
      $current_page = 'about.php';
      $page_title = 'About';
      break;

    case 'store':
      $current_page = (isset($_GET['code']) && $_GET['code'] != NULL) ? 'item_view.php' : 'pin_trading.php';
      $item = (isset($_GET['code']) && $_GET['code'] != NULL) ? ItemController::getItemByCode($_GET['code']) : NULL;
      $page_title = (isset($_GET['code']) && $_GET['code'] != NULL) ? 'Store | '.$item->title : 'Store';
      break;

    case 'order':
      $current_page = (isset($_GET['code']) && $_GET['code'] != NULL) ? 'item_order.php' : 'pin_trading.php';
      $page_title = 'Order Form';
      $meta_desc = 'Order Item';
      break;

    case 'ordersuccess':
      $current_page = 'item_order_success.php';
      $page_title = 'Order Success';
      $meta_desc = 'Order Success';
      break;

    case 'links':
      $current_page = 'links.php';
      $page_title = 'Links';
      break;

    case 'view-item':
      $current_page = 'item_view.php';
      $page_title = 'View Item';
      break;
  }
}

$web_data = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/website_data.ini', true);

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
        include $current_page;
        include '../assets/php/footer.php';
      ?>
    </div> <!-- ms-site-container -->
    <?php include '../assets/php/sidebar.php'; ?>
    <script src="/web/assets/js/plugins.min.js"></script>
    <script src="/web/assets/js/app.min.js"></script>
    <script src="/web/assets/js/ecommerce.js"></script>
    <script src="/web/assets/js/jquery.matchHeight.js"></script>
  </body>
</html>
