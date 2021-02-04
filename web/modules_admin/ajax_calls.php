<?php
include $_SERVER['DOCUMENT_ROOT'].'/web/start.php';
use Controllers\ProjectController;

$data = NULL;
$result = 0;

if (isset($_GET['action'])) {
  switch ($_GET['action']) {
    case 'update_gallery_sorting':
      $folders = (isset($_POST['folder_order'])) ? $_POST['folder_order'] : NULL;
      if($folders != NULL){
        $sorting = 1;
        foreach($folders as $folder){
          $project = ProjectController::updateProjectSorting($folder, $sorting);
          $sorting = $sorting + 1;
        }
      }
      echo json_encode($project);
    break;
  }
}

?>
