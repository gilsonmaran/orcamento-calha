<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Orçamento</title>

    <!-- Styles -->
    <style>
        body {
            background-color: #fff;
            color: #000;
            font-family: 'Times New Roman', sans-serif;
        }


        table {
            width: 100%;
        }

        td,
        th {
            padding: 0 10px;
        }

        hr {
            border: 1px solid #000;
        }

        .w25 {
            width: 25%;
        }

        .w50 {
            width: 50%;
        }

        .w75 {
            width: 75%;
        }

        .text-start {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }
    </style>
</head>

<body>
    <table class="text-center">
        <tr>
            <td>RENOVA CALHAS</td>
        </tr>
        <tr>
            <td> RUA ENGENHEIRO AMADO SANTOS, 466, RECANTO DAS ÁGUAS </td>
        </tr>
        <tr>
            <td>CNPJ: 39.887.589/0001-27</td>
        </tr>
        <tr>
            <td>WHATSAPP (19)98929-3622 / (19)99893-8347</td>
        </tr>
    </table>

    <hr>

    <h1 class="text-center">Orçamento</h1>

    <table>
        <tr>
            <th class="w25 text-end">Orçamento Nº: </th>
            <td class="w75">{{ $budget['id'] }}</td>
        </tr>
        <tr>
            <th class="w25 text-end">Data: </th>
            <td class="w75">{{ $budget['date'] }}</td>
        </tr>
        <tr>
            <th class="w25 text-end">Nome do Cliente: </th>
            <td class="w75">{{ $budget['customer']['name'] }}</td>
        </tr>
        <tr>
            <th class="w25 text-end">Contato: </th>
            <td class="w75">{{ $budget['customer']['phone'] ?: '-' }}</td>
        </tr>

    </table>

    <hr>

    <?php $count = 1; ?>
    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th class="w25 text-start">Unidade</th>
                <th class="w50 text-start">Produto</th>
                <th class="w25 text-start">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($budget['products'] as $product)
            <tr>
                <td>{{ $count++ }}</td>
                <td>{{ $product['unitary'] }}</td>
                <td>{{ $product['product']['name'] }}</td>
                <td>
                    @if($product['product']['category'] == 'UNIT')
                    R$ {{ number_format($product['unitary'] * $product['unit_price'], 2) }}
                    @endif

                    @if($product['product']['category'] == 'METERS')
                    R$ {{
                        number_format(($product['unitary'] * $product['unit_price']) + $product['unitary'] * $budget['labor'], 2)
                     }}
                    @endif
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4">
                    <br><br>
                    {{ $budget['comments'] }} - (R${{ $budget['add_amount'] }})
                </td>
            </tr>
        </tbody>
    </table>

    <hr>

    <h3 class="text-end">
        R$ {{ number_format($budget['amount'], 2) }}
    </h3>

</body>

</html>