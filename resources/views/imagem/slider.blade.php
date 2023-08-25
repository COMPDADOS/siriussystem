<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagens do Imóvel</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <style>
  /* Make the image fully responsive */

.lbl-medidas-valores {
  text-align: center;
  font-size: 30px;
  font-weight: bold;
  color: #4682B4; 
}


.carousel{
  width:70%;
  align: center;
}
.item img{
  object-fit:cover;
  height:90%% !important;
  width:90%%;
}

.profile{
    width: 1024px;
    height: 768px;
    overflow: hidden;
}

.div-img {
    display: block;
    margin-left: auto;
    margin-right: auto;
}  

</style>
</head>
<body>

<div class="row ">
  <div class="col-md-12">
    <h2 class="lbl-medidas-valores">{{$imovel}}</h2>
  </div>
</div>
<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-10">
      <div id="demo" class="carousel slide " data-ride="carousel">

        <!-- Indicators -->
        <ul class="carousel-indicators">
          @foreach( $imagens as $imagem)
            @if( $loop->first)
              <li data-target="#demo" data-slide-to="{{$loop->iteration-1}}" class="active"></li>
            @else
              <li data-target="#demo" data-slide-to="{{$loop->iteration-1}}" ></li>
            @endif
          @endforeach
        </ul>
        
        <!-- The slideshow -->
        <div class="carousel-inner center-block">
        @foreach( $imagens as $imagem)
            @if( $loop->first )
              <div class="carousel-item  active">
                <img class="d-block w-100 div-img" src="{{url('')}}/storage/images/{{$imagem->IMB_IMB_ID}}/imoveis/{{$imagem->IMB_IMV_ID}}/{{$imagem->IMB_IMG_ARQUIVO}}" alt="First slide" width="1024" height="768">
              </div>
            @else
              <div class="carousel-item  ">
                <img class="d-block w-100 div-img" src="{{url('')}}/storage/images/{{$imagem->IMB_IMB_ID}}/imoveis/{{$imagem->IMB_IMV_ID}}/{{$imagem->IMB_IMG_ARQUIVO}}" alt="second slide" width="1024" height="768">
              </div>
            @endif
          @endforeach
        </div>
        
        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
          <span class="carousel-control-next-icon"></span>
        </a>
      </div>
    </div>
    <div class="col-md-2">
    </div>
</div>

</body>
</html>
