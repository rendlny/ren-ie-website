<style>
  @media (max-width: 1500px){
    .container {
      max-width: 100%;
    }
  }

  @media (max-width: 1199px){
    .BGGwrapper, .BGGitem {
      max-width: 260px !important;
    }

    .BGGitem img {
      max-width: 150px;
    }
  }
</style>

<div class="container pt-6">
  <div class="row">

    <div class="col-md-12 col-lg-12">

      <div class="card card-primary bg-dark">
        <div class="card-header">
          <h3 class="card-title"><i class="fa fa-book"></i>&nbsp; Reading</h3>
        </div>
        <div class="card-body">
          <p class="text-center">
            I enjoy reading fiction and epic fantasy books with the Stormlight
            Archive series being my current favourite. I'm also reading through some manga - I'm in the middle of reading
            The Promised Neverland and Land of The Lustrous as new chapters release.
          </p>
          <div class="row">
            <div class="p-3" style="margin: 0px auto;"><?php include '../widgets/goodreads_reading.php'; ?></div>
          </div>
          <hr>
          <?php include '../widgets/goodreads_read_grid.php'; ?>
        </div>
      </div>

    </div>


  </div>
</div>
