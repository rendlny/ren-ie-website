<?php

use Controllers\ProjectController;
use Controllers\ProjectSectionController;

$error = $warning = NULL;
$active = NULL;
$projectTitle = $projectSlug = $projectContent = $projectDescription = $projectActive = $projectGalleryFolder = $projectImage = $projectTags = $sectionsNav = $imageModals = $sectionTabs = NULL;
$userId = $_SESSION['userId'];

if($_SERVER["REQUEST_METHOD"] == "POST") {

  try{
    $active = (isset($_POST['active'])) ? 1 : 0;
    $gallery = (isset($_POST['gallery_folder'])) ? 1 : 0;

    $data = [
      'id' => NULL,
      'project_id' => $_GET['code'],
      'title' => $_POST['title'],
      'image' => $_POST['image'],
      'slug' => $_POST['url'],
      'description' => $_POST['description'],
      'content' => $_POST['content'],
      'active' => $active
    ];
    if($_POST['action'] == 'add'){ //Add
      $data['id'] = NULL;
      $project = ProjectSectionController::addProjectSection($data);
      $successMsg = '<strong> Project Section Added! </strong>
      You have successfully added this project section. You can continue to edit this project section using the form.';
    }else{ // Edit
      $data['id'] = $_POST['id'];
      $project = ProjectSectionController::updateProjectSection($data);
      $successMsg = '<strong> Project Section Updated! </strong>
      You have successfully edited this project section. You can continue to edit this project section using the form.';
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
  if($_GET['action'] != 'add'){
    $project = ProjectController::getProjectById($_GET['code']);
    $projectSections = ProjectSectionController::getSectionsByProjectId($_GET['code']);

    if($project == NULL){
      echo '<meta http-equiv="refresh" content="0;url=/admin/projects/">';
    }

    if($projectSections != NULL){
      foreach($projectSections as $section){
        $sectionActive = ($section->active) ? 'checked="checked"' : NULL;
        $imageDisplay = ($section->image != NULL) ? '<div class="col-md-5 offset-md-3"><img class="img-fluid" src="/web/assets/images/'.$section->image.'" /></div>' : NULL;

        $sectionsNav .= '<li class="nav-item"><a class="nav-link withoutripple" href="#'.$section->slug.'" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-pencil"></i> <span class="d-none d-sm-inline">'.$section->title.'</span></a></li>';
        $sectionTabs .= '
        <div role="tabpanel" class="tab-pane fade" id="'.$section->slug.'">
          <form class="form-horizontal" name="editItem" method="post">
            <fieldset>
              <input type="hidden" name="action" value="edit">
              <input type="hidden" name="id" value="'.$section->id.'">

              <div class="row form-group">
                <label for="name" class="col-md-2 control-label">Title</label>
                <div class="col-md-9">
                  <input required name="title" type="text" class="form-control" id="name" placeholder="Title" value="'.$section->title.'">
                </div>
              </div>

              <div class="row form-group">
                <label for="url" class="col-md-2 control-label">URL</label>
                <div class="col-md-9">
                  <input readonly name="url" type="text" class="form-control" id="url" placeholder="URL" value="'.$section->slug.'">
                </div>
              </div>

              <div class="row form-group">
                <label for="name" class="col-md-2 control-label">Image</label>
                <div class="col-md-9">
                  <div class="input-group">
                	  <input type="text" class="form-control" name="image" id="image_upload_'.$section->id.'" value="'.$section->image.'"/>
                		<span class="input-group-btn">
                			<a href="#imageModal'.$section->id.'" data-toggle="modal" class="btn btn-raised btn-royal" type="button" style="margin-bottom: 0px">Select Image</a>
                		</span>
                	</div>
                </div>
                '.$imageDisplay.'
              </div>

              <div class="row form-group">
                <label for="description" class="col-md-2 control-label">Description</label>
                <div class="col-md-9">
                  <textarea rows="3" name="description" class="form-control" id="description">'.$section->description.'</textarea>
                </div>
              </div>

              <div class="row form-group">
                <label for="content" class="col-md-2 control-label">Content</label>
                <div class="col-md-9">
                  <textarea rows="30" name="content" class="tinymce" id="content">
                    '.$section->content.'
                  </textarea>
                </div>
              </div>

              <div class="row mt-2">
                <div class="offset-lg-2 col-lg-6">
                  <div class="checkbox">
                    <label>
                      <input name="active" type="checkbox" checked="checked"> <span class="ml-2">Active on website?</span>
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
        ';

        $imageModals .= '
        <div class="modal" id="imageModal'.$section->id.'" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-xl animated zoomIn animated-3x" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title color-primary" id="myModalLabel">Select Image</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
              </div>
              <div class="modal-body">
                <iframe width="865" height="500" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll;"
                  src="'.$config['filemanager_link'].'?type=2&multiple=1&field_id=image_upload_'.$section->id.'&relative_url=1&akey='.$config['filemanager_key'].'">
                </iframe>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-raised btn-primary">Save</button>
              </div>
            </div>
          </div>
        </div>';
      }
    }

  }
}

?>
<div class="ms-hero-page-override ms-hero-img-forest ms-hero-bg-info" style="padding: 30px 0 55px;">
  <div class="container">
    <div class="text-center">
      <br>
      <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5"><?=$project->title?></h1>
      <h2 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5">Project Sections</h2>
    </div>
  </div>
</div>
<br><br><br>
<div class="container">
  <div class="card card-primary card-hero animated fadeInUp animation-delay-7">

    <ul class="nav nav-tabs nav-tabs-royal indicator-primary shadow-2dp" role="tablist">
      <li class="nav-item"><a class="nav-link withoutripple active" href="#add" aria-controls="add" role="tab" data-toggle="tab"><i class="fa fa-plus"></i> <span class="d-none d-sm-inline">Add</span></a></li>
      <?=$sectionsNav?>
    </ul>

    <div class="card-body">
      <div class="tab-content">
        <a href="/admin/projects/" class="btn btn-royal btn-raised btn-block"><i class="fa fa-arrow-left"></i>&nbsp; Cancel</a>
        <a href="/admin/projects/edit/<?=$_GET['code']?>" class="btn btn-info btn-raised btn-block"><i class="fa fa-pencil"></i>&nbsp; Edit Project</a>

        <?=$warning?>
        <div role="tabpanel" class="tab-pane fade active show" id="add">
          <form class="form-horizontal" name="editItem" method="post">
            <fieldset>
              <input type="hidden" name="action" value="add">

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
              </div>

              <div class="row form-group">
                <label for="description" class="col-md-2 control-label">Description</label>
                <div class="col-md-9">
                  <textarea rows="3" name="description" class="form-control" id="description"><?=$projectDescription?></textarea>
                </div>
              </div>

              <div class="row form-group">
                <label for="content" class="col-md-2 control-label">Content</label>
                <div class="col-md-9">
                  <textarea rows="30" name="content" class="tinymce" id="content">
                    <?=$projectContent?>
                  </textarea>
                </div>
              </div>

              <div class="row mt-2">
                <div class="offset-lg-2 col-lg-6">
                  <div class="checkbox">
                    <label>
                      <input name="active" type="checkbox" checked="checked"> <span class="ml-2">Active on website?</span>
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

        <?=$sectionTabs?>
      </div>
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
<?=$imageModals?>
