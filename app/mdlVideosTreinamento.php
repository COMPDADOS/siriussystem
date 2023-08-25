<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlVideosTreinamento extends Model
{
    public $table = 'IMB_VIDEOTREINAMENTO';
    public $primaryKey = 'IMB_VDT_ID';
    public $timestamps = false;
}
