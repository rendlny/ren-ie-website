<?php

namespace Models;

use DOMDocument;
use \Illuminate\Database\Eloquent\Model;
use Models\Player;
use Models\Play;

class BggXml extends Model
{
    protected $url = 'https://boardgamegeek.com/xmlapi2/plays?';
    protected $username = 'RendlyTheFriendly';
    protected $page = 0;

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
        Player::query()->update(['wins' => 0]);
        $pageNotEmpty = true;
        $pageCount = 1;
        while ($pageNotEmpty) {
            $this->setPage($pageCount);
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
            foreach ($play->children() as $playData) {

                if ($playData->getName() == 'item') {
                    $dbPlay = Play::firstOrCreate(['bgg_id' => $play['id']], [
                        'date' => $play['date'],
                        'quantity' => $play['quantity'],
                        'length' => $play['length'],
                        'incomplete' => $play['incomplete'],
                        'no_win_stats' => $play['nowinstats'],
                        'location' => $play['location'],
                    ]);
                } elseif ($playData->getName() == 'players') {
                    foreach ($playData->children() as $player) {
                        $dbPlayer = Player::firstOrCreate(['name' => $player['name']], [
                            'bgg_id' => ($player['userid'] != 0 ? $player['userid'] : null),
                            'username' => ($player['username'] != '' ? $player['username'] : null),
                        ]);

                        if ($play['nowinstats'] == 0 && $player['win'] == 1) {
                            $winCount = $dbPlayer->wins;
                            $dbPlayer->wins = $winCount + 1;
                            $dbPlayer->save();
                        }
                    }
                }
            }
        }
    }
}
