<div class="modal fade" id="modaltransferir" tabindex="-1" role="dialog" >
    <div class="modal-dialog "style="width:90%;" >
        <div class="modal-content">
            <div class="modal-body">
                <div class="caption font-blue div-center transferencia">
                    <span class="caption-subject bold uppercase"> Transferência de Atendimento</span>
                </div>
                <div class="row">
                    <div class="col-md-12 div-center transferencia">
                        <h5 class="bold">Este procedimento é realizado quando o corretor não entra em contato com o cliente</h5>
                        <h5 class="bold">Sempre que o corretor for tirado do atendimento, automaticamente ele poderá receber um email de notificação</h5>
                        <h5 class="bold">Atendimento número: </h5><h5 id="i-numero-atendimento"></h5>
                    </div>
                </div>                    
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6" id="dados-cliente">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-blue">
                                        <span class="caption-subject bold uppercase div-center"> Dados do Cliente</span>
                                        <i class="fa fa-search font-blue"></i>
                                    </div>
                                </div>
                                <div style="height: 130px;"  class="portlet-body form">
                                    <div class="row">
                                        <label class="control-label">Nome: </label>
                                        <span class="bold" id="i-dc-nome"></span>
                                    </div>
                                    <div class="row">
                                        <label class="control-label">Telefone(s): </label>
                                        <span class="bold"  id="i-dc-telefone"></span>
                                    </div>
                                    <div class="row">
                                        <label class="control-label">Email: </label>
                                        <span class="bold"  id="i-dc-email"></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6" id="dados-atendimento">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-blue">
                                        <span class="caption-subject bold uppercase  div-center"> Dados do Atendimento</span>
                                        <i class="fa fa-search font-blue"></i>
                                    </div>
                                </div>
                                <div style="height: 130px;" class="portlet-body form ">
                                    <div class="row">
                                        <label class="control-label">Status: </label>
                                        <span class="bold" id="i-dc-status"></span>
                                    </div>
                                    <div class="row">
                                        <label class="control-label">Prioridade: </label>
                                        <span class="bold"  id="i-dc-prioridade"></span>
                                    </div>
                                    <div class="row">
                                        <label class="control-label">Aberto por: </label>
                                        <span class="bold"  id="i-dc-cadastrado"></span>
                                    </div>
                                    <div class="row">
                                        <label class="control-label">Direcionado para: </label>
                                        <span class="bold"  id="i-dc-direcionado"></span>
                                    </div>
                                    <div class="row">
                                        <label class="control-label">Retornar Até: </label>
                                        <span class="bold"  id="i-dc-dataretorno"></span>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="portlet light bordered">
                                <div class="portlet-body form">
                                    <div class="row">
                                        <label class="control-label caption font-blue">Comentários </label>
                                        <textarea rows="2" id="i-comentarios" style="min-width: 100%"></textarea>

                                    </div>
                                </div>
                            </div>                                
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-11">
                            </div>
                            <div class="col-md-1">
                                <button class="form-control escondido btn btn-success" id="i-btn-ok-atm" data-dismiss="modal">
                                    Sair
                                </button>
                            </div>
                        </div>
                    </div>                    

                    <div class="col-md-12 transferencia">
                        <div class="col-md-12">
                            <div class="portlet light bordered">
                                <div class="portlet-body form">
                                    <div class="row">
                                        <label class="control-label caption font-blue">Transferência </label>
                                    </div>
                                    <div class="row">
                                        <div class="com-ld-12">
                                            <div class="col-md-3">
                                                <label class="control-label">Transferir P/</label>
                                                <select class="form-control" id="i-select-corretor-para">
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label">Reagendar?</label>
                                                <select class="form-control" id="i-select-reagendar">
                                                    <option value="N">Não</option>
                                                    <option value="S">Sim</option>
                                                </select>
                                            </div>
                                            <div class="col-md-5 escondido" id="i-div-reagendar">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="control-label" for="nome">Data Agenda:</label>
                                                            <input type="text" class="form-control dpicker" name="datareagenda" placeholder="Reagende" id="i-data-agenda">
                                                    </div>
                                                    </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label" for="nome">Horário:</label>
                                                        <input class="form-control  timepicker-24"
                                                        id="i-hora-agenda"
                                                        type="text" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label">Enviar Email?</label>
                                                <select class="form-control" id="i-select-enviaremail">
                                                    <option value="S">Sim</option>
                                                    <option value="N">Não</option>
                                                </select>
                                                <span class="span-email" id="i-dc-enviar-email-para"></span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                    </div>
                                    <div class="form-actions div-center">
                                        <button type="button" class="btn default " id="i-btn-cancelar" onClick="fecharModalTrans()">Cancelar</button>
                                        <button type="button" class="btn blue " id="i-btn-gravar-agenda" onClick="onTransferir()">
                                        <i class="fa fa-check"></i> Confirmar a Transferência
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

