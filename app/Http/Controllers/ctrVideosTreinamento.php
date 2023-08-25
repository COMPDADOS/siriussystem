<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlVideosTreinamento;
use DataTables;

class ctrVideosTreinamento extends Controller
{
    public function index()
    {
        return view( 'treinamentos.videos.vtindex');
    }

    public function list( Request $request )
    {
        $tags = $request->tags;

        $videos = mdlVideosTreinamento::
        whereRaw( "IMB_VDT_TAGS like  '%{$tags}%'")
        ->orderBy('IMB_VDT_TITULO');

        return DataTables::of($videos)->make(true);


    }
}
