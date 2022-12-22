@extends('theme')

@section('content')

<div class="d-flex justify-content-end">
    <a href="{{ route('customer.index') }}" class="btn btn-sm btn-primary">
        <i class="fa-solid fa-plus"></i> Novo Orçamento
    </a>
</div>

<table class="table table-hover mt-3">
    <thead>
        <th>Cod</th>
        <th>Cliente</th>
        <th>Criado Em</th>
        <th>Valor</th>
        <th>Ações</th>
    </thead>

    <tbody>
        @foreach($budgets as $budget)
        <tr>
            <td>{{ $budget->id }}</td>
            <td>{{ $budget->customer->name }}</td>
            <td>{{ date('d/m/Y', strtotime($budget->date)) }}</td>
            <td>R$ {{ $budget->amount }}</td>
            <td>
                <a href="{{ route('budget.show', $budget->id) }}" class="btn btn-sm btn-primary">
                    <i class="fa-solid fa-file"></i>
                    Ver
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection