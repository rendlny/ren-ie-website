<?php
$pageCover = NULL;
  if(isset($page_cover_img)){
    $pageCover = '
      <div class="ms-hero-page ms-hero-img-'.$page_cover_img.' ms-hero-bg-info">
        <div class="text-center color-white mt-6 mb-6 index-1">
          <h1>'.$page_title.'</h1>
        </div>
      </div>
    ';
  }
  echo $pageCover;
?>
