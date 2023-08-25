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
                                            <i class="fa fa-gift"></i>Motivo Rescisão - Exclusão
                            </div>
                            <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        
                        <div class="portlet-body form">
                                        <!-- BEGIN FORM-->
                            <div class="form-body">
                                <div class="row">
                                    <form action="{{url('/motivorescisao/motivorescisao/apagar')}}/{{$tabela->IMB_MTR_ID}} " name="form_cliente" 
                                        id="i-form-cliente" class="horizontal-form"
                                        method="get">
                                        @csrf
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Nome</label>
                                                <input type="text" name="IMB_MTR_NOME" class="form-control" id="i-imb-forpag-nome"
                                                            
                                                            value="{{$tabela->IMB_MTR_DESCRICAO}}">
                                            </div>
                                        </div>
                                            <!-- Botões -->
                                        <div class="form-actions right">
                                            <button type="cancel" class="btn default" id="i-btn-cancelar">Cancelar</button>
                                            <button type="submit" class="btn red" id="i-btn-excluir">
                                                        <i class="fa fa-remove"></i> Excluir
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