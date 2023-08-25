<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlLog extends Model
{
    public $table       = 'IMB_LOG';
    public $primaryKey  = 'IMB_LOG_ID';
    public $timestamps  = false;
}
