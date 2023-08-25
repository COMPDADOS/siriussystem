<div class="modal fade" id="modalvisitas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-body">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i>Visitas
            </div>
          </div>
      
          <div class="portlet-body form">
            
            <div class="row">
              <hr>
            </div>
          
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                      <input type="text" id="i-strcliente"  
                      placeholder="digite aqui um pedaço do nome" 
                      class="form-control">
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <button class="btn btn-primary" onClick="buscaIncremental()">Carregar Sugestões</button>
                </div>
              </div>
            </div>
              
            <div class="row">
              <div class="col-md-10">
                <table  id="tblvisitas" class="table table-striped table-bordered table-hover" >
                  <thead class="thead-dark">
                    <tr >
                      <th width="10%" style="text-align:center"> Referência </th>
                      <th width="30%" style="text-align:center"> Imóvel </th>
                      <th width="20%" style="text-align:center"> Cliente </th>
                      <th width="10%" style="text-align:center"> Dt/Hr Saida </th>
                      <th width="10%" style="text-align:center"> Dt/Hr Prev. Retorno </th>
                      <th width="10%" style="text-align:center"> Dt/Hr Prev. Retorno </th>
                      <th width="10%" style="text-align:center"> Ações </th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
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


push('script')

<script>
$(document).ready(function() 
{

  var rows_selected = [];
  var table = $('#resultTable').DataTable(
  {
      "pageLength": 50,
      "lengthChange": true,
      "language": 
      {
          "sEmptyTable": "Nenhum registro encontrado",
          "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
          "sInfoPostFix": "",
          "sInfoThousands": ".",
          sLoadingRecords: '<div class="overlay"><img src="{{asset('/layouts/layout/img/loader.gif')}}"/></div>',
          sProcessing: '<div class="overlay"><img src="{{asset('/layouts/layout/img/loader.gif')}}"/></div>',
          "sZeroRecords": "Nenhum registro encontrado",
          "scrollY": "300px",
          "oPaginate": {
              "sNext": "Próximo",
              "sPrevious": "Anterior",
              "sFirst": "Primeiro",
              "sLast": "Último"
      }
  },
  processing: true,
  serverSide: true,
  ajax: 
  { 
      url:"{{ route('imovel.list') }}",
      data: function (d) 
      {
          d.id_completus  = $('input[name=id_completus]').val();
          d.referencia    = $('input[name=referencia]').val();
          d.endereco      = $('input[name=endereco]').val();
          d.bairro        = $('input[name=bairro]').val();
          d.cidade        = $('input[name=cidade]').val();
          d.dormitorio    = $('input[name=dormitorio]').val();
          d.suite         = $('input[name=suite]').val();
          d.agencia       = $('input[name=agencia]').val();
          d.tipoimovel    = $('input[name=tipoimovel]').val();
          d.finalidade    = $('input[name=finalidade]').val();
          d.faixainicial  = $('input[name=faixainicial]').val();
          d.faixafinal    = $('input[name=faixafinal]').val();
          d.condominio    = $('input[name=condominio]').val();
          d.proprietario  = $('input[name=proprietario]').val();
          d.corretor      = $('input[name=corretor]').val();
          d.captador      = $('input[name=captador]').val();
          d.cadastradopor  = $('input[name=cadastradopor]').val();
          d.empresamaster = $('input[name=empresamaster]').val();
          d.status        = $('input[name=status]').val();
          d.caddatainicial= $('input[name=caddatainicial]').val();
          d.caddatafinal  = $('input[name=caddatafinal]').val();
          d.pesquisagenerica = $('input[name=pesquisagenerica]').val();
                  
          d.radar         = $('input[name=radar]').prop('checked') ? 'S' : 'N';
      }
  },
  columns: 
  [
      { 
          "data": "IMAGEM", render: getImg 
      },
      {
          "data": 'ENDERECOCOMPLETO', render: getInformacoes
      },
  ],
  "columnDefs": 
  [ 
      {
          'targets': 0,
          'searchable': false,
          'orderable': false,
          'className': 'dt-body-center',
          'render': function (data, type, full, meta)
          {
              return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
          }
      },
  ],
  'rowCallback': function(row, data, dataIndex)
  {
      
      var rowId = data[0];
      if($.inArray(rowId, rows_selected) !== -1)
      {
          $(row).find('input[type="checkbox"]').prop('checked', true);
          $(row).addClass('selected');
      }
  },               
  searching: false
  });

});


</script>


@endpush