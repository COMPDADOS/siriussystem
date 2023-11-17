<!DOCTYPE html>

<html lang="pt-BR">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title id="i-title-erp">Sirius System ERP Imobiliário</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #2 for user inbox" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->


        <script src="{{asset('/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/js/datedropper.min.js')}}" type="text/javascript"></script>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
        <link href="https://pro.fontawesome.com/releases/v5.1.0/css/all.css" rel="stylesheet" type="text/css" />

         <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet" type="text/css" />

         <link href="{{asset('/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
         <link href="{{asset('/global/css/dataTables.checkboxes.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{asset('/global/plugins/sweetalert/sweetalert2.min.css')}}">
        <link href="{{asset('/global/plugins/fullcalendar/fullcalendar.css')}}" rel="stylesheet" type="text/css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/md5.js"></script>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{asset('/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{asset('/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{asset('/layouts/layout2/css/layout.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/layouts/layout2/css/themes/blue.css')}}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{asset('/layouts/layout2/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="{{asset('/global/img/favicon.ico')}}" />
        <script src="{{asset('/global/scripts/datatable.js') }}" type="text/javascript"></script>
        <script src="{{asset('/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
        <script src="{{asset('/global/plugins/jquery.blockUI.js')}}" type="text/javascript"></script>

        <link href="{{asset('/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/css/fonts.css')}}" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css" rel="stylesheet" />
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
        <script src="https://kit.fontawesome.com/9312426ea1.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="http://code.jquery.com/qunit/qunit-1.11.0.css" type="text/css" media="all">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />

        <style>

        .modal-body-notif {
            height: 80vh;
            overflow-x: auto;
            }
            #div-administracao      {display: none;}
            #div-comercial          {display: none;}
            #div-cliente            {display: none;}
            #div-botoes             {display: none;}
            #div-botoes-clientes    {display: none;}
            #div-botoes-corretor    {display: none;}

            .modal.custom .modal-dialog {
                width:20%;
                position:fixed;
                bottom:0;
                right:0;
                margin:0;
                background-color:#ffffe6;
            }
            .fundo-cinza
            {
                background-color: grey;
            }
            .select-pesquisar {
                width: 150px;
                height:40px;
            }
            .img-100
            {
                width: 100%;
            }

            .img-50
            {
                    max-width:50%;
                    width:20px;
            }

            .altura-50
            {

                    height:50%;
            }

            .red-sino
            {
                color:red;
            }

            .i-sem-conexao {
              background-color: red;
              color:white;
            }

            .liberado
{
    background-color:green;
    color:white;
}
.rejeitado
{
    color:red;
    text-decoration-line: italic;
}

.img-100px
                {
                    width: 100px;
                    height: 100px;
                    border-radius: 50%;
                }

                .barra-titulo
                {
                background-color:#007399;
                color:white;
                font-weight: bold;
                text-align: center;
                }


            .escondido {
              display: none;
            }

            .div-center
            {
                text-align:center;
            }



            .div-right
            {
                text-align:right;
            }

            .navbar-nav li a {
    line-height: 50%;
    height: 50%;
    padding-top: 0;
}
            .color-blue-14
            {
                color:#000066;
                font-size:20px;
                decoration:bold;
            }
            .color-white-20
            {
                color:white;
                background-color:#007399;
                font-size:25px;
                decoration:bold;
                font-family: verdana, Arial;

            }

            .notifications
            {
                color:#000066;
                font-size:18px;
                decoration:bold;
                font-family: verdana, Arial;
                background-color: #f0f5f5;

            }

            .notifications-icon
            {
                color:red;
                font-size:18px;
                decoration:bold;
            }

            .notifications-inv
            {
                background-color:#000066;
                color:white;
                font-size:18px;
                decoration:bold;
                font-family: verdana, Arial;
            }

            .font-black
            {
                color:black;
            }
            .font-red
            {
                color:red;
            }

            .font-riscado
            {
                text-decoration: line-through;
            }

            .btn-notif {
                background-color: #f0f5f5;
                border: 2px;
                color: black;
                padding: 0px 0px;
                font-size: 16px;
                cursor: pointer;
            }

            .font-20-red-white
            {
                background-color:red;
                color:white;
                decoration:bold;
                font-size:20px;

            }

            #preloader{
                background:#f2f2f2 url( "https://www.siriussystem.com.br/assets/img/preloader.gif") no-repeat center center;
                height:100vh;
                width:100%;
                background-size:15%;
                position: fixed;
                z-index:90000;
                opacity: 0.5;
            }

        </style>

        @yield('scripttop')

    </head>
    <!-- END HEAD -->
    <div id="preloader">

    </div>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="{{route('dashboard.comercial.panorama')}}">
                        <img src="{{asset('/layouts/layout/img/logo.png')}}" alt="logo" class="logo-default" /> </a>
                    <div class="menu-toggler sidebar-toggler"id="sirius-menu">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN PAGE ACTIONS -->
                <!-- DOC: Remove "hide" class to enable the page header actions -->
                <div class="page-actions" id="menu-acoes">
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning btn-circle  dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-plus"></i>&nbsp;
                            <span class="hidden-sm hidden-xs">Atalhos</span>&nbsp;
                            <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                @php
                                   $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'CriarAtendimento', 'Criar Novo Atendimento', 'CRM', 'Atendimento','S', 'I', 'Botão');
                                @endphp

                            <li class="{{$acesso}}">

                                <a href="javascript:iniciarNovoAtendimento()" >
                                <i class="fas fa-headset"></i> Novo Atendimento</a>
                            </li>

                            @php
                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Imovel', 'Imóveis(Acessar/Incluir/alterar/excluir)', 'CRM', 'Imóveis','S', 'I', 'Botão')
                            @endphp

                            <li class="{{$acesso}}">
                                <a href="{{route('imovel.add')}}"  target="_blank">
                                <i class="fas fa-warehouse"></i> Novo Imóvel </a>
                            </li>

                            @php
                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Condominios', 'Cadastro de Condomínios', 'CRM', 'Condomínios','S', 'X', 'Botão');
                            @endphp
                            <li class="{{$acesso}}">

                                <a href="{{route('condominio.index')}}">
                                <i class="fas fa-building"></i> Novo Condomínio </a>
                            </li>

                            @php
                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Clientes', 'Clientes', 'CRM', 'Clientes','S', 'I', 'Botão');
                            @endphp
                            <li class="{{$acesso}}">
                                <a href="{{route('cliente.add')}}"  target="_blank">
                                <i class="fas fa-building"></i> Novo Cliente </a>
                            </li>

                            @php
                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'verLeads', 'Consultar Leads', 'CRM', 'Leads','S', 'X', 'Botão');
                            @endphp
                            <li class="{{$acesso}}">
                                <a href="javascript:verLeads();">
                                    <i class='fas fa-headset'></i> Capturar Leads
                                </a>
                            </li>


                            <li><hr></li>
                            @php
                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( '
                                ', 'Contratos de Locação', 'ADM', 'Contratos','S', 'X', 'Botão');
                            @endphp
                            <li class="{{$acesso}}">
                                <a class="ultimolt" href="{{route('contrato.index')}}" target="_blank">
                                <i class="fa fa-tags"></i><b> Gerenciador de Contratos</b>
                                </a>
                            </li>

                            @php
                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Clientes', 'Clientes', 'CRM', 'Clientes','S', 'X', 'Botão');
                            @endphp
                            <li class="{{$acesso}}">
                                <a class="ultimolt" href="{{route('cliente.index')}}" target="_blank">
                                <i class="fa fa-tags"></i><b> Clientes</b>
                                </a>
                            </li>
                            @php
                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Imovel', 'Imóveis(Acessar/Incluir/alterar/excluir)', 'CRM', 'Imóveis','S', 'X', 'Botão')
                            @endphp
                            <li class="{{$acesso}}">
                                <a class="ultimolt" href="{{route('imovel.index')}}" target="_blank">
                                <i class="fa fa-tags"></i><b> Imóveis</b>
                                </a>
                            </li>
                            @php
                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'CobrancaBancaria', 'Cobrança Bancária', 'ADM', 'Cobrança Bancária','S', 'X', 'Botão');
                            @endphp
                            <li class="{{$acesso}}">
                            <a class="ultimolt" href="{{route('cobranca.index')}}" target="_blank">
                                <i class="fa fa-barcode"></i> <b> Cobrança Bancária</b>
                                </a>
                            </li>
                            <li>
                                <a class="ultimolt" href="{{route('menuadm')}}" target="_blank">
                                <i class="fa fa-navicon"></i> <b> Menu Geral</b>
                                </a>
                            </li>
                            <li>
                                <a class="ultimolt" href="{{route('admimoveis.relatorios')}}" target="_blank">
                                <i class="fa fa-navicon"></i> <b> Menu de Relatórios</b>
                                </a>
                            </li>
                            <li>
                                <a class="ultimolt" href="{{route('boleto.painelenviadosindex')}}" target="_blank">
                                <i class="fa fa-navicon"></i> <b> Painel Boletos Enviados por Email</b>
                                </a>
                            </li>

                            <li><hr></li>
                            @php
                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'DashboardAdm', 'Dashboard Adm Imóveis', 'ADM', 'Dashboards','S', 'X', 'Botão');
                            @endphp
                            <li class="{{$acesso}}">
                                <a class="ultimolt" href="{{route('estatistica.admimovel')}}" target="_blank">
                                <i class="fa fa-bar-chart" aria-hidden="true"></i><b>Dashboard Adm. Imóveis</b>
                                </a>
                            </li>
                            @php
                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'DashboardCRM', 'Dashboard CRM', 'CRM', 'Dashboards','S', 'X', 'Botão');
                            @endphp
                            <li class="{{$acesso}}">
                                <a class="ultimolt" href="{{route('estatistica.crm')}}" target="_blank">
                                <i class="fa fa-bar-chart" aria-hidden="true"></i><b>Dashboard CRM</b>

                                </a>
                            </li>
                            <li><hr></li>
                            @php
                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Solicitações', 'Solicitações', 'GERAL', 'Solicitações','S', 'X', 'Botão');
                            @endphp
                            <li class="{{$acesso}}">
                                <a class="ultimolt" href="{{route('solicitacoes.index')}}" target="_blank">
                                <i class="fas fa-phone"></i><b>Chamados</b>
                                </a>
                            </li>

                            <li>
                                <a class="ultimolt" href="{{route('videostreinamentos.index')}}" target="_blank">
                                <i class="fas fa-eye"></i><b> Videos Treinamento</b>
                                </a>
                            </li>


                        </ul>
                        &nbsp;
                             &nbsp;
                             @php
                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'PesquisaRapida', 'Pesquisas Rápidas', 'GERAL', 'Pesquisas','S', 'X', 'Botão');
                            @endphp
                            <select class="select-pesquisar {{$acesso}}" id="i-select-pesquisa">
                                <option value="0">Tipo Pesquisa</option>
                                <option value="1">Imóveis</option>
                                <option value="2">Interessado</option>
                                <option value="3">Proprietário</option>
                                <option value="4">Locatário</option>
                                <option value="5">Fiador</option>

                            </select>


                    </div>
                </div>
                <!-- END PAGE ACTIONS -->
                <!-- BEGIN PAGE TOP -->
                <div class="page-top" id="page-topo">
                    <!-- BEGIN HEADER SEARCH BOX -->
                    <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
                    <form class="search-form " onsubmit="return false;">
                        <div class="input-group">
                            <input type="text" class="form-control" id="i-campo-pesquisar"
                            placeholder="Digite....">
                            <span class="input-group-btn">
                                <button class="btn btn-warning" id="btn-pesquisar">Pesquisar</button>
                            </span>
                        </div>
                    </form>
                    <!-- END HEADER SEARCH BOX -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                    <input type="hidden" id="I-IMB_CTR_ID">
                        <input type="hidden" id="I-IMB_IMV_ID">
                        <input type="hidden" id="i-codigocliente">
                        <input type="hidden" value = "{{Auth::User()->IMB_ATD_SOMENTECOMERCIAL}}" id="I-IMB_ATD_SOMENTECOMERCIAL">
                        <input type="hidden" value = "{{Auth::User()->IMB_ATD_CLIENTE}}" id="I-IMB_ATD_CLIENTE">
                        <input type="hidden" value = "{{Auth::User()->VIS_AGE_ID}}" id="I-IMB_IMB_IDAGENCIA">
                        <input type="hidden" value = "{{Auth::User()->imb_imb_id2}}" id="I-IMB_IMB_ID2">
                        <input type="hidden" value = "{{Auth::User()->IMB_IMB_ID}}" id="I-IMB_IMB_IDMASTER">
                        <input type="hidden" value = "{{Auth::User()->IMB_IMB_ID}}" id="I-IMB_IMB_ID">

                        @php
                            $parametros2 = app('App\Http\Controllers\ctrRotinas')->parametros2( Auth::User()->IMB_IMB_ID );
                            $contarepassepadrao = '';
                            $formaerpassepadrao ='';
                            if( $parametros2 <> '')
                            {
                                $contarepassepadrao = $parametros2->FIN_CCX_ID_PADRAO_REP;
                                $formaerpassepadrao =$parametros2->IMB_FORPAG_IDLOCADOR;
                            }

                        @endphp

                        <input type="hidden"  id="i-imovelpesquisa">
                        <input type="hidden"  id="i-cfcpesquisa">
                        <input type="hidden"  id="i-cfcdescricaopesquisa">
                        <input type="hidden"  id="i-subcontapesquisa">
                        <input type="hidden"  id="i-subcontadescricaopesquisa">
                        <input type="hidden"  id="i-contarepassepadrao" value="{{$contarepassepadrao}}">
                        <input type="hidden"  id="i-formarepassepadrao" value="{{$formaerpassepadrao}}">

                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after "dropdown-extended" to change the dropdown styte -->
                            <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                            <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->

                            <!-- END TODO DROPDOWN -->
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-bell" style="color:red"></i>
                                    <span class="badge badge-default" id="i-notificacoes" title="Novas Notificações"></span>
                                </a>
                                <ul class="dropdown-menu notifications">
                                    <li id="i-alert-notificacoes">
                                        <h3 class="div-center font-20-red-white">Notificações
                                            </h3>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                            <li id="li-novosimoveis" class="btn-notif">
                                                @php
                                                    $novosim = app( 'App\Http\Controllers\ctrImoveisNotificacoes')->novosImoveisQtd();

                                                @endphp
                                                <span >
                                                    <span class="notifications btn-notif">
                                                    <i class="fa fa-home notifications-icon" aria-hidden="true"></i>
                                                    <span class="notifications-inv div-right" id="i-novosimoveis"> {{$novosim}} </span>
                                                    <a href="javascript:mostrarNovosImoveis()">
                                                    Novos Imóveis</a>
                                                    </span>
                                                </span>
                                                <hr>
                                            </li>
                                            <li id="li-novosatendimentos" class="btn-notif">
                                                @php
                                                    $novosim = app( 'App\Http\Controllers\ctrImoveisNotificacoes')->novosImoveisQtd();

                                                @endphp
                                                <span >
                                                    <span class="notifications btn-notif">
                                                    <i class="fa fa-headset notifications-icon" aria-hidden="true"></i>
                                                    <span class="notifications-inv div-right" id="i-novosatendimentos"> </span>
                                                    <a href="javascript:mostrarModalAtm();">
                                                    Novos Atendimentos</a>
                                                    </span>
                                                </span>
                                                <hr>
                                            </li>
                                            <li id="li-novosclientes" class="btn-notif">
                                                <span >
                                                    @php

                                                    $novosclientes = app('App\Http\Controllers\ctrClienteNotificacoes')->novosClientesQtd();

                                                    @endphp
                                                    <span class="notifications btn-notif">
                                                    <i class="fa fa-user notifications-icon" aria-hidden="true"></i>
                                                    <span class="notifications-inv" id="i-novosclientes">{{$novosclientes}} </span>
                                                    <a href="javascript:mostrarNovosClientes()">
                                                        Novos Clientes</a>
                                                    </span>
                                                </span>
                                            </li>

                                            <hr>
                                            <li id="li-novosclientes" class="btn-notif">
                                                <span >
                                                    <span class="notifications btn-notif">
                                                    <i class="fa fa-user notifications-icon" aria-hidden="true"></i>
                                                    @php
                                                        $chamados = app('App\Http\Controllers\ctrSolicitacoes')->countPendentes();
                                                    @endphp

                                                    <span class="notifications-inv" id="i-avisoscontrato" >{{$chamados}} </span>
                                                    <a href="javascript:mostrarSolicitacoesAberto()">
                                                    Chamados em Aberto</a>
                                                    </span>
                                                </span>
                                            </li>
                                            <hr>
                                            <li id="li-novosclientes" class="btn-notif">
                                                @php
                                                    $reajustes = app('App\Http\Controllers\ctrRotinas')->reajustesAtrasadosCount();
                                                @endphp
                                                <span >
                                                    <span class="notifications btn-notif">
                                                    <i class="fa fa-user notifications-icon" aria-hidden="true"></i>
                                                    <span class="notifications-inv" id="i-reajustes">{{$reajustes}} </span>
                                                    <a href="{{route('reajustar.index') }}">
                                                    Contratos sem Reajustar</a>
                                                    </span>
                                                </span>
                                            </li>

                                            <hr>
                                            <li id="li-novosclientes" class="btn-notif">
                                                @php
                                                    $atrasados = app('App\Http\Controllers\ctrRotinas')->aluguelAtrasadosCount();
                                                @endphp
                                                <span >
                                                    <span class="notifications btn-notif">
                                                    <i class="fa fa-user notifications-icon" aria-hidden="true"></i>
                                                    <span class="notifications-inv" id="i-atrasados">{{$atrasados}} </span>
                                                    <a href="{{route('inadimplentes')}}">
                                                    Aluguéres em Atraso</a>
                                                    </span>
                                                </span>
                                            </li>

                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!-- END NOTIFICATION DROPDOWN -->
                            <!-- BEGIN INBOX DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

                            <!-- END INBOX DROPDOWN -->
                            <!-- BEGIN TODO DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">
                                <a title="Leads capturado pelo site da imobiliária" href="javascript:verLeads()" class="dropdown-toggle" >
                                    <i class="icon-leads fa fa-heart"style="color:red"></i>
                                    <span class="badge badge-default" id="i-notifleads"></span>
                                </a>
                                
                            </li>
                            <li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">

                                @php
                                $req = app('App\Http\Controllers\ctrRotinas')->instanciarRequest();
                                $req->semjson = 'S';
                                $qtd=app('App\Http\Controllers\ctrCobrancaGerada')->boletosVencendoQtde( $req ) ;
                                @endphp

                                                              
                                <a title="Temos {{$qtd}} vencendo hoje." href="javascript:cargaBoletosVecendo()" class="dropdown-toggle" >
                                    <i class="icon-boleto fa fa-barcode" style="color:black"></i>
                                    <span class="badge badge-default" id="i-boletosvencendo"></span>
                                </a>
                                </li>
                            <li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">
                                <a title="Mensagens capturadas no Whatsapp" href="{{route('whatsapp.index')}}" class="dropdown-toggle" data-close-others="true">
                                    <i id="i-ws" class="fa fa-whatsapp" aria-hidden="true" style="color:green"></i>        
                                    <span class="badge badge-default" title="Mensagens WhatsApp"></span>
                                </a>
                            </li>

                            @php
                                $novoschamados = app( 'App\Http\Controllers\ctrSolicitacoes')->chamadosNovosPraMimQtde();
                                if( $novoschamados == 0 ) 
                                {
                                    $novoschamados  = '';
                                    $title='Você não tem novos chamados ou solictições direcionados para você';
                                }
                                else
                                {
                                    if( $novoschamados == 1)
                                        $title="Você tem ".$novoschamados." novo chamados direcionado pra você.";
                                    else
                                        $title="Você tem ".$novoschamados." novos chamados direcionados pra você.";
                                }
                            @endphp
                            <li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">
                                <a title="{{$title}}" href="javascript:chamados()" class="dropdown-toggle" >
                                    <b> <i class="fa fa-toolbox" style="color:orange"></i></b>

                                    <span class="badge badge-default" id="i-chamados">{{$novoschamados}}</span>
                                </a>
                            </li>
                                                        
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="img-circle" src="{{url('')}}/storage/images/{{Auth::user()->IMB_IMB_ID}}/usuarios/avatar{{Auth::user()->IMB_ATD_ID}}.jpg"/>
                                    <span class="username username-hide-on-mobile">{{ substr(Auth::user()->IMB_ATD_NOME,0,12)}}... </span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="javascript:meusDados()">
                                            <i class="icon-user"></i> Meus Dados </a>
                                    </li>
                                    <li>
                                        <a href="{{route('calendar.index')}}">
                                            <i class="icon-calendar"></i> Agenda </a>
                                    </li>
                                    <li>
                                        <a href="{{env('APP_EMAIL_SISTEMA')}}">
                                            <i class="icon-envelope-open"></i> Email
                                            
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-rocket"></i> Minhas Tarefas
                                            <span class="badge badge-success"></span>
                                        </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="{{ route( 'logout' ) }}">
                                            <i class="icon-key"></i> Sair </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            </li>
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->


            <div class="page-sidebar-wrapper " id="div-nav-comercial">
                <!-- END SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        <li class="nav-item start ">

                            <li class="nav-item">
                                <a href="{{route('menuadm')}}">
                                    <img src="{{asset('global/img/menugeral.png')}}" alt="">
                                    <span class="title"><b>Menu Geral</b></span>
