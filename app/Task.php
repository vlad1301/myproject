<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable=[
        'keyword',
        'urlProiect',
        'search_engine_name',
        'search_engine_language',
        'location_name',
        'task_id',
        'taskjobs'


    ];
}
