<?php
use Controllers\ItemController;
use Controllers\SaleController;

$saleLines = NULL;
$sales = SaleController::getUserSales();


foreach ($sales as $sale) {
  $item = ItemController::getItemByIdIncludingDeleted($sale->item_id);

  $editBtn = '<a title="Edit Sale" class="btn btn-md btn-raised btn-primary icon-btn" href="/admin/sales/edit/'.$sale->code.'"><i class="fa fa-pencil"></i></a>';

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
  $contactBtn = '<a title="Contact Customer" class="btn btn-md btn-raised icon-btn btn-'.$btnColour.'" href="'.$contactLink.'" target="_blank"><i class="'.($sale->contact_option == 'email' ? 'fa fa-envelope' : 'fab fa-'.$sale->contact_option).'"></i></a>';
  $detailsBtn = '<a row-id="'.$sale->id.'" title="Full Order Details" class="btn btn-md btn-raised btn-royal icon-btn detailsBtn" data-toggle="modal" data-target="#saleDetailModal"><i class="fa fa-file-invoice"></i></a>';

  $saleLines .= '
  <tr id="sale-row-'.$sale->id.'" comment-data="'.$sale->comment.'">
    <td>'.$editBtn.$contactBtn.$detailsBtn.'</td>
    <td class="item">'.$item->title.'</td>
    <td class="text-center">'.$sale->quantity.'</td>
    <td class="customer">'.$sale->customer_name.'</td>
    <td class="address d-none">'.$sale->shipping_address.'</td>
    <td><a href="mailto: '.$sale->paypal.'">'.$sale->paypal.'</a></td>
    <td>'.$sale->trade_offer.'</td>
    <td class="comment d-none">'.$sale->comment.'</td>
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
      <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2">Search Sales</h1>
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
            <th>Item</th>
            <th>Quantity</th>
            <th>Name</th>
            <th>PayPal</th>
            <th>Trade Offer</th>
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

<div class="modal" id="saleDetailModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="sale-id" class="modal-title">Sale #</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3>Customer</h3>
        <p id="sale-customer"></p>
        <hr>
        <h3>Item</h3>
        <p id="sale-item"></p>
        <hr>
        <h3>Comment</h3>
        <p id="sale-comment"></p>
        <hr>
        <h3>Address</h3>
        <p id="sale-address"></p>
        <hr>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.detailsBtn').on("click", function(){
      let saleId = $(this).attr('row-id');
      let customer = $('#sale-row-'+saleId+' .customer').html();
      let item = $('#sale-row-'+saleId+' .item').html();
      let comment = $('#sale-row-'+saleId+' .comment').html();
      let address = $('#sale-row-'+saleId+' .address').html();
      $('#saleDetailModal #sale-id').html('SALE #'+saleId);
      $('#saleDetailModal #sale-customer').html(customer);
      $('#saleDetailModal #sale-item').html(item);
      $('#saleDetailModal #sale-comment').html(comment);
      $('#saleDetailModal #sale-address').html(address);
    });
  });
</script>
