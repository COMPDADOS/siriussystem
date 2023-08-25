@extends('layout.app')

@push('script')

@section('scripttop')
<style>
.H5 {
    text-align: center;
    color: #4682B4 ;

    font-size: 20px;
    font-weight: bold;

}
.H2 {
    text-align: center;
    color: #4682B4 ;
    font-size: 14px;
    font-weight: bold;

}
.span-class {
    text-align: center;
    color: red ;
    font-size: 10px;
    font-weight: bold;

}

.span-check-class {
    color       : blue ;
    font-size   : 12px;
    font-weight : bold;
    font-family: Verdana;
}

.span-multa-class {
    color       : blue ;
    font-size   : 10px;
    font-weight : bold;
    font-family: Verdana;
}

.span-aba-title
{
  font-weight: bold;
}

.escondido
{
  display:none;
}


</style>
@endsection

@section('content')



<!-- BEGIN CONTENT -->
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <a href="{{route('home')}}">Home</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <a href="{{route('imovel.index')}}">Lista de Imovel</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <a href="#">Novo contrato de Locação</a>
    </li>
  </ul>

</div>
<div class="row">
  <div class="col-md-12 H5" id="i-endereco">
  </div>
</div>

<div class="row escondido" id="div-contrato">
  <input type="hidden" id="i-idimovelcontrato" value="{{ $idimovel }}">
  <input type="hidden" id="i-condominio">
  <input type="hidden" id="IMB_CLT_ID">
  <div id="tabs">
    <ul>
      <li><a href="#tab-imovel" id="h-imovel"><span>Imóvel</span></a></li>
      <li><a href="#tab-locador" id="h-locador"><span>Locador</span></a></li>
      <li><a href="#tab-locatario" id="h-locatario"><span>Locatário</span></a></li>
      <li><a href="#tab-fiador" id="h-fiador"><span>Fiador</span></a></li>
      <li><a href="#tab-datas" id="h-datas"><span>Datas/Encargos</span></a></li>
      <li><a href="#tab-taxas" id="h-multa"><span>Descontos/Taxas</span></a></li>
      <li><a href="#tab-iptu" id="h-iptu"><span>IPTU/Seguro</span></a></li>
      <li><a href="#tab-corretores" id="h-corretores"><span>Corretores/Captadores</span></a></li>
      <li><a href="#tab-impostos" id="h-impostos"><span>Impostos</span></a></li>
      <li><a href="#tab-outras" id="h-iptu"><span>Outras Informações</span></a></li>
    </ul>
    <div id="tab-imovel">
      <div class="row">
          <div class="col-md-2">
            <label class="label-control">Código</label>
            <input class="form-control" type="text" id="IMB_IMV_ID" readonly>
          </div>
          <div class="col-md-2">
            <label class="label-control">Refer.</label>
            <input class="form-control" type="text" id="IMB_IMV_REFERE" readonly>
          </div>
          <div class="col-md-4">
            <label class="label-control">Endereço</label>
            <input class="form-control" type="text" id="IMB_IMV_ENDERECO" readonly>
          </div>
          <div class="col-md-2">
            <label class="label-control">Nº Apto.</label>
            <input class="form-control" type="text" id="IMB_IMV_ENDERECONUMERO" readonly>
          </div>
          <div class="col-md-2">
            <label class="label-control">Complemento</label>
            <input class="form-control" type="text" id="IMB_IMV_ENDERECOCOMPLEMENTO" readonly>
          </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label class="label-control">Cep</label>
          <input class="form-control" type="text" id="IMB_IMV_ENDERECOCEP" readonly>
        </div>
        <div class="col-md-3">
          <label class="label-control">Bairro</label>
          <input class="form-control" type="text" id="CEP_BAI_NOME" readonly>
        </div>
        <div class="col-md-3">
          <label class="label-control">Condomínio</label>
          <input class="form-control" type="text" id="IMB_CND_NOME" readonly>
        </div>
        <div class="col-md-3">
          <label class="label-control">Cidade</label>
          <input class="form-control" type="text" id="IMB_IMV_CIDADE" readonly>
        </div>
        <div class="col-md-1">
          <label class="label-control">UF</label>
          <input class="form-control" type="text" id="IMB_IMV_ESTADO" readonly>
        </div>
      </div>
      <div class="row">
        <hr>
      </div>
      <div class="row">
        <div class="col-md-4">
          <label class="label-form">Tipo de Contrato</label>
          <select class="form-control" id="IMB_CTR_FINALIDADE">
            <option value="-1">Selecione</option>
            <option value="Residencial">Residencial</option>
              <option value="Comercial">Comercial</option>
          </select>
        </div>

        <div class="col-md-4">
          <label class="label-form">Forma de Fiança</label>
          <select class="form-control" id="IMB_CTR_EXIGENCIA" >
            <option value="-1">Selecione</option>
            <option value="F">Fiador</option>
            <option value="C">Caução</option>
            <option value="S">Seguro Fiança</option>
            <option value="V">Cartão de Crédito</option>
            <option value="P">Titulo Capitalização</option>
            <option value="O">Outra Forma</option>
            <option value="D">Dispensado</option>
          </select>
        </div>

      </div>
      <div class="row">
        <hr>
      </div>
      <div class="row">
      <div class="col-md-4">
          <label class="label-control">Alugado com Pintura Nova
          <input type="checkbox" class="form-control" id="IMB_CTR_PINTURANOVA">
          </label>
        </div>
        <div class="col-md-6">
          <label class="label-control">Liberado Multa Contratual (12 meses )
            <input type="checkbox" class="form-control" id="IMB_CTR_CLAUSULA12MESES">
          </label>
        </div>
        <div class="col-md-2 escondido">
          <label class="label-control">Com FCI
            <input type="checkbox" class="form-control" id="IMB_CTR_FCI">
          </label>
        </div>
      </div>

    </div>    
    <div id="tab-locador">
      <div class="row">
        <div class="portlet box blue-hoki">
          <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Locador(es)
            </div>

            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
            </div>
          </div>

          <div class="portlet-body form">
            <div class="form-body">
              <table  id="tbpropimo" class="table table-striped table-bordered table-hover" >
                <thead class="thead-dark">
                  <tr>
                    <th width="70%"  style="text-align:center"> Proprietario </th>
                    <th width="20%" style="text-align:center"> Percentual </th>
                    <th width="10%" style="text-align:center"> Principal </th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
              <span class="H2">Permitido alteração do proprietário do imóvel somente na tela de alteração do imóvel</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="tab-locatario">
      <div class="row">
        <div class="portlet box blue-hoki">
          <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Locatários
            </div>

            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
            </div>
          </div>

          <div class="portlet-body form">
            <div class="form-body">
              <table  id="tbllocatarios" class="table table-striped table-bordered table-hover" >
                <thead class="thead-dark">
                  <tr >
                    <th width="5%" style="text-align:center"> ID </th>
                    <th width="50%" style="text-align:center"> Nome </th>
                    <th width="10%" style="text-align:center"> Principal </th>
                    <th width="10%" style="text-align:center"> Ações </th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>

              <div class="table-footer" >
                            <a  class="btn btn-sm btn-warning"
                            role="button" onClick="adicionarLocatarioContrato()" >
                            Adicionar Locatário </a>
                            <span class="span-check-class" >para alterar, apague o locatário e relacione o novo com as informações corretas</span>
              </div>
              <div class="">
              </div>
              <div class="row">
                <hr>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <label class="label-control">Forma de Recebimento</label>
                  <select select class="form-control" id="IMB_FORPAG_ID_LOCATARIO"></select>
                </div>
                <div class="col-md-4">
                  <label class="label-control">Conta da Cobrança Bancária</label>
                  <select class="form-control" id="FIN_CCR_ID_COBRANCA"></select>
                </div>
                <div class="col-md-4 div-center">
                  <label class="label-control div-center">Cobrar Tarifa Boleto</label>
                  <input type="checkbox" class="form-control" id="IMB_CTR_COBRARBOLETO">
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 div-center">
                  <label class="label-control div-center">Boleto via email</label>
                  <input type="checkbox" class="form-control" id="IMB_CTR_BOLETOVIAEMAIL">
                </div>
                <div class="col-md-8">
                  <label class="label-control">Email</label>
                  <input type="email" class="form-control" id="IMB_CTR_EMAIL">
                </div>
              </div>
            </div><!-- end form-body-->
          </div>
        </div>
      </div>

    </div>
    <div id="tab-fiador">
      <div class="row">
        <div class="portlet box blue-hoki">
          <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Fiador(es)
            </div>

            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
            </div>
          </div>

          <div class="portlet-body form">
            <div class="form-body">
              <table  id="tblfiadores" class="table table-striped table-bordered table-hover" >
                <thead class="thead-dark">
                  <tr >
                    <th width="5%" style="text-align:center"> ID </th>
                    <th width="50%" style="text-align:center"> Nome </th>
                    <th width="10%" style="text-align:center"> Ações </th>
                  </tr>
                </thead>
                <tbody>
                </tbody>

              </table>

              <div class="table-footer" >
                            <a  class="btn btn-sm btn-warning"
                            role="button" onClick="adicionarFiadorContrato()" >
                            Adicionar Fiador </a>
                            <span class="span-check-class">para alterar, apague o locatário e relacione o novo com as informações corretas</span>
              </div>
            </div><!-- end form-body-->
          </div> <!--FIM Portlet-body form">-->
        </div>
      </div>
    </div>
    <div id="tab-caucao " class="escondido">
      <div class="row">
        <div class="col-md-5">
          <label class="label-control">Banco</label>
          <select class="form-control" id="GER_BNC_NUMERO">
            <option value=""></option>
          </select>
        </div>
        <div class="col-md-2">
          <label class="label-control">Agência</label>
          <input type="text" class="form-control" id="IMB_CAU_AGENCIA">
        </div>
        <div class="col-md-3">
          <label class="label-control">Nº C.Corrente</label>
          <input type="text" class="form-control" id="IMB_CAU_CONTACORRENTE">
        </div>
        <div class="col-md-2">
          <label class="label-control">Qt.Meses</label>
          <input type="text" class="form-control" id="IMB_CAU_MESES">
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <label class="label-control">Data Depósito</label>
          <input type="date" class="form-control" id="IMB_CAU_DATADEPOSITO">
        </div>
        <div class="col-md-3">
          <label class="label-control">Valor Depósito</label>
          <input type="text" class="form-control valor" id="IMB_CAU_VALOR">
        </div>
        <div class="col-md-4">
          <label class="label-control">Correntista</label>
          <input type="text" class="form-control" id="IMB_CAU_NOMINAL">
        </div>
      </div>
    </div>    
    <div id="tab-datas">
      <div class="row">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Data Locação</label>
                <input type="date" id="IMB_CTR_DATALOCACAO" class="form-control"  >
            </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
              <label>Dia</label>
                <input type="text" id="IMB_CTR_DIAVENCIMENTO"
                  class="form-control"
                  onkeypress="return isNumber(event)" onpaste="return false;">
                <span class="span-class">Vencto</span>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label>Duração</label>
              <input type="text" id="IMB_CTR_DURACAO"
                    class="form-control CALCTERMINO"
                    onkeypress="return isNumber(event)" onpaste="return false;">
                    <span class="span-class">em Meses</span>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label>Início</label>
              <input type="date" id="IMB_CTR_INICIO"
                    class="form-control CALCTERMINO" >
                    <span class="span-class">Data de Início</span>

            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label>Término</label>
              <input type="text" id="IMB_CTR_TERMINO"  readonly
                    class="form-control " >
              <span class="span-class">Data de Término</span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Reajuste</label>
              <select class="form-control" id="IMB_CTR_FORMAREAJUSTE">
                <option value="1">Mensal</option>
                <option value="3">Trimestral</option>
                <option value="6">Semestral</option>
                <option value="12" selected >Anual</option>
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label>Prox.Reajuste</label>
              <input type="text" id="IMB_CTR_DATAREAJUSTE"
                    class="form-control" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Índice de Reajuste</label>
              <select class="form-control" id="IMB_IRJ_ID">
              </select>
              <span class="span-check-class">
              <input type="checkbox"
                  id="IMB_CTR_MAIORINDICE">Utilizar o Maior Índice
                  </span>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="control-label">Valor Aluguel</label>
              <input type="text" id="IMB_CTR_VALORALUGUEL"
                    class="form-control valor">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="portlet box blue-hoki">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>Dados para o Primeiro Pagamento
                </div>
                <div class="tools">
                  <a href="javascript:;" class="collapse"> </a>
                </div>
              </div>
              <div class="portlet-body">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Primeiro Vencto</label>
                      <input type="date" id="IMB_CTR_PRIMEIROVENCIMENTO"
                        class="form-control">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>$ Acerto Dias</label>
                      <input type="text" id="IMB_CTR_DIASVALOR"
                        class="form-control valor" value='0'>
                      <span class="span-check-class" id="span-diferenca"></span>

                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Valor 1º Aluguel</label>
                      <input type="text" id="IMB_CTR_VALORPRIMVEN"
                        class="form-control valor" >
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>$ Condomínio</label>
                      <input type="text" id="IMB_CTR_VALORCOND"
                        class="form-control valor" value='0'>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="portlet box blue-hoki">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>Metodologia para Multa/Juros e Período de Pagamento
                </div>
                <div class="tools">
                  <a href="javascript:;" class="collapse"> </a>
                </div>
              </div>
              <div class="portlet-body">
                <div class="row">
                  <div class="col-md-1">
                    <div class="form-group">
                      <label class="control-label span-multa-class">Tolerância</label>
                      <input type="text" id="IMB_CTR_TOLERANCIA"
                        class="form-control"
                        onkeypress="return isNumber(event)" onpaste="return false;"
                        value='0'>
                        <span class="span-multa-class">Em dias</span>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label span-multa-class">Multa</label>
                      <input type="text" id="IMB_CTR_MULTA"
                        class="form-control valor"  placeholder='%' value='0'>
                        <span class="span-multa-class"></span>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label span-multa-class">% Juros</label>
                      <input type="text" id="IMB_CTR_JUROSDIARIO"
                        class="form-control valor" placeholder='%' value='0'>
                      <span class="span-multa-class">Diário</span>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label span-multa-class">% Correção</label>
                      <input type="text" id="IMB_CTR_PERMANDIARIA"
                        class="form-control valor"  placeholder='%' value='0'>
                        <span class="span-multa-class">Diário</span>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label span-multa-class">Protestar</label>
                      <input type="text" id="`IMB_CTR_DIASPROTESTO"
                        class="form-control"
                        onkeypress="return isNumber(event)" onpaste="return false;" value='0'>
                        <span class="span-multa-class"> Após Dias</span>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label span-multa-class">Método do Período</label>
                      <select   class="form-control" id="IMB_CTR_TOLERANCIAFATOR">
                        <option value="1">Normal</option>
                        <option value="3">Mês Fechado</option>
                        <option value="4">Antecipado</option>
                        <option value="5">Texto: "Aluguel do Mês"</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="tab-taxas">
      <div class="row">
        <div class="row">
          <div class="col-md-12">
            <div class="class-md-6">
              <div class="portlet box blue-hoki">
                <div class="portlet-title">
                  <div class="caption">
                    <i class="fa fa-gift"></i>Descontos Para os Primeiros Meses / Pontualidade
                  </div>
                  <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                  </div>
                </div>
                <div class="portlet-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="col-md-6">
                        <label class="label-control">Primeiros Meses</label>
                        <input type="text" class="form-control" id="IMB_CTR_DESCONTOMESES"
                          onkeypress="return isNumber(event)" onpaste="return false;"
                          placeholder="Qtde de Meses" value='0'>
                        <span>
                          <input type="text" class="form-control valor" id="IMB_CTR_DESCONTO"
                            placeholder="Valor do Desconto" value='0'>
                        </span>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                            <span class="span-check-class">
                              <input type="checkbox"
                                id="IMB_CTR_PERDEBONAPOSVEN">Perder desconto pontual. após vencto. sem a tolerância
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="row">
                        <div class="col-md-6">
                          <label class="label-control">R$ ou % Até o Vencimento</label>
                          <input type="text" class="form-control valor"
                          id="IMB_CTR_VALORBONIFICACAO4" placeholder="Pontual. R$ ou %" value='0'>
                          <span class="span-multa-class" >
                            <select class="form-control" id="IMB_CTR_BONIFICACAOTIPO">
                              <option value="P">Em Percentual</option>
                              <option value="V">Em Valor</option>
                            </select>
                          </span>
                        </div>

                        <div class="col-md-6">
                          <label class="label-control">Validade</label>
                          <input type="date" class="form-control" id="IMB_CTR_PONTUALIDADEVALIDADE">
                          <span class="span-class">Nunca deixe em branco</span>
                        </div>
                      </div>
                      <div class="row">
                        <span class="span-check-class">
                          <input type="checkbox"
                            id="IMB_CTR_BONIF_NAOINC_TA">Não incluir desconto pontual. no cálculo da taxa admin.
                        </span>
                      </div>
                    </div>
                  </div>
                </div> <!--PORTLET BODY FIM -->
              </div> <!-- PORTLET BLUE-->
            </div> <!-- COL-MD-6 -->
          </div> <!--COL-MD-12-->
        </div> <!--RPW-->
      </div> <!-- row -->

      <div class="row">
        <div class="row">
          <div class="col-md-12">
            <div class="class-md-6">
              <div class="portlet box blue-hoki">
                <div class="portlet-title">
                </div>
                <div class="portlet-body">
                  <div class="row">
                    <div class="col-md-2">
                      <label class="label-control">Taxa Adm.</label>
                      <input type="text" class="form-control valor"
                        id="IMB_CTR_TAXAADMINISTRATIVA"
                        placeholder="R$ ou %" value='0'>
                      <span>
                        <select class="form-control" id="IMB_CTR_TAXAADMINISTRATIVAFORMA">
                        <option value="P">Em %</option>
                        <option value="R">Valor Fixo</option>
                        </select>
                      </span>
                    </div>
                    <div class="col-md-2">
                      <label class="label-control">Repassar</label>
                      <input type="text" class="form-control"
                        id="IMB_CTR_REPASSEDIA" value='0'>
                      <span class="span-check-class">
                          Após dias
                      </span>
                    </div>
                    <div class="col-md-2">
                      <label class="label-control">Garantido
                        <input type="checkbox" class="form-control"
                          id="IMB_CTR_ALUGUELGARANTIDO" >
                      </label>
                    </div>
                    <div class="col-md-3">
                        
                         <label class="label-control">Valor Taxa Contrato
                          <input type="text" class="form-control valor"
                            id="IMB_CTR_CONTRATOVALOR" value='0'>
                           
                          </label>
                           <span class="input-group-text">
                              <button title="Informe o percentual e click neste botão para calcular o valor da taxa e contrato com base no percentual informado" onClick="calcularTaxaContrato()"><b>!</b></button>
                            </span>
                    </div>

                    <div class="col-md-2">
                      <label class="label-control">Parcelas
                      <input type="text" class="form-control"
                        id="IMB_CTR_CONTRATOPARCELAS"
                        onkeypress="return isNumber(event)" onpaste="return false;" value='0'>
                      </label>
                    </div>
                  </div> <!--row -->
                </div> <!--portlet body-->
              </div> <!-- portlet-->
              <div class="portlet box blue-hoki">
                <div class="portlet-title">
                  <div class="caption">
                    <i class="fa fa-gift"></i>Taxa de Contrato
                  </div>
                  <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                  </div>
                </div>

                <div class="portlet-body">
                  @php
                    $param2 = app('App\Http\Controllers\ctrRotinas')->parametros2( Auth::user()->IMB_IMB_ID);

                  @endphp
                  <div class="row">
                    <div class="col-md-3">
                      <label class="label-control">Vencimento 1ª Parcela</label>
                      <input type="date" class="form-control" id="IMB_CTR_CONTRATOVENPAR1" >
                      <span>
                        <input type="text" class="form-control valor" id="IMB_CTR_CONTRATOVALPAR1"
                          placeholder="Valor em R$" value='0'>
                      </span>
                      <p>
                       <span class="span-check-class">
                          <input type="checkbox"
                          id="IMB_CTR_COBTAXAADM1" @if( $param2->IMB_PRM_TCPAR1COBRARTA=='S') Checked @endif>Cobrar Taxa Adm. no Mês
                        </span>
                      </p>
                      <p>
                       <span class="span-check-class">
                          <input type="checkbox"
                          id="IMB_CTR_INCTAXAADM1" @if( $param2->IMB_PRM_TCPAR1INCTA=='S') Checked @endif>Incidir no Cálculo da Taxa Admin.
                        </span> 
                      </p>                      
                    </div>
                    <div class="col-md-3">
                      <label class="label-control">Vencimento 2ª Parcela</label>
                      <input type="date" class="form-control" id="IMB_CTR_CONTRATOVENPAR2">
                      <span>
                        <input type="text" class="form-control valor" id="IMB_CTR_CONTRATOVALPAR2"
                        placeholder="Valor em R$" value='0'>
                      </span>
                      <p>
                       <span class="span-check-class">
                          <input type="checkbox"
                          id="IMB_CTR_COBTAXAADM2" @if( $param2->IMB_PRM_TCPAR2COBRARTA=='S') Checked @endif>Cobrar Taxa Adm. no Mês
                        </span>
                      </p>
                      <p>
                       <span class="span-check-class">
                          <input type="checkbox"
                          id="IMB_CTR_INCTAXAADM2" @if( $param2->IMB_PRM_TCPAR2INCTA=='S') Checked @endif>Incidir no Cálculo da Taxa Admin.
                        </span> 
                      </p>                      
                    </div>
                    <div class="col-md-3">
                      <label class="label-control">Vencimento 3ª Parcela</label>
                      <input type="date" class="form-control" id="IMB_CTR_CONTRATOVENPAR3">
                      <span>
                        <input type="text" class="form-control valor" id="IMB_CTR_CONTRATOVALPAR3"
                        placeholder="Valor em R$" value='0'>
                      </span>
                      <p>
                       <span class="span-check-class">
                          <input type="checkbox"
                          id="IMB_CTR_COBTAXAADM3" @if( $param2->IMB_PRM_TCPAR3COBRARTA=='S') Checked @endif>Cobrar Taxa Adm. no Mês
                        </span>
                      </p>
                      <p>
                       <span class="span-check-class">
                          <input type="checkbox"
                          id="IMB_CTR_INCTAXAADM3" @if( $param2->IMB_PRM_TCPAR3INCTA=='S') Checked @endif>Incidir no Cálculo da Taxa Admin.
                        </span> 
                      </p>                      
                    </div>
                    <div class="col-md-3">
                      <label class="label-control">Vencimento 4ª Parcela</label>
                      <input type="date" class="form-control" id="IMB_CTR_CONTRATOVENPAR4">
                      <span>
                        <input type="text" class="form-control valor" id="IMB_CTR_CONTRATOVALPAR4"
                          placeholder="Valor em R$" value='0'>
                      </span>
                      <p>
                       <span class="span-check-class">
                          <input type="checkbox"
                          id="IMB_CTR_COBTAXAADM4" @if( $param2->IMB_PRM_TCPAR4COBRARTA=='S') Checked @endif>Cobrar Taxa Adm. no Mês
                        </span>
                      </p>
                      <p>
                       <span class="span-check-class">
                          <input type="checkbox"
                          id="IMB_CTR_INCTAXAADM4" @if( $param2->IMB_PRM_TCPAR4INCTA=='S') Checked @endif>Incidir no Cálculo da Taxa Admin.
                        </span> 
                      </p>                      
                    </div>
                  </div> <!-- row -->
                </div> <!--portle body-->
              </div><!--portle-->
            </div> <!--col-md-6-->
          </div> <!--col-md-12-->
        </div> <!--row -->
      </div> <!--row-->
    </div>
    <div id="tab-iptu">
      <div class="row">
        <div class="row">
          <div class="col-md-12">
              <div class="portlet box blue-hoki">
                <div class="portlet-title">
                  <div class="caption">
                    <i class="fa fa-gift"></i>IPTU
                  </div>
                  <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                  </div>
                </div>
                <div class="portlet-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-3">
                        <label class="label-control">Valor do IPTU</label>
                        <input type="text" class="form-control valor" id="IMB_CTR_IPTUVALOR" value='0'>
                        <span class="span-check-class">
                            <input type="checkbox"
                              id="IMB_CTR_IPTUINCLUSO">Já Incluso no Aluguel
                        </span>
                      </div>
                      <div class="col-md-2">
                        <label class="label-control">Qt.Parcelas</label>
                        <input type="number" class="form-control" id="IMB_CTR_IPTUQTDEPARCLAS"
                        min="0" max="99" value='0'>
                      </div>

                      <div class="col-md-3">
                        <label class="label-control">Locador</label>
                        <select  class="form-control" id="IMB_CTR_IPTULOCADOR">
                          <option value="C">Crédito</option>
                          <option value="D">Débito</option>
                          <option value="N">Nada</option>
                        </select>
                        <span class="span-check-class">
                          Crédito/Débito/Nada
                        </span>
                      </div>
                      <div class="col-md-3">
                        <label class="label-control">Locatário</label>
                        <select  class="form-control"  id="IMB_CTR_IPTULOCATARIO">
                          <option value="C">Crédito</option>
                          <option value="D">Débito</option>
                          <option value="N">Nada</option>
                        </select>
                        <span class="span-check-class">
                          Crédito/Débito/Nada
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
              <div class="portlet box blue-hoki">
                <div class="portlet-title">
                  <div class="caption">
                    <i class="fa fa-gift"></i>Seguro
                  </div>
                  <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                  </div>
                </div>
                <div class="portlet-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-3">
                        <label class="label-control">Valor do Seguro</label>
                        <input type="text" class="form-control valor" id="IMB_CTR_SEGUROVALOR" value='0'>
                      </div>

                      <div class="col-md-2">
                        <label class="label-control">Qt.Parcelas</label>
                        <input type="number" class="form-control" id="imb_ctr_seguroparcelas"
                        min="0" max="99" value='0'>
                      </div>

                      <div class="col-md-3">
                        <label class="label-control">$ Parcela</label>
                        <input type="text" class="form-control valor" id="IMB_CTR_SEGUROVALORPARCELA"
                        min="0" max="99" value='0'>
                      </div>

                      <div class="col-md-4">
                        <label class="label-control">Seguradora</label>
                        <select  class="form-control"  id="IMB_SGR_ID">
                          <option value="0" selected>Selecione</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

          </div>
        </div>
      </div>
    </div>
    <div id="tab-corretores">
          <div class="row">
              <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                      <div class="caption">
                          <i class="fa fa-gift"></i>Corretor
                      </div>
                      <div class="tools">
                          <a href="javascript:;" class="collapse"> </a>
                      </div>
                  </div>

                  <div class="portlet-body form">
                      <table  id="tbcorctr" class="table table-striped table-bordered table-hover" >
                          <thead class="thead-dark">
                              <tr>
                                  <th style="text-align:center"> ID </th>
                                  <th style="text-align:center"> Corretor </th>
                                  <th width="100" style="text-align:center"> Percentual </th>
                                  <th width="200" style="text-align:center"> Ações </th>
                              </tr>
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                      <div class="row">
                          <div class="col-md-12">
                              <a  class="btn btn-sm btn-success"
                                role="button" onClick="adicionarCorCtr()" >
                                Adicionar Corretor
                              </a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                      <div class="caption">
                          <i class="fa fa-gift"></i>Captador
                      </div>
                      <div class="tools">
                          <a href="javascript:;" class="collapse"> </a>
                      </div>
                  </div>

                  <div class="portlet-body form">
                      <table  id="tbcapimo-contrato" class="table table-striped table-bordered table-hover" >
                          <thead class="thead-dark">
                              <tr>
                                  <th style="text-align:center"> ID </th>
                                  <th style="text-align:center"> Captador </th>
                                  <th width="100" style="text-align:center"> Percentual </th>
                                  <th width="200" style="text-align:center"> Ações </th>
                              </tr>
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                      <div class="row">
                          <div class="col-md-12">
                              <a  class="btn btn-sm btn-success"
                              role="button" onClick="adicionarCapCtr()" >
                                  Adicionar Captador
                              </a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
    </div>
    <div id="tab-impostos">
      <div class="row">
        <div class="col-md-12">
            <div class="col-md-3">
              <label for="IMB_IMV_RELIRRF">Incluir na Dimob Anual
                <input class="form-control" type="checkbox" id="IMB_IMV_RELIRRF">
              </label>
            </div>
            <div class="col-md-4">
              <label for="IMB_CTR_IRRF">Calcular IRRF no Recto/Repasse(Tab Padrão)
                <input class="form-control" type="checkbox" id="IMB_CTR_IRRF">
              </label>
            </div>
            <div class="col-md-2">
              <label for="imb_ctr_naoemitirnfe">Não Emitir NFSe
                <input class="form-control" type="checkbox" id="imb_ctr_naoemitirnfe">
              </label>
            </div>
            <div class="col-md-3">
              <label for="IMB_CTR_CALISS">Calcular ISS Repasse
                <input class="form-control" type="checkbox" id="IMB_CTR_CALISS">
              </label>
            </div>
        </div>
      </div>
    </div>


    <div id="tab-outras">
      <div class="row">
        <div class="col-md-12">
          <label class="label-control">Mensagem Locador(informes) até 200 caracteres</label>
          <input class="form-control" type="text" id="IMB_CTR_OBSERVACAOLOCADOR" maxlength="200" >
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <label class="label-control">Mensagem Locatário até 200 caracteres</label>
          <input class="form-control" type="text" id="IMB_CTR_OBSERVACAOLOCATARIO" maxlength="200" >
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <label class="label-control">Mensagem Imóvel/contrato até 200 caracteres</label>
          <input class="form-control" type="text" id="IMB_CTR_OBSERVACAO" maxlength="200" >
        </div>
      </div>

      <div class="row">
          <div class="col-md-2">
            <label class="label-control">Valor a Agregar</label>
            <input class="form-control valor" type="text" id="IMB_IMV_ALUGUELAGREGAR" maxlength="200">
          </div>
          <div class="col-md-2">
            <label class="label-control">Locador</label>
            <select class="form-control" id="IMB_IMV_AGREGADOLDCREDEB">
              <option value="N">Nada</option>
              <option value="C">Crédito</option>
              <option value="D">Débito</option>
            </select>
          </div>
          <div class="col-md-2">
            <label class="label-control">Locatário</label>
            <select class="form-control" id="IMB_IMV_AGREGADOLTCREDEB">
              <option value="N">Nada</option>
              <option value="C">Crédito</option>
              <option value="D">Débito</option>
            </select>
          </div>
      </div>
    </div>
  </div> <!--<div class="col-md-12">-->
