<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    //
    public function index()
    {
        $customers = Customer::all();

        return view('customer.index', compact(['customers']));
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $request = $request->all();

        $valid = Validator(
            $request,
            [
                'name' => 'required|string',
                'phone' => 'string|nullable'
            ],
            [
                'name.required' => 'O campo NOME é de preechimento obrigatório.',
                'name.string' => 'Não foi informado um NOME válido.',
                'phone.string' => 'Não foi informado um TELEFONE válido. ',
            ]
        );

        $valid = !$valid->fails();

        if ($valid) {
            Customer::create($request);
            return redirect()->route('customer.index')->with('success', 'Cliente cadastrado com sucesso');
        }

        return redirect()->route('customer.create')->withErrors('Erro ao cadastrar cliente');
    }

    public function edit($id)
    {
        $customer = Customer::find($id);

        return $customer ?
            view('customer.edit', compact('customer'))
            : redirect()->back()->withErrors('Cliente não encontrado');
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);

        if ($customer)
            $customer->update($request->all());

        return redirect()->route('customer.index')->with('success', 'Cliente editado com sucesso');
    }
}
