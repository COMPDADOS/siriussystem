<!DOCTYPE html>
<html lang="en">

<head>
    <!--- Basic Page Needs  -->
    <meta charset="utf-8">
    <title>Sirius System - Album de Fotos</title>
    <meta name="description" content="">
    <meta name="author" content="Compdados Tecnologia em Sistemas">
    <meta name="keywords" content="Imoveis">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Specific Meta  -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Adamina" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville:400,400i,700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('album/css/bootstrap.min.css')}}">
    <!-- Jquery ui CSS -->
    <link rel="stylesheet" href="{{asset('album/css/jquery-ui.css')}}">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{asset('album/css/font-awesome.min.css')}}">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{asset('album/css/flaticon/flaticon.css')}}">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{asset('album/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('album/css/owl.theme.default.min.css')}}">
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="{{asset('album/css/jquery.fancybox.min.css')}}">
    <!-- Nav Menu CSS -->
    <link rel="stylesheet" href="{{asset('album/css/slicknav.min.css')}}">
    <link rel="stylesheet" href="{{asset('album/css/nav-menu.css')}}">
    <!-- Void Mega Menu -->
    <link rel="stylesheet" href="{{asset('album/css/vmm.menu.css')}}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('album/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('album/css/ripple.min.css')}}">
    <!-- Main StyleSheet CSS -->
    <link rel="stylesheet" href="{{asset('album/css/style.css')}}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="assets/img/favicon.ico">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <style>
            .endereco
            {
                color: #0099ff;

            }
            .font-18
            {
                font-size:18px;

            }
        </style>

</head>

<body>
    <div id="preloader"></div>

    <!-- Header Area -->
    <header class="header-area fotolia-header header_2">
            <div class="voidmega-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-xl-10">
            
                            
                                <div class="vmm-header header-transparent-on vmm-mega-menu mega-menu-fullwidth">
                                    <div class="container">
                            
                                        <!-- vmm header -->
                                        <div class="vmm-header-container">
                                            
                                            <!--Logo-->
                                            <div class="logo" data-mobile-logo="{{asset('album/img/voltar.png')}}" data-sticky-logo="assets/img/logo-2.png">
                                                <a href="javascript:window.close()"><img src="{{asset('album/img/voltar.png')}}" alt="logo"/></a>
                                            </div>
                                            
                                            <!-- Burger menu -->
                                            <div class="burger-menu">
                                            </div>
                                        </div>
                            
                                    </div>
                                </div>
                            </div>
                            <div class="d-none col-xl-2 d-xl-block">
                                <div class="search-menu-btn">
                                    <div class="searchV1-btn">
                                        <div class="soc-btn search-open">
                                            <i class="fa fa-search"></i>
                                        </div>
                                        <div class="soc-btn search-close">
                                            <i class="fa fa-close"></i>
                                        </div>
                                    </div>
                                    <span class="menu2nd-btn">
                                        <i class="fa fa-bars fa-2x"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </header>
    <!-- /Header Area -->
    <!-- Search Box -->
    <div class="search_V1">
        <form>
            <input type="text" class="input">
        </form>
    </div>
    <!-- Secondary Menu area -->
    <div class="secondMenu_V1">
        <nav class="fotoliaCircular-menu">
            <div class="circle">
                <a href="index.html"><i class="flaticon-001-camera"></i></a>
                <a href="portfolio-1.html"><i class="flaticon-030-album"></i></a>
                <a href="portfolio-2.html"><i class="flaticon-025-video-camera"></i></a>
                <a href="gallery-3.html"><i class="flaticon-019-histogram"></i></a>
                <a href="album-1.html"><i class="flaticon-017-len-2"></i></a>
                <a href="album-2.html"><i class="flaticon-004-spotlight"></i></a>
                <a href="portfolio-4.html"><i class="flaticon-022-portrait"></i></a>
                <a href="portfolio-5.html"><i class="flaticon-037-timer"></i></a>
            </div>
            <span class="menu2nd-btn">
                <i class="fa fa-times fa-2x"></i>
            </span>
        </nav>
    </div>
    <!-- /Secondary Menu area -->
    <!-- Hero Area -->
    <div class="row">
            <h3>.
            </h3>
        </div>
        <div class="row">
            <h3>.
            </h3>
        </div>
        <div class="row">
            <h3>.
            </h3>
        </div>
    <section class="hero-area hero_V5">
        <div class="heroV5-carousel owl-carousel ">
            @foreach( $imagens as $imagem)
            <div class="item">
                <div class="single-hero5">
                    <img src="{{url('')}}/storage/images/{{$imagem->IMB_IMB_ID}}/imoveis/{{$imagem->IMB_IMV_ID}}/{{$imagem->IMB_IMG_ARQUIVO}}" alt="" class="sh5bg wow zoomIn" data-wow-delay=".45s">
                    <div class="hero-text">
                        <h3 class="endereco" data-wow-delay=".95s">{{$imv->IMB_IMV_TITULO}}</h3>
                    </div>
                    <div class="hb-bottom">
                        <div class="hb-social">
                        <ul>
                            <li class="fadeInUp endereco font-18" data-wow-delay=".15s"><i class="fa fa-bed" aria-hidden="true"></i>
                                    Dormitórios: {{$imv->IMB_IMV_DORQUA}} </li>
                                    </ul>

                                    <ul>
                            <li class="fadeInUp endereco font-18" data-wow-delay=".15s"><i class="fa fa-bed" aria-hidden="true"></i>
                                    Suítes:{{$imv->IMB_IMV_SUIQUA}} </li>
                                    </ul>

                                    <ul>
                            <li class="fadeInUp endereco font-18" data-wow-delay=".15s"><i class="fa fa-bath" aria-hidden="true"></i>
                                    Banheiros: {{$imv->IMB_IMV_WCQUA}} </li>
                                    </ul>

                                    <ul>
                            <li class="fadeInUp endereco font-18" data-wow-delay=".15s"><i class="fa fa-columns" aria-hidden="true"></i>
                                    Salas: {{$imv->IMB_IMV_SALQUA}} </li>

                                    </ul>

                                    <ul>
                            <li class="fadeInUp endereco font-18" data-wow-delay=".15s"><i class="fa fa-car" aria-hidden="true"></i>
                                    Garagem Coberta: {{$imv->IMB_IMV_GARCOB}} </li>

                                    <ul>
                            <li class="fadeInUp endereco font-18" data-wow-delay=".15s"><i class="fa fa-car" aria-hidden="true"></i>
                                    Garagem Descoberta: {{$imv->IMB_IMV_GARDES}}</li>
                                <li class="fadeInUp endereco font-18" data-wow-delay=".15s"><i class="fa fa-arrows-alt" aria-hidden="true"></i>
                                        Área Total: {{$imv->IMB_IMV_ARETOT}} m2</li>
                                <li class="fadeInUp endereco font-18" data-wow-delay=".15s"><i class="fa fa-arrows-alt" aria-hidden="true"></i>
                                        Área Construída: {{$imv->IMB_IMV_ARECON}} m2</li>
                                <li class="fadeInUp endereco font-18" data-wow-delay=".15s"><i class="fa fa-arrows-alt" aria-hidden="true"></i>
                                        Área Útil: {{$imv->IMB_IMV_AREUTI}} m2</li>
                            </ul>


                        </div>
                        <div class="hb-phone">
                            <h4>Referência: {{$imv->IMB_IMV_REFERE}}</h4    >
                        </div>
                    </div>                    
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <!-- /Hero Area -->
    <!-- About Area -->
    
    <!-- Our Portfolio -->
    <section class="portfolio-area">
        <div class="container-fluid">
            <div class="shuffle-wrapper">
                
                <div class="row shuffle-box sbox_V1">
                    @foreach( $imagens as $imagem)
                    <figure class="single-shuffle col-3 ssV1-2" data-groups='["design"]'>
                        <div class="aspect">
                            <div class="aspect__inner ssf-content wow zoomIn" data-wow-delay=".85s">
                                <img src="{{url('')}}/storage/images/{{$imagem->IMB_IMB_ID}}/imoveis/{{$imagem->IMB_IMV_ID}}/{{$imagem->IMB_IMG_ARQUIVO}}" alt=""/>
                                <div class="ssf-hover">
                                    <a data-fancybox="group-4" class="fancyGallery" href="{{url('')}}/storage/images/{{$imagem->IMB_IMB_ID}}/imoveis/{{$imagem->IMB_IMV_ID}}/{{$imagem->IMB_IMG_ARQUIVO}}">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </figure>
                    @endforeach

                    
                    <div class="col-1 my-sizer-element"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Our Portfolio -->
    
    <!-- /Instagram Area -->
    <!-- Footer Area -->
    <footer class="footer-area">
        <div class="container">
            <div class="col-md-12">
                <div class="footer-copyr-logo">
                    <img src="assets/img/logo-1.png" alt="">
                    <p>© 2021 Compdados Tecnologia - Todos os Direitos Reservados</p>
                </div>
                <div class="footer-social">
                    <ul>
                        <li><a href="https://twitter.com/voidcoders"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="https://www.behance.net/voidcoders"><i class="fa fa-behance" aria-hidden="true"></i></a></li>
                        <li><a href="https://www.facebook.com/voidcoders/"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="https://www.pinterest.com/voidthemes/"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                        <li><a href="https://www.linkedin.com/company/voidcoders/about/"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- /Footer Area -->


    <!-- Scripts -->
    <!-- jQuery Plugin -->
    <script src="{{asset('album/js/jquery-3.2.0.min.js')}}"></script>
    <script src="{{asset('album/js/jquery-ui.js')}}"></script>
    <script src="{{asset('album/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('album/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('album/js/countdown.js')}}"></script>
    <script src="{{asset('album/js/jquery.scrollUp.js')}}"></script>
    <script src="{{asset('album/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('album/js/shuffle.min.js')}}"></script>
    <script src="{{asset('album/js/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('album/js/jquery.ripples.min.js')}}"></script>
    <script src="{{asset('album/js/jquery.slicknav.min.js')}}"></script>
    <script src="{{asset('album/js/vmm.menu.js')}}"></script>
    <script src="{{asset('album/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('album/js/wow.js')}}"></script>
    <script src="{{asset('album/js/theme.js')}}"></script>

</body>

</html>
