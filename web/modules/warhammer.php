<?php
$armyJsonFile = file_get_contents("../assets/json/army-lists.json");
$armyJsonData = json_decode($armyJsonFile);
?>
<div class="container pt-4">
  <div class="row">

    <div class="col-md-12 col-lg-12">

      <div class="card card-primary bg-dark">
        <div class="card-body">

          <?php 
            foreach($armyJsonData as $armyName => $army) {
              include '../includes/warhammer_army_card.php';
            }
          ?>

        </div>
      </div>
    </div>

  </div>
</div>
