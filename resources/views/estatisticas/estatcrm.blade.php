@extends('layout.app')
@section('scripttop')
<style>

.pyramid {
  width: 220px;
  display: flex;
  flex-direction: column;
  height: 198px;
  -webkit-clip-path: polygon(50% 0, 100% 100%, 0 100%);
  clip-path: polygon(50% 0, 100% 100%, 0 100%);
}

.for{
	position: relative;
	right: 0px;
    top: 25px;
	font-size: 12px;
	line-height: 12px;
	color: black;
	padding: 0 55px;
	text-align: center;
	z-index: 9;
	-webkit-transform: rotate(-25deg);
	-moz-transform: rotate(-25deg);
	-ms-transform: rotate(-25deg);
	-o-transform: rotate(-25deg);
	transform: rotate(-25deg);
	-webkit-transition: all 300ms ease;
	-moz-transition: all 300ms ease;
	-ms-transition: all 300ms ease;
	-o-transition: all 300ms ease;
	transition : all 300ms ease;
    font-weight: bold;

}


.pyramid__section {
  flex: 1 1 100%;
  background-color: green;
  margin-bottom: 2px;
  vertical-align:bottom;
  text-align:bottom;
}

.position-bot
{
    position:absolute;
    bottom:0;
}

.pyramid__section:hover {
  background-color: yellow;
}

.bottom
{
    text-align:bottom;
}


.font-10
{
    font-size: 10px;
}

.font-12-bold
{
    font-size: 12px;
    font-weight: bold;

}
.red
{
	background-color: red;
}
.green
{
	background-color:greenyellow;
}
.orange
{
	background-color: orange;
}

.gray
{
	background-color: gainsboro;
}

