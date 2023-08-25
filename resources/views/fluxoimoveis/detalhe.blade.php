<html lang="PT-BR">

<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="Fluxo Imóveis - Site de Busca de Imóveis">
	<meta name="author" content="Compdados Tecnologia">
	<title>Detalhes do Imóvel</title>
	<!-- FAVICON -->
	<script src="{{asset('/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i%7CMontserrat:600,800" rel="stylesheet">
	<!-- FONT AWESOME -->
	<link rel="stylesheet" href="{{asset('/fluxo/css/fontawesome-all.min.css')}}">
		<!-- ARCHIVES CSS -->
	<link rel="stylesheet" href="{{asset('/global/css/animate.css')}}">
	<link rel="stylesheet" href="{{asset('/fluxo/css/magnific-popup.css')}}">
	<link rel="stylesheet" href="{{asset('/fluxo/css/lightcase.css')}}">
	<link rel="stylesheet" href="{{asset('/fluxo/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('/fluxo/css/bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('/fluxo/css/styles.css')}}">
	<link rel="stylesheet" id="color" href="{{asset('/fluxo/css/default.css')}}">
	<script src="https://kit.fontawesome.com/6f14330d53.js" crossorigin="anonymous"></script>

	<style>
.cardtitulo {
  text-align: center;
  font-size: 16px;
  color: #4682B4; 
  font-weight: bold;

}

H3 
		{
	    	text-align: right;
    		font-size: 16px;
			font-weight: bold;

  		}

		H4
		{
	    	text-align: left;
    		font-size: 16px;
			font-weight: bold;

  		}

 	    H2 
		{
	    	text-align: center;
    		font-size: 20px;
			font-weight: bold;
			color: blue;

  		}


	</style>
</head>

