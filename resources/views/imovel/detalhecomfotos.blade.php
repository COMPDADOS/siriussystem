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
	<link rel="stylesheet" href="{{asset('/site/css/fontawesome-all.min.css')}}">
		<!-- ARCHIVES CSS -->
	<link rel="stylesheet" href="{{asset('/global/css/animate.css')}}">
	<link rel="stylesheet" href="{{asset('/site/css/magnific-popup.css')}}">
	<link rel="stylesheet" href="{{asset('/site/css/lightcase.css')}}">
	<link rel="stylesheet" href="{{asset('/site/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('/site/css/bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('/site/css/styles.css')}}">
	<link rel="stylesheet" id="color" href="{{asset('/site/css/default.css')}}">
	<script src="https://kit.fontawesome.com/6f14330d53.js" crossorigin="anonymous"></script>

	<style>
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

	.div-img{
    width: 1024px;
    height: 768px;
    border-radius: 50%;
    overflow: hidden;
}

	</style>
</head>

<body class="inner-pages">
	<div class="page-bar">
    	<ul class="page-breadcrumb">
        	<li>
				<button onClick="fechar()" >Fechar</button>
        	</li>
    	</ul>
	</div>

	<!-- START SECTION PROPERTIES LISTING -->
	<section class="blog details">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-md-12 blog-pots">
					<!-- Block heading Start-->
						<div class="row">
							<div class="col-md-12">
								<H2>
	                                {{$imovel->CEP_BAI_NOME}}
								</H2>
							</div>
						</div>
						<div class="row">
							<input type="hidden" id="i-valorvenda" value="{{$imovel->IMB_IMV_VALVEN}}">
							<input type="hidden" id="i-valorlocacao" value="{{$imovel->IMB_IMV_VALLOC}}">
							<div class="col-md-6">
								<H4 id="i-div-valorvenda"></H4>
							</div>
							<div class="col-md-6">
								<H4 id="i-div-valorlocacao"></H4>
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
											src="{{url('')}}/storage/images/{{$imagem->IMB_IMB_ID}}/imoveis/{{$imagem->IMB_IMV_ID}}/{{$imagem->IMB_IMG_ARQUIVO}}"  alt="First slide">
										</div>
										@elseif ($contador <> 0 )
											<div class="carousel-item" >
											<img class="d-block img-fluid" 
											src="{{url('')}}/storage/images/{{$imagem->IMB_IMB_ID}}/imoveis/{{$imagem->IMB_IMV_ID}}/{{$imagem->IMB_IMG_ARQUIVO}}"  alt="slide">
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
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- END SECTION PROPERTIES LISTING -->

	<a data-scroll href="#heading" class="go-up"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
	<!-- END FOOTER -->

	<script>

	function fechar()
	{
		window.close();
	}

	
	function number_to_price(v)
	{
    	if(v==0){return '0,00';}
    	v=parseFloat(v);
    	v=v.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    	v=v.split('.').join('*').split(',').join('.').split('*').join(',');
    	return v;
	}		
	</script>
	<!-- ARCHIVES JS -->
	<script src="{{asset('/site/js/jquery.min.js')}}"></script>
	<script src="{{asset('/site/js/jquery-ui.js')}}"></script>
	<script src="{{asset('/site/js/range-slider.js')}}"></script>
	<script src="{{asset('/site/js/tether.min.js')}}"></script>
	<script src="{{asset('/site/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('/site/js/smooth-scroll.min.js')}}"></script>
	<script src="{{asset('/site/js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('/site/js/popup.js')}}"></script>
	<script src="{{asset('/site/js/ajaxchimp.min.js')}}"></script>
	<script src="{{asset('/site/js/newsletter.js')}}"></script>
	<script src="{{asset('/site/js/leaflet.js')}}"></script>
	<script src="{{asset('/site/js/leaflet-gesture-handling.min.js')}}"></script>
	<script src="{{asset('/site/js/leaflet-providers.js')}}"></script>
	<script src="{{asset('/site/js/leaflet.markercluster.js')}}"></script>
	<script src="{{asset('/site/js/map-single.js')}}"></script>
	<script src="{{asset('/site/js/inner.js')}}"></script>
</body>

</html>
