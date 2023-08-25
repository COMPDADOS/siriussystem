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
            <th width="40%" style="text-align:center"> Nome </th>
            <th width="10%" style="text-align:center"> Qt.Imóveis </th>
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
                <input type="hidden" id="i-id" class="form-control" >
                <input type="hidden" id="IMB_POR_ID">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nome</label>
                                <input type="text" class="form-control" 
                                id="IMB_POR_NOME">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Título</label>
                                <input type="text" class="form-control" 
                                id="IMB_POR_TITULO">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Tipo Mídia</label>
                                <select id="IMB_POR_TIPOMIDIA" class="form-control" >
                                    <option value="I">Internet</option>
                                    <option value="R">Rádio</option>
                                    <option value="T">TV</option>
                                    <option value="E">Jornal Impresso</option>
                                    <option value="O">Outro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label class="control-label">Breve Descrição</label>
                                <input type="text" class="form-control" 
                                id="IMB_POR_DESCRICAO">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Login / Nome de Usuário</label>
                                <input type="text" class="form-control" 
                                id="IMB_POR_LOGIN">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Senha</label>
                                <input type="text" class="form-control" 
                                id="IMB_POR_SENHA">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="portlet box blue i-div-informacoes">
                    <div class="portlet-title">INFORMAÇÕES PARA O PORTAL
                    </div>
                    <div class="portlet-body form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Link</label>
                                        <textarea rows="4" id="IMB_POR_LINKENDPOINT" style="min-width: 100%"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Forma Envio
                                    <select id="IMB_POR_FORMAENVIO" class="form-control">
                                        <option value="A">Automático</option>
                                        <option value="M">Manual</option>
                                    </select>
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Marca D'Agua
                                    <select id="IMB_POR_MARCADAGUA"  class="form-control">
                                        <option value="S">Sim</option>
                                        <option value="N">Não</option>
                                    </select>
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Enviar Endereço
                                    <select id="IMB_POR_ENDERECOCOMPLETO"  class="form-control">
                                        <option value="S">Sim</option>
                                        <option value="N">Não</option>
                                    </select>
                                    </label>
                                </div>
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
        url = "{{route('portais.carga')}}/{{Auth::User()->IMB_IMB_ID}}";

        console.log( 'url '+url );

        $.getJSON( url, function( data)
        {

            linha = "";

            $("#i-tbltipoimovel>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                var prefixo = '';
                var datainativo = moment( data[nI].IMB_POR_DTHINATIVO ).format('DD/MM/YYYY');
                
                //alert( datainativo );

                if( datainativo == 'Invalid date' )
                datainativo = '-';

                linha = 
                        '<tr>'+
                        '<td style="text-align:center">'+data[nI].IMB_POR_ID+'</td>' +
                        '<td style="text-align:center">'+data[nI].IMB_POR_NOME+'</td>' +
                        '<td style="text-align:center">'+data[nI].QUANTIDADE +'</td>' +
                        '<td style="text-align:center">'+datainativo+'</td>' +
                        '<td style="text-align:center">'+
                        '<a href=javascript:editar('+data[nI].IMB_POR_ID+') class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"></span></a> '+
                        '<a href=javascript:apagar('+data[nI].IMB_POR_ID+') class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a> '+
                        '<a title="Replicar para todos os imoveis este portal" href=javascript:replicar('+data[nI].IMB_POR_ID+') class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-option-horizontal"></span></a> '+
                        '</td> '+
                        '</tr>';
                $("#i-tbltipoimovel").append( linha );
            }
        });

    }


    function adicionar()
    {
        $("#i-IMB_POR_ID").val( '' )
        $("#i-IMB_POR_NOME").val( '' )
        $("#i-titulo").html('Inclusão de Novo Portal');
        $("#modalalteracao").modal('show');
    }


    function gravar()
    {

        var por = 
        {
            IMB_POR_ID : $("#IMB_POR_ID").val(),
            IMB_IMB_ID : $("#I-IMB_IMB_IDMASTER").val(),
            IMB_POR_NOME : $("#IMB_POR_NOME").val(),
            IMB_POR_TITULO : $("#IMB_POR_TITULO").val(),
            IMB_POR_TIPOMIDIA : $("#IMB_POR_TIPOMIDIA").val(),
            IMB_POR_DESCRICAO : $("#IMB_POR_DESCRICAO").val(),
            IMB_POR_LOGIN : $("#IMB_POR_LOGIN").val(),
            IMB_POR_SENHA : $("#IMB_POR_SENHA").val(),
            IMB_POR_FORMAENVIO : $("#IMB_POR_FORMAENVIO").val(),
            IMB_POR_ENDERECOCOMPLETO : $("#IMB_POR_ENDERECOCOMPLETO").val(),
            IMB_POR_MARCADAGUA : $("#IMB_POR_MARCADAGUA").val(),
            IMB_POR_LINKENDPOINT : $("#IMB_POR_LINKENDPOINT").val(),
            IMB_ATD_ID : $("#I-IMB_ATD_ID").val(),
        };


        if( $("#IMB_POR_ID").val() == '' )
        {
            var url = "{{ route('portais.novo')}}";
        }
        else
        {
            var url = "{{ route('portais.salvar')}}";
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
        var url = "{{ route('portais.editar')}}/"+id;

        $.ajax(
            {
                url         : url,
                datatype    : 'json',
                async       : false,
                success     : function( data )
                {
                    var endpoint = 'http://www.siriussystem.com.br/sys/storage/integrators/olx/'+data.IMB_IMB_ID+'/portal_3.xml';
                    $("#IMB_POR_ID").val( data.IMB_POR_ID);
                    $("#IMB_POR_NOME").val( data.IMB_POR_NOME);
                    $("#IMB_POR_TITULO").val( data.IMB_POR_TITULO);
                    $("#IMB_POR_TIPOMIDIA").val( data.IMB_POR_TIPOMIDIA);
                    $("#IMB_POR_DESCRICAO").val( data.IMB_POR_DESCRICAO);
                    $("#IMB_POR_LOGIN").val( data.IMB_POR_LOGIN);
                    $("#IMB_POR_SENHA").val( data.IMB_POR_SENHA);
                    $("#IMB_POR_FORMAENVIO").val( data.IMB_POR_FORMAENVIO);
                    $("#IMB_POR_ENDERECOCOMPLETO").val( data.IMB_POR_ENDERECOCOMPLETO);
                    $("#IMB_POR_MARCADAGUA").val( data.IMB_POR_MARCADAGUA);
                    $("#IMB_POR_LINKENDPOINT").val( endpoint );
                    $("#modalalteracao").modal('show');

                }
            }
        );

    }


    function apagar( id )
  {
    if (confirm("Tem certeza que deseja inativar este portal?")) 
    {
      if ( id != '')
      {
        var url = "{{ route( 'portais.apagar' )}}/"+id;

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
            success: function()
            {
                alert('Inativado!');
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

  function replicar( id )
  {

    var url = "{{ route('portalimovel.replicarimoveis')}}/"+id;

    $.ajax(
        {
            url : url,
            dataType: 'json',
            type:'get',
            success:function()
            {
                alert('Replicado em todos os imoveis');
            }
        }
    );
  }



</script>
@endpush