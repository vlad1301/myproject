<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $fillable=[
        'loc_id',
        'loc_id_parent',
        'loc_name',
        'loc_name_canonical',
        'loc_type',
        'loc_country_iso_code',
    ];
}
