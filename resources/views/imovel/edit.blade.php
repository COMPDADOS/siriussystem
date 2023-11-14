@extends('layout.app')
@push('script')
@endpush

@section('scripttop')
<link href="{{asset('/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/myscript.js?n=1"></script>
<style>
    .border-05
    {
        border-width: 0px;
        border-color: blue;
        border-style: solid;
        background-color:#dfdfdf;
    }

    .img-album
        {
            width: 100%;
            height: 300px;
            border-radius: 50%;
        }

.img-mini
            {
                max-width:100%;
                width:180px;
				height:135px;            }

.img-grande
{
    max-width:80%;
    width:80%;
	height:80%;
}


.div-imagem
{
    padding: 20px;
    background: #f0f4f4;
}

.footer {
  position: fixed;
  bottom: 0;
  width: 85%;
  height: 50px;
  background:#e0ebeb;
}

.div-imagens
{
    background-color: #f2ffe6;
    text-align:center;
}

#progress-wrp {
    border: 1px solid #0099CC;
    padding: 1px;
    position: relative;
    border-radius: 3px;
    margin: 10px;
    text-align: left;
    background: #fff;
    box-shadow: inset 1px 3px 6px rgba(0, 0, 0, 0.12);
}
#progress-wrp .progress-bar{
	height: 20px;
    border-radius: 3px;
    background-color: #79f763;
    width: 0;
    box-shadow: inset 1px 1px 10px rgba(0, 0, 0, 0.11);
}
#progress-wrp .status{
	top:3px;
	left:50%;
	position:absolute;
	display:inline-block;
	color: #000000;
}

.lay-col-1{
  display: block;
  height: 60px;
  line-height: 60px;
  background: #dfdfdf; /* Não necessário */
  text-align: center; /* Não necessário */
}

.enfatizados
    {
        font-size: 20px;
        font-weight: bold;
    }
    .valores-direita
    {
        text-align: right;
        font-size: 20px;
        font-weight: bold;
    }

    .valores
    {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
    }

    .cardtitulo {
  text-align: left;
  font-size: 16px;
  color: #FFFFFF;
  font-weight: bold;
  background: #FF0606;

}
.cardtitulo-red {
  text-align: center;
  font-size: 24px;
  color: #FFFFFF;
  font-weight: bold;
  background: rgb(255, 0, 0);
}

.div-center {
  text-align: center;
}

</style>
@endsection


