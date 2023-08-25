@extends("layout.app")
@section('scripttop')
<style>

input {
  border-style: solid;
  border-width: 2px;
  box-sizing: border-box;
}

label
{
    margin-bottom:0px;
}
.precos
{
    border-width: 0 0 1px;
    text-align: left;
    font-size: 16px;
    color:  rgb(5, 5, 80);
    font-weight: bold;
}


div.inset
{
    border-style: groove;
}
div.outset 
{
    border-style: groove;;
}



.row-top-menor {
    margin-bottom:-1px;
    margin-top:-1px;
}
.row-top-margin {
    margin-bottom:-1px;
    margin-top:-1px;
}

resultTable.dataTable tbody tr:hover {
    background-color: #ffa;
}
.fas.fa-tree  {
 font-size: 20px;
 color: green;
}

p {
 line-height: .5;
}
.fas.fa-car  {
 font-size: 20px;
 color: blue;
}

.fas.fa-bath  {
 font-size: 20px;
 color: black;
}

.fa.fa-bed  {
 font-size: 20px;
 color: black;
}

.fas.fa-store-alt  {
 font-size: 20px;
 color: black;
}

.fas.fa-swimmer  {
 font-size: 20px;
 color: brown;
}
.fas.fa-volleyball-ball  {
 font-size: 20px;
 color: brown;
}

.far.fa-futbol
{
 font-size: 20px;
 color: brown;
}

.fab.fa-odnoklassniki
{
 font-size: 20px;
 color: brown;
}


.fas.fa-solar-panel
{
 font-size: 20px;
 color: brown;
}


.fab.fa-accusoft
{
 font-size: 20px;
 color: red;
}

.fas.fa-arrows-alt
{
 font-size: 20px;
 color: red;
}

.far.fa-square
{
 font-size: 20px;
 color: red;
}

.fas.fa-retweet
{
 font-size: 20px;
 color: black;
}






.input-class-orignal{
  -moz-border-bottom-colors: none;
  -moz-border-left-colors: none;
  -moz-border-right-colors: none;
  -moz-border-top-colors: none;
  border-color: -moz-use-text-color -moz-use-text-color #ef8e80;
  border-image: none;
  border-style: none none dashed;
  border-width: 0 0 1px;
  color: #ef8e80;
  cursor: pointer;
  font-family: Gotham-Book;
  font-size: 18px;
  min-width: 60px;
    width:auto;
}


.input-class{
  -moz-border-bottom-colors: none;
  -moz-border-left-colors: none;
  -moz-border-right-colors: none;
  -moz-border-top-colors: none;
  border-color: -moz-use-text-color -moz-use-text-color #ef8e80;
  border-image: none;


  color: black;
  cursor: pointer;
  font-family: Gotham-Book;
  font-size: 18px;
  min-width: 50px;


}
#resultTable.dataTable tbody tr:hover > .sorting_1 {
  background-color: #ffa;
}

.overlay {
    height: 100%;
    width: 100%;
    position: absolute;
    top: 0px;
    left: 0px;
    z-index: 99999;
    background-color: gray;
    filter: alpha(opacity=75);
    -moz-opacity: 0.75;
    opacity: 0.75;
    display: none;
}
.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
  background-color: yellow;
}
.multiselect {
  width: 200px;
}

.div-right
{
    align:right;
}
.form-group {
  margin-bottom: 0.5;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}

.advertencia
{
    color:red;
    font-weight: bold;
    font-size: 14px;
}
.span-10
{
    color:red;
    font-size: 10px;
}

.span-7
{
    font-size: 8px;
}


table.dataTable tbody th, table.dataTable tbody td {
    height: 20px; /* e.g. change 8x to 4px here */
}

th, td{
    vertical-align: middle !important; /* alinha verticalmente */
    height: 30px; /* altura customizada da celula */
    padding: 0 16px !important; /* 0 de padding na vertical e 16px na horizontal */
}


.div-center
{
  text-align:center;
  font-size: 12px;

}

.div-center-puro
{
  text-align:center;
}
.div-left
{
  text-align:left;

}

        .img-album
        {
            width: 100%;
            height: 80px;
            border-radius: 50%;
        }
        .div-fundo-vermelho
{
    background-color: red;
    color:white;
    text-align:center;

}


.circulo-ativo {
    border-radius: 50%;
    display: inline-block;
    height: 20px;
    width: 20px;
    border: 1px solid #000000;
    background-color: green;
}

.circulo-inativo {
    border-radius: 50%;
    display: inline-block;
    height: 20px;
    width: 20px;
    border: 1px solid #000000;
    background-color: red;
}

.lbl-medidas {
  text-align: center;
  font-size: 14px;

}
.lbl-medidas-left {
  text-align: left;
  font-size: 14px;

}
.lbl-medidas-valores {
  text-align: center;
  font-size: 14px;
  font-weight: bold;
  color: #4682B4;
}

.alt-50perc
{
height: 50%;
}
.div-border-blue-center{
    border:solid 1px #4682B4;
    text-align: center;
}

.advertencia
{
    color:white;
    background:color:red;
    font-size: 20px;
    font-weight:bold;
}
.lbl-medidas-outrositens {
  text-align: left;
  font-size: 12px;
  color: #4682B4;
}

.cardtitulo {
  text-align: left;
  font-size: 16px;
  color: #80bfff;
  font-weight: bold;


}
.cardtitulo-center {
  text-align: center;
  font-size: 16px;
  color: #4682B4;
  font-weight: bold;

}

.info {
  text-align: left;
  font-size: 14px;
  color: #4682B4;
  font-weight: bold;

}

.lbl-medidas-left {
  text-align: left;
  font-size: 16px;
  font-weight: bold;

}

hr {
    height: 2px;
}

div .half-size-line
{
    line-height: 92%;
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

h4 {
  text-align: center;
}

h4-center-17 {
  text-align: center;
  font-size: 17px;
}

@media screen {
  #printSection {
      display: none;
      font-weight: bold;
  }
}

TH {
    text-align: center;
    width: 120px;
}
@media print {
  body * {
    visibility:hidden;
  }
  #printSection, #printSection * {
    visibility:visible;
  }
  #printSection {
    position:absolute;
    left:0;
    top:0;
  }
}

.td-hist
{
    font-size:10px;
}
.escondido {
  display: none;
}

.alugar
{
    color: green;
}

.alterar
{
    color: blue;
}

.clonar
{
    color: orange;
}

.bg-inativo
{
    background-color:#f5c9ce;
}

.bg-ativo
{
    background-color:#cbf2de;
}


.bg-white
{
    background-color:white;
}

</style>
<script src="{{asset('/global/plugins/sweetalert/sweetalert2.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('/global/plugins/sweetalert/sweetalert2.min.css')}}">

<style>

/* links: outlines and underscores */
</style>

<style>
/* panel */
.panel {margin-top: 25px;}
.panel .panel-heading { padding: 5px 5px 0 5px;}
.panel .nav-tabs {border-bottom: none;}

