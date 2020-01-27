<?php
use Controllers\ItemController;
use Controllers\SaleController;

$saleLines = NULL;
$sales = SaleController::getUserSales();


foreach ($sales as $sale) {
  $editBtn = '<a title="Edit Sale" class="btn-circle btn-circle-raised btn-circle-primary" href="/admin/sales/'.$sale->code.'"><i class="fa fa-pencil"></i></a>&nbsp;';


  $username = $sale->contact_username;
  if($username[0] == '@'){
    $username = substr($username, 1);
  }

  switch ($sale->contact_option) {
    case "discord":
        $btnColour = "vk";
        $contactLink = $username;
        break;

    case "telegram":
        $btnColour = "twitter";
        $contactLink = 'https://t.me/'.$username;
        break;

    case "email":
        $btnColour = "youtube";
        $contactLink = "mailto: ".$username;
        break;

    case "twitter":
        $btnColour = "twitter";
        $contactLink = 'https://twitter.com/'.$username;
        break;

    default:
        $btnColour = "github";
  }
  $contactBtn = '<a title="Contact Customer" class="btn-circle btn-circle-raised btn-'.$btnColour.'" href="'.$contactLink.'" target="_blank"><i class="fab fa-'.$sale->contact_option.'"></i></a>';

  $saleLines .= '
  <tr>
    <td>'.$editBtn.$contactBtn.'</td>
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
