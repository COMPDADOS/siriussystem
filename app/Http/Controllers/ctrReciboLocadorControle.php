<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlReciboLocadorControle;
class ctrReciboLocadorControle extends Controller
{
    public function gerar()
    {

        $rec = mdlReciboLocadorControle::first();
        if( $rec == '')

        {
            $rec = new mdlReciboLocadorControle;
            $rec->IMB_PRM_RECIBOLOCADOR = '1000000';

        }
        $rec->IMB_PRM_RECIBOLOCADOR = $rec->IMB_PRM_RECIBOLOCADOR + 1;
        $rec->save();

        return response()->json( $rec, 200 );
    }

}