<!--                                    <span class="arrow"></span>-->
                                </a>
                            </li>

                            <li class="nav-item  ">

                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <img src="{{asset( '/layouts/layout/img/icon-house-homeid.png')}}" alt="">
                                    <span class="title"><b>Imóveis</b></span>
<!--                                    <span class="arrow"></span>-->
                                </a>

                                <ul class="sub-menu {{$acesso}}">
                                    @php
                                        $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Imovel', 'Imóveis(Acessar/Incluir/alterar/excluir)', 'CRM', 'Imóveis','S', 'X', 'Botão')
                                    @endphp

                                    <li class="nav-item {{$acesso}}">
                                        <a href="{{route('imovel.index')}}" class="nav-link">
                                        <img src="{{asset( '/layouts/layout/img/icon-house-homeid-20.png')}}" alt="">
                                        <span class="title"> Imóveis</span>
                                        </a>
                                    </li>
                                    
                                    @php
                                        $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Condominios', 'Cadastro de Condomínios', 'CRM', 'Condomínios','S', 'X', 'Botão');
                                    @endphp
                                    <li class="nav-item  {{$acesso}}">
                                        <a href="{{route('condominio.index')}}" class="nav-link ">
                                        <img src="{{asset( '/layouts/layout/img/icon-house-homeid-20.png')}}" alt="">
                                            <span class="title"> Condom./Empreend.</span>
                                        </a>
                                    </li>
                                    @php
                                        $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ControlChaves', 'Controle de Chaves', 'CRM', 'Controle de Chaves','S', 'X', 'Botão');
                                    @endphp
                                    <li class="nav-item  {{$acesso}}">
                                        <a href="{{route('chaves')}}" class="nav-link ">
                                        <img src="{{asset( '/layouts/layout/img/icon-house-homeid-20.png')}}" alt="">
                                            <span class="title">Controle de Chaves</span>
                                        </a>
                                    </li>
                                    @php
                                        $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Propostas', 'Propostas', 'CRM', 'Propostas','S', 'X', 'Botão');
                                    @endphp
                                    <li class="nav-item  {{$acesso}}">
                                        <a href="#" class="nav-link ">
                                        <img src="{{asset( '/layouts/layout/img/icon-house-homeid-20.png')}}" alt="">
                                            <span class="title">Propostas</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admimoveis.relatorios')}}" class="nav-link">
                                        <img src="{{asset( '/layouts/layout/img/icon-aaaa-reports-homeid-20.png')}}" alt="">
                                        <span class="title"> Relatórios</span>
                                        </a>
                                        <ul class="sub-menu">
                                            @php
                                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Relatorios', 'Relatório Imóveis x Proprietários', 'CRM', 'Relatórios Imóveis','S', 'X', 'Botão');
                                            @endphp

                                            <li class="nav-item {{$acesso}}" id="i-relatorioimoveisprop">
                                                <a href="{{route('rel.imovel.proprietarios')}}" class="nav-link ">Relatórios Imóveis/Prop.</a>
                                            </li>

                                            @php
                                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Relatorios', 'Relatório Geral de Imóveis', 'CRM', 'Relatórios Imóveis','S', 'X', 'Botão');
                                            @endphp
                                            <li class="nav-item  {{$acesso}}">
                                                <a href="{{route('rel.imovel.geral')}}" class="nav-link ">Relatório Geral Imóveis</a>
                                            </li>

                                            @php
                                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'RelAvisoDesocupacao', 'Relatório Aviso Desocupação', 'CRM', 'Relatórios Contratos','S', 'X', 'Botão');
                                            @endphp
                                            <li class="nav-item  {{$acesso}}">
                                                <a href="#" class="nav-link "> Com Aviso de Desocupação </a>
                                            </li>

                                            @php
                                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'RelINscricoesImoveis', 'Relatório Imóveis e Incrições IPTU/ENERGIA/ETC.', 'ADM', 'Relatórios Imóveis','S', 'X', 'Botão');
                                            @endphp
                                            <li class="nav-item  {{$acesso}}">
                                                <a href="#" class="nav-link "> Com Nº Inscrição IPTU </a>
                                            </li>

                                            @php
                                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'DemoLocador', 'Demonstrativo/Extrado Locador', 'ADM', 'Informes','S', 'X', 'Botão');
                                            @endphp
                                            <li class="nav-item  {{$acesso}}">
                                                <a href="#" class="nav-link "> Demonstrativo Locador</a>
                                            </li>

                                            @php
                                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'InformeIRRFLocador', 'Informe IRRF Locador', 'ADM', 'Informes','S', 'X', 'Botão');
                                            @endphp
                                            <li class="nav-item  {{$acesso}}">
                                                <a href="#" class="nav-link "> Informe IRRF</a>
                                            </li>

                                            @php
                                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'RelPrevRepasse', 'Relatório Previsão Repasses', 'ADM', 'Relatórios Contratos','S', 'X', 'Botão');
                                            @endphp
                                            <li class="nav-item  {{$acesso}}">
                                                <a href="{{route('relatorioprevisaorepasse')}}" class="nav-link "> Previsão Pagamento</a>
                                            </li>
                                            @php
                                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'RelContatosClientes', 'Relatório de Contato dos Clientes', 'CRM', 'Relatórios Clientes','S', 'X', 'Botão');
                                            @endphp
                                            <li class="nav-item  {{$acesso}}">
                                                <a href="#" class="nav-link "> Email/Fone Clientes</a>
                                            </li>


                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item" id="li-contratos">
                                <a href="#" class="nav-link nav-toggle">
                                    <img src="{{asset( '/layouts/layout/img/icon-aaaaaa-contatoshomeid.png')}}" alt="">
                                    <span class="title"><b>Administração de Imóveis</b></span>
