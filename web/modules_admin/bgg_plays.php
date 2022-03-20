<?php
use Models\Player;

// $fileCount = 1;
// $fileExists = true;
// while($fileExists) {
//     $file = '../assets/xml/bgg_plays_'.$fileCount.'.xml';

//     if (file_exists($file)) {
//         $plays = simplexml_load_file($file);
//         foreach($plays->children() as $play) {
//             $gameName = $gameLength = $date = $location = $playerCount = $playerData = null;

//             foreach($play->children() as $playData) {
//                 if($playData->getName() == 'item') {
//                     $date = $play['date'];
//                     $gameName = $playData['name'];
//                     $location = $play['location'];
//                     $gameLength = $play['length'];
    
//                     // echo($playData['objecttype'].'<br>');
//                     // echo($playData['objectid'].'<br>');
//                     // foreach($playData->children() as $subtypes) {
//                     //     foreach($subtypes->children() as $subtype) {
//                     //         echo($subtype['value'].'<br>');
//                     //     }
//                     // }
//                 } else if ($playData->getName() == 'comments') {
//                     // echo($playData->__toString());
//                 } else if ($playData->getName() == 'players') {
//                     $playerCount = 0;
//                     foreach($playData->children() as $player) {
//                         $playerCount++;
//                         if($player['username']){
//                             // echo '<a href="https://boardgamegeek.com/user/'.$player['username'].'" target="_blank">'.$player['name'].'</a>';
//                         } else {
//                             // echo $player['name'];
//                         }
//                         // echo($player['startposition'].'<br>');
//                         // echo($player['color'].'<br>');
//                         // echo('&nbsp;'.$player['score']);
//                         // echo($player['new'].'<br>');
//                         // echo($player['rating']);
//                         $player = Player::firstOrCreate(['name' => $player['name']], [
//                             'bgg_id' => ($player['userid'] != 0 ? $player['userid'] : null),
//                             'username' => ($player['username'] != '' ? $player['username'] : null),
//                         ]);

//                         $playerData .= '
//                             <div class="bgg-play-player">
//                                 '.$player['name']
//                                 .($player['win'] == 1 ? '&nbsp;<i class="fa fa-crown"></i>' : null)
//                                 .'&nbsp;'.$player['score'].'
//                             </div>';
//                     }
//                 }
//             }
            
//             include '../widgets/bgg/bgg_play_card.php';
//         }
//     } 
//     else {
//         $fileExists = false;
//     }

//     $fileCount++;
// }

?>
<?
    include '../widgets/bgg/bgg_leader_board.php';
?>