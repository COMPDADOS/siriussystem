@extends('layout.app')

@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Dashboard</span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Ações
                <i class="fa fa-arrow-alt-circle-down"></i>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="#">
                        <i class="icon-bell"></i> Ação 1
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
                    

<!-- END PAGE HEADER-->


<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Metas para o Mês Corrente
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="form-body">

            @foreach( $metames as $meta)
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat2 ">
                            <div class="display">
                                <div class="number">
                                    <h3 class="font-green-sharp">
                                        <span data-counter="counterup" data-value="{{$meta->IMB_MET_REALIZADO}}" ></span>
                                        <small class="font-green-sharp"></small>
                                    </h3>
                                    <small>{{$meta->QUADRO}}</small>
                                </div>
                                <div class="icon">
                                    <i class="icon-pie-chart"></i>
                                </div>
                            </div>
                            <div class="progress-info">
                                <div class="progress">
                                    <span style="width: {{$meta->PERCENTUAL}}%;" class="progress-bar progress-bar-success green-sharp">
                                    <span class="sr-only">{{$meta->PERCENTUAL}}% progress</span>
                                </span>
                            </div>
                            <div class="status">
                                <div class="status-title"> Meta </div>
                                <div class="status-number"> {{ number_format($meta->IMB_MET_METANOVOS,0)}} {{$meta->QUADRO}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            
        </div>
    </div>
</div>

@section( 'script')

<script>

    $(document).ready(function()
    {
        $('#clickmewow').click(function()
        {
            $('#radio1003').attr('checked', 'checked');
        });

    })

    function cargaMetas()
    {

        url="{{ route('metas.carga')}}/"+$("#I-IMB_IMB_IDMASTER").val()+"/S";


        $.ajax({
            type: "GET",
            url: url,
            async:false,
            success: function(data)
            {

            },
            error: function()
            {
            alert('erro')
            }
        });          

    }

</script>

@endsection
@endsection

