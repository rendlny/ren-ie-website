<?php
use Models\Player;
$players = Player::where('on_leader_board', true)->orderBy('wins', 'DESC')->get();
?>
<h1><i class="fas fa-crown"></i> The Leader Board</h1>
<div class="bgg-play-card">
    <div class="row">
        <div class="col-md-12">
            <h3>Total Wins</h3>
        </div>
        <div class="col-md-12">
            <?
                foreach($players as $player) {
                    include '../widgets/bgg/bgg_player_score_row.php';
                }
            ?>
        </div>
    </div>
</div>

<script>
function setupFlip(tick) {
    var tickElement = tick.root;
    var total = tickElement.dataset.total;
    
    setTimeout(function(){
        tick.value = total;
    },100);
}
</script>