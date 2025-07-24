@extends('layouts.app')

@section('title', 'matrix Loan Matching')

@section('content')
<!-- Main content starts here -->
<div class="row gx-4">
    <!-- Left Panel -->
    <div class="col-lg-2 mb-4">
    </div>
    <div class="col-lg-8 mb-4">
        <div class="panel ai-loan-matching p-4 rounded-3 shadow-sm">
            <div class="multi-step-form">
                <form method="POST" action="{{ url('/save_data') }}" id="lender_form" class="car-bike-boat-form">
                    @csrf
                    <div class=" col-12 step  active" data-step="1">
                        <div class="row">
                            <h5 class="text-center">Client Details</h5>
                            <hr>

                            <div class="col-md-6 mb-3 ">
                                <label for="company_name" class="form-label">Company Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"> <i class="fas fa-building"></i></span>
                                    <input type="text" id="company_name" name="company_name" class="form-control" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_company_name">Please enter valid Name.</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="director_name" class="form-label">Director Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                    <input type="text" id="director_name" name="director_name" class="form-control" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_director_name">Please enter valid Name.</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="director_email" class="form-label">Director Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="text" id="director_email"   name="director_email" class="form-control" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_director_email">Please enter valid email.</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="director_phone" class="form-label">Director Phone</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                    <input type="text" id="director_phone"   name="director_phone" class="form-control" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_director_phone">Please enter valid Phone.</p>
                            </div>

                            <!-- <hr class="mt-3"> -->

                            <h5 class="text-center mt-3">Loan Details</h5>
                            <hr class="mt-3">

                            <div class="col-md-6 mb-3 loan-details">
                                <label for="loan_amt" class="form-label">Loan Amount Needed</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" id="loan_amt" name="loan_amt"   class="form-control" aria-label="Loan Amount Needed" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_loan_amt">Please enter valid Loan amount.</p>
                            </div>
                            <div class="col-md-6 mb-3 loan-details">
                                <label for="monthly_revenue" class="form-label"> Monthly Revenue</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" id="monthly_revenue"   name="monthly_revenue" class="form-control" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_monthly_revenue">Please enter valid monthly revenue.</p>

                            </div>
                            <div class="col-md-6 mb-3 loan-details">
                                <label for="time_in_business" class="form-label">Time in Business (Months)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                                    <input type="text" id="time_in_business" name="time_in_business" class="form-control" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_time_in_business">Please enter valid Time.</p>

                            </div>
                            <div class="col-md-6 mb-3 loan-details">
                                <label for="credit_score" class="form-label">Company Credit Score</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-credit-card"></i></span>
                                    <input type="text" id="credit_score" name="credit_score" class="form-control" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_credit_score">Please enter valid credit score.</p>

                            </div>
                            <div class="col-md-6 mb-3 loan-details">
                                <label for="negative_days" class="form-label">Days in negative (in last 6 months)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                                    <input type="text" id="negative_days" name="negative_days" class="form-control" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_negative_days">Please enter valid negative days.</p>
                            </div>
                            <div class="col-md-6 mb-3 loan-details">
                                <label for="number_of_dishonours" class="form-label">Number of Dishonours</label>
                                <div class="input-group">

                                    <input type="text" id="number_of_dishonours" name="number_of_dishonours"   class="form-control" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_number_of_dishonours">Please enter valid number of dushonours</p>

                            </div>
                            <div class="col-md-6 mb-3 loan-details">
                                <label for="asset_backed" class="form-label">Is your loan secured by any assets?</label>
                                <select id="asset_backed" name="asset_backed" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                                <p class="text-danger d-none" id="invalid_asset_backed">Please select valid option.</p>
                            </div>
                            <textarea type="text" id="applicable_lenders" cols="20" rows="20" name="applicable_lenders" class="form-control d-none" required></textarea>
                        </div>
                    </div>

            </div>

            <div class="loan-navigation d-flex justify-content-between align-items-center mt-4">
                <!-- <button type="button" class="btn btn-warning btn-arrow   btn-prev-global me-2" style="height: 40px;width:61px">
                    <span style="color: white;"> Back</span>
                </button> -->

                <div class="loan-info d-flex gap-2">

                </div>
                <button type="submit" class="btn btn-warning btn-arrow  btn-next-global" style="height: 40px;width:80px">
                    <span id="next-btn" style="color: white;">Submit</span>
                </button>
            </div>
            </form>
        </div>
    </div>
    <div class="col-lg-2 mb-4">
    </div>

    <!-- Right Panel -->
    <!-- <div class="col-lg-6 mb-4">
        <div class="panel ebroker-lender-panel p-4 rounded-3 shadow-sm position-sticky" style="top: 72px; z-index: 1000;border: 3px solid #d8b4fe">
            <div class="panel-header text-center mb-3">
                <span class="badge bg-gradient-ebroker px-3 py-1 rounded-pill fw-semibold">LENDERS PANEL</span>
            </div>
            <div class="lender-cards row g-3 position-sticky" style="top: 90px; z-index: 1000;">
                <div id="loader" class="text-center my-4" style="display: none;">
                    <img src="{{ asset('assets/images/loader.gif') }}" alt="Loading...">
                </div>
             </div>
            <div class="comparison-note text-center small text-white   rounded-2 py-1" style="margin-top:30px">
                Comparison Rates &amp; Repayments Include Fees &amp; Charges
            </div>
        </div>
    </div> -->



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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toast').forEach(function(toastEl) {
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        });
    });
</script>

<!-- Odometer JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/odometer.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- <script src="{{ asset('assets/js/index.js') }}"></script> -->
<script src="{{ url('assets/js/index.js') }}"></script>
<!-- Main content ends here -->
@endsection