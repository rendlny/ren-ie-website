<?php
use Controllers\SaleController;

if(isset($_SESSION['order-status']) && $_SESSION['order-status'] == 'success'){
  $emailContent = '
  A new order has been placed on ren.ie<br>
  <table cellspacing="0" cellpadding="0" border="1">
    <tr>
      <td width="100" style="padding: 10px;"><b>Item</b></td>
      <td width="500" style="padding: 10px;">'.$_SESSION['order-item'].'</td>
    </tr>
    <tr>
      <td width="100" style="padding: 10px;"><b>Quantity</b></td>
      <td width="500" style="padding: 10px;">'.$_SESSION['order-quantity'].'</td>
    </tr>
    <tr>
      <td width="100" style="padding: 10px;"><b>Comment</b></td>
      <td width="500" style="padding: 10px;">'.$_SESSION['order-comment'].'</td>
    </tr>
    <tr>
      <td width="100" style="padding: 10px;"><b>Address</b></td>
      <td width="500" style="padding: 10px;">'.$_SESSION['order-address'].'</td>
    </tr>
    <tr>
      <td width="100" style="padding: 10px;"><b>Shipping Option</b></td>
      <td width="500" style="padding: 10px;">'.$_SESSION['order-shipping'].'</td>
    </tr>
  </table>';

  $customerEmailContent = '
  Hello '.$_SESSION['order-customer'].',<br>
  Your order has been placed. You will receive an invoice for your order within the next 24 hours and once paid your order will be shipped asap.
  If you have any questions regarding your order, you can reply directly to this email.<br><br>

  Here is your order details:<br>
  <table cellspacing="0" cellpadding="0" border="1">
    <tr>
      <td width="100" style="padding: 10px;"><b>Item</b></td>
      <td width="500" style="padding: 10px;">'.$_SESSION['order-item'].'</td>
    </tr>
    <tr>
      <td width="100" style="padding: 10px;"><b>Quantity</b></td>
      <td width="500" style="padding: 10px;">'.$_SESSION['order-quantity'].'</td>
    </tr>
    <tr>
      <td width="100" style="padding: 10px;"><b>Comment</b></td>
      <td width="500" style="padding: 10px;">'.$_SESSION['order-comment'].'</td>
    </tr>
    <tr>
      <td width="100" style="padding: 10px;"><b>Address</b></td>
      <td width="500" style="padding: 10px;">'.$_SESSION['order-address'].'</td>
    </tr>
    <tr>
      <td width="100" style="padding: 10px;"><b>Shipping Option</b></td>
      <td width="500" style="padding: 10px;">'.$_SESSION['order-shipping'].'</td>
    </tr>
  </table>
  <br>
  Thanks for your order,<br>
  Ren<br>
  <a href="https://ren.ie/" target="_blank">www.ren.ie</a>';
  SaleController::sendNotificationEmail($config['admin_email'], 'New Order on ren.ie', $emailContent);
  SaleController::sendNotificationEmail($_SESSION['order-email'], 'Your ren.ie Order Details', $customerEmailContent);
  $pageNotice = '
  <h3 class="color-success text-center">Your order was successfully submitted</h3>
  <p class="text-center">
    Thank you for submitting your order!<br>
    If you were purchasing a pin, I will send you an invoice asap via PayPal,
    after payment has been received I will notify you when your order has been shipped.<br><br>

    For Pre-Orders, I won\'t send the invoice until I have the pins in-hand.<br><br>
    For Trades, I will contact you asap about the trade.
  </p>';
}
else{
  $pageNotice = '
  <h3 class="color-success text-center">An error occured while submitting your order</h3>
  <p class="text-center">
    It seems that an error has occured<br>
    Please return to the shop and try again<br><br>
    If this issues persists, please contact me to fix this issue.
  </p>';
}
session_destroy();
?>
<div class="container pt-6">
  <div class="card card-primary card-hero animated fadeInUp animation-delay-7">
    <div class="card-body">

      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="caption">
            <?=$pageNotice?>
            <br><br>
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
