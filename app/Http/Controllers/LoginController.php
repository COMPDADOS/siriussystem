<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    function index()
    {
        ini_set('memory_limit', '256M');
        return view('index');
    }
    
    function logado()
    {

        if( Auth::user() )
        {
            if( Auth::user()->IMB_ATD_ATIVO == 'I')
                $this->logout();
            else
                //return redirect()->route('dashboard.comercial.panorama', 
                return redirect()->route('menuadm', 
                    array('empresa' => Auth::User()->IMB_IMB_ID) );
        }
        else
            return view( 'login.acesso');
        
    }

    function login( Request $request )
    {

        //dd( bcrypt( $request->password) );
        $request->validate(
        [
            'username' => 'required',
            'password' =>'required'
        ]);


        $remember = $request->remember;
        $user = $request->username;
        $password = $request->password;
        $usuario = User::where('email', '=', $user )
        ->first();


        //dd( 'email '.$user.' - usuario '.$usuario );
        $encontrouuser = ! empty( $usuario ) ;
        if ( $encontrouuser )
        {
            $hashok = Hash::check( $password, $usuario->password   ) ;


            if ( $hashok )
            {
                //dd( '-----  encontrouuser: '.$encontrouuser.'   -    hash: '.$hashok);
                Auth::loginUsingId( $usuario->IMB_ATD_ID, $remember);
            }
        }


        //dd( Auth::user() );

        return redirect()->action('LoginController@logado');

//        ->
    
    }

    function logout()
    {
        Auth::logout();

        return view( 'logout.logout');
    }
}
