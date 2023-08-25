<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlVirtualTour extends Model
{
    public $table = 'svt_virtualtours';
    public $primaryKey = "id";
    public $timestamps = false;
}
