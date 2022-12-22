@extends('theme')

@section('content')

<div class="d-flex justify-content-end">
    <a href="{{ route('product.create') }}" class="btn tn-sm btn-primary">
        <i class="fa-solid fa-plus"></i>
        Novo Produto
    </a>
</div>

<table class="table mt-3">
    <thead>
        <th>Cod</th>
        <th>Nome</th>
        <th>Preço</th>
        <th>Ação</th>
    </thead>

    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            @if($product->category == 'METERS')
            <td>R$ {{ $product->price }}/metro</td>
            @else
            <td>R$ {{ $product->price }}/unidade</td>
            @endif
            <td>
                <a class="btn btn-sm btn-warning" href="{{ route('product.edit', $product->id) }}">
                    <i class="fa-solid fa-edit"></i> Editar
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection