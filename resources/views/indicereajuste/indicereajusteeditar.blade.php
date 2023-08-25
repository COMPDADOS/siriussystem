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
                                            <i class="fa fa-gift"></i>Indice de Reajuste - Alterar
                            </div>
                            <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        
                        <div class="portlet-body form">
                                        <!-- BEGIN FORM-->
                            <div class="form-body">
                                <div class="row">
                                    <form action="/indicereajuste/indicereajuste/{{$tabela->IMB_IRJ_ID}}" 
                                        name="form_cliente" 
                                        id="i-form-cliente" class="horizontal-form"
                                        method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                     <label class="control-label">Nome do Índice</label>
                                                     <input type="text" name="IMB_IRJ_NOME" class="form-control" 
                                                    id="i-imb-forpag-nome"
                                                          value="{{$tabela->IMB_IRJ_NOME}}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group mb-4">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Padrão</span>
                                                    </div>
                                                    <input type="checkbox" class="form-control" 
                                                        name="IMB_IRJ_PADRAO"
                                                        value="{{$tabela->IMB_IRJ_PADRAO}}">
                                                </div>
                                            </div>
                                        </div>
                                            <!-- Botões -->
                                        <div class="form-actions right">
                                            <button type="cancel" class="btn default" 
                                                        id="i-btn-cancelar">Cancelar</button>
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