<?php
use Controllers\SaleController;
use Controllers\ItemController;

$saleCount = SaleController::getUsersSalesCount();
$itemCount = ItemController::getUsersItemCount();
$shippedItemCount = SaleController::getUsersShippedSaleCount();
$recentSales = SaleController::getUsersRecentSales();
$recentSaleRow = NULL;

foreach ($recentSales as $sale) {
  $item = ItemController::getItemById($sale->item_id);
  $recentSaleRow .= '
    <tr>
      <td>'.$sale->created.'</td>
      <td>'.$sale->customer_name.'</td>
      <td>'.$item->title.'</td>
      <td>'.$sale->quantity.'</td>
    </tr>';
}
?>
<div class="ms-hero-page-override ms-hero-img-forest ms-hero-bg-info" style="padding: 30px 0 55px;">
  <div class="container">
    <div class="text-center">
      <br>
      <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2">Dashboard</h1>
    </div>
  </div>
</div>
<div class="container">
  <br>
  <div class="row">

    <div class="col-sm-4">
      <a href="/admin/items/">
        <div class="card card-info card-body overflow-hidden text-center wow zoomInUp animation-delay-2" style="visibility: visible; animation-name: zoomInUp;">
          <h2 class="counter color-info"><?=$itemCount?></h2>
          <i class="fa fa-4x fa-boxes color-info"></i>
          <p class="mt-2 no-mb lead small-caps color-info">Items</p>
        </div>
      </a>
    </div>

    <div class="col-sm-4">
      <a href="/admin/sales/">
        <div class="card card-success card-body overflow-hidden text-center wow zoomInUp animation-delay-2" style="visibility: visible; animation-name: zoomInUp;">
          <h2 class="counter color-success"><?=$saleCount?></h2>
          <i class="fa fa-4x fa-euro color-success"></i>
          <p class="mt-2 no-mb lead small-caps color-success">sales</p>
        </div>
      </a>
    </div>

    <div class="col-sm-4">
      <a href="/admin/sales/">
        <div class="card card-royal card-body overflow-hidden text-center wow zoomInUp animation-delay-2" style="visibility: visible; animation-name: zoomInUp;">
          <h2 class="counter color-royal"><?=$shippedItemCount?></h2>
          <i class="fa fa-4x fa-shipping-fast color-royal"></i>
          <p class="mt-2 no-mb lead small-caps color-royal">Shipped sales</p>
        </div>
      </a>
    </div>

  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card card-primary animated fadeInUp animation-delay-12">
        <div class="card-header">
          <h3 class="card-title"><i class="fa fa-receipt"></i> Recent Sales</h3>
        </div>
        <table class="table table-no-border table-striped">
          <thead>
            <tr><th>Date</th><th>Customer</th><th>Item</th><th>Quantity</th></tr>
          </thead>
          <tbody>

            <?=$recentSaleRow?>

          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
