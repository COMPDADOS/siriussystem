<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use log;

class ctrLogin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function acessoliberado()
    {
        return view( 'index');
    
    
    }
    public function login()
        {
            if( Auth::user() )
            {
                if( Auth::user()->IMB_ATD_DATADEMISSAO == '' )
                    return view('index');
            }
            else
                return view('login.login');
    }

    public function validaLogin( Request $Request  )
    {
     
        $Request->validate(
            [
                'username' => 'required|email',
                'password' => 'required'
            ]
            );

            $credenciais = 
                            [
                                'login' => $Request->username,
                                'password' => $Request->password
                            ];
            $lembrar = empty( $Request->remember) ? false : true;

            if( Auth::Attempt($credenciais, true ) )
            {
                return redirect()->action('ctrLogin@acessoliberado');
            }
            else
            {
                return  redirect()->action('ctrLogin@login');
            }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
