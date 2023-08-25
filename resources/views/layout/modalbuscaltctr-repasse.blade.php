<div class="modal fade" id="modalbuscaltctr-rep" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:70%;">    
    <div class="modal-content">
      <div class="modal-body">
        
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption">
              <i class="fa fa-gift"></i>Locatário/Contrato
            </div>
          </div>
      
          <input type="hidden" id="i-tipo-busca">
          <div class="portlet-body form">
            
          <div class="row">
            
        </div>
          
            <div class="row">
              <div class="col-md-2">
                <select id="i-tipo-busca-contrato" class="form-control">
                  <option value="P">Pasta</option>
                  <option value="T">Locatário</option>
                  <option value="D">Locador</option>
                  <option value="E">Endereço</option>
                  <option value="I">Código Imóvel</option>
                </select>
              </div>                
              <div class="col-md-8">
                <div class="form-group">
                      <input type="text" id="i-str-pesquisa"  
                      placeholder="digite a informação: Pasta ou parte do nome do cliente" 
                      class="form-control">
                </div>
              </div>
              <div class="col-md-2">
                  <a class="btn btn-primary form-control" href="javascript:buscaIncrementalContratos();">Carregar Sugestões</a> 
              </div>
            </div>
              
            <div class="row">
              <div class="col-md-10">
                <table  id="tblclientes" class="table table-bordered table-hover" >
                  <thead class="thead-dark">
                    <tr>
                      <th width="10%" style="text-align:center"> Situação </th>
                      <th width="10%" style="text-align:center"> Pasta </th>
                      <th width="20%" style="text-align:center"> Endereço </th>
                      <th width="20%" style="text-align:center"> Locador </th>
                      <th width="20%" style="text-align:center"> Locatário </th>
                      <th width="20%" style="text-align:center"> Ações </th>
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


@push('script')
<script>
  function buscaIncrementalContratos()
    {


      debugger;
      var tipo = $("#i-tipo-busca-contrato").val();

      if( tipo == 'P')
      {
        str = $("#i-str-pesquisa").val();
          var url = "{{ route('contrato.find.pasta') }}"+"/"+str;
                

      }
      if( tipo == 'D' )
        {
          str = $("#i-str-pesquisa").val();
          var url = "{{ route('contrato.buscaporld') }}"+"/"+str+"/"+
                $("#IMB_IMB_IDMASTER").val();
        };

        if( tipo == 'T' )
        {
          str = $("#i-str-pesquisa").val();
          var url = "{{ route('contrato.buscaporlt') }}"+"/"+str+"/"+
                $("#IMB_IMB_IDMASTER").val();
        };

        if( tipo == 'E' )
        {
          str = $("#i-str-pesquisa").val();
          var url = "{{ route('contrato.buscaporend') }}"+"/"+str+"/"+
                $("#IMB_IMB_IDMASTER").val();
        };

        $.getJSON( url, function( data)
        {
          linha = "";
          $("#tblclientes>tbody").empty();
          for( nI=0;nI < data.length;nI++)
          {
            if( data[nI].IMB_CTR_SITUACAO == 'ENCERRADO' )
            tr = '<tr class="linha-fundo-vermelho"  >';
            else
              tr = '<tr class="linha-fundo-azul">';


            linha =
              tr+
              '   <td>'+data[nI].IMB_CTR_SITUACAO+'</td>'+
              '   <td>'+data[nI].IMB_CTR_REFERENCIA+'</td>'+
              '   <td>'+data[nI].ENDERECOCOMPLETO+'</td>'+
              '   <td>'+data[nI].PROPRIETARIO+'</td>'+
              '   <td>'+data[nI].IMB_CLT_NOME_LOCATARIO+'</td>'+
              '   <td style="text-align:center"> '+
              '<a  class="btn btn-sm btn-primary" onclick="selecionarContratoRepasse( '+data[nI].IMB_CTR_ID+')">Selecionar</a>'+
            '    </td>'+
        '</tr>';
      $("#tblclientes").append( linha );
    }

        });
    }


    function  selecionarContratoRepasse( id)
    {
      debugger;
      $("#i-idcontrato-repassar").val(id);
      $("#form-repassar").submit();

    }


</script>
@endpush