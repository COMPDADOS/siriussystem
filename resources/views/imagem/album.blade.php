@extends('layout.app')
@section('scripttop')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <meta name="format-detection" content="telephone=no">


    <title>Album de Fotos </title>

    <link rel='stylesheet' id='theme-roboto-css'  href='http://fonts.googleapis.com/css?family=Roboto%3A400%2C400italic%2C500%2C500italic%2C700%2C700italic&#038;subset=latin%2Ccyrillic&#038;ver=4.5' type='text/css' media='all' />
    <link rel='stylesheet' id='theme-lato-css' href='http://fonts.googleapis.com/css?family=Lato%3A400%2C700%2C400italic%2C700italic&#038;ver=4.5' type='text/css' media='all' />

    <link rel="shortcut icon" href="images/favicon.png" />

    <link rel='stylesheet' id='font-awesome-css'    href="{{asset('realhome/css/font-awesome.min.css?ver=1.0.0')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='bootstrap-css-css'   href="{{asset('realhome/css/bootstrap.css?ver=2.2.2')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='responsive-css-css'  href="{{asset('realhome/css/responsive.css?ver=2.2.2')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='flexslider-css'      href="{{asset('realhome/js/flexslider/flexslider.css?ver=2.6.0')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='pretty-photo-css-css'href="{{asset('realhome/js/prettyphoto/css/prettyPhoto.css?ver=3.1.6')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='swipebox-css'        href="{{asset('realhome/js/swipebox/css/swipebox.min.css?ver=1.3.0')}}" type='text/css')" media='all' />
    <link rel='stylesheet' id='select2-css'         href="{{asset('realhome/js/select2/select2.css?ver=4.0.2')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='main-css-css'        href="{{asset('realhome/css/main.css?ver=2.5.5')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='custom-responsive-css-css'  href="{{asset('realhome//css/custom-responsive.css?ver=2.5.5')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='parent-custom-css'   href="{{asset('realhome/css/custom.css?ver=2.5.5')}}" type='text/css' media='all' />



    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <style>
          .img-album
        {
            max-width:100%;
                    height:auto;        }
    </style>
@endsection

@section('content')


<!-- Content -->
<div class="container contents detail">
    <div class="row">
        <div class="span9 main-wrap">
            <h1 class="page-title div-center"><span>{{$enderecocompleto}}</h1>
            <!-- Main Content -->
            <div class="main">

                <div id="overview">
                    <div id="property-detail-flexslider" class="clearfix">
                        <div class="flexslider">
                            <ul class="slides">@foreach( $imagens as $imagem)
                                <li data-thumb="{{url('')}}/storage/images/{{$imagem->IMB_IMB_ID}}/imoveis/{{$imagem->IMB_IMV_ID}}/{{$imagem->IMB_IMG_ARQUIVO}}">
                                    <a href="{{url('')}}/storage/images/{{$imagem->IMB_IMB_ID}}/imoveis/{{$imagem->IMB_IMV_ID}}/{{$imagem->IMB_IMG_ARQUIVO}}" class="swipebox" rel="gallery_real_homes">
                                        <img class="img-album" src="{{url('')}}/storage/images/{{$imagem->IMB_IMB_ID}}/imoveis/{{$imagem->IMB_IMV_ID}}/{{$imagem->IMB_IMG_ARQUIVO}}" alt="" />
                                    </a>
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                    </div>
                   
                    <article class="property-item clearfix">
                        <div class="wrap clearfix">
                            <h4 class="title"> Referência: {{$imovel->IMB_IMV_REFERE}}        </h4>
                            <h6 class="price">
                                <span class="status-label"> 
                                    @if( $imovel->IMB_IMV_VALVEN <> 0 and $imovel->IMB_IMV_VALLOC <> 0 )
                                        Venda/Loc
                                    @elseif( $imovel->IMB_IMV_VALLOC <> 0 )
                                        Locação
                                    @elseif( $imovel->IMB_IMV_VALVEN <> 0 )
                                      Venda
                                     @endif
                                </span>
                                <span>
                                    @if( $imovel->IMB_IMV_VALVEN <> 0 and $imovel->IMB_IMV_VALLOC <> 0 )
                                        R${{number_format( $imovel->IMB_IMV_VALVEN,2,'.','.')}}/R${{number_format( $imovel->IMB_IMV_VALLOC,2,'.','.')}}
                                    @elseif( $imovel->IMB_IMV_VALLOC <> 0 )
                                        R${{number_format( $imovel->IMB_IMV_VALLOC,2,'.','.')}}
                                    @elseif( $imovel->IMB_IMV_VALVEN <> 0 )
                                        R${{number_format( $imovel->IMB_IMV_VALVEN,2,'.','.')}}
                                    @endif
                                </span>
                            </h6>
                        </div>
                    

                        <div class="property-meta clearfix">
        <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
<path class="path" d="M14 7.001H2.999C1.342 7 0 8.3 0 10v11c0 1.7 1.3 3 3 3H14c1.656 0 3-1.342 3-3V10 C17 8.3 15.7 7 14 7.001z M14.998 21c0 0.551-0.447 1-0.998 1.002H2.999C2.448 22 2 21.6 2 21V10 c0.001-0.551 0.449-0.999 1-0.999H14c0.551 0 1 0.4 1 0.999V21z"/>
<path class="path" d="M14.266 0.293c-0.395-0.391-1.034-0.391-1.429 0c-0.395 0.39-0.395 1 0 1.415L13.132 2H3.869l0.295-0.292 c0.395-0.391 0.395-1.025 0-1.415c-0.394-0.391-1.034-0.391-1.428 0L0 3l2.736 2.707c0.394 0.4 1 0.4 1.4 0 c0.395-0.391 0.395-1.023 0-1.414L3.869 4.001h9.263l-0.295 0.292c-0.395 0.392-0.395 1 0 1.414s1.034 0.4 1.4 0L17 3 L14.266 0.293z"/>
<path class="path" d="M18.293 9.734c-0.391 0.395-0.391 1 0 1.429s1.023 0.4 1.4 0L20 10.868v9.263l-0.292-0.295 c-0.392-0.395-1.024-0.395-1.415 0s-0.391 1 0 1.428L21 24l2.707-2.736c0.391-0.394 0.391-1.033 0-1.428s-1.023-0.395-1.414 0 l-0.292 0.295v-9.263l0.292 0.295c0.392 0.4 1 0.4 1.4 0s0.391-1.034 0-1.429L21 7L18.293 9.734z"/>
</svg>
{{$imovel->IMB_IMV_ARETOT}}m2</span><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
<circle class="circle" cx="5" cy="8.3" r="2.2"/>
<path class="path" d="M0 22.999C0 23.6 0.4 24 1 24S2 23.6 2 22.999V18H2h20h0.001v4.999c0 0.6 0.4 1 1 1 C23.552 24 24 23.6 24 22.999V10C24 9.4 23.6 9 23 9C22.447 9 22 9.4 22 10v1H22h-0.999V10.5 C20.999 8 20 6 17.5 6H11C9.769 6.1 8.2 6.3 8 8v3H2H2V9C2 8.4 1.6 8 1 8S0 8.4 0 9V22.999z M10.021 8.2 C10.19 8.1 10.6 8 11 8h5.5c1.382 0 2.496-0.214 2.5 2.501v0.499h-9L10.021 8.174z M22 16H2v-2.999h20V16z"/>
</svg>
{{$imovel->IMB_IMV_DORQUA}}&nbsp;Dormit.</span><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
<path class="path" d="M23.001 12h-1.513C21.805 11.6 22 11.1 22 10.5C22 9.1 20.9 8 19.5 8S17 9.1 17 10.5 c0 0.6 0.2 1.1 0.5 1.5H2.999c0-0.001 0-0.002 0-0.002V2.983V2.98c0.084-0.169-0.083-0.979 1-0.981h0.006 C4.008 2 4.3 2 4.5 2.104L4.292 2.292c-0.39 0.392-0.39 1 0 1.415c0.391 0.4 1 0.4 1.4 0l2-1.999 c0.39-0.391 0.39-1.025 0-1.415c-0.391-0.391-1.023-0.391-1.415 0L5.866 0.72C5.775 0.6 5.7 0.5 5.5 0.4 C4.776 0 4.1 0 4 0H3.984v0.001C1.195 0 1 2.7 1 2.98v0.019v0.032v8.967c0 0 0 0 0 0.002H0.999 C0.447 12 0 12.4 0 12.999S0.447 14 1 14H1v2.001c0.001 2.6 1.7 4.8 4 5.649V23c0 0.6 0.4 1 1 1s1-0.447 1-1v-1h10v1 c0 0.6 0.4 1 1 1s1-0.447 1-1v-1.102c2.745-0.533 3.996-3.222 4-5.897V14h0.001C23.554 14 24 13.6 24 13 S23.554 12 23 12z M21.001 16.001c-0.091 2.539-0.927 3.97-3.001 3.997H7c-2.208-0.004-3.996-1.79-4-3.997V14h15.173 c-0.379 0.484-0.813 0.934-1.174 1.003c-0.54 0.104-0.999 0.446-0.999 1c0 0.6 0.4 1 1 1 c2.159-0.188 3.188-2.006 3.639-2.999h0.363V16.001z"/>
<rect class="rect" x="6.6" y="4.1" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 15.6319 3.2336)" width="1" height="1.4"/>
<rect class="rect" x="9.4" y="2.4" transform="matrix(0.7066 0.7076 -0.7076 0.7066 4.9969 -6.342)" width="1.4" height="1"/>
<rect class="rect" x="9.4" y="6.4" transform="matrix(0.7071 0.7071 -0.7071 0.7071 7.8179 -5.167)" width="1.4" height="1"/>
<rect class="rect" x="12.4" y="4.4" transform="matrix(0.7069 0.7073 -0.7073 0.7069 7.2858 -7.8754)" width="1.4" height="1"/>
<rect class="rect" x="13.4" y="7.4" transform="matrix(-0.7064 -0.7078 0.7078 -0.7064 18.5823 23.4137)" width="1.4" height="1"/>
</svg>
{{$imovel->IMB_IMV_WCQUA}}&nbsp;WC</span><span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
<path class="path" d="M23.958 0.885c-0.175-0.64-0.835-1.016-1.475-0.842l-11 3.001c-0.64 0.173-1.016 0.833-0.842 1.5 c0.175 0.6 0.8 1 1.5 0.842L16 4.299V6.2h-0.001H13c-2.867 0-4.892 1.792-5.664 2.891L5.93 11.2H5.024 c-0.588-0.029-2.517-0.02-3.851 1.221C0.405 13.1 0 14.1 0 15.201V18.2v2H2h2.02C4.126 22.3 5.9 24 8 24 c2.136 0 3.873-1.688 3.979-3.801H16V24h2V3.754l5.116-1.396C23.756 2.2 24.1 1.5 24 0.885z M8 22 c-1.104 0-2-0.896-2-2.001s0.896-2 2-2S10 18.9 10 20S9.105 22 8 22.001z M11.553 18.2C10.891 16.9 9.6 16 8 16 c-1.556 0-2.892 0.901-3.553 2.201H2v-2.999c0-0.599 0.218-1.019 0.537-1.315C3.398 13.1 5 13.2 5 13.2h2L9 10.2 c0 0 1.407-1.999 4-1.999h2.999H16v10H11.553z"/>
</svg>
Garagem - Coberta: {{$imovel->IMB_IMV_GARCOB}}&nbsp;Descoberta: {{$imovel->IMB_IMV_GARDES}}
</span>    
<span class="add-to-fav">
                 
    <div id="fav_output">
        <i class="fa fa-star-o dim"></i>&nbsp;
        <span id="fav_target" class="dim"></span>
    </div>

</span>

</article>                     
<div class="map-wrap clearfix">
    <p>{{$imovel->IMB_IMV_OBSWEB}}</p>
      <!-- Print link -->

</div>   
<div class="map-wrap clearfix">
    
    <div class="share-networks clearfix">
        <span class="share-label">Compartilhe</span>
        <span><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http://realhomes.inspirythemes.biz/property/15421-southwest-39th-terrace/"><i class="fa fa-facebook fa-lg"></i>Facebook</a></span>
        <span><a target="_blank" href="https://twitter.com/share?url=http://realhomes.inspirythemes.biz/property/15421-southwest-39th-terrace/" ><i class="fa fa-twitter fa-lg"></i>Twitter</a></span>
        <span><a target="_blank" href="https://plus.google.com/share?url={http://realhomes.inspirythemes.biz/property/15421-southwest-39th-terrace/}" onclick="javascript:window.open(this.href,  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes')"><i class="fa fa-google-plus fa-lg"></i>Google</a></span>
    </div>
</div>
<a href="#top" id="scroll-top"><i class="fa fa-chevron-up"></i></a>
@endsection
@push('script')
<script type='text/javascript'>
    var uiAutocompleteL10n = {"noResults":"No search results.","oneResult":"1 result found. Use up and down arrow keys to navigate.","manyResults":"%d results found. Use up and down arrow keys to navigate."};
    var localized = {"nav_title":"Go to..."};
    var localizedSearchParams = {"rent_slug":"for-rent"};
    var locationData = {"any_text":"Any","any_value":"any","all_locations":[{"term_id":27,"name":"Miami","slug":"miami","parent":0},{"term_id":41,"name":"Little Havana","slug":"little-havana","parent":27},{"term_id":30,"name":"Perrine","slug":"perrine","parent":27},{"term_id":40,"name":"Doral","slug":"doral","parent":27},{"term_id":48,"name":"Hialeah","slug":"hialeah","parent":27}],"select_names":["location","child-location","grandchild-location","great-grandchild-location"],"select_count":"1","locations_in_params":[]};
</script>

<script type='text/javascript' src="{{asset('realhome/js/jquery.js?ver=1.12.3')}}"></script>
<script type='text/javascript' src="{{asset('realhome/js/jquery-migrate.js?ver=1.4.0')}}"></script>
<script type='text/javascript' src="{{asset('realhome/js/inspiry-login-register.js?ver=2.5.5')}}"></script>
<script type='text/javascript' src="{{asset('realhome/js/inspiry-search-form.js?ver=2.5.5')}}"></script>
<script type='text/javascript' src="{{asset('realhome/js/flexslider/jquery.flexslider-min.js?ver=2.6.0')}}"></script>
<script type='text/javascript' src="{{asset('realhome/js/elastislide/jquery.easing.1.3.js?ver=1.3')}}"></script>
<script type='text/javascript' src="{{asset('realhome/js/elastislide/jquery.elastislide.js?ver=4.5')}}"></script>
<script type='text/javascript' src="{{asset('realhome/js/prettyphoto/jquery.prettyPhoto.js?ver=3.1.6')}}"></script>
<script type='text/javascript' src="{{asset('realhome/js/swipebox/js/jquery.swipebox.min.js?ver=1.4.1')}}"></script>
<script type='text/javascript' src="{{asset('realhome/js/isotope.pkgd.min.js?ver=2.1.1')}}"></script>
<script type='text/javascript' src="{{asset('realhome/js/jquery.jcarousel.min.js?ver=0.2.9')}}"></script>
<script type='text/javascript' src="{{asset('realhome/js/jquery.validate.min.js?ver=1.11.1')}}"></script>
<script type='text/javascript' src="{{asset('realhome/js/jquery.form.js?ver=3.40')}}"></script>
<script type='text/javascript' src="{{asset('realhome/js/select2/select2.full.min.js?ver=4.0.2')}}"></script>
<script type='text/javascript' src="{{asset('realhome/js/jquery.transit.min.js?ver=0.9.9')}}"></script>
<script type='text/javascript' src="{{asset('realhome/js/jquery-twitterFetcher.js?ver=15.1')}}"></script>
<script type='text/javascript' src="{{asset('realhome///maps.google.com/maps/api/js?language=en_US&#038;ver=3.21')}}"></script>
<script type='text/javascript' src="{{asset('realhome/js/infobox.js?ver=1.1.9')}}"></script>
<script type='text/javascript' src="{{asset('realhome/js/markerclusterer.js?ver=2.1.1')}}"></script>
<script type='text/javascript' src="{{asset('realhome/js/bootstrap.min.js?ver=4.5')}}"></script>
<script type='text/javascript' src="{{asset('realhome/js/custom.js?ver=2.5.5')}}"></script>

<script>
    /* Property Detail Page - Google Map for Property Location */

    function initialize_property_map(){

        var propertyMarkerInfo = {"lat":"-22.335648007105927","lang":"-49.06319940181841","icon":"http:\/\/realhomes.inspirythemes.biz\/wp-content\/themes\/realhomes\/images\/map\/villa-map-icon.png","retinaIcon":"http:\/\/realhomes.inspirythemes.biz\/wp-content\/themes\/realhomes\/images\/map\/villa-map-icon@2x.png"};
        var url = propertyMarkerInfo.icon;
        var size = new google.maps.Size( 42, 57 );
        
        // retina
        if( window.devicePixelRatio > 1.5 ) {
            if ( propertyMarkerInfo.retinaIcon ) {
                url = propertyMarkerInfo.retinaIcon;
                size = new google.maps.Size( 83, 113 );
            }
        }

        var image = {
            url: url,
            size: size,
            scaledSize: new google.maps.Size( 42, 57 ),
            origin: new google.maps.Point( 0, 0 ),
            anchor: new google.maps.Point( 21, 56 )
        };

        var propertyLocation = new google.maps.LatLng( propertyMarkerInfo.lat, propertyMarkerInfo.lang );
        var propertyMapOptions = {
            center: propertyLocation,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false
        };
        var propertyMap = new google.maps.Map(document.getElementById("property_map"), propertyMapOptions);
        var propertyMarker = new google.maps.Marker({
            position: propertyLocation,
            map: propertyMap,
            icon: image
        });
    }

    window.onload = initialize_property_map();
</script>
@endpush