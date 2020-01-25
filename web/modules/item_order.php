<?php
use Controllers\ItemController;
use Controllers\SaleController;

$warning = $itemTrade = $preorderAgreement = NULL;

$item = ItemController::getItemByCode($_GET['code']);

if($_SERVER["REQUEST_METHOD"] == "POST") {
  try{

    $data = [
      'item_id' => $item->id,
      'quantity' => $_POST['quantity'],
      'customer_name' => $_POST['name'],
      'shipping_address' => $_POST['address'],
      'paypal' => $_POST['email'],
      'trade_offer' => $_POST['trade'],
      'comment' => $_POST['comment'],
    ];

    $sale = SaleController::addSale($data);
  } catch (Exception $e) {
     $error = $e->getMessage();
  }

  if ($error != NULL){
    $_SESSION['form-alert'] = '
      <div class="alert alert-danger">
        <i class="fa fa-exclamation-circle"></i><strong> System Error! </strong>
        We are sorry but there was a system error, please try again. If this issue persists let me know and I will look into it.
      </div>
    ';
  } else {
    echo '<meta http-equiv="refresh" content="0;url=/ordersuccess/">';
  }
}

if($item->trade){
  $tradeOffer = '
  <div class="row form-group">
    <label for="inputPassword2" class="col-md-2 control-label">Trade Offer<br>(if trading)</label>
    <div class="col-md-9">
      <textarea class="form-control" rows="3" id="trade" name="trade"></textarea>
    </div>
  </div>';
}

if($item->preorder){
  $preorderAgreement = '
    <div class="checkbox">
      <label>
        <input name="active" required type="checkbox" <span class="ml-2">You understand that this is a pre-order and may take 3 to 4 months before I will have the pins ans ship them to you.</span>
      </label>
    </div>
  ';
}
?>
<div class="ms-hero-page-override ms-hero-img-forest ms-hero-bg-info" style="padding: 30px 0 55px;">
  <div class="container">
    <div class="text-center">
      <br>
      <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5">Order Form</h1>
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

          <div class="row">
            <div class="col-md-4">
              <div class="img-thumbnail" data-mh="top-cards">
                <img src="<?=$item->image_1?>" alt="..." class="img-fluid">
                <div class="caption">
                  <h3 class="color-success"><?=$item->title?></h3>
                  <h4>€<?=($item->price/100)?></h4>
                  <p><?=$item->description?></p>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="img-thumbnail" data-mh="top-cards">
                <div class="caption">
                  <h3 class="color-success">Order Information</h3>
                  <p>
                    After you submit this form I will send you an invoice via PayPal using the email you have provided.<br>
                    For Pre-Orders, I won't send the invoice until I have the pins in-hand.<br>
                    For Trades, you can see my <a target="_blank" href="https://trello.com/b/4sPgYiti/rendlys-fursona-pins-collection-trading-eu">pin list here <i class="fa fa-link"></i><a>
                    I will generally take any pins that I don't own
                  </p>
                  <h3 class="color-success">Shipping</h3>
                  <p>
                    Pins will be sent in a bubble mailer. Shipping costs are listed below.
                    If you would like to pay the higher price for tracking then just let me know in the comments box.
                  </p>
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th></th><th>Cost (no tracking)</th><th>With Tracking</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Ireland</td><td>€2</td><td>€9</td>
                      </tr>
                      <tr>
                        <td>Europe</td><td>€3</td><td>€10</td>
                      </tr>
                      <tr>
                        <td>USA</td><td>€3</td><td>€10</td>
                      </tr>
                    </tbody>
                  </table><br>
                  <p>*For elsewhere I will contact you with the shipping cost.</p>
                </div>
              </div>
            </div>
          </div>


          <div class="row form-group">
            <label for="inputName" class="col-md-2 control-label">Quantity</label>
            <div class="col-md-9">
              <input required name="quantity" type="number" class="form-control" id="quantity" placeholder="Quantity" value="1">
            </div>
          </div>

          <div class="row form-group">
            <label for="inputUser" class="col-md-2 control-label">Name</label>
            <div class="col-md-9">
              <input required name="name" type="text" class="form-control" id="name" placeholder="Your Name">
            </div>
          </div>
          <div class="row form-group">
            <label for="inputEmail" class="col-md-2 control-label">Shipping Address</label>
            <div class="col-md-9">
              <textarea required class="form-control" rows="3" id="address" name="address"></textarea>
            </div>
          </div>
          <div class="row form-group">
            <label for="inputPassword" class="col-md-2 control-label">PayPal Email</label>
            <div class="col-md-9">
              <input required name="email" type="email" class="form-control" id="email" placeholder="PayPal Email">
            </div>
          </div>

          <?=$tradeOffer?>

          <div class="row form-group">
            <label for="inputPassword2" class="col-md-2 control-label">Comments or Questions</label>
            <div class="col-md-9">
              <textarea class="form-control" rows="3" id="comment" name="comment"></textarea>
            </div>
          </div>

          <div class="row mt-2">
            <div class="offset-lg-2 col-lg-4">
              <?=$preorderAgreement?>
            </div>
            <div class="col-lg-5">
              <button class="btn btn-raised btn-primary btn-block">Submit</button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</div> <!-- container -->
<script src="/web/assets/js/jquery.min.js"></script>
<script src="/web/assets/js/jquery.matchHeight.js"></script>
