<?php
$galleryList = NULL;

if($galleryFolders != NULL){
  foreach ($galleryFolders as $gSection) {
    $galleryList .= '
    <div class="col-lg-4 col-md-6 masonry-item wow">
      <div class="card">
        <figure class="ms-thumbnail ms-thumbnail-horizontal">
          <a href="/web/assets/images/'.$gSection->image.'" data-lightbox="gallery" data-title="'.$gSection->title.'">
            <img src="/web/assets/images/'.$gSection->image.'" alt="'.$gSection->title.' cover image" class="img-fluid">
          </a>
        </figure>
      </div>
    </div>';
  }
}
?>

<div class="col-md-8 offset-md-2">
  <a class="btn btn-raised btn-royal btn-block" href="/gallery">
    <i class="fa fa-arrow-left"></i> Gallery Folders
  </a>
</div>

<div class="container pt-6">
  <div class="row masonry-container">
    <div class="col-md-12">
      <?=$galleryList?>

    </div>
  </div>
</div>
