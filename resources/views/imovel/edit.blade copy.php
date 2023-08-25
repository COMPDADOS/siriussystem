@extends('layout.app')
@push('script')
@endpush

@section('scripttop')

<style>

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

</style>
@endsection


@section('content')
<div class="portlet light bordered">
    <div class="portlet-body">
        <div class="tabbable-custom nav-justified">
            <ul class="nav nav-tabs valores  nav-justified">
                <li class="active">
                    <a class="valores" href="#tab_1_1_1" data-toggle="tab">Geral</a>
                </li>
                <li>
                    <a href="#tab_1_1_2" data-toggle="tab">Medidas/Cômodos</a>
                </li>
                <li>
                    <a href="#tab_1_1_3" data-toggle="tab">Observações / Chaves</a>
                </li>
                <li>
                    <a href="#tab_1_1_4" data-toggle="tab">Imagens</a>
                </li>
                <li>
                    <a href="#tab_1_1_5" data-toggle="tab">Corretor/Captador</a>
                </li>
                <li>
                    <a href="#tab_1_1_6" data-toggle="tab">Portais</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1_1_1">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="col-md-2">
                                    <label class="label-control">Site
                                        <input type="checkbox" id="IMB_IMV_WEBIMOVEL" class="form-control" data-checkbox="icheckbox_flat-blue">
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label class="label-control">Radar
                                        <input type="checkbox" id="IMB_IMV_RADAR" class="form-control" data-checkbox="icheckbox_flat-blue">
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label class="label-control">Destaque
                                        <input type="checkbox" id="IMB_IMV_DESTAQUE" class="form-control" data-checkbox="icheckbox_flat-blue">
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label class="label-control">Lançto.
                                        <input type="checkbox" id="IMB_IMV_WEBLANCAMENTO"  class="form-control"  data-checkbox="icheckbox_flat-blue">
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label class="label-control">Exclusivo
                                        <input type="checkbox" id="IMB_IMV_ESCLUSIVO" class="form-control" data-checkbox="icheckbox_flat-blue">
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label class="label-control">Térrea
                                        <input type="checkbox" id="IMB_IMV_TERREA"  class="form-control"  data-checkbox="icheckbox_flat-blue">
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-2">
                                    <label >Sobrado
                                        <input type="checkbox" id="IMB_IMV_SOBRADO" class="form-control" data-checkbox="icheckbox_flat-blue">
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label >Placa
                                        <input type="checkbox" id="IMB_IMV_PLACA" 
                                        class="form-control" data-checkbox="icheckbox_flat-blue">
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label >Ac. Financ.
                                        <input type="checkbox" id="IMB_IMV_ACEITAFINANC"class="form-control"  data-checkbox="icheckbox_flat-blue">
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label >Permuta
                                        <input type="checkbox" id="IMB_IMV_PERMUTA"  class="form-control" data-checkbox="icheckbox_flat-blue">
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label >Escritura
                                        <input type="checkbox" id="IMB_IMV_ESCRIT" class="form-control" data-checkbox="icheckbox_flat-blue">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

    
                    <div class="form-body">
                        <div class="portlet box blue">
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
                                            <th width="100" style="text-align:center"> Percentual </th>
                                            <th width="100" style="text-align:center"> Principal </th>
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
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Localização
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                </div>
                            </div>

                            <div class="portlet-body form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Título do Imóvel</label>
                                            <input type="text" id="IMB_IMV_TITULO"  class="form-control input-sm" style="font-family: Tahoma; font-size: 16px" placeholder="Ex.: casa da rua aimores">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Tipo</label>
                                            <input type="text" id="IMB_IMV_ENDERECOTIPO"  class="form-control input-sm" style="font-family: Tahoma; font-size: 16px" placeholder="Rua,Avenida,Praça...">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label id="ilogradouro" >Logradouro</label>
                                            <input type="text" maxlength="40" id="IMB_IMV_ENDERECO"  
                                                class="form-control  mr-sm-0 input-sm" style="font-family: Tahoma; font-size: 16px">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Número</label>
                                            <input type="text" maxlength="10"  id="IMB_IMV_ENDERECONUMERO"
                                                class="form-control input-sm" style="font-family: Tahoma; font-size: 16px">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Complemento</label>
                                            <input type="text" maxlength="20"  id="IMB_IMV_ENDERECOCOMPLEMENTO"
                                                class="form-control input-sm" style="font-family: Tahoma; font-size: 16px" >
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Apt.</label>
                                            <input type="text" id="IMB_IMV_NUMAPT" maxlength="5" 
                                                class="form-control input-sm" style="font-family: Tahoma; font-size: 16px">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Condomínio</label>
                                            <select class="form-control" id="IMB_CND_ID" >
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Nome Prédio</label>
                                            <input type="text" id="IMB_IMV_PREDIO" 
                                                class="form-control input-sm" >
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Andar</label>
                                            <input type="text" id="IMB_IMV_ANDAR" 
                                                class="form-control input-sm">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Bairro</label>
                                            <input type="text" 
                                                id="CEP_BAI_NOME" 
                                                maxlength="20"
                                                class="form-control input-sm" >
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
                                                    max="99999999">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Cidade</label>
                                            <input type="text" id="IMB_IMV_CIDADE"
                                                maxlength="20"
                                                class="form-control input-sm">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>UF</label>
                                            <input type="text" id="IMB_IMV_ESTADO" class="form-control input-sm" >
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Quadra</label>
                                            <input type="text" id="IMB_IMV_QUADRA" class="form-control input-sm" >
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Lote</label>
                                            <input type="text" id="IMB_IMV_LOTE" class="form-control input-sm" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Pontos de Referência/Imediações</label>
                                                <input type="text" maxlength="40"  id="IMB_IMV_PROXIMIDADE" 
                                                class="form-control" >
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
                                        <div class="form-group" >
                                            <label class="control-label">Unidade</label>
                                            <select class="form-control" id="IMB_IMB_ID2" >
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label>Tipo de Imóvel</label>
                                            <select class="form-control" id="IMB_TIM_ID">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Data Cadastro</label>
                                            <input type="text" id="IMB_IMV_DATACADASTRO" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Atualização</label>
                                            <input type="text" id="IMB_IMV_DATAATUALIZACAO" class="form-control"  readonly >
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
                                            <label>Referência</label>
                                            <input type="text" id="IMB_IMV_REFERE"
                                                class="form-control input-sm" 
                                                readonly>

                                        </div>
                                    </div>

                                    <div class="col-md-2 ">
                                        <label>Status</label>
                                        <select class="form-control" id="VIS_STA_ID">
                                        </select>
                                    </div>

                                    <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label>R$ Venda</label>
                                            <input type="text" 
                                                class="form-control valor valores" 
                                                id="IMB_IMV_VALVEN" 
                                                placeholder="Valor de Venda">
                                        </div>
                                    </div>

                                    <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label>R$ Locação</label>
                                            <input type="text"  
                                                class="form-control valor valores" 
                                                id="IMB_IMV_VALLOC" 
                                                placeholder="Valor de Locação" >
                                        </div>
                                    </div>
                                    <input  type="hidden" id="IMB_CLT_ID"  >
                                    <input  type="hidden" id="IMB_CLT_IDORIGINAL">
                                </div>
                            </div>
                        </div>

                            <!-- Botões -->
                        <div class="form-actions right">
                            <button type="button" class="btn default"  onClick="onCancelar()">Cancelar</button>
                            <button type="button" class="btn blue " onClick="onGravar()" id="i-btn-gravar">
                                    <i class="fa fa-check"></i> Gravar
                            </button>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="tab_1_1_2">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Medida Terreno</label>
                                <input type="text" id="IMB_IMV_MEDTER"  class="form-control" 
                                     placeholder="ex.: 10x20">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Área Total(m2)</label>
                                <input type="text" id="IMB_IMV_ARETOT"  class="form-control" >
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Área Construída(m2)</label>
                                <input type="text" id="IMB_IMV_ARECON"   class="form-control" >
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Área Útil(apto)(m2)</label>
                                <input type="text" id="IMB_IMV_AREUTI"  class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-1">
                            <div class="form-group">
                                    <label class="control-label">Dorm.</label>
                                    <input type="text" id="IMB_IMV_DORQUA"  
                                    class="form-control"
                                    onkeypress="return isNumber(event)" onpaste="return false;">
                            </div>
                        </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">suites</label>
                                    <input type="text" id="IMB_IMV_SUIQUA"   
                                    class="form-control " 
                                    onkeypress="return isNumber(event)" onpaste="return false;">
                                </div>
                            </div>
                        <div class="col-md-2">
                            <div class="checkbox icheck-primary">
                                <input type="checkbox" id="IMB_IMV_DORAE">
                                <label class="form-check-label">AE</label>
                            </div>

                            <div class="checkbox icheck-primary">
                                <input type="checkbox" id="IMB_IMV_SUIHID" >
                                <label class="form-check-label">Hidro </label>
                            </div>

                            <div class="checkbox icheck-primary">
                                <input type="checkbox"  id="IMB_IMV_DORCLO" >
                                <label class="form-check-label">Closet</label>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">WC</label>
                                <input type="text" id="IMB_IMV_WCQUA" 
                                class="form-control"
                                onkeypress="return isNumber(event)" onpaste="return false;">
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">Salas</label>
                                <input type="text" id="IMB_IMV_SALQUA" 
                                class="form-control"
                                onkeypress="return isNumber(event)" onpaste="return false;">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="checkbox icheck-primary">
                                <input type="checkbox" id="IMB_IMV_COZINHA" >
                                <label class="form-check-label">Cozinha</label>
                            </div>

                            <div class="checkbox icheck-primary">
                                <input type="checkbox" id="IMB_IMV_COZPLA">
                                <label class="form-check-label">Planejada</label>
                            </div>

                            <div class="checkbox icheck-primary">
                                <input type="checkbox" id="IMB_IMV_LAVABO">
                                <label class="form-check-label">Lavabo</label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="checkbox icheck-primary">
                                <input type="checkbox"  id="IMB_IMV_EMPQUA">
                                <label class="form-check-label">Dorm. Empr.</label>
                            </div>

                            <div class="checkbox icheck-primary">
                                <input type="checkbox"  id="IMB_IMV_EMPWC">
                                <label class="form-check-label">WC Empreg.</label>
                            </div>

                            <div class="checkbox icheck-primary">
                                <input type="checkbox"  id="IMB_IMV_DESPENSA" >
                                <label class="form-check-label">Despensa</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="checkbox icheck-primary">
                                <input type="checkbox"  id="IMB_IMV_ARESER">
                                <label class="form-check-label">Área Serviço</label>
                            </div>

                            <div class="checkbox icheck-primary">
                                <input type="checkbox"  id="`imb_imv_varandagourmet">
                                <label class="form-check-label">Sacada Gourmet</label>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-1">
                        </div>

                        <div class="col-md-2">
                            <div class="checkbox icheck-primary">   
                                <input type="checkbox"  id="IMB_IMV_PISCIN">
                                <label class="form-check-label">Piscina</label>
                            </div>

                            <div class="checkbox icheck-primary">
                                <input type="checkbox"   id="IMB_IMV_EDICUL">
                                <label class="form-check-label">Edícula</label>
                            </div>

                            <div class="checkbox icheck-primary">
                                <input type="checkbox"   id="IMB_IMV_QUINTA">
                                <label class="form-check-label">Quintal</label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="checkbox icheck-primary">
                                <input type="checkbox"   id="IMB_IMV_CHURRA">
                                <label class="form-check-label">Churrasqueira</label>
                            </div>

                            <div class="checkbox icheck-primary">
                                <input type="checkbox"   id="IMB_IMV_PORELE">
                                <label class="form-check-label">Portão Eletr.</label>
                            </div>

                            <div class="checkbox icheck-primary">
                                <input type="checkbox"   id="IMB_IMV_SAUNA">
                                <label class="form-check-label">Sauna</label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="checkbox icheck-primary">
                                <input type="checkbox"   id="IMB_IMV_QUADRAPOLIESPORTIVA" >
                                <label class="form-check-label">Quadra</label>
                            </div>

                            <div class="checkbox icheck-primary">
                                <input type="checkbox" id="IMB_IMV_SALFES">
                                <label class="form-check-label">Salão Festas</label>
                            </div>

                            <div class="checkbox icheck-primary">
                                <input type="checkbox" id="IMB_IMV_PLAGRO">
                                <label class="form-check-label">Playground</label>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">Vagas Cobertas</label>
                                <input type="number" id="IMB_IMV_GARCOB"   min="0" class="form-control"  >
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">Vagas Descob.</label>
                                <input type="number" id="IMB_IMV_GARDES"  min="0" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label"><br>Idade Imóvel</label>
                                <input type="text" id="IMB_IMV_IDADE" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-actions right">
                        <button type="button" class="btn default"    onClick="onCancelar()">Cancelar</button>
                        <button type="button" class="btn blue " onClick="onGravar()" id="i-btn-gravar-2">
                                <i class="fa fa-check"></i> Gravar
                        </button>
                    </div>

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
                                <textarea rows="2" id="IMB_IMV_CHAVES" style="min-width: 100%"></textarea>
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
                                <textarea rows="5" id="IMB_IMV_OBSERV" style="min-width: 100%"></textarea>
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
                                <textarea rows="5"id="IMB_IMV_OBSWEB" style="min-width: 100%"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions right">
                        <button type="button" class="btn default"   onClick="onCancelar()" >Cancelar</button>
                        <button type="submit" class="btn blue " id="i-btn-gravar-3" onClick="onGravar()">
                                <i class="fa fa-check"></i> Gravar
                        </button>
                    </div>
                </div>


                    <!--</form>-->

                <div class="tab-pane" id="tab_1_1_4">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>Imagens
                            </div>
                            <div class="tools">
                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <button class="btn btn-transparent dark btn-outline btn-circle btn-sm"
                                        onClick="carrousel(0)">
                                        Ver no Slider
                                    </button>
                                </div>
                                <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>

                        <div class="portlet-body form">
                            <div class="form-body" id="galeria-imovel"></div>
                            <table class="table" id="tblimagens">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="180" >Imagem</th>
                                        <th >Titulo</th>
                                        <th width="250" 
                                            style="text-align:center"
                                            > Ações 
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                        <form enctype="multipart/form-data">
                            @csrf
                            <div class="form-actions text-center">
                                <input type="hidden"  id="volta" name="telavolta" value="">
                                <input type="hidden"   name="imbmaster" value="{{$imovel->IMB_IMB_ID}}" id="i-imb_imagem">
                                <input type="hidden"  name="id" value="{{$imovel->IMB_IMV_ID}}" id='i-imv-id'>
                                <input type="file" id="galeria-imagem-upload" accept="image/*" capture="camera" style="visibility: hidden;" name="arquivo[]" multiple>
                                <button type="button" id="galeria-imagem-btn" onClick="upLoadImagem()" class="btn btn-primary"><i class="fa fa-camera-retro"></i> Fazer Upload / Tirar Foto</button>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div id="targetLayer" style="display:none;"></div>                        
                        </form>    
                        <div class="text-center" id="loader-icon" style="display:none;"><img src="{{asset('/layouts/layout/img/loader.gif')}}" /></div>                        
                    </div>
                </div>

                <div class="tab-pane" id="tab_1_1_5">
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
                                        <th style="text-align:center"> Corretor </th>
                                        <th width="100" style="text-align:center"> Percentual </th>
                                        <th width="200" style="text-align:center"> Ações </th>
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
                                        <th style="text-align:center"> Captador </th>
                                        <th width="100" style="text-align:center"> Percentual </th>
                                        <th width="200" style="text-align:center"> Ações </th>
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

                <div class="tab-pane" id="tab_1_1_6">
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
                </div>
            </div>
        </div>
    </div>
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
                <form class="form-horizontal" id="formCorImo">
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
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Percentual - %</label>
                                            <input type="number" class="form-control" id="i-percentual" min="1" >
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <div class="modal-footer">
                            <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submmit" class="btn btn-primary">Salvar mudanças</button>
                        </div>
                    <!--</form>-->
            
                
            </div>
        </div>
    </div>
