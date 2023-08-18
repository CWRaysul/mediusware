@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Transation') }}</div>
                    <div class="card-header"> <a class="dropdown-item" href="{{ route('transaction.index') }}">List</a></div>

                    <div class="card-body">
                        <table border="2">
                            <table class="table">
                                <tbody>
                                        <tr>
                                            <td>Transation Type: {{ $transaction->transaction_type == 1 ? 'Deposit' : 'Withdrawal' }}</td>
                                            <td>Amount: {{ $transaction->amount }}</td>
                                        </tr>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
