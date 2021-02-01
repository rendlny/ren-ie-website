<?php
$sidebar = $sidebar_socials = $linkBarTitle = NULL;
for($i = 1; $i <= sizeof($web_data["navbar_links"]); $i++){
  $activePage = ucwords(str_replace(".php", "", $current_page)); //changing home.php to Home and seeing if it matches
  $navActive = ($web_data["navbar"][$i] == $activePage) ? 'active' : NULL;

  if ($web_data["navbar"][$i] == 'Hobbies') {
    $sidebar .= '
    <li class="card" role="tab">
      <a class="collapsed" role="button" data-toggle="collapse" href="#hobbies" aria-expanded="true" aria-controls="hobbies">
        <i class="fa fa-chess"></i> Hobbies
      </a>
      <ul id="hobbies" class="card-collapse collapse" role="tabpanel" data-parent="#slidebar-menu" style="">
        <li><a href="/music"><i class="fa fa-music"></i> Music</a></li>
        <li><a href="/boardgames"><i class="fa fa-chess"></i> Board Games</a></li>
        <li><a href="/reading"><i class="fa fa-book"></i> Reading</a></li>
      </ul>
    </li>';
  }
  else{
    $sidebar .= '
      <li>
        <a class="link" href="'.$web_data["navbar_links"][$i].'"><i class="'.$web_data["navbar_icons"][$i].' '.$navActive.'"></i> '.$web_data["navbar"][$i].'</a>
      </li>';
  }
}

if($links != NULL){
  foreach ($links as $link) {
    if($link->footer){
      $sidebar_socials .= '
        <a href="'.$link["url"].'" class="btn-circle btn-circle-raised btn-royal"><i class="'.$link["icon"].'"></i>
          <div class="ripple-container"></div>
        </a>
      ';
    }
  }
}

if($sidebar_socials != NULL){
  $linkBarTitle = '<h4 class="ms-slidebar-block-title">'.$web_data["sidebar"]["links_title"].'</h4>';
}
?>
<div class="ms-slidebar sb-slidebar sb-left sb-style-overlay" id="ms-slidebar">
  <div class="sb-slidebar-container">
    <header class="ms-slidebar-header">
      <div id="slidebar-header-overlay">

        <div class="ms-slidebar-title">
          <div class="ms-slidebar-t">
            <img class="ms-logo ms-logo-sm" src="<?=$web_data["header"]["header_icon_img_link"]?>" alt="Website Icon">
            <h3><?=$web_data["site"]["name"]?></h3>
          </div>
        </div>
      </div>
    </header>
    <ul class="ms-slidebar-menu" id="slidebar-menu" role="tablist" aria-multiselectable="true">
      <?=$sidebar?>
    </ul>
    <div class="ms-slidebar-social ms-slidebar-block">
      <?=$linkBarTitle?>
      <div class="ms-slidebar-social">
        <?=$sidebar_socials?>
      </div>
    </div>
  </div>
</div>
