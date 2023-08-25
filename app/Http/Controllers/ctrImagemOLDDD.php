<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlImagem;
use App\mdlImovel;
use App\classes\PQ_Image;
use Illuminate\Filesystem;
use Illuminate\Support\Facades\Storage;
use File;
use Image;
use DB;
use Redirect;
use Auth;
use Log;


class ctrImagem extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }


    public function index()
    {

    }

    public function galeria( $id )
    {
        $imagens = mdlmagem::Select( '*')
        ->where( 'IMB_IMV_ID', $id )
        ->orderBy( 'IMB_IMG_NOME')
        ->get();


        return view( '/imovel/mygallery', compact( 'imagens') );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


     //   print_r( $_POST );
       /**
         *
         * @VAR Uploador
         */
        $images=$request->file('arquivo');

        if($request->hasfile('arquivo')){

            $images=$request->file('arquivo');

            if( !empty( $images ))
            {
                $cont=0;
                foreach( $images as $image )
                {
                    $cont++;
                    $file_name=$cont.'-'.time().'.'.$image->getClientOriginalExtension();

//                    $pasta='/rb/storage/images/imoveis/'.$request->input('id');
//                    $pastaThumb='/rb/storage/images/imoveis/'.$request->input('id').'/thumbnail';
                    $pasta='images/'.$request->input('imbmaster').'/imoveis/'.$request->input('id');
                    $pastaThumb='images/'.$request->input('imbmaster').'/imoveis/'.'thumb/'.$request->input('id');
    //                mkdir($pastaThumb.'/lindao', 0777, true);

                    Storage::disk('public')->makeDirectory( $pasta);
                    Storage::disk('public')->makeDirectory( $pastaThumb);

                    $photo = Image::make( $image );

                    $photo = Image::make( $image )
                    ->resize(1080, null, function ($constraint) { $constraint->aspectRatio(); } )
                    ->encode('jpg',80);
                    Storage::disk('public')->put( $pasta.'/'.$file_name, $photo);

                    $marcadagua =env('WATERMARK'); 
                    if( $marcadagua )
                    {
                        $imagepathroot = Storage::disk('public')->path('');
                        $img = Image::make($imagepathroot.$pasta.'/'.$file_name);
                        $img->insert( $marcadagua, 'center');
                        $img->save($imagepathroot.$pasta.'/'.$file_name);
                    }
            
                    $photo = Image::make( $image )
                    ->resize(100, null, function ($constraint) { $constraint->aspectRatio(); } )
                    ->encode('jpg',80);

                    Storage::disk('public')->put( $pastaThumb.'/100_75'.$file_name, $photo);

//                    $photo = Image::make( $image )
//                    ->resize(60, null, function ($constraint) { $constraint->aspectRatio(); } )
//                    ->encode('jpg',100);
//                    Storage::disk('public')->put( $pastaThumb.'/60_45_'.$file_name, $photo);

/*                  $photo = Image::make( $image )
                    ->resize(1920, null, function ($constraint) { $constraint->aspectRatio(); } )
                    ->encode('jpg',60);
                    Storage::disk('public')->put( $pasta.'/'.$file_name, $photo);


                    //if (!is_dir($pasta)) mkdir($pasta, 0777, true);
                    //if (!is_dir($pastaThumb)) mkdir($pastaThumb, 0777, true);
                    $image_resize = Image::make($image->getRealPath());
                    $image_resize->resize(1920,1280);
                    Storage::disk('public')->put( $pasta.'/'.$file_name, $image->getRealPath());
                    //$image_resize->store( $file_name, 'public');
//                    $image_resize->save( 'public/'.$file_name);
                    //$image_resize->save(public_path($pasta.'/'.$file_name));
                    Storage::disk('public')->put( $pasta.'/thumb_'.$file_name, $image_resize);
                    $image_resize->resize(180,135);
//                    $image_resize->store( $pastaThumb,'public');



//                    $image->store( 'images','public');
*/
                    $maxValue = DB::table( 'IMB_IMAGEM')
                    ->where( 'IMB_IMV_ID','=',  $request->input('id'))
                    ->max('IMB_IMG_SEQUENCIA');

                    $t = new mdlImagem();
                    $t->IMB_IMB_ID          = $request->input('imbmaster');;
                    $t->IMB_IMV_ID          = $request->input('id');
                    $t->IMB_IMG_SEQUENCIA   = $maxValue+1;
                    $t->IMB_IMG_ARQUIVO     = $file_name;
                    $t->IMB_IMG_NOME        = str_pad($seq,3,"0",STR_PAD_LEFT);;
                    $t->imb_img_dthativo    = date('Y/m/d');
                    $t->IMB_ATD_ID          = Auth::user()->IMB_IMB_ID;
                    $t->save();
                    //dd( $image_resize);
                };
                return response()->json(['success' => 'Arquivo Gravado'], 200);
            }

            return response()->json(['error' => 'Nada gravado'], 404);

        };




    }

    public function inserirWM($idimovel)
    {
    

        $imagens = mdlImagem::where( 'IMB_IMV_ID','=', $idimovel)->get();

        foreach( $imagens as $imagem  )
        {

             $file_name = $imagem->IMB_IMG_ARQUIVO;

              $pasta='images/'.Auth::user()->IMB_IMB_ID.'/imoveis/'.$idimovel;
        
              $marcadagua =env('WATERMARK'); 
                Log::info( $marcadagua );
             if( $marcadagua )
               {
                Log::info( "img ".$imagem->IMB_IMG_ID);
                   $imagepathroot = Storage::disk('public')->path('');
                                   $img = Image::make($imagepathroot.$pasta.'/'.$file_name);
                   $img->insert( $marcadagua, 'center');
                 $img->save($imagepathroot.$pasta.'/'.$file_name);
                }
        }

        return response()->json('ok',200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $imagens = mdlImagem::find( $id );

        return $imagens;
    }

    public function principal($idimovel, $idimagem )
    {

        DB::table('IMB_IMAGEM')
        ->where('IMB_IMV_ID', $idimovel)
        ->update(['IMB_IMG_PRINCIPAL' => 'N']);

        DB::table('IMB_IMAGEM')
        ->where('IMB_IMV_ID', $idimovel)
        ->where('IMB_IMG_ID', $idimagem)
        ->update(['IMB_IMG_PRINCIPAL' => 'S']);

        return response('OK',200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $imagem= mdlImagem::find( $id );
        if( isset( $imagem )){
            $imagem->IMB_IMG_NOME = $request->input('IMB_IMG_NOME');
            $imagem->IMB_IMG_PRINCIPAL = $request->input('IMB_IMG_PRINCIPAL');
            $imagem->IMB_IMG_NAOIRPROSITE = $request->input('IMB_IMG_NAOIRPROSITE');
            $imagem->IMB_IMG_CAPA = $request->input('IMB_IMG_CAPA');
            $imagem->save();
            return json_encode( $imagem );
        }

        return response('Não Encontrado', 404);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function destroy($id)
    {


        $imagem = mdlImagem::find( $id );
        $imovel = $imagem->IMB_IMV_ID;
        $idimagem = $imagem->IMB_IMG_ID;




        if( isset( $imagem ))
        {
            $pasta='/images/'.$imagem->IMB_IMB_ID.'/imoveis';
            $pastaThumb='/images/'.$imagem->IMB_IMB_ID.'/imoveis/thumb';
           $imagem->delete();


            Storage::disk('public')->delete(  $pasta.'/'. $imovel.'/'.$imagem->IMB_IMG_ARQUIVO );
            Storage::disk('public')->delete(  $pastaThumb.'/'.$imovel.'/800_600_'.$imagem->IMB_IMG_ARQUIVO);
            Storage::disk('public')->delete(  $pastaThumb.'/'.$imovel.'/100_75'.$imagem->IMB_IMG_ARQUIVO );
            Storage::disk('public')->delete(  $pastaThumb.'/'.$imovel.'/60_45_'.$imagem->IMB_IMG_ARQUIVO );
            $delete = 'imagem: '.$pastaThumb.'/'.$imovel.'/180_135_'.$idimagem;

            return response( $delete ,200);
        }

        return response('Já Excluido',404);

        //
    }


    public function indexJson( $id )
    {
        $imagens = mdlImagem::Select( '*')
        ->where( 'IMB_IMV_ID', $id )
        ->where( 'IMB_IMB_ID', Auth::user()->IMB_IMB_ID )
        ->orderBy('IMB_IMG_NOME')
        ->get();

        return $imagens->toJson();
        //
    }

    public function imagem( $id )
    {
        $imagens = mdlImagem::Select( '*')
        ->where( 'IMB_IMB_ID', Auth::user()->IMB_IMB_ID )
        ->where( 'IMB_IMG_ID', $id )
        ->get();

        return view( '/imovel/imagem', compact( 'imagens') );        //
    }

    public function mostrarImagemPrincipal( $id )
    {
        $imagens = mdlImagem::Select( '*')
        ->where( 'IMB_IMV_ID', $id )
        ->where( 'IMB_IMB_ID', Auth::user()->IMB_IMB_ID )
        ->orderBy( 'IMB_IMG_PRINCIPAL','DESC')
        ->limit(1)
        ->get();

        return $imagens->toJson();
    }

    public function slider( $id )
    {
        $imagens = mdlImagem::Select( '*')
        ->where( 'IMB_IMV_ID', $id )
        ->get();

        $imovel =   app('App\Http\Controllers\ctrRotinas')
        ->imovelEndereco( $id );



        return view('imagem.slider', compact( 'imagens', 'imovel' ) );
        //
    }





    public function album( $id )
    {
        
        $imovel = mdlImovel::select(
            [
                'IMB_IMOVEIS.*',
                DB::Raw( 'COALESCE(IMB_IMV_GARCOB,0)+COALESCE(IMB_IMV_GARDES,0) AS GARAGENS'),

                DB::raw( "(select IMB_CND_NOME FROM IMB_CONDOMINIO
                WHERE IMB_CONDOMINIO.IMB_CND_ID = IMB_IMOVEIS.IMB_CND_ID) AS IMB_CND_NOME"),
                DB::raw("IMB_IMOBILIARIA.IMB_IMB_NOME AS IMB_IMB_NOME"),
                DB::raw("IMB_TIPOIMOVEL.IMB_TIM_DESCRICAO AS IMB_TIM_DESCRICAO"),
                DB::raw( '(select IMB_IMG_ARQUIVO FROM IMB_IMAGEM 
                        WHERE IMB_IMAGEM.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID 
                        ORDER BY IMB_IMG_PRINCIPAL DESC LIMIT 1) AS IMB_IMG_ARQUIVO'),
                DB::raw( '(select COUNT(*) FROM IMB_IMAGEM 
                        WHERE IMB_IMAGEM.IMB_IMV_ID = IMB_IMOVEIS.IMB_IMV_ID ) AS QTDFOTOS'),
           ])
//            ->join('IMB_IMAGEM', 'IMB_IMAGEM.IMB_IMV_ID', 'IMB_IMOVEIS.IMB_IMV_ID')
            ->join('IMB_TIPOIMOVEL', 'IMB_TIPOIMOVEL.IMB_TIM_ID', 'IMB_IMOVEIS.IMB_TIM_ID')
            ->join('IMB_IMOBILIARIA', 'IMB_IMOBILIARIA.IMB_IMB_ID', 'IMB_IMOVEIS.IMB_IMB_ID')
            ->join('VIS_STATUSIMOVEL', 'VIS_STATUSIMOVEL.VIS_STA_ID', '=', 'IMB_IMOVEIS.VIS_STA_ID')
            ->where( 'IMB_IMV_ID','=', $id )
            ->first();
            


        
        $imagens = mdlImagem::Select( '*')
        ->where( 'IMB_IMV_ID', $id )
        ->get();

        if( $imagens == '[]')
           return '';


        return view('imagem.album', compact( 'imovel', 'imagens' ) );        


    }

    public function teste()
    {
        return view('testes.upload' );
    }

    public function testeenviarupload( Request $request )
    {

        return $request->input('arquivo-cliente');
    }

    public function fileUpload(Request $request)
    {

        //dd( $request);

        $images=$request->file('file');

        if($request->hasfile('file'))
        {

          $seq = mdlImagem::where('IMB_IMV_ID','=', $request->id )
          ->max( 'IMB_IMG_SEQUENCIA');
          $seq = $seq + 2;


          $images=$request->file('file');


          // Get file extension
          $extension = $request->file('file')->getClientOriginalExtension();

          // Valid extensions
          $validextensions = array("jpeg","jpg","png","pdf");

          // Check extension
          if(in_array(strtolower($extension), $validextensions))
          {

            // Rename file
            //$fileName = $request->file('file')->getClientOriginalName().time() .'.' . $extension;
            // Uploading file to given path
            $file_name=$seq.'-'.time().'.'.$images->getClientOriginalExtension();

            $pasta='/images/'.$request->input('imbmaster').'/imoveis/'.$request->input('id');
            $pastaThumb='/images/'.$request->input('imbmaster').'/imoveis/'.'thumb/'.$request->input('id');
            Storage::disk('public')->makeDirectory( $pasta);
            Storage::disk('public')->makeDirectory( $pastaThumb);
            $photo = Image::make( $images )
                                ->resize(1080, null, function ($constraint) { $constraint->aspectRatio(); } )
                                ->encode('jpg',80);
            Storage::disk('public')->put( $pasta.'/'.$file_name, $photo);


            $photo = Image::make( $images )
                                ->resize(100, null, function ($constraint) { $constraint->aspectRatio(); } )
                                ->encode('jpg',80);
            Storage::disk('public')->put( $pastaThumb.'/100_75'.$file_name, $photo);

            $maxValue = DB::table( 'IMB_IMAGEM')
                                ->where( 'IMB_IMV_ID','=',  $request->input('id'))
                                ->max('IMB_IMG_SEQUENCIA');

            $t = new mdlImagem();
            $t->IMB_IMB_ID          = $request->input('imbmaster');;
            $t->IMB_IMV_ID          = $request->input('id');
            $t->IMB_IMG_SEQUENCIA   = $seq;
            $t->IMB_IMG_ARQUIVO     = $file_name;
            $t->IMB_IMG_NOME        = str_pad($seq,3,"0",STR_PAD_LEFT);;
            $t->imb_img_dthativo    = date('Y/m/d');
            $t->IMB_ATD_ID          = Auth::user()->IMB_IMB_ID;
            $t->save();
            return response()->json(['success' => 'Arquivo Gravado'], 200);
          }

        }
     }
     public function userStore(Request $request)
     {
        
         if($request->hasfile('file'))
         {
            $image=$request->file('file');

            $id = $request->id;
            $file_name=$id.'.jpg';           

            Log::info( "id ".$id );
            Log::info( "filenema ".$file_name );

            $pasta='/images/'.Auth::user()->IMB_IMB_ID.'/usuarios/';

            $oldfileexists = Storage::disk('public')->exists( $pasta.$file_name );
            if( $oldfileexists )
            {
                Storage::disk('public')->delete( $pasta.$file_name );
            }
            
            Storage::disk('public')->makeDirectory( $pasta);
            Log::info( 'Pasta '.$pasta );
            $photo = Image::make( $image )
                ->resize(60, null, function ($constraint) { $constraint->aspectRatio(); } )
                ->encode('jpg',80);
            Storage::disk('public')->put( $pasta.'/avatar'.$file_name, $photo);

            return response()->json( 'avatar'.$file_name, 200);
        };
        return response()->json('Não Realizado', 404);


     }


     public function dropzoneStore(Request $request)
     {

         $images=$request->file('file');

         if($request->hasfile('file') )
         {

           $seq = mdlImagem::where('IMB_IMV_ID','=', $request->idimovel )->max( 'IMB_IMG_SEQUENCIA');
           $seq = $seq + 2;

           $images=$request->file('file');

           // Get file extension
           $extension = $request->file('file')->getClientOriginalExtension();

           // Valid extensions
           $validextensions = array("jpeg","jpg","png","pdf");

           // Check extension
           if(in_array(strtolower($extension), $validextensions))
           {

             // Rename file
             $file_name=$seq.'-'.time().'.'.$images->getClientOriginalExtension();

             $pasta='/images/'.Auth::user()->IMB_IMB_ID.'/imoveis/'.$request->input('idimovel');
             $pastaThumb='/images/'.Auth::user()->IMB_IMB_ID.'/imoveis/'.'thumb/'.$request->input('idimovel');
             Storage::disk('public')->makeDirectory( $pasta);
             Storage::disk('public')->makeDirectory( $pastaThumb);
             $photo = Image::make( $images )
                                 ->resize(1080, null, function ($constraint) { $constraint->aspectRatio(); } )
                                 ->encode('jpg',80);
             Storage::disk('public')->put( $pasta.'/'.$file_name, $photo);

             $photo = Image::make( $images )
                                 ->resize(100, null, function ($constraint) { $constraint->aspectRatio(); } )
                                 ->encode('jpg',80);
             Storage::disk('public')->put( $pastaThumb.'/100_75'.$file_name, $photo);

             $maxValue = DB::table( 'IMB_IMAGEM')
                                 ->where( 'IMB_IMV_ID','=',  $request->input('idimovel'))
                                 ->max('IMB_IMG_SEQUENCIA');

             $t = new mdlImagem();
             $t->IMB_IMB_ID          = Auth::user()->IMB_IMB_ID;
             $t->IMB_IMV_ID          = $request->input('idimovel');
             $t->IMB_IMG_SEQUENCIA   = $seq;
             $t->IMB_IMG_NOME        = '';
             $t->IMB_IMG_ARQUIVO     = $file_name;
             $t->IMB_IMG_NOME        = str_pad($seq,3,"0",STR_PAD_LEFT);;
             $t->imb_img_dthativo    = date('Y/m/d');
             $t->IMB_ATD_ID          = Auth::user()->IMB_IMB_ID;
             $t->save();
             return response()->json(['success' => 'Arquivo Gravado'], 200);
           };
        }
     }

     public function dropzone()
     {
         return view('imovel.uploadimagens');
     }
     
     public function dragDrop( Request $request )
     {
        $id = $request->id;
        Log::info( 'fncao dragdrop '.$id );
        return view( 'imagem.dragdrop', compact('id'));
     }

     public function storeDragDrop(Request $request)
     {


        

         $image = $request->file('file');
        $file_name='sirius_'.rand(1000,1000000) . '.' . $image->getClientOriginalExtension();
 
        Log::info('563');
        $empresa = Auth::user()->IMB_IMB_ID;

        $pasta='images/'.$empresa.'/imoveis/'.$request->input('id');
        $pastaThumb='images/'.$empresa.'/imoveis/'.'thumb/'.$request->input('id');
 
        Storage::disk('public')->makeDirectory( $pasta);
        Storage::disk('public')->makeDirectory( $pastaThumb);
 
        $photo = Image::make( $image )
            ->resize(1080, null, function ($constraint) { $constraint->aspectRatio(); } )
            ->encode('jpg',80);
        Storage::disk('public')->put( $pasta.'/'.$file_name, $photo);
 
        $marcadagua =env('WATERMARK'); 
        Log::info( $marcadagua );
        if( $marcadagua )
        {
            $imagepathroot = Storage::disk('public')->path('');
            $img = Image::make($imagepathroot.$pasta.'/'.$file_name);
            $img->insert( $marcadagua, 'center');
            $img->save($imagepathroot.$pasta.'/'.$file_name);
        }
        
        $photo = Image::make( $image )
            ->resize(100, null, function ($constraint) { $constraint->aspectRatio(); } )
            ->encode('jpg',80);
        Storage::disk('public')->put( $pastaThumb.'/100_75'.$file_name, $photo);
        
        $maxValue = DB::table( 'IMB_IMAGEM')
                     ->where( 'IMB_IMV_ID','=',  $request->input('id'))
                     ->max('IMB_IMG_SEQUENCIA');
 
        $t = new mdlImagem();
        Log::info('597');
        $t->IMB_IMB_ID          = Auth::user()->IMB_IMB_ID;
        $t->IMB_IMV_ID          = $request->input('id');
        $t->IMB_IMG_SEQUENCIA   = $maxValue+1;
        $t->IMB_IMG_NOME        = str_pad($t->IMB_IMG_SEQUENCIA,3,"0",STR_PAD_LEFT);;
        $t->IMB_IMG_ARQUIVO     = $file_name;
        $t->imb_img_dthativo    = date('Y/m/d');
        $t->IMB_ATD_ID          = Auth::user()->IMB_ATD_ID;
        Log::info('604');

        $t->save();
        return response()->json(['success' => 'Arquivo Gravado'], 200);
     }


     public function fileToBase64( $filename )
     {

        $pathroot = Storage::disk('public')->path('');
        $file="clicksign/laravel.log";

        $codif = base64_encode(file_get_contents( $pathroot.$file ));
       return $codif;
     }

     public function carga( $id)
     {
        $imgs = mdlImagem::where( 'IMB_IMV_ID','=', $id )
        ->whereRaw( "coalesce(IMB_IMG_NAOIRPROSITE,'N')<> 'S'")
        ->orderBy( 'IMB_IMG_NOME')
        ->get();
        return $imgs;
     }

     public function uploadDropZone( Request $request )
     {
 
 
         $image = $request->file('file');
 
         $imageName = 'sirius'.(rand(10,1000000)). '.' . $image->extension();
 
         $image->move( public_path( 'images'), $imageName );
         
         return response()->json( ['success' => $imageName]);
 
 
         
 
     }

     public function deletarImagensImovel( $imovel )
    {
        $img = mdlImagem::where( 'IMB_IMV_ID','=', $imovel )->get();
        foreach( $img as $im)
        {
        
            $pasta='/images/'.$im->IMB_IMB_ID.'/imoveis';
            $pastaThumb='/images/'.$im->IMB_IMB_ID.'/imoveis/thumb';
            Log::info( 'Imagem '.$pasta.'/'. $imovel.'/'.$im->IMB_IMG_ARQUIVO);
    
            Storage::disk('public')->delete(  $pasta.'/'. $imovel.'/'.$im->IMB_IMG_ARQUIVO );
            Storage::disk('public')->delete(  $pastaThumb.'/'.$imovel.'/800_600_'.$im->IMB_IMG_ARQUIVO);
            Storage::disk('public')->delete(  $pastaThumb.'/'.$imovel.'/100_75'.$im->IMB_IMG_ARQUIVO );
            $im->delete();
        }
        return response()->json( 'ok',200);
    
    }
 

}
