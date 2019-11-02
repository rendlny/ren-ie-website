<?php
include $_SERVER['DOCUMENT_ROOT'].'/web/start.php';
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

$web_data = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/website_data.ini', true);
$current_page = 'pin_trading.php';

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
  </body>
</html>
