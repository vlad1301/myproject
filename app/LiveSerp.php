<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiveSerp extends Model
{
    //
    protected $fillable=[
        'data_interogare',
        'keyword',
        'URL',
        'locatia',
        'se_id',
        'engine_name',
        'country'
    ];

    public function engine(){
        return $this->belongsTo('App\Engine');
    }
}
