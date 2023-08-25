@extends('layout.app')

@section('scripttop')
<style>
.btn {
  background-color: #f0f5f5;
  border: 2px;
  color: white;
  padding: 10px 2px;
  font-size: 16px;
  cursor: pointer;
}
</style>
@endsection



@section('content')

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Fichas para Captação de Imóveis</span>
            <i class="fa fa-search font-blue"></i>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="form-body">
            <div class="row">

                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaoandarcorp')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Andar Corporativo
                    </a>
                </div>
                <div class="col-md-1">
                </div>
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaoapartameto')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Apartamento
                    </a>
                </div>
                <div class="col-md-1">
                </div>
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.apartamentoduplex')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Apto. Duplex
                    </a>
                </div>
                <div class="col-md-1">
                </div>
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.apartamentotriplex')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Apto. Triplex
                    </a>
                </div>
                <div class="col-md-1">
                </div>
            </div>
            <hr>
            <div class="row">

                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaoarea')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Área
                    </a>
                </div>
                <div class="col-md-1">
                </div>

                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaobangalo')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Bangalô
                    </a>
                </div>

                <div class="col-md-1">
                </div>

                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaobarracao')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Barracão
                    </a>
                </div>

                <div class="col-md-1">
                </div>

                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaoboxgaragem')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Box/Garagem
                    </a>
                </div>

                                

            </div>
            
            <hr>
            <div class="row">
            <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaocasa')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Casa
                    </a>
                </div>            
                <div class="col-md-1">
                </div>
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaochacara')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Chácara
                    </a>
                </div>            
                <div class="col-md-1">
                </div>
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaocobertura')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Cobertura
                    </a>
                </div>            
                <div class="col-md-1">
                </div>
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaoconjunto')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Conjunto
                    </a>
                </div>            
                                
            </div>

            <hr>
            <div class="row">
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaoedicula')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Edícula
                    </a>
                </div>  
                <div class="col-md-1">
                </div>
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaofazenda')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Fazenda
                    </a>
                </div>            

                <div class="col-md-1">
                </div>
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaoflat')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Flat
                    </a>
                </div>            
                <div class="col-md-1">
                </div>
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaogalpao')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Galpão
                    </a>
                </div>            

            </div>          
            
            <hr>
            <div class="row">
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaoharas')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Haras
                    </a>
                </div>  
                <div class="col-md-1">
                </div>
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaohoel')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Hotel    
                    </a>
                </div>            
                <div class="col-md-1">
                </div>
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaoilha')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Ilha
                    </a>
                </div>            
                <div class="col-md-1">
                </div>
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaokitnet')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Kitnet
                    </a>
                </div>            

            </div>

            <hr>
            <div class="row">
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaolaje')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Laje
                    </a>
                </div>  
                <div class="col-md-1">
                </div>
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaoloft')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Loft
                    </a>
                </div>            
                <div class="col-md-1">
                </div>
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaoloja')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Loja
                    </a>
                </div>            
                <div class="col-md-1">
                </div>
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaopavilhao')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Pavilhão
                    </a>
                </div>            
            </div>

            <hr>
            <div class="row">
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaoponto')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Ponto
                    </a>
                </div>  
                <div class="col-md-1">
                </div>
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaopousada')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Pousada
                    </a>
                </div>            
                <div class="col-md-1">
                </div>
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaopredio')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Prédio
                    </a>
                </div>            
                <div class="col-md-1">
                </div>
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaorancho')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Rancho
                    </a>
                </div>            
            </div>            
            <hr>
            <div class="row">
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaosala')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Sala
                    </a>
                </div>            
                <div class="col-md-1">
                </div>
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaosalao')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Salão
                    </a>
                </div>            
                <div class="col-md-1">
                </div>
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaositio')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Sítio
                    </a>
                </div>            
                <div class="col-md-1">
                </div>
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaosobrado')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Sobrado
                    </a>
                </div>            
                                
            </div>    
            <hr>
            <div class="row">
                <div class="btn col-sm-4 col-md-3 col-lg-2">
                    <a href="{{route('ficha.captacaoterreno')}}" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;&nbsp;Terreno
                    </a>
                </div>            
                <div class="col-md-1">
                </div>                    
            </div>                    
        </div>
    </div>
</div>




@endsection

@push('script')

<script src="{{asset('/global/plugins/jquery-minicolors/jquery.minicolors.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/pages/scripts/components-color-pickers.min.js')}}" type="text/javascript"></script>

<script>


</script>

@endpush




