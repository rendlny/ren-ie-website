<?php
use Controllers\ItemController;

$carouselImages = $carouselThumbs = NULL;

if(isset($_GET['code']) && $_GET['code'] != NULL){
  $item = ItemController::getItemByCode($_GET['code']);

  $carouselImages .= ($item->image_1 != NULL) ? '<div class="carousel-item active"><img src="'.$item->image_1.'" alt="Product Image 1"></div>' : NULL;
  $carouselImages .= ($item->image_2 != NULL) ? '<div class="carousel-item"><img src="'.$item->image_2.'" alt="Product Image 2"></div>' : NULL;
  $carouselImages .= ($item->image_3 != NULL) ? '<div class="carousel-item"><img src="'.$item->image_3.'" alt="Product Image 3"></div>' : NULL;
  $carouselImages .= ($item->image_4 != NULL) ? '<div class="carousel-item"><img src="'.$item->image_4.'" alt="Product Image 4"></div>' : NULL;
  $carouselImages .= ($item->image_5 != NULL) ? '<div class="carousel-item"><img src="'.$item->image_5.'" alt="Product Image 5"></div>' : NULL;

  $carouselThumbs .= ($item->image_1 != NULL) ? '<li data-target="#carousel-product" data-slide-to="0" class="active itemImgPreview"><img src="'.$item->image_1.'" alt="Product Image 1"></li>' : NULL;
  $carouselThumbs .= ($item->image_2 != NULL) ? '<li data-target="#carousel-product" data-slide-to="1" class="itemImgPreview"><img src="'.$item->image_2.'" alt="Product Image 2"></li>' : NULL;
  $carouselThumbs .= ($item->image_3 != NULL) ? '<li data-target="#carousel-product" data-slide-to="2" class="itemImgPreview"><img src="'.$item->image_3.'" alt="Product Image 3"></li>' : NULL;
  $carouselThumbs .= ($item->image_4 != NULL) ? '<li data-target="#carousel-product" data-slide-to="3" class="itemImgPreview"><img src="'.$item->image_4.'" alt="Product Image 4"></li>' : NULL;
  $carouselThumbs .= ($item->image_5 != NULL) ? '<li data-target="#carousel-product" data-slide-to="4" class="itemImgPreview"><img src="'.$item->image_5.'" alt="Product Image 5"></li>' : NULL;

  $stockLabel = ($item->quantity > 0) ? '<span class="ms-tag ms-tag-success">in stock</span>' : '<span class="ms-tag ms-tag-danger">out of stock</span>';
  $stockLabel = ($item->preorder) ? '<span class="ms-tag ms-tag-warning">Awaiting Stock</span>' : $stockLabel;
  $stockNumber = ($item->quantity > 0) ? '<span class="ms-tag ms-tag-success">'.$item->quantity.'</span>' : '<span class="ms-tag ms-tag-danger">0</span>';

  $buttonTxt = ($item->preorder) ? 'Pre-Order' : 'Order';

  $orderBtn = ($item->quantity > 0) ? '
    <a href="/order/'.$_GET['code'].'/" class="btn btn-primary btn-block btn-raised mt-2 no-mb">
      <i class="zmdi zmdi-shopping-cart-plus"></i> '.$buttonTxt.'
    </a>' : '<a class="btn btn-danger btn-block btn-raised mt-2 no-mb">Sold Out</a>';
}else{
  header('Location: /store');
}
?>
<div id="item-view-bg">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <a href="/store" style="margin-top:15px;" class="btn btn-royal btn-raised btn-block"><i class="fa fa-arrow-left"></i> Back To All Products</a>
      </div>
    </div>

    <div class="row" style="padding-top: 10px;">
      <div class="col-md-6">
        <div id="carousel-product" class="ms-carousel ms-carousel-thumb carousel slide animated zoomInUp animation-delay-5" data-ride="carousel" data-interval="0">
          <div class="card card-body">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
              <?=$carouselImages?>
            </div>
          </div>
          <!-- Indicators -->
          <ol class="carousel-indicators carousel-indicators-tumbs carousel-indicators-tumbs-outside">
            <?=$carouselThumbs?>
          </ol>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card animated zoomInDown animation-delay-5">
          <div class="card-body">
            <h2><?=$item->title?></h2>
            <div class="mb-2 mt-4">
              <div class="row">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6 text-center">
                  <h2 class="color-success no-m text-normal">€ <?=number_format($item->price/100, 2)?></h2>
                </div>
              </div>
            </div>
            <p class="lead"><?=$item->description?></p>
            <ul class="list-unstyled">
              <li><strong>Stock: </strong> <?=$stockNumber?></li>
              <li class="mb-2"><strong>Availability: </strong> <?=$stockLabel?></li>
              <li><strong>Shipping costs: </strong> <span class="color-success">€2* See table below</span></li>
            </ul>
            <?=$orderBtn?>
          </div>
        </div>

        <div class="card card-success animated fadeInUp animation-delay-10">
          <div class="card-body overflow-hidden text-center">
            <h3 style="color:#21c28e; font-weight: 700; margin: 1rem;">Shipping Prices</h3>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/web/includes/shipping_table.php'; ?>
          </div>
        </div>

        <div class="card card-success animated fadeInUp animation-delay-10">
          <div class="card-body overflow-hidden text-center">
            <i class="zmdi-hc-3x zmdi zmdi-paypal" aria-hidden="true"></i>
            <br>
              For purchases I only accept payment via PayPal
          </div>
        </div>
      </div>
    </div>

  </div> <!-- container -->
</div>
