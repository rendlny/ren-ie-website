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
          <h3 class="card-title">Intro</h3>
        </div>
        <div class="card-body">
          <p class="text-center">
            Howdy my name is Ren, I am a Software Engineer from Ireland with too many hobbies.
            I enjoy coding, drawing, making music, reading epic fantasies (Brandon Sanderson's books are a fav), video games & I am currently obsessed with board games.
            Then after all that, I am also working on a novel.
          </p>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="card card-primary bg-dark">
        <div class="card-header">
          <h3 class="card-title">Music</h3>
        </div>
        <div class="card-body">
          <p class="text-center">
            In my freetime I like to mess around with my synth setup ( a Keystep
            hooked up to a Volca Keys with some effects pedals ) and try to make some
            music, below is some the tracks that I've created. My music is
            inspired by Para One's Naissance Des Pieuvres album & scntfc's work in Oxenfree.
            I'm also a big fan of the Stranger Things Synthy soundtrack & other ambient movie scores.
          </p>
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
          <?php include '../widgets/bgg.php'; ?>
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