<!--                                    <span class="arrow"></span>-->
                                </a>

                                <ul class="sub-menu">
                                    @php
                                        $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Contratos', 'Contratos de Locação', 'ADM', 'Contratos','S', 'X', 'Botão');
                                    @endphp
                                    <li class="nav-item {{$acesso}}">
                                        <a href="{{route('contrato.index')}}" class="nav-link">
                                        <img src="{{asset( '/layouts/layout/img/icon-aaaa-reports-homeid-20.png')}}" alt="">
                                        <span class="title"> <b>Gerenc. Contratos</b></span>
                                        </a>
                                    </li>
                                    @php
                                        $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'CobrancaBancaria', 'Cobrança Bancária', 'ADM', 'Cobrança Bancária','S', 'X', 'Botão');
                                    @endphp
                                    <li class="nav-item {{$acesso}}">
                                        <a href="{{route('cobranca.index')}}" class="nav-link"  target="_blank">
                                            <img src="{{asset( '/layouts/layout/img/icon_boletos20.png')}}" alt="">
                                        <span class="title"> Cobrança Bancária</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                        <img src="{{asset( '/layouts/layout/img/icon-aaaa-tabelaauxiliares.png')}}" alt="">
                                        <span class="title"> Tabelas Auxiliares</span>
                                        </a>
                                        <ul class="sub-menu">
                                            @php
                                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'TipoNegocio', 'Tipo de Negócio', 'CRM', 'Tabelas Auxiliares','S', 'X', 'Botão');
                                            @endphp

                                            <li class="nav-item {{$acesso}}">
                                            <a href="{{route('tiponegocio')}}" class="nav-link"  target="_blank">
                                                <img src="{{asset( '/layouts/layout/img/icon-aaaa-tabelaauxiliares.png')}}" alt="">
                                                    <span class="title">Tipos de Negócios                                                </span>
                                                </a>
                                            </li>                                            

                                            @php
                                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Feriados', 'Feriados Gerais', 'GERAL', 'Tabelas Auxiliares','S', 'X', 'Botão');
                                            @endphp
                                            <li class="nav-item {{$acesso}}">
                                            <a href="{{route('feriados.feriadosindex')}}" class="nav-link"  target="_blank">
                                                <img src="{{asset( '/layouts/layout/img/icon-aaaa-tabelaauxiliares.png')}}" alt="">
                                                    <span class="title">Feriados Gerais                                                </span>
                                                </a>
                                            </li>

                                            @php
                                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'FormaPagamento', 'Formas de Pagamento/Recebimento', 'ADM', 'Tabelas Auxiliares','S', 'X', 'Botão');
                                            @endphp
                                            <li class="nav-item {{$acesso}}">
                                            <a href="{{route('formasdepagamento')}}" class="nav-link"  target="_blank">
                                                <img src="{{asset( '/layouts/layout/img/icon-aaaa-tabelaauxiliares.png')}}" alt="">
                                                    <span class="title">Formas de Pagamento                                                </span>
                                                </a>
                                            </li>
                                            @php
                                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'IndiceReajuste', 'Índices de Reajustes', 'ADM', 'Tabelas Auxiliares','S', 'X', 'Botão');
                                            @endphp
                                            <li class="nav-item {{$acesso}}">
                                            <a href="{{route('indicereajuste.index')}}/0" class="nav-link"  target="_blank">
                                                <img src="{{asset( '/layouts/layout/img/icon-aaaa-tabelaauxiliares.png')}}" alt="">
                                                    <span class="title">Índices de Reajuste                                                </span>
                                                </a>
                                            </li>
                                            @php
                                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'MotivosRescisão', 'Motivos Recisão', 'ADM', 'Tabelas Auxiliares','S', 'X', 'Botão');
                                            @endphp
                                            <li class="nav-item {{$acesso}}">
                                            <a href="#" class="nav-link"  target="_blank">
                                                <img src="{{asset( '/layouts/layout/img/icon-aaaa-tabelaauxiliares.png')}}" alt="">
                                                    <span class="title">Motivos de Rescisão                                                </span>
                                                </a>
                                            </li>
                                            @php
                                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'RedeBancária', 'Rede Bancária', 'ADM', 'Tabelas Auxiliares','S', 'X', 'Botão');
                                            @endphp
                                            <li class="nav-item {{$acesso}}">
                                            <a href="#" class="nav-link"  target="_blank">
                                                <img src="{{asset( '/layouts/layout/img/icon-aaaa-tabelaauxiliares.png')}}" alt="">
                                                    <span class="title">Rede Bancária                                                </span>
                                                </a>
                                            </li>
                                            @php
                                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'RamoAtividade', 'Ramos de Atividades', 'CRM', 'Tabelas Auxiliares','S', 'X', 'Botão');
                                            @endphp
                                            <li class="nav-item {{$acesso}}">
                                            <a href="#" class="nav-link"  target="_blank">
                                                <img src="{{asset( '/layouts/layout/img/icon-aaaa-tabelaauxiliares.png')}}" alt="">
                                                    <span class="title">Ramos de Atividade</span>
                                                </a>
                                            </li>
                                            @php
                                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'TabelaMulta', 'Tabela de Multa', 'ADM', 'Tabelas Auxiliares','S', 'X', 'Botão');
                                            @endphp
                                            <li class="nav-item {{$acesso}} nav-item" id="i-lancamentos-nav">
                                            <a href="#" class="nav-link"  target="_blank">
                                                <img src="{{asset( '/layouts/layout/img/icon-aaaa-tabelaauxiliares.png')}}" alt="">
                                                    <span class="title">Tabela de Multas</span>
                                                </a>
                                            </li>
                                            @php
                                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'TabelaEvento', 'Tabela de Eventos', 'ADM', 'Tabelas Auxiliares','S', 'X', 'Botão');
                                            @endphp
                                            <li class="nav-item {{$acesso}} nav-item" >
                                            <a href="{{route('tabelaeventos.index')}}" class="nav-link"  target="_blank">
                                                <img src="{{asset( '/layouts/layout/img/icon-aaaa-tabelaauxiliares.png')}}" alt="">
                                                    <span class="title">Tabela de Eventos</span>
                                                </a>
                                            </li>
                                            @php
                                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'TabelaIRRF', 'Tabela de IRRF', 'ADM', 'Tabelas Auxiliares','S', 'X', 'Botão');
                                            @endphp
                                            <li class="nav-item {{$acesso}} nav-item" >
                                            <a href="{{route('tabelairrf.index')}}" class="nav-link"  target="_blank">
                                                <img src="{{asset( '/layouts/layout/img/icon-aaaa-tabelaauxiliares.png')}}" alt="">
                                                    <span class="title">Tabela de IRRF</span>
                                                </a>
                                            </li>
                                            @php
                                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'TiposClientes', 'Tipos de Clientes', 'CRM', 'Tabelas Auxiliares','S', 'X', 'Botão');
                                            @endphp
                                            <li class="nav-item {{$acesso}} nav-item" >
                                            <a href="#" class="nav-link"  target="_blank">
                                                <img src="{{asset( '/layouts/layout/img/icon-aaaa-tabelaauxiliares.png')}}" alt="">
                                                    <span class="title">Tipos de Clientes</span>
                                                </a>
                                            </li>
                                            @php
                                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'TiposFuncionarios', 'Tipos de Funcionários', 'GERAL', 'Tabelas Auxiliares','S', 'X', 'Botão');
                                            @endphp
                                            <li class="nav-item {{$acesso}} nav-item" >
                                            <a href="#" class="nav-link"  target="_blank">
                                                <img src="{{asset( '/layouts/layout/img/icon-aaaa-tabelaauxiliares.png')}}" alt="">
                                                    <span class="title">Tipos de Funcionários</span>
                                                </a>
                                            </li>
                                            @php
                                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'TiposDocPessoais', 'Tipos de Doctos Pessoais', 'GERAL', 'Tabelas Auxiliares','S', 'X', 'Botão');
                                            @endphp
                                            <li class="nav-item {{$acesso}} nav-item" >
                                            <a href="{{route('tipodocpessoal.index')}}" class="nav-link"  target="_blank">
                                                <img src="{{asset( '/layouts/layout/img/icon-aaaa-tabelaauxiliares.png')}}" alt="">
                                                    <span class="title">Tipos de Docto Pessoais</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                <img src="{{asset( '/layouts/layout/img/icon-customers-homeid.png')}}" alt="">
                                   <span class="title"><b>Clientes</b></span>
                                </a>
                                <ul class="sub-menu">
                                    @php
                                        $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Clientes', 'Clientes', 'CRM', 'Clientes','S', 'X', 'Botão');
                                    @endphp
                                    <li class="{{$acesso}}">
                                        <a href="{{route('cliente.index')}}" class="nav-link ">
                                        <img src="{{asset( '/layouts/layout/img/icon-customers-homeid-20.png')}}" alt="">
                                            <span class="title">Consultar Clientes
                                        </span>
                                        </a>
                                    </li>
                                    @php
                                        $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'verLeads', 'Consultar Leads', 'CRM', 'Leads','S', 'X', 'Botão');
                                    @endphp
                                    <li class="{{$acesso}}">
                                        <a href="javascript:verLeads();" class="nav-link ">
                                        <img src="{{asset( '/layouts/layout/img/icon-customers-homeid-20.png')}}" alt="">
                                           <span class="title">Leads</span>
                                        </a>
                                    </li>
                                    @php
                                       $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Atendimentos', 'Atendimentos', 'CRM', 'Atendimento','S', 'X', 'Botão');
                                    @endphp

                                    <li class="{{$acesso}}">
                                        <a href="{{route('atendimento')}}" class="nav-link ">
                                        <img src="{{asset( '/layouts/layout/img/icon-customers-homeid-20.png')}}" alt="">
                                            <span class="title">Atendimentos</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>


                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">

                                <img src="{{asset( '/layouts/layout/img/icon-aaaaaa-financeirohomeid.png')}}" alt="">
                                    <span class="title"><b>Financeiro</b></span>
