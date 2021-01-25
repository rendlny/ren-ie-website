<div class="col-md-8 offset-md-2">
  <a class="btn btn-raised btn-royal btn-block" href="/projects">
    <i class="fa fa-arrow-left"></i> All Projects
  </a>
</div>

<div class="container pt-3">
  <div class="row pb-6">
    <div class="col-md-12 bg-white pb-4">
      <div class="text-center pt-4 mw-35 mh-20">
        <img class="img-fluid" style="max-height: 300px;"
          src="/web/assets/images/<?=$project->image?>" alt="<?=$project->title?> image"
        />
      </div>
      <?=$project->content?>
    </div>
  </div>
</div>

<script src="/web/assets/js/twitter/widgets.js"></script>
