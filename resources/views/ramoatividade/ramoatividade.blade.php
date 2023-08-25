@extends('layout.app')
@section('content')
<table  id="example" class="table table-striped table-bordered table-hover" >
    <thead class="thead-dark">
        <tr >
            <th width="40" style="text-align:center"> Código </th>
            <th style="text-align:center"> Ramo de Atividade </th>
            <th width="200" style="text-align:center"> Ações </th>
        </tr>
    </thead>
    <tbody>
        @foreach( $tabela as $row)
        <tr>
            <td style="text-align:center">{{$row->GER_RMA_ID}}</td>
            <td style="text-align:center">{{$row->GER_RMA_DESCRICAO}}</td>
            <td style="text-align:center"> <a href="ramoatividade/editar/{{$row->GER_RMA_ID}}" 
                    class="btn btn-sm btn-primary">Editar</a>
                  <a href="ramoatividade/vereapagar/{{$row->GER_RMA_ID}}" 
                    class="btn btn-sm btn-danger">Excluir</a>
            </td>
        </tr>
        @endforeach
        
    </tbody>
</table>

    <div class="table-footer" >
        <a href="{{url('ramoatividade/ramoatividade/new')}}" class="btn btn-sm btn-primary" role="button">
        Adicionar novo </a>

    </div>
@endsection



