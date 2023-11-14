@extends("layout.app")
@section('scripttop')

<meta http-equiv=\"content-type\" content=\"application/vnd.ms-excel; charset=UTF-8\">
<link href="{{asset('/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

<style>

.cinza
{
    color:red;
}
.Inativo
{
    text-decoration: line-through;
}
.debito
{
    color:red;
    font-weight: bold;
}
.credito
{
    color:blue;
    font-weight: bold;
}
.conciliado
{
    color:gray;
}
.naoconciliado
{
    color:Black;
}
.div-center
{
  text-align:center;
}

.naoselecionada {
  text-decoration: line-through;
  color:red;
}

.liberado
{
    color:white;
    background-color:green;
}
.rejeitado
{
    color:white;
    background-color:red;
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

th
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
            <i class="fa fa-gift"></i>Conciliação Bancária Via Arquivo Bancário
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
        </div>
    </div>

    <div class="portlet-body form">
        <div class="row" id="i-div-resultado">
            <div class="col-md-12">
                <table class="table table-bordered  table-striped table-hover" id="resultTable">
                    <thead>
                        <th width="2%"></th>
                        <th width="2%"></th>
                        <th width="7%">Data</th>
                        <th width="7%">Operação</th>
                        <th width="7%">Valor</th>
                        <th width="30%">Descrição</th>
                        <th width="33%">Conciliado no Lançamento</th>
                    </thead>
                    <tbody>
                        @foreach( $cnc as $c )
                            @php
                                
                                $situacao="";
                                $operacao = 'X';
                                $classe='';
                                if( $c->FIN_CNC_OPERACAO == 'D' )
                                {
                                    $operacao='Débito';
                                    $classe="debito";
                                }
                                if( $c->FIN_CNC_OPERACAO == 'C' )
                                {
                                    $operacao='Crédito';
                                    $classe="credito";
                                }
                                if( intval($c->FIN_LCX_ID) > 0)
                                {
                                    $classe="conciliado";
                                    $situacao='conciliado';
                                }

                            @endphp
                            <tr>
                                <td class="div-center">@if(  $classe =="conciliado" ) <i title="Lançamento Conciliado" class="fa fa-check-square-o" aria-hidden="true" style="color:green" ></i>@endif</td>
                                <td class="div-center">@if(  $classe <> "conciliado" ) 
                                                        <a title="Conciliar este lançamento" href="javascript:conciliarLancamento( {{$c->FIN_CFC_UNIQUEID}},'{{$c->FIN_CNC_DATA}}')"> <i class="fa fa-thumbs-o-up" aria-hidden="true" style="color:black"></i></a>
                                                    @else 
                                                        <a title="Desconciliar este lançamento" href=""><i class="fa fa-undo" aria-hidden="true" style="color:red"></i></a> @endif</td>
                                <td class="div-center {{$classe}}">{{date('d/m/Y', strtotime($c->FIN_CNC_DATA))}}</td>
                                <td class="div-center {{$classe}}"><b>{{$operacao}}</b></td>
                                <td class="div-right {{$classe}}">{{number_format($c->FIN_CNC_VALOR,2,',','.')}}</td>
                                <td class="div-left {{$classe}}">{{$c->FIN_CNC_DESCRICAO}}</td>
                                <td class="div-left {{$classe}}">{{$c->CONCHOW}}</td>
                                                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@include('layout.modalconciliarlancarquivo')
@endsection

@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="{{asset('/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>


<script>

    $( document ).ready(function()
    {


        //cargaCarteira();
        $("#sirius-menu").click();
        $(".select2").select2({
                    placeholder: 'Selecione.....',
                    width: null
                });
            
    });

    function conciliarLancamento( idunique, data )
    {
        $("#modalconciliarlancfilebank").modal('show');
        $("#i-dataefetivacao").val( data );
        $("#i-select-forn-conc").val('-1');
    }


</script>

@endpush
