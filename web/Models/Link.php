<?php

namespace Models;
use \Illuminate\Database\Eloquent\Model;

class Link extends Model {

  public $timestamps = false;
  protected $table = 'link';
  protected $fillable = ['name', 'url', 'icon', 'colour', 'position', 'active', 'footer'];
  protected $primaryKey = 'id';

  protected static function boot() {
    parent::boot();
  }

}

?>
