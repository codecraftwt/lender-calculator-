@extends('layouts.app')

@section('title', 'matrix Loan Matching')

@section('content')
<!-- Main content starts here -->
<div class="row gx-4">
    <!-- Left Panel -->
    <div class="col-lg-2 mb-4"></div>
    <div class="col-lg-8 mb-4">
        <div class="panel ai-loan-matching shadow-sm">

            <div class="multi-step-form " style="margin: 0; padding:0;box-shadow: 5px 5px 5px 2px #878787;">
                <div class="header" style="height:62px">
                    <h5 style="border-bottom: none;color:white">Client Loan Eligibility Form</h5>
                </div>
                <form method="POST" action="{{ url('/save_data') }}" id="lender_form" class="car-bike-boat-form p-4">
                    @csrf
                    <div class="col-12 step active" data-step="1">
                        <div class="row">
                            <h5 class="text-center section-title">Client Details</h5>

                            <div class="col-md-6 mb-3">
                                <label for="company_name" class="form-label">Company Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-building"></i></span>
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
                                    <input type="text" id="director_email" name="director_email" class="form-control" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_director_email">Please enter valid email.</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="director_phone" class="form-label">Director Phone</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                    <input type="text" id="director_phone" name="director_phone" class="form-control" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_director_phone">Please enter valid Phone.</p>
                            </div>

                            <h5 class="text-center mt-3">Loan Details</h5>

                            <div class="col-md-6 mb-3 loan-details">
                                <label for="abn_gst" class="form-label">Do you have ABN/GST registration?</label>
                                <select id="abn_gst" name="abn_gst" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                                <p class="text-danger d-none" id="invalid_abn_gst">Please select valid option.</p>
                            </div>

                            <div class="col-md-6 mb-3 loan-details">
                                <label for="loan_amt" class="form-label">Loan Amount Needed</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" id="loan_amt" name="loan_amt" class="form-control" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_loan_amt">Please enter valid Loan amount.</p>
                            </div>

                            <div class="col-md-6 mb-3 loan-details">
                                <label for="monthly_revenue" class="form-label">Monthly Revenue</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" id="monthly_revenue" name="monthly_revenue" class="form-control" required>
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
                                    <input type="text" id="number_of_dishonours" name="number_of_dishonours" class="form-control" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_number_of_dishonours">Please enter valid number of dishonours</p>
                            </div>



                            <textarea type="text" id="applicable_lenders" cols="20" rows="20" name="applicable_lenders" class="form-control visually-hidden" required></textarea>
                        </div>
                    </div>

                    <div class="loan-navigation d-flex justify-content-between align-items-center mt-4 p-4">
                        <div class="loan-info d-flex gap-2"></div>
                        <button type="submit" class="btn btn-submit btn-next-global">
                            <span id="next-btn">Submit</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-2 mb-4"></div>
</div>

<!-- Internal CSS -->



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

<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

<!-- <script src="{{ asset('assets/js/index.js') }}"></script> -->
<script src="{{ url('assets/js/index.js') }}"></script>
<!-- Main content ends here -->
@endsection