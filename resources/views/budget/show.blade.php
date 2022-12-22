@extends('theme')

@section('content')
<p class="text-center">
    RENOVA CALHAS <br>
    RUA ENGENHEIRO AMADO SANTOS, 466, RECANTO DAS ÁGUAS <br>
    CNPJ: 39.887.589/0001-27 <br>
    WHATSAPP (19)98929-3622 / (19)99893-8347
</p>

<hr>

<div class="d-flex justify-content-end">
    <a href="{{ route('budget.pdf', $budget->id) }}" class="btn btn-sm btn-primary">
        <i class="fa-solid fa-file-pdf"></i>
        Gerar PDF
    </a>
</div>

<h1 class="text-center">Orçamento</h1>

<table>
    <tr>
        <th class="w25 text-end">Orçamento Nº: </th>
        <td class="w75">{{ $budget->id }}</td>
    </tr>
    <tr>
        <th class="w25 text-end">Data: </th>
        <td class="w75">{{ date('d/m/Y', strtotime($budget->date)) }}</td>
    </tr>
    <tr>
        <th class="w25 text-end">Nome do Cliente: </th>
        <td class="w75">{{ $budget->customer->name }}</td>
    </tr>
    <tr>
        <th class="w25 text-end">Contato: </th>
        <td class="w75">{{ $budget->customer->phone ?: '-' }}</td>
    </tr>

</table>

<hr>

<?php $count = 1; ?>
<table class="table">
    <thead>
        <tr>
            <th>Item</th>
            <th>Unidade</th>
            <th>Produto</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($budget->products as $item)
        <tr>
            <td>{{ $count++ }}</td>
            <td>{{ $item->unitary }}</td>
            <td>{{ $item->product->name }}</td>
            <td>
                @if($item->product->category == 'UNIT')
                R$ {{ number_format($item->unitary * $item->unit_price, 2) }}
                @endif

                @if($item->product->category == 'METERS')
                R$ {{
                    number_format(
                        ($item->unitary * $item->unit_price) + 
                        ($item->unitary * $budget->labor), 2)
                    }}
                @endif
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4">
                {{ $budget->comments }} - (R${{ $budget->add_amount }})
            </td>
        </tr>
    </tbody>
</table>

<hr>

<h3 class="text-end mb-5">
    R$ {{ number_format($budget->amount, 2) }}
</h3>
@endsection