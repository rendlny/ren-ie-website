<?php

namespace Models;

use \Illuminate\Database\Eloquent\Model;

class PlayPlayer extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    public $timestamps = false;
    protected $table = 'play_player';
    protected $fillable = [
        'play_id',
        'player_id',
        'start_position',
        'color',
        'score',
        'new',
        'rating',
        'win',
    ];

    protected function play() {
        return $this->belongsTo(Play::class);
    }

    protected function player() {
        return $this->belongsTo(Player::class);
    }
}
