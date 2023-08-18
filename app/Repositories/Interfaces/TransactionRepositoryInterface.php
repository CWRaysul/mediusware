<?php

namespace App\Repositories\interfaces;


interface TransactionRepositoryInterface{
    public function allTransactions();
    public function allWithdrawals();
    public function storeTransaction($data);
    public function findTransaction($id);
}


