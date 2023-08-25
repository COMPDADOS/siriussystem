<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Imóveis em Bauru - SP">
    <meta name="author" content="Compdados Tecnologia - Sirius System">
    <title>Sirius System</title>
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="{{asset('pagesirius/css/jquery-ui.css')}}">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i%7CMontserrat:600,800" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="{{asset('pagesirius/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('pagesirius/css/fontawesome-5-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('pagesirius/css/font-awesome.min.css')}}">
    <!-- Slider Revolution CSS Files -->
    <link rel="stylesheet" href="{{asset('pagesirius/revolution/css/settings.css')}}">
    <link rel="stylesheet" href="{{asset('pagesirius/revolution/css/layers.css')}}">
    <link rel="stylesheet" href="{{asset('pagesirius/revolution/css/navigation.css')}}">
    <!-- ARCHIVES CSS -->
    <link rel="stylesheet" href="{{asset('pagesirius/css/search.css')}}">
    <link rel="stylesheet" href="{{asset('pagesirius/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('pagesirius/css/aos.css')}}">
    <link rel="stylesheet" href="{{asset('pagesirius/css/aos2.css')}}">
    <link rel="stylesheet" href="{{asset('pagesirius/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('pagesirius/css/lightcase.css')}}">
    <link rel="stylesheet" href="{{asset('pagesirius/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('pagesirius/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('pagesirius/css/menu.css')}}">
    <link rel="stylesheet" href="{{asset('pagesirius/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('pagesirius/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('pagesirius/css/video.css')}}">
    <link rel="stylesheet" id="color" href="{{asset('pagesirius/css/colors/gray.css')}}">
    <style>

        .img-250
        {
                max-width:100%;    
                width:900px;
				height:200px;            
        }

        .div-red
        {
            height:100px;
            background-color: #ffffe6;
            align:center;
        }
    </style>


</head>

<body class="homepage-9 hp-6 hd-white">
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- START SECTION HEADINGS -->
        <!-- Header Container
        ================================================== -->
        <header id="header-container" class="div-red" >
            <!-- Header -->
            @include('pagesirius.header')
            <!-- Header / End -->

        </header>
        <div class="clearfix"></div>
        <!-- Header Container / End -->
        <!-- END HEADER SEARCH -->
        <!-- START SECTION FEATURED PROPERTIES -->
        <section class="featured portfolio bg-white">
            <div class="container">
                <div class="sec-title">
                    <h2><span>Nossos </span>Produtos</h2>
                    <p>Ferramentas para aumentar sua produtividade no dia-a-dia</p>
                </div>
                <div class="row portfolio-items">
                    @foreach( $ultimos as $imovel)

                    @php
                    $fincla="rent";
                    $valor='';
                    if( $imovel->IMB_IMV_VALVEN <> 0 and $imovel->IMB_IMV_VALLOC <> 0 )
                        {
                            $fin = "Ven/Loc";
                            $fincla="rent";
                            $valor=number_format($imovel->IMB_IMV_VALVEN,2,",",".").'/'.number_format($imovel->IMB_IMV_VALLOC,2,",",".");

                        }
                        elseif( $imovel->IMB_IMV_VALVEN <> 0 )
                        {
                            $fin = "Venda";
                            $fincla="sale";
                            $valor=number_format($imovel->IMB_IMV_VALVEN,2,",",".");

                        }
                        elseif( $imovel->IMB_IMV_VALLOC<> 0 )
                        {
                            $fin = "Locação";
                            $fincla="rent";
                            $valor=number_format($imovel->IMB_IMV_VALLOC,2,",",".");

                        }

                    @endphp


                    <div class="item col-lg-4 col-md-6 col-xs-12 landscapes {{$fincla}}">
                        <div class="project-single" data-aos="zoom-in">
                            <div class="project-inner project-head">
                                <div class="homes">
                                    <!-- homes img -->
                                    <a href="/sys/pagesirius/detalhe/{{$imovel->IMB_IMV_ID}}" class="homes-img">
                                        <div class="homes-tag button alt featured">Detalhes</div>
                                        <div class="homes-tag button alt sale">Integrado</div>
                                        <div class="homes-price"></div>
                                        <img class="img-250" src="https://www.siriussystem.com.br/sys/storage/images/{{$imovel->IMB_IMB_ID}}/imoveis/{{$imovel->IMB_IMV_ID}}/{{$imovel->IMB_IMG_ARQUIVO}}" alt="home-1" class="img-responsive">
                                    </a>
                                </div>
                                <div class="button-effect">
                                    <a href="/sys/pagesirius/detalhe/{{$imovel->IMB_IMV_ID}}" class="img-poppu btn"><i class="fa fa-photo"></i></a>
                                </div>
                            </div>
                            <!-- homes content -->
                            <div class="homes-content">
                                <!-- homes address -->
                                <h3><a href="/sys/pagesirius/detalhe/{{$imovel->IMB_IMV_ID}}">{{$imovel->IMB_IMV_ENDERECO}}</a></h3>
                                <p class="homes-address mb-3">
                                    <a href="/sys/pagesirius/detalhe/{{$imovel->IMB_IMV_ID}}">
                                        <i class="fa fa-map-marker"></i><span><b>Referência: {{$imovel->IMB_IMV_REFERE}}</b></span>
                                    </a>
                                </p>
                                <!-- homes List -->
                                <ul class="homes-list clearfix">
                                    <li>
                                        <span>{{$imovel->IMB_IMV_QUADOR}} Dormitórios</span>
                                    </li>
                                    <li>
                                        <span>{{$imovel->IMB_IMV_QUAWC}} Banheiros</span>
                                    </li>
                                    <li>
                                        <span>{{$imovel->IMB_IMV_GARCOB}} Vagas Cob.</span>
                                    </li>
                                    <li>
                                        <span>{{$imovel->IMB_IMV_GARDES}} Vagas Descob.</span>
                                    </li>
                                </ul>
                                <div class="footer">
                                    <a href="https://wa.me/5514981190975?text=Olá!%20Gostaria%20de%20receber%20mais%20informações%20sobre%20o%20imóvel%20{{$imovel->IMB_IMV_REFERE}}" target="_blank" title="Mais Informações">
                                        <i class="fa fa-whatsapp" aria-hidden="true"></i>           
                                    </a>

                                    <a href="#" title="Compartilhar">
                                        <i class="fa fa-share-alt" aria-hidden="true"></i>           
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- END SECTION FEATURED PROPERTIES -->

        @include('pagesirius.footer')
        <a data-scroll href="#wrapper" class="go-up"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
        <!-- END FOOTER -->

        
        <!-- START PRELOADER -->
        <div id="preloader">
            <div id="status">
                <div class="status-mes"></div>
            </div>
        </div>
        <!-- END PRELOADER -->

        <!-- ARCHIVES JS -->
        <script src="{{asset('pagesirius/js/jquery-3.5.1.min.js')}}"></script>
        <script src="{{asset('pagesirius/js/rangeSlider.js')}}"></script>
        <script src="{{asset('pagesirius/js/tether.min.js')}}"></script>
        <script src="{{asset('pagesirius/js/popper.min.js')}}"></script>
        <script src="{{asset('pagesirius/js/moment.js')}}"></script>
        <script src="{{asset('pagesirius/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('pagesirius/js/mmenu.min.js')}}"></script>
        <script src="{{asset('pagesirius/js/mmenu.js')}}"></script>
        <script src="{{asset('pagesirius/js/aos.js')}}"></script>
        <script src="{{asset('pagesirius/js/aos2.js')}}"></script>
        <script src="{{asset('pagesirius/js/slick.min.js')}}"></script>
        <script src="{{asset('pagesirius/js/fitvids.js')}}"></script>
        <script src="{{asset('pagesirius/js/jquery.waypoints.min.js')}}"></script>
        <script src="{{asset('pagesirius/js/typed.min.js')}}"></script>
        <script src="{{asset('pagesirius/js/jquery.counterup.min.js')}}"></script>
        <script src="{{asset('pagesirius/js/imagesloaded.pkgd.min.js')}}"></script>
        <script src="{{asset('pagesirius/js/isotope.pkgd.min.js')}}"></script>
        <script src="{{asset('pagesirius/js/smooth-scroll.min.js')}}"></script>
        <script src="{{asset('pagesirius/js/lightcase.js')}}"></script>
        <script src="{{asset('pagesirius/js/search.js')}}"></script>
        <script src="{{asset('pagesirius/js/owl.carousel.js')}}"></script>
        <script src="{{asset('pagesirius/js/jquery.magnific-popup.min.js')}}"></script>
        <script src="{{asset('pagesirius/js/ajaxchimp.min.js')}}"></script>
        <script src="{{asset('pagesirius/js/newsletter.js')}}"></script>
        <script src="{{asset('pagesirius/js/jquery.form.js')}}"></script>
        <script src="{{asset('pagesirius/js/jquery.validate.min.js')}}"></script>
        <script src="{{asset('pagesirius/js/searched.js')}}"></script>
        <script src="{{asset('pagesirius/js/forms-2.js')}}"></script>
        <script src="{{asset('pagesirius/js/leaflet.js')}}"></script>
        <script src="{{asset('pagesirius/js/leaflet-gesture-handling.min.js')}}"></script>
        <script src="{{asset('pagesirius/js/leaflet-providers.js')}}"></script>
        <script src="{{asset('pagesirius/js/leaflet.markercluster.js')}}"></script>
        <script src="{{asset('pagesirius/js/map-style2.js')}}"></script>
        <script src="{{asset('pagesirius/js/range.js')}}"></script>
        <script src="{{asset('pagesirius/js/color-switcher.js')}}"></script>

        <!-- Slider Revolution scripts -->
        <script src="{{asset('pagesirius/revolution/js/jquery.themepunch.tools.min.js')}}"></script>
        <script src="{{asset('pagesirius/revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
        <script src="{{asset('pagesirius/revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
        <script src="{{asset('pagesirius/revolution/js/extensions/revolution.extension.carousel.min.js')}}"></script>
        <script src="{{asset('pagesirius/revolution/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
        <script src="{{asset('pagesirius/revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
        <script src="{{asset('pagesirius/revolution/js/extensions/revolution.extension.migration.min.js')}}"></script>
        <script src="{{asset('pagesirius/revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
        <script src="{{asset('pagesirius/revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>
        <script src="{{asset('pagesirius/revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
        <script src="{{asset('pagesirius/revolution/js/extensions/revolution.extension.video.min.js')}}"></script>
        <script>
            var typed = new Typed('.typed', {
                strings: [  "C.R.M. / E.R.P Num Único Lugar ^2000", 
                            "Administração de Imóveis ^2000", 
                            "Administração de Contratos  ^2000", 
                            "Financeiro Total Integrado ^2000",
                            "Atendimento ao Cliente ^2000", 
                            "Site da Imobiliária Integrado ^2000", 
                            "Integração com Portais ^2000",
                            "Integrações Bancárias ^2000",
                            "Facilidade nas Parcerias"
                            ],
                smartBackspace: false,
                loop: true,
                showCursor: true,
                cursorChar: "|",
                typeSpeed: 50,
                backSpeed: 30,
                startDelay: 800
            });

        </script>
        <script>
            $('.slick-lancers').slick({
                infinite: false,
                slidesToShow: 4,
                slidesToScroll: 1,
                dots: true,
                arrows: false,
                adaptiveHeight: true,
                responsive: [{
                    breakpoint: 1292,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        dots: true,
                        arrows: false
                    }
                }, {
                    breakpoint: 993,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        dots: true,
                        arrows: false
                    }
                }, {
                    breakpoint: 769,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                        arrows: false
                    }
                }]
            });

        </script>

        <script>
            $(".dropdown-filter").on('click', function() {

                $(".explore__form-checkbox-list").toggleClass("filter-block");

            });

            $(document).ready(function() {
                $( "#i-finalidade" ).change(function() 
                {
                    
                    if(  $( "#i-finalidade" ).val() == 'V' )
                    {
                        debugger;
                        $("#i-preco").empty();
                        
                        $("#i-preco").append( '<option value="">Todos</option>' );
                        $("#i-preco").append( '<option value="10000-50000">$10.000 a $50.000</option>' );
                        $("#i-preco").append( '<option value="50001-10000">$50.001 a $100.000</option>' );
                        $("#i-preco").append( '<option value="100001-200000">$100.001 a $200.000</option>' );
                        $("#i-preco").append( '<option value="200001-400000">$200.001 a $400.000</option>' );
                        $("#i-preco").append( '<option value="400001-800000">$400.001 a $800.000</option>' );
                        $("#i-preco").append( '<option value="800001-1000000">$800.001 a $1.000.000</option>' );
                        $("#i-preco").append( '<option value="1000001-2000000">$1.000.001 a $2.000.000</option>' );
                        $("#i-preco").append( '<option value="2000001-90000000">Acima de $2.000.000</option>' );
                    };
                    if(  $( "#i-finalidade" ).val() == 'L' )
                    {
                        $("#i-preco").empty();
                        $("#i-preco").append( '<option value="">Todos</option>' );
                        $("#i-preco").append( '<option value="100-500">$100 a $500</option>' );
                        $("#i-preco").append( '<option value="501-1000">$501 a $1000</option>' );
                        $("#i-preco").append( '<option value="1001-2000">$1001 a $2000</option>' );
                        $("#i-preco").append( '<option value="2001-4000">$2001 a $4000</option>' );
                        $("#i-preco").append( '<option value="4001-8000">$4001 a $8000</option>' );
                        $("#i-preco").append( '<option value="8001-9000000">Acima de $8001</option>' );
                    };
                }
            );


         });             

        </script>

        <!-- MAIN JS -->
        <script src="{{asset('pagesirius/js/script.js')}}"></script>

    </div>
    <!-- Wrapper / End -->
</body>

</html>
