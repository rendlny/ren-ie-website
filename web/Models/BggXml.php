<?php

namespace Models;

use DOMDocument;
use \Illuminate\Database\Eloquent\Model;
use Models\Player;
use Models\Play;
use Models\Game;
use Models\PlayPlayer;

class BggXml extends Model
{
    protected $url = 'https://boardgamegeek.com/xmlapi2/plays?';
    protected $username = 'RendlyTheFriendly';
    protected $page = 1;

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPage($page)
    {
        $this->page = $page;
    }

    public function currentUrl()
    {
        return $this->url . 'username=' . $this->username . '&page=' . $this->page;
    }

    public function fileName()
    {
        return $_SERVER['DOCUMENT_ROOT'].'/web/assets/xml/bgg_plays_' . $this->page . '.xml';
    }

    public function checkOrCreateDirectory() {
        if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/web/assets/xml')) {
            mkdir($_SERVER['DOCUMENT_ROOT'].'/web/assets/xml', 0777);
        }
    }

    public function saveXmlFile()
    {
        $dom = new DOMDocument();
        $dom->load($this->currentUrl());
        $dom->save($this->fileName());
    }

    public function getXmlDataFromFile()
    {
        if(file_exists($this->fileName())) {
            return simplexml_load_file($this->fileName());
        }
        return null;
    }

    public function doesXmlContainData()
    {
        $containsData = false;
        $data = $this->getXmlDataFromFile();
        if ($data && $data->count() > 0) {
            $containsData = true;
        }
        return $containsData;
    }

    public function fetchLatestData()
    {
        $this->checkOrCreateDirectory();
        Player::query()->update(['wins' => 0]);
        $pageNotEmpty = true;
        $pageCount = 1;
        while ($pageNotEmpty) {
            $this->setPage($pageCount);
            $this->saveXmlFile();

            $pageNotEmpty = $this->doesXmlContainData();

            if ($pageNotEmpty) {
                $this->loopThroughXmlData();
            }
            $pageCount++;
        }
    }

    public function loopThroughXmlData()
    {
        $plays = $this->getXmlDataFromFile();
        foreach ($plays->children() as $play) {
            $dbPlay = $this->createOrUpdatePlay($play);

            foreach ($play->children() as $playData) {

                switch($playData->getName()) {
                    case 'item':
                        $this->createOrUpdateGame($playData, $dbPlay);
                        break;

                    case 'players':
                        $this->createOrUpdatePlayers($playData, $play, $dbPlay);
                        break;

                    case 'comments':
                        $dbPlay = $this->applyCommentToPlay($playData, $dbPlay);
                        break;

                    default:
                        echo 'no case found ['.$playData->getName().']<br/>';
                }
            }
        }
    }

    public function createOrUpdatePlay($play) {
        return Play::updateOrCreate(['bgg_id' => $play['id']], [
            'date' => $play['date'],
            'quantity' => $play['quantity'],
            'length' => $play['length'],
            'incomplete' => $play['incomplete'],
            'no_win_stats' => $play['nowinstats'],
            'location' => $play['location'],
        ]);
    }

    public function createOrUpdateGame($playData, $dbPlay) {
        $game = Game::updateOrCreate(['bgg_id' => $playData['objectid']], [
            'name' => $playData['name']
        ]);
        $dbPlay->game_id = $game->id;
        $dbPlay->save();
        return $game;
    }

    public function createOrUpdatePlayers($playData, $play, $dbPlay) {
        foreach ($playData->children() as $player) {
            $dbPlayer = Player::updateOrCreate(['name' => $player['name']], [
                'bgg_id' => ($player['userid'] != 0 ? $player['userid'] : null),
                'username' => ($player['username'] != '' ? $player['username'] : null),
            ]);

            PlayPlayer::updateOrCreate([
                'play_id' => $dbPlay->id,
                'player_id' => $dbPlayer->id,
            ], [
                'start_position' => $player['startposition'],
                'color' => $player['color'],
                'score' => $player['score'],
                'new' => $player['new'],
                'rating' => $player['rating'],
                'win' => $player['win'],
            ]);

            if ($play['nowinstats'] == 0 && $player['win'] == 1) {
                $winCount = $dbPlayer->wins;
                $dbPlayer->wins = $winCount + 1;
                $dbPlayer->save();
            }

        }
    }

    public function applyCommentToPlay($playData, $dbPlay) {
        $dbPlay->comment = $playData->__toString();
        $dbPlay->save();
        return $dbPlay;
    }
}
