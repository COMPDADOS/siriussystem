@extends( 'layout.app')
<style>
 .dark {
      background-color: #383838;
    }

    /* Centralização do conteúdo */
    .center {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

input[type="checkbox"] {
      position: relative;
      width: 80px;
      height: 40px;
      -webkit-appearance: none; /* Aparência padrão do checkbox é anulada */
      background-color: red; /* cor de fundo */
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
      width: 40px;
      height: 40px;
      border-radius: 50%;
      top: 0;
      left: 0;
      background: #ffffff;
      transform: scale(1.2);
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      transition: .2s;
    }

    input:checked[type="checkbox"]:before {
      left: 40px;
    }    

    .div-center
    {
        text-align:center;
    }
</style>
@section('scripttop')
    <script src="{{asset('/global/plugins/sweetalert/sweetalert2.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('/global/plugins/sweetalert/sweetalert2.min.css')}}">        
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                            <i class="fa fa-gift"></i>Módulos
                            </div>
                            <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        
                        <div class="portlet-body form">
                                        <!-- BEGIN FORM-->
                            <div class="form-body">
                                <div class="row">
                                    <form name="form_cliente" 
                                        id="i-form-modulo" class="horizontal-form">
                                        <div class="row">
                                            <div class="col-md-5">
                                            <div class="form-group">
                                                     <label class="control-label">Nome</label>
                                                     <input type="text" id='I-IMB_MDL_DESCRICAO' class="form-control" maxlenght="40" 
                                                        id="i-imb-forpag-nome" required>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="control-label">Pertencente a</label>
                                                    <select id="i-select-pai" class="form-control">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-actions right">
                                            <button type="cancel" class="btn default" id="i-btn-cancelar" onClick="history.go(-1);">Cancelar</button>
                                            <button type="button" class="btn blue" id="i-btn-gravar" onclick="onGravarModulo()">
                                                        <i class="fa fa-check"></i> Gravar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-3 div-center">
                                            <label for="i-mod-gerar">Uso Geral</label>
                                            <input  type="checkbox"  id="IMB_MOD_CFG">
                                        </div>
                                        <div class="col-md-3 div-center">
                                            <label for="i-mod-gerar">Módulo CRM</label>
                                            <input  type="checkbox"  id="IMB_MOD_CRM">
                                        </div>
                                        <div class="col-md-3 div-center">
                                            <label for="i-mod-gerar">Módulo Administrativo</label>
                                            <input  type="checkbox"  id="IMB_MOD_ADM">
                                        </div>
                                        <div class="col-md-3 div-center">
                                            <label for="i-mod-gerar">Módulo Financeiro</label>
                                            <input  type="checkbox"  id="IMB_MOD_ADM">
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
@endsection            <!-- END CONTENT BODY -->

@push('script')
<script>
    $( document ).ready(function() 
    {
        preencherPai();
    });

    function preencherPai()
    {

        $.getJSON( "{{route('modulo.carga')}}/0", function( data )
        {

            $("#i-select-pai").empty();
                
            linha =  '<option value="0">Módulo a que pertence</option>';
            $("#i-select-pai").append( linha );
            for( nI=0;nI < data.length;nI++)
            {
                
                linha = 
                '<option value="'+data[nI].IMB_MDL_ID+'">'+
                            data[nI].IMB_MDL_DESCRICAO
                $("#i-select-pai").append( linha );

            }

        });
            


    }

    function onGravarModulo()
    {

        if ( $("#I-IMB_MDL_DESCRICAO").val() == '' )
        {
            Swal.fire(
                'Informe a Descrição',
                '******************',
                'error'
            );

            return false;

        }


        mdl = 
        {
            IMB_MDL_DESCRICAO : $("#I-IMB_MDL_DESCRICAO").val(),
            IMB_MDL_IDPAI : $("#i-select-pai").val(),
            IMB_MDL_ID : $("#I-IMB_MDL_ID").val(),
            IMB_MOD_CRM : $("#IMB_MOD_CRM").prop('checked') ? 'S' : 'N',
            IMB_MOD_ADM : $("#IMB_MOD_ADM").prop('checked') ? 'S' : 'N',
            IMB_MOD_FIN : $("#IMB_MOD_FIN").prop('checked') ? 'S' : 'N',
            IMB_MOD_CFG : $("#IMB_MOD_CFG").prop('checked') ? 'S' : 'N',

        };

        $.ajaxSetup(
        {
            headers:    
            {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });        


        var url="{{ route( 'modulo.store')}}";

        console.log('url '+url);
        
        $.ajax(
        {
            url: url,
            dataType: 'json',
            type: "post",
            data: mdl,
            
            success: function(data)
                {
                    alert('Gravado');
                    window.history.back();
                },
                error: function()
                {
                    alert('erro na gravação');
                }
                
        });

        




    }

</script>
@endpush
