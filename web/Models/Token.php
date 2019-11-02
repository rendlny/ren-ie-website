<?php

namespace Models;
use \Illuminate\Database\Eloquent\Model;

class Token extends Model {
  public $timestamps = false;

  protected $table = 'tokens';
  protected $fillable = ['requestingIP'];

  protected static function boot() {
    parent::boot();

    // generate random token string
    static::creating(function ($query) {
        $query->token = static::generateToken();
        $query->created = $query->freshTimestamp();
    });
  }

  public function user()
  {
      return $this->belongsTo(User::class);
  }

  static function generateToken() {
    $tokenLength = 20;
    $keys = array_merge(range(0,9), range('A', 'Z'), range('a', 'z'));
    $token = "";
    for($i=0; $i < $tokenLength; $i++) {
        $token .= $keys[mt_rand(0, count($keys) - 1)];
    }
    return $token;
  }
}
?>
