@extends('layout.app')
@section('content')
<table  id="example" class="table table-striped table-bordered table-hover" >
    <thead class="thead-dark">
        <tr >
            <th width="40" style="text-align:center"> Código </th>
            <th style="text-align:center"> De </th>
            <th style="text-align:center"> Até </th>
            <th style="text-align:center"> Percentual </th>
            <th style="text-align:center"> Reter </th>
            <th width="200" style="text-align:center"> Ações </th>
        </tr>
    </thead>
    <tbody>
        @foreach( $tabela as $row)
        <tr>
            <td style="text-align:center">{{$row->IMB_TBM_ID}}</td>
            <td style="text-align:center">{{$row->IMB_TBM_DE}}</td>
            <td style="text-align:center">{{$row->IMB_TBM_ATE}}</td>
            <td style="text-align:center">{{$row->IMB_TBM_PERCENTUAL}}</td>
            <td style="text-align:center">{{$row->IMB_TBM_DAIMOBILIARIA}}</td>
            <td style="text-align:center"> <a href="tabelamulta/editar/{{$row->IMB_TBM_ID}}" 
                    class="btn btn-sm btn-primary">Editar</a>
                  <a href="tabelamulta/vereapagar/{{$row->IMB_TBM_ID}}" 
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
@endsection



