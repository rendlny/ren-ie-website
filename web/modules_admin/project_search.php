<?php

use Controllers\ProjectController;

$projectCards = NULL;

$projects = ProjectController::getAllProjects();
if($projects != NULL){
  foreach ($projects as $project) {
    $btns = '
      <div class="row">
        <div class="col-md-6">
          <a href="/admin/projects/'.$project->id.'/" class="btn btn-primary btn-sm btn-block btn-raised no-mb">
            <i class="zmdi zmdi-edit"></i> Edit
          </a>
        </div>
        <div class="col-md-6">
          <a href="/admin/projects/delete/'.$project->id.'/" class="btn btn-danger btn-sm btn-block btn-raised no-mb">
            <i class="zmdi zmdi-delete"></i> Delete
          </a>
        </div>
      </div>
    ';

    $formattedDate = strtotime($project->created);
    $notActive = (!$project->active)? 'bg-secondary text-dark' : NULL;

    $projectCards .= '
      <div class="col-xl-4 col-md-4 col-sm-6 mix" data-date="'.$formattedDate.'">
        <div class="card ms-feature '.$notActive.'">
          <div class="card-body overflow-hidden text-center">
            <a style="display:block;" data-mh="itemCardImage" href="/admin/items/'.$project->id.'/"><img src="'.$project->image.'" alt="" class="img-fluid center-block"></a>
            <h4 data-mh="itemCardTitle" class="text-normal text-center">'.$project->title.'</h4>
            <img class="img-fluid" src="/web/assets/images/'.$project->image.'"/>
            <p>'.$project->description.'</p>
            '.$btns.'
          </div>
        </div>
      </div>
    ';
  }
}

?>
<div class="ms-hero-page-override ms-hero-img-forest ms-hero-bg-info" style="padding: 30px 0 55px;">
  <div class="container">
    <div class="text-center">
      <br>
      <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2">Search Projects</h1>
    </div>
  </div>
</div>
<br>
<div class="container">
  <a href="/admin/projects/add/" class="btn btn-royal btn-raised btn-block"><i class="fa fa-plus"></i>&nbsp; Add New Project</a><br>
  <div class="row">
    <div class="col-lg-12">
      <div class="row" id="Container">

        <?=$projectCards?>

      </div>
    </div>
  </div>
</div> <!-- container -->
