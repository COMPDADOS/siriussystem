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
<html lang="pt-BR">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Sirius System ERP Imobiliário</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #2 for user inbox" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->


        <script src="{{asset('/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/js/datedropper.min.js')}}" type="text/javascript"></script>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
        <link href="https://pro.fontawesome.com/releases/v5.1.0/css/all.css" rel="stylesheet" type="text/css" />
        
         <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        
         <link href="{{asset('/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
         <link href="{{asset('/global/css/dataTables.checkboxes.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css"> 
        <link href="{{asset('/global/plugins/icheck/skins/all.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />
        <script src="{{asset('/global/plugins/sweetalert/sweetalert2.min.js')}}"></script>
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
        <link href="{{asset('/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/css/fonts.css')}}" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>        
        <link href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css" rel="stylesheet" />
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>        
        <script src="https://kit.fontawesome.com/9312426ea1.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="http://code.jquery.com/qunit/qunit-1.11.0.css" type="text/css" media="all">
        <link href="{{asset('/css/dropzone.css')}}" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
          <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />




        <style>
            #div-administracao      {display: none;}
            #div-comercial          {display: none;}
            #div-cliente            {display: none;}
            #div-botoes             {display: none;}
            #div-botoes-clientes    {display: none;}
            #div-botoes-corretor    {display: none;}

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

            .escondido {
              display: none;
            }
                        
        </style>

        @yield('scripttop')

    </head>
    <!-- END HEAD -->

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
                <div class="page-actions">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-circle  dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-plus"></i>&nbsp;
                            <span class="hidden-sm hidden-xs">Novo&nbsp;</span>&nbsp;
                            <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{route('clienteatendimento.novo')}}">
                                <i class="fas fa-headset"></i> Atendimento</a>
                            </li>
                            <li>
                                <a href="{{route('imovel.add')}}">
                                <i class="fas fa-warehouse"></i> Imóvel </a>
                            </li>
                            <li>
                                <a href="{{route('condominio.index')}}">
                                <i class="fas fa-building"></i> Condomínio </a>
                            </li>
                            <li>
                                <a href="{{route('cliente.add')}}">
                                <i class="fas fa-building"></i> Cliente </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                <i class="far fa-clock"></i> Agendamento
                                    <span class="badge badge-success">4</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fas fa-user-tie"></i> Usuário
                                </a>
                            </li>
                        </ul>
                        &nbsp; 
                             &nbsp; 
                            <select class="select-pesquisar" id="i-select-pesquisa">
                                <option value="0">Tipo Pesquisa</option>
                                <option value="1">Imóveis</option>
                                <option value="2">Interessado</option>
                                <option value="3">Proprietário</option>

                            </select>


                    </div>
                </div>
                <!-- END PAGE ACTIONS -->
                <!-- BEGIN PAGE TOP -->
                <div class="page-top">
                    <!-- BEGIN HEADER SEARCH BOX -->
                    <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
                    <form class="search-form search-form-expanded" onsubmit="return false;">
                        <div class="input-group">
                            <input type="text" class="form-control" id="i-campo-pesquisar" >
                            <span class="input-group-btn">
                                <button class="btn btn-primary" id="btn-pesquisar">Pesquisar</button>
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
                        <input type="hidden"  id="i-imovelpesquisa">
                        
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
                                    <i class="icon-bell"></i>
                                    <span class="badge badge-default">  </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3>
                                            <span class="bold">0</span> notifications</h3>
                                        <a href="page_user_profile_1.html">Visualizar Todas</a>
                                    </li>
                                    <li>
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
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-calendar"></i>
                                    <span class="badge badge-default" id="i-atm-pendentes"></span>
                                </a>
                                <ul class="dropdown-menu extended tasks">
                                    <li class="external">
                                        <h3>Você tem
                                            <span class="bold" id="i-atm_pendentes">Notificações </span> atendimento</h3>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                            <li>
                                                <a href="javascript:atendimentosTodosAberto()">
                                                    <span class="task">
                                                        <span class="desc">Atendimentos em aberto</span>
                                                        <span class="percent" id="i-atm-aberto"></span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">Atendimentos Atrasados</span>
                                                        <span class="percent" id="i-atm-atrasado"></span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">Atendimentos a Realizar</span>
                                                        <span class="percent" id="i-atm-agendados-futuro"></span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">Atendimentos pra Hoje</span>
                                                        <span class="percent" id="i-atm-agendados-hoje"></span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:agendamentos();">
                                                    <span class="task">
                                                        <span class="desc">Apontamentos na Agenda</span>
                                                        <span class="percent" id="i-apontamentos-hoje"></span>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="img-circle" src="{{asset('/layouts/layout/img/user.png')}}" />
                                    <span class="username username-hide-on-mobile">{{ substr(Auth::user()->IMB_ATD_NOME,0,12)}}... </span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="javascript:meusDados()">
                                            <i class="icon-user"></i> Meus Dados </a>
                                    </li>
                                    <li>
                                        <a href="javascript:agendamentos()">
                                            <i class="icon-calendar"></i> Agenda </a>
                                    </li>
                                    <li>
                                        <a href="javascript:acessarEmail();">
                                            <i class="icon-envelope-open"></i> Email
                                            <span class="badge badge-danger"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-rocket"></i> Minhas Tarefas
                                            <span class="badge badge-success"> 7 </span>
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
            <div class="page-sidebar-wrapper escondido" id="div-nav-administrativo">
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
                                <a>
                                    <span class="title" id="I-IMB_IMB_NOME"></span>