.dashed{
    text-decoration: overline underline line-through;
    color:#999;
}
.td-rigth
  {
    text-align:right;
  }

  .div-center
  {
    text-align:center;
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

td {
  font-size: 7px;
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

.font-8
{
    font-size:8px;
}

.cor-ate-15dias
{
    color:black;
    background-color: rgb(173, 235, 173); 
}
.cor-ate-30dias
{
    color:black;
    background-color: rgb(255, 204, 102); 
}
.cor-ate-60dias
{
    color:black;
    background-color: rgb(255, 153, 51); 
}

.cor-acima-60dias
{
    color:black;
    background-color: rgb(255, 102, 102); 
}


</style>

@endsection

@section('content')

 <!-- <div style="width: 500px;"><canvas id="dimensions"></canvas></div><br/> -->
 <div class="row">
        
    <div class="col-md-12 ">
        <div class="col-md-12 groove">
        <div class="col-md-4">
            <div class="portlet box blue altura-portlet">
                <div class="portlet-title">
                    <div class="caption color-white">
                        <span class="caption-subject bold uppercase">Atendimentos Ativos</span>
                            <i class="fa fa-search font-blue"></i>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                    </div>

                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-md-3">
                        <div class="row">
                                <p></p>
                            </div>
                            <div class="row">
                                <p></p>
                            </div>
                            <table  id="tblatm" class="table" >
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-9">
                        <div style="width: 100%px;"><canvas id="atendimentosativos"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="portlet box blue altura-portlet">
                <div class="portlet-title">
                    <div class="caption color-white">
                        <span class="caption-subject bold uppercase">Bairros mais procurados</span>
                            <i class="fa fa-search font-blue"></i>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                    </div>

                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-md-12">
                        <div style="width: 100%px;"><canvas id="bairrosvendas"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption color-white">
                        <span class="caption-subject bold uppercase">Midias de Origem</span>
                            <i class="fa fa-search font-blue"></i>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                    </div>

                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-md-12">
                        <div style="width: 100%px;"><canvas id="midiasorigem"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="col-md-12">
        <div class="col-md-12 groove">
            <div class="portlet box blue altura-portlet">
                <div class="portlet-title">
                    <div class="caption color-white">
                        <span class="caption-subject bold uppercase">Escalada do Sucesso</span>
                            <i class="fa fa-search font-blue"></i>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="col-md-12"></div>
                    <div class="col-md-12"></div>
                    <div class="col-md-12"></div>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption color-white">
                                        <span class="caption-subject bold uppercase">Escalada do Sucesso de Vendas</span>
                                                <i class="fa fa-search font-blue"></i>
                                    </div>
                                    <div class="tools">
                                            <a href="javascript:;" class="collapse"></a>
                                    </div>

                                </div>
                                <div class="portlet-body form">
                                    <div class="row  div-center">
                                        <div class="col-md-12 div-center">
                                            <div class="col-md-4 ">
                                                <div class="row">
                                                        <p></p>
                                                </div>

                                                <div class="pyramid div-center">
                                                    <div class="pyramid__section green" id="i-altaven">
                                                        <label class="font-12-bold for"> 
                                                            <a title="Estes são os atendimentos que estão com ALTA possibilidade de negócio"  href="javascript:cargaDetalhe()">4</a>
                                                        </label>
                                                    </div>
                                                    <div class="pyramid__section orange" id="i-mediaven">
                                                        <label class="font-12-bold for"> 
                                                            <a title="Estes são os atendimentos que estão com MÉDIA possibilidade de negócio"  href="javascript:cargaDetalhe()">15</a>
                                                        </label>
                                                    </div>
                                                    <div class="pyramid__section red" id="i-baixaven">
                                                         <label class="font-12-bold for"> 
                                                            <a title="Estes são os atendimentos que estão com BAIXA possibilidade de negócio"  href="javascript:cargaDetalhe()">32</a>
                                                        </label>
                                                    </div>
                                                    <div class="pyramid__section gray" id="i-atmsven">
                                                     <label class="font-12-bold for"> 
                                                            <a title="Estes são os atendimentos realizados para venda"  href="javascript:cargaDetalhe()">51</a>
                                                        </label>

                                                    </div>
                                                </div>
                                            </div>                                
                                            <div class="col-md-8 div-center">
                                                <div class="row"><p></p></div>
                                                A Escalada do Sucesso foi idealizada para que você possa ver com mais exatidão os atendimentos
                                                    que mais necessitam de um carinho especial. Essa pirâmide é abastecida com as informações 
                                                    do retorno do cliente na visita ao imóvel, onde o atendente informa a perspectiva de fechar o negócio
                                                    com Baixa, Média ou Alta. 
                                                    No topo da pirâmide estão todos os atendimentos que
                                                    estão com espectativa alta de negócio! Comece investindo neste atendimento.

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption color-white">
                                        <span class="caption-subject bold uppercase"> Escalada do Sucesso Locação</span>
                                                <i class="fa fa-search font-blue"></i>
                                    </div>
                                    <div class="tools">
                                            <a href="javascript:;" class="collapse"></a>
                                    </div>

                                </div>
                                <div class="portlet-body form">
                                    <div class="row  div-center">
                                        <div class="col-md-12 div-center">
                                            <div class="col-md-4 ">
                                                <div class="row">
                                                        <p></p>
                                                </div>

                                                <div class="pyramid div-center">
                                                    <div class="pyramid__section green" id="i-altaloc">
                                                        <label class="font-12-bold for"> 
                                                            <a title="Estes são os atendimentos que estão com ALTA possibilidade de negócio" href="javascript:cargaDetalhe()">10</a>
                                                        </label>
                                                    </div>
                                                    <div class="pyramid__section orange" id="i-medialoc">
                                                        <label class="font-12-bold for"> 
                                                            <a title="Estes são os atendimentos que estão com MÉDIA possibilidade de negócio"  href="javascript:cargaDetalhe()">30</a>
                                                        </label>
                                                    </div>
                                                    <div class="pyramid__section red" id="i-baixaloc">
                                                    <label class="font-12-bold for"> 
                                                            <a title="Estes são os atendimentos que estão com BAIXA possibilidade de negócio"  href="javascript:cargaDetalhe()">65</a>
                                                        </label>
                                                    </div>
                                                    <div class="pyramid__section gray" id="i-atmsloc">
                                                    <label class="font-12-bold for"> 
                                                            <a title="Estes foram seus atendimentos para locação"  href="javascript:cargaDetalhe()">105</a>
                                                        </label>

                                                    </div>
                                                </div>
                                            </div>                                
                                            <div class="col-md-8 div-center">
                                                <div class="row"><p></p></div>
                                                A Escalada do Sucesso foi idealizada para que você possa ver com mais exatidão os atendimentos
                                                    que mais necessitam de um carinho especial. Essa pirâmide é abastecida com as informações 
                                                    do retorno do cliente na visita ao imóvel, onde o atendente informa a perspectiva de fechar o negócio
                                                    com Baixa, Média ou Alta. 
                                                    No topo da pirâmide estão todos os atendimentos que
                                                    estão com espectativa alta de negócio! Comece investindo neste atendimento.

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

        calcularEstat();
        midiasRetorno();
        

    });    

    function atmAtivos()
    {

        
        var url = "{{route( 'estatisticas.atmativos')}}";

        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function( data )
                {

                    Dias = data.map( function(eLem )
                    {
                        return eLem.Dias;

                    })

                    
                    quant = data.map( function(eLem )
                    {
                        return eLem.count;

                    })

                    chartfp = new Chart
                    (
                            document.getElementById('atendimentosativos'),
                            {
                                type: 'pie',
                                data: 
                                {   labels: Dias,
                                    datasets: [
                                        {
                                            label: 'Dias Atendimento ',
                                            backgroundColor: 
                                            [
                                                'rgb(173, 235, 173)',
                                                'rgb(255, 204, 102)',
                                                'rgb(255, 153, 51)',
                                                'rgb(255, 102, 102)',
                                                

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
        if (typeof(chartfp) !== "undefined")
            chartfp.destroy();
    }

    function bairrosProcurados()
    {

        
        var url = "{{route( 'estatisticas.atmativos')}}";

        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function( data )
                {

                    Dias = data.map( function(eLem )
                    {
                        return eLem.Dias;

                    })

                    
                    quant = data.map( function(eLem )
                    {
                        return eLem.count;

                    })

                    chartbairros = new Chart
                    (
                            document.getElementById('bairrosvendas'),
                            {
                                type: 'bar',
                                data: 
                                {   labels: ['Estoril','Casa Branca','Marambá', 'Bela Vista', 'Vista Alegre', 'Demais'],
                                    datasets: [
                                        {
                                            label: 'Bairros mais procurados ',
                                            backgroundColor: 
                                            [
                                                'rgb(173, 235, 173)',
                                                'rgb(255, 204, 102)',
                                                'rgb(255, 153, 51)',
                                                'rgb(255, 102, 102)',
                                                

                                            ],
                                            borderColor: 'rgb(25,25,112)',
                                            data:[ 25, 22,20,18,10,200]
                                        }
                                    ]
                                },
                                options:{}
                            }
                    );

                }
            }
        )
        if (typeof(chartbairros) !== "undefined")
            chartbairros.destroy();
    }


    function midiasRetorno()
    {

        
        var url = "{{route( 'estatisticas.atmativos')}}";

        $.ajax(
            {
                url:url,
                dataType:'json',
                type:'get',
                success:function( data )
                {

                    Dias = data.map( function(eLem )
                    {
                        return eLem.Dias;

                    })

                    
                    quant = data.map( function(eLem )
                    {
                        return eLem.count;

                    })

                    chartmidia = new Chart
                    (
                            document.getElementById('midiasorigem'),
                            {
                                type: 'bar',
                                data: 
                                {   labels: ['Site Imobiliária','Olx','Zap', 'Facebook', 'Google', 'Instagram','Demais'],
                                    datasets: [
                                        {
                                            label: 'Origem dos Leads ',
                                            backgroundColor: 
                                            [
                                                'rgb(0,0,255)',
                                                'rgb(0,255,255)',
                                                'rgb(255,0,255)',
                                                'rgb(255,255,0)',
                                                'rgb(0,255,0)',
                                                'rgb(205,92,92)',
                                                'rgb(128,128,128)',
                                            ],
                                            borderColor: 'rgb(25,25,112)',
                                            data:[ 129, 190,185,25,42,21,15]
                                        }
                                    ]
                                },
                                options:{}
                            }
                    );

                }
            }
        )
        if (typeof(chartmidia) !== "undefined")
            chartmidia.destroy();
    }

    
    function cargaAtms()
    {
        var url = "{{ route('estatisticas.atmativos')}}";
        $.getJSON( url, function( data)
        {
            linha = "";
            $("#tblatm>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                classe="";
                if( data[nI].Dias == 'Até 15 dias')
                    classe = 'cor-ate-15dias';
                if( data[nI].Dias == 'Até 30 dias')
                    classe = 'cor-ate-30dias';
                if( data[nI].Dias == 'Até 60 dias')
                    classe = 'cor-ate-60dias';
                if( data[nI].Dias == 'Acima de 60 dias')
                    classe = 'cor-acima-60dias';


              linha =
                    '<tr>'+
                    '   <td class="'+classe+'"><a title="Click aqui para visualizar os atendimentos" href="javascript:verAtms('+data[nI].Dias+')">'+data[nI].Dias+'</td>'+
                    '</tr>';
              $("#tblatm").append( linha );
            }
        });
    }

    function calcularEstat()
    {
        atmAtivos();
        cargaAtms();
        bairrosProcurados();
        midiasRetorno();

        
    }

    function cargaDetalhe()
    {
        alert('Você não tem permissão pra ver o detalhe');

    }
    
    


</script>

@endpush