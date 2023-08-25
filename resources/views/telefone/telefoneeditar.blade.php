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
                                            <i class="fa fa-gift"></i>Alterando o Telefone do cliente
                            </div>
                            <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        
                        <div class="portlet-body form">
                                        <!-- BEGIN FORM-->
                            <div class="form-body">
                                <div class="row">
                                    <form action="{{url('telefone/telefone/')}}{{$tabela->IMB_TLF_ID}} " name="form_cliente" 
                                        id="i-form-cliente" class="horizontal-form"
                                        method="post">
                                        @csrf
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="control-label">DDD</label>
                                                <input type="number" name="IMB_TLF_DDD" class="form-control" id="i-imb-forpag-nome"
                                                            value="{{$tabela->IMB_TLF_DDD}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Número</label>
                                                <input type="number" name="IMB_TLF_NUMERO" class="form-control" id="i-imb-forpag-nome"
                                                            value="{{$tabela->IMB_TLF_NUMERO}}">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="control-label">Tipo</label>
                                                <input type="text" name="IMB_TLF_TIPOTELEFONE" class="form-control" id="i-imb-forpag-nome"
                                                            value="{{$tabela->IMB_TLF_TIPOTELEFONE}}">
                                            </div>
                                        </div>
                                            <!-- Botões -->
                                        <div class="form-actions right">
                                            <button type="cancel" class="btn default" id="i-btn-cancelar">Cancelar</button>
                                            <button type="submit" class="btn blue" id="i-btn-gravar">
                                                        <i class="fa fa-check"></i> Gravar
                                            </button>                                            
                                            
                                        </div>
                                    </form>
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


@endsection