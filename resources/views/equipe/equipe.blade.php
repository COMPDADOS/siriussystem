@extends('layout.app')
@section('scripttop')
<style>

.font-azul
{
    background-color:#6666ff;
}
    td{text-align:center;}


    input[type="checkbox"] {
      position: relative;
      width: 40px;
      height: 20px;
      -webkit-appearance: none; /* Aparência padrão do checkbox é anulada */
      background-color: #cccccc; /* cor de fundo */
      outline: none; /* sem borda externa */
      border-radius: 20px; /* arrendodamento dos cantos */
      box-shadow: inset 0 0 5px rgba(95, 85, 85, 0.2); /* sombra interna */
      transition: .2s; /* tempo de transição que vai ocorrer com a cor de fundo e com a posção da bolinha*/
      cursor: pointer;/* estabelecer que o mouse vai ter uma aparência como se fosse clicar em um botão */
    }

    input:checked[type="checkbox"] {
      background-color: #00b33c;/* cor de fundo que vai ser aplicada quando o checkbox tiver uma alteração para checked */
    }
/* O seletor :before pode criar objetos antes do elemento principal, no caso cria a bolinha do botão  */
    input[type="checkbox"]:before {
      content: '';
      position: absolute;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      top: 0;
      left: 0;
      background: #ffffff;
      transform: scale(1.2);
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      transition: .2s;
    }

    input:checked[type="checkbox"]:before {
      left: 20px;
    }    

</style>


@endsection
@section('content')
@php
    $tps = app('App\Http\Controllers\ctrEquipe')->carga();
@endphp
<table  id="i-tbltipoimovel" class="table table-striped table-bordered table-hover" >
    <thead class="thead-dark">
        <tr >
            <th width="40" style="text-align:center"> Código </th>
            <th style="text-align:center"> Equipe </th>
            <th style="text-align:center"> Desativado </th>
            <th width="200" style="text-align:center"> Ações </th>
        </tr>
    </thead>
    <tbody>
        @foreach( $tps as $tp )
            <td>{{$tp->IMB_EQP_ID}}</td>
            <td>{{$tp->IMB_EQP_DESCRICAO}}</td>
            <td>{{$tp->IMB_EQP_DTHINATIVO}}</td>
            <td>
                <a href="javascript:editar({{$tp->IMB_EQP_ID}})" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"></span></a> 
                <a href="javascript:apagar({{$tp->IMB_EQP_ID}})" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a> 
            </td>
        @endforeach
    </tbody>
</table>

    <div class="table-footer" >
        <button id="i-button-novo" class="btn btn-primary" onClick="adicionar()">
            Adicionar
        </button>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="modalalteracao">

    <div class="modal-dialog "style="width:80%;" >

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
                <div class="col-md-12">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Nome da Equipe</label>
                        <input type="text" name="IMB_EQP_DESCRICAO" class="form-control" 
                            id="IMB_EQP_DESCRICAO_ALT">
                     </div>
                </div>
                <div class="col-md-6">
                            <label class="control-label">Atuações da Equipe</label>
                            <select name="atuacao[]" class="form-control multiple-select font-a" id="i-atuacao" multiple>
                            </select>
                            
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>Definição dos Membros da Equipe
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="form-body" >
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="portlet box blue-hoki">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-gift"></i>Disponíveis
                                                    </div>
                                                    <div class="tools">
                                                        <a href="javascript:;" class="collapse"> </a>
                                                    </div>
                                                </div>
                                                <div class="portlet-body form">                                        
                                                    <table  id="i-tbldisponiveis" class="table table-striped table-bordered table-hover" >
                                                        <thead class="thead-dark">
                                                            <tr >
                                                                <th class="escondido"></th>
                                                                <th width="20%" style="text-align:center"> </th>
                                                                <th width="75%" style="text-align:center">Nome </th>
                                                                <th width="5%" style="text-align:center"> </th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="portlet box blue">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-gift"></i>Selecionados para Equipe
                                                    </div>
                                                    <div class="tools">
                                                        <a href="javascript:;" class="collapse"> </a>
                                                    </div>
                                                </div>
                                                <div class="portlet-body form">                                        
                                                    <table  id="i-tblmembros" class="table table-striped table-bordered table-hover" >
                                                        <thead class="thead-dark">
                                                            <tr >
                                                            <th class="escondido"> </th>
                                                            <th width="20%" style="text-align:center"> </th>
                                                                <th width="60%" style="text-align:center">Nome </th>
                                                                <th width="10%" style="text-align:center">Gerente</th>
                                                                <th width="10%" style="text-align:center">Lider</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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



@endsection

