<div class="modal fade" id="modalanexosdocumentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog "style="width:80%;" >        
        <div class="modal-content ">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Anexos
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <div class="row">
                        <hr>
                    </div>
                    @include('layout.modaldownload')

                    <input type="hidden" id="IMB_CTR_ID_ANEDOC">
                    <input type="hidden" id="IMB_CTA_ID_ANEDOC">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="col-md-9">
                                </div>
                                <div class="col-md-1">
                                    <button title="Atualizar a tela" class="form-control btn btn-primary" onClick="atualizarTela()"><i class="fa fa-refresh" aria-hidden="true" style="font-size:24px;color:white"></i></button>
                                </div>
                                <div class="col-md-2">
                                    <button class="form-control btn btn-primary" onClick="anexar()">Incluir Anexo</button>
                                </div>
                            </div>
                            <table  id="tblanexosdocumentos" class="table table-striped table-bordered table-hover" >
                                <thead class="thead-dark">
                                    <tr >
                                        <th width="5%" style="text-align:center"></th>
                                        <th width="5%" style="text-align:center"> Tipo</th>
                                        <th width="70%" style="text-align:center"> Descrição </th>
                                        <th width="20%" style="text-align:center"> Ações </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <div class="col-md-12 escondido" id="div-alteracao-des-doc">
                                <h5>Alteração de Descrição</h5>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id='i-descricao' >
                                </div>
                                <div class="col-md-1">
                                    <button class="form-control" type="button" onClick="gravarDocAnexo()">Gravar</button>
                                </div>
                                <div class="col-md-1">
                                    <button class="form-control" type="button" data-dismiss="modal">Cancelar</button>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">sair</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('script')
<script>

    function anexar()
    {
        var id = $("#IMB_CTR_ID_ANEDOC").val();

        $("#IMB_CTR_ID_NODANE").val( id );
        
        var url = "{{route('contrato.anexos')}}/"+id;
        window.open( url, '_blank');

    }

    function cargaAnexosDocumentos( id )
    {
        var url = "{{ route('contrato.anexos.carga') }}"+"/"+id;
        $.getJSON( url, function( data)
        {
            linha = "";
            $("#tblanexosdocumentos>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                debugger;
                var tipo=data[nI].IMB_CTA_EXTENSAO;
                var icone='';
                if( tipo == 'pdf') 
                    icone = "<i class='fas fa-file-pdf' style='font-size:24px;color:red'></i>";

                if( tipo == 'jpeg' || tipo == 'jpg' || tipo == 'gif' || tipo == 'bmp' || tipo == 'png' ) 
                    icone = "<i class='fa fa-image' style='font-size:24px'></i>";

                if( tipo == 'doc' || tipo == 'docx' ) 
                    icone = '<i class="fa fa-file-word-o"  style="font-size:24px;color:blue"></i>';                    

                if( tipo == 'xls' || tipo == 'xlsx' ) 
                    icone = '<i class="fa fa-file-excel-o"  style="font-size:24px;color:green"></i>';

                linha = 
                    '<tr>'+
                    '   <td>'+icone+'</td>'+
                    '   <td>'+tipo+'</td>'+
                    '   <td>'+data[nI].IMB_CTA_DESCRICAO+'</td>'+
                    '   <td style="text-align:center"> '+
                    '<a  class="btn btn-sm btn-primary" href="javascript:alterarAneDoc('+data[nI].IMB_CTA_ID+',\''+data[nI].IMB_CTA_DESCRICAO+'\')">     Editar</a>'+
                    '<a  class="btn btn-sm btn-danger" href=javascript:apagarAnexo('+data[nI].IMB_CTA_ID+')>     Apagar</a>'+
                    '<a  title="Baixar o arquivo" class="btn btn-sm btn-danger" href=javascript:downloadDocto('+data[nI].IMB_CTA_ID+')><i class="fa fa-download" aria-hidden="true"></i></a>'+
                    '   </td>'+
                    '</tr>';

                $("#tblanexosdocumentos").append( linha );
                        
            }
        });


    }

    function atualizarTela()
    {
        var id = $("#IMB_CTR_ID_ANEDOC").val();
        cargaAnexosDocumentos( id )

    }

    function downloadDocto( id )
    {

        $.ajax(
          {
              url     : "{{route('anexoscontrato.download')}}/"+id,
              dataType: 'json',
              type    : 'get',
              success : function( data )
              {
                $("#modalanexosdocumentos").modal('hide');
                var url = '<a href="'+data+'" download>Click no Link para Baixar</a>';
                  $("#div-download").empty();
                  $("#div-download").append(url);
                  $("#modaldownload").modal('show');
                  $("#i-download").val( data );

            }
          })
    }

    function alterarAneDoc(id, descricao )
    {

        $("#i-descricao").val( descricao );
        $("#IMB_CTA_ID_ANEDOC").val( id );
        $("#div-alteracao-des-doc").show();


    }

    function gravarDocAnexo()
    {
        $.ajaxSetup({
            headers:    
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

        var url = "{{route('anexoscontrato.update')}}";

        dados = { id:$("#IMB_CTA_ID_ANEDOC").val(), descricao : $("#i-descricao").val()};

        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'post',
                data:dados,
                async:false,
                success:function()
                {
                    alert('Alterado!')
                    $("#div-alteracao-des-doc").hide();

                },
                error:function()
                {
                    alert('Não foi possivel alterar!');
                    $("#IMB_CTR_ID_ANEDOC").val();                    
                    $("#div-alteracao-des-doc").hide();
                }
            }
        )


    }

    function apagarAnexo( id )
    {
        if( confirm('Confirma a exclusão deste documento?') != true )
            return false;
        var url = "{{route('anexoscontrato.delete')}}/"+id;

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
                success:function()
                {
                    alert('Excluido!');
                    cargaAnexosDocumentos(  $("#IMB_CTR_ID_ANEDOC").val() )                    
                }
            }
        )
    }



</script>


@endpush
