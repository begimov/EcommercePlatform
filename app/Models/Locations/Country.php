<?php

namespace App\Models\Locations;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['name', 'code'];
}
