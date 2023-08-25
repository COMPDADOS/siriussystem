<?php
 
namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlCFC extends Model
{
    protected $table = 'FIN_CFC';
    protected $primaryKey  = "ID";
    public $timestamps = false;
}
