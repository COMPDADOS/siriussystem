<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post( '/leads/captura/vivareal', 'Api\ctrLeads@capturarVivaReal');
route::get( '/botconversa/cliente/pegarnomeporcpf/{cpf?}',  'Api\ctrBotConversa@pegaClienteCpf');
route::get( '/botconversa/cliente/BoletoCpf/{cpf?}','Api\ctrBotConversa@procurarBoletoCpf');

route::post( '/whatsapp/webhook', 'Api\ctrWhatsAppInterface@webhook');


Route::middleware('auth:api')->get('/user', function (Request $request)
{
    return $request->user();

});
