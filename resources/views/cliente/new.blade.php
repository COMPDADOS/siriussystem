@extends('layout.app')

@section('layout.scripttop')
<style>
    .footer {
  position: fixed;
  bottom: 0;
  width: 95%;
  height: 50px;
  background:#e0ebeb;
}

.div-center
{
  text-align:center;
}

.sem-margem
{
    padding-right: 2px;
    padding-left: 2px;}
</style>

@section('content')


<!-- BEGIN CONTENT -->
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <a href="/">Home</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <span>Lista de Clientes</span>
    </li>
  </ul>

</div>

<div class="row">
  <div class="col-md-12">
    <div class="tabbable-line boxless tabbable-reversed">
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <form>
            <input type="hidden" id="i-numero-cliente" name="IMB_CLT_CODIGO">
            <div class="portlet box blue">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>Dados do Cliente
                </div>
                <div class="tools">
                  <a href="javascript:;" class="collapse"> </a>
                </div>
              </div>

              <div class="portlet-body form">
                <div class="form-body">

                  <div class="row">

                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label" >Nome</label>
                        <input type="text" maxlength="40" name="IMB_CLT_NOME"
                            class="form-control bot-click" id="IMB_CLT_NOME"
                                        placeholder="Nome completo"
                                        autocomplete="off"
                                        style="font-family: Tahoma; font-size: 16px"
                                        required >
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Pessoa</label>
                        <select name="CIMB_CLT_PESSOA"
                          class="form-control" id="IMB_CLT_PESSOA">
                          <option value="F">Física
                          </option>
                          <option value="J">Jurídica
                          </option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3" id="i-div-estado-civil">
                      <div class="form-group">
                        <label class="control-label">Estado Civil</label>
                        <select name="CIMB_CLT_ESTADOCIVIL" class="form-control" id="IMB_CLT_ESTADOCIVIL">
                          <option value="S">Solteiro
                          </option>

                          <option value="C">Casado
                          </option>

                          <option value="U">União Estável
                          </option>

                          <option value="I">Divorciado
                          </option>

                          <option value="V">Viúvo
                          </option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-1"  id="i-div-sexo">
                      <div class="form-group">
                        <label class="control-label">Sexo</label>
                        <select name="CIMB_CLT_SEXO" class="form-control"
                        id="IMB_CLT_SEXO">
                          <option value="M">Masculino
                          </option>

                          <option value="F">Feminino
                          </option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label" id="i-lab-cpf">CPF/CNPJ</label>
                        <input name="CIMB_CLT_CPF" id = "IMB_CLT_CPF"
                                    onkeydown="fMasc( this, mCNPJ )"
                                    type="text" class="form-control bot-click"  placeholder="Somente números"
                                    style="font-family: Tahoma; font-size: 16px"
                                    required
                                    autocomplete="off">
                                  <p id="cpfresponse"></p>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">RG/Insc. Estadual</label>
                        <input name="CIMB_CLT_RG" maxlength="20" type="text" class="form-control"
                                      placeholder="Preencher ./-"
                                      id="IMB_CLT_RG"
                                      style="font-family: Tahoma; font-size: 16px" autocomplete="off">
                      </div>
                    </div>

                    <div class="col-md-2" id="i-div-orgao">
                      <div class="form-group" >
                        <label class="control-label">UF</label>
                        <select class="form-control" id="CIMB_CLT_RGORGAO">
                              <option value="AC">Acre</option>
                              <option value="AL">Alagoas</option>
                              <option value="AP">Amapá</option>
                              <option value="AM">Amazonas</option>
                              <option value="BA">Bahia</option>
                              <option value="CE">Ceará</option>
                              <option value="DF">Distrito Federal</option>
                              <option value="ES">Espírito Santo</option>
                              <option value="GO">Goiás</option>
                              <option value="MA">Maranhão</option>
                              <option value="MT">Mato Grosso</option>
                              <option value="MS">Mato Grosso do Sul</option>
                              <option value="MG">Minas Gerais</option>
                              <option value="PA">Pará</option>
                              <option value="PB">Paraíba</option>
                              <option value="PR">Paraná</option>
                              <option value="PE">Pernambuco</option>
                              <option value="PI">Piauí</option>
                              <option value="RJ">Rio de Janeiro</option>
                              <option value="RN">Rio Grande do Norte</option>
                              <option value="RS">Rio Grande do Sul</option>
                              <option value="RO">Rondônia</option>
                              <option value="RR">Roraima</option>
                              <option value="SC">Santa Catarina</option>
                              <option value="SP">São Paulo</option>
                              <option value="SE">Sergipe</option>
                              <option value="TO">Tocantins</option>
                              <option value="EX">Estrangeiro</option>
                          </select>
                      </div>
                    </div>

                    <div class='col-md-2'  id="i-div-data-nascimento">
                      <div class="form-group">
                        <label class="control-label" id="i-lbl-datanasc">Data Nascimento</label>
                          <input type='date'  class="form-control" name="CIMB_CLT_DATNAS"
                          id="IMB_CLT_DATNAS">
                      </div>
                    </div>

                    <div class='col-md-2' id="i-div-nacionalidade">
                      <div class="form-group" >
                        <label class="control-label">Nacionalidade</label>
                        <input maxlength="15" type='text'  class="form-control" name="CIMB_CLT_NACIONALIDADE"
                        value="BRASILEIRA" id="IMB_CLT_NACIONALIDADE">
                      </div>
                    </div>

                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Endereço</label>
                        <input maxlength="40" name="CIMB_CLT_RESEND"
                                    type="text" id="IMB_CLT_RESEND" class="form-control" autocomplete="off">
                      </div>
                    </div>

                    <div class="col-md-1">
                      <div class="form-group">
                        <label>Número</label>
                        <input maxlength="10" name="CIMB_CLT_RESENDNUM"
                                    id="IMB_CLT_RESENDNUM"
                                    type="text" class="form-control" autocomplete="off">
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Complemento</label>
                        <input maxlength="20" name="CIMB_CLT_RESENDCOM"
                              id="IMB_CLT_RESENDCOM"
                                    type="text" class="form-control" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Cep</label>
                        <input maxlength="8" name="IMB_CLT_RESENDCEP"
                                        type="text" id="IMB_CLT_RESENDCEP" class="form-control" autocomplete="off"
                                        onkeypress="return isNumber(event)" onpaste="return false;"/>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Bairro</label>
                        <input maxlength="20" name="CCEP_BAI_NOMERES"
                                      id="CEP_BAI_NOMERES"
                                        type="text" class="form-control" autocomplete="off">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Cidade</label>
                        <input maxlength="20" name="CCEP_CID_NOMERES"
                                      type="text" id="CEP_CID_NOMERES"   class="form-control" autocomplete="off">
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label>UF</label>
                        <select class="form-control" id="CEP_UF_SIGLARES" >
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                          <option value="AP">Amapá</option>
                          <option value="AM">Amazonas</option>
                          <option value="BA">Bahia</option>
                          <option value="CE">Ceará</option>
                          <option value="DF">Distrito Federal</option>
                          <option value="ES">Espírito Santo</option>
                          <option value="GO">Goiás</option>
                          <option value="MA">Maranhão</option>
                          <option value="MT">Mato Grosso</option>
                          <option value="MS">Mato Grosso do Sul</option>
                          <option value="MG">Minas Gerais</option>
                          <option value="PA">Pará</option>
                          <option value="PB">Paraíba</option>
                          <option value="PR">Paraná</option>
                          <option value="PE">Pernambuco</option>
                          <option value="PI">Piauí</option>
                          <option value="RJ">Rio de Janeiro</option>
                          <option value="RN">Rio Grande do Norte</option>
                          <option value="RS">Rio Grande do Sul</option>
                          <option value="RO">Rondônia</option>
                          <option value="RR">Roraima</option>
                          <option value="SC">Santa Catarina</option>
                          <option value="SP">São Paulo</option>
                          <option value="SE">Sergipe</option>
                          <option value="TO">Tocantins</option>
                          <option value="EX">Estrangeiro</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Local de trabalho</label>
                        <input maxlength="40" id="IMB_CLT_COMCOM" name="CIMB_CLT_COMCOM"
                        type="text" class="form-control" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Profissão</label>
                        <input maxlength="20" name="CIMB_CLT_PROFISSAO"
                        id="IMB_CLT_PROFISSAO" type="text"  class="form-control" autocomplete="off">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-md-3">
                        <h5 class="div-center">Telefone (I)</h5>
                        <div class="col-md-3 ">
                          <input title="DDI" type="text" class="form-control " id="i-ddi1"  placeholder="DDI" value="55">
                        </div>
                        <div class="col-md-3 ">
                          <input title="DDD" type="text" class="form-control" id="i-ddd1"  placeholder="DDD" >
                        </div>
                        <div class="col-md-6">
                          <input title="Informe somente números" type="text" class="form-control telefone" id="i-telefone1"  >
                        </div>
                        <div class="col-md-12">
                          <input title="Escreva o que melhor identifique este número" type="text" class="form-control" id="i-telefone1-tipo" maxlength="40"
                            placeholder="Whatsapp, com., res., etc...">

                        </div>
                      </div>

                      <div class="col-md-3">
                        <h5 class="div-center">Telefone (II)</h5>
                        <div class="col-md-3 ">
                          <input title="DDI" type="text" class="form-control " id="i-ddi2"   value="55" placeholder="DDI">
                        </div>
                        <div class="col-md-3 ">
                          <input title="DDD" type="text" class="form-control" id="i-ddd2"  placeholder="DDD">
                        </div>
                        <div class="col-md-6">
                          <input title="Informe somente números" type="text" class="form-control telefone" id="i-telefone2"  >
                        </div>
                        <div class="col-md-12">
                          <input title="Escreva o que melhor identifique este número" type="text" class="form-control" id="i-telefone2-tipo" maxlength="40"
                            placeholder="Whatsapp, com., res., etc...">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <h5 class="div-center">Telefone (III)</h5>
                        <div class="col-md-3 ">
                          <input title="DDI" type="text" class="form-control " id="i-ddi3"   value="55" placeholder="DDI">
                        </div>
                        <div class="col-md-3 ">
                          <input title="DDD" type="text" class="form-control" id="i-ddd3"  placeholder="DDD">
                        </div>
                        <div class="col-md-6">
                          <input title="Informe somente números" type="text" class="form-control telefone" id="i-telefone3"  >
                        </div>
                        <div class="col-md-12">
                          <input title="Escreva o que melhor identifique este número" type="text" class="form-control" id="i-telefone3-tipo" maxlength="40"
                            placeholder="Whatsapp, com., res., etc...">

                        </div>
                      </div>

                      <div class="col-md-3">
                        <h5 class="div-center">Telefone (IV)</h5>
                        <div class="col-md-3 ">
                          <input title="DDI" type="text" class="form-control " id="i-ddi4"    value="55" placeholder="DDI">
                        </div>
                        <div class="col-md-3 ">
                          <input title="DDD" type="text" class="form-control" id="i-ddd4"  placeholder="DDD">
                        </div>
                        <div class="col-md-6">
                          <input title="Informe somente números" type="text" class="form-control telefone" id="i-telefone4"  >
                        </div>
                        <div class="col-md-12">
                          <input title="Escreva o que melhor identifique este número" type="text" class="form-control" id="i-telefone4-tipo" maxlength="40"
                            placeholder="Whatsapp, com., res., etc...">
                        </div>
                      </div>


