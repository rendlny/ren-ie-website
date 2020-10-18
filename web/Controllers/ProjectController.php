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

  static function updateProject($data){
    DB::beginTransaction();
    try{
      $project = Project::where('id',$data['id'])->first();
      $project->title = $data['title'];
      $project->image = $data['image'];
      $project->description = $data['description'];
      $project->content = $data['content'];
      $project->active = $data['active'];
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

    return $sale;
  }

  public static function getAllProjects(){
    $projects = Project::all();
    return $projects;
  }

  public static function getAllActiveProjects(){
    $projects = Project::where('active', 1)->get();
    return $projects;
  }

}

?>