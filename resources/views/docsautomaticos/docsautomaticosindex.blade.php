

@extends('layout.app')

@section('scripttop')
    <link href="{{asset('/global/plugins/bootstrap-colorpicker/css/colorpicker.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/global/plugins/jquery-minicolors/jquery.minicolors.css')}}" rel="stylesheet" type="text/css" />

<style>
    th, td
    {
        text-align: center;    
        padding: 0 16px !important; /* 0 de padding na vertical e 16px na horizontal */
    }

</style>
@endsection


@section('content')


<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="#">Menu</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Documentos Automaticos</span>
        </li>
    </ul>
</div>

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Pesquisa</span>
            <i class="fa fa-search font-blue"></i>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="form-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <input type="text" 
                        class="form-control" 
                                placeholder="por ser um pedaço do nome"
                                id="i-nome-pesquisa">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <button class="btn blue pull-right" id='i-add' onClick="adicionar()">Adicionar</button>
                    </div>
                </div>
            </div>
        </div>

<!--        <hr style="margin-top: 40px;" /> -->
        <div class="row">
            <div class="col-md-12">
                <table  id="tabela" class="table table-bordered table-hover" >
                    <thead class="thead-dark">
                        <tr >
                            <th width="80%" style="text-align:center"> Nome </th>
                            <th width="20%" style="text-align:center"> Ações </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection

@push('script')

<script src="{{asset('/global/plugins/jquery-minicolors/jquery.minicolors.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-color-pickers.min.js')}}" type="text/javascript"></script>

<script>

$( document ).ready(function() 
{
    cargaDocumentos();    
    $("#sirius-menu").click();

    
});


function cargaDocumentos()
{
    var url = "{{ route('docsautomaticos.carga') }}";
    $.ajax(
    {
        url: url,
        datatype: 'json',
        type: 'get',
        success : function(data)
        {
            linha = "";
            $("#tabela>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                console.log( data );
                cword ='';
                if( data[nI].GER_DCA_WORD == 'S')
                    cword = '<i title="Documento no padrão MS-Word" class="fa fa-file-word-o btn btn btn-primary" aria-hidden="true" style="fa-2x color:blue"></i>';

                 
                linha = 
                    '<tr>'+
                    '   <td>'+data[nI].GER_DCA_NOME+'-'+cword+'</td>'+
                    '   <td style="text-align:center"> '+
                        '<a href="javascript:visualizarDocto('+data[nI].GER_DCA_ID+')" class="btn btn-sm btn-primary">Editar</a>'+                              
                        '<a href="javascript:desativar('+data[nI].GER_DCA_ID+')" class="btn btn-sm btn-danger">Excluir</a>'+                              
                        '</td> ';
                    '</tr>';
                $("#tabela").append( linha );
                        
            }

        }
    });
        //}
}

function visualizarDocto( id )
{
    
    var url =  "{{route('docsautomaticos.visualizar')}}/"+id;
    window.location = url;
    
}

function adicionar()
{
    var url =  "{{route('docsautomaticos.novo')}}";
    window.location = url;

}

function desativar( id )
{

    var url ="{{route('docsautomaticos.desativar')}}/"+id;
    $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"

            }

        });

    $.ajax(
        {
            url:url,
            dataType:'json',
            type:'post',
            success:function( data)
            {
                alert('Inativado');
                cargaDocumentos();
            },
            error:function()
            {
                alert('erro na inativação');
            }
        }
    );

}
</script>
@endpush




