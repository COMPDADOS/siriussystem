<div class="modal" tabindex="-1" role="dialog" id="modaldocautomaticos">
    <div class="modal-dialog "style="width:70%;" >
        <div class="modal-content">
      
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Documentos Automaticos
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table  id="tabdocautomaticos" class="table table-bordered table-hover" >
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
                </div>
            </div>
                
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modaldocumentogerados">
    <div class="modal-dialog "style="width:70%;" >
        <div class="modal-content">
      
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Documentos Já Gerados
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table  id="tabdocumentosgerados" class="table table-bordered table-hover" >
                                        <thead class="thead-dark">
                                            <tr >
                                                <th width="20%" style="text-align:center"> Data/Hora</th>
                                                <th width="25%" style="text-align:center"> Gerado Por </th>
                                                <th width="40%" style="text-align:center"> Nome </th>
                                                <th width="15%" style="text-align:center"> Ações </th>
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
                
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modalmesclado">
    <div class="modal-dialog "style="width:90%;" >
        <div class="modal-content">
      
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Documentos Automaticos
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <textarea name="editorMesclado" id="GER_DCA_TEXTOMESCLADO" ></textarea>
                        </div>
                    </div>
                </div>
            </div>
                
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
@include('layout.modaldownload')

@push('script')
<script>
function cargaDocumentosAutomaticos( idcliente, idcontrato, idimovel)
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
            $("#tabdocautomaticos>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {

                cword ='';
                comp = '';
                if( data[nI].GER_DCA_WORD == 'S')
                {
                    cword = '<a title="Documento no padrão MS-Word" href="javascript:gerarDocWord('+idcontrato+', \''+data[nI].GER_DCA_UPLOAD+'\',\''+data[nI].GER_DCA_DOWNLOAD+'\')"'+
                            ' class="btn btn-sm btn-success"><i  class="fa fa-file-word-o btn btn btn-primary" aria-hidden="true" style="fa-2x color:blue"></i></a>';
                }
                else    
                    cword = '<a href="javascript:gerarDocAuto('+data[nI].GER_DCA_ID+','+
                                                                idcliente+','+idcontrato+','+idimovel+
                            ')" class="btn btn-sm btn-primary">Gerar</a>';

                linha = 
                    '<tr>'+
                    '   <td>'+data[nI].GER_DCA_NOME+'</td>'+
                    '   <td style="text-align:center"> '+cword+'</td> ';
                    '</tr>';
                $("#tabdocautomaticos").append( linha );
                        
            }

        }
    });
        
}

function gerarDocAuto( iddocumento, idcliente, idcontrato, idimovel)
{

    var url = "{{route('docsautomaticos.gerardocautomatico')}}/"+
                iddocumento+'/'+idcliente+'/'+idcontrato+'/'+idimovel+'/N';

    $.ajax(
        {
            url : url,
            type:'get',
            dataType:'json',
            //contentType: "application/json; charset=utf-8",
            async:false,
            success:function( data )
            {                
                
/*                console.log( 'success' );

                console.log( data );
                CKEDITOR.instances.GER_DCA_TEXTOMESCLADO.setData(data);
                console.log( 'mesclado' );
                $("#modalmesclado").modal('show');
                */
                //cargaMesclado( data );
                documentosGerados( idcliente, idcontrato, idimovel);                
//               alert('Gerado!');

            },
            complete:function( data )
            {


            }

        }
    )

}

function documentosGerados( idcliente, idcontrato, idimovel)
{
    var url = "{{ route('docsautomaticos.documentosgerados') }}";
    var dados = { idcliente:idcliente, idcontrato:idcontrato, idimovel:idimovel};
    $.ajax(
    {
        url: url,
        datatype: 'json',
        type: 'get',
        data:dados,
        success : function(data)
        {
            linha = "";
            $("#tabdocumentosgerados>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                var datahora = moment( data[nI].IMB_DCG_DTHATIVO ).format( 'DD/MM/YYYY H:mm')
                linha = 
                    '<tr>'+
                    '   <td>'+datahora+'</td>'+
                    '   <td>'+data[nI].IMB_ATD_NOME+'</td>'+
                    '   <td>'+data[nI].IMB_CGR_TITULO+'</td>'+
                    '   <td style="text-align:center"> '+
                            '<a href="javascript:cargaMesclado('+data[nI].IMB_DCG_ID+
                            ')" class="btn btn-sm btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>'+                              
                            '<a href="javascript:desativaDocto('+data[nI].IMB_DCG_ID+
                            ')" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>'+                              
                        '</td> ';
                    '</tr>';
                $("#tabdocumentosgerados").append( linha );
            }
            $("#modaldocumentogerados").modal('show');
        }
    });
}

function cargaMesclado(iddoc)
{
    var url = "{{route('docsautomaticos.documentomesclado')}}/"+iddoc;
    window.open( url, '_blank');


}

function gerarDocWord(  idcontrato, entrada, saida)
{

    var url = "{{route('docsautomaticos.word')}}";
    dados = 
    {
        'entrada' : entrada,
        'saida' : saida,
        'idcontrato':idcontrato,
    }
   

    $.ajax( 
        {
            url:url,
            dataType:'json',
            type:'get',
            data:dados,
            success:function( data )
            {
                var url = '<a href="'+data+'" download>Click no Link para Baixar</a>';
                $("#i-filename-title").html( 'Geração de Documentos no Word');
                $("#div-download").empty();
                $("#div-download").append(url);
                $("#modaldownload").modal('show');
                $("#i-download").val( data );
            }
        }
        
    )

}
</script>

@endpush