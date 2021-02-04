<?php
use Controllers\ProjectController;

$folders = ProjectController::getAllProjectGalleryFolders();
$list = NULL;
$count = 0;
foreach($folders as $folder){
  $count = $count + 1;
  $list .= '
  <div id="folder_order-'.$folder->id.'" class="col-lg-4 col-md-6 sorting-card">
    <div class="card card-royal">
      <a href="/gallery/'.$folder->slug.'">
        <div class="card-header ">
          <h3 class="card-title">
            <span class="badge-pill badge-pill-primary sorting-number">'.$folder->sorting.'</span>
            '.$folder->title.'
          </h3>
        </div>
      </a>
      <figure class="ms-thumbnail ms-thumbnail-horizontal">
        <img src="/web/assets/images/'.$folder->image.'" alt="'.$folder->title.' cover image" class="img-fluid">
      </figure>
    </div>
  </div>';
}

?>

<div class="container pt-6">
  <div class="row" id="sortable">
    <?=$list?>
  </div>
</div>

<script>
//when card dragged & dropped updated sorting numbers
  $('#sortable').sortable({
    update: function(event, ui) {
      var data = $(this).sortable('serialize');

      //post new order to function to update DB
      $.ajax({
        data: data,
        type: 'POST',
        url: '/web/modules_admin/ajax_calls.php?action=update_gallery_sorting'
      })
      .done(function(result){
        console.log(result);
      });
    }
});
</script>
