$(document).ready(function() {
    // Multi-step form navigation
    const $steps = $('.multi-step-form .step');
    const $btnNext = $('.btn-next-global');
    const $btnBack = $('.btn-back-global');
    let currentStep = 0;
    let selectedOption = null;

    function showStep(index) {
        $steps.each(function(i) {
            $(this).toggleClass('d-none', i !== index).toggleClass('active', i === index);
        });

        $btnBack.toggle(index > 0);
        $btnNext.toggle(index < $steps.length - 1);
    }

    // Handle loan option selection (Step 1)
    $('.step-1 .loan-option').click(function() {
        $('.step-1 .loan-option').removeClass('selected border border-success');
        $(this).addClass('selected border border-success');
        selectedOption = $(this).data('next-step');
        $('.step-1 .error-message').remove(); // Remove error message when selection is made
    });

    // Next button click handler
    $btnNext.click(function() {
        const $currentDiv = $steps.eq(currentStep);
        if ($currentDiv.hasClass('step-1') && !selectedOption) {
            if (!$('.step-1 .error-message').length) {
                $('<div>', {
                    class: 'text-danger mt-2 error-message w-100 ms-5',
                    text: 'Please select an option before continuing.'
                }).insertAfter($currentDiv.find('.loan-options'));
            }
            return;
        }

        currentStep = $currentDiv.hasClass('step-1') ? parseInt(selectedOption) - 1 : currentStep + 1;
        showStep(currentStep);
    });

    // Back button click handler
    $btnBack.click(function() {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    });

    showStep(currentStep);

    // Trigger AJAX request
    function triggerAjax() {
        const formData = {
            trading_time: $('#trading_time').val(),
            abn_gst: $('#gst').val(),
            annual_revenue: $('#annual_revenue').val(),
            net_income: $('#net_income').val(),
            credit_score: $('#credit_score').val(),
            bank_statements: $('#bank_statement').val(),
            min_loan_amount: $('#min_loan_amt').val(),
            max_loan_amount: $('#max_loan_amt').val(),
            loan_format: $('#loan_format').val(),
            financials: $('#financials').val(),
            loan_term: $('#loan_term').val()
        };

        $.ajax({
            url: "/get-lenders",
            method: "GET",
            data: formData,

            beforeSend: function() {
                $('#loader').show();

                // Add loader inside the lender-cards container
                const loaderHtml = `
            <div class="lender-cards-loader text-center w-100 py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="mt-2   small text-white">Finding best lenders for you...</div>
            </div>`;
                $('.lender-cards').html(loaderHtml);
            },

            success: function(data) {
                setTimeout(function() {
                    const $container = $('.lender-cards');
                    $('#matchedLenders').text(data.length);
                    $container.empty(); // Remove the loader and old cards

                    data.forEach(function(lender) {
                        const cardHtml = `
                    <div class="col-6">
                        <div class="lender-card d-flex p-0 rounded-3 shadow-sm overflow-hidden" data-lender-id="${lender.id}" id="lenderCard${lender.id}">
                            <div class="lender-logo-section d-flex flex-column align-items-center justify-content-center bg-white p-3 position-relative">
                                <img src="/assets/images/${lender.lender_image}" alt="${lender.lender_name}" class="lender-logo img-fluid" data-lender-logo />
                            </div>
                            <div class="loan-details-section flex-grow-1 bg-gradient-moneyme text-white d-flex flex-column justify-content-center small">
                                <p class="fw-bold text-center">${lender.lender_name}</p>
                                <div class="loan-header d-flex justify-content-between align-items-center">
                                    <div class="from-label bg-purple px-2 py-1 rounded-top text-white small">FROM</div>
                                    <div class="max-loan-label bg-orange px-2 py-1 rounded-top text-white small">MAX LOAN</div>
                                </div>
                                <div class="loan-amounts d-flex justify-content-between fw-bold">
                                    <div>$${lender.min_loan_amount}</div>
                                    <div data-max-loan-amount>$${lender.max_loan_amount}</div>
                                </div>
                                <div class="loan-rates d-flex justify-content-between small">
                                    <div>From ${lender.credit_score}+ credit score</div>
                                </div>
                            </div>
                            <div class="expanded-content bg-light p-0">
                                <div class="d-flex justify-content-between align-items-center" style="background: linear-gradient(90deg, #4a3f9a 0%, #6a5de8 100%);">
                                    <span class=" text-white" style="font-size:13px;margin:19px">Click here to finish on a call with a specialist.</span>
                                    <span class="circle-btn"><span class="text-white">or</span></span>
                                    <span class=" text-white" style="font-size:13px;margin:22px">Keep entering data to see your perfect match.</span>
                                </div>
                            </div>
                        </div>
                    </div>`;
                        $container.append(cardHtml);
                    });

                    $('#loader').hide();
                    $('.lender-cards').show();
                }, 1500); // Simulated delay
            },

            error: function(xhr, status, error) {
                console.error('Error fetching lenders:', error);
                $('#loader').hide();
                $('.lender-cards').html(`<div class="text-danger text-center py-4">Unable to load lenders. Please try again.</div>`);
            }
        });
    }

    // Trigger AJAX call on input or select change
    $('select, input').on('change input', triggerAjax);

    // Initial AJAX call to load lender data
    triggerAjax();

    // Lender card expand on click
    $('.lender-cards').on('click', '.lender-card', function() {
        $('.lender-card').removeClass('expanded');
        $(this).addClass('expanded');
    });

    // Form section toggle visibility (Guarantee, Credit History, Payday Loans, Bankruptcy, Cashflow Loan)
    $('#Guarantee').change(function() {
        $('#guaranteeTypeDiv').toggle(this.value === "Yes");
    });

    $('#CreditHistory').change(function() {
        const noteMap = {
            clean: '',
            paidDefaults: 'Some lenders may accept paid defaults or defaults on a payment plan.',
            unpaidDefaults: 'Only a few lenders may accept unpaid defaults. Eligibility may be limited.',
            dishonours: 'Dishonoured or overdrawn payments may affect eligibility with certain lenders.',
            bankruptcy: 'Past insolvency or bankruptcy may require manual assessment.'
        };
        $('#creditNote').text(noteMap[$(this).val()] || '').toggle(!!$(this).val());
    });

    $('#paydayLoans').change(function() {
        $('#payday_loan_div').toggle(this.value === 'Yes').find('input').val('');
    });

    $('#bankruptcy').change(function() {
        $('#bankruptcy_div').toggle(this.value === 'Yes').find('input').val('');
    });

    $('#cashflow_loan').change(function() {
        $('#cashflow_loan_div').toggle(this.value === 'Yes').find('input').val('');
    });
}); 