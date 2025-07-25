@extends('layouts.app')

@section('title', 'matrix Loan Matching')

@section('content')
<!-- Main content starts here -->
<div class="row gx-4">
    <!-- Left Panel -->
    <div class="col-lg-6 mb-4">
        <div class="panel ai-loan-matching p-4 rounded-3 shadow-sm">
            <div class="panel-header text-center mb-3">
                <span class="badge bg-gradient-ai-loan px-3 py-1 rounded-pill fw-semibold">AI LOAN MATCHING</span>
            </div>
            <h5 class="text-center mb-4">What is your loan for?</h5>
            <div class="multi-step-form">
                <div class="step step-1 active">
                    <div class="loan-options d-grid gap-3">
                        <div class="loan-option d-flex flex-column align-items-center p-3 rounded-3 shadow-sm" data-step="1" data-next-step="2">
                            <!-- <i class="bi bi-cash-stack fs-2 text-purple"></i> -->
                            <i class="fas fa-business-time fs-2 text-purple"></i>
                            <span class="text-center mt-2 small">For Business Purpose</span>
                        </div>
                        <div class="loan-option d-flex flex-column align-items-center p-3 rounded-3 shadow-sm" data-step="1" data-next-step="2">
                            <i class="bi bi-car-front fs-2 text-purple"></i>
                            <span class="text-center mt-2 small">Car, Bike, Boat or Equipement</span>
                        </div>
                        <div class="loan-option d-flex flex-column align-items-center p-3 rounded-3 shadow-sm " data-step="1" data-next-step="2">
                            <!-- <i class="bi bi-pie-chart fs-2 text-white"></i> -->
                            <i class="fas fa-user fs-2 text-purple"></i>
                            <span class="text-center mt-2 small text-purple">For Personal Purpose</span>
                        </div>
                        <div class="loan-option d-flex flex-column align-items-center p-3 rounded-3 shadow-sm" data-step="1" data-next-step="2">
                            <!-- <i class="bi bi-hammer fs-4 text-purple"></i> -->
                            <i class="fas fa-building fs-4 text-purple"></i>
                            <span class="text-center mt-2 small">Commercial Propery</span>
                        </div>
                        <div class="loan-option d-flex flex-column align-items-center p-3 rounded-3 shadow-sm" data-step="1" data-next-step="2">
                            <!-- <i class="bi bi-cup-straw fs-4 text-purple"></i> -->
                            <i class="fas fa-home fs-4 text-purple"></i>
                            <span class="text-center mt-2 small">Home,Land or Investment</span>
                        </div>
                        <div class="loan-option d-flex flex-column align-items-center p-3 rounded-3 shadow-sm" data-step="1" data-next-step="2">
                            <i class="bi bi-airplane fs-4 text-purple"></i>
                            <span class="text-center mt-2 small">Travel / Holiday</span>
                        </div>

                    </div>
                </div>


                <!-- the commented code can used to show the more option when we need more information og for what the user want the loan
                  -->
                <!-- <div class="step step-2 d-none">
                    <h5 class="text-center mb-4">Car, Bike, Boat or Equipment Finance</h5>
                    <p class="text-center mb-3">For Personal or Business Use?</p>
                    <div class="d-flex justify-content-center gap-4 mb-4">
                        <div class="option-box p-3 rounded-3 shadow-sm text-center cursor-pointer" data-next-step="3">
                            <i class="bi bi-bicycle fs-1 text-purple"></i>
                            <div class="mt-2 fw-semibold">For Personal Use</div>
                        </div>
                        <div class="option-box p-3 rounded-3 shadow-sm text-center cursor-pointer" data-next-step="3">
                            <i class="bi bi-truck fs-1 text-purple"></i>
                            <div class="mt-2 fw-semibold">For Business Use</div>
                        </div>
                    </div>
                    <label for="purchasePrice" class="form-label text-center d-block fw-semibold">Loan Amount</label>
                    <div class="purchase-price-wrapper mb-4 ">
                        <input type="text" id="purchasePrice" class="form-control ml-86" placeholder="$..." />
                    </div>
                    <p class="text-center mb-3">Preferred repayment term?</p>
                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        <button class="btn btn-outline-primary rounded-3" data-next-step="3">6 Months</button>
                        <button class="btn btn-outline-primary rounded-3" data-next-step="3">12 Months</button>
                        <button class="btn btn-outline-primary rounded-3" data-next-step="3">2 Years</button>
                        <button class="btn btn-outline-primary rounded-3" data-next-step="3">3 Years</button>
                        <button class="btn btn-outline-primary rounded-3" data-next-step="3">4 Years</button>
                        <button class="btn btn-outline-primary rounded-3" data-next-step="3">5 Years</button>
                    </div>

                </div> -->
                <div class="step step-2 d-none">
                    <form method="POST" action="#" class="car-bike-boat-form">
                        <div class="row">
                            <!-- Trading Time -->
                            <div class="col-md-6 mb-3">
                                <label for="trading_time" class="form-label">Select Your Trading Time</label>
                                <select id="trading_time" name="trading_time" class="form-control">
                                    <option value="">Select Trading Time</option>
                                    @foreach ($trading_times as $trading_time)
                                    <option value="{{ $trading_time['trading_time'] }}">{{ $trading_time['trading_time'] }} Months</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- GST Registration -->
                            <div class="col-md-6 mb-3">
                                <label for="gst" class="form-label">Do you have ABN/GST Registration?</label>
                                <select id="gst" name="gst" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>

                            <!-- Age -->
                            <div class="col-md-6 mb-3">
                                <label for="age" class="form-label">Enter Your Age</label>
                                <input type="text" id="age" name="age" class="form-control">
                            </div>

                            <!-- Loan Amount -->
                            <div class="col-md-6 mb-3">
                                <label for="loan_amt" class="form-label">Loan Amount Needed</label>
                                <input type="text" id="loan_amt" name="loan_amt" class="form-control">
                            </div>

                            <!-- Interest Rate -->
                            <div class="col-md-6 mb-3">
                                <label for="interest" class="form-label">Expected Interest Rate</label>
                                <input type="text" id="interest" name="interest" class="form-control">
                            </div>

                            <!-- Annual Revenue -->
                            <div class="col-md-6 mb-3">
                                <label for="annual_revenue" class="form-label">Annual Revenue</label>
                                <input type="text" id="annual_revenue" name="annual_revenue" class="form-control">
                            </div>

                            <!-- Net Income -->
                            <div class="col-md-6 mb-3">
                                <label for="net_income" class="form-label">Net Income</label>
                                <input type="text" id="net_income" name="net_income" class="form-control">
                            </div>

                            <!-- Credit Score -->
                            <div class="col-md-6 mb-3">
                                <label for="credit_score" class="form-label">Credit Score</label>
                                <input type="text" id="credit_score" name="credit_score" class="form-control">
                            </div>

                            <!-- Bank Statement -->
                            <div class="col-md-6 mb-3">
                                <label for="bank_statement" class="form-label">Bank Statement Duration</label>
                                <select id="bank_statement" name="bank_statement" class="form-control">
                                    <option value="">Select</option>
                                    <option value="6months">Minimum 6 months</option>
                                    <option value="6months_ato">Minimum 6 months + ATO portals</option>
                                </select>
                            </div>

                            <!-- Guarantee -->
                            <div class="col-md-6 mb-3">
                                <label for="Guarantee" class="form-label">Will You Provide a Guarantee?</label>
                                <select id="Guarantee" name="Guarantee" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>

                            <!-- Guarantee Type (Conditional) -->
                            <div id="guaranteeTypeDiv" class="col-md-6 mb-3" style="display: none;">
                                <label for="GuaranteeType" class="form-label">Guarantee Type</label>
                                <select id="GuaranteeType" name="GuaranteeType" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Personal">Personal</option>
                                    <option value="Director">Director</option>
                                    <option value="Owner">Owner</option>
                                </select>
                            </div>

                            <!-- Financials -->
                            <div class="col-md-6 mb-3">
                                <label for="Financials" class="form-label">Will You Provide Financial Docs?</label>
                                <select id="Financials" name="Financials" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>

                            <!-- Decision Time -->
                            <div class="col-md-6 mb-3">
                                <label for="decision_time" class="form-label">Preferred Decision Time</label>
                                <select id="decision_time" name="decision_time" class="form-control">
                                    <option value="">Select</option>
                                    <option value="24hr">Within 24 hours</option>
                                    <option value="30min">As fast as 30 minutes</option>
                                </select>
                            </div>

                            <!-- Loan Format -->
                            <div class="col-md-6 mb-3">
                                <label for="loan_format" class="form-label">Loan Format</label>
                                <select id="loan_format" name="loan_format" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($loan_formats as $loan_format)
                                    <option value="{{ $loan_format['loan_format'] }}">{{ $loan_format['loan_format'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Loan Term -->
                            <div class="col-md-6 mb-3">
                                <label for="loan_term" class="form-label">Loan Term</label>
                                <select id="loan_term" name="loan_term" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($loan_terms as $loan_term)
                                    <option value="{{ $loan_term['loan_term'] }}">{{ $loan_term['loan_term'] }} Months</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Credit History -->
                            <div class="col-md-6 mb-3">
                                <label for="CreditHistory" class="form-label">What best describes your credit history?</label>
                                <select id="CreditHistory" name="CreditHistory" class="form-control">
                                    <option value="">Select</option>
                                    <option value="clean">Clean credit history</option>
                                    <option value="paidDefaults">Paid/default under payment plan</option>
                                    <option value="unpaidDefaults">Unpaid defaults</option>
                                    <option value="dishonours">Dishonours / overdrawn</option>
                                    <option value="bankruptcy">Past bankruptcy</option>
                                </select>
                            </div>

                            <!-- Security
                                    <div class="col-md-6 mb-3">
                                        <label for="SecurityProvided" class="form-label">Security Provided?</label>
                                        <select id="SecurityProvided" name="SecurityProvided" class="form-control">
                                            <option value="">Select</option>
                                            <option value="None">No</option>
                                            <option value="Property">Property</option>
                                            <option value="Assets">Assets</option>
                                        </select>
                                    </div> -->

                            <!-- Repayment Frequency -->
                            <div class="col-md-6 mb-3">
                                <label for="Repayment_Frequency" class="form-label">Repayment Frequency</label>
                                <select id="Repayment_Frequency" name="Repayment_Frequency" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Daily">Daily</option>
                                    <option value="Weekly">Weekly</option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Fortnightly">Fortnightly</option>
                                </select>
                            </div>

                            <!-- Early Repayment -->
                            <div class="col-md-6 mb-3">
                                <label for="EarlyRepayment" class="form-label">Will You Repay Early?</label>
                                <select id="EarlyRepayment" name="EarlyRepayment" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>

                            <!-- Industry Type -->
                            <div class="col-md-6 mb-3">
                                <label for="IndustryType" class="form-label">Industry Type</label>
                                <select id="IndustryType" name="IndustryType" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Accommodation">Accommodation</option>
                                    <option value="PropertyDevelopment">Property Development</option>
                                    <option value="Retail">Retail</option>
                                    <option value="Gaming">Gaming / Gambling</option>
                                    <option value="Healthcare">Healthcare</option>
                                    <option value="Education">Education</option>
                                    <option value="Adult">Adult / Tattoo</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <!-- Refinance -->
                            <div class="col-md-6 mb-3">
                                <label for="refinanceOption" class="form-label">Refinance Application?</label>
                                <select id="refinanceOption" name="refinanceOption" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>

                            <!-- Lending Ratio -->
                            <div class="col-md-6 mb-3">
                                <label for="lendingRatio" class="form-label">Preferred Lending Ratio</label>
                                <select id="lendingRatio" name="lendingRatio" class="form-control">
                                    <option value="">Select</option>
                                    <option value="125">Up to 125%</option>
                                    <option value="150">Up to 150%</option>
                                    <option value="custom">Other</option>
                                </select>
                            </div>

                            <!-- Brokerage -->
                            <div class="col-md-6 mb-3">
                                <label for="brokerage" class="form-label">Expected Brokerage</label>
                                <input type="text" id="brokerage" name="brokerage" class="form-control">
                            </div>

                            <!-- Payday Loans -->
                            <div class="col-md-6 mb-3">
                                <label for="paydayLoans" class="form-label">Have You Taken Payday Loans?</label>
                                <select id="paydayLoans" name="paydayLoans" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>

                            <!-- Payday Count (if yes) -->
                            <div id="payday_loan_div" class="col-md-6 mb-3" style="display: none;">
                                <label for="payday_loan" class="form-label">How Many Payday Loans?</label>
                                <input type="text" id="payday_loan" name="payday_loan" class="form-control">
                            </div>

                            <!-- Bankruptcy -->
                            <div class="col-md-6 mb-3">
                                <label for="bankruptcy" class="form-label">Filed for Bankruptcy?</label>
                                <select id="bankruptcy" name="bankruptcy" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>

                            <!-- Bankruptcy Details -->
                            <div id="bankruptcy_div" class="col-md-6 mb-3" style="display: none;">
                                <label for="bankruptcy_count" class="form-label">Months Since Discharge</label>
                                <input type="text" id="bankruptcy_count" name="bankruptcy_count" class="form-control">
                            </div>

                            <!-- Cash Flow Loan -->
                            <div class="col-md-6 mb-3">
                                <label for="cashflow_loan" class="form-label">Do You Have Cash Flow Loan?</label>
                                <select id="cashflow_loan" name="cashflow_loan" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>

                            <!-- Cash Flow Loan Count -->
                            <div id="cashflow_loan_div" class="col-md-6 mb-3" style="display: none;">
                                <label for="cashflow_loan_count" class="form-label">How Much?</label>
                                <input type="text" id="cashflow_loan_count" name="cashflow_loan_count" class="form-control">
                            </div>

                            <!-- High Cost Lenders -->
                            <div class="col-md-6 mb-3">
                                <label for="high_cost_lenders" class="form-label">Allow High-Cost Lenders?</label>
                                <select id="high_cost_lenders" name="high_cost_lenders" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Yes">Yes - I consent</option>
                                    <option value="No">No - Avoid</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="step step-3 d-none">
                    <h5 class="text-center mb-4">Summary</h5>
                    <p class="text-center">You have selected your loan options. Please review and submit.</p>


                </div>
            </div>



            <div class="loan-navigation d-flex justify-content-between align-items-center mt-4">
                <button class="btn btn-purple btn-arrow rounded-circle btn-back-global" data-prev-step="1" style="display:none;">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <div class="matched-lenders text-center ms-5">
                    <div id="matchedLenders" class="odometer matched-count fw-bold fs-4 text-green">20</div>

                    <div class="matched-label small fw-bold text-purple">MATCHED LENDERS</div>
                </div>
                <div class="loan-info d-flex gap-2">
                    <div class="loan-info-box border border-2 rounded-2 p-2 text-center">
                        <div class="small text-muted">FROM</div>
                        <div class="fw-bold fs-5">$22</div>
                        <div class="small">PER WEEK</div>
                        <div class="small text-muted">7 years</div>
                        <div class="small text-success">FROM 6.74% p/a</div>
                        <div class="small text-muted">10.58% comparison</div>
                    </div>
                    <div class="loan-info-box border border-2 rounded-2 p-2 text-center">
                        <div class="small text-muted">MAX LOAN</div>
                        <div class="fw-bold fs-5">$200,000</div>
                        <div class="small">unsecured</div>
                        <div class="small text-success">$200,000 secured</div>
                    </div>
                </div>
                <button class="btn btn-green btn-arrow rounded-circle btn-next-global">
                    <i class="bi bi-chevron-right"></i>
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
        <div class="panel ebroker-lender-panel p-4 rounded-3 shadow-sm">
            <div class="panel-header text-center mb-3">
                <span class="badge bg-gradient-ebroker px-3 py-1 rounded-pill fw-semibold">ebroker LENDER PANEL</span>
            </div>
            <div class="lender-cards row g-3">
                <div id="loader" class="text-center my-4" style="display: none;">
                    <img src="{{ asset('assets/images/loader.gif') }}" alt="Loading...">
                </div>
                        <!-- Each lender card -->
                        <!-- <div class="col-6">
                            <div class="lender-card d-flex p-0 rounded-3 shadow-sm overflow-hidden" data-lender-id="1">
                                <div class="lender-logo-section d-flex flex-column align-items-center justify-content-center bg-white p-3 position-relative">
                                    <img src="{{ url('assets/images/liberty-logo.png') }}" alt="Wisr" class="lender-logo img-fluid" data-lender-logo />

                                </div>
                                <div class="loan-details-section flex-grow-1  bg-gradient-moneyme text-white d-flex flex-column justify-content-center small">
                                    <div class="loan-header d-flex justify-content-between align-items-center">
                                        <div class="from-label bg-purple px-2 py-1 rounded-top text-white small">FROM</div>
                                        <div class="max-loan-label bg-orange px-2 py-1 rounded-top text-white small">MAX LOAN</div>
                                    </div>
                                    <div class="loan-amounts d-flex justify-content-between fw-bold">
                                        <div>$22/week</div>
                                        <div data-max-loan-amount></div>
                                    </div>


                                    <div class="loan-rates d-flex justify-content-between small">
                                        <div>From 6.74% p/a</div>

                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- More lender cards can be added here following the same pattern -->
                    </div>
                    <div class="comparison-note text-center mt-3 small text-white   rounded-2 py-1">
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
        <script src="{{ asset('assets/js/index.js') }}"></script>
        @endsection