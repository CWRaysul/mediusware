<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $d = Transaction::whereMonth('date', now()->month)
        ->whereYear('date', now()->year)
        ->where('transaction_type', 2)
        ->sum('amount');
        return $d;

    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'transaction'], function () {
    Route::get('/', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('/create', [TransactionController::class, 'create'])->name('transaction.create');
    Route::post('/', [TransactionController::class, 'store'])->name('transaction.store');
    Route::get('/{id}/show', [TransactionController::class, 'show'])->name('transaction.show');
    Route::Post('/{id}/update', [TransactionController::class, 'update'])->name('transaction.update');
    Route::get('/{id}/destroy', [TransactionController::class, 'destroy'])->name('transaction.destroy');
});
Route::group(['prefix' => 'withdrawal'], function () {
    Route::get('/', [TransactionController::class, 'withdrawal'])->name('withdrawal.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
