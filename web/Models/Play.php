<?php

namespace Models;

use \Illuminate\Database\Eloquent\Model;

class Play extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    public $timestamps = false;

    protected $table = 'play';

    protected $fillable = [
        'bgg_id',
        'date',
        'quantity',
        'length',
        'incomplete',
        'no_win_stats',
        'location',
    ];

}