</div>


<!--modal IMAGENS -->
<div class="modal" tabindex="-1" role="dialog" id="modalimagem">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Imagens do Imóvel - Alteração
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                </div>
                    <form class="form-horizontal" id="formimagem">
                        <input type="hidden" id="i-idimg">
                        <input type="hidden" id="i-idimovel-img" name="IMB_IMV_ID" 
                                                value="{{$imovel->IMB_IMV_ID}}">
                        <input type="hidden" id="i-idempresa-img" name="IMB_IMB_IDIMAGEM"
                                               value="{{$imovel->IMB_IMB_ID2}}">
                        <div class="portlet-body form">
                            <div class="form-body" >
                            <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nome da Imagem</label>
                                            <input type="text" maxlength="100" 
                                            class="form-control" id="i-nomeimagem" 
                                            name="IMB_IMG_NOME">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                            <input type="checkbox" name="IMB_IMG_PRINCIPAL"
                                                     class="icheck" data-checkbox="icheckbox_flat-blue"
                                                     id="i-imagemprincipal">
                                                Imagem Principal
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                            <input type="checkbox" name="IMB_IMG_CAPA"
                                                     class="icheck" data-checkbox="icheckbox_flat-blue"
                                                     id="i-imagemcapa">
                                                Mostrar na Capa do Site
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                            <input type="checkbox" name="IMB_IMG_NAOIRPROSITE"
                                                     class="icheck" data-checkbox="icheckbox_flat-blue"
                                                     id="i-imagemnaoirsite">
                                                NÃO Exibir no site
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="cabcel" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="button" class="btn btn-primary" onClick="salvarImagem()">Salvar mudanças</button>
                                </div>
                            </div>
                        </div>
                    </form>
            
                
            </div>
        </div>
    </div>
