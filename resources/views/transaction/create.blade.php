@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Transation') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('transaction.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Transation Type') }}</label>

                                <div class="col-md-6">
                                    <select id="transaction_type" class="form-select @error('transaction_type') is-invalid @enderror"
                                        name="transaction_type" aria-label="Default select example">
                                        <option value="1">Deposit</option>
                                        <option value="2">Withdrawal</option>
                                    </select>

                                    @if ($errors->has('transaction_type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('transaction_type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="amount"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Amount') }}</label>

                                <div class="col-md-6">
                                    <input id="amount" type="number"
                                        class="form-control @error('amount') is-invalid @enderror" name="amount"
                                        value="{{ old('amount') }}" required autocomplete="name" autofocus>

                                    @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