<!--                        <div class="col-md-2">
                          <label class="control-label">Telefone (V)</label>
                          <input type="text" class="form-control telefone  input-8" id="i-telefone5" >
                          <label class="control-label">Tipo</label>
                          <input type="text" class="form-control" id="i-telefone5-tipo" maxlength="40"
                            placeholder="Whatsapp, com., res., etc...">
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Telefone (VI)</label>
                          <input type="text" class="form-control telefone  input-8" id="i-telefone6">
                          <label class="control-label">Tipo</label>
                          <input type="text" class="form-control" id="i-telefone6-tipo" maxlength="40"
                            placeholder="Whatsapp, com., res., etc...">
                        </div>
-->

                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="input-group">
                        <span class="input-group-addon input-circle-left">
                          <i class="fa fa-envelope"></i>
                        </span>
                        <input maxlength="100" name="CIMB_CLT_EMAIL" type="email"
                                    id="IMB_CLT_EMAIL"
                                    class="form-control input-circle-right"
                                    placeholder="Endereço de Email" autocomplete="off" required>
                      </div>
                    </div>
                  </div>
               </div><!--< FIM div class="form-body">-->
              </div> <!-- FIM <div class="portlet-body form">-->
            </div> <!-- fim quadro <div class="portlet box blue">-->
            <div class="portlet box blue" >
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i> Corretor(es) para Este Cliente
                </div>

                <div class="tools">
                  <a href="javascript:;" class="collapse"> </a>
                </div>
              </div>

              <div class="portlet-body form">
                <div class="form-body" >
                  <div class="row">
                    <table  id="tbcluusu" class="table table-striped table-bordered table-hover" >
                      <thead class="thead-dark">
                        <tr>
                          <th width="50" style="text-align:center"> Ações </th>
                          <th class="div-center"> ID </th>
                          <th class="div-center"> Corretor </th>
                          <th class="div-center"> Atendido como </th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                    </div>
                    <div class="table-footer" >
                      <a  class="btn btn-sm btn-primary"
                      role="button" onClick="adicionarCliUsu()" >
                      Adicionar Corretor </a>
                                <!--data-toggle="modal" data-target="#modalFormaPagamento"-->
                  </div> <!-- row -->
                </div><!-- end form-body-->
              </div> <!--FIM Portlet-body form">-->
            </div> <!-- fimquadro -->



            <div class="portlet box blue" >
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i> Dados do Conjuge
                </div>

                <div class="tools">
                  <a href="javascript:;" class="collapse"> </a>
                </div>
              </div>

              <div class="portlet-body form">
                <div class="form-body" id="i-div-conjuge">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Nome</label>
                          <input maxlength="40" id="IMB_CLTCJG_NOME"
                          name="CIMB_CLTCJG_NOME" type="text" class="form-control" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">CPF</label>
                        <input maxlength="14" name="CIMB_CLTCJG_CPF" type="text" id="IMB_CLTCJG_CPF"
                                    onkeydown="fMasc( this, mCPF )"
                                    class="form-control" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">RG</label>
                        <input  maxlength="15"  id="IMB_CLTCJG_RG"  name="CIMB_CLTCJG_RG" type="text" class="form-control" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-md-1">
                      <div class="form-group">
                        <label class="control-label">Orgão</label>
                        <input maxlength="5"  id="IMB_CLTCJG_RGORGAO" name="CIMB_CLTCJG_RGORGAO" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-1">
                      <div class="form-group">
                        <label class="control-label">UF</label>
                        <input  maxlength="2" id="IMB_CLTCJG_RGESTADO"  name="CIMB_CLTCJG_RGESTADO" type="text" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Nacionalidade</label>
                        <input  maxlength="15" name="CIMB_CLTCJG_NACIONALIDADE" id="IMB_CLTCJG_NACIONALIDADE"
                                    type="text" class="form-control">
                      </div>
                    </div>
                  </div> <!-- row -->
                  <div class="row">
                    <div class='col-md-3'>
                      <div class="form-group">
                        <label class="control-label">Data Nascimento</label>
                        <input type='date' id="IMB_CLTCJG_DATANASCIMENTO" class="form-control"
                                    name="CIMB_CLTCJG_DATANASCIMENTO">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Sexo</label>
                        <select id="IMB_CLTCJG_SEXO"  name="CIMB_CLTCJG_SEXO" class="form-control">
                          <option value="M">Masculino
                          </option>
                          <option value="F">Feminino
                          </option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Profissão</label>
                        <input maxlength="20" id="IMB_CLTCJG_PROFISSAO" name="CIMB_CLTCJG_PROFISSAO"
                                    type="text" class="form-control" autocomplete="off">
                      </div>
                    </div>
                  </div> <!-- row -->


                </div><!-- end form-body-->
              </div> <!--FIM Portlet-body form">-->
            </div> <!-- fimquadro -->

            <div class="portlet box blue" >
              <div class="portlet-body form">
                <div class="form-body">
                  <table  id="i-table-representantes" class="table table-striped table-bordered table-hover" >
                    <thead class="thead-dark">
                      <tr>
                        <th width="600" style="text-align:center"> Código </th>
                        <th width="600" style="text-align:center"> Nome do Representante </th>
                        <th width="200" style="text-align:center"> Ações </th>
                      </tr>
                    </thead>
                    <tbody>
                      </tbody>
                  </table>

                  <div class="table-footer" >
                    <div class="table-footer" >
                                <a  class="btn btn-sm btn-primary"
                                role="button" onClick="modalRepresentante()" >
                                Adicionar Representante </a>
                                <!--data-toggle="modal" data-target="#modalFormaPagamento"-->
                    </div>
                  </div>
                </div><!-- end form-body-->
              <div> <!--FIM Portlet-body form">-->
            </div>

            <div class="portlet box blue">
              <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Observações Diversas / Observações de Negociação
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
                          <label class="control-label">Descreva a Observação</label>
                          <textarea class="form-control" rows="3"
                          id="IMB_CLT_OBSERVACAO"name="IMB_CLT_OBSERVACAO"></textarea>
                      </div>
                    </div>
                  </div>

                </div><!-- end form-body-->
              </div><!--FIM Portlet-body form">-->
            <div>

            <div class="portlet box red">
              <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Informações Imóvel do Fiador Deixado como Garantia
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
                          <label class="control-label">Descreva as informações referentes ao imóvel( poderão aparecer no contrato)</label>
                          <textarea class="form-control" rows="3"
                          id="IMB_CLT_IMOVELGARANTIA"name="IMB_CLT_IMOVELGARANTIA"></textarea>
                      </div>
                    </div>
                  </div>

                </div><!-- end form-body-->
              </div><!--FIM Portlet-body form">-->
            <div>


            <div class="portlet box blue">
              <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Arquivos Anexos
                </div>

                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                </div>
              </div>

              <div class="portlet-body form">
                <div class="form-body">
                  <div class="row">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tblanexos">
                      <thead>
                        <tr>
                          <th align="center" width="200"> Arquivo </th>
                          <th >Descrição</th>
                          <th width="100"> </th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>

                  <div class="row">
                    <div class="col-md-8">
                      <button type="submit" name="enviar"
                            formaction="uploadcliente/index.php?ncliente=$nclientepesquisa">Anexar Arquivos
                      </button>
                    </div>
                  </div>
                </div><!-- end form-body-->
              </div> <!--FIM Portlet-body form">-->
            </div>
          </form>
          <div class="row">
            <div class="col-md-12 div-center">
              <div class="footer div-center">
                    <button type="button" class="btn default botao-confirmacao " id="i-btn-cancelar" onClick="history.go(-1);">Cancelar</button>
                    <button type="button" class="btn blue botao-confirmacao" onClick="onGravar()" id="i-btn-gravar">
                      <i class="fa fa-check"></i> Gravar
                    </button>
              </div>
            </div>
          </div>
        </div> <!--class="tab-pane active" id="tab_1">-->
      </div><!--class="tab-content">-->
    </div><!--class="tabbable-line boxless tabbable-reversed">-->
  </div> <!--<div class="col-md-12">-->
