<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="Fluxo Imóveis - Site de Busca de Imóveis">
	<meta name="author" content="Compdados Tecnologia">
	<title>Fluxo Imóveis - Bauru</title>
	<script src="{{asset('/global/plugins/jquery.min.js')}}" type="text/javascript"></script>

	<!-- FAVICON -->
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<link rel="stylesheet" href="{{asset('/global/plugins/jquery-ui.css')}}" />
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i%7CMontserrat:600,800" rel="stylesheet">
	<!-- FONT AWESOME -->
	<!-- Slider Revolution CSS Files -->
	<link rel="stylesheet" href="{{asset('/fluxo/css/revolution/css/settings.css')}}">
	<link rel="stylesheet" href="{{asset('/fluxo/css/revolution/css/layers.css')}}">
	<link rel="stylesheet" href="{{asset('/fluxo/css/revolution/css/navigation.css')}}">
	<!-- ARCHIVES CSS -->
	<link rel="stylesheet" href="{{asset('/global/css/animate.css')}}">
	<link rel="stylesheet" href="{{asset('/fluxo/css/magnific-popup.css')}}">
	<link rel="stylesheet" href="{{asset('/fluxo/css/lightcase.css')}}"> 
	<link rel="stylesheet" href="{{asset('/fluxo/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('/fluxo/css/bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('/fluxo/css/styles.css')}}">
	<link rel="stylesheet" id="color" href="{{asset('/fluxo/css/default.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://kit.fontawesome.com/6f14330d53.js" crossorigin="anonymous"></script>	

	<style>
		.hidden {
 			 display: none;
		}
	</style>

</head>

