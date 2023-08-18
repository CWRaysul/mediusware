<?php

namespace App\Repositories;

use App\Repositories\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TransactionRepository implements TransactionRepositoryInterface{
    public function allTransactions(){
        return Transaction::all();
    }
    public function allWithdrawals(){
        return Transaction::where('transaction_type', 2)->get();
    }
    public function storeTransaction($data){

        $data['user_id'] = Auth::user()->id;
        $data['date'] =  date('Y-m-d H:i:s');
        $data['free'] =  $data['transaction_type'] == 2 ? $this->freeSum($data['user_id'], $data['amount']) : 0;
        return $data;
        $updateUserBalance =  $this->userBalance($data['user_id'], $data['transaction_type'], $data['amount']);
        if($updateUserBalance){
            Transaction::create($data);
            return redirect()->route('transaction.index')->with('create', 'Transaction created successfully !');
        }
        return redirect()->route('transaction.index')->with('create', 'Transaction Not created!');
    }

    public function findTransaction($id){
        return Transaction::find($id);
    }

    private function freeSum($user_id, $amount){
        $free = 0;
        $account_type = User::find($user_id)->account_type;
        $free = 0;

        if (50000 <= $amount) {
            if (1 == $account_type) {
                $feePercentage = 0.015;
            } else {
                $feePercentage = 0.015;
            }
            $free = $amount * $feePercentage;
        } else if ('Friday' == date('l')) {
            $free = 0;
        } else {
            $currentMonthWithdrawal = Transaction::whereMonth('date', now()->month)
                ->whereYear('date', now()->year)
                ->where('transaction_type', 2)
                ->sum('amount');
            if ($currentMonthWithdrawal == 0 && 5000 == $amount) {
                $free = 0;
            } else {
                if (1 == $account_type) {
                    $feePercentage = 0.015;
                } else {
                    $feePercentage = 0.025;
                }
                $free = $amount * $feePercentage;
            }
        }
        return $free;
    }

    private function userBalance($user_id, $transaction_type, $amount){
        if(1 == $transaction_type){
            $beforeBalance = Transaction::where(['user_id' => $user_id, 'transaction_type' => 1])->sum('amount');
            $currentBalance = $beforeBalance + $amount;
            $balanceUpdate = User::find($user_id);
            $balanceUpdate->balance = $currentBalance;
            $balanceUpdate->update();
            if($balanceUpdate){
                return true;
            }else{
                return false;
            }
        }else{
            $beforeBalance = Transaction::where(['user_id' => $user_id, 'transaction_type' => 1])->sum('amount');
            $currentBalance = $beforeBalance - $amount;
            $balanceUpdate = User::find($user_id);
            $balanceUpdate->balance = $currentBalance;
            $balanceUpdate->update();
            if ($balanceUpdate) {
                return true;
            } else {
                return false;
            }
        }
    }


}
