<?php
$navbar = NULL;

for($i = 1; $i <= sizeof($web_data["admin_navbar_links"]); $i++){
  $navActive = ($web_data["admin_navbar"][$i] == $current_page) ? 'active' : NULL;
  $navbar .= '
    <li class="nav-item dropdown '.$navActive.'">
      <a href="'.$web_data["admin_navbar_links"][$i].'" class="nav-link dropdown-toggle role="button" aria-haspopup="true" aria-expanded="false" data-name="home">'.$web_data["admin_navbar"][$i].'</a>
    </i>';
}
?>

<nav class="navbar navbar-expand-md  navbar-static ms-navbar ms-navbar-dark">
  <div class="container container-full">
    <div class="navbar-header">
      <a class="navbar-brand" href="/home">
        <img class="ms-logo ms-logo-sm" src="<?=$web_data["admin_header"]["header_icon_img_link"]?>" alt="Website Icon">
        <span class="ms-title"><?=$web_data["admin_header"]["header_title"]?></span>
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
