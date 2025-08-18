@extends('layouts.app')

@section('title', 'matrix Loan Matching')

@section('content')
<style>
    .select2-container {
        z-index: 9999 !important;
    }

    .select2-dropdown {
        z-index: 9999 !important;
    }
</style>

<div class="row px-0">
    <div style="background: linear-gradient(90deg, #4a3f9a 0%, #d15de8 100%); border-top-left-radius: 15px;border-top-right-radius: 15px;height:76px" class="header">
        <h5 style="color: white; margin: 0; padding: 1rem;font-size:25px;font-weight:600;">User List</h5>
    </div>
    <div class="panel ai-loan-matching  shadow-sm" style="padding: 0; margin: 0;overflow-x: auto; width: 100%;">
        <div class="col-lg-12 mb-4 p-4 " style="background-color: #dedede;min-width:1500px;margin-left:auto;margin-right:auto">
            <div style="height:76px;" class="header d-flex align-items-center ml-4">
                <h3 class="m-2" style="color:rgb(48 30 119);font-weight:600">Users</h3>
                @if(auth()->check() && auth()->user()->role === 'Admin')
                <a href="{{ url('/add-user') }}" style="text-decoration: none;" class="text-white"><button style="border: none; background-color: rgb(86 66 161); width: 180px; height: 41px;" class="m-5 rounded border-none text-white p-1 add-new-lender-btn">
                        <small><i class="fas fa-plus"></i> Add New</small></a>
                </button>
                @endif
                <div id="customSearchWrapper" style="max-width: 500px; width: 100%;"></div>
                <button style="border: none; background-color: rgb(86 66 161); width: 100px; height: 41px; margin-left:auto" class="  rounded border-none text-white p-1">
                    <small style="color: white;">
                        <i class="fas fa-filter"></i> Filter</small>
                </button>
            </div>
            <table id="userTable" class="table  p-1">
                <thead>
                    <tr>

                        <th> Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        @if(auth()->check() && auth()->user()->role === 'Admin')
                        <th>status</th>
                        <th>action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Lender Products Modal  -->
    <div id="User_Edit_Modal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" style="width: 100%; max-width: 1200px; z-index: 2050;">
            <div class="modal-content" style="min-height: 80vh !important;padding:20px;max-height: 80vh;box-shadow: 0 0 15px rgba(133, 42, 163, 0.9);">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>

                <div class="container">
                    <h4 class="text-center">Edit User Details</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <form id="user_detail_edit_form" method="POST" action="{{ url('/update-user-data') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-4 mb-3 visually-hidden">
                                        <input type="text" id="user_id" name="user_id" readonly class="form-control" autocomplete="off" />
                                    </div>
                                    <div class="col-md-6 mb-3  ">
                                        <label for="name" class="form-label">Name</label>
                                        <div class="input-group">
                                            <input type="text" id="name" name="name" class="form-control" autocomplete="off" />
                                        </div>
                                        <p class="text-danger d-none" id="invalid_name">Please enter valid name.</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-group">
                                            <input type="text" id="email" name="email" class="form-control" autocomplete="off" />
                                        </div>
                                        <p class="text-danger d-none" id="invalid_email">Please enter valid email.</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="role" class="form-label">Role </label>
                                        <select id="role" name="role" class="form-control" required>
                                            <option value="">Select</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Broker">Broker</option>
                                        </select>
                                        <p class="text-danger d-none" id="invalid_role">Please select valid option.</p>
                                    </div>



                                    <div class="col-md-6 mb-3">
                                        <button type="submit" class="btn btn-success m-5 user-details-submit-btn" style="background-color:rgb(86 66 161);;border:none">
                                            Save Changes
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


        @php
        $baseImageUrl = "{{ url('assets/images') }}";
        $base_product_guide_url = "{{ url('assets/product-guides') }}";
        @endphp

        <script>
            const baseImageUrl = "{{ url('assets/images') }}";
            const base_product_guide_url = "{{ url('assets/product_guide') }}";
        </script>
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


        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/odometer.min.js"></script>
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- Include jQuery (required for DataTables) and DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="{{ url('assets/js/user.js') }}"></script>


        <!-- JSZip for Excel -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <!-- Main content ends here -->
        @endsection