@extends('layout.app')
@section( 'scripttop')
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


<table  id="tableindice" class="table table-striped table-bordered table-hover" >
    <thead class="thead-dark">
        <tr >
            <th width="10%" style="text-align:center"> Código </th>
            <th  width="50%" style="text-align:center"> Nome do Indíce </th>
            <th  width="10%" style="text-align:center"> Padrão </th>
            <th  width="30%" style="text-align:center"> Ações </th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

    <div class="table-footer" >
        <button class="btn btn-primary" onClick="incluir()">Incluir Novo Índice</button>
        <span>Atenção! Este botão é apenas para um novo índice e não percentuais! Para informar o percentual, click em percentual</span>

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
        <input type="hidden" id="IMB_IRJ_ID">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label class="control-label">Nome do Índice</label>
                    <input type="text" class="form-control" 
                        id="IMB_IRJ_NOME">
                </div>
            </div>
            <div class="col-md-4">
                <label class="label-control">Padrão
                    <input type="checkbox" class="form-control" 
                        id="IMB_IRJ_PADRAO">
                </label>
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

<script>
    $(document).ready(function() 
    {
        carga();

    });

    function carga()
    {
        var url = "{{route('indicereajuste.carga')}}/"+$("#I-IMB_IMB_IDMASTER").val();
        console.log(url);

        $.ajax(
            {
                url         : url,
                type        : 'get',
                dataType    : 'json',
                success     : function( data )
                {
                    linha = "";
                    $("#tableindice>tbody").empty();
                    console.log('linhas '+data.length);
                    for( nI=0;nI < data.length;nI++)
                    {
                        linha = 
                            '<tr>'+
                            '   <td>'+data[nI].IMB_IRJ_ID+'</td>'+
                            '   <td>'+data[nI].IMB_IRJ_NOME+'</td>'+
                            '   <td>'+data[nI].IMB_IRJ_PADRAO+'</td>'+
                            '   <td style="text-align:center"> '+
                            '<a  class="btn btn-sm btn-warning" href=javascript:detalhes('+data[nI].IMB_IRJ_ID+')>Percentual</a>'+
                            '<a  class="btn btn-sm btn-primary" href=javascript:editar('+data[nI].IMB_IRJ_ID+')>Editar</a>'+
                            '<a  class="btn btn-sm btn-danger" href=javascript:apagar('+data[nI].IMB_IRJ_ID+')>Apagar</a>'+
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

        $("#IMB_IRJ_ID").val( '');
        $("#IMB_IRJ_NOME").val( '');
        $("#IMB_IRJ_PADRAO").prop('checked', false);
        $("#modaldados").modal('show');
    }

    function editar( id )
    {
        var url = "{{route('indicereajuste.find')}}/"+id;
        console.log( url );

        $.ajax(
            {
                url         : url,
                type        : 'get',
                dataType    : 'json',
                success     : function( data )
                {
                    console.log( data );
                    $("#IMB_IRJ_ID").val( data.IMB_IRJ_ID);
                    $("#IMB_IRJ_NOME").val( data.IMB_IRJ_NOME);
                    $("#IMB_IRJ_PADRAO").prop('checked', false);
                    if( data.IMB_IRJ_PADRAO == 'S') 
                        $("#IMB_IRJ_PADRAO").prop('checked', true);
                    $("#modaldados").modal('show');

                }
            }
        )
        
    }

    function onGravar()
    {

        if( $("#IMB_IRJ_NOME").val()=='' ) 
        {
            alert('Informe o nome do índice de reajuste');
            return false;
        }

        $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });       

        var url = "{{ route('indicereajuste.salvar') }}";


        dados = 
        {
            IMB_IMB_ID          : $("#I-IMB_IMB_IDMASTER").val(),
            IMB_IRJ_ID          : $("#IMB_IRJ_ID").val(),
            IMB_IRJ_NOME        : $("#IMB_IRJ_NOME").val(),
            IMB_IRJ_PADRAO       : $("#IMB_IRJ_PADRAO").prop( "checked" )   ? 'S' : 'N', 
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

    function detalhes( id )
    {
        window.location = "{{ route('indicemes.index')}}/"+id;
    }

</script>

@endpush



