<div id="home-body" class="wrap wrap-mountain mt-6">
  <div class="container">

    <h2 class="text-center text-light mb-6"><strong><?=$web_data["home"]["home_title"]?></strong></h2>
    <hr>

    <div class="row">
      <div class="col-lg-4 order-lg-2 mb-4  center-block">
        <img id="home-body-img" src="/web/assets/images/me_square.jpg" alt="" class="img-fluid center-block wow zoomIn animation-delay-4 ">
      </div>
      <div id="home-txt" class="col-lg-6 order-lg-1 pr-6">
        <p class="wow fadeInLeft animation-delay-1">
          <?=$web_data["home"]["home_txt_1"]?>
        </p>
        <div class="text-center">
          <a href="/coding" class="btn btn-primary btn-raised btn-block mr-1 wow flipInX animation-delay-5">
            <i class="fa fa-terminal"></i>&nbsp; Coding
          </a>
        </div>
        <p class="wow fadeInLeft animation-delay-2"><?=$web_data["home"]["home_txt_2"]?></p>
        <div class="text-center">
          <a href="/store" class="btn btn-primary btn-raised btn-block mr-1 wow flipInX animation-delay-5">
            <?=$web_data["home"]["home_btn_1"]?>
          </a>
        </div>

        <p class="wow fadeInLeft animation-delay-3"><?=$web_data["home"]["home_txt_3"]?></p>
      </div>
    </div>
  </div>
</div>
