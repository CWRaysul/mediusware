<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Http\Requests\StoreDepositRequest;
use App\Http\Requests\UpdateDepositRequest;
use App\Repositories\Interfaces\DepositRepositoryInterface;

class DepositController extends Controller
{
    private $depositRepository;

    public function __construct(DepositRepositoryInterface $depositRepository)
    {
        $this->depositRepository = $depositRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('deposit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepositRequest $request)
    {
        $validatedData = $request->validated();
        return $this->depositRepository->storeDeposit($validatedData);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transaction =  $this->depositRepository->findDeposit($id);
        return  view('deposit.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deposit $deposit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepositRequest $request, Deposit $deposit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deposit $deposit)
    {
        //
    }
}
