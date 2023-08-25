<div class="modal fade" id="modalacordoscontrato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog"  style="width:90%;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Acordos Realizados para o Contrato
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="row">
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <table  id="tblacordosrealizados" class="table table-striped table-bordered table-hover" >
                                    <thead class="thead-dark">
                                        <tr >
                                            <th class="div-center" width="10%" > Data do Acordo</th>
                                            <th class="div-center" width="15%" > Valor do Acordo </th>
                                            <th class="div-center" width="15%" > Parcelas </th>
                                            <th class="div-center" width="15%" > Dt. Entrada </th>
                                            <th class="div-center" width="15%" > Valor Entrada </th>
                                            <th class="div-center" width="10%" ></th>
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

    function acordosRealizados( id )
    {
        $("#modalpesquisasubconta").modal( 'hide');

        url = "{{route('acordo.contrato.carga')}}/"+id;

        $.ajax(
        {
            url:url,
            dataType:'json',
            type:'get',
            async:false,
            success:function( data)
            {
                linha = "";
                $("#tblacordosrealizados>tbody").empty();
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<tr>'+
                        '<td class="div-center" >'+moment( data[nI].IMB_ACD_DATAACORDO ).format('DD/MM/YYYY')+'</td>'+
                        '<td class="div-right">R$ '+formatarBRSemSimbolo( parseFloat(data[nI].IMB_ACD_VALOR) )+'</td>' +
                        '<td class="div-center">'+data[nI].IMB_ACD_PARCELAS+'</td>' +
                        '<td class="div-center">'+moment( data[nI].IMB_ACD_DATAENTRADA ).format('DD/MM/YYYY')+'</td>'+
                        '<td class="div-right" >R$ '+formatarBRSemSimbolo( parseFloat( data[nI].IMB_ACD_VALORENTRADA) )+'</td>' +
                        '<td class="div-center"> '+
                            '<a href=javascript:verAcordo('+data[nI].IMB_ACD_ID+')><i class="fas fa-eye fa-2x" style="color:green"></i></a> '+
                            '<a title="Cancelar o acordo e voltar os lançamentos em aberto" href=javascript:estornaracordo('+data[nI].IMB_ACD_ID+')><i class="fas fa-undo fa-2x" style="color:green"></i></a> '+
                        '</td> '+
                    '</tr>';
                    $("#tblacordosrealizados").append( linha );
                }
                $("#modalacordoscontrato").modal('show');
            }

        });

    }

    function verAcordo( id )
    {
        var url = "{{route('acordo.contrato.detalhes')}}/"+id;

        window.open( url, '_blank');

    }

  </script>



  @endpush