</div> <!-- fim row unica -->

<div class="modal" tabindex="-1" role="dialog" id="modalcliusu">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i>Corretor que Atende o Cliente
            </div>
            <div class="tools">
              <a href="javascript:;" class="collapse"> </a>
            </div>
          </div>

          <div class="portlet-body form">
            <div class="form-body" >
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                  <label>Corretor</label>
                    <select class="form-control" id="i-select-corretor">
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Atendendo como</label>
                    <select  class="form-control" id="i-select-tipocliente">
                      <option value="Interessado">Interessado</option>
                      <option value="Interessado">Proprietário</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" onClick="adicionarTabCliUsu()">Adicionar</button>
      </div>
    </div>
  </div>
</div>

          <!-- BEGIN QUICK SIDEBAR -->

<a href="javascript:;" class="page-quick-sidebar-toggler">
  <i class="icon-login"></i>
</a>

<div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
</div>

      <div class="modal fade" id="modaltelefones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Adicionar  Telefone</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
      <!--        <form action="{{url('telefone/telefone/1')}}" method="get"> -->
              <input name="IMB_TLF_ID" type="hidden" class="form-control" id="i-id">

                <div class="row">

                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="ddd" class="col-form-label">DDD</label>
                      <input name="IMB_TLF_DDD" type="text" class="form-control" id="i-ddd" max="99" onkeypress="return isNumber(event)" onpaste="return false;"/>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="numero" class="col-form-label">Número</label>
                      <input name="IMB_TLF_NUMERO"  type="text" class="form-control" id="i-numero" onkeypress="return isNumber(event)" onpaste="return false;"/>
                    </div>
                  </div>

                  <div class="col-md-7">
                    <div class="form-group">
                      <label for="tipo" class="col-form-label">Tipo</label>
                      <select class="form-control  input-8" id="i-tipo">
                        <option value="Residencial">Residencial</option>
                        <option value="Comercial">Comercial</option>
                        <option value="Celular">Celular</option>
                        <option value="Whatsapp">Whatsapp</option>
                        <option value="Recado">Recado</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" onClick="telefoneIncluir()">Gravar</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
