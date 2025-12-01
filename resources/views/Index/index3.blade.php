@extends('layouts.app2')

@section('title', 'matrix Loan Matching')

@section('content')
<!-- Main content starts here -->

<style>
    .fetch-button {
        margin: 5px;
        border: none;
        border-radius: 6px;
        color: white;
        padding: 8px 16px;
        width: auto;
        background: linear-gradient(90deg, #009688 0%, #4DB6AC 100%);
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.2s ease;
    }

    .fetch-button:hover {
        background: linear-gradient(90deg, #00796B 0%, #26A69A 100%);
        transform: scale(1.03);
    }

    .fetch-button:active {
        transform: scale(0.97);
    }
</style>
<di v class="row gx-4" style=" background: #d8b4fe;">
    <!-- Left Panel -->
    <div class="col-lg-2 mb-4"></div>

    <div class="col-lg-8 mb-4" style="">
        <div class="panel ai-loan-matching shadow-sm" style=" margin-top: 20px;">




            <!-- <div id='bankstatements' data-code='FNCN'></div>
            <script src='https://www.bankstatements.com.au/js/loader.js' async></script>
            <noscript>
                <iframe src='https://www.bankstatements.com.au/iframe/start/FNCN' style='width: 100%; height: 100%;'></iframe>
            </noscript> -->



            <div class="multi-step-form " style="margin: 0; padding:20px;box-shadow: 5px 5px 5px 2px #878787; ">
                <!-- <div class="header" style="height:62px;background: linear-gradient(90deg, #009688 0%, #4DB6AC 100%); text-align: center;border-top-left-radius:20px;border-top-right-radius:20px">
                    <h5 style="border-bottom: none;color:white">Client Loan Eligibility Form</h5>
                </div> -->
                <header class="form-header" aria-hidden="false">
                    <div class="brand-logo" aria-hidden="true">LN</div>
                    <div class="form-meta">
                        <h1 id="formTitle">Loan Eligibility Form</h1>
                        <!-- <p>Quick application · We'll only ask essential details</p> -->
                    </div>

                </header>
                <hr>
                <form method="POST" action="{{ url('/save_data') }}" id="loanForm" novalidate style="padding: 10px;margin-top:-50px">
                    @csrf
                    <!-- CLIENT DETAILS -->
                    <section class="section" aria-labelledby="clientTitle">

                        <br>
                        <div class="section-title">
                            <div class="dot" aria-hidden="true"></div>
                            <h2 id="clientTitle">Client Details</h2>
                        </div>

                        <div class="grid">
                            <div class="field">
                                <label class="field-label" for="company_name">Company Name</label>
                                <div class="control">
                                    <input id="company_name" name="company_name" type="text" placeholder="e.g. Greenfield Pty Ltd" required />
                                </div>
                                <div class="error">Please enter a company name.</div>
                            </div>

                            <div class="field">
                                <label class="field-label" for="director_name">Director Name</label>
                                <div class="control">
                                    <input id="director_name" name="director_name" type="text" placeholder="e.g. John Smith" required />
                                </div>
                                <div class="error">Please enter director's name.</div>
                            </div>

                            <div class="field">
                                <label class="field-label" for="director_email">Director Email</label>
                                <div class="control">
                                    <input id="director_email" name="director_email" type="email" placeholder="name@company.com" required />
                                </div>
                                <div class="error">Please enter a valid email.</div>
                            </div>

                            <div class="field">
                                <label class="field-label" for="director_phone">Director Phone</label>
                                <div class="control">
                                    <input id="director_phone" name="director_phone" type="tel" placeholder="(03) 9999 9999" pattern="[\d\-\s\(\)\+]+" required />
                                </div>
                                <div class="error">Please enter a phone number.</div>
                            </div>
                        </div>
                    </section>

                    <!-- BUSINESS DETAILS -->
                    <section class="section" aria-labelledby="businessTitle">
                        <br>
                        <div class="section-title">
                            <div class="dot" aria-hidden="true"></div>
                            <h2 id="businessTitle">Business Details</h2>
                        </div>

                        <div class="grid">
                            <div class="field">
                                <label class="field-label" for="abn_date">Date of ABN Registration</label>
                                <div class="control">
                                    <input id="abn_date" name="abn_date" type="date" />
                                </div>
                                <div class="hint">Optional — if known</div>
                            </div>

                            <div class="field">
                                <label class="field-label" for="time_in_business">Time in Business</label>
                                <div class="control">
                                    <input id="time_in_business" name="time_in_business" type="text" placeholder="e.g. 3 years" />
                                </div>
                                <div class="hint">Approximate is fine</div>
                            </div>

                            <div class="field">
                                <label class="field-label" for="entity_type">Entity Type</label>
                                <div class="control">
                                    <select id="entity_type" name="entity_type" required>
                                        <option value="">Select entity type</option>
                                        <option>Company</option>
                                        <option>Sole Trader</option>
                                        <option>Trust</option>
                                        <option>Partnership</option>
                                    </select>
                                </div>
                                <div class="error">Please choose an entity type.</div>
                            </div>

                            <div class="field">
                                <label class="field-label" for="gst_registered">GST Registered</label>
                                <div class="control">
                                    <select id="gst_registered" name="gst_registered" required>
                                        <option value="">Select</option>
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                                <div class="error">Please select Yes or No.</div>
                            </div>
                    </section>

                    <section class="section" aria-labelledby="businessTitle">

                        <br>
                        <div class="section-title">
                            <div class="dot" aria-hidden="true"></div>
                            <h2 id="businessTitle">Business Details</h2>
                        </div>

                        <!-- full width request / note -->
                        <div class="field full">
                            <label class="field-label" for="purpose">Loan Purpose (brief)</label>
                            <div class="control">
                                <input id="purpose" name="purpose" type="text" placeholder="e.g. Working capital, equipment purchase" />
                            </div>
                            <div class="hint">Keep it short — this helps speed assessment.</div>
                        </div>
            </div>


            <!-- FOOTER -->

            <div class="foot-note">We protect your data — secure & encrypted.</div>
            <div style="margin-left:auto; display:flex; gap:10px;">
                <button type="button" class="secondary" id="resetBtn">Reset</button>
                <button type="submit" class="primary-btn" id="submitBtn">Submit Application</button>
            </div>

            </section>
            </form>
        </div>
    </div>
</div>
<div class="col-lg-2 mb-4"></div>
</div>




<!-- Illion Data Modal -->
<div class="modal fade" id="illionModal" tabindex="-1" aria-labelledby="illionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius:10px;">
            <div class="modal-header" style="background: linear-gradient(90deg, #4a3f9a 0%, #d15de8 100%); color: #fff;">
                <h5 class="modal-title" id="illionModalLabel">Illion Bank Statement Summary (<span id="doc_id" style="font-size: 15px;"></span>)</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <div id="illion-summary" class="row g-3">
                    <div class="col-md-6"><b>Reference:</b> <span id="ref"></span></div>
                    <div class="col-md-6"><b>Submission Time:</b> <span id="sub_time"></span></div>

                    <div class="col-md-6"><b>Monthly Income (BF002):</b> <span id="monthly_income"></span></div>
                    <div class="col-md-6"><b>Monthly Turnover (BM001):</b> <span id="monthly_turnover"></span></div>
                    <div class="col-md-6"><b>Annual Income:</b> <span id="annual_income"></span></div>
                    <div class="col-md-6"><b>Annual Turnover:</b> <span id="annual_turnover"></span></div>

                    <div class="col-md-6"><b>Days in Negative:</b> <span id="days_negative"></span></div>
                    <div class="col-md-6"><b>Dishonours (EBP009):</b> <span id="dishonours"></span></div>

                    <div class="col-md-6"><b>Non-SACC Loans (DM079):</b> <span id="non_sacc_loans"></span></div>
                    <div class="col-md-6"><b>Ongoing Non-SACC Loans (DM090):</b> <span id="ongoing_non_sacc_loans"></span></div>

                    <div class="col-md-6"><b>SACC Loans (DM091):</b> <span id="sacc_loans"></span></div>
                    <div class="col-md-6"><b>Ongoing SACC Loans (DM042):</b> <span id="ongoing_sacc_loans"></span></div>

                    <div class="col-md-6"><b>Cashflow Lenders (BF017):</b> <span id="cashflow_loans"></span></div>

                    <div class="col-md-6"><b>Overdrawn Count (AB006):</b> <span id="overdraw_count"></span></div>
                    <div class="col-md-6"><b>Overdrawn Fees (30 Days - FN006):</b> <span id="overdraw_30"></span></div>
                    <div class="col-md-6"><b>Overdrawn Fees (90 Days - FN007):</b> <span id="overdraw_90"></span></div>
                    <div class="col-md-6"><b>Overdrawn Fees (180 Days - FN008):</b> <span id="overdraw_180"></span></div>
                    <div class="col-md-6"><b>cash_flow_loans_count:</b> <span id="cash_flow_loans_count"></span></div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

<!-- <script src="{{ asset('assets/js/index.js') }}"></script> -->
<script src="{{ url('assets/js/index.js') }}"></script>
<!-- Main content ends here -->
@endsection