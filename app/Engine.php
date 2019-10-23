<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Engine extends Model
{
    //
    protected $fillable=[
        'se_id',
        "se_name",
        "se_country_iso_code",
        "se_country_name",
        "se_language",
        'se_localization'
    ];
}
