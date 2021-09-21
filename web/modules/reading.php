<style>
  @media (max-width: 1500px){
    .container {
      max-width: 100%;
    }
  }
</style>

<div class="container pt-4">
  <div class="row">

    <div class="col-md-12 col-lg-12">
      <div class="card card-primary bg-dark">
        <div class="card-header">
          <h3 class="card-title"><i class="fa fa-book"></i>&nbsp; Reading</h3>
        </div>
        <div class="card-body">
        
          <div class="row">
            <div class="col-md-5 offset-md-1">
              <p class="text-center">
                I enjoy reading fiction and fantasy books with the Stormlight
                Archive series being my current favourite. I'm also reading through some manga - I'm enjoying
                The Promised Neverland and Land of The Lustrous.
              </p>
            </div>
            <div class="col-md-3 offset-md-2">
              <?php include '../widgets/goodreads_reading_challenge.php'; ?>
            </div>
          </div>

          <hr>
          <?php include '../widgets/goodreads_reading.php'; ?>
          <hr>
          <?php include '../widgets/goodreads_tbr.php'; ?>
          <hr>
          <?php include '../widgets/goodreads_read_grid.php'; ?>
          <hr>
          <?php include '../widgets/goodreads_wishlist.php'; ?>
        </div>
      </div>
    </div>

  </div>
</div>
