<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable=[
        'keyword',
        'urlProiect',
        'search_engine_name',
        'search_engine_language',
        'location_name',
        'task_id',
        'taskjobs',
        'search_engine_id',
        'location_id'

    ];
}
