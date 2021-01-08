<?php
use Controllers\ProjectController;
use Controllers\UserController;

if($_GET['action'] == 'delete' && $_GET['code'] != NULL){
  $project = ProjectController::getProjectById($_GET['code']);
  if($project != NULL){
    $project->deleted_at = now();
    $project->save();
    $notice = substr($_GET['page'], 0, -1).' Deleted!';
  }else{
    $notice = 'Could not find '.substr($_GET['page'], 0, -1).', it may have been deleted already';
  }
}
?>
<div class="ms-hero-page-override ms-hero-img-forest ms-hero-bg-info" style="padding: 30px 0 55px;">
  <div class="container">
    <div class="text-center">
      <br>
      <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5">Delete <?=ucwords(substr($_GET['page'], 0, -1))?></h1>
    </div>
  </div>
</div>
<br><br><br>
<div class="container">
  <div class="card card-primary card-hero animated fadeInUp animation-delay-7">
    <div class="card-body">
      <h1><?=$notice?></h1>
      <br>
      <hr>
      <br>
      <a href="/admin/<?=$_GET['page']?>/" class="btn btn-raised btn-primary btn-block">Return to <?=$_GET['page']?> List</a>
    </div>
  </div>
</div>
