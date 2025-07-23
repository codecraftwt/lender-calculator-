<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'matrix Loan Matching')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" rel="stylesheet" />
    <!-- Odometer CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/themes/odometer-theme-default.min.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link rel="icon" href="{{ url('assets/images/favicon.jpg') }}" type="image/jpeg">
    @yield('styles')
</head>

<body>
    <header class="py-3 bg-white shadow-sm">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="{{ url('/index') }}" class="d-flex align-items-center text-decoration-none">
                <img src="{{ url('assets/images/main-logo.png') }}" alt="matrix" class="logo" />
            </a>
            <nav>
                <ul class="nav gap-3 align-items-center">
                    <li><a href="{{ url('/') }}" class="nav-link px-2">Home</a></li>
                    <li><a href="{{ url('/') }}" class="nav-link px-2">Lenders</a></li>
                    <li><a href="{{ url('/customer-list') }}" class="nav-link px-2">Customers</a></li>
                    <li><a href="{{ url('/') }}" class="nav-link px-2">Contact us</a></li>
                    <li>
                        <a href="#" class="btn btn-login px-3 py-1 rounded-pill">Login</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="container my-4">
        @yield('content')
    </main>
    @yield('scripts')
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>