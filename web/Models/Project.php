<?php

namespace Models;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model {
  use SoftDeletes;
  const CREATED_AT = 'created';
  const UPDATED_AT = 'updated';

  public $timestamps = false;
  protected $table = 'project';
  protected $fillable = [
    'title', 'image', 'slug', 'description', 'content', 'active'
  ];

  protected static function boot() {
    parent::boot();

    // must generate code when creating new report
    static::creating(function ($query) {
      $query->slug = static::generateProjectSlug($query->title);
    });

    //must update the slug to match the name
    static::updating(function ($query) {
      $query->slug = static::generateProjectSlug($query->title);
    });
  }

  static function generateProjectSlug($title){
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
