<?php

namespace App\Repositories;

use App\Repositories\Interfaces\DepositRepositoryInterface;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DepositRepository implements DepositRepositoryInterface{

    public function storeDeposit($data){
        try {
            $data['user_id'] = Auth::user()->id;
            $data['date'] =  date('Y-m-d H:i:s');
            $data['transaction_type'] = 1;
            Transaction::create($data);
            $this->increaseUserBalance($data['user_id']);
            return redirect()->route('transaction.index')->with('create', 'Deposit created successfully !');

        } catch (\Throwable $th) {
            return redirect()->route('transaction.index')->with('create', 'Deposit Not created!');
        }
    }

    public function findDeposit($id){
        return Transaction::find($id);
    }

    private function increaseUserBalance($user_id)
    {
        try {
            $balanceUpdate = User::find($user_id);
            $balanceUpdate->balance = Transaction::where(['user_id' => $user_id, 'transaction_type' => 1])->sum('amount');
            $balanceUpdate->update();
            if ($balanceUpdate) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return redirect()->route('transaction.index')->with('create', 'Deposit Not created!');
        }

    }


}
