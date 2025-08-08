@extends('layouts.app')

@section('title', 'matrix Loan Matching')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Main content starts here -->
<div class="row px-0">

    <div
        class="header d-flex justify-content-center align-items-center"
        style="height: 76px; background: linear-gradient(90deg, #4a3f9a 0%, #d15de8 100%); text-align: center;">
        <h3 class="text-white m-0">Submission History</h3>
    </div>

    <div class="panel ai-loan-matching  shadow-sm" style="padding: 0; margin: 0;overflow-x: auto; width: 100%;">

        <!-- Left Panel -->
        <div class="col-lg-12 mb-4 p-4 " style="background-color: #dedede;min-width:1500px;margin-left:auto;margin-right:auto">

            <div style="height:76px;" class="header d-flex align-items-center ml-4">
                <h3 class="m-2" style="color:rgb(48 30 119);font-weight:600">Members</h3>
                <a href="{{ url('/index') }}"><button style="border: none; background-color: rgb(86 66 161); width: 100px; height: 41px;" class="m-5 rounded border-none text-white p-1">
                        <small>Add new</small>
                    </button></a>
                <div id="customSearchWrapper" style="max-width: 500px; width: 100%;"></div>

                <button style="border: none; background-color: rgb(86 66 161); width: 100px; height: 41px; margin-left:auto" class="  rounded border-none text-white p-1">
                    <small style="color: white;">
                        < &nbsp;Filter</small>
                </button>
            </div>


            <!-- <hr> -->
            <table id="lenderTable" class="table p-1 " style="table-layout: fixed;font-family:sans-serif;background-color:white">
                <thead>
                    <tr>
                        <!-- <th>Sr.No</th> -->
                        <th> Date</th>
                        <th> Name</th>
                        <th>Business Name</th>
                        <th> Email</th>
                        <th> Phone</th>
                        <th>Loan Amount </th>
                        <th>status</th>
                        <th>Actions</th>
                        <th>Lenders</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <!-- </div> -->
    </div>

    <div class="modal fade" id="lenderModal" tabindex="-1" aria-labelledby="lenderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered"
            style="width: 97%; max-width: 1600px; z-index: 1050;">
            <div class="modal-content" style="min-height: 90vh;">
                <div class="modal-header">
                    <h5 class="modal-title" id="lenderModalLabel">Applicable Lenders</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="panel ebroker-lender-panel p-4 rounded-3 shadow-sm">
                        <div class="lender-cards row g-3" id="applicableLenderCards">
                            <div id="loader" class="text-center my-4" style="display: none;">
                                <img src="{{ asset('assets/images/loader.gif') }}" alt="Loading...">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">

                    <button type="button" class="btn text-white" data-bs-dismiss="modal" style="background: linear-gradient(90deg, #4a3f9a 0%, #d15de8 100%);">Close</button>
                </div>

            </div>
        </div>
    </div>

    <div id="lenderDetailModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered"
            style="width: 90%; max-width: 1500px; z-index: 1060;">
            <div class="modal-content" style="min-height: 80vh !important; margin-top: 2vh !important;padding:29px;max-height: 85vh;box-shadow: 0 0 15px rgba(133, 42, 163, 0.9);">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-1" data-bs-dismiss="modal" aria-label="Close"></button>
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center position-relative" style="height: 80px; width: 80px;">
                        <!-- Loader (shown initially) -->
                        <span id="logoLoader" class="" role="status" style="width: 2rem; height: 2rem;">
                            <i class="fas fa-spinner fa-spin" style="font-size: 24px;"></i>
                        </span>

                        <!-- Lender Logo (hidden initially) -->
                        <img id="modalLenderLogo" src="" alt="Lender Logo"
                            style="height: 80px; width: auto; display: none;" class="me-3" />
                    </div>

                    <div class="mb-4 ml-4">
                        <p>
                            <a id="modalurl" href="#" target="_blank" style="text-decoration: none; cursor: pointer;">
                                <i class="fas fa-globe" style="color: #852aa3; font-size: 20px;"></i>
                                <span id="modalwebsite" style="color: black;">
                                    <i class="fas fa-spinner fa-spin" style="font-size: 14px;"></i>
                                </span>
                            </a>
                        </p>
                        <p class="mb-1">
                            <i class="fas fa-mobile" style="color: #852aa3; font-size: 20px;"></i>
                            <span id="modalPhone">
                                <i class="fas fa-spinner fa-spin" style="font-size: 14px;"></i>
                            </span>
                        </p>
                        <p class="mb-0">
                            <i class="fas fa-envelope" style="color: #852aa3; font-size: 20px;"></i>
                            <span id="modalEmail">
                                <i class="fas fa-spinner fa-spin" style="font-size: 14px;"></i>
                            </span>
                        </p>

                    </div>
                </div>

                <hr />

                <!-- Sub-product list will be injected into this container -->
                <div id="loanProductsContainer" style="overflow-y: auto;padding-left: 15px;padding-right:15px" class="row g-4 mb-3">

                </div>

                <!-- View Contacts Button -->
                <button type="button" id="lendercontactbuton" class="text-white m-3 view-lender-contacts-btn"
                    style="background: linear-gradient(90deg, #4a3f9a 0%, #d15de8 100%); border-radius: 20px; border: none; width: 185px; height: 28px; font-weight: 600;">
                    View Lender Contacts
                </button>

                <!-- Footer -->
                <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-outline-secondary text-white m-1" data-bs-dismiss="modal"
                        style="background: linear-gradient(90deg, #4a3f9a 0%, #d15de8 100%);">
                        ← Back to Lenders
                    </button>
                </div>
            </div>
        </div>
    </div>



    <div id="lenderContactModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered"
            style="width: 85%; max-width: 1400px;; z-index: 1070;">
            <div class="modal-content" style="min-height: 70vh !important; margin-top: 4vh !important;padding:30px;max-height: 78vh;box-shadow: 0 0 15px rgba(133, 42, 163, 0.9);margin-left: 18px;">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-1" data-bs-dismiss="modal" aria-label="Close"></button>
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center position-relative" style="height: 80px; width: 80px;">
                        <!-- Loader (shown initially) -->
                        <span id="logoLoader2" class="" role="status" style="width: 2rem; height: 2rem;">
                            <i class="fas fa-spinner fa-spin" style="font-size: 24px;"></i>
                        </span>

                        <!-- Lender Logo (hidden initially) -->
                        <img id="modalLenderLogo2" src="" alt="Lender Logo"
                            style="height: 60px; width: auto; display: none;" class="me-3" />
                    </div>
                    <div class="mb-4 ml-4">


                        <p>
                            <a id="contactmodalurl" href="#" target="_blank" style="text-decoration: none; cursor: pointer;">
                                <i class="fas fa-globe" style="color: #852aa3; font-size: 20px;"></i>
                                <span id="contactmodalwebsite" style="color: black;">
                                    <i class="fas fa-spinner fa-spin" style="font-size: 14px;"></i>
                                </span>
                            </a>
                        </p>
                        <p class="mb-1">
                            <i class="fas fa-mobile" style="color: #852aa3; font-size: 20px;"></i>
                            <span id="phone">
                                <i class="fas fa-spinner fa-spin" style="font-size: 14px;"></i>
                            </span>
                        </p>
                        <p class="mb-0">
                            <i class="fas fa-envelope" style="color: #852aa3; font-size: 20px;"></i>
                            <span id="email">
                                <i class="fas fa-spinner fa-spin" style="font-size: 14px;"></i>
                            </span>
                        </p>
                    </div>
                </div>

                <hr />

                <!-- Contacts Table -->
                <div style="overflow-x: auto;">
                    <h4 style="color:#852aa3;font-size:25px;font-weight: bold; ">
                        BDM Contacts
                    </h4>
                    <table id="lenderContactTable" class="contact-table">

                        <!-- Dynamic contact rows will be injected here -->
                    </table>
                </div>

                <!-- Footer -->
                <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-outline-secondary text-white m-1" data-bs-dismiss="modal"
                        style="background: linear-gradient(90deg, #4a3f9a 0%, #d15de8 100%);">
                        ← Back to Lenders
                    </button>
                </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toast').forEach(function(toastEl) {
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        });
    });
</script>


<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/odometer.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<!-- <script src="{{ asset('assets/js/index.js') }}"></script> -->
<!-- <script src="{{ asset('assets/js/customer.js') }}"></script> -->
<script src="{{ url('assets/js/customer.js') }}"></script>


<!-- Include jQuery (required for DataTables) and DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- JSZip for Excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>


<!-- Main content ends here -->
@endsection