<!--                                    <span class="arrow"></span>-->
                                </a>
                                <ul class="sub-menu">
                                    @php
                                       $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'BancosCaixa', 'Tesouraria Bancos/Caixa', 'FIN', 'Tesouraria - Bancos/Caixa','S', 'X', 'Botão');
                                    @endphp
                                    <li class="{{$acesso}}">
                                        <a href="{{route('caixa.menu')}}" class="nav-link">
                                            <img src="{{asset( '/layouts/layout/img/icon-aaaaaa-financeirohomeid-20.png')}}" alt="">
                                            <span class="title"> Bancos/Caixa</span>
                                        </a>
                                    </li>
                                    @php
                                       $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ContasPagar', 'Contas a Pagar', 'FIN', 'Contas a Pagar','S', 'X', 'Botão');
                                    @endphp
                                    <li class="{{$acesso}}">
                                        <a href="{{ route('contasapagar') }}" class="nav-link">
                                            <img src="{{asset( '/layouts/layout/img/icon-aaaaaa-financeirohomeid-20.png')}}" alt="">
                                            <span class="title"> Contas a Pagar</span>
                                        </a>
                                    </li>
                                    @php
                                       $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'BancosCaixa', 'Tesouraria Bancos/Caixa', 'FIN', 'Tesouraria - Bancos/Caixa','S', 'X', 'Botão');
                                    @endphp
                                    <li class="{{$acesso}}">
                                        <a href="{{route('caixa.menu')}}" class="nav-link">
                                            <img src="{{asset( '/layouts/layout/img/icon-aaaaaa-financeirohomeid-20.png')}}" alt="">
                                            <span class="title"> Bancos/Caixa</span>
                                        </a>
                                    </li>
                                    @php
                                       $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Fornecedores', 'Fornecedores', 'FIN', 'Fornecedores','S', 'X', 'Botão');
                                    @endphp
                                    <li class="{{$acesso}}">
                                        <a href="{{ route('fornecedores.index') }}" class="nav-link">
                                            <img src="{{asset( '/layouts/layout/img/icon-aaaaaa-financeirohomeid-20.png')}}" alt="">
                                            <span class="title"> Fornecedores</span>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:;" class="nav-link nav-toggle">

                                <img src="{{asset( '/layouts/layout/img/icon-aaaaa-vistoria.png')}}" alt="">
                                    <span class="title"><b>Área de Vistorias</b></span>
