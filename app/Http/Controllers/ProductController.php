<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();

        return view('product.index', compact(['products']));
    }

    public function create(Request $request)
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $request = $request->all();

        $valid = Validator(
            $request,
            [
                'name' => 'required|string',
                'price' => 'required|numeric',
                'category' => 'required|in:METERS,UNIT'
            ],
            [
                'name.required' => 'O campo NOME é de preechimento obrigatório.',
                'price.required' => 'O campo VALOR é de preenchimento obrigatório.',
                'price.numeric' => 'O campo VALOR deve conter apenas números separado por ponto.',
                'category.required' => 'O campo CATEGORIA é de preenhcimento obrigatório.',
                'category.in' => 'Deve ser informado uma opção válida no campo CATEGORIA',
            ]
        );

        $valid = !$valid->fails();

        if ($valid) {
            Product::create($request);
            return redirect()->route('product.index');
        }

        return redirect()->route('product.create');
    }

    public function edit($id)
    {
        $product = Product::find($id);

        return $product ?
            view('product.edit', compact('product'))
            : redirect()->back()->withErrors('Produto não encontrado');
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());

        return redirect()->route('product.index')->with('success', $product->name . ' editado com sucesso');
    }
}
