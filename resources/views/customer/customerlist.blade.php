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
                <h3 class="m-2" style="color:rgb(48 30 119);font-weight:600">Clients</h3>
                <a href="{{ url('/index') }}"><button style="border: none; background-color: rgb(86 66 161); width: 180px; height: 41px;" class="m-5 rounded border-none text-white p-1">
                        <small><i class="fas fa-plus"></i> Add New</small>
                    </button></a>
                <div id="customSearchWrapper" style="max-width: 500px; width: 100%;"></div>

                <button id="filterToggleBtn" style="border: none; background-color: rgb(86 66 161); width: 100px; height: 41px; margin-left:auto" class="  rounded border-none text-white p-1">
                    <small style="color: white;">
                        <i class="fas fa-filter"></i> Filter</small>
                </button>
            </div>


            <!-- <hr> -->
            <table id="lenderTable" class="table p-1 " style="table-layout: fixed;font-family:sans-serif;background-color:white">
                <thead>
                    <tr id="filterRow" class="d-none">
                        <th>
                            <label for="">Select Date From</label>
                            <input type="date" id="start_date" name="start_date" class="form-control" style="border-radius: 0.375rem !important">
                        </th>
                        <th>
                            <label for="">Select Date To</label>
                            <input type="date" id="end_date" name="end_date" class="form-control" style="border-radius: 0.375rem !important">
                        </th>
                        <th>
                            <label for="">Select Loan Amount</label>
                            <select name="" id="" class="form-control">
                                <option value="">Select</option>
                                <option value="0-20000">Upto $20,000</option>

                                <option value="20001-50000">$20,001 - $50,000</option>
                                <option value="50001-100000">$50,001 - $100,000</option>
                                <option value="100001-500000">$100,001 - $500,000</option>
                                <option value="500001-1000000">$500,001 - $1,000,000</option>
                                <option value="1000000-10000000">Above $1,000,000</option>
                            </select>
                        </th>

                        <th>
                            <label for="">Select Lender</label>
                            <select name="" id="" class="form-control">
                                <option value="">Select</option>
                                <option value="">Upto $20,000</option>
                            </select>
                        </th>
                        <th><label for="">Select status</label>
                            <select name="" id="" class="form-control">
                                <option value="">Select</option>
                                <option value="0">Initial</option>
                                <option value="3">Setteled</option>
                                <option value="1">Submitted</option>
                                <option value="2">In-progress</option>
                            </select>
                        </th>
                        <th> </th>
                        <th> </th>
                    </tr>
                    <tr>
                        <th> Date</th>
                        <th> Client Name</th>
                        <th>Business Name</th>
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


                        </div>
                        <div id="MainModalloader" class="text-center my-4" style="display: none;">
                            <img src="{{ asset('assets/images/obi-loader.gif') }}" alt="Loading..." style="height: 200px;">
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
            style="width: 97%; max-width: 1600px; z-index: 1060;">
            <div class="modal-content p-5" style="min-height: 90vh;">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-1" data-bs-dismiss="modal" aria-label="Close"></button>
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4 d-flex justify-content-center align-items-center h-100">
                                <div class="d-flex align-items-center position-relative" style="height: 80px; width: 80px;">
                                    <!-- Loader (shown initially) -->
                                    <span id="product_modal_lender_logo_spinner" class="" role="status" style="width: 2rem; height: 2rem;">
                                        <img src="{{ asset('assets/images/obi-loader.gif') }}" alt="Loading..." style="height: 50px;">
                                    </span>

                                    <!-- Lender Logo (hidden initially) -->
                                    <img id="modalLenderLogo" src="" alt="Lender Logo"
                                        style="height: 80px; width: auto; display: none;" class="me-3" />
                                </div>
                            </div>
                            <div class="col-md-4 d-flex justify-content-center align-items-center h-100">
                                <div style="display: flex;" class="mt-3">
                                    <p>
                                        <a id="modalurl" href="#" target="_blank" style="text-decoration: none; cursor: pointer;">
                                            <i class="fas fa-globe" style="color: #852aa3; font-size: 20px;"></i>
                                            <span id="modalwebsite" style="color: black;">
                                                <i class="fas fa-spinner fa-spin" style="font-size: 14px;"></i>
                                            </span>
                                        </a>
                                    </p>
                                    &nbsp; &nbsp; &nbsp;
                                    <p class="mb-1">
                                        <i class="fas fa-mobile" style="color: #852aa3; font-size: 20px;"></i>
                                        <span id="modalPhone">
                                            <i class="fas fa-spinner fa-spin" style="font-size: 14px;"></i>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4   justify-content-center align-items-center h-100">
                                <p class="mb-0 " style="margin-left: 17px;">
                                    <i class="fas fa-envelope" style="color: #852aa3; font-size: 20px;"></i>
                                    <span id="modalEmail">
                                        <i class="fas fa-spinner fa-spin" style="font-size: 14px;"></i>
                                    </span>
                                </p>

                                <button type="button" id="lendercontactbuton" class="text-white m-3 view-lender-contacts-btn"
                                    style="background: linear-gradient(90deg, #4a3f9a 0%, #d15de8 100%); border-radius: 20px; border: none; width: 185px; height: 28px; font-weight: 600;" data-lender-id="">
                                    View Lender Contacts
                                </button>
                            </div>


                            <!-- <div class="mb-4">



                            </div> -->
                        </div>
                    </div>
                </div>

                <hr />

                <!-- Sub-product list will be injected into this container -->
                <div id="loanProductsContainer" style="overflow-y: auto;padding-left: 15px;padding-right:15px" class="row g-4 mb-3">

                </div>

                <div id="ProductModalloader" class="text-center my-4" style="display: none;">
                    <img src="{{ asset('assets/images/obi-loader.gif') }}" alt="Loading..." style="height: 200px;">
                </div>

                <!-- View Contacts Button -->


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
            style="width: 97%; max-width: 1600px; z-index: 1060;">
            <div class="modal-content p-5" style="min-height: 90vh;">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-1" data-bs-dismiss="modal" aria-label="Close"></button>
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-start mb-3">

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4 d-flex justify-content-center align-items-center h-100">
                                <div class="d-flex align-items-center position-relative" style="height: 80px; width: 80px;">
                                    <!-- Loader (shown initially) -->
                                    <span id="logoLoader2" class="" role="status" style="width: 2rem; height: 2rem;">
                                        <img src="{{ asset('assets/images/obi-loader.gif') }}" alt="Loading...">
                                    </span>

                                    <!-- Lender Logo (hidden initially) -->
                                    <img id="modalLenderLogo2" src="" alt="Lender Logo"
                                        style="height: 80px; width: auto; display: none;" class="me-3" />
                                </div>
                            </div>
                            <div class="col-md-4 d-flex justify-content-center align-items-center h-100">
                                <div style="display: flex;" class="mt-5">
                                    <p>
                                        <a id="contactmodalurl" href="#" target="_blank" style="text-decoration: none; cursor: pointer;">
                                            <i class="fas fa-globe" style="color: #852aa3; font-size: 20px;"></i>
                                            <span id="contactmodalwebsite" style="color: black;">
                                                <i class="fas fa-spinner fa-spin" style="font-size: 14px;"></i>
                                            </span>
                                        </a>
                                    </p>
                                    &nbsp;&nbsp;
                                    <p class="mb-1">
                                        <i class="fas fa-mobile" style="color: #852aa3; font-size: 20px;"></i>
                                        <span id="phone">
                                            <i class="fas fa-spinner fa-spin" style="font-size: 14px;"></i>
                                        </span>
                                    </p>

                                </div>
                            </div>





                        </div>
                    </div>

                </div>

                <hr />


                <div class="container mt-3" id="contacts_container" style="max-width: 600px;overflow-y:auto">

                    <div id="ContactModalloader" class="text-center my-4" style="display: none;">
                        <img src="{{ asset('assets/images/obi-loader.gif') }}" alt="Loading..." style="height: 200px;">
                    </div>
                    <div class="bg-purple p-2 text-white fw-bold d-flex justify-content-between align-items-center" style="background-color:#6a4b8c;">
                        <span>CONTACTS</span>
                        <input type="search" class="form-control form-control-sm" name="search_contact" id="search_contact" style="width: 200px;" placeholder="Search" data-lender-id="">
                        <div class="visually-hidden" id="loader" style="display:none;">Loading...</div>
                        <div class="visually-hidden" id="results"></div>

                    </div>

                    <div class="accordion mt-2" id="contactsAccordion">

                        <!-- New South Wales -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingNSW" class="headingNSW">

                            </h2>
                            <div id="collapseNSW" class="accordion-collapse collapse collapseNSW" aria-labelledby="headingNSW" data-bs-parent="#contactsAccordion">



                            </div>
                        </div>

                        <div class="accordion mt-2" id="contactsAccordion"></div>


                    </div>

                </div>
                <div id="ContactdetailsModalloader" class="text-center my-4" style="display: none;">
                    <img src="{{ asset('assets/images/obi-loader.gif') }}" alt="Loading..." style="height: 200px;">
                </div>

                <!-- Footer -->

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