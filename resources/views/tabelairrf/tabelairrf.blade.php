@extends('layout.app')
@section('scripttop')
<style>
    td{text-align:center;}
</style>


@endsection
@section('content')
<table  id="tblirrf" class="table table-striped table-bordered table-hover" >
    <thead class="thead-dark">
        <tr >
            <th style="text-align:center"> De</th>
            <th style="text-align:center"> Até </th>
            <th style="text-align:center"> Percentual </th>
            <th style="text-align:center"> Dedução </th>
            <th width="200" style="text-align:center"> Ações </th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<div class="modal fade" id="modalirrfman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog "style="width:60%;" >        
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alteração de Dados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="i-id" class="form-control" >
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label">De</label>
                        <input type="text" name="IMB_TIR_DE" id="IMB_TIR_DE_MAN" class="form-control valor">
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Até</label>
                        <input type="text" name="IMB_TIR_ATE" id="IMB_TIR_ATE_MAN" class="form-control valor">
                    </div>
                    <div class="col-md-2">
                        <label class="control-label">Percentual</label>
                        <input type="text" name="IMB_TIR_PERCENTUAL" id="IMB_TIR_PERCENTUAL_MAN" class="form-control valor">
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Dedução</label>
                        <input type="text" name="IMB_TIR_DEDUCAO" id="IMB_TIR_DEDUCAO_MAN" class="form-control valor">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn default" 
                    id="i-btn-cancelar" onClick="cancelar()">Cancelar
            </button>
            <button type="button" class="btn blue" id="i-btn-gravar"
                    onClick="gravar()">
                    <i class="fa fa-check"></i> Gravar
            </button>                                            
        </div>
    </div>
</div>



@endsection

@push('script')
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>

<script>

    $(document).ready(function() 
    {
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

         carga();
    });

    function carga()
    {
        url = "{{route('tabelairrf.carga')}}";

        $.getJSON( url, function( data)
        {

            linha = "";

            $("#tblirrf>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                linha = 
                        '<tr>'+
                        '<td style="text-align:center valign="center">'+data[nI].IMB_TIR_DE+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].IMB_TIR_ATE+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].IMB_TIR_PERCENTUAL+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].IMB_TIR_DEDUCAO+'</td>' +
                        '<td style="text-align:center" valign="center"> '+
                        '<a href=javascript:editar('+data[nI].IMB_TIR_ID+') class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"></span></a> '+
                        '</td> '+
                        '</tr>';
                $("#tblirrf").append( linha );
            }
        });
    }


    function adicionar( id )
    {

        $("#i-id").val( '' )
        $("#i-nome-alteracao").val( '');
        $("#i-subtipo-alteracao").val( '' );
        $("#i-comercial-alteracao").val( '' );
        $("#modalirrfman").modal('show');

    }

    function editar( id )
    {

        url = "{{route('tabelairrf.find')}}/"+id;

        $.ajax(
        {
            url : url,
            datatype: 'json',
            async:false,
            success:function( data )
            {
                console.log(data);
                $("#IMB_TIR_DE_MAN").val( formatarBRSemSimbolo(parseFloat(data.IMB_TIR_DE)) )
                $("#IMB_TIR_ATE_MAN").val( formatarBRSemSimbolo(parseFloat(data.IMB_TIR_ATE )) )
                $("#IMB_TIR_PERCENTUAL_MAN").val(formatarBRSemSimbolo(parseFloat( data.IMB_TIR_PERCENTUAL )) )
                $("#IMB_TIR_DEDUCAO_MAN").val( formatarBRSemSimbolo(parseFloat(data.IMB_TIR_DEDUCAO)) )
                $("#modalirrfman").modal('show');

            },
            error:function()
            {
                alert('não encontrado!');
            }
        });
    }
    
    function gravar()
    {


        if ( $("#i-id").val() == '' )
            url = "{{route('tipoimovel.store')}}"
        else
            url = "{{route('tipoimovel.update')}}";

        atm =
        {

            id : $("#i-id").val(),
            IMB_IMB_ID :  $("#I-IMB_IMB_IDMASTER").val(),
            IMB_TIM_DESCRICAO :  $("#i-nome-alteracao").val(),
            IMB_TIM_SUPTIPO :  $("#i-subtipo-alteracao").val(),
            IMB_TIM_COMERCIAL :  $("#i-comercial-alteracao").val(),
        }

        alert( atm.IMB_IMB_ID );

        $.ajaxSetup(
            {
              headers:
              {
                  'X-CSRF-TOKEN': "{{csrf_token()}}"
              }
            });


        $.ajax(
        {
            url : url,
            datatype: 'json',
            async:false,
            data:atm,
            type:"post",
            success:function( data )
            {
                console.log(data);
                alert('Gravado');
                carga();
                $("#modalalteracao").modal('hide');

            }
        });
    }
    
    function cancelar()
    {
        $("#modalalteracao").modal('hide');
    }

    function apagar( id )
    {
        Swal.fire({
        title: 'Tem certeza que deseja Excluir?',
        text: "Se apagar o registro, será um processo irreversível!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Confirmar Exclusão'
        }).then((result) => 
        {
            if (result.value) 
            {
                var url = "{{ route('tipoimovel.apagar')}}/"+id;
                
                $.ajaxSetup(
                {
                    headers:
                    {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    }
                });

                $.ajax(
                {
                    url : url,
                    datatype: 'json',
                    async:false,
                    type:"post",
                    success:function( data )
                    {
                        console.log( data )
                        Swal.fire(
                        {
                            position: 'center',
                            icon: 'success',
                            title: 'Registro inativado com Sucesso!',
                            showConfirmButton: true,
                            timer: 3500
                        });
                        carga();
                    }
                });
            }
        });


    }

    function gravar()
    {
        $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });
            $.ajax
            ({
                type: "delete",
                url: url,
                context: this,
                success: function()
                {
                    CarregarCorImo( $("#i-idimovel").val() );
                },
                error: function( error )
                {
                    console.log(error);
                }
            });
        };
                
    }
    
    carga();
</script>
@endpush


