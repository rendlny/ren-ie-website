<?php
include $_SERVER['DOCUMENT_ROOT'].'/web/start.php';
use Controllers\ItemController;

/* set item code & qty to cart session */
if(isset($_GET['code'])){
  $item = ItemController::getItemByCode($_GET['code']);
  if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
  }

  if($item != NULL){
    $cartItem = array(
      "code" => $item->code,
      "quantity" => 1
    );
    array_push($_SESSION['cart'], $cartItem);
  }
}

header('Location: '.$web_data['site']['url'].'store/');
?>
