<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Customer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $budgets = Budget::all();

        $money = $budgets->reduce(function ($carry, $item) {
            return $carry + $item->amount;
        });

        $stats = [
            'customers' => Customer::all()->count(),
            'budgets' => Budget::all()->count(),
            'budgets_money' => number_format($money, 2),
        ];

        return view('dashboard', compact('stats'));
    }
}
