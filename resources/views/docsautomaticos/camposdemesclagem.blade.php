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

    table.dataTable td 
    {
        font-size: 14px;
        
    }

    input {border:0;outline:0; width: 100%;}
    input:focus {outline:none!important;}    
    
</style>
@endsection

@section('content')


<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Campos para Mesclagem em Documentos</span>
            <i class="fa fa-search font-blue"></i>
        </div>


    </div>
    <div class="portlet-body form">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover"  id="resultTable">
                    <thead>
                        <th class="td-center" style="width: 75%">Descriçao do Campos</th>
                        <th class="td-center" style="width: 20%">Nome do Campo</th>
                        <th class="td-center" style="width: 5%"></th>
                    </thead>
                    @php
                        $campos = app('App\Http\Controllers\ctrRotinas')->camposMesclagem();
                    @endphp
                    <tbody>
                        @foreach ($campos as $campo)
                            <tr>
                                <td class="div-center">{{$campo->GER_CMM_DESCRICAO}}</td>
                                <td class="div-center"><input type="text" id="texto{{$campo->GER_CMM_ID}}" value="{{$campo->GER_CMM_NOMECAMPO}}"></td>
                                <td class="div-center">
                                    <a href="javascript:copiarTexto({{$campo->GER_CMM_ID}})">
                                        <i class="fa fa-clone" aria-hidden="true"></i></a>                                    
                                </td>
                            </tr>
                            
                        @endforeach
                        

                    </tbody>
                </table>
            </div>
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

    
    var table = $('#resultTable').DataTable(
    {
        "pageLength": 40,
        "language": 
        {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            sLoadingRecords: '<img src="{{asset('/layouts/layout/img/loader.gif')}}"/>',
                sProcessing: '<img src="{{asset('/layouts/layout/img/loader.gif')}}"/>',
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": 
            {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
        },       
    });
  
         
    function copiarTexto( id) 
    {
        var texto = $("#texto"+id).val();

        navigator.clipboard.writeText( texto );

    }    
    
</script>
@endpush


