<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'matrix Loan Matching')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" rel="stylesheet" />
    <!-- Odometer CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/themes/odometer-theme-default.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.6.4/dist/select2-bootstrap4.min.css" rel="stylesheet" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="icon" href="{{ url('assets/images/favicon.jpg') }}" type="image/jpeg">
    @yield('styles')
</head>

<body>
    <header class="py-3 bg-white shadow-sm">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="{{ url('/index') }}" class="d-flex align-items-center text-decoration-none">
                <!-- <img src="{{ url('assets/images/matrix.png') }}" alt="matrix" class="logo" /> -->
            </a>
            <nav>
                <ul class="nav gap-3 align-items-center">
                    <li><a href="{{ url('/') }}" class="nav-link px-2">Home</a></li>
                    <li><a href="{{ url('/lender-list') }}" class="nav-link px-2">Lenders</a></li>
                    <li class=""><a href="{{ url('/customer-list') }}" class="nav-link px-2">Customers</a></li>
                    <li><a href="{{ url('/') }}" class="nav-link px-2">Contact us</a></li>
                    @auth
                    @if( auth()->user()->deleted_flag !=1 && auth()->user()->role === 'Admin')
                    <li>
                        <a href="{{ url('/user-list') }}" class="nav-link px-2">Users</a>
                    </li>
                    @endif
                    @if( auth()->user()->deleted_flag !=1 && auth()->user()->role === 'Admin' && auth()->user()->master_account === 'Yes' )
                    <li>
                        <a href="{{ url('/activity-logs') }}" class="nav-link px-2">Activity Logs</a>
                    </li>
                    @endif
                    <!-- <li>
                        <a href="#" class="nav-link px-2 btn btn-login px-3 py-1 rounded-pill"
                            onclick="confirmLogout(event)">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li> -->

                    <div class="dropdown">
                        <button class="btn btn-link " type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('assets/images/user_icon.webp') }}" id="user_profile_picture" alt="Profile Image" class="rounded-circle" style="width: 40px; height: 40px;">
                        </button>

                        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                            <li class="open-profile-modal-btn" data-user-id="{{ auth()->user()->id }}">
                                <a class="dropdown-item " style="color: rgb(86 66 161); font-weight:600;cursor:pointer">
                                    <i class="fas fa-user"></i> Profile
                                </a>
                            </li>
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item" style="color: rgb(86 66 161);font-weight:600">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>

                    @endauth
                    @guest
                    <li>
                        <a href="{{ route('login') }}" class="btn btn-login px-3 py-1 rounded-pill">Login</a>
                    </li>
                    @endguest
                </ul>
            </nav>
        </div>
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



        <div id="profile_modal" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" style="width: 100%; max-width: 1100px; z-index: 2050;">
                <div class="modal-content" style="min-height: 70vh !important;padding:20px;max-height: 75vh;box-shadow: 0 0 15px rgba(133, 42, 163, 0.9);">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>

                    <div class="container">
                        <h4 class="text-center">Profile</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <form id="user_profile_edit_form" method="POST" action="{{ url('/update-user-profile') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-4 mb-3 visually-hidden">
                                            <input type="text" id="logged_user_id" name="logged_user_id" readonly class="form-control" autocomplete="off" />
                                        </div>
                                        <div class="col-md-12 mb-3 d-flex justify-content-center align-items-center " style="height: 100px;">
                                            <img src="" alt="" id="profile_picture" height="100px" style="border-radius:50%">
                                        </div>
                                        <div class="col-md-6 mb-3  ">
                                            <label for="profile_image" class="form-label">Profile Image</label>
                                            <div class="input-group">
                                                <input type="file" id="profile_image" name="profile_image" class="form-control" autocomplete="off" />
                                            </div>
                                            <p class="text-danger d-none" id="invalid_profile_image">Please enter valid name.</p>
                                        </div>
                                        <div class="col-md-6 mb-3  ">
                                            <label for="user_name" class="form-label">Name</label>
                                            <div class="input-group">
                                                <input type="text" id="user_name" name="user_name" class="form-control" autocomplete="off" />
                                            </div>
                                            <p class="text-danger d-none" id="invalid_user_name">Please enter valid name.</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="user_email" class="form-label">Email</label>
                                            <div class="input-group">
                                                <input type="text" id="user_email" name="user_email" class="form-control" readonly autocomplete="off" />
                                            </div>
                                            <p class="text-danger d-none" id="invalid_user_email">Please enter valid email.</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="user_role" class="form-label">Role</label>
                                            <input type="text" id="user_role" name="user_role" readonly class="form-control" autocomplete="off" />
                                            <p class="text-danger d-none" id="invalid_role">Please select valid option.</p>
                                        </div>



                                        <div class="col-md-6 mb-3">
                                            <button type="button" class="btn btn-success m-5 user-details-edit-submit-btn" style="background-color:rgb(86 66 161);border:none">
                                                Save Changes
                                            </button>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            @auth
                                            <a href="{{ url('/password/reset') }}"><button type="button" class="btn btn-success m-5  " style="background-color:rgb(86 66 161);;border:none">
                                                    Reset Password
                                                </button></a>
                                            @endauth
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-2"></div>
                        </div>
                        <div class="modal-footer mt-1">
                            <button type="button" class="btn btn-outline-secondary text-white m-1" data-bs-dismiss="modal"
                                style="background-color:rgb(86 66 161);">
                                ← Back
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="change_password_modal" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" style="width: 100%; max-width: 1100px; z-index: 2050;">
                <div class="modal-content" style="min-height: 75vh !important;padding:20px;max-height: 75vh;box-shadow: 0 0 15px rgba(133, 42, 163, 0.9);">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>

                    <div class="container">
                        <h4 class="text-center">Change Password</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <form id="user_password_change_form" method="POST" action="{{ url('/user-change-password') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-4 mb-3 visually-hidden">
                                            <input type="text" id="change_password_user_id" name="change_password_user_id" class="form-control" autocomplete="off" />
                                        </div>



                                        <div class="col-md-12 mb-3">
                                            <label for="change_password_user_email" class="form-label">Email</label>
                                            <div class="input-group">
                                                <input type="text" id="change_password_user_email" name="change_password_user_email" readonly class="form-control" readonly autocomplete="off" />
                                            </div>
                                            <p class="text-danger d-none" id="invalid_change_password_user_email">Please enter valid email.</p>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <button type="button" class="btn btn-success m-5 request-otp-btn" style="background-color:rgb(86 66 161);border:none">
                                                Request OTP
                                            </button>
                                        </div>
                                        <p id="otp_text" style="color: green;" class="d-none">An OTP has been sent to your email and is valid for 60 seconds.</p>

                                        <div class="col-md-12 mb-3 d-none" id="otp_field">
                                            <label for="otp" class="form-label">Enter your OTP.</label>
                                            <div class="input-group">
                                                <input type="text" id="otp" name="otp" readonly class="form-control" autocomplete="off" />
                                            </div>
                                            <p class="text-danger d-none" id="invalid_otp">Invalid otp.</p>
                                        </div>
                                        <div class="col-md-12 mb-3 d-none otp_btn">
                                            <button type="button" class="btn btn-success m-5 submit-otp-btn" style="background-color:rgb(86 66 161);border:none">
                                                submit
                                            </button>
                                        </div>

                                    </div>
                                </form>
                            </div>

                            <div class="col-md-2"></div>
                        </div>
                        <div class="modal-footer mt-1">
                            <button type="button" class="btn btn-outline-secondary text-white m-1" data-bs-dismiss="modal"
                                style="background-color:rgb(86 66 161);">
                                ← Back
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php
        $baseUserImageUrl = "{{ url('assets/profile_images') }}";
        @endphp

        @auth
        <script>
            const baseUserImageUrl = "{{ url('assets/profile_images') }}";
            const user_id = "{{ auth()->user()->id }}";
            const user_profile_picture = "{{ auth()->user()->user_image }}";
        </script>
        @endauth
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.toast').forEach(function(toastEl) {
                    const toast = new bootstrap.Toast(toastEl);
                    toast.show();
                });
            });

            function confirmLogout(event) {
                event.preventDefault();

                Swal.fire({
                    title: "Are you sure?",
                    text: "You are about to log out.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#aaa",
                    confirmButtonText: "Logout",
                    cancelButtonText: "Cancel",
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById("logout-form").submit();
                    }
                });
            }
        </script>
    </header>
    <main class=" col-12" style="padding-right:15px;padding-left:15px">
        @yield('content')
    </main>
    @yield('scripts')
    <!-- Bootstrap JS Bundle -->
    <!-- Include jQuery (required for DataTables) and DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @auth
    <script src="{{ url('assets/js/user.js') }}"></script>
    <script src="{{ url('assets/js/activity_logs.js') }}"></script>
    @endauth


</body>

</html>