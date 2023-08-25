@section( 'scripttop')
<style>
    

    .overlay {
    height: 100%;
    width: 100%;
    position: absolute;
    top: 0px;
    left: 0px;
    z-index: 99999;
    background-color: gray;
    filter: alpha(opacity=75);
    -moz-opacity: 0.75;
    opacity: 0.75;
    display: none;
}
.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
  background-color: yellow;
}
.multiselect {
  width: 200px;
}

.selectBox {
  position: relative;
}


.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}



table.dataTable tbody th, table.dataTable tbody td {
    height: 20px; /* e.g. change 8x to 4px here */
}

th, td{
    vertical-align: middle !important; /* alinha verticalmente */
    height: 30px; /* altura customizada da celula */
    padding: 0 16px !important; /* 0 de padding na vertical e 16px na horizontal */
}


.div-center
{
  text-align:center;
  font-size: 12px;

}

.div-left
{
  text-align:left;

}

        .profile img{
            width: 90%;
            height: 90%;                

        }.div-fundo-vermelho
{
    background-color: red;
    color:white;
    text-align:center;

}

.circulo-ativo {
    border-radius: 50%;
    display: inline-block;
    height: 20px;
    width: 20px;
    border: 1px solid #000000;
    background-color: green;
}  

.circulo-inativo {
    border-radius: 50%;
    display: inline-block;
    height: 20px;
    width: 20px;
    border: 1px solid #000000;
    background-color: red;
}  

.lbl-medidas {
  text-align: center;
  font-size: 14px;
  
}
.lbl-medidas-left {
  text-align: left;
  font-size: 14px;
  
}
.lbl-medidas-valores {
  text-align: center;
  font-size: 14px;
  font-weight: bold;
  color: #4682B4; 
}

.div-border-blue-center{
    border:solid 1px #4682B4;
    text-align: center;
}
.lbl-medidas-outrositens {
  text-align: left;
  font-size: 12px;
  color: #4682B4; 
}

.cardtitulo {
  text-align: left;
  font-size: 16px;
  color: #4682B4; 
  font-weight: bold;

}
.cardtitulo-center {
  text-align: center;
  font-size: 16px;
  color: #4682B4; 
  font-weight: bold;

}

.info {
  text-align: left;
  font-size: 14px;
  color: #4682B4; 
  font-weight: bold;

}

.lbl-medidas-left {
  text-align: left;
  font-size: 16px;
  font-weight: bold;

}

hr {
    height: 2px;
}

div .half-size-line
{
    line-height: 92%;
}

H-LEFT {
    text-align: left;
    color: #4682B4 ; 
    font-size: 16px;
    font-weight: bold;

}


h5 {
    text-align: center;
}

H5 {
    text-align: center;
    color: #4682B4 ; 
    font-size: 20px;
    font-weight: bold;

}

h4 {
  text-align: center;
}

h4-center-17 {
  text-align: center;
  font-size: 17px;
}

@media screen {
  #printSection {
      display: none;
      font-weight: bold;
  }
}

TH {
    text-align: center;
    width: 120px;
}
@media print {
  body * {
    visibility:hidden;
  }
  #printSection, #printSection * {
    visibility:visible;
  }
  #printSection {
    position:absolute;
    left:0;
    top:0;
  }
}

.escondido {
  display: none;
}

</style>
@endsection


