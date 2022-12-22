@extends('theme')

@section('content')

<h1 class="mt-3 text-center">
    Novo Orçamento para {{ $customer->name }}
</h1>

<div class="mt-3">
    <form action="{{ route('budget.store') }}" method="post">
        @csrf
        <input type="hidden" name="customer_id" value="{{ $customer->id }}">

        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-6">
                <div class="">
                    <label class="fw-bold">Pesquisar Produto</label>
                    <input type="search" class="form-control" id="filter-product">
                </div>

                <table class="table search">
                    <tbody id="show-products-filtered"></tbody>
                </table>
            </div>

            <div class="col-md-3">
                <label class="fw-bold">Valor da Mão de Obra (R$/metro)</label>
                <input type="number" step="0.01" class="form-control" id="labor" name="labor" value="20">
            </div>

            <div class="col-md-3">
                <label class="fw-bold">Total Atual (R$)</label>
                <input type="text" class="form-control" id="amount-current" value="0" readonly>
            </div>
        </div>

        <h3 class="mt-4">Produtos Selecionados</h3>

        <table class="table table-hover">
            <thead>
                <th style="max-width: 50px !important;">Qtd/Tamanho (mts)</th>
                <th>Nome</th>
                <th>Vl Total</th>
            </thead>
            <tbody id="products-select"></tbody>
        </table>

        <hr>

        <div class="row">
            <div class="form-group mb-3 col">
                <label class="fw-bold">Valor Adicional/Insumos (R$)</label>
                <input class="form-control" type="number" name="add_amount" value="0" min="0" step="0.01">
            </div>

            <div class="form-group col">
                <label class="fw-bold">Observações</label>
                <textarea class="form-control" name="comments" rows="5"></textarea>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button class="btn btn-primary mt-3">
                <i class="fa-solid fa-check"></i>
                Salvar Orçamento
            </button>
        </div>
    </form>
</div>

@push('css')
<style>
    .search {
        z-index: 10;
        position: fixed;
        background-color: #FFF;
        max-height: 300px;
        display: block;
        overflow-y: scroll;
    }
</style>
@endpush

@push('js')
<script>
    const filterProduct = document.getElementById('filter-product')
    const showProductsFiltered = document.getElementById('show-products-filtered')
    const productsSelect = document.getElementById('products-select')
    const amountCurrent = document.getElementById('amount-current')
    const labor = document.getElementById('labor')
    let amount = 0
    let budget = []
    let count = 0;

    labor.addEventListener('change', () => {
        updatePriceBudget()
    })

    filterProduct.addEventListener('keyup', (e) => {
        const url = "{{ route('budget.fetch_find_product') }}"
        const _product = {
            product: e.target.value
        }

        let myHeaders = new Headers();
        myHeaders.append("X-CSRF-TOKEN", '{{ csrf_token() }}');
        myHeaders.append("Content-Type", "application/json");

        fetch(url, {
                method: "POST",
                headers: myHeaders,
                body: JSON.stringify(_product),
            })
            .then(response => response.json())
            .then(products => {
                showProduct(products)
            })
    })

    function showProduct(products) {
        const table = document.createElement('table')
        showProductsFiltered.innerHTML = ''

        products.forEach(p => {
            const tr = document.createElement('tr');
            const tdProduct = document.createElement('td');
            const tdButtom = document.createElement('td');

            const button = document.createElement('button')
            button.setAttribute('type', 'button')
            button.setAttribute('class', 'btn btn-sm btn-primary')
            button.setAttribute('id', 'product-' + p.id)
            button.innerText = 'Adicionar'

            button.addEventListener('click', () => {
                addProductInBudget(p)
            })

            tdProduct.innerText = `${p.name} (R$ ${p.price})`
            tdButtom.appendChild(button)

            tr.appendChild(tdProduct)
            tr.appendChild(tdButtom)

            showProductsFiltered.appendChild(tr)
        })
    }

    function addProductInBudget(product) {
        const tr = document.createElement('tr')
        // const tdCod = document.createElement('td')
        const tdQtd = document.createElement('td')
        const tdName = document.createElement('td')
        const tdAmount = document.createElement('td')

        // tr.appendChild(tdCod)
        tr.appendChild(tdQtd)
        tr.appendChild(tdName)
        tr.appendChild(tdAmount)

        const inputQtd = document.createElement('input');
        inputQtd.setAttribute('class', 'form-control form-control-sm')
        inputQtd.setAttribute('type', 'number')
        inputQtd.setAttribute('step', '0.1')
        inputQtd.setAttribute('min', '0')
        inputQtd.setAttribute('name', `product_${product.id}_1`)
        inputQtd.setAttribute('value', '1')
        inputQtd.style.maxWidth = '100px'

        tdQtd.appendChild(inputQtd);

        inputQtd.addEventListener('change', () => {
            const id = product.id
            let total = 0

            if (product.category == 'METERS') {
                let work = parseFloat(inputQtd.value) * parseFloat(labor.value)
                total = parseFloat(inputQtd.value) * parseFloat(product.price) + work
            }

            if (product.category == 'UNIT') {
                total = parseFloat(inputQtd.value) * parseFloat(product.price)
            }

            tdAmount.innerText = `R$ ${total.toFixed(2)}`
            inputQtd.setAttribute('name', `product__${product.id}__${inputQtd.value}`)

            const item = budget.find(product => product.id == id);
            item.qtd = parseFloat(inputQtd.value)
            updatePriceBudget()
        })

        // tdCod.innerText = product.id
        tdName.innerText = product.name

        if (product.category == 'METERS') {
            let work = parseFloat(inputQtd.value) * parseFloat(labor.value)
            tdAmount.innerText = 'R$' + (parseFloat(inputQtd.value) * parseFloat(product.price) + work)
        }

        if (product.category == 'UNIT') {
            tdAmount.innerText = 'R$' + (parseFloat(inputQtd.value) * parseFloat(product.price))
        }

        productsSelect.appendChild(tr)

        product.qtd = 1
        budget.push(product)

        updatePriceBudget()
        clearFilter()
    }

    function clearFilter() {
        showProductsFiltered.innerHTML = ''
        filterProduct.value = ''
    }

    function updatePriceBudget() {
        const total = budget.reduce((acc, p) => {
            if (p.category == 'METERS') {
                const work = parseFloat(p.qtd) * parseFloat(labor.value)
                return acc + (parseFloat(p.price) * parseFloat(p.qtd) + parseFloat(work))
            }

            if (p.category == 'UNIT') {
                return acc + (parseFloat(p.price) * parseFloat(p.qtd))
            }
        }, 0)

        amount = total.toFixed(2)
        amountCurrent.value = amount
    }
</script>
@endpush

@endsection