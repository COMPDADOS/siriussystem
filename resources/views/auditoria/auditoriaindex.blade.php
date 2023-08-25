@extends("layout.app")
@section('scripttop')
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

@endsection
@section('content')

<div class="page-bar">
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Auditoria / Logs
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
            </div>
        </div>

        <form  id="search-form">
        <div class="col-md-12">
            <input type="hidden" id="IMB_CTR_ID" name="IMB_CTR_ID" >
            <input type="hidden" id="IMB_IMV_ID" name="IMB_IMV_ID" >
            <input type="hidden" id="IMB_CLT_ID" name="IMB_CLT_ID" >
            
            <div class="col-md-2">
                <label class="label-control" >Data Inicial
                <input class="form-control" type="date" id="datainicio" name="datainicio">
                </label>
            </div>
            <div class="col-md-2">
                <label class="label-control" >Data Final
                    <input class="form-control" type="date" id="datatermino" name="datatermino">
                </label>
            </div>
            <div class="col-md-6">
            </div>
            <div class="col-md-2">
                <p></p>
                <div class="form-actions noborder">
                    <button class="btn blue pull-right" id='btn-search-form'>Carregar</button>
                </div>
                
            </div>

        </div>
        </form>        
    </div>

</div>

<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Registros
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
        </div>
    </div>

    <div class="portlet-body form">
        <div class="row" id="i-div-resultado">
            <div class="col-md-12">
                <table class="table table-bordered table-striped" id="resultTable">
                    <thead>
                        <th width="8%">Data</th>
                        <th width="20%">Usuario</th>
                        <th>Log</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</div>


@endsection

@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/jquery.btechco.excelexport.js')}}"></script>
<script src="{{asset('/js/jquery.base64.js')}}"></script>

<script>

$( document ).ready(function() 
{
    
    //cargaCarteira();    
    $("#sirius-menu").click();
    $("#datainicio").val(moment().format('YYYY-MM-DD'));
    $("#datatermino").val(moment().format('YYYY-MM-DD'));
    var table = $('#resultTable').DataTable(
    {
        "language": 
        {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
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
        bSort : false ,
        responsive: false,
        processing: true,
        serverSide: true,
        ajax: 
        {
            url:"{{ route('auditoria.cargalog') }}",
            data: function (d) 
            {
                    d.datainicio = $('input[name=datainicio]').val();
                    d.datatermino = $('input[name=datatermino]').val();
            }
        },
        columns: 
            [
                {data: 'IMB_OBS_DTHATIVO', render:formatarData },
                {data: 'IMB_ATD_NOME'},
                {data: 'IMB_OBS_OBSERVACAO'},
            ],
            searching: false
    });

    $('#search-form').on('submit', function(e) 
    {
        table.draw();
        e.preventDefault();
    });

    
    
});


function formatarData( data )
{
    return moment( data ).format( 'DD/MM/YYYY HH:MM' );
}

</script>

@endpush