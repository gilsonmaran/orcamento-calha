<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return  redirect()->route('login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::prefix('dashboard')
    ->controller(DashboardController::class)
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/index', 'index')->name('dashboard');
    });

Route::prefix('budget')
    ->controller(BudgetController::class)
    ->middleware(['auth'])
    ->name('budget.')
    ->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create/{customer_id}', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/show/{id}', 'show')->name('show');
        
        Route::get('/pdf/{id}', 'pdf')->name('pdf');

        Route::post('/fetch_find_product', 'fetch_find_product')->name('fetch_find_product');
    });

Route::prefix('customer')
    ->controller(CustomerController::class)
    ->middleware(['auth'])
    ->name('customer.')
    ->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
    });

Route::prefix('product')
    ->controller(ProductController::class)
    ->middleware(['auth'])
    ->name('product.')
    ->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');

        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
    });
