@extends('layout.app')
@section('scripttop')
<style>
.dashed{
    text-decoration: overline underline line-through;
    color:#999;
}
.td-rigth
  {
    text-align:right;
  }

  .td-center
  {
    text-align:center;
  }

  .div-left
  {
    text-align:left;
  }

.total-selecionado
{
  background-color:#b3d9ff;
  color:#003366;
  font-weight: bold;
  text-align:center;
}


.cardtitulo {
  text-align: left;
  font-size: 16px;
  color: #4682B4;
  font-weight: bold;

}
.cardtitulo-20 {
  text-align: left;
  font-size: 20px;
  color: #4682B4;
  font-weight: bold;

}

.escondido
{
  display:none;
}

.outset
{
   border-style: outset;
}
.inset
{
   border-style: inset;
}
.groove 
{
   border-style: groove ;
}

.color-white
{
    color:white;
}



</style>

@endsection

@section('content')

 <!-- <div style="width: 500px;"><canvas id="dimensions"></canvas></div><br/> -->
 <div class="row">
    <div class="col-md-12">
        
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputType" class="col-sm-2 control-label">Últimos Meses</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="i-meses" value="6" max="12" min="1">
                </div>
            </div>            
        </div>
        <div class="col-md-6"></div>
        <div class="col-md-2">
            <button class="btn btn-primary form-control" onClick="calcularEstat()">Atualizar Gráficos</button>
        </div>

    </div>
    <div class="col-md-12">
        <div class="col-md-6">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption color-white">
                        <span class="caption-subject bold uppercase"> Locações Realizadas</span>
                            <i class="fa fa-search font-blue"></i>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                    </div>

                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-md-12">
                        <div style="width: 100%px;"><canvas id="locacoesrealizadas"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption color-white">
                        <span class="caption-subject bold uppercase"> Rescisões Realizadas</span>
                            <i class="fa fa-search font-blue"></i>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                    </div>

                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="width: 100%px;"><canvas id="rescisoesrealizadas"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-6">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption color-white">
                        <span class="caption-subject bold uppercase"> Posição da carteira de locação</span>
                            <i class="fa fa-search font-blue"></i>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                    </div>

                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-md-12">
                        <h4 class="div-center">Sua carteira possui {{app('App\Http\Controllers\ctrEstatisticas')->contratosAtivosTotal()}} contratos ativos neste momento</h4>
                                <div style="width: 100%px;"><canvas id="contratosativos"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption color-white">
                        <span class="caption-subject bold uppercase"> Situação da Inadimplência</span>
                            <i class="fa fa-search font-blue"></i>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                    </div>

                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="div-center">Como está sua inadimplência no momento - Normal: <b> {{app('App\Http\Controllers\ctrEstatisticas')->contratosInadimplentesSemJur()}}</b>  
                            - No Jurídico: <b>{{app('App\Http\Controllers\ctrEstatisticas')->contratosInadimplentesJur()}}</h4>
                            <div style="width: 100%px;"><canvas id="inadimplencia"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-6">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption color-white">
                        <span class="caption-subject bold uppercase"> Concentração de Recebimentos</span>
                            <i class="fa fa-search font-blue"></i>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                    </div>

                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="width: 100%px;"><canvas id="concentracaoreceb"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption color-white">
                        <span class="caption-subject bold uppercase"> Valores de Aluguéres</span>
                            <i class="fa fa-search font-blue"></i>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                    </div>

                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="width: 100%px;"><canvas id="faixavalores"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


 </div>
 
    
@endsection


@push('script')
<script type="text/javascript" src="{{asset('/js/Chart.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"></script>
    
