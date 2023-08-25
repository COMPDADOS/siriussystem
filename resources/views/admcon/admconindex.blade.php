

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
            <span>Administradoras de Condomínios</span>
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
                        <button class="btn blue pull-right" id='search-form' onClick="pesquisar()">Pesquisar</button>
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
                            <th width="40" style="text-align:center"> Código </th>
                            <th style="text-align:center"> Nome da Administradoa </th>
                            <th style="text-align:center"> Contato</th>
                            <th style="text-align:center"> Telefone</th>
                            <th style="text-align:center"> email</th>
                            <th style="text-align:center"> Inativado</th>
                            <th width="200" style="text-align:center"> Ações </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="mdlStatus">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>Administradora de Condomínio
                            </div>
                        </div>
                        <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                            <div class="form-body">
                                <form action=" " name="formmodalstatus" 
                                    id="i-form-status" class="horizontal-form"
                                        method="post">
                                    <input type="hidden"  id="I-IMB_ADMCON_ID">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Nome da Administradora</label>
                                                <input maxlength="40" type="text"  class="form-control" 
                                                id="I-IMB_ADMCON_NOME" value="" >
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Botões -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Contato</label>
                                                <input maxlength="20" type="text"  class="form-control" 
                                                id="I-IMB_ADMCON_CONTATO1" value="" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Telefone</label>
                                                <input maxlength="100" type="text"  class="form-control" 
                                                id="I-IMB_ADMCON_FONE1" value="" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Email</label>
                                                <input maxlength="200" type="email"  class="form-control" 
                                                id="I-IMB_ADMCON_EMAIL" value="" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions right">
                                        <button type="button" class="btn default" id="i-btn-cancelar">Cancelar</button>
                                        <button type="submit" class="btn blue" id="i-btn-gravar">
                                                <i class="fa fa-check"></i> Gravar
                                        </button>                                            
                                    </div>
                                </form>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        <div class="modal-footer">
        </div>
    </div>
</div>

@endsection

@push('script')

<script src="{{asset('/global/plugins/jquery-minicolors/jquery.minicolors.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-color-pickers.min.js')}}" type="text/javascript"></script>

<script>

var url = '';
    
    $("#i-form-status").submit
        ( function( event )
        { 
            event.preventDefault();
            //alert($("#i-idcorimo").val());
            criarStatus();
            $("#mdlStatus").modal('hide');
            
         });

    $("#i-btn-cancelar").click( function()
    {
        $("#mdlStatus").modal('hide');

    });


function cargaAdmCon()
{

    console.log( url );
    $.getJSON( url, function( data)
    {

        console.log('data '+data);
        linha = "";
        $("#I-IMB_ADMCON_ID").empty();
        for( nI=0;nI < data.length;nI++)
        {
            linha = 
                '<option value="'+data[nI].IMB_ADMCON_ID+'">'+
                data[nI].IMB_ADMCON_NOME+"</option>";
            $("#I-IMB_ADMCON_ID").append( linha );
        }       
    });

}

function cargaTotal()
{
    var url = "{{ route('condominio.carga') }}/"+$("#I-IMB_IMB_IDMASTER").val();
    $.getJSON( url, function( data)
    {
        pesquisar(data);
    });
}

    
    function apagar( id )
  {
    if (confirm("Tem certeza que deseja inativar esta administradora de condominio?")) 
    {
      if ( id != '')
      {
        var url = "{{ route( 'admcon.apagar' )}}/"+id;

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
                pesquisar();
                
            },
            error: function()
            {
                alert( 'erro ao inativar registro');
            }

        });
      }
      

    }

  }


  function adicionar( id )
    {
        $("#I-IMB_ADMCON_ID").val( '');
        $("#I-IMB_ADMCON_NOME").val( '');
        $("#I-IMB_ADMCON_CONTATO1").val( '');
        $("#I-IMB_ADMCON_FONE1").val( '');
        $("#I-IMB_ADMCON_EMAIL").val( '');
        $("#mdlStatus").modal('show');
    }

  function editar( id )
{
    $("#mdlStatus").modal('show');

    var url = "{{ route('admcon.buscar') }}/"+id;
    $.getJSON( url, function( data)
    {
        $("#I-IMB_ADMCON_ID").val( data.IMB_ADMCON_ID);
        $("#I-IMB_ADMCON_NOME").val( data.IMB_ADMCON_NOME);
        $("#I-IMB_ADMCON_CONTATO1").val( data.IMB_ADMCON_CONTATO1);
        $("#I-IMB_ADMCON_FONE1").val( data.IMB_ADMCON_FONE1);
        $("#I-IMB_ADMCON_EMAIL").val( data.IMB_ADMCON_EMAIL);
        //prioridadeCarga(  data.VIS_PRI_ID );
    });
}

