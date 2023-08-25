@extends('layout.app')
@section('pre-script')
@endsection
@section('content')

<table  id="gridreceb" class="table table-striped table-bordered table-hover" >
    <thead class="thead-dark">
        <tr class="thead-dark">
            <th width="40" style="text-align:center"> Código </th>
            <th style="text-align:center"> Evento </th>
            <th style="text-align:center"> C/D </th>
            <th style="text-align:center"> Valor </th>
            <th style="text-align:center"> Vencto. </th>
            <th style="text-align:center"> Observação </th>
            <th width="200" style="text-align:center"> Ações </th>
        </tr>
    </thead>
    <tbody>
       CONTRATO {{$IMB_CTR_ID}}  DATA PAGAMENTO {{$dDataPagamento}}
        @foreach( $tabela as $row)
        <tr>
            <td style="text-align:center">{{$row->IMB_TBE_ID}}</td>
            <td style="text-align:center">{{$row->IMB_TBE_NOME}}</td>            
            <td style="text-align:center">{{$row->IMB_LCF_LOCATARIOCREDEB}}</td>
            <td style="text-align:center">{{$row->IMB_LCF_VALOR}}</td>
            <td style="text-align:center">{{$row->IMB_LCF_DATAVENCIMENTO}}</td>
            <td style="text-align:center">{{$row->IMB_LCF_OBSERVACAO}}</td>

            <td style="text-align:center"> <a href="tipoimovel/editar/{{$row->IMB_LCF_ID}}" 
                    class="btn btn-sm btn-primary">Editar</a>
                  <a href="tipoimovel/vereapagar/{{$row->IMB_LCF_ID}}" 
                    class="btn btn-sm btn-danger">Excluir</a>
            </td>
        </tr>
        @endforeach
        
    </tbody>
</table>

    <div class="table-footer" >
        <a href="{{url('tipoimovel/tipoimovel/new')}}" class="btn btn-sm btn-primary" role="button">
        Adicionar novo </a>

    </div>

            <!-- END CONTENT BODY -->
@endsection

@section('pos-script')
@endsection

