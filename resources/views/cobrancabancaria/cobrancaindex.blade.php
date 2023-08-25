@extends("layout.app")
@section('scripttop')
<style>

.div-center
{
  text-align:center;
}

.naoselecionada {
  text-decoration: line-through;
  color:red;
}

.div-right
{
    text-align:right;
}
  
.escondido
{
    display:none;
}

.lbl-medidas {
  text-align: center;
  font-size: 14px;
  
}
.lbl-medidas-valores {
  text-align: center;
  font-size: 14px;
  font-weight: bold;
  color: #4682B4; 
}

.div-border-blue-center{
    border:solid 1px #4682B4;
    text-align: center;
}
.lbl-medidas-outrositens {
  text-align: left;
  font-size: 12px;
  color: #4682B4; 
}

.cardtitulo {
  text-align: left;
  font-size: 16px;
  color: #4682B4; 
  font-weight: bold;

}

.lbl-download-title {
  text-align: center;
  font-size: 20px;
  font-weight: bold;
}

hr {
    height: 2px;
}

div .half-size-line
{
    line-height: 92%;
}

td, th
{
    text-align:center;
}

</style>
<script src="{{asset('/global/plugins/sweetalert/sweetalert2.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('/global/plugins/sweetalert/sweetalert2.min.css')}}">        

@endsection
@section('content')


<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Cobrança Bancária - Opções
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
        </div>
    </div>

    <div class="portlet-body form">
    <div class="row">
        <hr>
        </div>
        <div class="row" >

                <div class="col-md-12">
                    <div class="col-md-2 div-center"><span class="lbl-medidas"></span>
                    <label class="lbl-medidas">
                        <a href="{{route('cobranca.viewgerar')}}" title="Gerar Cobrança"><img src="{{asset('/global/img/gerar-cobanca-50.png')}}" alt=""></a>
                        <p>Gerar Cobrança</p>
                        
                    </label>
                    </div>
                    

                    <div class="col-md-2 div-center">
                        <label  class="lbl-medidas">
                            <a href="{{route('cobrancabancaria.cobrancagerada')}}" title="Consultar Geradas"><img src="{{asset('/global/img/cobranca-consultar-geradas-50.png')}}" alt=""></a>
                            <p>Consultar Geradas</p>
                            
                        </label>
                    </div>

                    <div class="col-md-2 div-center">
                        <label class="lbl-medidas control-label" >
                            <a href="{{route('cobrancabancaria.carteira.index')}}" title="Consultar Carteira"><img src="{{asset('/global/img/cobranca-consultar-carteria.50.png')}}" alt=""></a>
                            <p>Consultar Carteira</p>
                            
                        </label>

                    </div>
                    <div class="col-md-2 div-center">
                        <label class="lbl-medidas control-label" >
                            <a href="{{route('cobrancabancaria.lerretorno.index')}}" title="Ler Arquivo Retorno"><img src="{{asset('/global/img/lerretorno50.jpg')}}" alt=""></a>
                            <p>Ler Retorno</p>
                        </label>
                    </div>
                </div>
        </div>
        <div class="row">
        <hr>
        </div>        
    </div>
</div>

@endsection

@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/funcoes-recibolocatario.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/jquery.btechco.excelexport.js')}}"></script>
<script src="{{asset('/js/jquery.base64.js')}}"></script>

<script>

$( document ).ready(function() 
{
    $("#sirius-menu").click();

    
});



</script>

@endpush