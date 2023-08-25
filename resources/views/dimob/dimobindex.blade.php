@extends('layout.app')

@section('scripttop')
<style>

    .escondido
    {
        display:none;
    }
    .new-input{width:500px}    
    .new-input-200{width:200px}    
    .td-50
    {   
        height:50%;
    }

    .font-20
    {
        font-size:30px;
    }

    .td-center
    {   
        text-align:center;
    }
    
    .excluido {
      text-decoration: line-through;
    }
    .td-direita
    {   
        text-align:right;
    }

    table.dataTable tbody th, table.dataTable tbody td 
    {
        padding: 1px 10px; 
        text-align:center;

    }


    .div-center
    {
        text-align:center;
    }

    .fundo-grey
    {
        background-color: #eff5f5;
    }

    .azul
    {
        color:blue;
    }
    .font-white
    {
        color:whi;
    }
    .vermelho
    {
        color:red;
    }

    .fundo-azul
    {
        background-color:blue;
    }
    .fundo-black
    {
        background-color:black;
    }

</style>
@endsection

@section('content')


<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Dimob
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
        </div>
    </div>

    <div class="portlet-body form">
        <div class="row">
            <hr>
        </div>
        <div class="row" >

            <div class="col-md-12">
                <div class="col-md-2 div-center"><span class="lbl-medidas"></span>
                    <label class="lbl-medidas">
                        <a href="{{route('dimob.tela')}}" title="Gerar Nova Base">
                            <i class="fa fa-spinner fa-3x " style="color:blue" aria-hidden="true">
                            </i>
                            <p>Gerar Nova Base
                            </p>
                        </a>
                    </label>
                </div>
                <div class="col-md-2 div-center"><span class="lbl-medidas"></span>
                    <label class="lbl-medidas">
                        <a href="{{route('dimob.consultarbase.index')}}" title="Manutenção da Base e Gerar Informes">
                            <i class="fa fa-tasks fa-3x" aria-hidden="true"></i>                    
                            <p>Base Gerada/Informes
                            </p>
                        </a>
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
        <hr>
        </div>        
    </div>
</div>





@endsection

@push('script')
<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="{{asset('/global/scripts/moment.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui-timepicker-addon.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>

<script>



    $(document).ready(function() 
    {

        $("#sirius-menu").click();
    });
    
</script>
@endpush


