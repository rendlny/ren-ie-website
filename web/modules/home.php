<div id="home-body" class="wrap wrap-mountain mt-6">
  <div class="container">

    <h2 class="text-center text-light mb-6 wow fadeInDown animation-delay-5"><strong><?=$web_data["home"]["home_title"]?></strong></h2>
    <hr>

    <div class="alert alert-royal alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="zmdi zmdi-close"></i></button>
      <h3 class="alert-heading"><i class="fa fa-exclamation-circle"></i>&nbsp; Notice - website name change</h3>
      <p>
        KalciumCove.ie is changing to <strong>ren.ie</strong><br>
        In November KalciumCove.ie will no longer work and you will need to use ren.ie to access this site.
      </p>
    </div>

    <div class="row">
      <div class="col-lg-4 order-lg-2 mb-4  center-block">
        <img id="home-body-img" src="/web/assets/images/spoopyfloofer-icon2019.png" alt="" class="img-fluid center-block wow zoomIn animation-delay-12 ">
      </div>
      <div id="home-txt" class="col-lg-6 order-lg-1 pr-6">
        <p class="wow fadeInLeft animation-delay-6"><?=$web_data["home"]["home_txt_1"]?></p>
        <p class="wow fadeInLeft animation-delay-7"><?=$web_data["home"]["home_txt_2"]?></p>
        <p class="wow fadeInLeft animation-delay-8"><?=$web_data["home"]["home_txt_3"]?></p>
        <div class="text-center">
          <a href="/store" class="btn btn-primary btn-raised mr-1 wow flipInX animation-delay-14">
            <?=$web_data["home"]["home_btn_1"]?>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
