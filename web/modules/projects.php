<?php
$projectsList = NULL;

if($projects != NULL){
  foreach ($projects as $project) {
    $projectsList .= '
      <div class="col-md-4 masonry-item">
        <article class="card card-royal mb-4">
          <figure class="ms-thumbnail ms-thumbnail-center ms-thumbnail-light">
            <img src="/web/assets/images/'.$project->image.'" alt="'.$project->title.' cover image" class="img-fluid">
          </figure>
          <div class="card-body">
            <h2><a href="/projects/'.$project->slug.'">'.$project->title.'</a></h2>
            <p>'.$project->description.'</p>
            <div class="row">
              <div class="col-lg-6 col-md-4">
                <div class="mt-05">
                  <a href="javascript:void(0)" class="ms-tag ms-tag-info">Design</a>
                </div>
              </div>
              <div class="col-lg-6 col-md-8">
                <a href="/projects/'.$project->slug.'" class="btn btn-primary btn-sm btn-block animate-icon">Read more <i class="ml-1 no-mr zmdi zmdi-long-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </article>
      </div>
    ';
  }
}
?>

<div class="container pt-6">
  <div class="row masonry-container">
    <div class="col-md-12">
      <?=$projectsList?>
    </div>
  </div>
</div>
