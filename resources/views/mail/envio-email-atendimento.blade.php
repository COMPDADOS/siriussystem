<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.5
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="pt-br">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
    <meta charset="utf-8" />
    <title>Sirius System</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- BEGIN GLOBAL MANDATORY STYLES -->

    <script src="{{asset('/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="https://pro.fontawesome.com/releases/v5.1.0/css/all.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css"> 

    <h1>Olá {{$user->clientenome}}</h1>

    <h3>Seguem abaixo informações referente ao atendimento iniciado em {{$user->atendimentoiniciado}} pelo 
        atendente {{$user->corretornome}}</h3>


        <p>{{$user->linhaobs1}}</p>
        <p>{{$user->linhaobs2}}</p>
        <p>{{$user->linhaobs3}}</p>
        <p>{{$user->linhaobs4}}</p>
        <p>{{$user->linhaobs5}}</p>
        <p></p>
        <p>Estamos a disposição</p>
        <p></p>
        <p>Atenciosamente</p>
        <p></p>
    
        <h3>{{$user->corretornome}}</h3>
        <h4>{{$user->corretoremail}}</h3>

        <h3>{{$user->imobiliarianome}}</h3>
        <h4>{{$user->imobiliariatelefone}}</h3>






