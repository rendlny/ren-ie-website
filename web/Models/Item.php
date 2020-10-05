<?php

namespace Models;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model {
  use SoftDeletes;
  const CREATED_AT = 'created';
  const UPDATED_AT = 'updated';

  protected $table = 'item';
  protected $fillable = [
    'code', 'user_id', 'title', 'description', 'slug', 'active',
    'price', 'preorder', 'trade', 'weight', 'quantity',
    'image_1', 'image_2', 'image_3', 'image_4', 'image_5',
    'sale', 'bid'
  ];

  protected static function boot() {
  parent::boot();

    // must generate code when creating new report
    static::creating(function ($query) {
      $query->code = static::generateItemCode();
      $query->slug = static::generateItemSlug($query->title);
    });

    //must update the slug to match the name
    static::updating(function ($query) {
      $query->slug = static::generateItemSlug($query->title);
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

  static function generateItemSlug($title){
    $slug = preg_replace('~[^\pL\d]+~u', '-', $title);
    $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);
    $slug = preg_replace('~[^-\w]+~', '', $slug);
    $slug = trim($slug, '-');
    $slug = preg_replace('~-+~', '-', $slug);
    $slug = strtolower($slug);
    return $slug;
  }
}

?>
