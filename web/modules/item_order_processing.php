<?php
use Controllers\ItemController;
use Controllers\SaleController;

$warning = $error = NULL;

if($_SERVER["REQUEST_METHOD"] == "POST") {
  try{
    $recaptchaPassed = SaleController::recaptcha($_POST['g-recaptcha-response']);

    if(!$recaptchaPassed){
      $error = 'Recaptcha failed';
    }else{
      $itemCode = $_POST['itemCode'];
      $item = ItemController::getItemByCode($itemCode);
      $data = [
        'item_id' => $item->id,
        'quantity' => $_POST['quantity'],
        'customer_name' => $_POST['name'],
        'shipping_address' => $_POST['address'],
        'paypal' => $_POST['email'],
        'trade_offer' => $_POST['trade'],
        'comment' => $_POST['comment'],
        'contact_option' => $_POST['contactOption'],
        'contact_username' => $_POST['contactName'],
      ];

      if($_POST['contactOption'] == 'paypal'){
        $data['contact_username'] = $_POST['email'];
        $data['contact_option'] = 'email';
      }

      $sale = SaleController::addSale($data);
    }

  } catch (Exception $e) {
    $error = $e->getMessage();
  }

  if ($error != NULL){
    $warning = '
      <div class="alert alert-danger">
        <i class="fa fa-exclamation-circle"></i><strong> System Error! </strong>
        We are sorry but there was a system error, please try again. If this issue persists let me know and I will look into it.<br>
      [ '.$error.' ]
      </div>
    ';
    echo '<meta http-equiv="refresh" content="0;url=/order-result/">';
  } else {
    $_SESSION['order-status'] = 'success';
    $_SESSION['order-email'] = $data['paypal'];
    $_SESSION['order-address'] = $data['shipping_address'];
    $_SESSION['order-customer'] = $data['customer_name'];
    $_SESSION['order-item'] = $item->title;
    $_SESSION['order-quantity'] = $data['quantity'];
    $_SESSION['order-comment'] = $data['comment'];
    echo '<meta http-equiv="refresh" content="0;url=/order-result/">';
  }
}else{
  echo '<meta http-equiv="refresh" content="0;url=/order-result/">';
}

?>
<div class="container pt-6">
  <div class="card card-primary card-hero animated fadeInUp animation-delay-7">
    <div class="card-body">
      <?=$warning?>
      <form class="form-horizontal" name="item-order-form" id="item-order-form" method="post">
        <fieldset>

          <div class="row text-center">
            <div class="col-md-12">
              <div class="img-thumbnail" data-mh="top-cards">
                <div class="caption">
                  <h3 class="color-success">The system is processing your order, please wait until this completes.</h3><br>
                  <div class="fa-8x">
                    <i class="fas fa-circle-notch fa-spin"></i>
                  </div><br><br>
                  <p>
                    This should only take a 1 to 2 minutes. If you are not redirected in that time,
                    use the button below to continue.
                  </p>
                  <a class="btn btn-royal btn-raised" href="">Continue</a><br><br><br>
                </div>
              </div>
            </div>
          </div>

        </fieldset>
      </form>
    </div>
  </div>
</div> <!-- container -->
<script src="/web/assets/js/jquery.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js?render=<?=$config['recaptcha_site_key']?>"></script>
<script src="/web/assets/js/jquery.matchHeight.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
  function onSubmit(token) {
    $("#item-order-form").submit();
  }
</script>
<script>
  $('input[type=radio][name=contactOption]').on('change', function(){
    let option = $(this).val();
    if(option == 'paypal'){
      $('#username-row').css('display', 'none');
    }else{
      $('#username-row').css('display', 'flex');
      if(option == 'email'){
        $('#username-row label').html('Contact Email');
        $('#username-row input').attr('placeholder','Your Contact Email');
      }else{
        $('#username-row label').html('Contact Username');
        $('#username-row input').attr('placeholder','Your Contact Username');
      }
    }
  });
</script>
