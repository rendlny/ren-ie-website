<?php
$galleryList = NULL;

if($galleryFolders != NULL){
  foreach ($galleryFolders as $gSection) {
    $galleryList .= '
    <div class="col-lg-4 col-md-6 masonry-item">
      <div class="card">
        <figure class="ms-thumbnail ms-thumbnail-horizontal">
          <a href="/gallery/'.$gSection->slug.'">
          <img src="/web/assets/images/'.$gSection->image.'" alt="'.$gSection->title.' cover image" class="img-fluid">
          <figcaption class="ms-thumbnail-caption text-center">
            <div class="ms-thumbnail-caption-content">
              <h4 class="ms-thumbnail-caption-title mb-2">'.$gSection->title.'</h4>
            </div>
          </figcaption>
          </a>
        </figure>
      </div>
    </div>';
  }
}
?>

<div class="container pt-6">
  <div class="row masonry-container">
    <div class="col-md-12">
      <?=$galleryList?>

    </div>
  </div>
</div>
