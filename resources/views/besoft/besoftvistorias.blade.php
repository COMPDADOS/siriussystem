@extends("layout.app")
@section('scripttop')

<meta http-equiv=\"content-type\" content=\"application/vnd.ms-excel; charset=UTF-8\">
<link href="{{asset('/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<style>

.cinza
{
    color:red;
}
.Inativo
{
    text-decoration: line-through;
}
.Rejeitado
{
    color:red;
}
.Liberado
{
    color:Blue;
}
.Aguardando-Retorno
{
    color:Black;
}
.div-center
{
  text-align:center;
}

.naoselecionada {
  text-decoration: line-through;
  color:red;
}

.liberado
{
    color:white;
    background-color:green;
}
.rejeitado
{
    color:white;
    background-color:red;
}

.div-right
{
    text-align:right;
}

.escondido
{
    display:none;
}

.lbl-medidas {
  text-align: center;
  font-size: 14px;

}
.lbl-medidas-valores {
  text-align: center;
  font-size: 14px;
  font-weight: bold;
  color: #4682B4;
}

.div-border-blue-center{
    border:solid 1px #4682B4;
    text-align: center;
}
.lbl-medidas-outrositens {
  text-align: left;
  font-size: 12px;
  color: #4682B4;
}

.cardtitulo {
  text-align: left;
  font-size: 16px;
  color: #4682B4;
  font-weight: bold;

}

.lbl-download-title {
  text-align: center;
  font-size: 20px;
  font-weight: bold;
}

hr {
    height: 2px;
}

div .half-size-line
{
    line-height: 92%;
}

td, th
{
    text-align:center;
}

</style>
<script src="{{asset('/global/plugins/sweetalert/sweetalert2.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('/global/plugins/sweetalert/sweetalert2.min.css')}}">
<script src="{{asset('/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>

@endsection
@section('content')

<form id="search-form">
<div class="page-bar">
    <div class="col-md-12">
        <div class="col-md-4">
            <div class="col-md-6">
                <label class="label-control" for="i-data-inicio">Data Inicial</label>
                <input class="form-control" type="date" id="i-data-inicio">
            </div>
            <div class="col-md-6">
                <label class="label-control" for="i-data-fim">Data Final</label>
                <input class="form-control" type="date" id="i-data-fim">
                
            </div>
            <div class="col-md-12">
                <label class="label-control">Situação</label>
                <select class="form-control" id="i-situacao">
                    <option value="Todas">Todas</option>
                    <option value="Agendadas">Agendada</option>
                    <option value="Realizadas">Realizadas</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <button type="button" class="form-control btn btn-danger" >Limpar Filtros</button>
            <button type="button" class="form-control btn btn-primary" >Carregar Vistorias</button>
            <button type="button" class="form-control btn btn-success" onClick="agendarVistoria()">Agendar Vistoria</button>
        </div>
        <div class="col-md-4">
        </div>
        <div class="col-md-2">
            <a class="form-control" href="javascript:sincronizarTipoImoveis();">Sincronizar Tipo Imoveis</a>
            <a class="form-control" href="javascript:sincronizarVistoriadores();">Sincronizar Vistoriadores</a>
            <a class="form-control" href="javascript:sincronizarCidades();">Sincronizar Cidades</a>
        </div>

    </div>
</div>

<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Vistorias
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
        </div>
    </div>

    <div id="processando">
        <h3 class="div-center escondido">Gerando o PDF. Aguarde o final........</h3>
    </div>
    <div class="portlet-body form">
        <div class="row" id="i-div-resultado">
            <div class="col-md-12">
                <table class="table table-bordered table-striped" id="tblvistorias">
                    <thead>
                        <th width="20%">Ações</th>
                        <th width="10%">Dt Agendamento</th>
                        <th width="10%">Dt Realização</th>
                        <th width="5%"># BeSoft</th>
                        <th width="5%"># Imovel</th>
                        <th width="5%">Pasta</th>
                        <th width="15%">Imóvel</th>
                        <th width="10%">Tipo</th>
                        <th width="20%">Vistoriador</th>
                        <th width="10%">Status</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</div>
</form>

@include('layout.modaldownload')

@include('layout.modalbevistoria')
@endsection

@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/funcoes-recibolocatario.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/jquery.btechco.excelexport.js')}}"></script>
<script src="{{asset('/js/jquery.base64.js')}}"></script>

<script>

$( document ).ready(function()
{
    $(".select2").select2({
            placeholder: 'Selecione',
            width: null
        });
    


});

