<?php

use Controllers\ItemController;
use Controllers\UserController;

$imageList = $error = $warning = NULL;
$itemActive = $saleCheck = $preorderCheck = $bidCheck = $tradeCheck = NULL;
$image1 = $image2 = $image3 = $image4 = $image5 = $itemPrice = $itemTitle = $itemDesc = NULL;
$userId = $_SESSION['userId'];

if($_SERVER["REQUEST_METHOD"] == "POST") {

  try{
    $active = (isset($_POST['active'])) ? 1 : 0;
    $tradeable = (isset($_POST['trade'])) ? 1 : 0;
    $sale = ($_POST['saleType'] == 'sale') ? 1 : 0;
    $preorder = ($_POST['saleType'] == 'preorder') ? 1 : 0;
    $bid = ($_POST['saleType'] == 'bid') ? 1 : 0;

    $data = [
      'code' => $_GET['code'],
      'user_id' => $userId,
      'title' => $_POST['title'],
      'description' => $_POST['description'],
      'active' => $active,
      'price' => ($_POST['price'] * 100),
      'trade' => $tradeable,
      'preorder' => $preorder,
      'sale' => $sale,
      'bid' => $bid,
      'weight' => $_POST['weight'],
      'quantity' => $_POST['quantity'],
      'image_1' => $_POST['image_1'],
      'image_2' => $_POST['image_2'],
      'image_3' => $_POST['image_3'],
      'image_4' => $_POST['image_4'],
      'image_5' => $_POST['image_5'],
    ];
    if($_GET['code'] == 'add'){ //Add
      $data['code'] = NULL;
      $item = ItemController::addItem($data);
      $successMsg = '<strong> Item Added! </strong>
      You have successfully added this item. You can continue to edit this item using the form.';
    }else{ // Edit
      $item = ItemController::updateItem($data);
      $successMsg = '<strong> Item updated! </strong>
      You have successfully edited this item. You can continue to edit this item using the form.';
    }
  } catch (Exception $e) {
    $error = $e->getMessage();
  }

 	if ($error != NULL){
 		$_SESSION['form-alert'] = '
 			<div class="alert alert-danger">
        <i class="fa fa-exclamation-circle"></i>
        <strong> System Error! </strong>
        We are sorry but there was a system error: '.$error.'
      </div>
    ';
 	}
  else {

 		$_SESSION['form-alert'] = '
 			<div class="alert alert-success">
        <i class="fa fa-check-circle"></i> '.$successMsg.'
      </div>
    ';
  }
}

if(isset($_SESSION['form-alert'])) {
  $warning = $_SESSION['form-alert'];
  $_SESSION['form-alert'] = NULL;
}

if(isset($_GET['code']) && $_GET['code'] != NULL){
  if($_GET['code'] != 'add'){
    $pageTitle = 'Edit Item';
    $item = ItemController::getItemByCodeAndUser($_GET['code']);
    if($item == NULL){
      echo '<meta http-equiv="refresh" content="0;url=/admin/items/">';
    }

    $imageList .= ($item->image_1 != NULL) ? '<a href="'.$item->image_1.'" data-lightbox="image-1" data-title="My caption">Item Image 1</a>&nbsp;' : NULL;
    $imageList .= ($item->image_2 != NULL) ? '<a href="'.$item->image_2.'" data-lightbox="image-1" data-title="My caption">Item Image 2</a>&nbsp;' : NULL;
    $imageList .= ($item->image_3 != NULL) ? '<a href="'.$item->image_3.'" data-lightbox="image-1" data-title="My caption">Item Image 3</a>&nbsp;' : NULL;
    $imageList .= ($item->image_4 != NULL) ? '<a href="'.$item->image_4.'" data-lightbox="image-1" data-title="My caption">Item Image 4</a>&nbsp;' : NULL;
    $imageList .= ($item->image_5 != NULL) ? '<a href="'.$item->image_5.'" data-lightbox="image-1" data-title="My caption">Item Image 5</a>&nbsp;' : NULL;

    $image1 = $item->image_1;
    $image2 = $item->image_2;
    $image3 = $item->image_3;
    $image4 = $item->image_4;
    $image5 = $item->image_5;
    $itemTitle = $item->title;
    $itemDesc = $item->description;

    $itemPrice = $item->price;
    $itemActive = ($item->active) ? 'checked="checked"' : NULL;
    $saleCheck = ($item->sale) ? 'checked' : NULL;
    $preorderCheck = ($item->preorder) ? 'checked' : NULL;
    $bidCheck = ($item->bid) ? 'checked' : NULL;
    $tradeCheck = ($item->trade) ? 'checked="checked"' : NULL;
  }else{
    $pageTitle = 'Add Item';
  }

}


?>
<div class="ms-hero-page-override ms-hero-img-forest ms-hero-bg-info" style="padding: 30px 0 55px;">
  <div class="container">
    <div class="text-center">
      <br>
      <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5"><?=$pageTitle?></h1>
    </div>
  </div>