function criarStatus()
    {
        
           $.ajaxSetup({
            headers:    
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
            });        

            console.log('id '+$("#i-VIS_ATS_ID").val() );
            corimo = 
                {
                                        
                    IMB_ADMCON_ID       : $("#I-IMB_ADMCON_ID").val(),
                    IMB_ADMCON_NOME     : $("#I-IMB_ADMCON_NOME").val(),
                    IMB_ADMCON_CONTATO1 : $("#I-IMB_ADMCON_CONTATO1").val(),
                    IMB_ADMCON_FONE1    : $("#I-IMB_ADMCON_FONE1").val(),
                    IMB_ADMCON_EMAIL    : $("#I-IMB_ADMCON_EMAIL").val(),
                    IMB_IMB_ID          : $("#I-IMB_IMB_IDMASTER").val(),
                };

        url = "{{ route( 'admcon.salvar' ) }}";

        $.ajax(
        {
            url: url,
            data: corimo,
            datatype:'json',
            type:'post',
            async:false,
            success: function()
            {
                $("#mdlStatus").modal("hide");
                pesquisar();
            },
            error: function()
            {
                alert( 'Houve erro na tentativa da gravação');
            }

        });

    };

    function pesquisar()
    {
        
        if( $("#i-nome-pesquisa").val() != '' )
        {
            var url = "{{ route('admcon.pesquisar') }}/"+
                        $("#i-nome-pesquisa").val()+'/'+
                        $("#I-IMB_IMB_IDMASTER").val();
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
                        datainativo = '';
                        var datainativo = moment( data[nI].IMB_ADMCON_DTHINATIVO ).format('DD/MM/YYYY');

                        if( datainativo == 'Invalid date' )
                            datainativo = '-';

                            contato = data[nI].IMB_ADMCON_CONTATO1;
                        if ( contato === null )
                           contato = '-';

                        fone = data[nI].IMB_ADMCON_FONE1;
                        if ( fone === null )
                            fone = '-';

                        email = data[nI].IMB_ADMCON_EMAIL;
                        if ( email === null )
                            email = '-';

                        linha = 
                            '<tr>'+
                            '   <td>'+data[nI].IMB_ADMCON_ID+'</td>'+
                            '   <td>'+data[nI].IMB_ADMCON_NOME+'</td>'+
                            '   <td>'+contato+'</td>'+
                            '   <td>'+fone+'</td>'+
                            '   <td>'+email+'</td>'+
                                '   <td>'+datainativo +'</td>'+
                            '   <td style="text-align:center"> '+
                                    '<a href=javascript:apagar('+data[nI].IMB_ADMCON_ID+') class="btn btn-sm btn-danger">Excluir</a> '+
                                    '<a href=javascript:editar('+data[nI].IMB_ADMCON_ID+') class="btn btn-sm btn-primary">Editar</a>'+                              
                                '</td> ';
                            '</tr>';

                        $("#tabela").append( linha );
                        
                    }

                }
            });
        }
    }

  cargaAdmCon();

</script>
@endpush