var table = $('#tblvistorias').DataTable(
    {
        "language": 
        {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "dom": 'Plfrtip',
            "language": 
            {
                "searchPanes": 
                {
                    "emptyPanes": 'Nada a mostrar'
                }            
            },
            sLoadingRecords: '<img src="{{asset('/layouts/layout/img/loader.gif')}}"/>',
                sProcessing: '<img src="{{asset('/layouts/layout/img/loader.gif')}}"/>',
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": 
            {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
        },
        bLengthChange: false,
        bSort : true ,
        responsive: false,
        processing: true,
        serverSide: true,
        ajax: 
        {
            url:"{{ route('besoft.vistorias') }}",
            data: function (d) 
            {
            }

        },
        columns: 
        [
            {data: 'vis_codigo', render:montarAcoes},
            {data: 'vis_datahora', render:formatarData},
            {data: 'vis_datarealizacao', render:formatarData},
            {data: 'vis_codigo'},
            {data: 'imo_codigo'},
            {data: 'imb_ctr_id'},
            {data: 'Imovel_imo_endereco', render:montarEndereco},
            {data: 'Tipo_visti_tipo'},
            {data: 'Vistoriador_first_name'},
            {data: 'Status_vist_status'},

        ],
        searching: false
    });

    $('#search-form').on('submit', function(e) {
        table.draw();
        e.preventDefault();
    });

    
function agendarVistoria()
{
    cargaTiposImoveis();
    cargaSubTiposImoveis();
    cargaVistoriadores();
    $("#modalbevistoria").modal('show');
}

function montarEndereco( data, type, full, meta)
{
    return '<div><b>'+full.Imovel_imo_endereco+' '+full.Imovel_imo_numero+' '+full.Imovel_imo_complemento+'</b></div>';
}

function formatarData( data )
{
    var d = moment( data ).format('YYYY');

    if( data === null || d < 2020  )
        return '<div>-</div>'
    else
        return '<div>'+moment(data).format( 'DD/MM/YYYY')+'</div>';
}

function montarAcoes( data, type, full, meta)
{
    var pdf = '';
    if( full.Status_vist_status == 'Realizada')  
    {
        pdf = '<a href="javascript:gerarPDF('+data+',2)" title="Gerar o PDF" class="btn btn-secondary btn-sm"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></a>';
        pdfimg = '<a href="javascript:gerarPDF('+data+',1)" title="Gerar o PDF COM FOTOS" class="btn btn-secondary btn-sm"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></a>';
        docx = '<a href="javascript:gerarDOCX('+data+',2)" title="Gerar no WORD" class="btn btn-secondary btn-sm"><i class="fa fa-file-word-o fa-2x" aria-hidden="true"></i></a>';
        docximg = '<a href="javascript:gerarDOCX('+data+',1)" title="Gerar no WORD COM FOTOS" class="btn btn-secondary btn-sm"><i class="fa fa-file-word-o fa-2x" aria-hidden="true"></i></a>';
    }
                
    var texto = '<div>'+pdf+pdfimg+docx+docximg+
                    '<button title="Excluir essa vistoria" class="btn btn-danger btn-sm" onClick=apagarVistoria('+data+')><i class="fa fa-trash-o"></i></button>'+
                '</div>';

                                

    return texto;

}

function apagarVistoria( id )
{
    if (confirm("Confirma a exclusão da vistoria?") == true) 
    {
        var url = "{{route('besoft.apagarvistoria')}}/"+id+'/';

        $.ajaxSetup({
                headers:
                {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });

        $.ajax
        (
        {
            url: url,
            dataType:'json',
            type:'delete',
            complete:function( data )
            {
                var retorno = data.responseText;
                retorno = JSON.parse( retorno );
                if(  retorno.deleted  == true )
                {
                    $('#search-form').submit();
                }
                else
                {
                    alert('Não Foi possível a exclusão');

                }
                
            }

        }
        );
    }
}

function gerarPDF( id, tipo )
{
    var url = "{{route('besoft.gerarlaudo')}}";

    var dados = 
            {
                vis_codigo: id,
                template:
                { pk: tipo },
                "typepdf": true
            }    

        $.ajax(
        {
            url:url,
            dataType:'json',
            type:'get',
            data:dados,
            async:false,
            beforeSend: () =>
            {
                $("#processando").show();
                $("#i-div-resultado").hide();
                alert('O sistema comecará o processo de geraçao do laudo de vistoria em PDF, e poderá demorar uns poucos segundos a mais. Aguarde até o final...');
                
            },
            success:function(data)
            {
            var url = '<a href="'+data+'" download>Click no Link para Baixar</a>';
             $("#i-filename-title").html( 'Geração de PDF Laudo de Vistoria');
             $("#div-download").empty();
             $("#div-download").append(url);
             $("#modaldownload").modal('show');
             $("#i-download").val( data );
            },
            complete:function()
            {
                $("#processando").hide();
                $("#i-div-resultado").show();

            }
        });
    
}

function gerarDOCX( id, tipo )
{
    var url = "{{route('besoft.gerarlaudo')}}";

    var dados = 
            {
                vis_codigo: id,
                template:
                { pk: tipo },
                "docx": true
            }    

        $.ajax(
        {
            url:url,
            dataType:'json',
            type:'get',
            data:dados,
            async:false,
            beforeSend: () =>
            {
                $("#processando").show();
                $("#i-div-resultado").hide();
                alert('O sistema comecará o processo de geraçao do laudo de vistoria em PDF, e poderá demorar uns poucos segundos a mais. Aguarde até o final...');
                
            },
            success:function(data)
            {
            var url = '<a href="'+data+'" download>Click no Link para Baixar</a>';
             $("#i-filename-title").html( 'Geração de PDF Laudo de Vistoria');
             $("#div-download").empty();
             $("#div-download").append(url);
             $("#modaldownload").modal('show');
             $("#i-download").val( data );
            },
            complete:function()
            {
                $("#processando").hide();
                $("#i-div-resultado").show();

            }
        });
    
}

</script>

@endpush
