@extends('theme')

@section('content')

<div class="d-flex justify-content-end">
    <a href="{{ route('customer.create') }}" class="btn btn-sm btn-primary">
        <i class="fa-solid fa-plus"></i>
        Novo Cliente
    </a>

</div>

<table class="table table-hover mt-3">
    <thead>
        <th>Cod</th>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Cadastrado Em</th>
        <th>Ação</th>
    </thead>
    <tbody>
        @foreach($customers as $customer)
        <tr>
            <td>{{ $customer->id }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->phone }}</td>
            <td>{{ $customer->created_at->format('d/m/Y') }}</td>
            <td>
                <a href="{{ route('budget.create', $customer->id) }}" class="btn btn-sm btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Novo Orçamento
                </a>
                <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-sm btn-warning">
                    <i class="fa-solid fa-edit"></i>
                    Editar
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection