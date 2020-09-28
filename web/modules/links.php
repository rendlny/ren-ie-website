<?php
use Controllers\LinkController;

$linkList = NULL;
$links = LinkController::getActiveLinks();

if($links != NULL){
  foreach ($links as $link) {
    $linkList .= '
      <a href="'.$link["url"].'" target="_blank"
        class="btn btn-xlg btn-block btn-primary btn-raised"
        style="background: '.$link["colour"].';"
      >
        <i class="'.$link["icon"].'"></i> '.$link["name"].'
      </a><br>
    ';
  }
}
?>
<div class="ms-hero-page ms-hero-img-forest ms-hero-bg-info mb-6" style="margin-bottom:0px !important;">
  <div class="text-center color-white mt-6 mb-6 index-1">
    <h1>Links</h1>
    <br>
    <div class="col-md-4 offset-md-4">
      <?=$linkList?>
    </div>
    <br><br><br>
  </div>
</div>
