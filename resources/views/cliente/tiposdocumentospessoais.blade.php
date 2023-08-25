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

.inativado
{
    text-decoration: line-through;
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
            <th width="40%" style="text-align:center"> Tipo de Documento </th>
            <th width="10%" style="text-align:center"> Fonte </th>
            <th width="10%" style="text-align:center"> Inativado </th>
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
                <input type="hidden" id="IMB_TDP_ID">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nome</label>
                                <input type="text" class="form-control" 
                                id="IMB_TPD_NOME">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Origem</label>
                                <select class="form-control" id="IMB_TPD_DESTINO">
                                    <option value="Pessoal">Pessoal</option>
                                    <option value="Pessoal">Extras</option>
                                    <option value="Pessoal">Imóvel</option>
                                </select>
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
        url = "{{route('tipodocpessoal.carga')}}";

        $.getJSON( url, function( data)
        {

            linha = "";

            $("#i-tbltipoimovel>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                classe="";
                inativado = '-';
                if( data[nI].IMB_TPD_DTHINATIVO != null )
                {   
                    inativado = moment(data[nI].IMB_TPD_DTHINATIVO).format('DD/MM/YYYY');
                    classe="inativado";
                };
                    

                linha = 
                        '<tr class="'+classe+'">'+
                        '<td style="text-align:center">'+data[nI].IMB_TDP_ID+'</td>' +
                        '<td style="text-align:center">'+data[nI].IMB_TPD_NOME+'</td>' +
                        '<td style="text-align:center">'+data[nI].IMB_TPD_DESTINO +'</td>' +
                        '<td style="text-align:center">'+inativado +'</td>' +
                        "<td align='center'>"+
                            '<button class="btn  btn-sm btn-primary" onClick="editar('+data[nI].IMB_TDP_ID+')">Editar</button>'+
                            '<button class="btn  btn-sm btn-danger" onClick="apagar('+data[nI].IMB_TDP_ID+')">Excluir</button>'+
                        "</td>"
                        '</tr>';
                $("#i-tbltipoimovel").append( linha );
            }
        });

    }


    function adicionar()
    {
        $("#IMB_TDP_ID").val( '' )
        $("#IMB_TPD_NOME").val( '' )
        $("#IMB_TPD_DESTINO").val( '' )
        $("#i-titulo").html('Inclusão de Novo Tipo de Documento');
        $("#modalalteracao").modal('show');
    }


    function gravar()
    {

        var por = 
        {
            IMB_TDP_ID : $("#IMB_POR_ID").val(),
            IMB_TPD_NOME : $("#IMB_TPD_NOME").val(),
            IMB_TPD_DESTINO : $("#IMB_TPD_DESTINO").val(),
        };

        var url = "{{ route('tipodocpessoal.salvar')}}";

        
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
        var url = "{{ route('tipodocpessoal.find')}}/"+id;

        $.ajax(
            {
                url         : url,
                datatype    : 'json',
                async       : false,
                success     : function( data )
                {
                    $("#IMB_TDP_ID").val( data.IMB_TDP_ID);
                    $("#IMB_TPD_NOME").val( data.IMB_TPD_NOME);
                    $("#IMB_TPD_DESTINO").val( data.IMB_TPD_DESTINO);
                    $("#modalalteracao").modal('show');

                }
            }
        );

    }


    function apagar( id )
  {
    if (confirm("Tem certeza que deseja inativar este tipo de documento?")) 
    {
      if ( id != '')
      {
        var url = "{{ route( 'tipodocpessoal.inativar' )}}/"+id;

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