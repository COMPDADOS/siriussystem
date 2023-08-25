<div class="modal" tabindex="-1" role="dialog" id="modalcadbairro">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Cadastro de Bairro
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body" >
                        <div class="row">
                            <input type="hidden" id="CEP_BAI_ID">
                            <div class="col-md-5">
                                <label class="control-label">Nome do Bairro</label>
                                <input class="form-control" id="CEP_BAI_NOME" type="text" maxlegth="60">
                            </div>
                            <div class="col-md-5">
                                <label class="control-label">Cidade</label>
                                <input class="form-control" type="text" id="CEP_CID_NOME" value="{{env('IMOBILIARIA_CIDADE')}}">
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Estado</label>
                                <input class="form-control" type="text" id="CEP_UF_SIGLA" value="{{env('IMOBILIARIA_ESTADO')}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onClick="gravarBairro()">Gravar</button>
                </div>
            </div>
        </div>
    </div>
</div>


@push('script')

<script>

    function gravarBairro()
    {
        if( $("#CEP_BAI_NOME").val() == '' )
        {
            alert('Informe o bairro!');
            return false;
        }

        if( $("#CEP_CID_NOME").val() == '' )
        {
            alert('Informe a cidade!');
            return false;
        }


        if( $("#CEP_UF_SIGLA").val() == '' )
        {
            alert('Informe o estado!');
            return false;
        }

        var url = "{{route('bairro.salvar')}}";

        var dados = {
            CEP_BAI_NOME : $("#CEP_BAI_NOME").val(),
            CEP_CID_NOME : $("#CEP_CID_NOME").val(),
            CEP_UF_SIGLA : $("#CEP_UF_SIGLA").val(),
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
                url:url,
                data:dados,
                dataType:'json',
                type:'post',
                success:function( data )
                {
                    alert('Gravado!!!');

                    cargaBairrosdaTabela( data);
                }
            }
        )
        
    }

    function cargaBairrosdaTabela( id )
    {
        
        var url = "{{ route('bairro.cargadatabela')}}/X";

        debugger;
        $.getJSON( url, function( data )
        {
            linha = "";
            $("#CEP_BAI_ID").empty();
            for( nI=0;nI < data.length;nI++)
            {
            
                selecionado = '';
                if( data[nI].CEP_BAI_ID == id ) selecionado = 'selected';
                linha =
                    '<option value="'+data[nI].CEP_BAI_ID+'" '+selecionado+'>'+
                    data[nI].CEP_BAI_NOME+'('+data[nI].CEP_CID_NOME+')</option>';
                    $("#CEP_BAI_ID").append( linha );
            };
            $("#CEP_BAI_ID").val( id );

        });
    }

    function verificarBairroCadastrado( bairro, cidade, estado,newifnotexists)
    {

        $.ajaxSetup({
            headers:
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
            });

        var url = "{{ route('bairro.verificarexistencia')}}";

        var dados = 
        {
            CEP_BAI_NOME : bairro,
            CEP_CID_NOME : cidade,
            CEP_UF_SIGLA : estado,
            newifnotexists : newifnotexists,

        }

        $.ajax(
            {
                type: "post",
                url: url,
                dataType:'json',
                type:'post',
                async:false,
                data:dados,
                success: function(data)
                {
                    cargaBairrosdaTabela(data);
                 
                },
                error: function( error )
                {
                    console.log(error);
                }

        });


        


    }
</script>


@endpush
