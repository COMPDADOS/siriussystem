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
            <span class="caption-subject bold uppercase"> Pesquisa</span>
            <i class="fa fa-search font-blue"></i>
        </div>
        <div>
            <button class="btn btn-danger pull-right" type="button" id="btn-limpar"
            onClick="limparCampos()">Limpar Filtro</button>
        </div>

        @php
            $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Clientes', 'Clientes', 'CRM', 'Clientes','S', 'I', 'Botão');
        @endphp
        <form action="{{route( 'cliente.add' )}}" method="get" target="_blank">
            <button type="submit" class="btn green pull-right {{$acesso}}" type="button" id="i-btn-novo">Novo Cliente</button>
        </form>

    </div>
    <div class="portlet-body form">
       <form role="form" id="search-form">
        <!--<form acion="/cliente/list" method="get">-->
        <input type="hidden" id="IMB_IMB_IDMASTER" name="empresamaster" value="{{ Auth::User()->IMB_IMB_ID }}">
        <input type="hidden" id="i-corretor" name="corretor">
        <input type="hidden" id="i-clientetipopesquisa"name="tipopesquisa" value="{{session()->pull('clientetipopesquisa')}}">
        <input type="hidden" id="i-pesquisagenerica"name="pesquisagenerica" value="{{session()->pull('clientepesquisa')}}">

            <div class="form-body">
                <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label" >Telefone</label>
                            <input type="text" class="form-control telefone" placeholder="somente números"
                            name="fone" id="i-fone-cliente" onkeypress="return isNumber(event)"  >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="nome">Nome(nome fantasia)</label>
                            <input type="text" class="form-control" id="i-nome" name="nome"
                            placeholder="por ser um pedaço do nome" >
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label" for="cnpj">CPF/CNPJ</label>
                            <input type="text" class="form-control" name="cnpj" id="i-cnpj">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label  class="control-label">Corretor</label>
    		    			<select class="form-control" id="i-select-corretor" >
							</select>
                            <span>
                                <label class="control-label">
                                    <input class="form-check-input" type="checkbox"
                                        id="id-corretoresativos"  checked>Somente Ativos
                                </label>
                            </span>
                        </div>
                    </div>
                    <div class="form-actions noborder">
                        <button class="btn blue pull-right" id='btn-search-form'>Pesquisar</button>
                    </div>
            </div>

        </form>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover"  id="resultTable">
                    <thead>
                        <th>Nome</th>
                        <th width="200">Telefone</th>
                        <th width="150">Corretor</th>
                        <th width="50"></th>
                        <th width="50"></th>
                        <th width="50"></th>
                        <th width="10">Atualizaçao</th>
                        <th width="100" class="text-right">Ações</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal" tabindex="-1" role="dialog" id="modaldados">
    <div class="modal-dialog "style="width:90%;" >
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-blue">
                            <span id="i-nome-cliente" class="caption-subject bold uppercase"> Cliente</span>
                            <span id="i-corretor-atende" class="font-10px"></span>
                            <i class="fa fa-search font-blue"></i>
                        </div>
                        <div>
                            <button class="btn btn-danger pull-right" type="button" id="btn-limpar"
                            data-dismiss="modal" >Fechar
                            </button>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <input type="hidden" id="i-codigo-cliente">
                        <input type="hidden" id="i-interessado">
                        <input type="hidden" id="i-proprietario">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                @php
                                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Clientes', 'Clientes', 'CRM', 'Clientes','S', 'A', 'Botão');
                                @endphp

                                    <button type="button" class="{{$acesso}} btn btn-success" onClick="clienteAlterar()">Alterar
                                        <i class="glyphicon glyphicon-edit" ></i>
                                    </button>
                                @php
                                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Clientes', 'Clientes', 'CRM', 'Clientes','S', 'E', 'Botão');
                                @endphp

                                    <button type="button" class="{{$acesso}} btn btn-danger">Inativar
                                        <i class="glyphicon glyphicon glyphicon-trash"></i>
                                    </button>
                                </div>
                                <div id="i-radar-ligado" class="col-md-1 escondido">
                                    <img  src="/sys/assets/layouts/layout/img/radar_verde_50.png" alt="radar">
                                </div>
                                <div id="i-chave" class="col-md-1 escondido">
                                    <img  src="/sys/assets/layouts/layout/img/chaves.png" alt="radar">
                                </div>
                                <div id="i-radar-desligado" class="col-md-1 escondido">
                                    <img id="i-radar-desligado" class="escondido" src="/sys/assets/layouts/layout/img/radar_desligado_50.png" alt="">
                                </div>
                                <div class="col-md-6 caption-subject bold uppercase font-10px">
                                    <div id="i-ultimo-atendimento" class="col-md-6">
                                    </div>
                                    <div class="col-md-6 font-red-bold-10px" id="i-ultimo-atendimentoaberto" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tabs">
                            <ul>
                                <li><a href="#tab-principal" id="h-principal"><span>Dados Gerais</span></a></li>
                                <li><a href="#tab-imoveis" id="h-imoveis"><span>Imóveis</span></a></li>
                                @php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ClientesTelefone', 'Visualizar Telefones de Clientes', 'CRM', 'Clientes','S', 'X', 'Botão')@endphp
                                <li class="{{$acesso}}"><a href="#tab-telefones" id="h-telefones"><span>Fones/Email</span></a></li>
                                <li><a href="#tab-log" id="h-logs"><span>Logs/Registros</span></a></li>
                                <li><a href="#tab-perfis" id="h-perfis"><span>Perfis</span></a></li>
                                <li><a href="#tab-atendimentos" id="h-atendimentos"><span>Atendimentos</span></a></li>
                                <li><a href="#tab-visitas"><span>Visitas</span></a></li>
                                <li><a href="#tab-negociacoes" id="h-negociacoes"><span>Negociações/Observações</span></a></li>
                            </ul>
                            <div id="tab-principal">
                                <div class="row">
                                    <div class="col-md-2">Cadastrado em
                                        <p id="m-IMB_CLT_DATACADASTRO">Data</p>
                                    </div>
                                    <div class="col-md-2">Atualizado em
                                        <p id="m-IMB_CLT_DTHALTERACAO">Data</p>
                                    </div>
                                    <div class="col-md-2">RG/Insc.Est.
                                        <p id="m-IMB_CLT_RG"></p>
                                    </div>
                                    <div class="col-md-3">CPF/CNPJ
                                        <p id="m-IMB_CLT_CPF"></p>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-6">Endereço
                                        <p id="m-ENDERECO">Tipo</p>
                                    </div>
                                    <div class="col-md-6">Bairro
                                        <p id="m-CEP_BAI_NOMERES">Data</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">Cep
                                        <p id="m-IMB_CLT_RESENDCEP">CEP</p>
                                    </div>
                                    <div class="col-md-5">Cidade
                                        <p id="m-CEP_CID_NOMERES">Data</p>
                                    </div>
                                    <div class="col-md-1">Estado
                                        <p id="m-CEP_UF_SIGLARES">Data</p>
                                    </div>
                                </div>


                            </div>
                            <div id="tab-imoveis">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered" id="tableImoveis">
                                            <thead>
                                                <th width="50">#ID</th>
                                                <th width="100">Referência</th>
                                                <th>Endereço</th>
                                                <th>Bairro</th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-telefones">
                                <div class="row">
                                    <table  id="tbltelefone" class="table table-striped table-bordered table-hover" >
                                        <thead class="thead-dark">
                                            <tr >
                                                <th width="40" style="text-align:center"> DDD </th>
                                                <th width="150" style="text-align:center"> Número </th>
                                                <th style="text-align:center"> Tipo </th>
                                                <th width="40"><button class="btn btn-primary" onClick="incluirTelefone()">+</button></th>
                                                <th width="40"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                    </table>
                                    <div class="form-group">
                                        <label class="label-control">Email</label>
                                        <input class="form-control" type="text" id="m-IMB_CLT_EMAIL" readonly>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-log">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-striped" id="tablelog">
                                            <thead>
                                                <th>Data/Hora</th>
                                                <th>Alteração</th>
                                                <th>Usuário</th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-perfis">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered" id="tableperfil">
                                            <thead>
                                                <th>Data</th>
                                                <th>Tipo</th>
                                                <th>Venda Até R$</th>
                                                <th>Locação Até R$</th>
                                                <th>Finalidade</th>
                                                <th>Bairro</th>
                                                <th>Dorm.</th>
                                                <th>Suíte</th>
                                                <th>Garag.</th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-atendimentos">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="i-div-pagination" class="div-center">
                                        </div>
                                    </div>
                                     <div class="col-md-12">
                                        <table id="tableatm" style="width:100%" class="table-bordered table-hover compact stripe">
                                            <thead class="font-und-14px">
                                                <th class="div-center" >Status</th>
                                                <th class="div-center" >Responsavel</th>
                                                <th class="div-center" >Data/Hora</th>
                                                <th class="div-center" >Agendamento</th>
                                                <th class="div-center" >comentário</th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-visitas">
                                Registro de Visitas
                            </div>
                            <div id="tab-negociacoes">
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i>Dados da Negociação
                                        </div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-4 bg-light">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Taxa Adm.%</label>
                                                                <input class="form-control" type="text" id="m-IMB_CLT_TAXAADM">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label class="control-label">Taxa Contrato</label>
                                                                <input class="form-control" type="text" id="m-IMB_CLT_TCPERC">
                                                                <span>% Sobre o Aluguel</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Parcelas</label>
                                                                <input class="form-control"type="number" id="m-IMB_CLT_TCPARCELAS" min="1" max="12">
                                                                <span>Qt.Parcelas</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 bg-info">
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <label class="control-label">Banco</label>
                                                                    <select class="form-control" id="m-GER_BNC_NUMERO">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Ag.</label>
                                                                        <input class="form-control" type="text" id="m-GER_BNC_AGENCIA">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <label class="control-label">C/C</label>
                                                                        <input class="form-control" type="text" id="m-IMB_CLTCCR_NUMERO">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label class="control-label">DV</label>
                                                                        <input class="form-control" type="text" id="m-IMB_CLTCCR_DV">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Correntista
                                                                                <input class="form-control" type="text" id="m-IMB_CLTCCR_NOME">
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="control-label">CPF/CNPJ
                                                                                <input class="form-control" type="text" id="m-IMB_CLTCCR_CPF">
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Poupança
                                                                            <input class="form-control"
                                                                                type="checkbox"
                                                                                data-checkbox="icheckbox_flat-blue"
                                                                                name="aberto" id="m-IMB_CLTCCR_POUPANCA">
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">Chave PIX
                                                                    <input class="form-control" type="text" id="m-IMB_CLT_CHAVEPIX">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end form-body-->
                                    </div>
                                </div>
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i>Observações
                                        </div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea class="form-control" rows="3"
                                                            id="M-IMB_CLT_OBSERVACAO" ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end form-body-->
                                    </div>
                                </div><!--FIM Portlet-body form">-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modaltelefones">
  <div class="modal-dialog "style="width:60%;" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Telefones do Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered" id="tbltelefone">
                    <thead>
                        <th>DDD</th>
                        <th>Número</th>
                        <th>Tipo</th>
                    </thead>
                </table>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">sair</button>
      </div>
    </div>
  </div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="modalalttelefone">
  <div class="modal-dialog "style="width:60%;" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Inclusão/Alteração de Telefone</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
                <input type="hidden" id="i-alt-tlfid">
                <div class="col-md-2">
                    <input class="form-control" type="text" id="i-alt-dddtelefone" placeholder="DDD" onkeypress="return isNumber(event)"  >
                </div>
                <div class="col-md-3">
                    <input class="form-control" type="text" id="i-alt-numerotelefone"  placeholder="Número"  onkeypress="return isNumber(event)"  >
                </div>
                <div class="col-md-3">
                    <select class="form-control  input-8" id="i-alt-tipotelefone"  placeholder="Tipo" >
                        <option value="Residencial">Residencial</option>
                        <option value="Comercial">Comercial</option>
                        <option value="Celular">Celular</option>
                        <option value="Whatsapp">Whatsapp</option>
                        <option value="Recado">Recado</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary" onClick="ConfirmarAltFone()"> Gravar </button>
                    <button class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>




