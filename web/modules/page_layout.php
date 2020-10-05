<?php
include $_SERVER['DOCUMENT_ROOT'].'/web/start.php';
use Controllers\ItemController;
use Controllers\LinkController;

$links = LinkController::getActiveLinks();

$current_page = 'home.php';
$noticeAlert = NULL;

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
      $current_page = (isset($_GET['code']) && $_GET['code'] != NULL) ? 'item_view.php' : 'store.php';
      $item = (isset($_GET['code']) && $_GET['code'] != NULL) ? ItemController::getItemBySlug($_GET['code']) : NULL;
      $page_title = (isset($_GET['code']) && $_GET['code'] != NULL) ? 'Store | '.$item->title : 'Store';
      break;

    case 'order':
      $current_page = (isset($_GET['code']) && $_GET['code'] != NULL) ? 'item_order.php' : 'store.php';
      $page_title = 'Order Form';
      $meta_desc = 'Order Item';
      break;

    case 'ordersuccess':
      $current_page = 'item_order_success.php';
      $page_title = 'Order Success';
      $meta_desc = 'Order Success';
      break;

    case 'coding':
      $current_page = 'coding.php';
      $page_title = 'Coding';
      $meta_desc = 'Coding';
      break;

    case 'music':
      $current_page = 'music.php';
      $page_title = 'Music';
      $meta_desc = 'Music';
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

if(!isset($_SESSION['notice-read']) || $_SESSION['notice-read'] != 'yes'){
  $noticeAlert = '
    <div class="alert alert-royal alert-dismissible" role="alert" style="margin-bottom:0px;">
      <button id="noticeBtn" type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="zmdi zmdi-close"></i></button>
      <p>
        <i class="fa fa-exclamation-circle"></i>&nbsp;
        KalciumCove.ie is changing to <a href="https://www.ren.ie"><strong>ren.ie</strong></a>
        In November KalciumCove.ie will no longer work and you will need to use <a href="https://www.ren.ie"><strong>ren.ie</strong></a> to access this site.
      </p>
    </div>
  ';
  $_SESSION['notice-read'] = 'no';
}

?>
<!DOCTYPE html>
<html lang="en">
  <?php include '../assets/php/head.php'; ?>
  <body>

    <div id="status">
      <div class="spinner">
        <div class="dot1"></div>
        <div class="dot2"></div>
      </div>
    </div>

    <div class="ms-site-container">
      <?php
        include '../assets/php/header.php';
        include '../assets/php/navbar.php';
      ?>

      <?=$noticeAlert?>

      <?php
        include $current_page;
        include '../assets/php/footer.php';
      ?>
    </div> <!-- ms-site-container -->
    <?php include '../assets/php/sidebar.php'; ?>
    <script src="/web/assets/js/jquery.min.js"></script>
    <script src="/web/assets/js/plugins.min.js"></script>
    <script src="/web/assets/js/app.min.js"></script>
    <script src="/web/assets/js/ecommerce.js"></script>
    <script>
      $('#noticeBtn').on('click', function(){
        $("#noticeBtn").load('web/assets/php/set_session.php');
      });
    </script>
  </body>
</html>
