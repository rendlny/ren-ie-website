<?php
$sidebar = $sidebar_socials = NULL;
for($i = 1; $i <= sizeof($web_data["navbar_links"]); $i++){
  $navActive = ($web_data["navbar"][$i] == $current_page) ? 'active' : NULL;
  $sidebar .= '
    <li>
      <a class="link" href="'.$web_data["navbar_links"][$i].'"><i class="'.$web_data["navbar_icons"][$i].'"></i> '.$web_data["navbar"][$i].'</a>
    </li>';
}

for($i = 1; $i <= sizeof($web_data["social_links"]); $i++){
  $sidebar_socials .= '
  <a href="'.$web_data["social_links"][$i].'" class="btn-circle btn-circle-raised '.$web_data["social_class_colors"][$i].'"><i class="'.$web_data["social_icons"][$i].'"></i>
    <div class="ripple-container"></div>
  </a>';
}
?>
<div class="ms-slidebar sb-slidebar sb-left sb-style-overlay" id="ms-slidebar">
  <div class="sb-slidebar-container">
    <header class="ms-slidebar-header">
      <div id="slidebar-header-overlay">
        <div class="ms-slidebar-login">
          <a href="javascript:void(0)" class="withripple"><i class="zmdi zmdi-account"></i> Login</a>
          <a href="javascript:void(0)" class="withripple"><i class="zmdi zmdi-account-add"></i> Register</a>
        </div>
        <div class="ms-slidebar-title">
          <form class="search-form">
            <input id="search-box-slidebar" type="text" class="search-input" placeholder="Search..." name="q" />
            <label for="search-box-slidebar"><i class="zmdi zmdi-search"></i></label>
          </form>
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
      <h4 class="ms-slidebar-block-title">Social Links</h4>
      <div class="ms-slidebar-social">
        <?=$sidebar_socials?>
      </div>
    </div>
  </div>
</div>