<div class="modal fade" id="modalpesquisarimovel" tabindex="-1" role="dialog" >
    <div class="modal-dialog "style="width:90%;" >
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-blue">
                            <span class="caption-subject bold uppercase"> Pesquisar Lista</span>
                            <i class="fa fa-search font-blue"></i>
                        </div>
                        <div>
                            <button class="btn btn-danger pull-right" type="button" id="btn-limpar"
                            onClick="limparCampos()">Limpar Filtro</button>
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <form role="form" id="search-form">
                            <!--<form role="form" action="{{ route('imovel.list')}}" method="get">-->
                            <div class="form-body">
                                <input type="hidden" id="IMB_IMB_IDMASTER" name="empresamaster" value="{{ Auth::User()->IMB_IMB_ID }}"> 
                                <input type="hidden" id="i-unidade" name="agencia"> 
                                <input type="hidden" id="i-tipo" name="tipoimovel"> 
                                <input type="hidden" id="i-finalidade" name="finalidade"> 
                                <input type="hidden" id="i-corretor" name="corretor"> 
                                <input type="hidden" id="i-captador" name="captador"> 
                                <input type="hidden" id="i-cadastradopor" name="cadastradopor"> 
                                <input type="hidden" id="i-status" name="status"> 
                                <input type="hidden" id="i-bairro" name="bairro"> 
                                <input type="hidden" id="i-condominio"  name="condominio">               
                                <input type="hidden" id="i-imagemprincipal" name="imagemprincipal"> 
                                <input type="hidden" id="i-usuario" value="{{Auth::user()->email}}"> 
                                <input type="hidden" id="i-idusuario" value="{{Auth::user()->IMB_ATD_ID}}"> 

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="js-select-unidade" class="control-label">Unidade</label>
                                            <select class="form-control" id="js-select-unidade">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="referencia" class="control-label">Referencia</label>
                                            <input type="text" class="form-control" name="referencia" value="{{session()->pull('imovelpesquisa')}}"
                                            placeholder="Ex.: CA0003" id="i-referencia">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="id_completus">Cód Interno</label>
                                            <input type="text" class="form-control" name="id_completus" id="i-idcompletus">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Selecione o Tipo
                                                <select id="i-select-tipo" multiple class="form-control multiplos-select" placeholder="Pesquise" >
                                                    @php
                                                        $tipos = app('App\Http\Controllers\ctrTipoImovel')->carga();
                                                    @endphp
                                                    @foreach( $tipos as $tipo)
                                                        <option value="{{$tipo->IMB_TIM_ID}}">{{$tipo->IMB_TIM_DESCRICAO}}</option>
                                                    @endforeach
                                                </select>                        
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label  class="control-label">Finalidade</label>
                                            <select class="form-control" id='i-select-finalidade-cliente'>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label" for="faixainicial">Faixa de </label>
                                            <input type="text" class="form-control" name="faixainicial"
                                            placeholder="De R$" id="i-faixainicial" 
                                            onkeypress="return isNumber(event)" onpaste="return false;">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label" for="faixafinal">Até</label>
                                            <input type="text" class="form-control" name="faixafinal" 
                                            placeholder="De R$" id="i-faixafinal" 
                                            onkeypress="return isNumber(event)" onpaste="return false;">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="endereco">Endereco</label>
                                            <input type="text" class="form-control" name="endereco" 
                                            placeholder="Sugestão: coloque parte do endereço" id="i-endereco">
                                        </div>
                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label class="control-label">Selecione o Condomínio

                                                <select id="i-select-condominio" multiple class="form-control multiplos-select" placeholder="Pesquise" >
                                                    @php
                                                        $condominios = app('App\Http\Controllers\ctrRotinas')->condominiosSistemaCarga();
                                                    @endphp
                                                    @foreach( $condominios as $condominio)
                                                        <option value="{{$condominio->IMB_CND_ID}}">{{$condominio->IMB_CND_NOME}}</option>
                                                    @endforeach
                                                </select>                        
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="cidade">Cidade</label>
                                            <input type="text" class="form-control"
                                            name="cidade" id="i-cidade" placeholder="Sugestão: parte do nome">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Selecione o Bairro

                                                @php
                                                    $bairros = app('App\Http\Controllers\ctrRotinas')->bairrosSistemaCarga();
                                                @endphp
                                            <select id="i-select-bairro" multiple class="form-control " placeholder="Pesquise" >
                                                @foreach( $bairros as $bairro)
                                                <option value="{{$bairro->CEP_BAI_NOME}}">{{$bairro->CEP_BAI_NOME}}({{$bairro->IMB_IMV_CIDADE}})</option>
                                                @endforeach
                                            </select>                        
                                            </label>
                                        </div>
                                    </div>
                            
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="control-label" for="dormitorio">Dorm.</label>
                                            <input type="number" class="form-control" name="dormitorio" min="0"
                                            id="i-dormitorio">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="control-label" for="suite">Suítes</label>
                                            <input type="number" class="form-control" mon="0"
                                            id="i-suite" name="suite" >
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Status
                                            @php
                                               $status = app('App\Http\Controllers\ctrRotinas')->statusImoveisCarga();
                                            @endphp

                                                <select id="i-select-status" multiple class="form-control multiplos-select" placeholder="Pesquise" >
                                                    @foreach( $status as $statu)
                                                        <option value="{{$statu->VIS_STA_ID}}">{{$statu->VIS_STA_NOME}}</option>
                                                    @endforeach
                                                </select>                        
                                            </label>
                                        </div>
                                    </div>
                            
                                    <div class="col-md-1">
                                        <div class="form-actions noborder">
                                            <button class="btn blue pull-right" id='search-form'>Pesquisar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--<hr style="margin-top: 40px;" />-->
                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>
                    </div>

                    <table id="resultadopesquisa" style="width:100%" class="cell-border compact stripe">
                        <thead>
                            <th ></th>
                            <th ></th>
                            <th >Referência</th>
                            <th >Tipo</th>
                            <th >Endereço</th>
                            <th >Bairro</th>
                            <th >Edif./Condom.</th>
                            <th >Cidade</th>
                            <th >Venda</th>
                            <th >Locação</th>
                            <th >Cadastro</th>
                            <th >Atualizado</th>
                        </thead>
                    </table>            
                </div>
            </div>
        </div>
    </div>  
