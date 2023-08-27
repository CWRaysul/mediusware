<?php

namespace App\Repositories\interfaces;


interface WithdrawalRepositoryInterface{
    public function allWithdrawals();
    public function storeWithdrawal($data);
}