/* inactive tabs */
.nav > li > a				{  border-color: #dddddd; border-width: 1px }}
.nav > li > a:hover 		{ background-color: #eeeeee; color: #676767; border-color: #dddddd;}

/* active tabs */
.nav > li.active > a:hover 	{color: #222222;}

/* table */

/* buttons */
.btn-default.btn-outline:active,
.btn-default.btn-outline:focus,
.btn-default.btn-outline 		{ color: #676767; border-color: #676767; background-color: transparent; border-width: 2px; -webkit-transition: all 0.25s; -moz-transition: all 0.25s; transition: all 0.25s;}
.btn-default.btn-outline:hover 	{ color: #000000; border-color: #000000; background-color: transparent; border-width: 2px; -webkit-transition: all 0.75s; -moz-transition: all 0.75s; transition: all 0.75s; }


/* panel buttons */
.btn-group button.btn.btn-outline.btn-default 			{ background-color: #f5f5f5; color: #676767; border-color: #dddddd; border-width: 1px; padding: 5px 15px; line-height: 2; -webkit-transition: all 0.75s; -moz-transition: all 0.75s; transition: all 0.75s; }}
.btn-group button.btn.btn-outline.btn-default:focus		{ background-color: #f5f5f5;}
.btn-group button.btn.btn-outline.btn-default:active   	{ background-color: #f5f5f5;}
.btn-group button.btn.btn-outline.btn-default:hover 	{ background-color: #eeeeee; border-width: 1px; -webkit-transition: all 0.75s; -moz-transition: all 0.75s; transition: all 0.75s; }

.btn-outline.btn-highlight	{ color: #676767; border-color: #676767; background-color: transparent; border-width: 2px;}

.display-title { font family: verdana, arial, helvetica; color:#008400;}
.display-title-red { font family: verdana, arial, helvetica; color:red; font-size:14px}


ul.nav.nav-tabs li.btn-group.active > a.btn.btn-default
{
border: 1px solid #dddddd;
background-color: #ffffff;
border-right:0px;
margin-right: 0px;
border-bottom: 0px;
}

ul.nav.nav-tabs li.btn-group > a.btn.btn-default
{
border: 1px solid #F5F5F5;
border-right:0px;
margin-right: 0px;
border-bottom: 0px;
}

ul.nav.nav-tabs > li.btn-group.active > a.btn.dropdown-toggle
{
border: 1px solid #dddddd;
background-color: #ffffff;
margin-left: 0px;
border-left:0px;
border-bottom: 0px;

}

ul.nav.nav-tabs > li.btn-group > a.btn.dropdown-toggle
{
border: 1px solid #F5F5F5;
margin-left: 0px;
border-left: 0px;
border-bottom: 0px;
}

 ul.nav.nav-tabs li.btn-group a.btn.dropdown-toggle span.caret
{
color: #F5F5F5;
}

 ul.nav.nav-tabs li.btn-group.active > a.btn.dropdown-toggle > span.caret
{
color: #999999;
}


.cor-fundo-pesquisa
{
    background-color:#e9ebf0;
    margin-bottom:-1px;
    margin-top:-1px;
}
	</style>



<style>


</style>


@endsection
@section('content')
<div class="page-bar">
    @php  
    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Imovel', 'Imóveis(Acessar/Incluir/alterar/excluir)', 'CRM', 'Imóveis','S', 'I', 'Botão')
    @endphp

    <div class="col-md-12 div-center {{$acesso}}">
        <form action="{{route( 'imovel.add' )}}" method="get" target="_blank">
            <button type="submit" class="btn green pull-right" type="button" id="i-btn-novo">Novo Imóvel</button>
        </form>
    </div>

</div>

<div class="portlet cor-fundo-pesquisa bordered">
    <div class="portlet-body form">

        <form role="form" id="search-form">
        <!--<form role="form" action="{{ route('imovel.list')}}" method="get">-->
            <div class="form-body">
                <input type="hidden" id="IMB_IMB_IDMASTER" name="empresamaster" value="{{ Auth::User()->IMB_IMB_ID }}">
                <input type="hidden" id="i-unidade" name="agencia">
                <input type="hidden" id="i-tipolocacao" name="tipolocacao">
                <input type="hidden" id="i-tipo" name="tipoimovel">
                <input type="hidden" id="i-finalidade" name="finalidade">
                <input type="hidden" id="i-corretor" name="corretor">
                <input type="hidden" id="i-captador" name="captador">
                <input type="hidden" id="i-cadastradopor" name="cadastradopor">
                <input type="hidden" id="i-status" name="status" value = '5'>
                <input type="hidden" id="i-bairro" name="bairro">
<!--                <input type="hidden" id="i-condominio"  name="condominio">               -->
                <input type="hidden" id="i-imagemprincipal" name="imagemprincipal">
                <input type="hidden" id="i-usuario" value="{{Auth::user()->email}}">
                <input type="hidden" id="i-idusuario" value="{{Auth::user()->IMB_ATD_ID}}">
                <input type="hidden" id="i-sortitem" name="sortitem">
                <input type="hidden" id="i-ascdes" name="ascdes" value="asc">
                <input type="hidden" id="i-faixainicial" name="faixainicial">
                <input type="hidden" id="i-faixafinal" name="faixafinal">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2 escondido row-top-menor">
                            <div class="form-group">
                                <label for="js-select-unidade" class="control-label"><b>Unidade</b></label>
                                <select class="form-control" id="js-select-unidade">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 lbl-medidas-outrositens row-top-menor">
                            <label class="control-label">Campo de Busca Genérica por: Referência, Endereço ou Bairro</label>
                            <input class="form-control" type="text" id="i-pesquisagenerica"
                                    name="pesquisagenerica" value="{{session()->pull('imovelpesquisa')}}"
                                    placeholder="Busca rápida - Referência, bairro ou endereço">

                        </div>
                        <div class="col-md-2 row-top-menor">
                            <div class="form-group">
                                <label for="sel-tipo-locacao" class="control-label"><b>Tipo de Locação</b></label>
                                <select class="form-control" id="sel-tipo-locacao">
                                    <option value=""></option>
                                    <option value="Residencial">Residencial</option>
                                    <option value="Comercial">Comercial</option>
                                    <option value="Misto">Misto</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2 row-top-menor">
                            <div class="form-group">
                                <label for="referencia" class="control-label"><b>Referência</b></label>
                                <input type="text" class="form-control" name="referencia" value="{{session()->pull('imovelpesquisa')}}"
                                    placeholder="Ex.: CA0003" id="i-referencia">
                            </div>
                        </div>
                        <div class="col-md-1 row-top-menor">
                            <div class="form-group">
                                <label for="id_completus"><b>Cód Interno</b></label>
                                <input type="text" class="form-control" name="id_completus" id="i-idcompletus">
                            </div>
                        </div>
                        <div class="col-md-3 row-top-menor">
                            <div class="form-group">
                                <label class="control-label"><b>Selecione o Tipo</b><br></label>
                                <select id="i-select-tipo" multiple class="form-control escondido" placeholder="Pesquise" >
                                    @foreach( $tipos as $tipo)
                                    <option value="{{$tipo->IMB_TIM_ID}}">{{$tipo->IMB_TIM_DESCRICAO}}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>
                    </div>
                </div>
                
                

                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2 row-top-menor">
                            <div class="form-group">
                                <label  class="control-label"><b>Finalidade</b></label>
                                <select class="form-control" id='i-select-finalidade'>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2 row-top-menor">
                            <div class="form-group">
                                <label class="control-label " for="pre-faixainicial"><b>Faixa de</b></label>
                                <input type="text" class="form-control input-class valor valores-direita" name="pre-faixainicial"
                                placeholder="De R$" id="i-pre-faixainicial"
                                onkeypress="return isNumber(event)" onpaste="return false;">
                            </div>
                        </div>

                        <div class="col-md-2 row-top-menor">
                            <div class="form-group">
                                <label class="control-label" for="pre-faixafinal"><b>Até</b></label>
                                <input type="text" class="form-control input-class   valor   valores-direita" name="pre-faixafinal"
                                placeholder="De R$" id="i-pre-faixafinal"
                                onkeypress="return isNumber(event)" onpaste="return false;">
                            </div>
                        </div>

                        <div class="col-md-3 row-top-menor">
                            <div class="form-group">
                                <label class="control-label" for="endereco"><b>Endereco</b></label>
                                <input type="text" class="form-control" name="endereco"
                                placeholder="Sugestão: coloque parte do endereço" id="i-endereco">
                            </div>
                        </div>
                        <div class="col-md-3 row-top-menor">
                        <div class="form-group">
                            <label class="control-label"><b>Selecione o Bairro</b></label>

                            <select id="i-select-bairro" multiple class="form-control escondido" placeholder="Pesquise" >
                                @foreach( $bairros as $bairro)
                                <option value="{{$bairro->CEP_BAI_NOME}}">{{$bairro->CEP_BAI_NOME}}({{$bairro->IMB_IMV_CIDADE}})</option>
                                @endforeach
                            </select>
    
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="col-md-3 row-top-menor">
                            <div class="form-group">
                                <label class="control-label"><b>Condomínio</b></label>
                                <input type="text" class="form-control"  name="condominio" id="i-nome-condominio">
                            </div>
                        </div>
                        <div class="col-md-3 row-top-menor">
                            <div class="form-group">
                                <label for="cidade"><b>Cidade</b></label>
                                <input type="text" class="form-control"
                                name="cidade" id="i-cidade" placeholder="Sugestão: parte do nome">
                            </div>
                        </div>

                        <div class="col-md-1 row-top-menor">
                            <div class="form-group">
                                <label class="control-label" for="dormitorio"><b>Dorm.</b></label>
                                <input type="text" class="form-control" name="dormitorio"
                                    id="i-dormitorio"
                                    onkeypress="return isNumber(event)" onpaste="return false;">
                            </div>
                        </div>
                        <div class="col-md-1 row-top-menor">
                            <div class="form-group">
                                <label class="control-label" for="suite"><b>Suítes</b></label>
                                <input type="text" class="form-control"
                                    id="i-suite" name="suite"
                                    onkeypress="return isNumber(event)" onpaste="return false;">
                            </div>
                        </div>
                        <div class="col-md-2 row-top-menor">
                            <div class="form-group">
                                <label class="control-label"><b>Status</b></label>
                                <select id="i-select-status" multiple class="form-control escondido" placeholder="Pesquise" >
                                    @foreach( $status as $statu)
                                    <option value="{{$statu->VIS_STA_ID}}">{{$statu->VIS_STA_NOME}}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>
                        <div class="col-md-1 row-top-menor div-right">
                            <button class="btn blue btn-lg glyphicon glyphicon-search form-control" id='search-form'></button>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-danger pull-right" type="button" id="btn-limpar"
                            onClick="limparCampos()">Limpar Filtro</button>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="portlet box blue" >
                    <div class="row">

                    </div>

                    <div class="portlet-title">
                        <div class="caption">
                            <div class="col-md-6 row-top-menor">
                                <select class="form-control" id="i-select-sortitem">
                                    <option value="">Classificação</option>
                                    <option value="Bairro">Bairro</option>
                                    <option value="Cidade">Cidade</option>
                                    <option value="dataatualizacao">Data de Atualização</option>
                                    <option value="datacadastro">Data de Cadastro</option>
                                    <option value="precolocacao">Preço Locação</option>
                                    <option value="precovenda">Preço Venda</option>
                                    <option value="dormitorios">Dormitórios</option>
                                    <option value="suites">Suítes</option>
                                </select>
                            </div>
                            <div class="col-md-5 row-top-menor">
                                <select class="form-control" id="i-select-ascdes">
                                    <option value="asc">Ascendente</option>
                                    <option value="desc">Descendente</option>
                                </select>
                            </div>
                        </div>
                        <div class="tools" id="i-maisfiltros" >
                            <a href="javascript:;" class="expand" title="Mais Filtros"> </a>
                        </div>
                    </div>

                    <div class="portlet-body form" id="i-panmaisfiltros" style="display:none">
                        <label id="i-t"></label>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tipo" class="control-label">Corretor</label>
    		    				    <select class="form-control" id="i-select-corretor" >
							        </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="captador" class="control-label">Captador</label>
    		    				    <select class="form-control" id="i-select-captador" >
							        </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="proprietario">Proprietário</label>
                                    <input type="text" class="form-control"
                                    name="proprietario" id="i-proprietario"
                                        placeholder="Sugestão: parte do nome proprietário">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <label>
                                    <input type="checkbox" name="IMB_IMV_FINANC"
                                    data-checkbox="icheckbox_flat-blue" id="i-chk-financiamento" name="chkfinancliamento">
                                        Aceita Financ.
                                </label>
                            </div>

                            <div class="col-md-2">
                                <label>
                                    <input type="checkbox" name="IMB_IMV_PERMUT"
                                    data-checkbox="icheckbox_flat-blue" id="i-chk-permuta" name="chkpemuta">
                                        Aceita Permuta
                                </label>
                            </div>

                            <div class="col-md-1">
                                <label>
                                    <input type="checkbox" name="IMB_IMV_WEBIMOVEL"
                                        data-checkbox="icheckbox_flat-blue" id="i-chk-site" name="chksite">
                                        Site
                                </label>
                            </div>

                            <div class="col-md-1">
                                <label>
                                    <input type="checkbox" name="IMB_IMV_PLACA" class="icheck"
                                        data-checkbox="icheckbox_flat-blue" id="i-chk-placa">
                                        Placa
                                </label>
                            </div>

                            <div class="col-md-2">
                                <label>
                                    <input type="checkbox" name="EMCONDOMINIO" class="icheck"
                                    data-checkbox="icheckbox_flat-blue" id="i-chk-condominio">
                                    Cond Fechado
                                </label>
                            </div>

                            <div class="col-md-2">
                                <label>
                                    <input type="checkbox" name="IMB_IMV_PISCIN" class="icheck"
                                        id="i-chk-piscina" data-checkbox="icheckbox_flat-blue">
                                        Piscina
                                </label>
                            </div>

                            <div class="col-md-2">
                                <label>
                                    <input type="checkbox" name="IMB_IMV_CHURRA" class="icheck"
                                            data-checkbox="icheckbox_flat-blue" id="i-chk-churrasqueira">
                                    Churrasqueira
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="atuinicial">Atualizado</label>
                                    <input type="text" class="form-control" name="atuadatainicial"
                                    placeholder="Desde dd/mm/yyyy" id="i-atualizado-ini">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="atuinicial">&nbsp;</label>
                                    <input type="text" class="form-control"
                                        name="atuadatafinal" placeholder="Ate dd/mm/yyyy" id="i-atualizado-fim">
                                </div>
                            </div>

                            <div class="col-md-2">
                            </div>

                            <div class="col-md-2">
                                <div class="orm-group">
                                    <label for="atuinicial">Cadastrado</label>
                                    <input type="date" class="form-control " name="caddatainicial" id="i-cadastrado-ini"
                                        placeholder="Desde dd/mm/yyyy">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="atuinicial">&nbsp;</label>
                                    <input type="date" class="form-control " name="caddatafinal" id="i-cadastrado-fim"
                                        placeholder="Ate dd/mm/yyyy">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="tipo" class="control-label">Cadastrado por</label>
    		    				    <select class="form-control" id="i-select-cadastrado" >
							        </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--<hr style="margin-top: 40px;" />-->
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover"  id="resultTable">
                <thead style="display: none;">
                        <th width="100"></th>
                    </thead>
                </table>
            </div>

        </div>
            <nav class="quick-nav">
                <a class="quick-nav-trigger" href="#0">
                    <span aria-hidden="true"></span>
                </a>
                <ul>
                    <li>
                        <a href="{{route('saidachaves.saida')}}" target="_blank">
                            <span>Saida de Chaves aos Selecionados</span>
                            <i class="icon-book-open"></i>
                        </a>
                    </li>
                </ul>
                <span aria-hidden="true" class="quick-nav-bg"></span>
            </nav>
            <div class="quick-nav-overlay"></div>

    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="i-modal-img-grande">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



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

<div class="modal fade" id="modalimoveisselecionados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Seleção de Imóveis para o Atendimento</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <table  id="tblimoveiselecionados" class="table table-striped table-bordered table-hover" >
                    <thead class="thead-dark">
                      <tr >
                        <th width="40" style="text-align:center"> Código </th>
                        <th width="150" style="text-align:center"> Referência</th>
                        <th width="700" style="text-align:center"> Endereço </th>
                        <th width="100" style="text-align:center"> Chaves </th>
                        <th width="100" style="text-align:center"> Ações </th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class="table-footer" >
                    <a  class="btn btn-sm btn-primary"
                        role="button" onClick="mostrarSelecionados()" >
                        Atualizar</a>
                    <a  class="btn btn-sm btn-primary"
                        role="button" onClick="" >
                        Continuar com Atendimento</a>
                                <!--data-toggle="modal" data-target="#modalFormaPagamento"-->
                </div>
            </div>
        </div>
    </div>
</div>


@include("layout.modaldadosimovel")

<div class="modal" tabindex="-1" role="dialog" id="modalstatus">
    <div class="modal-dialog" style="width:30%;" role="document">
        <div class="modal-content">
            <div class="modal-header div-fundo-vermelho">Troca de Status do Imóvel
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" id="i-div-mudar-status">
                        <label class="label-control" >Mudar Status Para
                            <select class="form-control" id="i-statustrocar">
                                <option value="-1">Mudar Para</option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onClick="confirmarStatus()">Confirmar Troca</button>
                <button type="button" class="btn btn-secondary" onClick="cancelarTrocaStatus()">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modalfichaimovel">
    <div class="modal-dialog" style="width:20%"; role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-3 div-center">Ficha Completa
                            <a href="javascript:fichaCompleta();"> <img src="{{asset('global/img/fichacompleta.png')}}" alt="ficha"></a>
                        </div>
                        <div class="col-md-2 div-center" >
                            -
                        </div>
                        <div class="col-md-3 div-center">
                            <label>Ficha Simples
                                <a href="javascript:fichaSimples();"> <img src="{{asset('global/img/fichasimples.png')}}" alt="ficha"></a>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer div-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDadosImobiliaria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Dados do Parceiro</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <h5 id="i-nome-imobiliaria"></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 H5">
                        <h5 id="i-telefone-imobiliaria"></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 H5">
                        <h5 id="i-site-imobiliaria"></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 H5">
                        <h5 id="i-email-imobiliaria"></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<form style="display: none" action="{{route('imovel.edit')}}" method="POST" id="form-alt"  target="_blank">
@csrf
    <input type="hidden" id="id" name="id" />
    <input type="hidden" id="readonly" name="readonly"/>
</form>


<form style="display: none" action="{{route('contrato.novo')}}" method="POST" id="form-novocontrato">
@csrf
    <input type="hidden" id="idimovelcontrato" name="idimovel" />
</form>

<form style="display: none" action="{{route('ficha.imovel')}}" method="POST" id="form-fichaimovel"  target="_blank">>
@csrf
    <input type="hidden" id="idimovelficha" name="idimovel" />
    <input type="hidden" id="tipoficha" name="tipo" />
</form>




@endsection
@push('script')
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-timepicker-addon.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>

<script>


$(document).ready(function() {
    $(".alt-imv").hide();

    $('#div-linksite').click(function(){
        //Visto que o 'copy' copia o texto que estiver selecionado, talvez você queira colocar seu valor em um txt escondido
        $('#idtextolink').select();
        try {
            var ok = document.execCommand('copy');
            if (ok) { alert('Texto copiado para a área de transferência'); }
            } catch (e) {
            alert(e)
        }
    });

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

    $( "#tabs" ).tabs();

    $('[data-toggle="tooltip"]').tooltip();

    $("#sirius-menu").click();

    $("#h-historico").click( function()
    {
        cargaHistorico( $("#i-codigo-imovel").val() );
    });
    $('#i-select-bairro').multiselect(
    {
        nonSelectedText: 'Selecione Bairro',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth:'330px'
        });


        $('#i-select-condominio').multiselect(
    {
        nonSelectedText: 'Selecione condomínio',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth:'300px'
        });

        $('#i-select-tipo').multiselect(
    {
        nonSelectedText: 'Selecione Tipo',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth:'330px'
        });

    $('#i-select-status').multiselect(
    {
        nonSelectedText: 'Selecione ',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth:'170px'
        });



    $.datepicker.regional['br'] = {
        closeText: 'ok',
        prevText: 'Anterior',
        nextText: 'Próximo',
        currentText: 'corrent',
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho',
        'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun',
        'Jul','Ago','Set','Out','Nov','Dez'],
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        dayNamesShort: ['D','S','T','Q','Q','S', 'S'],
        dayNamesMin:  ['D','S','T','Q','Q','S', 'S'],
        weekHeader: 'wh',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
	};

	$.datepicker.setDefaults($.datepicker.regional['br']);

	$('.dpicker').datetimepicker(
    {
        timeFormat: 'hh:mm',
        timeOnlyTitle: 'timeonly',
        timeText: 'Horário',
        hourText: 'Hora',
        minuteText: 'Minuto',
        secondText: 'Segundo',
        currentText: 'Agora',
        closeText: 'Sair',
        format: 'DD-MM-YYYY',
        minView: 2,
        showTimepicker: false
    });


    limparCampos();

    console.log('generica '+$("#i-pesquisagenerica").val() );


    });

    //    document.getElementById("myText").disabled = true;
    $( "#js-select-unidade" ).change(function() {
        var nUnidade = $('#js-select-unidade').val();
        $("#i-unidade").val( nUnidade);
});

$( "#i-select-tipo" ).change(function() {
        var nTipo = $('#i-select-tipo').val();
        $("#i-tipo").val( nTipo);
    });


    $('#i-pre-faixafinal').blur(function(event)
    {
        var valor =  parseFloat( realToDolar( $("#i-pre-faixafinal").val() ) );

        $("#i-faixafinal").val(  valor );

    });

    $('#i-pre-faixainicial').blur(function(event)
    {
        var valor =  parseFloat( realToDolar( $("#i-pre-faixainicial").val() ) );

        $("#i-faixainicial").val(  valor );

    });




    $( "#i-select-ascdes" ).change(function()
    {
        var csort = $('#i-select-ascdes').val();
        $("#i-ascdes").val( csort);

        table.clear();
        table.draw();
        e.preventDefault();
    });

    $( "#i-select-sortitem" ).change(function()
    {
        var csort = $('#i-select-sortitem').val();
        $("#i-sortitem").val( csort);

        table.clear();
        table.draw();
        e.preventDefault();
    });

    $( "#i-select-finalidade" ).change(function() {
        var cFinalidade = $('#i-select-finalidade').val();
        $("#i-finalidade").val( cFinalidade);
    });

    $( "#sel-tipo-locacao" ).change(function() {
        var cTipoLocacao = $('#sel-tipo-locacao').val();
        $("#i-tipolocacao").val( cTipoLocacao);
    });

    $( "#i-select-corretor" ).change(function() {
        var cCorretor = $('#i-select-corretor').val();
        $("#i-corretor").val( cCorretor );
    });

    $( "#i-select-captador" ).change(function() {
        var cCaptador = $('#i-select-captador').val();
        $("#i-captador").val( cCaptador);
    });

    $( "#i-select-cadastrado" ).change(function() {
        var cCad = $('#i-select-cadastrado').val();
        $("#i-cadastradopor").val( cCad);
    });


    $( "#i-select-status" ).change(function() {
        var status = $('#i-select-status').val();
        $("#i-status").val( status );
    });
    $( "#i-select-bairro" ).change(function() {
        var bairros = $('#i-select-bairro').val();
        $("#i-bairro").val( bairros );

    });




</script>
<script type="text/javascript">



var rows_selected = [];
var table = $('#resultTable').DataTable(
{
    "pageLength": 20,
    "bLengthChange": false,
    //"lengthChange": true,
    "language":
    {
        "sEmptyTable": "Nenhum registro encontrado",
        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        sLoadingRecords: '<div class="overlay"><img src="{{asset('/layouts/layout/img/loader.gif')}}"/></div>',
        sProcessing: '<div class="overlay"><img src="{{asset('/layouts/layout/img/loader.gif')}}"/></div>',
        "sZeroRecords": "Nenhum registro encontrado",
        "scrollY": "300px",
        "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
    }
},
bSort : false ,
processing: true,
serverSide: true,
ajax:
{
    url:"{{ route('imovel.list') }}",
    data: function (d)
    {
        d.id_completus  = $('input[name=id_completus]').val();
        d.referencia    = $('input[name=referencia]').val();
        d.endereco      = $('input[name=endereco]').val();
        d.bairro        = $('input[name=bairro]').val();
        d.cidade        = $('input[name=cidade]').val();
        d.dormitorio    = $('input[name=dormitorio]').val();
        d.suite         = $('input[name=suite]').val();
        d.agencia       = $('input[name=agencia]').val();
        d.tipoimovel    = $('input[name=tipoimovel]').val();
        d.finalidade    = $('input[name=finalidade]').val();
        d.faixainicial  = $('input[name=faixainicial]').val();
        d.faixafinal    = $('input[name=faixafinal]').val();
        d.tipolocacao    = $('input[name=tipolocacao]').val();
        //d.condominio    = $('input[name=condominio]').val();
        d.proprietario  = $('input[name=proprietario]').val();
        d.corretor      = $('input[name=corretor]').val();
        d.captador      = $('input[name=captador]').val();
        d.cadastradopor  = $('input[name=cadastradopor]').val();
        d.empresamaster = $('input[name=empresamaster]').val();
        d.status        = $('input[name=status]').val();
        d.caddatainicial= $('input[name=caddatainicial]').val();
        d.caddatafinal  = $('input[name=caddatafinal]').val();
        d.pesquisagenerica = $('input[name=pesquisagenerica]').val();
        d.sortitem          = $('input[name=sortitem]').val();
        d.ascdes          = $('input[name=ascdes]').val();
        d.condominio      = $('input[name=condominio]').val();

        d.radar         = $('input[name=radar]').prop('checked') ? 'S' : 'N';
    }
},
columns:
[
    {
        "data": 'ENDERECOCOMPLETO', render: getInformacoes
    },
],
"columnDefs":
[
    {
        'targets': 0,
        'searchable': false,
        'orderable': false,
        'className': 'dt-body-center',
        'render': function (data, type, full, meta)
        {
            return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
        }
    },
],
'rowCallback': function(row, data, dataIndex)
{

    var rowId = data[0];
    if($.inArray(rowId, rows_selected) !== -1)
    {
        $(row).find('input[type="checkbox"]').prop('checked', true);
        $(row).addClass('selected');
    }
},
searching: false
});

        $('#search-form').click( function()
        {
            var bairro =  $('#i-select-bairro').val()+'' ;
            var condominio =  $('#i-select-condominio').val()+'' ;
            var tipo =  $('#i-select-tipo').val()+'' ;
            var status =  $('#i-select-status').val()+'' ;



            if ( bairro != '' )
                bairro = bairro.split( ',')

            $("#i-bairro").val( bairro );

/*
            if ( condominio != '' )
                condominio = condominio.split( ',')
*/


            $("#i-condominio").val( condominio );

            if ( tipo != '' )
                tipo = tipo.split( ',')

            $("#i-tipo").val( tipo );

            if ( status != '' )
            status = status.split( ',')

            $("#i-status").val( status );

        })

        $('#search-form').on('submit', function(e) {

            var ref = $("#i-referencia").val();
            ref = ref.replace( '-','');
            $("#i-referencia").val( ref );

            if( $("#i-faixainicial").val() != 0 && $("#i-select-finalidade").val() =='T' )
            {
                alert('Você informou uma faixa de valor, mas não informou ainda se deseja VENDA ou LOCAÇÃO!');
                return false;
            }

            table.clear();
            table.draw();
            e.preventDefault();
            $("#i-pesquisagenerica").val('');
        });




/*
        $('#resultTable tbody').on( 'click', '.i-btn-alugar', function () {
            var data = table.row( $(this).parents('tr') ).data();
                $("#idimovelcontrato").val( data.IMB_IMV_ID );
                $("#form-novocontrato").submit();
        });
*/
        $('#resultTable tbody').on( 'click', '.i-btn-selecionar', function () {
            var data = table.row( $(this).parents('tr') ).data();
            selecionarImovel( data.IMB_IMV_ID );

        });






        $('#i-maisfiltros').on( 'click', function () {
            $('#i-maisfiltros').show();
        });


        $('#resultTable tbody').on( 'click', '.alt-imv', function ()
        {
                var data = table.row( $(this).parents('tr') ).data();
                $("#id").val( data.IMB_IMV_ID );
                $("#form-alt").submit();
                //window.location = "{{ route('imovel.edit') }}/" + data.IMB_IMV_ID;
        });


        function preencherUnidades()
        {

            $.getJSON( "{{ route('imobiliaria.carga')}}/"+$("#IMB_IMB_IDMASTER").val(), function( data )
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

                $("#js-select-unidade").val( $("#IMB_IMB_IDMASTER").val());

            });

        }

        function preencherFinalidade()
        {
            $("#i-select-finalidade").empty();
            linha = '<option value="T">Finalidade</option>';
            $("#i-select-finalidade").append( linha );
            linha = '<option value="V">Venda</option>';
            $("#i-select-finalidade").append( linha );
            linha = '<option value="L">Locação</option>';
            $("#i-select-finalidade").append( linha );
        }

        function preencherTipoImovel()
        {

            var url = "{{ route('tipoimovel.carga')}}";
            $.getJSON( url, function( data )
            {
                $("#i-select-tipo").empty();
                linha = '<option value="0">Escolha o Tipo de Imóvel</option>';
                $("#i-select-tipo").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].IMB_TIM_ID+'">'+
                        data[nI].IMB_TIM_DESCRICAO+"</option>";
                        $("#i-select-tipo").append( linha );

                }

            });

        }


        function preencherSelectUsuarios()
        {
            var empresa = $("#I-IMB_IMB_IDMASTER").val();
            var url = "{{ route('atendente.carga')}}";

            $.getJSON( url+"/"+empresa, function( data )
            {

                $("#i-select-cadastrado").empty();
                linha = '<option value="0">Escolha quem cadastrou</option>';
                $("#i-select-cadastrado").append( linha );

                $("#i-select-corretor").empty();
                linha = '<option value="0">Escolha o Corretor</option>';
                $("#i-select-corretor").append( linha );


                $("#i-select-captador").empty();
                linha = '<option value="0">Escolha o Captador</option>';
                $("#i-select-captador").append( linha );

                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].IMB_ATD_ID+'">'+
                        data[nI].IMB_ATD_NOME+"</option>";
                        $("#i-select-cadastrado").append( linha );
                    linha =
                    '<option value="'+data[nI].IMB_ATD_ID+'">'+
                        data[nI].IMB_ATD_NOME+"</option>";
                        $("#i-select-corretor").append( linha );
                    linha =
                    '<option value="'+data[nI].IMB_ATD_ID+'">'+
                        data[nI].IMB_ATD_NOME+"</option>";
                        $("#i-select-captador").append( linha );
                }
            });

        }
        function preencherStatus()
        {


            var url = "{{ route('status.carga')}}/0";
            console.log( 'url status '+url);
            $.getJSON( url, function( data )
            {
                $("#i-select-status").empty();
                linha = '<option value="0">Todos</option>';
                $("#i-select-status").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].VIS_STA_ID+'">'+
                        data[nI].VIS_STA_NOME+"</option>";
                        $("#i-select-status").append( linha );
                }

            });

        }

        function limparCampos( )
        {

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
            preencherStatus();
            preencherSelectUsuarios();


            $("#i-idcompletus").val('');
            $("#i-pesquisagenerica").val('');
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
            $("#i-select-cadastrado").val('');
            $("#i-select-corretor").val('');
            $("#i-select-captador").val('');
            $("#i-nome-condominio").val('');
            $("#i-corretor").val('');
            $("#i-captador").val('');

            $("#i-select-tipo").multiselect("clearSelection");
            $("#i-select-tipo").multiselect( 'refresh' );

            $("#i-select-condominio").multiselect("clearSelection");
            $("#i-select-condominio").multiselect( 'refresh' );

            $("#i-select-bairro").multiselect("clearSelection");
            $("#i-select-bairro").multiselect( 'refresh' );

            $("#i-select-status").multiselect("clearSelection");
            $("#i-select-status").multiselect( 'refresh' );





        }


        function desabilitarCampos( )
        {

            document.getElementById( 'i-chk-site').disabled = true;
            document.getElementById( 'i-chk-piscina').disabled = true;
            document.getElementById( 'i-chk-churrasqueira').disabled = true;
            document.getElementById( 'i-chk-placa').disabled = true;
            document.getElementById( 'i-chk-condominio').disabled = true;

            document.getElementById( 'i-idcompletus').disabled = true;
            document.getElementById( 'i-faixainicial').disabled = true;
            document.getElementById( 'i-faixafinal').disabled = true;
            document.getElementById( 'i-endereco').disabled = true;
            document.getElementById( 'i-condominio').disabled = true;
            document.getElementById( 'i-bairro').disabled = true;
            document.getElementById( 'i-cidade').disabled = true;
            document.getElementById( 'i-dormitorio').disabled = true;
            document.getElementById( 'i-suite').disabled = true;
            document.getElementById( 'i-proprietario').disabled = true;
            document.getElementById( 'i-cadastrado-ini').disabled = true;
            document.getElementById( 'i-cadastrado-fim').disabled = true;
            document.getElementById( 'i-atualizado-ini').disabled = true;
            document.getElementById( 'i-atualizado-fim').disabled = true;
            document.getElementById( 'i-select-corretor').disabled = true;
            document.getElementById( 'js-select-unidade').disabled = true;
            document.getElementById( 'i-select-tipo').disabled = true;




        }


        preencherSelectUsuarios();

        $("#btnPrint").click(function()
                {
                printElement(document.getElementById("printThis"));
                });

function printElement(elem) {
    var domClone = elem.cloneNode(true);

    var $printSection = document.getElementById("printSection");

    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }

    $printSection.innerHTML = "";
    $printSection.appendChild(domClone);
    window.print();
}

function mostrarImagem( id )
{

    window.open( "{{ route( 'imagem')}}/"+id,'janela');

}




function CarregarImagens()
    {
        str = $("#i-imovel").val();
        $.getJSON( "{{ route( 'imagens.imoveis')}}/"+str, function( data)
        {
            linha = "";
            $("#tblimagens>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                var nome = data[nI].IMB_IMG_NOME;
                if( nome == null)
                    nome = "";

                    var detalhes ='<ul class="display:inline">';

                var capa= data[nI].IMB_IMG_CAPA;
                if( capa == 'S')
                    detalhes = detalhes +'<li>Capa</li>';

                var principal= data[nI].IMB_IMG_CAPA;
                if( principal == 'S')
                detalhes = detalhes +'<li>Imagem Principal</li>';

                var naoirprosite= data[nI].IMB_IMG_NAOIRPROSITE;
                if( naoirprosite == 'S')
                    detalhes = detalhes +'<li>Não ir pro Site</li>';
                    naoirprosite = 'Fora do Site';

                detalhes = detalhes +'</ul>';

                var idimg = data[nI].IMB_IMG_ID;
                var imimg = data[nI].IMB_IMV_ID;
                var arquivo = data[nI].IMB_IMG_ARQUIVO

                linha =
                        '<tr>'+
                        '<td align="left"><a href=javascript:mostrarImagem('+idimg+') ><img src="{{url('')}}/storage/images/'+$("#I-IMB_IMB_IDMASTER").val()+'/imoveis/thumb/'+imimg+'/100_75'+arquivo+'">'+
                        '</a> </td>'+
//                        '<td style="text-align:center" valign="center"> '+
//                            '<a href=javascript:editarImagem('+data[nI].IMB_IMG_ID+') class="btn btn-sm btn-primary">Editar</a> '+
//                            '<a href=javascript:apagarImagem('+data[nI].IMB_IMG_ID+') class="btn btn-sm btn-danger">Excluir</a> ';
                        '<td align="center" >'+nome+'</td>' +
                        '<td align="center" >'+detalhes+'</td>' ;

                if( data[nI].IMB_IMG_PRINCIPAL !='S')
                    linha = linha +
                            '<a class="btn btn-sm btn-success"></a> '+
                            '</td> ';
                else
                    linha = linha +
                    '<a class="btn btn-sm btn-success">Principal</a> '+
                            '</td> ';
                    linha = linha +
                        '</tr>';

                $("#tblimagens").append( linha );

            }

        });

    }


    function carregarCapImo( id, callback )
    {

        var url = "{{ route('capimo.carga') }}/"+id;
        $.getJSON( url, function( data)
            {
                var captadores ='';
                for( nI=0;nI < data.length;nI++)
                {
                    captadores = captadores + data[nI].IMB_ATD_NOME+'&nbsp;&nbsp;&nbsp;&nbsp;';
                }
                callback( captadores )

            })
    }


    function getImg(data, type, full, meta) {

        texto = '';
        if( data != null )
        {

            texto =
            '<div class="row">'+
            '   <div class="col-md-12 info">'+
            '      <div class="col-md-4 cardtitulo">'+
            '          <a href="javascript:mostrarImovelModal('+full.IMB_IMV_ID+')";></label>'+full.IMB_IMV_REFERE+'</label></a>'+
            '      </div>'+
            '      <div class="col-md-2"></div>';
            if( full.VIS_STA_SITUACAO == 'I')
                texto = texto +
                   '<div class="col-md-2 circulo-inativo" title="'+full.VIS_STA_NOME+'"></div> '
            else
                texto = texto +
                   '<div class="col-md-2 circulo-ativo" title="'+full.VIS_STA_NOME+'"></div>';
            texto = texto +
            '   </div>'+
            '</div>';

            texto = texto +
            '<div class="row">'+
            '   <div class="col-md-12 div-center">'+
            '     <a href="javascript:carrousel( '+full.IMB_IMV_ID+')"><img class="img" style="display:block;" width="200" height="150" src="{{url('')}}/storage/images/'+full.IMB_IMB_ID+'/imoveis/'+full.IMB_IMV_ID+'/'+data+'" data-toggle="tooltip" title="Ver no album de fotos"></a>'+
            '   </div>'+
            '</div>';

            texto = texto +
            '<div class="row">'+
            '   <div class="col-md-12 lbl-medidas-left">'+
            '       <button class="btn btn-circle glyphicon glyphicon-shopping-cart pull-left i-btn-selecionar" data-toggle="tooltip" title="Selecionar este imóvel"></button>'+
            '       <button class="btn btn-circle fa fa-envelope-open pull-left" onClick="enviarPorEmail('+full.IMB_IMV_ID+');"  data-toggle="tooltip" title="Enviar por Email"></button>'+
            '       <a title="Aplicar Marca d\'água" class="btn btn-warning" href="javascript:marcaDagua('+ full.IMB_IMV_ID+')"><label class="span-7">Aplicar</label></a>'+
            '   </div>'+
            '</div>';
/*            texto = texto +
            '<div class="row">'+
            '   <div class="col-md-12 lbl-medidas-left">'+
            'Local Chaves: '+localchaves+
            '   </div>'+
            '</div>';
*/

        }
        else
        {
            texto =
            '<div class="row">'+
            '   <div class="col-md-12 info">'+
            '      <div class="col-md-4 cardtitulo outset">'+
            '          <a href="javascript:mostrarImovelModal('+full.IMB_IMV_ID+')";></label>'+full.IMB_IMV_REFERE+'</label></a>'+
            '      </div>'+
            '      <div class="col-md-2"></div>';
            if( full.VIS_STA_SITUACAO == 'I')
                texto = texto +
                   '<div class="col-md-2 circulo-inativo" title="'+full.VIS_STA_NOME+'"></div> '
            else
                texto = texto +
                   '<div class="col-md-2 circulo-ativo" title="'+full.VIS_STA_NOME+'"></div>';
            texto = texto +
            '   </div>'+
            '</div>';

            texto = texto +
            '<div class="row">'+
            '   <div class="col-md-12 div-center">'+
            '     <a href="javascript:carrousel( '+full.IMB_IMV_ID+')"><img style="display:block;" width="200" height="150" src="{{url('')}}/storage/images/'+full.IMB_IMB_ID+'/logos/logo_180_135_semimagem.jpg" data-toggle="tooltip" title="Ver no album de fotos"></a>'+
            '   </div>'+
            '</div>';

            texto = texto +
            '<div class="row">'+
            '   <div class="col-md-12 lbl-medidas-left">'+
            '       <button class="btn btn-circle glyphicon glyphicon-shopping-cart pull-left i-btn-selecionar" data-toggle="tooltip" title="Selecionar este imóvel"></button>'+
            '       <button class="btn btn-circle fa fa-envelope-open pull-left" onClick="enviarPorEmail('+full.IMB_IMV_ID+');"  data-toggle="tooltip" title="Enviar por Email"></button>'+
            '       <a class="btn btn-warning" href="javascript:marcaDagua('+ full.IMB_IMV_ID+')">Marca d`agua</a>'+
            '   </div>'+
            '</div>';

/*            texto = texto +
            '<div class="row">'+
            '   <div class="col-md-12 lbl-medidas-left">'+
            'Local Chaves: '+full.IMB_IMV_CHABOX+
            '   </div>'+
            '</div>';
*/

        }
        return texto;
    }

    function getInformacoes(data, type, full, meta)
    {
        var condominio = '';
        if ( full.CONDOMINIO != null )
           condominio = full.CONDOMINIO;

        var tipoimovel='';
        if ( full.IMB_TIM_DESCRICAO != null )
           tipoimovel = full.IMB_TIM_DESCRICAO;

        var comodos='';
        if( full.IMB_IMV_DORQUA != null  &&  full.IMB_IMV_DORQUA != '0' )
            comodos = comodos + '<i title="Dormitórios" class="fa fa-bed" aria-hidden="true"></i><b>  '+full.IMB_IMV_DORQUA+'</b>';

        if( full.IMB_IMV_SUIQUA != null  &&  full.IMB_IMV_SUIQUA != '0' )
            comodos = comodos + '&nbsp;&nbsp;&nbsp;&nbsp;'+'<i title="Suítes" class="fa fa-bed" aria-hidden="true"></i><b>  '+full.IMB_IMV_SUIQUA+'</b>';

        if( full.IMB_IMV_DORAE == 'S' )
            comodos = comodos + '&nbsp;&nbsp;C/Armários';


        wc = full.IMB_IMV_WCQUA;
        if( wc != null ) 
            comodos = comodos + '&nbsp;&nbsp;&nbsp;&nbsp;<i title="Banheiros" class="fas fa-bath"></i><b>  '+wc+'</b>';

        if( full.IMB_IMV_SALQUA != null )
            comodos = comodos + '&nbsp;&nbsp;&nbsp;&nbsp;<i title="Salas" class="fas fa-retweet"></i><b>  '+full.IMB_IMV_SALQUA+'</b>';

        if( full.IMB_IMV_GARCOB != null )
            comodos = comodos + '&nbsp;&nbsp;&nbsp;&nbsp;<i title="Garagem Coberta" class="fas fa-car"></i><b>  '+full.IMB_IMV_GARCOB+'</b>';

        if( full.IMB_IMV_GARDES != null )
            comodos = comodos + '&nbsp;&nbsp;&nbsp;&nbsp;<i title="Garagem Descoberta" class="fas fa-car"></i><b>  '+full.IMB_IMV_GARDES+'</b>';

            if( full.IMB_IMV_QUINTA == 'S' )
            comodos = comodos + '&nbsp;&nbsp;&nbsp;&nbsp;<i title="Com Quintal" class="fas fa-tree"></i>';

            if( full.IMB_IMV_EDICUL == 'S' )
            comodos = comodos + '&nbsp;&nbsp;&nbsp;&nbsp;<i title="Com Edícula" class="fas fa-store-alt"></i>';

            if( full.IMB_IMV_PISCIN == 'S' )
            comodos = comodos + '&nbsp;&nbsp;&nbsp;&nbsp;<i title="Tem Piscina" class="fas fa-swimmer"></i>';

            if( full.IMB_IMV_QUADRAPOLIESPORTIVA == 'S' )
            comodos = comodos + '&nbsp;&nbsp;&nbsp;&nbsp;<i title="Tem Quadra Poliespotiva" class="fas fa-volleyball-ball lbl-medidas"></i>';

            if( full.IMB_IMV_CAMFUT == 'S' )
            comodos = comodos + '&nbsp;&nbsp;&nbsp;&nbsp;<i title="Tem Campo Futebol" class="far fa-futbol"></i>';

            if( full.IMB_IMV_PLAGRO == 'S' )
            comodos = comodos + '&nbsp;&nbsp;&nbsp;&nbsp;<i title="Tem PlayGround" class="fab fa-odnoklassniki"></i>';



            if( full.IMB_IMV_CHURRA == 'S' )
            comodos = comodos + '&nbsp;&nbsp;&nbsp;&nbsp;<i title="Churrasqueira" class="fas fa-solar-panel"></i>';

            if( full.IMB_IMV_ARECON != null )
            comodos = comodos + '&nbsp;&nbsp;&nbsp;&nbsp;<i title="Área Construída" class="fab fa-accusoft"></i> '+full.IMB_IMV_ARECON+'m2';

            if( full.IMB_IMV_AREUTI != null )
            comodos = comodos + '&nbsp;&nbsp;&nbsp;&nbsp;<i title="Área Útil" class="fas fa-arrows-alt"></i> '+full.IMB_IMV_AREUTI+'m2';

            if( full.IMB_IMV_ARETOT != null )
            comodos = comodos + '&nbsp;&nbsp;&nbsp;&nbsp;<i title="Área Total" class="far fa-square"></i> '+full.IMB_IMV_ARETOT+'m2';

        var captadores='';
        if( full.IMB_ATD_NOME != '' )
            captadores = full.IMB_ATD_NOMECAPTADOR;
        captadores=  captadores.replace('null', '');
        
        var corretores='';
        if( full.IMB_ATD_NOMECORRETOR != '' )
            corretores = full.IMB_ATD_NOMECORRETOR;
        corretores=  corretores.replace('null', '');




        var data = new Date(full.IMB_IMV_DATAATUALIZACAO); //cria um objeto de data com o valor inserido no input
        data =  moment(data).format('DD/MM/YYYY HH:mm');

        var d1 = data;
        var d2 = moment().format( 'DD/MM/YYYY HH:mm' );
        var diff = moment(d2,"DD/MM/YYYY HH:mm").diff(moment(d1,"DD/MM/YYYY HH:mm"));
        var dias = moment.duration(diff).asDays();
        var atualizado='';

        console.log( 'dias: '+dias);

        if( dias < 1  )
        {

            var horas =  moment.duration(diff).asHours();
            atualizado='Atualizado há '+parseInt(horas)+' horas ';
        }

        if( dias >= 1 && dias <=31 )
            atualizado='Atualizado há mais de '+parseInt(dias)+' dias ';

            if( dias > 31 && dias <= 365 )
        {
            var meses = Math.round(moment.duration(diff).asMonths());
            if( meses = 1 )
                atualizado='Atualizado há '+parseInt(meses)+' mês '
            else
                atualizado='Atualizado há mais de '+parseInt(meses)+' meses ';
        };

        if( dias > 365 )
        {
            var anos = Math.round(moment.duration(diff).asYears());
            if( anos == 1 )
                atualizado='Atualizado há '+parseInt(anos)+' Ano '
            else
                atualizado='Atualizado há mais de '+parseInt(anos)+' Anos ';
        };

        var atualizado= atualizado+' - Captação de <b>'+captadores+'</b>';



//        carregarCapImo( full.IMB_IMV_ID, function(dados) {
            //var captadores = dados;
            //alert( captadores );
        //});



        var valorvenda =  parseFloat(full.IMB_IMV_VALVEN);
        var valorvenda =  formatarBRSemSimbolo(valorvenda);
        var valorlocacao = parseFloat(full.IMB_IMV_VALLOC);
        var valorlocacao = formatarBRSemSimbolo(valorlocacao);
        var texto = '';

        var urlsite = full.URLIMOVELSITE;
        if( urlsite != null )
            urlsite=
            '<div class="col-md-q2 div-center  row-top-margin">'+
            '  <a href="'+full.URLIMOVELSITE+full.IMB_IMV_ID+'" id="div-linksite" title="Copie e cole este link para enviar ao cliente ou click no link" target="_blank">'+
            '  '+full.URLIMOVELSITE+full.IMB_IMV_ID+'</a>'+
            '</div>'
        else
            urlsite='';


        var localchaves = full.IMB_IMV_CHABOX;
        if( localchaves == null ) localchaves='Consultar Corretor';

        reservas = '';
        if( full.IMB_CCH_RESERVAR == 'S')
            reservas ='<div class="col-md-12" class="advertencia"> '+
                        '  <div class="col-md-12 div-center"><br>'+
                        '  <a href="javascript:mostrarReserva('+full.IMB_CCH_ID+')"  title="">'+
                        '  Com Reserva até '+moment(full.IMB_CCH_RESERVARDATALIMITE).format('DD/MM/YYYY')+'</a>'+
                        '  </div>'+
                        '</div>';
                    

        classeescondido = '';
        if( full.VIS_STA_SITUACAO =='I' || full.IMB_IMV_VALLOC == 0 ) classeescondido="escondido";

        situacao = '';
        if( full.VIS_STA_SITUACAO == 'I' ) 
        {
            situacao = 'bg-inativo';
            situacaosimbolo = '<i class="fa fa-toggle-off fa-2x" aria-hidden="true" style="color:red"></i>';
        }
        else
        {
            situacao = 'bg-ativo';
            situacaosimbolo = '<i class="fa fa-toggle-on fa-2x" aria-hidden="true" style="color:green"></i>';
        }

        console.log( full.IMAGEM );
        var htmlimagem = 
            ' <div class="inset"><a href="javascript:carrousel( '+full.IMB_IMV_ID+')"><img  class="img-album" src="{{url('')}}/storage/images/'+full.IMB_IMB_ID+'/imoveis/'+full.IMB_IMV_ID+'/'+full.IMAGEM+'" data-toggle="tooltip" title="Ver no album de fotos"></a></div>';
        if( full.IMAGEM == '' || full.IMAGEM == 'null'  || full.IMAGEM === null )
            htmlimagem = 
            ' <div class="inset"><a href="javascript:carrousel( '+full.IMB_IMV_ID+')"><img  class="img-album" src="{{url('')}}/storage/images/'+full.IMB_IMB_ID+'/logos/logo_180_135_semimagem.jpg" data-toggle="tooltip" title="Ver no album de fotos"></a></div>';
            

        var obs = full.IMB_IMV_OBSWEB;
        if( obs === null ) obs = '';
        texto=  texto +
                    '<div class="row '+situacao+' outset">'+
                    '   <div class="col-md-1 div-center '+situacao+'">'+
                    '      <label class="precos"><a href="javascript:mostrarImovelModal('+full.IMB_IMV_ID+')";>'+full.IMB_IMV_REFERE+'</a>&nbsp;&nbsp;&nbsp;&nbsp;'+situacaosimbolo+'</label>'+
                    htmlimagem+
                    '       <a title="Aplicar marca d\'água em todas as fotos deste imóvel" class="form-control" btn btn-warning" href="javascript:marcaDagua('+ full.IMB_IMV_ID+')"><span class="span-7">Marca d`agua</span></a>'+
                    
                    '   </div>'+
                    '   <div class="col-md-10 precos ">'+
                    '       <div class="col-md-4 div-left precos">'+
                    '               <label class="precos"><a href="javascript:mostrarImovelModal('+full.IMB_IMV_ID+')";>'+full.CEP_BAI_NOME+'</a></label>'+
                    '       </div> '+
                    '       <div class="col-md-3 div-center precos">'+
                    '               <label class="precos"><a href="javascript:mostrarImovelModal('+full.IMB_IMV_ID+')";>'+tipoimovel+'</a></label>'+
                    '       </div> '+
                    '       <div class="col-md-2 precos " >'+
                    '           <label>Locação: R$ <b>'+valorlocacao+'</b></label>'+
                    '       </div> '+
                    '       <div class="col-md-2 precos" >'+
                    '           <label>Venda: R$ <b>'+valorvenda+'</b></label>'+
                    '       </div>'+
                    '       <div class="col-md-6 precos row-top-margin">'+
                    '             <label><b>'+full.ENDERECOCOMPLETO+'</b></label>'+
                    '       </div> '+
                    '       <div class="col-md-5 precos row-top-margin">'+
                    '               <label><b>'+condominio+'</b></label>'+
                    '       </div> '+
                    '       <div class="col-md-11 row-top-margin">'+
                    '               <label>'+comodos+'</label>'+
                    '       </div> '+
                    '       <div class="col-md-1 div-center precos  row-top-margin" >'+
                    "         @php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ImoveisSelecionar', 'Selecionar Imoveis', 'CRM', 'Imóveis','S', 'X', 'Botão')@endphp"+
                    '        <div class="{{$acesso}}">'+
                    '           <button class="btn btn-circle glyphicon glyphicon-shopping-cart pull-left i-btn-selecionar  row-top-margin " '+
                    '               data-toggle="tooltip" title="Selecionar este imóvel">'+
                    '           </button>'+                    
                    '         </div>'+
                    "         @php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ImovelEmail', 'Enviar Imóvel por Email', 'CRM', 'Imóveis','S', 'X', 'Botão')@endphp"+
                    '        <div class="{{$acesso}}">'+
                    '           <button class="btn btn-circle fa fa-envelope-open pull-left {{$acesso}}" '+
                    '               onClick="enviarPorEmail('+full.IMB_IMV_ID+');"  data-toggle="tooltip" title="Enviar por Email">'+
                    '          </button>'+
                    '         </div>'+
                    '       </div>'+
                    '       <div class="col-md-6 row-top-margin">'+
                    '           <label>'+atualizado+'</label>'+
                    '       </div> '+
                    '       <div class="col-md-6 row-top-margin">'+
                    '          <label>Local das Chaves: <b>'+localchaves+'</b></label>'+
                    '       </div>'+
                    '       <div class="col-md-12 row-top-margin"><i>'+obs+'</i>'+
                    '       </div>'+reservas+urlsite+
                    '   </div> '+
                    '   <div class="col-md-1 cardtitulo div-right">'+
                    '   <p>&nbsp;</p>'+
                    "         @php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Contratos', 'Contratos', 'ADM', 'Contratos','S', 'I', 'Botão')@endphp"+
                    '     <p class="div-right {{$acesso}}">'+
                    '           <a class="alugar control-label '+classeescondido+'" title="Click aqui para iniciar novo processo de locação para este imóvel" href="javascript:novoContrato('+full.IMB_IMV_ID+')"><i class="fa fa-key fa-2x" aria-hidden="true"></i></a>'+
                    '     </p>'+
                    "         @php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'Imovel', 'Imóveis(Acessar/Incluir/alterar/excluir)', 'CRM', 'Imóveis','S', 'A', 'Botão')@endphp"+
                    '     <p class="div-right {{$acesso}}">'+
                    '           <a class="alterar  control-label"  title="Click aqui para alterar dados do imóvel" href="javascript:alterarImovel('+full.IMB_IMV_ID+')"><i class="fa fa-pencil fa-2x" aria-hidden="true"></i></a>'+
                    '     </p>'+
                    "         @php  $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ImovelClonar', 'Duplicar Imóvel para facilitar novo cadastro', 'CRM', 'Imóveis','S', 'X', 'Botão')@endphp"+
                    '     <p class="div-right {{$acesso}}"> '+
                    '           <a class="clonar  control-label" title="Click aqui para clonar este imóvel" href="javascript:clonarImovel('+full.IMB_IMV_ID+')"><i class="fa fa-clone fa-2x" aria-hidden="true"></i></a>'+
                    '     </p>'+
                    '   </div>';
                    if( full.TEMLOCACAO != '')
                            texto = texto +
                                '<div class="row">'+
                                '   <div class="col-md-12">'+
                                '           <label class="display-title-red">Este Imóvel Tem Históricos de Locações</label>'+
                                '   </div> '+
                                '</div>';

                    texto = texto + '</div> ';






                        /*'   <div class="col-md-6">'+
                        '       <div class="form-group">'+
                        '           </label>Corretor: '+corretores+'</label>'+
                        '        </div> '+
                        '   </div> '+
                        */


/*                        texto = texto  +
                        '<div class="row" height="50%"> '+
                            '<div class="col-md-12">'+
                            '    <div class="col-md-4">'+
                            '        <button class="btn btn-primary  fa fa-search-plus" onClick="mostrarImovelModal('+full.IMB_IMV_ID+');">  VISUALIZAR </button>'+
                            '    </div>'+
                            '    <div class="col-md-4">'+
                            '        <button class="btn btn-primary  fa fa-pencil-square-o" onClick="alterarImovel('+full.IMB_IMV_ID+')">  ALTERAR </button>'+
                            '    </div>'+
                            '    <div class="col-md-4">'+
                            '        <button class="btn btn-primary  fa fa-sticky-note-o" onClick="novoContrato('+full.IMB_IMV_ID+')">  ALUGAR O IMÓVEL</button>'+
                            '    </div>'+
                            '</div>'+
                        '</div>';
                        */
                        if( full.IMB_CCH_DTHDEVOLUCAOESPERADA != null)
                            texto = texto +
                                '<div class="row">'+
                                '   <div class="col-md-12">'+
                                '   <div class="col-md-3  div-center" >'+
                                '       <div class="form-group">'+
                                '           <label class="display-title-red" title="Devolução esperada até '+moment(full.IMB_CCH_DTHDEVOLUCAOESPERADA).format('DD/MM/YYYY HH:mm')+'">'+full.SITUACAOCHAVE+'</label>'+
                                '        </div> '+
                                '   </div> '+
                                '   </div> '+
                                '</div>';



//                    carregarCapImo( full.IMB_IMV_ID,
                    //function(dados)
                    //{
                        //$("#i-referencia").val('-------->'+dados );
                    //});



        return texto;
    }


    function getFormattedDate(date)
    {
        let year = date.getFullYear();
        let month = (1 + date.getMonth()).toString().padStart(2, '0');
        let day = date.getDate().toString().padStart(2, '0');
        return month + '/' + day + '/' + year;
    }

    function selecionarImovel( id )
    {
        $.ajaxSetup(
        {
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

        cliente =
        {
            IMB_ATD_ID : $("#i-idusuario").val(),
            IMB_IMV_ID : id
        };

        console.log( cliente );
        $.ajax(
        {
            url : "{{ route( 'atendimento.selecionarimoveis' ) }}",
            type : 'post',
            data : cliente,
            success:function()
            {
                mostrarSelecionados();
            },
            error: function()
            {
                alert('Não selecionado! Pode ser que já esteja selecionado por você ou por outro usuário!');
            }
        });

    }


    function apagarImovelSelecao( id )
    {

        cliente =
        {
            IMB_IMS_ID : id
        };

        console.log( cliente );
        $.ajax({
          url : "{{ route( 'apagarimvselec' ) }}",
          type : 'get',
          data : cliente
     })
     .done(function(){
        mostrarSelecionados();
     });
    }

    function mostrarSelecionados()
    {

        cliente =
        {
            IMB_ATD_ID : $("#i-idusuario").val()
        };


        url = "{{ route( 'cargaselecionados' ) }}";

        console.log('CARGA SELECIONADO: '+url );

        $.getJSON( url, function(data)
            {
                ;
                linha = "";
                $("#tblimoveiselecionados>tbody").empty();
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                        '<tr>'+
                        '   <td>'+data[nI].IMB_IMV_ID+'</td>'+
                        '   <td>'+data[nI].IMB_IMV_REFERE+'</td>'+
                        '   <td>'+data[nI].ENDERECO+'</td>'+
                        '   <td>'+data[nI].SITUACAOCHAVE+'</td>'+
                        '   <td style="text-align:center"> '+
//                    '<a  class="btn btn-sm btn-primary" href=javascript:editarCorImo('+data[nI].IMB_CORIMO_ID+')>Editar</a>&nbsp;&nbsp;&nbsp;&nbsp;'+
//                    '           <button class="btn btn-sm btn-primary" onclick="editarCorImo('+data[nI].IMB_CORIMO_ID+' )">Editar</button>'+
//                    '           <button class="btn btn-sm btn-danger" onclick="apagarCorImo('+data[nI].IMB_CORIMO_ID+' )">Apagar</button>'+
                        '<a  class="btn btn-sm btn-danger" onclick="apagarImovelSelecao('+data[nI].IMB_IMS_ID+')">Apagar</a>'+

                        '   </td>'+
                        '</tr>';

                    $("#tblimoveiselecionados").append( linha );

                }
                $("#modalimoveisselecionados").modal('show');
            })
    }

    function carrousel( id )
    {

        window.open("{{ route('imagem.album') }}/" + id,'_blank');

    }

    function mostrarImobiliaria( id )
    {


        url = "{{route('pegaragencia')}}/"+id;

        $.ajax(
            {
                url : url,
                type: 'get',
                datatype: 'json',
                async:true,
                success: function( data )
                {
                    $("#i-nome-imobiliaria").text( data.IMB_IMB_NOME);
                    $("#i-telefone-imobiliaria").text( data.IMB_IMB_TELEFONE1+'  '+data.IMB_IMB_TELEFONE2);
                    $("#i-site-imobiliaria").text( data.IMB_IMB_URL == 'null' ?  '-' : data.IMB_IMB_URL  );
                    $("#i-email-imobiliaria").text( data.IMB_IMB_EMAIL == 'null' ? data.IMB_IMB_EMAIL : '-' );
                    $("#modalDadosImobiliaria").modal('show' );
                }
            }
        )

    }

    function enviarPorEmail( id )
    {
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

    function imovelAlterar()
    {

      


        $("#id").val( $("#i-codigo-imovel").val() );
        $("#form-alt").submit();
    }

    function novoContrato( id, situacao )
    {
        if( situacao == 'I')
        {
            alert('Este imóvel não pode ser alugado! O Status dele não permite este procedimento!' );
            return false;
        }

        $("#idimovelcontrato").val( id );
        $("#form-novocontrato").submit();

    }

    function alterarImovel( id )
    {
   

        $("#id").val( id );
        $("#form-alt").submit();
    }

    function statusImovel( id )
    {

        url = "{{route('statusimovel.buscar')}}/"+id;
        situacao='';

        $.ajax(
        {
            url     : url,
            datatype: 'json',
            type    : 'get',
            async   : false,
            success : function( data )
            {
                situacao = data.VIS_STA_SITUACAO;
            }

        });
        return situacao;


    }

    function CarregarPropImo( id )
    {
        var url = "{{ route('propimo.carga') }}/"+id;
        $.getJSON( url, function( data)
        {
            linha = "";
            $("#tbpropimo>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                linha =
                    '<tr>'+
                    '   <td style="text-align:center">'+data[nI].IMB_CLT_NOME+'</td>'+
                    '   <td style="text-align:center">'+data[nI].principal+'</td>'+
                    '   <td style="text-align:center">'+data[nI].FONES+'</td>'+
                    '   <td style="text-align:center">'+data[nI].IMB_CLT_EMAIL+'</td>'+
                    '   <td style="text-align:center">'+data[nI].CEP_CID_NOMERES+'</td>'+
                    '</tr>';
                $("#tbpropimo").append( linha );

            }
        });
    }

    function preencherStatusTroca()
        {
            var url = "{{ route('statusimovel.carga')}}/0";

            console.log('urk '+url);
            $.getJSON( url, function( data )
            {
                $("#i-statustrocar").empty();
                linha = '<option value="0"></option>';
                $("#i-statustrocar").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].VIS_STA_ID+'">'+
                        data[nI].VIS_STA_NOME+"</option>";
                        $("#i-statustrocar").append( linha );
                }

            });

        }


    function mudarStatus()
    {



        preencherStatusTroca();

        $("#modalstatus").modal('show');

        ///$("#i-div-mudar-status").removeClass('escondido');


    }

    function cancelarTrocaStatus()
    {
        $("#modalstatus").modal('hide');
        //$("#i-div-mudar-status").addClass('escondido');

    }
    function confirmarStatus()
    {
        var imovel = $("#i-codigo-imovel").val();
        var status = $("#i-statustrocar").val();

        url = "{{route('imovel.trocarstatus')}}";

        $.ajaxSetup(
        {
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

        troca =
        {
            IMB_IMV_ID : imovel,
            VIS_STA_ID : status,
        };

        $.ajax({
          url : url,
          type : 'post',
          dataTyepe: 'json',
          data : troca,
          success:function(data)
          {
              alert('Status Alterado');
              //$("#i-div-mudar-status").addClass('escondido');
              $("#modalstatus").modal('hide');

          }
        })
    }

    function fichaImovel()
    {
        $("#modalfichaimovel").modal('show');
    }


    function fichaSimples()
    {
       
        $("#idimovelficha").val( $("#i-codigo-imovel").val());
        $("#tipoficha").val( 'N' );
        $("#form-fichaimovel").submit();

    }
    function fichaCompleta()
    {


        $("#idimovelficha").val( $("#i-codigo-imovel").val());
        $("#tipoficha").val( 'S' );
        $("#form-fichaimovel").submit();
    }

    function excluirImovel( id )
    {


        var resposta = confirm("Atenção! Processo será irrervesível! Deseja esxluir o imóvel mesmo assim?");
        if (resposta == true)
        {
            url = "{{route('imovel.apagar')}}/"+id;

            $.ajaxSetup(
            {
                headers:
                {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });

            $.ajax(
                {
                    url     : url,
                    type    :'delete',
                    dataType:'Json',
                    async:false,
                    success:function( data )
                    {
                        alert('Imóvel Excluido');
                        window.location="{{route('imovel.index')}}";
                    }
                    ,
                    error:function()
                    {
                        alert('Erro ao tentar excluir o imovel');
                    }

                });



        }


    }

    function mostrarReserva( id )
    {

        var url = "{{route('saidachaves.show')}}/"+id;

        $.ajax(
            {
                url:url,
                type:'get',
                dataType:'json',
                success:function(data)
                {

                    var cliente=data.IMB_CLT_NOME;
                    if( cliente === null ) cliente='';
                    var solicitante=data.IMB_ATD_NOMESOLICITANTE;
                    if( solicitante === null )
                       solicitante='';
                    alert('Reservado por '+cliente+' '+
                    solicitante);
                }

            });
    }

    function clonarImovel( id )
    {
        var resposta = confirm("Confirma Clonar o Imóvel?");
        if (resposta == true)
        {
            var url = "{{ route('imoveis.clonar') }}/"+id;

            $.ajaxSetup(
                {
                    headers:
                    {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                    }
                });
                    $.ajax(
            {
                url:url,
                dataType:'json',
                type:'post',
                success:function(data)
                {
                    alert('Imovel clonado. Referência: '+data.IMB_IMV_REFERE);

                }
            }
            )

        }



    }
    function marcaDagua( id )
        {
            var url = "{{route('imoveis.imagens.insertwm')}}/"+id;
            $.ajax(
                {
                    url:url,
                    dataType:'json',
                    type:'get',
                    success:function()
                    {
                        alert('Marca d`agua colocada! A tela precisa ser atualizada');
                    }
                }
            )

        }


</script>

@endpush



