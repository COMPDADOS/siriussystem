<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Album de Imagens</title>
<!-- Stylesheets -->
<style>
    .pagination{
            float: right;
            margin-top: 10px;
        }    
    .select2-selection__rendered 
    {
        line-height: 45px !important;
    }
    .select2-container .select2-selection--single {
        height: 45px !important;
    }
    .select2-selection__arrow 
    {
        height: 45px !important;
    }
    .img-mini
            {
                max-width:100%;
                width:370px;
				height:320px;            
            }

    .thumb-album
    {
        max-width:100%;
        width:170px;
		height:110px;            
    }
    .imagem-album
    {
        max-width:100%;
        width:770px;
		height:470px;            
    }

    .img-lateral-pesquisa
    {
        max-width:100%;
                width:370px;
				height:250px;            
                max-width:320px;

            }

    .font-green
    {
        color:green;
    }

    .div-center
    {
        text-align:center;
    }
    
    .w-5
    {
        display:nome;
    }

    .fundo-album
    {
        background-color: #e6e6e6;
    }

</style>
<link href="{{asset('album/css/bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('album/plugins/revolution/css/settings.css')}}" rel="stylesheet" type="text/css"><!-- REVOLUTION SETTINGS STYLES -->
<link href="{{asset('album/plugins/revolution/css/layers.css')}}" rel="stylesheet" type="text/css"><!-- REVOLUTION LAYERS STYLES -->
<link href="{{asset('album/plugins/revolution/css/navigation.css')}}" rel="stylesheet" type="text/css"><!-- REVOLUTION NAVIGATION STYLES -->
<link href="{{asset('album/css/style.css')}}" rel="stylesheet">
<link href="{{asset('album/css/responsive.css')}}" rel="stylesheet">
<!--Color Switcher Mockup-->
<link href="{{asset('album/css/color-switcher-design.css')}}" rel="stylesheet">
<!--Color Themes-->
<link id="theme-color-file" href="{{asset('album/css/color-themes/blue-theme.css')}}" rel="stylesheet">

<link rel="shortcut icon" href="{{asset('images/favicon.png')}}" type="image/x-icon">
<link rel="icon" href="{{asset('images/favicon.png')}}" type="image/x-icon">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://kit.fontawesome.com/6f14330d53.js" crossorigin="anonymous"></script>	
<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>
