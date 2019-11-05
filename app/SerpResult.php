<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SerpResult extends Model
{
    //
    protected $fillable=[
        'resultPostId',
        'resultPostKey',
        'resultTaskId',
        'resultSeId',
        'resultLocationId',
        'resultKeyId',
        'resultDatetime',
        'resultPosition',
        'resultUrl'

    ];
}
