@extends('layout.app')
@section('scriptop')
<style>
    #div-administracao      {display: none;}
    #div-comercial          {display: none;}
    #div-cliente            {display: none;}
    #div-botoes             {display: none;}
    #div-botoes-clientes    {display: none;}
    #div-botoes-corretor    {display: none;}
</style>
@endsection
@section('content')
<div class="row">
    <div class="card-group" id="div-botoes">
        <div class="row">
            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center  border-right-2">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/site.png')}}">
                    <div class="card-block">
                         <a href="{{route('cliente.index')}}" class="btn btn-success">Clientes</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center border-right-0">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/novoimovel.png')}}">
                    <div class="card-block">
                     <a href="{{route('imovel.index')}}" class="btn btn-primary">Imóveis</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center  border-right-2">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/atendimentos.png')}}">
                    <div class="card-block">
                         <a href="{{ route('atendimento')}}" class="btn btn-success">Atendimentos</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center   border-right-0">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/alugarimovel.png')}}">
                    <div class="card-block">
                        <a href="" class="btn btn-primary">Alugar Imóvel</a>
                    </div>
                </div>
            </div>

        
        </div>
        <div class="row">
        <hr>
        </div>
        <div class="row">


            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center   border-right-0">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/gerenciadorcontrato.png')}}">
                    <div class="card-block">
                         <a href="{{route('contrato.index')}}" class="btn btn-primary">Gerenciad. Contratos</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center   border-right-0">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/lancamentos.png')}}">
                    <div class="card-block">
                        <a href="#" class="btn btn-primary">Lançamentos</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center border-right-0">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/receber.png')}}">
                    <div class="card-block">
                     <a href="{{ route('recebimento')}} " class="btn btn-primary">Receber Aluguel</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center   border-right-0">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/repassar.png')}}">
                    <div class="card-block">
                     <a href="#" class="btn btn-primary">Repassar Aluguel</a>
                    </div>
                </div>
            </div>
        
    
        </div>
        
        <div class="row">
        <hr>
        </div>
        
        <div class="row">
            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center  border-right-2">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/bancoscaixa.png')}}">
                    <div class="card-block">
                         <a href="#" class="btn btn-info">Bancos/Caixa</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center  border-right-0">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/contasapagar.png')}}">
                    <div class="card-block">
                     <a href="#" class="btn btn-info">Contas a Pagar</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center  border-right-0">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/recebidos.png')}}">
                    <div class="card-block">
                     <a href="#" class="btn btn-info">Recebidos/Período</a>
                    </div>
                </div>
            </div>
        
            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center  border-right-0">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/repassado.png')}}">
                    <div class="card-block">
                        <a href="#" class="btn btn-info">Repassados/Período</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
        <hr>
        </div>
        
        <div class="row">

            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center  border-right-0">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/receber.png')}}">
                    <div class="card-block">
                     <a href="#" class="btn btn-success">Solicitações</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center  border-right-0">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/agenda.png')}}">
                    <div class="card-block">
                     <a href="javascript:agendamentos()" class="btn btn-success">Agendamentos</a>
                    </div>
                </div>
            </div>
        
            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center  border-right-0">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/lancamentos.png')}}">
                    <div class="card-block">
                        <a href="#" class="btn btn-success">Auditoria</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
        <hr>
        </div>
        
        <div class="row">
            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center  border-right-2">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/site.png')}}">
                    <div class="card-block">
                         <a href="/site" class="btn btn-success">Site Imobiliária</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">   
                <div class="card text-center   border-right-0">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/cobrancabancaria.png')}}">
                    <div class="card-block">
                     <a href="#" class="btn btn-primary">Cobrança Bancária</a>
                    </div>
                </div>
            </div>


        </div>

    </div>


    <div class="card-group" id="div-botoes-cliente">
        <div class="row">
            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center   border-right-0">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/inadimplentes.png')}}">
                    <div class="card-block">
                        </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center border-right-0">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/novoimovel.png')}}">
                    <div class="card-block">
                     <a href="#" class="btn btn-primary">Seus Imóveis</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center   border-right-0">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/boleto.png')}}">
                    <div class="card-block">
                        <a href="" class="btn btn-primary">Segunda Via</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center   border-right-0">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/atendimentos.png')}}">
                    <div class="card-block">
                         <a href="{{route('atendimento')}}" class="btn btn-primary"> Atendimentos</a>
                    </div>
                </div>
            </div>


        
        </div>
        <div class="row">
        <hr>
        </div>
        <div class="row">

            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center  border-right-2">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/bancoscaixa.png')}}">
                    <div class="card-block">
                         <a href="#" class="btn btn-info">Extrato de Recebimentos</a>
                    </div>
                </div>
            </div>            
            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center  border-right-2">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/bancoscaixa.png')}}">
                    <div class="card-block">
                         <a href="#" class="btn btn-info">Extrato de Pagamentos</a>
                    </div>
                </div>
            </div>            
        </div>
        
        <div class="row">
        <hr>
        </div>
    </div>    


    <div class="card-group" id="div-botoes-corretor">
        <div class="row">
            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center  border-right-2">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/site.png')}}">
                    <div class="card-block">
                         <a href="{{route('cliente.index')}}" class="btn btn-success">Clientes</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center border-right-0">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/buscarimovel.png')}}">
                    <div class="card-block">
                     <a href="{{ route('imovel.index')}}" class="btn btn-primary">Consultar Imóveis</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center border-right-0">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/dash.png')}}">
                    <div class="card-block">
                     <a href="{{route('dashboard.comercial.panorama')}}/{{Auth::User()->IMB_IMB_ID}}" 
                     class="btn btn-primary">Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        <hr>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center border-right-0">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/novoimovel.png')}}">
                    <div class="card-block">
                     <a href="#" class="btn btn-primary">Meus Imóveis</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center border-right-0">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/novoimovel.png')}}">
                    <div class="card-block">
                     <a href="#" class="btn btn-primary">Minhas Captações</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                <div class="card text-center   border-right-0">
                    <img class="card-img-top" src="{{asset('/layouts/layout/img/atendimentos.png')}}">
                    <div class="card-block">
                         <a href="{{route('atendimento')}}" class="btn btn-primary"> Atendimentos</a>
                    </div>
                </div>
            </div>
        
        </div>
        <div class="row">
            <hr>
        </div>
       
    </div>    

</div>
@endsection



