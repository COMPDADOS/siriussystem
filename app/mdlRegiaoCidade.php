<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
class mdlRegiaoCidade extends Model
{
    protected $table = 'IMB_REGIAODACIDADE';
    public $primaryKey = 'IMB_RGC_ID';
    public $timestamps = false;


}
