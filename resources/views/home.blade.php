@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @php
                    $currentDayOfWeek = date('l');
echo "Current day of the week: $currentDayOfWeek";

                @endphp
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                       <div class="card-header"> <a class="dropdown-item" href="{{ route('transaction.index') }}">All Transaction</a></div>
                       <div class="card-header"> <a class="dropdown-item" href="{{ route('withdrawal.index') }}">All Withdrawal:</a></div>
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