<!--                                    <span class="arrow"></span>-->
                                </a>
                                <ul class="sub-menu">
                                        @php
                                            $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'PainelVistorias', 'Painel de Vistorias', 'ADM', 'Vistorias','S', 'X', 'Botão');
                                        @endphp
                                    <li class="{{$acesso}}">
                                        <a href="{{route('besoft.painel')}}" class="nav-link">
                                            <img src="{{asset( '/layouts/layout/img/icon-aaaaa-vistoria-20.png')}}" alt="">
                                            <span class="title"> Painel Vistoria</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
    


                                @php
                                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Agenda', 'Agenda', 'ADM', 'Agenda','S', 'X', 'Botão');
                                @endphp
                                <li class="{{$acesso}}">
                                <a href="{{route('calendar.index')}}" class="nav-link nav-toggle">
                                <img src="{{asset( '/layouts/layout/img/icon-agenda-homeid.png')}}" alt="">
                                <span class="title"><b>Agenda</b></span>
                                </a>
                            </li>
                            @php
                                $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'PortalAnuncio', 'Portais de Anúncio', 'CRM', 'Portais de Anúncios','S', 'X', 'Botão');
                            @endphp
                            <li class="{{$acesso}}">
                                <a href="{{route('portais')}}" class="nav-link nav-toggle">
                                <img src="{{asset( '/layouts/layout/img/icon-aa-portais-homeid.png')}}" alt="">
                                   <span class="title"><b>Portais de Anúncios</b></span>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <img src="{{asset( '/layouts/layout/img/icon-aaaa-documents-homeid.png')}}" alt="">
                                    <span class="title"><b>Documentos</b></span><!--                                    <span class="arrow"></span>-->
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="{{route('ficha.fichascaptacao')}}" class="nav-link nav-toggle">
                                            <img src="{{asset( '/layouts/layout/img/icon-aaaa-documents-homeid-20.png')}}" alt="">
                                            <span class="title">Captação de Imóvei</span>
                                            <span class="arrow"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{route('ficha.fichascaptacaoempreend')}}" class="nav-link nav-toggle">
                                            <img src="{{asset( '/layouts/layout/img/icon-aaaa-documents-homeid-20.png')}}" alt="">
                                            <span class="title">Captação de Empreendimentos</span>
                                            <span class="arrow"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{route('ficha.menupersonalizados')}}" class="nav-link nav-toggle">
                                            <img src="{{asset( '/layouts/layout/img/icon-aaaa-documents-homeid-20.png')}}" alt="">
                                            <span class="title">Documentos Personalizados</span>
                                            <span class="arrow"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{route('docsautomaticos.index')}}" class="nav-link nav-toggle">
                                            <img src="{{asset( '/layouts/layout/img/icon-aaaa-documents-homeid-20.png')}}" alt="">
                                            <span class="title">Documentos Automáticos</span>
                                            <span class="arrow"></span>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <img src="{{asset( '/layouts/layout/img/icon-aaaaa-settings-homeid.png')}}" alt="">
                                   <span class="title"><b>Configuração</b></span>
                                </a>
                                <ul class="sub-menu">
                                    @php
                                        $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Usuarios', 'Usuarios / Colaboradores', 'GERAL', 'Usuários / Colaboradores','S', 'X', 'Botão');
                                    @endphp
                                    <li class="{{$acesso}}">
                                        <a href="{{route('atendente.index')}}" class="nav-link nav-toggle">
                                            <img src="{{asset( '/layouts/layout/img/icon-aaaaa-settings-homeid-20.png')}}" alt="">
                                            <span class="title">Usuários</span>
                                            <span class="arrow"></span>
                                        </a>
                                    </li>
                                    @php
                                        $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ModulosRecursos', 'Módulos e Recursos', 'GERAL', 'Módulos e Recursos','S', 'X', 'Botão');
                                    @endphp
                                    <li class="{{$acesso}}">
                                            <a href="{{route('modulo.index')}}" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Gerenciamento dos Módulos</span>
                                            </a>
                                        </li>

                                    @php
                                        $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ParametrizacaoGeral', 'Parametrização Geral', 'GERAL', 'Parametrização Geral','S', 'X', 'Botão');
                                    @endphp
                                    <li class="{{$acesso}}">
                                        <a href="{{route('parametrizacao.index')}}" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Parametrização Geral</span>
                                        </a>
                                    </li>

                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <img src="{{asset( '/layouts/layout/img/icon-aaaaa-suporte-homeid.png')}}" alt="">
                                   <span class="title"><b>Suporte</b></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="javascript:;" class="nav-link nav-toggle">
                                            <img src="{{asset( '/layouts/layout/img/icon-aaaaa-suporte-homeid-20.png')}}" alt="">
                                            <span class="title">Whatsapp</span>
                                            <span class="arrow"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="javascript:;" class="nav-link nav-toggle">
                                            <img src="{{asset( '/layouts/layout/img/icon-aaaaa-suporte-homeid-20.png')}}" alt="">
                                            <span class="title">Abrir Chamado</span>
                                                <span class="arrow"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="javascript:;" class="nav-link nav-toggle">
                                            <img src="{{asset( '/layouts/layout/img/icon-aaaaa-suporte-homeid-20.png')}}" alt="">
                                            <span class="title">Enviar Email</span>
                                            <span class="arrow"></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        </li>


                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    @yield('content')
                    @include('layout.modalnovosimoveis')
                    @include('layout.modalnovosclientes')
                </div>
                <!-- END CONTENT BODY -->
            </div>




            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
            <a href="javascript:;" class="page-quick-sidebar-toggler">
                <i class="icon-login"></i>
            </a>
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <input type="hidden" id="i-email" value="{{Auth::user()->email}}">
            <input type="hidden" id="I-IMB_ATD_ID" value="{{Auth::user()->IMB_ATD_ID}}">
            <input type="hidden" id="i-idempresa" >
            <div class="page-footer-inner" id="i-empresa">Compdados Tecnologia
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>