@push('script')
<script>

function transferirAtendimento( id ) 
        {

            $("#modaltransferir").modal( 'show');

            var url = "{{route('listaratendimentos')}}";

            dados =
            {
                id : id
            };

            console.log('dados '+dados.id );

            $.ajax(
                {
                    url     : url,
                    data    : dados,
                    type    : 'get',
                    dataType: 'json',
//                    async:false,
                    success : function( data )
                    {
                        var direcionadopara = data.data[0].IMB_ATD_NOME;
                        if( direcionadopara == null ) 
                        {
                            direcionadopara = '-';
                        }
                        var dataatd = moment( data.data[0].IMB_CLA_DATAATENDIMENTO ).format( 'DD/MM/YYYY');
                        $("#i-dc-nome").html( data.data[0].IMB_CLT_NOME );
                        $("#i-dc-telefone").html( data.data[0].FONES );
                        $("#i-dc-email").html( data.data[0].IMB_CLT_EMAIL );
                        $("#i-dc-prioridade").html( data.data[0].VIS_PRI_NOME );
                        $("#i-dc-status").html( data.data[0].IMB_CLA_STATUS );
                        $("#i-dc-cadastrado").html( data.data[0].IMB_ATD_NOMECADASTRO );
                        $("#i-dc-direcionado").html( direcionadopara );
                        $("#i-dc-enviar-email-para").html( 'P/ '+direcionadopara );
                        $("#i-comentarios").val( data.data[0].IMB_CLA_COMENTARIO );
                        $("#i-dc-dataretorno").html( dataatd );
                        $("#i-numero-atendimento").html(  data.data[0].IMB_CLA_ID );
                    },
                    error:function()
                    {
                        alert('erro');
                    }
                });

        }

        function fecharModalTrans()
        {
            $("#modaltransferir").modal('hide');

        }

        function onTransferir()
        {

            if( $("#i-select-corretor-para").val() == '' ) 
            {
                alert('Informe o corretor que assumirá este atendimento');
                return false;
            }

            if( $( "#i-select-reagendar" ).val() == 'S' ) 
            {
                if( $( "#i-data-agenda" ).val() == '' || $( "#i-hora-agenda" ).val() =='')
                {
                    alert('Precisa informar data e hora na agenda!');
                    return false;
                }
            }


            if( $("#i-dc-status").html() == 'Finalizado' )
            {
                alert('Não é possível transferir um atendimento já finalizado');
                return false;
            }

            var url = "{{route('transferiratendimento')}}";

            dados = 
            {
                IMB_CLA_ID : $("#i-numero-atendimento").html(),
                IMB_ATD_ID: $("#i-select-corretor-para").val(),
                IMB_CLA_DATAATENDIMENTO: $("#i-data-agenda").val(),
                IMB_CLA_HORAATENDIMENTO: $("#i-hora-agenda").val(),
                IMB_CLA_COMENTARIO:'(Atend.Transferido)'+$("#i-comentarios").val(),
            };

            $.ajaxSetup({
                headers:    
                {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });        

            $.ajax(
                {
                    url         : url,
                    dataType    : 'json',
                    type        : 'post',
                    data        : dados,
                    success     : function()
                    {
                        alert('Atendimetno transferido ');
                        $("#modaltransferir").modal('hide');
                        

                    }
            });



        }
</script>
@endpush