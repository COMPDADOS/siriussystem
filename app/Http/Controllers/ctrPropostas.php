<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlImovelProposta;
use Auth;

class ctrPropostas extends Controller
{
    public function index()
    {
        return view( 'imovel.imovelproposta');
    }

    public function incluir( $idimovel)
    {
        return view( 'imovel.proposta', compact( 'idimovel'));

    }

    
}
