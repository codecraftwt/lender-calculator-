@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="min-height: 100vh;   padding-top: 50px;">

        <div class="col-md-8">
            <div class="card" style="animation: fadeIn 1s ease-in-out; box-shadow: 0 8px 20px rgba(0,0,0,0.2); border-radius: 10px;">
                <div class="card-header text-center" style="background-color: #bd94e7; color: white; font-size: 20px; font-weight: bold; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    {{ __('Login') }}
                </div>

                <div class="card-body" style="background-color: #fff; border-radius: 0 0 10px 10px;">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end" style="font-weight: 500;">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required
                                    autocomplete="email" autofocus
                                    style="border-radius: 8px; border: 1px solid #ccc; padding: 10px; transition: all 0.3s ease;">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end" style="font-weight: 500;">{{ __('Password') }}</label>


                            <div class="col-md-6 position-relative">
                                <div class="input-group">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="current-password"
                                        style="border-radius: 8px 0 0 8px !important; border: 1px solid #ccc; padding: 10px; transition: all 0.3s ease;">

                                    <!-- Toggle Icon -->
                                    <span class="input-group-text" onclick="togglePassword()" style="cursor: pointer; border-radius: 0 8px 8px 0;background-color: #e8f0fe !important;">
                                        <i class="fas fa-eye" id="toggleIcon"></i>
                                    </span>
                                </div>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}
                                        style="cursor: pointer;">

                                    <label class="form-check-label" for="remember" style="cursor: pointer;">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-5">
                                <button type="submit" class="btn"
                                    style="background-color: #bd94e7; color: white; padding: 10px 25px; border: none; border-radius: 5px; transition: background-color 0.3s ease; font-weight: bold;">
                                    {{ __('Login') }}
                                </button>
                                <br>


                            </div>
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}"
                                style="color: #8e3fdf; text-decoration: none; margin-top: 10px; display: inline-block;">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Inline keyframes for fade-in animation -->
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div class="position-fixed  p-3" style="z-index: 2000;top:0px;right:0px">
        @if(session('success'))
        <div id="sessionToast_success" class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div id="sessionToast_error" class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('error') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toast').forEach(function(toastEl) {
                const toast = new bootstrap.Toast(toastEl);
                toast.show();
            });
        });


        // function togglePassword() {
        //     const passwordInput = document.getElementById("password");
        //     const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
        //     passwordInput.setAttribute("type", type);
        // }
    </script>


    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const icon = document.getElementById("toggleIcon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>

</div>
@endsection