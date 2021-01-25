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

    <div class="col-md-12 col-lg-5">

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

    <div class="col-md-12 col-lg-7">
      <div class="card card-primary bg-dark">
        <div class="card-header">
          <h3 class="card-title"><i class="fa fa-music"></i>&nbsp; Music</h3>
        </div>
        <div class="card-body">
          <p class="text-center">
            In my freetime I like to mess around with my synth setup ( a Keystep
            hooked up to a Volca Keys with some effects pedals ) and try to make some
            music, below is one of the tracks that I've created. I am inpired by music from
            Para One's Naissance Des Pieuvres album,  scntfc's work in Oxenfree & Hainbach.
            I'm a big fan of synthy & ambient movie scores and video game soundtracks.
          </p>

          <?php include '../widgets/soundcloud.php'; ?>

          <p class="text-center">
            You can hear more of my tracks on the Music page<br>
            <a href="/music" class="btn btn-royal btn-raised btn-block">Music</a>
          </p>
        </div>
      </div>

      <div class="card card-primary bg-dark">
        <div class="card-header">
          <h3 class="card-title"><i class="fa fa-chess"></i>&nbsp; Board-Gaming</h3>
        </div>
        <div class="card-body">
          <p class="text-center">
            I got into boardgaming in the summer of 2020, it all started
            when I purchased Call to Adventure: The Stormlight Adventure.
            As a Stormlight fan I'd bought it for the beautiful artwork
            on every card but I was soon pulled into the world of boardgaming
            when I discovered <a href="https://boardgamegeek.com/" target="_blank">BGG</a>
            and realised the huge amount of board games that exist.
            I started with Ticket To Ride then moved on to Terraforming Mars! Now I have backed a bunch of
            Kickstarter board games that I am excited to play! The two that I am
            most excited for are
            <a href="https://boardgamegeek.com/boardgame/251661/oathsworn-deepwood" target="_blank">Oathsworn</a> and
            <a href="https://boardgamegeek.com/boardgame/285036/shadow-kingdoms-valeria" target="_blank">Shadow Kingdoms of Valeria</a>.

            <iframe style="width:100%; height:500px;" src="https://playback.geekgroup.app/rendlythefriendly" title="My Monthly Board Game Plays"></iframe>

          </p>

          <!--<hr>
          <h2 style="color: #22c38e">Lastest Board Games Played</h2>
          <p class="text-center"><img src="https://geekgroup.app/share/ugkitn" /><p>-->
          <hr>

          <?php include '../widgets/bgg.php'; ?>
        </div>
      </div>
    </div>

  </div>
</div>
