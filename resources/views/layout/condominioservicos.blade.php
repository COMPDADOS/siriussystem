<div class="col-md-12 back-div-zelado border-05">
<div class="portlet box blue " id="div-servicos">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Serviços
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="col-md-12 ">
            <div class="col-md-4  div-center">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <label class="control-label div-center">Portaria 24 Hs</label>
                        <input type="checkbox" class="form-control" id="IMB_CND_PORTARIA24">
                    </div>
                    <div class="col-md-8">
                        <label >Tipo de Portaria</label>
                        <select  class="form-control" id="IMB_CND_PORTARIATIPO">
                            <option value="Tradicional">Tradicional</option>
                            <option value="Tags">Por tags</option>
                            <option value="Remota">Remota</option>
                            <option value="Híbrida">Híbrida</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <label class="control-label">Empresa de Segurança</label>
                    @php
                        $adms = app('App\Http\Controllers\ctrEmpresa')->carga( 'N');
                    @endphp
                    <select id="IMB_ADMCON_IDPORTARIA"  class="select2">
                        @foreach( $adms as $adm)
                            <option value="{{$adm->IMB_EEP_ID}}">{{$adm->IMB_EEP_RAZAOSOCIAL}}({{$adm->IMB_EEP_NOMEFANTASIA}})</option>
                        @endforeach
                    </select>
                </div>
                <p>
                    Telefones:  <b><span id="i-telefone-portaria"></span></b>
               </p>
               <p>
                    Email:  <b><span id="i-email-portaria"></span></b>
           </p>
                
            </div>
            <div class="col-md-4  div-center ">
                <label class="control-label div-center">Gás e Água</label>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <label >Forma Gás</label>
                        <select  class="form-control" id="IMB_CND_GASFORMA">
                            <option value="Incluso">Incluso</option>
                            <option value="Individualizado">Individualizado</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label >Forma Água</label>
                        <select  class="form-control" id="IMB_CND_AGUAFORMA">
                            <option value="Incluso">Incluso</option>
                            <option value="Individualizado">Individualizado</option>
                        </select>
                    </div>
                    <label class="control-label">Empresa do Gás</label>
                    @php
                        $adms = app('App\Http\Controllers\ctrEmpresa')->carga( 'N');
                    @endphp
                    <select id="IMB_ADMCON_IDGAS"  class="select2">
                        @foreach( $adms as $adm)
                            <option value="{{$adm->IMB_EEP_ID}}">{{$adm->IMB_EEP_RAZAOSOCIAL}}({{$adm->IMB_EEP_NOMEFANTASIA}})</option>
                        @endforeach
                    </select>
                    <p>
                        Telefone:  <b><span id="i-telefone-gas"></span></b>
                    </p>
                    <p>
                        Email:  <b><span id="i-email-gas"></span></b>
                    </p>

                </div>            
            </div>            
            <div class="col-md-4  div-center ">
                <label class="control-label div-center">Administradora Condomínio</label>
                <div class="col-md-12">
                    @php
                        $adms = app('App\Http\Controllers\ctrEmpresa')->carga( 'N');
                    @endphp
                    <label class="control-label">Administradora</label>
                    <select id="IMB_ADMCON_ID"  class="select2">
                        @foreach( $adms as $adm)
                            <option value="{{$adm->IMB_EEP_ID}}">{{$adm->IMB_EEP_RAZAOSOCIAL}}({{$adm->IMB_EEP_NOMEFANTASIA}})</option>
                        @endforeach
                    </select>
                    <p>
                        Telefone: <b><span id="i-telefone-admcon"></span></b>
                    </p>
                    <p>
                        Email:  <b><span id="i-email-adm"></span></b>
                    </p>
                    <p>
                    </p>
                </div>            
            </div>            

        </div>
    </div>
</div>
</div>

@push( 'script')

<script>
    $("#IMB_ADMCON_IDPORTARIA").change( function()
    {
        var url = "{{route('fornecedores.find')}}/"+$(this).val();
        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function( data )
                {
                    var fone1 = ( data.IMB_EEP_CONTATO1 === null ? '' : data.IMB_EEP_CONTATO1); 
                    var fone2 = ( data.IMB_EEP_CONTATO2 === null ? '' : data.IMB_EEP_CONTATO2); 
                    var fone3 = ( data.IMB_EEP_CONTATO3 === null ? '' : data.IMB_EEP_CONTATO3);
                    

                    $("#i-email-portaria").html( fone1+' ' +fone2 + ' ' + fone3);
                    $("#i-telefone-portaria").html( data.IMB_EEP_EMAIL );
                }
            }
        )
        $("#i-email-portaria").html( '' );
        $("#i-telefone-portaria").html( '' );
    })

    $("#IMB_ADMCON_ID").change( function()
    {
        var url = "{{route('fornecedores.find')}}/"+$(this).val();
        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function( data )
                {
                    var fone1 = ( data.IMB_EEP_CONTATO1 === null ? '' : data.IMB_EEP_CONTATO1); 
                    var fone2 = ( data.IMB_EEP_CONTATO2 === null ? '' : data.IMB_EEP_CONTATO2); 
                    var fone3 = ( data.IMB_EEP_CONTATO3 === null ? '' : data.IMB_EEP_CONTATO3);
                    

                    $("#i-telefone-admcon").html( fone1+' ' +fone2 + ' ' + fone3);
                    $("#i-email-admcon").html( data.IMB_EEP_EMAIL );
                },
                error:function()
                {
                    $("#i-email-admcon").html( '');
                    $("#i-telefone-admcon").html( '');
                }
            }
        )
        
    })

    $("#IMB_ADMCON_IDGAS").change( function()
    {
        var url = "{{route('fornecedores.find')}}/"+$(this).val();
        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function( data )
                {
                    var fone1 = ( data.IMB_EEP_CONTATO1 === null ? '' : data.IMB_EEP_CONTATO1); 
                    var fone2 = ( data.IMB_EEP_CONTATO2 === null ? '' : data.IMB_EEP_CONTATO2); 
                    var fone3 = ( data.IMB_EEP_CONTATO3 === null ? '' : data.IMB_EEP_CONTATO3);
                    

                    $("#i-telefone-gas").html( fone1+' ' +fone2 + ' ' + fone3);
                    $("#i-email-gas").html( data.IMB_EEP_EMAIL );
                },
                error:function()
                {
                    $("#i-email-gas").html('');
                    $("#i-telefone-gas").html('');
                }
            }
        )
        
    })

</script>

@endpush