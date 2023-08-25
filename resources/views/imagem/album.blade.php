@include('imagem.definitions')
<body>
<div class="fundo-album">
    <!-- Preloader -->
    <!-- Sidebar Page Container -->
    <div class="sidebar-page-container">
        <div >
            <div >

                <input type="hidden" id="IMB_IMV_ID" value ="{{$imovel->IMB_IMV_ID}}">
                <input type="hidden" id="IMB_IMV_REFERE" value ="{{$imovel->IMB_IMV_REFERE}}">
                                    
            </div>
            <div class="row clearfix">
                <!--Content Side-->
                <div class="col-md-1">
                    .
                </div>
                <div class="col-lg-3">
                        <div class="property-features">
                            <h3>                                
                            <b><u>
                                {{$imovel->IMB_TIM_DESCRICAO}}
                            </h3>
                            @if( $imovel->IMB_CND_NOME <> '' )
                                <h5>{{$imovel->IMB_CND_NOME}}</h5>
                            @else
                                <h5>{{$imovel->CEP_BAI_NOME}}</h5>
                            @endif
                            <h5>                                
                                @if( $imovel->IMB_CND_NOME <> '' )
                                    Condomínio: {{$imovel->IMB_CND_NOME}}
                                @endif
                            </h5>
                            </u></b>
                            <b>
                            @if( $imovel->IMB_IMV_VALVEN <> 0 )
                                <h4>Venda: R${{number_format( $imovel->IMB_IMV_VALVEN,2,'.','.')}}</h4>
                            @endif
                            @if( $imovel->IMB_IMV_VALLOC <> 0 )
                                <h4>Locação: R${{number_format( $imovel->IMB_IMV_VALLOC,2,'.','.')}}</h4>
                            @endif
                            </b>
                        </div>                            
                </div>
                <div class="content-side col-lg-4 col-md-6 col-sm-6">
                    <div class="property-detail">
                        <div class="upper-box">
                            <div class="carousel-outer">
                                <ul class="image-carousel owl-carousel owl-theme">
                                    @foreach( $imagens as $imagem)
                                    <li><a href="{{url('')}}/storage/images/{{$imagem->IMB_IMB_ID}}/imoveis/{{$imagem->IMB_IMV_ID}}/{{$imagem->IMB_IMG_ARQUIVO}}" 
                                        class="lightbox-image" title="Click na imagem">
                                        <img class="imagem-album" src="{{url('')}}/storage/images/{{$imagem->IMB_IMB_ID}}/imoveis/{{$imagem->IMB_IMV_ID}}/{{$imagem->IMB_IMG_ARQUIVO}}" alt=""></a>
                                    </li>

                                    @endforeach
                                </ul>

                                <ul class="thumbs-carousel owl-carousel owl-theme">
                                    @foreach( $imagens as $imagem)
                                        <li><img class="thumb-album" src="{{url('')}}/storage/images/{{$imagem->IMB_IMB_ID}}/imoveis/{{$imagem->IMB_IMV_ID}}/{{$imagem->IMB_IMG_ARQUIVO}}" alt=""></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>


                        <!-- Property Features -->
                        
                        <!-- Flooring Tabs -->
                        <div class="flooring-tabs tabs-box">
                            <div class="clearfix">
                            </div>

                        </div>

                        <!-- Nearest Places -->
                        <div class="nearest-places">
                            
                        </div>

                        <!-- Review Box -->
                        <div class="review-area">
                            <!--Reviews Container-->
                            <div class="reviews-container">
                                <h4></h4>
                                <!--Reviews-->
                                <article class="review-box">
                                </article>

                                <!--Reviews-->
                                <article class="review-box reply">
                                </article>

                                <!--Reviews-->
                                <article class="review-box">
                                </article>
                            </div>
                        </div>

                         <!-- Review Comment Form -->
                        <div class="review-comment-form">
                            <h4></h4>
                                <div class="row">
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="property-features">
                            <ul class="list-style-one">
                                <li>Tipo: {{$imovel->IMB_TIM_DESCRICAO}}</li>
                                @if( $imovel->IMB_IMV_AREUTI > 10 )
                                    <li><i class="flaticon-dimension"></i> {{$imovel->IMB_IMV_AREUTI}}m2 Área Útil</li>
                                @elseif( $imovel->IMB_IMV_ARECON > 10 )
                                    <li><i class="flaticon-dimension"></i> {{$imovel->IMB_IMV_ARECON}}m2 Área Constr.</li>
                                @elseif( $imovel->IMB_IMV_ARETOT > 10 )
                                    <li><i class="flaticon-dimension"></i> {{$imovel->IMB_IMV_ARETOT}}m2 Área Total</li>
                                @endif

                                <li>Cidade: {{$imovel->IMB_IMV_CIDADE}}</li>
                                
                                <li>Garagens: {{$imovel->GARAGENS}} </li>
                                <li>Dormitórios: {{$imovel->IMB_IMV_DORQUA}}  </li>
                                <li>Banheiros: {{$imovel->IMB_IMV_WCQUA}}</li>
                                <li>Suítes: {{$imovel->IMB_IMV_SUIQUA}}</li>
                                <li>Salas: {{$imovel->IMB_IMV_SALQUA}}</li>
                            </ul>
                        </div>
                        <div class="property-features">
                            <ul class="list-style-one">
                                <li>IPTU: R$ {{$imovel->IMB_IMV_VALORIPTU}}</li>
                                <li>Condomínio: R${{$imovel->imb_imv_valorcondominio}}</li>
                            </ul>
                        </div>

                        <!-- Property Features -->
                        <div class="property-features">
                            <ul class="list-style-one">
                            @if( $imovel->IMB_IMV_ALARME =='S')
                                    <li>Alarme</li>
                                @endif

                                @if( $imovel->IMB_IMV_ARAPARELHO  =='S')
                                    <li>Aparelho de Ar Cond.</li>
                                @endif

                                @if( $imovel->IMB_IMV_AGUAQUENTE  =='S')
                                    <li>Aquecedor Central</li>
                                @endif

                                @if( $imovel->IMB_IMV_COPA  =='S')
                                    <li>Copa</li>
                                @endif

                                @if( $imovel->IMB_IMV_SALESC  =='S')
                                    <li>Escritório</li>
                                @endif

                                @if( $imovel->IMB_IMV_LAVABO  =='S')
                                    <li>Lavabo</li>
                                @endif

                                @if( $imovel->IMB_IMV_SUICLO  =='S')
                                    <li>Closet</li>
                                @endif

                                @if( $imovel->IMB_IMV_DORAE  =='S')
                                    <li>Armários no Dormitório</li>
                                @endif

                                @if( $imovel->IMB_IMV_COZAE  =='S')
                                    <li>Armários na Cozinha</li>
                                @endif

                                @if( $imovel->IMB_IMV_AECORREDOR  =='S')
                                    <li>Armários no Corredor</li>
                                @endif

                                @if( $imovel->IMB_IMV_AECLOSET  =='S')
                                    <li>Armários no Closet</li>
                                @endif
                                @if( $imovel->IMB_IMV_AESALA  =='S')
                                    <li>Armários na Sala</li>
                                @endif

                                @if( $imovel->IMB_IMV_AEWC  =='S')
                                    <li>Armários no Banheiro</li>
                                @endif

                                @if( $imovel->IMB_IMV_ARESER  =='S')
                                    <li>Área de Serviço</li>
                                @endif

                                @if( $imovel->IMB_IMV_EMPWC  =='S')
                                    <li>WC de Empregados</li>
                                @endif

                                @if( $imovel->IMB_IMV_EMPQUA  =='S')
                                    <li>Dormitório Empregados</li>
                                @endif

                                @if( $imovel->IMB_IMV_ELEVADORES  =='S')
                                    <li>Elevador</li>
                                @endif

                                @if( $imovel->IMB_IMV_DESPENSA =='S' )
                                    <li>Despensa</li>
                                @endif

                                @if( $imovel->IMB_IMV_SALAAMOCO  =='S')
                                    <li>Sala Almoço</li>
                                @endif
                                @if( $imovel->imb_imv_deposito )
                                    <li>Depósito</li>
                                @endif

                                @if( $imovel->IMB_IMV_SUIHID  =='S')
                                    <li>Hidromassagem</li>
                                @endif

                                @if( $imovel->imb_imv_varandagourmet  =='S')
                                    <li>Sacada Gourmet</li>
                                @endif

                                @if( $imovel->IMB_IMV_PISCIN  =='S')
                                    <li>Piscina </li>
                                @endif

                                @if( $imovel->IMB_IMV_CHURRA  =='S')
                                    <li>Churrasqueira</li>
                                @endif

                                @if( $imovel->IMB_IMV_SAUNA  =='S')
                                    <li>Sauna</li>
                                @endif

                                @if( $imovel->IMB_IMV_QUADRAPOLIESPORTIVA  =='S')
                                    <li>Quadra Poliestportiva</li>
                                @endif

                                @if( $imovel->IMB_IMV_CAMFUT  =='S')
                                    <li>Campo Futebol</li>
                                @endif

                                @if( $imovel->IMB_IMV_SALFES  =='S')
                                    <li>Salão de Festas</li>
                                @endif

                                @if( $imovel->IMB_IMV_PLAGRO  =='S')
                                    <li>Playground</li>
                                @endif

                                @if( $imovel->IMB_IMV_HOME  =='S')
                                    <li>Home Theater</li>
                                @endif

                                @if( $imovel->IMB_IMV_QUINTA  =='S')
                                    <li>Quintal</li>
                                @endif

                                @if( $imovel->IMB_IMV_VARANDA  =='S')
                                    <li>Varanda</li>
                                @endif

                                @if( $imovel->IMB_IMV_SACADA =='S')
                                    <li>Sacada</li>
                                @endif

                                @if( $imovel->IMB_IMV_EDICUL =='S')
                                    <li>Edícula</li>
                                @endif

                                @if( $imovel->IMB_IMV_MURADO =='S')
                                    <li>Murado</li>
                                @endif

                                @if( $imovel->IMB_IMV_PORELE =='S')
                                    <li>Portão Eletrônico</li>
                                @endif
                            </ul>
                        </div>

                </div>
                <div class="col-lg-2">
                        <div class="property-features">
                            
                        </div>                    
                </div>
                
            </div>
        </div>
    </div>
    <!-- End Sidebar Container -->

    <!--Clients Section-->
    <!--End Clients Section-->

    <!-- Main Footer -->
    <!-- End Main Footer -->

</div>
<!--End pagewrapper-->


@include('imagem.definitionsbottom')

<script>
    function enviarMsg()
    {
        if( $("#username").val() == '' )
        {
            alert('Informe seu nome');
            return false;
        }
        if( $("#email").val() == '' )
        {
            alert('Informe seu email');
            return false;
        }

        if( $("#number").val() == '' )
        {
            alert('Informe seu telefone');
            return false;
        }
        if( $("#mensagem").val() == '' )
        {
            alert('Informe a mensagem');
            return false;
        }

        debugger;
        var mensagem = "Referente ao Imóvel: *"+$("#i-referencia").html()+"* %0a"+$("#mensagem").val();
        mensagem = mensagem.replace(/ /g, "%20");
        var url = href="https://wa.me/5514997744232?text="+mensagem;
        window.open( url);



    }
    function midiaWhats()    
        {
            var id = $("#IMB_IMV_ID").val();
            var id = $("#IMB_IMV_REFERE").val();

            window.location = "https://api.whatsapp.com/send?text=Olá,%20veja%20este%20imóvel%20que%20encontrei%20pra%20você:%20%20http://www.ortizimobiliaria.com.br/sys/site/detalhe/"+id;
        }

</script>
</body>
</html>
