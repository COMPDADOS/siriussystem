@extends('layout.app')

@section('scripttop')
<style>
</style>
@endsection



@section('content')
<div class="table-footer" >
        <button id="i-button-novo1" class="btn btn-primary" onClick="adicionar()">
            Adicionar
        </button>
    </div>
<table  id="i-tbltipoimovel" class="table table-striped table-bordered table-hover" >
    <thead class="thead-dark">
        <tr >
            <th style="text-align:center" oninput="this.value = this.value.toUpperCase()"/> Código CFC </th>
            <th style="text-align:center"> Nome do CFC </th>
            <th style="text-align:center">  Grupo </th>
            <th style="text-align:center"> Tipo </th>
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

    <div class="modal-dialog" style="width:70%;" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Alteração de Dados</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="ID" class="form-control" >
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label">CFC</label>
                        <input type="text" name="FIN_CFC_ID" class="form-control" 
                        id="FIN_CFC_ID" maxlength="10">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Nome do CFC</label>
                        <input type="text" name="FIN_CFC_DESCRICAO" class="form-control" 
                        id="FIN_CFC_DESCRICAO" maxlength="40">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Grupo</label>
                        <select id="FIN_GCF_ID" class="form-control">
                            <option value="">Selecione o Grupo</option>
                            @foreach( $grupo as $m )
                                <option value="{{$m->FIN_GCF_ID}}">{{$m->FIN_GCF_DESCRICAO}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Tipo</label>
                        <select id="FIN_CFC_TIPORD" class="form-control">
                            <option value="">Selecione o Tipo</option>
                            <option value="R">Receita</option>
                            <option value="D">Despesa</option>
                            <option value="T">Transitória</option>
                        </select>
                        
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
        url = "{{route('cfc.carga')}}";
        console.log( url );

        $.getJSON( url, function( data)
        {

            linha = "";

            $("#i-tbltipoimovel>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                var datainativo = moment( data[nI].FIN_CFC_DTHINATIVO ).format('DD/MM/YYYY');
                
                //alert( datainativo );

                if( datainativo == 'Invalid date' )
                datainativo = '-';

                linha = 
                        '<tr>'+
                        '<td>'+data[nI].FIN_CFC_ID+'</td>' +
                        '<td>'+data[nI].FIN_CFC_DESCRICAO+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].FIN_GCF_DESCRICAO+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].FIN_CFC_TIPORD+'</td>' +
                        '<td style="text-align:center valign="center">'+datainativo+'</td>' +
                        '<td style="text-align:center" valign="center"> '+
                        '<a href=javascript:editar("'+data[nI].ID+'") class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"></span></a> '+
                        '<a href=javascript:apagar("'+data[nI].ID+'") class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a> '+
                        '</td> '+
                        '</tr>';
                $("#i-tbltipoimovel").append( linha );
            }
        });

    }


    function adicionar( id )
    {

        $("#ID").val( '' )
        $("#FIN_CFC_ID").val( '' )
        $("#FIN_CFC_DESCRICAO").val( '');

        $("#modalalteracao").modal('show');

    }

    function editar( id )
    {

        url = "{{route('cfc.find')}}/"+id;
        console.log( url );

        $.ajax(
        {
            url : url,
            datatype: 'json',
            async:false,
            success:function( data )
            {
                $("#ID").val( data.ID);
                $("#FIN_CFC_ID").val( data.FIN_CFC_ID );
                $("#FIN_GCF_ID").val( data.FIN_GCF_ID );
                $("#FIN_CFC_DESCRICAO").val( data.FIN_CFC_DESCRICAO );
                $("#FIN_CFC_DTHINATIVO").val( data.FIN_CFC_DTHINATIVO );
                $("#FIN_CFC_TIPORD").val( data.FIN_CFC_TIPORD );
                $("#modalalteracao").modal('show');
            }
        });
    }
    
    function gravar()
    {

        url = "{{route('cfc.salvar')}}";

        atm =
        {

            ID : $("#ID").val(),
            FIN_CFC_ID : $("#FIN_CFC_ID").val(),
            FIN_GFC_ID : $("#FIN_GCF_ID").val(),
            FIN_CFC_DESCRICAO : $("#FIN_CFC_DESCRICAO").val(),
            FIN_CFC_TIPORD : $("#FIN_CFC_TIPORD").val(),

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

            },
            error:function(data)
            {
                
                alert( 'ATENÇÃO! Provalmente um CFC com este código já esteja cadastrado!');
            }
        });
    }
    
    function cancelar()
    {
        $("#modalalteracao").modal('hide');
    }

    function apagar( id )
    {
        if (confirm("Confirma a exclusão deste CFC! Atenção, este processo é irreversível!. Posso continuar?") == true) 
        {       
            var url = "{{ route('cfc.inativar')}}/"+id;
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
                    alert('Desativado!')
                    carga();
                },
                error:function( data )
                {
                    alert('Deve haver lancamentos mo caixa ou contas a pagar com este cfc! Não será permitido exclusão');
                }
            });
        }
    }
    
    carga();
</script>
@endpush


