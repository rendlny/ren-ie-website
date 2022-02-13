<?php
$file = '../assets/xml/bgg_plays.xml';
if (file_exists($file)) {
    $plays = simplexml_load_file($file);
    // echo($plays['username'].'<br>');
    // echo($plays['userid'].'<br>');
    // echo($plays['total'].'<br>');
    // echo($plays['page'].'<br>');
    foreach($plays->children() as $play) {
        $gameName = $gameLength = $date = $location = $playerCount = $playerData = null;
        // echo $play['id'].'<br>';
        // echo $play['quantity'].'<br>';
        // echo '<i class="fa fa-clock"></i>&nbsp;'.$play['length'].'<br>';
        // echo $play['incomplete'].'<br>';
        // echo $play['nowinstats'].'<br>';

        foreach($play->children() as $playData) {
            if($playData->getName() == 'item') {
                $date = $play['date'];
                $gameName = $playData['name'];
                $location = $play['location'];
                $gameLength = $play['length'];

                // echo($playData['objecttype'].'<br>');
                // echo($playData['objectid'].'<br>');
                // foreach($playData->children() as $subtypes) {
                //     foreach($subtypes->children() as $subtype) {
                //         echo($subtype['value'].'<br>');
                //     }
                // }
            } else if ($playData->getName() == 'comments') {
                // echo($playData->__toString());
            } else if ($playData->getName() == 'players') {
                $playerCount = 0;
                foreach($playData->children() as $player) {
                    $playerCount++;
                    if($player['username']){
                        // echo '<a href="https://boardgamegeek.com/user/'.$player['username'].'" target="_blank">'.$player['name'].'</a>';
                    } else {
                        // echo $player['name'];
                    }
                    // echo($player['userid'].'<br>');
                    // echo($player['startposition'].'<br>');
                    // echo($player['color'].'<br>');
                    // echo('&nbsp;'.$player['score']);
                    // echo($player['new'].'<br>');
                    // echo($player['rating']);
                    $playerData .= '
                        <div class="bgg-play-player">
                            '.$player['name']
                            .($player['win'] == 1 ? '&nbsp;<i class="fa fa-crown"></i>' : null)
                            .'&nbsp;'.$player['score'].'
                        </div>';
                }
            }
        }
        
        echo '
            <div class="bgg-play-card">
                <div class="row">
                    <div class="col-md-12">
                        <h2>'.$gameName.'</h2>
                    </div>
                    <div class="col-md-12">
                        <i class="fa fa-calendar"></i>&nbsp;'.$date.'
                    </div>
                    <div class="col-md-7">
                        <i class="fa-solid fa-location-pin"></i>&nbsp;'.$location.'
                    </div>
                    <div class="col-md-5 bgg-play-time">
                        <i class="fa fa-clock"></i>&nbsp;'.$gameLength.'
                        <i class="fa fa-users"></i>&nbsp;'.$playerCount.'
                    </div>
                    <div class="col-md-12">
                        '.$playerData.'
                    </div>
                </div>
            </div>
        ';
    }
} 
else {
    exit('Failed to open bgg_plays.xml.');
}
?>

<div class="bgg-play-card">
    <div class="row">
        <div class="col-md-12">
            <h1>The Leaderboard</h1>
        </div>
        <div class="col-md-12">
            <div class="bgg-play-player">
                <div class="row">
                    <div class="col-md-5">
                        Ren
                        <div class="tick" data-value="0" data-total="40" data-did-init="setupFlip">
                            <div data-repeat="true" aria-hidden="true" data-transform="arrive(9, .001) -> round -> pad('   ') -> split -> delay(rtl, 100, 150)">
                                <span data-view="flip"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">VS</div>
                    <div class="col-md-5">
                        Michael
                        <div class="tick" data-value="0" data-total="20" data-did-init="setupFlip">
                            <div data-repeat="true" aria-hidden="true" data-transform="arrive(9, .001) -> round -> pad('   ') -> split -> delay(rtl, 100, 150)">
                                <span data-view="flip"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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