<style>
  @media (max-width: 1500px){
    .container {
      max-width: 100%;
    }
  }
</style>

<div class="container pt-6">
  <div class="row">

    <div class="col-md-12 col-lg-5">
      <div class="card card-primary bg-dark">
        <div class="card-header">
          <h3 class="card-title"><i class="fa fa-user"></i>&nbsp; Intro</h3>
        </div>
        <div class="card-body">
          <p class="text-center">
            I enjoy reading fiction and fantasy books with the Stormlight
            Archive series being my current favourite. I'm also reading through some manga - I'm enjoying
            The Promised Neverland and Land of The Lustrous.
            <hr>
            For 2021 I plan on reading:<br>
            - <a href="https://www.goodreads.com/book/show/40275288-the-priory-of-the-orange-tree" target="_blank">The Priory of the Orange Tree by Samantha Shannon</a><br>
            - <a href="https://www.goodreads.com/book/show/54511226-dawnshard" target="_blank">Dawnshard by Brandon Sanderson</a><br>
            - <a href="https://www.goodreads.com/book/show/49021976-rhythm-of-war" target="_blank">Rhythm of War by Brandon Sanderson</a><br>
            - <a href="https://www.goodreads.com/book/show/42036538-gideon-the-ninth" target="_blank">Gideon the Ninth by Tamsyn Muir</a><br>
            - <a href="https://www.goodreads.com/book/show/36642458-skyward" target="_blank">Skyward by Brandon Sanderson</a>
          </p>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-4">
      <div class="card card-primary bg-dark">
        <div class="card-header">
          <h3 class="card-title"><i class="fa fa-book-open"></i>&nbsp; Currently Reading</h3>
        </div>
        <div class="card-body">
          <div class="p-3" style="margin: 0px auto;"><?php include '../widgets/goodreads_reading.php'; ?></div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="card card-primary bg-dark">
        <div class="card-header">
          <h3 class="card-title"><i class="fa fa-trophy"></i>&nbsp; <?=date('Y')?> Reading Challenge</h3>
        </div>
        <div class="card-body">
          <br>
          <div class="p-3" style="margin: 0px auto;"><?php include '../widgets/goodreads_reading_challenge.php'; ?></div>
          <br>
          <br>
        </div>
      </div>
    </div>

    <div class="col-md-12 col-lg-12">
      <div class="card card-primary bg-dark">
        <div class="card-header">
          <h3 class="card-title"><i class="fa fa-book"></i>&nbsp; Lastest Read Books</h3>
        </div>
        <div class="card-body">
          <?php include '../widgets/goodreads_read_grid.php'; ?>
        </div>
      </div>
    </div>

  </div>
</div>
