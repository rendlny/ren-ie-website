<?php

namespace Controllers;
use Models\ProjectSection;
use Controllers\ProjectController;
use Exception;
use Illuminate\Database\Capsule\Manager as DB;
use PHPMailer;

class ProjectSectionController {
  public static function getProjectSectionById($id){
    return ProjectSection::find($id);
  }

  public static function getProjectSectionBySlug($slug) {
    return ProjectSection::where('slug', $slug)->first();
  }

  public static function addProjectSection($data){
    DB::beginTransaction();

    try {
      // create the new report
      $projectSection = ProjectSection::create($data);
      DB::commit();
    } catch(Exception $e) {
      DB::rollback();
      throw $e;
    }

    return $projectSection;
  }

  static function updateProjectSection($data){
    DB::beginTransaction();
    try{
      $projectSection = ProjectSection::where('id',$data['id'])->first();
      $projectSection->title = $data['title'];
      $projectSection->image = $data['image'];
      $projectSection->description = $data['description'];
      $projectSection->content = $data['content'];
      $projectSection->active = $data['active'];
      unset($projectSection->displayTags);
      $projectSection->save();
      DB::commit();
    }catch(Exception $e) {
      DB::rollback();
      throw $e;
    }
    return $projectSection;
  }

  static function getSectionsByProjectId($projectId){
    return ProjectSection::where('project_id', $projectId)->get();
  }

  static function getActiveSectionsByProjectId($projectId){
    return ProjectSection::where('project_id', $projectId)->where('active', 1)->get();
  }

  static function getActiveSectionsByProjectSlug($projectSlug){
    $project = ProjectController::getProjectBySlug($projectSlug);
    $sections = ProjectSectionController::getActiveSectionsByProjectId($project->id);
    return $sections;
  }

}

?>
