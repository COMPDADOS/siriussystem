@extends('layout.app')
@section('scripttop')
<script src="https://cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
<style>

/*.table tbody tr:hover td, .table tbody tr:hover th {
    background-color: #eeeeea;
}
*/

/* Rounded pill classes for horizontal sides */
.rounded-pill-left {
  border-top-left-radius: 5rem !important;
  border-bottom-left-radius: 5rem !important;
  border-color:darkgray;
}
.rounded-pill-right {
  border-top-right-radius: 10rem !important;
  border-bottom-right-radius: 10rem !important;
  border-color:darkgray;
}

/* Another classes to use */
.rounded-t-l-0 {
  border-top-left-radius: 0 !important;
}
.rounded-t-r-0 {
  border-top-right-radius: 0 !important;
}
.rounded-b-l-0 {
  border-bottom-left-radius: 0 !important;
}
.rounded-b-r-0 {
  border-bottom-right-radius: 0 !important;
}
.rounded-x-l-0 {
  border-top-left-radius: 0 !important;
  border-bottom-left-radius: 0 !important;
}
.rounded-x-r-0 {
  border-top-right-radius: 0 !important;
  border-bottom-right-radius: 0 !important;
}

label {
  margin-bottom: 0px;
}

.form-control {
  -webkit-border-radius: 50px;
  -moz-border-radius: 50px;

  border-radius: 50px;
}
.for{
	position: absolute;
	right: 0px;
    top: 25px;
	font-size: 13px;
	line-height: 23px;
	color: #ffffff;
	font-weight: 700;
	background-color: rgb(255, 204, 204);
	padding: 0 80px;
	text-align: left;
	z-index: 9;
	-webkit-transform: rotate(10deg);
	-moz-transform: rotate(10deg);
	-ms-transform: rotate(10deg);
	-o-transform: rotate(10deg);
	transform: rotate(10deg);
	-webkit-transition: all 300ms ease;
	-moz-transition: all 300ms ease;
	-ms-transition: all 300ms ease;
	-o-transition: all 300ms ease;
	transition : all 300ms ease;
}

div.outset 
{
    border-style: groove;
}

