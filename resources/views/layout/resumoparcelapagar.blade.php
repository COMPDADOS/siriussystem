@section('scripttop')

<style>

.linha-fundo-azul {
  background-color:#b3d9ff;
  color:#003366;
  font-weight: bold;
}

.linha-fundo-azul-center
{
  background-color:#b3d9ff;
  color:#003366;
  font-weight: bold;
  text-align:center;
  font-size: 24px;

}


.cardtitulo-20 {
  background-color:#b3d9ff;
  text-align: left;
  font-size: 20px;
  color: #4682B4;
  font-weight: bold;

}

.cardtitulo-20-center {
  text-align:center;
  font-size: 24px;
  color:#003366;
  font-weight: bold;

}

.div-recebimento
{
  display: none;
}

.valores-calculados
{

  text-align: center;
  font-size: 14px;
  font-weight: bold;
  color: #4682B4;

}

input {
  font-size: 32px;
}

</style>
@endsection

<div class="modal fade" id="modalresumoparcela" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:90%;"  role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption" id="i-lbl-header-modalresumoparcelas">
              <i class="fa fa-gift"></i>
            </div>
          </div>
          <input type="hidden" id="i-chave">
          <div class="portlet-body form">
            <div class="row">
              <div class="col-md-12">
                <table  id="i-tlblf-resumo" class="table-striped table-bordered table-hover" >
                  <thead class="thead-dark">
                    <tr>
                      <th width="100" style="text-align:center"> Ações </th>
                      <th class="escondido"> IDlcf </th>
                      <th width="20" style="text-align:center"> ID </th>
                      <th width="200" style="text-align:center"> Evento </th>
                      <th width="100" style="text-align:center"> Valor </th>
                      <th width="100" style="text-align:center"> Locatário </th>
                      <th width="100" style="text-align:center"> Locador </th>
                      <th width="100" style="text-align:center"> Vencimento </th>
                      <th width="200" style="text-align:center"> Direcionado para </th>
                      <th width="500" style="text-align:center"> Descrição</th>
                      <th width="50" style="text-align:center"> Inc.Taxa</th>
                      <th class="escondido"> randon</th>
                      <th  class="escondido"> deletado</th>
                      <th class="escondido"> clt_id</th>
                      <th > - </th>
                      

                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-3 div-center">
                  <label class="label-control">Data Vencimento</label>
                  <input type="date" class="form-control cardtitulo-20" id="i-data-vencimento" readonly>
                </div>
                <div class="col-md-3 div-center">
                  <label class="label-control" id="lbl-data-vencimento">Data para Simulação</label>
                  <input type="date" class="form-control cardtitulo-20" id="i-data-base" readonly>
                </div>
                <div class="col-md-2">
                  <label class="label-control">$ Lançamentos</label>
                  <input type="text" class="form-control valor cardtitulo-20"
                  id="i-valores-lancados" readonly >
                </div>
                <div class="form-actions right" id="i-div-btn-sim">
                  <button type="button" class="btn btn-primary" id="i-btn-previarecebimento">
                  <i class="fa fa-momey"></i> Prévia Receber
                  </button>
                  <button type="button" class="btn btn-danger " id="i-btn-previarepasse">
                  <i class="fa fa-momey"></i> Prévia Repassar
                  </button>
                </div>
                <div class="form-actions right" style="display:none" id="i-div-btn-rec">
                  <button type="button" class="btn btn-primary" id="i-btn-rec-recalcular"
                  onClick="recalcular()">

                  <i class="fa fa-momey"></i> Recalcular
                  </button>
                  <button type="button" class="btn btn-danger " id="i-btn-rec-sair-resumo"
                  class="close" data-dismiss="modal" aria-label="Close">
                  <i class="fa fa-momey"></i> Sair
                  </button>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 div-center" id="div-processando">

              </div>
            </div>
          </div>
        </div>



        <div class="portlet box green" style="display: none" id="i-div-recebimento">
          <div class="portlet-title">
            <div class="caption">Valores Calculados
              <i class="fa fa-gift"></i>
            </div>
          </div>
          <div class="portlet-body form">
            <div class="row">
              <div class="col-md-8">
                <div class="row">
                 <div class="col-md-3 ">
                    <label class="label-control">$ Multa a Repassar</label>
                    <input type="text" class="form-control valor" id="i-multarepassar" value="0">
                  </div>
                  <div class="col-md-3 ">
                    <label class="label-control">$ Multa a Reter</label>
                    <input type="text" class="form-control valor" id="i-multareter" value="0">
                  </div>
                  <div class="col-md-3 ">
                    <label class="label-control">$ Juros Repassar</label>
                    <input type="text" class="form-control valor" id="i-jurosrepassar" value="0">
                  </div>
                  <div class="col-md-3 ">
                    <label class="label-control">$ Juros reter</label>
                    <input type="text" class="form-control valor" id="i-jurosreter"value="0">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <label class="label-control">$ Corr. Repassar</label>
                    <input type="text" class="form-control valor" id="i-correcaorepassar" value="0">
                  </div>
                  <div class="col-md-3 ">
                    <label class="label-control">$ Correção Reter</label>
                    <input type="text" class="form-control valor" id="i-correcaoreter" value="0">
                  </div>
                  <div class="col-md-3 ">
                    <label class="label-control">$ Boleto</label>
                    <input type="text" class="form-control valor" id="i-boleto" value="0">
                  </div>
                  <div class="col-md-3 ">
                    <label class="label-control">$ IRRF</label>
                    <input type="text" class="form-control valor" id="i-irrf" value="0">
                  </div>
                </div>
              </div>

              <div class="col-md-4 cardtitulo-20" >
                <div class="row">
                  <br>
                  <label class="label-control " >Total a Receber</label>
                  <label class="label-control"   id="i-totalareceber" ></label>
                </div>
              </div>
            </div>
          </div>
        </div>

        @include( 'layout.dadosrepassar')

      </div>
    </div>
  </div>
</div>

