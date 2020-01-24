<?php
$sidebar = NULL;
for($i = 1; $i <= sizeof($web_data["admin_navbar_links"]); $i++){
  $navActive = ($web_data["admin_navbar"][$i] == $current_page) ? 'active' : NULL;
  $sidebar .= '
    <li>
      <a class="link" href="'.$web_data["admin_navbar_links"][$i].'"><i class="'.$web_data["admin_navbar_icons"][$i].'"></i> '.$web_data["admin_navbar"][$i].'</a>
    </li>';
}
?>
<div class="ms-slidebar sb-slidebar sb-left sb-style-overlay" id="ms-slidebar">
  <div class="sb-slidebar-container">
    <header class="ms-slidebar-header">
      <div id="slidebar-header-overlay">

        <div class="ms-slidebar-title">
          <div class="ms-slidebar-t">
            <img class="ms-logo ms-logo-sm" src="<?=$web_data["admin_header"]["header_icon_img_link"]?>" alt="Website Icon">
            <h3><?=$web_data["admin_site"]["title"]?></h3>
          </div>
        </div>
      </div>
    </header>
    <ul class="ms-slidebar-menu" id="slidebar-menu" role="tablist" aria-multiselectable="true">
      <?=$sidebar?>
    </ul>

  </div>
</div>
