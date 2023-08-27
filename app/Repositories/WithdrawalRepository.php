<?php

namespace App\Repositories;

use App\Repositories\Interfaces\WithdrawalRepositoryInterface;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class WithdrawalRepository implements WithdrawalRepositoryInterface{

    public function allWithdrawals(){
        return Transaction::where(['user_id' => Auth::user()->id, 'transaction_type' => 2])->get();
    }

    public function storeWithdrawal($data){

        try {
            $data['user_id'] = Auth::user()->id;
            $data['date'] =  date('Y-m-d H:i:s');
            $data['transaction_type'] =  2;
            $data['free'] =  $this->calculateWithdrawalFree($data['user_id'], $data['amount']);
            $this->decrementUserBalance($data['user_id'], $data['amount']);
            Transaction::create($data);
            return redirect()->route('withdrawal.index')->with('create', 'Withdrawal successfully !');
        } catch (\Throwable $th) {
            return redirect()->route('withdrawal.index')->with('create', 'Withdrawal Not created!');
        }


    }


    private function calculateWithdrawalFree($user_id, $amount)
    {
        $account_type = User::find($user_id)->account_type;

        $free = 0;
        if(date('l') == 'Friday'){
            $free = 0;
        }else if(50000 <= $amount){
            $free = ($amount / 100) *  0.015;
        }else{
            // The first 5K withdrawal each month is free
            $currentMonthWithdrawal = Transaction::whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->where('transaction_type', 2)
            ->sum('amount');

            if(5000  > $currentMonthWithdrawal){
                $withdrawalFreeAmount = 5000 - $currentMonthWithdrawal;
                $amount -= $withdrawalFreeAmount;
                $percentage = ($account_type == 1) ? 0.015 : 0.025;
                $free = ($amount / 100) * $percentage;
            }else{
                $percentage = ($account_type == 1) ? 0.015 : 0.025;
                $free = ($amount / 100) * $percentage;
            }
        }

        //  First 1K withdrawal per transaction is free
        if(!empty($free)){
            $free -= ($account_type == 1) ? 0.15 : 0.25;
        }

        return $free;
    }

    private function decrementUserBalance($user_id, $amount)
    {
        try {
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
        } catch (\Throwable $th) {
            return redirect()->route('withdrawal.index')->with('create', 'Withdrawal Not created!');
        }
    }

}