</div>

@include( 'layout.modaldadosimovel')

@push('script')

<script>

    var rows_selected = [];
    var table = $('#resultadopesquisa').DataTable(
    {
        "pageLength": 10,
        "lengthChange": true,
        "language": 
        {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            sLoadingRecords: '<div class="overlay"><img src="{{asset('/layouts/layout/img/loader.gif')}}"/></div>',
            sProcessing: '<div class="overlay"><img src="{{asset('/layouts/layout/img/loader.gif')}}"/></div>',
            "sZeroRecords": "Nenhum registro encontrado",
            "scrollY": "300px",
            "oPaginate": 
            {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            }
        },
        processing: true,
        serverSide: true,
        bSort : false ,
        ajax: 
        { 
            url:"{{ route('imovel.list') }}",
            data: function (d) 
            {
                d.id_completus  = $('input[name=id_completus]').val();
                d.referencia    = $('input[name=referencia]').val();
                d.endereco      = $('input[name=endereco]').val();
                d.bairro        = $('input[name=bairro]').val();
                d.cidade        = $('input[name=cidade]').val();
                d.dormitorio    = $('input[name=dormitorio]').val();
                d.suite         = $('input[name=suite]').val();
                d.agencia       = $('input[name=agencia]').val();
                d.tipoimovel    = $('input[name=tipoimovel]').val();
                d.finalidade    = $('input[name=finalidade]').val();
                d.faixainicial  = $('input[name=faixainicial]').val();
                d.faixafinal    = $('input[name=faixafinal]').val();
                d.condominio    = $('input[name=condominio]').val();
                d.proprietario  = $('input[name=proprietario]').val();
                d.empresamaster = $('input[name=empresamaster]').val();
                d.status        = $('input[name=status]').val();
                
                d.radar         = $('input[name=radar]').prop('checked') ? 'S' : 'N';
            }
        },
        columns: 
        [
            {
                "targets": 0,
                "data": null,
                "defaultContent": "<div style='text-align:center'>"+
                "<button class='btn glyphicon glyphicon-ok btn btn-primary pull-right select-imv'></button></div>"
            },
            {
                "targets": 1,
                "data": null,
                "defaultContent": "<div style='text-align:center'>"+
                "<button class='btn green-meadow glyphicon glyphicon-search pull-right show-imv'></button></div>"
            },
            { "data" : 'IMB_IMV_REFERE'},
            { "data" : 'IMB_TIM_DESCRICAO'},
            { "data" : 'ENDERECOCOMPLETO'},
            { "data" : 'CEP_BAI_NOME'},
            { "data" : 'CONDOMINIO'},
            { "data" : 'IMB_IMV_CIDADE'},
            { "data" : 'IMB_IMV_VALVEN',render:formatarValVen},
            { "data" : 'IMB_IMV_VALLOC', render:formatarValLoc},
            { "data" : 'IMB_IMV_DATACADASTRO', render : formatardatacadastro},
            { "data" : 'IMB_IMV_DATAATUALIZACAO', render : formataratualizacao},
        ],
        "aoColumnDefs":[
                { className: "text-right", "targets": [8,9] },
                { className: "text-center", "targets": [2,3,7] },

        ],
        searching: false
    });

        $('#search-form').click( function()
        {
            var bairro =  $('#i-select-bairro').val()+'' ;
            var condominio =  $('#i-select-condominio').val()+'' ;
            var tipo =  $('#i-select-tipo').val()+'' ;
            var status =  $('#i-select-status').val()+'' ;
            


            if ( bairro != '' )
                bairro = bairro.split( ',')
            
            $("#i-bairro").val( bairro );
            
            if ( condominio != '' )
                condominio = condominio.split( ',')

            $("#i-condominio").val( condominio );

            if ( tipo != '' )
                tipo = tipo.split( ',')
            
            $("#i-tipo").val( tipo );

            if ( status != '' )
            status = status.split( ',')
            
            $("#i-status").val( status );

        })

        $('#search-form').on('submit', function(e) {

            var ref = $("#i-referencia").val();
            ref = ref.replace( '-','');
            $("#i-referencia").val( ref );

            table.clear();
            table.draw();
            e.preventDefault();
        });

