<?php
$projectGrid = NULL;
foreach ($projects as $project) {
  $projectGrid .= '
    <div class="col-sm-4 col-md-3 col-lg-2 col-xl-2">
      <a href="/work/' . $project->slug . '" class="img-thumbnail withripple">
        <div class="thumbnail-container">
          <img src="/web/assets/images/' . $project->image . '" alt="' . $project->title . '" class="img-fluid"/>
        </div>
      </a>
    </div>';
}
?>
<div class="container pt-6">
  <div class="row">
    <div class="col-md-12">

      <div class="card card-primary bg-dark">
        <div class="card-header">
          <h1 class="card-title"><i class="zmdi zmdi-code"></i>&nbsp; PHP</h1>
        </div>
        <div class="card-sub-header">
          <h4 class="card-title">4 Years Industry Experience</h4>
        </div>
        <div class="card-body">
          <p class="text-center">
            I have 2 years of experience as a main software engineer at Inkerman
            Technologies where I worked on over 15
            different bespoke systems for clients in various industries, such as
            ticket booking systems, dance school systems and e-commerce systems,
            in a fast-paced development schedule using PHP with JS, Ajax, jQuery,
            MySQL and the Laravel framework. I deployed these systems to Linux cloud machines.
            <br><br>
            I worked on both the front and back-end of major projects with my
            team by following Scrum and Agile methodologies using Jira Kanban
            boards to deliver projects in a timely & efficient manner. In my
            2 years of working at Inkerman Technologies, I grew more confident
            in my coding abilities and increased my skill set a great deal.
          </p>

          <hr>
          <h2 class="text-center">Websites & Systems I've Worked On:</h2>
          <div class="row">

            <?= $projectGrid ?>

          </div>
        </div>
      </div>

      <div class="card card-primary bg-dark">
        <div class="card-header">
          <h1 class="card-title"><i class="zmdi zmdi-language-python"></i>&nbsp; Python</h1>
        </div>
        <div class="card-sub-header">
          <h4 class="card-title">Experience creating small web-scraper projects and bots</h4>
        </div>
        <div class="card-body">
          <p class="text-center">
            I have built webscrapers in python, including one for the open source
            project <a href="https://yokaidex.netlify.app/" target="_blank">YokaiDex</a>,
            which is a handy web app for guides and info on the
            Yokai Watch video games. For this webscraper, I used the beautifulSoup
            package to pull the websites code and search through it to grab the required data
            which I build an object for and then print into a json file to be used
            by the web app. You can see the webscraper code on the
            <a href="https://github.com/rendlny/YokaidexWebscraper" target="_blank">github repo</a>.
          </p>
          <hr>
          <p class="text-center">
            Another Python project I have built is
            <a href="https://github.com/rendlny/rapuli-bot" target="_blank">Rapuli-Bot</a>,
            a Discord chat-Bot for tracking weekly turnip stock prices for the
            game Animal Crossing New Horizons on Nintendo Switch. This bot will
            take inputs from the user of their turnip prices and will then
            return a link to <a href="https://turnipprophet.io/" target="_blank">TurnipProphet</a>
            with their price data already set. Everytime they set a price,
            the bot will update the link with their new pricing.
            <br><br>
          <div class="card wow zoomIn">
            <div class="card-body p-05 ">
              <div class="withripple">
                <a href="https://ren.ie/web/assets/images/github/rapuli-bot/rapuli-bot-example.png" data-lightbox="gallery" data-title="Image of Rapuli-Bot in action, returning custom links to two users" c><img src="https://ren.ie/web/assets/images/github/rapuli-bot/rapuli-bot-example.png" alt="" class="img-fluid"></a>
              </div>
              <small class="color-dark">Image of Rapuli-Bot in action, returning custom links to two users</small>
            </div>
          </div>
          </p>
        </div>
      </div>

      <div class="card card-primary bg-dark">
        <div class="card-header">
          <h1 class="card-title"><i class="zmdi zmdi-code"></i>&nbsp; Java</h1>
        </div>
        <div class="card-sub-header">
          <h4 class="card-title">Used throughout my 4 years at college</h4>
        </div>
        <div class="card-body">
          <p class="text-center">
            Java was my main programming language throughout my 4 years in college at DKIT.
            One of the last Java projects I worked on was
            <a href="https://github.com/rendlny/PokeTools-TCG" target="_blank">PokeTools-TCG</a>
            PokeTools-TCG is a Android application that uses a Firebase database which
            is kept up to data via Python web-scraper located on a Linux Cloud server
            and is configured to run every 12 hours as a cron job. The app displays
            the latest cards in the Pokemon Trading Card Game and provides users
            with tools to help them play.
            <br><br>
          <div class="card wow zoomIn">
            <div class="card-body p-05 ">
              <div class="withripple">
                <a href="https://ren.ie/web/assets/images/github/PokeTools-TCG/poster-cc4-2018-ren-delaney.jpg" data-lightbox="gallery" data-title="PokeTools-TCG Project Poster" c><img src="https://ren.ie/web/assets/images/github/PokeTools-TCG/poster-cc4-2018-ren-delaney.jpg" alt="" class="img-fluid"></a>
              </div>
              <small class="color-dark">PokeTools-TCG Project Poster</small>
            </div>
          </div>

          <div class="card wow zoomIn">
            <div class="card-body p-05 ">
              <div class="withripple">
                <iframe class="content-center yt-iframe" width="650" height="405" src="https://www.youtube.com/embed/o2_NAiDsNbA?start=685" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>
              <small class="color-dark">Footage of PokeTools-TCG app functioning</small>
            </div>
          </div>

          </p>
        </div>
      </div>

    </div>
  </div>
</div>