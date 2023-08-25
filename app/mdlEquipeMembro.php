<?php
 
namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlEquipeMembro extends Model
{
    protected $table = 'IMB_EQUIPEMEMBROS';
    protected $primaryKey  = "IMB_EPM_ID";
    public $timestamps = false;
}