<!-- END FOOTER -->
            <!-- BEGIN QUICK NAV -->
            <div class="quick-nav-overlay"></div>
            <!-- END QUICK NAV -->
            <!-- BEGIN CORE PLUGINS -->

        @include('layout.modalnotifcorretoratm')            
        @include('layout.modalboletosvencendohoje')            

        <script src="{{asset('/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>


        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{asset('/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{asset('/pages/scripts/form-samples.min.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="{{asset('/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/layouts/global/scripts/quick-nav.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')}}"></script>
        <script src="{{asset('global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('global/plugins/morris/raphael-min.js')}}" type="text/javascript"></script>
        <script src="{{asset('global/plugins/counterup/jquery.waypoints.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('global/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('global/plugins/amcharts/amcharts/amcharts.js')}}" type="text/javascript"></script>
        <script src="{{asset('global/plugins/amcharts/amcharts/serial.js')}}" type="text/javascript"></script>
        <script src="{{asset('global/plugins/amcharts/amcharts/pie.js')}}" type="text/javascript"></script>
        <script src="{{asset('global/plugins/amcharts/amcharts/radar.js')}}" type="text/javascript"></script>
        <script src="{{asset('/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/js/jquery.btechco.excelexport.js')}}"></script>
        <script src="{{asset('/js/jquery.base64.js')}}"></script>

             <script>
            $(document).ready(function()
            {
                
                $("#i-notificacoes").html('');


                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });

                $('#btn-pesquisar').click(function()
                {
                    pesquisar();

                });

                var loader = document.getElementById("preloader");
                window.addEventListener("load", function()
                {
                    loader.style.display="none";
                });

                verificarSeHaAtendimento();
                 verificarSeHaNovosLeads();



                $("#menu-acoes").show();
                $("#page-topo").show();

                window.addEventListener('offline', function(e) { alert( "Você pode estar sem conexão com a Internet!"); });

                $('#i-select-pesquisa').change(function()
                {

                    var opcao=$('#i-select-pesquisa').val();
                    if( opcao == '1' )
                    {
                        $('#i-campo-pesquisar').attr("placeholder", "Digite o endereço ou parte dele");
                    }else
                    if( opcao == '2' )
                    {
                        $('#i-campo-pesquisar').attr("placeholder", "Digite o nome do interessado ou parte dele");
                    }else
                    if( opcao == '3' )
                    {
                        $('#i-campo-pesquisar').attr("placeholder", "Digite o nome do proprietário ou parte dele");
                    };
                    if( opcao == '4' )
                    {
                        $('#i-campo-pesquisar').attr("placeholder", "Digite o nome do Locatário ou parte dele");
                    }; if( opcao == '4' )
                    {
                        $('#i-campo-pesquisar').attr("placeholder", "Digite o nome do Fiador ou parte dele");
                    };

                    // $(this).val() will work here
                });
                 $("#div-botoes-cliente").hide();

                $("#i-notificacoes").show();
                if( $("#i-notificacoes").html() == '' )
                {
                    $("#i-alert-novosimoveis").hide();
                    $("#i-notificacoes").html('');
                }
                else
                    $("#i-notificacoes").prop("title", $("#i-notificacoes").html()+" Novas Notificações");


                                        

                //mostrarSolicitacoes();                    
//                atendimentosAbertos();
                //atendimentosHoje();

            })


            function mostrarImobiliaria()
            {
                var url = "{{ route('pegarimobiliaria')}}/"+$("#I-IMB_IMB_IDMASTER").val();

//                    alert( $("#I-IMB_IMB_IDMASTER").val() );

                console.log( url );

                $.ajax({
                    url : url,
                    type : 'get',
                    dataType: 'json',
                    success : function( data )
                    {
                        $("#I-IMB_IMB_NOME").html( data.IMB_IMB_NOME+' - Código Cliente: '+data.IMB_IMB_ID ) ;
                    }
                });
            }

            function mostrarAgencia()
            {
                var url = "{{ route('pegaragencia')}}/"+$("#I-IMB_IMB_IDAGENCIA").val();

                console.log( url );

                $.ajax({
                    url : url,
                    type : 'get',
                    dataType: 'json',
                    success : function( data )
                    {
                        $("#I-IMB_IMB_NOME").html( data.IMB_IMB_NOME+' - Código Cliente: '+data.IMB_IMB_ID ) ;
                    }
                });
            }


	    </script>
        @stack('script')

        @hasSection('javascript')
            @yield('javascript')
        @endif



    <script type="text/javascript" src="{{asset('/js/funcoes.js')}}"></script>

    </body>


