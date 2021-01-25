<?php
$pageCover = NULL;
  if(isset($custom_cover_img)){
    $pageCover = '
      <div class="ms-hero-page ms-hero-img-keyboard ms-hero-bg-info" style="background-image: url(/web/assets/images/'.$custom_cover_img.');">
        <div class="text-center color-white mt-6 mb-6 index-1">
          <h1>'.$page_title.'</h1>
        </div>
      </div>
    ';
  }
  echo $pageCover;
?>
