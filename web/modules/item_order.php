<?php
use Controllers\ItemController;
use Controllers\SaleController;

$warning = $itemTrade = $preorderAgreement = $error = $tradeOffer = NULL;

if(!$item->quantity > 0){
  echo '<meta http-equiv="refresh" content="0;url=/store/'.$_GET['code'].'">';
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
        <input name="active" required type="checkbox" <span class="ml-2">You understand that this is a pre-order and may take around 3 to 4 months before I will have the pins and ship them to you.</span>
      </label>
    </div>
  ';
}
?>
<div class="container pt-6">
  <div class="card card-primary card-hero animated fadeInUp animation-delay-7">
    <div class="card-body">
      <?=$warning?>
      <form class="form-horizontal" name="item-order-form" id="item-order-form" method="post" action="/order-processing/">
        <fieldset>

          <div class="row">
            <div class="col-md-4">
              <div class="img-thumbnail" data-mh="top-cards">
                <a href="/store/<?=$item->slug?>" target="_blank"><img src="<?=$item->image_1?>" alt="..." class="img-fluid"></a>
                <div class="caption">
                  <a href="/store/<?=$item->slug?>" target="_blank"><h3 class="color-success"><?=$item->title?></h3></a>
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
                  <!--  For Pre-Orders, I won't send the invoice until I have the pins in-hand.<br>-->
                    For Trades, you can see my <a target="_blank" href="https://trello.com/b/4sPgYiti/rendlys-fursona-pins-collection-trading-eu">pin list here <i class="fa fa-link"></i><a>
                  </p>
                  <h3 class="color-success">Multiple Pins</h3>
                  <p>
                    If you are looking to order multiple pins, you don't need to complete multiple forms. 
                    Simply list the other pins in the comment section at the bottom of this form
                  </p>
                  <h3 class="color-success">Shipping</h3>
                  <p>
                    Pins will be sent in a bubble mailer. Shipping costs are listed below.
                  </p>
                  <?php include $_SERVER['DOCUMENT_ROOT'].'/web/includes/shipping_table.php'; ?>
                </div>
              </div>
            </div>
          </div>

          <input name="itemCode" type="hidden" class="form-control" id="itemCode" value="<?=$item->code?>">

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
            <label for="contactOption" class="col-md-2 control-label">Contact Option</label>
            <div class="col-md-9">

              <div class="radio radio-primary">
                <label>
                  <input type="radio" name="contactOption" id="contactOption1" value="telegram">
                  <span class="circle"></span><span class="check"></span>
                  <i style="color: #179cde;" class="fab fa-telegram fa-2x"></i>&nbsp; Telegram
                </label>
              </div>

              <div class="radio radio-primary">
                <label>
                  <input type="radio" name="contactOption" id="contactOption3" value="twitter">
                  <span class="circle"></span><span class="check"></span>
                  <i style="color: #179cde;" class="fab fa-twitter-square fa-2x"></i>&nbsp; Twitter
                </label>
              </div>
<!--
              <div class="radio radio-primary">
                <label>
                  <input type="radio" name="contactOption" id="contactOption2" value="discord">
                  <span class="circle"></span><span class="check"></span>
                  <i style="color: #7289da;" class="fab fa-discord fa-2x"></i>&nbsp; Discord
                </label>
              </div>
-->
              <div class="radio radio-primary">
                <label>
                  <input type="radio" name="contactOption" id="contactOption3" value="email" checked>
                  <span class="circle"></span><span class="check"></span>
                  <i style="color: red;" class="fa fa-envelope fa-2x"></i>&nbsp; Email
                </label>
              </div>

              <div class="radio radio-primary">
                <label>
                  <input type="radio" name="contactOption" id="contactOption4" value="paypal">
                  <span class="circle"></span><span class="check"></span>
                  <i style="color: #0070ba;" class="fab fa-cc-paypal fa-2x"></i>&nbsp; Same as PayPal Email
                </label>
              </div>

            </div>
          </div>

          <div class="row form-group" id="username-row">
            <label for="inputUser" class="col-md-2 control-label">Contact Email</label>
            <div class="col-md-9">
              <input name="contactName" type="text" class="form-control" id="contactName" placeholder="Your Contact Email">
            </div>
          </div>

          <div class="row form-group">
            <label for="shippingOption" class="col-md-2 control-label">Shipping Option</label>
            <div class="col-md-9">

              <div class="radio radio-primary">
                <label>
                  <input type="radio" name="shippingOption" id="shippingOption1" value="standard" checked>
                  <span class="circle"></span><span class="check"></span>
                  <i style="color: #179cde;" class="fa fa-box fa-2x"></i>&nbsp; Standard (no tracking)
                </label>
              </div>

              <div class="radio radio-primary">
                <label>
                  <input type="radio" name="shippingOption" id="shippingOption2" value="tracked">
                  <span class="circle"></span><span class="check"></span>
                  <i style="color: #179cde;" class="fa fa-map-marker-alt fa-2x"></i>&nbsp; Tracked
                </label>
              </div>

            </div>
          </div>

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
              <button class="btn btn-raised btn-primary btn-block g-recaptcha"
                data-sitekey="<?=$config['recaptcha_site_key']?>"
                data-callback='onSubmit'
                data-action='submit'
              >
                Submit
              </button>
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
