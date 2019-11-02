<?php

namespace Models;
use \Illuminate\Database\Eloquent\Model;

class User extends Model {
  const CREATED_AT = 'created';
  const UPDATED_AT = 'updated';

  public $timestamps = false;
  protected $table = 'user';
  protected $fillable = ['usercode', 'firstname', 'surname', 'email', 'created', 'active', 'image', 'trade_list_link', 'level', 'status'];

  protected static function boot() {
    parent::boot();

    // must generate usercode when creating new user
    static::creating(function ($query) {
      $query->usercode = static::generateUserCode();
    });
  }

  public function password() {
     return $this->hasOne(UserFocal::class);
  }

  public function token() {
     return $this->hasOne(Token::class);
  }

  static function generateUserCode() {
    static $USER_CODE_LEN = 10;
    $keys = array_merge(range(0,9), range('A', 'Z'), range('a', 'z'));
    $key = "";
    for($i=0; $i < $USER_CODE_LEN; $i++) {
        $key .= $keys[mt_rand(0, count($keys) - 1)];
    }
    return $key;
  }

}

?>
