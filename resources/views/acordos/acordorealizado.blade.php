@extends('layout.app')
@section('scripttop')
<style>
.gi-2x{font-size: 2em;}
.gi-3x{font-size: 3em;}
.gi-4x{font-size: 4em;}
.gi-5x{font-size: 5em;}


table, th, td {
  border: .5px dotted;
  font-size: 80%;
}

input[type=text] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    /*border: 1px solid #555;*/
    outline: none;
}


input[type=text]:focus {
    background-color: lightblue;
    color:black;
}
.row-top-margin-normal {
    margin-bottom:-1px;
    margin-top:-1px;
}

.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
    position: relative;
    min-height: 1px;
    padding-right: 8px;
    padding-left: 8px;
}
.pad-left-zero
{
    position: relative;
    min-height: 1px;
    padding-right: 0px;
    padding-left: 0px;
}

.row-top-margin {
    background-color:antiquewhite;
    margin-bottom:-1px;
    margin-top:-1px;
}

.Receita
{
    color:blue;
}

.orange
{
    color:orange;
}

.bold
{
    font-weight: bold;
}

.Despesa
{
    color:red;
}
.inativado
{
    color: gray;
}

.escondido
{
    display:none;
}
.div-center {
    text-align: center;
  }

  .italic
{
    text-decoration: italic;
}
.font-10px
{
    font-size:10px;
}

.font-green
{
    color:green;
}
.font-blue
{
    color:blue;
}

.bg-direcionado
{
    background-color:beige;
}

.bg-white
{
    background-color: white;
}

.font-red-bold
{
    color: red;
    font-weight: bold;

}

.font-und-14px
{
    font-size:14px;
    color: grey;
    text-decoration: underline;
}
.font-red-bold-10px
{
    font-size:12px;
    color: red;
    font-weight: bold;

}
.bg-red-foreg-white
{
    background-color: red;
    color:white;
    font-size:14px;
    font-weight: bold;

}
.bg-blue-foreg-white
{
    background-color: blue;
    color:white;
    font-size:14px;
    font-weight: bold;
}
.bg-orange-foreg-black
{
    background-color: orange;
    color: black;
    font-size:14px;
    font-weight: bold;
}

.font-padrao
{
    font-size:12px;
}
.font-8
{
    font-size:8px;
}


.bg-peru-foreg-white
{
    background-color:peru;
    color:white;
    font-size:14px;
    font-weight: bold;

}

.bg-peru-green-white
{
    background-color:green;
    color:white;
    font-size:14px;
    font-weight: bold;

}

.bg-gray-fore-black
{
    background-color:darkorange;
    color:black;
    font-size:14px;
    font-weight: bold;

}

.font-10px-bold
{
    font-size:12px;
    color: #000099;
    font-weight: bold;

}
.font-10px
{
    font-size:12px;
    color: #000099;
}

h5 {
    text-align: center;
    color: #4682B4 ;
    font-size: 20px;
    font-weight: bold;
}

h1 {
    text-align: center;
    color: #4682B4 ;
    font-size: 20px;
    font-weight: bold;
}

.lbl-cliente {
  text-align: center;
  font-size: 14px;
  font-weight: bold;
  color: #4682B4;
}

.div-cor-fonte-white{
    color:white;
}
.div-cor-red {
  border-style: solid;
  border-color: red;
  color: white;
}

.div-cor-green {
    border-style: solid;
  border-color: green;
}

.div-cor-blue {
    background-color: blue;
    color: white;
}

.div-cor-white{
    border-style: solid;
  border-color: white;
}

td{text-align:center;}
th{text-align:center;}

.td-center{text-align:left;}

</style>

@endsection

@section('content')

