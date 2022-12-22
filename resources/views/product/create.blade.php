@extends('theme')

@section('content')

<h1>
    Novo Produto
</h1>

<form action="{{ route('product.store') }}" method="post">
    @csrf

    <div class="mb-3">
        <label for="" class="form-label fw-bold">Nome</label>
        <input type="text" class="form-control" id="" placeholder="Nome do Produto" name="name">
    </div>

    <div class="mb-3">
        <label for="" class="form-label fw-bold">Categoria</label>
        <select class="form-select" id="" name="category">
            <option value="METERS">Metro Linear</option>
            <option value="PRODUCT">Produto</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="" class="form-label fw-bold">Valor (Apenas números separados por '.')</label>
        <input type="text" class="form-control" id="" placeholder="10" name="price">
    </div>

    <button class="btn btn-primary">
        <i class="fa-solid fa-check"></i>
        Salvar
    </button>
</form>
@endsection