<!--                                    <span class="arrow"></span> -->
                                </a>
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-bar-chart"></i>
                                    <span class="title">Dashboard</span>
<!--                                    <span class="arrow"></span> -->
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item start ">
                                        <a href="/" class="nav-link ">
                                            <i class="icon-bar-chart"></i>
                                            <span class="title">Área Administrativa</span>
                                        </a>
                                    </li>
                                    <li class="nav-item start ">
                                        <a href="{{route('dashboard.comercial.panorama')}}/{{Auth::User()->IMB_IMB_ID}}"
                                            class="nav-link ">
                                            <i class="icon-bar-chart"></i>
                                            <span class="title">Área Comercial</span>
                                            <span class="badge badge-success"></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="heading">
                                <h class="uppercase"></h3>
                                <li class="nav-item    active open">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="icon-puzzle"></i>
                                        <span class="title">Comercial +Utilizados</span>
                                    </a>

                                    <ul class="sub-menu">
                                        <li class="nav-item  ">
                                            <a href="{{route('cliente.index')}}" class="nav-link ">
                                                <span class="title">Clientes</span>
                                            </a>
                                        </li>
                                        <li class="nav-item  ">
                                            <a href="{{route('imovel.index')}}" class="nav-link ">
                                                <span class="title">Imóveis</span>
                                            </a>
                                        </li>
                                        <li class="nav-item  ">
                                            <a href="{{route('atendimento')}}" class="nav-link ">
                                                <span class="title">Atendimentos</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </li>
                                                        
                            <li class="heading">
                                <label></b></label>
                            </li>
                            
                            <li class="nav-item    active open">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-puzzle"></i>
                                    <span class="title">Adm.  +Utilizadas</span>
<!--                                    <span class="glyphicon glyphicon-menu-down"></span>-->
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="{{route('cliente.index')}}" class="nav-link ">
                                            <span class="title">Clientes</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{route('contrato.index')}}" class="nav-link ">
                                            <span class="title">Gerenciador de Contratos</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                            <span class="title">Inadimplentes</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{route('imovel.index')}}" class="nav-link ">
                                        <span class="title">Imóveis</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                            <span class="title">Alugar Imóvel</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="glyphicon glyphicon-list-alt"></i>
                                    <span class="title">Cadastros</span>
