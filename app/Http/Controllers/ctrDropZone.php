<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ctrDropZone extends Controller
{
    public function imoveis( )
    {
        return view( 'upload.dropzone.dropzoneimoveis');
    }
}
