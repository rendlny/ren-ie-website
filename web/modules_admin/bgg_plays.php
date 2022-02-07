<?php
$file = '../assets/xml/bgg_plays.xml';
if (file_exists($file)) {
    $plays = simplexml_load_file($file);
    foreach($plays as $play) {
        $players = $play->players;
        foreach($players as $player) {
            echo $player->username.'<br>';
            // echo $player->username.'<br>';
            // echo $key.'<br>';
            // echo $player->getUsername();
            // $username = $player->username[0]->__toString();
            // print_r($player->username);
            // echo($username);
            // print_r($player);

        }
        // echo($play->id);
        // print_r($play->date);
        echo '----';
    }
} 
else {
    exit('Failed to open bgg_plays.xml.');
}
?>