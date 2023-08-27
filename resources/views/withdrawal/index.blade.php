@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Withdrawal List') }}</div>
                    <div class="card-header">
                        <a href="{{ route('withdrawal.create') }}"><button type="button" class="btn btn-secondary">Withdrawal</button></a>

                        <a href="{{ route('transaction.index') }}"><button type="button" class="btn btn-primary">Transactions
                            List</button></a>
                    </div>

                    <div class="card-body">
                        <table>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Transation Type</th>
                                        <th>Amount</th>
                                        <th>Free</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalWithdrawal = 0;
                                        $totalFree = 0;
                                    @endphp

                                    @foreach ($transactions as $key => $transaction)
                                        @php
                                            $totalWithdrawal += $transaction->amount;
                                            $totalFree += $transaction->free;
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ ++$key }}</th>
                                            <td>{{ $transaction->transaction_type == 1 ? 'Deposit' : 'Withdrawal' }}</td>
                                            <td>{{ $transaction->amount }}</td>
                                            <td>{{ $transaction->free }}</td>
                                    @endforeach
                                    <tr>
                                        <td colspan="2">Total :</td>
                                        <td>{{ $totalWithdrawal }}</td>
                                        <td>{{ $totalFree }} </td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
