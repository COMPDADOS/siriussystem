<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ctrDashBoardComercial extends Controller
{
    public function panorama()
    {
        return view('dashboard.comercial.dsbdefault');
    }
}
