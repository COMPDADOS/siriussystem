@extends('meuimovel.meusimoveismenu')
@section( 'scripttop')
@endsection


@section('content')



<div class="page-bar">
    <input type="hidden" id="idcliente" value ="{{$clt->IMB_CLT_ID}}">  
        <div class="col-md-12 div-center">
            <img  src="{{env('APP_URL')}}/storage/images/{{$imb->IMB_IMB_ID}}/logos/logoportal.png" alt="">
        </div>
        <p></p>
        <p></p>
        <div class="col-md-12 div-center">
            <h1>Seja Bem-vindo ao nosso portal</h1>
        </div>
        <p></p>
        <p></p>
        <div class="col-md-12 div-center">
            <h3>Através deste portal você poderá ter acesso aos seus imóveis e contratos</h3>
        </div>
        <hr>
        @php
            $ehlt = app( 'App\Http\Controllers\ctrCliente')->ehLocatario( $clt->IMB_CLT_ID );
            $ehld = app( 'App\Http\Controllers\ctrCliente')->ehLocador( $clt->IMB_CLT_ID );
        @endphp
        <div class="col-md-12">
             @if( $ehld > 0 )
                @php
                    $ppis = app( 'App\Http\Controllers\ctrPropImo')->imoveisProprietario( $clt->IMB_CLT_ID);
                @endphp
                <div class="col-md-12 div-center">
                    <h5>Você é um proprietário de imóvel</h5>
                </div>
                <div class="col-md-12 div-center">
                    <h6><u> Seus Imóveis</u></h6>
                </div>
                <table class="table table-striped">
                    <thead>
                        <th width="10%">Ações</th>
                        <th width="80%">Endereço</th>
                        <th width="10%">Situação</th>
                    </thead>
                    <tbody>
                        @foreach( $ppis as $reg )
                        <tr>
                            <td><a class="btn btn-primary" href="javascript:extrato( {{$reg->IMB_IMV_ID}} )"><i class="fa fa-print" aria-hidden="true"></i>Extrato Recto.</a></td>
                            <td>{{ app('App\Http\Controllers\ctrRotinas')->imovelEndereco( $reg->IMB_IMV_ID)}}</td>
                            <td>{{ app('App\Http\Controllers\ctrRotinas')->situacaoImovel( $reg->IMB_IMV_ID)}}</td>
                            
                        </tr>
                        @endforeach
                    
                    </tbody>
                </table>
                

            @endif
            <ul>
                @if( $ehlt > 0 )
                <li>
                    <a class="btn btn-primary" href="{{route('meuimovel.meuscontratos')}}/{{$clt->IMB_CLT_ID}}">Click aqui P/ 2ª via de boletos e extrato</a>
                </li>
                @endif
            </ul>
        </div>
</div>

<div class="modal fade" id="modalextratorep" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <input type="hidden" id="IMB_IMV_ID-PORTAL">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Extrato
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <div class="row">
                        <hr>
                    </div>

                    <div class="row">
                        <div class="col-md-12 div-center">
                            <label class="label-control">Data Inicial</label>
                            <input class="form-control" type="date" id="i-datainicial" value="<?php date('Y/m/d')?>">
                        </div>
                        
                        <div class="col-md-12 div-center">
                            <label class="label-control">Data Final</label>
                            <input class="form-control" type="date" id="i-datafinal" >
                        </div>
                        <div class="col-md-12 div-center">
                            <button class="btn btn-primary" onClick="cargaDemonstrativo()">Gerar Relatório</button>
                        </div>                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-secondary" onClick="fecharModal()">sair</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function extrato( id)
    {
        $("#IMB_IMV_ID-PORTAL").val( id );

//        $("#i-datainicial").val( moment().format( 'YYYY/MM/DD'));
        //$("#i-datafinal").val( moment().format( 'YYYY/MM/DD'));
        $("#modalextratorep").modal( 'show');
    }

    

    function cargaDemonstrativo()
    {

        if( $("#i-datainicial").val() == '' )
        {
            alert('Informe a data inicio');
            return false;
        }

        if( $("#i-datafinal").val() == '' )
        {
            alert('Informe a data fim');
            return false;
        }

        var url = "{{route('portal.demonstrativosnew')}}?IMB_CLT_ID="+
                    $("#idcliente").val()+
                    "&datainicial="+$("#i-datainicial").val()+
                    "&datafinal="+$("#i-datafinal").val()+
                    "&IMB_IMV_ID="+$("#IMB_IMV_ID-PORTAL").val();

        
        window.open( url );


}


function fecharModal()
{
    $("#modalextratorep").modal( 'hide');

}

</script>


@endsection
