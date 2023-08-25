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
        <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">        
        <style>
            		.img-200
            {
                max-width:100%;    
                width:300px;
				height:300px;            
				max-height:300px;            
			}

            .bg-blue
            {
                background-color:blue;                
                color:white;
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
                    <!-- categoties-column -->
                    <div class="categoties-column cc-right cc-top">
                        <div class="categoties-column_container cat-list">
                            <ul>
                                <li><a href="https://www.chabimoveis.com.br/sys/site/pesquisar?finalidade=&tipoimovel=8" class="act-category"><i class="fal fa-city"></i><span>Apartamentos</span></a></li>
                                <li><a href="https://www.chabimoveis.com.br/sys/site/pesquisar?finalidade=&tipoimovel=9"><i class="fal fa-car-building"></i><span>Casas</span></a></li>
                                <li><a href="https://www.chabimoveis.com.br/sys/site/pesquisar?finalidade=&tipoimovel=2"><i class="fal fa-home"></i><span>Terrenos</span></a></li>
                            </ul>
                        </div>
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
                    <!-- categoties-column end -->
                    <!-- Map -->
                    <div class="map-container column-map right-position-map no-top_search">
                        <a title="Click na imagem para maiores informações" 
                        href="https://www.youtube.com/embed/8yU8aUoKFU8">
                    <img src="{{asset('/site/images/mirandela.png')}}" alt="">
                    </a>
                        
                    </div>
                    <!-- Map end -->					
                    <!-- col-list-wrap -->
                    <div class="col-list-wrap col-list-wrap_left no-top-pad gray-bg ">
                        <!-- list-searh-input-wrap-->
                        <div class="list-searh-input-wrap fl-wrap">
                            <div class="container">
                                <div class="list-searh-input-wrap-title fl-wrap"><i class="far fa-sliders-h"></i><span>Filtros de Busca</span></div>
                                <div class="custom-form fl-wrap">
                                <form method="get" action="{{route('pesquisar')}}">

                                    <div class="row">
                                        <!-- listsearch-input-item -->
                                        <!-- listsearch-input-item -->
                                        <!-- listsearch-input-item -->
                                        <div class="col-sm-2">
                                            <div class="listsearch-input-item">
                                                <select title="Qual finalidade?" data-placeholder="Finalidade" class="chosen-select on-radius no-search-select" name="finalidade" required>
                                                    <option value="V">Venda</option>
                                                    <option value="L">Locação</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <!-- listsearch-input-item -->								
                                        <!-- listsearch-input-item -->
                                        <div class="col-sm-3">
                                            <div class="listsearch-input-item">
                                                <select data-placeholder="Tipos" class="chosen-select on-radius no-search-select" name="tipoimovel">
                                                    <option>Tipos</option>
                                                    @foreach( $tipoimovel as $ti)
                                                        <option value="{{$ti->IMB_TIM_ID}}">{{$ti->IMB_TIM_DESCRICAO}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <!-- listsearch-input-item -->								
                                        <!-- listsearch-input-item -->
                                        <div class="col-sm-5">
                                            <div class="listsearch-input-item">
                                                <div class="price-rage-item fl-wrap">
                                                <select data-placeholder="Faixa de Preço" class="chosen-select on-radius no-search-select" id="i-faixa-preco" name="faixapreco">
                                                <option value="">Faixa de Valor</option>
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
                                        </select>                                                </div>
                                            </div>
                                        </div>
                                        <!-- listsearch-input-item -->								
                                        <!-- listsearch-input-item -->
                                        <div class="col-sm-1">
                                            <div class="listsearch-input-item">
                                                <button class="form-control btn btn-primary bg-blue"><i class="far fa-search"></i></button>                                                
                                            </div>
                                        </div>
                                        <!-- listsearch-input-item --> 						
                                    </div>
                                    <div class="hidden-listing-filter fl-wrap">
                                        <div class="row">
                                            <!-- listsearch-input-item -->								
                                            <div class="col-sm-2">
                                                <div class="listsearch-input-item">
                                                    <label>Dormitórios</label>
                                                    <select data-placeholder="Bedrooms" class="chosen-select on-radius no-search-select" name="dormitorios">
                                                        <option value=""></option>
                                                        <option  value="1">1</option>
                                                        <option  value="2">2</option>  
                                                        <option  value="3">3</option>
                                                        <option  value="4">4 ou mais</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- listsearch-input-item end-->
                                            <!-- listsearch-input-item -->								
                                            <div class="col-sm-1">
                                                <div class="listsearch-input-item">
                                                    <label>WC</label>
                                                    <select data-placeholder="Bathrooms" class="chosen-select on-radius no-search-select" name="banheiros" >
                                                        <option value=""></option>
                                                        <option  value="1">1</option>
                                                        <option  value="2">2</option>  
                                                        <option  value="3+">3</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="listsearch-input-item">
                                                    <label>Vagas Cobertas</label>
                                                    <select data-placeholder="Bathrooms" class="chosen-select on-radius no-search-select" name="vagascobertas" >
                                                        <option>Uma</option>
                                                        <option>Duas</option>
                                                        <option>Três ou mais</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="listsearch-input-item">
                                                    <label>Vagas Descobertas</label>
                                                    <select data-placeholder="Bathrooms" class="chosen-select on-radius no-search-select" name="vagasdescobertas" >
                                                        <option>Uma</option>
                                                        <option>Duas</option>
                                                        <option>Três ou mais</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- listsearch-input-item end-->
                                            <!-- listsearch-input-item -->
                                            <!-- listsearch-input-item end-->
                                            <!-- listsearch-input-item -->
                                            <div class="col-sm-2">
                                                <div class="listsearch-input-item">
                                                    <label>Código(referência)</label>
                                                    <input type="text" onClick="this.select()" placeholder="Código" value=""/>
                                                </div>
                                            </div>
                                            <!-- listsearch-input-item end-->								
                                            <!-- listsearch-input-item -->
                                            <!-- listsearch-input-item -->								
                                        </div>
                                        <div class="clearfix"></div>
                                        <!-- listsearch-input-item-->
                                        <div class="listsearch-input-item">
                                            <label>Recursos</label>
                                            <div class=" fl-wrap filter-tags">
                                                <ul class="no-list-style">
                                                    <li>
                                                        <input id="check-aa" type="checkbox" name="check">
                                                        <label for="check-aa">Elevadores</label>
                                                    </li>
                                                    <li>
                                                        <input id="check-b" type="checkbox" name="check">
                                                        <label for="check-b"> Lavanderia</label>
                                                    </li>
                                                    <li>
                                                        <input id="check-d1" type="checkbox" name="check">
                                                        <label for="check-d1">Coz. Planejada</label>
                                                    </li>
                                                    <li>
                                                        <input id="check-d" type="checkbox" name="check">
                                                        <label for="check-d">Ar Condicionado</label>
                                                    </li>
                                                    <li>
                                                        <input id="check-d2" type="checkbox" name="check" checked>
                                                        <label for="check-d2">Garagem</label> 
                                                    </li>
                                                    <li>
                                                        <input id="check-d3" type="checkbox" name="check" checked>
                                                        <label for="check-d3">Piscina</label> 
                                                    </li>
                                                    <li>   
                                                        <input id="check-d4" type="checkbox" name="check">
                                                        <label for="check-d4">Academia</label>
                                                    </li>
                                                    <li>   
                                                        <input id="check-d5" type="checkbox" name="check">
                                                        <label for="check-d5">Segur. 24hs</label>
                                                    </li>
                                                    <li>   
                                                        <input id="check-d6" type="checkbox" name="check">
                                                        <label for="check-d6">Churrasqueira</label>
                                                    </li>
                                                    <li>   
                                                        <input id="check-d7" type="checkbox" name="check">
                                                        <label for="check-d7">Playground</label>
                                                    </li>
                                                    <li>   
                                                        <input id="check-d8" type="checkbox" name="check">
                                                        <label for="check-d8">Sacada</label>
                                                    </li>
                                                    <li>   
                                                        <input id="check-d9" type="checkbox" name="check">
                                                        <label for="check-d9">Sacada Gourmet</label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- listsearch-input-item end--> 												
                                    </div>
                                </div>
                                </form>
                            </div>
                            <div class="more-filter-option-wrap">
                                <div class="more-filter-option-btn more-filter-option act-hiddenpanel"> <span>Filtro Avançado</span> <i class="fas fa-caret-down"></i></div>
                                <div class="reset-form reset-btn"> <i class="far fa-sync-alt"></i> Limpar Filtros</div>
                            </div>
                        </div>
                        <!-- list-searh-input-wrap end-->
                        <!-- list-main-wrap-header-->
                        <div class="list-main-wrap-header fl-wrap fixed-listing-header">
                            <div class="container">
                                <!-- list-main-wrap-title-->
                                <!-- list-main-wrap-title end-->
                                <!-- list-main-wrap-opt-->
                                <div class="list-main-wrap-opt">
                                    <!-- price-opt-->
                                    <div class="price-opt">
                                        <span class="price-opt-title">Ordernar:</span>
                                        <div class="listsearch-input-item">
                                            <select data-placeholder="Popularity" class="chosen-select no-search-select" >
                                                <option>Preço: Menor Preço</option>
                                                <option>Preço: Maior Preço</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- price-opt end-->
                                    <!-- price-opt-->
                                    <div class="grid-opt">
                                        <ul class="no-list-style">
                                            <li class="grid-opt_act"><span class="two-col-grid   tolt" data-microtip-position="bottom" data-tooltip="Modo de Visualização em Grid"><i class="far fa-th"></i></span></li>
                                            <li class="grid-opt_act"><span class="one-col-grid act-grid-opt tolt" data-microtip-position="bottom" data-tooltip="Modo de Visualização em Lista"><i class="far fa-list"></i></span></li>
                                        </ul>
                                    </div>
                                    <!-- price-opt end-->
                                </div>
                                <!-- list-main-wrap-opt end-->                    
                            </div>
                        </div>
                        <!-- list-main-wrap-header end-->					
                        <!-- listing-item-wrap-->
                        <div class="listing-item-container one-column-grid-wrap fl-wrap">
                            <!-- listing-item -->
                            @foreach( $imoveis as $imovel )
                            <div class="listing-item">
                                <article class="geodir-category-listing fl-wrap">
                                    <div class="geodir-category-img fl-wrap">
                                        <a href="{{route('detalhe')}}/{{$imovel->IMB_IMV_ID}}" class="geodir-category-img_item" title="{{$imovel->IMB_IMV_OBSWEB}}">
                                            @if( $imovel->IMB_IMG_ARQUIVO )
                                            <img  class="img-200" src="https://www.chabimoveis.com.br/sys/storage/images/1/imoveis/{{$imovel->IMB_IMV_ID}}/{{$imovel->IMB_IMG_ARQUIVO}}" alt="">
                                            @else
                                                <img   class="img-200" src="https://www.chabimoveis.com.br/sys/storage/images/1/logos/logo_200_200.jpg" alt="">
                                            @endif
                                            
                                            <div class="overlay"></div>
                                        </a>
                                        <div class="geodir-category-location">
                                            <a href="https://www.chabimoveis.com.br/sys/site/pesquisar?bairro={{$imovel->CEP_BAI_NOME}}" class="map-item tolt" data-microtip-position="top-left" data-tooltip="ver mais imóveis deste bairro"><i class="fas fa-map-marker-alt"></i>  {{$imovel->CEP_BAI_NOME}}-{{$imovel->IMB_IMV_CIDADE}}</a>
                                        </div>
                                        <ul class="list-single-opt_header_cat">
                                            @if( $imovel->IMB_IMV_VALLOC <> 0 and $imovel->IMB_IMV_VALVEN <> 0 )
                                                <li><a href="#" class="cat-opt blue-bg">Venda/Locação</a></li>
                                            @elseif( $imovel->IMB_IMV_VALLOC <> 0  )
                                                <li><a href="#" class="cat-opt blue-bg">Somente Locação</a></li>
                                            @elseif( $imovel->IMB_IMV_VALVEN <> 0  )
                                                <li><a href="#" class="cat-opt blue-bg">Somente Venda</a></li>
                                            @endif

                                            <li><a href="#" class="cat-opt color-bg">{{$imovel->IMB_TIM_DESCRICAO}}</a></li>
                                        </ul>
                                        <a href="javascript:midiaWhats( {{$imovel->IMB_IMV_ID}},'{{$imovel->IMB_IMV_REFERE}}' )" class="geodir_save-btn tolt" data-microtip-position="right" data-tooltip="Compartilhar no Whatsapp"><span><i class="fab fa-whatsapp"></i></span></a>
                                        <a href="javascript:midiaFace( {{$imovel->IMB_IMV_ID}},'{{$imovel->IMB_IMV_REFERE}}' )" class="compare-btn tolt" data-microtip-position="right" data-tooltip="Compartilhar no facebook"><span><i class="fab fa-facebook-f"></i></span></a>
<!--                                        <a href="#" class="compare-btn tolt" data-microtip-position="left" data-tooltip="Compare"><span><i class="fal fa-random"></i></span></a>-->
                                        <div class="geodir-category-listing_media-list">
                                            <span><i class="fas fa-camera"></i> {{$imovel->QTDFOTOS}}</span>
                                        </div>
                                    </div>
                                    <div class="geodir-category-content fl-wrap">
                                        <h3><a href="listing-single.html">Referência: <b>{{$imovel->IMB_IMV_REFERE}}</b></a></h3>
                                        @if( $imovel->IMB_IMV_VALLOC <> 0 and $imovel->IMB_IMV_VALVEN <> 0 )
                                            <div class="geodir-category-content_price">${{number_format($imovel->IMB_IMV_VALVEN, 2, ',', '.')}}/
                                                                                    ${{number_format($imovel->IMB_IMV_VALLOC, 2, ',', '.')}}</div>
                                        @elseif( $imovel->IMB_IMV_VALVEN <> 0  )
                                            <div class="geodir-category-content_price">${{number_format($imovel->IMB_IMV_VALVEN, 2, ',', '.')}}</div>
                                        @elseif( $imovel->IMB_IMV_VALLOC <> 0  )
                                            <div class="geodir-category-content_price">${{number_format($imovel->IMB_IMV_VALLOC, 2, ',', '.')}}</div>
                                        @endif
                                        <div class="geodir-category-content-details">
                                            <ul>
                                                <li><i class="fal fa-bed"></i><span>{{$imovel->IMB_IMV_DORQUA}}</span></li>
                                                <li><i class="fal fa-bed"></i><span>{{$imovel->IMB_IMV_SUIQUA}}</span> Suíte</li>
                                                <li><i class="fal fa-bath"></i><span>{{$imovel->IMB_IMV_WCQUA}}</span></li>
                                                <li><i class="fal fa-car"></i><span>{{$imovel->IMB_IMV_GARCOB}}</span></li>
                                            </ul>
                                        </div>
                                        <div class="geodir-category-footer fl-wrap">
                                            <a href="https://wa.me/5514997002400?text=Olá!%20Gostaria%20de%20receber%20mais%20informações%20sobre%20o%20imóvel%20{{$imovel->IMB_IMV_REFERE}}" class="gcf-company" target="_blank"><img class="img-50" src="{{asset('images/logoavatar.png')}}" alt=""><span>Chab Imóveis</span></a>
                                            <a title="Compartilhar com um amigo no whatsapp" href="javascript:midiaWhats( {{$imovel->IMB_IMV_ID}},'{{$imovel->IMB_IMV_REFERE}}' )"  class="whatsapp-color">  
                                                    <i class="fa fa-whatsapp" style="font-size:24px"></i>  </a>

                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                        <P>{{$imovel->IMB_IMV_OBSWEB}}</P>

                                    
                                </article>
                            </div>
                            @endforeach
                            <!-- listing-item end-->							
                        </div>
                        <!-- listing-item-wrap end-->
                        <!-- pagination end-->						
                        <div class="small-footer fl-wrap">
                            <div class="copyright"> © Sirius System 2021 .  All rights reserved.</div>
                            <a class="custom-to-top color-bg custom-scroll-link" href="#main"><i class="fas fa-caret-up"></i></a>
                        </div>
                    </div>
                    <!-- col-list-wrap end -->
                </div>
                <!-- content end -->	
            </div>
            <!-- wrapper end -->
            <!--register form -->
            
            <!--register form end -->
        </div>
        <!-- Main end -->
        <!--=============== scripts  ===============-->
        <script>
            function midiaWhats( id, referencia )    
            {
                window.location = "https://api.whatsapp.com/send?text=Olá,%20veja%20este%20imóvel%20que%20encontrei%20pra%20você:%20%20http://www.chabimoveis.com.br/sys/site/detalhe/"+id;
            }

            function midiaFace( id, referencia )    
            {
            window.location = "https://www.addthis.com/bookmark.php?v=300&winname=addthis&pub=ra-58358341f66a70b6&source=tbx-300,men-300&lng=pt&s=facebook   20este%20imóvel%20que%20encontrei%20pra%20você:%20%20&url=http://www.chabimoveis.com.br/sys/site/detalhe/"+id;
            }
        </script>
        <script   src="{{asset('/site/js/jquery.min.js')}}"></script>
        <script   src="{{asset('/site/js/plugins.js')}}"></script>
        <script   src="{{asset('/site/js/scripts.js')}}"></script>

    </body>
</html>