<!--                                    <span class="arrow"></span>-->
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="{{route('cliente.index')}}" class="nav-link ">
                                        <i class="glyphicon glyphicon-list-alt"></i>
                                            <span class="title"> Clientes</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{route('imovel.index')}}" class="nav-link ">
                                                <i class="glyphicon glyphicon-list-alt"></i>
                                            <span class="title"> Imóveis</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{ route('atendente.index')}}" class="nav-link ">
                                        <i class="glyphicon glyphicon-list-alt"></i>
                                        <span class="title"> Funcionários</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                            <i class="glyphicon glyphicon-list-alt"></i>
                                            <span class="title">Empresas/Fornecedores</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="glyphicon glyphicon-retweet"></i>
                                    <span class="title">Movimentação</span>
                                    <span class="selected"></span>
<!--                                    <span class="arrow open"></span>-->
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                           <i class="glyphicon glyphicon-retweet"></i>
                                           <span class="title">Alugar Imóvel</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" id="i-lancamentos-nav">
                                        <a href="{{route('lancamento.index')}}" class="nav-link ">
                                            <i class="glyphicon glyphicon-retweet"></i>
                                            <span class="title">Lançamentos
                                        </span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{ route('recebimento')}}" class="nav-link ">
                                            <i class="glyphicon glyphicon-retweet"></i>
                                            <span class="title">Receber Aluguel</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                            <i class="glyphicon glyphicon-retweet"></i>
                                            <span class="title">Repassar Aluguel</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                            <i class="glyphicon glyphicon-retweet"></i>
                                            <span class="title">Cobrança Bancária
                                                </span>
                                        </a>
                                    </li>
                                    <li class="nav-item  active open">
                                        <a href="#" class="nav-link ">
                                            <i class="glyphicon glyphicon-retweet"></i>
                                            <span class="title">DOC Eletrônico</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="glyphicon glyphicon-print"></i>
                                    <span class="title">Relatórios / Consultas</span>
<!--                                    <span class="arrow"></span>-->
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="javascript:;" class="nav-link nav-toggle">
                                            <i class="glyphicon glyphicon-print"></i>
                                            <span class="title">Clientes</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu">
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Demonstrativo locador </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Demonstrativo Locador<br>em Lote </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Informe IRRF</a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Emails/Telefones de Clientes </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Curva ABC Locadores </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Clientes Ativos </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Imóveis x Proprietários </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="javascript:;" class="nav-link nav-toggle">
                                            <i class="glyphicon glyphicon-print"></i>
                                            <span class="title">Imóveis</span>
<!--                                            <span class="arrow"></span>-->
                                        </a>
                                        <ul class="sub-menu">
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Vencimento de Contratos </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Contratos a Reajustar </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Contratos Reajustados</a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Locaçoes Realizadas </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Locações Realizadas<br>(Completo) </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Rescisões no Período </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Com Aviso de Desocupação </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Geral de Imóveis </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Geral de Contratos </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Contratos e Seus Envolvidos </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Imóveis com Inscrição IPTU </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> IPTUs Responsabilidade <br>da Imobiliária </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Imóveis Selecionados<br>para Dimob </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="javascript:;" class="nav-link nav-toggle">
                                            <i class="glyphicon glyphicon-print"></i>
                                            <span class="title">Financeiro</span>
<!--                                            <span class="arrow"></span>-->
                                        </a>
                                        <ul class="sub-menu">
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Aluguéres Recebidos </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Aluguéres Repassados<br>em Lote </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Previsão Recebimento</a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Previsão Repasse </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Taxa Contrato Recebida </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Previsão Taxa Contrato  </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Taxa Admin. Recebida </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Previsão Taxa Contrato </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Emissão Cheques em Lote </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Lançamentos Valores <br>em Contratos </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Emissão Nota Fiscal</a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Contratos com Seguros </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Planilha de Vencimento </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Contratos com Caução </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Antecipações </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> DOCs Emitidos </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Conciliação de Pagtos x Rectos </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Conciliação Pagtos x Rectos Modelo II </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Recebimentos Por Evento </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Repasses Por Evento </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Visões Diversas </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            
                            <li class="heading">
                                <h3 class="uppercase"></h3>
                            </li>

                            
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="glyphicon glyphicon-usd"></i>
                                    <span class="title">Bancos / Caixa</span>
