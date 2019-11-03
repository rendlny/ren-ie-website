<?php

namespace Models;
use \Illuminate\Database\Eloquent\Model;

class Item extends Model {
  const CREATED_AT = 'created';
  const UPDATED_AT = 'updated';

  protected $table = 'item';
  protected $fillable = ['code', 'user_id', 'title', 'description', 'active', 'price', 'preorder', 'trade', 'weight', 'quantity', 'image', 'sale', 'bid'];

  protected static function boot() {
  parent::boot();

    // must generate code when creating new report
    static::creating(function ($query) {
      $query->code = static::generateItemCode();
    });
  }

  static function generateItemCode(){
    static $REPORT_CODE_LEN = 16;
    $keys = array_merge(range(0,9), range('A', 'Z'), range('a', 'z'));
    $key = "";
    for($i=0; $i < $REPORT_CODE_LEN; $i++) {
      $key .= $keys[mt_rand(0, count($keys) - 1)];
    }
    return $key;
  }
}

?>
