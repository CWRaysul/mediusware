<?php

namespace App\Repositories;

use App\Repositories\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TransactionRepository implements TransactionRepositoryInterface{
    public function allTransactions(){
        return Transaction::where('user_id', Auth::user()->id)->get();
    }


}
