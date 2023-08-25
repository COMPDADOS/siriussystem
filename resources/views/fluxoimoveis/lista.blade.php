<!DOCTYPE html>
<html lang="PT-BR">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="Fluxo Imóveis - Site de Busca de Imóveis">
	<meta name="author" content="Compdados Tecnologia">
	<title>Resultado da Busca</title>
	<!-- FAVICON -->
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i%7CMontserrat:600,800" rel="stylesheet">
	<!-- FONT AWESOME -->
	<link rel="stylesheet" href="{{asset('/fluxo/css/fontawesome-all.min.css')}}">
	<link rel="stylesheet" href="{{asset('/fluxo/css/font-awesome.min.css')}}">
	<!-- ARCHIVES CSS -->
	<link rel="stylesheet" href="{{asset('/global/css/animate.css')}}">
	<link rel="stylesheet" href="{{asset('/fluxo/css/magnific-popup.css')}}">
	<link rel="stylesheet" href="{{asset('/fluxo/css/lightcase.css')}}">
	<link rel="stylesheet" href="{{asset('/fluxo/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('/fluxo/css/bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('/fluxo/css/styles.css')}}">
	<link rel="stylesheet" id="color" href="{{asset('/fluxo/css/default.css')}}">
	<script src="https://kit.fontawesome.com/6f14330d53.js" crossorigin="anonymous"></script>	
</head>

<body class="inner-pages">
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
					<div class="social-icons-header">
						<div class="social-icons">
							<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="header-bottom heading sticky-header" id="heading">
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
	<section class="properties-list full featured portfolio blog">
		<div class="container">
			<!-- Block heading Start-->
			<div class="block-heading">
				<div class="row">
					<div class="col-lg-6 col-md-5 col-2">
						<h4>
                            <span class="heading-icon">
                                <i class="fa fa-th-list"></i>
                                </span>
                                <span class="hidden-sm-down">Imóveis</span>
                            </h4>
					</div>
					<div class="col-lg-6 col-md-7 col-10 cod-pad">
						<div class="sorting-options">
							<select class="sorting">
								<option>Preço: Maior</option>
								<option>Preço: Menor</option>
							</select>
						</div>
					</div>
				</div>
			</div>

			<!-- Block heading end -->
			<div class="row featured portfolio-items">

					@foreach( $imoveis as $imovel)

					<div class="item col-lg-4 col-md-12 col-xs-12 landscapes sale pr-0 pb-0">
						<div class="project-single mb-0 bb-0">
							<div class="project-inner project-head">
								<div class="project-bottom">
									<h4><a href="properties-details.html"></a><span class="category">									
									@if ( $imovel->IMB_IMV_VALLOC > 0 && $imovel->IMB_IMV_VALVEN > 0 )
										Venda: ${{number_format($imovel->IMB_IMV_VALVEN, 2, ',', '.')}}<br>
										Locação: ${{number_format($imovel->IMB_IMV_VALLOC, 2, ',', '.')}}
									@elseif ( $imovel->IMB_IMV_VALLOC > 0 )
										Locação: ${{number_format($imovel->IMB_IMV_VALLOC, 2, ',', '.')}}<br>
										-
									@elseif ( $imovel->IMB_IMV_VALVEN > 0 )
										Venda: ${{number_format($imovel->IMB_IMV_VALVEN, 2, ',', '.')}}<br>
										-
									@endif