<body>
	<!-- START SECTION HEADINGS -->
	<div class="header">
		<div class="header-top">
			<div class="container">
				<div class="top-info hidden-sm-down">
					<div class="call-header">
						<p><i class="fa fa-phone" aria-hidden="true"></i>(14) 3224-2400 - Rua Virgílio Malta, 17016 - Vila Mesquita - Bauru(SP)</p>
					</div>
				</div>
				<div class="top-social hidden-sm-down">
					<div class="login-wrap">
						<ul class="d-flex">
							<li><a href="login.html"><i class="fa fa-user"></i> Área Cliente</a></li>
							<li><a href="register.html"><i class="fa fa-sign-in"></i> Cadastre-se</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<div class="header-bottom heading sticky-header" id="heading">
			<div class="container">
			    <a href="{{route('index')}}">
					<img src="{{asset('/fluxo/images/logo.jpg')}}" alt="realhome">
				</a>
				<button type="button" class="button-menu hidden-lg-up" data-toggle="collapse" data-target="#main-menu" aria-expanded="false">
					<i class="fa fa-bars" aria-hidden="true"></i>
				</button>

				<nav id="main-menu" class="collapse">
					<ul>
						
						<!-- END COLLAPSE MOBILE MENU -->
						<li><a href="{{route('index')}}">Home</a></li>
						
					
						<!-- STAR COLLAPSE MOBILE MENU -->
						<!-- END COLLAPSE MOBILE MENU -->
 						<!-- END COLLAPSE MOBILE MENU -->
						 <li><a href="#">Nossa Visão</a></li>
						 <li><a href="#">Nossa Missão</a></li>
						 <li><a href="#">Contato</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>

	<!-- START SLIDER -->
	<!-- START REVOLUTION SLIDER 5.0.7 fullwidth mode -->
	<div id="rev_slider_home_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="news-gallery34" style="margin:0px auto;background-color:#ffffff;padding:0px;margin-top:0px;margin-bottom:0px;">
		<div id="rev_slider_home" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.0.7">
			<ul>
			
			@foreach( $capa as $destaque)
					<!-- SLIDE 1 -->
					
                    <li data-index="rs-{{$destaque->IMB_IMG_ID}}" data-transition="slidingoverlayhorizontal" data-slotamount="default" 
						data-easein="default" data-easeout="default" data-masterspeed="default" 
						data-thumb="/sys/storage/images/3/imoveis/thumb/{{$destaque->IMB_IMV_ID}}/100_75{{$destaque->IMB_IMG_ARQUIVO}}" data-rotate="0" 
						data-fstransition="fade" data-fsmasterspeed="1500" 
						ata-fsslotamount="7" data-saveperformance="off" data-title="Make an Impact">
                        <!-- MAIN IMAGE -->
						<img src="/sys/storage/images/3/imoveis/{{$destaque->IMB_IMV_ID}}/{{$destaque->IMB_IMG_ARQUIVO}}"  alt="" data-bgposition="center center" 
							data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                        <!-- LAYERS -->
                        <!-- LAYER NR. 1 -->
						<div class="tp-caption tp-shape tp-shapewrapper tp-resizeme rs-parallaxlevel-0" id="{{$destaque->IMB_IMG_ID}}-slide-1-layer-1" 
							data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" 
							data-voffset="['0','0','0','0']" data-width="full" data-height="full" data-whitespace="normal" data-transform_idle="o:1;" 
							data-transform_in="opacity:0;s:1500;e:Power3.easeInOut;" data-transform_out="opacity:0;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" 
							data-start="1000" data-basealign="slide" data-responsive_offset="on" 
							style="z-index: 5;background-color:rgba(0, 0, 0, 0.35);border-color:rgba(0, 0, 0, 1.00);">
                        </div>
                        <!-- LAYER NR. 2 -->
						<div class="tp-caption tp-resizeme text-white rs-parallaxlevel-0" id="{{$destaque->IMB_IMG_ID}}-slide-1-layer-2" data-x="['left','left','left','left']" 
							data-hoffset="['50','50','50','30']" data-y="['top','top','top','top']" data-voffset="['120','100','70','90']" 
							data-fontsize="['56','46','40','36']" data-lineheight="['70','60','50','45']" data-fontweight="['800','700','700','700']" 
							data-width="['700','650','600','420']" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" 
							data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" 
							data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" 
							data-mask_out="x:0;y:0;s:inherit;e:inherit;" data-start="1000" data-splitin="none" data-splitout="none" 
							data-responsive_offset="on" style="z-index: 6; min-width: 600px; max-width: 600px; white-space: normal;">
							<span class="text-theme-colored2">
							@if ( $destaque->IMB_CND_NOME <> '' )  
							Condomínio<br> {{$destaque->IMB_CND_NOME}}
							@else
								{{$destaque->CEP_BAI_NOME}}
							@endif
                        </div>
                        <!-- LAYER NR. 3 -->
						<div class="tp-caption tp-resizeme text-white rs-parallaxlevel-0 font-p" 
								id="{{$destaque->IMB_IMG_ID}}-slide-1-layer-3" 
								data-x="['left','left','left','left']" 
								data-hoffset="['50','50','50','30']" 
								data-y="['top','top','top','top']" 
								data-voffset="['280','220','180','180']" 
								data-fontsize="['18','18','16','13']" data-lineheight="['30','30','28','25']" 
								data-fontweight="['400','400','400','600']" 
								data-width="['700','650','600','420']" 
								data-height="none" data-whitespace="nowrap" 
								data-transform_idle="o:1;" 
								data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" 
								data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;" 
								data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" 
								data-mask_out="x:0;y:0;s:inherit;e:inherit;" 
								data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" 
								style="z-index: 7; white-space: nowrap;">{{ substr($destaque->IMB_IMV_OBSWEB,0,60)}}
						<br> {{ substr($destaque->IMB_IMV_OBSWEB,61,120)}}....<span class="text-theme-colored2"><a href="{{route('detalhe')}}/{{$destaque->IMB_IMV_ID}}">ver mais</a></span>
                        </div>
                        <!-- LAYER NR. 4 -->
						<div class="tp-caption tp-resizeme text-white rs-parallaxlevel-0" 
							id="{{$destaque->IMB_IMG_ID}}-slide-1-layer-4" 
							data-x="['left','left','left','left']" data-hoffset="['53','53','53','30']" 
							data-y="['top','top','top','top']" data-voffset="['360','290','260','260']" 
							data-fontsize="['18','18','16','16']" data-lineheight="['30','30','30','30']" 
							data-fontweight="['600','600','600','600']" data-width="['700','650','600','420']" 
							data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" 
							data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" 
							data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" 
							data-mask_out="x:0;y:0;s:inherit;e:inherit;" data-start="1000" data-splitin="none" 
							data-splitout="none" data-responsive_offset="on" style="z-index: 7; white-space: nowrap;">
							<a href="{{route('detalhe')}}/{{$destaque->IMB_IMV_ID}}" class="btn btn-default btn-theme-colored2 btn-xl">{{substr($destaque->IMB_IMV_REFERE,0,2)}}-{{substr($destaque->IMB_IMV_REFERE,2,4)}}</a> <a href="#" class="btn btn-dark btn-theme-colored btn-xl">Contato</a>
                        </div>
                    </li>
				@endforeach
			</ul>
			<div class="tp-bannertimer tp-bottom" style="height: 5px; background-color: #0098ef;"></div>
		</div>
	</div>
	<!-- END REVOLUTION SLIDER -->
	<!-- END SECTION HEADINGS -->

	<!-- START SECTION SEARCH AREA -->
	<section class="main-search-field">
		<div class="container">
			<h3>Localize seu imóvel</h3>
			<form action="{{route('site.pesquisa')}}" id="i-formpesquisa">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="at-col-default-mar">
						<input type="hidden" id="i-cidade" name="IMB_IMV_CIDADE"> 
						<select id="i-select-cidade">
							<option value="" selected>Cidade</option>
							@foreach( $cidades as $cidade )
								<option value="{{$cidade->IMB_IMV_CIDADE}}">{{$cidade->IMB_IMV_CIDADE}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="at-col-default-mar">
						<select class="div-toggle" data-target=".my-info-1" name="finalidade" id="i-select-finalidade">
							<option value="N" data-show=".acitveon" selected>Finalidade</option>
							<option value="V" data-show=".sale">Venda</option>
							<option value="L" data-show=".rent">Locação</option>
							<option value="T" data-show=".rent">Todos</option>
						</select>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="at-col-default-mar">
						<div class="at-col-default-mar">
								<input class="at-input" type="text" name="bairro" placeholder="Bairro: Pode ser parte o nome">
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="at-col-default-mar">
						<div class="at-col-default-mar">
							<select name="IMB_TIM_ID" id="i-select-tipoimovel"> 
								<option value="0" selected>Tipo</option>
								@foreach( $tipoimovel as $tipo)
									<option value="{{$tipo->IMB_TIM_ID}}">{{$tipo->IMB_TIM_DESCRICAO}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="at-col-default-mar">
						<select class="div-toggle" data-target=".my-info-1">
							<option value="0" selected>Dormitórios</option>
							<option value="1">1 / Ou + </option>
							<option value="2">2 / ou +</option>
							<option value="3">3 / ou +</option>
							<option value="4">4 / ou +</option>
							<option value="5">5 / ou +</option>
							<option value="6">6 / ou +</option>
							<option value="7">7 / ou +</option>
							<option value="8">8 / ou +</option>
							<option value="9">9 / ou +</option>
							<option value="10">10 / ou +</option>
						</select>
					</div>
				</div>

				<div class="col-lg-3 no-pds">
					<div class="at-col-default-mar no-mb">
					<input class="at-input" type="number" name="valorinicial" min="100" id="i-valorinicial" placeholder="Faixa Inicial R$">
					</div>
				</div>
				<div class="col-lg-3 no-pds">
					<div class="at-col-default-mar no-mb">
						<input class="at-input" type="number" name="valorfinal"  min="100" id="i-valorfinal"  placeholder="Faixa Final R$">
					</div>
				</div>

				<div class="col-lg-3 col-md-6">
					<div class="at-col-default-mar">
					<input class="at-input" type="text" name="referencia" placeholder="Referência">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3 col-md-6 hidden">
					<div class="at-col-default-mar">
						<select name='unidade'>
							<option value="3" selected>Altos da Cidade</option>
						</select>
					</div>
				</div>

				<div class="col-lg-3 col-md-6">
				</div>
				<div class="col-lg-3 col-md-6">
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="at-col-default-mar no-mb">
						<button class="btn btn-default hvr-bounce-to-right" type="submit" id="i-btn-pesquisar">Vamos lá</button>
					</div>
				</div>
			</div>
			</form>
		</div>
	</section>
	<!-- END SECTION SEARCH AREA -->

	<!-- START SECTION RECENTLY PROPERTIES -->
	<section class="recently portfolio">
		<div class="container-fluid">
			<div class="section-title">
				<h3>Novos</h3>
				<h2>Cadastros</h2>
			</div>
			<div class="row portfolio-items">
			
				@foreach( $ultimos as $ultimo)
				<div class="item col-lg-3 col-md-6 col-xs-12 landscapes">
					<div class="project-single">
						<div class="project-inner project-head">
							<div class="project-bottom">
								<h4><a href="{{route('detalhe')}}/{{$ultimo->IMB_IMV_ID}}">Click Aqui</a><span class="category">para detalhes</span></h4>
							</div>
							<div class="button-effect">
								<a href="{{route('detalhe')}}/{{$ultimo->IMB_IMV_ID}}" class="btn"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
<!--								<a href="https://www.youtube.com/watch?v=2xHQqYRcrx4" class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>-->
							</div>
							<div class="homes">
								<!-- homes img -->
								<a href="{{route('site.detalhe')}}/{{$ultimo->IMB_IMV_ID}}" class="homes-img">
									<div class="homes-tag button alt featured">Detalhes</div>
									@if ( $ultimo->IMB_IMV_VALLOC > 0 && $ultimo->IMB_IMV_VALVEN > 0 )
										<div class="homes-tag button alt sale">Venda/Loc.</div>
										@elseif ( $ultimo->IMB_IMV_VALLOC > 0 )
										<div class="homes-tag button rent sale">Locação</div>
									@elseif ( $ultimo->IMB_IMV_VALVEN > 0 )
										<div class="homes-tag button alt sale">Venda</div>
									@endif
									<div class="homes-price">{{$ultimo->IMB_TIM_DESCRICAO}}</div>									
									<?php
												
//										if ( file_exists( $imagem ) )
											//$imagem="/images/imoveis/'.$ultimo->IMB_IMV_ID.'/thumbnail/thumb_'.$ultimo->IMB_IMG_ARQUIVO";
//										else
//											$imagem="/images/logo.png" ;
										?>
									<img src="/sys/storage/images/3/imoveis/{{$ultimo->IMB_IMV_ID}}/{{$ultimo->IMB_IMG_ARQUIVO}}" alt="{{$ultimo->IMB_IMG_D}}" class="img-responsive">
								</a>
							</div>
						</div>
						<!-- homes content -->
						<div class="homes-content">
							<!-- homes address -->
							<h3>{{$ultimo->CEP_BAI_NOME}}</h3>
							<p class="homes-address mb-3">
								<a href="{{route('site.detalhe')}}/{{$ultimo->IMB_IMV_ID}}">
									<i class="fa fa-map-marker"></i><span>{{substr($ultimo->IMB_IMV_REFERE,0,2)}}-{{substr($ultimo->IMB_IMV_REFERE,2,4)}}</span>
								</a>
								
								<a href="https://wa.me/5514997002400?text=Olá!%20Gostaria%20de%20receber%20mais%20informações%20sobre%20o%20imóvel%20{{$ultimo->IMB_IMV_REFERE}}" target="_blank">
									<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
									<i class="fa fa-whatsapp" aria-hidden="true"></i>
									
								</a>
								<a href="javascript:enviarPorEmail( {{$ultimo->IMB_IMV_ID}} );">
									<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
									<i class="fa fa-envelope" aria-hidden="true"></i>
									
								</a>
							</p>
							<!-- homes List -->
							<ul class="homes-list clearfix">
								<li>
									<i class="fa fa-bed" aria-hidden="true"></i>
									<span>{{$ultimo->IMB_IMV_DORQUA}} Dorm.</span>
								</li>
								<li>
									<i class="fa fa-bed" aria-hidden="true"></i>
									<span>{{$ultimo->IMB_IMV_SUIQUA}} Suítes</span>
								</li>
								<li>
									<i class="fa fa-bath" aria-hidden="true"></i>
									<span>{{$ultimo->IMB_IMV_WCQUA}} WCs</span>
								</li>
								<li>
									<i class="fas fa-warehouse" aria-hidden="true"></i>
									<span>{{$ultimo->IMB_IMV_GARCOB+$ultimo->IMB_IMV_GARDES}} Garagem</span>
								</li>
							</ul>
							<!-- Price -->
							<div class="price-properties">
								<h3 class="title mt-3">
                                <a href="{{ route('site.detalhe')}}/{{$ultimo->IMB_IMV_ID}}">
									@if ( $ultimo->IMB_IMV_VALLOC > 0 && $ultimo->IMB_IMV_VALVEN > 0 )
										Venda: ${{number_format($ultimo->IMB_IMV_VALVEN, 2, ',', '.')}}<br>
										Locação: ${{number_format($ultimo->IMB_IMV_VALLOC, 2, ',', '.')}}
									@elseif ( $ultimo->IMB_IMV_VALLOC > 0 )
										Locação: ${{number_format($ultimo->IMB_IMV_VALLOC, 2, ',', '.')}}<br>
										-
									@elseif ( $ultimo->IMB_IMV_VALVEN > 0 )
										Venda: ${{number_format($ultimo->IMB_IMV_VALVEN, 2, ',', '.')}}<br>
										-
									@endif
								</a>
                                </h3>
							</div>
							<div class="footer">
								<a href="agent-details.html">
									<i class="fa fa-user"></i> {{$ultimo->IMB_IMB_NOME}}
								</a>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	<!-- END SECTION RECENTLY PROPERTIES -->


	<!-- STAR SECTION WELCOME -->
	<section class="welcome">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12 col-xs-12">
					<div class="welcome-title">
						<h2>Bem-vindos ao <span>site de nossa imobiliária</span></h2>
						<h4>O Lugar certo para encontrar o imóvel certo.</h4>
					</div>
					<div class="welcome-services">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-xs-12 ">
								<div class="w-single-services">
									<div class="services-img img-1">
										<img src="" width="32" alt="">
									</div>
									<div class="services-desc">
										<h6>Deseja Comprar?</h6>
										<p>Temos imóveis sob medida
											<br> pra você e tua família</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-xs-12 ">
								<div class="w-single-services">
									<div class="services-img img-2">
										<img src="" width="32" alt="">
									</div>
									<div class="services-desc">
										<h6>Quer vender?</h6>
										<p>Deixe seu imóvel conosco
											<br> encontraremos os melhores compradores</p>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-xs-12 ">
								<div class="w-single-services no-mb mbx">
									<div class="services-img img-3">
										<img src="" width="32" alt="">
									</div>
									<div class="services-desc">
										<h6>Quer alugar?</h6>
										<p>Com certeza irá encontrar
											<br> o imóvel que procura.</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-xs-12 ">
								<div class="w-single-services no-mb">
									<div class="services-img img-4">
										<img src="" width="32" alt="">
									</div>
									<div class="services-desc">
										<h6>Vários imóveis</h6>
										<p>Apartamento, Casas, Terrenos
											<br> Chácaras, Sítios e Fazendas</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-12 col-xs-12">
					<div class="wprt-image-video w50">
						<a class="icon-wrap popup-video popup-youtube" href="https://www.youtube.com/watch?v=2xHQqYRcrx4">
							<i class="fa fa-play"></i>
						</a>
						<div class="iq-waves">
							<div class="waves wave-1"></div>
							<div class="waves wave-2"></div>
							<div class="waves wave-3"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- END SECTION WELCOME -->

	<!-- START SECTION SERVICES -->
	<section class="services-home bg-white">
		<div class="container">
			<div class="section-title">
				<h3>Nossos</h3>
				<h2>Imóveis</h2>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-12 m-top-0 m-bottom-40">
					<div class="service bg-light-2 border-1 border-light box-shadow-1 box-shadow-2-hover">
						<div class="media">
							<i class="fa fa-home bg-base text-white rounded-100 box-shadow-1 p-top-5 p-bottom-5 p-right-5 p-left-5"></i>
						</div>
						<div class="agent-section p-top-35 p-bottom-30 p-right-25 p-left-25">
							<h4 class="m-bottom-15 text-bold-700">Casas</h4>
							<p>Temos casas em vários padrões e ótimas localizações.</p>
							<a class="text-base text-base-dark-hover text-size-13" href="properties-full-list.html">Acesse <i class="fa fa-long-arrow-right"></i></a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-12 m-top-40 m-bottom-40">
					<div class="service bg-light-2 border-1 border-light box-shadow-1 box-shadow-2-hover">
						<div class="media">
							<i class="fas fa-building bg-base text-white rounded-100 box-shadow-1 p-top-5 p-bottom-5 p-right-5 p-left-5"></i>
						</div>
						<div class="agent-section p-top-35 p-bottom-30 p-right-25 p-left-25">
							<h4 class="m-bottom-15 text-bold-700">Apartamentos</h4>
							<p>Apartamentos em excelentes condomínios e em vários padrões.</p>
							<a class="text-base text-base-dark-hover text-size-13" href="properties-full-list.html">Acesse <i class="fa fa-long-arrow-right"></i></a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-12 m-top-40 m-bottom-40 commercial">
					<div class="service bg-light-2 border-1 border-light box-shadow-1 box-shadow-2-hover">
						<div class="media">
							<i class="fas fa-warehouse bg-base text-white rounded-100 box-shadow-1 p-top-5 p-bottom-5 p-right-5 p-left-5"></i>
						</div>
						<div class="agent-section p-top-35 p-bottom-30 p-right-25 p-left-25">
							<h4 class="m-bottom-15 text-bold-700">Terrenos</h4>
							<p>Encontre aqui os mais variados terrenos, das mais variadas dimensões, em bairros e condomínios</p>
							<a class="text-base text-base-dark-hover text-size-13" href="properties-full-list.html">Acesse <i class="fa fa-long-arrow-right"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- END SECTION SERVICES -->

	
	<!-- START SECTION AGENTS -->
	<section class="team">
		<div class="container">
			<div class="section-title col-md-5">
				<h3>Fale com nossos</h3>
				<h2>Corretores</h2>
			</div>
			<div class="row team-all">
				<div class="col-lg-3 col-md-6 team-pro hover-effect">
					<div class="team-wrap">
						<div class="team-img">
							<img src="{{asset('/fluxo/images/team/suzanaabreu.jpg')}}" alt="" />
						</div>
						<div class="team-content">
							<div class="team-info">
								<h3>Suzana</h3>
								<p>Diretora</p>
								<div class="team-socials">
									<ul>
										<li>
											<a href="https://web.facebook.com/FluxoImoveis" title="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
											<a href="https://api.whatsapp.com/send?phone=5514997626163&text=Olá Suzana, tudo bem?" title="whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
										</li>
									</ul>
								</div>
								<span><a href="agent-details.html">Ver Informações</a></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 team-pro hover-effect">
					<div class="team-wrap">
						<div class="team-img">
							<img src="{{asset('/fluxo/images/logo.jpg')}}" alt="" />
						</div>
						<div class="team-content">
							<div class="team-info">
								<h3>Depto. Locação</h3>
								<p>Atendimento Locação</p>
								<div>
									<ul>
										<li>
											<a href="https://web.facebook.com/FluxoImoveis" title="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
											<a href="https://api.whatsapp.com/send?phone=5514997702400&text=Olá Fluxo Imoveis, tudo bem?" title="whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
										</li>
									</ul>
								</div>
								<span>Fone: 3224-2400</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 team-pro hover-effect">
					<div class="team-wrap">
						<div class="team-img">
						<img src="{{asset('/fluxo/images/logo.jpg')}}" alt="" />
						</div>
						<div class="team-content">
							<div class="team-info">
								<h3>Depto. Vendas</h3>
								<p>Atendimento Vendas</p>
								<div class="team-socials">
								<div>
									<ul>
										<li>
											<a href="https://web.facebook.com/FluxoImoveis" title="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
											<a href="https://api.whatsapp.com/send?phone=5514997702400&text=Olá Fluxo Imoveis, tudo bem?" title="whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
										</li>
									</ul>
								</div>
								<span>Fone: 3224-2400</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- END SECTION AGENTS -->

	<!-- START SECTION TESTIMONIALS -->
	<section class="testimonials">
		<div class="container">
			<div class="section-title col-md-5">
				<h3>Clientes</h3>
				<h2>Satisfeitos</h2>
			</div>
			<div class="owl-carousel style1">
				<div class="test-1">
					<h3>Demétrius</h3>
					<img src="" alt="">
					<h6 class="mt-2">Bauru</h6>
					<ul class="starts text-center mb-2">
						<li><i class="fa fa-star"></i>
						</li>
						<li><i class="fa fa-star"></i>
						</li>
						<li><i class="fa fa-star"></i>
						</li>
						<li><i class="fa fa-star"></i>
						</li>
						<li><i class="fa fa-star"></i>
						</li>
					</ul>
					<p>Atendimento exemplar, com respeito e honestidade.</p>
				</div>
				<div class="test-1">
					<h3>Júlio Cesar</h3>
					<img src="" alt="">
					<h6 class="mt-2">Presidente Epitácio</h6>
					<ul class="starts text-center mb-2">
						<li><i class="fa fa-star"></i>
						</li>
						<li><i class="fa fa-star"></i>
						</li>
						<li><i class="fa fa-star"></i>
						</li>
					</ul>
					<p>Atendimento rápido e personalizado. Em busca de imóveis que me atenda</p>
				</div>
				<div class="test-1">
					<h3>Édio Cássio</h3>
					<img src="" alt="">
					<h6 class="mt-2">Presidente Prudente</h6>
					<ul class="starts text-center mb-2">
						<li><i class="fa fa-star"></i>
						</li>
						<li><i class="fa fa-star"></i>
						</li>
						<li><i class="fa fa-star"></i>
						</li>
						<li><i class="fa fa-star"></i>
						</li>
						<li><i class="fa fa-star"></i>
						</li>
					</ul>
					<p>Recomendo. Profissionais dedicados ao cliente.</p>
				</div>
			</div>
		</div>
	</section>
	<!-- END SECTION TESTIMONIALS -->

	
	<!-- START FOOTER -->
	<footer class="first-footer">
		<div class="top-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="contactus">
							<h3>Contatos</h3>
							<ul>
								<li>
									<div class="info">
										<i class="fa fa-map-marker" aria-hidden="true"></i>
										<p class="in-p"> Rua Virgílio Malta, 17016 - Vila Mesquita - Bauru(SP)</p>

									</div>
								</li>
								<li>
									<div class="info">
										<i class="fa fa-phone" aria-hidden="true"></i>
										<p class="in-p">(14) 3224-2400</p>
									</div>
								</li>
								<li>
									<div class="info">
										<i class="fa fa-envelope" aria-hidden="true"></i>
										<p class="in-p ti">contato@fluxoimoveis.com.br</p>
									</div>
								</li>
							</ul>
						</div>
						<ul class="netsocials">
							<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="second-footer">
			<div class="container">
				<p>2019 © Copyright - Todos Direitos Reservados.</p>
				<p>Produzido pela <i class="fa fa-heart" aria-hidden="true"></i> Compdados Tecnologia</p>
			</div>
		</div>
	</footer>

	<div class="modal" tabindex="-1" role="dialog" id="div-modal-email">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input type="hidden" id="i-email-processo">
          <input type="hidden" id="i-email-imovel">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Email destino</label>
                        <input type="email" class="form-control" name="i-email-resumoimovel"
                             id="i-email-resumoimovel">
                    </div>
                </div>
            </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onClick="enviarResumoImovel()">Enviar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

	<a data-scroll href="#heading" class="go-up"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
	<!-- END FOOTER -->

	<!-- START PRELOADER -->
	<div id="preloader">
		<div id="status">
			<div class="status-mes"></div>
		</div>
	</div>
	<!-- END PRELOADER -->

	<!-- ARCHIVES JS -->
	<script src="{{asset('/fluxo/js/jquery.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/jquery-ui.js')}}"></script>
	<script src="{{asset('/fluxo/js/tether.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/moment.js')}}"></script>
	<script src="{{asset('/fluxo/js/transition.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/fitvids.js')}}"></script>
	<script src="{{asset('/fluxo/js/jquery.waypoints.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/jquery.counterup.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/imagesloaded.pkgd.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/isotope.pkgd.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/smooth-scroll.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/lightcase.js')}}"></script>
	<script src="{{asset('/fluxo/js/owl.carousel.js')}}"></script>
	<script src="{{asset('/fluxo/js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/ajaxchimp.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/newsletter.js')}}"></script>
	<script src="{{asset('/fluxo/js/jquery.form.js')}}"></script>
	<script src="{{asset('/fluxo/js/jquery.validate.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/forms-2.js')}}"></script>

	<!-- Slider Revolution scripts -->
	<script src="{{asset('/fluxo/js/revolution/jquery.themepunch.tools.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/revolution/jquery.themepunch.revolution.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/revolution/extensions/revolution.extension.actions.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/revolution/extensions/revolution.extension.carousel.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/revolution/extensions/revolution.extension.kenburn.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/revolution/extensions/revolution.extension.layeranimation.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/revolution/extensions/revolution.extension.migration.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/revolution/extensions/revolution.extension.navigation.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/revolution/extensions/revolution.extension.parallax.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/revolution/extensions/revolution.extension.slideanims.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/revolution/extensions/revolution.extension.video.min.js')}}"></script>

	<script>
		var tpj = jQuery;
		var revapi34;
		if (tpj("#rev_slider_home").revolution === undefined) {
			revslider_showDoubleJqueryError("#rev_slider_home");
		} else {
			revapi34 = tpj("#rev_slider_home").show().revolution({
				sliderType: "standard",
				jsFileLocation: "js/revolution-slider/fluxo/js/",
				sliderLayout: "fullwidth",
				dottedOverlay: "none",
				delay: 9000,
				navigation: {
					keyboardNavigation: "on",
					keyboard_direction: "horizontal",
					mouseScrollNavigation: "off",
					onHoverStop: "on",
					touch: {
						touchenabled: "on",
						swipe_threshold: 75,
						swipe_min_touches: 1,
						swipe_direction: "horizontal",
						drag_block_vertical: false
					},
					arrows: {
						style: "zeus",
						enable: true,
						hide_onmobile: true,
						hide_under: 600,
						hide_onleave: true,
						hide_delay: 200,
						hide_delay_mobile: 1200,
						
						tmp: '<div class="tp-title-wrap"><div class="tp-arr-imgholder"></div> </div>',
						left: {
							h_align: "left",
							v_align: "center",
							h_offset: 30,
							v_offset: 0
						},
						right: {
							h_align: "right",
							v_align: "center",
							h_offset: 30,
							v_offset: 0
						}
					},
					bullets: {
						enable: true,
						hide_onmobile: true,
						hide_under: 600,
						style: "metis",
						hide_onleave: true,
						hide_delay: 200,
						hide_delay_mobile: 1200,
						direction: "horizontal",
						h_align: "center",
						v_align: "bottom",
						h_offset: 0,
						v_offset: 30,
						space: 5,
						tmp: '<span class="tp-bullet-img-wrap"><span class="tp-bullet-image"></span></span>'
					}
				},
				viewPort: {
					enable: true,
					outof: "pause",
					visible_area: "80%"
				},
				responsiveLevels: [1240, 1024, 778, 480],
				gridwidth: [1240, 1024, 778, 480],
				gridheight: [600, 550, 500, 450],
				lazyType: "none",
				parallax: {
					type: "scroll",
					origo: "enterpoint",
					speed: 400,
					levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 50],
				},
				shadow: 0,
				spinner: "off",
				stopLoop: "off",
				stopAfterLoops: -1,
				stopAtSlide: -1,
				shuffle: "off",
				autoHeight: "off",
				hideThumbsOnMobile: "off",
				hideSliderAtLimit: 0,
				hideCaptionAtLimit: 0,
				hideAllCaptionAtLilmit: 0,
				debugMode: false,
				fallbacks: {
					simplifyAll: "off",
					nextSlideOnWindowFocus: "off",
					disableFocusListener: false,
				}
			});
		}

	</script>

	<script>


		$("#i-btn-pesquisar").click( function() {
            $("#i-cidade").val( $("#i-select-cidade").val() );
		});
			
		function enviarPorEmail( id )
    {
        $("#i-email-imovel").val( id );
        $("#div-modal-email").modal('show');

//        window.location = url = "{{route('pdfresumoimovel')}}/"+id;

    }

	function enviarResumoImovel()
    {
        if ( $("#i-email-resumoimovel").val() == '' )
        {
            alert( 'Informe um email');
            return false;
        }

        var id      = $("#i-email-imovel").val();
        var email   = $("#i-email-resumoimovel").val();

        url = url = "{{route('pdfresumoimovel')}}/"+id+"/"+email;

        $.ajax(
            {
                url: url, 
                type: 'get',
                datatype: 'json',
                async:false,
                success: function( data )
                {
                    alert( data );
                    $("#div-modal-email").modal('hide');
                },
                error: function()
                {
                    'erro ao envio';
                }

            }
        )


      


    }

	function whatsapp( id )
	{
		windows.locate( 'https://web.whatsapp.com/send?phone=5514991857709?text=Olá,'+
			'gostaria de receber mais informações sobre o imovel '+id );
	}
	</script>

	<!-- MAIN JS -->
	<script src="{{asset('/fluxo/js/script.js')}}"></script>

</body>

</html>
