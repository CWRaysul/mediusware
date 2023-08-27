<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use App\Http\Requests\StoreWithdrawalRequest;
use App\Http\Requests\UpdateWithdrawalRequest;
use App\Repositories\Interfaces\WithdrawalRepositoryInterface;

class WithdrawalController extends Controller
{
    private $withdrawalRepository;

    public function __construct(WithdrawalRepositoryInterface $withdrawalRepository)
    {
        $this->withdrawalRepository = $withdrawalRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = $this->withdrawalRepository->allWithdrawals();
        return view('withdrawal.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('withdrawal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWithdrawalRequest $request)
    {
        $validatedData = $request->validated();
        return $this->withdrawalRepository->storeWithdrawal($validatedData);
    }

    /**
     * Display the specified resource.
     */
    public function show(Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWithdrawalRequest $request, Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Withdrawal $withdrawal)
    {
        //
    }
}