</div>
<br><br><br>
<div class="container">
  <div class="card card-primary card-hero animated fadeInUp animation-delay-7">
    <div class="card-body">
      <a href="/admin/items/" class="btn btn-royal btn-raised btn-block"><i class="fa fa-arrow-left"></i>&nbsp; Cancel</a>
      <?=$warning?>
      <form class="form-horizontal" name="editItem" method="post">
        <fieldset>
          <div class="row form-group">
            <label for="inputUser" class="col-md-2 control-label">Name</label>
            <div class="col-md-9">
              <input name="title" type="text" class="form-control" id="title" placeholder="Item Name" value="<?=$itemTitle?>">
            </div>
          </div>
          <div class="row form-group">
            <label for="inputEmail" class="col-md-2 control-label">Description</label>
            <div class="col-md-9">
              <textarea class="form-control" rows="3" id="description" name="description"><?=$itemDesc?></textarea>
            </div>
          </div>
          <div class="row form-group">
            <label for="inputPassword" class="col-md-2 control-label">Price</label>
            <div class="col-md-9">
              <input name="price" type="text" class="form-control" id="inputPassword" placeholder="Price" value="<?=($itemPrice/100)?>">
            </div>
          </div>
          <div class="row form-group">
            <label for="inputPassword2" class="col-md-2 control-label">Quantity</label>
            <div class="col-md-9">
              <input name="quantity" type="number" class="form-control" id="inputPassword2" placeholder="Quantity" value="<?=$item->quantity?>">
            </div>
          </div>
          <div class="row form-group">
            <label for="inputName" class="col-md-2 control-label">Weight</label>
            <div class="col-md-9">
              <input name="weight" type="number" class="form-control" id="inputName" placeholder="Weight" value="<?=$item->weight?>">
            </div>
          </div>
          <div class="row form-group">
            <label for="inputName" class="col-md-2 control-label">Sale Type</label>
            <div class="col-md-9">

              <div class="radio radio-primary">
                <label>
                  <input type="radio" name="saleType" id="optionsRadios1" value="sale" <?=$saleCheck?> >
                  <span class="circle"></span><span class="check"></span>
                  Sale
                </label>
              </div>

              <div class="radio radio-primary">
                <label>
                  <input type="radio" name="saleType" id="optionsRadios2" value="preorder" <?=$preorderCheck?> >
                  <span class="circle"></span><span class="check"></span>
                  Preorder
                </label>
              </div>

              <div class="radio radio-primary">
                <label>
                  <input type="radio" name="saleType" id="optionsRadios3" value="bid" <?=$bidCheck?> >
                  <span class="circle"></span><span class="check"></span>
                  Bid
                </label>
              </div>

            </div>
          </div>
          <div class="row form-group">
            <label for="trade" class="col-md-2 control-label">Allow Trade Requests?</label>
            <div class="col-md-9">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="trade" <?=$tradeCheck?>> <span class="ml-2">Yes</span>
                </label>
              </div>
            </div>
          </div>

          <?=$imageList?>

          <div class="row form-group">
            <label for="inputUser" class="col-md-2 control-label">Image #1</label>
            <div class="col-md-9">
              <input name="image_1" type="text" class="form-control" id="inputUser" placeholder="Image #1 Link" value="<?=$image1?>">
            </div>
          </div>

          <div class="row form-group">
            <label for="inputUser" class="col-md-2 control-label">Image #2</label>
            <div class="col-md-9">
              <input name="image_2" type="text" class="form-control" id="inputUser" placeholder="Image #2 Link" value="<?=$image2?>">
            </div>
          </div>

          <div class="row form-group">
            <label for="inputUser" class="col-md-2 control-label">Image #3</label>
            <div class="col-md-9">
              <input name="image_3" type="text" class="form-control" id="inputUser" placeholder="Image #3 Link" value="<?=$image3?>">
            </div>
          </div>

          <div class="row form-group">
            <label for="inputUser" class="col-md-2 control-label">Image #4</label>
            <div class="col-md-9">
              <input name="image_4" type="text" class="form-control" id="inputUser" placeholder="Image #4 Link" value="<?=$image4?>">
            </div>
          </div>

          <div class="row form-group">
            <label for="inputUser" class="col-md-2 control-label">Image #5</label>
            <div class="col-md-9">
              <input name="image_5" type="text" class="form-control" id="inputUser" placeholder="Image #5 Link" value="<?=$image5?>">
            </div>
          </div>

          <div class="row mt-2">
            <div class="offset-lg-2 col-lg-6">
              <div class="checkbox">
                <label>
                  <input name="active" type="checkbox" <?=$itemActive?>> <span class="ml-2">Item active on website?</span>
                </label>
              </div>
            </div>
            <div class="col-lg-3">
              <button class="btn btn-raised btn-primary btn-block">Submit</button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</div> <!-- container -->
