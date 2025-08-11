@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center" style="min-height: 100vh; padding-top: 50px;">
        <div class="col-md-8">
            <div class="card" style="animation: fadeIn 1s ease-in-out; box-shadow: 0 8px 20px rgba(0,0,0,0.2); border-radius: 10px;">
                <div class="card-header text-center" style="background-color: #bd94e7; color: white; font-size: 20px; font-weight: bold; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    {{ __('Register') }}
                </div>

                <div class="card-body" style="background-color: #fff; border-radius: 0 0 10px 10px;">
                    <form method="POST" action="{{ url('store-user') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end" style="font-weight: 500;">
                                {{ __('Name') }}
                            </label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                    style="border-radius: 8px; border: 1px solid #ccc; padding: 10px;">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end" style="font-weight: 500;">
                                {{ __('Email Address') }}
                            </label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email"
                                    style="border-radius: 8px; border: 1px solid #ccc; padding: 10px;">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end" style="font-weight: 500;">
                                {{ __('Role') }}
                            </label>

                            <div class="col-md-6">
                                <select name="role" id="role" class="col-md-4 col-form-label text-md-start form-control" style="font-weight: 500;">
                                    <option value="">Select role</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Broker">Broker</option>

                                </select>

                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end" style="font-weight: 500;">
                                {{ __('Password') }}
                            </label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password"
                                    style="border-radius: 8px; border: 1px solid #ccc; padding: 10px;">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end" style="font-weight: 500;">
                                {{ __('Confirm Password') }}
                            </label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password"
                                    class="form-control"
                                    name="password_confirmation" required autocomplete="new-password"
                                    style="border-radius: 8px; border: 1px solid #ccc; padding: 10px;">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn"
                                    style="background-color: #bd94e7; color: white; padding: 10px 25px; border: none; border-radius: 5px; transition: background-color 0.3s ease; font-weight: bold;">
                                    {{ __('Register') }}
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>