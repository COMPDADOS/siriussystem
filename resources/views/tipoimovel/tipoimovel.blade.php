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
            <th width="40" style="text-align:center"> Código </th>
            <th style="text-align:center"> Tipo de Imóvel </th>
            <th style="text-align:center"> Sub-Tipo </th>
            <th style="text-align:center"> Pre-fixo </th>
            <th style="text-align:center"> Comercial </th>
            <th style="text-align:center"> Desativado </th>
            <th width="200" style="text-align:center"> Ações </th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

    <div class="table-footer" >
        <button id="i-button-novo" class="btn btn-primary" onClick="adicionar()">
            Adicionar
        </button>
    </div>

    <form style="display: none" action="{{route('tipoimovel.editar')}}" method="POST" id="form-alt">            
        @csrf
        <input type="hidden" id="id" name="id" />                
    </form>

    <form style="display: none" action="{{route('tipoimovel.apagar')}}" method="POST" id="form-del">            
        @csrf
        <input type="hidden" id="id" name="id" />                
    </form>
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
            <input type="hidden" id="i-id" class="form-control" >
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Nome</label>
                        <input type="text" name="IMB_TIM_DESCRICAO" class="form-control" 
                        id="i-nome-alteracao">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Sub-Tipo</label>
                        <select id="i-subtipo-alteracao"  class="form-control">
                            <option value="A">Apartamento</option>
                            <option value="C">Casa</option>
                            <option value="R">Rural</option>
                            <option value="T">Terreno</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label">Comercial</label>
                        <select id="i-comercial-alteracao"  class="form-control">
                            <option value="S">Sim</option>
                            <option value="N">Não</option>
                        </select>
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
        url = "{{route('tipoimovel.carga')}}/{{Auth::User()->IMB_IMB_ID}}";
        console.log( url );

        $.getJSON( url, function( data)
        {
            console.log('length '+data.length );

            linha = "";

            $("#i-tbltipoimovel>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                var prefixo = '';
                var datainativo = moment( data[nI].IMB_TIM_DTHINATIVO ).format('DD/MM/YYYY');
                
                //alert( datainativo );

                if( datainativo == 'Invalid date' )
                datainativo = '-';

                if ( data[nI].imb_tim_prefixo == null) 
                   prefixo = '-';
                linha = 
                        '<tr>'+
                        '<td style="text-align:center valign="center">'+data[nI].IMB_TIM_ID+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].IMB_TIM_DESCRICAO+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].IMB_TIM_SUPTIPO+'</td>' +
                        '<td style="text-align:center valign="center">'+prefixo+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].IMB_TIM_COMERCIAL+'</td>' +
                        '<td style="text-align:center valign="center">'+datainativo+'</td>' +
                        '<td style="text-align:center" valign="center"> '+
                        '<a href=javascript:editar('+data[nI].IMB_TIM_ID+') class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"></span></a> '+
                        '<a href=javascript:apagar('+data[nI].IMB_TIM_ID+') class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a> '+
                        '</td> '+
                        '</tr>';
                $("#i-tbltipoimovel").append( linha );
            }
        });
    }


    function adicionar( id )
    {

        $("#i-id").val( '' )
        $("#i-nome-alteracao").val( '');
        $("#i-subtipo-alteracao").val( '' );
        $("#i-comercial-alteracao").val( '' );
        $("#modalalteracao").modal('show');

    }

    function editar( id )
    {

        url = "{{route('tipoimovel.buscar')}}/"+id;

        $.ajax(
        {
            url : url,
            datatype: 'json',
            async:false,
            success:function( data )
            {
                $("#i-id").val( data.IMB_TIM_ID )
                $("#i-nome-alteracao").val( data.IMB_TIM_DESCRICAO )
                $("#i-subtipo-alteracao").val( data.IMB_TIM_SUPTIPO )
                $("#i-comercial-alteracao").val( data.IMB_TIM_COMERCIAL )
                $("#modalalteracao").modal('show');

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
    
    carga();
</script>
@endpush