</span></h4>
								</div>
								<div class="button-effect">
									<a href="properties-details.html" class="btn"><i class="fa fa-link"></i></a>
									<a class="img-poppu btn" href="{{route('site.detalhe')}}/{{$imovel->IMB_IMV_ID}}" data-rel="lightcase:myCollection:slideshow"><i class="fa fa-photo"></i></a>
								</div>
								<div class="homes">
									<!-- homes img -->
									<a href="{{route('site.detalhe')}}/{{$imovel->IMB_IMV_ID}}"  class="homes-img">
										<div class="homes-tag button alt featured">Detalhes</div>
										@if ( $imovel->IMB_IMV_VALLOC > 0 && $imovel->IMB_IMV_VALVEN > 0 )
											<div class="homes-tag button alt sale">Venda/Loc.</div>
										@elseif ( $imovel->IMB_IMV_VALLOC > 0 )
											<div class="homes-tag button rent sale">Locação</div>
										@elseif ( $imovel->IMB_IMV_VALVEN > 0 )
											<div class="homes-tag button alt sale">Venda</div>
										@endif
										<div class="homes-price">{{$imovel->IMB_TIM_DESCRICAO}}</div>									
										<?php
										?>
										<img src="http://www.siriussystem.com.br/sys/storage/images/3/imoveis/{{$imovel->IMB_IMV_ID}}/{{$imovel->IMB_IMG_ARQUIVO}}" alt="home-1" class="img-responsive">';
									</a>
								</div>
							</div>
						</div>
					</div>
					<!-- homes content -->
					<div class="col-lg-8 col-md-12 homes-content pb-0 mb-44">
						<!-- homes address -->
						<h3>
						@if ( $imovel->IMB_IMV_VALLOC > 0 && $imovel->IMB_IMV_VALVEN > 0 )
										Venda: ${{number_format($imovel->IMB_IMV_VALVEN, 2, ',', '.')}} e 
										Locação: ${{number_format($imovel->IMB_IMV_VALLOC, 2, ',', '.')}}
									@elseif ( $imovel->IMB_IMV_VALLOC > 0 )
										Locação: ${{number_format($imovel->IMB_IMV_VALLOC, 2, ',', '.')}}
									@elseif ( $imovel->IMB_IMV_VALVEN > 0 )
										Venda: ${{number_format($imovel->IMB_IMV_VALVEN, 2, ',', '.')}}
									@endif
						</h3>
						<p class="homes-address mb-3">
								<a href="{{route('site.detalhe')}}/{{$imovel->IMB_IMV_ID}}">
									<i class="fa fa-map-marker"></i><span>{{substr($imovel->IMB_IMV_REFERE,0,2)}}-{{substr($imovel->IMB_IMV_REFERE,2,4)}}</span>
								</a>
								
								<a href="https://wa.me/5514997002400?text=Olá!%20Gostaria%20de%20receber%20mais%20informações%20sobre%20o%20imóvel%20{{$imovel->IMB_IMV_REFERE}}" target="_blank">
									<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
									<i class="fa fa-whatsapp" aria-hidden="true"></i>
									
								</a>
							</p>
						<!-- homes List -->
						<ul class="homes-list clearfix">
							<li>
								Bairro: {{$imovel->CEP_BAI_NOME}}
							</li>
							<li>
								<i class="fa fa-bed" aria-hidden="true"></i>
								<span>{{$imovel->IMB_IMV_DORQUA}} Dormit.</span>
							</li>
							<li>
								<i class="fa fa-bath" aria-hidden="true"></i>
								<span>{{$imovel->IMB_IMV_WCQUA}} WCs</span>
							</li>
							<li>
								<i class="fa fa-object-group" aria-hidden="true"></i>
								<span>Área Const/Útil: {{$imovel->IMB_IMV_ARECON}} m2</span>
							</li>
							<li>
								<i class="fas fa-warehouse" aria-hidden="true"></i>
								<span>{{$imovel->IMB_IMV_GARCOB+$imovel->IMB_IMV_GARDES}} Garagens</span>
							</li>
						</ul>
						<!-- Price -->
						<div class="price-properties">
							<div>
							{{$imovel->IMB_IMV_OBSWEB}}
							</div>
						</div>
						<div class="footer">
							<a href="agent-details.html">
								<i class="fa fa-user"></i> {{$imovel->IMB_IMB_NOME}}
							</a>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>
	<!-- END SECTION PROPERTIES LISTING -->

	
	<!-- END SECTION NEWSLETTER -->

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

	<!-- ARCHIVES JS -->
	<script src="js/jquery.min.js"></script>
	<script src="js/tether.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/smooth-scroll.min.js"></script>
	<script src="js/lightcase.js"></script>
	<script src="js/light.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/popup.js"></script>
	<script src="js/ajaxchimp.min.js"></script>
	<script src="js/newsletter.js"></script>
	<script src="js/inner.js"></script>
	
	<script>
	
	function enviarPorEmail( id )
    {
		alert( id );
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
</body>

</html>
