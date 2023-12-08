@extends('layout.app')
@section('scriptop')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  @endsection
@section('scripttop')
<style>
    input::-webkit-datetime-edit-day-field:focus,
    input::-webkit-datetime-edit-month-field:focus,
    input::-webkit-datetime-edit-year-field:focus {
    background-color: red;
    color: white;
    outline: none;
}
label
{
    margin-bottom:0px;
}

.readonly
{
    color:black;
    background-color:lightgrey;
}

textarea:focus,
input[type="text"]:focus,
input[type="password"]:focus,
input[type="checkbox"]:focus,
input[type="datetime"]:focus,
input[type="datetime-local"]:focus,
input[type="date"]:focus,
input[type="month"]:focus,
input[type="time"]:focus,
input[type="week"]:focus,
input[type="number"]:focus,
input[type="email"]:focus,
input[type="url"]:focus,
input[type="search"]:focus,
input[type="tel"]:focus,
input[type="color"]:focus,
.uneditable-input:focus {   
  border-color: rgba(126, 239, 104, 0.8);
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(126, 239, 104, 0.6);
  outline: 0 none;
}

.escondido
{
    display:none;
}


div{
    padding: 0px;}

    
.div-center {
    text-align: center;
  }
.italic
{
    text-decoration: italic;
}
.font-10px
{
    font-size:10px;
}

.font-green
{
    color:green;
}




.font-und-14px
{
    font-size:14px;
    color: grey;
    text-decoration: underline;
}
.font-red-bold-10px
{
    font-size:12px;
    color: red;
    font-weight: bold;

}
.bg-red-foreg-white
{
    background-color: red;
    color:white;
    font-size:10px;
    font-weight: bold;

}
.bg-blue-foreg-white
{
    background-color: blue;
    color:white;
    font-size:10px;
    font-weight: bold;
    padding: 0px;
}
.bg-orange-foreg-black
{
    background-color: orange;
    color: black;
    font-size:10px;
    font-weight: bold;
}



.bg-peru-foreg-white
{
    background-color:peru;
    color:white;
    font-size:10px;
    font-weight: bold;

}

.bg-peru-green-white
{
    background-color:green;
    color:white;
    font-size:10px;
    font-weight: bold;

}

.bg-gray-fore-black
{
    background-color:darkorange;
    color:black;
    font-size:10px;
    font-weight: bold;


}

.font-10px-bold
{
    font-size:12px;
    color: #000099;
    font-weight: bold;

}
.font-10px
{
    font-size:12px;
    color: #000099;
}

h5 {
    text-align: center;
    color: #4682B4 ;
    font-size: 20px;
    font-weight: bold;
}

h1 {
    text-align: center;
    color: #4682B4 ;
    font-size: 20px;
    font-weight: bold;
}

.lbl-cliente {
  text-align: center;
  font-size: 14px;
  font-weight: bold;
  color: #4682B4;
}

.div-cor-fonte-white{
    color:white;
}
.div-cor-red {
  border-style: solid;
  border-color: red;
  color: white;
}

.div-cor-green {
    border-style: solid;
  border-color: green;
}

.div-cor-blue {
    background-color: blue;
    color: white;
}

.div-cor-white{
    border-style: solid;
  border-color: white;
}


table.dataTable tbody th, table.dataTable tbody td 
    {
        padding: 1px 10px; 
        text-align:left;
        height: 70%;

    }
    table.dataTable td 
    {
        font-size: 12px;
    }

</style>

@endsection

@section('content')




<div class="portlet orange bordered">
    <div class="portlet-title">
        <div class="caption font-blue">
            <span class="caption-subject bold uppercase"> Nova Proposta para o Imóvel</span>
            <i class="fa fa-search font-blue"></i>
        </div>
    </div>
</div>

    @php
        $dadosimovel = app('App\Http\Controllers\ctrImovel')->dadosMinimosPorID( $idimovel );
        $enderecocompleto = app('App\Http\Controllers\ctrRotinas')->imovelEnderecoCompleto( $idimovel );


    @endphp
<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-home"></i>Dados do imóvel
        </div>
        <div class="tools">
        </div>
    </div>
        
    <div class="portlet-body form">
        <div class="form-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-1">
                        <label class="control-label">Referência</label>
                        <label  class="form-control readonly" id="IMB_IMV_REFERE">{{$dadosimovel->IMB_IMV_REFERE}}</label>
                    </div>
                    <div class="col-md-7">
                        <label class="control-label">Endereço</label> 
                        <label  class="form-control readonly">{{$enderecocompleto}}</label>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">Proprietário</label>
                             <span>&nbsp; <a href=""><i title="Telefones de contato do proprietário" class="fa fa-phone" aria-hidden="true"></i></a> 
                                &nbsp;<a href=""><i title="Email de contato do proprietário" class="fa fa-envelope-o" aria-hidden="true"></i></a>
                            </span>
                        <label  class="form-control readonly">{{$dadosimovel->IMB_CLT_NOME}}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('script')

<script src="{{asset('/js/funcoes.js')}}" type="text/javascript"></script>

<script type="text/javascript">

    $(document).ready(function()
    {
        $("#sirius-menu").click();

    
    });

    </script>
@endpush
