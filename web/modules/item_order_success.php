<?php
use Controllers\SaleController;

if($_SESSION['order-status'] == 'success'){
  $emailContent = '
  A new order has been placed on ren.ie<br>
  ITEM: '.$_SESSION['order-item'].' x'.$_SESSION['order-quantity'].'<br>
  COMMENT: '.$_SESSION['order-comment'];

  $customerEmailContent = '
  Hello '.$_SESSION['order-customer'].',<br>
  Your order has been placed. You will receive an invoice for your order within the next 24 hours and once paid your order will be shipped asap.
  If you have any questions regarding your order, you can reply directly to this email.<br><br>

  Here is your order details:<br>
  <table cellspacing="0" cellpadding="0" border="1">
    <tr>
      <td width="50"><b>Item</b></td>
      <td width="350">'.$_SESSION['order-item'].'</td>
    </tr>
    <tr>
      <td width="50"><b>Quantity</b></td>
      <td width="350">'.$_SESSION['order-quantity'].'</td>
    </tr>
    <tr>
      <td width="50"><b>Comment</b></td>
      <td width="350">'.$_SESSION['order-comment'].'</td>
    </tr>
    <tr>
      <td width="50"><b>Address</b></td>
      <td width="350">'.$_SESSION['order-address'].'</td>
    </tr>
  </table>
  <br>
  Thanks for your order,<br>
  Ren<br>
  <a href="https://ren.ie/" target="_blank">www.ren.ie</a>';
  SaleController::sendNotificationEmail($config['admin_email'], 'New Order on ren.ie', $emailContent);
  SaleController::sendNotificationEmail($_SESSION['order-email'], 'Your ren.ie Order Details', $customerEmailContent);
}
else{
  echo '<meta http-equiv="refresh" content="0;url=/ordererror/">';
}
session_destroy();
?>
<div class="container pt-6">
  <div class="card card-primary card-hero animated fadeInUp animation-delay-7">
    <div class="card-body">

      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="caption">
            <h3 class="color-success text-center">Your order was successfully submitted</h3>
            <p class="text-center">
              Thank you for submitting your order!<br>
              If you were purchasing a pin, I will send you an invoice asap via PayPal,
              after payment has been received I will notify you when your order has been shipped.<br><br>

              For Pre-Orders, I won't send the invoice until I have the pins in-hand.<br><br>
              For Trades, I will contact you asap about the trade.
            </p><br><br>
          </div>
        </div>
      </div>

      <div class="row mt-2">
        <div class="col-lg-8 offset-lg-2">
          <a href="/home" class="btn btn-raised btn-primary btn-block">Return to Home-page</a>
          <a href="/store" class="btn btn-raised btn-royal btn-block">Back To Store</a><br>
        </div>
      </div>
    </div>
  </div>
</div> <!-- container -->
<script src="/web/assets/js/jquery.min.js"></script>
<script src="/web/assets/js/jquery.matchHeight.js"></script>
