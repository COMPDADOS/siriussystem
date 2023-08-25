<div class="portlet box blue">
  <div class="portlet-title">
    <div class="caption" id="i-lbl-header-imovel" >
    </div>
  </div>
  <input type="hidden" id="i-chave">
  <input type="hidden" id="IMB_CTR_ID" value = "{{$idcontrato}}">
  <input type="hidden" id="IMB_IMV_ID">

  <div class="portlet-body form">

    @php
      $ctr = app( 'App\Http\Controllers\ctrContrato')->find( $idcontrato )
    @endphp

    <div class="row">
      <div class="col-md-12">
        <br>
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-12">
                <label class="label-control">Locatário</label>
                <input type="text" class="form-control cardtitulo" id="i-locatario" value="{{$ctr[0]->IMB_CLT_NOME_LOCATARIO}}" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label class="label-control">Locador</label>
                <input type="text" class="form-control cardtitulo" id="i-locador" value="{{$ctr[0]->PROPRIETARIO}}"  readonly >
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-3">
                <label class="label-control">Pasta</label>
                <input type="text" class="form-control cardtitulo" id="i-pasta" value="{{$ctr[0]->IMB_CTR_REFERENCIA}}" readonly>
              </div>
              <div class="col-md-4">
                <label class="label-control">Início Contrato</label>
                <input type="text" class="form-control cardtitulo" id="i-iniciocontrato" value="{{date('d/m/Y', strtotime($ctr[0]->IMB_CTR_INICIO))}}"  readonly>
              </div>
              <div class="col-md-4">
                <label class="label-control">Próximo Reajuste</label>
                <input type="text" class="form-control cardtitulo" value="{{date('d/m/Y', strtotime($ctr[0]->IMB_CTR_DATAREAJUSTE))}}"  readonly>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
