@extends('layout.app')

@section('scripttop')
<link href="{{asset('/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<style>

    .escondido
    {
        display:none;
    }
    .new-input{width:500px}    
    .new-input-200{width:200px}    
    .td-50
    {   
        height:50%;
    }

    .font-20
    {
        font-size:30px;
    }

    .td-center
    {   
        text-align:center;
    }
    
    .excluido {
      text-decoration: line-through;
    }
    .td-direita
    {   
        text-align:right;
    }

    table.dataTable tbody th, table.dataTable tbody td 
    {
        padding: 1px 10px; 
        text-align:center;

    }


    .div-center
    {
        text-align:center;
    }

    .fundo-grey
    {
        background-color: #eff5f5;
    }

    .azul
    {
        color:blue;
    }
    .font-white
    {
        color:white;
    }
    .vermelho
    {
        color:red;
    }

    .fundo-azul
    {
        background-color:blue;
    }
    .fundo-black
    {
        background-color:black;
    }

</style>
@endsection

@section('content')


<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Dimob</span>
            <i class="fa fa-search font-blue"></i>
        </div>
        <div>
            <button class="btn btn-danger pull-right" type="button" id="btn-limpar"
            onClick="limparCampos()">Limpar Filtro</button>
        </div>

        <button class="btn green pull-right escondido" id="btnnovo" type="button" onClick="novoSeguro()">Nova Ficha</button>


    </div>
    <div class="portlet-body form">
        <form role="form" id="search-form">

        <div class="form-body">
            <div class="col-md-12">
                <div class="col-md-4">
                    <label class="label-control empresa" for="IMB_IMB_IDDIMOBGERAR">Empresa</label>
                    <select class="select2" id="IMB_IMB_IDDIMOBGERAR">
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="label-control empresa" for="IMB_CLT_IDLOCADOR">Apenas do Locador Abaixo</label>
                    <select class="select2" id="IMB_CLT_IDLOCADOR">
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="label-control empresa" for="IMB_CTR_IDDIMOBGERAR">Apenas do Contrato Abaixo</label>
                    <select class="select2" id="IMB_CTR_IDDIMOBGERAR">
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="label-control empresa" for="IMB_CTR_IDDIMOBGERAR">Ano Base</label>
                        <input type="number" class="form-control" name="anobase" max="2050" min="2012" placeholder="Ano Base" id="anobase">
                    </div>
                </div>                
                <div class="form-actions noborder">
                    <button class="btn blue pull-right" id="search-form" >Consultar Base</button>
                </div>
            </div>
        </div>
        </form>
        
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-3"  id="i-saldo-inicial">
                        </div>
                        <div class="col-md-9 td-direita"  id="i-saldo-final">
                        </div>                        
                    </div>
                </div>
                <table class="table table-striped table-hover"  id="resultTable">
                    <thead>
                        <th ></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>





@endsection

@push('script')
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="{{asset('/global/scripts/moment.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-timepicker-addon.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>
<script src="{{asset('/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>