/*           
        $('#resultTable tbody').on( 'click', '.i-btn-alugar', function () {
            var data = table.row( $(this).parents('tr') ).data();
                $("#idimovelcontrato").val( data.IMB_IMV_ID );
                $("#form-novocontrato").submit();
        });
*/
        $('#resultadopesquisa tbody').on( 'click', '.show-imv', function () {
            var data = table.row( $(this).parents('tr') ).data();
            mostrarImovelModal( data.IMB_IMV_ID );
           
        });

        $('#resultadopesquisa tbody').on( 'click', '.select-imv', function () {
            var data = table.row( $(this).parents('tr') ).data();
            selecionarImovel( data.IMB_IMV_REFERE );
           
        });

        
    
            


            $('#i-maisfiltros').on( 'click', function () {
                $('#i-maisfiltros').show();
            });


   
        function formatarValVen(data, type, full, meta) 
        {
            var valorvenda = parseFloat(full.IMB_IMV_VALVEN);
            valorvenda = formatarBRSemSimbolo(valorvenda);
            //alert( "do banco: "+full.IMB_CLT_DATACADASTRO+' - tratado '+datacad );
            return '<div class="div-right"><b>'+valorvenda+'</b></div>';

        }

        function formatarValLoc(data, type, full, meta) 
        {
            var valorlocacao = parseFloat(full.IMB_IMV_VALLOC);
            valorlocacao = formatarBRSemSimbolo(valorlocacao);
            //alert( "do banco: "+full.IMB_CLT_DATACADASTRO+' - tratado '+datacad );
            return '<div class="div-right"><b>'+valorlocacao+'</b></div>';

        }

        function formataratualizacao(data, type, full, meta) 
        {
            var dataat = full.IMB_IMV_DATAATUALIZACAO;
            dataat = moment(dataat).format('DD/MM/YYYY');
            return dataat;

        }
        function formatardatacadastro(data, type, full, meta) 
        {
            var dataat = full.IMB_IMV_DATACADASTRO;
            dataat = moment(dataat).format('DD/MM/YYYY');
            return dataat;

        }

        function CarregarPropImo( id )
    {
        var url = "{{ route('propimo.carga') }}/"+id;
        $.getJSON( url, function( data)
        {
            linha = "";
            $("#tbpropimo>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                linha = 
                    '<tr>'+
                    '   <td style="text-align:center">'+data[nI].IMB_CLT_NOME+'</td>'+
                    '   <td style="text-align:center">'+data[nI].principal+'</td>'+
                    '   <td style="text-align:center">'+data[nI].FONES+'</td>'+
                    '   <td style="text-align:center">'+data[nI].IMB_CLT_EMAIL+'</td>'+
                    '</tr>';
                $("#tbpropimo").append( linha );
                        
            }
        });
    }

    function preencherStatusTroca()
        {
            var url = "{{ route('statusimovel.carga')}}/0";

            console.log('urk '+url);
            $.getJSON( url, function( data )
            {
                $("#i-statustrocar").empty();
                linha = '<option value="0"></option>';
                $("#i-statustrocar").append( linha );
                for( nI=0;nI < data.length;nI++)
                {
                    linha = 
                    '<option value="'+data[nI].VIS_STA_ID+'">'+
                        data[nI].VIS_STA_NOME+"</option>";
                        $("#i-statustrocar").append( linha );
                }

            });
            
        }

        function CarregarImagens()
    {
        str = $("#i-imovel").val();
        $.getJSON( "{{ route( 'imagens.imoveis')}}/"+str, function( data)
        {
            linha = "";
            $("#tblimagens>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                var nome = data[nI].IMB_IMG_NOME;
                if( nome == null)
                    nome = "";
    
                    var detalhes ='<ul class="display:inline">';

                var capa= data[nI].IMB_IMG_CAPA;
                if( capa == 'S')
                    detalhes = detalhes +'<li>Capa</li>';

                var principal= data[nI].IMB_IMG_CAPA;
                if( principal == 'S')
                detalhes = detalhes +'<li>Imagem Principal</li>';

                var naoirprosite= data[nI].IMB_IMG_NAOIRPROSITE;
                if( naoirprosite == 'S')
                    detalhes = detalhes +'<li>Não ir pro Site</li>';
                    naoirprosite = 'Fora do Site';

                detalhes = detalhes +'</ul>';

                var idimg = data[nI].IMB_IMG_ID;
                var imimg = data[nI].IMB_IMV_ID;
                var arquivo = data[nI].IMB_IMG_ARQUIVO

                linha = 
                        '<tr>'+
                        '<td align="left"><a href=javascript:mostrarImagem('+idimg+') ><img src="{{url('')}}/storage/images/'+$("#I-IMB_IMB_IDMASTER").val()+'/imoveis/thumb/'+imimg+'/100_75'+arquivo+'">'+
                        '</a> </td>'+
//                        '<td style="text-align:center" valign="center"> '+
//                            '<a href=javascript:editarImagem('+data[nI].IMB_IMG_ID+') class="btn btn-sm btn-primary">Editar</a> '+
//                            '<a href=javascript:apagarImagem('+data[nI].IMB_IMG_ID+') class="btn btn-sm btn-danger">Excluir</a> ';
                        '<td align="center" >'+nome+'</td>' +
                        '<td align="center" >'+detalhes+'</td>' ;

                if( data[nI].IMB_IMG_PRINCIPAL !='S')
                    linha = linha + 
                            '<a class="btn btn-sm btn-success"></a> '+
                            '</td> ';
                else
                    linha = linha + 
                    '<a class="btn btn-sm btn-success">Principal</a> '+
                            '</td> ';
                    linha = linha +
                        '</tr>';
                    
                $("#tblimagens").append( linha );
                        
            }
                
        });

    }


    function carregarCapImo( id, callback )
    {
        
        var url = "{{ route('capimo.carga') }}/"+id;
        $.getJSON( url, function( data)
            {
                var captadores ='';
                for( nI=0;nI < data.length;nI++)
                {
                    captadores = captadores + data[nI].IMB_ATD_NOME+'&nbsp;&nbsp;&nbsp;&nbsp;';
                }
                callback( captadores )

            })
    }
    function selecionarImovel( ref )
    {

        $("#modalpesquisarimovel").modal( 'hide');
        $("#I-IMB_IMV_REFERE").val( ref );
        $("#i-observacoes").val( 'O cliente tem interesse no imóvel: '+ref );
        
    }

    function CarregarImagens()
    {
        str = $("#i-imovel").val();
        $.getJSON( "{{ route( 'imagens.imoveis')}}/"+str, function( data)
        {
            linha = "";
            $("#tblimagens>tbody").empty();
            for( nI=0;nI < data.length;nI++)
            {
                var nome = data[nI].IMB_IMG_NOME;
                if( nome == null)
                    nome = "";
    
                    var detalhes ='<ul class="display:inline">';

                var capa= data[nI].IMB_IMG_CAPA;
                if( capa == 'S')
                    detalhes = detalhes +'<li>Capa</li>';

                var principal= data[nI].IMB_IMG_CAPA;
                if( principal == 'S')
                detalhes = detalhes +'<li>Imagem Principal</li>';

                var naoirprosite= data[nI].IMB_IMG_NAOIRPROSITE;
                if( naoirprosite == 'S')
                    detalhes = detalhes +'<li>Não ir pro Site</li>';
                    naoirprosite = 'Fora do Site';

                detalhes = detalhes +'</ul>';

                var idimg = data[nI].IMB_IMG_ID;
                var imimg = data[nI].IMB_IMV_ID;
                var arquivo = data[nI].IMB_IMG_ARQUIVO

                linha = 
                        '<tr>'+
                        '<td align="left"><a href=javascript:mostrarImagem('+idimg+') ><img src="{{url('')}}/storage/images/'+$("#I-IMB_IMB_IDMASTER").val()+'/imoveis/thumb/'+imimg+'/100_75'+arquivo+'">'+
                        '</a> </td>'+
//                        '<td style="text-align:center" valign="center"> '+
//                            '<a href=javascript:editarImagem('+data[nI].IMB_IMG_ID+') class="btn btn-sm btn-primary">Editar</a> '+
//                            '<a href=javascript:apagarImagem('+data[nI].IMB_IMG_ID+') class="btn btn-sm btn-danger">Excluir</a> ';
                        '<td align="center" >'+nome+'</td>' +
                        '<td align="center" >'+detalhes+'</td>' ;

                if( data[nI].IMB_IMG_PRINCIPAL !='S')
                    linha = linha + 
                            '<a class="btn btn-sm btn-success"></a> '+
                            '</td> ';
                else
                    linha = linha + 
                    '<a class="btn btn-sm btn-success">Principal</a> '+
                            '</td> ';
                    linha = linha +
                        '</tr>';
                    
                $("#tblimagens").append( linha );
                        
            }
                
        });

    }


</script>


@endpush