@php
    $acordo = app( 'App\Http\Controllers\ctrAcordo')->acordoDados( $id);
    $contrato = app( 'App\Http\Controllers\ctrContrato')->pegaUm( $acordo->IMB_CTR_ID );
    $enderecoimovel = app('App\Http\Controllers\ctrRotinas')->imovelEndereco( $contrato->IMB_IMV_ID);
    $locadores = app( 'App\Http\Controllers\ctrPropImo')->cargaSemJson($contrato->IMB_IMV_ID);
    $locatarios = app( 'App\Http\Controllers\ctrLocatarioContrato')->carga($contrato->IMB_CTR_ID);
    $fiadores = app( 'App\Http\Controllers\ctrFiadorContrato')->carga($contrato->IMB_CTR_ID);
    $parcelas = app( 'App\Http\Controllers\ctrAcordo')->parcelasAcordo( $id);
    $origens = app( 'App\Http\Controllers\ctrAcordo')->origensAcordo( $id);

        
@endphp


<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
        
            <span class="caption-subject bold uppercase"> Acordos Realizados</span>
            <i class="fa fa-search font-blue"></i>
            <span id="i-totalizar"></span>
        </div>
        <div>
            <button class="btn btn-danger pull-right" type="button" id="btn-limpar"
            onClick="limparCampos()">Limpar Filtro</button>
        </div>

    </div>
    <div class="portlet-body form">
        <div class="col-md-12">
            <div class="col-md-1 row-top-margin-normal">
                <label class="label-control">Pasta</label>
                <input class="form-control" type="text" id="I-IMB_CTR_REFERENCIA-AC" value="{{$contrato->IMB_CTR_REFERENCIA}}" readonly>
                
            </div>
            <div class="col-md-1 row-top-margin-normal">
                <label class="label-control"># Imóvel</label>
                <input class="form-control" type="text" id="I-IMB_IMV_ID-AC" 
                    value="{{$contrato->IMB_IMV_ID}}" readonly>
                
            </div>

            <div class="col-md-4 row-top-margin-normal">
                <label class="label-control" for="i-data-inicio">Endereco </label>
                <input class="form-control" type="text" id="i-endereco-ac" 
                value="{{$enderecoimovel}}" readonly>

            </div>

            <div class="col-md-2 row-top-margin-normal">
                <label class="label-control">Inicio Contrato</label>
                <input class="form-control" type="text" id="IMB_CTR_INICIO-AC" 
                value="{{ date( 'd/m/Y', strtotime( $contrato->IMB_CTR_INICIO))}}" readonly>
                
            </div>
            <div class="col-md-2 row-top-margin-normal">
                <label class="label-control">Término Contrato</label>
                <input class="form-control" type="text" id="IMB_CTR_TERMINO-AC" 
                value="{{ date( 'd/m/Y', strtotime( $contrato->IMB_CTR_TERMINO))}}" readonly>
            </div>
            <div class="col-md-2 row-top-margin-normal">
                <label class="label-control">Data Locação</label>
                <input class="form-control" type="text" id="IMB_CTR_DATALOCACAO-AC" 
                value="{{ date( 'd/m/Y', strtotime( $contrato->IMB_CTR_DATALOCACAO))}}" readonly>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-4 bg-white">
                <div class="col-md-12 div-center">Locador(es)</div>
                <table class="table" id="i-locadores-ac">
                    @foreach( $locadores as $registro )
                    @php
                        $principal='';
                        if($registro->IMB_IMVCLT_PRINCIPAL == 'S')
                            $principal='Principal';
                    @endphp
                        <tr>
                            <td width="70%">{{$registro->IMB_CLT_NOME}}</td>
                            <td width="15%">{{$registro->IMB_IMVCLT_PERCENTUAL4}}%</td>
                            <td width="15%">{{$principal}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-md-4 bg-white">
                <div class="col-md-12 div-center">Locatário(s)</div>
                <table class="table" id="i-locatarios-ac">
                @foreach( $locatarios as $registro )
                    @php
                        $principal='';
                        if($registro->IMB_LCTCTR_PRINCIPAL == 'S')
                            $principal='Principal';
                    @endphp
                        <tr>
                            <td width="70%">{{$registro->IMB_CLT_NOME}}</td>
                            <td width="15%">{{number_format($registro->IMB_LCTCTR_PERCENTUAL4,2,',','.')}}%</td>
                            <td width="15%">{{$principal}}</td>
                        </tr>
                    @endforeach

                </table>

            </div>
            <div class="col-md-4 bg-white">
                <div class="col-md-12 div-center">Fiador(es)</div>
                <table class="table" id="i-fiadores-ac">
                @if( $fiadores <> '' )
                @foreach( $fiadores as $registro )
                    <tr>
                        <td width="100%">{{$registro->IMB_CLT_NOME}}</td>
                    </tr>
                @endforeach
                @endif
                </table>

            </div>            
        </div>
        <div class="col-md-12">
            <div class="col-md-7 row-top-margin-normal">
                <div class="col-md-3 div-center ">
                    <label class="control-label">Data do Acordo</label>
                    <input class=" div-center form-control" type="text" 
                    value="{{ date( 'd/m/Y', strtotime( $acordo->IMB_ACD_DATAACORDO))}}" readonly>
                </div>

                <div class="col-md-2 div-center ">
                    <label class="control-label">Valor do Acordo</label>
                    <input class=" div-center form-control" type="text" 
                    value="R$ {{number_format($acordo->IMB_ACD_VALOR,2,',','.')}}" readonly>
                </div>
                <div class="col-md-2 div-center ">
                    <label class="control-label">Parcelas</label>
                    <input class=" div-center form-control" type="text" 
                    value="{{$acordo->IMB_ACD_PARCELAS}}" readonly>
                </div>                
                <div class="col-md-2 div-center ">
                    <label class="control-label">$ Entrada</label>
                    <input class=" div-center form-control" type="text" 
                    value="R$ {{number_format($acordo->IMB_ACD_VALORENTRADA,2,',','.')}}" readonly>
                </div>
                <div class="col-md-3 div-center ">
                    <label class="control-label">Data Entrada</label>
                    <input class=" div-center form-control" type="text" 
                    value="{{ date( 'd/m/Y', strtotime( $acordo->IMB_ACD_DATAENTRADA))}}" readonly>
                </div>
                <div class="col-md-2">

                </div>
                <div class="col-md-12 div-center ">
                    <label class="control-label">Motivo</label>
                    <textarea class="form-control" cols="100%" rows="3" readonly>
                        {{$acordo->IMB_ACD_MOTIVOACORDO}}
                    </textarea>
                    
                    <div class="col-md-12 div-center"><u>Referente aos Lançamentos </u></div>
                <table class="table" id="i-fiadores-ac">

                @foreach( $origens as $registro )
                    <tr>
                        <td width="20%">{{app('App\Http\Controllers\ctrRotinas')->formatarData($registro->IMB_LCF_DATAVENCIMENTO)}}</td>
                        <td width="20%">{{$registro->IMB_LCF_VALOR}}</td>                    
                        <td width="60%">{{$registro->IMB_LCF_OBSERVACAO}}</td>                    
                    </tr>
                @endforeach

                </table>

    
                </div>
            </div>
            <div class="col-md-5 row-top-margin-normal">
                <div class="col-md-12 div-center"><u>Parcelas do Acordo </u></div>
                <table class="table" id="i-fiadores-ac">

                @foreach( $parcelas as $registro )
                    <tr>
                        <td width="20%">{{app('App\Http\Controllers\ctrRotinas')->formatarData($registro->IMB_LCF_DATAVENCIMENTO)}}</td>
                        <td width="20%">{{$registro->IMB_LCF_VALOR}}</td>                    
                        <td width="60%">{{$registro->IMB_LCF_OBSERVACAO}}</td>                    
                    </tr>
                @endforeach

                </table>
                </div>
            </div>

        </div>
        
            
    </div>
</div>


@endsection
@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>

<script type="text/javascript">

    $(document).ready(function()
    {
        $("#sirius-menu").click();
        $('.valor').inputmask('decimal',
        {
          radixPoint:",",
          groupSeparator: ".",
          autoGroup: true,
          digits: 2,
          digitsOptional: false,
          placeholder: '0',
          rightAlign: false,
          onBeforeMask: function (value, opts)
          {
            return value;
          }
        });


    });




</script>
@endpush
