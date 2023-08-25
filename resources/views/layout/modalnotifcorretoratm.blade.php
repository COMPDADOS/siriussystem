@section( 'scripttop')
<style>
    .bg-modalnotify
    {
        background-color:#ffffe6;

    }

</style>

@endsection
<div class="modal custom bg-modalnotify" id="modalnotifnovosatm" tabindex="-1" role="dialog" aria-labelledby="trackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" style="width:50%;" >
        <div class="modal-content">

            <div class="modal-header">
                <div class="col-md-1">
                    <i class="fa fa-smile-o fa-2x" style="color:orange" aria-hidden="true"></i>                    

                </div>
                <div class="col-md-10">
                <h4 class="div-center" id="trackModalLabel"><u>{{Auth::user()->IMB_ATD_NOME}}, novo atendimento pra você</u></h4></i>
                </div>
                <div class="col-md-1">
                <i class="fa fa-smile-o fa-2x" style="color:orange" aria-hidden="true"></i>                    
                </div>
                
            </div>

            <div class="modal-body modal-body-notif ">
                @php
                    $atms = app('App\Http\Controllers\ctrClienteAtendimento')->verCorretorAtm();
                @endphp
                    <table class="table table-hover">
                        <tbody>
                            @foreach( $atms as $atm )
                            <tr>
                                <td width="100%">
                                    <div id="linha{{$atm->IMB_CLA_ID}}">
                                        <div class="col-md-12">
                                                <div class="col-md-2">
                                                <a title="Ir para o atendimento" href="javascript:verAtm({{$atm->IMB_CLA_ID}})"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                <a title="Nao mostrar mais" href="javascript:cienteAtm({{$atm->IMB_CLA_ID}})"><i class="fa fa-bell-slash-o" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="col-md-3">
                                                Data: <b>{{ date(  'd/m/Y H:i', strtotime($atm->IMB_CLA_DATACADASTRO)    )}}</b>
                                            </div>
                                            <div class="col-md-4">
                                                Prioridade: <b>{{$atm->IMB_CLA_PRIORIDADE}}</b>
                                            </div>
                                            <div class="col-md-3">
                                                Pretensão: <b>{{$atm->IMB_CLA_PRETENSAO}}</b>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-2">

                                            </div>
                                            <div class="col-md-3">
                                                Para: <b>{{ date(  'd/m/Y H:i', strtotime($atm->IMB_CLA_DATAATENDIMENTO)    )}}</b>
                                            </div>
                                            <div class="col-md-7">
                                                Cliente: <b>{{$atm->IMB_CLT_NOME}} - {{$atm->TELEFONE}}</b>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
            </div>

            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" onClick="fecharNoti()">Fechar Notificações</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@include('layout.modalatendimento')
@push('script')

<script>
    function verAtm( id )
    {
        $(".transferencia").hide();
        $("#i-comentarios").prop( 'readonly', true );
        $("#i-btn-ok-atm").show();
        
        transferirAtendimento( id );
    }

    function fecharNoti()
    {
        $("#modalnotifnovosatm").modal('hide');
    }

    function cienteAtm( id )
    {

        var url = "{{route('atendimento.cienteatm')}}";

        var dados = { IMB_CLA_ID : id}
        $.ajaxSetup(
            {
            headers:
            {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
            });
            
        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'post',
                data:dados,
                success:function(data)
                {
                    $("#linha"+data).hide();

                },
                error:function()
                {
                    alert('Erro ao dar ciência do atendimento');
                }
            }
        )

    }
</script>
@endpush

