<div class="modal fade" id="modalnovosimoveis" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog "style="width:90%;" >
        <div class="modal-content">
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="portlet box yellow" >
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>Novos Imóveis, Imóveis que Sofreram alterações ou Imóveis comalterações Importantes
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered" id="tblnovosimoveis">
                                            <thead>
                                            <tr>
                                                <th class="div-center"></th>
                                                <th class="div-center">Tipo Imóvel</th>
                                                <th class="div-center">Tipo Atualização</th>
                                                <th class="div-center">Data</th>
                                                <th class="div-center">Referência</th>
                                                <th class="div-center">Endereço</th>
                                                <th class="div-center">Bairro</th>
                                                <th class="div-center">Condominio</th>
                                                <th class="div-center">$ Venda</th>
                                                <th class="div-center">$ Locação</th>
                                            </thead>
                                            </tr>
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

<form style="display: none" action="{{route('imovel.edit')}}" method="POST" id="form-alt-imoveis"  target="_blank">            
@csrf
    <input type="hidden" name="id" id="id-imovel">                
    <input type="hidden" name="readonly" id="i-readonly-imoveis">                
</form>


@push('script')
<script>
function mostrarNovosImoveis()
    {
        url = "{{route('novosimoveisatd')}}";

        $.ajax(
        {
            url             : url,
            dataType        : 'json',
            type            : 'get',
            async           : false,
            success         : function( data )
            {

                linha = "";
                $("#tblnovosimoveis>tbody").empty();

                for( nI=0;nI < data.length;nI++)
                {
                    var datacadastro = moment(data[nI].IMB_IMN_DTHCADASTRO).format('DD/MM/YYYY');

                    var locacao = parseFloat(data[nI].IMB_IMV_VALLOC);
                    locacao = formatarBRSemSimbolo( locacao );

                    var venda = parseFloat(data[nI].IMB_IMV_VALVEN);
                    venda = formatarBRSemSimbolo( venda );

                    var condominio = data[nI].IMB_CND_NOME;
                    if( condominio === null )
                       condominio = '-';

                    linha = 
                        '<tr>'+
                            '<td style="text-align:center" valign="center"> '+
                            '<a href=javascript:tirarNovosImoveis('+data[nI].IMB_IMN_ID+','+data[nI].IMB_IMV_ID+') class="btn btn-sm btn-danger">Remover</a> '+
                            '<a href=javascript:visualizarNovosImoveis('+data[nI].IMB_IMN_ID+','+data[nI].IMB_IMV_ID+') class="btn btn-sm btn-success">Ver</a> '+
                            '</td> '+
                            '<td>'+data[nI].IMB_TIM_DESCRICAO+'</td>'+
                            '<td>'+data[nI].IMB_IMN_TIPOENTRADA+'</td>'+
                            '<td>'+datacadastro+'</td>'+
                            '<td>'+data[nI].IMB_IMV_REFERE+'</td>'+
                            '<td>'+data[nI].ENDERECO+'</td>'+
                            '<td>'+data[nI].CEP_BAI_NOME+'</td>'+
                            '<td>'+condominio+'</td>'+
                            '<td>'+venda+'</td>'+
                            '<td>'+locacao+'</td>';

                        linha = linha +
                        '</tr>';
                    $("#tblnovosimoveis").append( linha );
                    $("#modalnovosimoveis").modal('show');

                }
            }

        })
    }

    function visualizarNovosImoveis( id, idimovel )
    {

        url = "{{route('informarimovelvisualizado')}}";

        dados = { 'id' : id};

        $.ajaxSetup({
            headers:    
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });        

        $.ajax(
            {
                url : url,
                data:dados,
                dataType:'json',
                type:'post',
                async:false,
                success: function()
                {
                    $("#id-imovel").val( idimovel );
                    $("#i-readonly-imoveis").val( "readonly" );
                    $("#form-alt-imoveis").submit();
                }
            }
        );



    }

    function tirarNovosImoveis( id, idimovel)
    {

        url = "{{route('informarimovelvisualizado')}}";

        dados = { 'id' : id};

        $.ajaxSetup({
            headers:    
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });        

        $.ajax(
            {
                url : url,
                data:dados,
                dataType:'json',
                type:'post',
                async:false,
                success: function()
                {
                    mostrarNovosImoveis();
                }
            }
        );
        




    }

</script>
@endpush