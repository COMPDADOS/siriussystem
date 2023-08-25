<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlMidia;

class ctrMidia extends Controller
{
    public  function carga()
    {

        $md = mdlMidia::
        orderBy( 'IMB_MDI_GRUPO','ASC')
        ->orderBy( 'IMB_MDI_NOME','ASC')
        ->get();
        return $md;
    }
}
