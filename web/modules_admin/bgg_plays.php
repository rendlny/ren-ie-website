<?php
$file = '../assets/xml/bgg_plays.xml';
if (file_exists($file)) {
    $plays = simplexml_load_file($file);
    echo($plays['username'].'<br>');
    echo($plays['userid'].'<br>');
    echo($plays['total'].'<br>');
    echo($plays['page'].'<br>');
    echo('<br>---<br>');
    foreach($plays->children() as $play) {
        
        echo '<br>=======play========================<br>';
        echo $play['id'].'<br>';
        echo $play['date'].'<br>';
        echo $play['quantity'].'<br>';
        echo $play['length'].'<br>';
        echo $play['incomplete'].'<br>';
        echo $play['nowinstats'].'<br>';
        echo $play['location'].'<br>';

        foreach($play->children() as $playData) {

            if($playData->getName() == 'item') {
                echo($playData['name'].'<br>');
                echo($playData['objecttype'].'<br>');
                echo($playData['objectid'].'<br>');
                foreach($playData->children() as $subtypes) {
                    foreach($subtypes->children() as $subtype) {
                        echo($subtype['value'].'<br>');
                    }
                }
            } else if ($playData->getName() == 'comments') {
                echo($playData->__toString());
            } else if ($playData->getName() == 'players') {
                echo('players = ');
                foreach($playData->children() as $player) {
                    echo($player['name'].'<br>');
                    echo($player['username'].'<br>');
                    echo($player['userid'].'<br>');
                    echo($player['startposition'].'<br>');
                    echo($player['color'].'<br>');
                    echo($player['score'].'<br>');
                    echo($player['new'].'<br>');
                    echo($player['rating'].'<br>');
                    echo($player['win'].'<br>');
                }
            }
            echo('<br>');
        }
    }
} 
else {
    exit('Failed to open bgg_plays.xml.');
}
?>