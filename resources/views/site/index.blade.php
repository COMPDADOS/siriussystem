<!DOCTYPE HTML>
<html lang="en">
    <head>
        <!--=============== basic  ===============-->
        <meta charset="UTF-8">
        <title>Chab Imóveis - Bauru(SP)</title>
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>
        <!--=============== css  ===============-->	
        <link type="text/css" rel="stylesheet" href="{{asset('/site/css/plugins.css')}}">
        <link type="text/css" rel="stylesheet" href="{{asset('/site/css/style.css')}}">
        <link type="text/css" rel="stylesheet" href="{{asset('/site/css/color.css')}}">
        <!--=============== favicons ===============-->
        <link rel="shortcut icon" href="{{asset('/site/images/favicon.ico')}}">
        <style>
		.img-200
            {
                max-width:100%;    
                width:200px;
				height:200px;            
				max-height:200px;            
			}

            
            .img-40
            {
                max-width:100%;    
                width:120px;
				height:70px;            
				max-height:70px;            
			}

        .preto
        {
            color:black;
        }
        </style>            

    </head>
    <body>
        <!--loader-->
        <div class="loader-wrap">
            <div class="loader-inner">
                <svg>
                    <defs>
                        <filter id="goo">
                            <fegaussianblur in="SourceGraphic" stdDeviation="2" result="blur" />
                            <fecolormatrix in="blur"   values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 5 -2" result="gooey" />
                            <fecomposite in="SourceGraphic" in2="gooey" operator="atop"/>
                        </filter>
                    </defs>
                </svg>
            </div>
        </div>
        <!--loader end-->
        <!-- main -->
        <div id="main">
            <!-- header -->
            @include('site.menutop')
            <!-- header end  -->	
            <!-- wrapper  -->	
            <div id="wrapper">
                <!-- content -->	
                <div class="content">
                    <!--  section  -->
                    <section class="hero-section gray-bg">
                        <form method="get" action="{{route('pesquisar')}}">
                        <div class="bg-wrap">
                            <div class="half-hero-bg-media full-height">
                                <div class="slider-progress-bar">
                                    <span>
                                        <svg class="circ" width="30" height="30">
                                            <circle class="circ2" cx="15" cy="15" r="13" stroke="rgba(255,255,255,0.4)" stroke-width="1" fill="none"/>
                                            <circle class="circ1" cx="15" cy="15" r="13" stroke="#fff" stroke-width="2" fill="none"/>
                                        </svg>
                                    </span>
                                </div>

                                <div class="slideshow-container" >
                                @foreach( $capa as $imovel)
                                    <!-- slideshow-item -->
                                    <div class="slideshow-item">
                                        <div class="bg"  data-bg="http://www.chabimoveis.com.br/sys/storage/images/1/imoveis/{{$imovel->IMB_IMV_ID}}/{{$imovel->IMB_IMG_ARQUIVO}}"></div>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="hero-title hero-title_small">
                                <h4>BEM-VINDOS A CHAB IMÓVEIS</h4>
                                <h2>Encontre aqui o imóvel <br>
                                    que procura
                                </h2>
                            </div>
                            <div class="main-search-input-wrap shadow_msiw">
                                <div class="main-search-input fl-wrap">
                                    <div class="main-search-input-item">
                                        <input type="text" placeholder="Bairro, ou uma parte do nome" name="bairro"/>
                                    </div>
                                    <div class="main-search-input-item">
                                        <select data-placeholder="Escolha"  class="chosen-select no-search-select" name="finalidade" id="finalidade">
                                            <option value="V"> Venda</option>
                                            <option value="L">Locação</option>
                                        </select>
                                    </div>
                                    <div class="main-search-input-item">
                                        <select data-placeholder="Tipo de Imóvel" class="chosen-select on-radius no-search-select" name="tipoimovel">
                                            <option>Todos os Tipos</option>
                                            @foreach( $tipoimovel as $ti)
                                                <option value="{{$ti->IMB_TIM_ID}}">{{$ti->IMB_TIM_DESCRICAO}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="main-search-input-item">
                                        <select data-placeholder="dormitorios" class="chosen-select on-radius no-search-select" name="dormitorios">
                                            <option>Dormitórios</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4 ou +</option>
                                        </select>
                                    </div>
                                    <div class="main-search-input-item">
                                        <select data-placeholder="Faixa de Preço" class="chosen-select on-radius no-search-select" id="i-faixa-preco" name="faixapreco">
                                            <option value="">Selecione a faixa de valor</option>
                                            <option value="100-1000">R$ 100 a R$1.000</option>
                                            <option value="1001-2000">R$ 1.001 a R$2.000</option>
                                            <option value="2001-3000">R$ 2.001 a R$3.000</option>
                                            <option value="3001-5000">R$ 3.001 a R$5.000</option>
                                            <option value="5001-10000">R$ 5.001 a R$10.000</option>
                                            <option value="10001-20000">R$ 10.001 a $20.000</option>
                                            <option value="5000-20000">R$ 5.000 a R$20.000</option>
                                            <option value="20001-50000">R$ 20.001 a R$50.000</option>
                                            <option value="50001-100000">R$ 50.001 a R$100.000</option>
                                            <option value="100001-300000">R$ 100.001 a R$300.000</option>
                                            <option value="300001-600000">R$ 300.001 a R$600.000</option>
                                            <option value="600001-1000000">R$ 600.001 a R$ 1 Milhão</option>
                                            <option value="1000001-3000000">R$ 1 Milhão a R$ 3 milhões</option>
                                            <option value="3000001-50000000">Acima de R$ 3 milhões</option>
                                        </select>
                                    </div>

                                    <div class="main-search-input-item">
                                        <input type="text" placeholder="Código(referência)" name="referencia">
                                    </div>

                                    <button class="main-search-button color-bg"><i class="far fa-search"></i> Pesquisar </button>

                                </div>
                            </div>
                            
                        </div>
                        </form>
                    </section>
                    <!--  section  end-->
                    <!-- breadcrumbs-->
                    <!-- breadcrumbs end -->
                    <!-- section -->
                    <section class="gray-bg small-padding">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="section-title fl-wrap">
                                        <h4>Imóveis Disponíveis</h4>
                                        <h2>Nossos novos cadastros</h2>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="listing-filters gallery-filters">
                                        <a href="#" class="gallery-filter  gallery-filter-active" data-filter="*"> <span>Todos</span></a>
                                        <a href="#" class="gallery-filter" data-filter=".for_sale"> <span>Venda</span></a>
                                        <a href="#" class="gallery-filter" data-filter=".for_rent"> <span>Locação</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <!-- grid-item-holder-->	
                            <div class="grid-item-holder gallery-items gisp fl-wrap">
                                <!-- gallery-item-->
                                @foreach( $ultimos as $imovel)
                                @if( $imovel->IMB_IMV_VALLOC <> 0 and $imovel->IMB_IMV_VALVEN <> 0 )
                                    <div class="gallery-item for_sale">
                                        <!-- listing-item -->
                                        <div class="listing-item">
                                            <article class="geodir-category-listing fl-wrap">
                                                <div class="geodir-category-img fl-wrap">
                                                    <a href="{{route('detalhe')}}/{{$imovel->IMB_IMV_ID}}" class="geodir-category-img_item">
                                                        @if( $imovel->IMB_IMG_ARQUIVO )
                                                        <img class="img-200" src="http://www.chabimoveis.com.br/sys/storage/images/1/imoveis/{{$imovel->IMB_IMV_ID}}/{{$imovel->IMB_IMG_ARQUIVO}}" alt="">                <div class="overlay"></div>
                                                        @else
                                                        <img class="img-200" src="https://www.chabimoveis.com.br/sys/storage/images/1/logos/logo_200_200.jpg" alt="">                
                                                        @endif
                                                        <div class="overlay"></div>                                                        
                                                    </a>
                                                    <div class="geodir-category-location">
                                                        <a href="#" class="single-map-item tolt" data-newlatitude="40.72956781" data-newlongitude="-73.99726866"   data-microtip-position="top-left" data-tooltip="Ver detalhes"><i class="fas fa-map-marker-alt"></i> <span>
                                                            
                                                        @if( $imovel->IMB_IMV_TITULO  )
                                                            <b>{{ $imovel->IMB_IMV_TITULO }}</b>
                                                        @else
                                                            <b>{{ $imovel->IMB_TIM_DESCRICAO }}, em {{$imovel->IMB_IMV_CIDADE}} no bairro {{$imovel->CEP_BAI_NOME}}</b>
                                                       @endif
                                                       
                                                        </span></a>
                                                    </div>
                                                    <ul class="list-single-opt_header_cat">
                                                        <li><a href="{{route('detalhe')}}/{{$imovel->IMB_IMV_ID}}" class="cat-opt blue-bg">Venda</a></li>
                                                        <li><a href="{{route('detalhe')}}/{{$imovel->IMB_IMV_ID}}" class="cat-opt color-bg">{{$imovel->IMB_TIM_DESCRICAO}}</a></li>
                                                    </ul>
                                                    <div class="geodir-category-listing_media-list">
                                                        <span><i class="fas fa-camera"></i> {{$imovel->QTDFOTOS}}</span>
                                                    </div>
                                                </div>
                                                <div class="geodir-category-content fl-wrap">
                                                    <h3 class="title-sin_item"><a href="{{route('detalhe')}}/{{$imovel->IMB_IMV_ID}}">{{$imovel->CEP_BAI_NOME}}</a></h3>
                                                    <div class="geodir-category-content_price">R${{number_format($imovel->IMB_IMV_VALVEN, 2, ',', '.')}}</div>
                                                    <div class="geodir-category-content-details">
                                                        <ul>
                                                            <li><i class="fal fa-bed"></i><span>{{$imovel->IMB_IMV_DORQUA}}</span></li>
                                                            <li><i class="fal fa-bath"></i><span>{{$imovel->IMB_IMV_WCQUA}}</span></li>
                                                            <li><i class="fal fa-cube"></i><span>{{$imovel->IMB_IMV_ARECON}}</span></li>
                                                        </ul>
                                                    </div>
                                                    <div class="geodir-category-footer fl-wrap">
                                                        <a href="{{route('detalhe')}}/{{$imovel->IMB_IMV_ID}}" class="gcf-company"><img src="{{asset('site/images/logoavatar.png')}}" alt=""><span>Chab Imóveis</span></a>
                                                        <div>{{$imovel->IMB_IMV_REFERE}}</div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <!-- listing-item end-->															
                                    </div>
                                    <div class="gallery-item for_rent">
                                        <!-- listing-item -->
                                        <div class="listing-item">
                                            <article class="geodir-category-listing fl-wrap">
                                                <div class="geodir-category-img fl-wrap">
                                                    <a href="{{route('detalhe')}}/{{$imovel->IMB_IMV_ID}}" class="geodir-category-img_item">
                                                        @if( $imovel->IMB_IMG_ARQUIVO )
                                                        <img class="img-200" src="http://www.chabimoveis.com.br/sys/storage/images/1/imoveis/{{$imovel->IMB_IMV_ID}}/{{$imovel->IMB_IMG_ARQUIVO}}" alt="">                <div class="overlay"></div>
                                                        @else
                                                        <img class="img-200" src="https://www.chabimoveis.com.br/sys/storage/images/1/logos/logo_200_200.jpg" alt="">                
                                                        @endif
                                                    </a>
                                                    <div class="geodir-category-location">
                                                        <a href="#" class="single-map-item tolt" data-newlatitude="40.72956781" data-newlongitude="-73.99726866"   data-microtip-position="top-left" data-tooltip="Ver detalhes"><i class="fas fa-map-marker-alt"></i> 
                                                        <span>                                                            
                                                        @if( $imovel->IMB_IMV_TITULO  )
                                                            <b>{{ $imovel->IMB_IMV_TITULO }}</b>
                                                        @else
                                                            <b>{{ $imovel->IMB_TIM_DESCRICAO }}, em {{$imovel->IMB_IMV_CIDADE}} no bairro {{$imovel->CEP_BAI_NOME}}</b>
                                                       @endif
                                                       
                                                        </span></a>
                                                    </div>
                                                    <ul class="list-single-opt_header_cat">
                                                        <li><a href="{{route('detalhe')}}/{{$imovel->IMB_IMV_ID}}" class="cat-opt blue-bg">Locação</a></li>
                                                        <li><a href="{{route('detalhe')}}/{{$imovel->IMB_IMV_ID}}" class="cat-opt color-bg">{{$imovel->IMB_TIM_DESCRICAO}}</a></li>
                                                    </ul>
                                                    <div class="geodir-category-listing_media-list">
                                                        <span><i class="fas fa-camera"></i> {{$imovel->QTDFOTOS}}</span>
                                                    </div>
                                                </div>
                                                <div class="geodir-category-content fl-wrap">
                                                    <h3 class="title-sin_item"><a href="listing-single.html">{{$imovel->CEP_BAI_NOME}}</a></h3>
                                                    <div class="geodir-category-content_price">R${{number_format($imovel->IMB_IMV_VALLOC, 2, ',', '.')}}</div>
                                                    <div class="geodir-category-content-details">
                                                        <ul>
                                                            <li><i class="fal fa-bed"></i><span>{{$imovel->IMB_IMV_DORQUA}}</span></li>
                                                            <li><i class="fal fa-bath"></i><span>{{$imovel->IMB_IMV_WCQUA}}</span></li>
                                                            <li><i class="fal fa-cube"></i><span>{{$imovel->IMB_IMV_ARECON}}</span></li>
                                                        </ul>
                                                    </div>
                                                    <div class="geodir-category-footer fl-wrap">
                                                    <a href="{{route('detalhe')}}/{{$imovel->IMB_IMV_ID}}" class="gcf-company"><img src="{{asset('site/images/logoavatar.png')}}" alt=""><span>Chab Imóveis</span></a>                                                        <div>{{$imovel->IMB_IMV_REFERE}}</div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <!-- listing-item end-->															
                                    </div>                                    
                                @elseif( $imovel->IMB_IMV_VALLOC <> 0)
                                    <div class="gallery-item for_rent">
                                        <!-- listing-item -->
                                        <div class="listing-item">
                                            <article class="geodir-category-listing fl-wrap">
                                                <div class="geodir-category-img fl-wrap">
                                                    <a href="{{route('detalhe')}}/{{$imovel->IMB_IMV_ID}}" class="geodir-category-img_item">
                                                        @if( $imovel->IMB_IMG_ARQUIVO )
                                                        <img class="img-200" src="http://www.chabimoveis.com.br/sys/storage/images/1/imoveis/{{$imovel->IMB_IMV_ID}}/{{$imovel->IMB_IMG_ARQUIVO}}" alt="">                <div class="overlay"></div>
                                                        @else
                                                        <img class="img-200" src="https://www.chabimoveis.com.br/sys/storage/images/1/logos/logo_200_200.jpg" alt="">                
                                                        @endif
                                                    </a>
                                                    <div class="geodir-category-location">
                                                        <a href="{{route('detalhe')}}/{{$imovel->IMB_IMV_ID}}" class="single-map-item tolt" data-newlatitude="40.72956781" data-newlongitude="-73.99726866"   data-microtip-position="top-left" data-tooltip="Ver detalhes"><i class="fas fa-map-marker-alt"></i> 
                                                        <span>                                                            
                                                        @if( $imovel->IMB_IMV_TITULO  )
                                                            <b>{{ $imovel->IMB_IMV_TITULO }}</b>
                                                        @else
                                                            <b>{{ $imovel->IMB_TIM_DESCRICAO }}, em {{$imovel->IMB_IMV_CIDADE}} no bairro {{$imovel->CEP_BAI_NOME}}</b>
                                                       @endif
                                                       
                                                        </span></a>
                                                    </div>
                                                    <ul class="list-single-opt_header_cat">
                                                        <li><a href="{{route('detalhe')}}/{{$imovel->IMB_IMV_ID}}" class="cat-opt blue-bg">Locação</a></li>
                                                        <li><a href="{{route('detalhe')}}/{{$imovel->IMB_IMV_ID}}" class="cat-opt color-bg">{{$imovel->IMB_TIM_DESCRICAO}}</a></li>
                                                    </ul>
                                                    <div class="geodir-category-listing_media-list">
                                                        <span><i class="fas fa-camera"></i> {{$imovel->QTDFOTOS}}</span>
                                                    </div>
                                                </div>
                                                <div class="geodir-category-content fl-wrap">
                                                    <h3 class="title-sin_item"><a href="{{route('detalhe')}}/{{$imovel->IMB_IMV_ID}}">{{$imovel->CEP_BAI_NOME}}</a></h3>
                                                    <div class="geodir-category-content_price">R${{number_format($imovel->IMB_IMV_VALLOC, 2, ',', '.')}}</div>
                                                    <div class="geodir-category-content-details">
                                                        <ul>
                                                            <li><i class="fal fa-bed"></i><span>{{$imovel->IMB_IMV_DORQUA}}</span></li>
                                                            <li><i class="fal fa-bath"></i><span>{{$imovel->IMB_IMV_WCQUA}}</span></li>
                                                            <li><i class="fal fa-cube"></i><span>{{$imovel->IMB_IMV_ARECON}}</span></li>
                                                        </ul>
                                                    </div>
                                                    <div class="geodir-category-footer fl-wrap">
                                                    <a href="{{route('detalhe')}}/{{$imovel->IMB_IMV_ID}}" class="gcf-company"><img src="{{asset('site/images/logoavatar.png')}}" alt=""><span>Chab Imóveis</span></a>                                                        <div>{{$imovel->IMB_IMV_REFERE}}</div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <!-- listing-item end-->															
                                    </div>                                                                    
                                @elseif  ( $imovel->IMB_IMV_VALVEN <> 0)
                                    <div class="gallery-item for_sale">
                                        <!-- listing-item -->
                                        <div class="listing-item">
                                            <article class="geodir-category-listing fl-wrap">
                                                <div class="geodir-category-img fl-wrap">
                                                    <a href="{{route('detalhe')}}/{{$imovel->IMB_IMV_ID}}" class="geodir-category-img_item">
                                                        @if( $imovel->IMB_IMG_ARQUIVO )
                                                        <img class="img-200" src="http://www.chabimoveis.com.br/sys/storage/images/1/imoveis/{{$imovel->IMB_IMV_ID}}/{{$imovel->IMB_IMG_ARQUIVO}}" alt="">                <div class="overlay"></div>
                                                        @else
                                                        <img class="img-200" src="https://www.chabimoveis.com.br/sys/storage/images/1/logos/logo_200_200.jpg" alt="">                
                                                        @endif
                                                        <div class="overlay"></div>
                                                    </a>
                                                    <div class="geodir-category-location">
                                                        <a href="{{route('detalhe')}}/{{$imovel->IMB_IMV_ID}}" class="single-map-item tolt" data-newlatitude="40.72956781" data-newlongitude="-73.99726866"   data-microtip-position="top-left" data-tooltip="Ver detalhes"><i class="fas fa-map-marker-alt"></i> 
                                                        <span>                                                              
                                                        @if( $imovel->IMB_IMV_TITULO  )
                                                            <b>{{ $imovel->IMB_IMV_TITULO }}</b>
                                                        @else
                                                            <b>{{ $imovel->IMB_TIM_DESCRICAO }}, em {{$imovel->IMB_IMV_CIDADE}} no bairro {{$imovel->CEP_BAI_NOME}}</b>
                                                       @endif
                                                       </span></a>
                                                    </div>
                                                    <ul class="list-single-opt_header_cat">
                                                        <li><a href="{{route('detalhe')}}/{{$imovel->IMB_IMV_ID}}" class="cat-opt blue-bg">Venda</a></li>
                                                        <li><a href="{{route('detalhe')}}/{{$imovel->IMB_IMV_ID}}" class="cat-opt color-bg">{{$imovel->IMB_TIM_DESCRICAO}}</a></li>
                                                    </ul>
                                                    <div class="geodir-category-listing_media-list">
                                                        <span><i class="fas fa-camera"></i> {{$imovel->QTDFOTOS}}</span>
                                                    </div>
                                                </div>
                                                <div class="geodir-category-content fl-wrap">
                                                    <h3 class="title-sin_item"><a href="{{route('detalhe')}}/{{$imovel->IMB_IMV_ID}}">{{$imovel->CEP_BAI_NOME}}</a></h3>
                                                    <div class="geodir-category-content_price">R${{number_format($imovel->IMB_IMV_VALVEN, 2, ',', '.')}}</div>

                                                    <div class="geodir-category-content-details">
                                                        <ul>
                                                            <li><i class="fal fa-bed"></i><span>{{$imovel->IMB_IMV_DORQUA}}</span></li>
                                                            <li><i class="fal fa-bath"></i><span>{{$imovel->IMB_IMV_WCQUA}}</span></li>
                                                            <li><i class="fal fa-cube"></i><span>{{$imovel->IMB_IMV_ARECON}}</span></li>
                                                        </ul>
                                                    </div>
                                                    <div class="geodir-category-footer fl-wrap">
                                                    <a href="https://wa.me/5514997002400?text=Olá!%20Gostaria%20de%20receber%20mais%20informações%20sobre%20o%20imóvel%20{{$imovel->IMB_IMV_REFERE}}" class="gcf-company" target="_blank"><img class="img-50" src="{{asset('site/images/logoavatar.png')}}" alt=""><span>Chab Imóveis</span></a>
                                                    <div>{{$imovel->IMB_IMV_REFERE}}</div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <!-- listing-item end-->															
                                    </div>                                                                                                    
                                @endif
                                @endforeach

                                <!-- gallery-item end-->																
                            </div>
                            <!-- grid-item-holder-->	
                            <a href="{{route('pesquisar')}}" class="btn float-btn small-btn color-bg">Top 50</a>
                        </div>
                    </section>
                    <!-- section end-->	
                    <!-- section -->
                    <section>
                        <div class="container">
                            <!--about-wrap -->
                            <div class="about-wrap">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="about-title ab-hero fl-wrap">
                                            <h2>Porquê alugar, comprar ou vender seus imóveis conosco? </h2>
                                        </div>
                                        <div class="services-opions fl-wrap">
                                            <ul>
                                                <li>
                                                    <i class="fal fa-headset"></i>
                                                    <h4>Garantia de Segurança na Locação  </h4>
                                                    <p>Somos especializados em locação de imóveis e temos um grande suporte administrativo e jurídico para melhor atendê-lo</p>
                                                </li>
                                                <li>
                                                    <i class="fal fa-users-cog"></i>
                                                    <h4>Acesso a Informações no Site</h4>
                                                    <p>Em nosso site, você poderá emitir 2ª via de boletos, emitir extratos, informes, etc... </p>
                                                </li>
                                                <li>
                                                    <i class="fal fa-phone-laptop"></i>
                                                    <h4>Mobilidade</h4>
                                                    <p>Onde quer que você esteja, poderá acessar nossos serviços de qualquer smartphone</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-6">
                                    </div>
                                </div>
                            </div>
                            <!-- about-wrap end  -->							
                        </div>
                    </section>
                    <!-- section end-->	
                    
                    <!-- section end-->					
                    <!-- section -->
                    <section class="color-bg small-padding">
                        <div class="container">
                            <div class="main-facts fl-wrap">
                                <!-- inline-facts  -->
                                <div class="inline-facts-wrap">
                                    <div class="inline-facts">
                                        <div class="milestone-counter">
                                            <div class="stats animaper">
                                                <div class="num" data-content="0" data-num="{{$qtdimoveis}}">0</div>
                                            </div>
                                        </div>
                                        <h6>Imóveis Disponíveis</h6>
                                    </div>
                                </div>
                                <!-- inline-facts end -->
                                <!-- inline-facts  -->
                                <div class="inline-facts-wrap">
                                    <div class="inline-facts">
                                        <div class="milestone-counter">
                                            <div class="stats animaper">
                                                <div class="num" data-content="0" data-num="{{$qtdclientes}}">0</div>
                                            </div>
                                        </div>
                                        <h6>Clientes atendidos</h6>
                                    </div>
                                </div>
                                <!-- inline-facts end -->
                                <!-- inline-facts  -->
                                <div class="inline-facts-wrap">
                                    <div class="inline-facts">
                                        <div class="milestone-counter">
                                            <div class="stats animaper">
                                                <div class="num" data-content="0" data-num="{{$qtdatendimentos}}">0</div>
                                            </div>
                                        </div>
                                        <h6>Atendimentos Realizados</h6>
                                    </div>
                                </div>
                                <!-- inline-facts end -->
                                <!-- inline-facts  -->
                                <!-- inline-facts end -->
                            </div>
                        </div>
                        <div class="svg-bg">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100%"
                                height="100%" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMax slice">
                                <defs>
                                    <lineargradient id="bg">
                                        <stop offset="0%" style="stop-color:rgba(255, 255, 255, 0.6)"></stop>
                                        <stop offset="50%" style="stop-color:rgba(255, 255, 255, 0.1)"></stop>
                                        <stop offset="100%" style="stop-color:rgba(255, 255, 255, 0.6)"></stop>
                                    </lineargradient>
                                    <path id="wave" stroke="url(#bg)" fill="none" d="M-363.852,502.589c0,0,236.988-41.997,505.475,0
                                        s371.981,38.998,575.971,0s293.985-39.278,505.474,5.859s493.475,48.368,716.963-4.995v560.106H-363.852V502.589z" />
                                </defs>
                                <g>
                                    <use xlink:href="#wave">
                                        <animatetransform attributeName="transform" attributeType="XML" type="translate" dur="10s" calcMode="spline"
                                            values="270 230; -334 180; 270 230" keyTimes="0; .5; 1" keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
                                            repeatCount="indefinite" />
                                    </use>
                                    <use xlink:href="#wave">
                                        <animatetransform attributeName="transform" attributeType="XML" type="translate" dur="8s" calcMode="spline"
                                            values="-270 230;243 220;-270 230" keyTimes="0; .6; 1" keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
                                            repeatCount="indefinite" />
                                    </use>
                                    <use xlink:href="#wave">
                                        <animatetransform attributeName="transform" attributeType="XML" type="translate" dur="6s" calcMode="spline"
                                            values="0 230;-140 200;0 230" keyTimes="0; .4; 1" keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
                                            repeatCount="indefinite" />
                                    </use>
                                    <use xlink:href="#wave">
                                        <animatetransform attributeName="transform" attributeType="XML" type="translate" dur="12s" calcMode="spline" values="0 240;140 200;0 230"
                                            keyTimes="0; .4; 1" keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0" repeatCount="indefinite" />
                                    </use>
                                </g>
                            </svg>
                        </div>
                    </section>
                    <section >
                        <div class="container">
                            <!-- section-title -->
                            <div class="section-title st-center fl-wrap">
                                <h4>O Melhor Atendimento</h4>
                                <h2>Nossos Corretores e Colaboradores</h2>
                            </div>
                            <!-- section-title end -->
                            <div class="clearfix"></div>
                            <div class="listing-carousel-wrapper lc_hero carousel-wrap fl-wrap">
                                <div class="listing-carousel carousel ">
                                    <!-- slick-slide-item -->
                                    <div class="slick-slide-item">
                                        <!--  agent card item -->
                                        <div class="listing-item">
                                            <article class="geodir-category-listing fl-wrap">
                                                <div class="geodir-category-img fl-wrap  agent_card">
                                                    <a href="{{route('siteindex')}}" >
                                                        <img class="img-200" src="{{asset('site/images/female.png')}}" alt="">
                                                    </a>
                                                    <div class="agent-card-social fl-wrap">
                                                        <ul>
                                                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                                            <li><a href="#" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="geodir-category-content fl-wrap">
                                                    <div class="agent_card-title fl-wrap">
                                                        <h4><a href="agent-single.html" >Ricardo Guimarães</a></h4>
                                                        <h5><a href="">Diretor</a></h5>
                                                    </div>
                                                    <div class="geodir-category-footer fl-wrap">
                                                        <a href="mailto: ricardo@elianachab.com.br" class="tolt ftr-btn" data-microtip-position="left" data-tooltip="Envie uma mensagem"><i class="fal fa-envelope"></i></a>
                                                        <a href="" class="tolt ftr-btn" data-microtip-position="left" data-tooltip="Ligue agora"><i class="fal fa-phone"></i></a>	
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <!--  agent card item end -->
                                    </div>
                                    <div class="slick-slide-item">
                                        <!--  agent card item -->
                                        <div class="listing-item">
                                            <article class="geodir-category-listing fl-wrap">
                                                <div class="geodir-category-img fl-wrap  agent_card">
                                                    <a href="{{route('siteindex')}}" >
                                                        <img class="img-200"  src="{{asset('site/images/male.png')}}" alt="">
                                                    </a>
                                                    <div class="agent-card-social fl-wrap">
                                                        <ul>
                                                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                                            <li><a href="#" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="geodir-category-content fl-wrap">
                                                    <div class="agent_card-title fl-wrap">
                                                        <h4><a href="agent-single.html" >Carla</a></h4>
                                                        <h5><a href="agency-single.html">Administrativo</a></h5>
                                                    </div>
                                                    <div class="geodir-category-footer fl-wrap">
                                                        <a href="mailto: carla@elianachab.com.br" class="tolt ftr-btn" data-microtip-position="left" data-tooltip="Envie uma mensagem"><i class="fal fa-envelope"></i></a>
                                                        <a href="" class="tolt ftr-btn" data-microtip-position="left" data-tooltip="Ligue agora"><i class="fal fa-phone"></i></a>	
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <!--  agent card item end -->
                                    </div>                                    
                                    
                                    <!-- slick-slide-item -->
                                    <!-- slick-slide-item end-->								
                                </div>
                                <div class="swiper-button-prev lc-wbtn lc-wbtn_prev"><i class="far fa-angle-left"></i></div>
                                <div class="swiper-button-next lc-wbtn lc-wbtn_next"><i class="far fa-angle-right"></i></div>
                            </div>
                        </div>
                    </section>                    
                    <!-- section end-->	 
                    <!-- section -->
                    
                    <!-- section end-->
                </div>
                <!-- content end -->	
                <!-- subscribe-wrap -->	
                
                <!-- subscribe-wrap end -->	
                <!-- footer -->	
                <footer class="main-footer fl-wrap">
                    <div class="footer-inner fl-wrap">
                        <div class="container">
                            <div class="row">
                                <!-- footer widget-->
                                <div class="col-md-3">
                                    <div class="footer-widget fl-wrap">
                                        <div class="footer-widget-logo fl-wrap">
                                            <img src="{{asset('site/images/logo.png')}}" alt="">
                                        </div>
                                        <p>Nossa imobiliária terá o enorme prazer em poder te conhecer e atendê-lo.</p>
                                        <div class="fw_hours fl-wrap">
                                            <span>Segunda a sexta:<strong> 08:00hs - 18:00hs</strong></span>
                                            <span>Sábado:<strong> 08:00hs - 12:00hs</strong></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- footer widget end-->
                                <!-- footer widget-->
                                <div class="col-md-3">
                                    <div class="footer-widget fl-wrap">
                                        <div class="footer-widget-title fl-wrap">
                                            <h4>Links Úteis</h4>
                                        </div>
                                        <ul class="footer-list fl-wrap">
                                            <li><a href="http://www8.caixa.gov.br/siopiinternet-web/simulaOperacaoInternet.do?method=inicializarCasoUso">Crédito Imobiliário CEF</a></li>
                                            <li><a href="https://www.projuris.com.br/lei-do-inquilinato/">Lei do Inquilinato</a></li>
                                            <li><a href="https://www.primecont.net/blog/976-declaracao-ir-2021-o-que-sao-rendimentos-tributaveis.html?https://primecont.net/?utm_source=googleads&utm_medium=cpc&utm_campaign=P2-RP-trafego-site-pagina-servicos&gclid=Cj0KCQiA-K2MBhC-ARIsAMtLKRsTy062l_uITh-YwOa3ujRkd5W3cr9PMk7S5krwByRfSfjAm67OHmMaArYzEALw_wcB">Entenda o que é declarado no IRRF</a></li>
                                            <li><a href="https://www.debit.com.br/tabelas/reajuste-aluguel.php">Índices de Reajustes de Aluguéres</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- footer widget end--> 
                                <!-- footer widget-->
                                <div class="col-md-6">
                                    <div class="footer-widget fl-wrap">
                                        <div class="footer-widget-title fl-wrap">
                                            <h4>Entre em contato</h4>
                                        </div>
                                        <ul  class="footer-contacts fl-wrap">
                                            <li><span><i class="fal fa-envelope"></i> E-mail :</span><a href="#" target="_blank">adm@elianachab.com.br</a></li>
                                            <li> <span><i class="fal fa-map-marker"></i> Endereço :</span><a href="#" target="_blank">Rua Rubens de Mello Souza 2-38 Jardim Europa - Bauru(SP)</a></li>
                                            <li><span><i class="fal fa-phone"></i> Telefone:</span><a href="#">+(14)2107-9400</li>
                                            <li><span><i class="fab fa-whatsapp"></i> Whatsapp Administrativo:</span><a href="https://wa.me/5514997002400?text=Olá!%20Gostaria%20de%20receber%20mais%20informações">+(14)</li>
                                            <li><span><i class="fab fa-whatsapp"></i> Whatsapp Comercial:</span><a href="https://wa.me/5514997002400?text=Olá!%20Gostaria%20de%20receber%20mais%20informações">+(14)</li>
                                        </ul>
                                        <div class="footer-social fl-wrap">
                                            <ul>
                                                <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- footer widget end-->   
                                <!-- footer widget-->
                                
                                <!-- footer widget end-->                                     
                            </div>
                        </div>
                    </div>
                    <!--sub-footer-->
                    <div class="sub-footer gray-bg fl-wrap">
                        <div class="container">
                            <div class="copyright"> &#169; Sirius System 2021 .  All rights reserved.</div>
                            
                            </div>
                        </div>
                    </div>
                    <!--sub-footer end -->                     
                </footer>
                <!-- footer end -->
            </div>
            <!-- wrapper end -->
            <!--register form -->
                        @include('site.register')
            <!--register form end -->
            <!--secondary-nav -->
            <div class="secondary-nav">
                
                <div class="progress-indicator">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="-1 -1 34 34">
                        <circle cx="16" cy="16" r="15.9155"
                            class="progress-bar__background" />
                        <circle cx="16" cy="16" r="15.9155"
                            class="progress-bar__progress 
                            js-progress-bar" />
                    </svg>
                </div>
            </div>
            <!--secondary-nav end -->
            <a class="to-top color-bg"><i class="fas fa-caret-up"></i></a>   
            <!--map-modal -->
            <div class="map-modal-wrap">
                <div class="map-modal-wrap-overlay"></div>
                <div class="map-modal-item">
                    <div class="map-modal-container fl-wrap">
                        <h3> <span>Listing Title </span></h3>
                        <div class="map-modal-close"><i class="far fa-times"></i></div>
                        <div class="map-modal fl-wrap">
                            <div id="singleMap" data-latitude="40.7" data-longitude="-73.1"></div>
                            <div class="scrollContorl"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--map-modal end --> 			
        </div>
        <!-- Main end -->
        <!--=============== scripts  ===============-->
        <script src="{{asset('/site/js/jquery.min.js')}}"></script>
        <script src="{{asset('/site/js/plugins.js')}}"></script>
        <script src="{{asset('/site/js/scripts.js')}}"></script>
        <script>

        </script>
        
    </body>
</html>