@push('script')
<script>
    $(document).ready(function() {
        carga();
        $("#i-atuacao").select2({
                placeholder: 'Selecione ',
                width: null
            });


    });



    function adicionar( id )
    {

        $("#i-id").val( '' )
        $("#IMB_EQP_DESCRICAO_ALT").val( '');
        cargaAtdDisponiveis(0);
        cargaAtdMembros(0);
        $("#modalalteracao").modal('show');

    }

    function editar( id )
    {

        cargaAtuacao( id );
        cargaAtdDisponiveis(id);
        cargaAtdMembros(id);
        url = "{{route('equipe.buscar')}}/"+id;
        


        $.ajax(
        {
            url : url,
            datatype: 'json',
            async:false,
            success:function( data )
            {
                $("#i-id").val( data.IMB_EQP_ID )
                $("#IMB_EQP_DESCRICAO_ALT").val( data.IMB_EQP_DESCRICAO )
                $("#modalalteracao").modal('show');

            }
        });
    }
    
    function gravar()
    {

        atuacaosel = $('#i-atuacao').select2('data');

        var arraymembros = [];

        var table = document.getElementById('i-tblmembros');
       debugger;
       for (var r = 1, n = table.rows.length; r < n; r++)
        {

            gerente = $("#chkgerente"+table.rows[r].cells[0].innerHTML).prop('checked') ? 'S' : 'N';
            lider = $("#chklider"+table.rows[r].cells[0].innerHTML).prop('checked') ? 'S' : 'N';
            atdid = table.rows[r].cells[0].innerHTML;

            novoitem = {"IMB_ATD_ID" : atdid, "IMB_EPM_GERENTE" : gerente, "IMB_EPM_LIDER": lider };
            arraymembros.push( novoitem );
        }
        
        console.log( arraymembros );

        neg = atuacaosel.map( function(eLem )
            {
                return eLem.id;
            });


        

        url = "{{route('equipe.salvar')}}"
        atm =
        {

            id : $("#i-id").val(),
            IMB_EQP_DESCRICAO :  $("#IMB_EQP_DESCRICAO_ALT").val(),
            atuacao: neg,
            membros:arraymembros
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
                var url = "{{ route('equipe.apagar')}}/"+id;
                
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
    function carga()
    {
        url = "{{route('equipe.carga')}}";
        console.log( url );

        $.getJSON( url, function( data)
        {
            console.log('length '+data.length );

            linha = "";

            $("#i-tbltipoimovel>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                var prefixo = '';
                var datainativo = moment( data[nI].IMB_EQP_DTHINATIVO ).format('DD/MM/YYYY');
                
                //alert( datainativo );

                if( datainativo == 'Invalid date' )
                datainativo = '-';

                linha = 
                        '<tr>'+
                        '<td style="text-align:center valign="center">'+data[nI].IMB_EQP_ID+'</td>' +
                        '<td style="text-align:center valign="center">'+data[nI].IMB_EQP_DESCRICAO+'</td>' +
                        '<td style="text-align:center valign="center">'+datainativo+'</td>' +
                        '<td style="text-align:center" valign="center"> '+
                        '<a href=javascript:editar('+data[nI].IMB_EQP_ID+') class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"></span></a> '+
                        '<a href=javascript:apagar('+data[nI].IMB_EQP_ID+') class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a> '+
                        '</td> '+
                        '</tr>';
                $("#i-tbltipoimovel").append( linha );
            }
        });
    }

    function cargaAtuacao( id )
        {


            var url = "{{ route('equipe.negocio')}}/"+id;
            $.getJSON( url, function( data )
            {
                $("#i-atuacao").empty();
                linha = '<option value="">Selecione uma ou mais</option>';
                $("#i-atuacao").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                 
                    linha =
                    '<option value="'+data[nI].IMB_NEG_ID+'"'+data[nI].selection+'>'+
                        data[nI].IMB_NEG_DESCRICAO+"</option>";
                        $("#i-atuacao").append( linha );

                }

            });

        }

        function cargaAtdDisponiveis( id )
    {
        url = "{{route('equipe.membros')}}/"+id;

        $.getJSON( url, function( data)
        {
            console.log('length '+data.length );

            linha = "";

            $("#i-tbldisponiveis>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                var prefixo = '';
                var datainativo = moment( data[nI].IMB_EPM_DTHINATIVO ).format('DD/MM/YYYY');
                
                //alert( datainativo );

                if( datainativo == 'Invalid date' )
                datainativo = '-';

                if( data[nI].selection != 'selected')
                {
                    linha = 
                        '<tr id="atd'+data[nI].IMB_ATD_ID+'">'+
                        '<td class="escondido">'+data[nI].IMB_ATD_ID+'</td>' +
                        '<td style="text-align:center valign="center"></td>' +
                        '<td>'+data[nI].IMB_ATD_NOME+'</td>' +
                        '<td><a title="Adicionar '+data[nI].IMB_ATD_NOME+' a lista de membros dessa equipe"  href="javascript:adicionarMembro( '+data[nI].IMB_ATD_ID+')"><i class="fa fa-chevron-circle-right fa-2x"  aria-hidden="true"></i></a>'+
                        '</tr>';
                    $("#i-tbldisponiveis").append( linha );
                }
            }
        });
    }
    function cargaAtdMembros( id )
    {
        url = "{{route('equipe.membros')}}/"+id;

        $.getJSON( url, function( data)
        {
            linha = "";

            $("#i-tblmembros>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                var prefixo = '';
                var datainativo = moment( data[nI].IMB_EPM_DTHINATIVO ).format('DD/MM/YYYY');
                
                //alert( datainativo );

                if( datainativo == 'Invalid date' )
                datainativo = '-';



                console.log( data[nI].IMB_ATD_NOME+' - sel: '+data[nI].selection);
                if( data[nI].selection == 'selected')
                {
                    linha = 
                        '<tr id="membro'+data[nI].IMB_ATD_ID+'">'+
                        '<td class="escondido">'+data[nI].IMB_ATD_ID+'</td>' +
                        '<td><a title="Remover '+data[nI].IMB_ATD_NOME+' da lista de membros dessa equipe" href="javascript:removerMembro( '+data[nI].IMB_ATD_ID+')"><i class="fa fa-arrow-circle-left fa-2x" style="color:red" aria-hidden="true"></i></a>'+
                        '<td>'+data[nI].IMB_ATD_NOME+'</td>' +
                        '<td style="text-align:center valign="center"><input  type="checkbox" id="chkgerente'+data[nI].IMB_ATD_ID+'">'+
                        '<td style="text-align:center valign="center"><input  type="checkbox" id="chklider'+data[nI].IMB_ATD_ID+'">'+
                        '</td>' +
                        '</tr>';

                        
                    debugger;
                    gerente ="#chkgerente"+data[nI].IMB_ATD_ID; 
                    lider ="#chklider"+data[nI].IMB_ATD_ID; 
                    $("#i-tblmembros").append( linha );
                    $(gerente).prop( 'checked',(data[nI].IMB_EPM_GERENTE == 'S') );                        
                    $(lider).prop( 'checked',(data[nI].IMB_EPM_LIDER == 'S') );                        
                    



                }
            }
        });
    }

    function adicionarMembro( id )
    {

        url = "{{route('atendente.find')}}/"+id;
        $.ajax( 
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function( data )
                {

                    linha = 
                        '<tr id="membro'+id+'">'+
                        '<td class="escondido">'+id+'</td>' +
                        '<td><a title="Retirar '+data.IMB_ATD_NOME+' da lista de membros dessa equipe" href="javascript:removerMembro( '+id+')"><i class="fa fa-arrow-circle-left fa-2x" style="color:red" aria-hidden="true"></i></a>'+
                        '<td>'+data.IMB_ATD_NOME+'</td>' +
                        '<td style="text-align:center valign="center"><input  type="checkbox" id="chkgerente'+data.IMB_ATD_ID+'">'+
                        '<td style="text-align:center valign="center"><input  type="checkbox" id="chklider'+data.IMB_ATD_ID+'">'+
                        '</tr>';

                        
                    gerente ="#chkgerente"+data.IMB_ATD_ID; 
                    lider ="#chklider"+data.IMB_ATD_ID; 
                    $("#i-tblmembros").append( linha );
                    $(gerente).prop( 'checked',false );                        
                    $(lider).prop( 'checked',false );                        
                    

                    $("#atd"+id).remove();

                }
            });
    }
    function removerMembro( id )
    {

        url = "{{route('atendente.find')}}/"+id;
        $.ajax( 
            {
                url:url,
                dataType:'json',
                type:'get',
                async:false,
                success:function( data )
                {

                    debugger;
                    var membro = "#membro"+id;
                    linha = 
                        '<tr id="atd'+id+'">'+
                        '<td class="escondido">'+id+'</td>' +
                        '<td style="text-align:center valign="center"></td>' +
                        '<td>'+data.IMB_ATD_NOME+'</td>' +
                        '<td><a title="Adicionar '+data.IMB_ATD_NOME+' da lista de membros dessa equipe" href="javascript:AdicionarMembro( '+id+')"><i class="fa fa-chevron-circle-right fa-2x"  aria-hidden="true"></i></a>'+
                        '</tr>';
                        $("#i-tbldisponiveis").append( linha );
                    $( membro).remove();

                    }
            });
    }

    function GerenteOnOff( idequipe, idmembro, gerente)
    {

        if( $( "#gerente1Remover" ).length )

        
        gerente1Remover
    }
    
</script>
@endpush