<!--              </form>-->
            </div>
          </div>
        </div>
      </div>

      <div class="modal" tabindex="-1" role="dialog" id="modalrepresentante">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <div class="portlet box blue">

                <div class="portlet-title">
                  <div class="caption">
                    <i class="fa fa-gift"></i>Representante do Locatário Pessoa Jurídica
                  </div>

                  <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                  </div>
                </div>

                <div class="portlet-body">
                    <input type="hidden" id="i-imb-clt-id" name="IMB_CLT_IDMASTER" >
                    <div class="form-body" >

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
                                <a class="btn btn-sm btn-primary" href="javascript:buscaIncremental()">
                                Carregar Sugestões</a>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Representante</label>
                              <select class="form-control" id="i-select-representante" name="IMB_CLT_ID">
                              </select>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" onClick="criarRepresentante()">Selecionar</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



@endsection
@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-timepicker-addon.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
 <script>

    $(document).ready(function() {
      $(".bot-click").click(function()
      {
        $(".bot-click")
        .removeClass("btn-dark"); // remove a classe de todos
        $(this)
        .addClass("btn-dark"); // adiciona a classe ao botão clicado
      });
      $("#sirius-menu").click();

      $('.telefone').mask('00000-00009');
      $('.telefone').blur(function(event)
      {
        if($(this).val().length == 10){ // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
          $('.telefone').mask('00000-0009');
        } else
        {
          $('.telefone').mask('0000-00009');
        }
      });

      preencherCBCorretores();
//      adicionarCliUsu();//por padrão já jogar o usuario corrente

        //iniciar com o corretor sendo o cadatrador
      var corretor = "{{Auth::User()->IMB_ATD_ID}}";
      var nome =  "{{Auth::User()->IMB_ATD_NOME}}";
      linha =
            '<tr id="cliusu'+corretor+'">'+
            '   <td class="div-center"> '+
            '       <a  class="btn btn-sm btn-danger" href=javascript:apagarCliUsu('+corretor+')>Apagar</a>'+
            '   </td>'+
            '   <td class="div-center">'+corretor+'</td>'+
            '   <td class="div-center">'+nome+'</td>'+
            '   <td class="div-center">Interessado</td>'+
            '</tr>';
        $("#tbcluusu").append( linha );


    });

  $('#IMB_CLT_PESSOA').on('change', function () {
    var pessoa = $("#IMB_CLT_PESSOA").val();
    $("#i-div-estado-civil").show();
    $("#i-div-sexo").show();
    $("#i-lbl-datanasc").html('Data Nascimento');
    if( pessoa == 'J')
    {
      $("#i-div-estado-civil").hide();
      $("#i-div-sexo").hide();
      $("#i-lbl-datanasc").html('Data Abertura');
    }

});


  $('#IMB_CLT_CPF').on('blur', () =>
  {

    var pessoa = $("#IMB_CLT_PESSOA").val();


    if( pessoa == 'F')
    {

      console.log('pessoa fisica');

      if ( is_cpf( $("#IMB_CLT_CPF").val() ) )
      {
        console.log('ok');
      }
      else
      {
        $('#IMB_CLT_CPF').val('');
        alert('Erro nas informações do CPF');
  //        $('#icpf').focus();

//         alert('Erro de validação de CPF!');
        console.log('not ok');
        }
    };
    clienteJaCadastrado();

  });

        // Método para consultar o CEP
 $('#IMB_CLT_RESENDCEP').on('blur', () => {

  let token = document.head.querySelector('meta[name="csrf-token"]');
   if (token) {
      window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    } else {
      console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
  }

    if ($.trim($('#IMB_CLT_RESENDCEP').val()) !== '') {
      $('#mensagem').html('(Aguarde, consultando CEP ...)');

      // NOVO CODIGO =============================================

      // Guardar o CEP do input.
      const cep = $('#IMB_CLT_RESENDCEP').val();

      // Construir a url com o CEP do input.
      // IMPORTANTE: na url, informar o parametro formato=json ao invés de formato=javascript.
      const urlBuscaCEP = 'https://viacep.com.br/ws/'+cep+'/json';

      // Realizar uma requisição HTTP GET na url.
      // O primeiro parâmetro é a url.
      // O segundo parâmetro é o callback, ou seja,
      // uma função que vai ser executada quando os dados forem retornados.
      // Essa função recebe um parâmetro que são os dados que a API retornou.
      $.get(urlBuscaCEP, (resultadoCEP) => {


        $('#tipologradouro').val('');
          $('#IMB_CLT_RESEND').val(resultadoCEP.logradouro.substr(0,39) );
          $('#CEP_BAI_NOMERES').val(resultadoCEP.bairro.substr(0,19));
          $('#CEP_CID_NOMERES').val(resultadoCEP.localidade.substr( 0, 19 ));
          $('#CEP_UF_SIGLARES').val(resultadoCEP.uf);

      });

      // FIM NOVO CODIGO.
    }
  });

  //preencherClientes();

  function clienteJaCadastrado()
  {
    str = $("#IMB_CLT_CPF").val();
    var url = "{{ route('cliente.checarcadastrocpf') }}"+"/"+str;
      console.log(url);

    $.getJSON( url, function( data)
    {
      if ( data.IMB_CLT_NOME != '' )
      {
        alert( 'Já há um cliente com este CPF -> '+data.IMB_CLT_NOME );
        $("#icpf").val('');
      }
    });
  }



  function modalRepresentante()
  {

    $("#modalrepresentante").modal('show');

  }


  function criarRepresentante()
  {
    linha =              '<tr id="'+$("#i-select-representante").val()+'">'+
                         '<td style="text-align:center valign="center">'+$( "#i-select-representante option:selected" ).val()+'</td>' +
                         '<td style="text-align:center valign="center">'+$( "#i-select-representante option:selected" ).text()+'</td>' +
                        '<td style="text-align:center" valign="center"> '+
                              '<a href=javascript:removerLinha('+$("#i-select-representante").val()+') class="btn btn-sm btn-danger">Excluir</a> '+
                          '</td> '+
                          '</tr>';

    $("#i-table-representantes").append( linha );

  }
  function  salvarRepresentantes( id)
  {
  //        console.log('$("#i-imb-clt-id").val()' + $("#i-numero-cliente").val() );
          //console.log('$("#i-select-representante").val()' + $("#i-select-representante").val() );


    var table = document.getElementById('i-table-representantes');
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
        IMB_CLT_ID :  table.rows[r].cells[0].innerHTML,
        IMB_CLT_IDMASTER :id,
      };

      var url = "{{ route('representante.save')}}/"+id;

      $.ajax(
      {
        url : url,
        data : corimo,
        datatype:'json',
        type:'post',
        async:false,
        success: function( )
        {
        },
        error: function()
        {
          alert('erro para gravar o representante');
        }
      });
    }
  };


  function buscaIncremental()
  {
    str = $("#i-str").val();
    var url = "{{ route('buscaclienteincremental') }}"+"/"+str;

    $.getJSON( url, function( data)
    {
      linha = "";
      $("#i-select-representante").empty();
      for( nI=0;nI < data.length;nI++)
      {
        linha =
        '<option value="'+data[nI].IMB_CLT_ID+'">'+
        data[nI].IMB_CLT_NOME+"</option>";
        $("#i-select-representante").append( linha );
      }
      console.log( linha );
      console.log('busca incremenal');
    });
  }

  function telefoneModal()
  {

    //alert('Para informar telefones, primeiro grave o cadastro, clicando no botão gravar');

    $("#i-ddd").val('');
    $("#i-numero").val('');
    $("#i-tipo").val('');
    $("#modaltelefones").modal('show');
  }


  function telefoneApagar( id )
  {
    if (confirm("Tem certeza que deseja excluir este telefone?") )
    {
      var textoid = '#'+id;
      $( textoid ).remove();
    }
  }

  function telefoneIncluir()
  {
    var linha =
                        '<tr id="'+$("#i-numero").val()+'">'+
                        '<td style="text-align:center valign="center">'+$("#i-ddd").val()+'</td>' +
                        '<td style="text-align:center valign="center">'+$("#i-numero").val()+'</td>' +
                        '<td style="text-align:center valign="center">'+$("#i-tipo").val()+'</td>' +
                        '<td style="text-align:center" valign="center"> '+
                              '<button onClick="removerLinha('+$("#i-numero").val()+')" class="btn btn-sm btn-danger">Excluir</button>'+
                        '</td> '+
                        '</tr>';
    $("#tbltelefone").append( linha );

  };



  function telefonesSalvar( nId )
  {


    var telefones = [];

    if( $("#i-telefone1").val() != '' )
    {
          // Criar objeto para armazenar os dados (com JSON essa tarefa fica mais simples)
      var tel = $("#i-telefone1").val();
      tel = tel.replace("-", "");

      var ddd =  $("#i-ddd1").val();
      var ddi =  $("#i-ddi1").val();
      telefones.push( [ ddi, ddd, tel, $("#i-telefone1-tipo").val(),'' ] )
    }

    if( $("#i-telefone2").val() != '' )
    {
          // Criar objeto para armazenar os dados (com JSON essa tarefa fica mais simples)
      var tel = $("#i-telefone2").val();
      tel = tel.replace("-", "");
      var ddd =  $("#i-ddd2").val();
      var ddi =  $("#i-ddi2").val();
      telefones.push( [ ddi, ddd, tel, $("#i-telefone2-tipo").val(),'' ] )
    }

    if( $("#i-telefone3").val() != '' )
    {
          // Criar objeto para armazenar os dados (com JSON essa tarefa fica mais simples)
      var tel = $("#i-telefone3").val();
      tel = tel.replace("-", "");
      var ddd =  $("#i-ddd3").val();
      var ddi =  $("#i-ddi3").val();
      telefones.push( [ ddi, ddd, tel, $("#i-telefone3-tipo").val(),'' ] )
    }

    if( $("#i-telefone4").val() != '' )
    {
          // Criar objeto para armazenar os dados (com JSON essa tarefa fica mais simples)
      var tel = $("#i-telefone4").val();
      tel = tel.replace("-", "");
      var ddd =  $("#i-ddd4").val();
      var ddi =  $("#i-ddi4").val();
      telefones.push( [ ddi, ddd, tel, $("#i-telefone4-tipo").val(),'' ] )
    }

    console.log( telefones );



    var dados =
    {
      numeros : telefones,
      IMB_CLT_ID : nId,
    }

    $.ajaxSetup(
      {
        headers:
        {
          'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
      });

    var url = "{{route('telefone.salvarlote')}}";
    //alert( url );

    $.ajax(
      {
        url     : url,
        type    : 'post',
        dataType:'json',
        data: dados,
        success : function data()
        {

        },
        error   : function()
        {
          //alert('erro gravacao fone' )
        }

      }
    )

    console.log( telefones );



  }

  function carregarAnexos()
  {
    str = $("#i-numero-cliente").val();
    var url = "{{ route('clienteanexo.carga') }}"+"/"+str;
    $.getJSON( url, function( data)
    {
        linha = "";
        $("#tblanexos>tbody").empty();
        for( nI=0;nI < data.length;nI++)
        {
          linha =
            '<tr>'+
            '<td style="text-align:center valign="center">'+data[ nI ].IMB_CLA_ARQUIVO+'</td>' +
            '<td style="text-align:center valign="center">'+data[ nI ].IMB_CLA_DESCRICAO+'</td>' +
            '</tr>';
          $("#tblanexos").append( linha );
        }
      });
    };

    carregarAnexos();

    function onGravar()
    {

    if( $("#IMB_CLT_NOME").val() == '' )
    {
        alert('Informe o nome!');
        return false;
    }

      if ( $("#i-telefone1").val() == '' &&
          $("#i-telefone2").val() == '' &&
          $("#i-telefone3").val() == '' &&
          $("#i-telefone4").val() == '' )
          alert( 'É necessário pelo menos um telefone')
      else
      if( $("#i-telefone1").val().length < 8 )
        alert('Verifique o telefone I')
      else
      if( $("#i-telefone2").val() != '' && $("#i-telefone2").val().length < 8 )
        alert('Verifique o telefone II')
      else
      if( $("#i-telefone3").val() != '' && $("#i-telefone3").val().length < 8 )
        alert('Verifique o telefone III')
      else
      if( $("#i-telefone4").val() != '' && $("#i-telefone4").val().length < 8 )
        alert('Verifique o telefone IV')
      else
      {

        $.ajaxSetup({
          headers:
          {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
          }
        });

        cpf=$("#IMB_CLT_CPF").val();
        cpf = cpf.replace('.','');
        cpf = cpf.replace('.','');
        cpf = cpf.replace('.','');
        cpf = cpf.replace('-','');
        cpf = cpf.replace('/','');
        console.log(cpf);
        cpfcjg = '';
        if( $("#IMB_CLT_CPF").val() )
        {
          cpfcjg=$("#IMB_CLTCJG_CPF").val();
          cpfcjg = cpfcjg.replace('.','');
          cpfcjg = cpfcjg.replace('-','');
          cpfcjg = cpfcjg.replace('/','');
        }

        var cliente =
        {

          IMB_CLT_ID      : $("#IMB_CLT_ID").val(),
          IMB_CLT_NOME      : $("#IMB_CLT_NOME").val(),
          IMB_CLT_RESEND      : $("#IMB_CLT_RESEND").val(),
          IMB_CLT_RESENDNUM      : $("#IMB_CLT_RESENDNUM").val(),
          IMB_CLT_RESENDCOM      : $("#IMB_CLT_RESENDCOM").val(),
          IMB_CLT_EMAIL      : $("#IMB_CLT_EMAIL").val(),
          IMB_CLT_RESENDCEP      : $("#IMB_CLT_RESENDCEP").val(),
          IMB_CLT_COMEND      : $("#IMB_CLT_COMEND").val(),
          IMB_CLT_DATNAS      : $("#IMB_CLT_DATNAS").val(),
          IMB_CLT_COMNUM      : $("#IMB_CLT_COMNUM").val(),
          IMB_CLT_COMCOM      : $("#IMB_CLT_COMCOM").val(),
          IMB_CLT_COMCEP      : $("#IMB_CLT_COMCEP").val(),
          IMB_CLT_OBSERVACAO      : $("#IMB_CLT_OBSERVACAO").val(),
          IMB_CLT_CPF      : cpf,
          IMB_CLT_COMCEP      : $("#IMB_CLT_COMCEP").val(),
          IMB_CLT_RG      : $("#IMB_CLT_RG").val(),
          IMB_CLT_RGORGAO      : $("#IMB_CLT_RGORGAO").val(),
          IMB_CLT_RGESTADO      : $("#IMB_CLT_RGESTADO").val(),
          IMB_CLT_PROFISSAO      : $("#IMB_CLT_PROFISSAO").val(),
          IMB_ATD_ID      : $("#I-IMB_ATD_ID").val(),
          IMB_CLT_RG_DATAEXPEDICAO      : $("#IMB_CLT_RG_DATAEXPEDICAO").val(),
          IMB_TIPCLI_ID      : $("#IMB_CLT_RGESIMB_TIPCLI_IDTADO").val(),
          IMB_CLT_NACIONALIDADE      : $("#IMB_CLT_NACIONALIDADE").val(),
          IMB_CLT_RENDA      : $("#IMB_CLT_RENDA").val(),
          CEP_BAI_NOMERES      : $("#CEP_BAI_NOMERES").val(),
          CEP_CID_NOMENAT      : $("#CEP_CID_NOMENAT").val(),
          CEP_UF_SIGLANAT      : $("#CEP_UF_SIGLANAT").val(),
          CEP_UF_SIGLARES      : $("#CEP_UF_SIGLARES").val(),
          IMB_CLT_RAZAOSOCIAL      : $("#IMB_CLT_RAZAOSOCIAL").val(),
          IMB_CLT_PRECADASTRO      : $("#IMB_CLT_PRECADASTRO").val(),
          IMB_IMB_ID2      : $("#IMB_IMB_IDAGENCIA").val(),
          IMB_CLT_SENHA      : $("#IMB_CLT_SENHA").val(),
          IMB_CLTCJG_CPF      : cpfcjg,
          IMB_CLT_ESTADOCIVIL : $("#IMB_CLT_ESTADOCIVIL").val(),
          IMB_CLTCJG_PROFISSAO      : $("#IMB_CLTCJG_PROFISSAO").val(),
          IMB_CLTCJG_RG      : $("#IMB_CLTCJG_RG").val(),
          IMB_CLTCJG_RGORGAO      : $("#IMB_CLTCJG_RGORGAO").val(),
          IMB_CLTCJG_NOME      : $("#IMB_CLTCJG_NOME").val(),
          IMB_CLTCJG_DATANASCIMENTO      : $("#IMB_CLTCJG_DATANASCIMENTO").val(),
          IMB_CLTCJG_NACIONALIDADE      : $("#IMB_CLTCJG_NACIONALIDADE").val(),
          IMB_CLTCJG_RGESTADO      : $("#IMB_CLTCJG_RGESTADO").val(),
          IMB_CLTCJG_SALARIO      : $("#IMB_CLTCJG_SALARIO").val(),
          CEP_CID_NOMERES      : $("#CEP_CID_NOMERES").val(),
          CEP_UF_SIGLA      : $("#IMB_CLTCJG_RGESTCEP_UF_SIGLAADO").val(),
          CEP_CID_NOMENATURAL      : $("#CEP_CID_NOMENATURAL").val(),
          CEP_UF_SIGLANATURAL      : $("#CEP_UF_SIGLANATURAL").val(),
          IMB_CLTCJG_RGESTADO      : $("#IMB_CLTCJG_RGESTADO").val(),
          IMB_IMB_ID2       : $("#I-IMB_IMB_ID2").val(),
          IMB_IMB_ID       : $("#I-IMB_IMB_IDMASTER").val(),
          IMB_CLT_PESSOA      : $("#I-IMB_CLT_PESSOA").val(),
          IMB_CLT_IMOVELGARANTIA      : $("#IMB_CLT_IMOVELGARANTIA").val(),

        };

        //alert( cliente.IMB_IMB_ID2+' - idmaster '+cliente.IMB_IMB_ID);

        url = "{{ route( 'cliente.store' ) }}";

        $.ajax(
        {
          url : url,
          data : cliente,
          type: "post",
          datatype: "json",
          async:false,
          success: function(data)
          {
            telefonesSalvar( data );
            salvarRepresentantes( data );
            salvarCliUsuBD( data )          ;
            $("#i-btn-gravar").hide();
            alert('Gravado com Sucesso');
            window.close();
          },
          error : function()
          {
            alert( 'error ');
          }

        });
      }
    }

    function removerLinha(id)
    {
      var textoid = '#'+id;

      $( textoid ).remove();

    }
    function procurarTelefone( telefone )
    {
//      if( $("#IMB_CLT_NOME").val() != '' )
  //      return false;
      var ntelefone = telefone.value;
      ntelefone = ntelefone.replace( '(','' );
      ntelefone = ntelefone.replace(')','');
      ntelefone = ntelefone.replace('-','');
      ntelefone = ntelefone.replace(' ','');

      console.log( telefone );

      var url = "{{route('cliente.localizar.telefone')}}/"+ntelefone;

      $.ajax(
        {
          url       : url,
          type      : 'get',
          dataType  : 'json',
          async     : false,
          success   : function( data )
          {
            alert('Cliente Já Cadastrado! '+data.IMB_CLT_NOME+' - Corretores: '+data.CORRETOR );

            window.close();
          },
          error: function()
          {
          }
      });
    }

    function adicionarCliUsu()
    {
      $("#modalcliusu").modal('show');
      $("#i-select-corretor").val( "{{Auth::user()->IMB_ATD_ID}}" );
      $("#i-select-tipocliente").val('Interessado');
    }

    function adicionarTabCliUsu()
    {
        var cliente = $("#i-select-corretor option:selected" ).val();
        linha =
            '<tr id="cliusu'+cliente+'">'+
            '   <td class="div-center"> '+
            '       <a  class="btn btn-sm btn-danger" href=javascript:apagarCliUsu('+cliente+')>Apagar</a>'+
            '   </td>'+
            '   <td class="div-center">'+$("#i-select-corretor option:selected" ).val()+'</td>'+
            '   <td class="div-center">'+$("#i-select-corretor option:selected" ).text()+'</td>'+
            '   <td class="div-center">'+$("#i-select-tipocliente").val()+'</td>'+
            '</tr>';
        $("#tbcluusu").append( linha );
        $("#modalcliusu").modal('hide');

    }

    function preencherCBCorretores()
    {
        var url = "{{ route('atendente.cargaativos')}}";

        $.ajax(
          {
            url     : url,
            dataType: 'json',
            type    : 'get',
            async:  false,
            success:function(data)
            {
              linha = "";
              $("#i-select-corretor").empty();
              for( nI=0;nI < data.length;nI++)
              {
                linha =
                  '<option value="'+data[nI].IMB_ATD_ID+'">'+
                  data[nI].IMB_ATD_NOME+"</option>";
                  $("#i-select-corretor").append( linha );
              }   ;
            }

        });
    }

    function salvarCliUsuBD( id )
    {
        var table = document.getElementById('tbcluusu');
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
                IMB_ATD_ID : table.rows[r].cells[1].innerHTML,
                IMB_CLT_ID : id,
                IMB_CLU_TIPO: table.rows[r].cells[3].innerHTML,
            };


            var url = "{{ route('cliente.corretores.salvar')}}";

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
                    alert('Erro na gravação do corretor no cliente '+
                    table.rows[r].cells[2].innerHTML+' - erro:'+erro);

                }
            });

        }
    }

    function apagarCliUsu( id )
    {

        if (confirm("Tem certeza que deseja excluir?"))
        {

          var textoid = '#cliusu'+id;
          $( textoid ).remove();

        }

    }




</script>



@endpush
