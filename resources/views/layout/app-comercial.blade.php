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
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="Compdados Tecnologia" />
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
        <link href="{{asset('/layouts/layout/css/layout.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/layouts/layout/css/themes/blue.css')}}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{asset('/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="{{asset('/global/img/favicon.ico')}}" />    
        <script src="{{asset('/global/scripts/datatable.js') }}" type="text/javascript"></script>
        <script src="{{asset('/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>

        <link href="{{asset('/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/css/fonts.css')}}" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>        
        <link href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css" rel="stylesheet" />
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>        
        <script src="https://kit.fontawesome.com/9312426ea1.js" crossorigin="anonymous"></script>
        @yield('scripttop')
    </head>        
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="{{ route('home')}}">
                            <img src="{{asset('/layouts/layout/img/logo.png')}}" alt="logo" class="logo-default" /> </a>
                        <div class="menu-toggler sidebar-toggler">
                        <span>--</span>
                        </div>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <input type="hidden" id="I-IMB_CTR_ID">
                        <input type="hidden" id="I-IMB_IMV_ID">
                        <input type="hidden" id="i-codigocliente">
                        <input type="hidden" value = "{{Auth::User()->IMB_IMB_ID2}}" id="I-IMB_IMB_IDAGENCIA">

                        <input type="hidden" value = "{{Auth::User()->IMB_IMB_ID}}" id="I-IMB_IMB_IDMASTER">
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
                                    <span class="badge badge-default"> 7 </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3>
                                            <span class="bold">12 pending</span> notifications</h3>
                                        <a href="page_user_profile_1.html">view all</a>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">just now</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-success">
                                                            <i class="fa fa-plus"></i>
                                                        </span> New user registered. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">3 mins</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Server #12 overloaded. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">10 mins</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> Server #2 not responding. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">14 hrs</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-info">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </span> Application error. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">2 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Database overloaded 68%. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">3 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> A user IP blocked. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">4 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> Storage Server #4 not responding dfdfdfd. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">5 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-info">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </span> System Error. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">9 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Storage server failed. </span>
                                                </a>
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
                                    <img alt="" class="img-circle" src="" />
                                    <span class="username username-hide-on-mobile">{{Auth::user()->IMB_ATD_NOME}} </span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="javascript:meusDados()">
                                            <i class="icon-user"></i> Meus Dados </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-calendar"></i> Agenda </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-envelope-open"></i> Caixa de Entrada
                                            <span class="badge badge-danger"> 3 </span>
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
                            <li class="dropdown dropdown-quick-sidebar-toggler">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <i class="icon-logout"></i>
                                </a>
                            </li>
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
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
                <div class="page-sidebar-wrapper"  >
                    <!-- BEGIN SIDEBAR -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <div class="page-sidebar navbar-collapse collapse" id="i-nav-comercial">
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
                                            <span class="title">Área Administrativa</span>
                                        </a>
                                    </li>
                                    <li class="nav-item start ">
                                        <a href="#" class="nav-link ">
                                            <i class="icon-bulb"></i>
                                            <span class="title">Área Comercial</span>
                                            <span class="badge badge-success">1</span>
                                        </a>
                                    </li>
                                    <li class="nav-item start ">
                                        <a href="#" class="nav-link ">
                                            <i class="icon-graph"></i>
                                            <span class="title">Outros</span>
                                            <span class="badge badge-danger">5</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="heading">
                                <h3 class="uppercase">Administração de Imóveis</h3>
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
                                        <a href="imovel" class="nav-link ">
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
                                        <a href="#" class="nav-link ">
                                            <i class="icon-clock"></i>
                                            <span class="title">Auditoria na Utilização</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                            <i class="icon-clock"></i>
                                            <span class="title">Tarefas</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                            <i class="icon-envelope"></i>
                                            <span class="title">Caixa de Entrada</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                            <i class="icon-calendar"></i>
                                            <span class="title">Calendário</span>
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
                                        <a href="#" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Condomínios</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="#" class="nav-link ">
                                            <i class="v"></i>
                                            <span class="title">Administradoras de <br>Condomínios</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="/tipocliente/tipocliente" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Tipos de Clientes</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="/tipoatendente/tipoatendente" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Tipos de Funcionários</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="/tipocomercio/tipocomercio" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Tipos de Comércios</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{route('tipoimovel')}}" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Tipos de Imóvel</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="/statusimovel/statusimovel" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Status do Imóvel</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="{{route('statusatendimento')}}" class="nav-link ">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="title">Status do Atendimento</span>
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
                <!-- END SIDEBAR -->
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN THEME PANEL -->
                        
                        <!-- END THEME PANEL -->
                        <!-- BEGIN PAGE BAR -->
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                        @yield('content')
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
                <!-- BEGIN QUICK SIDEBAR -->
                <a href="javascript:;" class="page-quick-sidebar-toggler">
                    <i class="icon-login"></i>
                </a>
                <div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
                    <div class="page-quick-sidebar">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="javascript:;" data-target="#quick_sidebar_tab_1" data-toggle="tab"> Usuários
                                    <span class="badge badge-danger">2</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" data-target="#quick_sidebar_tab_2" data-toggle="tab"> Alertas
                                    <span class="badge badge-success">7</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> Mais...
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">
                                            <i class="icon-bell"></i> Alertas </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">
                                            <i class="icon-info"></i> Notificaçoes </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">
                                            <i class="icon-speech"></i> Atividades </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">
                                            <i class="icon-settings"></i> Configurações </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active page-quick-sidebar-chat" id="quick_sidebar_tab_1">
                                <div class="page-quick-sidebar-chat-users" data-rail-color="#ddd" data-wrapper-class="page-quick-sidebar-list">
                                    <h3 class="list-heading">Apoio</h3>
                                    <ul class="media-list list-items">

