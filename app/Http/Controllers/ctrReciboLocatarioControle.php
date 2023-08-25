<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlReciboLocatarioControle;

class ctrReciboLocatarioControle extends Controller
{
    public function gerar()
    {

        $rec = mdlReciboLocatarioControle::first();
        if( $rec == '')

        {
            $rec = new mdlReciboLocatarioControle;
            $rec->IMB_PRM_RECIBOLOCATARIO = '1000000';

        }
        $rec->IMB_PRM_RECIBOLOCATARIO = $rec->IMB_PRM_RECIBOLOCATARIO + 1;
        $rec->save();

        return response()->json( $rec, 200 );
    }

}
