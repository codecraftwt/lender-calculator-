@extends('layouts.app')

@section('title', 'matrix Loan Matching')

@section('content')
<!-- Main content starts here -->
@foreach ($data as $customer )
@endforeach
<div class="row gx-4">
    <!-- Left Panel -->
    <div class="col-lg-2 mb-4"></div>
    <div class="col-lg-8 mb-4">
        <div class="panel ai-loan-matching shadow-sm" style="border-radius:20px;margin-top: 20px;">

            <div class="multi-step-form " style="margin: 0; padding:0;box-shadow: 5px 5px 5px 2px #878787;">
                <div class="header" style="height:62px">
                    <h5 style="border-bottom: none;color:white">Client Loan Eligibility Form</h5>
                </div>
                <form method="POST" action="{{ url('/update-customer') }}" id="lender_form" class="car-bike-boat-form p-4">
                    @csrf
                    <div class="col-12 step active" data-step="1">
                        <div class="row">
                            <h5 class="text-center section-title">Client Details</h5>
                            <hr>

                            <div class="col-md-6 mb-3">
                                <label for="company_name" class="form-label">Company Name</label>
                                <div class="input-group">
                                    <input type="text" id="company_name" name="company_name" class="form-control" value="{{ $customer['company_name'] }}" autocomplete="off" />
                                </div>
                                <div id="company_list" class="list-group mt-1" style="min-height: 40px;"></div>
                                <p class="text-danger d-none" id="invalid_company_name">Please enter valid Name.</p>
                            </div>



                            <div class="col-md-6 mb-3">
                                <label for="director_name" class="form-label">Director Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                    <input type="text" id="director_name" name="director_name" class="form-control" value="{{ $customer['director_name'] }}" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_director_name">Please enter valid Name.</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="director_email" class="form-label">Director Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="text" id="director_email" name="director_email" value="{{ $customer['director_email'] }}" class="form-control" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_director_email">Please enter valid email.</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="director_phone" class="form-label">Director Phone</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                    <input type="text" id="director_phone" name="director_phone" value="{{ $customer['director_phone'] }}" class="form-control" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_director_phone">Please enter valid Phone.</p>
                            </div>

                            <h5 class="text-center mt-3">Loan Details</h5>
                            <hr>

                            <div class="col-md-6 mb-3 loan-details">
                                <label for="abn_date" class="form-label">Date of ABN registration</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                                    <input type="date" id="abn_date" name="abn_date" value="{{ $customer['abn_date'] }}" class="form-control" required readonly>
                                </div>
                                <p class="text-danger d-none" id="invalid_abn_date">Please enter valid monthly revenue.</p>
                            </div>

                            <div class="col-md-6 mb-3 loan-details">
                                <label for="time_in_business" class="form-label">Time in Business (Months)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                                    <input type="text" id="time_in_business" name="time_in_business" value="{{ $customer['time_in_business'] }}" class="form-control" required readonly>
                                </div>
                                <p class="text-danger d-none" id="invalid_time_in_business">Please enter valid Time.</p>
                            </div>

                            <div class="col-md-6 mb-3 loan-details">
                                <label for="abn_gst" class="form-label">Do you have GST registration?</label>
                                <!-- <select id="abn_gst" name="abn_gst" class="form-control" required disabled>
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select> -->
                                <input type="text" id="abn_gst" name="abn_gst" value="{{ $customer['GST_registration'] }}" class="form-control" readonly>
                                <p class="text-danger d-none" id="invalid_abn_gst">Please select valid option.</p>
                            </div>

                            <div class="col-md-6 mb-3 loan-details">
                                <label for="gst_date" class="form-label">Date of GST registration</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                                    <input type="date" id="gst_date" name="gst_date" value="{{ $customer['gst_date'] }}" class="form-control" readonly>
                                </div>
                                <p class="text-danger d-none" id="invalid_gst_date">Please enter valid monthly revenue.</p>
                            </div>
                            <div class="col-md-6 mb-3 loan-details">
                                <label for="gst_time" class="form-label">Time From GST Registation (Months)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                                    <input type="text" id="gst_time" name="gst_time" value="{{ $customer['gst_time'] }}" class="form-control" readonly>
                                </div>
                                <p class="text-danger d-none" id="invalid_gst_time">Please enter valid Time.</p>
                            </div>

                            <div class="col-md-6 mb-3 loan-details">
                                <label for="entity_type" class="form-label">Entity Type</label>
                                <input type="text" id="entity_type" name="entity_type" value="{{ $customer['entity_type'] }}" class="form-control" required readonly>

                                <p class="text-danger d-none" id="invalid_entity_type">Please select valid option.</p>
                            </div>

                            <div class="col-md-6 mb-3 loan-details">
                                <label for="loan_amt" class="form-label">Loan Amount Needed</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" id="loan_amt" name="loan_amt" value="{{ $customer['loan_amt_needed'] }}" class="form-control" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_loan_amt">Please enter valid Loan amount.</p>
                            </div>

                            <div class="col-md-6 mb-3 loan-details">
                                <label for="monthly_revenue" class="form-label">Monthly Revenue</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" id="monthly_revenue" name="monthly_revenue" value="{{ $customer['monthly_revenue'] }}" class="form-control" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_monthly_revenue">Please enter valid monthly revenue.</p>
                            </div>

                            <div class="col-md-6 mb-3 loan-details">
                                <label for="company_credit_score" class="form-label">Company Credit Score</label>
                                <select id="company_credit_score" name="company_credit_score" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="Excellent" {{ (isset($customer['company_credit_score']) && $customer['company_credit_score'] == 'Excellent') ? 'selected' : '' }}>Excellent (800+)</option>
                                    <option value="Very_Good" {{ (isset($customer['company_credit_score']) && trim($customer['company_credit_score']) == 'Very_Good') ? 'selected' : '' }}>Very Good (700-800)</option>
                                    <option value="Good" {{ (isset($customer['company_credit_score']) && $customer['company_credit_score'] == 'Good') ? 'selected' : '' }}>Good (500-700)</option>
                                    <option value="Fair" {{ (isset($customer['company_credit_score']) && $customer['company_credit_score'] == 'Fair') ? 'selected' : '' }}>Fair (300 - 500)</option>
                                    <option value="Low" {{ (isset($customer['company_credit_score']) && $customer['company_credit_score'] == 'Low') ? 'selected' : '' }}>Low (0-300)</option>
                                </select>
                                <p class="text-danger d-none" id="invalid_company_credit_score">Please select valid option.</p>
                            </div>



                            <div class="col-md-6 mb-3 loan-details">
                                <label for="credit_score" class="form-label">Actual Credit Score </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-credit-card"></i></span>
                                    <input type="text" id="credit_score" name="credit_score" value="{{ $customer['credit_score'] }}" class="form-control" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_credit_score">Please enter valid credit score.</p>
                            </div>

                            <div class="col-md-6 mb-3 loan-details">
                                <label for="property_owner" class="form-label">Are you a property owner? </label>
                                <select id="property_owner" name="property_owner" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="Yes" {{ (isset($customer['property_owner']) && $customer['property_owner'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ (isset($customer['property_owner']) && $customer['property_owner'] == 'No') ? 'selected' : '' }}>No</option>
                                </select>

                                <p class="text-danger d-none" id="invalid_property_owner">Please select valid option.</p>
                            </div>

                            <div class="col-md-6 mb-3 loan-details">
                                <label for="negative_days" class="form-label">Days in negative (in last 6 months)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                                    <input type="text" id="negative_days" name="negative_days" value="{{ $customer['negative_days'] }}" class="form-control" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_negative_days">Please enter valid negative days.</p>
                            </div>

                            <div class="col-md-6 mb-3 loan-details">
                                <label for="number_of_dishonours" class="form-label">Number of Dishonours</label>
                                <div class="input-group">
                                    <input type="text" id="number_of_dishonours" name="number_of_dishonours" value="{{ $customer['number_of_dishonours'] }}" class="form-control" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_number_of_dishonours">Please enter valid number of dishonours</p>
                            </div>
                            @php
                            $industries = [
                            "Accounting & Bookkeeping",
                            "Advertising & Marketing Services",
                            "Agriculture Equipment Supply & Services (not farms)",
                            "Architecture & Design",
                            "Automotive Repairs & Servicing",
                            "Business Consulting Services",
                            "Childcare Services",
                            "Cleaning & Sanitation Services",
                            "Construction Trades (e.g. Electrical, Plumbing, Carpentry)",
                            "Courier & Logistics (non-food/alcohol delivery)",
                            "Creative Services (Photography, Graphic Design, Copywriting)",
                            "Dental Clinics",
                            "Digital Marketing Agencies",
                            "E-commerce (Physical Products)",
                            "Education & Tutoring Services",
                            "Engineering Services",
                            "Event Services (excluding adult or gambling-related)",
                            "Financial & Mortgage Brokers",
                            "Fitness & Personal Training Studios (only if not flagged in your logic)",
                            "Florists",
                            "Food & Beverage – Cafés, Bakeries (excluding nightclubs, vape bars, etc.)",
                            "Freight & Logistics (non-high-risk categories)",
                            "Furniture Retail & Manufacturing",
                            "General Retail (Clothing, Electronics, Homewares)",
                            "Hairdressers & Barber Shops (as long as not flagged)",
                            "Health & Allied Services (Physiotherapists, Osteopaths, etc.)",
                            "HVAC Services (Heating, Ventilation & Air Conditioning)",
                            "Import/Export Agents (non-restricted goods)",
                            "Information Technology Services",
                            "Landscaping & Gardening Services",
                            "Legal Services (Sole Practitioner or Firm)",
                            "Manufacturing – Light/Consumer Goods",
                            "Mechanic & Auto Servicing",
                            "Medical Clinics & Practitioners",
                            "NDIS Plan Managers & Admin Support",
                            "Office Supplies & Equipment",
                            "Online Services (Web Dev, SaaS, IT Support)",
                            "Optometrists & Optical Retail",
                            "Packaging & Printing Services",
                            "Pest Control Services",
                            "Pet Services & Supplies",
                            "Property Management Agencies",
                            "Real Estate Agencies (Sales & Leasing)",
                            "Recruitment & Staffing (General)",
                            "Repair Services (Electronics, Homewares, etc.)",
                            "Security System Installation (CCTV, alarms)",
                            "Solar & Renewable Energy Installation",
                            "Trades & Maintenance",
                            "Training & Professional Development",
                            "Veterinary Clinics",
                            ];
                            @endphp


                            <div class="col-md-6 mb-3 loan-details">
                                <label for="industry_type" class="form-label">Select your industry</label>
                                <select id="industry_type" name="industry_type" class="form-select select2" required>
                                    <option value="">Select</option>
                                    @foreach ($industries as $industry)
                                    <option value="{{ $industry }}" {{ (isset($customer['industry_type']) && $customer['industry_type'] == $industry) ? 'selected' : '' }}>
                                        {{ $industry }}
                                    </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted"> </small>
                                <p class="text-danger d-none" id="invalid_industry_type">Please select a valid option.</p>
                            </div>
                            @php
                            // Make sure we have an array, else empty array
                            $selectedIndustries = isset($customer['restricted_industry']) && is_array($customer['restricted_industry']) ? $customer['restricted_industry'] : [];
                            @endphp
                            <div class="col-md-6 mb-3 loan-details">
                                <label for="restricted_industry" class="form-label">
                                    Please select if client operates in one of the following industries
                                </label>
                                <select id="restricted_industry" name="restricted_industry[]" class="form-control select2" multiple required>
                                    <option value="null" {{ in_array('null', $selectedIndustries) ? 'selected' : '' }}>None of the below</option>
                                    @foreach ($restricted_industries as $industry)
                                    <option value="{{ $industry }}" {{ in_array($industry, $selectedIndustries) ? 'selected' : '' }}>
                                        {{ $industry }}
                                    </option>
                                    @endforeach
                                </select>
                                <p class="text-danger d-none" id="invalid_restricted_industry">Please select at least one option.</p>
                            </div>


                            <textarea type="text" id="applicable_lenders" cols="20" rows="20" name="applicable_lenders" class="form-control visually-hidden" required></textarea>
                            <input type="text" name="customer_id" id="customer_id" value="{{ $customer['id'] }}" class="visually-hidden">
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



<!-- Odometer JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/odometer.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

<!-- <script src="{{ asset('assets/js/index.js') }}"></script> -->
<script src="{{ url('assets/js/index.js') }}"></script>
<!-- Main content ends here -->
@endsection