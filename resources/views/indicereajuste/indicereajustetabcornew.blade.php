@extends( 'layout.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                            <i class="fa fa-gift"></i>Tabela de Correção
                            </div>
                            <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        
                        <div class="portlet-body form">
                                        <!-- BEGIN FORM-->
                            <div class="form-body">
                                <div class="row">
                                   
                                        <div class="row">

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input type="hidden" id="IMB_TBC_ID" value="{{$id}}">
                                                     <label class="control-label">Mês</label>
                                                     <input type="number" id="IMB_TBC_MES" class="form-control" 
                                                     max="12" min="1">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                     <label class="control-label">Ano</label>
                                                     <input type="number" id="IMB_TBC_ANO" class="form-control" 
                                                    >
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                     <label class="control-label">Percentual</label>
                                                     <input type="text" id="IMB_TBC_INDICECORRECAO" class="form-control perc4" >
                                                </div>
                                            </div>
                                        </div>
                                            <!-- Botões -->
                                        <div class="form-actions right">
                                            <button type="cancel" class="btn default" id="i-btn-cancelar">Cancelar</button>
                                            <button type="button" class="btn blue" id="i-btn-gravar">
                                                        <i class="fa fa-check"></i> Gravar
                                            </button>
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
            <!-- END CONTENT BODY -->
@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>

<script>


    $('.perc4').inputmask('decimal', 
      {
        radixPoint:",",
        groupSeparator: ".",
        autoGroup: true,
        digits: 4,
        digitsOptional: false,
        placeholder: '0',
        rightAlign: false,
        onBeforeMask: function (value, opts) 
        {
          return value;
        }
      });


    function gravar()
    {
        var url = "{{route('indicemes.gravar')}}";

        var dados = {
            IMB_TBC_MES : $("#IMB_TBC_MES").val(),
            IMB_TBC_ANO : $("#IMB_TBC_ANO").val(),
            IMB_TBC_INDICEID : $("#IMB_TBC_INDICEID").val(),
            IMB_TBC_INDICECORRECAO : $("#IMB_TBC_INDICECORRECAO").val(),
            IMB_TBC_FATOR : $("#IMB_TBC_INDICECORRECAO").val(),
        }

        $.ajax(

            {
                url : url,
                dataType:'json',
                type:'get',
                data:dados,
                success:function( )
                {
                    alert('Gravado!');

                }
            }
        );



    }


</script>

@endpush

            

@endsection