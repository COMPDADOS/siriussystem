<div class="modal fade" id="modalconciacaoarquivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width:40%;">
        <form action="{{route('conciliacao.passo2')}}" method="post" enctype="multipart/form-data">
        <div class="modal-content ">
            <input type="hidden" id="i-tipo-alteracao-data">
            <input type="hidden" id="i-numero-recibo">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Selecione o arquivo bancário
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        @php
                                            $contas = app('App\Http\Controllers\ctrContaCaixa')->cargaAtivasBancarias();
                                        @endphp
                                        <label class="control-label">Selecione a Conta Bancária</label>
                                        <select  class="form-control" id="FIN_CCX_ID-ofx" name="conta" required>
                                            <option value="">Selecione</option>
                                            @foreach( $contas as $conta )
                                                <option value="{{$conta->FIN_CCX_ID}}">{{$conta->FIN_CCX_NOME}}</option>
                                            @endforeach
                                        </select>                                    
                                    </div>
                                    <div class="col-md-8">
                                        @csrf

                                        <input type="hidden" id="nomedoarquivooriginal" name="nomeoriginal">
                                        <label class="control-label" for="file">Arquivo</label>
                                        <input class="form-control" type="file" name="arquivo" id="arquivo" required><br>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-4 div-center">
                                    
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">Processar</button>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">sair</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>

    </div>
</div>

@push('script')


@endpush
