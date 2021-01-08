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
    'title', 'image', 'slug', 'description', 'content', 'active', 'tags'
  ];

  protected static function boot() {
    parent::boot();

    // must generate code when creating new report
    static::creating(function ($query) {
      $query->slug = static::generateProjectSlug($query->title);
    });

    //must update the slug to match the name and set timestamp updated at
    static::updating(function ($query) {
      $query->slug = static::generateProjectSlug($query->title);
      $query->updated = now();
    });

    //build tag display
    static::retrieved(function ($model) {
      $tagsDisplay = static::getTags($model->tags);
      if($tagsDisplay != NULL){
        $model->displayTags = $tagsDisplay;
      }
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

  static function getTags($tags){
    $tagsDisplay = NULL;

    if($tags != NULL){
      $tags = explode(',', $tags);
      foreach ($tags as $tag) {
        $tagsDisplay .= '
          <a href="/projects-search/'.$tag.'/" class="ms-tag ms-tag-info">'.$tag.'</a>
        ';
      }
    }

    return $tagsDisplay;
  }
}

?>