<!--                                    <span class="arrow"></span>-->
                                </a>

                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="glyphicon glyphicon-usd"></i>
                                        <span class="title">Cadastro</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu">
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Contas de Caixa </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Grupo de CFC </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> C.F.C. </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link ">Sub-Conta<br>(Centro de Custo) </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="nav-item  ">
                                        <a href="javascript:;" class="nav-link nav-toggle">
                                            <i class="glyphicon glyphicon-usd"></i>
                                            <span class="title">Movimentação</span>
<!--                                            <span class="arrow"></span> -->
                                        </a>
                                        <ul class="sub-menu">
                                        <li class="nav-item ">
                                                <a href="#" class="nav-link "> Lançamentos </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Desbloqueio de Cheques<br> e Cancelamentos </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Conciliação por Arquivo CNAB </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Recibos Avulsos </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="nav-item  ">
                                        <a href="javascript:;" class="nav-link nav-toggle">
                                            <i class="glyphicon glyphicon-usd"></i>
                                            <span class="title">Consultas/Relatórios</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu">
                                        <li class="nav-item ">
                                                <a href="#" class="nav-link "> Movimentação </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Consolidado </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="glyphicon glyphicon-usd"></i>
                                    <span class="title">Contas a Pagar</span>
<!--                                    <span class="arrow"></span> -->
                                </a>

                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="javascript:;" class="nav-link nav-toggle">
                                            <i class="glyphicon glyphicon-usd"></i>
                                            <span class="title">Opções</span>
<!--                                            <span class="arrow"></span> -->
                                        </a>
                                        <ul class="sub-menu">
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Fornecedores </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Novos Lançamentos </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="#" class="nav-link "> Consultas </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-docs"></i>
                                    <span class="title">Utilidades</span>
<!--                                    <span class="arrow"></span> -->
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="javascript:agendamentos()" class="nav-link ">
                                            <i class="icon-calendar"></i>
                                            <span class="title">Agenda</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                            <i class="icon-notebook"></i>
                                            <span class="title">Suporte</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>


                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="glyphicon glyphicon-cog"></i>
                                    <span class="title">Configurações</span>
<!--                                    <span class="arrow"></span>-->
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                    <a href="{{route('condominio.index')}}" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Condomínios</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{route('admcon.index')}}" class="nav-link ">
                                            <i class="v"></i>
                                            <span class="title">Administradoras de <br>Condomínios</span>
                                        </a>
                                    </li>
                                    <li class="nav-item adm ">
                                        <a href="/formapagamento/formapagamento" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Forma de Pagamento</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                    <a href="{{route('indicereajuste.index')}}/{{Auth::User()->IMB_IMB_ID}}" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Índices de Reajustes</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  adm">
                                        <a href="{{url('motivorescisao/motivorescisao')}}" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Motivos de Rescisão</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Rede Bancária</span>
                                        </a>
                                    </li>
                                    <li class="nav-item ">
                                        <a href="#" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Regras Comissão<br>Entre Agências</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="/ramoatividade/ramoatividade" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Ramo de Atividade</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="/tabelamulta/tabelamulta" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Tabela de Multa</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Tabela de Eventos</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Tabela de I.R.R.F.</span>
                                        </a>
                                    </li>
                                    <li class="nav-item adm ">
                                        <a href="{{route('tipocliente.index')}}/{{Auth::User()->IMB_IMB_ID}}" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Tipos de Clientes</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  adm">
                                        <a href="{{route('tipoatendente.index')}}/{{Auth::User()->IMB_IMB_ID}}" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Tipos de Funcionários</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{route('tipocomercio.index')}}/{{Auth::User()->IMB_IMB_ID}}" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Tipos de Comércios</span>
                                        </a>
                                    </li>
                                    <li class="nav-item adm ">
                                        <a href="{{route('tipoimovel')}}/{{Auth::User()->IMB_IMB_ID}}" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Tipos de Imóvel</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  adm ">
                                        <a href="{{route('statusimovel.index')}}/{{Auth::User()->IMB_IMB_ID}}" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Status do Imóvel</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  adm">
                                        <a href="{{route('statusatendimento.index')}}/{{Auth::User()->IMB_IMB_ID}}" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Status do Atendimento</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  adm">
                                        <a href="{{route('tipoimovel')}}/{{Auth::User()->IMB_IMB_ID}}" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Tipos de Imóvel</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  adm">
                                        <a href="{{route('perfil.index')}}" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Tabela de Perfis</span>
                                        </a>
                                    </li>
                                        <li class="nav-item  ">
                                            <a href="#" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Parametrização Geral</span>
                                            </a>
                                        </li>
                                        <li class="nav-item  adm">
                                            <a href="{{route('modulo.index')}}" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Gerenciamento dos Módulos</span>
                                            </a>
                                        </li>
                                </ul>
                            </li>
                        
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>

            <div class="page-sidebar-wrapper escondido" id="div-nav-comercial">
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
                            
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <img src="{{asset( '/layouts/layout/img/icon-house-homeid.png')}}" alt="">
                                    <span class="title">Imóveis</span>
<!--                                    <span class="arrow"></span>-->
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a href="{{route('imovel.index')}}" class="nav-link">
                                        <img src="{{asset( '/layouts/layout/img/icon-house-homeid-20.png')}}" alt="">
                                        <span class="title"> Imóveis</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{route('condominio.index')}}" class="nav-link ">
                                        <img src="{{asset( '/layouts/layout/img/icon-house-homeid-20.png')}}" alt="">
                                            <span class="title"> Condom./Empreend.</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                        <img src="{{asset( '/layouts/layout/img/icon-house-homeid-20.png')}}" alt="">
                                        <span class="title"> Roteiros</span>
                                        </a>
                                        </li>
                                        <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                        <img src="{{asset( '/layouts/layout/img/icon-house-homeid-20.png')}}" alt="">
                                            <span class="title">Controle de Chaves</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                        <img src="{{asset( '/layouts/layout/img/icon-house-homeid-20.png')}}" alt="">
                                            <span class="title">Propostas</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item" id="li-contratos">
                                <a href="#" class="nav-link nav-toggle">
                                    <img src="{{asset( '/layouts/layout/img/icon-aaaaaa-contatoshomeid.png')}}" alt="">
                                    <span class="title">Locação de Imóveis</span>
<!--                                    <span class="arrow"></span>-->
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a href="{{route('contrato.index')}}" class="nav-link">
                                        <img src="{{asset( '/layouts/layout/img/icon-aaaaaa-contatoshomeid-20.png')}}" alt="">
                                        <span class="title"> Contratos</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>                            
                            <li class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                <img src="{{asset( '/layouts/layout/img/icon-customers-homeid.png')}}" alt="">
                                   <span class="title">Clientes</span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item" id="i-lancamentos-nav">
                                        <a href="{{route('cliente.index')}}" class="nav-link ">
                                        <img src="{{asset( '/layouts/layout/img/icon-customers-homeid-20.png')}}" alt="">
                                            <span class="title">Consultar Clientes
                                        </span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                        <img src="{{asset( '/layouts/layout/img/icon-customers-homeid-20.png')}}" alt="">
                                           <span class="title">Leads</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
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
                                    <span class="title">Financeiro</span>
