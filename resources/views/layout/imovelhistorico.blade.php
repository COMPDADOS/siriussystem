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
            <i class="fa fa-gift"></i>Históricos do Imóvel
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="font-10">
        <table  id="tblhistoricoimovel" class="table table-condensed table-hover table-bordered table-striped" >
            <thead class="thead-dark">
                <tr class="font-10">
                    <th width="5%" class="font-10" >Por</th>
                    <th width="15%" class="font-10" > Data/Hora </th>
                    <th width="20%" class="font-10" > Campo Alterado </th>
                    <th width="35%" class="font-10" > Alterado de</th>
                    <th width="35%" class="font-10" > Alterado para </th>
                </tr>   
            </thead>
            <tbody>
            </tbody>
        </table>
        </div>

    </div>
</div>


<div class="modal fade" id="modaldetalhe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="i-header" >Detalhe</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label class="label-control">Campo</label>
                        <input class="form-control" type="text" readonly id="I-CAMPO">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="label-control">Valor Anterior</label>
                        <input class="form-control"  type="text" readonly id="I-VALORANTERIOR">
                        <textarea rows="3" readonly id="I-VALORANTERIOR" style="min-width: 100%"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="label-control">Valor Atual</label>
                        <textarea rows="3" readonly id="I-VALORATUAL" style="min-width: 100%"></textarea>
                    </div>
                </div>
                <div class="form-actions right">
                    <button type="button" class="btn blue " id="i-btn-gravar" onClick="fecharModalHis()")>
                          <i class="fa fa-check"></i> OK
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>      

<script>

    function cargaHistorico( id )
    {
        url = "{{route('historicoimovel.carga')}}/"+id;

        $.ajax( 
        {
            url         : url,
            dataType    : 'json',
            type        : 'get',
            success     : function( data )
            {
                $("#i-header").html( data.data[0].IMB_ATD_NOME+' em '+
                moment(data.data[0].IMB_IMH_DTHALTERACAO).format( 'DD/MM/YYYY HH:mm') );
                linha = "";
                $("#tblhistoricoimovel>tbody").empty();
                for( nI=0;nI < data.data.length;nI++)
                {
                    datalog = moment(data.data[nI].IMB_IMH_DTHALTERACAO).format( 'DD/MM/YYYY HH:mm');
                    console.log( data.data[nI].IMB_IMV_ID );
                    console.log( data);
                    linha = 
                    '<tr class="table-visitas">'+
                    '   <td class="lbl-medidas-outrositens div-center">'+data.data[nI].IMB_ATD_NOME+'</td>'+
                    '   <td class="lbl-medidas-outrositens div-center">'+datalog+'</td>'+
                    '   <td class="lbl-medidas-outrositens div-center">'+data.data[nI].IMB_IMH_CAMPO+'</td>'+
                    '   <td class="lbl-medidas-outrositens div-center">'+data.data[nI].IMB_IMH_VALORANTERIOR+'</td>'+
                    '   <td class="lbl-medidas-outrositens div-center">'+data.data[nI].IMB_IMH_VALORATUAL+'</td>'+
                    '</tr>';
                
                $("#tblhistoricoimovel").append( linha );
                    
                }

            }
        });
    }

    function verMais( id )
    {
        var url = "{{route( 'historicoimovel.find' )}}/"+id;

        $.ajax( 
        {
            url : url,
            dataType: 'json',
            type : 'get',
            success:function( data )
            {
                $("#I-CAMPO").val( data.IMB_IMH_CAMPO);
                $("#I-VALORANTERIOR").val( data.IMB_IMH_VALORANTERIOR);
                $("#I-VALORATUAL").val( data.IMB_IMH_VALORATUAL);

            }
        });

        $("#modaldetalhe").modal('show');

    }


    function fecharModalHis()
    {
        $("#modaldetalhe").modal('hide');

    }

</script>