<script>
    $(document).ready(function()
    {
        $("#sirius-menu").click();

        estatisticaLocacoesRealizadas(6);
            estatisticaRescisoesRealizadas(6);
            estatisticaTaxaAdm();
            inadimplencia();
        concentracaoReceb();
        faixaValores();
    });    
    function estatisticaLocacoesRealizadas( meses )
    {

        
        var url = "{{route( 'estatisticas.locacoesrealizadas')}}";
        dados = {
            datafinal: moment().format( 'YYYY/MM/DD'),
             datainicial :  moment(). subtract(meses, 'months' ). format( "YYYY/MM/01" ),
            agrupar : 'M'
        };

        console.log( dados );

        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                data: dados,
                success:function( data )
                {

                    console.log( data );
                    meses = data.map( function(eLem )
                    {
                        return eLem.month;

                    })

                    console.log( meses );

                    quant = data.map( function(eLem )
                    {
                        return eLem.count;

                    })

                    chartlocacoes = new Chart
                    (
                            document.getElementById('locacoesrealizadas'),
                            {
                                type: 'bar',
                                data: 
                                {   labels: meses,
                                    datasets: [
                                        {
                                            label: 'Locações Realizadas no período',
                                            backgroundColor: 'rgb(0, 102, 204)',
                                            borderColor: 'rgb(25,25,112)',
                                            data:quant
                                        }
                                    ]
                                },
                                options:{}
                            }
                    );

                }
            }
        )
        if (typeof(chartlocacoes) !== "undefined")
        chartlocacoes.destroy();
    }

    function estatisticaRescisoesRealizadas( meses )
    {

        
        var url = "{{route( 'estatisticas.rescisoesrealizadas')}}";
        dados = {
            datafinal: moment().format( 'YYYY/MM/DD'),
             datainicial :  moment(). subtract(meses, 'months' ). format( "YYYY/MM/01" ),
            agrupar : 'M'
        };

        console.log( dados );

        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                data: dados,
                success:function( data )
                {

                    console.log( data );
                    meses = data.map( function(eLem )
                    {
                        return eLem.month;

                    })

                    console.log( meses );

                    quant = data.map( function(eLem )
                    {
                        return eLem.count;

                    })

                    

                    chartrescisoes = new Chart
                    (
                            document.getElementById('rescisoesrealizadas'),
                            {
                                type: 'bar',
                                data: 
                                {   labels: meses,
                                    datasets: [
                                        {
                                            label: 'rescisoes Realizadas no período',
                                            backgroundColor: 'rgb(255, 153, 102)',
                                            borderColor: 'rgb(229, 0, 0)',
                                            data:quant
                                        }
                                    ]
                                },
                                options:{}
                            }
                    );

                }
            }
        )
        if (typeof(chartrescisoes) !== "undefined")
            chartrescisoes.destroy();
    }

    
    
    function concentracaoReceb()
    {

        
        var url = "{{route( 'estatisticas.concentracaorecebimentos')}}";

        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function( data )
                {

                    Dia = data.map( function(eLem )
                    {
                        return eLem.Dia;

                    })

                    
                    quant = data.map( function(eLem )
                    {
                        return eLem.count;

                    })

                    chartconcrec = new Chart
                    (
                            document.getElementById('concentracaoreceb'),
                            {
                                type: 'pie',
                                data: 
                                {   labels: Dia,
                                    datasets: [
                                        {
                                            label: 'Concentração de Recebimentos',
                                            backgroundColor: 
                                            [
                                                'rgb(255,182,193)',
                                                'rgb(250,235,215)',
                                                'rgb(245,245,220)',
                                                'rgb(255,228,196)',
                                                'rgb(255,235,205)',
                                                'rgb(245,222,179)',
                                                'rgb(255,248,220)',
                                                'rgb(255,250,205)',
                                                'rgb(250,250,210)',
                                                'rgb(255,255,224)',
                                                'rgb(222,184,135)',
                                                'rgb(210,180,140)',
                                                'rgb(188,143,143)',
                                                'rgb(255,228,181)',
                                                'rgb(255,240,245)',
                                                'rgb(176,196,222)',
                                                'rgb(240,255,240)',
                                                'rgb(192,192,192)',
                                                'rgb(220,220,220)',
                                                'rgb(245,245,245)'
                                            ],
                                            borderColor: 'rgb(25,25,112)',
                                            data:quant
                                        }
                                    ]
                                },
                                options:{}
                            }
                    );

                }
            }
        )
        if (typeof(chartconcrec) !== "undefined")
            chartconcrec.destroy();
    }

    
    function estatisticaTaxaAdm()
    {

        
        var url = "{{route( 'estatisticas.taxaadm')}}";

        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function( data )
                {

                    console.log( data );
                    taxas = data.map( function(eLem )
                    {
                        return eLem.Percentual;

                    })

                    
                    quant = data.map( function(eLem )
                    {
                        return eLem.count;

                    })

                    chartta = new Chart
                    (
                            document.getElementById('contratosativos'),
                            {
                                type: 'pie',
                                data: 
                                {   labels: taxas,
                                    datasets: [
                                        {
                                            label: 'Posição da Carteira ',
                                            backgroundColor: 
                                            [
                                                'rgb(0, 204, 255)',
                                                'rgb(51, 214, 255)',
                                                'rgb(0, 163, 204)',
                                                'rgb(214, 245, 214)',
                                                'rgb(111, 220, 111)',
                                                'rgb(0, 204, 102)',
                                                'rgb(255, 204, 102)',
                                                'rgb(255, 179, 26)',
                                                'rgb(255, 204, 204)',
                                                'rgb(204, 204, 255)',

                                            ],
                                            borderColor: 'rgb(25,25,112)',
                                            data:quant
                                        }
                                    ]
                                },
                                options:{}
                            }
                    );

                }
            }
        )
        if (typeof(chartta) !== "undefined")
            chartta.destroy();
    }

    
    function inadimplencia()
    {

        debugger;
        var url = "{{route( 'estatisticas.inadimplencia')}}";

        $.getJSON( url, function( data)
        {
                    console.log( data );

                    Dias = data.map( function(eLem )
                        {
                        return eLem.Dias;
                        

                    })

                    
                    quant = data.map( function(eLem )
                    {
                        return eLem.count;

                    })

                    chart = new Chart
                    (
                            document.getElementById('inadimplencia'),
                            {
                                type: 'pie',
                                data: 
                                {   labels: Dias,
                                    datasets: [
                                        {
                                            label: 'Inadimplência ',
                                            backgroundColor: 
                                            [
                                                'rgb(255, 255, 204)',
                                                'rgb(255, 212, 128)',
                                                'rgb(255, 163, 102)',
                                                'rgb(255, 102, 0)',
                                                'rgb(255, 112, 77)',
                                                'rgb(255, 71, 26)',
                                                'rgb(179, 0, 0)',
                                                

                                            ],
                                            borderColor: 'rgb(25,25,112)',
                                            data:quant
                                        }
                                    ]
                                },
                                options:{}
                            },
                            
                    );

          
            }
        )
        if (typeof(chart) !== "undefined")
            chart.destroy();
    }
    

    
    function faixaValores()
    {

        
        var url = "{{route( 'estatisticas.faixadevaloraluguel')}}";

        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function( data )
                {

                    Valor = data.map( function(eLem )
                    {
                        return eLem.Valor;

                    })

                    
                    quant = data.map( function(eLem )
                    {
                        return eLem.count;

                    })

                    chartfp = new Chart
                    (
                            document.getElementById('faixavalores'),
                            {
                                type: 'pie',
                                data: 
                                {   labels: Valor,
                                    datasets: [
                                        {
                                            label: 'Faixa de Valores de Aluguéres ',
                                            backgroundColor: 
                                            [
                                                'rgb(255, 255, 204)',
                                                'rgb(255, 212, 128)',
                                                'rgb(255, 163, 102)',
                                                'rgb(255, 102, 0)',
                                                'rgb(255, 112, 77)',
                                                'rgb(255, 71, 26)',
                                                'rgb(179, 0, 0)',
                                                

                                            ],
                                            borderColor: 'rgb(25,25,112)',
                                            data:quant
                                        }
                                    ]
                                },
                                options:{}
                            }
                    );

                }
            }
        )
        if (typeof(chartfp !== "undefined"))
            chartfp.destroy();
    }

    

    function calcularEstat()
    {
        estatisticaLocacoesRealizadas( $("#i-meses").val());
        estatisticaRescisoesRealizadas( $("#i-meses").val());
        estatisticaTaxaAdm()
        inadimplencia();
        faixaValores();
    }
    
    


</script>

@endpush