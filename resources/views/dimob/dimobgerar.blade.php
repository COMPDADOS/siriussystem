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
        color:whi;
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
            <span class="caption-subject bold uppercase"> Dimob - Gerar</span>
            <i class="fa fa-search font-blue"></i>
        </div>
    </div>
    <div class="portlet-body form">
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
                    <button class="btn blue pull-right" onClick="dimobGerar()" >Gerar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@include( 'layout.modalprocessa');




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

        
        preencherUnidadesDimobGerar();

    });

    function dimobGerar()
    {
        if( confirm('Confirma a geração do arquivo? Se confirmar, todas as informações não FECHADAS serão excluídas para o ano selecionado') != true )
            return false;
        $("#modalprocessa").modal('show');
        
        var url = "{{route('dimob.gerar')}}";

        dados = { 
            imobiliaria : $("#IMB_IMB_IDDIMOBGERAR").val(),
            anobase : $("#anobase").val(),
            idlocador : $("#IMB_CLT_IDLOCADOR").val(),
            idcontrato : $("#IMB_CTR_IDDIMOBGERAR").val(),
         }

         $.ajaxSetup(
            {
                headers:
                {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });


        $.ajax({
            url:url,
            dataType:'json',
            type:'post',
            data:dados,
            async:false,
            success:function()
            {

                $("#modalprocessa").modal('hide');

                alert('Gerado com sucesso!');

            },
            beforeSend:function()
            {
                $("#modalprocessa").modal('show');
            }
        });

        
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

        $("#IMB_IMB_IDDIMOBGERAR").val( empresa);

    }

    
</script>
@endpush