</div> <!-- fim row unica -->

          <!-- BEGIN QUICK SIDEBAR -->

<a href="javascript:;" class="page-quick-sidebar-toggler">
  <i class="icon-login"></i>
</a>

<div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
</div>

<div class="modal fade" id="locatariosModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Locatário(s) do Contrato
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
                                <input type="text" id="i-str-locatario"
                                placeholder="digite aqui um pedaço do nome"
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <button class="btn btn-primary"
                                    onClick="buscaIncrementalLocatario()">Carregar Sugestões
                                </button>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="i-idlocatariocontrato" name="IMB_LCTCTR_ID">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label class="control-label">Selecione abaixo</label>
                                <select class="form-control" id="selclientelike-locatario">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Principal
                                    <input type="checkbox"
                                        class="form-control" data-checkbox="icheckbox_flat-blue"
                                        id="i-principal-locatario">

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('cliente.add') }}"  target="_blank" >Click aqui para cadastrar um novo locatário</a>

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onClick="criarLocatarioContrato()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="fiadoresModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Fiador do Contrato
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
                                <input type="text" id="i-str-fiador"
                                placeholder="digite aqui um pedaço do nome"
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <button class="btn btn-primary"
                                    onClick="buscaIncrementalFiador()">Carregar Sugestões
                                </button>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="i-idfiadorcontrato" name="IMB_FDC_ID">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Selecione abaixo</label>
                                <select class="form-control" id="selclientelike-fiador">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('cliente.add') }}"  target="_blank" >Click aqui para cadastrar um novo fiador</a>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onClick="criarFiadorContrato()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalresumo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Resumo do Novo Contrato (lançamentos)
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body form">
                  <table  id="tblparcelas" class="table table-bordered table-hover" >
                    <thead class="thead-dark">
                      <tr >

                        <th width="1%" style="display: none"> order </th>
                        <th width="5%" style="text-align:center"> ID </th>
                        <th width="20%" style="text-align:center"> Evento </th>
                        <th width="10%" style="text-align:center"> Locador </th>
                        <th width="10%" style="text-align:center"> Locatário </th>
                        <th width="10%" style="text-align:center"> Vencimento </th>
                        <th width="15%" style="text-align:center"> Valor </th>
                        <th width="30%" style="text-align:center"> Observaçao </th>
                        <th width="1%" style="display: none">  TX  </th>
                        <th width="1%" style="display: none"> controle </th>
                        <th width="10%" style="text-align:center"> reajustar </th>
                        <th width="1%" style="display: none">  inc TX  </th>
                        

                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="i-btn-confirma" onClick="confirmarContrato(this)">Confirma os Lançamentos</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalprocessando" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
              <h2>Processando Aguarde.....</h2>
            </div>
        </div>
    </div>
