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
        
      
          <div>
            <?php include '../widgets/goodreads/goodreads_reading_challenge.php'; ?>
          </div>

          <hr>
          <?php include '../widgets/goodreads/goodreads_reading.php'; ?>
          <hr>
          <?php include '../widgets/goodreads/goodreads_tbr.php'; ?>
          <hr>
          <?php include '../widgets/goodreads/goodreads_read_grid.php'; ?>
          <hr>
          <?php include '../widgets/goodreads/goodreads_wishlist.php'; ?>
        </div>
      </div>
    </div>

  </div>
</div>
