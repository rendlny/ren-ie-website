<?php
use Controllers\ItemController;
use Controllers\SaleController;

$saleLines = NULL;
$sales = SaleController::getUserSales();


foreach ($sales as $sale) {
  $editBtn = '<a class="btn btn-sm btn-primary btn-raised" href="/admin/sales/'.$sale->code.'"><i class="fa fa-pencil"></i></a>';

  $saleLines .= '
  <tr>
    <td>'.$editBtn.'</td>
    <td>'.$sale->customer_name.'</td>
    <td>'.$sale->shipping_address.'</td>
    <td><a href="mailto: '.$sale->paypal.'">'.$sale->paypal.'</a></td>
    <td>'.$sale->trade_offer.'</td>
    <td>'.$sale->comment.'</td>
    <td class="text-center">'.binaryCheck($sale->charged).'</td>
    <td class="text-center">'.binaryCheck($sale->shipped).'</td>
    <td>'.$sale->tracking.'</td>
  </tr>';
  }

function binaryCheck($value){
  $result = ($value == 1) ? '<i class="fa fa-check-circle fa-2x text-success"></i>' : '<i class="fa fa-times-circle fa-2x text-danger"></i>';
  return $result;
}

?>
<div class="ms-hero-page-override ms-hero-img-forest ms-hero-bg-info" style="padding: 30px 0 55px;">
  <div class="container">
    <div class="text-center">
      <br>
      <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5">Search Sales</h1>
    </div>
  </div>
</div>
<br>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Action</th>
            <th>Name</th>
            <th>Address</th>
            <th>PayPal</th>
            <th>Trade Offer</th>
            <th>Comment</th>
            <th>Charged</th>
            <th>Shipped</th>
            <th>Tracking #</th>
          </tr>
        </thead>
        <tbody>
          <?=$saleLines?>
        </tbody>
      </table>
    </div>
  </div>
</div>
