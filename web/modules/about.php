<div class="ms-hero-page ms-hero-img-forest ms-hero-bg-info mb-6">
  <div class="text-center color-white mt-6 mb-6 index-1">
    <h1>About</h1>
  </div>
</div>
<br><br><br>
<div class="container">

  <div class="row">

    <div class="col-md-12">
      <div class="card card-primary bg-dark">
        <div class="card-header">
          <h3 class="card-title">Music</h3>
        </div>
        <div class="card-body">
          <p></p>
          <?php include '../widgets/soundcloud.php'; ?>
        </div>
      </div>
    </div>

    <div class="col-md-5">
      <div class="card card-primary bg-dark">
        <div class="card-header">
          <h3 class="card-title">Boardgaming</h3>
        </div>
        <div class="card-body">
          <script language="javascript" src="https://boardgamegeek.com/jswidget.php?username=RendlyTheFriendly&numitems=6&header=1&text=title&images=medium&show=recentplays&imagesonly=1&imagepos=left&addstyles=1&showplaydate=1&domains%5B%5D=boardgame"></script>
        </div>
      </div>
    </div>

    <div class="col-md-7">
      <div class="card card-primary bg-dark">
        <div class="card-header">
          <h3 class="card-title">Books</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="p-3"><?php include '../widgets/goodreads_reading.php'; ?></div>
            <div class="p-3"><?php include '../widgets/goodreads_reading_challenge.php'; ?></div>
          </div>
          <hr>
          <?php include '../widgets/goodreads_read_grid.php'; ?>
        </div>
      </div>
    </div>

  </div>

</div>
