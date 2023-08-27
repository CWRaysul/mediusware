@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Transation List') }}</div>
                    <div class="card-header">
                        <a href="{{ route('deposit.create') }}"><button type="button"  class="btn btn-primary">Deposit</button></a>
                        <a href="{{ route('withdrawal.index') }}"><button type="button" class="btn btn-secondary">Withdrawal List</button></a>
                    </div>

                    <div class="card-body">
                        <table>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Transation Type</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $currentBalance = 0;
                                    @endphp

                                    @foreach ($transactions as $key => $transaction)
                                        @php
                                            if (1 == $transaction->transaction_type) {
                                                $currentBalance += $transaction->amount;
                                            }else{
                                                $currentBalance -= $transaction->amount;
                                            }
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ ++$key }}</th>
                                            <td>{{ $transaction->transaction_type == 1 ? 'Deposit' : 'Withdrawal' }}</td>
                                            <td>{{ $transaction->amount }}</td>
                                            <td> <a class="dropdown-item"
                                                    href="{{ route('deposit.show', [$transaction->id]) }}"><i
                                                        class="la la-show"></i> Details</a></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2">Current Balance :</td>
                                        <td>{{ $currentBalance }}</td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