<!--                                    <span class="arrow"></span>-->
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="{{route('contrato.index')}}" class="nav-link">
                                            <img src="{{asset( '/layouts/layout/img/icon-aaaaaa-financeirohomeid-20.png')}}" alt="">
                                            <span class="title"> Bancos/Caixa</span>
                                        </a>
                                        <ul class="sub-menu">
                                            <li class="nav-item  ">
                                                <a href="#" class="nav-link">
                                                    <img src="{{asset( '/layouts/layout/img/icon-aaaaaa-financeirohomeid-20.png')}}" alt="">
                                                    <span class="title"> Cadastros</span>
                                                </a>
                                                <ul class="sub-menu">
                                                    <li class="nav-item" id="li-grupocfc">
                                                        <a href="{{route('grupocfc')}}" class="nav-link "> Grupos de CFC(Fluxo de Caixa)</a>
                                                    </li>
                                                    <li class="nav-item" id="li-cfc">
                                                        <a href="{{route('cfc')}}" class="nav-link "> Códigos de CFC(Fluxo de Caixa)</a>
                                                    </li>
                                                    <li class="nav-item " id="li-subconta">
                                                        <a href="{{route('subconta')}}" class="nav-link "> Sub-Contas(Centro de Custo)</a>
                                                    </li>
                                                    <li class="nav-item" id="li-contacaixa">
                                                        <a href="{{route('contacaixa')}}" class="nav-link "> Contas de Banco/Caixa</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-item  ">
                                                <a href="" class="nav-link">
                                                    <img src="{{asset( '/layouts/layout/img/icon-aaaaaa-financeirohomeid-20.png')}}" alt="">
                                                    <span class="title"> Movimento</span>
                                                </a>
                                                <ul class="sub-menu">
                                                    <li class="nav-item" id="li-lancamentocaixa">
                                                        <a href="" class="nav-link "> Lançamentos</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-item  ">
                                                <a href="" class="nav-link">
                                                    <img src="{{asset( '/layouts/layout/img/icon-aaaaaa-financeirohomeid-20.png')}}" alt="">
                                                    <span class="title"> Relatórios</span>
                                                </a>
                                                <ul class="sub-menu">
                                                    <li class="nav-item" id="li-relmovcai">
                                                        <a href="" class="nav-link "> Movimentação</a>
                                                    </li>
                                                    <li class="nav-item" id="li-relconsol">
                                                        <a href="" class="nav-link "> Relatório Consolidado</a>
                                                    </li>
                                                </ul>
                                            </li>

                                        </ul>
                                    </li>
                                </ul>
                            </li>


                            <li class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                <img src="{{asset( '/layouts/layout/img/icon-agenda-homeid.png')}}" alt="">
                                <span class="title">Agenda</span>
                                </a>
                            </li>                            
                            <li class="nav-item">
                                <a href="{{route('portais')}}" class="nav-link nav-toggle">
                                <img src="{{asset( '/layouts/layout/img/icon-aa-portais-homeid.png')}}" alt="">
                                   <span class="title">Portais de Anúncios</span>
                                </a>
                            </li>                            
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">

                                <img src="{{asset( '/layouts/layout/img/icon-aaa-reports-homeid.png')}}" alt="">
                                    <span class="title">Relatórios</span>
<!--                                    <span class="arrow"></span>-->
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="javascript:;" class="nav-link nav-toggle">
                                            <img src="{{asset( '/layouts/layout/img/icon-aaaa-reports-homeid-20.png')}}" alt="">
                                            <span class="title">Clientes</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu">
                                            <li class="nav-item">
                                                <img src="{{asset( '/layouts/layout/img/icon-aaaa-reports-homeid-20.png')}}" alt="">
                                                <a href="#" class="nav-link "> Clientes</a>
                                            </li>
                                            <li class="nav-item">
                                                <img src="{{asset( '/layouts/layout/img/icon-aaaa-reports-homeid-20.png')}}" alt="">
                                                <a href="#" class="nav-link "> Estatísticas </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="javascript:;" class="nav-link nav-toggle">
                                            <img src="{{asset( '/layouts/layout/img/icon-aaaa-reports-homeid-20.png')}}" alt="">

                                            <span class="title">Imóveis</span>
