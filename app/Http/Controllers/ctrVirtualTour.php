<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlVirtualTour;
class ctrVirtualTour extends Controller
{
    public function tourImovelHeader( $id )
    {
        $imovel = app('App\Http\Controllers\ctrImovel')
        ->carga( $id );

        $referencia = $imovel->IMB_IMV_REFERE;

        $vt = mdlVirtualTour::where( 'name','=',$referencia)->get();

        return $vt;

    }
}
