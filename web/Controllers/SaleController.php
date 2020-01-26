<?php

namespace Controllers;
use Models\Sale;
use Models\Item;
use Models\User;
use Exception;
use Illuminate\Database\Capsule\Manager as DB;
use PHPMailer;


class SaleController {
  public static function getSaleById($id) {
    return Sale::find($id);
  }

  public static function getSaleByCode($code) {
    return Sale::where('code', $code)->first();
  }

  public static function getSaleByCodeAndUser($code) {
    echo $code;
    $sale = Sale::where('code', $code)->first();
    $user = User::where('usercode', $_SESSION['userCode'])->first();
    $item = Item::where('id', $sale->item_id)->first();

    if($item->user_id == $user->id){
      return $sale;
    }
  }

  static function updateSale($data){
    DB::beginTransaction();
    try{
      $sale = Sale::where('code',$data['code'])->first();
      $sale->code = $data['code'];
      $sale->item_id = $data['item_id'];
      $sale->quantity = $data['quantity'];
      $sale->total_price = $data['total_price'];
      $sale->customer_name = $data['customer_name'];
      $sale->shipping_address = $data['shipping_address'];
      $sale->trade_offer = $data['trade_offer'];
      $sale->comment = $data['comment'];
      $sale->charged = $data['charged'];
      $sale->tracking = $data['tracking'];
      $sale->shipped = $data['shipped'];
      $sale->cancelled = $data['cancelled'];
      $sale->refunded = $data['refunded'];
      $sale->save();
      DB::commit();
    }catch(Exception $e) {
      DB::rollback();
      throw $e;
    }
    return $sale;
  }

  public static function addSale($data){
   DB::beginTransaction();

   try {
     // create the new report
     $sale = Sale::create($data);

     DB::commit();
   } catch(Exception $e) {
     DB::rollback();
     throw $e;
   }

   return $sale;
 }

 public static function getUserSales(){
   $item = NULL;
   $userSales = array();

   $sales = Sale::where('cancelled', 0)->get();
   $user = User::where('usercode', $_SESSION['userCode'])->first();

   foreach ($sales as $sale) {
     $item = Item::where('id', $sale->item_id)->first();
     if($item->user_id == $user->id){
       array_push($userSales, $sale);
     }

   }
   return $userSales;
 }

 public static function getUsersSalesCount(){
   $salesCount = 0;
   $sales = Sale::where('cancelled', 0)->get();
   $user = User::where('usercode', $_SESSION['userCode'])->first();

   foreach ($sales as $sale) {
     $item = Item::where('id', $sale->item_id)->first();
     if($item->user_id == $user->id){
       $salesCount = $salesCount + 1;
     }

   }
   return $salesCount;
 }

 static function getUsersShippedSaleCount(){
   $shippedSalesCount = 0;
   $sales = Sale::where('cancelled', 0)->where('shipped', 1)->get();
   $user = User::where('usercode', $_SESSION['userCode'])->first();
   foreach ($sales as $sale) {
     $item = Item::where('id', $sale->item_id)->first();
     if($item->user_id == $user->id){
       $shippedSalesCount = $shippedSalesCount + 1;
     }
   }

   return $shippedSalesCount;
 }

 static function getUsersRecentSales(){
   $item = NULL;
   $userSales = array();

   $sales = Sale::where('cancelled', 0)->limit(10)->get();
   $user = User::where('usercode', $_SESSION['userCode'])->first();

   foreach ($sales as $sale) {
     $item = Item::where('id', $sale->item_id)->first();
     if($item->user_id == $user->id){
       array_push($userSales, $sale);
     }

   }
   return $userSales;
 }

}

?>
