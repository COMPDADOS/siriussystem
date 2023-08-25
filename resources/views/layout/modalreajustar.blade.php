<div class="modal fade" id="modalreajustar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog "style="width:80%;" >
    <div class="modal-content">
      <div class="modal-body">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption" id="i-endereco-rajuste">
              <i class="fa fa-gift"></i>
            </div>
          </div>

          <div class="portlet-body form">
            <div class="row">
              <input type="hidden" id="i-ctr-id">
              <input type="hidden" id="i-fator-indice">
              <hr>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="col-md-2">
                  <label class="control-label">Data Reajuste</label>
                  <input class="form-control" type="text" id="i-data-reajuste" readonly>
                </div>
                <div class="col-md-2">
                  <label class="control-label">Valor Atual</label>
                  <input class="form-control" type="text" id="i-valor-atual" readonly>
                </div>
                <div class="col-md-2">
                  <label class="control-label">Índice</label>
                  <input class="form-control" type="text" id="i-indice" readonly>
                </div>
                <div class="col-md-2">
                  <label class="control-label">$ Sugestão</label>
                  <input type="hidden" id="i-valordigitado">
                  <input class="form-control" type="text" id="i-sugestao" >
                </div>
                <div class="col-md-2">
                  <label class="control-label">Valor Desconto </label>
                  <input class="form-control valor" type="text" id="i-valordesconto">
                </div>                
                <div class="col-md-2 div-center">
                  <label class="control-label"> &nbsp; &nbsp; &nbsp;</label>
                  <button class="btn btn-primary"title="Irá gerar as parcelas de acordo com o valor digitado!"class="btn btn-primary" onClick="refazerParcelas()">Reparcelar</button>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <table  id="tblparcelasreajuste" class="table table-striped table-bordered table-hover" >
                  <thead class="thead-dark">
                    <tr >
                      <th width="10%" style="text-align:center"> Parcela</th>
                      <th width="15%" style="text-align:center"> Data</th>
                      <th width="15%" style="text-align:center"> Valor </th>
                      <th width="45%" style="text-align:center"> Descriçao </th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <div class="col-md-12 div-direita">
                    <button class="btn btn-success" onClick="confirmarReajuste()">Confirmar Reajuste</button>
                </div>

              </div>
            </div>
          </div>
        </div>


        <div class="modal-footer">

          <div class="row">
            <div class="col-md-12">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">sair</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@push('script')
<script>
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


function confirmarReajuste()
{
    var table = document.getElementById('tblparcelasreajuste');
    var aarray = [];

    for (var r = 1, n = table.rows.length; r < n; r++)
    {
        aarray.push( [  table.rows[r].cells[0].innerHTML,
                        table.rows[r].cells[1].innerHTML,
                        realToDolar(table.rows[r].cells[2].innerHTML),
                        table.rows[r].cells[3].innerHTML,
                    ]);
    };

    var url = "{{route('reajustar.confirmar')}}";

    var dados =
    {
        parcelas : aarray,
        id : $("#i-ctr-id").val(),
        valoratual : realToDolar($("#i-valor-atual").val()),
        valornovo : realToDolar($("#i-sugestao").val()),
        fator : $("#i-fator-indice").val(),
        valordesconto: realToDolar($("#i-valordesconto").val()),
    }
    $.ajaxSetup({
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
            data:dados,
            success:function()
            {
                alert('Confirmado');
                $("#modalreajustar").modal('hide');
                $( "#form-carga" ).submit();

            }
        }
    )

    console.log( aarray );

}

</script>


@endpush
