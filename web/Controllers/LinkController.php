<?php

namespace Controllers;
use Models\Link;
use Exception;
use Illuminate\Database\Capsule\Manager as DB;

class LinkController {
  public static function getLinkById($id) {
    return Link::find($id);
  }

  public static function getLinkByUrl($url) {
    return Link::where('url', $url)->first();
  }

  static function updateLink($data){
    DB::beginTransaction();
    try{
      $link = Link::where('id', $data['id'])->first();
      $link->name = $data['name'];
      $link->url = $data['url'];
      $link->icon = $data['icon'];
      $link->colour = $data['colour'];
      $link->position = $data['position'];
      $link->active = $data['active'];
      $link->save();
      DB::commit();
    }catch(Exception $e) {
      DB::rollback();
      throw $e;
    }
    return $link;
  }

  public static function addLink($data){
    DB::beginTransaction();

    try {
      // create the new report
      $link = Link::create($data);
      DB::commit();

    } catch(Exception $e) {
      DB::rollback();
      throw $e;
    }

    return $link;
  }

  static function getActiveLinks(){
    $links = Link::where('active', 1)->orderBy('position')->get();
    return $links;
  }

}

?>
