<?php

namespace Controllers;
use Models\User;
use Models\Item;
use Exception;
use Illuminate\Database\Capsule\Manager as DB;
use PHPMailer;


class ItemController {
  public static function getItemById($id) {
    return Item::find($id);
  }

  public static function getItemByCode($code) {
    return Item::where('code', $code)->first();
  }

  public static function getItemByCodeAndUser($code) {
    return Item::where('code', $code)->where('user_id', $_SESSION['userId'])->first();
  }

  static function updateItem($data){
    DB::beginTransaction();
    try{
      $item = Item::where('code',$data['code'])->first();
      $item->user_id = $data['user_id'];
      $item->title = $data['title'];
      $item->description = $data['description'];
      $item->active = $data['active'];
      $item->price = $data['price'];
      $item->preorder = $data['preorder'];
      $item->trade = $data['trade'];
      $item->weight = $data['weight'];
      $item->quantity = $data['quantity'];
      $item->image_1 = $data['image_1'];
      $item->image_2 = $data['image_2'];
      $item->image_3 = $data['image_3'];
      $item->image_4 = $data['image_4'];
      $item->image_5 = $data['image_5'];
      $item->sale = $data['sale'];
      $item->bid = $data['bid'];
      $item->save();
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

  static function getUsersItemCount(){
    return Item::where('active', 1)->where('user_id', $_SESSION['userId'])->count();
  }

}

 ?>