<!--                                            <span class="arrow"></span>-->
                                        </a>
                                        <ul class="sub-menu">
                                            <li class="nav-item ">
                                                <img src="{{asset( '/layouts/layout/img/icon-aaaa-reports-homeid-20.png')}}" alt="">
                                                <a href="#" class="nav-link "> Estatísticas </a>
                                            </li>
                                        </ul>
                                    </li>
                                    
                                </ul>
                            </li>

                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <img src="{{asset( '/layouts/layout/img/icon-aaaa-documents-homeid.png')}}" alt="">
                                    <span class="title">Documentos</span><!--                                    <span class="arrow"></span>-->
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="javascript:;" class="nav-link nav-toggle">
                                            <img src="{{asset( '/layouts/layout/img/icon-aaaa-documents-homeid-20.png')}}" alt="">
                                            <span class="title">Captação de Imóvei</span>
                                            <span class="arrow"></span>
                                        </a>    
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="javascript:;" class="nav-link nav-toggle">
                                            <img src="{{asset( '/layouts/layout/img/icon-aaaa-documents-homeid-20.png')}}" alt="">
                                            <span class="title">Captação de Empreendimentos</span>
                                            <span class="arrow"></span>
                                        </a>    
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <img src="{{asset( '/layouts/layout/img/icon-aaaaa-settings-homeid.png')}}" alt="">
                                   <span class="title">Configuração</span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="{{route('atendente.index')}}" class="nav-link nav-toggle">
                                            <img src="{{asset( '/layouts/layout/img/icon-aaaaa-settings-homeid-20.png')}}" alt="">
                                            <span class="title">Usuários</span>
                                            <span class="arrow"></span>   
                                        </a>    
                                    </li>
                                    <li class="nav-item  adm">
                                            <a href="{{route('modulo.index')}}" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Gerenciamento dos Módulos</span>
                                            </a>
                                        </li>
                                    <li class="nav-item  adm">
                                        <a href="{{route('perfil.index')}}" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Tabela de Perfis</span>
                                        </a>
                                    </li>

                                </ul>
                            </li>                            

                            <li class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <img src="{{asset( '/layouts/layout/img/icon-aaaaa-suporte-homeid.png')}}" alt="">
                                   <span class="title">Suporte</span>
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

                </div>
                <!-- END CONTENT BODY -->
            </div>

            

                <div class="page-sidebar-wrapper"  id="div-cliente">
                    <!-- BEGIN SIDEBAR -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <div class="page-sidebar navbar-collapse collapse" id="i-nav-cliente">
                        <!-- BEGIN SIDEBAR MENU -->
                        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                </div>
                            </li>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                            
                            <li class="nav-item start ">
                                <a>
                                    <span class="title" id="I-IMB_IMB_NOME"></span>
<!--                                    <span class="arrow"></span> -->
                                </a>
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-home"></i>
                                    <span class="title">Dashboard</span>
<!--                                    <span class="arrow"></span> -->
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item start ">
                                        <a href="/" class="nav-link ">
                                            <i class="icon-bar-chart"></i>
                                            <span class="title">Atendimentos </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="heading">
                                <h3 class="uppercase"></h3>
                            </li>
                            
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="glyphicon glyphicon-list-alt"></i>
                                    <span class="title">Cadastros</span>
<!--                                    <span class="arrow"></span>-->
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="{{route('cliente.index')}}" class="nav-link ">
                                        <i class="glyphicon glyphicon-list-alt"></i>
                                            <span class="title"> Seus Dados</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{route('imovel.index')}}" class="nav-link ">
                                                <i class="glyphicon glyphicon-list-alt"></i>
                                            <span class="title"> Seus Imóveis</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-docs"></i>
                                    <span class="title">Segundas-vias/Extratos</span>
