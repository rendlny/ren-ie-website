<?php

namespace Models;

use \Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    public $timestamps = false;
    protected $table = 'player';
    protected $fillable = [
        'bgg_id',
        'username',
        'name',
        'wins',
        'on_leader_board',
    ];

    protected function playerPlays()
    {
        return $this->hasMany(PlayPlayer::class);
    }

    public function winAverage()
    {
        return ($this->wins / $this->playCount()) * 100;
    }

    public function playCount()
    {
        return $this->playerPlays()->count();
    }
}
