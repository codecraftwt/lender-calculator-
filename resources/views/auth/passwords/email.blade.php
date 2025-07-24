@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="min-height: 100vh; padding-top: 50px;">
        <div class="col-md-8">
            <div class="card" style="animation: fadeIn 1s ease-in-out; box-shadow: 0 8px 20px rgba(0,0,0,0.2); border-radius: 10px;">
                <div class="card-header text-center" style="background-color: #bd94e7; color: white; font-size: 20px; font-weight: bold; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    {{ __('Reset Password') }}
                </div>

                <div class="card-body" style="background-color: #fff; border-radius: 0 0 10px 10px;">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert" style="border-radius: 8px;">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end" style="font-weight: 500;">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    style="border-radius: 8px; border: 1px solid #ccc; padding: 10px; transition: all 0.3s ease;">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn"
                                    style="background-color: #bd94e7; color: white; padding: 10px 25px; border: none; border-radius: 5px; transition: background-color 0.3s ease; font-weight: bold;">
                                    {{ __('Send Password Reset Link') }}
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