label
    {
        font-weight: bold;        
    }
 .dark {
      background-color: #383838;
    }

    /* Centralização do conteúdo */
    .center {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

input[type="checkboxa"] {
      position: relative;
      width: 40px;
      height: 15px;
      -webkit-appearance: none; /* Aparência padrão do checkbox é anulada */
      background-color: red; /* cor de fundo */
      outline: none; /* sem borda externa */
      border-radius: 30%; /* arrendodamento dos cantos */
      box-shadow: inset 0 0 5px rgba(95, 85, 85, 0.2); /* sombra interna */
      transition: .2s; /* tempo de transição que vai ocorrer com a cor de fundo e com a posção da bolinha*/
      cursor: pointer;/* estabelecer que o mouse vai ter uma aparência como se fosse clicar em um botão */
    }

    input:checked[type="checkboxa"] {
      background-color: #00b33c;/* cor de fundo que vai ser aplicada quando o checkbox tiver uma alteração para checked */
    }
/* O seletor :before pode criar objetos antes do elemento principal, no caso cria a bolinha do botão  */
    input[type="checkboxa"]:before {
      content: '';
      position: absolute;
      width: 15px;
      height: 15px;
      border-radius: 50%;
      top: 0;
      left: 0;
      background: #ffffff;
      transform: scale(1.2);
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      transition: .2s;
    }

    input:checked[type="checkbox"]:before {
      left: 40px;
    }    


    .p-menor { margin-bottom:-15px;margin-top:-10px; }
.row-bottom-margin { margin-bottom:-10px;margin-top:-10px; }
.row-top-margin { margin-bottom:-5px;margin-top:-5px; }

.borda-1
{
    border: 1px solid;
}

th, td{
    vertical-align: middle !important; /* alinha verticalmente */
    height: 36px; /* altura customizada da celula */
    padding: 0 16px !important; /* 0 de padding na vertical e 16px na horizontal */
}

.td-d {
    padding-top: 0;
}

.liberado
{
    background-color:green;
    color:white;
}
.rejeitado
{
    color:red;
    text-decoration-line: italic;
}
.div-center
{
  text-align:center;
  font-size: 12px;

}
.email-center
{
  text-align:center;
  font-size: 14px;
  color:blue;
  text-decoration-line: underline;
}

.bg-botoes
{
    background-color:bisque;
}
.div-right
{
    text-align:right;
}

.div-left
{
    text-align:left;
}
.Cancelado
{
    text-decoration-line: line-through;;
}

.Aberto
{
    color:white;
    background-color:red;
}

.Quitado
{
  color:blue;
}

.emdia
{
  color:green;
  font-weight: bold;

}


.r-50
{
    height:"50%";
}

.font-red
{
    color:red;
    font-weight: bold;
}

.cor-fundo-pesquisa
{
    background-color:#e9ebf0;
}



.black-14-bold-underline
{
    color:black;
    font-size:14px;
    font-weight: bold;
    text-decoration-line: underline;
}

.black-14-bold
{
    color:black;
    font-size:14px;
    font-weight: bold;
}
.black-12-bold
{
    color:black;
    font-size:14px;
    background-color:white;
    font-weight: bold;

}

.blue-12-bold
{
    color:blue;
    font-size:14px;
    font-weight: bold;

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

.cardtitulo-font-med {
  text-align: left;
  font-size: 12px;
  color: #4682B4;
  font-weight: bold;

}

.lbl-medidas-left {
  text-align: left;
  font-size: 16px;
  font-weight: bold;

}
.lbl-medidas-center {
  text-align: left;
  font-size: 16px;
  font-weight: bold;

}

hr {
    height: 2px;
}


.atrasado
{
    color:white;
    background-color:red;
    font-weight: bold;

}

H-LEFT {
    text-align: left;
    color: #4682B4 ;
    font-size: 16px;
    font-weight: bold;

}


h5 {
    text-align: center;
}

H5 {
    text-align: center;
    color: #4682B4 ;
    font-size: 20px;
    font-weight: bold;

}

.font-12-white-blue
{
    font-size:10px;
    color:white;
    background-color:green;
    font-weight: bold;

}

h4 {
  text-align: center;
}

h4-center-17 {
  text-align: center;
  font-size: 17px;
}
</style>
@endsection

@section('content')
<div class="page-bar">
    <div class="col-md-10">
        <ul class="page-breadcrumb">
        <li>
                <a href="{{route('reajustar.index')}}" title="Reajustar Aluguéres"><img src="{{asset('/global/img/reajuste.jpg')}}" alt=""></a>

            </li>
            <li>
                <a href="{{route('seguroincendio.index')}}" title="Vencimento de Seguros Incêndio"><i class="fas fa-fire-extinguisher" style="font-size:50px;color:red"></i></a>

            </li>
            <li>
                <a href="{{route('caucao.index')}}" title="Consultar Depósitos Caução"><i class="fas fa-piggy-bank" style="font-size:50px;color:green"></i></a>

            </li>
            <li>
                <a href="{{route('segurofianca.index')}}" title="Consultar Seguros Fiança"><i class="fas fa-shield-alt" style="font-size:50px;color:black"></i></a>

            </li>
            <li>
                <a href="{{route('avisodesocupacao')}}" title="Avisos de Desocupacao"><img src="{{asset('/global/img/avisodesocupacao_50.png')}}" alt=""></a>
            </li>
        </ul>
    </div>
    <div class="col-md-2 div-center">
        <button class="btn btn-danger pull-right form-control" type="button" id="btn-limpar"
        onClick="limparCampos()">Limpar Filtro</button>

        @php  
            $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Contratos', 'Contratos', 'ADM', 'Contratos','S', 'I', 'Botão');
            $param2 = app( 'App\Http\Controllers\ctrRotinas')->parametros2( Auth::user()->IMB_IMB_ID);
            $acessorelcontrato = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'RelatórioGeralContratos', 'Relatório Geral Contratos Aluguéres', 'ADM', 'Contratos','S', 'X', 'Botão');
        @endphp
        <div class="{{$acesso}}">
            <form action="{{route( 'imovel.index' )}}" method="get">
                <button type="submit" class="btn green pull-right form-control" type="button">Novo Contrato</button>
            </form>
        </div>

    </div>
</div>
<div class="portlet light bordered">
    <div class="portlet-body form">

        <form role="form" id="search-form">
        <!--<form role="form" action="{{ route('contrato.list')}}" method="get">-->
            <input type="hidden" id="IMB_IMB_IDMASTER" name="empresamaster" value="{{ Auth::User()->IMB_IMB_ID }}">
            <input type="hidden" id="i-idtbesemseg" value="{{$param2->IMB_TBE_IDSEGINC}}">
            <input type="hidden" id="i-textsemseguro">
            <div class="form-body cor-fundo-pesquisa">
                <input type="hidden" id="i-unidade" name="agencia">

                <div class="row">
                    <div class="col-md-3 row-top-margin">
                        <div class="form-group">
                            <label for="js-select-unidade" >Unidade</label>
                            <select class="form-control border rounded-pill-left rounded-pill-right " id="js-select-unidade">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1 row-top-margin">
                        <div class="form-group">
                            <label for="referencia" >Pasta</label>
                            <input type="text" class="form-control  border rounded-pill-left rounded-pill-right " name="referencia"
                            id="i-referencia">
                        </div>
                    </div>
                    <div class="col-md-1 row-top-margin">
                        <div class="form-group">
                            <label for="id_completus">Código Imóvel</label>
                            <input type="text" class="form-control border rounded-pill-left rounded-pill-right " name="id_completus" id="i-idcompletus">
                        </div>
                    </div>
                    <div class="col-md-1 row-top-margin">
                        <div class="form-group">
                            <label for="id_completus">Dia Vencto.</label>
                            <input type="number" class="form-control border rounded-pill-left rounded-pill-right "  id="i-diavencimento" max="31" min="1" value="">
                        </div>
                    </div>

                    <div class="col-md-5 row-top-margin">
                        <div class="form-group">
                            <label  for="endereco">Endereco</label>
                            <input type="text" class="form-control border rounded-pill-left rounded-pill-right " name="endereco"
                            placeholder="Sugestão: coloque parte do endereço" id="i-endereco">
                        </div>
                    </div>
                    <div class="col-md-1 div-center row-top-margin">
                        <div class="form-group div-center" >
                            <label >S/ Seguro Incêndio
                            <input title="Sem seguro lançado para o próximo vencimento" class="form-control border rounded-pill-left rounded-pill-right " type="checkbox" id="i-semseguro">
                                </label>
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-3 row-top-margin">
                        <div class="form-group">
                            <label  for="condominio">Condomínio</label>
                            <input type="text" class="form-control border rounded-pill-left rounded-pill-right " name="condominio" id="i-condominio"
                            placeholder="Sugestão:  parte do nome">
                        </div>
                    </div>

                    <div class="col-md-3 row-top-margin">
                        <div class="form-group">
                            <label for="cidade">Cidade</label>
                            <input type="text" class="form-control border rounded-pill-left rounded-pill-right "
                            name="cidade" id="i-cidade" placeholder="Sugestão: parte do nome">
                        </div>
                    </div>

                    <div class="col-md-3 row-top-margin">
                        <div class="form-group">
                            <label for="bairro">Bairro</label>
                            <input type="text" class="form-control border rounded-pill-left rounded-pill-right " name="bairro"
                            id="i-bairro" placeholder="Sugestão: parte do nome">
                        </div>
                    </div>

                    <div class="col-md-3 row-top-margin">
                        <div class="form-group">
                            <label for="i-select-situacao">Situação</label>
                                <input type="hidden" name="situacao" id="i-situacao">
                                <select class="form-control border rounded-pill-left rounded-pill-right " id="i-select-situacao">
                                    <option value="T" >Todos</option>
                                    <option value="A" selected >Ativos</option>
                                    <option value="E" >Encerrados</option>
                                </select>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-3 row-top-margin">
                        <div class="form-group">
                            <label for="proprietario">Proprietário</label>
                            <input type="text" class="form-control border rounded-pill-left rounded-pill-right "
                            name="proprietario" id="i-proprietario"
                            placeholder="Sugestão: parte do nome proprietário">
                        </div>
                    </div>
                    <div class="col-md-3 row-top-margin">
                        <div class="form-group">
                            <label for="locatario">Locatário</label>
                            <input type="text" class="form-control border rounded-pill-left rounded-pill-right "
                            name="locatario" id="i-locatario"
                            placeholder="Sugestão: parte do nome locatário">
                        </div>
                    </div>
                    <div class="col-md-2 row-top-margin">
                        <div class="form-group">
                            <label for="fiador">Fiador</label>
                            <input type="text" class="form-control border rounded-pill-left rounded-pill-right "
                            name="fiador" id="i-fiador"

                            placeholder="Sugestão: parte do nome fiador">
                        </div>
                    </div>
                    <div class="col-md-1 div-center row-top-margin">
                        <div class="form-group div-center" >
                            <label >Somente Jurídico
                            <input class="form-control border rounded-pill-left rounded-pill-right " type="checkbox" id="IMB_CTR_ADVOGADO"
                                name="IMB_CTR_ADVOGADO " >
                                </label>
                        </div>
                    </div>
                    <div class="col-md-1 div-center row-top-margin">
                        <div class="form-group div-center" >
                            <label >Exceto Jurídico
                            <input class="form-control border rounded-pill-left rounded-pill-right " type="checkbox" id="IMB_CTR_ADVOGADOEXCETO"
                                name="IMB_CTR_ADVOGADOEXCETO" >
                                </label>
                        </div>
                    </div>

                    <div class="col-md-1 div-center row-top-margin">
                        <div class="form-actions noborder">
                        <button class="btn blue pull-right" id='search-form'>Pesquisar</button>
                        </div>
                    </div>
                    <div class="col-md-1 div-center row-top-margin">
                        <div class="form-actions noborder {{$acessorelcontrato}}">
                            <a class="btn btn-seconday" href="javascript:imprimirVisao();"><i class="fa fa-print fa-2x" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-md-12">
                <table class="table stripe table-hover"  id="resultTable">
                    <thead style="display: none;">
                        <th><input type="checkbox" name="select_all" value="1" id="example-select-all"></th>
                        <th class="text-left" ></th>
                        <th width="100" class="text-right" >Ações</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('layout.modalsolicitacao')

@include('layout.modalextratolocatario')
@include('layout.modalacordoscontrato')
@include('layout.modalrescisao')
@include('layout.modaldocautomaticos')
@include('layout.modalboletoscontrato')
@include('layout.modalauditoria')
@include('layout.modalalteracaovencimento')
@include('layout.modaltelefonesenvolvidos')
@include('layout.modalavisodesocupacao')
@include('layout.modalemail')
@include('layout.modalSolicitacaoEventosContrato')
@include('layout.modalEnderecoCobranca')
@include('layout.modalanexos')

<form style="display: none" action="{{route('contrato.novo')}}" method="POST" id="form-novocontrato" target="_blank">
@csrf
    <input type="hidden" id="idimovelcontrato" name="idimovel" />
</form>

<form style="display: none" action="{{route('lancamento.index')}}" method="GET" id="form-lancamentos"target="_blank">
    <input type="hidden" id="i-idcontratopesquisa" name="IMB_CTR_ID" />
</form>

<form style="display: none" action="{{route('contrato.edit')}}" method="POST" id="form-alterarcontrato"target="_blank">
@csrf
    <input type="hidden" id="i-idcontrato-alt" name="IMB_CTR_ID" />
</form>

<form style="display: none" action="{{route('recebimento')}}" method="POST" id="form-receber"target="_blank">
@csrf
    <input type="hidden" id="i-idcontrato-receber" name="IMB_CTR_ID" />
</form>

<form style="display: none" action="{{route('repasse')}}" method="POST" id="form-repassar"target="_blank">
    @csrf
    <input type="hidden" id="i-idcontrato-repassar" name="IMB_CTR_ID" />
</form>

<form style="display: none" action="{{route('imovel.edit')}}" method="POST" id="form-alt-imovel"  target="_blank">
@csrf
    <input type="hidden" id="id-imovel" name="id" />
    <input type="hidden" id="readonly" name="readonly"/>
</form>

<form style="display: none" action="{{route('cliente.edit')}}" method="POST" id="form-alt-cliente-indexctr"  target="_blank">
@csrf
    <input type="hidden" id="id-cliente" name="id" />
    <input type="hidden" id="readonly" name="readonly" value="readonly"/>
</form>


@endsection
@push('script')
<script>
$(document).ready(function()
{
        //$('#js-select-unidade').select2();
    //});
//    document.getElementById("myText").disabled = true;
    $( "#js-select-unidade" ).change(function() {
        var nUnidade = $('#js-select-unidade').val();
        $("#i-unidade").val( nUnidade);
    });

    $("#i-semseguro").change( function()
    {
        if( $("#i-semseguro").prop('checked') == true )
        {
            if( $("#i-idtbesemseg").val() == '' )
            {
                alert('Você precisa definir qual o código do evento do seguro incêndio em parametrização!');
                $("#i-semseguro").prop( 'checked', false);
                return false;
            }
            $("#i-textsemseguro").val( 'S' )
        }
        else
            $("#i-textsemseguro").val( 'N' );

    })
    $( "#i-select-tipo" ).change(function() {
        var nTipo = $('#i-select-tipo').val();
        $("#i-tipo").val( nTipo);
    });

    $("#i-situacao").val( 'A' );
    $("#sirius-menu").click();
    CKEDITOR.replace( 'editorMesclado',
                {
                    height: 400,
                    baseFloatZIndex: 10005,
                    removeButtons: 'PasteFromWord'
                });



});

</script>
<script type="text/javascript">
    var table = $('#resultTable').DataTable({
        "language":
        {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            sLoadingRecords: '<div class="overlay"><img src="{{asset('/layouts/layout/img/loader.gif')}}"/></div>',
            sProcessing: '<div class="overlay"><img src="{{asset('/layouts/layout/img/loader.gif')}}"/></div>',
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        },
        processing: true,
        serverSide: true,
        ajax: {
            url:"{{ route('contrato.list') }}",
            data: function (d) {
                d.id_completus = $('input[name=id_completus]').val();
                d.referencia = $('input[name=referencia]').val();
                d.endereco = $('input[name=endereco]').val();
                d.bairro = $('input[name=bairro]').val();
                d.condominio = $('input[name=condominio]').val();
                d.cidade = $('input[name=cidade]').val();
                d.proprietario = $('input[name=proprietario]').val();
                d.agencia = $('input[name=agencia]').val();
                d.situacao = $('input[name=situacao]').val();
                d.locatario = $('input[name=locatario]').val();
                d.advogado = $('input[name=IMB_CTR_ADVOGADO]').val();
                d.advogadoexceto = $('input[name=IMB_CTR_ADVOGADOEXCETO]').val();
                d.fiador = $('input[name=fiador]').val();
                d.empresamaster = $('input[name=empresamaster]').val();
                d.diavencimento = $("#i-diavencimento").val();
                d.semseguro = $("#i-textsemseguro").val();
                
            }
        },
        columns: [
                {  "data": 'ENDERECOCOMPLETO', render: getInformacoes  },
            ],

        searching: false
    });



    $("#i-select-situacao").change( function(){
        var situacao =  $("#i-select-situacao").val();
        $("#i-situacao").val( situacao );
    });
    $('#search-form').on('submit', function(e) {

            $("#i-semseguro").val(  $("#i-semseguro").prop( "checked" )   ? 'S' : 'N');            
            $("#IMB_CTR_ADVOGADO").val(  $("#IMB_CTR_ADVOGADO").prop( "checked" )   ? 'S' : 'N');
            $("#IMB_CTR_ADVOGADOEXCETO").val(  $("#IMB_CTR_ADVOGADOEXCETO").prop( "checked" )   ? 'S' : 'N');
            table.draw();
            e.preventDefault();
        });

        $('#resultTable tbody').on( 'click', '.show-imv', function () {
            var data = table.row( $(this).parents('tr') ).data();
            window.location = "{{ route('imovel.form') }}/" + data.IMB_IMV_ID;
        });



        $('#resultTable tbody').on( 'click', '.show-lf', function () {
            var data = table.row( $(this).parents('tr') ).data();
            $("#i-idcontratopesquisa").val( data.IMB_CTR_ID );
            $("#form-lancamentos").submit();
        });


        function preencherUnidades()
        {

            $.getJSON( "{{route('imobiliaria.carga')}}/"+$("#IMB_IMB_IDMASTER").val(), function( data )
            {

                $("#js-select-unidade").empty();

                linha =  '<option value="0">Todas Unidades</option>';
                $("#js-select-unidade").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].IMB_IMB_ID+'">'+
                        data[nI].IMB_IMB_NOME+"</option>";
                        $("#js-select-unidade").append( linha );

                }

            });

        }


        function limparCampos( )
        {
            $("#js-select-unidade").val('');
            $("#i-referencia").val('');
            $("#i-idcompletus").val('');
            $("#i-endereco").val('');
            $("#i-condominio").val('');
            $("#i-cidade").val('');            
            $("#i-bairro").val('');
            $("#i-select-situacao").val('');
            $("#i-proprietario").val('');
            $("#i-locatario").val('');
            $("#i-fiador").val('');                 
/*

            document.getElementById( 'i-chk-site').checked = false;;
            document.getElementById( 'i-chk-piscina').checked = false;;
            document.getElementById( 'i-chk-churrasqueira').checked = false;;
            document.getElementById( 'i-chk-placa').checked = false;;
            document.getElementById( 'i-chk-condominio').checked = false;;
            document.getElementById( 'i-chk-financiamento').checked = false;;
            document.getElementById( 'i-chk-permuta').checked = false;;

            preencherUnidades();
            preencherTipoImovel();
            preencherFinalidade();
            preencherCorretor();
            preencherStatus();

            $("#i-idcompletus").val('');
            $("#i-referencia").val('');
            $("#i-faixainicial").val('');
            $("#i-faixafinal").val('');
            $("#i-endereco").val('');
            $("#i-condominio").val('');
            $("#i-bairro").val('');
            $("#i-cidade").val('');
            $("#i-dormitorio").val('');
            $("#i-suite").val('');
            $("#i-proprietario").val('');
            $("#i-cadastrado-ini").val('');
            $("#i-cadastrado-fim").val('');
            $("#i-atualizado-ini").val('');
            $("#i-atualizado-fim").val('');

*/
        }

        function getInformacoes(data, type, full, meta)
        {
            var condominio = '';
            var bairro = '';
            var texto = '';




            var obsparcela = full.PROXIMORECEBIMENTO;
            if( obsparcela === null)
                obsparcela = '<i>(Sem Parc)</i>'
            else
                obsparcela='';
            proximorecebimento = moment(full.IMB_CTR_VENCIMENTOLOCATARIO).format('DD/MM/YYYY');
            var str = proximorecebimento;
            var dateproxre = new Date(str.split('/').reverse().join('/'));
            var datahoje = new Date();
            var classeatrasa = 'emdia';
            if( datahoje > dateproxre )  classeatrasa = 'atrasado';

            var obsparcela = full.PROXIMOREPASSE;
            if( obsparcela === null)
                obsparcela = '<i>(Sem Parc)</i>'
            else
                obsparcela='';

                proximorepasse = moment(full.IMB_CTR_VENCIMENTOLOCADOR).format('DD/MM/YYYY');
            var str = proximorepasse;
            var dateproxre = new Date(str.split('/').reverse().join('/'));
            var datahoje = new Date();
            var classeatrasarep = 'emdia';
            if( datahoje > dateproxre )  classeatrasarep = 'atrasado';

            datareajuste = moment(full.IMB_CTR_DATAREAJUSTE).format('DD/MM/YYYY');
            var str = datareajuste;
            var dateproxreajuste = new Date(str.split('/').reverse().join('/'));
            var datahoje = new Date();
            var classeatrasareajuste = 'emdia';
            if( datahoje > dateproxreajuste )  classeatrasareajuste = 'atrasado';

            var juridico='';
            if( full.IMB_CTR_ADVOGADO == 'S')
                juridico = '  <span class="atrasado"> ***JURÍDICO***</span>';

//            juridico='**'+full.IMB_CTR_ADVOGADO+'**';

            var obslt = full.IMB_CTR_OBSERVACAOLOCATARIO;
            if( obslt === null)
                obslt='';

            var obsld = full.IMB_CTR_OBSERVACAOLOCADOR;
            if( obsld === null )
                obsld='';

            var obsimv = full.IMB_CTR_OBSERVACAO;
            if(  obsimv === null )
                obsimv='';


            condominio = '';
            bairro='';
            if ( full.CONDOMINIO != null )
                condominio = 'Condomínio: <b>'+full.CONDOMINIO+',  </b>';
            if ( full.CEP_BAI_NOME != null )
                bairro = '<b>'+full.CEP_BAI_NOME+'</b>';

            var pasta = full.IMB_CTR_REFERENCIA;
           
            if( pasta === null || pasta=='')  
                pasta = "# Imóvel: "+full.IMB_IMV_ID 
            else
                pasta = "# Imóvel: "+full.IMB_IMV_ID + ' Pasta: '+pasta;

            var nomepredio = full.IMB_IMV_PREDIO;
            if( nomepredio === null || nomepredio=='')  
                nomepredio =''
            else
                nomepredio ='('+nomepredio+')';

            var bonificacaovalor = full.IMB_CTR_VALORBONIFICACAO4;
            var bonificacaotipo = full.IMB_CTR_BONIFICACAOTIPO;
            var textobonificacao='';
            if( bonificacaovalor > 0)
            {
                if( bonificacaotipo =='P')
                {
                    bonificacaovalor = full.IMB_CTR_VALORALUGUEL - (full.IMB_CTR_VALORALUGUEL * bonificacaovalor / 100);
                }
                textobonificacao = 'Até o Vencto:R$ '+formatarBRSemSimbolo(parseFloat(bonificacaovalor));

            }
            var taxaadministrativa = full.IMB_CTR_TAXAADMINISTRATIVA
            if( full.IMB_CTR_TAXAADMINISTRATIVAFORMA == 'P')
                taxaadministrativa = taxaadministrativa+'%'
            else
                taxaadministrativa = 'R$ '+formatarBRSemSimbolo( parseFloat(taxaadministrativa));

            if( full.IMB_CTR_ALUGUELGARANTIDO == 'S')
                taxaadministrativa = taxaadministrativa+'-Garantido';

            var classstatus='emdia';
            var encerramento='';
            if( full.IMB_CTR_SITUACAO == 'ENCERRADO')
            {
                classstatus = 'atrasado';
                encerramento = moment( full.IMB_CTR_DATARESCISAO).format('DD/MM/YYYY');
            }
            texto = texto + '<div class="row outset"><div class="col-md-12">';

            var avisoDesocupacao=moment(full.IMB_AVD_DATAPREVISAO).format('DD/MM/YYYY');
                if( avisoDesocupacao == 'Invalid date' )
                   avisoDesocupacao = ''
                else
                    avisoDesocupacao = '<span class="for"><a href="javascript:avisoDesocupacao('+full.IMB_CTR_ID+')">Aviso desocupação p/ '+avisoDesocupacao+'</span></a>';

            labelencerrado = '';
            if( full.IMB_CTR_DATARESCISAO != null )
            labelencerrado = '<span class="font-red">** Encerrado em: '+moment(full.IMB_CTR_DATARESCISAO).format('DD/MM/YYYY')+' **</span>';

            texto = texto +

                '<div class="row p-5 ">'+ avisoDesocupacao+
                '   <div class="col-md-1 ">'+
                '           <b> <a title="Mostrar mais informações de '+pasta+'" href="javascript:mostrarDiv('+full.IMB_CTR_ID+','+full.IMB_IMV_ID+
                    ')"><i class="fa fa-plus-circle black-14-bold" aria-hidden="true"></i></a></b>'+
                '   </div> '+
                '   <div class="col-md-2 cardtitulo">'+
                '           <label>'+pasta+'</label>'+
                '   </div> '+
                '   <div class="col-md-2 cardtitulo div-center">'+
                '           <label title="Encerrado em '+encerramento+'"class="'+classstatus+'"></label>'+ligaDesligaSituacao(full)+
                '   </div> '+
                '   <div class="col-md-5 cardtitulo">'+
                '           <a href="javascript:alterarImovel('+full.IMB_IMV_ID+')"<label class="black-14-bold-underline"><b>'+full.ENDERECOCOMPLETO+'('+full.IMB_IMV_ID+')</b></label></a>'+
                '   </div> '+
                '   <div class="col-md-2 cardtitulo div-center">'+
                '           <label><b>R$ '+formatarBRSemSimbolo( parseFloat(full.IMB_CTR_VALORALUGUEL))+'<br><span class="font-12-white-blue">'+
                textobonificacao+'</span></b></label>'+
                '   </div> '+
                '</div>';

            texto = texto +
                '<div class="row  p-5"  >'+
                '   <div class="col-md-5 cardtitulo row-top-margin ">'+
                '       <div class="form-group">'+
                '           <a href="javascript:alterarClienteIndexCtr('+full.IMB_CLT_IDLOCADOR+')"<label>Locador: <b>'+full.PROPRIETARIO+'('+taxaadministrativa+')</b></label></a>'+
                '        </div> '+
                '   </div> '+
                '   <div class="col-md-5 cardtitulo row-top-margin">'+
                '       <div class="form-group">'+
                '           <a href="javascript:alterarClienteIndexCtr('+full.IMB_CLT_IDLOCATARIO+')"<label>Locatário: '+full.IMB_CLT_NOMELOCATARIO+juridico+'</label></a> ('+nomepredio+')'+
                '        </div> '+
                '   </div> '+
                '   <div class="col-md-2  row-top-margin">'+
                '       <div class="form-group">'+labelencerrado+'</label>'+
                '        </div> '+
                '   </div> '+
                '</div>';

            //DIV DOS DADOS DO CONTRATO
            texto = texto +
            '<div class="divdados escondido " id = "i-div-'+full.IMB_CTR_ID+'">';
            
                texto = texto +
                '<div class="row  p-5 bg-info text-white" >'+
                '   <div class="col-md-6 cardtitulo row-top-margin bg-info text-white">'+
                '       <div class="form-group">'+
                '           <label>Contrato: <b>'+moment(full.IMB_CTR_INICIO).format('DD/MM/YYYY')+
                                                ' a '+moment(full.IMB_CTR_TERMINO).format('DD/MM/YYYY')+', '+
                                                '<span class="'+classeatrasareajuste+'">reajustar em '
                                                +moment(full.IMB_CTR_DATAREAJUSTE).format('DD/MM/YYYY')+'</span></b></label>'+
                '        </div> '+
                '   </div> '+
                '   <div class="col-md-6 cardtitulo-font-med row-top-margin bg-info text-white">'+
                '       <div class="col-md-6 lbl-medidas-center bg-info text-white '+classeatrasa+'">'+
                '           <label  title="'+full.LANCTOLT+'">Próximo Recto <b>'+proximorecebimento+'</b></label>'+
                '        </div> ';

                if( full.IMB_CTR_REPASSEDIAFIXO === null || full.IMB_CTR_REPASSEDIAFIXO  == 0 )
                    texto = texto +                 
                    '       <div class="col-md-6 lbl-medidas-center bg-info text-white'+classeatrasarep+'">'+
                    '           <label  title="'+full.LANCTOLD+'">Próximo Repasse <b>'+proximorepasse+'</b></label>'
                else
                    texto = texto + '<div class="col-md-6 lbl-medidas-center bg-info text-white"><b>Contrato Repasse Dia fixo: '+full.IMB_CTR_REPASSEDIAFIXO+'  -  '+moment(full.IMB_CTR_PROXIMOREPASSE).format('DD/MM/YYYY')+"</b><div>";


                texto = texto +
                '        </div> '+
                '   </div> '+
                '</div>';

                texto = texto +
                '<div class="row  p-5 bg-info text-white">'+
                '   <div class="col-md-6 cardtitulo-font-med row-top-margin bg-info text-white">'+
                '       <div class="form-group">'+
                '           <label class="blue-12-bold bg-info text-white"><i>'+bairro+condominio+'</i></label>'+
                '        </div> '+
                '   </div> '+
                '   <div class="col-md-6 cardtitulo-font-med row-top-margin bg-info text-white">'+
                '       <div class="form-group"> '+
                '           <label class="black-12-bold bg-info text-white"></label>'+
                '        </div> '+
                '   </div> '+

                '</div>';

                iptu1 = full.IMB_IMV_IPTU1
                if( iptu1  === null )  iptu1='';
                iptu2 = full.IMB_IMV_IPTU2
                if( iptu2  === null )  iptu2='';
                iptu3 = full.IMB_IMV_IPTU3
                if( iptu3  === null )  iptu3='';
                iptu4 = full.IMB_IMV_IPTU4
                if( iptu4  === null )  iptu4='';
                iptu5 = full.IMB_IMV_IPTU5
                if( iptu5  === null )  iptu5='';
                iptu6 = full.IMB_IMV_IPTU6
                if( iptu6  === null )  iptu1='';


                iptu1ref = full.IMB_IMV_IPTU1REFERENTE
                if( iptu1ref  === null )  iptu1ref='';
                
                iptu2ref = full.IMB_IMV_IPTU2REFERENTE
                if( iptu2ref  === null )  iptu2ref='';
                
                iptu3ref = full.IMB_IMV_IPTU3REFERENTE
                if( iptu3ref  === null )  iptu3ref='';
                
                iptu4ref = full.IMB_IMV_IPTU4REFERENTE
                if( iptu4ref  === null )  iptu4ref='';
                
                iptu5ref = full.IMB_IMV_IPTU5REFERENTE
                if( iptu5ref  === null )  iptu5ref='';
                
                iptu6ref = full.IMB_IMV_IPTU6REFERENTE
                if( iptu6ref  === null )  iptu6ref='';
                

                inscdae = full.IMB_IMV_DAEINSCRICAO;                
                if( inscdae === null ) inscdae = '-';
                senhadae = full.IMB_IMV_DAESENHA;                
                if( senhadae === null ) senhadae = '-';
                inscenerg = full.IMB_IMV_CPFLINSCRICAO;                
                if( inscenerg === null ) inscenerg = '-';
                senhaenerg = full.IMB_IMV_CPFLSENHA;                
                if( senhaenerg === null ) senhaenerg = '-';

                var formarec = full.CONTARECEB;
                if( formarec == null ) 
                    formarec = ''
                else
                    formarec = '('+formarec+')';
                
                var valorcaucao = '';
                if( full.VALORCAUCAO != null)
                    valorcaucao = ' (Caucão de R$ '+dolarToReal(full.VALORCAUCAO )+')';

                var seguroincendio = '';
                if( full.SEGUROINCENDIO != null )
                    seguroincendio = ' **Vencimento Seguro Incêndio em: '+moment( full.SEGUROINCENDIO).format('DD/MM/YYYY')+'**';

                var formafianca = full.IMB_CTR_EXIGENCIA;
                if( formafianca == 'F' ) formafianca =  'Fiador';
                if( formafianca == 'C' ) formafianca =  'Caução';
                if( formafianca == 'S' ) formafianca =  'Seguro Fiança';
                if( formafianca == 'O' ) formafianca =  'Outra Forma';
                if( formafianca == 'D' ) formafianca =  'Dispensado';
                if( formafianca == 'V' ) formafianca =  'Cartão Crédido';
                if( formafianca == 'P' ) formafianca =  'Título Capitalização';
                texto = texto +
                '<div class="row bg-info text-white">'+
                '   <div class=" col-md-6 cardtitulo row-top-margin bg-info text-white">'+
             
                '           <label>Forma de Recebimento: <b>'+full.FORMAPAGLT+' ('+formarec+')</b></label>'+
      
                '   </div> '+
                '   <div class="  col-md-6 cardtitulo row-top-margin bg-info text-white">'+
             
                '           <label >Forma de Fiança: '+formafianca+valorcaucao+seguroincendio+'   </label>'+
      
                '   </div> '+

                '</div>';

                texto = texto + '<div class="row bg-info ">&nbsp;</div>';

                texto = texto +
                '<div class="row  p-5 bg-info text-white">'+
                '<div class="col-md-12">'+
                '   <div class="col-md-4 cardtitulo-font-med row-top-margin bg-info text-white">'+   
                '     <table  id="i-tbl-locador'+full.IMB_IMV_ID+'" class="table table-dark table-striped  table-hover sm" >'+
                
                '           <thead>'+
              //  '               <th width="50px" class="text-left" ></th>'+
                '               <th width="200px" class="text-center" >Locador(es)</th>'+
                '               <th width="50px" class="text-center" >Perc.</th>'+
                '               <th width="50px" class="text-center" >Principal</th>'+
                '           </thead> '+
                '       </table>'+
                '   </div>'+

                '   <div class="col-md-4 cardtitulo-font-med row-top-margin bg-info text-white">'+
                '     <table  id="i-tbl-locatario'+full.IMB_CTR_ID+'" class="ttable table-dark table-striped  table-hover " >'+
                '     <thead class="thead-dark">'+
                '        <tr >'+
     
                '          <th width="50%" style="text-align:center"> Locatário(s) </th>'+
                '          <th width="10%" style="text-align:center"> Principal </th>'+
                '          <th width="1%" style="display: none" > REG </th>'+
                          '        </tr>'+
                '      </thead>'+
                '      <tbody>'+
                '      </tbody>'+
                '     </table>'+
                '   </div>'+

                '   <div class="col-md-4 cardtitulo-font-med row-top-margin bg-info text-white">'+
                '     <table id="i-tbl-fiador'+full.IMB_CTR_ID+'" class="table table-dark table-striped  table-hover" >'+
             
        
                '      <thead class="thead-dark">'+
                '       <tr >'+
            
                '         <th width="100%" style="text-align:center"> Fiador(es)</th>'+
             
                '       </tr>'+
                '     </thead>'+
                '     <tbody>'+                
                '     </tbody>'+  
                '   </table>'+  
              
                '   </div>'+                                
                '</div>'+                                
                '</div>';

            texto = texto +
                ' <div class="row" style="display:none" id="i-div-dadosbancarios'+full.IMB_IMV_ID+'">'+
                 '   <div class="portlet box green">'+
                 '       <div class="portlet-title">'+
                 '           <div class="caption" id="i-nome-proprietario">'+
                '            <i class="fa fa-gift"></i>Dados para Repasse'+
                 '           </div>'+
                 '           <div class="tools">'+
                 '               <a href="javascript:;" class="collapse"> </a>'+
                 '           </div>'+
                 '       </div>'+
                        '<div class="portlet-body form">'+
                        '  <div class="form-body"> '+
                        '   <input type="hidden" id="IMB_PPI_ID"> '+
                        '   <input type="hidden" id="IMB_IMV_ID-REP"> '+
                        '   <input type="hidden" id="IMB_CLT_ID-REP"> '+
                        '   <div class="row"> '+
                        '     <div class="col-md-12"> '+
                        '       <div class="col-md-2"> '+
                        '         <label class="label-control">Part.%</label> '+
                        '         <input class="form-control valor-4 readonly-db" type="text" id="IMB_IMVCLT_PERCENTUAL4" > '+
                        '       </div> '+
                        '       <div class="col-md-4"> '+
                        '         <label class="label-control">Forma de Repasse</label> '+
                        '         <select select class="form-control readonly-db" id="IMB_FORPAG-IDLOCADOR"></select> '+
                        '       </div> '+
                        '       <div class="col-md-6"> '+
                        '         <label class="label-control">Cheque Nominal</label>'+
                        '         <input type="text" class="form-control readonly-db" id="IMB_IMV_CHEQUENOMINAL" maxlength="40">'+
                        '       </div>'+
                        '     </div>'+
                        '   </div>'+
                        '   <div class="row">'+
                        '     <div class="col-md-12">'+
                        '       <div class="col-md-4">'+
                        '         <label class="label-control">Banco</label>'+
                        '         <select select class="form-control readonly-db" id="GER_BNC_NUMERO-REP"></select>'+
                        '       </div>'+
                        '       <div class="col-md-2">'+
                        '         <label class="label-control">Agencia</label>'+
                        '         <input type="text" class="form-control readonly-db" id="GER_BNC_AGENCIA"'+
                        '         onkeypress="return isNumber(event)" onpaste="return false;">'+
                        '       </div>'+
                        '       <div class="col-md-1">'+
                        '         <label class="label-control">DV</label>'+
                        '         <input type="text" class="form-control readonly-db" id="IMB_BNC_AGENCIADV" maxlength="1">'+
                        '       </div>'+
                        '       <div class="col-md-1">'+
                        '       </div>'+
                        '       <div class="col-md-3">'+
                        '         <label class="label-control">Nº Conta</label>'+
                        '         <input type="text" class="form-control readonly-db" id="IMB_CLTCCR_NUMERO"'+
                        '         onkeypress="return isNumber(event)" onpaste="return false;">'+
                        '       </div>'+
                        '       <div class="col-md-1">'+
                        '         <label class="label-control">DV</label>'+
                        '         <input type="text" class="form-control readonly-db" id="IMB_CLTCCR_DV" maxlength="2">'+
                        '       </div>'+
                        '     </div>'+
                        '   </div>'+
                        '   <div class="row">'+
                        '     <div class="col-md-12">'+
                        '       <div class="col-md-3">'+
                        '         <label class="label-control">Pessoa</label>'+
                        '         <select select class="form-control readonly-db" id="IMB_CLTCCR_PESSOA">'+
                        '           <option value="F">Física</option>'+
                        '           <option value="J">Jurídica</option>'+
                        '         </select>'+
                        '       </div>'+
                        '       <div class="col-md-3">'+
                        '         <label class="label-control">CPF/CNPJ</label>'+
                        '         <input type="text" class="form-control readonly-db" id="IMB_CLTCCR_CPF"'+
                        '         onkeypress="return isNumber(event)" onpaste="return false;">'+
                        '       </div>'+
                        '       <div class="col-md-6">'+
                        '         <label class="label-control">Chave Pix</label>'+
                        '         <input type="text" class="form-control readonly-db" id="IMB_IMVCLT_PIX" >'+
                        '       </div>'+
                        '     </div>'+
                         '   </div>'+
                        '   <div class="row">'+
                        '     <div class="col-md-12">'+
                        '       <div class="col-md-1 div-center" >'+
                        '         <label class="label-control">DOC</label>'+
                        '         <input type="checkbox" class="form-control readonly-db" id="IMB_CLTCCR_DOC">'+
                        '       </div>'+
                        '       <div class="col-md-2 div-center">'+
                        '         <label class="label-control ">Principal</label>'+
                        '         <input type="checkbox" class="form-control readonly-db" id="IMB_IMVCLT_PRINCIPAL">'+
                        '       </div>'+
                        '       <div class="col-md-1 div-center">'+
                        '         <label class="label-control ">Poupança</label>'+
                        '         <input type="checkbox" class="form-control readonly-db" id="IMB_CLTCCR_POUPANCA">'+
                        '       </div>'+
                        '       <div class="col-md-2">'+
                        '         <label class="label-control div-center">Tx.Adm.</label>'+
                        '         <input type="text" class="form-control valor-4 readonly-db" id="IMB_IMVCLT_TAXAADMINISTRAT">'+
                        '         <span>'+
                        '           <select select class="form-control readonly-db" id="IMB_IMVCLT_TAXAADMINISTRATFORMA">'+
                        '             <option value="P">Em %</option>'+
                        '             <option value="V">Em R$</option>'+
                        '           </select>'+
                        '         </span>'+
                        '       </div>'+
                        '       <div class="col-md-6">'+
                        '         <div class="row">'+
                        '           <div class="col-md-12">'+
                        '             <label class="label-control">Nome do Correntista</label>'+
                        '             <input type="text" class="form-control readonly-db" id="IMB_CLTCCR_NOME" maxlength="40">'+
                        '           </div>'+
                        '         </div>'+
                        '       </div>'+
                        '     </div>'+
                        '   </div>'+
                        ' </div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div class="row p-5 bg-info text-white" >'+
                '   <div class="col-md-2" >IPTU 1: '+iptu1+'<p>'+iptu1ref+'</p></div>'+
                '   <div class="col-md-2" >IPTU 2: '+iptu2+'<p>'+iptu2ref+'</p></div>'+
                '   <div class="col-md-2" >IPTU 3: '+iptu3+'<p>'+iptu3ref+'</p></div>'+
                '   <div class="col-md-2" >IPTU 4: '+iptu4+'<p>'+iptu4ref+'</p></div>'+
                '   <div class="col-md-2" >Inscr. Água: '+inscdae+'<p>Senha: '+senhadae+'</p></div>'+
                '   <div class="col-md-2" >Inscr.Energia: '+inscenerg+'<p>Senha: '+senhaenerg+'</p></div>'+
                '</div>';

                '<div class="row p-5 bg-info text-white" ><p></p></div>';

                if( obsimv != '' )
                texto = texto + '<div class="row p-5 bg-info text-white div-center" ><b>'+obsimv+'</b></div>';

                if( obsld != '' )
                texto = texto + '<div class="row p-5 bg-info text-white div-center" ><b>'+obsld+'</b></div>';

                if( obslt != '' )
                texto = texto + '<div class="row p-5 bg-info text-white div-center" ><b>'+obslt+'</b></div>';
                
                texto = texto +'<div class="row p-5 bg-info text-white" ><p></p></div>';

                classeencerrado = '';
                if( full.IMB_CTR_SITUACAO == 'ENCERRADO')
                   classeencerrado='escondido';

                texto = texto +
                '<div class="row p-5 bg-info text-white" >'+
                '   <div class="col-md-12  row-top-margin bg-info text-white">'+
                "@php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Contratos', 'Contratos', 'ADM', 'Contratos','S', 'A', 'Botão')@endphp"+
                '<a class="{{$acesso}}" href="javascript:alterarContrato('+full.IMB_CTR_ID+')" title="Alterar dados do contrato"><i class="fas fa-edit fa-2x" style="color:black"></i></a>'+
                '&nbsp;&nbsp;&nbsp;'+
                "@php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'LançamentosContrato', 'Contratos - Lançamentos Valores em Contrato', 'ADM', 'Contratos','S', 'X', 'Botão')@endphp"+
                '<a class="{{$acesso}}" href="javascript:lancamentos('+full.IMB_CTR_ID+')" title="Lançamentos de valores"><i class="fas fa-calculator fa-2x"></i></a>'+
                '&nbsp;&nbsp;&nbsp;'+
                "@php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'RecebimentoAluguel', 'Contratos - Receber Aluguel', 'ADM', 'Contratos','S', 'X', 'Botão')@endphp"+
                '<a class="{{$acesso}} '+classeencerrado+'" href="javascript:receber('+full.IMB_CTR_ID+')" title="Receber Aluguel"><i class="fas fa-donate fa-2x" style="color:green"></i></a>'+
                '&nbsp;&nbsp;&nbsp;'+
                "@php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'RepassarAluguel', 'Contratos - Repassar Aluguel', 'ADM', 'Contratos','S', 'X', 'Botão')@endphp"+
                '<a  class="{{$acesso}} '+classeencerrado+'" href="javascript:repassar('+full.IMB_CTR_ID+')" title="Repassar Aluguel"><i class="fas fa-donate fa-2x" style="color:red"></i></a>'+
                '&nbsp;&nbsp;&nbsp;'+
                "@php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'HistoricoLt', 'Contratos - Histórico de Recebimento', 'ADM', 'Contratos','S', 'X', 'Botão')@endphp"+
                '<a class="{{$acesso}}"href="javascript:hitoricoReceb('+full.IMB_CTR_ID+')"    title="Históricos de Recebimento"><i class="fas fa-eye fa-2x" style="color:green"></i></a>'+
                '&nbsp;&nbsp;&nbsp;'+
                "@php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'HistoricoLd', 'Contratos - Histórico de Repasse', 'ADM', 'Contratos','S', 'X', 'Botão')@endphp"+
                '<a class="{{$acesso}}" href="javascript:hitoricoRepasse('+full.IMB_CTR_ID+')"  title="Históricos de Repasse"><i class="fas fa-eye fa-2x" style="color:red"></i></a>'+
                '&nbsp;&nbsp;&nbsp;'+
                "@php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'BoletosEmitidos', 'Contratos - Boletos Emitidos', 'ADM', 'Boletos Emitidos','S', 'X', 'Botão')@endphp"+
                '<a class="{{$acesso}}" href="javascript:boletosEmitidos('+full.IMB_CTR_ID+')"  title="Boletos Emitidos"><i class="fa fa-barcode" style="font-size:30px;color:black"></i></a>'+
                '&nbsp;&nbsp;&nbsp;'+
                "@php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ContratoAlteracaoVencto', 'Contrato - Alteração de Vencimento', 'ADM', 'Contratos','S', 'X', 'Botão')@endphp"+
                '<a class="{{$acesso}}" href="javascript:alteracaoVencimento('+full.IMB_CTR_ID+')"  title="Alteração de Vencimento"><i class="fas fa-clock" style="font-size:30px"> </i></a>'+
                '&nbsp;&nbsp;&nbsp;'+
                "@php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ClientesTelefone', 'Visualizar Telefones de Clientes', 'CRM', 'Clientes','S', 'X', 'Botão')@endphp"+
                '<a class="{{$acesso}}" href="javascript:telefones('+full.IMB_CTR_ID+')" title="Telefones dos Envolvidos"><i class="fas fa-phone-square-alt" style="font-size:30px;color:black"></i></a>'+
                '&nbsp;&nbsp;&nbsp;'+
                "@php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'AcordosAluguel', 'Contratos - Acordos', 'ADM', 'Contratos','S', 'X', 'Botão')@endphp"+
                '<a class="{{$acesso}}" href="javascript:acordosRealizados('+full.IMB_CTR_ID+')" title="Acordos para este contrato"><i class="fa fa-handshake-o" style="font-size:30px;color:green"></i></a>'+
                '&nbsp;&nbsp;&nbsp;'+
                "@php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'RescisãoContratoAluguel', 'Contratos - Rescisão Contrato Aluguel', 'ADM', 'Contratos','S', 'X', 'Botão')@endphp"+
                '<a class="{{$acesso}}" href="javascript:rescisao('+full.IMB_CTR_ID+')" title="Rescindir este contrato"><i class="fas fa-lock" style="font-size:30px;color:orange"></i></a>'+
                '&nbsp;&nbsp;&nbsp;'+
                "@php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'SeguroIncendioContrato', 'Contratos - Seguro Incêndio Contrato Aluguel', 'ADM', 'Contratos','S', 'X', 'Botão')@endphp"+
                '<a  class="{{$acesso}}" href="javascript:seguroIncendio('+full.IMB_CTR_ID+')" title="Seguro Incendio"><i class="fas fa-fire-extinguisher" style="font-size:30px;color:red"></i></a>'+
                '&nbsp;&nbsp;&nbsp;'+
                "@php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'DepositoCaucao', 'Contratos - Depósito Caução', 'ADM', 'Contratos','S', 'X', 'Botão')@endphp"+
                '<a  class="{{$acesso}}" href="javascript:caucao('+full.IMB_CTR_ID+')"  title="Depósito Caução"><i class="fas fa-piggy-bank" style="font-size:30px;color:green"></i></a>'+
                '&nbsp;&nbsp;&nbsp;'+
                "@php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'AvisoDesocupacao', 'Contratos - Aviso de Desocupação', 'ADM', 'Contratos','S', 'X', 'Botão')@endphp"+
                '<a  class="{{$acesso}}"href="javascript:avisoDesocupacao('+full.IMB_CTR_ID+')"title="Aviso Desocupação"><i class="fas fa-bullhorn"" style="font-size:30px;color:blue"  ></i></a>'+
                '&nbsp;&nbsp;&nbsp;'+
                "@php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'SeguroFianca', 'Contratos - Seguro Fiança', 'ADM', 'Contratos','S', 'X', 'Botão')@endphp"+
                '<a  class="{{$acesso}}" href="javascript:seguroFianca('+full.IMB_CTR_ID+')" title="Seguro Fiança"><i class="fas fa-shield-alt" style="font-size:30px;color:black"></i></a>'+
                '&nbsp;&nbsp;&nbsp;'+
                "@php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ContratoAuditoria', 'Contratos - Auditoria na Utilização', 'GERAL', 'Auditoria','S', 'X', 'Botão')@endphp"+
                '<a class="{{$acesso}}" href="javascript:auditoria('+full.IMB_CTR_ID+')"  title="Logs e Auditoria"><i class="fas fa-user-secret"  style="font-size:30px;color:red"></i></a>'+
                '&nbsp;&nbsp;&nbsp;'+
                "@php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ContratosRelatDebitosAberto', 'Contratos - Relat. Débitos Locatário', 'GERAL', 'Contratos','S', 'X', 'Botão')@endphp"+
                '<a class="{{$acesso}}" href="javascript:relatorioDebitoCliente('+full.IMB_CTR_ID+')"  title="Relatório Débitos"><i class="fas fa-calculator fa-2x" style="font-size:30px;color:red"></i></a>'+
                '&nbsp;&nbsp;&nbsp;'+
                "@php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ContratosGerarDoctos', 'Contratos - Gerar Documentos Automáticos', 'ADM', 'Contratos','S', 'X', 'Botão')@endphp"+
                '<a class="{{$acesso}}" href="javascript:modalDocsAutomaticos('+full.IMB_CTR_ID+')"  title="Gerar NOVOS Documentos"><i class="far fa-file" style="font-size:30px;color:black"></i></a>'+
                '&nbsp;&nbsp;&nbsp;'+
                '<a href="javascript:documentosGerados( 0,'+full.IMB_CTR_ID+',0)"  title="Documentos Já Gerados para o Contrato"><i class="far fa-folder-open" style="font-size:30px;color:black"></i></a>'+
                '&nbsp;&nbsp;&nbsp;'+
                '<a href="javascript:chamadosContrato( '+full.IMB_CTR_ID+', '+full.IMB_IMV_ID+')"  title="Chamados envolvendo este contrato"><i class="fa fa-commenting-o" style="font-size:30px;color:black"></i></a>'+
                '&nbsp;&nbsp;&nbsp;'+
                '<a href="javascript:alterarEnderecoCobranca( '+full.IMB_CTR_ID+')"  title="Endereço Cobrança"><i class="far fa-address-card" style="font-size:30px;color:black"></i></a>'+
                '&nbsp;&nbsp;&nbsp;'+
                '<a href="javascript:anexos( '+full.IMB_CTR_ID+' )"  title="Anexos"><i class="fa fa-paperclip" aria-hidden="true" style="font-size:30px;color:black"></i></a>'+
                '&nbsp;&nbsp;&nbsp;'+
                "@php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ContratosExtratoRecto', 'Contratos - Extrato Recebimento Locatário', 'ADM', 'Contratos','S', 'X', 'Botão')@endphp"+
                '<a class="{{$acesso}}" href="javascript:modalExtratoLocatario( '+full.IMB_CTR_ID+', 1 )"  title="Extrato de Pagamentos do Locatário"><i class="fa fa-database" aria-hidden="true"  style="font-size:30px;color:green"></i></a>'+
                '&nbsp;&nbsp;&nbsp;'+
                                




                '   </div>'+
                '</div>';

                //debugger;




//                texto = texto +
  //              '<div class="row"><br></div>';

                //fechando div dos dados do contrato
                texto = texto + '</div>';

                texto = texto + '</div></div>';


            return texto;
        }



        function alterarContrato( id )
        {
            $("#i-idcontrato-alt").val( id );
            $("#form-alterarcontrato").submit();
        }

        function alterarImovel( id )
        {
            $("#id-imovel").val( id );
            $("#form-alt-imovel").submit();
        }

        function alterarClienteIndexCtr( id )
        {
            $("#id-cliente").val( id );
            $("#form-alt-cliente-indexctr").submit();
        }


        function receber( id )
        {
            $("#i-idcontrato-receber").val( id );
            $("#form-receber").submit();
        }


        function repassar( id )
        {
            $("#i-idcontrato-repassar").val( id );
            $("#form-repassar").submit();
        }


        function lancamentos( id )
        {
            $("#i-idcontratopesquisa").val( id );
            $("#form-lancamentos").submit();
        }

        function hitoricoReceb( id )
        {
            window.open( "{{route('recibolocatario.historico')}}/"+id, "_blank");
        }


        function hitoricoRepasse( id )
        {
            window.open( "{{route('recibolocador.historico')}}/"+id, "_blank");
        }

        function boletosEmitidos( id )
        {
            $("#IMB_CTR_ID-BOLETO").val( id );
            cargaBoletos();
            $("#modalboletoscontrato").modal('show');
        }

        function alteracaoVencimento( id )
        {

            $("#modalalteracaovencimento").modal('show');
            $("#av-IMB_CTR_ID").val( id );
            alteracaoVencimentoCargaCampos( id );


        }

        function telefones( id )
        {
            var url = "{{route('telefone.envolvidos')}}/"+id;
            cargaTelefoneEnvolvidos( id );
        }

        function seguroIncendio( id )
        {
            var url = "{{route('seguroincendio.new')}}/"+id;
            window.open( url, '_blank');
        }

        function seguroFianca( id )
        {
            var url = "{{route('segurofianca.new')}}/"+id;
            window.open( url, '_blank');
        }

        function caucao( id )
        {
            var url = "{{route('caucao.new')}}/"+id;
            window.open( url, '_blank');
        }
        function avisoDesocupacao( id )
        {
            avisoDesocupacaoCargaCampos( id );
            $("#modalavisodesocupacao").modal('show');

        }

        function auditoria( id )
        {
            cargaLog(id);
            $("#modalauditoria").modal( 'show');
        }

        function modalDocsAutomaticos( id )
        {
            cargaDocumentosAutomaticos(0,id,0); //somente parametro id contrato
            $("#modaldocautomaticos").modal('show');

        }

        function relatorioDebitoCliente( id )
        {
            var url = "{{ route('contrato.debitos') }}/"+id;
            window.open( url, '_blank');
        }

        function chamadosContrato( id, idImovel )
        {
            $("#IMB_CTR_IDSOLEVECON").val( id );
            $("#IMB_IMV_ID-SOL").val( idImovel );
                        
            

            cargaEventos( id );
            usuarioDestinoSol();
            cargaTipoSolicitacao();
            $("#modalsolicitacaoeventoscontrato").modal('show');
//            $("#modalsolicitacao").modal('show');

        }


        function modalExtratoLocatario( id )
        {
            debugger;
            var datafinal       = moment();
            var datainicial     = moment().subtract(12, 'months')

            datainicial = moment( datainicial).format( 'YYYY-MM-DD');
            datafinal = moment( datafinal).format( 'YYYY-MM-DD');
            
            var url = "{{route('contrato.emaillocatarioprincipal')}}/"+id;

            $.ajax(
                {
                    url:url,
                    dataType:'json',
                    type:'get',
                    async:false,
                    success:function( data )
                    {
                        $("#i-email-modal-extratolocatario").val( data);
                    }
                }
            )

            $("#IMB_CTR_ID-extratolocatario").val( id );
            $("#i-datainicial-extratolocatario").val( datainicial);
            $("#i-datafinal-extratolocatario").val( datafinal);
            $("#modalemvialextratolocatario").modal('show');

        }

        function mostrarDiv( idcontrato, idimovel)
        {
            CarregarPropImo( idimovel );
            cargaLocatarioContrato( idcontrato );
            cargaFiadorContrato( idcontrato );
            $(".divdados").hide();
            $("#i-div-"+idcontrato).show();
        }

        function CarregarPropImo( imovel )
        {
        var url = "{{ route('propimo.carga') }}"+"/"+imovel;
        console.log( url );
        $.ajax
        (
            {
                url:url,
                dataType:'json',
                type:'get',
        
                success:function(data )
                {
                    //debugger;
                    linha = "";
                    $("#i-tbl-locador"+imovel+">tbody").empty();
                    for( nI=0;nI < data.length;nI++)
                    {
                        linha =
                            '<tr>'+
                    //        '   <td style="text-align:center"> '+
                //            '     <a  class="btn btn-sm btn-primary" data-toggle="tooltip" title="Dados Bancário / Informações para Pagamento" href=javascript:dadosBancarios('+data[nI].IMB_PPI_ID+','+imovel+')>Dados Bancários</a>'+
              //              '   </td>'+
                            '   <td style="text-align:center"><a title="Forma Pagto: '+
                                            data[nI].FORMAPAGAMENTO+
                                            ' Banco: '+data[nI].GER_BNC_NUMERO+
                                            ' Agencia: '+data[nI].GER_BNC_AGENCIA+'-'+data[nI].IMB_BNC_AGENCIADV+'  '+
                                            ' Conta: '+data[nI].IMB_CLTCCR_NUMERO+'-'+data[nI].IMB_CLTCCR_DV+'  '+
                                            ' Correntista: '+data[nI].IMB_CLTCCR_NOME+' CPF: '+data[nI].IMB_CLTCCR_CPF+'  '+
                                            ' Pix: '+data[nI].IMB_IMVCLT_PIX+'" href="javascript:ClienteCargaEnvolvido('+data[nI].IMB_CLT_ID+')">'+data[nI].IMB_CLT_NOME+'('+data[nI].FORMAPAGAMENTO+')</a></td>'+
                            '   <td style="text-align:center">'+data[nI].IMB_IMVCLT_PERCENTUAL4+'%</td>'+
                            '   <td style="text-align:center">'+data[nI].principal+'</td>'+
                            '</tr>';

                        $("#i-tbl-locador"+imovel).append( linha );

                    }
                }
            })
        }

        
    function cargaLocatarioContrato( idcontrato )
    {
        var url = "{{ route('locatariocontrato.carga') }}"+"/"+idcontrato;
        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                async:false,
                success:function(data)
                {
                    linha = "";

                    $("#i-tbl-locatario"+idcontrato+">tbody").empty();
                    for( nI=0;nI < data.length;nI++)
                    {
                        var sim='';
                        if( data[nI].IMB_LCTCTR_PRINCIPAL =='S' ) sim='Principal';
                            linha =
                            '<tr id="'+data[nI].IMB_CLT_ID+'">'+

                            '   <td style="text-align:center"><a href="javascript:ClienteCargaEnvolvido('+data[nI].IMB_CLT_ID+')">'+data[nI].IMB_CLT_NOME+'</a></td>'+
                            '   <td style="text-align:center">'+sim+'</td>'+
                            '   <td style="display: none">'+data[nI].IMB_LCTCTR_ID+'</td>'+
                            '</tr>';
                        $("#i-tbl-locatario"+idcontrato).append( linha );
                    }
                }


            });
    }

    function cargaFiadorContrato( idcontrato )
    {
        var url = "{{ route('fiadorcontrato.carga') }}"+"/"+idcontrato;
        console.log( url );
        $.getJSON( url, function( data)
        {
            debugger;
            linha = "";
            $("#i-tbl-fiador"+idcontrato+">tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                conjuge = data[nI].IMB_CLTCJG_NOME;
                if( conjuge === null ) conjuge = '';
              linha =
                    '<tr id="'+data[nI].IMB_CLT_ID+'">'+
                
                    '   <td style="text-align:center"><a href="javascript:ClienteCargaEnvolvido('+data[nI].IMB_CLT_ID+')">'+data[nI].IMB_CLT_NOME+'/'+conjuge+'</a></td>'+
               
                    '</tr>';
              $("#i-tbl-fiador"+idcontrato).append( linha );
            }
        });
    }

    function dadosBancarios( id, idimovel)
    {
      url = "{{route('propimo.editar')}}/"+id;

      $.ajax(
        {
          url       : url,
          type      : 'get',
          dataType  : 'json',
          async     :' json',
          success   : function( data )
          {
            $("#i-nome-proprietario").html('Dados para Repasse a '+data.IMB_CLT_NOME);
            cargaFormaRepasse( data.IMB_FORPAG_ID);
            cargaBancosRepasse( data.GER_BNC_NUMERO);


            var banco = ( data.GER_BNC_NUMERO == '' ? '0' : data.GER_BNC_NUMERO )
            var taxa = ( data.IMB_IMVCLT_TAXAADMINISTRAT == '' ? '0' : data.IMB_IMVCLT_TAXAADMINISTRAT )
            $("#IMB_CLT_ID-REP").val(data.IMB_CLT_ID);
            $("#IMB_IMV_ID-REP").val(data.IMB_IMV_ID);
            $("#IMB_IMVCLT_PERCENTUAL4").val( dolarToReal(data.IMB_IMVCLT_PERCENTUAL4));
            $("#IMB_FORPAG-IDLOCADOR").val( data.IMB_FORPAG_ID);
            $("#IMB_IMV_CHEQUENOMINAL").val( data.IMB_IMV_CHEQUENOMINAL);
            $("#GER_BNC_NUMERO-REP").val( banco );
            $("#GER_BNC_AGENCIA").val( data.GER_BNC_AGENCIA);
            $("#IMB_BNC_AGENCIADV").val( data.IMB_BNC_AGENCIADV);
            $("#IMB_CLTCCR_NUMERO").val( data.IMB_CLTCCR_NUMERO);
            $("#IMB_CLTCCR_NOME").val( data.IMB_CLTCCR_NOME);
            $("#IMB_CLTCCR_DV").val( data.IMB_CLTCCR_DV);
            $("#IMB_CLTCCR_PESSOA").val( data.IMB_CLTCCR_PESSOA);
            $("#IMB_CLTCCR_CPF").val( data.IMB_CLTCCR_CPF);
            $("#IMB_IMVCLT_PIX").val( data.IMB_IMVCLT_PIX);
            if( data.IMB_IMVCLT_PRINCIPAL == 'S')
              $("#IMB_IMVCLT_PRINCIPAL").prop( "checked",true );
            if( data.IMB_CLTCCR_DOC == 'S')
              $("#IMB_CLTCCR_DOC").prop( "checked",true );
            if( data.IMB_CLTCCR_POUPANCA == 'S')
              $("#IMB_CLTCCR_POUPANCA").prop( "checked",true );
            $("#IMB_IMVCLT_TAXAADMINISTRAT").val( dolarToReal( taxa ) );
            $("#IMB_IMVCLT_TAXAADMINISTRATFORMA").val( data.IMB_IMVCLT_TAXAADMINISTRATFORMA);
            $("#IMB_PPI_ID").val( data.IMB_PPI_ID);
            $(".readonly-db").attr('readonly', true);
          }
        }
      )




      $("#i-div-dadosbancarios"+idimovel).show();


    }

    function cargaFormaRepasse( id )
    {
      var url = "{{ route('formapagamento.carga')}}";
      console.log( url );
      $.getJSON( url , function( data )
            {

                $("#IMB_FORPAG-IDLOCADOR").empty();

                linha =  '<option value="-1">Forma Repasse</option>';
                $("#IMB_FORPAG-IDLOCADOR").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].IMB_FORPAG_ID+'">'+
                        data[nI].IMB_FORPAG_NOME+"</option>";
                        $("#IMB_FORPAG-IDLOCADOR").append( linha );

                };

                $("#IMB_FORPAG-IDLOCADOR").val( id );


            });

    }
    function cargaBancosRepasse(id)
    {
      $.getJSON( "{{ route('bancos.distinct')}}", function( data )
            {

                $("#GER_BNC_NUMERO-REP").empty();

                linha =  '<option value="-1">Selecione</option>';
                $("#GER_BNC_NUMERO-REP").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].GER_BNC_NUMERO+'">'+
                        data[nI].GER_BNC_NOME+"</option>";
                        $("#GER_BNC_NUMERO-REP").append( linha );

                }
                $("#GER_BNC_NUMERO-REP").val( id );

            });


    }

    function cargaBancos(id)
    {
      $.getJSON( "{{ route('bancos.distinct')}}", function( data )
            {

                $("#GER_BNC_NUMERO").empty();

                linha =  '<option value="-1">Selecione</option>';
                $("#GER_BNC_NUMERO").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].GER_BNC_NUMERO+'">'+
                        data[nI].GER_BNC_NOME+"</option>";
                        $("#GER_BNC_NUMERO-REP").append( linha );

                }
                $("#GER_BNC_NUMERO").val( id );

            });


    }

        preencherUnidades();

        function ligaDesligaSituacao( full)
        {
            var situacao = full.IMB_CTR_SITUACAO;

            if( situacao == 'ATIVO')
                return '<div title="'+situacao+'"><input  type="checkbox"  id="IMB_CTR_SITUACAO'+full.IMB_CTR_ID+'" checked disabled="disabled"></div>';
            else
                return '<div title="'+situacao+'"><input  type="checkbox"  id="IMB_CTR_SITUACAO'+full.IMB_CTR_ID+'" disabled="disabled"></div>';



        }

        function imprimirVisao()
        {
    

            agencia = $("#js-select-unidade").val();
            referencia = $("#i-referencia").val();
            endereco = $("#i-endereco").val();
            idcompletus = $("#i-idcompletus").val();
            condominio = $("#i-condominio").val();
            cidade = $("#i-cidade").val();
            bairro = $("#i-bairro").val();
            situacao= $("#i-situacao").val();
            proprietario = $("#i-proprietario").val();
            locatario = $("#i-locatario").val();
            fiador = $("#i-fiador").val();
            advogado = $("#IMB_CTR_ADVOGADO").prop( "checked" )   ? 'S' : 'N';
            advogadoexceto = $("#IMB_CTR_ADVOGADOEXCETO").prop( "checked" )   ? 'S' : 'N';

            var url = "{{route('contrato.list')}}?agencia="+agencia+"&referencia="+referencia+"&endereco="+endereco+"&condominio="+condominio+
                        "&cidade="+cidade+"&bairro="+bairro+"&locatario="+locatario+
                        "&fiador="+fiador+"&advogado="+advogado+"&situacao="+situacao+"&imprimirvisao=S&advogadoexceto="+advogadoexceto;

            window.open( url, '_blank');

        }


        function anexos( id)
        {
            $("#IMB_CTR_ID_ANEDOC").val( id );
            cargaAnexosDocumentos( id );
            $("#modalanexosdocumentos").modal( 'show');

        }


    </script>


@endpush
