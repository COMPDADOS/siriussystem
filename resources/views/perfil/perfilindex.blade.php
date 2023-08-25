@extends('layout.app')
@section('scriptop')

<style>

H5 {
    text-align: center;
    color: #4682B4 ; 
    font-size: 20px;
    font-weight: bold;
}

.lbl-medidas-center {
  text-align: center;
  font-size: 20px;
  font-weight: bold;

}
.div-cor-fonte-white{
    color:white;
}
.div-cor-red {
  border-style: solid;
  border-color: red;
  color: white;
}

.div-cor-green {
    border-style: solid;
  border-color: green;
} 

.div-cor-blue {
    background-color: blue;    
    color: white;
} 

.div-cor-white{
    border-style: solid;
  border-color: white;
} 

td{text-align:center;}

</style>

@endsection

@section('content')


<table  id="i-tbltipoimovel" class="table table-striped table-bordered table-hover" >
    <thead class="thead-dark">
        <tr >
            <th width="10%" style="text-align:center"> ID </th>
            <th width="50%" style="text-align:center"> Nome </th>
            <th width="20%" style="text-align:center"> Inativado </th>
            <th width="20%" style="text-align:center"> Ações </th>        </tr>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title lbl-medidas-center" id="i-titulo">Alteração de Dados</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="IMB_ATP_ID">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nome</label>
                                <input type="text" class="form-control" 
                                id="IMB_ATP_DESCRICAO">
                            </div>
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
        url = "{{route('perfil.carga')}}";

        console.log( 'url '+url );

        $.getJSON( url, function( data)
        {

            linha = "";

            $("#i-tbltipoimovel>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                var prefixo = '';
                var datainativo = moment( data[nI].IMB_ATD_DTHINATIVO ).format('DD/MM/YYYY');
                
                //alert( datainativo );

                if( datainativo == 'Invalid date' )
                datainativo = '-';

                linha = 
                        '<tr>'+
                        '<td style="text-align:center">'+data[nI].IMB_ATP_ID+'</td>' +
                        '<td style="text-align:center">'+data[nI].IMB_ATP_DESCRICAO+'</td>' +
                        '<td style="text-align:center">'+datainativo+'</td>' +
                        '<td style="text-align:center">'+
                        '<a href=javascript:editar('+data[nI].IMB_ATP_ID+') class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"></span></a> '+
                        '<a href=javascript:apagar('+data[nI].IMB_ATP_ID+') class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a> '+
                        '<a href=javascript:permissoes('+data[nI].IMB_ATP_ID+') class="btn btn-sm btn-warning">Permissões</a> '+
                        '</td> '+
                        '</tr>';
                $("#i-tbltipoimovel").append( linha );
            }
        });

    }


    function adicionar()
    {
        $("#IMB_ATP_ID").val( '' )
        $("#IMB_ATP_DESCRICAO").val( '' )
        $("#i-titulo").html('Inclusão de Novo Portal');
        $("#modalalteracao").modal('show');
    }


    function gravar()
    {

        var por = 
        {
            IMB_ATP_ID : $("#IMB_ATP_ID").val(),
            IMB_ATP_DESCRICAO : $("#IMB_ATP_DESCRICAO").val(),
            
        };

        var url = "{{ route('perfil.salvar')}}";

        
        $.ajaxSetup(
        {
            headers:    
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });        
        
        $.ajax(
        {
            url     : url,
            data    : por,
            datatype: 'json',
            type    : 'post',
            async   : false,
            success : function()
            {
                alert( 'Registro Gravado!' );
                $("#modalalteracao").modal('hide');
                carga();

            },
            erro: function()
            {
                alert( 'erro na gravação');

            }
        });

    }

    function editar( id )
    {
        var url = "{{ route('perfil.buscar')}}/"+id;

        $.ajax(
            {
                url         : url,
                datatype    : 'json',
                async       : false,
                success     : function( data )
                {
                    $("#IMB_ATP_ID").val( data.IMB_ATP_ID);
                    $("#IMB_ATP_DESCRICAO").val( data.IMB_ATP_DESCRICAO);
                    $("#modalalteracao").modal('show');

                }
            }
        );

    }


    function apagar( id )
  {
    if (confirm("Tem certeza que deseja inativar este perfil?")) 
    {
      if ( id != '')
      {
        var url = "{{ route( 'perfil.apagar' )}}/"+id;

        $.ajaxSetup({
            headers:    
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
            });        

        $.ajax(
        {
            url : url,
            type: 'post',
            datatype: 'json',
            async:false,
            success: function( data )
            {
                alert( data );
                carga();
                
            },
            error: function()
            {
                alert( 'erro ao inativar registro');
            }

        });
      }
      

    }

  }

  function cancelar()
  {
    $("#modalalteracao").modal('hide');
  }


  function permissoes( id )
    {

      var url = "{{ route('direito.index') }}"+"/"+id;

      window.location = url;

    }


</script>
@endpush