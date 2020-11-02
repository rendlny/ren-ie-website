<?php

namespace Controllers;
use Models\Project;
use Exception;
use Illuminate\Database\Capsule\Manager as DB;
use PHPMailer;

class ProjectController {
  public static function getProjectById($id) {
    return Project::find($id);
  }

  public static function getProjectBySlug($slug) {
    return Project::where('slug', $slug)->first();
  }

  public static function getProjectsByTag($tag) {
    return Project::where('tags', 'LIKE', '%'.$tag.'%')->get();
  }

  static function updateProject($data){
    DB::beginTransaction();
    try{
      $project = Project::where('id',$data['id'])->first();
      $project->title = $data['title'];
      $project->image = $data['image'];
      $project->description = $data['description'];
      $project->content = $data['content'];
      $project->tags = $data['tags'];
      $project->active = $data['active'];
      unset($project->displayTags);
      $project->save();
      DB::commit();
    }catch(Exception $e) {
      DB::rollback();
      throw $e;
    }
    return $project;
  }

  public static function addProject($data){
    DB::beginTransaction();

    try {
      // create the new report
      $project = Project::create($data);
      DB::commit();
    } catch(Exception $e) {
      DB::rollback();
      throw $e;
    }

    return $project;
  }

  public static function getAllProjects(){
    $projects = Project::orderBy('updated', 'DESC')->get();
    return $projects;
  }

  public static function getAllActiveProjects(){
    $projects = Project::where('active', 1)->orderBy('updated', 'DESC')->get();
    return $projects;
  }

}

?>
