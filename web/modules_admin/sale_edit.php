<?php
$warning = $error = $sale = NULL;

use Controllers\SaleController;
use Controllers\ItemController;

if($_SERVER["REQUEST_METHOD"] == "POST") {
  try{
    $sale = SaleController::getSaleByCodeAndUser($_GET['code']);
    $item = ItemController::getItemById($sale->item_id);
    $charged = (isset($_POST['charged'])) ? 1 : 0;
    $shipped = (isset($_POST['shipped'])) ? 1 : 0;

    $data = [
      'code' => $_GET['code'],
      'item_id' => $sale->item_id,
      'quantity' => $_POST['quantity'],
      'total_price' => ($item->price * $_POST['quantity']),
      'customer_name' => $_POST['name'],
      'paypal' => $_POST['email'],
      'shipping_address' => $_POST['address'],
      'trade_offer' => $_POST['trade'],
      'comment' => $_POST['comment'],
      'charged' => $charged,
      'tracking' => $_POST['tracking'],
      'shipped' => $shipped,
      'cancelled' => $sale->cancelled,
      'refunded' => $sale->refunded,
    ];
    $sale = SaleController::updateSale($data);
  } catch (Exception $e) {
    $error = $e->getMessage();
  }

  if ($error != NULL){
    $_SESSION['form-alert'] = '
      <div class="alert alert-danger">
        <i class="fa fa-exclamation-circle"></i>
        <strong> System Error! </strong>
         We are sorry but there was a system error: '.$error.'
       </div>';
  }
  else {
    $_SESSION['form-alert'] = '
      <div class="alert alert-success">
         <i class="fa fa-check-circle"></i>
         <strong> Sale Updated! </strong>
         You have successfully edited this sale. You can continue to edit this sale using the form.
       </div>';
  }
}

if(isset($_SESSION['form-alert'])) {
  $warning = $_SESSION['form-alert'];
  $_SESSION['form-alert'] = NULL;
}


if(isset($_GET['code']) && $_GET['code'] != NULL){
  $sale = SaleController::getSaleByCodeAndUser($_GET['code']);
  $item = ItemController::getItemById($sale->item_id);

  $saleCharged = ($sale->charged) ? 'checked="checked"' : NULL;
  $saleShipped = ($sale->shipped) ? 'checked="checked"' : NULL;

}else{
  echo '<meta http-equiv="refresh" content="0;url=/admin/sales/">';
}

if($sale == NULL){
  echo '<meta http-equiv="refresh" content="0;url=/admin/sales/">';
}

?>
<div class="ms-hero-page-override ms-hero-img-forest ms-hero-bg-info" style="padding: 30px 0 55px;">
  <div class="container">
    <div class="text-center">
      <br>
      <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5">Edit Sale</h1>
    </div>
  </div>
</div>
<br><br><br>
<div class="container">
  <div class="card card-primary card-hero animated fadeInUp animation-delay-7">
    <div class="card-body">
      <?=$warning?>
      <form class="form-horizontal" name="editItem" method="post">
        <fieldset>

          <div class="col-md-6 offset-md-3">
            <a class="btn btn-royal btn-raised btn-block" href="/admin/sales/"><i class="fa fa-arrow-left"></i>&nbsp; Back to Sales</a>
          </div>
          <br>

          <div class="row form-group">
            <label for="inputUser" class="col-md-2 control-label">Customer Name</label>
            <div class="col-md-9">
              <input name="name" type="text" class="form-control" id="name" placeholder="Customer Name" value="<?=$sale->customer_name?>">
            </div>
          </div>

          <div class="row form-group">
            <label for="inputEmail" class="col-md-2 control-label">Shipping Address</label>
            <div class="col-md-9">
              <textarea class="form-control" rows="3" id="address" name="address"><?=$sale->shipping_address?></textarea>
            </div>
          </div>

          <div class="row form-group">
            <label for="inputName" class="col-md-2 control-label">PayPal Email</label>
            <div class="col-md-9">
              <input name="email" type="email" class="form-control" id="email" placeholder="PayPal Email" value="<?=$sale->paypal?>">
            </div>
          </div>

          <div class="row form-group">
            <label for="inputEmail" class="col-md-2 control-label">Quantity</label>
            <div class="col-md-9">
              <input name="quantity" type="number" class="form-control" id="quantity" placeholder="Quantity Of Item" value="<?=$sale->quantity?>">
            </div>
          </div>

          <div class="row form-group">
            <label for="inputEmail" class="col-md-2 control-label">Trade Offer</label>
            <div class="col-md-9">
              <textarea class="form-control" rows="3" id="trade" name="trade"><?=$sale->trade_offer?></textarea>
            </div>
          </div>

          <div class="row form-group">
            <label for="inputEmail" class="col-md-2 control-label">Comment</label>
            <div class="col-md-9">
              <textarea class="form-control" rows="3" id="comment" name="comment"><?=$sale->comment?></textarea>
            </div>
          </div>


          <div class="row form-group">
            <label for="trade" class="col-md-2 control-label">Charged?</label>
            <div class="col-md-9">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="charged" <?=$saleCharged?>> <span class="ml-2">Yes</span>
                </label>
              </div>
            </div>
          </div>

          <div class="row form-group">
            <label for="trade" class="col-md-2 control-label">Shipped?</label>
            <div class="col-md-9">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="shipped" <?=$saleShipped?>> <span class="ml-2">Yes</span>
                </label>
              </div>
            </div>
          </div>

          <div class="row form-group">
            <label for="inputUser" class="col-md-2 control-label">Tracking #</label>
            <div class="col-md-9">
              <input name="tracking" type="text" class="form-control" id="tracking" placeholder="Tracking Number" value="<?=$sale->tracking?>">
            </div>
          </div>



          <div class="row mt-2">
            <div class="col-lg-5">
              <a class="btn btn-raised btn-royal btn-block" href="/admin/sales/">Cancel</a>
            </div>
            <div class="col-lg-7">
              <button class="btn btn-raised btn-primary btn-block">Submit</button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</div> <!-- container -->