<script>



    $(document).ready(function() 
    {

        $("#sirius-menu").click();

        $(".select2").select2({
            placeholder: 'Selecione',
            width: null
        });

        var anobase = moment().format('YYYY');
        anobase = parseInt( anobase )-1;
        $('#anobase').val( anobase );
        preencherUnidadesDimobGerar();        

        var table = $('#resultTable').DataTable({
            "language":
            {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                sLoadingRecords: '<div class="overlay"><img src="{{asset('/layouts/layout/img/loader.gif')}}"/></div>',
                sProcessing: '<div class="overlay"><img src="{{asset('/layouts/layout/img/loader.gif')}}"/></div>',
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },
            "pageLength": -1,
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('dimob.consultarbase.carga') }}",
                data: function (d) {
                    d.anobase = $('#anobase').val();
                    d.imobiliaria = $("#IMB_IMB_IDDIMOBGERAR").val();
                }
            },
            columns: [
                    {  "data": 'IMB_DIL_ID', render: getInformacoes  },
                ],

            searching: false
        });


        $('#search-form').on('submit', function(e) {
            table.draw();
            e.preventDefault();
        });

    });
    
    function getInformacoes( data, type, full, meta)
    {

        var dimobchecked = 'checked';

        if( full.imb_imv_seleleciona != 'N' ) dimobchecked='';
        texto = '<div class="row">';

        cwarning = '';
        if( full.imb_dil_rejeitado == 'S')
        {
            cwarning = '<p><a title="Há problemas com essa ficha!" ><i class="fa fa-warning fa-2x" style="color:red"></i></a></p>';
        }

        datainicio = moment(full.imb_ctr_inicio).format( 'DD/MM/YYYY');

        texto = texto + 
                '   <div class="col-md-1"><a title="Alterar dados da ficha" class="btn btn-success btn-sm fa fa-pencil" href="#" ></a>'+
                cwarning+
                '   </div>';
                
        texto = texto + 
                '   <div class="col-md-1"><input title="Indica se irá ser incluído ou não na dimob" type="checkbox" class="form-control" id="i-dimob'+full.imb_dil_id+'" '+dimobchecked+'>'+
                '   </div>';
        
        //locador
        texto = texto + 
                '   <div class="col-md-4 div-left">Locador: <b>'+full.imb_clt_nomelocador+' - CPF/CNPJ: <i>'+full.imb_clt_cpflocador+'</i></b> '+
                '       <p>Locatário: <b>'+full.imb_clt_nomelocatario+' - CPF/CNPJ: <i>'+full.imb_clt_cpflocatario+'</i></b></p> '+
                '   </div>';
        texto = texto + 
                '   <div class="col-md-6 div-left">'+
                '       <h5>Imóvel: <b>'+full.imb_imv_endereco+'</b></h5> '+
                '        Pasta: <b>'+full.imb_ctr_referencia+'</b> #Imóvel: <b><i>'+full.imb_imv_id+'</i></b>  - CEP: <b>'+full.imb_imv_cep+' - '+full.imb_imv_cidade+' - '+full.imb_imv_estado+'</i></b> '+
                '       Cod.IBGE: <b>'+full.imb_imv_codigocidaderaiz+' - Data Contrato: '+datainicio+'</b> '+
                '   </div>';

        //fim da rol
        texto = texto + '</div>';

        texto = texto + '<div class="row">';
        texto = texto + 
                '   <div class="col-md-1">'+
                '   <h4><u>Janeiro</u></h4>'+
                '   Bruto: <b>'+full.imb_dil_janbruto+'</b>'+
                '   <p>Comissão: <b>'+full.imb_dil_jancomissao+'</b></p>'+
                '   <p>IRRF: <b>'+full.imb_dil_janretido+'</b></p>'+
                '   </div>';
        texto = texto + 
                '   <div class="col-md-1">'+
                '   <h5><u>Fevereiro</u></h5>'+
                '   Bruto: <b>'+full.imb_dil_fevbruto+'</b>'+
                '   <p>Comissão: <b>'+full.imb_dil_fevcomissao+'</b></p>'+
                '   <p>IRRF: <b>'+full.imb_dil_fevretido+'</b></p>'+
                '   </div>';

        texto = texto + 
                '   <div class="col-md-1">'+
                '   <h5><u>Março</u></h5>'+
                '   Bruto: <b>'+full.imb_dil_marbruto+'</b>'+
                '   <p>Comissão: <b>'+full.imb_dil_marcomissao+'</b></p>'+
                '   <p>IRRF: <b>'+full.imb_dil_marretido+'</b></p>'+
                '   </div>';

        texto = texto + 
                '   <div class="col-md-1">'+
                '   <h5><u>Abril</u></h5>'+
                '   Bruto: <b>'+full.imb_dil_abrbruto+'</b>'+
                '   <p>Comissão: <b>'+full.imb_dil_abrcomissao+'</b></p>'+
                '   <p>IRRF: <b>'+full.imb_dil_abrretido+'</b></p>'+
                '   </div>';
        
        texto = texto + 
                '   <div class="col-md-1">'+
                '   <h5><u>Maio</u></h5>'+
                '   Bruto: <b>'+full.imb_dil_maibruto+'</b>'+
                '   <p>Comissão: <b>'+full.imb_dil_maicomissao+'</b></p>'+
                '   <p>IRRF: <b>'+full.imb_dil_mairetido+'</b></p>'+
                '   </div>';
        texto = texto + 
                '   <div class="col-md-1">'+
                '   <h5><u>Junho</u></h5>'+
                '   Bruto: <b>'+full.imb_dil_junbruto+'</b>'+
                '   <p>Comissão: <b>'+full.imb_dil_juncomissao+'</b></p>'+
                '   <p>IRRF: <b>'+full.imb_dil_junretido+'</b></p>'+
                '   </div>';
    
        texto = texto + 
                '   <div class="col-md-1">'+
                '   <h5><u>Julho</u></h5>'+
                '   Bruto: <b>'+full.imb_dil_julbruto+'</b>'+
                '   <p>Comissão: <b>'+full.imb_dil_julcomissao+'</b></p>'+
                '   <p>IRRF: <b>'+full.imb_dil_julretido+'</b></p>'+
                '   </div>';

        texto = texto + 
                '   <div class="col-md-1">'+
                '   <h5><u>Agosto</u></h5>'+
                '   Bruto: <b>'+full.imb_dil_agobruto+'</b>'+
                '   <p>Comissão: <b>'+full.imb_dil_agocomissao+'</b></p>'+
                '   <p>IRRF: <b>'+full.imb_dil_agoretido+'</b></p>'+
                '   </div>';

        texto = texto + 
                '   <div class="col-md-1">'+
                '   <h5><u>Setembro</u></h5>'+
                '   Bruto: <b>'+full.imb_dil_setbruto+'</b>'+
                '   <p>Comissão: <b>'+full.imb_dil_setcomissao+'</b></p>'+
                '   <p>IRRF: <b>'+full.imb_dil_setretido+'</b></p>'+
                '   </div>';

        texto = texto + 
                '   <div class="col-md-1">'+
                '   <h5><u>Outubro</u></h5>'+
                '   Bruto: <b>'+full.imb_dil_outbruto+'</b>'+
                '   <p>Comissão: <b>'+full.imb_dil_outcomissao+'</b></p>'+
                '   <p>IRRF: <b>'+full.imb_dil_outretido+'</b></p>'+
                '   </div>';
                
            texto = texto + 
                '   <div class="col-md-1">'+
                '   <h5><u>Novembro</u></h5>'+
                '   Bruto: <b>'+full.imb_dil_novbruto+'</b>'+
                '   <p>Comissão: <b>'+full.imb_dil_novcomissao+'</b></p>'+
                '   <p>IRRF: <b>'+full.imb_dil_novretido+'</b></p>'+
                '   </div>';

            texto = texto + 
                '   <div class="col-md-1">'+
                '   <h5><u>Dezembro</u></h5>'+
                '   Bruto: <b>'+full.imb_dil_dezbruto+'</b>'+
                '   <p>Comissão: <b>'+full.imb_dil_dezcomissao+'</b></p>'+
                '   <p>IRRF: <b>'+full.imb_dil_dezretido+'</b></p>'+
                '   </div>';
                texto = texto + '</div>';


        return texto;
    }

        
    function preencherUnidadesDimobGerar()
    {
        var empresa ="{{Auth::user()->IMB_IMB_ID}}";
        var url = "{{ route('imobiliaria.carga')}}/"+empresa;
        $("#IMB_IMB_IDDIMOBGERAR").empty();
        linha = '<option value="">Selecione a empresa</option>"';
        $("#IMB_IMB_IDDIMOBGERAR").append( linha );        
        $.getJSON( url, function( data )
        {
            for( nI=0;nI < data.length;nI++)
            {
                linha =
                '<option value="'+data[nI].IMB_IMB_ID+'">'+
                    data[nI].IMB_IMB_NOME+"</option>";
                $("#IMB_IMB_IDDIMOBGERAR").append( linha );
            }
        });

        $("#IMB_IMB_IDDIMOBGERAR").select2("val", String(empresa) );        

    }


</script>
@endpush


