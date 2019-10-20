<?php
$web_data = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/website_data.ini');
$current_page = 'home.php';

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
    <script src="../assets/js/plugins.min.js"></script>
    <script src="../assets/js/app.min.js"></script>
  </body>
</html>
