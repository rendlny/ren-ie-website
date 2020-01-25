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
    return $item;
  }

  static function getActiveItems(){
    return Item::where('active', 1)->get();
  }

  static function getUsersActiveItems(){
    return Item::where('active', 1)->where('user_id', $_SESSION['userId'])->get();
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

}

?>
