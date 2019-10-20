<nav class="navbar navbar-expand-md  navbar-static ms-navbar ms-navbar-dark">
  <div class="container container-full">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.html">
        <!-- <img src="../assets/img/demo/logo-navbar.png" alt=""> -->
        <span class="ms-logo ms-logo-sm"><?=$web_data["header_icon"]?></span>
        <span class="ms-title"><?=$web_data["header_title"]?></span>
      </a>
    </div>
    <div class="collapse navbar-collapse" id="ms-navbar">
      <ul class="navbar-nav">
        <li class="nav-item dropdown active">
          <a href="<?=$web_data["nav_1_link"]?>" class="nav-link dropdown-toggle animated fadeIn animation-delay-7" role="button" aria-haspopup="true" aria-expanded="false" data-name="home"><?=$web_data["nav_1_txt"]?></a>
        </li>
        <li class="nav-item dropdown">
          <a href="<?=$web_data["nav_2_link"]?>" class="nav-link dropdown-toggle animated fadeIn animation-delay-7" role="button" aria-haspopup="true" aria-expanded="false" data-name="page"><?=$web_data["nav_2_txt"]?></a>
        </li>
        <li class="nav-item dropdown">
          <a href="<?=$web_data["nav_3_link"]?>" class="nav-link dropdown-toggle animated fadeIn animation-delay-7" role="button" aria-haspopup="true" aria-expanded="false" data-name="page"><?=$web_data["nav_3_txt"]?></a>
        </li>

      </ul>
    </div>
    <a href="javascript:void(0)" class="ms-toggle-left btn-navbar-menu"><i class="zmdi zmdi-menu"></i></a>
  </div> <!-- container -->
</nav>
