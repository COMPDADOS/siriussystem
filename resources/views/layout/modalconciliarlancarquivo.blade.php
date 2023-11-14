<div class="modal fade" id="modalconciliarlancfilebank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width:70%;">
        <div class="modal-content ">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Conciliar Lançamento Pelo Arquivo
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <div class="row">
                        <hr>
                    </div>

                    <div class="row">
                        <input type="hidden" id="FIN_LCX_IDCONCIL">
                        <div class="col-md-12">
                            <input type="hidden" id="i-tipo-lancamento-conc">
                            <div class="col-md-2">
                                <h6>Data da Efetivação</h6>
                                <input class="form-control div-center" type="date" id="i-dataefetivacao">
                            </div>
                            <div class="col-md-4">
                                <h6>Fornecedor</h6>
                                @php
                                    $forn = app('App\Http\Controllers\ctrEmpresa')->carga('N');
                                @endphp
                                <select class="form-control select2" id="i-select-forn-conc">
                                   <option value="-1">Selecione.....</option>
                                    @foreach( $forn as $f)
                                        <option value="{{$f->IMB_EEP_ID}}">{{$f->IMB_EEP_RAZAOSOCIAL}}({{$f->IMB_EEP_NOMEFANTASIA}})</option>
                                    @endforeach

                                </select>
                            </div>                            
                            <div class="col-md-4">
                                @php
                                    $cfcs = app('App\Http\Controllers\ctrCFC')->cargaSemJson();
                                @endphp

                                <h6>Classificação</h6>
                                <select class="form-control select2" id="i-select-cfc-conc">
                                    <option value="-1">Selecione.....</option>
                                    @foreach( $cfcs as $cfc)
                                        <option value="{{$cfc->FIN_CFC_ID}}">{{$cfc->FIN_CFC_DESCRICAO}}</option>
                                    @endforeach
                                </select>
                            </div>                
                            <div class="col-md-1">
                                
                            </div>                            
            
                            <div class="col-md-1">
                                <button class="form-control btn btn-primary">Confirmar</button>
                                <button class="form-control btn btn-danger">Sair</button>
                            </div>                            

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                    <button type="button" class="btn btn-primary" onClick="conciliarLancamento()">Conciliar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">sair</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('script')
<script>

    function cargaCfcConcLan()
    {
        $.ajax(
        { 
            url : "{{route('cfc.carga')}}",
            dataType:'json',
            type:'get',
            async:false, 
            success:function(data)
            {
                    
                $("#i-select-cfc-conc").empty();

                linha =  '<option value="">Informe um CFC</option>';
                $("#i-select-cfc-conc").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha =
                    '<option value="'+data[nI].FIN_CFC_ID+'">'+
                    data[nI].FIN_CFC_DESCRICAO+'<b>('+data[nI].FIN_CFC_ID+')</b></option>';
                    $("#i-select-cfc-conc").append( linha );
                }
            }
        });


    }

    $("#i-select-forn-conc").change( function()
    {
        var id=$("#i-select-forn-conc").val() ;
        var url = "{{route('fornecedores.findjson')}}/"+id;
        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function( data )
                {

                    console.log( data );
                    $('#i-select-cfc-conc').val( data.FIN_CFC_ID).select2();
                }
            }
        )
        
    })

</script>


@endpush
