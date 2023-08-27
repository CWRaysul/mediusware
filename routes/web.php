<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WithdrawalController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'transaction', 'middleware' => 'auth'], function () {
    Route::get('/', [TransactionController::class, 'index'])->name('transaction.index');
});

Route::group(['prefix' => 'deposit', 'middleware' => 'auth'], function () {
    Route::get('/create', [DepositController::class, 'create'])->name('deposit.create');
    Route::post('/', [DepositController::class, 'store'])->name('deposit.store');
    Route::get('/{id}/show', [DepositController::class, 'show'])->name('deposit.show');
});

Route::group(['prefix' => 'withdrawal', 'middleware' => 'auth'], function () {
    Route::get('/', [WithdrawalController::class, 'index'])->name('withdrawal.index');
    Route::get('/create', [WithdrawalController::class, 'create'])->name('withdrawal.create');
    Route::post('/', [WithdrawalController::class, 'store'])->name('withdrawal.store');
});

