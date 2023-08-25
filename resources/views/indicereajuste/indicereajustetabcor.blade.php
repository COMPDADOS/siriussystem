@extends('layout.app')
@section('scripttop')
<style>
th, td, tr{
    vertical-align: middle !important; /* alinha verticalmente */
    height: 36px; /* altura customizada da celula */
    padding: 0 16px !important; /* 0 de padding na vertical e 16px na horizontal */
    text-align:center;
}
</style>
@endsection
@section('content')
<input type="hidden" id="IMB_IRJ_ID" value="{{$id}}">
<table  id="tableindice" class="table table-striped table-bordered table-hover" >
    <thead class="thead-dark">
        <tr >
        <th width="40%" style="text-align:center"> índice</th>
            <th width="10%" style="text-align:center"> Mês </th>
            <th width="10%" style="text-align:center"> Ano </th>
            <th width="20%" style="text-align:center"> %  </th>
            <th width="20%" style="text-align:center"> Ações </th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

    <div class="table-footer" >
        <button class="btn btn-primary" onClick="incluir()">Adicionar Índice do Mês</button>
    </div>



<div class="modal" tabindex="-1" role="dialog" id="modaldados">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Índice Reajuste</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="IMB_TBC_ID">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Mês</label>
                    <input type="number" name="IMB_TBC_MES" class="form-control" 
                        id="IMB_TBC_MES">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Ano</label>
                    <input type="number" name="IMB_TBC_ANO" class="form-control" 
                    id="IMB_TBC_ANO">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Percentual</label>
                    <input type="text" name="IMB_TBC_INDICECORRECAO" class="form-control perc4" 
                    id="IMB_TBC_FATOR">
                </div>
            </div>
        </div>
    </div>
    <!-- Botões -->
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" onClick="onGravar()">Gravar</button>
    </div>
  </div>
</div>    
@endsection

@push('script')
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function() 
    {
        $('.perc4').inputmask('decimal', 
      {
        radixPoint:",",
        groupSeparator: ".",
        autoGroup: true,
        digits: 4,
        digitsOptional: false,
        placeholder: '0',
        rightAlign: false,
        onBeforeMask: function (value, opts) 
        {
          return value;
        }
      });

        carga();

    });

    function carga()
    {
        var url = "{{route('indicemes.carga')}}/"+$("#IMB_IRJ_ID").val();

        $.ajax(
            {
                url         : url,
                type        : 'get',
                dataType    : 'json',
                success     : function( data )
                {
                    console.log( data );

                    linha = "";
                    $("#tableindice>tbody").empty();
                    console.log('linhas '+data.length);
                    for( nI=0;nI < data.length;nI++)
                    {
                        linha = 
                            '<tr>'+
                            '   <td>'+data[nI].IMB_IRJ_NOME+'</td>'+
                            '   <td>'+data[nI].IMB_TBC_MES+'</td>'+
                            '   <td>'+data[nI].IMB_TBC_ANO+'</td>'+
                            '   <td>'+data[nI].IMB_TBC_FATOR+'</td>'+
                            '   <td style="text-align:center"> '+
                            '<a  class="btn btn-sm btn-primary" href=javascript:editar('+data[nI].IMB_TBC_ID+')>Editar</a>'+
                            '<a  class="btn btn-sm btn-danger" href=javascript:apagar('+data[nI].IMB_TBC_ID+')>Apagar</a>'+
                            '   </td>'+
                            '</tr>';

                        $("#tableindice").append( linha );

                    }

                }
            }
        )
    }

    function incluir()
    {
        $("#IMB_TBC_ID").val( '');
        $("#IMB_TBC_MES").val( '');
        $("#IMB_TBC_ANO").val( '');
        $("#IMB_TBC_FATOR").val( '');
        $("#modaldados").modal('show');
    }

    function onGravar()
    {

        if( $("#IMB_TBC_MES").val() < 1 || $("#IMB_TBC_MES").val() > 12 ) 
        {
            alert('Informe corretamente o mês');
            return false;
        }

        if( $("#IMB_TBC_ANO").val() < 2000 || $("#IMB_TBC_ANO").val() > 2050 ) 
        {
            alert('Informe corretamente o ano');
            return false;
        }



        url = "{{route('indicemes.buscarmesano')}}/"+
            $("#IMB_IRJ_ID").val()  + '/'+
            $("#IMB_TBC_MES").val() + '/'+
            $("#IMB_TBC_ANO").val();

        $.ajax(
            {
                url : url,
                type:'get',
                dataType : 'json',
                success : function(data)
                {
                   
                    if( data !='' && $("#IMB_TBC_ID").val() == '' )
                    {
                        alert('Os valores para este índice e para este mês e ano, já foram cadastrados');
                        return false;
                    }
                    else
                    {
                        $.ajaxSetup(
                        {
                            headers:
                            {
                                'X-CSRF-TOKEN': "{{csrf_token()}}"
                            }
                        });       

                        var url = "{{ route('indicemes.gravar') }}";

                        dados = 
                        {
                            IMB_TBC_ID                    : $("#IMB_TBC_ID").val(),
                            IMB_TBC_INDICEID              : $("#IMB_IRJ_ID").val(),
                            IMB_TBC_MES                   : $("#IMB_TBC_MES").val(),
                            IMB_TBC_ANO                   : $("#IMB_TBC_ANO").val(),
                            IMB_TBC_INDICECORRECAO        : realToDolar($("#IMB_TBC_FATOR").val()),
                            IMB_TBC_FATOR                 : realToDolar($("#IMB_TBC_FATOR").val()),
                            IMB_IMB_ID                    :  $("#I-IMB_IMB_IDMASTER").val(),   
                        };

                        $.ajax(
                        {
                            url                 : url, 
                            data                : dados,
                            type                : 'post',
                            datatype            : 'json',
                            async               : false,
                            success             : function()
                            {
                                $("#modaldados").modal("hide");
                                carga();
                            }
                        });
                    }
                }
            }
        )


    }

    function editar( id )
    {
        url = "{{route('indicemes.find')}}/"+id;

        console.log( 'url: '+url );

        $.ajax(
            {
                url : url,
                type: 'get',
                dataType: 'json',
                success : function( data )
                {
                    $("#IMB_TBC_ID").val( data.IMB_TBC_ID);
                    $("#IMB_TBC_MES").val( data.IMB_TBC_MES);
                    $("#IMB_TBC_ANO").val( data.IMB_TBC_ANO);
                    $("#IMB_TBC_FATOR").val( dolarToReal(data.IMB_TBC_FATOR));
                    $("#modaldados").modal('show');
                }
            }
        )
    }


</script>
@endpush





