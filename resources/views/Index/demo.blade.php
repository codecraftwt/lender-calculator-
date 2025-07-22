@extends('layouts.app')

@section('title', 'matrix Loan Matching')

@section('content')
<!-- Main content starts here -->
<div class="row gx-4">
    <!-- Left Panel -->
    <div class="col-lg-6 mb-4">
        <div class="panel ai-loan-matching p-4 rounded-3 shadow-sm position-sticky" style="top: 72px; z-index: 1000;margin-bottom:10px;border: 3px solid #d8b4fe;">
            <div class="col-md-12 ">
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <div class="panel-header text-center mb-3">
                            <span class="badge bg-gradient-ai-loan px-3 py-1 rounded-pill fw-semibold">AI LOAN MATCHING</span>
                        </div>

                    </div>
                    <div class="col-md-6  mt-3">
                        <div class="matched-lenders text-center ms-5">
                            <div id="matchedLenders" class="odometer matched-count fw-bold fs-4 text-green">0</div>
                            <div class="matched-label small fw-bold text-purple">MATCHED LENDERS</div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="panel ai-loan-matching p-4 rounded-3 shadow-sm">


            <div class="multi-step-form">
                <div class="step step-1 active" data-step="1">
                    <h5 class="text-center mb-4">What is your loan for?</h5>
                    <div class="loan-options d-grid gap-3">
                        <div class="loan-option d-flex flex-column align-items-center p-3 rounded-3 shadow-sm" data-step="1" data-next-step="2" data-loan-type="Business">
                            <i class="fas fa-business-time fs-2 text-purple"></i>
                            <span class="text-center mt-2 small">For Business Purpose</span>
                        </div>
                        <div class="loan-option d-flex flex-column align-items-center p-3 rounded-3 shadow-sm" data-step="1" data-next-step="2" data-loan-type="Vehicle">
                            <i class="bi bi-car-front fs-2 text-purple"></i>
                            <span class="text-center mt-2 small">Car, Bike, Boat or Equipement</span>
                        </div>
                        <div class="loan-option d-flex flex-column align-items-center p-3 rounded-3 shadow-sm " data-step="1" data-next-step="2" data-loan-type="Personal">
                            <i class="fas fa-user fs-2 text-purple"></i>
                            <span class="text-center mt-2 small text-purple">For Personal Purpose</span>
                        </div>
                        <div class="loan-option d-flex flex-column align-items-center p-3 rounded-3 shadow-sm" data-step="1" data-next-step="2" data-loan-type="Property">
                            <i class="fas fa-building fs-4 text-purple"></i>
                            <span class="text-center mt-2 small">Commercial Propery</span>
                        </div>
                        <div class="loan-option d-flex flex-column align-items-center p-3 rounded-3 shadow-sm" data-step="1" data-next-step="2" data-loan-type="Investment">
                            <i class="fas fa-home fs-4 text-purple"></i>
                            <span class="text-center mt-2 small">Home,Land or Investment</span>
                        </div>
                        <div class="loan-option d-flex flex-column align-items-center p-3 rounded-3 shadow-sm" data-step="1" data-next-step="2" data-loan-type="Education">
                            <i class="fas fa-graduation-cap text-purple" style="font-size: 25px;"></i>
                            <span class="text-center mt-2 small">Education</span>
                        </div>

                    </div>
                </div>

                <div class="step step-2 d-none" data-step="2">
                    <form method="POST" action="#" id="lender_form" class="car-bike-boat-form">
                        <div class="row">
                            <!-- Trading Time -->
                            <div class="col-md-6 mb-3">
                                <label for="trading_time" class="form-label">Select Your Trading Time</label>
                                <select id="trading_time" name="trading_time" class="form-control" required>
                                    <option value="">Select Trading Time</option>
                                    @foreach ($trading_times as $trading_time)
                                    <option value="{{ $trading_time['trading_time'] }}">{{ $trading_time['trading_time'] }} Months</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="gst" class="form-label">Do you have ABN/GST Registration?</label>
                                <select id="gst" name="gst" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="age" class="form-label">Enter Your Age</label>
                                <input type="text" id="age" name="age" class="form-control" required>
                                <p class="text-danger d-none" id="invalid_age">Please enter valid age.</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="loan_amt" class="form-label">Loan Amount Needed</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" id="loan_amt" name="loan_amt" class="form-control" aria-label="Loan Amount Needed" required>
                                    <p class="text-danger d-none" id="invalid_loan_amt">Please enter valid Loan amount.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="interest_rate" class="form-label">Expected Interest Rate</label>
                                <div class="input-group">
                                    <input type="text" id="interest_rate" name="interest_rate" class="form-control" required>
                                    <span class="input-group-text">%</span>
                                    <p class="text-danger d-none" id="invalid_interest_rate">Please enter valid interest rate.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="annual_revenue" class="form-label">Annual Revenue</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" id="annual_revenue" name="annual_revenue" class="form-control" required>
                                    <p class="text-danger d-none" id="invalid_annual_revenue">Please enter valid annual revenue.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="net_income" class="form-label">Net Income</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" id="net_income" name="net_income" class="form-control" required>
                                    <p class="text-danger d-none" id="invalid_net_income">Please enter valid net income.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="credit_score" class="form-label">Credit Score</label>
                                <input type="text" id="credit_score" name="credit_score" class="form-control" required>
                                <p class="text-danger d-none" id="invalid_credit_score">Please enter valid credit score.</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="bank_statement" class="form-label">Bank Statement Duration</label>
                                <select id="bank_statement" name="bank_statement" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach ($bank_statements as $bank_statement)
                                    <option value="{{ $bank_statement['bank_statement_type'] }}">
                                        {{ $bank_statement['bank_statement_type'] }} Months
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="Guarantee" class="form-label">Will You Provide a Guarantee?</label>
                                <select id="Guarantee" name="Guarantee" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div id="guaranteeTypeDiv" class="col-md-6 mb-3" style="display: none;">
                                <label for="GuaranteeType" class="form-label">Guarantee Type</label>
                                <select id="GuaranteeType" name="GuaranteeType" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($guaranteeTypes as $guaranteeType)
                                    <option value="{{ $guaranteeType }}">{{ $guaranteeType }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="Financials" class="form-label">Will You Provide Financial Docs?</label>
                                <select id="Financials" name="Financials" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="decision_time" class="form-label">Preferred Decision Time</label>
                                <select id="decision_time" name="decision_time" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach ($decision_times as $decision_time)
                                    <option value="{{ $decision_time['decision_time'] }}">
                                        {{ $decision_time['decision_time'] }} Hours
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="loan_format" class="form-label">Loan Format</label>
                                <select id="loan_format" name="loan_format" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach ($loan_formats as $loan_format)
                                    <option value="{{ $loan_format['loan_format'] }}">{{ $loan_format['loan_format'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="loan_term" class="form-label">Loan Term</label>
                                <select id="loan_term" name="loan_term" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach ($loan_terms as $loan_term)
                                    <option value="{{ $loan_term['loan_term'] }}">{{ $loan_term['loan_term'] }} Months</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="CreditHistory" class="form-label">What best describes your credit history?</label>
                                <select id="CreditHistory" name="CreditHistory" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="clean">Clean credit history</option>
                                    <option value="paidDefaults">Paid/default under payment plan</option>
                                    <option value="unpaidDefaults">Unpaid defaults</option>
                                    <option value="dishonours">Dishonours / overdrawn</option>
                                    <option value="bankruptcy">Past bankruptcy</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="Repayment_Frequency" class="form-label">Repayment Frequency</label>
                                <select id="Repayment_Frequency" name="Repayment_Frequency" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach ($repayment_frequency as $repayment)
                                    <option value="{{ $repayment }}">{{ $repayment }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="EarlyRepayment" class="form-label">Will You Repay Early?</label>
                                <select id="EarlyRepayment" name="EarlyRepayment" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                                <p class="text-warning" id="earlyRepaymentNote" style="display:none; color: #555; margin-top: 5px;"></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="IndustryType" class="form-label">Industry Type</label>
                                <select id="IndustryType" name="IndustryType" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach ($industries as $industry)
                                    <option value="{{ $industry }}">{{ $industry }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="refinanceOption" class="form-label">Refinance Application?</label>
                                <select id="refinanceOption" name="refinanceOption" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="monthly_income" class="form-label">Your Monthly Income</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" id="monthly_income" name="monthly_income" class="form-control" required>
                                    <p class="text-danger d-none" id="invalid_monthly_income">Please enter valid monthly income.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="brokerage" class="form-label">Expected Brokerage (in %)</label>
                                <div class="input-group">
                                    <input type="text" id="brokerage" name="brokerage" class="form-control" required>
                                    <span class="input-group-text">%</span>
                                    <p class="text-danger d-none" id="invalid_brokerage">Please enter valid brokerage.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="paydayLoans" class="form-label">Have You Taken Payday Loans?</label>
                                <select id="paydayLoans" name="paydayLoans" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div id="payday_loan_div" class="col-md-6 mb-3" style="display: none;">
                                <label for="payday_loan_count" class="form-label">How many payday loans do you have?</label>
                                <input type="text" id="payday_loan_count" name="payday_loan_count" class="form-control">
                                <p class="text-danger d-none" id="invalid_payday_loan_count">Please enter valid payday loan count.</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="bankruptcy" class="form-label">Have you ever filed for bankruptcy?</label>
                                <select id="bankruptcy" name="bankruptcy" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div id="bankruptcy_div" class="col-md-6 mb-3" style="display: none;">
                                <label for="bankruptcy_count" class="form-label">Months since your bankruptcy was discharged:</label>
                                <input type="text" id="bankruptcy_count" name="bankruptcy_count" class="form-control">
                                <p class="text-danger d-none" id="invalid_bankruptcy_count">Please enter valid bankruptcy count.</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cashflow_loan" class="form-label">Do You Have Cash Flow Loan?</label>
                                <select id="cashflow_loan" name="cashflow_loan" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div id="cashflow_loan_div" class="col-md-6 mb-3" style="display: none;">
                                <label for="cashflow_loan_count" class="form-label">How many cashflow loans do you have?</label>
                                <input type="text" id="cashflow_loan_count" name="cashflow_loan_count" class="form-control">
                                <p class="text-danger d-none" id="invalid_cashflow_loan_count">Please enter valid cashflow loan count.</p>
                            </div>
                            <!-- <h5 class="text-center">Client Details</h5>
                            <hr>

                            <div class="col-md-6 mb-3">
                                <label for="annual_revenue" class="form-label">Company Name</label>
                                <div class="input-group">
                                    <input type="text" id="company_name" name="company_name" class="form-control" required>
                                    <p class="text-danger d-none" id="invalid_annual_revenue">Please enter valid Name.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="annual_revenue" class="form-label">Director Name</label>
                                <div class="input-group">
                                    <input type="text" id="director_name" name="director_name" class="form-control" required>
                                    <p class="text-danger d-none" id="invalid_annual_revenue">Please enter valid Name.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="annual_revenue" class="form-label">Director Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="text" id="director_email" name="director_email" class="form-control" required>
                                    <p class="text-danger d-none" id="invalid_annual_revenue">Please enter valid email.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="annual_revenue" class="form-label">Director Phone</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                    <input type="text" id="annual_revenue" name="annual_revenue" class="form-control" required>
                                    <p class="text-danger d-none" id="invalid_annual_revenue">Please enter valid Phone.</p>
                                </div>
                            </div> -->
                        </div>
                    </form>

                </div>
                <div class="step step-3 d-none">
                    <h5 class="text-center mb-4">Summary</h5>
                    <p class="text-center">You have selected your loan options. Please review and submit.</p>
                </div>
            </div>
            <div class="loan-navigation d-flex justify-content-between align-items-center mt-4">
                <button class="btn btn-warning btn-arrow rounded-circle btn-prev-global me-2" style="height: 60px;width:60px">
                    <i class="bi bi-chevron-left text-white" style="font-size: 15px;font-weight:600"><br>Back</i>
                </button>

                <div class="loan-info d-flex gap-2">
                    <div class="loan-info-box border border-2 rounded-2 p-2 text-center from-box">
                        <div class="small text-muted">FROM</div>
                        <div class="fw-bold fs-5 from-amount">$0</div>
                        <div class="small from-frequency">Credit Score</div>

                        <div class="small text-success from-rate">FROM 0% p/a</div>

                    </div>
                    <div class="loan-info-box border border-2 rounded-2 p-2 text-center max-box">
                        <div class="small text-muted">MAX LOAN</div>
                        <div class="fw-bold fs-5 max-amount">$0</div>
                        <div class="small max-unsecured text-success ">unsecured</div>
                        <!-- <div class="small text-success max-secured">$0 secured</div> -->
                    </div>
                </div>
                <button class="btn btn-warning btn-arrow rounded-circle btn-next-global" style="height: 60px;width:60px">
                    <i id="next_btn" class="bi bi-chevron-right text-white" style="font-size: 15px;font-weight:600"><br>Next</i>
                </button>
            </div>
            <div class="loan-actions d-flex justify-content-center gap-3 mt-3">
                <button class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-telephone"></i> Finish on a call
                </button>
                <button class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-bookmark"></i> Save for later
                </button>
            </div>

        </div>
    </div>

    <!-- Right Panel -->
    <div class="col-lg-6 mb-4">
        <div class="panel ebroker-lender-panel p-4 rounded-3 shadow-sm position-sticky" style="top: 72px; z-index: 1000;border: 3px solid #d8b4fe">
            <div class="panel-header text-center mb-3">
                <span class="badge bg-gradient-ebroker px-3 py-1 rounded-pill fw-semibold">LENDERS PANEL</span>
            </div>
            <div class="lender-cards row g-3 position-sticky" style="top: 90px; z-index: 1000;">
                <div id="loader" class="text-center my-4" style="display: none;">
                    <img src="{{ asset('assets/images/loader.gif') }}" alt="Loading...">
                </div>
                <!-- the ajax resposnse will bind the divs here -->
            </div>
            <div class="comparison-note text-center small text-white   rounded-2 py-1" style="margin-top:30px">
                Comparison Rates &amp; Repayments Include Fees &amp; Charges
            </div>
        </div>
    </div>
</div>
<!-- Main content ends here -->
@endsection

@section('scripts')
<!-- Odometer JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/odometer.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script src="{{ asset('assets/js/index2.js') }}"></script>
@endsection