<?php
$footerLinks = $footerEmail = NULL;

if ($links != NULL) {
  foreach ($links as $link) {
    if ($link->footer) {
      $footerLinks .= '
        <a href="' . $link["url"] . '" target="_blank" class="btn-circle btn-royal"
        >
          <i class="' . $link["icon"] . '"></i>
        </a>
      ';
    }
  }
}

if ($web_data["site"]["email"] != NULL) {
  $footerEmail = '
    <div class="ms-footbar-block-top-padding-only">
      <div class="ms-footbar-social">
        <a href="mailto:' . $web_data["site"]["email"] . '" style="background: none;">
          <i class="fa fa-envelope"></i>&nbsp; ' . $web_data["site"]["email"] . '
        </a>
      </div>
    </div>
  ';
}
?>

<div id="footer">
  <aside class="ms-footbar">
    <div class="container">
      <div class="row">

        <div class="col-lg-3 col-md-4 col-sm-12 ms-footer-col text-center">
          <?= $footerEmail ?>
        </div>

        <div class="col-lg-9 col-md-8 col-sm-12 ms-footer-col ms-footer-text-right">
          <div class="ms-footbar-block">
            <div class="ms-footbar-social">
              <?= $footerLinks ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </aside>
  <footer class="ms-footer">
    <div class="container">
      <p>Copyright &copy; 2019 - <?= date("Y") ?> Ren Delaney</p>
    </div>
  </footer>
  <div class="btn-back-top">
    <a href="#" data-scroll id="back-top" class="btn-circle btn-circle-primary btn-circle-sm btn-circle-raised "><i class="zmdi zmdi-long-arrow-up"></i></a>
  </div>
</div>