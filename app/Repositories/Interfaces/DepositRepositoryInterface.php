<?php

namespace App\Repositories\interfaces;


interface DepositRepositoryInterface{
    public function storeDeposit($data);
    public function findDeposit($id);
}


