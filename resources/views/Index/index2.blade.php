<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>eBrokerTech Loan Matching</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" rel="stylesheet" />


    <!-- Odometer CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/themes/odometer-theme-default.min.css" />

    <!-- Odometer JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/odometer.min.js"></script>



    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/style2.css') }}">
</head>

<body>
    <header class="py-3 bg-white shadow-sm">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="#" class="d-flex align-items-center text-decoration-none">
                <img src="https://ebrokertech.com/wp-content/uploads/2021/06/ebrokertech-logo.svg" alt="ebrokertech" class="logo" />
            </a>
            <nav>
                <ul class="nav gap-3 align-items-center">
                    <li><a href="#" class="nav-link px-2">Home</a></li>
                    <li><a href="#" class="nav-link px-2">Meet Obi</a></li>
                    <li><a href="#" class="nav-link px-2">Brokerages</a></li>
                    <li><a href="#" class="nav-link px-2">Suppliers</a></li>
                    <li><a href="#" class="nav-link px-2">Partners</a></li>
                    <li><a href="#" class="nav-link px-2">Lenders</a></li>
                    <li><a href="#" class="nav-link px-2">Contact us</a></li>
                    <li>
                        <a href="#" class="btn btn-login px-3 py-1 rounded-pill">Login</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container my-4">
        <!-- <section class="intro-text mb-4">
            <h2 class="fw-bold">
                Say hi to "Obi", your broker-bot assistant who will assist the applicant in matching to the right lender or lenders up to the
                <a href="#" class="text-primary text-decoration-underline">SmartApp</a> phase.
            </h2>
            <p class="mb-3">
                In real-time, Obi delivers a complete fact-finding algorithm with every data entered showing filtered lender results. Hence, the applicant or customer consultant instantly views real-time filtering of 80 plus Australian lenders.
            </p>
            <a href="#" class="btn btn-demo d-flex align-items-center gap-2">
                <i class="bi bi-play-circle-fill"></i> Book a demo
            </a>
        </section> -->

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

                        <div class="step step-2 d-none">
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
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Select all steps
                            const steps = document.querySelectorAll('.multi-step-form .step');
                            const btnNext = document.querySelector('.btn-next-global');
                            const btnBack = document.querySelector('.btn-back-global');

                            let currentStep = 0; // Start at the first step

                            // Show step function to display the current step and hide others
                            function showStep(index) {
                                // Loop through all steps and hide/show accordingly
                                steps.forEach((step, i) => {
                                    // Show the current step, hide the rest
                                    step.classList.toggle('d-none', i !== index);
                                    step.classList.toggle('active', i === index);
                                });

                                // Hide the 'Back' button on the first step
                                if (btnBack) {
                                    btnBack.style.display = index === 0 ? 'none' : 'inline-block';
                                }

                                // Optionally, disable 'Next' button on the last step
                                if (btnNext) {
                                    btnNext.style.display = index === steps.length - 1 ? 'none' : 'inline-block';
                                }
                            }

                            // Handle 'Next' button click
                            if (btnNext) {
                                btnNext.addEventListener('click', () => {
                                    const matchedCount = document.getElementById('matchedLenders');

                                    // Simulate fetching a number
                                    setTimeout(() => {
                                        matchedCount.innerHTML = 30; // Replace 14 with dynamic value
                                    }, 500);

                                    if (currentStep < steps.length - 1) {
                                        currentStep++;
                                        showStep(currentStep);
                                    }
                                });
                            }

                            // Handle 'Back' button click
                            if (btnBack) {
                                btnBack.addEventListener('click', () => {

                                    const matchedCount = document.getElementById('matchedLenders');

                                    // Simulate fetching a number
                                    setTimeout(() => {
                                        matchedCount.innerHTML = 25; // Replace 14 with dynamic value
                                    }, 500);

                                    if (currentStep > 0) {
                                        currentStep--;
                                        showStep(currentStep);
                                    }
                                });
                            }

                            // Optional: Handle custom navigation if you want to jump steps from any button (data-next-step attribute)
                            document.querySelectorAll('[data-next-step]').forEach(el => {
                                el.addEventListener('click', () => {
                                    const next = parseInt(el.getAttribute('data-next-step')) - 1;
                                    if (!isNaN(next)) {
                                        currentStep = next;
                                        showStep(currentStep);
                                    }
                                });
                            });

                            // Initialize with the first step
                            showStep(currentStep);
                        });

                        document.addEventListener('DOMContentLoaded', function() {

                            const matchedCount = document.getElementById('matchedLenders');

                            // Simulate fetching a number
                            setTimeout(() => {
                                matchedCount.innerHTML = 50; // Replace 14 with dynamic value
                            }, 500);
                        });
                    </script>








                </div>
            </div>

            <!-- Right Panel -->
            <div class="col-lg-6 mb-4">
                <div class="panel ebroker-lender-panel p-4 rounded-3 shadow-sm">
                    <div class="panel-header text-center mb-3">
                        <span class="badge bg-gradient-ebroker px-3 py-1 rounded-pill fw-semibold">ebroker LENDER PANEL</span>
                    </div>
                    <div class="lender-cards row g-3">
                        <!-- Each lender card -->
                        <div class="col-6">
                            <div class="lender-card d-flex p-0 rounded-3 shadow-sm overflow-hidden">
                                <div class="lender-logo-section d-flex flex-column align-items-center justify-content-center bg-white p-3 position-relative">
                                    <img src="{{ asset('assets/images/liberty-logo.png') }}" alt="Wisr" class="lender-logo img-fluid" />

                                </div>
                                <div class="loan-details-section flex-grow-1  bg-gradient-moneyme text-white d-flex flex-column justify-content-center small">
                                    <div class="loan-header d-flex justify-content-between align-items-center">
                                        <div class="from-label bg-purple px-2 py-1 rounded-top text-white small">FROM</div>
                                        <div class="max-loan-label bg-orange px-2 py-1 rounded-top text-white small">MAX LOAN</div>
                                    </div>
                                    <div class="loan-amounts d-flex justify-content-between fw-bold">
                                        <div>$22/week</div>
                                        <div>$200,000</div>
                                    </div>


                                    <div class="loan-rates d-flex justify-content-between small">
                                        <div>From 6.74% p/a</div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-6">
                            <div class="lender-card d-flex align-items-center p-3 rounded-3 shadow-sm">
                                <img src="https://moneyplace.com.au/wp-content/themes/moneyplace/assets/images/logo.svg" alt="Moneyplace" class="lender-logo" />
                                <div class="lender-info ms-3 flex-grow-1">
                                    <div class="lender-name fw-bold">Moneyplace</div>
                                    <div class="loan-details bg-gradient-moneyplace p-2 rounded-2 text-white small">
                                        <div>FROM <span class="fw-bold">$23</span> per week</div>
                                        <div>7 years</div>
                                        <div>From 6.3% p/a</div>
                                        <div>11.34% comparison</div>
                                    </div>
                                    <div class="loan-type small text-muted">Unsecured</div>
                                </div>
                            </div>
                        </div> -->

                        <div class="col-6">
                            <div class="lender-card d-flex p-0 rounded-3 shadow-sm overflow-hidden">
                                <div class="lender-logo-section d-flex flex-column align-items-center justify-content-center bg-white p-3 position-relative">
                                    <img src="{{ asset('assets/images/moneyplace-logo.png') }}" alt="Wisr" class="lender-logo img-fluid" />

                                </div>
                                <div class="loan-details-section flex-grow-1  bg-gradient-moneyme text-white d-flex flex-column justify-content-center small">
                                    <div class="loan-header d-flex justify-content-between align-items-center">
                                        <div class="from-label bg-purple px-2 py-1 rounded-top text-white small">FROM</div>
                                        <div class="max-loan-label bg-orange px-2 py-1 rounded-top text-white small">MAX LOAN</div>
                                    </div>
                                    <div class="loan-amounts d-flex justify-content-between fw-bold">
                                        <div>$22/week</div>
                                        <div>$200,000</div>
                                    </div>


                                    <div class="loan-rates d-flex justify-content-between small">
                                        <div>From 6.74% p/a</div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Additional lender cards can be added similarly -->
                        <!-- <div class="col-6">
                            <div class="lender-card d-flex align-items-center p-3 rounded-3 shadow-sm">
                                <img src="https://moneyme.com.au/wp-content/themes/moneyme/assets/images/logo.svg" alt="Moneyme" class="lender-logo" />
                                <div class="lender-info ms-3 flex-grow-1">
                                    <div class="lender-name fw-bold">Moneyme</div>
                                    <div class="loan-details bg-gradient-moneyme p-2 rounded-2 text-white small">
                                        <div>FROM <span class="fw-bold">$27</span> per week</div>
                                        <div>7 years</div>
                                        <div>From 9.19% p/a</div>
                                        <div>13.27% comparison</div>
                                    </div>
                                    <div class="loan-type small text-muted">Unsecured</div>
                                </div>
                            </div>
                        </div> -->

                        <div class="col-6">
                            <div class="lender-card d-flex p-0 rounded-3 shadow-sm overflow-hidden">
                                <div class="lender-logo-section d-flex flex-column align-items-center justify-content-center bg-white p-3 position-relative">
                                    <img src="{{ asset('assets/images/plenti-logo.png') }}" alt="Wisr" class="lender-logo img-fluid" />

                                </div>
                                <div class="loan-details-section flex-grow-1  bg-gradient-moneyme text-white d-flex flex-column justify-content-center small">
                                    <div class="loan-header d-flex justify-content-between align-items-center">
                                        <div class="from-label bg-purple px-2 py-1 rounded-top text-white small">FROM</div>
                                        <div class="max-loan-label bg-orange px-2 py-1 rounded-top text-white small">MAX LOAN</div>
                                    </div>
                                    <div class="loan-amounts d-flex justify-content-between fw-bold">
                                        <div>$22/week</div>
                                        <div>$200,000</div>
                                    </div>


                                    <div class="loan-rates d-flex justify-content-between small">
                                        <div>From 6.74% p/a</div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-6">
                            <div class="lender-card d-flex align-items-center p-3 rounded-3 shadow-sm">
                                <img src="https://plenti.com.au/wp-content/themes/plenti/assets/images/logo.svg" alt="Plenti" class="lender-logo" />
                                <div class="lender-info ms-3 flex-grow-1">
                                    <div class="lender-name fw-bold">Plenti</div>
                                    <div class="loan-details bg-gradient-plenti p-2 rounded-2 text-white small">
                                        <div>FROM <span class="fw-bold">$30</span> per week</div>
                                        <div>5 years</div>
                                        <div>From 7.49% p/a</div>
                                        <div>13.73% comparison</div>
                                    </div>
                                    <div class="loan-type small text-muted">Unsecured</div>
                                </div>
                            </div>
                        </div> -->

                        <div class="col-6">
                            <div class="lender-card d-flex p-0 rounded-3 shadow-sm overflow-hidden">
                                <div class="lender-logo-section d-flex flex-column align-items-center justify-content-center bg-white p-3 position-relative">
                                    <img src="{{ asset('assets/images/moneyme.png') }}" alt="Wisr" class="lender-logo img-fluid" />

                                </div>
                                <div class="loan-details-section flex-grow-1  bg-gradient-moneyme text-white d-flex flex-column justify-content-center small">
                                    <div class="loan-header d-flex justify-content-between align-items-center">
                                        <div class="from-label bg-purple px-2 py-1 rounded-top text-white small">FROM</div>
                                        <div class="max-loan-label bg-orange px-2 py-1 rounded-top text-white small">MAX LOAN</div>
                                    </div>
                                    <div class="loan-amounts d-flex justify-content-between fw-bold">
                                        <div>$22/week</div>
                                        <div>$200,000</div>
                                    </div>


                                    <div class="loan-rates d-flex justify-content-between small">
                                        <div>From 6.74% p/a</div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- More lender cards can be added here following the same pattern -->
                    </div>
                    <div class="comparison-note text-center mt-3 small text-white   rounded-2 py-1">
                        Comparison Rates &amp; Repayments Include Fees &amp; Charges
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>