<?php
use Controllers\ProjectSectionController;
use Controllers\ProjectController;

$images = ProjectSectionController::getActiveSectionsByProjectSlug($project->slug);
$otherProjects = ProjectController::getAllOtherCodingProjects($project);
$imageCarousel = $carouselIndicators = $otherCodeProjectsSection = NULL;

$carouselCount = 0;
foreach($images as $image){
  $ativeImage = ($carouselCount == 0) ? 'active' : NULL; //setting first image as the active image
  $carouselIndicators .= '<li data-target="#image-carousel" data-slide-to="'.$carouselCount.'" class="'.$ativeImage.'"></li>';
  $imageCarousel .= '<div class="carousel-item '.$ativeImage.'">
    <img class="d-block img-fluid" src="/web/assets/images/'.$image->image.'" alt="'.$image->title.'">
    <div class="carousel-caption">
      <h3>'.$image->title.'</h3>
      <p>'.$image->description.'</p>
    </div>
  </div>';
  $carouselCount = $carouselCount + 1;
}

foreach($otherProjects as $otherProject){
  $otherCodeProjectsSection .= '
  <div class="col-sm-6 col-md-4 col-lg-3 masonry-item">
    <article class="card card-royal mb-4">
      <figure class="ms-thumbnail ms-thumbnail-center ms-thumbnail-light">
        <a href="/coding/'.$otherProject->slug.'"><img src="/web/assets/images/'.$otherProject->image.'" alt="'.$otherProject->title.' cover image" class="img-fluid"></a>
      </figure>
      <div class="card-body">
        <h2><a href="/coding/'.$otherProject->slug.'">'.$otherProject->title.'</a></h2>
        <p>'.$otherProject->description.'</p>
        <hr>
        <div class="row">
          <div class="col-md-12">
            <div class="mt-05">
              '.$otherProject->displayTags.'
            </div>
          </div>
        </div>
      </div>
    </article>
  </div>';
}

$buttonToLiveSite = ($project->external_link != NULL) ? '<p class="text-center"><a href="'.$project->external_link.'" target="_blank" class="btn btn-raised btn-primary"><i class="fa fa-desktop"></i> Live Site</a></p>' : NULL;
?>
<div class="col-md-6 offset-md-3 pt-3">
  <a class="btn btn-md btn-raised btn-royal btn-block" href="/coding/"><i class="fa fa-arrow-left"></i> Coding</a>
</div>

<div class="container pt-3">
  <div class="row">

    <div class="col-lg-5">
      <div class="card">
        <div class="ms-hero-bg-dark ms-hero-img-mountain" style="background-image: url(/web/assets/images/<?=$project->image?>);">
          <h2 class="text-center no-m pt-6 pb-6 color-white index-1"><?=$project->title?></h2>
        </div>
        <div class="card-body">
          <h3 class="color-primary no-mt">Information</h3>
          <p><?=$project->description?></p><hr>
          <h3 class="color-primary">Description</h3>
          <p><?=$project->content?></p>
          <?=$buttonToLiveSite?>
          <hr>
          <ul class="list-unstyled">
            <li><strong>Technologies:</strong><br><?=$project->displayTags?></li>
          </ul>
        </div>
      </div>
    </div>


    <div class="col-lg-7">
      <div class="card">
        <div id="image-carousel" class="ms-carousel carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <?=$carouselIndicators?>
          </ol>

          <div class="carousel-inner" role="listbox">
            <?=$imageCarousel?>
          </div>
          <!-- Carousel Controls -->
          <a href="#image-carousel" class="btn-circle btn-circle-xs btn-circle-raised btn-circle-primary left carousel-control-prev" role="button" data-slide="prev"><i class="zmdi zmdi-chevron-left"></i></a>
          <a href="#image-carousel" class="btn-circle btn-circle-xs btn-circle-raised btn-circle-primary right carousel-control-next" role="button" data-slide="next"><i class="zmdi zmdi-chevron-right"></i></a>
        </div>
      </div>
    </div>

  </div>


  <h2 class="right-line mt-6">Other Works</h2>
  <div class="row masonry-container">
    <?=$otherCodeProjectsSection?>
  </div>
</div> <!-- container -->
