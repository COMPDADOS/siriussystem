<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlDocsPersonalizados;
use App\mdlDocsPersonalizadosPermis;
use Auth;

class ctrDocsPersonalizados extends Controller
{
    public function carga()
    {
        $docs = mdlDocsPersonalizados::
        where('IMB_IMB_ID','=',Auth::user()->IMB_IMB_ID )->get();
        return $docs;
    }



    public function store( Request $request )
    {
        $doc = new mdlDocsPersonalizados;

        $doc->IMB_DPS_TITULO = $request->IMB_DPS_TITULO;
        $doc->IMB_DPS_ARQUIVO = $request->IMB_DPS_ARQUIVO;
        $doc->IMB_DPS_URL = $request->IMB_DPS_URL;
        $doc->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
        $doc->save();


        $docs_p = mdlPerfilUso::all();
        foreach ($docs_p as $perm) 
        {
            $permissoes = new mdlDocsPersonalizadosPermis;
            $permissoes->IMB_ATP_ID = $perm->IMB_ATP_ID;
            $permissoes->IMB_DPS_ID = $doc->IMB_DPS_ID;
            $permissoes->IMB_DPP_ACESSO = 'N';
            $permissoes->IMB_IMB_ID = Auth::user()->IMB_IMB_ID;
            $permissoes->save();
        }

        return  response()->json( 'ok',200);
            
    }

    public function download( $arquivo )
    {
        $arq = "http://www.siriussystem.com.br/sys/storage/docpersonalizados/".Auth::user()->IMB_IMB_ID."/".$arquivo;
        header("Content-Type: application/pdf");
        // informa o tipo do arquivo ao navegador
        header("Content-Length: ".filesize($arq));
        // informa o tamanho do arquivo ao navegador
        header("Content-Disposition: attachment; filename=".basename($arq));
        // informa ao navegador que é tipo anexo e faz abrir a janela de download,
        //tambem informa o nome do arquivo
        readfile($arq); // lê o arquivo        
    }
}
