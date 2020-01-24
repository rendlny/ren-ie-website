<?php

use Controllers\ItemController;

$itemCards = NULL;

$items = ItemController::getUsersActiveItems();

if($items != NULL){
  foreach ($items as $item) {
    $tagSale = ($item->sale == 1) ? ' sale' : NULL;
    $tagTrade = ($item->trade == 1) ? ' trade' : NULL;
    $tagPreorder = ($item->preorder == 1) ? ' preorder' : NULL;
    $tagBid = ($item->bid == 1) ? ' bid' : NULL;
    $itemTags = $tagSale.$tagTrade.$tagPreorder.$tagBid;

    if($item->quantity > 0){
      $labelSale = ($item->sale == 1) ? ' <span class="ms-tag ms-tag-success">€'.number_format(($item->price/100),2).'</span>' : NULL;
      $labelTrade = ($item->trade == 1) ? ' <span class="ms-tag ms-tag-royal">Trade</span>' : NULL;
      $labelPreorder = ($item->preorder == 1) ? ' <span class="ms-tag ms-tag-info">Preorder</span>' : NULL;
      $labelBid = ($item->bid == 1) ? ' <span class="ms-tag ms-tag-danger">Bid</span>' : NULL;

      $itemLabels = $labelSale.$labelTrade.$labelPreorder.$labelBid;

      $btnCart = '<a href="/admin/items/'.$item->code.'/" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb"><i class="zmdi zmdi-edit"></i> Edit</a>';

    }else{
      $itemLabels = '<span class="ms-tag ms-tag-secondary">Sold Out</span>';
      $btnCart = '<a class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb"><i class="zmdi zmdi-search"></i> View Item</a>';
    }


    $formattedDate = date_format($item->created, 'YmdHi');

    $itemCards .= '
      <div class="col-xl-3 col-md-4 col-sm-6 mix '.$itemTags.'" data-price="'.number_format(($item->price/100),2).'" data-date="'.$formattedDate.'">
        <div class="card ms-feature">
          <div class="card-body overflow-hidden text-center">
            <a style="display:block;" data-mh="itemCardImage" href="/admin/items/'.$item->code.'/"><img src="'.$item->image_1.'" alt="" class="img-fluid center-block"></a>
            <h4 data-mh="itemCardTitle" class="text-normal text-center">'.$item->title.'</h4>
            <div class="mt-2">
              '.$itemLabels.'
            </div>
            '.$btnCart.'
          </div>
        </div>
      </div>';
  }
}

?>
<div class="ms-hero-page-override ms-hero-img-forest ms-hero-bg-info" style="padding: 30px 0 55px;">
  <div class="container">
    <div class="text-center">
      <br>
      <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5">Search Items</h1>
    </div>
  </div>
</div>
<br>
<div class="container">
  <div class="row">
    <div class="col-lg-3">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Filters</h3>
        </div>
        <div class="card-body">
          <form class="form-horizontal" id="Filters">
            <fieldset>
              <div class="form-group no-mt">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value=".trade"> Trades </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value=".sale"> Sales </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value=".preorder"> Preorders </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value=".bid"> Bids </label>
                </div>
              </div>
            </fieldset>
            <button class="btn btn-danger btn-block no-mb mt-2" id="Reset"><i class="zmdi zmdi-delete"></i> Clear Filters</button>
          </form>
          <form class="form-horizontal">
            <h4>Sort by</h4>
            <div class="form-group">
              <select id="SortSelect" class="form-control selectpicker" data-dropup-auto="false">
                <option value="price:asc">Price ASC</option>
                <option value="price:desc">Price DESC</option>
                <option value="date:asc">Release ASC</option>
                <option value="date:desc">Release DESC</option>
              </select>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-9">
      <div class="row" id="Container">

        <?=$itemCards?>

      </div>
    </div>
  </div>
</div> <!-- container -->
