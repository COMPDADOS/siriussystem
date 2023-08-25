@extends('layout.app')
@section('scriptop')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection
@section('scripttop')
<style>
.gi-2x{font-size: 2em;}
.gi-3x{font-size: 3em;}
.gi-4x{font-size: 4em;}
.gi-5x{font-size: 5em;}

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


.div-left
{
    text-align:left;
}

.div-right
{
    text-align:right;
}


.Receita
{
    color:blue;
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

.font-11
{
    font-weight: bold;
    font-size:11px;
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


<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{route('home')}}">home</a>
            <i class="fa fa-circle"></i>
        </li>
    </ul>
</div>


<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
        <span class="caption-subject bold uppercase"> Consolidado - <b><i></i> Analitico por Sub-Conta (Centro de Custos)</i></b></span>
            <i class="fa fa-search font-blue"></i>
            <span id="i-totalizar"></span>
        </div>
        <div>
            <button class="btn btn-danger pull-right" type="button" id="btn-limpar"
            onClick="limparCampos()">Limpar Filtro</button>
        </div>

    </div>
    <div class="portlet-body form">
            <input type="hidden" id="i-cfc-cons">
            <div class="col-md-12">
                <div class="col-md-2">
                    <div class="col-md-12">
                        <label class="label-control" for="i-data-inicio">Data Inicial
                        <input class="form-control" type="date" id="i-data-inicio-CONS" >
                        </label>
                    </div>
                    <div class="col-md-12">
                        <label class="label-control" for="i-data-fim">Data Final
                            <input class="form-control" type="date" id="i-data-fim-CONS">
                        </label>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="col-md-3">
                        <div class="col-md-12 div-center">
                            <label>Filtro(I)</label>
                            <select class="form-control" name="tipocompetencia" id="tipocompetencia">
                                <option value="E">Pela Data Efetivação</option>
                                <option value="C">Pela Data de Competência</option>
                            </select>
                        </div>
                        <div class="col-md-12 div-center">
                            <label>Filtro(II)</label>
                            <select class="form-control" name="tipocfc" id="tipocfc">
                                <option value="RC">Somente Contas de Receitas</option>
                                <option value="DP" selected>Somente Contas de Despesas</option>
                                <option value="RP">Receitas e Despesas</option>
                                <option value="TR">Somente Transitórias</option>
                                <option value="TD">Todas</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 div-center">
                        <div class="col-md-12 div-center">
                            <label class="control-label">Somente Conciliados</label>                        
                            <input class="form-control" type="checkbox" name="i-conciliados" id="i-conciliados" >
                        </div>


                        <div class="col-md-12">
                            <label class="label-control">Somente da Sub-Conta</label>
                            @php
                                $sbc = app('App\Http\Controllers\ctrSubConta')->carga();
                            @endphp
                            <select class="select2" id="FIN_SBC_ID-CONSO">
                                <option value="-1">Selecione</option>
                                @foreach( $sbc as $sc)
                                    <option value="{{$sc->FIN_SBC_ID}}">{{$sc->FIN_SBC_DESCRICAO}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 div-center">
                        <div class="form-actions noborder">
                            <button class="btn blue pull-right" onClick="relatorio()">Processar</button>
                        </div>
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
        $(".select2").select2(
            {
                placeholder: 'Selecione ',
                width: null
        });
        
        $( "#i-data-inicio-CONS").val( moment().format('YYYY-MM-DD'));
        $( "#i-data-fim-CONS").val( moment().format('YYYY-MM-DD'));


    });



    $( document ).ready(function() 
    {    
    });

    function limparCampos()
    {
        $('#FIN_SBC_ID-CONSO').select2().select2('val', ['-1']);

    }

    function relatorio()
    {
        var sbc = $("#FIN_SBC_ID-CONSO").val();
        var datini = $("#i-data-inicio-CONS").val();
        var datfim = $("#i-data-fim-CONS").val();
        var url = "{{route('caixa.relanaliticosubconta')}}?sbc="+sbc+'&datini='+datini+'&datfim='+datfim+"&tipo="+$("#tipocfc").val();
        window.open( url,'_blank');
        
    }




</script>
@endpush