@section('content')
<div class="portlet light bordered">
    <div class="portlet-body">
        <form id="formedit">
        <input type="hidden" id="i-somenteleitura" value="{{$somenteleitura}}">
            <div class="tabbable-custom nav-justified">
                <ul class="nav nav-tabs valores nav-justified">
                    <li class="active">
                        <a href="#tab_1_1_1" data-toggle="tab">Geral</a>
                    </li>
                    <li>
                        <a href="#tab_1_1_2" data-toggle="tab">Medidas/Cômodos</a>
                    </li>
                    <li>
                        <a href="#tab_1_1_3" data-toggle="tab">Observações / Chaves</a>
                    </li>
                    <li>
                        <a href="#tab_1_1_4" data-toggle="tab" id="i-imagens-click">Imagens</a>
                    </li>
                    <li>
                        <a href="#tab_1_1_5" data-toggle="tab">Condições Comerciais e Corretor/Captador</a>
                    </li>
                    <li>
                        <a href="#tab_1_1_6" data-toggle="tab">Portais</a>
                    </li>
                </ul>
                <div class="tab-content">
                    @php
                        $dadosimovel = app('App\Http\Controllers\ctrImovel')->carga( $imovel->IMB_IMV_ID );
                    @endphp
                    <div class="tab-pane active" id="tab_1_1_1">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                <div class="col-md-2">
                                        <label class="label-control">Internet
                                            <input type="checkbox" id="IMB_IMV_WEBIMOVEL" class="form-control" 
                                            data-checkbox="icheckbox_flat-blue" @if( $dadosimovel->IMB_IMV_WEBIMOVEL=='S') Checked @endif>
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="label-control">Destaque
                                            <input type="checkbox" id="IMB_IMV_DESTAQUE" class="form-control" 
                                            data-checkbox="icheckbox_flat-blue"
                                            @if( $dadosimovel->IMB_IMV_DESTAQUE=='S') Checked @endif>
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="label-control">Super Dest.
                                            <input type="checkbox" id="IMB_IMV_SUPERDESTAQUE" class="form-control" data-checkbox="icheckbox_flat-blue"
                                            @if( $dadosimovel->IMB_IMV_SUPERDESTAQUE=='S') Checked @endif>
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="label-control">Lançto.
                                            <input type="checkbox" id="IMB_IMV_WEBLANCAMENTO"  class="form-control"  
                                            data-checkbox="icheckbox_flat-blue"
                                            @if( $dadosimovel->IMB_IMV_WEBLANCAMENTO=='S') Checked @endif>
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="label-control">Exclusivo
                                            <input type="checkbox" id="IMB_IMV_ESCLUSIVO" class="form-control" data-checkbox="icheckbox_flat-blue"
                                            @if( $dadosimovel->IMB_IMV_ESCLUSIVO=='S') Checked @endif>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-2">
                                        <label >Sobrado
                                                <input type="checkbox" id="IMB_IMV_SOBRADO" class="form-control" data-checkbox="icheckbox_flat-blue"
                                                @if( $dadosimovel->IMB_IMV_SOBRADO=='S') Checked @endif>
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label >Placa
                                            <input type="checkbox" id="IMB_IMV_PLACA"
                                            class="form-control" data-checkbox="icheckbox_flat-blue"
                                            @if( $dadosimovel->IMB_IMV_PLACA=='S') Checked @endif>
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label >Ac. Financ.
                                            <input type="checkbox" id="IMB_IMV_ACEITAFINANC"class="form-control"  data-checkbox="icheckbox_flat-blue"
                                            @if( $dadosimovel->IMB_IMV_ACEITAFINANC=='S') Checked @endif>
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label >Permuta
                                            <input type="checkbox" id="IMB_IMV_PERMUTA"  class="form-control" data-checkbox="icheckbox_flat-blue"
                                            @if( $dadosimovel->IMB_IMV_PERMUTA=='S') Checked @endif>
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label >Escritura
                                            <input type="checkbox" id="IMB_IMV_ESCRIT" class="form-control" data-checkbox="icheckbox_flat-blue"
                                            @if( $dadosimovel->IMB_IMV_ESCRIT=='S') Checked @endif>
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="form-body">
                            <div class="portlet box blue" id="div-proprietario">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Proprietário(s) do Imóvel
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>

                                <div class="portlet-body form">
                                    <table  id="tbpropimo" class="table table-striped table-bordered table-hover" >
                                        <thead class="thead-dark">
                                            <tr>
                                                <th style="text-align:center"> Proprietario </th>
                                                <th style="text-align:center" width="100" style="text-align:center"> Percentual </th>
                                                <th style="text-align:center" width="100" style="text-align:center"> Principal </th>
                                                <th width="200" style="text-align:center"> Ações </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <div class="table-footer" >
                                        <a  class="btn btn-sm btn-primary" role="button" onClick="adicionarPropImo()" >
                                        Adicionar Proprietário </a>
                                        <!--data-toggle="modal" data-target="#modalFormaPagamento"-->
                                        <input type="hidden" id="i-totalperc">
                                        <input type="hidden" id="i-temprincipal">
                                    </div>
                                </div>
                            </div>

                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption" id="div-localizacao">
                                        <i class="fa fa-gift"></i>Localização
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>

                                <div class="portlet-body form">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="form-group">
                                                <label id="label-titulo">Título do Imóvel</label>
                                                <input type="text" id="IMB_IMV_TITULO"
                                                class="form-control input-sm titulo" style="font-family: Tahoma; font-size: 16px" 
                                                value = "{{$dadosimovel->IMB_IMV_TITULO}}">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <label >&nbsp;</label>
                                            <a href="javascript:gerarSugestaoTitulo();" class="btn btn-warning form-control>">Gerar Título</a>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Tipo</label>
                                                <select class="form-control" id="IMB_IMV_ENDERECOTIPO"
                                                value="{{$dadosimovel->IMB_IMV_ENDERECOTIPO}}">
                                                    <option value="Acesso">Acesso</option>
                                                    <option value="Alameda">Alameda</option>
                                                    <option value="Avenida">Avenida</option>
                                                    <option value="Estrada">Estrada</option>
                                                    <option value="Praça">Praça</option>
                                                    <option value="Rodovia">Rodovia</option>
                                                    <option value="Rua">Rua</option>
                                                    <option value="Travessa">Travessa</option>
                                                    <option value="Viela">Viela</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label id="ilogradouro" >Logradouro</label>
                                                <input type="text" maxlength="40" id="IMB_IMV_ENDERECO"
                                                class="form-control  mr-sm-0 input-sm" style="font-family: Tahoma; font-size: 16px"
                                                value="{{$dadosimovel->IMB_IMV_ENDERECO}}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Número</label>
                                                <input type="text" maxlength="10"  id="IMB_IMV_ENDERECONUMERO"
                                                class="form-control input-sm" style="font-family: Tahoma; font-size: 16px"
                                                value="{{$dadosimovel->IMB_IMV_ENDERECONUMERO}}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Complemento</label>
                                                <input type="text" maxlength="20"  id="IMB_IMV_ENDERECOCOMPLEMENTO"
                                                class="form-control input-sm" style="font-family: Tahoma; font-size: 16px" 
                                                value="{{$dadosimovel->IMB_IMV_ENDERECOCOMPLEMENTO}}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Apt.</label>
                                                <input type="text" id="IMB_IMV_NUMAPT" maxlength="5"
                                                class="form-control input-sm" style="font-family: Tahoma; font-size: 16px"
                                                value="{{$dadosimovel->IMB_IMV_NUMAPT}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Condomínio -<a href="javascript:tirarCondominio()"><b>Remover Condominio</b></a></label>
                                                @php
                                                    $cnds = app('App\Http\Controllers\ctrCondominio')->cargaSemJson( Auth::user()->IMB_IMB_ID );
                                                @endphp
                                                <select class="select2"  id="IMB_CND_ID" placeholder="Selecione o Condominio">
                                                    <option value=""></option>
                                                    @foreach( $cnds as $cnd )
                                                        <option value="{{$cnd->IMB_CND_ID}}" 
                                                            @if( $cnd->IMB_CND_ID == $dadosimovel->IMB_CND_ID ) selected @endif>{{$cnd->IMB_CND_NOME}}</option>
                                                    @endforeach
                                                </select>
                                                <span>

                                                    <a href="javascript:buscarCondominio()">Preencher Endereço</a>

                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nome Prédio</label>
                                                <input type="text" id="IMB_IMV_PREDIO"
                                                class="form-control input-sm" 
                                                value="{{$dadosimovel->IMB_IMV_PREDIO}}">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Andar</label>
                                                <input type="text" id="IMB_IMV_ANDAR"
                                                class="form-control input-sm"
                                                value="{{$dadosimovel->IMB_IMV_ANDAR}}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Bairro&nbsp; &nbsp; &nbsp;</label><span><a href="javascript:cadastrarBairro()"> <b>Cadastrar Bairro</b> </a></span>
                                                @php
                                                    $bairros = app('App\Http\Controllers\ctrBairro')->carga('X');
                                                @endphp
                                                <select class="form-control select2" id="CEP_BAI_ID">
                                                    <option value=""></option>
                                                    @foreach( $bairros as $bairro)
                                                        <option value="{{$bairro->CEP_BAI_ID}}"
                                                            @if( $bairro->CEP_BAI_ID == $dadosimovel->CEP_BAI_ID ) selected @endif>{{$bairro->CEP_BAI_NOME}}({{$bairro->CEP_CID_NOME}})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-grupo">
                                            <div class="col-md-2">
                                                <label>Cep</label>
                                                <div class="input-group">
                                                    <input type="text"id="IMB_IMV_ENDERECOCEP"
                                                    class="form-control input-sm"
                                                    max="99999999"
                                                    placeholder="Somente Nºs" value="{{$dadosimovel->IMB_IMV_ENDERECOCEP}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Cidade</label>
                                                <input type="text" id="IMB_IMV_CIDADE"
                                                maxlength="40"
                                                class="form-control input-sm"
                                                value="{{$dadosimovel->IMB_IMV_CIDADE}}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>UF</label>
                                                <select class="form-control" id="IMB_IMV_ESTADO" >
                                                    <option value="AC" @if( $dadosimovel->IMB_IMV_ESTADO =='AC') selected @endif>Acre</option>
                                                    <option value="AL" @if( $dadosimovel->IMB_IMV_ESTADO =='AL') selected @endif>Alagoas</option>
                                                    <option value="AP" @if( $dadosimovel->IMB_IMV_ESTADO =='AP') selected @endif>Amapá</option>
                                                    <option value="AM" @if( $dadosimovel->IMB_IMV_ESTADO =='AM') selected @endif>Amazonas</option>
                                                    <option value="BA" @if( $dadosimovel->IMB_IMV_ESTADO =='BA') selected @endif>Bahia</option>
                                                    <option value="CE" @if( $dadosimovel->IMB_IMV_ESTADO =='CE') selected @endif>Ceará</option>
                                                    <option value="DF" @if( $dadosimovel->IMB_IMV_ESTADO =='DF') selected @endif>Distrito Federal</option>
                                                    <option value="ES" @if( $dadosimovel->IMB_IMV_ESTADO =='ES') selected @endif>Espírito Santo</option>
                                                    <option value="GO" @if( $dadosimovel->IMB_IMV_ESTADO =='GO') selected @endif>Goiás</option>
                                                    <option value="MA" @if( $dadosimovel->IMB_IMV_ESTADO =='MA') selected @endif>Maranhão</option>
                                                    <option value="MT" @if( $dadosimovel->IMB_IMV_ESTADO =='MT') selected @endif>Mato Grosso</option>
                                                    <option value="MS "@if( $dadosimovel->IMB_IMV_ESTADO =='MS') selected @endif>Mato Grosso do Sul</option>
                                                    <option value="MG" @if( $dadosimovel->IMB_IMV_ESTADO =='MG') selected @endif>Minas Gerais</option>
                                                    <option value="PA" @if( $dadosimovel->IMB_IMV_ESTADO =='PA') selected @endif>Pará</option>
                                                    <option value="PB" @if( $dadosimovel->IMB_IMV_ESTADO =='PB') selected @endif>Paraíba</option>
                                                    <option value="PR" @if( $dadosimovel->IMB_IMV_ESTADO =='PR') selected @endif>Paraná</option>
                                                    <option value="PE" @if( $dadosimovel->IMB_IMV_ESTADO =='PE') selected @endif>Pernambuco</option>
                                                    <option value="PI" @if( $dadosimovel->IMB_IMV_ESTADO =='PI') selected @endif>Piauí</option>
                                                    <option value="RJ" @if( $dadosimovel->IMB_IMV_ESTADO =='RJ') selected @endif>Rio de Janeiro</option>
                                                    <option value="RN" @if( $dadosimovel->IMB_IMV_ESTADO =='RN') selected @endif>Rio Grande do Norte</option>
                                                    <option value="RS" @if( $dadosimovel->IMB_IMV_ESTADO =='RS') selected @endif>Rio Grande do Sul</option>
                                                    <option value="RO" @if( $dadosimovel->IMB_IMV_ESTADO =='RO') selected @endif>Rondônia</option>
                                                    <option value="RR" @if( $dadosimovel->IMB_IMV_ESTADO =='RR') selected @endif>Roraima</option>
                                                    <option value="SC" @if( $dadosimovel->IMB_IMV_ESTADO =='SC') selected @endif>Santa Catarina</option>
                                                    <option value="SP" @if( $dadosimovel->IMB_IMV_ESTADO =='SP') selected @endif>São Paulo</option>
                                                    <option value="SE" @if( $dadosimovel->IMB_IMV_ESTADO =='SE') selected @endif>Sergipe</option>
                                                    <option value="TO" @if( $dadosimovel->IMB_IMV_ESTADO =='TO') selected @endif>Tocantins</option>
                                                    <option value="EX" @if( $dadosimovel->IMB_IMV_ESTADO =='EX') selected @endif>Estrangeiro</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Quadra</label>
                                                <input type="text" id="IMB_IMV_QUADRA" class="form-control input-sm" 
                                                value="{{$dadosimovel->IMB_IMV_QUADRA}}">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Lote</label>
                                                <input type="text" id="IMB_IMV_LOTE" class="form-control input-sm" 
                                                value="{{$dadosimovel->IMB_IMV_LOTE}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Pontos de Referência/Imediações</label>
                                                <input type="text" maxlength="80"  id="IMB_IMV_PROXIMIDADE"
                                                class="form-control" 
                                                value="{{$dadosimovel->IMB_IMV_PROXIMIDADE}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <label class="control-label">Latitude</label>
                                                <input class="form-control" type="text" id="IMB_IMV_LATITUDE"
                                                value="{{$dadosimovel->IMB_IMV_LATITUDE}}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label">Longitude</label>
                                                <input class="form-control" type="text" id="IMB_IMV_LONGITUDE"
                                                value="{{$dadosimovel->IMB_IMV_LONGITUDE}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Dados Básicos
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>

                                <div class="portlet-body form">
                                    <div class="row">
                                        <div class="col-md-3">
                                            @php
                                                $imobs=app('App\Http\Controllers\ctrImobiliaria')->carga(1);
                                            @endphp
                                            <div class="form-group" >
                                                <label class="control-label">Unidade</label>
                                                <select class="form-control" id="IMB_IMB_ID2" >
                                                    @foreach( $imobs as $imob )
                                                        <option value="{{$imob->IMB_IMB_ID}}">{{$imob->IMB_IMB_NOME}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div class="form-group">
                                                <label>Tipo de Imóvel</label>
                                                @php
                                                    $tipos = app('App\Http\Controllers\ctrTipoImovel')->carga();
                                                @endphp
                                                <select class="form-control" id="IMB_TIM_ID">
                                                    @foreach( $tipos as $tipo)
                                                        <option value="{{$tipo->IMB_TIM_ID}}"
                                                            @if( $tipo->IMB_TIM_ID == $dadosimovel->IMB_TIM_ID) selected @endif>{{$tipo->IMB_TIM_DESCRICAO}}</option>
                                                    @endforeach
                                                

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div class="form-group">
                                                <label>R$ Venda</label>
                                                    <input type="text"
                                                id="IMB_IMV_VALVEN" class="form-control valor valores-direita"
                                                type="text"
                                                value="{{number_format( $dadosimovel->IMB_IMV_VALVEN,2,',','.')}}">
                                            </div>
                                        </div>

                                        <div class="col-md-3 ">
                                            <div class="form-group">
                                                <label>R$ Locação</label>
                                                <input type="text"
                                                id="IMB_IMV_VALLOC"  class="form-control valor valores-direita"
                                                value="{{number_format( $dadosimovel->IMB_IMV_VALLOC,2,',','.')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 ">
                                            <div class="form-group">
                                                <label>Código</label>
                                                <input type="text" id="IMB_IMV_ID"
                                                    value="{{$imovel->IMB_IMV_ID}}"
                                                    class="form-control input-sm"
                                                    readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-2 ">
                                            <div class="form-group">
                                                @php  
                                                    $acesso = app( 'App\Http\Controllers\ctrRotinas')->verificarRecurso( 'ImovelAltrEF', 'Imóveis(Alterar Referência)', 'CRM', 'Imóveis','S', 'I', 'Botão');
                                                    if( $acesso == 'escondido') $acesso = 'readonly';                                                    
                                                @endphp
                                                

                                                <label>Referência</label>
                                                <input type="text" id="IMB_IMV_REFERE"
                                                    class="form-control input-sm"
                                                    value="{{$dadosimovel->IMB_IMV_REFERE}}"
                                                    $acesso>

                                            </div>
                                        </div>

                                        <div class="col-md-2 ">
                                            <label>Status</label>
                                            @php
                                                $sts = app('App\Http\Controllers\ctrStatusImovel')->carga( Auth::user()->IMB_IMB_ID );
                                            @endphp
                                            <select class="form-control" id="VIS_STA_ID">
                                                @foreach( $sts as $st)
                                                    <option value="{{$st->VIS_STA_ID}}"
                                                        @if( $st->VIS_STA_ID == $dadosimovel->VIS_STA_ID) selected @endif>{{$st->VIS_STA_NOME}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2 ">
                                            <label>Finalidade</label>
                                            <select class="form-control" id="IMB_IMV_FINALIDADE">
                                                <option value="" @if( $dadosimovel->IMB_IMV_FINALIDADE='') select @endif>Não Informado</option>
                                                <option value="Residencial" @if( $dadosimovel->IMB_IMV_FINALIDADE='Residencial') select @endif>Residencial</option>
                                                <option value="Comercial"  @if( $dadosimovel->IMB_IMV_FINALIDADE='Comercial') select @endif>Comercial</option>
                                                <option value="Misto"  @if( $dadosimovel->IMB_IMV_FINALIDADE='Misto') select @endif>Misto</option>
                                            </select>
                                        </div>

                                        <input  type="hidden" id="IMB_CLT_ID" value="{{$dadosimovel->IMB_CLT_ID}}"  >
                                        <input  type="hidden" id="IMB_CLT_IDORIGINAL" value="{{$dadosimovel->IMB_CLT_ID}}">

                                        <div class="col-md-2">
                                            <div class="form-group" >
                                                <label>R$ IPTU</label>
                                                <input type="text"
                                                id="IMB_IMV_VALORIPTU"  class="form-control valor"
                                                value="{{number_format( $dadosimovel->IMB_IMV_VALORIPTU,2,',','.')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group" >
                                                <label>R$ Condomínio</label>
                                                <input type="text"
                                                id="imb_imv_valorcondominio"  class="form-control valor"
                                                value="{{number_format( $dadosimovel->imb_imv_valorcondominio,2,',','.')}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-3">
                                   <label class="label-control">Cadastrado em
                                        <input class="form-control" type="text" id="IMB_IMV_DATACADASTRO" readonly
                                        value="{{date( 'd/m/Y', strtotime($dadosimovel->IMB_IMV_DATACADASTRO))}}">
                                    </label>
                                </div>
                                <div class="col-md-3">
                                   <label class="label-control">Atualizado em
                                        <input class="form-control" type="text" id="IMB_IMV_DATAATUALIZACAO" readonly
                                        value="{{date( 'd/m/Y', strtotime($dadosimovel->IMB_IMV_DATAATUALIZACAO))}}">
                                        
                                    </label>
                                </div>
                                <div class="col-md-6 div-center">
                                <label class="label-control">Manter no site mesmo que comercializado
                                            <input class="form-control" type="checkbox" id="IMB_IMV_MANTERSITE"
                                            @if( $dadosimovel->IMB_IMV_MANTERSITE=='S') Checked @endif>
                                        </label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane" id="tab_1_1_2">

                        <div class="row">
                            <div class="col-md-2 lay-col-1">
                                Metragens
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Medida Terreno</label>
                                            <input type="text" id="IMB_IMV_MEDTER"  class="form-control"
                                            placeholder="ex.: 10x20"
                                            value="{{$dadosimovel->IMB_IMV_MEDTER}}">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Área Total(m2)</label>
                                            <input type="text" id="IMB_IMV_ARETOT"  class="form-control" 
                                            value="{{$dadosimovel->IMB_IMV_ARETOT}}">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Área Constr.(m2)</label>
                                            <input type="text" id="IMB_IMV_ARECON"   class="form-control" 
                                            value="{{$dadosimovel->IMB_IMV_ARECON}}">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Área Útil(m2)</label>
                                            <input type="text" id="IMB_IMV_AREUTI"  class="form-control"
                                            value="{{$dadosimovel->IMB_IMV_AREUTI}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Posição Solar</label>
                                            <select class="form-control" id="IMB_IMV_ORIENTACAOSOLAR">
                                                <option value="0" @if($dadosimovel->IMB_IMV_ORIENTACAOSOLAR =='0') selected @endif>Não Informado</option>
                                                <option value="L" @if($dadosimovel->IMB_IMV_ORIENTACAOSOLAR =='L') selected @endif>Leste</option>
                                                <option value="M" @if($dadosimovel->IMB_IMV_ORIENTACAOSOLAR =='M') selected @endif>Manhã</option>
                                                <option value="N" @if($dadosimovel->IMB_IMV_ORIENTACAOSOLAR =='N') selected @endif>Norte</option>
                                                <option value="O" @if($dadosimovel->IMB_IMV_ORIENTACAOSOLAR =='O') selected @endif>Oeste</option>
                                                <option value="S" @if($dadosimovel->IMB_IMV_ORIENTACAOSOLAR =='S') selected @endif>Sul</option>
                                                <option value="T" @if($dadosimovel->IMB_IMV_ORIENTACAOSOLAR =='T') selected @endif>Tarde</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Posição</label>
                                            <select class="form-control" id="IMB_IMV_POSICAO">
                                                <option value="0" @if($dadosimovel->IMB_IMV_POSICAO =='0') selected @endif>Não Informado</option>
                                                <option value="F"@if($dadosimovel->IMB_IMV_POSICAO =='F') selected @endif>Frente</option>
                                                <option value="U"@if($dadosimovel->IMB_IMV_POSICAO =='U') selected @endif>Fundo</option>
                                                <option value="L"@if($dadosimovel->IMB_IMV_POSICAO =='L') selected @endif>Lateral</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 lay-col-1">
                                Infra-estrutura
                            </div>
                            <div class="col-md-10">
                                <div class="row">

                                <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Alarme
                                            <input class="form-control" type="checkbox" id="IMB_IMV_ALARME"
                                            @if( $dadosimovel->IMB_IMV_ALARME=='S') Checked @endif>
                                            </label>
                                        </div>
                                    </div>


                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Ar
                                            <input class="form-control" type="checkbox" id="IMB_IMV_ARAPARELHO"
                                            @if( $dadosimovel->IMB_IMV_ARAPARELHO=='S') Checked @endif>
                                            </label>
                                            <span>Condic.</span>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Aquecedor
                                            <input class="form-control" type="checkbox" id="IMB_IMV_AGUAQUENTE"
                                            @if( $dadosimovel->IMB_IMV_AGUAQUENTE=='S') Checked @endif>
                                            </label>
                                            <span>Solar</span>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Lareira
                                            <input class="form-control" type="checkbox" id="IMB_IMV_LAREIRA"
                                            @if( $dadosimovel->IMB_IMV_LAREIRA=='S') Checked @endif>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Semi
                                            <input class="form-control" type="checkbox" id="IMB_IMV_SEMIMOB"
                                            @if( $dadosimovel->IMB_IMV_SEMIMOB=='S') Checked @endif>

                                                <span>Mobiliado</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Interfone
                                            <input class="form-control" type="checkbox" id="IMB_IMV_INTERF"
                                            @if( $dadosimovel->IMB_IMV_INTERF=='S') Checked @endif>

                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 lay-col-1">
                                Metragens: Rural
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Hectares</label>
                                    <input type="text" id="IMB_IMV_HECTARES"  class="form-control"
                                    @if( $dadosimovel->IMB_IMV_HECTARES=='S') Checked @endif>

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Alqueire Paulista</label>
                                    <input type="text" id="IMB_IMV_ALQPAU"  class="form-control"
                                    @if( $dadosimovel->IMB_IMV_ALQPAU=='S') Checked @endif>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Alqueire Goiano</label>
                                    <input type="text" id="IMB_IMV_ALQGOI"  class="form-control"
                                    @if( $dadosimovel->IMB_IMV_ALQGOI=='S') Checked @endif>

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Alqueire Mineiro</label>
                                    <input type="text" id="IMB_IMV_ALQMIN"  class="form-control"
                                    @if( $dadosimovel->IMB_IMV_ALQMIN=='S') Checked @endif>
                                    
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Alqueire Norte</label>
                                    <input type="text" id="IMB_IMV_ALQNOR"  class="form-control"
                                    @if( $dadosimovel->IMB_IMV_ALQNOR=='S') Checked @endif>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-2 lay-col-1">
                                Outras Informações
                            </div>
                            <div class="col-md-10">
                                <div class="col-md-3">
                                    <label class="control-label">Topografia</label>
                                    <select class="form-control" id="IMB_IMV_TOPOGR">
                                            <option value="-1" @if($dadosimovel->IMB_IMV_TOPOGR =='-1') selected @endif>Não Informado</option>
                                            <option value="A" @if($dadosimovel->IMB_IMV_TOPOGR =='A') selected @endif>Aclive</option>
                                            <option value="D"@if($dadosimovel->IMB_IMV_TOPOGR =='D') selected @endif>Declive</option>
                                            <option value="P"@if($dadosimovel->IMB_IMV_TOPOGR =='P') selected @endif>Plano</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label">Ano Construção</label>
                                    <input class="form-control" type="text" id="IMB_IMV_ANOCONSTRUCAO" 
                                    value="{{$dadosimovel->IMB_IMV_ANOCONSTRUCAO}}">
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label">Padrão</label>
                                    <select class="form-control" id="IMB_IMV_PADRAO">
                                            <option value="" @if($dadosimovel->IMB_IMV_PADRAO =='') selected @endif>Não Informado</option>
                                            <option value="A"@if($dadosimovel->IMB_IMV_PADRAO =='A') selected @endif>Alto</option>
                                            <option value="M"@if($dadosimovel->IMB_IMV_PADRAO =='M') selected @endif>Médio</option>
                                            <option value="B"@if($dadosimovel->IMB_IMV_PADRAO =='B') selected @endif>Baixo</option>
                                    </select>

                                </div>
                            </div>
                        </div>


                        <hr>

                        <div class="row">
                            <div class="col-md-2 lay-col-1">
                                Cômodos
                            </div>
                            <div class="col-md-10">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Dorm.</label>
                                        <input type="number" id="IMB_IMV_DORQUA" 
                                        class="form-control"
                                        value="{{$dadosimovel->IMB_IMV_DORQUA}}">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">suites</label>
                                        <input type="number" id="IMB_IMV_SUIQUA"
                                        class="form-control"
                                        value="{{$dadosimovel->IMB_IMV_SUIQUA}}">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">WC</label>
                                        <input type="number" id="IMB_IMV_WCQUA"
                                        class="form-control "
                                        value="{{$dadosimovel->IMB_IMV_WCQUA}}">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Salas</label>
                                        <input type="number" id="IMB_IMV_SALQUA"
                                        class="form-control"
                                        value="{{$dadosimovel->IMB_IMV_SALQUA}}">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <label>Copa
                                        <input class="form-control" type="checkbox" id="IMB_IMV_COPA"
                                        @if( $dadosimovel->IMB_IMV_COPA=='S') Checked @endif>
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label>Escrit.
                                        <input class="form-control" type="checkbox" id="IMB_IMV_SALESC"
                                        @if( $dadosimovel->IMB_IMV_SALESC=='S') Checked @endif>
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label>Lavabo
                                        <input class="form-control" type="checkbox" id="IMB_IMV_LAVABO"
                                        @if( $dadosimovel->IMB_IMV_LAVABO=='S') Checked @endif>
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label>Closet
                                        <input class="form-control" type="checkbox" id="IMB_IMV_SUICLO"
                                        @if( $dadosimovel->IMB_IMV_SUICLO=='S') Checked @endif>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-2 lay-col-1">
                                Armários
                            </div>
                            <div class="col-md-10">

                                <div class="col-md-1">
                                    <label class="label-control">Dorm.
                                        <input class="form-control" type="checkbox" id="IMB_IMV_DORAE"
                                        value="{{$dadosimovel->IMB_IMV_DORAE}}">
                                    </label>
                                </div>


                                <div class="col-md-1">
                                    <label class="label-control">Cozinha
                                        <input class="form-control" type="checkbox" id="IMB_IMV_COZAE"
                                        @if( $dadosimovel->IMB_IMV_COZAE=='S') Checked @endif>
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Corredor
                                        <input class="form-control" type="checkbox" id="IMB_IMV_AECORREDOR"
                                        @if( $dadosimovel->IMB_IMV_AECORREDOR=='S') Checked @endif>
                                        
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Closet
                                        <input class="form-control" type="checkbox" id="IMB_IMV_AECLOSET"
                                        @if( $dadosimovel->IMB_IMV_AECLOSET=='S') Checked @endif>
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control"> Salas
                                        <input class="form-control" type="checkbox" id="IMB_IMV_AESALA"
                                        @if( $dadosimovel->IMB_IMV_AESALA=='S') Checked @endif>
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Escrit.
                                        <input class="form-control" type="checkbox" id="IMB_IMV_AEESCRITORIO"
                                        @if( $dadosimovel->IMB_IMV_AEESCRITORIO=='S') Checked @endif>
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Banheiro
                                        <input class="form-control" type="checkbox" id="IMB_IMV_AEWC"
                                        @if( $dadosimovel->IMB_IMV_AEWC=='S') Checked @endif>
                                    </label>
                                </div>

                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-2 lay-col-1">
                                Serviço
                            </div>
                            <div class="col-md-10">
                                <div class="col-md-1 center" >
                                    <label class="label-control">Cozinha
                                        <input class="form-control" type="checkbox" id="IMB_IMV_COZINHA"
                                        @if( $dadosimovel->IMB_IMV_COZINHA=='S') Checked @endif>
                                    </label>
                                </div>
                                <div class="col-md-1 center" >
                                    <label class="label-control">A.Serv.
                                        <input class="form-control" type="checkbox" id="IMB_IMV_ARESER"
                                        @if( $dadosimovel->IMB_IMV_ARESER=='S') Checked @endif>
                                    </label>
                                </div>
                                <div class="col-md-1 center">
                                    <label class="label-control">WC
                                        <input class="form-control" type="checkbox" id="IMB_IMV_EMPWC"
                                        @if( $dadosimovel->IMB_IMV_EMPWC=='S') Checked @endif>
                                        <span> Empreg.</span>
                                    </label>
                                </div>
                                <div class="col-md-1 center">
                                    <label class="label-control">Dorm.
                                        <input class="form-control" type="checkbox" id="IMB_IMV_EMPQUA"
                                        @if( $dadosimovel->IMB_IMV_EMPQUA=='S') Checked @endif>
                                        <span> Empreg.</span>
                                    </label>
                                </div>
                                <div class="col-md-1 center">
                                    <label class="label-control">Elevador
                                        <input class="form-control" type="checkbox" id="IMB_IMV_ELEVADORES"
                                        @if( $dadosimovel->IMB_IMV_ELEVADORES=='S') Checked @endif>
                                    </label>
                                </div>
                                <div class="col-md-2 center">
                                    <label class="label-control">Despensa
                                        <input class="form-control" type="checkbox" id="IMB_IMV_DESPENSA"
                                        @if( $dadosimovel->IMB_IMV_DESPENSA=='S') Checked @endif>
                                    </label>
                                </div>
                                <div class="col-md-1 center">
                                    <label class="label-control">Sala
                                        <input class="form-control" type="checkbox" id="IMB_IMV_SALAAMOCO"
                                        @if( $dadosimovel->IMB_IMV_SALAAMOCO=='S') Checked @endif>
                                        <span> Almoço</span>
                                    </label>
                                </div>
                                <div class="col-md-2 center">
                                    <label class="label-control">Depósito
                                        <input class="form-control" type="checkbox" id="imb_imv_deposito"
                                        @if( $dadosimovel->imb_imv_deposito=='S') Checked @endif>
                                    </label>
                                </div>


                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-2 lay-col-1">
                                Lazer
                            </div>
                            <div class="col-md-10">
                                <div class="col-md-1">
                                    <label class="label-control">Hidro
                                        <input class="form-control" type="checkbox" id="IMB_IMV_SUIHID"
                                        @if( $dadosimovel->IMB_IMV_SUIHID=='S') Checked @endif>
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Sacada
                                        <input class="form-control" type="checkbox" id="imb_imv_varandagourmet"
                                        @if( $dadosimovel->imb_imv_varandagourmet=='S') Checked @endif>
                                    </label>
                                    <span>Gourmet</span>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Piscina
                                        <input class="form-control" type="checkbox" id="IMB_IMV_PISCIN"
                                        @if( $dadosimovel->IMB_IMV_PISCIN=='S') Checked @endif>
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Churr.
                                        <input class="form-control" type="checkbox" id="IMB_IMV_CHURRA"
                                        @if( $dadosimovel->IMB_IMV_CHURRA=='S') Checked @endif>
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Sauna
                                        <input class="form-control" type="checkbox" id="IMB_IMV_SAUNA"
                                        @if( $dadosimovel->IMB_IMV_SAUNA=='S') Checked @endif>
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Quadra
                                        <input class="form-control" type="checkbox" id="IMB_IMV_QUADRAPOLIESPORTIVA"
                                        @if( $dadosimovel->IMB_IMV_QUADRAPOLIESPORTIVA=='S') Checked @endif>

                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Campo
                                        <input class="form-control" type="checkbox" id="IMB_IMV_CAMFUT"
                                        @if( $dadosimovel->IMB_IMV_CAMFUT=='S') Checked @endif>

                                    </label>
                                    <span>Futebol</span>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Salão
                                        <input class="form-control" type="checkbox" id="IMB_IMV_SALFES"
                                        @if( $dadosimovel->IMB_IMV_SALFES=='S') Checked @endif>
                                    </label>
                                    <span>Festas</span>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Play
                                        <input class="form-control" type="checkbox" id="IMB_IMV_PLAGRO"
                                        @if( $dadosimovel->IMB_IMV_PLAGRO=='S') Checked @endif>

                                    </label>
                                    <span>Ground</span>
                                </div>
                                <div class="col-md-1">
                                    <label class="label-control">Home
                                        <input class="form-control" type="checkbox" id="IMB_IMV_HOME"
                                        @if( $dadosimovel->IMB_IMV_HOME=='S') Checked @endif>
                                    </label>
                                    <span>Teather</span>
                                </div>
                            </div>
                        </div>


                        <hr>

                        <div class="row">
                            <div class="col-md-2 lay-col-1">
                                Externo
                            </div>
                            <div class="col-md-10">
                                <div class="col-md-1 center">
                                    <label class="label-control">Quintal
                                        <input class="form-control" type="checkbox" id="IMB_IMV_QUINTA"
                                        @if( $dadosimovel->IMB_IMV_QUINTA=='S') Checked @endif>
                                    </label>
                                </div>
                                <div class="col-md-1 center">
                                    <label class="label-control">Varanda
                                        <input class="form-control" type="checkbox" id="IMB_IMV_VARANDA"
                                        @if( $dadosimovel->IMB_IMV_VARANDA=='S') Checked @endif>
                                    </label>
                                </div>
                                <div class="col-md-1 center">
                                    <label class="label-control">Sacada
                                        <input class="form-control" type="checkbox" id="IMB_IMV_SACADA"
                                        @if( $dadosimovel->IMB_IMV_SACADA=='S') Checked @endif>
                                    </label>
                                </div>
                                <div class="col-md-1 center">
                                    <label class="label-control">Edícula
                                        <input class="form-control" type="checkbox" id="IMB_IMV_EDICUL"
                                        @if( $dadosimovel->IMB_IMV_EDICUL=='S') Checked @endif>
                                    </label>
                                </div>
                                <div class="col-md-1 center">
                                    <label class="label-control">Murado
                                        <input class="form-control" type="checkbox" id="IMB_IMV_MURADO"
                                        @if( $dadosimovel->IMB_IMV_MURADO=='S') Checked @endif>
                                    </label>
                                </div>
                                <div class="col-md-1 center">
                                    <label class="label-control">Portão
                                        <input class="form-control" type="checkbox" id="IMB_IMV_PORELE"
                                        @if( $dadosimovel->IMB_IMV_PORELE=='S') Checked @endif>
                                    </label>
                                    <span>Eletrônico</span>
                                </div>

                                <div class="col-md-2 center">
                                    <label class="control-label">Vagas Cobertas</label>
                                    <input type="text" id="IMB_IMV_GARCOB"class="form-control"
                                    onkeypress="return isNumber(event)" onpaste="return false;" 
                                    value="{{$dadosimovel->IMB_IMV_GARCOB}}">
                                </div>

                                <div class="col-md-2 center">
                                    <label class="control-label">Vagas Descob.</label>
                                    <input type="text" id="IMB_IMV_GARDES"   class="form-control"
                                    onkeypress="return isNumber(event)" onpaste="return false;"
                                    value="{{$dadosimovel->IMB_IMV_GARDES}}">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-2 lay-col-1">
                                Piso
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-1 center">
                                        <label class="label-control">Aquecido
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOAQUECIDO"
                                            @if( $dadosimovel->IMB_IMV_PISOAQUECIDO=='S') Checked @endif>
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Ardósia
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOARDOSIA"
                                            @if( $dadosimovel->IMB_IMV_PISOARDOSIA=='S') Checked @endif>
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Bloquete
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOBLOQUETE"
                                            @if( $dadosimovel->IMB_IMV_PISOBLOQUETE=='S') Checked @endif>
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Carpete
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOCARPETE"
                                            @if( $dadosimovel->IMB_IMV_PISOCARPETE=='S') Checked @endif>
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Carp.Acril.
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOCARPETEACRIL"
                                            @if( $dadosimovel->IMB_IMV_PISOCARPETEACRIL=='S') Checked @endif>
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Carp.Mad.
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOCARPETEMADEIRA"
                                            @if( $dadosimovel->IMB_IMV_PISOCARPETEMADEIRA=='S') Checked @endif>
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Carp.Nylon
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOCARPETENYLON"
                                            @if( $dadosimovel->IMB_IMV_PISOCARPETENYLON=='S') Checked @endif>
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Cerâmica
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOCERAMICA"
                                            @if( $dadosimovel->IMB_IMV_PISOCERAMICA=='S') Checked @endif>
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Cimento
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOCIMENTO"
                                            @if( $dadosimovel->IMB_IMV_PISOCIMENTO=='S') Checked @endif>
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">C/Piso
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOCONTRAPISO"
                                            @if( $dadosimovel->IMB_IMV_PISOCONTRAPISO=='S') Checked @endif>
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Emborrachado
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOEMBORRACHADO"
                                            @if( $dadosimovel->IMB_IMV_PISOEMBORRACHADO=='S') Checked @endif>
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-1 center">
                                        <label class="label-control">Granito
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOGRANITO"
                                            @if( $dadosimovel->IMB_IMV_PISOGRANITO=='S') Checked @endif>
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Laminado
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOLAMINADO"
                                            @if( $dadosimovel->IMB_IMV_PISOLAMINADO=='S') Checked @endif>
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Mármore
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOMARMORE"
                                            @if( $dadosimovel->IMB_IMV_PISOMARMORE=='S') Checked @endif>
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Tábua
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOTABUA"
                                            @if( $dadosimovel->IMB_IMV_PISOTABUA=='S') Checked @endif>
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Taco
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOTACOMADEIRA"
                                            @if( $dadosimovel->IMB_IMV_PISOTACOMADEIRA=='S') Checked @endif>
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Vinílico
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOVINICULO"
                                            @if( $dadosimovel->IMB_IMV_PISOVINICULO=='S') Checked @endif>
                                        </label>
                                    </div>
                                    <div class="col-md-1 center">
                                        <label class="label-control">Porcelanato
                                            <input class="form-control" type="checkbox" id="IMB_IMV_PISOPORCELANATO"
                                            @if( $dadosimovel->IMB_IMV_PISOPORCELANATO=='S') Checked @endif>
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <hr>


                    </div>

                    <div class="tab-pane" id="tab_1_1_3">
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Local das Chaves
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                </div>
                            </div>

                            <div class="portlet-body form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <label class="label-control">Local</label>
                                            <select class="form-control" id="IMB_IMV_CHAVESSITUACAO">
                                                <option value="0" @if( $dadosimovel->IMB_IMV_CHAVESSITUACAO =='0') selected @endif>Não Informado</option>
                                                <option value="C"@if( $dadosimovel->IMB_IMV_CHAVESSITUACAO =='C') selected @endif>Corretor</option>
                                                <option value="I"@if( $dadosimovel->IMB_IMV_CHAVESSITUACAO =='I') selected @endif>Imobiliária</option>
                                                <option value="P"@if( $dadosimovel->IMB_IMV_CHAVESSITUACAO =='P') selected @endif>Proprietário</option>
                                                <option value="O"@if( $dadosimovel->IMB_IMV_CHAVESSITUACAO =='O') selected @endif>Outro</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="label-control">Box </label>
                                            <input class="form-control" id="IMB_IMV_CHABOX"
                                            value="{{$dadosimovel->IMB_IMV_CHABOX}}">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="label-control">Observações sobre as Chaves</label>
                                        <textarea rows="2" id="IMB_IMV_CHAVES" style="min-width: 100%">{{$dadosimovel->IMB_IMV_CHAVES}}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label" for="IMB_IMV_VALORAVALLOC">Valor Locação Avaliado</label>
                                        <input class="form-control valor valores-direita" type="text" value="{{number_format( $dadosimovel->IMB_IMV_VALORAVALLOC,2,',','.')}}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label" for="IMB_IMV_VALORAVALVEN">Valor Venda Avaliado</label>
                                        <input class="form-control valor valores-direita" type="text"  value="{{number_format( $dadosimovel->IMB_IMV_VALORAVALLOC,2,',','.')}}">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Observações do Imóvel(Uso interno)
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                </div>
                            </div>

                            <div class="portlet-body form">
                                <div class="form-body" ></div>
                                <div class="form-actions text-center">
                                    <textarea rows="5" id="IMB_IMV_OBSERV" style="min-width: 100%" >{{$dadosimovel->IMB_IMV_OBSERV}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Observações na Internet(no site)
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                </div>
                            </div>

                            <div class="portlet-body form">
                                <div class="form-body" ></div>
                                <div class="form-actions text-center">
                                    <textarea rows="5"id="IMB_IMV_OBSWEB" style="min-width: 100%" >{{$dadosimovel->IMB_IMV_OBSWEB}}</textarea>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane" id="tab_1_1_4">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="IMB_IMV_LINKVIDEO">Link do Vídeo</label>
                                <input class="form-control" type="text" id="IMB_IMV_LINKVIDEO" value="{{$dadosimovel->IMB_IMV_LINKVIDEO}}">
                            </div>
                        </div>
                        <div class="container">
                            <div class="col-md-12">
                                <h3 class="main-title div-center">Imagens Enviadas</h3>
                            </div>
                            <div id="galeria-imovel-inc"></div>
                        </div>                        
                        <div class="form-actions div-center">
                            <a href="{{route('imoveis.imagens.insertwm')}}/{{$imovel->IMB_IMV_ID}}">Forcar Marca d'agua</a>
                            <button type="button" id="galeria-imagem-btn" onClick="upLoadImagemDrop()" class="btn btn-primary"><i class="fa fa-camera-retro"></i> Fazer Upload</button>
                            <button type="button" id="galeria-update-btn" onClick="CarregarImagens( {{$imovel->IMB_IMV_ID}} )" class="btn btn-success escondido"><i class="fa fa-update"></i> Atualizar</button>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab_1_1_5">
                        <div class="col-md-6">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Corretor
                                    </div>
                                    <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>

                                <div class="portlet-body form">
                                    <table  id="tbcorimo" class="table table-striped table-bordered table-hover" >
                                        <thead class="thead-dark">
                                            <tr>
                                                <th width="70%" style="text-align:center"> Corretor </th>
                                                <th width="10%" style="text-align:center"> Percentual </th>
                                                <th width="20%" style="text-align:center"> Ações </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-footer" >
                                    <a  class="btn btn-sm btn-primary"
                                    role="button" onClick="adicionarCorImo()" >
                                    Adicionar Corretor </a>
                                    <!--data-toggle="modal" data-target="#modalFormaPagamento"-->
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Captador
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>

                                <div class="portlet-body form">
                                    <table  id="tbcapimo" class="table table-striped table-bordered table-hover" >
                                        <thead class="thead-dark">
                                            <tr>
                                                <th width="70%" style="text-align:center"> Captador </th>
                                                <th width="10%" style="text-align:center"> Percentual </th>
                                                <th width="20%" style="text-align:center"> Tipo</th>
                                                <th width="20%" style="text-align:center"> Ações </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-footer" >
                                    <a  class="btn btn-sm btn-primary"
                                    role="button" onClick="modalCaptadores()" >
                                    Adicionar Captador </a>
                                    <!--data-toggle="modal" data-target="#modalFormaPagamento"-->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-md-12">
                                    <label class="label-control">Condições Comerciais</label>
                                    <textarea rows="4" id="IMB_IMV_CONDICOESCOMERCIAIS" style="min-width: 100%">
                                    {{$dadosimovel->IMB_IMV_CONDICOESCOMERCIAIS}}</textarea>
                                </div>
                        </div>


                    </div>
                    <div class="tab-pane" id="tab_1_1_6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label for="IMB_IMV_TITULO_apoio">Título para portais e no site da imobiliária</label>
                                    <input class="form-control titulo" type="text" id="IMB_IMV_TITULO" value="{{$dadosimovel->IMB_IMV_TITULO}}">
                                    <span> <a href="javascript:gerarSugestaoTitulo()">Gerar Sugestão</a> </span>
                                </div>
                            </div>
                        </div>

                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Portais em que o imóvel está anunciado
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                </div>
                            </div>

                            <div class="portlet-body form">
                                <table  id="tbportalimovel" class="table table-striped table-bordered table-hover" >
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="text-align:center"> Portal </th>
                                            <th width="200" style="text-align:center"> Ações </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-footer" >
                                <a  class="btn btn-sm btn-primary"
                                role="button" onClick="imovelPortalInc()" >
                                    Adicional o Imóvel num Portal </a>
                            </div>
                        </div>

                        <div class="div-center">
                            <label class="label-control">Fazer Parte do Portal www.quadrodechaves.com.br
                                            <input type="checkbox" id="IMB_IMV_PORTALQUADROCHAVES" class="form-control" data-checkbox="icheckbox_flat-blue">
                                        </label>

                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="footer">
                        <div class="form-actions div-center">
                            <button type="button" class="btn default" id="i-btn-cancelar" onClick="avascript:window.close()">Cancelar</button>
                            <button type="button" class="btn blue " id="i-btn-gravar-agenda" onClick="onGravar()">
                            <i class="fa fa-check"></i> Gravar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <nav class="quick-nav">
        <a class="quick-nav-trigger" href="#0">
            <span aria-hidden="true"></span>
        </a>
        <ul>
        <li>
                <a href="javascript:onGravar();">
                    <span>Salvar Cadastro</span>
                    <i class="fas fa-save"></i>
                </a>
            </li>
            <li>
                <a href="javascript:onCancelar();">
                    <span>Cancelar</span>
                    <i class="fas fa-undo"></i>
                </a>
            </li>
        </ul>
        <span aria-hidden="true" class="quick-nav-bg"></span>
    </nav>
    <div class="quick-nav-overlay"></div>

</div>


<!--modal PORALIMO -->
<div class="modal" tabindex="-1" role="dialog" id="i-portalimovel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Portal de Anúncios
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="IMB_IMP_ID" >
                <div class="portlet-body form">
                    <div class="form-body" >
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Portal</label>
                                    <select class="form-control" id="IMB_POR_ID">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary" onClick="imovelPortalGravar()">Gravar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--modal CORIMO -->
<div class="modal" tabindex="-1" role="dialog" id="modalcorimo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Corretor do Imóvel
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                </div>
                        <input type="hidden" id="i-idcorimo" name="IMB_CORIMO_ID">
                        <input type="hidden" id="i-idimovel" name="IMB_IMV_ID"
                                                value="{{$imovel->IMB_IMV_ID}}">
                        <input type="hidden" id="i-idcorretor" >
                        <input type="hidden" id="i-idempresa" name="IMB_IMB_ID"
                                               value="{{$imovel->IMB_IMB_ID}}">
                        <div class="portlet-body form">
                            <div class="form-body" >
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Corretor</label>
                                            <select class="form-control" id="i-select-corretor" name="IMB_ATD_ID">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Percentual</label>
                                            <input class="form-control valor" id="i-percentual-cor">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button class="btn btn-primary" onClick="criarCorImo()">Salvar mudanças</button>
                        </div>



            </div>
        </div>
    </div>
</div>


<!--modal IMAGENS -->
@include('layout.modalimagem')

<!--modal CAPIMO -->
<div class="modal" tabindex="-1" role="dialog" id="modalcapimo">
    <div class="modal-dialog"  style="width:70%;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Captador do Imóvel
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                </div>
                        <input type="hidden" id="i-idcapimo" name="IMB_CAPIMO_ID">
                        <input type="hidden" id="i-idimovel-cap" name="IMB_IMV_ID"
                                                value="{{$imovel->IMB_IMV_ID}}">
                        <input type="hidden" id="i-idempresa-cap" name="IMB_IMB_IDCAPTADOR"
                                               value="{{$imovel->IMB_IMB_ID2}}">
                        <div class="portlet-body form">
                            <div class="form-body" >
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Captador</label>
                                            <select class="form-control" id="i-select-captador" name="IMB_ATD_ID">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Percentual</label>
                                            <input class="form-control valor" id="i-percentual-cap">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Tipo</label>
                                            <select  class="form-control" id="IMB_CAPIMO_TIPO">
                                                <option value="Venda">Venda</option>
                                                <option value="Locação">Locação</option>
                                                <option value="Ven./Loc.">Ven./Loc.</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button class="btn btn-primary" onClick=" criarCapImo()">Salvar mudanças</button>
                        </div>
                    


            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="propModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Proprietário do Imóvel
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" id="i-str"  placeholder="digite aqui um pedaço do nome" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <button class="btn btn-primary" onClick="buscaIncremental()">Carregar Sugestões</button>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="i-idpropimo" name="IMB_PPI_ID">
                    <input type="hidden" id="i-idimovel-prop" name="IMB_IMV_ID"
                                                value="{{$imovel->IMB_IMV_ID}}">
                    <div class="row">
                        <div class="col-md-12" id="div-a-selecionar">
                            <div class="form-group">
                                <select class="form-control" id="selclientelike" readonly>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10 div-cinza div-center-table-clientes" id="div-listaclientes">
                            <table class="table  table-striped table-hover" id="tblclientes"  width=300 height=100>
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="20%" >Nome</th>
                                        <th width="30%" >Fones</th>
                                        <th width="10%"
                                            style="text-align:center"> -
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="control-label">% Partic.</label>
                                    <input type="number" id="i-percentual-prop"
                                    class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>
                                    <input type="checkbox"
                                        class="form-control"
                                        id="i-principal-prop">
                                        Principal
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-6 center">
                            <label >O Cliente não está cadastrado?</label>
                            <a  class="btn btn-success" href="{{route('cliente.add')}}">Cadastro de um Novo Cliente</a>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onClick="criarPropImo()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modalimagemgrande">
    <div class="modal-dialog" style="width:90%;" role="document">
        <div class="modal-content">
            <div class="modal-body div-center" id="i-imagem-grande">
            </div>
            <div class="modal-footer div-center">
                <button class="btn btn-success" data-dismiss="modal"> Voltar Para o Album de Fotos</button>
            </div>
        </div>
    </div>
</div>

<form style="display: none" action="{{route('cliente.edit')}}" method="POST" id="form-alt-cliente-indexctr"  target="_blank">
    @csrf
        <input type="hidden" id="id-cliente-prop" name="id" />
        <input type="hidden" id="readonly" name="readonly" value="readonly"/>
    </form>
    
<form style="display: none" action="{{route('imoveis.imagens.dragdrop')}}" method="get" id="form-img"  target="_blank">
    <input type="hidden" id="i-idimovel-imgdrag" name="id" value="{{$imovel->IMB_IMV_ID}}"/>
</form>

@include( 'layout.modalCadBairro')
@include( 'layout.clienterapido')

@endsection
@push('script')

<script type="text/javascript">
    $("#i-form-imovel :input").prop("disabled", false);

</script>
<script src="{{asset('/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/dropzone.js')}}"></script>

<script>
    $(document).ready(function() {



        if( $("#i-idempresa").val() != $("#I-IMB_IMB_IDMASTER").val() )
        {
          window.history.back();
          return false;
        }
        $("#i-imagens-click").click( function()
        {
            CarregarImagens( $("#IMB_IMV_ID").val());


        });

        preencherCBCorretores(999999);
        calcularPerProp();
        temPrincipal();
        //cargaImovel();
        portalImovelCarga();

        CarregarPropImo( $("#IMB_IMV_ID").val());
        CarregarCorImo( $("#IMB_IMV_ID").val());
        CarregarCapImo( $("#IMB_IMV_ID").val());

        $("#sirius-menu").click();

        $("#galeria-imagem-upload").on("change", function (e) {
                var file = $(this)[0].files[0];
                //console.log('up');
                upLoadImagem();
            });

        $("#galeria-imagem-btn").click(function()
        {
            $("#galeria-imagem-upload").click();
        });

        if( $("#i-somenteleitura").val() == 'readonly')
        {

            $("#i-btn-cancelar").html('OK');
            $("#i-btn-gravar-agenda").hide();
            $("#formedit :input").attr("disabled", true);
        }


        $(".select2").select2({
            placeholder: 'Selecione',
            width: null
        });

    });
    Dropzone.autoDiscover = false;
        Dropzone.options.imageUpload = {
            maxFilesize         :       1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif"
        };

        Dropzone.options.filedrop = {
    maxFilesize: 4096,
    init: function () {
        this.on("complete", function (file) {
            CarregarImagens($("#IMB_IMV_ID").val() );
        });
    }
};
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

      $("#VIS_STA_ID").on( "blur", function(e)
      {
          statusImovel( $("#VIS_STA_ID").val() );
      });

      $('#IMB_IMV_ENDERECOCEP').on('blur', () =>
        {
            let token = document.head.querySelector('meta[name="csrf-token"]');
            if (token)
            {
                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
            }
            else
            {
                console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
            }


            if ($.trim($('#IMB_IMV_ENDERECOCEP').val()) !== '' && $("#IMB_IMV_ENDERECO").val() == '' )

            {
                //console.log('passando');
                $('#mensagem').html('(Aguarde, consultando CEP ...)');

                // NOVO CODIGO =============================================

                // Guardar o CEP do input.
                const cep = $('#IMB_IMV_ENDERECOCEP').val();

                // Construir a url com o CEP do input.
                // IMPORTANTE: na url, informar o parametro formato=json ao invés de formato=javascript.

                const urlBuscaCEP = 'https://viacep.com.br/ws/'+cep+'/json';

                // Realizar uma requisição HTTP GET na url.
                // O primeiro parâmetro é a url.
                // O segundo parâmetro é o callback, ou seja,
                // uma função que vai ser executada quando os dados forem retornados.
                // Essa função recebe um parâmetro que são os dados que a API retornou.
                $.get(urlBuscaCEP, (resultadoCEP) =>
                {

                       $('#IMB_IMV_ENDERECOTIPO').val('');
                        $('#IMB_IMV_ENDERECO').val(resultadoCEP.logradouro.substr( 0, 40 ));
                        $('#CEP_BAI_NOME').val(resultadoCEP.bairro.substr( 0, 60 ).toUpperCase());
                        $('#IMB_IMV_CIDADE').val(resultadoCEP.localidade.substr( 0, 40 ).toUpperCase());
                        $('#IMB_IMV_ESTADO').val(resultadoCEP.uf);

                        verificarBairroCadastrado( $('#CEP_BAI_NOME').val(), $('#IMB_IMV_CIDADE').val(), $('#IMB_IMV_ESTADO').val(),'S' );

                });
            }
        });


    function selecionarCliente()
    {
        var clienteselecionado = $("#selclientelike").val();
            $("#IMB_CLT_ID").val( clienteselecionado);
            $("#propModal").modal('hide');
            nomeprop = $('#selclientelike').find(":selected").text();
            $("#nomeprop").val( nomeprop );

    }

    function alterarProp()
    {
        var prop = $("#nomeprop").val();
            $("#propModal").modal('show');
            $("#i-str").val( prop );
            buscaIncremental();

    }


    function buscaIncremental()
    {
        $("#div-listaclientes").show();
        str = $("#i-str").val();
        if( isNaN( str) )
        {
            var url = "{{ route('buscaclienteincremental') }}"+"/"+str;

            $.getJSON( url, function( data)
            {
                linha = "";
                $("#tblclientes>tbody").empty();
//                console.log( data );
                for( nI=0;nI < data.length;nI++)
                {
//                    console.log('linha '+linha );
                    linha =
                        '<tr>'+
                        '<td style="text-align:center valign="center">'+data[nI].IMB_CLT_NOME+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].FONES+'</td>' +
                        '<td style="text-align:center" valign="center"> '+
                            '<a href=javascript:selecionar('+data[nI].IMB_CLT_ID+') class="btn btn-sm btn-primary">Selecionar</a> '+
                        '</td> ';
                    linha = linha +
                        '</tr>';

                    $("#tblclientes").append( linha );

                }

            });
        }
        else
        {
            var url = "{{ route('cliente.localizar.telefone') }}"+"/"+str;

            $.getJSON( url, function( data)
            {
                if( data != ' ')
                {
                    linha = "";
                    $("#tblclientes>tbody").empty();
                    linha =
                            '<tr>'+
                            '<td style="text-align:center valign="center">'+data.IMB_CLT_NOME+'</td>' +
                            '<td style="text-align:center valign="center">'+data.FONES+'</td>' +
                            '<td style="text-align:center" valign="center"> '+
                                '<a href=javascript:selecionar('+data.IMB_CLT_ID+') class="btn btn-sm btn-primary">Selecionar</a> '+
                            '</td> ';
                    linha = linha +
                            '</tr>';

                    $("#tblclientes").append( linha );
                }

            });
        }

    }

    function selecionar( id )
    {
        if( id == '' )
        {
            alert('Selecione um cliente válido!');
            return false;
        }
        var url = "{{route('cliente.find')}}/"+id;
//        console.log( 'url '+url );

        $.ajax
        (
            {
                url         : url,
                type        : 'get',
                dataType    : 'json',
                async       : false,
                success     : function( data )
                {
                    $("#selclientelike").empty();
                    $("#selclientelike").append( '<option value="'+id+'">'+data.IMB_CLT_NOME+'</option>');

                }

            }
        )




        $("#div-listaclientes").hide();


    }


    function adicionarCorImo()
    {
        $("#i-idcorimo").val('');
        modalCorretor();

    }
    //corretores do imovel

    function adicionarCapImo()
    {
        $("#i-idcapimo").val('');
        modalCaptadores();

    }


    function editarCorImo( id )
    {
        var url = "{{ route('corimo.editar') }}"+"/"+id;
        $.getJSON( url, function( data)
        {
            modalCorretor();
            preencherCBCorretores(data.IMB_ATD_ID);
            $("#i-idcorimo").val(data.IMB_CORIMO_ID);
            $("#i-idempresa").val(data.IMB_IMB_ID);
            $("#i-idimovel").val(data.IMB_IMV_ID);
            $("#i-percentual-cor").val(dolarToReal(data.IMB_CORIMO_PERCENTUAL));
//            $("#i-select-corretor").val(data.IMB_ATD_ID);
            //console.log( 'corretor definido '+data.IMB_ATD_ID);

        });
    }

    function CarregarCorImo( nId )
    {
        var url = "{{ route('corimo.carga') }}"+"/"+nId;
        $.getJSON( url, function( data)
        {
            linha = "";
            $("#tbcorimo>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                linha =
                    '<tr>'+
                    '   <td class="div-center">'+data[nI].IMB_ATD_NOME+'</td>'+
                    '   <td class="div-center">'+data[nI].IMB_CORIMO_PERCENTUAL+'%</td>'+
                    '   <td style="text-align:center"> '+
//                    '<a  class="btn btn-sm btn-primary" href=javascript:editarCorImo('+data[nI].IMB_CORIMO_ID+')>Editar</a>&nbsp;&nbsp;&nbsp;&nbsp;'+
//                    '           <button class="btn btn-sm btn-primary" onclick="editarCorImo('+data[nI].IMB_CORIMO_ID+' )">Editar</button>'+
//                    '           <button class="btn btn-sm btn-danger" onclick="apagarCorImo('+data[nI].IMB_CORIMO_ID+' )">Apagar</button>'+
                    '<a  class="btn btn-sm btn-primary" href=javascript:editarCorImo('+data[nI].IMB_CORIMO_ID+')><i class="fa fa-pencil" aria-hidden="true"></i></a>'+
                    '<a  class="btn btn-sm btn-danger" href=javascript:apagarCorImo('+data[nI].IMB_CORIMO_ID+')><i class="fa fa-trash" aria-hidden="true"></i>'+
                    '   </td>'+
                    '</tr>';

                $("#tbcorimo").append( linha );

            }
        });
    }




    function apagarCorImo( id )
    {
        var url = "{{ route('corimo.apagar') }}"+"/"+id;

        if (confirm("Tem certeza que deseja excluir?"))
        {
            $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });
            $.ajax
            ({
                type: "delete",
                url: url,
                context: this,
                success: function()
                {
                    CarregarCorImo( $("#i-idimovel").val() );
                },
                error: function( error )
                {
                    console.log(error);
                }
            });
        };

    }




    function preencherCBCorretores( nidcorretor )
    {
        var empresa = $("#I-IMB_IMB_IDMASTER").val();
        var url = "{{ route('atendente.carga')}}";

//        console.log('url carga atendente: '+url );

        $.getJSON( url+"/"+empresa, function( data )
        {
            linha = "";
            $("#i-select-corretor").empty();
            for( nI=0;nI < data.length;nI++)
            {

                if ( data[nI].IMB_ATD_ID  == nidcorretor )
                {
                    linha =
                        '<option value="'+data[nI].IMB_ATD_ID+'" selected>'+
                        data[nI].IMB_ATD_NOME+"</option>";
                    $("#i-select-corretor").append( linha )
                }
                else
                {
                linha =
                        '<option value="'+data[nI].IMB_ATD_ID+'">'+
                        data[nI].IMB_ATD_NOME+"</option>";
                    $("#i-select-corretor").append( linha );
                }
            }
        });

    }

    function preencherCorretoresChave( nidcorretor )
    {
        var empresa = $("#I-IMB_IMB_IDMASTER").val();
        var url = "{{ route('atendente.carga')}}";

//        console.log('url carga atendente: '+url );

        $.getJSON( url+"/"+empresa, function( data )
        {
            $("#IMB_ATD_IDCHAVE").empty();
            linha = '<option value="0"></option>';
            $("#IMB_ATD_IDCHAVE").append( linha )
            for( nI=0;nI < data.length;nI++)
            {

                if ( data[nI].IMB_ATD_ID  == nidcorretor )
                {
                    linha =
                        '<option value="'+data[nI].IMB_ATD_ID+'" selected>'+
                        data[nI].IMB_ATD_NOME+"</option>";
                    $("#IMB_ATD_IDCHAVE").append( linha )
                }
                else
                {
                linha =
                        '<option value="'+data[nI].IMB_ATD_ID+'">'+
                        data[nI].IMB_ATD_NOME+"</option>";
                    $("#IMB_ATD_IDCHAVE").append( linha );
                }
            }
        });

    }

    function criarCorImo()
    {
    $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });
            corimo =
        {
            IMB_IMB_ID : $("#I-IMB_IMB_ID2").val(),
            IMB_IMV_ID : $("#i-idimovel").val(),
            IMB_ATD_ID : $("#i-select-corretor").val(),
            IMB_CORIMO_ID : $("#i-idcorimo").val(),
            IMB_CORIMO_PERCENTUAL : realToDolar($("#i-percentual-cor").val()),
        };

        //alert( 'CORIMO.IMB_IMB_ID : '+corimo.IMB_IMB_ID );


        $.ajax(
            {
                url : "{{ route( 'corimo.salvar' ) }}",
                dataType:'json',
                type:'post',
                async:false,
                data:corimo,
                success:function()
                {
                    
                    $("#modalcorimo").modal("hide");
                    CarregarCorImo($("#i-idimovel").val());
                }
        });

        

    };


    {
        var combo = document.getElementById("i-select-corretor");
        console.log('entrei')    ;
        for (var i = 0; i < combo.options.length; i++)
        {
            if (combo.options[i].value == id)
            {
                console.log('valo comb ' +combo.options[i].value );
                combo.options[i].selected = "true";
                break;
		    }
	    }
    }


    function modalCorretor()
    {
        var unidade = $("#IMB_IMB_ID2").val();
        if (  ( unidade == null ) || ( unidade == '-1')  )

        {
            alert( 'Informe primeiro a qual unidade este imóvel pertence!')
        }
        else
        {
            $("#modalcorimo").modal('show');
            $("#i-percentual").val('100');
        }

    }
//FIM CORRETORES


//INICIO CAPTADORES
function modalCaptadores()
    {
        $("#modalcapimo").modal('show');
        $("#i-percentual-cap").val('0');
        preencherCBCaptadores();
    }



    function preencherCBCaptadores( nidcorretor )
    {
        var empresa = $("#I-IMB_IMB_IDMASTER").val();
        var url = "{{ route('atendente.carga')}}";
        $.getJSON( url+"/"+empresa, function( data )
        {
            linha = "";
            $("#i-select-captador").empty();
            for( nI=0;nI < data.length;nI++)
            {

                if ( data[nI].IMB_ATD_ID  == nidcorretor )
                {
                    linha =
                        '<option value="'+data[nI].IMB_ATD_ID+'" selected>'+
                        data[nI].IMB_ATD_NOME+"</option>";
                    $("#i-select-captador").append( linha )
                }
                else
                {
                linha =
                        '<option value="'+data[nI].IMB_ATD_ID+'">'+
                        data[nI].IMB_ATD_NOME+"</option>";
                    $("#i-select-captador").append( linha );
                }
            }
        });
    }


    function editarCapImo( id )
    {
        var url = "{{ route('capimo.editar') }}"+"/"+id;
        $.getJSON( url, function( data)
        {
            modalCaptadores();
            preencherCBCaptadores(data.IMB_ATD_ID);
            $("#i-idcapimo").val(data.IMB_CAPIMO_ID)    ;
            $("#i-idempresa-cap").val(data.IMB_IMB_ID);
            $("#i-idimovel-cap").val(data.IMB_IMV_ID);
            $("#i-percentual-cap").val(dolarToReal(data.IMB_CAPIMO_PERCENTUAL));
            $("#IMB_CAPIMO_TIPO").val(data.IMB_CAPIMO_TIPO);

        });
    }

    function CarregarCapImo( nId )
    {
        var url = "{{ route('capimo.carga') }}"+"/"+nId;
        $.getJSON( url, function( data)
        {
            linha = "";
            $("#tbcapimo>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                linha =
                    '<tr>'+
                    '   <td class="div-center">'+data[nI].IMB_ATD_NOME+'</td>'+
                    '   <td class="div-center">'+data[nI].IMB_CAPIMO_PERCENTUAL+'</td>'+
                    '   <td class="div-center">'+data[nI].IMB_CAPIMO_TIPO+'</td>'+
                    '   <td style="text-align:center"> '+
//                    '<a  class="btn btn-sm btn-primary" href=javascript:editarCorImo('+data[nI].IMB_CORIMO_ID+')>Editar</a>&nbsp;&nbsp;&nbsp;&nbsp;'+
//                    '           <button class="btn btn-sm btn-primary" onclick="editarCorImo('+data[nI].IMB_CORIMO_ID+' )">Editar</button>'+
//                    '           <button class="btn btn-sm btn-danger" onclick="apagarCorImo('+data[nI].IMB_CORIMO_ID+' )">Apagar</button>'+
                    '<a  class="btn btn-sm btn-primary" href=javascript:editarCapImo('+data[nI].IMB_CAPIMO_ID+')><i class="fa fa-pencil" aria-hidden="true"></i></a>'+
                    '<a  class="btn btn-sm btn-danger" href=javascript:apagarCapImo('+data[nI].IMB_CAPIMO_ID+')><i class="fa fa-trash" aria-hidden="true"></i></a>'+
                    '   </td>'+
                    '</tr>';

                $("#tbcapimo").append( linha );

            }
        });
    }



    function apagarCapImo( id )
    {
        var url = "{{ route('capimo.apagar') }}"+"/"+id;

        if (confirm("Tem certeza que deseja excluir?"))
        {
            $.ajaxSetup({
                headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
            });
            $.ajax
            ({
                type: "delete",
                url: url,
                context: this,
                success: function()
                {
                    CarregarCapImo( $("#i-idimovel").val() );
                },
                error: function( error )
                {
                    console.log(error);
                }
            });
        };

    }



    function criarCapImo()
    {
            $.ajaxSetup({
                headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
            });

            
     capimo =
        {
            IMB_IMB_ID : $("#I-IMB_IMB_ID2").val(),
            IMB_IMV_ID : $("#i-idimovel-cap").val(),
            IMB_ATD_ID : $("#i-select-captador").val(),
            IMB_CAPIMO_ID : $("#i-idcapimo").val(),
            IMB_CAPIMO_PERCENTUAL :realToDolar($("#i-percentual-cap").val()),
            IMB_CAPIMO_TIPO:$("#IMB_CAPIMO_TIPO").val(),
        };

        $.ajax( 
            {
                url:"{{ route( 'capimo.salvar' ) }}",
                dataType:'json',
                type:'post',
                async:false,
                data:capimo,
                success:function()
                {
                    
                    $("#modalcapimo").modal("hide");
                    CarregarCapImo( $("#i-idimovel").val() );
                }
            });


    };


    $("#formCapImo").submit
        ( function( event )
        {
            event.preventDefault();
            //alert($("#i-idcorimo").val());
                   criarCapImo();

            CarregarCapImo($("#i-idimovel").val());

         });

    function setarSelectCaptadores(id)
    {
        var combo = document.getElementById("i-select-captador");
        for (var i = 0; i < combo.options.length; i++)
        {
                if (combo.options[i].value == id)
            {
                combo.options[i].selected = "true";
                break;
		    }
	    }
    }

