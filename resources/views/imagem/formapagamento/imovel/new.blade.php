@extends('layout.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="#">Cadastro</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">Imóveis</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Cadastro</span>
        </li>
    </ul>
</div>

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject bold uppercase">Cadastro de Imóveis</span>
            <i class="fa fa-gift"></i>
        </div>
        <div class="tools">
            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
        </div>
    </div>
    <div class="portlet-body">
        <form action="{{route('imovel.store')}}" id="frmCadastro"
        method="post">
            @csrf
            <div class="tabbable-custom nav-justified">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active">
                        <a href="#tab_1_1_1" data-toggle="tab">Dados do Imóvel</a>
                    </li>
                    <li>
                        <a href="#tab_1_1_2" data-toggle="tab">Medidas / Imediações / Cômodos</a>
                    </li>
                    <li>
                        <a href="#tab_1_1_3" data-toggle="tab">Observações</a>
                    </li>
                    <li>
                        <a href="#tab_1_1_4" data-toggle="tab">Imagens</a>
                    </li>
                </ul>
                <div class="tab-content">
                      <div class="tab-pane active" id="tab_1_1_1">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="icheck-inline checkbox">
                                            <label>
                                                <input type="checkbox" name="IMB_IMV_WEBIMOVEL" 
                                                class="icheck" data-checkbox="icheckbox_flat-blue" value="N">
                                                Aparecer no Site
                                            </label>
                                            <label>
                                                <input type="checkbox" name="   IMB_IMV_DESTAQUE"class="icheck" 
                                                data-checkbox="icheckbox_flat-blue"value="N">
                                                Destaque
                                            </label>
                                            <label>
                                                <input type="checkbox" name="IMB_IMV_WEBLANCAMENTO"  class="icheck" 
                                                data-checkbox="icheckbox_flat-blue" value="N">
                                                Lançamento
                                            </label>
                                            <label> 
                                                <input type="checkbox" name="IMB_IMV_ESCLUSIVO"  class="icheck" 
                                                data-checkbox="icheckbox_flat-blue" value="N">
                                                Exclusividade
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" >
                                        <label class="control-label">Unidade</label>
                                        <select class="form-control" name="IMB_IMB_ID">
                                            @foreach ($imobiliaria as $imobiliaria)
                                                <option  value ="{{ $imobiliaria->IMB_IMB_ID }}">
                                                {{$imobiliaria->IMB_IMB_NOME}}
                                                 </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label>Tipo de Imóvel</label>
                                        <select class="form-control" name="IMB_TIM_ID">
                                            @foreach ($tipoimovel as $tipo)
                                                <option value="{{ $tipo->IMB_TIM_ID }}" >
                                                    {{ $tipo->IMB_TIM_DESCRICAO }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="icheck-list checkbox">
                                            <label class="form-check-label">
                                                <input type="checkbox"name="IMB_IMV_TERREA"  class="icheck" 
                                                data-checkbox="icheckbox_flat-blue" value="N">
                                                Térrea
                                            </label>
                                            <label class="form-check-label">
                                                <input type="checkbox" name="IMB_IMV_SOBRADO"  class="icheck" 
                                                data-checkbox="icheckbox_flat-blue" value="N">
                                                Sobrado
                                            </label>
                                            <label class="form-check-label">
                                                <input type="checkbox" name="IMB_IMV_ASSOBRADADA"  
                                                class="icheck" data-checkbox="icheckbox_flat-blue" value="N">
                                                Assobradada
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="icheck-list checkbox">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="IMB_IMV_PLACA"  
                                                value="N" class="icheck" data-checkbox="icheckbox_flat-blue">
                                                Tem Placa
                                            </label>
                                            <label class="form-check-label">
                                                <input type="checkbox" name="IMB_IMV_ACEITAFINANC"  
                                                value="N" class="icheck" data-checkbox="icheckbox_flat-blue">
                                                Aceita Financ.
                                            </label>
                                            <label class="form-check-label">
                                                <input type="checkbox" name="IMB_IMV_PERMUTA"  value="N"
                                                class="icheck" data-checkbox="icheckbox_flat-blue">
                                                Aceita Permuta
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="icheck-list checkbox">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="IMB_IMV_ESCRIT"  value="N" 
                                                class="icheck" data-checkbox="icheckbox_flat-blue">
                                                Tem Escritura
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 ">
                                    <div class="form-group">
                                        <label>Código</label>
                                        <input type="text" name="IMB_IMV_ID" class="form-control input-sm" >
                                    </div>
                                </div>

                                <div class="col-md-2 ">
                                    <div class="form-group">
                                        <label>Referência</label>
                                        <input type="text" name="IMB_IMV_REFERE"class="form-control input-sm" value="">
                                    </div>
                                </div>
                                <div class="col-md-2 ">  <!--deixando um espaço -->
                                </div>

                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label>R$ Venda</label>
                                        <input type="currency" text-align: right name="IMB_IMV_VALVEN" 
                                        class="form-control" id="valorvenda" type="text" value='0'>
                                    </div>
                                </div>

                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label>R$ Locação</label>
                                        <input type="text" id="valorlocacao" class="form-control" 
                                        name="IMB_IMV_VALLOC" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <input  type="hidden" name="IMB_CLT_ID" id="IMB_CLT_ID" VALUE='0' >
                                <div class="col-md-8">
                                    <label for="nomeprop">Proprietário</label>
                                        <div class="input-icon">
                                            <i class="fa fa-user fa-fw"></i>
                                            <input type="text"  id="nomeprop" class="form-control" readonly >
                                        </div>
                                </div>
                                <div class="col-md-2">
                                    <span class="input-group-btn">
                                        <span></span>
                                        <button type="button" class="btn btn-lg btn-success" onClick="alterarProp()">
                                        <!-- data-toggle="modal"   data-target="#propModal" >-->
                                            <i class="fa fa-edit fa-fw"></i>Alterar Proprietário
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Endereço / Localização</h3>
                                    <hr />
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Tipo</label>
                                        <input type="text" id="tipologradouro" 
                                            name="IMB_IMV_ENDERECOTIPO" class="form-control input-sm" 
                                            value=""
                                            placeholder="Rua,Avenida,Praça..." id="IMB_IMV_ENDERECOTIPO" required>
                                    </div>
                                </div>
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label for="ilogradouro" >Logradouro</label>
                                        <input type="text" id="rua" name="IMB_IMV_ENDERECO" 
                                        value=""
                                        class="form-control  mr-sm-0 input-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Número</label>
                                        <input type="text" name="IMB_IMV_ENDERECONUMERO"  
                                        value=""
                                        class="form-control input-sm">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Apt.</label>
                                        <input type="text" name="IMB_IMV_NUMAPT" 
                                        value=""
                                        class="form-control input-sm">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Complemento</label>
                                        <input type="text" name="IMB_IMV_ENDERECOCOMPLEMENTO"
                                        value=""
                                        class="form-control input-sm" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Condomínio</label>
                                        <select class="form-control" name="IMB_CND_ID">
                                            <option value="0">Sem condominio</option>
                                            @foreach ($condominio as $cond)
                                                <option value="{{ $cond->IMB_CND_ID }}" >{{ $cond->IMB_CND_NOME }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Nome Prédio</label>
                                        <input type="text" name="IMB_IMV_PREDIO" 
                                        value=""
                                        class="form-control input-sm" >
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Andar</label>
                                        <input type="text" name="IMB_IMV_ANDAR" value="0"
                                        class="form-control input-sm" >
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Bairro</label>
                                        <input type="text" name="CEP_BAI_NOME" 
                                        class="form-control input-sm" id="bairro" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-grupo">
                                    <div class="col-md-2">
                                        <label>Cep</label>
                                        <div class="input-group">
                                            <input type="text" name="IMB_IMV_ENDERECOCEP" 
                                            value=""
                                            class="form-control input-sm" id="cep">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Cidade</label>
                                        <input type="text" name="IMB_IMV_CIDADE" required
                                        value=""
                                        class="form-control input-sm" 
                                        id="cidade" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>UF</label>
                                        <input type="text" name="IMB_IMV_ESTADO" value=""
                                        class="form-control input-sm" id="uf"  >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Quadra</label>
                                        <input type="text" name="IMB_IMV_QUADRA" 
                                        value=""
                                        class="form-control input-sm" >
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Lote</label>
                                        <input type="text" name="IMB_IMV_LOTE" 
                                        value=""
                                        class="form-control input-sm" >
                                    </div>
                                </div>
                            </div>

                            <!-- Botões -->
                            <div class="form-actions right">
                                <button type="cancel" class="btn default " id="i-btn-cancelar">Cancelar</button>
                                <button type="button" class="btn blue " id="i-btn-gravar-2" onClick="submitForm()">
                                <i class="fa fa-check"></i> Gravar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_1_1_2">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Imediações</label>
                                    <input type="text" name="IMB_IMV_PROXIMIDADE" 
                                    value=""
                                    class="form-control input-sm" >
                                </div>
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Medida Terreno</label>
                                    <input type="text" name="IMB_IMV_MEDTER"  
                                    value=""
                                    class="form-control"  placeholder="ex.: 10x20">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Área Total(m2)</label>
                                    <input type="text" name="IMB_IMV_ARETOT"  
                                    value="0"
                                    class="form-control"  id="areatotal">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Área Construída(m2)</label>
                                    <input type="text" name="IMB_IMV_ARECON"   
                                    value="0"
                                    class="form-control"  id="areacontruida">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Área Útil(apto)(m2)</label>
                                    <input type="text" name="IMB_IMV_AREUTI"  
                                    value="0"
                                    class="form-control"  id="areautil">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Dorm.</label>
                                    <input type="number" name="IMB_IMV_DORQUA"  
                                    value="0"
                                    class="form-control input-sm" >
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">suites</label>
                                    <input type="number" name="IMB_IMV_SUIQUA"   
                                    value="0"
                                    class="form-control input-sm"  >
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" name="IMB_IMV_DORAE" 
                                    value="N">

                                   <label class="form-check-label">AE</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" name="IMB_IMV_SUIHID" 
                                    value="N">
                                    <label class="form-check-label">Hidro </label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"  name="IMB_IMV_DORCLO" 
                                    value="N">
                                    <label class="form-check-label">Closet</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Salas</label>
                                    <input type="number" name="IMB_IMV_SALQUA"  
                                    value="0"
                                    class="form-control input-sm" >
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" name="IMB_IMV_COZINHA" 
                                    value="N"
                                    >
                                    <label class="form-check-label">Cozinha</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" name="IMB_IMV_COZPLA"  
                                    value="N"
                                    >
                                    <label class="form-check-label">Planejada</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" name="IMB_IMV_LAVABO"  
                                    value="N"
                                    >
                                    <label class="form-check-label">Lavabo</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"  name="IMB_IMV_EMPQUA"  
                                    value="N"
                                    >
                                    <label class="form-check-label">Dorm. Empr.</label>
                                </div>
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"  name="IMB_IMV_EMPWC"  
                                    value="N"
                                    >
                                    <label class="form-check-label">WC Empreg.</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"  name="IMB_IMV_DESPENSA"  
                                    value="N"
                                    >
                                    <label class="form-check-label">Despensa</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-1">
                            </div>

                            <div class="col-md-2">
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"  name="IMB_IMV_PISCIN" 
                                    value="N"
                                    >
                                    <label class="form-check-label">Piscina</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"   name="IMB_IMV_EDICUL" 
                                    value="N"
                                    >
                                    <label class="form-check-label">Edícula</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"   name="IMB_IMV_QUINTA"  
                                    value="N"
                                    >
                                    <label class="form-check-label">Quintal</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"   name="IMB_IMV_CHURRA"  
                                    value="N"
                                    >
                                    <label class="form-check-label">Churrasqueira</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"   name="IMB_IMV_PORELE"  
                                    value="N"
                                    >
                                    <label class="form-check-label">Portão Eletr.</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"   name="IMB_IMV_SAUNA"  
                                    value="N"
                                    >
                                    <label class="form-check-label">Sauna</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="checkbox icheck-primary">
                                    <input type="checkbox"   name="IMB_IMV_QUADRAPOLIESPORTIVA" 
                                    value="N"
                                    >
                                    <label class="form-check-label">Quadra</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" name="IMB_IMV_SALFES"  
                                    value="N"
                                    >
                                    <label class="form-check-label">Salão Festas</label>
                                </div>

                                <div class="checkbox icheck-primary">
                                    <input type="checkbox" name="IMB_IMV_PLAGRO"  
                                    value="N"
                                    >
                                    <label class="form-check-label">Playground</label>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Vagas Cobertas</label>

                                    <input type="number" name="IMB_IMV_GARCOB"   
                                    value="0"
                                    class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Vagas Descob.</label>
                                    <input type="number" name="IMB_IMV_GARDES"  
                                    value="0"
                                    class="form-control"  >
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label"><br>Idade Imóvel</label>
                                    <input type="text" name="IMB_IMV_IDADE" 
                                    value=""
                                    class="form-control"  >
                                </div>
                            </div>
                        </div>

                        <div class="form-actions right">
                            <button type="cancel" class="btn default " id="i-btn-cancelar-2">Cancelar</button>
                            <button type="button" class="btn blue " id="i-btn-gravar-2" onClick="submitForm()">
                                <i class="fa fa-check"></i> Gravar
                            </button>
                        </div>

                    </div>
                    <div class="tab-pane" id="tab_1_1_3">
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Obsevações do Imóvel(Uso interno)
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                </div>
                            </div>

                            <div class="portlet-body form">
                                <div class="form-body" ></div>
                                <div class="form-actions text-center">
                                    <textarea rows="10" name="IMB_IMV_OBSERV" style="min-width: 100%">.</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Obsevações na Internet(no site)
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                </div>
                            </div>

                            <div class="portlet-body form">
                                <div class="form-body" ></div>
                                <div class="form-actions text-center">
                                    <textarea rows="10" name="IMB_IMV_OBSWEB" style="min-width: 100%">.</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions right">
                            <button type="cancel" class="btn default" id="i-btn-cancelar-2">Cancelar</button>
                            <button type="submit" class="btn blue " id="i-btn-gravar-2">
                                <i class="fa fa-check"></i> Gravar
                            </button>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_1_1_4">
                    </div>
                </div>
            </div>
        </form>
    </div>
<div>

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
                            <label class="control-label">Digite abaixo a sugestão de nome</label>
                                <input type="text" id="i-str"  class="form-control">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label"></label>
                                <button class="btn btn-primary" onClick="buscaIncremental()">Carregar Sugestões</button>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group"  id="divprop">
                                <label class="control-label">Escolha o proprietário</label>
                                <select class="form-control" id="selclientelike">
                                </select>
                            </div>
                        </div>
                    </div>
    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onClick="selecionarCliente()">Selecionar</button>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('script')

    <script type="text/javascript">
        $("#frmCadastro :input").prop("enabled", true);
    </script>
    
    <script src="{{asset('/global/plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script>


    <script>
        function submitForm()
        {
            var cMensagem = '';

            if ( 
                    ( $("#valorvenda").val()  =='0') && 
                    ( $("#valorlocacao").val()=="0")  
                )
                cMensagem = cMensagem + '-> Venda e/ou locação.\n';
            if ($("#nomeprop").val() == '' )
            cMensagem = cMensagem + '-> Proprietário do Imóvel.\n';

            if ($("#bairro").val() == '' )
                cMensagem = cMensagem + '-> Bairro.\n';

            if ($("#cidade").val() == '' )
                cMensagem = cMensagem + '-> Cidade.\n';

            if ($("#tipologradouro").val() == '' )
                cMensagem = cMensagem + '-> Tipo Logradouro.\n';

            if ($("#rua").val() == '' )
                cMensagem = cMensagem + '-> Logradouro(endereço).\n';

            if ($("#uf").val() == '' )
                cMensagem = cMensagem + '-> Estado.\n';

                if (cMensagem.length > 0) 
                swal(
                    {title: "Faltando Informar",
                     text: cMensagem
                    } )
            else
                document.getElementById("frmCadastro").submit();
        }
        
        $('#modalProp').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Botão que acionou o modal
    
            // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
            // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
            var modal = $(this)
          })
     
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
            $("#divprop").show();  
            buscaIncremental();

        }
        function buscaIncremental()
        {
            str = $("#i-str").val();
            var url = "{{ route('buscaclienteincremental') }}"+"/"+str;
            
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
                console.log( linha );

            });
            
        }

        $("#divprop").hide();


        $('#cep').on('blur', () => 
        {
            if ($.trim($('#cep').val()) !== '') 
            {
                //console.log('passando');
                $('#mensagem').html('(Aguarde, consultando CEP ...)');

                // NOVO CODIGO =============================================

                // Guardar o CEP do input.
                const cep = $('#cep').val();

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
                    console.log('API retornou: ');
                    console.log(resultadoCEP);

                    if (resultadoCEP.resultado) 
                    {
                        // /$('#rua').val(`${resultadoCEP['tipo_logradouro']} ${resultadoCEP['logradouro']}`);
                        $('#tipologradouro').val(resultadoCEP.tipo_logradouro);
                        $('#rua').val(resultadoCEP.logradouro);
                        $('#bairro').val(resultadoCEP.bairro);
                        $('#cidade').val(resultadoCEP.cidade);
                        $('#uf').val(resultadoCEP.uf);
                    } 
                    else 
                    {
                    console.error('Erro ao carregar os dados do CEP.');
                    }
                });        
            }
        });

     
    </script>

    
@endpush