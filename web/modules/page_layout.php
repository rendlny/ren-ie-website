<?php
include $_SERVER['DOCUMENT_ROOT'].'/web/start.php';
use Controllers\ItemController;
use Controllers\LinkController;
use Controllers\ProjectController;
use Controllers\ProjectSectionController;

$links = LinkController::getActiveLinks();

$current_page = 'home.php';

if(isset($_GET['page'])){
  switch($_GET['page']){
    case 'home':
      $current_page = 'home.php';
      $page_title = 'Home';
      $meta_desc = '';
      break;

    case 'hobbies':
      $current_page = 'hobbies.php';
      $page_title = 'Hobbies';
      $page_cover_img = 'hobbies';
      break;

    case 'store':
      $current_page = (isset($_GET['code']) && $_GET['code'] != NULL) ? 'item_view.php' : 'store.php';
      $item = (isset($_GET['code']) && $_GET['code'] != NULL) ? ItemController::getItemBySlug($_GET['code']) : NULL;
      $page_title = (isset($_GET['code']) && $_GET['code'] != NULL) ? 'Store | '.$item->title : 'Store';
      $page_cover_img = (isset($_GET['code']) && $_GET['code'] != NULL) ? NULL : 'forest';
      break;

    case 'order':
      $current_page = (isset($_GET['code']) && $_GET['code'] != NULL) ? 'item_order.php' : 'store.php';
      $page_title = 'Order Form';
      $meta_desc = 'Order Item';
      $page_cover_img = 'forest';
      break;

    case 'order-processing':
      $current_page = 'item_order_processing.php';
      $page_title = 'Processing Your Order';
      $meta_desc = 'Processing your item order';
      $page_cover_img = 'forest';
      break;

    case 'order-result':
      $current_page = 'item_order_check.php';
      if(isset($_SESSION['order-status']) && $_SESSION['order-status'] == 'success'){
        $page_title = 'Order Success';
        $meta_desc = 'Order Success';
      }else{
        $page_title = 'Order Error';
        $meta_desc = 'Order Error';
      }
      $page_cover_img = 'forest';
      break;

    case 'coding':
      $current_page = (isset($_GET['code']) && $_GET['code'] != NULL) ? 'coding_view.php' : 'coding.php';
      $projects = (isset($_GET['code']) && $_GET['code'] != NULL)? NULL : ProjectController::getAllActiveCodeProjects();
      $project = (isset($_GET['code']) && $_GET['code'] != NULL)? ProjectController::getProjectBySlug($_GET['code']) : NULL;
      $page_title = (isset($_GET['code']) && $_GET['code'] != NULL)? NULL : 'Coding';
      $meta_desc = (isset($_GET['code']) && $_GET['code'] != NULL)? $project->title : 'Coding';
      $page_cover_img = (isset($_GET['code']) && $_GET['code'] != NULL)? NULL : 'keyboard';
      break;

    case 'music':
      $current_page = 'music.php';
      $page_title = 'Music';
      $meta_desc = 'Music';
      break;

    case 'projects':
      $current_page = (isset($_GET['code']) && $_GET['code'] != NULL) ? 'project_view.php' : 'projects.php';
      $project = (isset($_GET['code']) && $_GET['code'] != NULL) ? ProjectController::getProjectBySlug($_GET['code']) : NULL;
      $page_title = (isset($_GET['code']) && $_GET['code'] != NULL) ? $project->title : 'Projects';
      $meta_desc = (isset($_GET['code']) && $_GET['code'] != NULL) ? 'Projects | '.$project->title.' | '.$project->description : 'My projects';
      $projects = (isset($_GET['code']) && $_GET['code'] != NULL) ? NULL : ProjectController::getAllActiveProjects();
      $page_cover_img = 'keyboard';
      break;

    case 'projects-search':
      $current_page = 'projects.php';
      $tag = (isset($_GET['code']) && $_GET['code'] != NULL) ? $_GET['code'] : NULL;
      $projects = ProjectController::getProjectsByTag($tag);
      $page_title = ucfirst($tag).' Projects';
      $meta_desc = 'Projects | '.ucfirst($tag).' Projects';
      $page_cover_img = 'keyboard';
      break;

    case 'gallery':
      $current_page = (isset($_GET['code']) && $_GET['code'] != NULL) ? 'gallery_folder.php' : 'gallery.php';
      $galleryFolders = (isset($_GET['code']) && $_GET['code'] != NULL) ? ProjectSectionController::getActiveSectionsByProjectSlug($_GET['code']) : ProjectController::getAllActiveProjectGalleryFolders();
      $project = (isset($_GET['code']) && $_GET['code'] != NULL) ? ProjectController::getProjectBySlug($_GET['code']) : NULL;
      $page_title = (isset($_GET['code']) && $_GET['code'] != NULL) ? $project->title : 'Gallery';
      $custom_cover_img = ($project != NULL)? $project->image : NULL;
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

      <?php
        include '../assets/php/page_title_tile.php';
        include '../assets/php/page_title_tile_custom.php';
      ?>

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
  </body>
</html>
