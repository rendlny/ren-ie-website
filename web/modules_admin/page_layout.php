<?php
include $_SERVER['DOCUMENT_ROOT'].'/web/start.php';

if(!isset($_SESSION['userCode']) || $_SESSION['userCode'] == NULL){
  header("Location: /admin/login/");
  exit();
}

$current_page = 'admin_dashboard.php';

if(isset($_GET['page'])){
  switch($_GET['page']){
    case 'dashboard':
      $current_page = 'admin_dashboard.php';
      break;

    case 'sales':
      $current_page = 'sale_search.php';
      break;

    case 'items':
      $current_page = (isset($_GET['code']) && $_GET['code'] != NULL) ? 'item_edit.php' : 'item_search.php';
      break;

    case 'logout':
      $current_page = 'system_logout.php';
      break;
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
        include '../assets/php/admin_header.php';
        include '../assets/php/admin_navbar.php';
        include $current_page;
        include '../assets/php/admin_footer.php';
      ?>
    </div> <!-- ms-site-container -->
    <?php include '../assets/php/admin_sidebar.php'; ?>
    <script src="/web/assets/js/plugins.min.js"></script>
    <script src="/web/assets/js/app.min.js"></script>
    <script src="/web/assets/js/ecommerce.js"></script>
    <script src="/web/assets/js/jquery.matchHeight.js"></script>
  </body>
</html>
