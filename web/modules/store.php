<?php

use Controllers\ItemController;

$itemCards = NULL;

$items = ItemController::getActiveItems();

if ($items != NULL) {
  foreach ($items as $item) {
    $tagSale = ($item->sale == 1) ? ' sale' : NULL;
    $tagTrade = ($item->trade == 1) ? ' trade' : NULL;
    $tagPreorder = ($item->preorder == 1) ? ' preorder' : NULL;
    $tagBid = ($item->bid == 1) ? ' bid' : NULL;
    $itemTags = $tagSale . $tagTrade . $tagPreorder . $tagBid;

    if ($item->quantity > 0) {
      $labelSale = ($item->sale == 1) ? ' <span class="ms-tag ms-tag-success">€' . number_format(($item->price / 100), 2) . '</span>' : NULL;
      $labelTrade = ($item->trade == 1) ? ' <span class="ms-tag ms-tag-royal">Trade</span>' : NULL;
      $labelPreorder = ($item->preorder == 1) ? ' <span class="ms-tag ms-tag-info">Preorder</span>' : NULL;
      $labelBid = ($item->bid == 1) ? ' <span class="ms-tag ms-tag-danger">Bid</span>' : NULL;

      $itemLabels = $labelSale . $labelTrade . $labelPreorder . $labelBid;

      $btnCart = '<a href="/order/' . $item->slug . '/" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb"><i class="zmdi zmdi-shopping-cart-plus"></i> Order</a>';
    } else {
      $itemLabels = '<span class="ms-tag ms-tag-secondary">Sold Out</span>';
      $btnCart = '<a href="/store/' . $item->slug . '/" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb"><i class="zmdi zmdi-search"></i> View Item</a>';
    }


    $formattedDate = date_format($item->created, 'YmdHi');

    $itemCards .= '
      <div class="col-xl-4 col-md-6 mix ' . $itemTags . '" data-price="' . number_format(($item->price / 100), 2) . '" data-date="' . $formattedDate . '">
        <div class="card ms-feature">
          <div class="card-body overflow-hidden text-center">
            <a style="display:block;" data-mh="itemCardImage" href="/store/' . $item->slug . '/"><img src="' . $item->image_1 . '" alt="" class="img-fluid center-block">
            <h4 data-mh="itemCardTitle" class="text-normal text-center itemCardTitle">' . $item->title . '</h4></a>
            <div class="mt-2">
              ' . $itemLabels . '
            </div>
            ' . $btnCart . '
          </div>
        </div>
      </div>';
  }
}

?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/web/includes/pin_deals_banner.php'; ?>
<div class="container pt-6">
  <div class="row">
    <div class="col-lg-3">

      <?php include $_SERVER['DOCUMENT_ROOT'] . '/web/widgets/custom/store_filter.php'; ?>

      <?php include $_SERVER['DOCUMENT_ROOT'] . '/web/includes/pin_deals_table.php'; ?>
    </div>

    <div class="col-lg-9">
      <div class="row" id="Container">

        <?= $itemCards ?>

      </div>
    </div>
  </div>
</div> <!-- container -->