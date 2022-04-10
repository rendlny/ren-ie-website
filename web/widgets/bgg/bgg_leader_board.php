<?php

use Models\Player;

$players = Player::where('on_leader_board', true)->orderBy('wins', 'DESC')->get();
?>
<h1><i class="fas fa-crown"></i> The Leader Board</h1>
<div class="bgg-play-card">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4 col-sm-3 align-right">
                    Player
                </div>

                <div class="col-md-4 col-sm-4 align-center">
                    Plays
                </div>

                <div class="col-md-4 col-sm-4">
                    Win Ratio %
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <?php
            foreach ($players as $player) {
                include $_SERVER['DOCUMENT_ROOT'] . '/web/widgets/bgg/bgg_player_score_row.php';
            }
            ?>
        </div>
    </div>
</div>

<script>
    function setupFlip(tick) {
        var tickElement = tick.root;
        var total = tickElement.dataset.total;

        setTimeout(function() {
            tick.value = total;
        }, 100);
    }
</script>