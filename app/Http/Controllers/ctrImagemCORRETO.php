<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mdlImagem;
use App\classes\PQ_Image;
use Illuminate\Filesystem;
use Illuminate\Support\Facades\Storage;use File;
use Image;
use DB;
use Redirect;
use Auth;

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
        if($request->hasfile('arquivo')){
     
            $image=$request->file('arquivo');

            if( !empty( $image )) 
            {
                //foreach( $imagens as $image )
                //{
                    $file_name=time().'.'.$image->getClientOriginalExtension();

//                    $pasta='/rb/storage/images/imoveis/'.$request->input('id');
//                    $pastaThumb='/rb/storage/images/imoveis/'.$request->input('id').'/thumbnail';
                    $pasta='/images/'.$request->input('imbmaster').'/imoveis/'.$request->input('id');
                    $pastaThumb='/images/'.$request->input('imbmaster').'/imoveis/'.'thumb/'.$request->input('id');
    //                mkdir($pastaThumb.'/lindao', 0777, true);                    

                    Storage::disk('public')->makeDirectory( $pasta);
                    Storage::disk('public')->makeDirectory( $pastaThumb);
    //                $pasta = '/images/imoveis/'.$request->input('id');
    
//                    $photo = Image::make( $image );
                    //Storage::disk('public')->put( $pasta.'/'.$file_name, $photo);

                    $photo = Image::make( $image )
                    ->resize(1920, null, function ($constraint) { $constraint->aspectRatio(); } )
                    ->encode('jpg',80);
                    Storage::disk('public')->put( $pasta.'/'.$file_name, $photo);
                    
                    //$photo = Image::make( $image )
                    //->resize(800, null, function ($constraint) { $constraint->aspectRatio(); } )
                    //->encode('jpg',70);
                    //Storage::disk('public')->put( $pastaThumb.'/800_600_'.$file_name, $photo);

//                    $photo = Image::make( $image )
//                    ->resize(180, null, function ($constraint) { $constraint->aspectRatio(); } )
                    //->encode('jpg',80);
                    //Storage::disk('public')->put( $pastaThumb.'/180_135_'.$file_name, $photo);

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
                    $t->imb_img_dthativo    = date('Y/m/d');
                    $t->IMB_ATD_ID          = Auth::user()->IMB_IMB_ID;
                    $t->save();
                    //dd( $image_resize);
                //};
                return response()->json(['success' => 'Arquivo Gravado'], 200);    
            }

            return response()->json(['error' => 'Nada gravado'], 404);    

        };




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
           $imagem->delete();    

            $pasta='/images/imoveis';
            $pastaThumb='/images/imoveis/thumb';        
            
            Storage::disk('public')->delete(  $pasta.'/'. $imovel.'/'.$imagem->IMB_IMG_ARQUIVO );
            Storage::disk('public')->delete(  $pastaThumb.'/'.$imovel.'/800_600_'.$imagem->IMB_IMG_ARQUIVO);
            Storage::disk('public')->delete(  $pastaThumb.'/'.$imovel.'/180_135_'.$imagem->IMB_IMG_ARQUIVO );
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
        ->orderBy('IMB_IMG_NOME')
        ->get();

        return $imagens->toJson();
        //
    }

    public function imagem( $id )
    {
        $imagens = mdlImagem::Select( '*')
        ->where( 'IMB_IMG_ID', $id )
        ->get();

        return view( '/imovel/imagem', compact( 'imagens') );        //
    }

    public function mostrarImagemPrincipal( $id )
    {
        $imagens = mdlImagem::Select( '*')
        ->where( 'IMB_IMV_ID', $id )
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

    public function teste()
    {
        return view('testes.upload' );
    }

    public function testeenviarupload( Request $request )
    {
        
        return $request->input('arquivo-cliente');
    }


        
}
