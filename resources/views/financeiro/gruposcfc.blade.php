@extends('layout.app')

@section('scripttop')
<style>
    td{text-align:center;}
</style>
@endsection

@section('content')
<table  id="i-tbltipoimovel" class="table table-striped table-bordered table-hover" >
    <thead class="thead-dark">
        <tr >
            <th width="40" style="text-align:center"> Código Grupo </th>
            <th style="text-align:center"> Nome do Grupo </th>
            <th style="text-align:center"> Situação </th>
            <th width="200" style="text-align:center"> Ações </th>        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

    <div class="table-footer" >
        <button id="i-button-novo" class="btn btn-primary" onClick="adicionar()">
            Adicionar
        </button>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="modalalteracao">

<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Alteração de Dados</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="FIN_GCF_ID" class="form-control" >
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Nome do Grupo</label>
                        <input type="text" name="FIN_GCF_DESCRICAO" class="form-control" 
                        id="FIN_GCF_DESCRICAO" maxlength="50">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Desativado em</label>
                        <input type="text" id="IMB_GCF_DTHINATIVO"  class="form-control">
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
<script>

    function carga()
    {
        url = "{{route('grupocfc.carga')}}";
        console.log( url );

        $.getJSON( url, function( data)
        {

            linha = "";

            $("#i-tbltipoimovel>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                var datainativo = moment( data[nI].IMB_GCF_DTHINATIVO ).format('DD/MM/YYYY');
                
                //alert( datainativo );

                if( datainativo == 'Invalid date' )
                datainativo = '-';

                linha = 
                        '<tr>'+
                        '<td style="text-align:center valign="center">'+data[nI].FIN_GCF_ID+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].FIN_GCF_DESCRICAO+'</td>' +
                        '<td style="text-align:center valign="center">'+datainativo+'</td>' +
                        '<td style="text-align:center" valign="center"> '+
                        '<a href=javascript:editar('+data[nI].FIN_GCF_ID+') class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"></span></a> '+
                        '<a href=javascript:apagar('+data[nI].FIN_GCF_ID+') class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a> '+
                        '</td> '+
                        '</tr>';
                $("#i-tbltipoimovel").append( linha );
            }
        });

    }


    function adicionar( id )
    {

        $("#FIN_GCF_ID").val( '' )
        $("#FIN_GCF_DESCRICAO").val( '');
        $("#modalalteracao").modal('show');

    }

    function editar( id )
    {

        url = "{{route('grupocfc.find')}}/"+id;

        $.ajax(
        {
            url : url,
            datatype: 'json',
            async:false,
            success:function( data )
            {
                $("#FIN_GCF_ID").val( data.FIN_GCF_ID );
                $("#FIN_GCF_DESCRICAO").val( data.FIN_GCF_DESCRICAO );
                $("#IMB_GCF_DTHINATIVO").val( data.IMB_GCF_DTHINATIVO );
                $("#modalalteracao").modal('show');

            }
        });
    }
    
    function gravar()
    {

        url = "{{route('grupocfc.salvar')}}";

        atm =
        {

            FIN_GCF_ID : $("#FIN_GCF_ID").val(),
            FIN_GCF_DESCRICAO : $("#FIN_GCF_DESCRICAO").val(),
        }

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
                var url = "{{ route('grupocfc.inativar')}}/"+id;
                
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
    
    carga();
</script>
@endpush


