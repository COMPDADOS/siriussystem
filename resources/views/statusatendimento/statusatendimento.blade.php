

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
<table  id="tabela" class="table table-bordered table-hover" >
    <thead class="thead-dark">
        <tr >
            <th width="40" style="text-align:center"> Código </th>
            <th style="text-align:center"> Nome do Status </th>
            <th style="text-align:center"> Escala </th>
            <th width="200" style="text-align:center"> Ações </th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<div class="table-footer" >
        <button id="i-btn_novo" class="btn btn-primary" onClick="adicionar()">
            Adicionar novo
        </button>
        

</div>


<div class="modal" tabindex="-1" role="dialog" id="mdlStatus">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>Status de Atendimento
                            </div>
                        </div>
                        <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                            <div class="form-body">
                                <form action=" " name="formmodalstatus" 
                                    id="i-form-status" class="horizontal-form"
                                        method="post">
                                    <input type="hidden" name="VIS_ATS_ID" id="i-VIS_ATS_ID">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Nome</label>
                                                <input maxlength="20" type="text" name="VIS_ATS_NOME" class="form-control" 
                                                id="i-VIS_ATS_NOME" value="" >
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Botões -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Escala de Andamento</label>
                                                <input type="number" name="VIS_ATS_ESCALAANDAMENTO" max="10"
                                                min="1" class="form-control" 
                                                id="i-VIS_ATS_ESCALAANDAMENTO" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" 
                                            class="form-control demo" data-control="hue" name="VIS_ATS_COLOR"
                                            id="i-VIS_ATS_COLOR">
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

function carregarDados()


    {
        var url = "{{ route('statusatendimentolista') }}/"+$("#I-IMB_IMB_IDMASTER").val();
        $.getJSON( url, function( data)
        {
            linha = "";
            $("#tabela>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                linha = 
                    '<tr bgcolor="'+data[nI].VIS_ATS_COLOR+'">'+
                    '   <td>'+data[nI].VIS_ATS_ID+'</td>'+
                    '   <td>'+data[nI].VIS_ATS_NOME+'</td>'+
                    '   <td>'+data[nI].VIS_PRI_NOME+'</td>'+
                    '   <td>'+data[nI].VIS_ATS_ESCALAANDAMENTO+'</td>'+
                    '   <td style="text-align:center"> '+
                              '<a href=javascript:apagarStatus('+data[nI].VIS_ATS_ID+') class="btn btn-sm btn-danger">Excluir</a> '+
                              '<a href=javascript:editarStatus('+data[nI].VIS_ATS_ID+') class="btn btn-sm btn-primary">Editar</a>'+                              
                        '</td> ';
                    '</tr>';

                $("#tabela").append( linha );
                        
            }
        });
    }

    

    
    function apagarStatus( id )
  {
    if (confirm("Tem certeza que deseja tirar este representante?")) 
    {
      if ( id != '')
      {
        var url = "{{ route( 'statusatendimento.apagar' )}}/"+id;

        $.getJSON( url, function( data)
        {
          console.log(data);
        });
      }
      
      carregarDados();

    }

  }


  function adicionar( id )
    {

        $("#i-VIS_ATS_ID").val( '');
        $("#i-VIS_ATS_NOME").val( '');
        $("#i-VIS_ATS_ESCALAANDAMENTO").val( '');
        $("#i-VIS_ATS_COLOR").val( '');
//        $("#i-VIS_ATS_COLOR").css('background', data.VIS_ATS_COLOR );
        $("#mdlStatus").modal('show');

    }

  function editarStatus( id )
{
    $("#mdlStatus").modal('show');

    var url = "{{ route('statusatendimento.show') }}/"+id;
    $.getJSON( url, function( data)
    {
        $("#i-VIS_ATS_ID").val( data.VIS_ATS_ID);
        $("#i-VIS_ATS_NOME").val( data.VIS_ATS_NOME);
        $("#i-VIS_ATS_ESCALAANDAMENTO").val( data.VIS_ATS_ESCALAANDAMENTO);
        $("#i-VIS_ATS_COLOR").val( data.VIS_ATS_COLOR);
        $("#i-VIS_ATS_COLOR").css('background', data.VIS_ATS_COLOR );
        //prioridadeCarga(  data.VIS_PRI_ID );
    });
}

function prioridadeCarga( id )
{
    var url = "{{ route('prioridadeatendimentolista') }}/"+$("#I-IMB_IMB_IDMASTER").val();
    $.getJSON( url, function( data)
    {
        linha = "";
            $("#i-select-prioridade").empty();
            for( nI=0;nI < data.length;nI++)
            {

                if ( data[nI].VIS_PRI_ID  == id )
                {
                    linha = 
                        '<option value="'+data[nI].VIS_PRI_ID+'" selected>'+
                        data[nI].VIS_PRI_NOME+"</option>";
                    $("#i-select-prioridade").append( linha )
                }
                else
                {
                linha = 
                        '<option value="'+data[nI].VIS_PRI_ID+'">'+
                        data[nI].VIS_PRI_NOME+"</option>";
                    $("#i-select-prioridade").append( linha );
                }       
            }
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
            VIS_ATS_ID : $("#i-VIS_ATS_ID").val(),
            VIS_ATS_NOME : $("#i-VIS_ATS_NOME").val(),
            //VIS_PRI_ID : $("#i-select-prioridade").val(),
            VIS_ATS_ESCALAANDAMENTO: $("#i-VIS_ATS_ESCALAANDAMENTO").val(),
            VIS_ATS_COLOR :  $("#i-VIS_ATS_COLOR").val(),
            IMB_IMB_ID : $("#I-IMB_IMB_IDMASTER").val(),
            IMB_ATD_ID : $("#I-IMB_ATD_ID").val()
        };

        url = "{{ route( 'statusatendimento.salvar' ) }}";

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
                carregarDados();
            },
            error: function()
            {
                alert( 'Houve erro na tentativa da gravação');
            }

        });

    };

  carregarDados();

</script>
@endpush