</div>


@include('layout.modalcapctr')
@include('layout.modalcorctr')

<nav class="quick-nav">
  <a class="quick-nav-trigger" href="#0">
      <span aria-hidden="true"></span>
  </a>
  <ul>
      <li>
          <a href="javascript:ConcluirContrato()">
              <span id="i-gravado">Gravar Contrato</span>
              <i class="icon-check"></i>
          </a>
      </li>
  </ul>
  <span aria-hidden="true" class="quick-nav-bg"></span>
</nav>
<div class="quick-nav-overlay"></div>
@endsection
@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>

 <script>

    $(document).ready(function()
    {
      $("#sirius-menu").click();
      $("#div-contrato").show();
      cargaFormaRecebimento();
      cargaContaCobranca();
      imovelCarga();
      cargaIndiceReajuste();
      CarregarCorImo( $("#IMB_IMV_ID").val() );
      CarregarCapImo( $("#IMB_IMV_ID").val() );
      
      cargaBancos();
      pegarParametros();
      $("#h-locador").click( function()
      {
        CarregarPropImo( $("#IMB_IMV_ID").val() );
      })

      $( "#tabs" ).tabs();
      $( "#tabs-env" ).tabs();
      $( "#tabs-nomes" ).tabs();
      $( "#tabs" ).tabs( {
             active: 0
      });

      $(".CALCTERMINO").blur( function()
      {
        calcularTerminoContrato();
        primeiroVencimento();
      });

      var today = moment().format('YYYY-MM-DD');

      $('#IMB_CTR_DATALOCACAO').val(today);
      $('#IMB_CTR_INICIO').val(today);
      $("#IMB_CTR_PONTUALIDADEVALIDADE").val( '2200-12-31');
      $("#IMB_CTR_DIAVENCIMENTO").val( moment().format('DD'));

      $("#IMB_CTR_CONTRATOPARCELAS").blur( function()
      {

        var nValorTC = realToDolar( $("#IMB_CTR_CONTRATOVALOR").val() );
        var nParcelas = $("#IMB_CTR_CONTRATOPARCELAS").val();
        var nValorParcelas = nValorTC / nParcelas;

        var nParcFix = nValorParcelas.toFixed(2);
        var nTotalFix = nParcFix * nParcelas;
        var nDiferenca = nValorTC - nTotalFix;
        var nParcUmFix = parseFloat(nValorParcelas) + parseFloat(nDiferenca.toFixed(2));

        console.log('nValorParcelas '+nValorParcelas );
        console.log('diferenca '+nDiferenca );
        console.log('nTotalFix '+nTotalFix );

        nParcUmFix = nParcUmFix.toLocaleString('pt-BR');
        nValorParcelas = nValorParcelas.toLocaleString('pt-BR');
        console.log('nParcFix '+nParcFix );
        console.log('nParcUmFix '+nParcUmFix );

        $("#IMB_CTR_CONTRATOVENPAR1").val( $("#IMB_CTR_PRIMEIROVENCIMENTO").val() );
        $("#IMB_CTR_CONTRATOVALPAR1").val( nParcUmFix);

        if( nParcelas > 1 )
        {
          var dVen = adicionarMes( $("#IMB_CTR_DIAVENCIMENTO").val(),
          moment( $("#IMB_CTR_PRIMEIROVENCIMENTO").val()).format( 'MM-DD-YYYY'),1 );
          $("#IMB_CTR_CONTRATOVENPAR2").val( moment( dVen ).format( 'YYYY-MM-DD')) ;
          $("#IMB_CTR_CONTRATOVALPAR2").val( nValorParcelas);
        }

        if( nParcelas > 2 )
        {
          var dVen = adicionarMes( $("#IMB_CTR_DIAVENCIMENTO").val(),
          moment( $("#IMB_CTR_PRIMEIROVENCIMENTO").val()).format( 'MM-DD-YYYY'),2 );
          $("#IMB_CTR_CONTRATOVENPAR3").val( moment( dVen ).format( 'YYYY-MM-DD'));
          $("#IMB_CTR_CONTRATOVALPAR3").val( nValorParcelas);
        }

        if( nParcelas > 3 )
        {
          var dVen = adicionarMes( $("#IMB_CTR_DIAVENCIMENTO").val(),
          moment( $("#IMB_CTR_PRIMEIROVENCIMENTO").val()).format( 'MM-DD-YYYY'),3 );
          $("#IMB_CTR_CONTRATOVENPAR4").val( moment( dVen ).format( 'YYYY-MM-DD'));
          $("#IMB_CTR_CONTRATOVALPAR4").val( nValorParcelas);
        }


      });




      $("#IMB_CTR_PRIMEIROVENCIMENTO").blur( function()
      {

        if  ( ! verificarDataPrimeiroVencimento() ) return false;

        var dias = ( diferencaDias( $("#IMB_CTR_PRIMEIROVENCIMENTO").val(),
                                    $("#IMB_CTR_INICIO").val() ) )-30;

        var dFormatadoini = moment( $("#IMB_CTR_INICIO").val() ).format("M-D-YYYY");
        var dini = new Date( dFormatadoini );
        var ndiaini = dini.getDate();

        var dFormatadopri = moment( $("#IMB_CTR_PRIMEIROVENCIMENTO").val() ).format("M-D-YYYY");
        var dpri = new Date( dFormatadopri );
        var ndiapri = dpri.getDate();

        if ( dias < 31 && ndiapri == ndiaini ) dias = 0;

        valorproporcional = 0;

        if( dias != 0 ) dias--;

        if( dias != 0 )
          var valorproporcional =
            calcularValorProporcionalDia( $("#IMB_CTR_VALORALUGUEL").val(), dias );

        console.log('Dias: '+dias );
        console.log('Valor Prop: '+valorproporcional );
        console.log('Valor valoremtexto : '+valoremtexto  );

        var valoremtexto = valorproporcional.toString();

        valoremtexto = valoremtexto.replace('.', ',');

        $("#span-diferenca").val( 'Ref. a '+dias);

        $("#IMB_CTR_DIASVALOR").val( valoremtexto );

        if( valorproporcional == 0 )
          var nValorPrimVen =   parseFloat( realToDolar( $("#IMB_CTR_VALORALUGUEL").val()))
        else
          var nValorPrimVen =   parseFloat( realToDolar( $("#IMB_CTR_VALORALUGUEL").val()))+
                          parseFloat(realToDolar($("#IMB_CTR_DIASVALOR").val()))

        cValorPrimVen = nValorPrimVen.toString();
        cValorPrimVen = cValorPrimVen.replace('.', ',');

        $("#IMB_CTR_VALORPRIMVEN").val( cValorPrimVen );


      });

      $("#IMB_CTR_FORMAREAJUSTE").blur( function()
      {
        calcularProximoReajuste();
      })

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



    function imovelCarga()
    {
      url = "{{ route( 'imovel.carga')}}/"+$("#i-idimovelcontrato").val();
      $.ajax(
      {
        url : url,
        type: 'get',
        datatype: 'json',
        async:false,
        success: function( data )
        {
          var tipoendereco = data.IMB_IMV_ENDERECOTIPO;
          var compleendereco = data.IMB_IMV_ENDERECOCOMPLEMENTO;
          var numapt = data.IMB_IMV_NUMAPT;

          if( tipoendereco === null ) tipoendereco = '';
          if( compleendereco === null ) compleendereco = '';
          if( numapt === null ) numapt = '';


          if( data.IMB_IMV_NUMAPT != 0 )
          {
            $("#i-endereco").text( 'Imóvel: ('+
            data.IMB_IMV_ID+') - '+
            tipoendereco+' '+
              data.IMB_IMV_ENDERECO+' '+
              data.IMB_IMV_ENDERECONUMERO+' '+
              numapt+' '+
              compleendereco+' - Bairro: '+
              data.CEP_BAI_NOME);

          }
          else
          {
            $("#i-endereco").text('Imóvel: ('+
              data.IMB_IMV_ID+') - '+
              tipoendereco+' '+
              data.IMB_IMV_ENDERECO+' '+
              data.IMB_IMV_ENDERECONUMERO+' '+
              compleendereco+' - Bairro: '+
              data.CEP_BAI_NOME
            )
          };
          var nValorAluguel =  parseFloat(data.IMB_IMV_VALLOC);
          nValorAluguel = nValorAluguel.toLocaleString('pt-BR');
          $("#IMB_CTR_VALORALUGUEL").val( nValorAluguel );
          console.log( 'valoraluguel: '+nValorAluguel );
          buscarCondominio( data.IMB_CND_ID );

          $("#IMB_IMV_ID").val( data.IMB_IMV_ID );
          $("#IMB_CLT_ID").val( data.IMB_CLT_ID );

          $("#IMB_IMV_REFERE").val( data.IMB_IMV_REFERE );

          tipoendereco = data.IMB_IMV_ENDERECOTIPO;
          if( tipoendereco === null ) 
            tipoendereco=''
          else
            tipoendereco= tipoendereco +' ';
          $("#IMB_IMV_ENDERECO").val( tipoendereco+data.IMB_IMV_ENDERECO );
            $("#IMB_IMV_ENDERECONUMERO").val( data.IMB_IMV_ENDERECONUMERO );
            $("#IMB_IMV_ENDERECOCOMPLEMENTO").val( data.IMB_IMV_ENDERECONUMEROCOMPLEMENTO );
            $("#IMB_IMV_NUMAPT").val( data.IMB_IMV_NUMAPT );
            $("#IMB_IMV_ENDERECOCEP").val( data.IMB_IMV_ENDERECOCEP );
            $("#IMB_IMV_CIDADE").val( data.IMB_IMV_CIDADE );
            $("#CEP_BAI_NOME").val( data.CEP_BAI_NOME );
            $("#IMB_IMV_ESTADO").val( data.IMB_IMV_ESTADO );
          if( $("#i-condominio").val() != '' )
            $("#i-endereco").text( $("#i-endereco").text()
            +' - Condomínio: '+$("#i-condominio").val() );

          $("#IMB_IMV_ALUGUELAGREGAR").val( dolarToReal( data.IMB_IMV_ALUGUELAGREGAR ));
          $("#IMB_IMV_AGREGADOLDCREDEB").val(  data.IMB_IMV_AGREGADOLDCREDEB );
          $("#IMB_IMV_AGREGADOLTCREDEB").val(  data.IMB_IMV_AGREGADOLTCREDEB );

        }

      });

      function buscarCondominio( id )
      {
        url = "{{ route( 'condominio.buscar' )}}/"+id;
        $.ajax(
          {
            url : url,
            type: 'get',
            datatype: 'json',
            async:false,
            success : function( data )
            {
              $("#i-condominio").val( data.IMB_CND_NOME );
            },

            error: function()
            {
              $("#i-condominio").val('');
            }

          }
        )
      }
    }

    function selecionarLocatario()
    {
        var clienteselecionado = $("#selclientelike-locatario").val();
            $("#IMB_CLT_ID").val( clienteselecionado);
            $("#locatariosModal").modal('hide');
            var nomelocatario = $('#selclientelike-locatario').find(":selected").text();
    }


    function adicionarLocatarioContrato()
    {

        $("#locatariosModal").modal('show');
        $("#i-idlocatariocontrato").val('');
//        $("#i-str").val( prop );
        $('#i-principal-locatario').prop('checked', 'true');

        buscaIncrementalLocatario();
    }


    function buscaIncrementalLocatario()
    {
        str = $("#i-str-locatario").val();
        var url = "{{ route('buscaclienteincremental') }}"+"/"+str;

        $.getJSON( url, function( data)
        {
        linha = "";
        $("#selclientelike-locatario").empty();
        for( nI=0;nI < data.length;nI++)
        {
            linha =
            '<option value="'+data[nI].IMB_CLT_ID+'">'+
            data[nI].IMB_CLT_NOME+"</option>";
            $("#selclientelike-locatario").append( linha );
        }
        });
    }

    function criarLocatarioContrato()
    {
        var cprincipal = '-';
        if( $('#i-principal-locatario').prop('checked') )
            cprincipal = 'Principal';

        var cliente = $("#selclientelike-locatario option:selected" ).val();
        linha =
                    '<tr id="'+cliente+'">'+
                    '   <td style="text-align:center">'+$("#selclientelike-locatario option:selected" ).val()+'</td>'+
                    '   <td style="text-align:center">'+$("#selclientelike-locatario option:selected" ).text()+'</td>'+
                    '   <td style="text-align:center">'+cprincipal+'</td>'+
                    '   <td style="text-align:center"> '+
                    '<a  class="btn btn-sm btn-danger" href=javascript:removerLinha('+cliente+')>Apagar</a>'+
                    '   </td>'+
                    '</tr>';
        $("#tbllocatarios").append( linha );

    };



    function fiadorLocatario()
    {
        var clienteselecionado = $("#selclientelike-fiador").val();
            $("#fiadoresModal").modal('hide');
            var nomelocatario = $('#selclientelike-fiadores').find(":selected").text();
    }


    function adicionarFiadorContrato()
    {

        $("#fiadoresModal").modal('show');

        buscaIncrementalLocatario();
    }

    function buscaIncrementalFiador()
    {
        str = $("#i-str-fiador").val();
        var url = "{{ route('buscaclienteincremental') }}"+"/"+str;

        $.getJSON( url, function( data)
        {
        linha = "";
        $("#selclientelike-fiador").empty();
        for( nI=0;nI < data.length;nI++)
        {
            linha =
            '<option value="'+data[nI].IMB_CLT_ID+'">'+
            data[nI].IMB_CLT_NOME+"</option>";
            $("#selclientelike-fiador").append( linha );
        }
        });
    }


    function criarFiadorContrato()
    {
        var cliente = $("#selclientelike-fiador option:selected" ).val();
        linha =
                    '<tr id="'+cliente+'">'+
                    '   <td style="text-align:center">'+$("#selclientelike-fiador option:selected" ).val()+'</td>'+
                    '   <td style="text-align:center">'+$("#selclientelike-fiador option:selected" ).text()+'</td>'+
                    '   <td style="text-align:center"> '+
                    '<a  class="btn btn-sm btn-danger" href=javascript:removerLinha('+cliente+')>Apagar</a>'+
                    '   </td>'+
                    '</tr>';
        $("#tblfiadores").append( linha );

    };


    function calcularTerminoContrato()
    {
      var dAnt = $("#IMB_CTR_INICIO").val();
      var dFormatado = moment(dAnt).format("M-D-YYYY");

      var date = new Date( dFormatado );
      var mes = date.getMonth();


      var duracao = parseInt($("#IMB_CTR_DURACAO").val());
	    //crio uma nova váriavel com a nova data, Date(ano, mes(soma da variavel enviada para o metodo + o mes atual, dia que eu coloquei padrão para 1
      var n_date = date.setMonth( mes + duracao )-1;
      n_date = moment( n_date ).format( 'DD/MM/YYYY');

       if ( n_date=='Invalid date') n_date='';
      $("#IMB_CTR_TERMINO").val( n_date );
      calcularProximoReajuste();

    }

    function primeiroVencimento()
    {
      var dAnt = $("#IMB_CTR_INICIO").val();
      var dFormatado = moment(dAnt).format("M-D-YYYY");

      var date = new Date( dFormatado );
      var mes = date.getMonth();


      var duracao = 1;
	    //crio uma nova váriavel com a nova data, Date(ano, mes(soma da variavel enviada para o metodo + o mes atual, dia que eu coloquei padrão para 1
      var n_date = date.setMonth( mes + duracao );
      n_date = moment( n_date ).format( 'YYYY-MM-DD');

      if ( n_date=='Invalid date') n_date='';
      $("#IMB_CTR_PRIMEIROVENCIMENTO").val( n_date );

    }


    function calcularProximoReajuste()
    {

      var dAnt = $("#IMB_CTR_INICIO").val();
      var dFormatado = moment(dAnt).format("M-D-YYYY");

      var date = new Date( dFormatado );
      var mes = date.getMonth();

      var duracao = parseInt($("#IMB_CTR_FORMAREAJUSTE").val());
	    //crio uma nova váriavel com a nova data, Date(ano, mes(soma da variavel enviada para o metodo + o mes atual, dia que eu coloquei padrão para 1
      var n_date = date.setMonth( mes + duracao);
      n_date = moment( n_date ).format( 'DD/MM/YYYY');

      if ( n_date=='Invalid date') n_date='';
      $("#IMB_CTR_DATAREAJUSTE").val( n_date );

    }



    function removerLinha(id)
    {

      var textoid = '#'+id;

      $( textoid ).remove();

    }

    function cargaIndiceReajuste()
    {

      $.getJSON( "{{ route('indicereajuste.carga')}}/"+$("#I-IMB_IMB_IDMASTER").val(), function( data )
            {

                $("#IMB_IRJ_ID").empty();

                linha =  '<option value="-1">Índice de Reajuste</option>';
                $("#js-select-unidade").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].IMB_IRJ_ID+'">'+
                        data[nI].IMB_IRJ_NOME+"</option>";
                        $("#IMB_IRJ_ID").append( linha );

                }

            });

    }

    function ConcluirContrato()
    {


      var dFormatado = moment($("#IMB_CTR_PRIMEIROVENCIMENTO").val()).format("M-D-YYYY");

      dFormatado = new Date( dFormatado );

      var datainicial     = new Date( dFormatado.getFullYear(),
                                      dFormatado.getMonth(),
                                      $("#IMB_CTR_DIAVENCIMENTO").val() );

      var nMes = 0;
      var nAno = 0;

      var nDia = dFormatado.getDate();

      if( $("#IMB_IRJ_ID").val() == '' )
      {
        alert( 'Informe o índice a ser utilizado!');
        return false;
      }


      if( $("#IMB_CTR_FINALIDADE").val() == '-1' )
      {
        alert( 'Informe o tipo de contrato RESIDENCIAL ou COMERCIAL!');
        return false;
      }

      if( $("#IMB_CTR_EXIGENCIA").val() == '-1' )
      {
        alert( 'Informe a forma de fiança!');
        return false;
      }


      if( $("#IMB_CTR_EXIGENCIA").val() == 'F' && document.getElementById('tblfiadores').rows.length == 1 )
      {
        alert( 'Você informou a forma de fiança como FIADOR, mas não informou ainda o(s) fiador(es)!');
        return false;

      }

      if(  document.getElementById('tbllocatarios').rows.length == 1 )
      {
        alert( 'Você ainda não informou o locatário!');
        return false;

      }




      if( $("#IMB_CTR_DIAVENCIMENTO").val() != nDia )
      {
        alert('Atenção! O dia de vencimento contratual, está diferente do dia informado no primeiro vencimento');
        return  false;
      }

      if( $("#IMB_CTR_DATAREAJUSTE").val() =='' )
      {
        alert('Atenção! Confirma a forma de reajuste clicando sobre o campo FORMA DE REAJUSTE');
        return  false;
      }

      if( $("#IMB_CTR_TERMINO").val() =='' )
      {
        alert('Atenção! Informe a duração do contrato');
        return  false;
      }


      if( $("#IMB_CTR_DIAVENCIMENTO").val() =='' )
      {
        alert('Atenção! Informe o dia de vencimento');
        return  false;
      }


      if ( ! consistirLocatario() )
      {
        return false;
      }

      $("#i-gravado").hide();



      $("#modalprocessando").modal('show');
      linha = "";
      nMes = datainicial.getMonth();
      nAno = datainicial.getFullYear();
      var valordoaluguel = 0;
      var numpar = 0;
      var numparreajustar=0;
      var columnreajustar='';
      $("#tblparcelas>tbody").empty();
      for( nParcelas=0;nParcelas <= $("#IMB_CTR_FORMAREAJUSTE").val();nParcelas++)
      //coloquei <= para que dentro do laço ele calcule já a data de reajuste
      {


          if( nParcelas == 0 )
          {

            dPerInicial = $("#IMB_CTR_INICIO").val();
            dPerFinal = adicionarMes( $("#IMB_CTR_DIAVENCIMENTO").val(),
                        moment( dPerInicial).format('MM-DD-YYYY') ,1 );
            dPerFinal = dPerFinal -1;
            descricao = 'Periodo entre '+moment( dPerInicial ).format('DD/MM/YYYY')+' a '+
            moment(dPerFinal).format('DD/MM/YYYY') ;
            valordoaluguel = $("#IMB_CTR_VALORPRIMVEN").val();

          }
          else
          {
            nDiaVencimento = $("#IMB_CTR_DIAVENCIMENTO").val();
            nMes++;
            if( nMes > 11 )
            {
               nMes = 0;
               nAno++;
            }
            nUltimoDia = ultimoDiaMes( nMes+1, nAno );

            if ( nUltimoDia < nDiaVencimento )
              nDiaVencimento = nUltimoDia;

            datainicial = new Date( nAno, nMes, nDiaVencimento );

            dPerInicial = subtrairUmMes( nDiaVencimento, datainicial );
            descricao = 'Periodo entre '+moment( dPerInicial ).format('DD/MM/YYYY')+' a '+
            moment(datainicial-1).format('DD/MM/YYYY') ;

            valordoaluguel = $("#IMB_CTR_VALORALUGUEL").val();
          }

          numpar = nParcelas + 1;
          numparreajustar++;

          columnreajustar = '';
          if( numparreajustar > $("#IMB_CTR_FORMAREAJUSTE").val() )
          {
            numparreajustar = 1;
            columnreajustar = 'Reajustar';
//            $("#IMB_CTR_DATAREAJUSTE").val( moment(datainicial).format('DD/MM/YYYY'));

          }

          var datasort = moment(datainicial).format('YYYYMMDD');
          console.log('Parcela aluguel: '+valordoaluguel+'  '+nParcelas);
          linha =
            '<tr>'+
            '<td style="display: none">'+datasort+'</td>' +
            '<td style="text-align:center valign="center">1</td>' +
            '<td style="text-align:center valign="center">Aluguel</td>' +
            '<td style="text-align:center valign="center">Crédito</td>' +
            '<td style="text-align:center valign="center">Débito</td>' +
            '<td style="text-align:center valign="center">'+moment(datainicial).format('DD/MM/YYYY')+'</td>' +
            '<td style="text-align:center valign="center">'+valordoaluguel+'</td>' +
            '<td style="text-align:center valign="center"></td>'+
            '<td style="display: none"></td>'+
            '<td style="display: none">'+numpar+'</td>'+
            '<td style="text-align:center valign="center">'+columnreajustar+'</td>'+
            '<td style="display: none"></td>';

          linha = linha +
                          '</tr>';

          $("#tblparcelas").append( linha );

//          datainicial.setMonth(datainicial.getMonth() + 1);


      }   ;

      //DESCONTO
      var dFormatado = moment($("#IMB_CTR_PRIMEIROVENCIMENTO").val()).format("M-D-YYYY");

      dFormatado = new Date( dFormatado );

      var datainicial     = new Date( dFormatado.getFullYear(),
                                      dFormatado.getMonth(),
                                      $("#IMB_CTR_DIAVENCIMENTO").val() );

      nMes = 0;
      nAno = 0;
      linha = "";
      descricao='';
      nMes = datainicial.getMonth();
      nAno = datainicial.getFullYear();
      for( nParcelas=0;nParcelas < $("#IMB_CTR_DESCONTOMESES").val();nParcelas++)
      {


        if( nParcelas != 0 )
          {
            nDiaVencimento = $("#IMB_CTR_DIAVENCIMENTO").val();
            nMes++;
            if( nMes > 11 )
            {
               nMes = 0;
               nAno++;
            }
            nUltimoDia = ultimoDiaMes( nMes+1, nAno );

            if ( nUltimoDia < nDiaVencimento )
              nDiaVencimento = nUltimoDia;

            datainicial = new Date( nAno, nMes, nDiaVencimento );

          };

          numpar = nParcelas + 1;
          descricao = 'Parcela '+numpar+'/'+$("#IMB_CTR_DESCONTOMESES").val();

          datasort = moment(datainicial).format('YYYYMMDD');
          linha =
            '<tr>'+
            '<td style="display: none">'+datasort+'</td>' +
            '<td style="text-align:center valign="center">8</td>' +
            '<td style="text-align:center valign="center">Desconto Temporário</td>' +
            '<td style="text-align:center valign="center">Débito</td>' +
            '<td style="text-align:center valign="center">Crédito</td>' +
            '<td style="text-align:center valign="center">'+moment(datainicial).format('DD/MM/YYYY')+'</td>' +
            '<td style="text-align:center valign="center">'+$("#IMB_CTR_DESCONTO").val()+'</td>' +
            '<td style="text-align:center valign="center">'+descricao+'</td>'+
            '<td style="display: none"></td>'+
            '<td style="display: none">'+numpar+'</td>'+
            '<td style="text-align:center valign="center"></td>'+
            '<td style="display: none"></td>';

          linha = linha +
                          '</tr>';

          $("#tblparcelas").append( linha );

//          datainicial.setMonth(datainicial.getMonth() + 1);


      }   ;

      if( $("#IMB_CTR_VALORCOND").val() != '0,00' )
      {
      //condominio
        datasort = moment( $("#IMB_CTR_PRIMEIROVENCIMENTO").val()).format( 'YYYYMMDD');
        descricao="Condominio(pago antecipado)";
        linha =
            '<tr>'+
            '<td style="display: none">'+datasort+'</td>' +
            '<td style="text-align:center valign="center">12</td>' +
            '<td style="text-align:center valign="center">Condomínio</td>' +
            '<td style="text-align:center valign="center">Nada</td>' +
            '<td style="text-align:center valign="center">Débito</td>' +
            '<td style="text-align:center valign="center">'+
                moment( $("#IMB_CTR_PRIMEIROVENCIMENTO").val()).format( 'DD/MM/YYYY')+'</td>' +
            '<td style="text-align:center valign="center">'+$("#IMB_CTR_VALORCOND").val()+'</td>' +
            '<td style="text-align:center valign="center">'+descricao+'</td>'+
            '<td style="display: none"></td>'+
            '<td style="display: none">1</td>'+
            '<td style="text-align:center valign="center"></td>'+
            '<td style="display: none"></td>';
          linha = linha +
                          '</tr>';

          $("#tblparcelas").append( linha );
      }



      //IPTU
      var dFormatado = moment($("#IMB_CTR_PRIMEIROVENCIMENTO").val()).format("M-D-YYYY");

      dFormatado = new Date( dFormatado );

      var datainicial     = new Date( dFormatado.getFullYear(),
                                      dFormatado.getMonth(),
                                      $("#IMB_CTR_DIAVENCIMENTO").val() );

      nMes = 0;
      nAno = 0;
      linha = "";
      descricao='';
      nMes = datainicial.getMonth();
      nAno = datainicial.getFullYear();
      for( nParcelas=0;nParcelas < $("#IMB_CTR_IPTUQTDEPARCLAS").val();nParcelas++)
      {


        if( nParcelas != 0 )
          {
            nDiaVencimento = $("#IMB_CTR_DIAVENCIMENTO").val();
            nMes++;
            if( nMes > 11 )
            {
               nMes = 0;
               nAno++;
            }
            nUltimoDia = ultimoDiaMes( nMes+1, nAno );

            if ( nUltimoDia < nDiaVencimento )
              nDiaVencimento = nUltimoDia;

            datainicial = new Date( nAno, nMes, nDiaVencimento );

          };

          numpar = nParcelas + 1;
          descricao = 'Parcela '+numpar+'/'+$("#IMB_CTR_IPTUQTDEPARCLAS").val();
          datasort = moment(datainicial).format('YYYYMMDD');

          linha =
            '<tr>'+
            '<td style="display: none">'+datasort+'</td>' +
            '<td style="text-align:center valign="center">17</td>' +
            '<td style="text-align:center valign="center">IPTU</td>' +
            '<td style="text-align:center valign="center">'+$('#IMB_CTR_IPTULOCADOR').find(":selected").text()+'</td>' +
            '<td style="text-align:center valign="center">'+$('#IMB_CTR_IPTULOCATARIO').find(":selected").text()+'</td>' +
            '<td style="text-align:center valign="center">'+moment(datainicial).format('DD/MM/YYYY')+'</td>' +
            '<td style="text-align:center valign="center">'+$("#IMB_CTR_IPTUVALOR").val()+'</td>' +
            '<td style="text-align:center valign="center">'+descricao+'</td>'+
            '<td style="display: none"></td>'+
            '<td style="display: none">'+numpar+'</td>'+
            '<td style="text-align:center valign="center"></td>'+
            '<td style="display: none"></td>';

          linha = linha +
                          '</tr>';

          $("#tblparcelas").append( linha );

//          datainicial.setMonth(datainicial.getMonth() + 1);


      }   ;



      //SEGURO
      var dFormatado = moment($("#IMB_CTR_PRIMEIROVENCIMENTO").val()).format("M-D-YYYY");

      dFormatado = new Date( dFormatado );

      var datainicial     = new Date( dFormatado.getFullYear(),
                                      dFormatado.getMonth(),
                                      $("#IMB_CTR_DIAVENCIMENTO").val() );

      nMes = 0;
      nAno = 0;
      linha = "";
      descricao='';
      nMes = datainicial.getMonth();
      nAno = datainicial.getFullYear();
      for( nParcelas=0;nParcelas < $("#imb_ctr_seguroparcelas").val();nParcelas++)
      {


        if( nParcelas != 0 )
          {
            nDiaVencimento = $("#IMB_CTR_DIAVENCIMENTO").val();
            nMes++;
            if( nMes > 11 )
            {
               nMes = 0;
               nAno++;
            }
            nUltimoDia = ultimoDiaMes( nMes+1, nAno );

            if ( nUltimoDia < nDiaVencimento )
              nDiaVencimento = nUltimoDia;

            datainicial = new Date( nAno, nMes, nDiaVencimento );

          };

          numpar = nParcelas + 1;
          descricao = 'Parcela '+numpar+'/'+$("#imb_ctr_seguroparcelas").val();
          datasort = moment(datainicial).format('YYYYMMDD');

          linha =
            '<tr>'+
            '<td style="display: none">'+datasort+'</td>' +
            '<td style="text-align:center valign="center">34</td>' +
            '<td style="text-align:center valign="center">Seguro Incêndio</td>' +
            '<td style="text-align:center valign="center">Nenhum</td>' +
            '<td style="text-align:center valign="center">Débito</td>' +
            '<td style="text-align:center valign="center">'+moment(datainicial).format('DD/MM/YYYY')+'</td>' +
            '<td style="text-align:center valign="center">'+$("#IMB_CTR_SEGUROVALORPARCELA").val()+'</td>' +
            '<td style="text-align:center valign="center">'+descricao+'</td>'+
            '<td style="display: none"></td>'+
            '<td style="display: none">'+numpar+'</td>'+
            '<td style="text-align:center valign="center"></td>'+
            '<td style="display: none"></td>';
          linha = linha +
                          '</tr>';

          $("#tblparcelas").append( linha );

//          datainicial.setMonth(datainicial.getMonth() + 1);


      }   ;


      var cIncideTA = '';
      if( $("#IMB_CTR_CONTRATOVENPAR1").val() != 0 )
      {
        datasort = moment($("#IMB_CTR_CONTRATOVENPAR1").val()).format('YYYYMMDD');
        if( $("#IMB_CTR_CONTRATOPARCELAS").val() == 1 )
          descricao="Parcela Única"
        else
          descricao="Parcela 1/"+$("#IMB_CTR_CONTRATOPARCELAS").val()
        cIncideTA = '';

        cIncideTA = 'N';
        cCobrarTa = 'N';
        if( $("#IMB_CTR_COBTAXAADM1").prop( "checked" ) )
          cCobrarTa='S';
        if( $("#IMB_CTR_INCTAXAADM1").prop( "checked" ) )
          cIncideTA='S';

           
        linha =
            '<tr>'+
            '<td style="display: none">'+datasort+'</td>' +
            '<td style="text-align:center valign="center">7</td>' +
            '<td style="text-align:center valign="center">Taxa de Contrato</td>' +
            '<td style="text-align:center valign="center">Débito</td>' +
            '<td style="text-align:center valign="center">Nada</td>' +
            '<td style="text-align:center valign="center">'+
                moment( $("#IMB_CTR_CONTRATOVENPAR1").val()).format( 'DD/MM/YYYY')+'</td>' +
            '<td style="text-align:center valign="center">'+$("#IMB_CTR_CONTRATOVALPAR1").val()+'</td>' +
            '<td style="text-align:center valign="center">'+descricao+'</td>'+
            '<td style="display: none">'+cCobrarTa+'</td>'+
            '<td style="display: none">1</td>'+
            '<td style="text-align:center valign="center"></td>'+
            '<td style="display: none">'+cIncideTA+'</td>';



          linha = linha +
                          '</tr>';

          $("#tblparcelas").append( linha );
      }





      if( $("#IMB_CTR_CONTRATOVENPAR2").val() != 0 )
      {
        descricao="Parcela 2/"+$("#IMB_CTR_CONTRATOPARCELAS").val();
        cIncideTA = '';

        cIncideTA = 'N';
        cCobrarTa = 'N';
        if( $("#IMB_CTR_COBTAXAADM2").prop( "checked" ) )
          cCobrarTa='S';
        if( $("#IMB_CTR_INCTAXAADM2").prop( "checked" ) )
          cIncideTA='S';

           
        linha =
            '<tr>'+
            '<td style="display: none">'+datasort+'</td>' +
            '<td style="text-align:center valign="center">7</td>' +
            '<td style="text-align:center valign="center">Taxa de Contrato</td>' +
            '<td style="text-align:center valign="center">Débito</td>' +
            '<td style="text-align:center valign="center">Nada</td>' +
            '<td style="text-align:center valign="center">'+
                moment( $("#IMB_CTR_CONTRATOVENPAR2").val()).format( 'DD/MM/YYYY')+'</td>' +
            '<td style="text-align:center valign="center">'+$("#IMB_CTR_CONTRATOVALPAR2").val()+'</td>' +
            '<td style="text-align:center valign="center">'+descricao+'</td>'+
            '<td style="display: none">'+cCobrarTa+'</td>'+
            '<td style="display: none">1</td>'+
            '<td style="text-align:center valign="center"></td>'+
            '<td style="display: none">'+cIncideTA+'</td>';

            linha = linha +
                          '</tr>';

          $("#tblparcelas").append( linha );
      }



      if( $("#IMB_CTR_CONTRATOVENPAR3").val() != 0 )
      {
        descricao="Parcela 3/"+$("#IMB_CTR_CONTRATOPARCELAS").val();
        cIncideTA = '';

        cIncideTA = 'N';
        cCobrarTa = 'N';
        if( $("#IMB_CTR_COBTAXAADM3").prop( "checked" ) )
          cCobrarTa='S';
        if( $("#IMB_CTR_INCTAXAADM3").prop( "checked" ) )
          cIncideTA='S';

           
        linha =
            '<tr>'+
            '<td style="display: none">'+datasort+'</td>' +
            '<td style="text-align:center valign="center">7</td>' +
            '<td style="text-align:center valign="center">Taxa de Contrato</td>' +
            '<td style="text-align:center valign="center">Débito</td>' +
            '<td style="text-align:center valign="center">Nada</td>' +
            '<td style="text-align:center valign="center">'+
                moment( $("#IMB_CTR_CONTRATOVENPAR3").val()).format( 'DD/MM/YYYY')+'</td>' +
            '<td style="text-align:center valign="center">'+$("#IMB_CTR_CONTRATOVALPAR3").val()+'</td>' +
            '<td style="text-align:center valign="center">'+descricao+'</td>'+
            '<td style="display: none">'+cCobrarTa+'</td>'+
            '<td style="display: none">1</td>'+
            '<td style="text-align:center valign="center"></td>'+
            '<td style="display: none">'+cIncideTA+'</td>';

                
        linha = linha +
                          '</tr>';

          $("#tblparcelas").append( linha );
      }



      if( $("#IMB_CTR_CONTRATOVENPAR4").val() != 0 )
      {
        datasort = moment($("#IMB_CTR_CONTRATOVENPAR2").val()).format('YYYYMMDD');
        descricao="Parcela 4/"+$("#IMB_CTR_CONTRATOPARCELAS").val();
        cIncideTA = '';

        cIncideTA = 'N';
        cCobrarTa = 'N';
        if( $("#IMB_CTR_COBTAXAADM4").prop( "checked" ) )
          cCobrarTa='S';
        if( $("#IMB_CTR_INCTAXAADM4").prop( "checked" ) )
          cIncideTA='S';

           
        linha =
            '<tr>'+
            '<td style="display: none">'+datasort+'</td>' +
            '<td style="text-align:center valign="center">7</td>' +
            '<td style="text-align:center valign="center">Taxa de Contrato</td>' +
            '<td style="text-align:center valign="center">Débito</td>' +
            '<td style="text-align:center valign="center">Nada</td>' +
            '<td style="text-align:center valign="center">'+
                moment( $("#IMB_CTR_CONTRATOVENPAR4").val()).format( 'DD/MM/YYYY')+'</td>' +
            '<td style="text-align:center valign="center">'+$("#IMB_CTR_CONTRATOVALPAR4").val()+'</td>' +
            '<td style="text-align:center valign="center">'+descricao+'</td>'+
            '<td style="display: none">'+cCobrarTa+'</td>'+
            '<td style="display: none">1</td>'+
            '<td style="text-align:center valign="center"></td>'+
            '<td style="display: none">'+cIncideTA+'</td>';

        
          linha = linha +
                          '</tr>';

          $("#tblparcelas").append( linha );
      }


      sortTable();
      $("#modalresumo").modal('show');
      $("#modalprocessando").modal('hide');


    }



    function verificarDataPrimeiroVencimento()
    {
      var dInicio = moment( $("#IMB_CTR_INICIO").val(), 'YYYY-MM-DD');
      var dPrimeiroVencimento = moment( $("#IMB_CTR_PRIMEIROVENCIMENTO").val(), 'YYYY-MM-DD');

      if ( dPrimeiroVencimento < dInicio )
      {
        alert('A data do primeiro vencimento é inferior a data de inicio de contrato. Verifique!');
        $("#IMB_CTR_PRIMEIROVENCIMENTO").val('');
          return false;
      }

      return true;
    }

    function CarregarPropImo( imovel )
    {
        var url = "{{ route('propimo.carga') }}"+"/"+imovel;
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
                    '</tr>';

                $("#tbpropimo").append( linha );

            }
        });
    }
    function sortTable()
    {
      var table, rows, switching, i, x, y, shouldSwitch;
      table = document.getElementById("tblparcelas");
      switching = true;
      /*Make a loop that will continue until
      no switching has been done:*/
      while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /*Loop through all table rows (except the
        first, which contains table headers):*/
        for (i = 1; i < (rows.length - 1); i++) {
          //start by saying there should be no switching:
          shouldSwitch = false;
          /*Get the two elements you want to compare,
          one from current row and one from the next:*/
          x = rows[i].getElementsByTagName("TD")[ 0];
          y = rows[i + 1].getElementsByTagName("TD")[0];
          //check if the two rows should switch place:
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            //if so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        }
        if (shouldSwitch) {
          /*If a switch has been marked, make the switch
          and mark that a switch has been done:*/
          rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
          switching = true;
        }
      }
    }

    function CarregarCorImo( nId )
    {
        var url = "{{ route('corimo.carga') }}"+"/"+nId;
        console.log( url );
        $.ajax(
        {
          url: url,
          dataType:'json',
          type:'get',
          async:false,
          success:function( data )
          {
            linha = "";
            $("#tbcorctr>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
              var perc = parseFloat( data[nI].IMB_CORIMO_PERCENTUAL );
              var percbr = formatarBRSemSimbolo( perc );
                linha =
                    '<tr id="l-cor'+data[nI].IMB_ATD_ID+'">'+
                    '   <td class="div-center">'+data[nI].IMB_ATD_ID+'</td>'+
                    '   <td class="div-center">'+data[nI].IMB_ATD_NOME+'</td>'+
                    '   <td class="div-center">'+percbr+'</td>'+
                    '   <td style="text-align:center"> '+
                    '<a  class="btn btn-sm btn-danger" href="javascript:apagarLinha( \'l-cor'+data[nI].IMB_ATD_ID+'\')">Apagar</a>'+
                    '   </td>'+
                    '</tr>';

                $("#tbcorctr").append( linha );

            }
          }
        });
    }

    function CarregarCapImo( nId )
    {
        var url = "{{ route('capimo.carga') }}"+"/"+nId;
        $.getJSON( url, function( data)
        {
            linha = "";
            $("#tbcapimo-contrato>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
              var perc = parseFloat( data[nI].IMB_CAPIMO_PERCENTUAL );
              var percbr = formatarBRSemSimbolo( perc );

                linha =
                    '<tr>'+
                    '   <td>'+data[nI].IMB_ATD_ID+'</td>'+
                    '   <td>'+data[nI].IMB_ATD_NOME+'</td>'+
                    '   <td>'+percbr+'%</td>'+
                    '   <td style="text-align:center"> '+
//                    '<a  class="btn btn-sm btn-primary" href=javascript:editarCorImo('+data[nI].IMB_CORIMO_ID+')>Editar</a>&nbsp;&nbsp;&nbsp;&nbsp;'+
//                    '           <button class="btn btn-sm btn-primary" onclick="editarCorImo('+data[nI].IMB_CORIMO_ID+' )">Editar</button>'+
//                    '           <button class="btn btn-sm btn-danger" onclick="apagarCorImo('+data[nI].IMB_CORIMO_ID+' )">Apagar</button>'+
                    '<a  class="btn btn-sm btn-primary" href=javascript:editarCapImo('+data[nI].IMB_CAPIMO_ID+')>     Editar</a>'+
                    '<a  class="btn btn-sm btn-danger" href=javascript:apagarCapImo('+data[nI].IMB_CAPIMO_ID+')>     Apagar</a>'+
                    '   </td>'+
                    '</tr>';

                $("#tbcapimo-contrato").append( linha );

            }
        });
    }

    function confirmarContrato(e)
    {

      debugger;
      $("#modalresumo").hide();
      alert('Este processo poderá demorar alguns segundos....');
        e.disabled = true;

      url="{{ route('contrato.sequencia') }}";

      $("#i-btn-confirma").hide();
      $("#i-btn-confirma").click( function()
      {
          alert('');
        this.hide();
      });

      
      
      $("#modalprocessando").modal('show');

      if( $("#IMB_CTR_DIASVALOR").val()=='')
        $("#IMB_CTR_DIASVALOR").val(0);

      $.ajax(
      {
          url : url,
          dataType : 'json',
          async : false,
          type : 'get',
          success : function( data )
          {
            var sequencia = data;
            var contrato =
            {
              IMB_CTR_INICIO : $("#IMB_CTR_INICIO").val(),
              IMB_IMB_ID : $("#I-IMB_IMB_IDMASTER").val(),
              IMB_CTR_TERMINO :  $("#IMB_CTR_TERMINO").val(),
              IMB_CTR_VALORALUGUEL : realToDolar($("#IMB_CTR_VALORALUGUEL").val()),
              IMB_CTR_TOLERANCIA : $("#IMB_CTR_TOLERANCIA").val(),
              IMB_CTR_PRIMEIROVENCIMENTO :$("#IMB_CTR_PRIMEIROVENCIMENTO").val(),
              IMB_CTR_DATALOCACAO : $("#IMB_CTR_DATALOCACAO").val(),
              IMB_CTR_DATAREAJUSTE : $("#IMB_CTR_DATAREAJUSTE").val(),
              IMB_CTR_MULTA : realToDolar( $("#IMB_CTR_MULTA").val() ),
              IMB_CTR_DURACAO : $("#IMB_CTR_DURACAO").val(),
              IMB_CTR_DIAVENCIMENTO : $("#IMB_CTR_DIAVENCIMENTO").val(),
              IMB_CTR_DESCONTO : realToDolar( $("#IMB_CTR_DESCONTO").val()),
              IMB_CTR_DESCONTOMESES : $("#IMB_CTR_DESCONTOMESES").val(),
              IMB_CTR_CONTRATOPARCELAS : $("#IMB_CTR_CONTRATOPARCELAS").val(),
              IMB_CTR_CONTRATOVALOR : realToDolar( $("#IMB_CTR_CONTRATOVALOR").val()),
              IMB_CTR_CONTRATOVENPAR1 :  $("#IMB_CTR_CONTRATOVENPAR1").val(),
              IMB_CTR_CONTRATOVENPAR2 :  $("#IMB_CTR_CONTRATOVENPAR2").val(),
              IMB_CTR_CONTRATOVENPAR3 :  $("#IMB_CTR_CONTRATOVENPAR3").val(),
              IMB_CTR_CONTRATOVENPAR4 :  $("#IMB_CTR_CONTRATOVENPAR4").val(),
              IMB_CTR_CONTRATOVALPAR1 : realToDolar($("#IMB_CTR_CONTRATOVALPAR1").val()),
              IMB_CTR_CONTRATOVALPAR2 : realToDolar($("#IMB_CTR_CONTRATOVALPAR2").val()),
              IMB_CTR_CONTRATOVALPAR3 : realToDolar($("#IMB_CTR_CONTRATOVALPAR3").val()),
              IMB_CTR_CONTRATOVALPAR4 : realToDolar($("#IMB_CTR_CONTRATOVALPAR4").val()),
              IMB_CTR_COBTAXAADM1 : $("#IMB_CTR_COBTAXAADM1").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_COBTAXAADM2 : $("#IMB_CTR_COBTAXAADM2").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_COBTAXAADM3 : $("#IMB_CTR_COBTAXAADM3").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_COBTAXAADM4 : $("#IMB_CTR_COBTAXAADM4").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_SITUACAO : 'ATIVO',
              IMB_CTR_FINALIDADE : $("#IMB_CTR_FINALIDADE").val(),
              IMB_IRJ_ID : $("#IMB_IRJ_ID").val(),
              IMB_CTR_FORMAREAJUSTE : $("#IMB_CTR_FORMAREAJUSTE").val(),
              IMB_CTR_BONIFICACAOTIPO : $("#IMB_CTR_BONIFICACAOTIPO").val(),
              IMB_IMV_ID : $("#IMB_IMV_ID").val(),
              IMB_CTR_TAXAADMINISTRATIVA : realToDolar($("#IMB_CTR_TAXAADMINISTRATIVA").val()),
              IMB_CTR_TAXAADMINISTRATIVAFORMA : $("#IMB_CTR_TAXAADMINISTRATIVAFORMA").val(),
              IMB_CTR_VENCIMENTOLOCADOR :  $("#IMB_CTR_PRIMEIROVENCIMENTO").val(),
              IMB_CTR_VENCIMENTOLOCATARIO : $("#IMB_CTR_PRIMEIROVENCIMENTO").val(),
              IMB_CTR_REPASSEDIA : $("#IMB_CTR_REPASSEDIA").val(),
              IMB_FORPAG_ID_LOCATARIO : $("#IMB_FORPAG_ID_LOCATARIO").val(),
              IMB_CTR_EXIGENCIA : $("#IMB_CTR_EXIGENCIA").val(),
              IMB_CTR_COBRARBOLETO : $("#IMB_CTR_COBRARBOLETO").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_ALUGUELGARANTIDO : $("#IMB_CTR_ALUGUELGARANTIDO").prop( "checked" )   ? 'S' : 'N',
              FIN_CCR_ID_COBRANCA : $("#FIN_CCR_ID_COBRANCA").val(),
              IMB_CTR_COBRANCAVALOR : realToDolar($("#IMB_CTR_COBRANCAVALOR").val()),
              IMB_CTR_IPTUINCLUSO : $("#IMB_CTR_IPTUINCLUSO").prop( "checked" )   ? 'S' : 'N',
              IMB_ATD_ID : $("#I-IMB_ATD_ID").val(),
              IMB_CTR_FINALIDADEDESCRICAO : $("#IMB_CTR_FINALIDADEDESCRICAO").val(),
              IMB_IMB_ID2 : $("#I-IMB_IMB_IDMASTER").val(),
              IMB_CTR_REFERENCIA : sequencia,
              IMB_CTR_JUROSDIARIO : realToDolar($("#IMB_CTR_JUROSDIARIO").val()),
              IMB_CTR_PERMANDIARIA : realToDolar($("#IMB_CTR_PERMANDIARIA").val()),
              IMB_CTR_PINTURANOVA : $("#IMB_CTR_PINTURANOVA").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_BOLETOVIAEMAIL : $("#IMB_CTR_BOLETOVIAEMAIL").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_PARCELALT : 1,
              IMB_CTR_PARCELALD : 1,
              IMB_CTR_MAIORINDICE : $("#IMB_CTR_MAIORINDICE").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_PONTUALIDADEVALIDADE : $("#IMB_CTR_PONTUALIDADEVALIDADE").val(),
              IMB_CTR_CLAUSULA12MESES : $("#IMB_CTR_CLAUSULA12MESES").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_TOLERANCIAFATOR : $("#IMB_CTR_TOLERANCIAFATOR").val(),
              IMB_CTR_VALORPRIMVEN : realToDolar($("#IMB_CTR_VALORPRIMVEN").val()),
              IMB_CTR_VALORCOND : realToDolar($("#IMB_CTR_VALORCOND").val()),
              IMB_CTR_SEGUROVALOR : realToDolar($("#IMB_CTR_SEGUROVALOR").val()),
              IMB_CTR_BONIF_NAOINC_TA : $("#IMB_CTR_BONIF_NAOINC_TA").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_CORRETAGEMPERC : realToDolar($("#IMB_CTR_CORRETAGEMPERC").val()),
              IMB_CTR_CAPTAPERC : realToDolar($("#IMB_CTR_CAPTAPERC").val()),
              imb_ctr_seguroparcelas : $("#imb_ctr_seguroparcelas").val(),
              IMB_CTR_VALORBONIFICACAO4 : realToDolar($("#IMB_CTR_VALORBONIFICACAO4").val()),
              IMB_CTR_FCI : $("#IMB_CTR_FCI").prop( "checked" )   ? 'S' : 'N',
              IMB_SGR_ID : $("#IMB_SGR_ID").val(),
              IMB_CTR_IPTUVALOR : realToDolar($("#IMB_CTR_IPTUVALOR").val()),
              IMB_CTR_IPTULOCADOR : $("#IMB_CTR_IPTULOCADOR").val(),
              IMB_CTR_IPTULOCATARIO : $("#IMB_CTR_IPTULOCATARIO").val(),
              IMB_CTR_IPTUQTDEPARCLAS : $("#IMB_CTR_IPTUQTDEPARCLAS").val(),
              IMB_CTR_DIASACERTO : $("#IMB_CTR_DIASACERTO").val(),
              IMB_CTR_DIASVALOR : realToDolar($("#IMB_CTR_DIASVALOR").val()),
              IMB_IMV_ALUGUELAGREGAR: realToDolar($("#IMB_IMV_ALUGUELAGREGAR").val()),
              IMB_IMV_AGREGADOLDCREDEB: $("#IMB_IMV_AGREGADOLDCREDEB").val(),
              IMB_IMV_AGREGADOLTCREDEB: $("#IMB_IMV_AGREGADOLTCREDEB").val(),

              IMB_IMV_RELIRRF: $("#IMB_IMV_RELIRRF").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_IRRF: $("#IMB_CTR_IRRF").prop( "checked" )   ? 'S' : 'N',
              imb_ctr_naoemitirnfe: $("#imb_ctr_naoemitirnfe").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_CALISS: $("#IMB_CTR_CALISS").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_BOLETOVIAEMAIL: $("#IMB_CTR_BOLETOVIAEMAIL").prop( "checked" )   ? 'S' : 'N',
              IMB_CTR_EMAIL: $("#IMB_CTR_EMAIL").val(),


                            
          };

          $.ajaxSetup
        ({
          headers:
          {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
          }
        });

          url = "{{route('contrato.gravarnovo')}}";
        
          console.log( contrato );
          $.ajax(
          {
            url : url,
            dataType:'json',
            data : contrato,
            type : 'post',
            async : false,
            success: function( data )
            {
              debugger;
              gravarLancamentos( data  );
              debugger;
              gravarLocatarios( data  );
              debugger;
              gravarFiadores( data  );
              gravarCorCtr( data  );
              //salvarCapCtrBD( data  );

              alert( 'Contrato Gerado!!!!');

              window.location="{{route('contrato.index')}}";

            },
            error : function()
            {
              alert('erro');
            }

          });
        }
      });
      $("#modalprocessando").modal('hide');



    }

    function gravarLancamentos( nIdcontrato )
    {

      var locadorcredeb = '';
      var locatariocredeb = '';
      var table = document.getElementById('tblparcelas');
      $("#modalprocessando").modal('show');

      aLF = [];

      debugger;
      for (var r = 1, n = table.rows.length; r < n; r++)
      {
        $.ajaxSetup
        ({
          headers:
          {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
          }
        });

        locadorcredeb =  table.rows[r].cells[3].innerHTML;
        locadorcredeb = locadorcredeb.substring(0,1);
        locatariocredeb =  table.rows[r].cells[4].innerHTML;
        locatariocredeb = locatariocredeb.substring(0,1);
        dataven = table.rows[r].cells[5].innerHTML;
        cobrarta = table.rows[r].cells[8].innerHTML;
        incta = table.rows[r].cells[11].innerHTML;

        var difdias = realToDolar( $("#IMB_CTR_DIASVALOR").val() );
        var obser = table.rows[r].cells[7].innerHTML;
        if(  moment( $("#IMB_CTR_PRIMEIROVENCIMENTO").val() ).format( 'DD/MM/YYYY') == dataven && table.rows[r].cells[1].innerHTML == 1 )
        {
          if( parseFloat(difdias) != 0 )
          {
            obser = 'Aluguel com a diferença de dias';

          }

        }


        console.log('criando vetor');
        console.log('reaustsar: '+table.rows[r].cells[10].innerHTML);
        lf =
        {
          IMB_IMV_ID                : $("#IMB_IMV_ID").val(),
          IMB_CTR_ID                : nIdcontrato,
          IMB_LCF_VALOR             : realToDolar(table.rows[r].cells[6].innerHTML),
          IMB_LCF_LOCADORCREDEB     : locadorcredeb,
          IMB_LCF_LOCATARIOCREDEB   : locatariocredeb,
          IMB_LCF_DATAVENCIMENTO    : dataven,
          IMB_LCF_TIPO              : 'M',
          IMB_TBE_ID                : table.rows[r].cells[1].innerHTML,
          IMB_LCF_OBSERVACAO        : obser,
          IMB_LCF_COBRARTAXADMMES   : table.rows[r].cells[8].innerHTML,
          IMB_CLT_ID                : $("#IMB_CLT_ID").val(),
          IMB_CLT_IDLOCADOR         : 0,
          IMB_LCF_NUMEROCONTROLE    : table.rows[r].cells[9].innerHTML,
          IMB_LCF_NUMPARREAJUSTE    : table.rows[r].cells[9].innerHTML,
          IMB_LCF_NUMPARCONTRATO    : table.rows[r].cells[9].innerHTML,
          IMB_LCF_CHAVE             : table.rows[r].cells[9].innerHTML,
          IMB_LCF_REAJUSTAR         : table.rows[r].cells[10].innerHTML,
          IMB_LCF_INCIRRF           : '',
          IMB_LCF_INCTAX            : table.rows[r].cells[11].innerHTML,
          IMB_LCF_INCMUL            : '',
          IMB_LCF_INCJUROS          : '',
          IMB_LCF_INCCORRECAO       : '',
          IMB_LCF_INCISS            : '',
          IMB_LCF_FIXO              : 'N',
          IMB_LCF_GARANTIDO         : 'X',
          IMB_LCF_COBRARTAXADMMES    : table.rows[r].cells[8].innerHTML,
          
          CONTRATONOVO              :   'S',

        };
        aLF.push( lf );
      }
        console.log('vetor lf criado');
        console.log( lf );

        var url = "{{ route('lancamento.gravararray')}}";

        $.ajax(
        {
          url:url,
          type:'post',
          datatype:'json',
          async:false,
          data: { lfs : aLF },
          success:function( )
          {

          },
          error: function()
          {
            alert('Erro na gravação do LF');
          }
        });

      
    }

    function gravarLocatarios( idContrato)
    {
      $("#modalprocessando").modal('show');
      var table = document.getElementById('tbllocatarios');

      for (var r = 1, n = table.rows.length; r < n; r++)
      {
        $.ajaxSetup
        ({
          headers:
          {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
          }
        });

        lf =
        {
          IMB_CTR_ID                : idContrato,
          IMB_CLT_ID                : table.rows[r].cells[0].innerHTML,
          IMB_LCTCTR_PRINCIPAL      : table.rows[r].cells[2].innerHTML,
          IMB_IMB_ID                : $("#I-IMB_IMB_IDMASTER").val(),
        };

        var url = "{{ route('locatariocontrato.store')}}";

        $.ajax(
        {
          url:url,
          type:'post',
          datatype:'json',
          async:false,
          data: lf,
          success:function()
          {

          },
          error: function()
          {
            alert('Erro na gravação do LF');
          }
        });

      }

    }


    function gravarFiadores( idContrato)
    {
      var table = document.getElementById('tblfiadores');

      for (var r = 1, n = table.rows.length; r < n; r++)
      {
        $.ajaxSetup
        ({
          headers:
          {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
          }
        });

        lf =
        {
          IMB_CTR_ID                : idContrato,
          IMB_CLT_ID                : table.rows[r].cells[0].innerHTML,
        };

        var url = "{{ route('fiadorcontrato.store')}}";

        $.ajax(
        {
          url:url,
          type:'post',
          datatype:'json',
          async:false,
          data: lf,
          success:function( )
          {
                  alert('gravado');

          },
          error: function()
          {
            alert('Erro na gravação do LF');
          }
        });

      }

    }


    function consistirLocatario()
    {
      var table = document.getElementById('tbllocatarios');

      var nCont = 0;
      for (var r = 1, n = table.rows.length; r < n; r++)
      {
        if( table.rows[r].cells[2].innerHTML == 'Principal')
           nCont++;

      }

      if( nCont == 0 )
        alert( 'Informe pelo menos um locatário como locatário principal!');

      if( nCont > 1 )
        alert( 'Informe somente um locatário como locatário principal!');

      if ( nCont == 1 )
        return true
      else
        return false;

    }


    function cargaFormaRecebimento()
    {

      $.getJSON( "{{ route('formapagamento.carga')}}", function( data )
            {

                $("#IMB_FORPAG_ID_LOCATARIO").empty();

                linha =  '<option value="-1">Forma Pagamento</option>';
                $("#IMB_FORPAG_ID_LOCATARIO").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].IMB_FORPAG_ID+'">'+
                        data[nI].IMB_FORPAG_NOME+"</option>";
                        $("#IMB_FORPAG_ID_LOCATARIO").append( linha );

                }

            });

    }

    function cargaContaCobranca()
    {

      $.getJSON( "{{ route('contacaixa.carga')}}/S", function( data )
            {

                $("#FIN_CCR_ID_COBRANCA").empty();

                linha =  '<option value="-1">Selecione</option>';
                $("#FIN_CCR_ID_COBRANCA").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].FIN_CCX_ID+'">'+
                        data[nI].FIN_CCX_DESCRICAO+"</option>";
                        $("#FIN_CCR_ID_COBRANCA").append( linha );

                }

            });

    }


    function cargaBancos()
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
                        $("#GER_BNC_NUMERO").append( linha );

                }

            });


    }

    function salvarCapImoBD( id )
    {
        var table = document.getElementById('tbcapimo-contrato');
        for (var r = 1, n = table.rows.length; r < n; r++)
        {

            $.ajaxSetup(
            {
                headers:
                {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });

            corimo =
            {
                IMB_ATD_ID : table.rows[r].cells[0].innerHTML,
                IMB_CAPIMO_PERCENTUAL : table.rows[r].cells[2].innerHTML,
                IMB_IMB_ID : $("#IMB_IMB_ID2").val(),
                IMB_CTR_ID : id,
            };

            if( table.rows[r].cells[2].innerHTML != null )
            {

                          
              var url = "{{ route('capctr.salvar')}}";

              $.ajax(
              {
                  url:url,
                  type:'post',
                  datatype:'json',
                  async:false,
                  data: corimo,
                  success:function( data)
                  {
                  },
                  error: function()
                  {
                      alert('Erro na gravação do captador no CONTRATO '+
                      table.rows[r].cells[1].innerHTML);

                  }
              });
            }

        }
    }

    function pegarParametros()
    {
        var url = "{{ route('parametros1') }}";

        id = "{{Auth::user()->IMB_IMB_ID}}";

        $.ajaxSetup({
            headers:    
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });        


        $.ajax( 
            {
                url     : url,
                dataType: 'json',
                type    : 'get',
                data    : { id : id },
                success : function( data )
                {


                    $("#IMB_FORPAG_ID_LOCATARIO").val( data.IMB_FORPAG_ID_LOCATARIO);
                    $("#FIN_CCR_ID_COBRANCA").val( data.FIN_CCR_ID_COBRANCA);
                    
                },
                error:function()
                {
                    alert( 'Erro');
                }
            }
        )
  
    }
    function apagarLinha( linha )
    {

        if (confirm("Tem certeza que deseja excluir?"))
        {

          var textoid = '#'+linha;
          $( textoid ).remove();

        }

    }

    function gravarCorCtr( id )
    {
        var table = document.getElementById('tbcorctr');
        for (var r = 1, n = table.rows.length; r < n; r++)
        {

            $.ajaxSetup(
            {
                headers:
                {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });

            corimo =
            {
                IMB_ATD_ID : table.rows[r].cells[0].innerHTML,
                IMB_CORIMO_PERCENTUAL : realToDolar(table.rows[r].cells[2].innerHTML),
                IMB_CORCTR_ID : '',
                IMB_IMB_ID : $("#IMB_IMB_ID2").val(),
                IMB_CTR_ID : id
                
            };
          
            if( table.rows[r].cells[2].innerHTML != null )
            {

            var url = "{{ route('corctr.salvar')}}";

              $.ajax(
              {
                  url:url,
                  type:'post',
                  datatype:'json',
                  async:false,
                  data: corimo,
                  success:function( data)
                  {
                  },
                  error: function( erro)
                  {
                      alert('Erro na gravação do corretor no imovel '+
                      table.rows[r].cells[1].innerHTML+' - erro:'+erro);

                  }
              });

            }
        }
    }

    function calcularTaxaContrato()
    {
      var percentual = realToDolar($("#IMB_CTR_CONTRATOVALOR").val());
      if( percentual > 100 )
      {
        alert('Percentual não pode ser maior que 100');
        return false;
      }

      var valoraluguel = realToDolar($("#IMB_CTR_VALORALUGUEL").val());
      var valoraluguel = realToDolar($("#IMB_CTR_VALORALUGUEL").val());
      var valortaxa =  valoraluguel * percentual / 100;
      $("#IMB_CTR_CONTRATOVALOR").val( valortaxa );
    }

</script>



@endpush