<!--                                        <li class="media">
                                            <div class="media-status">
                                                <span class="badge badge-success">8</span>
                                            </div>
                                            <img class="media-object" src="{{asset('/layouts/layout/img/avatar3.jpg')}}" alt="...">
                                            <div class="media-body">
                                                <h4 class="media-heading"></h4>
                                                <div class="media-heading-sub"> Project Manager </div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <img class="media-object" src="{{asset('/layouts/layout/img/avatar1.jpg')}}" alt="...">
                                            <div class="media-body">
                                                <h4 class="media-heading">Nick Larson</h4>
                                                <div class="media-heading-sub"> Art Director </div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-status">
                                                <span class="badge badge-danger">3</span>
                                            </div>
                                            <img class="media-object" src="{{asset('/layouts/layout/img/avatar4.jpg')}}" alt="...">
                                            <div class="media-body">
                                                <h4 class="media-heading">Deon Hubert</h4>
                                                <div class="media-heading-sub"> CTO </div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <img class="media-object" src="{{asset('/layouts/layout/img/avatar2.jpg')}}" alt="...">
                                            <div class="media-body">
                                                <h4 class="media-heading">Ella Wong</h4>
                                                <div class="media-heading-sub"> CEO </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <h3 class="list-heading">Customers</h3>
                                    <ul class="media-list list-items">
                                        <li class="media">
                                            <div class="media-status">
                                                <span class="badge badge-warning">2</span>
                                            </div>
                                            <img class="media-object" src="{{asset('/layouts/layout/img/avatar6.jpg')}}" alt="...">
                                            <div class="media-body">
                                                <h4 class="media-heading">Lara Kunis</h4>
                                                <div class="media-heading-sub"> CEO, Loop Inc </div>
                                                <div class="media-heading-small"> Last seen 03:10 AM </div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-status">
                                                <span class="label label-sm label-success">new</span>
                                            </div>
                                            <img class="media-object" src="{{asset('/layouts/layout/img/avatar7.jpg')}}" alt="...">
                                            <div class="media-body">
                                                <h4 class="media-heading">Ernie Kyllonen</h4>
                                                <div class="media-heading-sub"> Project Manager,
                                                    <br> SmartBizz PTL </div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <img class="media-object" src="{{asset('/layouts/layout/img/avatar8.jpg')}}" alt="...">
                                            <div class="media-body">
                                                <h4 class="media-heading">Lisa Stone</h4>
                                                <div class="media-heading-sub"> CTO, Keort Inc </div>
                                                <div class="media-heading-small"> Last seen 13:10 PM </div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-status">
                                                <span class="badge badge-success">7</span>
                                            </div>
                                            <img class="media-object" src="{{asset('/layouts/layout/img/avatar9.jpg')}}" alt="...">
                                            <div class="media-body">
                                                <h4 class="media-heading">Deon Portalatin</h4>
                                                <div class="media-heading-sub"> CFO, H&D LTD </div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <img class="media-object" src="{{asset('/layouts/layout/img/avatar10.jpg')}}" alt="...">
                                            <div class="media-body">
                                                <h4 class="media-heading">Irina Savikova</h4>
                                                <div class="media-heading-sub"> CEO, Tizda Motors Inc </div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-status">
                                                <span class="badge badge-danger">4</span>
                                            </div>
                                            <img class="media-object" src="{{asset('/layouts/layout/img/avatar11.jpg')}}" alt="...">
                                            <div class="media-body">
                                                <h4 class="media-heading">Maria Gomez</h4>
                                                <div class="media-heading-sub"> Manager, Infomatic Inc </div>
                                                <div class="media-heading-small"> Last seen 03:10 AM </div>
                                            </div>
                                        </li>
                                    -->                                        
                                    </ul>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
                <!-- END QUICK SIDEBAR -->
            </div>
            <!-- END CONTAINER -->
            <!-- BEGIN FOOTER -->
            <div class="page-footer">

                <input type="hidden" id="i-email" value="{{Auth::user()->email}}">
                <input type="hidden" id="I-IMB_ATD_ID" value="{{Auth::user()->IMB_ATD_ID}}">
                <input type="hidden" id="i-idempresa" >
                <div class="page-footer-inner" id="i-empresa">Compdados Tecnolohia
                </div>
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>
            <!-- END FOOTER -->
        </div>
        <!-- BEGIN QUICK NAV -->
        <!-- END QUICK NAV -->
        <!--[if lt IE 9]>
<script src="{{asset('/global/plugins/respond.min.js')}}"></script>
<script src="{{asset('/global/plugins/excanvas.min.js')}}"></script> 
<script src="{{asset('/global/plugins/ie8.fix.min.js')}}"></script> 
<![endif]-->
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
		
        <script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });


    
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
    

    atendimentosAbertos();
    atendimentosHoje();


</script>
    

</html>