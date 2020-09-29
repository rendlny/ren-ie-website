<?php

use Controllers\LinkController;

$error = $warning = NULL;
$active = NULL;
$linkName = $linkUrl = $linkIcon = $linkColour = $linkPosition = $linkActive = $linkFooter = NULL;
$userId = $_SESSION['userId'];

if($_SERVER["REQUEST_METHOD"] == "POST") {

  try{
    $active = (isset($_POST['active'])) ? 1 : 0;
    $footer = (isset($_POST['footer'])) ? 1 : 0;

    $data = [
      'id' => $_GET['code'],
      'name' => $_POST['name'],
      'url' => $_POST['url'],
      'icon' => $_POST['icon'],
      'colour' => $_POST['colour'],
      'position' => $_POST['position'],
      'active' => $active,
      'footer' => $footer
    ];
    if($_GET['code'] == 'add'){ //Add
      $data['code'] = NULL;
      $link = LinkController::addLink($data);
      $successMsg = '<strong> Link Added! </strong>
      You have successfully added this link. You can continue to edit this link using the form.';
    }else{ // Edit
      $link = LinkController::updateLink($data);
      $successMsg = '<strong> Link updated! </strong>
      You have successfully edited this link. You can continue to edit this link using the form.';
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
    $link = LinkController::getLinkById($_GET['code']);

    if($link == NULL){
      echo '<meta http-equiv="refresh" content="0;url=/admin/links/">';
    }

    $linkName = $link->name;
    $linkUrl = $link->url;
    $linkIcon = $link->icon;
    $linkColour = $link->colour;
    $linkPosition = $link->position;
    $linkActive = ($link->active) ? 'checked="checked"' : NULL;
    $linkFooter = ($link->footer) ? 'checked="checked"' : NULL;

  }
  else{
    $pageTitle = 'Add';
    $linkActive = 'checked="checked"';
    $linkFooter = 'checked="checked"';
    $linkIcon = 'fa fa-';
  }
}

?>
<div class="ms-hero-page-override ms-hero-img-forest ms-hero-bg-info" style="padding: 30px 0 55px;">
  <div class="container">
    <div class="text-center">
      <br>
      <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5"><?=$pageTitle?> Link</h1>
    </div>
  </div>
</div>
<br><br><br>
<div class="container">
  <div class="card card-primary card-hero animated fadeInUp animation-delay-7">
    <div class="card-body">
      <a href="/admin/links/" class="btn btn-royal btn-raised btn-block"><i class="fa fa-arrow-left"></i>&nbsp; Cancel</a>
      <?=$warning?>
      <form class="form-horizontal" name="editItem" method="post">
        <fieldset>

          <div class="row form-group">
            <label for="name" class="col-md-2 control-label">Name</label>
            <div class="col-md-9">
              <input required name="name" type="text" class="form-control" id="name" placeholder="Name" value="<?=$linkName?>">
            </div>
          </div>

          <div class="row form-group">
            <label for="url" class="col-md-2 control-label">URL</label>
            <div class="col-md-9">
              <input required name="url" type="text" class="form-control" id="url" placeholder="URL" value="<?=$linkUrl?>">
            </div>
          </div>

          <div class="row form-group">
            <label for="icon" class="col-md-2 control-label">Icon</label>
            <div class="col-md-9">
              <input name="icon" type="text" class="form-control" id="icon" placeholder="Icon" value="<?=$linkIcon?>">
            </div>
          </div>

          <div class="row form-group">
            <label for="colour" class="col-md-2 control-label">Colour</label>
            <div class="col-md-9">
              <input name="colour" type="text" class="form-control" id="colour" placeholder="Colour" value="<?=$linkColour?>">
            </div>
          </div>

          <div class="row form-group">
            <label for="position" class="col-md-2 control-label">Position</label>
            <div class="col-md-9">
              <input name="position" type="number" class="form-control" id="position" placeholder="Position" value="<?=$linkPosition?>">
            </div>
          </div>

          <div class="row mt-2">
            <div class="offset-lg-2 col-lg-6">
              <div class="checkbox">
                <label>
                  <input name="footer" type="checkbox" <?=$linkFooter?>> <span class="ml-2">Display in footer?</span>
                </label>
              </div>
            </div>

            <div class="offset-lg-2 col-lg-6">
              <div class="checkbox">
                <label>
                  <input name="active" type="checkbox" <?=$linkActive?>> <span class="ml-2">Active on website?</span>
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
