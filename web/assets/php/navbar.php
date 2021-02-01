<?php
$navbar = $navActive = NULL;

for($i = 1; $i <= sizeof($web_data["navbar_links"]); $i++){
  $activePage = ucwords(str_replace(".php", "", $current_page)); //changing home.php to Home and seeing if it matches
  $navActive = ($web_data["navbar"][$i] == $activePage) ? 'active' : NULL;
  $navActive = ($web_data["navbar"][$i] == 'Projects' && $activePage == 'Project_view') ? 'active' : $navActive;
  $navActive = ($web_data["navbar"][$i] == 'Coding' && $activePage == 'Coding_view') ? 'active' : $navActive;
  $navActive = ($web_data["navbar"][$i] == 'Store' && $activePage == 'Item_order') ? 'active' : $navActive;

  if ($web_data["navbar"][$i] == 'Hobbies') {
    $navActive = ('Music' == $activePage || 'Reading' == $activePage || 'Boardgames' == $activePage) ? 'active' : NULL;
    $navbar .= '
    <li class="nav-item dropdown '.$navActive.'">
      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hobbies <i class="zmdi zmdi-chevron-down"></i></a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="/music"><i class="fa fa-music"></i> Music</a></li>
        <li><a class="dropdown-item" href="/boardgames"><i class="fa fa-chess"></i> Board games</a></li>
        <li><a class="dropdown-item" href="/reading"><i class="fa fa-book"></i> Reading</a></li>
      </ul>
    </li>';
  }
  else{
    $navbar .= '
      <li class="nav-item dropdown '.$navActive.'">
        <a href="'.$web_data["navbar_links"][$i].'" class="nav-link dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">'.$web_data["navbar"][$i].'</a>
      </li>';
  }
}
?>

<nav class="navbar navbar-expand-md  navbar-static ms-navbar ms-navbar-dark">
  <div class="container container-full">
    <div class="navbar-header">
      <a class="navbar-brand" href="/home">
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
