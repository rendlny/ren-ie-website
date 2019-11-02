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
      $item->image = $data['image'];
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

}

 ?>
