<?php
use Controllers\LinkController;

$links = LinkController::getActiveLinks();
$tableRows = NULL;

if($links != NULL){
  foreach ($links as $link) {
    $editBtn = '<a title="Edit" class="btn-circle btn-circle-raised btn-circle-primary" href="/admin/links/edit/'.$link->id.'"><i class="fa fa-pencil"></i></a>&nbsp;';

    $btnPreview = '
      <a style="background:'.$link->colour.';" class="btn btn-raised text-white" href="'.$link->url.'" target="_blank">
        <i class="'.$link->icon.'"></i>&nbsp; '.$link->name.'
      </a>
    ';

    $tableRows .= '
      <tr>
        <td>'.$editBtn.'</td>
        <td>'.$link->name.'</td>
        <td>'.$link->url.'</td>
        <td>'.$link->icon.'</td>
        <td>'.$link->colour.'</td>
        <td>'.$btnPreview.'</td>
      </tr>
    ';
  }
}
?>
<div class="ms-hero-page-override ms-hero-img-forest ms-hero-bg-info" style="padding: 30px 0 55px;">
  <div class="container">
    <div class="text-center">
      <br>
      <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2">Search Links</h1>
    </div>
  </div>
</div>
<br>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <a href="/admin/links/add" class="btn btn-royal btn-raised btn-block"><i class="fa fa-plus"></i>&nbsp; Add New Link</a><br>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Action</th>
            <th>Name</th>
            <th>URL</th>
            <th>Icon</th>
            <th>Colour</th>
            <th>Preview</th>
          </tr>
        </thead>
        <tbody>
          <?=$tableRows?>
        </tbody>
      </table>
    </div>
  </div>
</div>
