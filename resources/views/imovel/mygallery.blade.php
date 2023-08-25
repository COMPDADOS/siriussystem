@extends('layout.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                            <i class="fa fa-gift"></i>Imagens
                            </div>
                            <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        
                        <div class="portlet-body form">
                                        <!-- BEGIN FORM-->
                            <div class="form-body">
                                <div class="row">
                                    @foreach( $imagens as $imagem)
                                        <div class="col-md-4">
                                        <p class="card-text">@if( $imagem->IMB_IMG_PRINCIPAL =="S" )Principal @else  .
                                                    @endif</p>
                                                <div class="card-body">
                                                    <p class="card-text">{{ $imagem->IMB_IMG_DESCRICAO }}</p>

                                            <div class="card  mb-4 shadow-sm" >
                                                    <img class="card-img-bottom" style="width:200px"
                                                    src="/storage/{{ $imagem->IMB_IMG_ARQUIVO }}">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="btn-group">
                          <!--button type="button" class="btn btn-sm btn-outline-secondary">Download</button-->
                                                            <form action="" method="POST">
                                                            @csrf
                                                                <input type="hidden" name="_method" value="delete">
                                                                <button type="submit" class="btn btn-sm btn-danger">Apagar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                            <i class="fa fa-gift"></i>Enviar Imagens
                            </div>
                            <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        
                        <div class="portlet-body form">
                                        <!-- BEGIN FORM-->
                            <div class="form-body">
                                <div class="row">
                                    <form action="/fotos/imoveis/grava" 
                                        name="form_cliente" 
                                        
                                        id="i-form-cliente" class="horizontal-form"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$imagem->IMB_IMV_ID}}">
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="custom-file">
                                                <input type="file" id="arquivo" name="arquivo">
                                            </div>
                                        </div>

                                        <div class="form-actions right">
                                            <button type="submit" class="btn btn-priamary my-2">Enviar</button>
                                            <button type="reset" class="btn btn-secondary my-2">Cancelar</button>
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