<!--                                    <span class="arrow"></span> -->
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                            <i class="icon-clock"></i>
                                            <span class="title">Boletos</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                            <i class="icon-clock"></i>
                                            <span class="title">Extrato de Recebimento</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                            <i class="icon-envelope"></i>
                                            <span class="title">Extrato de Pagamento</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <!-- END SIDEBAR MENU -->
                        <!-- END SIDEBAR MENU -->
                    </div>
                    <!-- END SIDEBAR -->
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
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
        <script src="{{asset('global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('global/plugins/morris/raphael-min.js')}}" type="text/javascript"></script>
        <script src="{{asset('global/plugins/counterup/jquery.waypoints.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('global/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('global/plugins/amcharts/amcharts/amcharts.js')}}" type="text/javascript"></script>
        <script src="{{asset('global/plugins/amcharts/amcharts/serial.js')}}" type="text/javascript"></script>
        <script src="{{asset('global/plugins/amcharts/amcharts/pie.js')}}" type="text/javascript"></script>
        <script src="{{asset('global/plugins/amcharts/amcharts/radar.js')}}" type="text/javascript"></script>
        <script src="{{asset('/js/dropzone.js')}}"></script>    
             <script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });

                $('#btn-pesquisar').click(function()
                {
                    pesquisar();

                });


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

                    // $(this).val() will work here
                });
                 $("#div-botoes-cliente").hide();


                 if  ( carregarOpcao( $("#I-IMB_ATD_ID").val(), 33,1, "{{route('direito.checar')}}",false) == true)  
                     $("#li-contratos").show()
                else
                    $("#li-contratos").hide();

                    if  ( carregarOpcao( $("#I-IMB_ATD_ID").val(), 121,1, "{{route('direito.checar')}}",false) == true || 
                          carregarOpcao( $("#I-IMB_ATD_ID").val(), 34,1, "{{route('direito.checar')}}",false) == true )  
                     $("#li-financeiro").show()
                else
                    $("#li-financeiro").hide();


                    if  ( carregarOpcao( $("#I-IMB_ATD_ID").val(), 121,1, "{{route('direito.checar')}}",false) == true )  
                     $("#li-financeiro-bancoscaixa").show()
                else
                    $("#li-financeiro-bancoscaixa").hide();

                    if  ( carregarOpcao( $("#I-IMB_ATD_ID").val(), 26,1, "{{route('direito.checar')}}",false) == true )  
                     $("#li-cfc").show()
                else
                    $("#li-cfc").hide();

                    if  ( carregarOpcao( $("#I-IMB_ATD_ID").val(), 27,1, "{{route('direito.checar')}}",false) == true )  
                     $("#li-grupocfc").show()
                else
                    $("#li-grupocfc").hide();


                if  ( carregarOpcao( $("#I-IMB_ATD_ID").val(), 84,1, "{{route('direito.checar')}}",false) == true )  
                     $("#li-subconta").show()
                else
                    $("#li-subconta").hide();


                if  ( carregarOpcao( $("#I-IMB_ATD_ID").val(), 45,1, "{{route('direito.checar')}}",false) == true )  
                     $("#li-contacaixa").show()
                else
                    $("#li-contacaixa").hide();




                if( $("#I-IMB_ATD_CLIENTE").val() == 'S')
                {
                    $("#div-cliente").show();
                    $("#div-botoes-cliente").show();
                    $("#div-botoes-corretor").hide();
                    $("#div-botoes").hide();

                }
                else
                if  ( carregarOpcao( $("#I-IMB_ATD_ID").val(), 203,1, "{{route('direito.checar')}}",false) == true)  
                {
                    $("#div-nav-comercial").show();
                    $("#div-botoes-cliente").hide();
                    $("#div-botoes").hide();
                    $("#div-botoes-corretor").show();
                    $("#div-nav-administrativo").hide();

                }
                else
                {
                    $("#div-nav-administrativo").show();
                    $("#div-botoes").show();
                    $("#div-botoes-corretor").hide();
                    $("#div-botoes-cliente").hide();
                }

                
    
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
                            clientetipopesquisa:'I'
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
                            clientetipopesquisa:'P'
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
    

    atendimentosAbertos();
    atendimentosHoje();


</script>
    </body>

</html>