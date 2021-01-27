<?php

namespace Models;
use \Illuminate\Database\Eloquent\Model;

class Sale extends Model {
  const CREATED_AT = 'created';
  const UPDATED_AT = 'updated';

  public $timestamps = false;
  protected $table = 'sale';
  protected $fillable = ['code', 'item_id', 'quantity', 'total_price', 'customer_name', 'paypal', 'shipping_address', 'trade_offer', 'comment', 'charged', 'tracking', 'shipped', 'cancelled', 'refunded', 'contact_option', 'contact_username', 'shipping_option'];

  protected static function boot() {
    parent::boot();

    // must generate usercode when creating new user
    static::creating(function ($query) {
      $query->code = static::generateSaleCode();
    });

    static::updating(function ($query) {
      $query->updated = now();
    });
  }

  static function generateSaleCode() {
    static $SALE_CODE_LEN = 16;
    $keys = array_merge(range(0,9), range('A', 'Z'), range('a', 'z'));
    $key = "";
    for($i=0; $i < $SALE_CODE_LEN; $i++) {
        $key .= $keys[mt_rand(0, count($keys) - 1)];
    }
    return $key;
  }

}

?>
