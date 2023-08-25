<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mdlDocsAutomaticos extends Model
{
    protected $table = 'GER_DOCUMENTOAUTOMATICOS';
    protected $primaryKey  = "GER_DCA_ID";
    public $timestamps = false;    //
}
