@extends('layouts.app')

@section('title', 'matrix Loan Matching')

@section('content')
<!-- Main content starts here -->
<div class="row px-0">
    <div style="background: linear-gradient(90deg, #4a3f9a 0%, #d15de8 100%); border-top-left-radius: 15px;border-top-right-radius: 15px;height:76px" class="header">
        <h5 style="color: white; margin: 0; padding: 1rem;font-size:25px;font-weight:600;">Lender List</h5>
    </div>
    <div class="panel ai-loan-matching  shadow-sm" style="padding: 0; margin: 0;overflow-x: auto; width: 100%;">

        <!-- Left Panel -->
        <div class="col-lg-12 mb-4 ">


            <!-- <hr> -->
            <table id="lenderTable" class="table table-striped p-1">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Lender Name</th>
                        <th>Lender Logo</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Website</th>
                        <th>Products</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <!-- </div> -->
    </div>
    <!-- Lender Modal (Main List) -->
    <!-- Lender Modal (Background) -->
    <div class="modal fade" id="lenderModal" tabindex="-1" aria-labelledby="lenderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" style="max-height: 90vh;">
            <div class="modal-content" style="border: 3px solid #d8b4fe; z-index: 1050; min-height: 90vh;">
                <div class="modal-header">
                    <h5 class="modal-title" id="lenderModalLabel">Lender Products</h5>
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

    <!-- Lender Detail Modal (Overlay) -->
    <div id="lenderDetailModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" style="max-height: 90vh;">
            <div class="modal-content p-4 modal-body" style="z-index: 1060; border: 2px solid #ddd; min-height: 90vh;">

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center">
                        <img id="modalLenderLogo" src="" alt="Lender Logo" style="height: 80px;" class="me-3" />
                    </div>
                    <div class="mb-4 ml-4">
                        <p>
                            <a id="modalurl" href="#" target="_blank" style="text-decoration: none; cursor: pointer;">
                                <i class="fas fa-globe" style="color: #852aa3; font-size: 20px;"></i>
                                <span id="modalwebsite" style="color: black;"></span>
                            </a>
                        </p>
                        <p class="mb-1"><i class="fas fa-mobile" style="color: #852aa3; font-size: 20px;"></i> <span id="modalPhone"></span></p>
                        <p class="mb-0"><i class="fas fa-envelope" style="color: #852aa3; font-size: 20px;"></i> <span id="modalEmail"></span></p>
                    </div>
                </div>

                <hr />

                <!-- Sub-product list will be injected into this container -->
                <div id="loanProductsContainer" class="row g-4 mb-3"></div>

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
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" style="max-height: 90vh;">
            <div class="modal-content p-4 modal-body" style="z-index: 1060; border: 2px solid #ddd; min-height: 90vh;">

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center">
                        <img id="LenderLogo" src="" alt="Lender Logo" style="height: 80px;" class="me-3" />
                    </div>
                    <div class="mb-4 ml-4">
                        <p>
                            <a id="contactmodalurl" href="#" target="_blank" style="text-decoration: none; cursor: pointer;">
                                <i class="fas fa-globe" style="color: #852aa3; font-size: 20px;"></i>
                                <span id="contactmodalwebsite" style="color: black;"></span>
                            </a>
                        </p>
                        <p class="mb-1"><i class="fas fa-mobile" style="color: #852aa3; font-size: 20px;"></i> <span id="phone"></span></p>
                        <p class="mb-0"><i class="fas fa-envelope" style="color: #852aa3; font-size: 20px;"></i> <span id="email"></span></p>
                    </div>
                </div>

                <hr />

                <!-- Contacts Table -->
                <div style="overflow-x: auto;">
                    <h4 style="color:#852aa3;font-size:25px;font-weight: bold;font-family:'Times New Roman', Times, serif;
                      unicode-bidi: isolate;">
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
<script src="{{ url('assets/js/lender.js') }}"></script>


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