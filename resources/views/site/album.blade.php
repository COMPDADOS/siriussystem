<!DOCTYPE HTML>
<html lang="pt-BR">
    @include('site.header')

    <body>
        <!--loader-->
        <div class="loader-wrap">
            <div class="loader-inner">
                <svg>
                    <defs>
                        <filter id="goo">
                            <fegaussianblur in="SourceGraphic" stdDeviation="2" result="blur" />
                            <fecolormatrix in="blur"  values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 5 -2" result="gooey" />
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
                    <!--  carousel--> 
                    @if( $imagens<> '[]')
                    <div class="list-single-carousel-wrap carousel-wrap fl-wrap" id="sec1">
                        <div class="fw-carousel single-carousel carousel fl-wrap full-height lightgallery">
                            <!-- slick-slide-item -->
                                @foreach( $imagens as $imagem )
                                <div class="slick-slide-item">
                                    <div class="box-item">
                                        <img  src="http://www.chabimoveis.com.br/sys/storage/images/1/imoveis/{{$imagem->IMB_IMV_ID}}/{{$imagem->IMB_IMG_ARQUIVO}}"   alt="">
                                        <a href="http://www.chabimoveis.com.br/sys/storage/images/1/imoveis/{{$imagem->IMB_IMV_ID}}/{{$imagem->IMB_IMG_ARQUIVO}}" class="gal-link popup-image"><i class="fal fa-search"  ></i></a>
                                        <div class="show-info">
                                            <span><i class="fas fa-info"></i></span>
                                            <div class="tooltip-info">
                                                <h5>Descrição</h5>
                                                <p>{{$imv->IMB_IMV_OBSWEB}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            <!-- slick-slide-item end -->
                        </div>
                        <div class="swiper-button-prev sw-btn"><i class="fal fa-angle-left"></i></div>
                        <div class="swiper-button-next sw-btn"><i class="fal fa-angle-right"></i></div>
                    </div>
                    @endif                    <!--  carousel  end-->  
                    <div class="breadcrumbs fw-breadcrumbs smpar fl-wrap">
                        <div class="container">
                            <div class="breadcrumbs-list">
                                <a href="{{route('siteindex')}}">Home</a><a href="javascript:window.history.back();">Página Anterior</a></span>
                            </div>
                            <div class="show-more-snopt smact"><i class="fal fa-ellipsis-v"></i></div>
                            <div class="show-more-snopt-tooltip">
                                <a href="#sec15" class="custom-scroll-link"> <i class="fas fa-comment-alt"></i> Escreva um comentário</a>
                                <a href="#"> <i class="fas fa-exclamation-triangle"></i> Report </a>
                            </div>
                            <a class="print-btn tolt" href="javascript:window.print()" data-microtip-position="bottom"  data-tooltip="Print"><i class="fas fa-print"></i></a>
                            <a class="compare-top-btn tolt" data-microtip-position="bottom"  data-tooltip="Fale com a gente" href="https://wa.me/551421079400?text=Olá!%20Gostaria%20de%20receber%20mais%20informações%20sobre%20o%20imóvel%20{{$imv->IMB_IMV_REFERE}}" target="_blank"><i class="fa fa-whatsapp"></i></a>
                        </div>
                    </div>
                    <div class="gray-bg small-padding fl-wrap">
                        <div class="container">
                            <div class="row">
                                <!--  listing-single content -->
                                <div class="col-md-8">
                                    <div class="list-single-main-wrapper fl-wrap">
                                        <!--  scroll-nav-wrap -->
                                        <div class="scroll-nav-wrap">
                                            <nav class="scroll-nav scroll-init fixed-column_menu-init">
                                                <ul class="no-list-style">
                                                    <li><a class="act-scrlink" href="#sec1"><i class="fal fa-image"></i></a><span>Gallery</span></li>
                                                    <li><a href="#sec2"><i class="fal fa-info"></i> </a><span>Detalhes</span></li>
                                                    <li><a href="#sec3"><i class="fal fa-stars"></i></a><span>Recursos</span></li>
                                                    <li><a href="#sec4"><i class="fal fa-video"></i></a><span>Video</span></li>
                                                    <li><a href="#sec5"><i class="fal fa-map-pin"></i></a><span>Localização</span></li>
                                                </ul>
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
                                            </nav>
                                        </div>
                                        <!--  scroll-nav-wrap end-->   
                                        <!--  list-single-opt_header-->
                                        <div class="list-single-opt_header fl-wrap">
                                            <ul class="list-single-opt_header_cat">
                                                @if( $imv->IMB_IMV_VALLOC <> 0 and $imv->IMB_IMV_VALVEN <> 0 )
                                                    <li><a href="#" class="cat-opt blue-bg">Venda/Locação</a></li>
                                                @elseif( $imv->IMB_IMV_VALLOC <> 0  )
                                                    <li><a href="#" class="cat-opt blue-bg">Somente Locação</a></li>
                                                @elseif( $imv->IMB_IMV_VALVEN <> 0  )
                                                    <li><a href="#" class="cat-opt blue-bg">Somente Venda</a></li>
                                                @endif

                                               <li><a href="#" class="cat-opt color-bg">{{$IMB_TIM_DESCRICAO}}</a></li>
                                            </ul>
                                            <div>
                                                <a title="Compartilhar com um amigo no whatsapp" href="javascript:midiaWhats( {{$imv->IMB_IMV_ID}},'{{$imv->IMB_IMV_REFERE}}' )"  class="whatsapp-color">  
                                                    <i class="fa fa-whatsapp" style="font-size:24px"></i>  </a>
                                                <a title="Compartilhar com um amigo no facebook" href="javascript:midiaFace( {{$imv->IMB_IMV_ID}},'{{$imv->IMB_IMV_REFERE}}' )" class="facebook-color">  
                                                    <i class="fa fa-facebook" style="font-size:24px"></i>   </a>
                                            </div>
                                        </div>
                                        <!--  list-single-opt_header end -->
                                        <!--  list-single-header-item-->
                                        <div class="list-single-header-item  fl-wrap" id="sec2">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="geodir-category-location fl-wrap">
                                                        @if( $imv->IMB_IMV_TITULO  )
                                                            <a href="#"><i class="fas fa-map-marker-alt"></i> <b>{{ $imv->IMB_IMV_TITULO }}</b></a> 
                                                        @else
                                                            <a href="#"><i class="fas fa-map-marker-alt"></i> <b>{{ $imv->IMB_TIM_DESCRICAO }}, em {{$imv->IMB_IMV_CIDADE}} no bairro {{$imv->CEP_BAI_NOME}}</b></a> 
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-single-header-footer fl-wrap">
                                                @if( $imv->IMB_IMV_VALLOC <> 0 and $imv->IMB_IMV_VALVEN <> 0 )
                                                    <div class="list-single-header-price" data-propertyprise="50500">
                                                        <strong>Venda:</strong>
                                                                <span>R$</span>{{number_format($imv->IMB_IMV_VALVEN, 2, ',', '.')}}
                                                        <strong>Locação:</strong>
                                                                <span>R$</span>{{number_format($imv->IMB_IMV_VALLOC, 2, ',', '.')}}
                                                    </div>                                                
                                                @elseif( $imv->IMB_IMV_VALLOC <> 0)
                                                    <div class="list-single-header-price" data-propertyprise="50500">
                                                        <strong>Locação:</strong>
                                                                <span>R$</span>{{number_format($imv->IMB_IMV_VALLOC, 2, ',', '.')}}
                                                    </div>                                        

                                                @elseif( $imv->IMB_IMV_VALVEN <> 0)
                                                    <div class="list-single-header-price" data-propertyprise="50500">
                                                        <strong>Venda:</strong>
                                                                <span>R$</span>{{number_format($imv->IMB_IMV_VALVEN, 2, ',', '.')}}
                                                    </div>                                        

                                                @endif
                                            </div>                                        
                                        </div>
                                        <div class="list-single-facts fl-wrap">
                                            <!-- inline-facts -->
                                            <div class="inline-facts-wrap">
                                                <div class="inline-facts">
                                                    <i class="fal fa-home-lg"></i>
                                                    <h6>Tipo</h6>
                                                    <span>{{$IMB_TIM_DESCRICAO}}</span>
                                                </div>
                                            </div>
                                            <!-- inline-facts end -->
                                            <!-- inline-facts  -->
                                            <!-- inline-facts end -->
                                            <!-- inline-facts -->
                                            @if($imv->IMB_IMV_DORQUA)
                                                <div class="inline-facts-wrap">
                                                    <div class="inline-facts">
                                                        <i class="fal fa-bed"></i>
                                                        <h6>Dormitórios</h6>
                                                        <span>{{$imv->IMB_IMV_DORQUA}} Dormitório(s)</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($imv->IMB_IMV_SUIQUA)
                                                <div class="inline-facts-wrap">
                                                    <div class="inline-facts">
                                                        <i class="fal fa-bed"></i>
                                                        <h6>Suítes</h6>
                                                        <span>{{$imv->IMB_IMV_SUIQUA}} Suíte(s)</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($imv->IMB_IMV_GARCOB)
                                                <div class="inline-facts-wrap">
                                                    <div class="inline-facts">
                                                        <i class="fal fa-car"></i>
                                                        <h6>Garagem</h6>
                                                        <span>{{$imv->IMB_IMV_GARCOB}} Gar.Coberta</span>
                                                    </div>
                                                </div>
                                            @endif


                                            <!-- inline-facts end -->
                                            <!-- inline-facts -->
                                            @if($imv->IMB_IMV_WCQUA)
                                                <div class="inline-facts-wrap">
                                                    <div class="inline-facts">
                                                        <i class="fal fa-bath"></i>
                                                        <h6>Banheiros</h6>
                                                        <span>{{$imv->IMB_IMV_WCQUA}} Banheiro(s)</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if( $imv->IMB_IMV_ARETOT)
                                                <div class="inline-facts-wrap">
                                                    <div class="inline-facts">
                                                        <i class="fal fa-cube"></i>
                                                        <h6>Área</h6>
                                                        <span>{{$imv->IMB_IMV_ARETOT}}m2 Área Total</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($imv->IMB_IMV_ARECON)
                                                <div class="inline-facts-wrap">
                                                    <div class="inline-facts">
                                                        <i class="fal fa-cube"></i>
                                                        <h6>Área Construída</h6>
                                                        <span>{{$imv->IMB_IMV_ARECON}}m2 Área Construída</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($imv->IMB_IMV_AREUTI)
                                                <div class="inline-facts-wrap">
                                                    <div class="inline-facts">
                                                        <i class="fal fa-cube"></i>
                                                        <h6>Área Útil</h6>
                                                        <span>{{$imv->IMB_IMV_AREUTI}}m2 Área Útil</span>
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- inline-facts end -->                                                                        
                                        </div>
                                        <div class="list-single-main-container fl-wrap">
                                            <!-- list-single-main-item -->
                                            <!-- list-single-main-item end -->                                          
                                            <!-- list-single-main-item -->
                                            <div class="list-single-main-item fl-wrap" id="sec3">
                                                <div class="list-single-main-item-title">
                                                    <h3>Detalhes</h3>
                                                </div>
                                                <div class="list-single-main-item_content fl-wrap">
                                                    <div class="details-list">
                                                        <ul>
                                                            @if( $imv->IMB_IMV_VALVEN > 0)
                                                                <li><span>Valor Venda:</span> <b>R${{number_format($imv->IMB_IMV_VALVEN, 2, ',', '.')}}</b></li>
                                                            @endif
                                                            @if( $imv->IMB_IMV_VALLOC > 0)
                                                                <li><span>Valor Locação:</span> <b>R${{number_format($imv->IMB_IMV_VALLOC, 2, ',', '.')}}</b></li>
                                                            @endif
                                                            @if( $imv->IMB_IMV_VALORIPTU > 0)
                                                                <li><span>Valor IPTU:</span> R${{number_format($imv->IMB_IMV_VALORIPTU, 2, ',', '.')}}
                                                                <b>Confirmar</b></li>


                                                            @endif
                                                            @if( $imv->imb_imv_valorcondominio > 0)
                                                                <li><span>Valor Condomínio: R$</span>{{number_format($imv->imb_imv_valorcondominio, 2, ',', '.')}}
                                                                <b>Sujeito a alteração</b></li>
                                                            @endif

                                                            <li><span>Código:</span>{{$imv->IMB_IMV_REFERE}}</li>
                                                            <li><span>Bairro:</span>{{$imv->CEP_BAI_NOME}}</li>
                                                            <li><span>Cidade:</span>{{$imv->IMB_IMV_CIDADE}}</li>
                                                            
                                                            <li><span>Dormitórios:</span>{{$imv->IMB_IMV_DORQUA}}</li>
                                                            <li><span>Suítes:</span>{{$imv->IMB_IMV_SUIQUA}}</li>
                                                            <li><span>Salas:</span>{{$imv->IMB_IMV_SALQUA}}</li>
                                                            <li><span>Banheiros:</span>{{$imv->IMB_IMV_WCQUA}}</li>
                                                            <li><span>Vagas Cobertas:</span>{{$imv->IMB_IMV_GARGOB}}</li>
                                                            <li><span>Vagas Descobertas:</span>{{$imv->IMB_IMV_GARDES}}</li>
                                                            <li><span>Área Total:</span>{{$imv->IMB_IMV_ARETOT}}m2</li>
                                                            <li><span>Área Constr.:</span>{{$imv->IMB_IMV_ARECON}}m2</li>
                                                            <li><span>Área Útil:</span>{{$imv->IMB_IMV_AREUTI}}m2</li>
                                                            <li><span>Med. Ter.:</span>{{$imv->IMB_IMV_MEDTER}}m2</li>
                                                            <li><span>Tipo:</span>{{$IMB_TIM_DESCRICAO}}</li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- list-single-main-item end -->  
                                            <!-- list-single-main-item -->
                                            <!-- list-single-main-item end -->                                             
                                            <!-- list-single-main-item -->
                                            <!-- list-single-main-item end -->                                             
                                            <!-- list-single-main-item -->
                                            <div class="list-single-main-item fl-wrap">
                                                <div class="list-single-main-item-title">
                                                    <h3>Outros Recursos</h3>
                                                </div>
                                                <div class="list-single-main-item_content fl-wrap">
                                                    <div class="listing-features ">
                                                        <ul>
                                                            @if( $imv->IMB_IMV_EDICUL == 'S' )
                                                                <li><i class="fal fa-dumbbell"></i> Edícula</li>
                                                            @endif
                                                            @if( $imv->IMB_IMV_QUINTA == 'S' )
                                                                <li><i class="fal fa-dumbbell"></i> Quintal</li>
                                                            @endif
                                                            @if( $imv->IMB_IMV_DORAE == 'S' )
                                                                <li><i class="fal fa-dumbbell"></i> AE Dormitório(s)</li>
                                                            @endif
                                                            @if( $imv->IMB_IMV_DORCLO == 'S' )
                                                                <li><i class="fal fa-dumbbell"></i> Closet</li>
                                                            @endif
                                                            @if( $imv->IMB_IMV_PISCIN == 'S' )
                                                                <li><i class="fal fa-dumbbell"></i> Piscina</li>
                                                            @endif
                                                            @if( $imv->IMB_IMV_PLAGRO == 'S' )
                                                                <li><i class="fal fa-dumbbell"></i> Play Ground</li>
                                                            @endif
                                                            @if( $imv->IMB_IMV_CHURRA == 'S' )
                                                                <li><i class="fal fa-dumbbell"></i> Churrasqueira</li>
                                                            @endif
                                                            @if( $imv->IMB_IMV_PORELE == 'S' )
                                                                <li><i class="fal fa-dumbbell"></i> Portão Eletrônico</li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- list-single-main-item end -->
                                            <!-- list-single-main-item -->
                                            <div class="list-single-main-item fw-lmi fl-wrap" id="sec5">
                                                <div class="map-container mapC_vis mapC_vis2">
                                                    <div id="singleMap" data-latitude="{{$imv->IMB_IMV_LATITUDE}}" 
                                                        data-longitude="{{$imv->IMB_IMV_LATITUDE}}" data-mapTitle="Proximidades" 
                                                        data-infotitle="O que tem proximo" data-infotext="{{$imv->CEP_BAI_NOME}}"></div>
                                                    <div class="scrollContorl"></div>
                                                </div>
<!--                                                <input id="pac-input" class="controls fl-wrap controls-mapwn" autocomplete="on" type="text" placeholder="What Nearby? Schools, Gym... " value="">-->
                                            </div>
                                            <!-- list-single-main-item end -->                                            
                                            <!-- list-single-main-item -->

                                            <!-- list-single-main-item end -->                                             
                                            <!-- list-single-main-item -->
                                            <div class="list-single-main-item fl-wrap"  id="sec15">
                                                <div class="list-single-main-item-title fl-wrap">
                                                    <h3>Adicione um comentário a este imóvel</h3>
                                                </div>
                                                <!-- Add Review Box -->
                                                <div id="add-review" class="add-review-box">
                                                    <!-- Review Comment -->
                                                    <form   class="add-comment custom-form">
                                                        <fieldset>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>Seu nome* <span class="dec-icon"><i class="fas fa-user"></i></span></label>
                                                                    <input   name="phone" type="text"    onClick="this.select()" value="">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label>Seu email* <span class="dec-icon"><i class="fas fa-envelope"></i></span></label>
                                                                    <input   name="reviewwname" type="text"    onClick="this.select()" value="">
                                                                </div>
                                                            </div>
                                                            <textarea cols="40" rows="3" placeholder="Sua mensagem:"></textarea>
                                                        </fieldset>
                                                        <button class="btn big-btn color-bg float-btn">Enviar <i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                                                    </form>
                                                </div>
                                                <!-- Add Review Box / End -->
                                            </div>
                                            <!-- list-single-main-item end -->                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- listing-single content end-->
                                <!-- sidebar -->
                                <div class="col-md-4">
                                    <!--box-widget-->
                                    <div class="box-widget fl-wrap">
                                        <div class="profile-widget">
                                            <div class="profile-widget-header color-bg smpar fl-wrap">
                                                <div class="pwh_bg"></div>
                                                <div class="call-btn"><a href="tel:551421079400" class="tolt color-bg" data-microtip-position="right"  data-tooltip="Ligue pra nós"><i class="fas fa-phone-alt"></i></a></div>
                                                <div class="box-widget-menu-btn smact"><i class="far fa-ellipsis-h"></i></div>
                                                <div class="show-more-snopt-tooltip bxwt">
                                                    <a href="#"> <i class="fas fa-comment-alt"></i> Esc</a>
                                                    <a href="#"> <i class="fas fa-exclamation-triangle"></i> Report </a>
                                                </div>
                                                <div class="profile-widget-card">
                                                    <div class="profile-widget-image">
                                                        <img src="{{asset('/site/images/logoavatar.png')}}" alt="">
                                                    </div>
                                                    <div class="profile-widget-header-title">
                                                        <h4><a href="agent-single.html">Corretores</a></h4>
                                                        <div class="clearfix"></div>
                                                        <div class="clearfix"></div>
                                                        <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="profile-widget-content fl-wrap">
                                                <div class="contats-list fl-wrap">
                                                    <ul class="no-list-style">
                                                        <li><span><i class="fal fa-phone"></i> Telefone :</span> <a href="#">14 2107-6400</a></li>
                                                        <li><span><i class="fal fa-envelope"></i> Mail :</span> <a href="#">atendimento@elianachab.com.b</a></li>
                                                        <li><span><a href="https://wa.me/?text=Olá!%20Gostaria%20de%20receber%20mais%20informações%20sobre%20o%20imóvel%20{{$imv->IMB_IMV_REFERE}}"><i class="fa fa-whatsapp"></i>Whatsapp</a></span> </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--box-widget end -->
                                    <!--box-widget-->
                                    <div class="box-widget fl-wrap">
                                        <div class="box-widget-title fl-wrap">Descrição do Imóvel</div>
                                        <div class="box-widget-content fl-wrap">
                                            <!--widget-posts-->
                                            <div class="widget-posts  fl-wrap">
                                                <p><b>{{$imv->IMB_IMV_OBSWEB}}<b></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--box-widget end --> 
                                    <!--box-widget-->
                                    <div class="box-widget fl-wrap hidden-section" style="margin-top: 30px">
                                        <div class="box-widget-content fl-wrap color-bg">
                                        <iframe width="100%" height="360" src="https://www.youtube.com/embed/8yU8aUoKFU8" title="Residencial Mirandela" frameborder="0" allow="accelerometer; &autoplay=1; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                    <!--box-widget end -->                                   
                                    <!--box-widget-->
                                    <!--box-widget end -->                                
                                    <!--box-widget-->
                                    <!--box-widget end -->                                   
                                </div>
                                <!--  sidebar end-->                            
                            </div>
                            <div class="fl-wrap limit-box"></div>
                            <div class="listing-carousel-wrapper carousel-wrap fl-wrap">
                                <div class="list-single-main-item-title">
                                    <h3>Abaixo outros imóveis que podem te satisfazer</h3>
                                </div>
                                <div class="listing-carousel carousel ">
                                    <!-- slick-slide-item -->
                                    @foreach( $ultimos as $imovel )
                                    <div class="slick-slide-item">
                                        <div class="listing-item">
                                            <article class="geodir-category-listing fl-wrap">
                                                <div class="geodir-category-img fl-wrap">
                                                    <a href="{{route('detalhe')}}/{{$imovel->IMB_IMV_ID}}" class="geodir-category-img_item" title="{{$imovel->IMB_IMV_OBSWEB}}">
                                                        @if( $imovel->IMB_IMG_ARQUIVO )
                                                        <img  class="img-200" src="http://www.chabimoveis.com.br/sys/storage/images/1/imoveis/{{$imovel->IMB_IMV_ID}}/{{$imovel->IMB_IMG_ARQUIVO}}" alt="">
                                                        @else
                                                            <img  class="img-200" src="http://www.chabimoveis.com.br/sys/storage/images/1/logos/logo_200_200.jpg" alt="">
                                                        @endif
                                                        <div class="overlay"></div>
                                                    </a>
                                                    <div class="geodir-category-location">
                                                        <a href="#1" class="map-item tolt" data-microtip-position="top-left" data-tooltip="On the map"><i class="fas fa-map-marker-alt"></i>  {{$imovel->CEP_BAI_NOME}}</a>
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
                                                            <li><i class="fal fa-bath"></i><span>{{$imovel->IMB_IMV_WCQUA}}</span></li>
                                                            <li><i class="fal fa-car"></i><span>{{$imovel->IMB_IMV_GARCOB}}</span></li>
                                                        </ul>
                                                    </div>
                                                    <div class="geodir-category-footer fl-wrap">
                                                        <a href="https://wa.me/551421079400?text=Olá!%20Gostaria%20de%20receber%20mais%20informações%20sobre%20o%20imóvel%20{{$imovel->IMB_IMV_REFERE}}" class="gcf-company" target="_blank"><img class="img-50" src="{{asset('/site/images/logoavatar.png')}}" alt=""><span>Chab Imóveis</span></a>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            </div>
                        </div>
                <!-- content end -->	
                <!-- subscribe-wrap -->	
                    </div>
                </div>
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
                                            <img src="/site/images/logo.png" alt="">
                                        </div>
                                        <p>Nossa imobiliária terá o enorme prazer em poder te conhecer e atendê-lo.</p>
                                        <div class="fw_hours fl-wrap">
                                            <span>Segunda a sexta:<strong> 09:00hs - 18:00hs</strong></span>
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
                                <div class="col-md-3">
                                    <div class="footer-widget fl-wrap">
                                        <div class="footer-widget-title fl-wrap">
                                            <h4>Entre em contato</h4>
                                        </div>
                                        <ul  class="footer-contacts fl-wrap">
                                            <li><span><i class="fal fa-envelope"></i> E-mail :</span><a href="#" target="_blank">atendimento@chabimoveis.com.br</a></li>
                                            <li> <span><i class="fal fa-map-marker"></i> Endereço :</span><a href="#" target="_blank">Rua Rubens de Mello Souza 2-38 Jardim Europa - CEP 17017-450 Bauru - SP </a></li>
                                            <li><span><i class="fal fa-phone"></i> Telefone:</span><a href="#">+(14)2107-9400</li>
                                            <li><span><i class="fa fa-whatsapp"></i> Whatsapp :</span><a href="https://wa.me/?text=Olá!%20Gostaria%20de%20receber%20mais%20informações">+(14)2107-9400</li>
                                        </ul>
                                        <div class="footer-social fl-wrap">
                                            <ul>
                                                <li><a href="#" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
                                                 <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- footer widget end-->   
                                <!-- footer widget-->
                                <div class="col-md-3">
                                    <div>
                                        <img src="{{asset('site/images/logo.png')}}" alt="">
                                        
                                    </div>
                                </div>
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
            
            <!--register form end -->
            <a class="to-top color-bg"><i class="fas fa-caret-up"></i></a>   
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
        <script src="https://maps.googleapis.com/maps/api/js?key=YOU_API_KEY_HERE&libraries=places"></script>
        <script src="{{asset('/site/js/map-single.js')}}"></script>
    </body>
</html>