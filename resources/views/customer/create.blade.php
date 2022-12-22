@extends('theme')

@section('content')

<h1>
    Novo Cliente
</h1>

<form action="{{ route('customer.store') }}" method="post">
    @csrf

    <div class="mb-3">
        <label for="" class="form-label fw-bold">Nome</label>
        <input type="text" class="form-control" id="" placeholder="Nome do Cliente" name="name">
    </div>

    <div class="mb-3">
        <label for="" class="form-label fw-bold">Telefone</label>
        <input type="text" class="form-control" id="" placeholder="(19)90011-2233" name="phone">
    </div>

    <button class="btn btn-primary">
        <i class="fa-solid fa-check"></i>
        Salvar
    </button>
</form>
@endsection