</div>



<!--modal CAPIMO -->
<div class="modal" tabindex="-1" role="dialog" id="modalcapimo">
    <div class="modal-dialog" role="document">
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
                    <form class="form-horizontal" id="formCapImo">
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
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Percentual - %</label>
                                            <input type="number" class="form-control" id="i-percentual-cap" min="1" >
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <div class="modal-footer">
                            <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submmit" class="btn btn-primary">Salvar mudanças</button>
                        </div>
                    </form>
            
                
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Selecione abaixo</label>
                                <select class="form-control" id="selclientelike">
                                </select>
                            </div>
                        </div>
                    </div>
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
                                        class="icheck" data-checkbox="icheckbox_flat-blue"
                                        id="i-principal-prop">
                                        Principal
                                </label>
                            </div>
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

@include( 'layout.clienterapido')


@endsection
@push('script')

<script type="text/javascript">
    $("#i-form-imovel :input").prop("disabled", false);
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
       
        if  ( carregarOpcao( $("#I-IMB_ATD_ID").val(), 17,3, "{{route('direito.checar')}}") == false )  
            window.history.back();

        

        if( $("#i-idempresa").val() != $("#I-IMB_IMB_IDMASTER").val() )
        {
          window.history.back();
          return false;
        }

        preencherCBCorretores(999999);
        calcularPerProp();
        temPrincipal();
        cargaImovel();    
        portalImovelCarga();

        $("#galeria-imagem-upload").on("change", function (e) {
                var file = $(this)[0].files[0];
                console.log('up');
                upLoadImagem();
            });

        $("#galeria-imagem-btn").click(function()
        {
            $("#galeria-imagem-upload").click();
        });
        
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


            if ($.trim($('#IMB_IMV_ENDERECOCEP').val()) !== '') 
            {
                //console.log('passando');
                $('#mensagem').html('(Aguarde, consultando CEP ...)');

                // NOVO CODIGO =============================================

                // Guardar o CEP do input.
                const cep = $('#IMB_IMV_ENDERECOCEP').val();

                // Construir a url com o CEP do input.
                // IMPORTANTE: na url, informar o parametro formato=json ao invés de formato=javascript.
                const urlBuscaCEP = `http://cep.republicavirtual.com.br/web_cep.php?formato=json&cep=${cep}`;

                // Realizar uma requisição HTTP GET na url.
                // O primeiro parâmetro é a url.
                // O segundo parâmetro é o callback, ou seja,
                // uma função que vai ser executada quando os dados forem retornados.
                // Essa função recebe um parâmetro que são os dados que a API retornou.
                $.get(urlBuscaCEP, (resultadoCEP) => 
                {

                    if (resultadoCEP.resultado) 
                    {
                        // /$('#rua').val(`${resultadoCEP['tipo_logradouro']} ${resultadoCEP['logradouro']}`);
                        $('#IMB_IMV_ENDERECOTIPO').val(resultadoCEP.tipo_logradouro);
                        $('#IMB_IMV_ENDERECO').val(resultadoCEP.logradouro);
                        $('#CEP_BAI_NOME').val(resultadoCEP.bairro.substr( 0, 19 ));
                        $('#IMB_IMV_CIDADE').val(resultadoCEP.cidade.substr( 0, 19 ));
                        $('#IMB_IMV_ESTADO').val(resultadoCEP.uf);
                    } 
                    else 
                    {
                    console.error('Erro ao carregar os dados do CEP.');
                    }
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
        str = $("#i-str").val();
        if( isNaN( str) )
        {
            var url = "{{ route('buscaclienteincremental') }}"+"/"+str;
        }
        else
            var url = "{{ route('cliente.localizar.telefone') }}"+"/"+str;
        
        $.getJSON( url, function( data)
        {
        linha = "";
        $("#selclientelike").empty();
        for( nI=0;nI < data.length;nI++)
        {
            linha = 
            '<option value="'+data[nI].IMB_CLT_ID+'">'+
            data[nI].IMB_CLT_NOME+"</option>";
            $("#selclientelike").append( linha );
        }
        });
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
            $("#i-percentual").val(data.IMB_CORIMO_PERCENTUAL);
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
                    '   <td>'+data[nI].IMB_ATD_NOME+'</td>'+
                    '   <td>'+data[nI].IMB_CORIMO_PERCENTUAL+'%</td>'+
                    '   <td style="text-align:center"> '+
//                    '<a  class="btn btn-sm btn-primary" href=javascript:editarCorImo('+data[nI].IMB_CORIMO_ID+')>Editar</a>&nbsp;&nbsp;&nbsp;&nbsp;'+
//                    '           <button class="btn btn-sm btn-primary" onclick="editarCorImo('+data[nI].IMB_CORIMO_ID+' )">Editar</button>'+ 
//                    '           <button class="btn btn-sm btn-danger" onclick="apagarCorImo('+data[nI].IMB_CORIMO_ID+' )">Apagar</button>'+ 
                    '<a  class="btn btn-sm btn-primary" href=javascript:editarCorImo('+data[nI].IMB_CORIMO_ID+')>     Editar</a>'+
                    '<a  class="btn btn-sm btn-danger" href=javascript:apagarCorImo('+data[nI].IMB_CORIMO_ID+')>     Apagar</a>'+
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

        console.log('url carga atendente: '+url );

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
            IMB_CORIMO_PERCENTUAL : $("#i-percentual").val()
        };

        //alert( 'CORIMO.IMB_IMB_ID : '+corimo.IMB_IMB_ID );



        $.post("{{ route( 'corimo.salvar' ) }}", corimo, function(data)
        {
                $("#modalcorimo").modal("hide");
        });

        CarregarCorImo($("#i-idimovel").val());

    };
        
    
    $("#formCorImo").submit
        ( function( event )
        { 
            event.preventDefault();
            //alert($("#i-idcorimo").val());
                   criarCorImo();

            CarregarCorImo($("#i-idimovel").val());
            
         });

/*    function setarSelectCorretor(id)
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
    
*/
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
        $("#i-percentual-cap").val('100');
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
            $("#i-percentual-cap").val(data.IMB_CAPIMO_PERCENTUAL);
//            $("#i-select-corretor").val(data.IMB_ATD_ID);
            //console.log( 'corretor definido '+data.IMB_ATD_ID);

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
                    '   <td>'+data[nI].IMB_ATD_NOME+'</td>'+
                    '   <td>'+data[nI].IMB_CAPIMO_PERCENTUAL+'</td>'+
                    '   <td style="text-align:center"> '+   
//                    '<a  class="btn btn-sm btn-primary" href=javascript:editarCorImo('+data[nI].IMB_CORIMO_ID+')>Editar</a>&nbsp;&nbsp;&nbsp;&nbsp;'+
//                    '           <button class="btn btn-sm btn-primary" onclick="editarCorImo('+data[nI].IMB_CORIMO_ID+' )">Editar</button>'+ 
//                    '           <button class="btn btn-sm btn-danger" onclick="apagarCorImo('+data[nI].IMB_CORIMO_ID+' )">Apagar</button>'+ 
                    '<a  class="btn btn-sm btn-primary" href=javascript:editarCapImo('+data[nI].IMB_CAPIMO_ID+')>     Editar</a>'+
                    '<a  class="btn btn-sm btn-danger" href=javascript:apagarCapImo('+data[nI].IMB_CAPIMO_ID+')>     Apagar</a>'+
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
            IMB_CAPIMO_PERCENTUAL : $("#i-percentual-cap").val()
        };
        $.post("{{ route( 'capimo.salvar' ) }}", capimo, function(data)
        {
                $("#modalcapimo").modal("hide");
        });

        CarregarCapImo( $("#i-idimovel").val() );


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
    function CarregarImagens( nId)
    {
    
        $.getJSON( "{{ route( 'imagens.imoveis')}}/"+nId, function( data)
        {
            linha = "";
            $("#tblimagens>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                var detalhes ='<hr><ul>';

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

                var nome = data[nI].IMB_IMG_NOME;
                if( nome == null)
                    nome = "";
                linha = 
                        '<tr>'+
                        '<td><a href=javascript:carrousel('+data[nI].IMB_IMG_ID+')><img class="card-img-top" src="/sys/storage/images/'+
                        $("#I-IMB_IMB_IDMASTER").val()+'/imoveis/thumb/'+data[nI].IMB_IMV_ID+'/100_75'+data[nI].IMB_IMG_ARQUIVO+'"</a></td>'+
                        '<td style="text-align:center valign="center">'+nome+detalhes+'</td>' +
                        '<td style="text-align:center" valign="center"> '+
                            '<a href=javascript:editarImagem('+data[nI].IMB_IMG_ID+') class="btn btn-sm btn-primary">Editar</a> '+
                            '<a href=javascript:apagarImagem('+data[nI].IMB_IMG_ID+') class="btn btn-sm btn-danger">Excluir</a> ';

                if( data[nI].IMB_IMG_PRINCIPAL !='S')
                    linha = linha + 
                                '<a href=javascript:imagemPrincipal('+data[nI].IMB_IMV_ID+','+
                                data[nI].IMB_IMG_ID+') class="btn btn-sm btn-default">Definir</a> '+
                            '</td> ';
                else
                    linha = linha + 
                                '<a class="btn btn-sm btn-success">Definida</a> '+
                            '</td> ';
                    linha = linha +
                        '</tr>';
                    
                $("#tblimagens").append( linha );
                        
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


    function salvarImagem( )
    {
        $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });       

        var url = "{{ route('imagem.salvar') }}"+"/"+$("#i-idimg").val();


        imagem = 
        {
            IMB_IMB_ID : $("#IMB_IMB_IDIMAGEM").val(),
            IMB_IMV_ID : $("#i-idimovel").val(),
            IMB_IMG_NOME: $("#i-nomeimagem").val(),
            IMB_IMG_PRINCIPAL: $( '#i-imagemprincipal' ).prop( "checked" )   ? 'S' : 'N',
            IMB_IMG_NAOIRPROSITE: $( '#i-imagemnaoirsite' ).prop( "checked" )   ? 'S' : 'N',
            IMB_IMG_CAPA: $( '#i-imagemcapa' ).prop( "checked" )  ? 'S' : 'N'
        };

        $.ajax(
        {
            url:url, 
            data:imagem,
            type:'post',
            datatype:'json',
            async:false,
            success: function()
            {
                $("#modalimagem").modal("hide");
                CarregarImagens( $("#i-idimovel").val() );                
            }

        });
        
        /*$.post( url, imagem, function(data)
        {
                $("#modalimagem").modal("hide");
                CarregarImagens();
        });
*/

    }

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
        
        if( $("#IMB_IMV_VALVEN").val() == '' )
            $("#IMB_IMV_VALVEN").val(0);

        if( $("#IMB_IMV_VALLOC").val() == '' )
            $("#IMB_IMV_VALLOC").val(0);

        var areaconstruida = $("#IMB_IMV_ARECON").val();
        areaconstruida = areaconstruida.replace(',','.');

        var valorinformado =
            parseFloat($("#IMB_IMV_VALLOC").val() )  +
            parseFloat($("#IMB_IMV_VALVEN").val() );
        
        calcularPerProp();        
        temPrincipal()
        
        var totalpercprop = $("#i-totalperc").val();
        var principal = $("#i-temprincipal").val();
                 
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
        

        if ( totalpercprop != 100 )        
        {
            nerros = nerros  + 1;
            cerros = cerros + 'O total de participação em proprietário(s) deve 100%\n';
        }

        if ( principal == 0 )        
        {
            nerros = nerros  + 1;
            cerros = cerros + 'Deve haver pelo menos um proprietário como principal\n';
        }

        if ( principal > 1 )        
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
        var radar = $("#IMB_IMV_RADAR").prop('checked') ? 'S' : 'N';
    


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
            IMB_IMV_DATACADASTRO : $("#IMB_IMV_DATACADASTRO").val(),
            IMB_IMV_DATSUS : $("#IMB_IMV_DATSUS").val(),
            IMB_IMV_REFERE : $("#IMB_IMV_REFERE").val(),
            IMB_IMV_VALVEN : realToDolar( $("#IMB_IMV_VALVEN").val() ),
            IMB_IMV_VALLOC : realToDolar($("#IMB_IMV_VALLOC").val()),
            IMB_IMV_ENDERECOTIPO : $("#IMB_IMV_ENDERECOTIPO").val(),
            IMB_IMV_NUMAPT : $("#IMB_IMV_NUMAPT").val(),
            IMB_IMV_PREDIO : $("#IMB_IMV_PREDIO").val(),
            IMB_IMV_ANDAR : $("#IMB_IMV_ANDAR").val(),
            CEP_BAI_NOME : $("#CEP_BAI_NOME").val(),
            IMB_IMV_ENDERECOCEP : $("#IMB_IMV_ENDERECOCEP").val(),
            IMB_IMV_CIDADE : $("#IMB_IMV_CIDADE").val(),
            IMB_IMV_ESTADO : $("#IMB_IMV_ESTADO").val(),
            IMB_IMV_QUADRA : $("#IMB_IMV_QUADRA").val(),
            IMB_IMV_LOTE : $("#IMB_IMV_LOTE").val(),
            IMB_IMV_PROXIMIDADE : $("#IMB_IMV_PROXIMIDADE").val(),
            IMB_IMV_MEDTER : $("#IMB_IMV_MEDTER").val(),
            IMB_IMV_ARETOT : $("#IMB_IMV_ARETOT").val(),
            IMB_IMV_AREUTI : $("#IMB_IMV_AREUTI").val(),
            IMB_IMV_ARECON : areaconstruida,
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
            IMB_IMV_RADAR : radar,
            VIS_STA_ID : $("#VIS_STA_ID").val(),
            IMB_IMV_TITULO: $("#IMB_IMV_TITULO").val(),
            IMB_ATD_ID: $("#I-IMB_ATD_ID").val(),
            imb_imv_varandagourmet: $("#I-imb_imv_varandagourmet").val(),
            IMB_IMV_ARESER: $("#IMB_IMV_ARESER").val(),
            IMB_IMV_CHAVES: $("#IMB_IMV_CHAVES").val(),

                        
                        
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

                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Gravado com Sucesso!',
                showConfirmButton: true,
                timer: 3500
              });

              window.history.back();


            },
            error: function()
            {
                alert('erro');
            }
        });
        
    }

    function onCancelar()
    
    {
    
        $.ajaxSetup({
                headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });       

        if ( $("#i-referencia").val() == '')
           {
            str = $("#i-codigoimovel").val();
            var url = "{{ route('imovel.apagar') }}"+"/"+str;

         
            $.ajax({
                    type: "delete",
                        url: url,
                        context: this,
                        error: function( error )
                        {
                            console.log(error);
                        }
                    });
        }
        window.history.back();
    }

    function preencherCondominio( nId )
    {
        url = "{{ route('condominio.carga')}}/"+$("#I-IMB_IMB_IDMASTER").val();
        console.log( 'condominios: '+url );
        $.getJSON( url, function( data )

        {
            $("#IMB_CND_ID").empty();
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
        $.getJSON( url, function( data)
        {
            linha = "";
            $("#tbpropimo>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                linha = 
                    '<tr>'+
                    '   <td style="text-align:center">'+data[nI].IMB_CLT_NOME+'</td>'+
                    '   <td style="text-align:center">'+data[nI].IMB_IMVCLT_PERCENTUAL4+'%</td>'+
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
            $("#i-idpropimo").val( data.IMB_PPI_ID),
            $("#i-idimovel-prop").val( data.IMB_IMV_ID),
            $('#i-principal-prop' ).prop( "checked" , (data.IMB_IMVCLT_PRINCIPAL =='S') );
            $("#i-percentual-prop").val( data.IMB_IMVCLT_PERCENTUAL4);
            $("#i-str").val( data.IMB_CLT_NOME );
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
            var url = "{{ route('propimo.parttotal') }}"+"/"+$("#i-idimovel-prop").val();
            $.getJSON( url, function( data)
            {
                    $("#i-totalperc").val( data );

            })
        }        

    function temPrincipal()
        {
            var url = "{{ route('propimo.temprincipal') }}"+"/"+$("#IMB_IMV_ID").val();
            $.getJSON( url, function( data)
            {
                $("#i-temprincipal").val( data );
                //alert( data );

            });
            
        }        

    function carrousel()
    {
        window.open("{{ route('imovel.detalhecomfoto') }}/" + $("#IMB_IMV_ID").val(),
         "imagens", "height=1024,width=600");
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
                $("#IMB_IMV_DORQUA").val(data.IMB_IMV_DORQUA );
                $("#IMB_IMV_SUIQUA").val(data.IMB_IMV_SUIQUA );
                $("#IMB_IMV_WCQUA").val(data.IMB_IMV_WCQUA );
               
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

                $("#IMB_IMV_TERREA").prop( 'checked',false );
                if( data.imb_imv_terrea == 'S')
                    $("#IMB_IMV_TERREA").prop( 'checked',true );

                                                            
        
                $("#IMB_IMV_GARCOB").val(data.IMB_IMV_GARCOB );

                $("#IMB_IMV_GARDES").val(data.IMB_IMV_GARDES );
                $("#IMB_IMV_IDADE").val(data.IMB_IMV_IDADE );
                $("#IMB_IMV_OBSERV").val(data.IMB_IMV_OBSERV );
                $("#IMB_IMV_OBSWEB").val(data.IMB_IMV_OBSWEB );
                                                            
                preencherUnidades( data.IMB_IMB_ID2 );
                preencherTipoImovel( data.IMB_TIM_ID );
                preencherCondominio( data.IMB_CND_ID);
                CarregarPropImo(data.IMB_IMV_ID);
                CarregarCorImo(data.IMB_IMV_ID);
                CarregarCapImo(data.IMB_IMV_ID);
                CarregarImagens(data.IMB_IMV_ID);
                cargaStatus( data.VIS_STA_ID );
                statusImovel( data.VIS_STA_ID );

            },
            error: function()
            {
                alert('error ');
            }
        })

    }
    
   
    function upLoadImagem()
    {
            var arquivos = $("#galeria-imagem-upload")[0].files;

            for (var i = 0; i < arquivos.length; i++)
            {
                console.log( 'arq '+arquivos[i].name);
                var fd = new FormData();
                fd.append( 'arquivo', arquivos[i] );
                fd.append( 'id', $("#i-imv-id").val()  );
                fd.append( 'imbmaster', $("#I-IMB_IMB_IDMASTER").val()  );
                alert('Enviado Imagem: '+(i+1)+'. Pressione aqui para continuar');
            
                $.ajaxSetup(
                {
                    headers:    
                    {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    }
                });        
                $.ajax(
                {
                    url: "{{ route('imagensimoveis')}}",
                    type:'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    beforeSend: function()
                    {
                        $("#loader-icon").show();
                    },
                    complete: function( response )
                    {
                        if( response != 0 )
                        {

                            CarregarImagens( $("#i-imv-id").val() );
                            $("#loader-icon").hide();
                            $("#galeria-imagem-upload").val('');


                        }
                        else
                        {
                            $("#galeria-imagem-upload").val('');
                            alert('Arquivo não encontrato');
                        }
                    }
                });
            }
        

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



</script>
@endpush