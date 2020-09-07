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

<div class="ms-hero-page ms-hero-img-forest ms-hero-bg-info mb-6">
  <div class="text-center color-white mt-6 mb-6 index-1">
    <h1>About</h1>
  </div>
</div>
<div class="container">
  <div class="row">

    <div class="col-md-12 col-lg-5">

      <div class="card card-primary bg-dark">
        <div class="card-header">
          <h3 class="card-title">Intro</h3>
        </div>
        <div class="card-body">
          <p class="text-center">
            Howdy my name is Ren, I am a Software Engineer from Ireland with
            too many hobbies.
            I enjoy coding, drawing, making music, reading epic fantasies
            (Brandon Sanderson's books are a fav), video games, I am currently
            obsessed with board games
            and after all that, I am also working on a novel.
          </p>
        </div>
      </div>

      <div class="card card-primary bg-dark">
        <div class="card-header">
          <h3 class="card-title">Books</h3>
        </div>
        <div class="card-body">
          <p class="text-center">
            I am currently reading through Oathbringer, the third book in The
            Stormlight Archive series. I post chapter reactions to my
            <a href="https://twitter.com/chasmfriend" target="_blank">Cosmere
            twitter account <i class="fa fa-external-link"></i></a>
            I am throughly enjoying The Stormlight Archive and am looking forward
            to reading the fourth book, Rhytmn of War. I am also in the middle
            of reading The Promised Neverland (up to vol 6 so far) and Land of
            The Lustrous as new chapters
            release.
          </p>
          <div class="row">
            <div class="p-3" style="margin: 0px auto;"><?php include '../widgets/goodreads_reading.php'; ?></div>
          </div>
          <hr>
          <?php include '../widgets/goodreads_read_grid.php'; ?>
        </div>
      </div>

    </div>

    <div class="col-md-12 col-lg-7">
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
            I'm also a big fan of synthy & ambient movie scores and video game soundtracks.
          </p>
          <?php include '../widgets/soundcloud.php'; ?>
        </div>
      </div>

      <div class="card card-primary bg-dark">
        <div class="card-header">
          <h3 class="card-title">Boardgaming</h3>
        </div>
        <div class="card-body">
          <p class="text-center">
            I've just gotten into boardgaming this year, it all started
            when I purchased Call to Adventure: The Stormlight Adventure.
            As a Stormlight fan I had bought it for the beautiful artwork
            on every card but I was soon pulled into the world of boardgaming
            when I discovered <a href="https://boardgamegeek.com/" target="_blank">BGG</a>
            and realised the huge amount of board games that exist.
            I started with Ticket To Ride then moved on to Terraforming Mars! Now I have backed a bunch of
            Kickstarter board games that I am excited to play! The top two I am
            most excited for are
            <a href="https://boardgamegeek.com/boardgame/251661/oathsworn-deepwood" target="_blank">Oathsworn</a> and
            <a href="https://boardgamegeek.com/boardgame/285036/shadow-kingdoms-valeria" target="_blank">Shadow Kingdoms of Valeria</a>
          </p>
          <?php include '../widgets/bgg.php'; ?>
        </div>
      </div>
    </div>

  </div>
</div>