<form style="display: none" action="{{route('atendimento.atendimento')}}" method="POST" id="form-atm" target="_blank">
@csrf
    <input type="hidden" id="id-atm" name="id" />
</form>


<form style="display: none" action="{{route('cliente.edit')}}" method="POST" id="form-alt" target="_blank">
@csrf
    <input type="hidden" id="id" name="id" />
    <input type="hidden" id="readonly" name="readonly"/>
</form>

@endsection
@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>

<script type="text/javascript">

    $(document).ready(function()
    {
        $( "#tabs" ).tabs();

        preencherSelectUsuarios();

        $("#sirius-menu").click();

        $( "#id-corretoresativos" ).change(function()
        {
            preencherSelectUsuarios();
        });

        $( "#i-select-corretor" ).change(function() {
            var cCorretor = $('#i-select-corretor').val();
            $("#i-corretor").val( cCorretor );
        });

        $("#h-principal").click( function()
        {
            carregarModalCliente( $("#i-codigo-cliente").val() );
        })

        $("#h-imoveis").click( function()
        {
            cargaPropImo( $("#i-codigo-cliente").val() );

        })

        $("#h-telefones").click( function()
        {
            telefoneCarregar( $("#i-codigo-cliente").val() );

        })

        $("#h-logs").click( function()
        {
            CargaLog( $("#i-codigo-cliente").val() );

        })

        $("#h-atendimentos").click( function()
        {
            atendimentos( $("#i-codigo-cliente").val() );

        })

        $("#h-perfis").click( function()
        {
            cargaPerfil( $("#i-codigo-cliente").val() );

        })




    });

    var table = $('#resultTable').DataTable({
            "language":

    {
    "sEmptyTable": "Nenhum registro encontrado",
    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
    "sInfoPostFix": "",
    "sInfoThousands": ".",
    sLoadingRecords: '<img src="{{asset('/layouts/layout/img/loader.gif')}}"/>',
        sProcessing: '<img src="{{asset('/layouts/layout/img/loader.gif')}}"/>',
    "sZeroRecords": "Nenhum registro encontrado",
    "sSearch": "Pesquisar",
    "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
    },
},
           bLengthChange: false,
            bSort : false ,
            responsive: false,
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('cliente.list') }}",
                data: function (d) {
                    d.fone = $('input[name=fone]').val();
                    d.nome = $('input[name=nome]').val();
                    d.cnpj = $('input[name=cnpj]').val();
                    d.corretor = $('input[name=corretor]').val();
                    d.empresamaster = $('input[name=empresamaster]').val();
                    d.tipopesquisa = $('input[name=tipopesquisa]').val();
                    d.pesquisagenerica = $('input[name=pesquisagenerica]').val();
                }
            },
            columns: [
                {data: 'IMB_CLT_NOME' },
                {data: 'FONES', render:getFonesCliente},
                {data: 'CORRETOR'},
                {data: 'IMB_CLT_ID', render: getRadar},
                {data: 'IMB_CCH_ID', render: getClienteChave},
                {data: 'IMB_CLT_ID', render: getInformacoes},
                {data: 'IMB_CLT_DTHALTERACAO', render: formataDataAlteracao},

            ],

            "columnDefs": [
                {
                "targets": 0,
                "orderable": false
                } ,
                {
                    "targets": 7,
                    "data": null,
                    "defaultContent": "<div style='text-align:center'>"+
                        "<button class='btn green-meadow glyphicon glyphicon-search pull-right show-imv'></button>"+
                        "@php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Clientes', '   ', 'CRM', 'Clientes','S', 'A', 'Botão')@endphp"+
                        "<button class='btn btn-primary glyphicon glyphicon-pencil pull-right alt-clt {{$acesso}}'></button>",
                },
                { width: 200, targets: 0 },
           ],
            searching: false
        });

        $('#search-form').on('submit', function(e) {
            table.draw();
            e.preventDefault();
        });

        $('#resultTable tbody').on( 'click', '.alt-clt', function ()
        {
            var data = table.row( $(this).parents('tr') ).data();
            clienteAlterarGrid( data.IMB_CLT_ID );
        });


        $('#resultTable tbody').on( 'click', '.btn-fone', function ()
        {
            alterar( data.IMB_CLT_ID );
        });


        $('#resultTable tbody').on( 'click', '.show-imv', function ()
        {
            var data = table.row( $(this).parents('tr') ).data();
            $( "#tabs" ).tabs({ active: 0 });
            carregarModalCliente(data.IMB_CLT_ID, data.INTERESSADO, data.PROPRIETARIO);
/*            $("#id").val( data.IMB_CLT_ID );
             $("#readonly").val('S');
            $("#form-alt").submit();
            */

//            window.location = "{{ route('cliente.edit') }}/" + data.IMB_CLT_ID+'/S';
            //window.location = "{{ route('cliente.edit', ['id' =>"+ data.IMB_CLT_ID+", 'somenteleitura' =>'S'])}}";
        });

        $('#resultTable tbody').on( 'click', '.btn-atm', function ()
        {
     

            var data = table.row( $(this).parents('tr') ).data();
            atendimentos(  data.IMB_CLT_ID );
        });


        $('#resultTable tbody').on( 'click', '.alt-imv', function () {
            var data = table.row( $(this).parents('tr') ).data();
            $("#id").val( data.IMB_CLT_ID );
            $("#readonly").val('N');
            $("#form-alt").submit();
//            window.location = "{{ route('cliente.edit') }}/" + data.IMB_CLT_ID+'/N';
        });

        function formatarDataColumn(data, type, full, meta)
        {
            var datacad = '';
            if( full.IMB_CLT_DATACADASTRO != null )
                datacad = moment(full.IMB_CLT_DATACADASTRO).format('DD/MM/YYYY');

            //alert( "do banco: "+full.IMB_CLT_DATACADASTRO+' - tratado '+datacad );
            return datacad;

        }


        function getRadar(data, type, full, meta)
        {

            var cdados='<div id="radarligado'+full.IMB_CLT_ID+'"><img  src="/sys/assets/layouts/layout/img/radar_30_ligado.png" alt="radar"></div>'+
                        '<div id="radardesligado'+full.IMB_CLT_ID+'"><img  src="/sys/assets/layouts/layout/img/radar_desligado_30.png" alt="radar"></div>';
            verificarClienteTemPerfil(full.IMB_CLT_ID, function(resultado)
            {

                if( resultado == 'ok' )
                {
                    $("#radarligado"+full.IMB_CLT_ID).show();
                    $("#radardesligado"+full.IMB_CLT_ID).hide();
                }
                else
                {
                    $("#radarligado"+full.IMB_CLT_ID).hide();
                    $("#radardesligado"+full.IMB_CLT_ID).show();

                }

            });
            return cdados;

        }

        function getClienteChave(data, type, full, meta)
        {

            var cdados='<div id="clientechave'+full.IMB_CLT_ID+'"><img  src="/sys/assets/layouts/layout/img/chave.png" title="Cliente em posse de chaves de imóvel(eis)"</div>';
                if( data === null )
                    $("#clientechave"+full.IMB_CLT_ID).hide()
                else
                    $("#clientechave"+full.IMB_CLT_ID).show();
            return cdados;

        }


        function getInformacoes(data, type, full, meta)
        {

            //$("#i-div-status").css("background",data[0].VIS_ATS_COLOR );


            var cdados='';
            if ( full.SEGUROFIANCA != null)
            {
                cdados = cdados + '<div class="bg-red-foreg-white">SEGURADORA</div>';

            }
            if ( full.LOCADOR != null)
            {
                cdados = cdados + '<div class="bg-blue-foreg-white">PROPRIETÁRIO</div>';

            }

            if ( full.INTERESSADO != null)
            {
                cdados = cdados + '<div class="bg-peru-foreg-white">INTERESSADO</div>';

            }

            if ( full.LOCATARIO != null)
            {
                cdados = cdados + '<div class="bg-orange-foreg-black">LOCATÁRIO</div>';

            }
            if ( full.FIADOR != null)

            {
               cdados = cdados + '<div class="bg-gray-fore-black">FIADOR</div>';
            }


            var precadastro =  (full.IMB_CLT_PRECADASTRO == 'S');

            if ( cdados == '' && precadastro)
            {
//              cdados = '<div align="center" style="color:white ;background-color:red">Pré-cadastro</div>';

            }

            verificarClienteTemPerfil(full.IMB_CLT_ID, function(resultado)
            {

                if( resultado == 'ok' )

                    cdados = cdados =
                        '<div><img  src="/sys/assets/layouts/layout/img/radar_30_ligado.png" alt="radar"></div>'
                else
                    cdados = cdados = '<div><img src="/sys/assets/layouts/layout/img/radar_desligado_30.png" alt=""></div>';

            });



            return cdados;
        }

        function atendimentos( id )
        {

            var url= "{{ route( 'atendimentos.cliente' ) }}/"+id+'/0';
            $.ajax(
            {
                url : url,
                type : 'get',
                success: function( data )
                {
                    var totalpaginas = Math.ceil(data.recordsTotal /10);

                    linha='<nav aria-label="Page navigation example">'+
                          '<ul class="pagination">'+
                          '<li class="page-item">'+
                          '<a class="page-link" href="#" onclick="paginarAtendimento('+id+',1)" aria-label="Previous">'+
                          '<span aria-hidden="true">&laquo;</span>'+
                          '<span class="sr-only">Previous</span>'+
                          '</a>'+
                          '</li>';
                    for( nI=1;nI <= totalpaginas;nI++)
                    {

                        linha+= '<li class="page-item"><a class="page-link" href="#" onclick="paginarAtendimento('+id+','+nI+')">'+nI+'</a></li>';
                    };
                    linha+= '<li class="page-item">'+
                            '<a class="page-link" href="#"  onclick="paginarAtendimento('+id+','+totalpaginas+')" aria-label="Next">'+
                            '<span aria-hidden="true">&raquo;</span>'+
                            '<span class="sr-only">Next</span>'+
                            '</a>'+
                            '</li>'+
                            '</ul>';
                    $("#i-div-pagination").html( linha );
                    paginarAtendimento( id,1);

                },
                error: function()
                {
                    alert('error');
                }
            });


            $("#modalatendimento").modal('show');
        }

        function visualizarAtm( id )
        {
            $("#id-atm").val( id );
            $("#form-atm").submit();

//            window.location = "{{ route('atendimento.atendimento') }}/" + id;
        }


        function telelefones( id )  //rotina feita pra acessar pela pagina de grid do cliente
        {
            var url = "{{ route('telefone.carga') }}"+"/"+id;
            $.getJSON( url, function( data)
            {
                linha = "";
                $("#tbltelefone>tbody").empty();
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                        '<tr>'+
                        '<td style="text-align:center valign="center">'+data[nI].IMB_TLF_DDD+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].IMB_TLF_NUMERO+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].IMB_TLF_TIPOTELEFONE+'</td>'+
                        '<td>'+
                            '<a href="#"><i class="fa fa-trash" aria-hidden="true"></i>Excluir</a>'+
                            '<a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true">Alterar</i></a>'+
                        '</td>'+
                        '</tr>';
                    $("#tbltelefone").append( linha );
                }
            });
            $("#modaltelefones").modal('show');


        }

        function carregarModalCliente( id, comointeressado, comoproprietario )
        {



            var url = "{{route('cliente.find')}}/"+id;

            $("#i-interessado").val( comointeressado );
            $("#i-proprietario").val( comoproprietario );



            $.ajax(
            {
                url : url,
                type: 'get',
                dataType:'json',
                async:false,
                success: function( data )
                {
                    var datacadastro = moment( data.IMB_CLT_DATACADASTRO).format('DD-MM-YYYY');
                    if( datacadastro = 'Invalid date')
                       datacadatro = '-';
                    var dataalteracao = moment( data.IMB_CLT_DTHALTERACAO).format('DD-MM-YYYY HH:mm');
                    if( dataalteracao = 'Invalid date')
                    dataalteracao = '-';
                    enderecotipo = data.IMB_CLT_RESENDTIPO;
                    if( enderecotipo === null ) enderecotipo = '';
                    endereco = data.IMB_CLT_RESEND;
                    if( endereco === null ) endereco = '';
                    endereconumero = data.IMB_CLT_RESENDNUM;
                    if( endereconumero === null ) endereconumero = '';

                    enderecocomplemento = data.IMB_CLT_RESENDCOM;
                    if( enderecocomplemento === null ) enderecocomplemento = '';


                    $("#i-nome-cliente").html( data.IMB_CLT_NOME);

                    $("#i-codigo-cliente").val( data.IMB_CLT_ID);
                    $("#m-IMB_CLT_DATACADASTRO").html( moment( data.IMB_CLT_DATACADASTRO).format('DD-MM-YYYY'));
                    $("#m-IMB_CLT_DTHALTERACAO").html( moment( data.IMB_CLT_DTHALTERACAO).format('DD-MM-YYYY'));
                    $("#m-IMB_CLT_RG").html( data.IMB_CLT_RG);
                    $("#m-IMB_CLT_CPF").html( data.IMB_CLT_CPF);
                    $("#m-IMB_CLT_RESENDCEP").html( data.IMB_CLT_RESENDCEP);
                    $("#m-CEP_CID_NOMERES").html( data.CEP_CID_NOMERES);
                    $("#m-CEP_BAI_NOMERES").html( data.CEP_BAI_NOMERES);
                    $("#m-ENDERECO").html( enderecotipo +' '+
                                            endereco+ ' '+
                                            endereconumero+' '+
                                            enderecocomplemento);
                    $("#m-CEP_UF_SIGLARES").html( data.CEP_UF_SIGLARES);

                    $("#m-IMB_CLT_EMAIL").val( data.IMB_CLT_EMAIL );

                    carregarBancos( data.GER_BNC_NUMERO );



                    ultimoCorretorAtendimento(data.IMB_CLT_ID, function(resultado)
                    {
                        var array = resultado.split(",");
                        nome=array[0];
                        data=array[1];
                        status=array[2];
                        if( nome != '' )
                            $("#i-ultimo-atendimento").html('Ultimo atendimento em '+data+' - por <span class="italic bold green">'+nome+'</span>');
                        else
                            $("#i-ultimo-atendimento").html('Cliente sem atendimento</p>' );

                    });


                    ultimoAtmAbeCorCli(data.IMB_CLT_ID, function(resultado)
                    {
                        var array = resultado.split(",");
                        nome=array[0];
                        data=array[1];
                        status=array[2];
                        if( nome != '' )
                            $("#i-ultimo-atendimentoaberto").html('Há atendimento em aberto desde '+data)
                        else
                            $("#i-ultimo-atendimentoaberto").html('');

                    });

                    verificarClienteTemPerfil(data.IMB_CLT_ID, function(resultado)
                    {
                        if( $("#i-interessado").val() !='' )
                        {
                            if( resultado == 'ok' )
                            {
                                $("#i-radar-ligado").show();
                                $("#i-radar-desligado").hide();
                            }
                            else
                            {
                                $("#i-radar-desligado").show();
                                $("#i-radar-ligado").hide();
                            }
                        }
                    });

                        clienteCorretor(data.IMB_CLT_ID, function(resultado)
                    {
                        $("#i-corretor-atende").html( ' - Atendido por '+resultado[0].IMB_ATD_NOME );

                    });



                    $("#modaldados").modal( 'show');



                }
            });
        }

        function carregarBancos( id )
        {
            var url = "{{ route('bancos.distinct') }}";

            $.getJSON( url, function( data)
            {
                $("#m-GER_BNC_NUMERO").empty();
                linha = "<option value='-1'>Selecione</option>";
                $("#m-GER_BNC_NUMERO").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                        '<option value="'+data[nI].GER_BNC_NUMERO+'">'+
                            data[nI].GER_BNC_NOME+"</option>";
                            $("#m-GER_BNC_NUMERO").append( linha );
                }
                $("#m-GER_BNC_NUMERO").val( id );


            });



        }

        function cargaPropImo( id )
        {
            url = "{{route('propimo.imoveisprop')}}/"+id;

            $.ajax(
                {
                    url : url,
                    datatype : 'json',
                    type: 'get',
                    async : false,
                    success:function( data )
                    {
                        linha = "";
                    $("#tableImoveis>tbody").empty();
                    for( nI=0;nI < data.length;nI++)
                    {
                        var enderecotipo = data[nI].IMB_IMV_ENDERECOTIPO;
                        if( enderecotipo === null ) enderecotipo = '';
                        var endereco = data[nI].IMB_IMV_ENDERECO;
                        if( endereco === null ) endereco = '';
                        var endereconumero = data[nI].IMB_IMV_ENDERECONUMERO;
                        if( endereconumero === null ) endereconumero = '';
                        var enderecocomplemento = data[nI].IMB_IMV_ENDERECOCOMPLEMENTO;
                        if( enderecocomplemento === null ) enderecocomplemento = '';
                        var numapto= data[nI].IMB_IMV_NUMAPT;


                        linha =
                            '<tr>'+
                            '<td style="text-align:center valign="center">'+data[nI].IMB_IMV_ID+'</td>' +
                            '<td style="text-align:center valign="center">'+data[nI].IMB_IMV_REFERE+'</td>' +
                            '<td style="text-align:center valign="center">'+enderecotipo+' '+
                            endereco+' '+
                            endereconumero+' ' +
                            numapto+' ' +
                            enderecocomplemento+'</td>'+
                            '<td style="text-align:center valign="center">'+data[nI].CEP_BAI_NOME+'</td>' +
                            '</tr>';
                        $("#tableImoveis").append( linha );
                    }

                    }
                }
            )

        }


        function telefoneCarregar( id )
        {
            var url = "{{ route('telefone.carga') }}"+"/"+id;
            $.ajax(
                {
                    url : url,
                    type:'get',
                    dataType:'json',
                    async:false,
                    success:function( data )
                    {
                        linha = "";
                        $("#tbltelefone>tbody").empty();
                        for( nI=0;nI < data.length;nI++)
                        {
                            linha =
                                '<tr>'+
                                '<td style="text-align:center valign="center">'+data[nI].IMB_TLF_DDD+'</td>' +
                                '<td style="text-align:center valign="center">'+data[nI].IMB_TLF_NUMERO+'</td>' +
                                '<td style="text-align:center valign="center">'+data[nI].IMB_TLF_TIPOTELEFONE+'</td>' +
                                '<td style="width:20px>'+
                                '<button class="btn" title="Alterar este telefone" onClick="javascript:alterarFone('+data[nI].IMB_TLF_ID+')"><i class="fa fa-pencil"></i> </button>'+
                                '</td>'+
                                '<td style="width:20px>'+
                                '<button class="btn" title="Excluir este telefone"  onClick="javascript:excluirFone('+data[nI].IMB_TLF_ID+')"><i class="fa fa-trash"></i> </button>'+
                                '</td>';

                                linha = linha +
                                '</tr>';
                            $("#tbltelefone").append( linha );
                        }
                    }
                });
        }

        function CargaLog( id )
        {
            var url = "{{ route('log.cliente') }}";
            dados =
            {
                IMB_CLT_ID : id,
            }
            $.ajax(
            {
            url:url,
            data:dados,
            datatype:'json',
            async:false,
            success: function( data )
            {
                linha = "";
                $("#tablelog>tbody").empty();

                for( nI=0;nI < data.data.length;nI++)
                {
                    var datalog = moment(data.data[nI].IMB_OBS_DTHATIVO).format('DD/MM/YYYY HH:mm');


                linha =
                    '<tr>' +
                    '<td style="text-align:center valign="center">'+datalog+'</td>' +
                    '<td style="text-align:center valign="center">'+data.data[nI].IMB_OBS_OBSERVACAO+'</td>' +
                    '<td style="text-align:center valign="center">'+data.data[nI].IMB_ATD_NOME+'</td>' +
                    '</tr>';
                $("#tablelog").append( linha );
                }
            }
            });
        }

        function cargaPerfil( id )
        {
            var url = "{{ route('cliente.perfil') }}/"+id;

            $.ajax(
            {
            url:url,
            datatype:'json',
            async:false,
            success: function( data )
            {
                linha = "";
                $("#tableperfil>tbody").empty();

                for( nI=0;nI < data.length;nI++)
                {
                    var datacad = moment(data[nI].IMB_CLP_DATACADASTRO).format('DD/MM/YYYY');

                    var valorvenda=formatarBRSemSimbolo(  data[nI].IMB_CLP_VALVENFIM );
                    var valorlocacao=formatarBRSemSimbolo(  data[nI].IMB_CLP_VALLOCFIM );

                    linha =
                    '<tr>' +
                    '<td style="text-align:center valign="center">'+datacad+'</td>' +
                    '<td style="text-align:center valign="center">'+data[nI].IMB_TIM_DESCRICAO+'</td>' +
                    '<td style="text-align:center valign="center">'+valorvenda+'</td>' +
                    '<td style="text-align:center valign="center">'+valorlocacao+'</td>' +
                    '<td style="text-align:center valign="center">'+data[nI].IMB_IMV_FINALIDADE+'</td>' +
                    '<td style="text-align:center valign="center">'+data[nI].IMB_CLP_BAIRRO+'</td>' +
                    '<td style="text-align:center valign="center">'+data[nI].IMB_IMV_DORQUA+'</td>' +
                    '<td style="text-align:center valign="center">'+data[nI].IMB_IMV_SUIQUA+'</td>' +
                    '<td style="text-align:center valign="center">'+data[nI].IMB_IMV_GARAGEM+'</td>' +
                    '</tr>';
                $("#tableperfil").append( linha );
                }
            }
            });
        }

        function clienteAlterar()
        {
            $("#id").val( $("#i-codigo-cliente").val() );
            $("#readonly").val('N');
            $("#form-alt").submit();


        }

        function clienteAlterarGrid(id)
        {
            $("#id").val( id );
            $("#readonly").val('N');
            $("#form-alt").submit();


        }


        function preencherSelectUsuarios()
        {

            var empresa = "{{Auth::user()->IMB_IMB_ID}}";
            if( $("#id-corretoresativos").prop("checked")  )
                var url = "{{ route('atendente.cargaativos')}}"
            else
                var url = "{{ route('atendente.carga')}}/"+empresa;

            $.getJSON( url, function( data )
            {

                $("#i-select-corretor").empty();
                linha = '<option value="">Escolha o Corretor</option>';
                $("#i-select-corretor").append( linha );

                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].IMB_ATD_ID+'">'+
                        data[nI].IMB_ATD_NOME+"</option>";
                        $("#i-select-corretor").append( linha );
                }
            });

        }

        function limparCampos()
        {
            $("#i-id-cliente").val('');
            $("#i-nome").val('');
            $("#i-conjuge").val('');
            $("#i-cnpj").val('');
            $("#i-corretor").val('');
            $("#i-fone-cliente").val('');

        }
        function paginarAtendimento( id,pagina )
        {
            var url= "{{ route( 'atendimentos.cliente' ) }}/"+id+'/'+pagina;

            $.ajax(
            {
                url : url,
                type : 'get',
                success: function( data )
                {

                linha = "";
                    $("#tableatm>tbody").empty();

                    for( nI=0;nI < data.data.length;nI++)
                    {
                        var datacadastro     = moment( data.data[nI].IMB_CLA_DATACADASTRO).format('DD-MM-YYYY HH:mm');
                        var dataagendamento  = moment( data.data[nI].IMB_CLA_DATAATENDIMENTO).format('DD-MM-YYYY HH:mm');

                        if ( dataagendamento == null )
                        dataagendamento = '-';

                        if ( dataagendamento == 'Invalid date' )
                            dataagendamento = '-';

                        responsavel = data.data[nI].IMB_ATD_NOME;
                        if ( responsavel == null )
                           responsavel = '-';

                        linha =
                            '<tr>'+
                            '<td class="font-10px" style="text-align:center valign="center">'+data.data[nI].IMB_CLA_STATUS+'</td>' +
                            '<td class="font-10px" style="text-align:center valign="center">'+responsavel+'</td>' +
                            '<td class="font-10px" style="text-align:center valign="center">'+datacadastro+'</td>'+
                            '<td class="font-10px" style="text-align:center valign="center">'+dataagendamento+'</td>' +
                            '<td class="font-10px" style="text-align:center valign="center">'+data.data[nI].IMB_CLA_COMENTARIO+'</td>' +
                            '</tr>';
                        $("#tableatm").append( linha );
                    }
                }
            });

        }

        function alterarFone( id )
        {
            var url = "{{route('telefone.edit')}}/"+id;
            $.ajax(
                {
                    url         : url,
                    type        : 'get',
                    dataType    : 'json',
                    success     : function( data )
                    {
                        $("#i-alt-tlfid").val( data.IMB_TLF_ID);
                        $("#i-alt-dddtelefone").val( data.IMB_TLF_DDD);
                        $("#i-alt-numerotelefone").val( data.IMB_TLF_NUMERO);
                        $("#i-alt-tipotelefone").val( data.IMB_TLF_TIPOTELEFONE);
                        $("#modalalttelefone").modal( 'show');

                    }
                }
            )

        }

        function excluirFone( id )
        {
            var r = confirm("Confirma a Exclusão?");
            if (r != true)
                return false;

            url = "{{route('telefone.apagar')}}/"+id;



            $.ajax(
                {
                    url     : url,
                    dataType:'json',
                    type    : 'get',
                    async   : false,
                    success : function()
                    {
                        alert('Telefone excluído');
                        $("#modalalttelefone").modal( 'hide');
                        telefoneCarregar($("#i-codigo-cliente").val() );

                    },
                    error:function()
                    {
                        alert('erro ao excluir o fone');
                    },
                    done:function()
                    {
                        telefoneCarregar($("#i-codigo-cliente").val() );

                    }
                });

        }

        function ConfirmarAltFone()
        {

            if( $("#i-alt-dddtelefone").val() == '' )
            {
                alert('Necessário DDD');
                return false;
            }
            if( $("#i-alt-numerotelefone").val() == '' )
            {
                alert('Necessário Número Telefone');
                return false;
            }
            $.ajaxSetup(
            {
                headers:
                {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });

            url = "{{route('telefone.editsalvar')}}";

            dados =
            {
                IMB_TLF_ID : $("#i-alt-tlfid").val(),
                IMB_TLF_DDD : $("#i-alt-dddtelefone").val(),
                IMB_TLF_NUMERO : $("#i-alt-numerotelefone").val(),
                IMB_TLF_TIPOTELEFONE : $("#i-alt-tipotelefone").val(),
                IMB_TLF_ID_CLIENTE : $("#i-codigo-cliente").val(),

            }

            $.ajax(
                {
                    url             : url,
                    type            : 'post',
                    dataType        : 'json',
                    data            : dados,
                    async           : false,
                    success          : function()
                    {
                        alert('Gravado');
                        telefoneCarregar($("#i-codigo-cliente").val() );
                        $("#modalalttelefone").modal( 'hide');
                    }
                }
            );


        }

        function incluirTelefone()
        {
            $("#i-alt-tlfid").val('');
            $("#i-alt-dddtelefone").val( '');
            $("#i-alt-numerotelefone").val( '');
            $("#i-alt-tipotelefone").val( '');
            $("#modalalttelefone").modal( 'show');

        }

        function formataDataAlteracao(data, type, full, meta)
        {
            return '<div>'+moment( full.IMB_CLT_DTHALTERACAO).format('DD/MM/YYYY HH:mm')+'</div>';


        }

        function getFonesCliente( data )
        {
            var texto = "@php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ClientesTelefone', 'Visualizar Telefones de Clientes', 'CRM', 'Clientes','S', 'X', 'Botão')@endphp"+
            '<div class="{{$acesso}}">'+data+'</div>';
            return texto;


        }



    </script>
@endpush
