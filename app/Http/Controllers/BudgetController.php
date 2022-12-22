<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\BudgetProduct;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class BudgetController extends Controller
{

    public function index()
    {
        $budgets = Budget::all()->sortByDesc('id');
        return view('budget.index', compact(['budgets']));
    }

    public function create(Request $request, $customer_id)
    {
        $customer = Customer::find(intval($customer_id));

        return $customer
            ? view('budget.create', compact('customer'))
            : redirect()->route('customer.index');
    }

    public function fetch_find_product(Request $request)
    {
        $request = $request->all();
        $product = request('product', null);

        if (strlen($product) < 2)
            return response()->json([]);

        $products = DB::table('products')
            ->select('id', 'name', 'price', 'category')
            ->where('name', 'like', '%' . $product . '%')
            ->get();

        return response()->json($products);
    }

    public function show($id)
    {
        $budget = Budget::find($id);
        $budget->products = BudgetProduct::where('budget_id', $id)->get();

        return view('budget.show', compact(['budget']));
    }

    public function store(Request $request)
    {
        $customer_id = request('customer_id', null);
        $labor = request('labor', 0);
        $add_amount = request('add_amount', 0);
        $comments = request('comments', '');

        // dd($request->all());
        $products = $this->getProductsFromRequest($request);

        if (count($products) == 0)
            return redirect()->back()->withErrors('Orçamento não cadastrado. Não foi adicionado itens ao orçamento.');

        if (!Customer::find($customer_id)) {
            return redirect()->back()->withErrors('Orçamento não cadastrado. Cliente não existe na base de dados.');
        }

        $amount = 0;
        foreach ($products as $product) {
            $p = Product::find($product['id']);

            if ($p->category == 'METERS') {
                $work = floatval($labor) * floatval($product['unitary']);
                $amount += floatval($p->price) * floatval($product['unitary']) + $work;
            }

            if ($p->category == 'UNIT')
                $amount += floatval($p->price) * floatval($product['unitary']);
        }


        $amount += $add_amount;
        // dd($add_amount, $request->all());

        $budget = Budget::create([
            'date' => now(),
            'customer_id' =>  $customer_id,
            'labor' => $labor,
            'amount' => $amount,
            'comments' => $comments,
            'add_amount' => $add_amount,
            'status' => true
        ]);


        foreach ($products as $p) {
            $product = Product::find($p['id']);

            if ($p['unitary'] > 0)
                BudgetProduct::create([
                    'budget_id' => $budget->id,
                    'product_id' => $product->id,
                    'unitary' => $p['unitary'],
                    'unit_price' => $product->price,
                ]);
        }

        return redirect()->route('budget.index')->with('success', 'Orçamento cadastrado com sucesso');
    }

    public function pdf($id)
    {
        $budget = Budget::find($id);

        if (!$budget) {
            return redirect()->route('budget.index')->withErrors('Orçamento não encontrado.');
        }

        $customer = $budget->customer;

        $budget->products = BudgetProduct::with('product')
            ->where('budget_id', $budget->id)
            ->get()
            ->toArray();

        $budget = $budget->toArray();

        $data['budget'] = $budget;

        $pdf = \PDF::loadView('budget.pdf', $data);
        return $pdf->download($budget['id'] . '_' . $customer->name . '.pdf');
    }

    private function getProductsFromRequest(Request $request)
    {
        $req = $request->except('_token', 'customer_id', 'labor', 'comments', 'add_amount');
        $keys = [];
        $items = [];

        foreach ($req as $key => $value) {
            $keys[] = explode('product__', $key)[1];
        }

        foreach ($keys as $k) {
            $k = explode('__', $k);
            $id = $k[0];
            $unity = str_replace('_', '.', $k[1]);

            $items[] = [
                'id' => $id,
                'unitary' => $unity,
            ];
        }

        return $items;
    }
}
