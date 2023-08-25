@extends('layout.app')

@section('scripttop')
<style>


    
</style>
@endsection

@section('content')
<table  id="i-tbltipoimovel" class="table table-striped table-bordered table-hover" >
    <thead class="thead-dark">
        <tr >
            <th style="text-align:center"> Código Sub-Conta </th>
            <th style="text-align:center"> Nome da Sub-Conta </th>
            <th style="text-align:center">  Pertencente ao Grupo </th>
            <th style="text-align:center"> Situação </th>
            <th width="200px" style="text-align:center"> Ações </th>        </tr>
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
            <input type="hidden" id="idsubconta" class="form-control" >
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Código da Sub-Conta</label>
                        <input type="text" name="FIN_SBC_ID" class="form-control" 
                        id="FIN_SBC_ID" maxlength="10">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Nome da Sub-Conta</label>
                        <input type="text" name="FIN_SBC_DESCRICAO" class="form-control" 
                        id="FIN_SBC_DESCRICAO" maxlength="40">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Grupo de Consolidação</label>
                        <select id="FIN_SBC_IDCONSOL" class="form-control">
                            <option value="">Selecione o Grupo</option>
                            @foreach( $grupo as $m )
                                <option value="{{$m->FIN_SBC_ID}}">{{$m->FIN_SBC_DESCRICAO}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Desativado em</label>
                        <input type="text" id="FIN_SBC_DTHINATIVA"  class="form-control">
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
        url = "{{route('subconta.carga')}}";
        console.log( url );

        $.getJSON( url, function( data)
        {

            linha = "";

            $("#i-tbltipoimovel>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                var datainativo = moment( data[nI].FIN_SBC_DTHINATIVA ).format('DD/MM/YYYY');
                
                //alert( datainativo );

                if( datainativo == 'Invalid date' )
                datainativo = '-';

                linha = 
                        '<tr>'+
                        '<td >'+data[nI].FIN_SBC_ID+'</td>' +
                        '<td >'+data[nI].FIN_SBC_DESCRICAO+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].FIN_SBC_DESCRICAOGRUPO+'</td>' +
                        '<td style="text-align:center valign="center">'+datainativo+'</td>' +
                        '<td style="text-align:center" valign="center"> '+
                        '<a href=javascript:editar(\''+data[nI].ID+'\') class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"></span></a> '+
                        '<a href=javascript:apagar(\''+data[nI].ID+'\') class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a> '+
                        '</td> '+
                        '</tr>';
                $("#i-tbltipoimovel").append( linha );
            }
        });

    }


    function adicionar( id )
    {

        $("#idsubconta").val( '' )
        $("#FIN_SBC_ID").val( '' )
        $("#FIN_SBC_DESCRICAO").val( '');
        $("#modalalteracao").modal('show');

    }

    function editar( id )
    {

        url = "{{route('subconta.find')}}/"+id;
        console.log( url );

        $.ajax(
        {
            url : url,
            datatype: 'json',
            async:false,
            success:function( data )
            {
                $("#idsubconta").val( data.ID );
                $("#FIN_SBC_ID").val( data.FIN_SBC_ID );
                $("#FIN_SBC_IDCONSOL").val( data.FIN_SBC_IDCONSOL );
                $("#FIN_SBC_DESCRICAO").val( data.FIN_SBC_DESCRICAO );
                $("#FIN_SBC_DTHINATIVA").val( data.FIN_SBC_DTHINATIVA );
                $("#modalalteracao").modal('show');
            }
        });
    }
    
    function gravar()
    {

        url = "{{route('subconta.salvar')}}";

        atm =
        {

            
            ID : $("#idsubconta").val(),
            FIN_SBC_ID : $("#FIN_SBC_ID").val(),
            FIN_SBC_IDCONSOL : $("#FIN_SBC_IDCONSOL").val(),
            FIN_SBC_DESCRICAO : $("#FIN_SBC_DESCRICAO").val(),

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
                preencherGrupo();
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
                var url = "{{ route('subconta.inativar')}}/"+id;
                
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


    function preencherGrupo()
    {
        var url = "{{ route('subconta.carga')}}";
        $.ajax(
        {
            url : url,
            datatype: 'json',
            async:false,
            type:"GET",
            success:function( data )
            {
                $("#FIN_SBC_IDCONSOL").empty();
                linha = '<option value=""></option>';
                $("#FIN_SBC_IDCONSOL").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha = 
                    '<option value="'+data[nI].FIN_SBC_ID+'">'+
                            data[nI].FIN_SBC_DESCRICAO+"</option>";
                            $("#FIN_SBC_IDCONSOL").append( linha );
                }
            }

        });
            
    }

        
</script>
@endpush


