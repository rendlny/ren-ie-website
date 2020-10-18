<?php

use Controllers\ProjectController;

$error = $warning = NULL;
$active = NULL;
$projectTitle = $projectSlug = $projectContent = $projectDescription = $projectActive = $projectImage = NULL;
$userId = $_SESSION['userId'];

if($_SERVER["REQUEST_METHOD"] == "POST") {

  try{
    $active = (isset($_POST['active'])) ? 1 : 0;

    $data = [
      'id' => $_GET['code'],
      'title' => $_POST['title'],
      'image' => $_POST['image'],
      'slug' => $_POST['url'],
      'description' => $_POST['description'],
      'content' => $_POST['content'],
      'active' => $active
    ];
    if($_GET['code'] == 'add'){ //Add
      $data['id'] = NULL;
      $project = ProjectController::addProject($data);
      $successMsg = '<strong> Project Added! </strong>
      You have successfully added this project. You can continue to edit this project using the form.';
    }else{ // Edit
      $project = ProjectController::updateProject($data);
      $successMsg = '<strong> Project updated! </strong>
      You have successfully edited this project. You can continue to edit this project using the form.';
    }
  } catch (Exception $e) {
    $error = $e->getMessage();
  }

 	if ($error != NULL){
 		$_SESSION['form-alert'] = '
 			<div class="alert alert-danger">
        <i class="fa fa-exclamation-circle"></i>
        <strong> System Error! </strong>
        We are sorry but there was a system error: '.$error.'
      </div>
    ';
 	}
  else {

 		$_SESSION['form-alert'] = '
 			<div class="alert alert-success">
        <i class="fa fa-check-circle"></i> '.$successMsg.'
      </div>
    ';
  }
}

if(isset($_SESSION['form-alert'])) {
  $warning = $_SESSION['form-alert'];
  $_SESSION['form-alert'] = NULL;
}

if(isset($_GET['code']) && $_GET['code'] != NULL){
  if($_GET['code'] != 'add'){
    $pageTitle = 'Edit';
    $project = ProjectController::getProjectById($_GET['code']);

    if($project == NULL){
      echo '<meta http-equiv="refresh" content="0;url=/admin/projects/">';
    }

    $projectTitle = $project->title;
    $projectSlug = $project->slug;
    $projectImage = $project->image;
    $projectDescription = $project->description;
    $projectContent = $project->content;
    $projectActive = ($project->active) ? 'checked="checked"' : NULL;

    $imageDisplay = ($projectImage != NULL) ? '<div class="col-md-5 offset-md-3"><img class="img-fluid" src="/web/assets/images/'.$projectImage.'" /></div>' : NULL;

  }
  else{
    $pageTitle = 'Add';
    $projectActive = 'checked="checked"';
    $imageDisplay = NULL;
  }
}

?>
<div class="ms-hero-page-override ms-hero-img-forest ms-hero-bg-info" style="padding: 30px 0 55px;">
  <div class="container">
    <div class="text-center">
      <br>
      <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5"><?=$pageTitle?> Project</h1>
    </div>
  </div>
</div>
<br><br><br>
<div class="container">
  <div class="card card-primary card-hero animated fadeInUp animation-delay-7">
    <div class="card-body">
      <a href="/admin/projects/" class="btn btn-royal btn-raised btn-block"><i class="fa fa-arrow-left"></i>&nbsp; Cancel</a>
      <?=$warning?>
      <form class="form-horizontal" name="editItem" method="post">
        <fieldset>

          <div class="row form-group">
            <label for="name" class="col-md-2 control-label">Title</label>
            <div class="col-md-9">
              <input required name="title" type="text" class="form-control" id="name" placeholder="Title" value="<?=$projectTitle?>">
            </div>
          </div>

          <div class="row form-group">
            <label for="url" class="col-md-2 control-label">URL</label>
            <div class="col-md-9">
              <input readonly name="url" type="text" class="form-control" id="url" placeholder="URL" value="<?=$projectSlug?>">
            </div>
          </div>

          <div class="row form-group">
            <label for="name" class="col-md-2 control-label">Image</label>
            <div class="col-md-9">
              <div class="input-group">
            	  <input type="text" class="form-control" name="image" id="image_upload" value="<?=$projectImage?>"/>
            		<span class="input-group-btn">
            			<a href="#imageModal" data-toggle="modal" class="btn btn-raised btn-royal" type="button" style="margin-bottom: 0px">Select Image</a>
            		</span>
            	</div>
            </div>
            <?=$imageDisplay?>
          </div>

          <div class="row form-group">
            <label for="description" class="col-md-2 control-label">Description</label>
            <div class="col-md-9">
              <textarea rows="3" name="description" class="form-control tinymce" id="description"><?=$projectDescription?></textarea>
            </div>
          </div>

          <div class="row form-group">
            <label for="content" class="col-md-2 control-label">Content</label>
            <div class="col-md-9">
              <textarea rows="10" name="content" class="tinymce" id="content">
                <?=$projectContent?>
              </textarea>
            </div>
          </div>

          <div class="row mt-2">
            <div class="offset-lg-2 col-lg-6">
              <div class="checkbox">
                <label>
                  <input name="active" type="checkbox" <?=$projectActive?>> <span class="ml-2">Active on website?</span>
                </label>
              </div>
            </div>
            <div class="col-lg-3">
              <button class="btn btn-raised btn-primary btn-block">Submit</button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</div> <!-- container -->



<div class="modal" id="imageModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl animated zoomIn animated-3x" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title color-primary" id="myModalLabel">Select Image</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
      </div>
      <div class="modal-body">
        <iframe width="865" height="500" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll;"
          src="<?=$config['filemanager_link'].'?type=2&multiple=1&field_id=image_upload&relative_url=1&akey='.$config['filemanager_key']?>">
        </iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-raised btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
