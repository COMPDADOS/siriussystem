

<div class="modal fade" id="modalauditoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:90%;" >
    <div class="modal-content ">
      <div class="modal-body">
        <div class="portlet box blue escondido">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i>Auditoria / Logs / Relatos
            </div>
            <div class="tools">
              <a href="javascript:;" class="collapse"> </a>
            </div>
          </div>
          <div class="col-md-12 ">
            <input type="hidden" id="IIMB_CTR_ID" name="logcontrato" >
            <input type="hidden" id="IIMB_IMV_ID" name="logimovel" >
            <input type="hidden" id="IIMB_CLT_ID" name="logcliente" >

            <div class="col-md-2">
              <label class="label-control" >Data Inicial
                <input class="form-control" type="date" id="LOG-datainicio" name="datainicio">
              </label>
            </div>
            <div class="col-md-2">
              <label class="label-control" >Data Final
                <input class="form-control" type="date" id="LOG-datatermino" name="datatermino">
              </label>
            </div>
            <div class="col-md-6">
            </div>
            <div class="col-md-2">
              <p></p>
              <div class="form-actions noborder">
                <button class="btn blue pull-right" id='btn-search-form'>Carregar</button>
              </div>
            </div>
          </div>
        </div>

        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i>Registros
            </div>
            <div class="tools">
              <a href="javascript:;" class="collapse"> </a>
            </div>
          </div>

          <div class="portlet-body form">
            <div class="row">
              <div class="col-md-12">
                <table class="table table-striped table-bordered" id="resultTableLog">
                  <thead>
                    <th  style="text-align:center">Data</th>
                    <th width="20%" style="text-align:center">Usuario</th>
                    <th  width="60%">Log</th>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-2">
                <button class="form-control btn btn-primary" onClick="incluirRelato()">Novo Relato</button>
              </div>
              <div class="col-md-8">
              </div>
              <div class="col-md-2">
                <button class="form-control  btn btn-danger" onClick="fecharModalAuditoria()">Fechar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="modal" id="modalnovolog" tabindex="-1" role="dialog">
  <div class="modal-dialog" style="width:70%;" >
    <div class="modal-content">
      <div class="modal-header">
        <input type="hidden" id="IMB_CTR_IDINCLOC">
        <h5 class="modal-title">Novo Relato</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="col-md-2">
            <label class="control-label">Data</label>
            <input class="form-control" type="date" id="i-datalog-inc">
            <button class="btn btn-success form-control" onClick="gravarLog()">Gravar</button>
            <button class="btn btn-danger form-control"  data-dismiss="modal">Sair</button>
          </div>
          <div class="col-md-10">
              <label class="control-label">Descrição</label>
              <textarea class="form-control" id="IMB_OBS_OBSERVACAOINC" cols="100%" rows="10"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>


@push('script')
<script>


function cargaLog(id)
{

    $("#IMB_CTR_IDINCLOC").val(id);

    $('#resultTableLog').dataTable().fnClearTable();
    $('#resultTableLog').dataTable().fnDestroy();  
    var table = $('#resultTableLog').DataTable(
    {
        "pageLength": 20,
        "language":
        {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "  Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "..Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            sLoadingRecords: '<img src="{{asset('/layouts/layout/img/loader.gif')}}"/>',
                sProcessing: '<img src="{{asset('/layouts/layout/img/loader.gif')}}"/>',
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate":
            {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
        },
        bLengthChange: false,
        bSort : false ,
        responsive: false,
        processing: true,
        serverSide: true,
        ajax:
        {
            url:"{{route('auditoria.cargalog')}}",
            data: function (d)
            {
                d.IMB_CTR_ID = id;
            }
        },
        columns:
        [
            {data: 'IMB_OBS_DTHATIVO', render:formatData},
            {data: 'IMB_ATD_NOME'},
            {data: 'IMB_OBS_OBSERVACAO' },
            
        ],
        searching: false
    });

    $('#btn-search-form').on('submit', function(e) {
        table.draw();
        e.preventDefault();
    });




}

function fecharModalAuditoria()
{
  $("#modalauditoria").modal('hide');
}

function formatData( data )
{
  return moment( data ).format('DD/MM/YYYY HH:mm:ss');
}

function incluirRelato()
{
  $("#i-desclog-inc").val('');
  $("#i-datalog-inc").val( moment().format('YYYY-MM-DD'));
  $("#modalnovolog").modal('show');
}

function gravarLog()
{

  if(  $("#IMB_OBS_OBSERVACAOINC").val() == '')
  {
    alert('Preencha o campo descrição!');
    abort;
  }

  var url = "{{route('relato.gravar')}}";

  $.ajaxSetup(
    {
      headers:
      {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
      }
    });
        
    var dados = 
    { 
      IMB_CTR_ID :   $("#IMB_CTR_IDINCLOC").val(),
      IMB_OBS_OBSERVACAO :   $("#IMB_OBS_OBSERVACAOINC").val(),
    };

    $.ajax(
    {
      url : url,
      dataType:'json',
      data : dados,
      type : 'post',
      async : false,
      success: function( data )
      {
        $("#modalnovolog").modal('hide');
        cargaLog($("#IMB_CTR_IDINCLOC").val());
      },
      error : function()
      {
        alert('ERRO: Não gravado!');
        $("#modalnovolog").modal('hide');

      }

    });

}
</script>
@endpush
