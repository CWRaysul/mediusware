@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="col-md-6">
                    <a href="{{ route('transaction.index') }}"><button type="button" class="btn btn-primary">Transactions
                            List</button></a>
                    <a href="{{ route('withdrawal.index') }}"><button type="button" class="btn btn-secondary">Withdrawal List</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection
