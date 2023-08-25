@section('scripttop')
<style>
    .table-visitas {
            text-align: center;
            font-size: 10px;
                color: #4682B4; 
    }
</style>
@endsection


        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i>Visitas
            </div>
          </div>
      
          <input type="hidden" id="i-imovel-saidachaves">
          <div class="portlet-body form">
            <div class="row">
              <div class="col-md-12">
              <small>
              <table  id="tblvisitas" class="table table-striped table-bordered table-hover" >
                  <thead>
                    <tr> 
                      <th  style="text-align:center"> Ações </th>
                      <th  style="text-align:center"> Saida </th>
                      <th  style="text-align:center"> Cliente </th>
                      <th style="text-align:center"> Prev. Retorno </th>
                      <th  style="text-align:center"> Retorno </th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                </small>
              </div>  
            </div>
          </div>
        </div>
      

@push('script')
<script>


function tabelar()
{

  url = "{{ route('saidachaves.listar') }}";

  dados = { IMB_IMV_ID : $("#i-imovel-saidachaves").val() };

  $.ajax(
  { 
      url: url,
      data:dados,
      dataType:'json',
      type:'get',
      success:function( data )
      {
        linha = "";
        $("#tblvisitas>tbody").empty();
        for( nI=0;nI < data.data.length;nI++)
        {
          datadevesp = data.data[nI].IMB_CCH_DTHDEVOLUCAOEFETIVA;
          if( datadevesp == null )
             datadevesp = '-'
          else
             datadevesp = moment( datadevesp ).format( 'DD/MM/YYYY HH:mm');

          linha = 
            '<tr class="table-visitas">'+
              '<td>'+
                '<a href="#"><i class="icon-book-open"></i> '+
                '<span>Detalhes</span></a>'+
              '</td>'+
              '<td><div class="lbl-medidas-outrositens div-center">'+moment(data.data[nI].IMB_CCH_DTHSAIDA).format('DD/MM/YYYY HH:mm')+'</div></td>'+
              '<td><div class="lbl-medidas-outrositens">'+data.data[nI].IMB_CLT_NOME+'</div></td>'+
              '<td><div class="lbl-medidas-outrositens">'+moment(data.data[nI].IMB_CCH_DTHDEVOLUCAOESPERADA).format('DD/MM/YYYY HH:mm')+'</div></td>'+
              '<td><div class="lbl-medidas-outrositens">'+datadevesp+'</div></td>'+
            '</tr>';
                
            $("#tblvisitas").append( linha );
        }

      }
  });
}

</script>


@endpush