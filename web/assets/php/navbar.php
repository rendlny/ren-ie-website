<?php
$navbar = NULL;

for($i = 1; $i <= sizeof($web_data["navbar_links"]); $i++){
  $navActive = ($web_data["navbar"][$i] == $current_page) ? 'active' : NULL;
  $navbar .= '
    <li class="nav-item dropdown '.$navActive.'">
      <a href="'.$web_data["navbar_links"][$i].'" class="nav-link dropdown-toggle animated fadeIn animation-delay-7" role="button" aria-haspopup="true" aria-expanded="false" data-name="home">'.$web_data["navbar"][$i].'</a>
    </i>';
}
?>

<nav class="navbar navbar-expand-md  navbar-static ms-navbar ms-navbar-dark">
  <div class="container container-full">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.html">
        <img class="ms-logo ms-logo-sm" src="<?=$web_data["header"]["header_icon_img_link"]?>" alt="Website Icon">
        <span class="ms-title"><?=$web_data["header"]["header_title"]?></span>
      </a>
    </div>
    <div class="collapse navbar-collapse" id="ms-navbar">
      <ul class="navbar-nav">
        <?=$navbar?>
      </ul>
    </div>
    <a href="javascript:void(0)" class="ms-toggle-left btn-navbar-menu"><i class="zmdi zmdi-menu"></i></a>
  </div> <!-- container -->
</nav>
