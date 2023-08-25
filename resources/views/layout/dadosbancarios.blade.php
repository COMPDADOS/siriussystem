<div class="portlet-body form">
                  <div class="form-body">
                    <input type="hidden" id="IMB_PPI_ID">
                    <input type="hidden" id="IMB_IMV_ID-REP">
                    <input type="hidden" id="IMB_CLT_ID-REP">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-2">
                          <label class="label-control">Part.%</label>
                          <input class="form-control valor-4 readonly-db" type="text" id="IMB_IMVCLT_PERCENTUAL4" >
                        </div>

                        <div class="col-md-4">
                          <label class="label-control">Forma de Repasse</label>
                          <select select class="form-control readonly-db" id="IMB_FORPAG-IDLOCADOR"></select>
                        </div>
                        <div class="col-md-6">
                          <label class="label-control">Cheque Nominal</label>
                          <input type="text" class="form-control readonly-db" id="IMB_IMV_CHEQUENOMINAL" maxlength="40">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-4">
                          <label class="label-control">Banco</label>
                          <select select class="form-control readonly-db" id="GER_BNC_NUMERO-REP"></select>
                        </div>
                        <div class="col-md-2">
                          <label class="label-control">Agencia</label>
                          <input type="text" class="form-control readonly-db" id="GER_BNC_AGENCIA"
                          onkeypress="return isNumber(event)" onpaste="return false;">
                        </div>
                        <div class="col-md-1">
                          <label class="label-control">DV</label>
                          <input type="text" class="form-control readonly-db" id="IMB_BNC_AGENCIADV" maxlength="1">
                        </div>
                        <div class="col-md-1">
                        </div>

                        <div class="col-md-3">
                          <label class="label-control">Nº Conta</label>
                          <input type="text" class="form-control readonly-db" id="IMB_CLTCCR_NUMERO"
                          onkeypress="return isNumber(event)" onpaste="return false;">
                        </div>
                        <div class="col-md-1">
                          <label class="label-control">DV</label>
                          <input type="text" class="form-control readonly-db" id="IMB_CLTCCR_DV" maxlength="2">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-3">
                          <label class="label-control">Pessoa</label>
                          <select select class="form-control readonly-db" id="IMB_CLTCCR_PESSOA">
                            <option value="F">Física</option>
                            <option value="J">Jurídica</option>
                          </select>
                        </div>
                        <div class="col-md-3">
                          <label class="label-control">CPF/CNPJ</label>
                          <input type="text" class="form-control readonly-db" id="IMB_CLTCCR_CPF"
                          onkeypress="return isNumber(event)" onpaste="return false;">
                        </div>
                        <div class="col-md-6">
                          <label class="label-control">Chave Pix</label>
                          <input type="text" class="form-control readonly-db" id="IMB_IMVCLT_PIX" >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-1 div-center" >
                          <label class="label-control">DOC</label>
                          <input type="checkbox" class="form-control readonly-db" id="IMB_CLTCCR_DOC">
                        </div>
                        <div class="col-md-2 div-center">
                          <label class="label-control ">Principal</label>
                          <input type="checkbox" class="form-control readonly-db" id="IMB_IMVCLT_PRINCIPAL">
                        </div>
                        <div class="col-md-1 div-center">
                          <label class="label-control ">Poupança</label>
                          <input type="checkbox" class="form-control readonly-db" id="IMB_CLTCCR_POUPANCA">
                        </div>
                        <div class="col-md-2">
                          <label class="label-control div-center">Tx.Adm.</label>
                          <input type="text" class="form-control valor-4 readonly-db" id="IMB_IMVCLT_TAXAADMINISTRAT">
                          <span>
                            <select select class="form-control readonly-db" id="IMB_IMVCLT_TAXAADMINISTRATFORMA">
                              <option value="P">Em %</option>
                              <option value="V">Em R$</option>
                            </select>
                          </span>
                        </div>
                        <div class="col-md-6">
                          <div class="row">
                            <div class="col-md-12">
                              <label class="label-control">Nome do Correntista</label>
                              <input type="text" class="form-control readonly-db" id="IMB_CLTCCR_NOME" maxlength="40">
                            </div>
                          </div>
                          <div class="row div-center">Botões para Acões em Dados Bancários
                            <div class="row">
                              <div class="col-md-4 div-center">
                                <button class="btn btn-primary" onClick="habilitarDB()" id="i-btn-hab-db">Habilitar Alteração</button>
                              </div>
                              <div class="col-md-4 div-center">
                                <button class="btn btn-primary" onClick="gravarDadosBancarios()" id="i-btn-gra-db">Gravar Dados Bancários</button>
                              </div>
                              <div class="col-md-4 div-center">
                                <button class="btn btn-danger" onClick="cancelarDadosBancarios()" id="i-btn-can-db">Cancelar Alteração</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>