<script>

function atendimentosAbertos()
    {

        var id = $("#I-IMB_ATD_ID").val();
        var url = "{{ route('atendimento.abertos')}}/"+id;

        console.log( 'abertos '+url );
        $.ajax(
        {
            type: "get",
            url: url,
            context: this,
            //type:'json',
            success: function(data)
            {
                if( data != 0 )
                {
                    $("#i-atm-pendentes").html( data );
                    $("#i-atm-aberto").html( data );
                }
            }



        })
    }

    function atendimentosHoje()
    {

        var id = $("#I-IMB_ATD_ID").val();
        var url = "{{ route('atendimento.agenda.hoje')}}/"+id;
        $.ajax(
        {
            type: "get",
            url: url,
            context: this,
            //type:'json',
            success: function(data)
            {
                if( data != 0 )
                {
                    $("#i-atm-agendados-hoje").html( data );
                }
            }



        })
    }


    function atendimentosTodosAberto()
    {

        var id = $("#I-IMB_ATD_ID").val();
        var url = "{{ route('atendimento.list')}}";

        atm =
        {
            empresamaster : $("#I-IMB_IMB_IDMASTER").val(),
            todosemaberto : 'S',
            IMB_ATD_ID : $("#I-IMB_ATD_ID").val(),
        }

        $.ajax(
        {
            type: "get",
            url: url,
            context: this,
            data : atm,
            //type:'json',
            success: function(data)
            {
                console.log('voltou');
            }

        })
    }

    function meusDados()
    {
        window.location = "{{ route('atendente.edit') }}/" + $("#I-IMB_ATD_ID").val();


    }

    function agendamentos()
    {
        window.location = "{{ route('calendar.index') }}/"+$("#I-IMB_ATD_ID").val();

    }

    function pesquisar()
    {
        var opcao=$("#i-select-pesquisa").val();
        var texto=$("#i-campo-pesquisar").val();

        if ( $('#i-select-pesquisa').val()  == 1 )
        {

            var url =  "{{route('setarvarimovel')}}";

            var dado = { id : texto };

            $.ajax(
            {
                url         : url,
                type        : 'get',
                dataType    : 'json',
                data        : dado,
                success     : function( data )
                {
                    console.log( data );
                    window.location = "{{ route('imovel.index') }}";

                }
            });
        };


        if ( $('#i-select-pesquisa').val() == 2 )
        {

            var url =  "{{route('setarvarcliente')}}";

            var dado =  {   clientepesquisa : texto,
                            clientetipopesquisa:'I',
                            pesquisagenerica:texto,
                        };

            $.ajax(
            {
                url         : url,
                type        : 'get',
                dataType    : 'json',
                data        : dado,
                success     : function()
                {
                    window.location = "{{ route('cliente.index') }}";

                }
            });
        };

        if ( $('#i-select-pesquisa').val()  == 3 )
        {

            var url =  "{{route('setarvarcliente')}}";

            var dado =  {   clientepesquisa : texto,
                            clientetipopesquisa:'P',
                            tipopesquisa: opcao,
                            pesquisagenerica:texto,

                        };
            $.ajax(
            {
                url         : url,
                type        : 'get',
                dataType    : 'json',
                data        : dado,
                success     : function()
                {
                    window.location = "{{ route('cliente.index') }}";

                }
            });
        };

        if ( $('#i-select-pesquisa').val()  == 4 )
        {

            var url =  "{{route('setarvarcliente')}}";

            var dado =  {   clientepesquisa : texto,
                            clientetipopesquisa:'LT',
                            tipopesquisa: opcao,
                            pesquisagenerica:texto,

                        };
            $.ajax(
            {
                url         : url,
                type        : 'get',
                dataType    : 'json',
                data        : dado,
                success     : function()
                {
                    window.location = "{{ route('cliente.index') }}";

                }
            });
        };

        if ( $('#i-select-pesquisa').val()  == 5 )
        {

            var url =  "{{route('setarvarcliente')}}";

            var dado =  {   clientepesquisa : texto,
                            clientetipopesquisa:'FD',
                            tipopesquisa: opcao,
                            pesquisagenerica:texto,

                        };
            $.ajax(
            {
                url         : url,
                type        : 'get',
                dataType    : 'json',
                data        : dado,
                success     : function()
                {
                    window.location = "{{ route('cliente.index') }}";

                }
            });
        };


    }

    function acessarEmail()
    {
        window.location = 'http://webmail.'+window.location.host;
    }

    function novosImoveis()
    {
        url = "{{route('novosimoveisatdqtd')}}";

        $.ajax(
            {
                url     : url,
                dataType:'json',
                type:'get',
                async:false,
                success:function(data)
                {
                    var notif = parseInt($("#i-notificacoes").html());
                    $("#i-novosimoveis").html( data );
                    if( data != 0 )
                    {
                        notif = notif + 1;
                        $("#i-notificacoes").html( data);
                    }


                }
            }
        )



    }
    function mostrarSolicitacoes()
    {
        url = "{{route('solicitacoes.count.pendentes')}}";
        
        $.ajax(
            {
                url     : url,
                dataType:'json',
                type:'get',
                async:false,
                success:function(data)
                {
                    notif = parseInt($("#i-notificacoes").html());
                    $("#i-avisoscontrato").html( data );

                    if( data != '0' )
                    {
                        notif = notif + 1;
                        $("#i-notificacoes").html( notif);
                    }

                }
            }
        )



    }

    function mostrarSolicitacoesAberto()
    {
        window.open( "{{route('solicitacoes.index')}}", "_blank");

    }

    function verLeads()
    {
            
        var url = "{{route('leads.leadsindex')}}";

        window.open( url, '_blank');

    }

    
    function verificarSeHaNovosLeads()
    {
        var url = "{{route('atendimento.notificarNovosLeads')}}";

        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function( data )
                {
                    $("#modalnotiflead").hide();
                    if( data > 0 )
                    {
                        var lab = 'lead';
                        if (data > 1 ) lab = 'leads';
                        $("#modalnotiflead").modal( 'show');
                        $("#i-notifleads").html( data );
                        $("#i-notifleads").prop( 'title','Você tem mais '+data+' '+lab+' pra dar sequência');


                    }
                }
            }
        );

    }

    

    function verificarSeHaAtendimento()
    {
        var notifica = "{{Auth::user()->IMB_ATD_NOTIFICARNOVOATM}}";
        //alert(notifica);
        if( notifica == 'S')
        {
            var url = "{{route('atendimento.nofiticarcorretor')}}";

            $.ajax(
                {
                    url:url,
                    dataType:'json',
                    type:'get',
                    success:function( data )
                    {
                        $("#modalnotifnovosatm").modal( 'hide');

                        if( data > 0 )
                        {
                            var lab = 'atendimento';

                            if (data > 1 ) lab = 'atendimentos';
                            $("#modalnotifnovosatm").modal( 'show');
                            $("#i-notificacoes").html( data );
                            $("#i-notificacoes").prop( 'title','Você tem mais '+data+' '+lab+' te aguardando');
                            $("#i-novosatendimentos").show();
                            $("#i-novosatendimentos").html( data );

                        }
                    }
                }
            );
        }

    }

    function blink_text() 
    {
        if( $("#i-notificacoes").html() != '')
        {
            $('.icon-bell ').fadeOut(500);
            $('.icon-bell ').fadeIn(500);
        }
        if( $("#i-notifleads").html() != '')
        {
            $('.icon-leads').fadeOut(500);
            $('.icon-leads').fadeIn(500);
        }
        if( $("#i-i-boletosvencendo").html() != '')
        {
            $('.icon-boleto').fadeOut(500);
            $('.icon-boleto').fadeIn(500);
        }
    }
    setInterval(blink_text, 1000);

    function mostrarModalAtm()
    {
        $("#modalnotifnovosatm").modal( 'show');
    }
    
    function setCookie(name,value,days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "")  + expires + "; path=/";
    }
    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }
    function eraseCookie(name) {   
        document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }

    function iniciarNovoAtendimento()
    {
        let idatendimento = getCookie('3wt2oowd3ooo2oowt4');
        if( idatendimento != null )
        {
            alert('Você já está num atendimento! Para iniciar outro irá precisar fechar o pendente!');
            return false;
        }

        window.open( "{{route('clienteatendimento.novo')}}", '_blank');

    }
    const handlePhone = (event) => 
    {
        let input = event.target
        input.value = phoneMask(input.value)
    }

    const phoneMask = (value) => {
        if (!value) return ""
        value = value.replace(/\D/g,'')
        value = value.replace(/(\d{2})(\d)/,"($1) $2")
        value = value.replace(/(\d)(\d{4})$/,"$1-$2")
        return value
    }

</script>
    </body>

</html>