//FIM CAPTADORES






        //área de IMAGENS
    function CarregarImagens( id )
    {
        
        $( "#galeria-imovel-inc" ).empty();        
        $("#galeria-update-btn").hide();        
        var url = "{{ route( 'imagens.imoveis')}}/"+id;

        var empresa = "{{Auth::user()->IMB_IMB_ID}}";
        console.log('recarregar');
        $("#preloader").show();
        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                async:false,
                success:function( data )
                {
            
                    contador = 4;
                    texto='';
                    for( nI=0;nI < data.length;nI++)
                    {

                        console.log('recarregando');
                        console.log( data[nI]);
                        if( data[nI].IMB_IMG_PRINCIPAL !='S')
                            principal = '<a title="Definir essa imagem como a imagem principal" href=javascript:imagemPrincipal('+data[nI].IMB_IMV_ID+','+
                                            data[nI].IMB_IMG_ID+') class="btn btn-sm btn-warning"><i class="fa fa-check-square-o" aria-hidden="true"></i></a> '
                        else
                            principal =
                                '<a class="btn btn-sm btn-success">Principal</a> ';

                        bloqnet = '';
                        if( data[nI].IMB_IMG_NAOIRPROSITE == 'S')
                            bloqnet = '<a title="Não vai pro site"><i class="fa fa-ban" aria-hidden="true"></i><a>';

                        texto = '<div class="col-lg-3 border-05">'+
                                '   <div class="card">'+
                                '       <div class="card-body"> '+
                                '          <h5 class="card-title div-center">'+data[nI].IMB_IMG_NOME+'</h5>' +
                                '       </div> '+

                                '       <a title="click na imagem para ir para o album" href="javascript:verImagem('+data[nI].IMB_IMV_ID+', \''+data[nI].IMB_IMG_ARQUIVO+'\' )"><img id="img'+data[nI].IMB_IMG_ID+'" class="img-album" src={{url('')}}/storage/images/'+empresa+'/imoveis/'+data[nI].IMB_IMV_ID+'/'+data[nI].IMB_IMG_ARQUIVO+'?v='+moment().format('YYYYDDMMHHMMSS')+'></a>'+
                                '       <a title="Alterar ou complementar informações para esta imagem" href=javascript:editarImagem('+data[nI].IMB_IMG_ID+') class="btn btn-sm btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>'+
                                '       <a title="Rotacionar Imagem para Direita em 90º" href=javascript:rotacionar('+data[nI].IMB_IMG_ID+',90) class="btn btn-sm btn-secondary"><i class="fa fa-rotate-right" aria-hidden="true"></i></a>'+
                                '       <a title="Rotacionar Imagem para Esquerda em 90º" href=javascript:rotacionar('+data[nI].IMB_IMG_ID+',-90) class="btn btn-sm btn-secondary"><i class="fa fa-rotate-left" aria-hidden="true"></i></a>'+
                                                
                                '&nbsp;&nbsp;<a title="Excluir a imagem" href=javascript:apagarImagem('+data[nI].IMB_IMG_ID+') class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>'+
                                '&nbsp;&nbsp;'+principal+
                                '&nbsp;&nbsp;'+bloqnet+
                                '   </div> '+
                                '</div>';
                        $( "#galeria-imovel-inc" ).append( texto );                

                    }
                },
                complete:function()
                {
                    $("#preloader").hide();
                }


            });
    }


    function imagemPrincipal( idimovel, idimagem)
    {
        $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
            });

            var url = "{{ route('imagem.principal') }}"+"/"+idimovel+"/"+idimagem;

        $.ajax(
            {
                type: "post",
                url: url,
                context: this,
                success: function()
                {
                    CarregarImagens(idimovel );
                },
                error: function( error )
                {
                    console.log(error);
                }

        });


    }

    function apagarImagem( id )
    {
        if (confirm("Tem certeza que deseja excluir a Imagem?"))
        {

            $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
            });

            var url = "{{ route('imagem.apagar') }}"+"/"+id;
            console.log( url );
            $.ajax
            (
                {
                    type: "get",
                    url: url,
                    context: this,
                    success: function(){
                        CarregarImagens( $("#IMB_IMV_ID").val() );
                    },
                    error: function( error ){
                        console.log(error);
                    }
                }
            );
            }

    }

    function editarImagem( id )
    {

        var url = "{{ route('imagem.editar') }}"+"/"+id;
        $.getJSON( url, function( data)
        {
            $("#i-idimg").val(data.IMB_IMG_ID);
            $("#i-nomeimagem").val(data.IMB_IMG_NOME);
            $("#i-imagemprincipal" ).prop( "checked", (data.IMB_IMG_PRINCIPAL =='S') );
            $("#i-imagemnaoirsite").prop( "checked", (data.IMB_IMG_NAOIRPROSITE =='S') );
            $("#i-imagemcapa").prop( "checked", (data.IMB_IMG_CAPA =='S') );
//            setarSelectCorretor(data.IMB_ATD_ID);
            $("#modalimagem").modal('show');
        });

    }

           //alert($("#i-idcorimo").val());



    function preencherUnidades( nId )
    {


        $.getJSON( "{{route('imobiliaria.carga')}}/"+$("#I-IMB_IMB_IDMASTER").val(), function( data )
        {

            $("#IMB_IMB_ID2").empty();

            linha =  '<option value="-1">Todas Unidades</option>';
            $("#IMB_IMB_ID2").append( linha );
            for( nI=0;nI < data.length;nI++)
            {
                linha =
                    '<option value="'+data[nI].IMB_IMB_ID+'">'+
                        data[nI].IMB_IMB_NOME;
                linha = linha + "</option>";
                        $("#IMB_IMB_ID2").append( linha );

            }

            $("#IMB_IMB_ID2").val( nId );

        });


    }

    function preencherTipoImovel( nId )
    {
        $.getJSON( "{{ route('tipoimovel.carga')}}", function( data )
        {

            $("#IMB_TIM_ID").empty();
            for( nI=0;nI < data.length;nI++)
            {
                linha =
                    '<option value="'+data[nI].IMB_TIM_ID+'">'+
                        data[nI].IMB_TIM_DESCRICAO;
                linha = linha + "</option>";
                        $("#IMB_TIM_ID").append( linha );

            }

            $("#IMB_TIM_ID").val( nId );

        });

    }

    function onGravar()
    {


        var id = $("#IMB_IMV_ID").val();

        var valorvenda = realToDolar( $("#IMB_IMV_VALVEN").val() );

        var valorlocacao = realToDolar( $("#IMB_IMV_VALLOC").val() );

        var valorcondominio = realToDolar( $("#imb_imv_valorcondominio").val() );

        var valoriptu =  realToDolar( $("#IMB_IMV_VALORIPTU").val() );

        var valorlocacaoaval =  realToDolar( $("#IMB_IMV_VALORAVALLOC").val() );
        var valorvendaaval =  realToDolar( $("#IMB_IMV_VALORAVALVEN").val() );



        if( valorlocacaoaval == '' )
            valorlocacaoaval = 0;

        if( valorvendaaval == '' )
            valorvendaaval = 0;

        if( valoriptu == '' )
            valoriptu = 0;

        if( valorcondominio == '' )
            valorcondominio = 0;

        if( valorvenda == '' )
           valorvenda = 0;


        if( valorlocacao == '' )
            valorlocacao = 0;

        var valorinformado =
            parseFloat( valorlocacao )  +
            parseFloat( valorvenda );



        var nerros = 0;
        var cerros = '';

/*        var count =  $('#tbcorimo tr').length
        if ( count == 1)
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Obrigatório informar o corretor\n';
        }

*/
        if( $("#cep").val() > 99999999 )
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Cep com erro!\n';
        }

        if( $("#cep").lenght > 8 )
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Cep com erro!\n';
        }


        if (calcularPerProp() != 100 )
        {
            nerros = nerros  + 1;
            cerros = cerros + 'O total de participação em proprietário(s) deve 100%\n';
        }


        if ( temPrincipal() == 0 )
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Deve haver pelo menos um proprietário como principal\n';
        }

        if ( temPrincipal() > 1 )
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Somente um único proprietário pode ser o principal\n';
        }

        if ( $("#IMB_CLT_ID").val() == "" )
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Faltando informar o proprietario \n';
        }



    //    alert( valorinformado );

        if ( valorinformado == 0 )
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Faltando informar o valor de venda e/ou locação \n';
        }

        if ($('#IMB_IMV_ID').val() == null )
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Informe o tipo de imóvel \n';
        }

        if ($('#IMB_IMB_ID2').val() == null )
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Informe qual agência(unidade) pertence o imóvel\n';
        }

        if(nerros>0){
            alert( cerros );
            return false;
	    }


        var web = 'N';
        if ( $("#IMB_IMV_WEBIMOVEL").prop( "checked" ) )
            web = 'S';

            var exclusivo = 'N';
        if ( $("#IMB_IMV_ESCLUSIVO").prop( "checked" ) )
           exclusivo = 'S';

        var destaque = 'N';
        if ( $("#IMB_IMV_DESTAQUE").prop( "checked" ) )
        destaque = 'S';


        var lancamento = 'N';
        if ( $("#IMB_IMV_WEBLANCAMENTO").prop( "checked" ) )
        lancamento = 'S';


        var terrea = 'N';
        if ( $("#IMB_IMV_TERREA").prop( "checked" ) )
        terrea = 'S';

        var sobrado = 'N';
        if ( $("#IMB_IMV_SOBRADO").prop( "checked" ) )
        sobrado = 'S';


        var placa = 'N';
        if ( $("#IMB_IMV_PLACA").prop( "checked" ) )
        placa = 'S';

        var financiamento = 'N';
        if ( $("#IMB_IMV_ACEITAFINANC").prop( "checked" ) )
        financiamento = 'S';

        var permuta = 'N';
        if ( $("#IMB_IMV_PERMUTA").prop( "checked" ) )
        permuta = 'S';

        var dorae = 'N';
        if ( $("#IMB_IMV_DORAE").prop( "checked" ) )
        dorae = 'S';

        var suitehid = 'N';
        if ( $("#IMB_IMV_SUIHID").prop( "checked" ) )
        suitehid = 'S';

        var dorclo = 'N';
        if ( $("#IMB_IMV_DORCLO").prop( "checked" ) )
        dorclo = 'S';

        var cozinha = 'N';
        if ( $("#IMB_IMV_COZINHA").prop( "checked" ) )
        cozinha = 'S';

        var cozinha = 'N';
        if ( $("#IMB_IMV_COZINHA").prop( "checked" ) )
        cozinha = 'S';

        var suspenso = 'N';
        if ( $("#IMB_IMV_SUSPENSO").prop( "checked" ) )
        suspenso = 'S';

        var cozpla = $("#IMB_IMV_COZPLA").prop('checked') ? 'S' : 'N';
        var lavabo = $("#IMB_IMV_LAVABO").prop('checked') ? 'S' : 'N';
        var empdor = $("#IMB_IMV_EMPQUA").prop('checked') ? 'S' : 'N';
        var empwc = $("#IMB_IMV_EMPWC").prop('checked') ? 'S' : 'N';
        var despensa = $("#IMB_IMV_DESPENSA").prop('checked') ? 'S' : 'N';
        var piscina = $("#IMB_IMV_PISCIN").prop('checked') ? 'S' : 'N';
        var edicula = $("#IMB_IMV_EDICUL").prop('checked') ? 'S' : 'N';
        var quintal = $("#IMB_IMV_QUINTA").prop('checked') ? 'S' : 'N';
        var churra = $("#IMB_IMV_CHURRA").prop('checked') ? 'S' : 'N';
        var portaoele = $("#IMB_IMV_PORELE").prop('checked') ? 'S' : 'N';
        var terrea= $("#IMB_IMV_TERREA").prop('checked') ? 'S' : 'N';
        var cozpla = $("#IMB_IMV_COZPLA").prop('checked') ? 'S' : 'N';
        var sauna = $("#IMB_IMV_SAUNA").prop('checked') ? 'S' : 'N';
        var quadrapoli = $("#IMB_IMV_QUADRAPOLIESPORTIVA").prop('checked') ? 'S' : 'N';
        var salaofes = $("#IMB_IMV_SALFES").prop('checked') ? 'S' : 'N';
        var plagro = $("#IMB_IMV_PLAGRO").prop('checked') ? 'S' : 'N';
        var escritura = $("#IMB_IMV_ESCRIT").prop('checked') ? 'S' : 'N';
        var dorae = $("#IMB_IMV_DORAE").prop('checked') ? 'S' : 'N';
        var superdestaque = $("#IMB_IMV_SUPERDESTAQUE").prop('checked') ? 'S' : 'N';
        var areaser = $("#IMB_IMV_ARESER").prop('checked') ? 'S' : 'N';
        var alarme = $("#IMB_IMV_ALARME").prop('checked') ? 'S' : 'N';
        var arcondicionado = $("#IMB_IMV_ARAPARELHO").prop('checked') ? 'S' : 'N';
        var lareira = $("#IMB_IMV_LAREIRA").prop('checked') ? 'S' : 'N';
        var semimobiliado = $("#IMB_IMV_SEMIMOB").prop('checked') ? 'S' : 'N';
        var interfone = $("#IMB_IMV_INTERF").prop('checked') ? 'S' : 'N';
        var aguaquente = $("#IMB_IMV_AGUAQUENTE").prop('checked') ? 'S' : 'N';
        var sacada = $("#IMB_IMV_SACADA").prop('checked') ? 'S' : 'N';
        var elevadores = $("#IMB_IMV_ELEVADORES").prop('checked') ? 'S' : 'N';
        var portalquadrochaves = $("#IMB_IMV_PORTALQUADROCHAVES").prop('checked') ? 'S' : 'N';




        idchave = $("#IMB_ATD_IDCHAVE").val();
        if( idchave == null )
            idchave = 0;

//        alert( idchave );


        var imoveis =
        {
            IMB_IMB_ID : $("#I-IMB_IMB_IDMASTER").val(),
            IMB_IMB_ID2 : $("#IMB_IMB_ID2").val(),
            IMB_IMV_ID : $("#IMB_IMV_ID").val(),
            IMB_CLT_ID : $("#IMB_CLT_ID").val(),
            IMB_IMV_ENDERECO : $("#IMB_IMV_ENDERECO").val(),
            IMB_IMV_ENDERECONUMERO : $("#IMB_IMV_ENDERECONUMERO").val(),
            IMB_IMV_ENDERECOCOMPLEMENTO : $("#IMB_IMV_ENDERECOCOMPLEMENTO").val(),
            IMB_IMV_WEBIMOVEL : web,
            IMB_IMV_DESTAQUE : destaque,
            IMB_IMV_WEBLANCAMENTO : lancamento,
            IMB_IMV_ESCLUSIVO :  exclusivo,
            IMB_IMV_TERREA : terrea,
            IMB_IMV_SOBRADO : sobrado,
            IMB_IMV_PLACA : placa,
            IMB_IMV_ACEITAFINANC : financiamento,
            IMB_IMV_PERMUTA : permuta,
            IMB_IMV_COZPLA : cozpla,
            IMB_IMV_LAVABO : lavabo,
            IMB_IMV_EMPQUA : empdor,
            IMB_IMV_EMPWC : empwc,
            IMB_IMV_DESPENSA : despensa,
            IMB_IMV_PISCIN : piscina,
            IMB_IMV_EDICUL : edicula,
            IMB_IMV_QUINTA :quintal,
            IMB_IMV_CHURRA : churra,
            IMB_IMV_PORELE :portaoele,
            IMB_IMV_SAUNA : sauna,
            IMB_IMV_QUADRAPOLIESPORTIVA :quadrapoli,
            IMB_IMV_SALFES : salaofes,
            IMB_IMV_PLAGRO : plagro,
//            IMB_IMV_DATACADASTRO : $("#IMB_IMV_DATACADASTRO").val(),
            IMB_IMV_DATSUS : $("#IMB_IMV_DATSUS").val(),
            IMB_IMV_REFERE : $("#IMB_IMV_REFERE").val(),
            IMB_IMV_VALVEN : valorvenda,
            IMB_IMV_VALLOC : valorlocacao,

            IMB_IMV_VALORAVALVEN: valorvendaaval,
            IMB_IMV_VALORAVALLOC: valorlocacaoaval,

            IMB_IMV_ENDERECOTIPO : $("#IMB_IMV_ENDERECOTIPO").val(),
            IMB_IMV_NUMAPT : $("#IMB_IMV_NUMAPT").val(),
            IMB_IMV_PREDIO : $("#IMB_IMV_PREDIO").val(),
            IMB_IMV_ANDAR : $("#IMB_IMV_ANDAR").val(),
            CEP_BAI_NOME : $("#CEP_BAI_NOME").val(),
            CEP_BAI_ID : $("#CEP_BAI_ID").val(),
            IMB_IMV_ENDERECOCEP : $("#IMB_IMV_ENDERECOCEP").val(),
            IMB_IMV_CIDADE : $("#IMB_IMV_CIDADE").val(),
            IMB_IMV_ESTADO : $("#IMB_IMV_ESTADO").val(),
            IMB_IMV_QUADRA : $("#IMB_IMV_QUADRA").val(),
            IMB_IMV_LOTE : $("#IMB_IMV_LOTE").val(),
            IMB_IMV_PROXIMIDADE : $("#IMB_IMV_PROXIMIDADE").val(),
            IMB_IMV_MEDTER : $("#IMB_IMV_MEDTER").val(),
            IMB_IMV_ARETOT : $("#IMB_IMV_ARETOT").val(),
            IMB_IMV_AREUTI : $("#IMB_IMV_AREUTI").val(),
            IMB_IMV_ARECON :  $("#IMB_IMV_ARECON").val(),
            IMB_IMV_DORQUA : $("#IMB_IMV_DORQUA").val(),
            IMB_IMV_SUIQUA :  $("#IMB_IMV_SUIQUA").val(),
            IMB_IMV_DORAE : dorae,
            IMB_IMV_SUIHID : suitehid,
            IMB_IMV_DORCLO : dorclo,
            IMB_IMV_COZINHA : cozinha,
            IMB_IMV_WCQUA : $("#IMB_IMV_WCQUA").val(),
            IMB_IMV_GARCOB : $("#IMB_IMV_GARCOB").val(),
            IMB_IMV_GARDES : $("#IMB_IMV_GARDES").val(),
            IMB_IMV_IDADE : $("#IMB_IMV_IDADE").val(),
            IMB_IMV_OBSERV : $("#IMB_IMV_OBSERV").val(),
            IMB_IMV_OBSWEB : $("#IMB_IMV_OBSWEB").val(),
            IMB_TIM_ID : $("#IMB_TIM_ID").val(),
            IMB_CND_ID : $("#IMB_CND_ID").val(),
            IMB_IMV_SUSPENSO : suspenso,
            IMB_IMV_ESCRIT : escritura,
            IMB_IMV_SUPERDESTAQUE : superdestaque,
            VIS_STA_ID : $("#VIS_STA_ID").val(),
            IMB_IMV_TITULO: $("#IMB_IMV_TITULO").val(),
            IMB_ATD_ID: $("#I-IMB_ATD_ID").val(),
            IMB_IMV_WCQUA : $("#IMB_IMV_WCQUA").val(),
            IMB_IMV_ARESER: simNao( $("#IMB_IMV_ARESER").prop('checked') ),
            IMB_IMV_CHAVES:  $("#IMB_IMV_CHAVES").val(),
            IMB_IMV_ORIENTACAOSOLAR: $("#IMB_IMV_ORIENTACAOSOLAR").val(),
            IMB_IMV_POSICAO: $("#IMB_IMV_POSICAO").val(),
            IMB_IMV_ALQPAU: $("#IMB_IMV_ALQPAU").val(),
            IMB_IMV_ALQGOI: $("#IMB_IMV_ALQGOI").val(),
            IMB_IMV_ALQMIN: $("#IMB_IMV_ALQMIN").val(),
            IMB_IMV_ALQNOR: $("#IMB_IMV_ALQNOR").val(),
            IMB_IMV_TOPOGR: $("#IMB_IMV_TOPOGR").val(),
            IMB_IMV_IDADE: $("#IMB_IMV_IDADE").val(),
            IMB_IMV_AECORREDOR: simNao( $("#IMB_IMV_AECORREDOR").prop('checked')),
            IMB_IMV_AECLOSET: simNao( $("#IMB_IMV_AECLOSET").prop('checked')),
            IMB_IMV_AESALA: simNao( $("#IMB_IMV_AESALA").prop('checked')),
            IMB_IMV_AEESCRITORIO: simNao( $("#IMB_IMV_AEESCRITORIO").prop('checked')),
            IMB_IMV_SALAAMOCO: simNao( $("#IMB_IMV_SALAAMOCO").prop('checked')),
            imb_imv_deposito: simNao( $("#imb_imv_deposito").prop('checked')),
            IMB_IMV_QUADRAPOLIESPORTIVA: simNao( $("#IMB_IMV_QUADRAPOLIESPORTIVA").prop('checked')),
            IMB_IMV_CAMFUT: simNao( $("#IMB_IMV_CAMFUT").prop('checked')),
            IMB_IMV_SALESC: simNao( $("#IMB_IMV_SALESC").prop('checked')),
            IMB_IMV_HOME: simNao( $("#IMB_IMV_HOME").prop('checked')),
            IMB_IMV_VARANDA : simNao( $("#IMB_IMV_VARANDA").prop('checked')),
            IMB_IMV_MURADO  : simNao( $("#IMB_IMV_MURADO").prop('checked')),
            IMB_IMV_PISOAQUECIDO   : simNao( $("#IMB_IMV_PISOAQUECIDO").prop('checked')),
            IMB_IMV_PISOARDOSIA    : simNao( $("#IMB_IMV_PISOARDOSIA").prop('checked')),
            IMB_IMV_PISOBLOQUETE     : simNao( $("#IMB_IMV_PISOBLOQUETE").prop('checked')),
            IMB_IMV_PISOCARPETE      : simNao( $("#IMB_IMV_PISOCARPETE").prop('checked')),
            IMB_IMV_PISOCARPETEACRIL       : simNao( $("#IMB_IMV_PISOCARPETEACRIL").prop('checked')),
            IMB_IMV_PISOCARPETEMADEIRA        : simNao( $("#IMB_IMV_PISOCARPETEMADEIRA").prop('checked')),
            IMB_IMV_PISOCARPETENYLON         : simNao( $("#IMB_IMV_PISOCARPETENYLON").prop('checked')),
            IMB_IMV_PISOCERAMICA          : simNao( $("#IMB_IMV_PISOCERAMICA").prop('checked')),
            IMB_IMV_PISOCIMENTO           : simNao( $("#IMB_IMV_PISOCIMENTO").prop('checked')),
            IMB_IMV_PISOCONTRAPISO            : simNao( $("#IMB_IMV_PISOCONTRAPISO").prop('checked')),
            IMB_IMV_PISOEMBORRACHADO             : simNao( $("#IMB_IMV_PISOEMBORRACHADO").prop('checked')),
            IMB_IMV_PISOGRANITO              : simNao( $("#IMB_IMV_PISOGRANITO").prop('checked')),
            IMB_IMV_PISOMARMORE                : simNao( $("#IMB_IMV_PISOMARMORE").prop('checked')),
            IMB_IMV_PISOLAMINADO                 : simNao( $("#IMB_IMV_PISOLAMINADO").prop('checked')),
            IMB_IMV_PISOTABUA                  : simNao( $("#IMB_IMV_PISOTABUA").prop('checked')),
            IMB_IMV_PISOTACOMADEIRA                   : simNao( $("#IMB_IMV_PISOTACOMADEIRA").prop('checked')),
            IMB_IMV_PISOVINICULO                    : simNao( $("#IMB_IMV_PISOVINICULO").prop('checked')),
            imb_imv_varandagourmet:  simNao( $("#imb_imv_varandagourmet").prop('checked')),
            IMB_IMV_LINKVIDEO: $("#IMB_IMV_LINKVIDEO").val(),

//            IMB_IMV_VALVEN : realToDolar( $("#IMB_IMV_VALVEN").val()),
            //IMB_IMV_VALLOC : realToDolar( $("#IMB_IMV_VALLOC").val()),
            IMB_IMV_VALORIPTU: valoriptu,
            imb_imv_valorcondominio: valorcondominio,
            IMB_IMV_CHAVESSITUACAO: $("#IMB_IMV_CHAVESSITUACAO").val(),
            IMB_ATD_IDCHAVE: $("#IMB_ATD_IDCHAVE").val(),
            IMB_IMV_CHAVES: $("#IMB_IMV_CHAVES").val(),
            IMB_IMV_SALQUA: $("#IMB_IMV_SALQUA").val(),
            IMB_IMV_PADRAO: $("#IMB_IMV_PADRAO").val(),
            IMB_IMV_FINALIDADE: $("#IMB_IMV_FINALIDADE").val(),


            IMB_IMV_HECTARES: $("#IMB_IMV_HECTARES").val(),

            IMB_IMV_SALESC : simNao( $("#IMB_IMV_SALESC").prop('checked')),
            IMB_IMV_COPA : simNao( $("#IMB_IMV_COPA").prop('checked')),
            IMB_IMV_SUICLO : simNao( $("#IMB_IMV_SUICLO").prop('checked')),
            IMB_IMV_COZAE: simNao( $("#IMB_IMV_COZAE").prop('checked')),
            IMB_IMV_AECORREDOR: simNao( $("#IMB_IMV_AECORREDOR").prop('checked')),
            IMB_IMV_AECLOSET: simNao( $("#IMB_IMV_AECLOSET").prop('checked')),
            IMB_IMV_AESALA: simNao( $("#IMB_IMV_AESALA").prop('checked')),
            IMB_IMV_AEESCRITORIO: simNao( $("#IMB_IMV_AEESCRITORIO").prop('checked')),
            IMB_IMV_AEWC: simNao( $("#IMB_IMV_AEWC").prop('checked')),
            IMB_IMV_MANTERSITE: simNao( $("#IMB_IMV_MANTERSITE").prop('checked')),
            IMB_IMV_ANOCONSTRUCAO: $("#IMB_IMV_ANOCONSTRUCAO").val(),
            IMB_IMV_CONDICOESCOMERCIAIS: $("#IMB_IMV_CONDICOESCOMERCIAIS").val(),
            IMB_IMV_PISOPORCELANATO: simNao( $("#IMB_IMV_PISOPORCELANATO").prop('checked')),
            IMB_IMV_CHABOX: $("#IMB_IMV_CHABOX").val(),
            IMB_IMV_ALARME: alarme,
            IMB_IMV_ARAPARELHO: arcondicionado,
            IMB_IMV_LAREIRA: lareira,
            IMB_IMV_SEMIMOB: semimobiliado,
            IMB_IMV_INTERF: interfone,
            IMB_IMV_AGUAQUENTE: aguaquente,
            IMB_IMV_SACADA : sacada,
            IMB_IMV_ELEVADORES : elevadores,
            IMB_IMV_LATITUDE: $("#IMB_IMV_LATITUDE").val(),
            IMB_IMV_LONGITUDE: $("#IMB_IMV_LONGITUDE").val(),
            IMB_IMV_PORTALQUADROCHAVES: portalquadrochaves,


        }

        url = "{{route('imovel.save')}}";

        $.ajaxSetup({
                headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

        $.ajax(
        {
            url : url,
            type:'post',
            datatype:'json',
            data: imoveis,
            async:false,
            success : function()
            {

                alert('Gravado com sucesso!');

                window.close();

            },
            error: function()
            {
                alert('erro');
            }
        });

    }

    function onCancelar()

    {

        window.close();

    }

    function preencherCondominio( nId )
    {

        url = "{{ route('condominio.carga')}}/"+$("#I-IMB_IMB_IDMASTER").val();
        console.log( 'condominios: '+url );

        $.getJSON( url, function( data )

        {
            $("#IMB_CND_ID").empty();
            $("#IMB_CND_ID").append( '<option value=""></option>' );
            for( nI=0;nI < data.length;nI++)
            {
                linha =
                    '<option value="'+data[nI].IMB_CND_ID+'">'+
                        data[nI].IMB_CND_NOME;
                linha = linha + "</option>";
                $("#IMB_CND_ID").append( linha );

            }

            $("#IMB_CND_ID").val( nId );

        });

    }


    //proprietarios
    function CarregarPropImo()
    {
        var url = "{{ route('propimo.carga') }}"+"/"+$("#IMB_IMV_ID").val();
        console.log('propimo: '+url );
        $.getJSON( url, function( data)
        {
            linha = "";
            $("#tbpropimo>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                linha =
                    '<tr>'+
                    '   <td style="text-align:center"><a href="javascript:alterarClienteEditImv('+data[nI].IMB_CLT_ID+')">'+data[nI].IMB_CLT_NOME+'</a></td>'+
                    '   <td style="text-align:center">'+data[nI].IMB_IMVCLT_PERCENTUAL4+'</td>'+
                    '   <td style="text-align:center">'+data[nI].principal+'</td>'+
                    '   <td style="text-align:center"> '+
//                    '<a  class="btn btn-sm btn-primary" href=javascript:editarCorImo('+data[nI].IMB_CORIMO_ID+')>Editar</a>&nbsp;&nbsp;&nbsp;&nbsp;'+
//                    '           <button class="btn btn-sm btn-primary" onclick="editarCorImo('+data[nI].IMB_CORIMO_ID+' )">Editar</button>'+
//                    '           <button class="btn btn-sm btn-danger" onclick="apagarCorImo('+data[nI].IMB_CORIMO_ID+' )">Apagar</button>'+
                    '<a  class="btn btn-sm btn-primary" href=javascript:editarPropImo('+data[nI].IMB_PPI_ID+')>     Editar</a>'+
                    '<a  class="btn btn-sm btn-danger" href=javascript:apagarPropImo('+data[nI].IMB_PPI_ID+')>     Apagar</a>'+
                    '   </td>'+
                    '</tr>';

                $("#tbpropimo").append( linha );

            }
        });
    }


    function apagarPropImo( id )
    {
        var url = "{{ route('propimo.apagar') }}"+"/"+id;

        if (confirm("Tem certeza que deseja excluir?"))
        {
            $.ajaxSetup({
                headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
            });
            $.ajax
            ({
                type: "delete",
                url: url,
                context: this,
                success: function()
                {
                    CarregarPropImo();
                },
                error: function( error )
                {
                    console.log(error);
                }
            });
        };

    }

    function editarPropImo( id )
    {
        var url = "{{ route('propimo.editar') }}"+"/"+id;
        $.getJSON( url, function( data)
        {

            $("#tblclientes").empty();
            $("#selclientelike").empty();
            $("#selclientelike").append( '<option value="'+data.IMB_CLT_ID+'">'+data.IMB_CLT_NOME+'</option>');
            $("#i-idpropimo").val( data.IMB_PPI_ID),
            $("#i-idimovel-prop").val( data.IMB_IMV_ID),
            $('#i-principal-prop' ).prop( "checked" , (data.IMB_IMVCLT_PRINCIPAL =='S') );
            $("#i-percentual-prop").val( data.IMB_IMVCLT_PERCENTUAL4);
            $("#i-str").val( '------------' );  //SÓ PRA LIMPAR A TELA DE CLIENTES TABLE
            $("#i-str").val( '' );
            $("#propModal").modal('show');
            buscaIncremental();

        });
    }


    /*function totalParProp()
    {
        var id = $("#i-codigoimovel").val();
        var url = "{{ route('propimo.parttotal') }}"+"/"+id;
        var total =  0;
        $.getJSON( url, function( data)
        {
            total = parseFloat(data);
            return total;


        });
        return total;
    }
*/

    function adicionarPropImo()
    {
        var prop = $("#nomeprop").val();

        $("#propModal").modal('show');
        $("#i-idpropimo").val('');
        $("#i-str").val( prop );
        buscaIncremental();
    }


    function criarPropImo()
    {
           $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
            });
            corimo =
        {
            IMB_IMB_ID :$("#IMB_IMB_ID2").val(),
            IMB_PPI_ID :$("#i-idpropimo").val(),
            IMB_IMV_ID : $("#i-idimovel-prop").val(),
            IMB_CLT_ID : $("#selclientelike").val(),
            IMB_IMVCLT_PRINCIPAL : $( '#i-principal-prop' ).prop( "checked" )  ==true ? 'S' : 'N',
            IMB_IMVCLT_PERCENTUAL4 : $("#i-percentual-prop").val()
        };
        console.log( corimo );

        $.post("{{ route( 'propimo.salvar' ) }}", corimo, function(data)
        {
            $("#propModal").modal("hide");
        });


        calcularPerProp();
        CarregarPropImo();



    };




    function calcularPerProp()
    {

            /*var url = "{{ route('propimo.parttotal') }}"+"/"+$("#i-idimovel-prop").val();
            $.getJSON( url, function( data)
            {
                    $("#i-totalperc").val( data );

            })*/
        var table = document.getElementById('tbpropimo');
        var percentual = 0;
        for (var r = 1, n = table.rows.length; r < n; r++)
        {
            percentual = percentual + parseFloat(table.rows[r].cells[1].innerHTML);
        }

        return percentual;


    }

    function temPrincipal()
        {

            var table = document.getElementById('tbpropimo');
            var principal = 0;
            for (var r = 1, n = table.rows.length; r < n; r++)
            {
                if (table.rows[r].cells[2].innerHTML == 'Principal' )
                   principal = principal + 1;
                console.log( 'principal: '+table.rows[r].cells[2].innerHTML );
            }

            return principal;



/*            var url = "{{ route('propimo.temprincipal') }}"+"/"+$("#IMB_IMV_ID").val();
            $.getJSON( url, function( data)
            {
                $("#i-temprincipal").val( data );
                //alert( data );

            });
            */

        }

    function carrousel()
    {
        window.open("{{ route('imovel.detalhecomfoto') }}/" + $("#IMB_IMV_ID").val(),
         "imagens", "height=768,width=1024");
        ///window.location = "{{ route('imovel.detalhecomfoto') }}/" + $("#IMB_IMV_ID").val();
    }

    $("#formPropImo").submit
        ( function( event )
        {
            event.preventDefault();
            //alert($("#i-idcorimo").val());
                   criarPropImo();

            CarregarPropImo();

         });


