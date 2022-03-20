<?php
include $_SERVER['DOCUMENT_ROOT'].'/web/start.php';

if(!isset($_SESSION['userCode']) || $_SESSION['userCode'] == NULL){
  header("Location: /admin/login/");
  exit();
}

$current_page = 'admin_dashboard.php';
$current_page = pageDirect($_GET['page'], $_GET['action'], $_GET['code']);

if(isset($_GET['page'])){
  switch($_GET['page']){
    case 'home':
      $current_page = 'admin_dashboard.php';
      break;

    case 'logout':
      $current_page = 'system_logout.php';
      break;

    case 'bgg-api':
      $current_page = 'bgg_api.php';
      break;

    case 'bgg-refresh':
      $current_page = 'bgg_api_refresh.php';
      break;
    
    case 'bgg-plays':
      $current_page = 'bgg_plays.php';
      break;

    default:
      $current_page = pageDirect($_GET['page'], $_GET['action'], $_GET['code']);
      break;
  }
}

function pageDirect($page, $action, $code){
  $current_page = NULL;
  $page_link = str_replace('-', '_', $page); //convert dashes to underscores
  $page_link = substr($page_link, 0, -1);
  switch($action){
    case 'delete':
      $current_page = $page_link.'_delete.php';
      break;

    case 'edit':
      $current_page = $page_link.'_edit.php';
      break;

    case 'add':
      $current_page = $page_link.'_edit.php';
      break;

    case 'sections':
      $current_page = $page_link.'_sections.php';
      break;

    case NULL:
      $current_page = $page_link.'_search.php';
      break;
  }
  return $current_page;
}

?>
<!DOCTYPE html>
<html lang="en">
  <?php include '../assets/php/admin_head.php'; ?>
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
    <?php
      include '../assets/php/admin_sidebar.php';
      include '../assets/php/admin_scripts.php';
    ?>
  </body>
</html>
