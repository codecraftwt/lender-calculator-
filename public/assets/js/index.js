$(document).ready(function () {
    // Multi-step form navigation
    const $steps = $(".multi-step-form .step");
    const $btnNext = $(".btn-next-global");
    const $btnBack = $(".btn-back-global");
    let currentStep = 0;
    let selectedOption = null;

    function showStep(index) {
        $steps.each(function (i) {
            $(this)
                .toggleClass("d-none", i !== index)
                .toggleClass("active", i === index);
        });

        $btnBack.toggle(index > 0);
        $btnNext.toggle(index < $steps.length - 1);
    }

    $(".btn-prev-global").on("click", function () {
        let which_step = $(".step.active").data("step");
        if (which_step - 1 == 1) {
            console.log(which_step);
            $(".btn-prev-global").removeClass("btn-green");
            $(".btn-prev-global").addClass("btn-warning");
        }
    });
    // // Handle loan option selection (Step 1)
    // $(".step-1 .loan-option").click(function () {
    //     $(".step-1 .loan-option").removeClass("selected border border-success");
    //     $(this).addClass("selected border border-success");
    //     selectedOption = $(this).data("next-step");
    //     $(".step-1 .error-message").remove(); // Remove error message when selection is made
    // });

    // Next button click handler
    // $btnNext.click(function () {
    //     const $currentDiv = $steps.eq(currentStep);
    //     if ($currentDiv.hasClass("step-1") && !selectedOption) {
    //         if (!$(".step-1 .error-message").length) {
    //             $("<div>", {
    //                 class: "text-danger mt-2 error-message w-100 ms-5",
    //                 text: "Please select an option before continuing.",
    //             }).insertAfter($currentDiv.find(".loan-options"));
    //         }
    //         return;
    //     }

    //     currentStep = $currentDiv.hasClass("step-1")
    //         ? parseInt(selectedOption) - 1
    //         : currentStep + 1;
    //     showStep(currentStep);
    // });

    // Back button click handler
    $btnBack.click(function () {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    });

    showStep(currentStep);

    // $("loan-option").on("click", function () {
    //     var loan_purpose = $(this).data("loan_type");
    //     triggerAjax(loan_purpose);
    // });

    // Trigger AJAX request
    function triggerAjax() {
        const formData = {
            trading_time: $("#trading_time").val(),
            abn_gst: $("#gst").val(),
            annual_revenue: $("#annual_revenue").val(),
            net_income: $("#net_income").val(),
            credit_score: $("#credit_score").val(),
            bank_statements: $("#bank_statement").val(),
            min_loan_amount: $("#min_loan_amt").val(),
            max_loan_amount: $("#max_loan_amt").val(),
            loan_format: $("#loan_format").val(),
            financials: $("#financials").val(),
            loan_term: $("#loan_term").val(),
            age_of_applicant: $("#age").val(),
            loan_amt: $("#loan_amt").val(),
            interest_rate: $("#interest_rate").val(),
            Guarantee: $("#Guarantee").val(),
            GuaranteeType: $("#GuaranteeType").val(),
            Financials: $("#Financials").val(),
            decision_time: $("#decision_time").val(),
            Repayment_Frequency: $("#Repayment_Frequency").val(),
            EarlyRepayment: $("#EarlyRepayment").val(),
            refinanceOption: $("#refinanceOption").val(),
            monthly_income: $("#monthly_income").val(),
            brokerage: $("#brokerage").val(),
            paydayLoans_option: $("#paydayLoans").val(),
            payday_loan_count: $("#payday_loan_count").val(),
            bankruptcy: $("#bankruptcy").val(),
            bankruptcy_count: $("#bankruptcy_count").val(),
            cashflow_loan: $("#cashflow_loan").val(),
            cashflow_loan_count: $("#cashflow_loan_count").val(),
            IndustryType: $("#IndustryType").val(),
            // Loan_type: Loan_type,
        };

        console.log(formData);

        $.ajax({
            url: "/get-lenders",
            method: "GET",
            data: formData,

            beforeSend: function () {
                $("#loader").show();

                // Add loader inside the lender-cards container
                const loaderHtml = `
            <div class="lender-cards-loader text-center w-100 py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="mt-2   small text-white">Finding best lenders for you...</div>
            </div>`;
                $(".lender-cards").html(loaderHtml);
            },

            success: function (data) {
                console.log(data);

                setTimeout(function () {
                    const $container = $(".lender-cards");
                    $("#matchedLenders").text(data.length);
                    $container.empty(); // Remove loader and old cards

                    if (data.length < 1) {
                        $container.html(`
        <div class="text-danger text-center py-4">
            <div class="no-lenders-container">
                <div class="emoji">❌</div>
                <p style="font-size: 18px; margin-top: 12px; font-weight: 600;">
                    No lenders matched your preference at this moment.
                </p>
            </div>
        </div>
    `);

                        // Update From Box
                        $(".loan-info .from-amount").text(`$0`);
                        $(".loan-info .from-frequency").text("credit score:");
                        $(".loan-info .from-rate").text(`FROM 0%`);
                        $(".loan-info .from-comparison").text(`$0`);

                        // Update Max Box with fallback values
                        $(".loan-info .max-amount").text(`$0`);
                        $(".loan-info .max-unsecured").text(`unsecured`);
                        $(".loan-info .max-secured").text(`$0 secured`);

                        return; // stop execution before using lender
                    } else {
                        // ✅ Now we can safely define and use lender
                        const lender = data[0];

                        // Update From Box
                        $(".loan-info .from-amount").text(
                            `$${lender.min_loan_amount || 0}`
                        );
                        $(".loan-info .from-frequency").text(
                            lender.credit_score
                                ? `${lender.credit_score}+ credit score`
                                : "500+ credit score"
                        );
                        $(".loan-info .from-rate").text(
                            `FROM ${lender.interest_rate || 0}%`
                        );
                        $(".loan-info .from-comparison").text(
                            `${lender.comparison_rate || 0}% comparison`
                        );

                        // Update Max Box
                        $(".loan-info .max-amount").text(
                            `$${lender.max_loan_amount || 0}`
                        );
                        $(".loan-info .max-unsecured").text(
                            lender.unsecured_text || "unsecured"
                        );
                        $(".loan-info .max-secured").text(
                            `$${lender.secured_amount || 0} secured`
                        );
                    }

                    // Then add the lender cards as you already do:
                    data.forEach(function (lender) {
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

                    $("#loader").hide();
                    $(".lender-cards").show();
                }, 1500); // Simulated delay
            },

            error: function (xhr, status, error) {
                console.error("Error fetching lenders:", error);
                $("#loader").hide();
                $(".lender-cards").html(
                    `<div class="text-danger text-center py-4">Unable to load lenders. Please try again.</div>`
                );
            },
        });
    }

    // Trigger AJAX call on input or select change
    $("select, input").on("change input", triggerAjax);

    // Initial AJAX call to load lender data
    triggerAjax();

    // Lender card expand on click
    $(".lender-cards").on("click", ".lender-card", function () {
        $(".lender-card").removeClass("expanded");
        $(this).addClass("expanded");
    });

    // Form section toggle visibility (Guarantee, Credit History, Payday Loans, Bankruptcy, Cashflow Loan)
    $("#Guarantee").change(function () {
        $("#guaranteeTypeDiv").toggle(this.value === "Yes");
    });

    $("#CreditHistory").change(function () {
        const noteMap = {
            clean: "",
            paidDefaults:
                "Some lenders may accept paid defaults or defaults on a payment plan.",
            unpaidDefaults:
                "Only a few lenders may accept unpaid defaults. Eligibility may be limited.",
            dishonours:
                "Dishonoured or overdrawn payments may affect eligibility with certain lenders.",
            bankruptcy:
                "Past insolvency or bankruptcy may require manual assessment.",
        };
        $("#creditNote")
            .text(noteMap[$(this).val()] || "")
            .toggle(!!$(this).val());
    });

    $("#EarlyRepayment").change(function () {
        const noteMap = {
            Yes: "Some lenders may apply penalty on early repayment.",
            No: "Some lenders may accept early repayment without penalty.",
        };

        const selectedVal = $(this).val();
        const noteText = noteMap[selectedVal] || "";

        $("#earlyRepaymentNote").text(noteText).toggle(!!noteText);
    });

    $("#paydayLoans").change(function () {
        $("#payday_loan_div")
            .toggle(this.value === "Yes")
            .find("input")
            .val("");
    });

    $("#bankruptcy").change(function () {
        $("#bankruptcy_div")
            .toggle(this.value === "Yes")
            .find("input")
            .val("");
    });

    $("#cashflow_loan").change(function () {
        $("#cashflow_loan_div")
            .toggle(this.value === "Yes")
            .find("input")
            .val("");
    });
});

$(document).ready(function () {
    const $steps = $(".step");
    const $btnNext = $(".btn-next-global");
    const $btnPrev = $(".btn-prev-global"); // new prev button
    let currentStep = 0;
    let selectedOption = null;

    // Show initial step
    showStep(currentStep);

    // Step 1: select option handler
    $(".loan-option").click(function () {
        $(".loan-option").removeClass("selected");
        $(".btn-next-global").removeClass("btn-warning");
        $(".btn-next-global").addClass("btn-green");
        $(this).addClass("selected");
        selectedOption = $(this).data("next-step");
        $(".step-1 .error-message").remove();
    });

    $("#next_btn").click(function () {
        // $(".btn-prev-global").removeClass("btn-warning");
        // $(".btn-prev-global").addClass("btn-green");
        $(".btn-next-global").removeClass("btn-green");
        $(".btn-next-global").addClass("btn-warning");
    });

    // js to check whether all fields are filled?

    function checkFields() {
        let allFilled = true;

        // Check all inputs and selects that are required
        $("input[required], select[required]").each(function () {
            let value = $.trim($(this).val());
            let hasErrorClass = $(this).hasClass("is-invalid");

            if (value === "" || hasErrorClass) {
                allFilled = false;
            }
        });

        if (allFilled) {
            $(".btn-next-global").removeClass("btn-warning");
            $(".btn-next-global").addClass("btn-green");
        } else {
            $(".btn-next-global").removeClass("btn-green");
            $(".btn-next-global").addClass("btn-warning");
        }
    }

    // Trigger check on input or select change
    $("select[required], input[required]").on("input change", checkFields);

    // Run check once when page loads
    checkFields();

    // validations to numeric input fields
    // Block non-numeric keys on keydown (allow numbers, backspace, delete, arrows, etc.)
    $(
        "#age,#loan_amt, #interest_rate, #annual_revenue, #net_income, #credit_score, #monthly_income, #brokerage, #payday_loan_count, #bankruptcy_count, #cashflow_loan_count"
    ).on("keydown", function (e) {
        // Allow: backspace(8), tab(9), delete(46), arrows(37-40), home(36), end(35), and num keys
        // Also allow Ctrl+A (select all), Ctrl+C, Ctrl+V, Ctrl+X for convenience
        if (
            $.inArray(e.keyCode, [8, 9, 46, 37, 38, 39, 40, 35, 36]) !== -1 ||
            (e.ctrlKey === true && [65, 67, 86, 88].indexOf(e.keyCode) !== -1)
        ) {
            // let it happen, don't block
            return;
        }
        // Block if not a number key (0-9) on both main keyboard and numpad
        if (
            (e.keyCode < 48 || e.keyCode > 57) &&
            (e.keyCode < 96 || e.keyCode > 105)
        ) {
            e.preventDefault();
        }
    });

    // Show error message on input event (after user typed)
    $(
        "#age,#loan_amt, #interest_rate, #annual_revenue, #net_income, #credit_score, #monthly_income, #brokerage, #payday_loan_count, #bankruptcy_count, #cashflow_loan_count"
    ).on("input", function (e) {
        let value = $(this).val().trim();
        let id = $(this).attr("id");
        let errorPara = $("#invalid_" + id);

        if (value === "" || isNaN(value)) {
            $(this).addClass("is-invalid");
            errorPara.removeClass("d-none").addClass("d-block");
        } else {
            $(this).removeClass("is-invalid");
            errorPara.removeClass("d-block").addClass("d-none");
        }
    });

    // validations

    // Next button click
    $btnNext.on("click", function (e) {
        e.preventDefault();
        const $currentDiv = $steps.eq(currentStep);

        // Step 1 validation: check option selected
        if ($currentDiv.hasClass("step-1")) {
            if (!selectedOption) {
                if (!$(".step-1 .error-message").length) {
                    $("<div>", {
                        class: "text-danger mt-2 error-message w-100 ms-5",
                        text: "Please select an option before continuing.",
                    }).insertAfter($currentDiv.find(".loan-options"));
                }
                return; // prevent going forward
            } else {
                $(".step-1 .error-message").remove();
                $(".btn-prev-global").removeClass("btn-warning");
                $(".btn-prev-global").addClass("btn-green");
            }

            currentStep = parseInt(selectedOption) - 1;
            showStep(currentStep);
            return;
        }

        // Step 2 validation: check all select fields inside step-2 are filled
        if ($currentDiv.hasClass("step-2")) {
            let isValid = true;

            $currentDiv.find("select").each(function () {
                if (!$(this).val()) {
                    $(this).addClass("is-invalid");
                    if ($(this).siblings(".invalid-feedback").length === 0) {
                        $(this).after(
                            '<div class="invalid-feedback">This field is required.</div>'
                        );
                    }
                    isValid = false;
                } else {
                    $(this).removeClass("is-invalid");
                    $(this).siblings(".invalid-feedback").remove();
                }
            });

            if (!isValid) {
                return; // stop if validation fails
            }
        }

        // Move to next step if not last
        if (currentStep < $steps.length - 1) {
            currentStep++;
            showStep(currentStep);
        }
    });

    // Previous button click
    $btnPrev.on("click", function (e) {
        e.preventDefault();
        $(".loan-option").each(function () {
            if ($(this).hasClass("selected")) {
                $btnNext.addClass("btn-green");
            }
        });

        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    });

    // Helper: show current step, hide others
    function showStep(step) {
        $steps.removeClass("active").addClass("d-none");
        $steps.eq(step).removeClass("d-none").addClass("active");
    }
});

// $(".loan-option").on("click", function () {
//     var Loan_type = $(this).attr("data-loan-type");
//     console.log(Loan_type);
//     triggerAjax(Loan_type);
// });