/*    window.onbeforeunload = function(){
        if( $("#i-referencia").val() == '' )
            return 'Tchau';
    };
    */


    function formatarValorLocacao()
    {
        var texto = $("#valorlocacao").val();
        texto = texto.replace( 'R$','');
        texto = texto.replace( '.','');
        texto = texto.replace( '.','');
        texto = texto.replace( '.','');


        console.log('texto '+texto );

        var atual = Number( texto );

        //com R$
        var f = atual.toLocaleString('pt-br',{minimumFractionDigits: 0});

        //sem R$
        //var f2 = atual.toLocaleString('pt-br', {minimumFractionDigits: 2});

        $("#valorlocacao").val( f );

    }

    $("#valorlocacao").blur(function()
    {
        formatarValorLocacao()
    });


    function formatarValorVenda()
    {
        var texto = $("#valorvenda").val();
        texto = texto.replace( 'R$','');
        texto = texto.replace( '.','');
        texto = texto.replace( '.','');
        texto = texto.replace( '.','');


        console.log('texto '+texto );

        var atual = Number( texto );

        //com R$
        var f = atual.toLocaleString('pt-br',{minimumFractionDigits: 0});

        //sem R$
        //var f2 = atual.toLocaleString('pt-br', {minimumFractionDigits: 2});

        $("#valorvenda").val( f );

    }

    $("#valorvenda").blur(function()
    {
        formatarValorVenda();

    });


    $("#i-str").keyup( function()
        {
            if ( $("#i-str").val().length >= 5 )
            {
                buscaIncremental();
            }

    });

    function cargaImovel()
    {
        url="{{route('imovel.carga')}}/"+$("#IMB_IMV_ID").val();

        $.ajax(
        {
            url:url,
            type:'get',
            async:false,
            success:function( data )
            {
                $("#IMB_CLT_ID").val(data.IMB_CLT_ID );
                $("#IMB_IMV_ENDERECO").val( data.IMB_IMV_ENDERECO );
                $("#IMB_IMV_ENDERECONUMERO").val( data.IMB_IMV_ENDERECONUMERO );
                $("#IMB_IMV_ENDERECOCOMPLEMENTO").val( data.IMB_IMV_ENDERECOCOMPLEMENTO );
                $("#IMB_IMV_TITULO").val( data.IMB_IMV_TITULO );
                $("#div-localizacao").html('Imóvel: '+data.IMB_IMV_REFERE );


                $("#IMB_IMV_WEBIMOVEL").prop( 'checked',false )
                if( data.IMB_IMV_WEBIMOVEL == 'S')
                    $("#IMB_IMV_WEBIMOVEL").prop( 'checked',true );

                $("#IMB_IMV_DESTAQUE").prop( 'checked',false )
                if( data.IMB_IMV_DESTAQUE == 'S')
                    $("#IMB_IMV_DESTAQUE").prop( 'checked',true );

                    $("#IMB_IMV_WEBLANCAMENTO").prop( 'checked',false )
                if( data.IMB_IMV_WEBLANCAMENTO == 'S')
                    $("#IMB_IMV_WEBLANCAMENTO").prop( 'checked',true );

                    $("#IMB_IMV_ESCLUSIVO").prop( 'checked',false )
                if( data.IMB_IMV_ESCLUSIVO == 'S')
                    $("#IMB_IMV_ESCLUSIVO").prop( 'checked',true );

                    $("#imb_imv_terrea").prop( 'checked',false )
                if( data.IMB_IMV_TERREA == 'S')
                    $("#imb_imv_terrea").prop( 'checked',true );

                    $("#IMB_IMV_SOBRADO").prop( 'checked',false )
                if( data.IMB_IMV_SOBRADO == 'S')
                    $("#IMB_IMV_SOBRADO").prop( 'checked',true );

                    $("#IMB_IMV_PLACA").prop( 'checked',false )
                if( data.IMB_IMV_PLACA == 'S')
                    $("#IMB_IMV_PLACA").prop( 'checked',true );

                    $("#IMB_IMV_ACEITAFINANC").prop( 'checked',false )
                if( data.IMB_IMV_ACEITAFINANC == 'S')
                    $("#IMB_IMV_ACEITAFINANC").prop( 'checked',true );

                    $("#IMB_IMV_PERMUTA").prop( 'checked',false )
                if( data.IMB_IMV_PERMUTA == 'S')
                    $("#IMB_IMV_PERMUTA").prop( 'checked',true );

                $("#IMB_IMV_DATACADASTRO").val( moment( data.IMB_IMV_DATACADASTRO).format( 'DD/MM/YYYY') );
                $("#IMB_IMV_DATAATUALIZACAO").val( moment( data.IMB_IMV_DATAATUALIZACAO).format( 'DD/MM/YYYY') );
                if( data.IMB_IMV_DATSUS == '' )
                    $("#IMB_IMV_DATSUS").val( moment( data.IMB_IMV_DATSUS).format( 'DD/MM/YYYY') );

                $("#IMB_IMV_REFERE").val(data.IMB_IMV_REFERE );

                $("#IMB_IMV_SUSPENSO").prop( 'checked',false );
                if( data.IMB_IMV_SUSPENSO == 'S')
                    $("#IMB_IMV_SUSPENSO").prop( 'checked',true );


                if( data.IMB_IMV_SALESC == 'S')
                    $("#IMB_IMV_SALESC").prop( 'checked',true );

                if( data.IMB_IMV_COPA == 'S')
                    $("#IMB_IMV_COPA").prop( 'checked',true );

                if( data.IMB_IMV_SUICLO == 'S')
                    $("#IMB_IMV_SUICLO").prop( 'checked',true );

                var valorlocacaoaval = parseFloat(data.IMB_IMV_VALORAVALLOC);
                var valorFormatado = valorlocacaoaval.toLocaleString('pt-BR', { inimumFractionDigits: 2});
                $('#IMB_IMV_VALORAVALLOC').val( valorFormatado );

                var valorvendaaval = parseFloat(data.IMB_IMV_VALORAVALVEN);
                var valorFormatado = valorvendaaval.toLocaleString('pt-BR', { inimumFractionDigits: 2});
                $('#IMB_IMV_VALORAVALVEN').val( valorFormatado );


                var valor = parseFloat(data.IMB_IMV_VALVEN);
                var valorFormatado = valor.toLocaleString('pt-BR', { inimumFractionDigits: 2});
                $('#IMB_IMV_VALVEN').val( valorFormatado );

                valor = parseFloat( data.IMB_IMV_VALLOC);
                valorFormatado = valor.toLocaleString('pt-BR', { inimumFractionDigits: 2});
                $('#IMB_IMV_VALLOC').val( valorFormatado );

                $("#IMB_IMV_ENDERECOTIPO").val(data.IMB_IMV_ENDERECOTIPO );
                $("#IMB_IMV_ENDERECO").val(data.IMB_IMV_ENDERECO );
                $("#IMB_IMV_ENDERECONUMERO").val(data.IMB_IMV_ENDERECONUMERO );
                $("#IMB_IMV_NUMAPT").val(data.IMB_IMV_NUMAPT );
                $("#IMB_IMV_PREDIO").val(data.IMB_IMV_PREDIO );
                $("#IMB_IMV_ANDAR").val(data.IMB_IMV_ANDAR );
                $("#CEP_BAI_NOME").val(data.CEP_BAI_NOME );
                $("#IMB_IMV_ENDERECOCEP").val(data.IMB_IMV_ENDERECOCEP );
                $("#IMB_IMV_CIDADE").val(data.IMB_IMV_CIDADE );
                $("#IMB_IMV_ESTADO").val(data.IMB_IMV_ESTADO );
                $("#IMB_IMV_QUADRA").val(data.IMB_IMV_QUADRA );
                $("#IMB_IMV_LOTE").val(data.IMB_IMV_LOTE );
                $("#IMB_IMV_PROXIMIDADE").val(data.IMB_IMV_PROXIMIDADE );
                $("#IMB_IMV_MEDTER").val(data.IMB_IMV_MEDTER );
                $("#IMB_IMV_ARETOT").val(data.IMB_IMV_ARETOT );
                $("#IMB_IMV_AREUTI").val(data.IMB_IMV_AREUTI );
                $("#IMB_IMV_ARECON").val(data.IMB_IMV_ARECON );
                $("#IMB_IMV_DORQUA").val(data.IMB_IMV_DORQUA );
                $("#IMB_IMV_SUIQUA").val(data.IMB_IMV_SUIQUA );
                $("#IMB_IMV_WCQUA").val(data.IMB_IMV_WCQUA );
                $("#IMB_IMV_LATITUDE").val(data.IMB_IMV_LATITUDE );
                $("#IMB_IMV_LONGITUDE").val(data.IMB_IMV_LONGITUDE );


                $("#IMB_IMV_PORTALQUADROCHAVES").prop( 'checked',false );
                if( data.IMB_IMV_PORTALQUADROCHAVES == 'S')
                    $("#IMB_IMV_PORTALQUADROCHAVES").prop( 'checked',true );

                    $("#IMB_IMV_SACADA").prop( 'checked',false );
                if( data.IMB_IMV_SACADA == 'S')
                    $("#IMB_IMV_SACADA").prop( 'checked',true );

                $("#IMB_IMV_ELEVADORES").prop( 'checked',false );
                if( data.IMB_IMV_ELEVADORES == 'S')
                    $("#IMB_IMV_ELEVADORES").prop( 'checked',true );

                $("#IMB_TIM_ID").val(data.IMB_TIM_ID );

                $("#IMB_IMV_ESCRIT").prop( 'checked',false );
                if( data.IMB_IMV_ESCRIT == 'S')
                    $("#IMB_IMV_ESCRIT").prop( 'checked',true );

                $("#IMB_IMV_DORAE").prop( 'checked',false );
                if( data.IMB_IMV_DORAE == 'S')
                    $("#IMB_IMV_DORAE").prop( 'checked',true );

                $("#IMB_IMV_SUIHID").prop( 'checked',false );
                if( data.IMB_IMV_SUIHID == 'S')
                    $("#IMB_IMV_SUIHID").prop( 'checked',true );

                    $("#IMB_IMV_DORCLO").prop( 'checked',false );
                if( data.IMB_IMV_DORCLO == 'S')
                    $("#IMB_IMV_DORCLO").prop( 'checked',true );

                $("#IMB_IMV_COZINHA").prop( 'checked',false );
                if( data.IMB_IMV_COZINHA == 'S')
                    $("#IMB_IMV_COZINHA").prop( 'checked',true );

                $("#IMB_IMV_COZPLA").prop( 'checked',false );
                if( data.IMB_IMV_COZPLA == 'S')
                    $("#IMB_IMV_COZPLA").prop( 'checked',true );

                $("#IMB_IMV_LAVABO").prop( 'checked',false );
                if( data.IMB_IMV_LAVABO == 'S')
                    $("#IMB_IMV_LAVABO").prop( 'checked',true );

                    $("#IMB_IMV_EMPQUA").prop( 'checked',false );
                if( data.IMB_IMV_EMPQUA == 'S')
                    $("#IMB_IMV_EMPQUA").prop( 'checked',true );

                    $("#IMB_IMV_EMPWC").prop( 'checked',false );
                if( data.IMB_IMV_EMPWC == 'S')
                    $("#IMB_IMV_EMPWC").prop( 'checked',true );

                $("#IMB_IMV_DESPENSA").prop( 'checked',false );
                if( data.IMB_IMV_DESPENSA == 'S')
                    $("#IMB_IMV_DESPENSA").prop( 'checked',true );

                $("#IMB_IMV_PISCIN").prop( 'checked',false );
                if( data.IMB_IMV_PISCIN == 'S')
                    $("#IMB_IMV_PISCIN").prop( 'checked',true );

                $("#IMB_IMV_EDICUL").prop( 'checked',false );
                if( data.IMB_IMV_EDICUL == 'S')
                    $("#IMB_IMV_EDICUL").prop( 'checked',true );


                $("#IMB_IMV_QUINTA").prop( 'checked',false );
                if( data.IMB_IMV_QUINTA == 'S')
                    $("#IMB_IMV_QUINTA").prop( 'checked',true );

                $("#IMB_IMV_CHURRA").prop( 'checked',false );
                if( data.IMB_IMV_CHURRA == 'S')
                    $("#IMB_IMV_CHURRA").prop( 'checked',true );


                $("#IMB_IMV_PORELE").prop( 'checked',false );
                if( data.IMB_IMV_PORELE == 'S')
                    $("#IMB_IMV_PORELE").prop( 'checked',true );

                $("#IMB_IMV_SAUNA").prop( 'checked',false );
                if( data.IMB_IMV_SAUNA == 'S')
                    $("#IMB_IMV_SAUNA").prop( 'checked',true );


                $("#IMB_IMV_QUADRAPOLIESPORTIVA").prop( 'checked',false );
                if( data.IMB_IMV_QUADRAPOLIESPORTIVA == 'S')
                    $("#IMB_IMV_QUADRAPOLIESPORTIVA").prop( 'checked',true );


                $("#IMB_IMV_SALFES").prop( 'checked',false );
                if( data.IMB_IMV_SALFES == 'S')
                    $("#IMB_IMV_SALFES").prop( 'checked',true );

                $("#IMB_IMV_PLAGRO").prop( 'checked',false );
                if( data.IMB_IMV_PLAGRO == 'S')
                    $("#IMB_IMV_PLAGRO").prop( 'checked',true );

                $("#IMB_IMV_TERREA").prop( 'checked',(data.imb_imv_terrea == 'S') );
                $("#IMB_IMV_SUPERDESTAQUE").prop( 'checked',(data.IMB_IMV_SUPERDESTAQUE == 'S') );



                $("#IMB_IMV_GARCOB").val(data.IMB_IMV_GARCOB );

                $("#IMB_IMV_GARDES").val(data.IMB_IMV_GARDES );
                $("#IMB_IMV_OBSERV").val(data.IMB_IMV_OBSERV );
                $("#IMB_IMV_OBSWEB").val(data.IMB_IMV_OBSWEB );
                $("#IMB_IMV_CHAVESSITUACAO").val(data.IMB_IMV_CHAVESSITUACAO );
                $("#IMB_ATD_IDCHAVE").val(data.IMB_ATD_IDCHAVE );
                $("#IMB_IMV_CHAVES").val(data.IMB_IMV_CHAVES );
                $("#IMB_IMV_HECTARES").val(data.IMB_IMV_HECTARES );
                $("#IMB_IMV_ALQPAU").val(data.IMB_IMV_ALQPAU );
                $("#IMB_IMV_ALQGOI").val(data.IMB_IMV_ALQGOI );
                $("#IMB_IMV_ALQMIN").val(data.IMB_IMV_ALQMIN );
                $("#IMB_IMV_ALQNOR").val(data.IMB_IMV_ALQNOR );
                $("#IMB_IMV_TOPOGR").val(data.IMB_IMV_TOPOGR );
                $("#IMB_IMV_IDADE").val(data.IMB_IMV_IDADE );
                $("#IMB_IMV_ORIENTACAOSOLAR").val(data.IMB_IMV_ORIENTACAOSOLAR );
                $("#IMB_IMV_POSICAO").val(data.IMB_IMV_POSICAO );
                $("#IMB_IMV_SALQUA").val(data.IMB_IMV_SALQUA );
                $("#IMB_IMV_PADRAO").val(data.IMB_IMV_PADRAO );
                $("#IMB_IMV_FINALIDADE").val(data.IMB_IMV_FINALIDADE );
                $("#IMB_IMV_VALORIPTU").val(  dolarToReal(data.IMB_IMV_VALORIPTU) );
                $("#imb_imv_valorcondominio").val( dolarToReal(data.imb_imv_valorcondominio) );

                $("#IMB_IMV_COZAE").prop( 'checked',(data.IMB_IMV_COZAE == 'S') );
                $("#IMB_IMV_AECORREDOR").prop( 'checked',(data.IMB_IMV_AECORREDOR == 'S') );
                $("#IMB_IMV_AECLOSET").prop( 'checked',(data.IMB_IMV_AECLOSET == 'S') );
                $("#IMB_IMV_AESALA").prop( 'checked',(data.IMB_IMV_AESALA == 'S') );
                $("#IMB_IMV_AEESCRITORIO").prop( 'checked',(data.IMB_IMV_AEESCRITORIO == 'S') );
                $("#IMB_IMV_AEWC").prop( 'checked',(data.IMB_IMV_AEWC == 'S') );
                $("#IMB_IMV_ARESER").prop( 'checked',(data.IMB_IMV_ARESER == 'S') );
                $("#IMB_IMV_SALAAMOCO").prop( 'checked',(data.IMB_IMV_SALAAMOCO == 'S') );
                $("#imb_imv_deposito").prop( 'checked',(data.imb_imv_deposito == 'S') );
                $("#imb_imv_varandagourmet").prop( 'checked',(data.imb_imv_varandagourmet == 'S') );
                $("#IMB_IMV_CAMFUT").prop( 'checked',(data.IMB_IMV_CAMFUT == 'S') );
                $("#IMB_IMV_HOME").prop( 'checked',(data.IMB_IMV_HOME == 'S') );
                $("#IMB_IMV_MURADO").prop( 'checked',(data.IMB_IMV_MURADO == 'S') );
                $("#IMB_IMV_VARANDA").prop( 'checked',(data.IMB_IMV_VARANDA == 'S') );
                $("#IMB_IMV_PISOAQUECIDO").prop( 'checked',(data.IMB_IMV_PISOAQUECIDO == 'S') );
                $("#IMB_IMV_PISOARDOSIA").prop( 'checked',(data.IMB_IMV_PISOARDOSIA == 'S') );
                $("#IMB_IMV_PISOBLOQUETE").prop( 'checked',(data.IMB_IMV_PISOBLOQUETE == 'S') );
                $("#IMB_IMV_PISOCARPETE").prop( 'checked',(data.IMB_IMV_PISOCARPETE == 'S') );
                $("#IMB_IMV_PISOCARPETEACRIL").prop( 'checked',(data.IMB_IMV_PISOCARPETEACRIL == 'S') );
                $("#IMB_IMV_PISOCARPETEMADEIRA").prop( 'checked',(data.IMB_IMV_PISOCARPETEMADEIRA == 'S') );
                $("#IMB_IMV_PISOCARPETENYLON").prop( 'checked',(data.IMB_IMV_PISOCARPETENYLON == 'S') );
                $("#IMB_IMV_PISOCERAMICA").prop( 'checked',(data.IMB_IMV_PISOCERAMICA == 'S') );
                $("#IMB_IMV_PISOCIMENTO").prop( 'checked',(data.IMB_IMV_PISOCIMENTO == 'S') );
                $("#IMB_IMV_PISOCONTRAPISO").prop( 'checked',(data.IMB_IMV_PISOCONTRAPISO == 'S') );
                $("#IMB_IMV_PISOEMBORRACHADO").prop( 'checked',(data.IMB_IMV_PISOEMBORRACHADO == 'S') );
                $("#IMB_IMV_PISOGRANITO").prop( 'checked',(data.IMB_IMV_PISOGRANITO == 'S') );
                $("#IMB_IMV_PISOMARMORE").prop( 'checked',(data.IMB_IMV_PISOMARMORE == 'S') );
                $("#IMB_IMV_PISOLAMINADO").prop( 'checked',(data.IMB_IMV_PISOLAMINADO == 'S') );
                $("#IMB_IMV_PISOTABUA").prop( 'checked',(data.IMB_IMV_PISOTABUA == 'S') );
                $("#IMB_IMV_PISOTACOMADEIRA").prop( 'checked',(data.IMB_IMV_PISOTACOMADEIRA == 'S') );
                $("#IMB_IMV_PISOVINICULO").prop( 'checked',(data.IMB_IMV_PISOVINICULO == 'S') );
                $("#IMB_IMV_MANTERSITE").prop( 'checked',(data.IMB_IMV_MANTERSITE == 'S') );
                $("#IMB_IMV_PISOPORCELANATO").prop( 'checked',(data.IMB_IMV_PISOPORCELANATO == 'S') );
                $("#IMB_IMV_ALARME").prop( 'checked',(data.IMB_IMV_ALARME == 'S') );
                $("#IMB_IMV_ARAPARELHO").prop( 'checked',(data.IMB_IMV_ARAPARELHO == 'S') );
                $("#IMB_IMV_LAREIRA").prop( 'checked',(data.IMB_IMV_LAREIRA == 'S') );
                $("#IMB_IMV_SEMIMOB").prop( 'checked',(data.IMB_IMV_SEMIMOB == 'S') );
                $("#IMB_IMV_INTERF").prop( 'checked',(data.IMB_IMV_INTERF == 'S') );
                $("#IMB_IMV_AGUAQUENTE").prop( 'checked',(data.IMB_IMV_AGUAQUENTE == 'S') );
                $("#IMB_IMV_CONDICOESCOMERCIAIS").val( data.IMB_IMV_CONDICOESCOMERCIAIS);
                $("#IMB_IMV_CHABOX").val( data.IMB_IMV_CHABOX);
                $("#IMB_IMV_LINKVIDEO").val( data.IMB_IMV_LINKVIDEO);
                $("#IMB_CND_ID").val( data.IMB_CND_ID);
                $("#CEP_BAI_ID").val( data.CEP_BAI_ID );
                $("#IMB_TIM_ID").val( data.IMB_TIM_ID );


                //cargaBairrosdaTabela( data.CEP_BAI_ID )


                preencherUnidades( data.IMB_IMB_ID2 );
                //preencherTipoImovel( data.IMB_TIM_ID );
//                preencherCondominio( data.IMB_CND_ID);
                CarregarPropImo(data.IMB_IMV_ID);
                CarregarCorImo(data.IMB_IMV_ID);
                CarregarCapImo(data.IMB_IMV_ID);
                cargaStatus( data.VIS_STA_ID );
                statusImovel( data.VIS_STA_ID );
                preencherCorretoresChave( data.IMB_ATD_IDCHAVE );


            },
            error: function()
            {
                alert('error ');
            }
        })

    }


    function upLoadImagem()
    {
    }


    function cargaPortal()
    {
        var url = "{{ route('portais.carga')}}/"+$("#I-IMB_IMB_IDMASTER").val();

        $.ajax(
        {
            url     : url,
            datatype: 'json',
            type    : 'get',
            async   : false,
            success : function( data )
            {
                linha = "";
                $("#IMB_POR_ID").empty();
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                        '<option value="'+data[nI].IMB_POR_ID+'">'+
                        data[nI].IMB_POR_NOME+"</option>";
                    $("#IMB_POR_ID").append( linha );
                }
            },
            error   : function( e )
            {
                alert('Erro ao carregar os portais!'+e);
            }

        });

    }


    function imovelPortalInc()
    {
        $("#i-portalimovel").modal('show');
        $("#IMB_IMP_ID").val('');
        $("#IMB_POR_ID").val('');
        cargaPortal();
    }

    function imovelPortalGravar()
    {
        var url = "{{ route('portalimovel.gravar')}}";

        dados =
        {
            IMB_IMV_ID : $("#IMB_IMV_ID").val(),
            IMB_POR_ID : $("#IMB_POR_ID").val(),
        };

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
            data    : dados,
            type    : 'post',
            datatype: 'json',
            async   : false,
            success : function()
            {
                alert('gravado!');
                portalImovelCarga();
            },
            error   : function(e)
            {
                alert('Erro ao gravar. '+e);
            }

        });

    }

    function portalImovelCarga()
    {
        var url = "{{ route('portalimovel.carga')}}/"+$("#IMB_IMV_ID").val();

        $("#i-portalimovel").modal('hide');

        $.ajax(
        {
            url     : url,
            datatype: 'json',
            type    : 'get',
            async   : false,
            success : function(data)
            {
                linha = "";
                $("#tbportalimovel>tbody").empty();
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                        '<tr>'+
                        '   <td>'+data[nI].IMB_POR_NOME+'</td>'+
                        '   <td style="text-align:center"> '+
                        '<a  class="btn btn-sm btn-danger" href=javascript:portalImovelApagar('+data[nI].IMB_IMP_ID+')>     Apagar</a>'+
                        '   </td>'+
                        '</tr>';
                    $("#tbportalimovel").append( linha );
                }
            }
        });
    }

    function portalImovelApagar( id )
      {
    if (confirm("Tem certeza que deseja tirar este imovel do portal?"))
    {
      if ( id != '')
      {
        var url = "{{ route( 'portalimovel.apagar' )}}/"+id;

        $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
            });

        $.ajax(
        {
            url : url,
            type: 'post',
            datatype: 'json',
            async:false,
            success: function()
            {
                alert('Excluido!');
                portalImovelCarga();

            },
            error: function()
            {
                alert( 'erro ao excluir registro');
            }

        });
      }


    }

  }

    function cargaStatus( id )
    {
        url = "{{route('statusimovel.carga')}}/0";

        $.ajax(
        {
            url     : url,
            datatype: 'json',
            type    : 'get',
            async   : false,
            success : function( data )
            {
                console.log( data );
                linha = "";
                $("#VIS_STA_ID").empty();
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                        '<option value="'+data[nI].VIS_STA_ID+'">'+
                        data[nI].VIS_STA_NOME+"</option>";
                    $("#VIS_STA_ID").append( linha );
                }
            },
            error   : function( e )
            {
                alert('Erro ao carregar os Status'+e);
            }

        });

        $("#VIS_STA_ID").val( id );

    }

    function statusImovel( id )
    {

        url = "{{route('statusimovel.buscar')}}/"+id;

        $("#i-div-status").hide();

        $.ajax(
        {
            url     : url,
            datatype: 'json',
            type    : 'get',
            async   : false,
            success : function( data )
            {
                console.log( data );
                if( data.VIS_STA_SITUACAO == 'I')
                {
                    $("#i-div-status").html( data.VIS_STA_NOME );
                    $("#i-div-status").show();
                }
            }

        });



    }
    function novoCadastroCliente()
    {
        $("#modalnovocliente").modal( 'show');
    }

    function gerarSugestaoTitulo()
    {
        var tipo = $("#IMB_TIM_ID option:selected").text();
        var valorvenda  = $("#IMB_IMV_VALVEN").val();
        var valorlocacao  = $("#IMB_IMV_VALLOC").val();
        var dormitorios = $("#IMB_IMV_DORQUA").val();
        var bairro =  $("#CEP_BAI_ID option:selected").text();
        var cidade = $("#IMB_IMV_CIDADE").val();
        var nomecondominio =$("#IMB_CND_ID option:selected").text();

        var finalidade='';
        if( valorvenda !='0,00' && valorlocacao != '0,00' )
           finalidade = 'Vender ou Alugar';

        if( valorvenda != '0,00' && valorlocacao == '0,00' )
           finalidade = 'Vender';
        if( valorvenda == '0,00' && valorlocacao != '0,00' )
           finalidade = 'Alugar';

        if( $("#IMB_CND_ID").val()  != '0' )
            $("#IMB_IMV_TITULO").val( tipo+' para '+finalidade+' em '+cidade+' no bairro '+bairro+' no Condominio '+nomecondominio)
        else
            $("#IMB_IMV_TITULO").val( tipo+' para '+finalidade+' em '+cidade+' no bairro '+bairro );




    }

    function buscarCondominio()
    {
        var id = $("#IMB_CND_ID").val();
        var url = "{{route('condominio.buscar')}}/"+id;


        $.ajax(
            {
                url     : url,
                dataType: 'json',
                type    : 'get',
                success : function( data )
                {
                    $("#IMB_IMV_ENDERECO").val( data.IMB_CND_ENDERECO);
                    $("#IMB_IMV_ENDERECONUMERO").val( data.IMB_CND_ENDERECONUMERO);
                    $("#IMB_IMV_ENDERECOMPLEMENTO").val( data.IMB_CND_ENDERECOCOMPLEMENTO);
                    $("#IMB_IMV_ENDERECOCEP").val( data.IMB_CND_CEP);
                    $("#CEP_BAI_NOME").val( data.CEP_BAI_NOME);
                    $("#CEP_CID_NOME").val( data.CEP_CID_NOME);
                    $("#CEP_UF_SIGLA").val( data.CEP_UF_SIGLA);
                    $("#imb_imv_valorcondominio").val( data.IMB_CND_VALCON);
                }
            }
        )

    }

    function tirarCondominio()
    {
        $("#IMB_CND_ID").empty();
        $("#IMB_CND_ID").val('0');
        preencherCondominio();

    }

    function upLoadImagemDrop()
    {
        $("#galeria-update-btn").show();
        $("#form-img").submit();

    }

    function verImagem( id, nome)
    {
        var empresa = "{{Auth::user()->IMB_IMB_ID}}";

        $("#i-imagem-grande").empty();

        var texto = '<img class="img-grande" src="{{env('APP_URL')}}/storage/images/'+empresa+'/imoveis/'+id+'/'+nome+'" alt=""/>';

        $("#i-imagem-grande").append( texto );

        $("#modalimagemgrande").modal('show');

    }

    function cadastrarBairro()
{
    $("#modalcadbairro").modal('show');
}

    function rotacionar( idimagem, graus )
    {
        var url = "{{route('image.rotate')}}/"+idimagem+"/"+graus;
        console.log(url);
        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function()
                {
                    alert('Rotacionado');
                    dsource = $("#img"+idimagem).attr( 'src' );
                    $("#img"+idimagem).attr("src", dsource+moment().format('MMSS') );
                    

                },
                error:function()
                {
                    alert('erro ao rotacionar');
                }
            }
        )
    }

    function alterarClienteEditImv( id )
        {
            $("#id-cliente-prop").val( id );
            $("#form-alt-cliente-indexctr").submit();
        }

    

</script>
@endpush
