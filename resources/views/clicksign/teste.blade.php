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
    <div class="col-md-6 groove ">
        <div style="width: 100%px;"><canvas id="locacoesrealizadas"></canvas></div>
        </div>
        <div class="col-md-6 groove ">
        <div style="width: 100%px;"><canvas id="rescisoesrealizadas"></canvas></div>
        </div>

    </div>
    <div class="col-md-12">
    <div class="col-md-6 groove ">
        <h4 class="div-center">Sua carteira possui {{app('App\Http\Controllers\ctrEstatisticas')->contratosAtivosTotal()}} contratos ativos neste momento</h4>
        <div style="width: 100%px;"><canvas id="contratosativos"></canvas></div>
        </div>
        <div class="col-md-6 groove ">
        <div style="width: 100%px;"><canvas id="rescisoesrealizadas"></canvas></div>
        </div>

    </div>

 </div>
 
    
@endsection


@push('script')
<script type="text/javascript" src="{{asset('/js/Chart.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"></script>
    
<script>
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

                    chart = new Chart
                    (
                            document.getElementById('locacoesrealizadas'),
                            {
                                type: 'bar',
                                data: 
                                {   labels: meses,
                                    datasets: [
                                        {
                                            label: 'Locações Realizadas no mês ',
                                            backgroundColor: 'rgb(25,25,112)',
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
        if (typeof(chart) !== "undefined")
            chart.destroy();
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

                    

                    chart = new Chart
                    (
                            document.getElementById('rescisoesrealizadas'),
                            {
                                type: 'bar',
                                data: 
                                {   labels: meses,
                                    datasets: [
                                        {
                                            label: 'rescisoes Realizadas no mês ',
                                            backgroundColor: 'rgb(229, 0, 0)',
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
        if (typeof(chart) !== "undefined")
            chart.destroy();
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

                    chart = new Chart
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
                                                'rgb(255, 0, 0)',
                                                'rgb(255, 153, 102)',
                                                'rgb(102, 0, 255)',
                                                'rgb(51, 204, 51)',
                                                'rgb(31, 122, 31)',
                                                'rgb(16, 61, 16)',
                                                'rgb(204, 153, 0)',
                                                'rgb(255, 153, 255)',

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
        if (typeof(chart) !== "undefined")
            chart.destroy();
    }


    function calcularEstat()
    {
        estatisticaLocacoesRealizadas( $("#i-meses").val());
        estatisticaRescisoesRealizadas( $("#i-meses").val());
        estatisticaTaxaAdm()
    }
    
    estatisticaLocacoesRealizadas(6);
    estatisticaRescisoesRealizadas(6);
    estatisticaTaxaAdm();
</script>

@endpush