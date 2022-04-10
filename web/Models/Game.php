<?php

namespace Models;

use \Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    public $timestamps = false;
    protected $table = 'game';
    protected $fillable = [
        'bgg_id',
        'name',
    ];

    protected function plays() {
        return $this->hasMany(Play::class);
    }

}
