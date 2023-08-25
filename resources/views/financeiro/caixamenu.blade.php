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
.bs-example{
    	margin: 50px;
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
            <i class="fa fa-gift"></i>Bancos/Caixa- Opções
        </div>
            <div class="col-md-12">
                <div class="btn-toolbar">
                    <div class="btn-group">
                        <a class="btn dark btn-lg" data-toggle="dropdown">
                            <i class="fas fa-donate"></i> Cadastros
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{route('grupocfc')}}">
                                <i class="fas fa-donate"></i> Grupos de CFC(Fluxo de Caixa) </a>
                            </li>
                            <li>
                                <a href="{{route('cfc')}}">
                                <i class="fas fa-donate"></i> Códigos de CFC</a>
                            </li>
                            <li>
                                <a href="{{route('subconta')}}">
                                <i class="fas fa-donate"></i>Sub-Contas(Centros de Custos) </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="{{route('contacaixa')}}">
                                <i class="fas fa-donate"></i> Contas Banco/Caixa</a>
                            </li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <a class="btn dark btn-lg" data-toggle="dropdown">
                            <i class="fas fa-donate"></i> Movimentação
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{route('caixa.index')}}">
                                <i class="fas fa-donate"></i> Consultar/Lançamento/DRE </a>
                            </li>
                        </ul>
                    </div>                    
                </div>
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