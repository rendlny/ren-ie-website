<?php
$links_socials = NULL;
for($i = 1; $i <= sizeof($web_data["social_links"]); $i++){
  $links_socials .= '<a href="'.$web_data["social_links"][$i].'" target="_blank" class="btn btn-xlg btn-block btn-primary btn-raised">
    <i class="'.$web_data["social_icons"][$i].'"></i> '.$web_data["social_link_titles"][$i].'
  </a><br>';
}
?>
<div class="ms-hero-page ms-hero-img-forest ms-hero-bg-info mb-6" style="margin-bottom:0px !important;">
  <div class="text-center color-white mt-6 mb-6 index-1">
    <h1>Links</h1>
    <br>
    <div class="col-md-4 offset-md-4">
      <?=$links_socials?>
    </div>
    <br><br><br>
  </div>
</div>
