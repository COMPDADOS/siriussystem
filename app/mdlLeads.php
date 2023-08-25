<?php
 
namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlLeads extends Model
{
    protected $table = 'IMB_LEADS';
    protected $primaryKey  = "IMB_LED_ID";
    public $timestamps = false;
}
