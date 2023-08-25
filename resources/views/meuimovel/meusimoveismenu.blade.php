<!doctype html>
<html class="no-js" lang="en">

<head>
    @includeIf('meuimovel.googleads-head')
    <meta charset="UTF-8">
    <title>Portal do Cliente</title>
    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('meuimovel/img/logo1.ico')}}"/>
    <!-- global styles-->
    <link rel="stylesheet" href="{{asset('meuimovel/css/components.css')}}"/>
    <link rel="stylesheet" href="{{asset('meuimovel/css/custom.css')}}"/>
    <!--End of Global styles-->
    <!-- page level styles -->
    <link rel="stylesheet" href="{{asset('meuimovel/css/pages/tables.css')}}" />
    <link rel="stylesheet" href="#" id="skin_change" />
    <link href="https://pro.fontawesome.com/releases/v5.1.0/css/all.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>        
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" >

    <!-- end of page level styles -->
    @yield('scripttop')
    <style>
        .div-center
        {
            text-align:center;
        }
        .font-20-blue
        {
            text : blue;
            font-size:20px;
        }
        .fundo-black
    {
        background-color:black;
        color:white;
    }


    </style>

</head>

<body>
@includeIf('meuimovel.googleadds-body')
<div class="preloader" style=" position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: 100000;
  backface-visibility: hidden;
  background: #ffffff;">
    <div class="preloader_img" style="width: 200px;
  height: 200px;
  position: absolute;
  left: 48%;
  top: 48%;
  background-position: center;
z-index: 999999">
        <img src="{{asset('meuimovel/img/loader.gif')}}" style=" width: 40px;" alt="loading...">
    </div>
</div>
    <div id="wrap">
        <div id="top">
            <!-- .navbar -->
            <nav class="navbar navbar-static-top">
                <div class="container-fluid m-0">
                    <a class="navbar-brand mr-0" href="#">
                        <h4 class="text-white"> Portal do Cliente</h4>
                    </a>
                    <div class="menu mr-sm-auto">
                        <span class="toggle-left" id="menu-toggle">
                        <i class="fa fa-bars text-white"></i>
                    </span>
                    </div>
                    @php
                        $ehlt = app( 'App\Http\Controllers\ctrCliente')->ehLocatario( $clt->IMB_CLT_ID );
                        $ehld = app( 'App\Http\Controllers\ctrCliente')->ehLocador( $clt->IMB_CLT_ID );
                    @endphp
                    <div class="topnav dropdown-menu-right ml-auto">
                        <div class="btn-group">
                            <div class="user-settings no-bg">
                                <button type="button" class="btn btn-default no-bg micheal_btn" data-toggle="dropdown">
                                    <strong>{{$clt->IMB_CLT_NOME}}</strong>
                                    <span class="fa fa-sort-down white_bg"></span>
                                </button>
                                <div class="dropdown-menu admire_admin">
                                    <a class="dropdown-item" href="javascript:window.close();"><i class='fas fa-door-open'></i>
                                        Sair
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </nav>
            <!-- /.navbar -->
            <!-- /.head -->
        </div>
        <!-- /#top -->
        <div class="wrapper">
            <div id="left">
                <div class="menu_scroll">
                    <div class="media user-media">
                        <div class="user-media-toggleHover">
                            <span class="fa fa-user"></span>
                        </div>
                        <div class="user-wrapper div-center">
                            <img  class="media-object img-thumbnail user-img rounded-circle admin_img3" src="https://www.siriussystem.com.br/sys/storage/images/{{$clt->IMB_IMB_ID}}/logos/logoportal.png" alt="">
                        </div>
                    </div>
                    <!-- #menu -->
                    <ul id="menu">
                        @if( $ehlt <> 0 )
                        <li class="dropdown_menu">
                            <a href="javascript:;">
                                <i class="fa fa-user"></i>
                                <span class="link-title menu_hide">&nbsp; Sou Locatário</span>
                                <span class="fa arrow menu_hide"></span>
                            </a>
                            <ul>
                                <li>
                                    <a href="javascript:meusContratos()">
                                        <i class="fa fa-angle-right"></i> &nbsp; Meus Contratos
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @if( $ehld <> 0 )
                        <li class="dropdown_menu">
                            <a href="javascript:;">
                            <i class="fa fa-user"></i>
                                <span class="link-title menu_hide">&nbsp; Sou Locador</span>
                                <span class="fa arrow menu_hide"></span>
                            </a>
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-angle-right"></i> &nbsp; Meus Imóveis
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        <li>
                            <a href="javascript:window.close();">
                                <i class='fas fa-door-open'></i>
                                <span class="link-title menu_hide">&nbsp; Sair do Portal</span>
                                <span class="fa arrow menu_hide"></span>
                            </a>
                        </li>
                    </ul>
                    <!-- /#menu -->
                </div>
            </div>
            <!-- /#left -->
            <div id="content" class="bg-container">
                @yield('content')
            </div>
            
            <!-- /#content -->
        </div>
        <!--wrapper-->
        
        <!-- # right side -->
    </div>

    <form style="display: none" action="{{route('meuimovel.meuscontratos')}}/{{$clt->IMB_CLT_ID}}" method="get" id="frm-meuscontratos" target="_blank">            
    </form>

    <!-- /#wrap -->
    <!-- global scripts-->
    <script src="{{asset('meuimovel/js/components.js')}}"></script>
    <script src="{{asset('meuimovel/js/custom.js')}}"></script>
    <script src="{{asset('js/funcoes.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" ></script>
    <script>
        function meusContratos()
        {
            $("#frm-meuscontratos").submit();

        }
    </script>

    @stack('script')

        @hasSection('javascript')
            @yield('javascript')
        @endif

    <!-- end of global scripts-->
</body>

</html>
