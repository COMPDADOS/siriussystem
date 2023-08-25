@extends('layout.app')
@section('content')
<table  id="tbFormaPagamento" class="table table-striped table-bordered table-hover" >
    <thead class="thead-dark">
        <tr >
            <th width="40" style="text-align:center"> Código </th>
            <th style="text-align:center"> Nome </th>
            <th width="200" style="text-align:center"> Ações </th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<div class="table-footer" >
    <a  class="btn btn-sm btn-primary" 
        role="button" onClick="novoRegistro()" >
                Adicionar novo </a>
                <!--data-toggle="modal" data-target="#modalFormaPagamento"-->
</div>

<!-- Modal -->
<div class="modal fade" id="modalFormaPagamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form  name="form_cliente" id="formCadastro"
            class="horizontal-form">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tabbable-line boxless tabbable-reversed">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="portlet box blue">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                            <i class="fa fa-gift"></i>Forma Pagamento
                                                </div>
                                                <div class="tools">
                                                            <a href="javascript:;" class="collapse"> </a>
                                                </div>
                                            </div>
                                        
                                            <div class="portlet-body form">
                                                        <!-- BEGIN FORM-->
                                                <div class="form-body">
                                                    <div class="row">
                                                        <input type="hidden" id="id" name="id">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Nome</label>
                                                                <input type="text" name="IMB_FORPAG_NOME" 
                                                                        class="form-control" id="i-imb-forpag-nome"
                                                                            placeholder="Nome da forma de pagamento">
                                                            </div>
                                                        </div>
                                                            <!-- Botões -->
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar mudanças</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('javascript')
<script type="text/javascript">

    $.ajaxSetup( {
        headers: {
            'X-CSRF-TOKEN' : "{{ csrf_token() }}"
        }
    })


    function montarLinha( p )
    {
        var linha=  "<tr>"+
                        "<td align='center'>"+p.IMB_FORPAG_ID+  "</td>"+
                        "<td align='center'>"+p.IMB_FORPAG_NOME+"</td>"+
                        "<td align='center'>"+
                            '<button class="btn  btn-sm btn-primary" onClick="editar('+p.IMB_FORPAG_ID+')">Editar</button>'+
                            '<button class="btn  btn-sm btn-danger" onClick="remover('+p.IMB_FORPAG_ID+')">Excluir</button>'+
                        "</td>"
                    "</tr>";
        return linha;


    }
    function carregarFormas()
    {
        $.getJSON( "{{route('formapagamento.carga')}}", function( formas )
        {
            for( nI = 0; nI < formas.length; nI++ )
            {
                linha = montarLinha( formas[ nI ] );
                $("#tbFormaPagamento>tbody").append( linha );
            }

        });
    }

    function criarForma()
    {
        forma = {
            IMB_IMB_ID : 1,
            IMB_FORPAG_NOME : $("#i-imb-forpag-nome").val()
        };
        $.post('/api/formapagamento', forma, function( data ) {
            fp = JSON.parse( data );
            linha = "<tr>"+
                        "<td align='center'>"+fp.IMB_FORPAG_ID+  "</td>"+
                        "<td align='center'>"+fp.IMB_FORPAG_NOME+"</td>"+
                        "<td align='center'>"+
                            '<button class="btn  btn-sm btn-primary" onClick="editar('+fp.IMB_FORPAG_ID+')">Editar</button>'+
                            '<button class="btn  btn-sm btn-danger" onClick="remover('+fp.IMB_FORPAG_ID+')">Excluir</button>'+
                        "</td>"
                    "</tr>";

            $("#tbFormaPagamento>tbody").append( linha )
            
        })
    }

    function editar( id )
    {
        $.getJSON( "/api/formapagamento/"+id, function( data ) 
            {
                $("#id").val( data.IMB_FORPAG_ID);
                $("#i-imb-forpag-nome").val( data.IMB_FORPAG_NOME);
             });
        $( '#modalFormaPagamento').modal('show');
    }

    
    

    function remover( id )
    {
        $.ajax( {
            type : "delete",
            url : "/api/formapagamento/"+id,
            context: this,
            success:function(){
                linha = $("#tbFormaPagamento>tbody>tr");
                e = linha.filter( function( i,elemento) 
                { 
                    return elemento.cells[0].textContent == id ;
                })
                if( e )
                    e.remove();
            },
            error: function() {
                    console.log( error );
            }
        })

    }
    function novoRegistro(){
        $("#i-imb-forpag-nome").val('');
        $("#modalFormaPagamento").modal('show');
    }

    function salvarProduto()
    {
        
        forma = {
            IMB_IMB_ID : 1,
            IMB_FORPAG_ID : $("#id").val(),
            IMB_FORPAG_NOME : $("#i-imb-forpag-nome").val()
        };

        $.ajax( {
            type : "put",
            url : "/api/formapagamento/" +forma.IMB_FORPAG_ID,
            data : forma,
            context: this,
            success:function(data)
            {
                forma = JSON.parse( data );
                linha = $("#tbFormaPagamento>tbody>tr");
                e = linha.filter( function( i,e) 
                { 
                    return ( e.cells[0].textContent == forma.IMB_FORPAG_ID )
                });

                if(e)
                   e[0].cells[1].textContent = forma.IMB_FORPAG_NOME;


            },
            error: function()
            {
            console.log( error );
            }
        })

    }
    $("#formCadastro").submit( function( event ){
        event.preventDefault();
        if ( $("#id").val() == '' )
                criarForma()
            else
                salvarProduto();
        $("#modalFormaPagamento").modal('hide')

    })
    carregarFormas();

</script>
@endsection

