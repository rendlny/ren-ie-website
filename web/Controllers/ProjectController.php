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
      $project->external_link = $data['external_link'];
      $project->content = $data['content'];
      $project->tags = $data['tags'];
      $project->active = $data['active'];
      $project->gallery_folder = $data['gallery_folder'];
      $project->coding_project = $data['coding_project'];

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
    $projects = Project::where('active', 1)->where('coding_project', 0)->where('gallery_folder', 0)->orderBy('updated', 'DESC')->get();
    return $projects;
  }

  public static function getAllActiveProjectGalleryFolders(){
    $projects = Project::where('active', 1)->where('gallery_folder', 1)->orderBy('updated', 'DESC')->get();
    return $projects;
  }

  public static function getAllActiveCodeProjects(){
    $projects = Project::where('active', 1)->where('coding_project', 1)->orderBy('updated', 'DESC')->get();
    return $projects;
  }

  public static function getRelatedCodingProjects($num, $project){
    $projects = Project::where('active', 1)->where('coding_project', 1)->where('id', '!=', $project->id)->limit($num)->get();
    return $projects;
  }
}

?>
