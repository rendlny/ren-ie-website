<?php
use Controllers\LinkController;

$footerLinks = NULL;

if($links != NULL){
  foreach ($links as $link) {
    $footerLinks .= '
      <a href="'.$link["url"].'" target="_blank" class="btn-circle btn-royal"
      >
        <i class="'.$link["icon"].'"></i>
      </a>
    ';
  }
}
?>

<div id="footer" >
  <aside class="ms-footbar">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 ms-footer-col ms-footer-text-right">
          <div class="ms-footbar-block">
            <div class="ms-footbar-social">
              <?=$footerLinks?>
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