<body class="inner-pages">
	<!-- START SECTION HEADINGS -->
		<!-- START SECTION HEADINGS -->
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
		
		<div class="header-bottom heading " id="heading">
			<div class="container">
			<a href="{{route('fluxoimoveis')}}">

					<img src="{{asset('/fluxo/images/logo.jpg')}}" alt="realhome">
				</a>
				<button type="button" class="button-menu hidden-lg-up" data-toggle="collapse" data-target="#main-menu" aria-expanded="false">
					<i class="fa fa-bars" aria-hidden="true"></i>
				</button>

				<nav id="main-menu" class="collapse">
					<ul>
						
						<!-- END COLLAPSE MOBILE MENU -->
						<li><a href="{{route('fluxoimoveis')}}">Home</a></li>
						
					
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



	<!-- END SECTION HEADINGS -->

	<!-- START SECTION PROPERTIES LISTING -->
	<section class="blog details">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-md-12 blog-pots">
					<!-- Block heading Start-->
						<div class="row">
							<div class="col-md-12">
								<H2>
	                                {{$imovel->CEP_BAI_NOME}} - {{substr($imovel->IMB_IMV_REFERE,0,2)}}-{{substr($imovel->IMB_IMV_REFERE,2,4)}}
								</H2>
							</div>
						</div>
						<div class="row ">
							<input type="hidden" id="i-valorvenda" value="{{$imovel->IMB_IMV_VALVEN}}">
							<input type="hidden" id="i-valorlocacao" value="{{$imovel->IMB_IMV_VALLOC}}">
							<div class="col-md-6 cardtitulo" id="i-div-valorvenda">
							</div>
							<div class="col-md-6 cardtitulo" id="i-div-valorlocacao">
							</div>
						</div>
					<!-- Block heading end -->
					<div class="row">
						<div class="col-md-12 mb-4">
							<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
								<ol class="carousel-indicators">
								<?php $contador=-1;?>
									@foreach( $imagens as $imagem )
									<?php $contador = $contador + 1;?>
										@if( $contador == 0 )
											<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
 									    @elseif( $contador <> 0 )
											<li data-target="#carouselExampleIndicators" data-slide-to="{{$contador}}"></li>
										@endif 	
									@endforeach

								</ol>
								<div class="carousel-inner" role="listbox">
									<?php $contador=-1;?>
     								   	@foreach( $imagens as $imagem )
									   <?php $contador = $contador + 1;?>
										@if( $contador == 0 )
											<div class="carousel-item active" >
											<img class="d-block img-fluid" 
											src="/sys/storage/images/3/imoveis/{{$imagem->IMB_IMV_ID}}/{{$imagem->IMB_IMG_ARQUIVO}}"  alt="First slide">
										</div>
										@elseif ($contador <> 0 )
											<div class="carousel-item" >
											<img class="d-block img-fluid" 
											src="/sys/storage/images/3/imoveis/{{$imagem->IMB_IMV_ID}}/{{$imagem->IMB_IMG_ARQUIVO}}"  alt="slide">
											</div>
										@endif
									@endforeach
								</div>
								<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="sr-only">Anterior</span>
								</a>
								<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="sr-only">Próximo</span>
								</a>
							</div>
							<div class="blog-info details">
								<!-- cars content -->
								<div class="homes-content details-2 mb-5">
									<!-- cars List -->
									<ul class="homes-list clearfix">
										<li>
											<i class="fa fa-bed" aria-hidden="true"></i>
											<span>{{$imovel->IMB_IMV_DORQUA}} Dormitórios</span>
										</li>
										<li>
											<i class="fa fa-bath" aria-hidden="true"></i>
											<span>{{$imovel->IMB_IMV_WCQUA}} WCs</span>
										</li>
										<li>
											<i class="fa fa-clone" aria-hidden="true"></i>
											<span>{{$imovel->IMB_IMV_SUIQUA}} Suítes</span>
										</li>
										<li>
											<i class="fa fa-object-group" aria-hidden="true"></i>
											<span>{{$imovel->IMB_IMV_ARETOT}} m2</span>
										</li>
										<li>
											<i class="fa fa-car" aria-hidden="true"></i>
											<span>{{$imovel->IMB_IMV_GARCOB + $imovel->IMB_IMV_GARDES }} Garagens</span>
										</li>
										<li>
											<i class="fa fa-columns" aria-hidden="true"></i>
											<span>{{$imovel->IMB_IMV_SALQUA}} Salas</span>
										</li>
									</ul>
								</div>
								<p class="homes-address mb-3">
								<a href="{{route('site.detalhe')}}/{{$imovel->IMB_IMV_ID}}">
									<i class="fa fa-map-marker"></i><span>{{substr($imovel->IMB_IMV_REFERE,0,2)}}-{{substr($imovel->IMB_IMV_REFERE,2,4)}}</span>
								</a>
								
								<a href="https://wa.me/5514997002400?text=Olá!%20Gostaria%20de%20receber%20mais%20informações%20sobre%20o%20imóvel%20{{$imovel->IMB_IMV_REFERE}}" target="_blank">
									<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
									<i class="fa fa-whatsapp" aria-hidden="true"></i>
									
								</a>
								<a href="javascript:enviarPorEmail( {{$imovel->IMB_IMV_ID}} );">
									<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
									<i class="fa fa-envelope" aria-hidden="true"></i>
									
								</a>
								</p>								
								<h5 class="mb-4">Informações Gerais</h5>
								<p class="mb-3">{{$imovel->IMB_IMV_OBSWEB}}</p>
							</div>
						</div>
					</div>
					<!-- cars content -->
					<div class="homes-content details mb-5">
						<!-- title -->
						<h5 class="mb-4">Outras Características</h5>
						<!-- cars List -->
						<ul class="homes-list clearfix">
							@if( $imovel->IMB_IMV_PISCIN == 'S')
							<li>
								<i class="fa fa-check-square" aria-hidden="true"></i>
								<span>Piscina</span>
							</li>
							@endif
						    @if( $imovel->IMB_IMV_CHURRA == 'S')
							<li>
								<i class="fa fa-check-square" aria-hidden="true"></i>
								<span>Churrasqueira</span>
							</li>
							@endif
						    @if( $imovel->IMB_IMV_QUINTA == 'S')
							<li>
								<i class="fa fa-check-square" aria-hidden="true"></i>
								<span>Quintal</span>
							</li>
							@endif
						    @if( $imovel->IMB_IMV_EDICUL == 'S')
							<li>
								<i class="fa fa-check-square" aria-hidden="true"></i>
								<span>Edícula</span>
							</li>
							@endif
						    @if( $imovel->IMB_IMV_SALFES == 'S')
							<li>
								<i class="fa fa-check-square" aria-hidden="true"></i>
								<span>Salão de Festas</span>
							</li>
							@endif
						    @if( $imovel->IMB_IMV_GARCOB > 0)
							<li>
								<i class="fa fa-check-square" aria-hidden="true"></i>
								<span>Garagem Coberta</span>
							</li>
							@endif
						    @if( $imovel->IMB_IMV_PLAGRO =='S')
							<li>
								<i class="fa fa-check-square" aria-hidden="true"></i>
								<span>Playground</span>
							</li>
							@endif
							
						</ul>
					</div>
					<!-- START SECTION ASSIGNED AGENTS -->
					<!-- END SECTION ASSIGNED AGENTS -->
				</div>
			</div>
		</div>
	</section>
	<!-- END SECTION PROPERTIES LISTING -->

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
										<p class="in-p">Rua Virgílio Malta, 17016 - Vila Mesquita - Bauru(SP) </p>
									</div>
								</li>
								<li>
									<div class="info">
										<i class="fa fa-phone" aria-hidden="true"></i>
										<p class="in-p">14 3224-2400</p>
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

	<a data-scroll href="#heading" class="go-up"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
	<!-- END FOOTER -->

	<script>
		$( document ).ready(function() 
		{
			var valorvenda = $("#i-valorvenda").val();
			var valorlocacao = $("#i-valorlocacao").val();
			if  ( $("#i-valorvenda").val() != 0 )
			{
				$("#i-div-valorvenda").html( "Venda: R$ "+number_to_price(valorvenda));
//			  $("#i-div-valorvenda").css("background","#42F973");
			}
			else
			   $("#i-div-valorvenda").html( "Somente Locação" );

			if  ( $("#i-valorlocacao").val() != 0 )
			{
			  $("#i-div-valorlocacao").html( "Locação: R$ "+number_to_price(valorlocacao) );
//			  $("#i-div-valorlocacao").css("background","#CACE49");
			}
			else
			   $("#i-div-valorlocacao").html( "Somente Venda" );

		});

		function number_to_price(v){
    if(v==0){return '0,00';}
    v=parseFloat(v);
    v=v.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    v=v.split('.').join('*').split(',').join('.').split('*').join(',');
    return v;
}		
	</script>
	<!-- ARCHIVES JS -->
	<script src="{{asset('/fluxo/js/jquery.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/jquery-ui.js')}}"></script>
	<script src="{{asset('/fluxo/js/range-slider.js')}}"></script>
	<script src="{{asset('/fluxo/js/tether.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/smooth-scroll.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/popup.js')}}"></script>
	<script src="{{asset('/fluxo/js/ajaxchimp.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/newsletter.js')}}"></script>
	<script src="{{asset('/fluxo/js/leaflet.js')}}"></script>
	<script src="{{asset('/fluxo/js/leaflet-gesture-handling.min.js')}}"></script>
	<script src="{{asset('/fluxo/js/leaflet-providers.js')}}"></script>
	<script src="{{asset('/fluxo/js/leaflet.markercluster.js')}}"></script>
	<script src="{{asset('/fluxo/js/map-single.js')}}"></script>
	<script src="{{asset('/fluxo/js/inner.js')}}"></script>
</body>

</html>
