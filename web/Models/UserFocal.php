<?php

namespace Models;
use \Illuminate\Database\Eloquent\Model;

class UserFocal extends Model {
  public $timestamps = false;
  protected $table = 'userfocal';
  protected $fillable = ['user_id','focal'];

  /** Mutator to encrypt password */
  public function setFocalAttribute($focal) {
    $this->attributes['focal'] = password_hash($focal, PASSWORD_DEFAULT);
  }

  public function owner()
  {
    return $this->belongsTo(User::class);
  }

  public function checkPassword($password) {
    return password_verify($password, $this->focal);
  }
}
?>
