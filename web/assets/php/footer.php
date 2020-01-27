<?php
$footer_socials = NULL;

for($i = 1; $i <= sizeof($web_data["social_links"]); $i++){
  $footer_socials .= '<a href="'.$web_data["social_links"][$i].'" target="_blank" class="btn-circle '.$web_data["social_class_colors"][$i].'"><i class="'.$web_data["social_icons"][$i].'"></i></a>';
}
?>
  <br><br><br><br><br>
<div id="footer" >
  <aside class="ms-footbar">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 ms-footer-col ms-footer-text-right">
          <div class="ms-footbar-block">
            <div class="ms-footbar-social">
              <?=$footer_socials?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </aside>
  <footer class="ms-footer">
    <div class="container">
      <p><?=$web_data["footer"]["copyright_txt"]?></p>
    </div>
  </footer>
  <div class="btn-back-top">
    <a href="#" data-scroll id="back-top" class="btn-circle btn-circle-primary btn-circle-sm btn-circle-raised "><i class="zmdi zmdi-long-arrow-up"></i></a>
  </div>
</div>
