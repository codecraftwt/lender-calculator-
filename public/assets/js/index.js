$(document).ready(function () {
    const $steps = $(".multi-step-form .step"),
        $btnNext = $(".btn-next-global"),
        $btnPrev = $(".btn-back-global");
    let currentStep = 0,
        selectedOption = null;

    function showStep(index) {
        $steps.each(function (i) {
            $(this)
                .toggleClass("d-none", i !== index)
                .toggleClass("active", i === index);
        });
        $btnPrev.toggle(index > 0);
        $btnNext.toggle(index < $steps.length - 1);
    }

    $(".btn-prev-global").on("click", function () {
        let which_step = $(".step.active").data("step");
        if (which_step - 1 == 1) {
            $(".btn-prev-global")
                .removeClass("btn-green")
                .addClass("btn-warning");
        }
    });

    $btnPrev.click(function () {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    });

    showStep(currentStep);

    function triggerAjax() {
        const formData = {
            trading_time: $("#time_in_business").val(),
            loan_amt: $("#loan_amt").val(),
            credit_score: $("#credit_score").val(),
            monthly_income: $("#monthly_revenue").val(),
            negative_days: $("#negative_days").val(),
            number_of_dishonours: $("#number_of_dishonours").val(),
            asset_backed: $("#asset_backed").val(),
        };
        console.log(formData);
        $.ajax({
            url: "/get-lenders",
            method: "GET",
            data: formData,
            beforeSend: function () {
                $("#loader").show();
                const loaderHtml = `<div class="lender-cards-loader text-center w-100 py-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div><div class="mt-2 small text-white">Finding best lenders for you...</div></div>`;
                $(".lender-cards").html(loaderHtml);
            },
            success: function (data) {
                console.log(data);
                setTimeout(function () {
                    const $container = $(".lender-cards");
                    $("#matchedLenders").text(data.length);
                    $container.empty();
                    if (data.length < 1) {
                        $container.html(
                            `<div class="text-danger text-center py-4"><div class="no-lenders-container"><div class="emoji">❌</div><p style="font-size: 18px; margin-top: 12px; font-weight: 600;">No lenders matched your preference at this moment.</p></div></div>`
                        );
                        $(".loan-info .from-amount").text("$0");
                        $(".loan-info .from-frequency").text("credit score:");
                        $(".loan-info .from-rate").text(`FROM 0%`);
                        $(".loan-info .from-comparison").text(`$0`);
                        $(".loan-info .max-amount").text(`$0`);
                        $(".loan-info .max-unsecured").text(`unsecured`);
                        $(".loan-info .max-secured").text(`$0 secured`);
                        return;
                    } else {
                        const lender = data[0];
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
                    data.forEach(function (lender) {
                        const cardHtml = `<div class="col-6"><div class="lender-card d-flex p-0 rounded-3 shadow-sm overflow-hidden" data-lender-id="${lender.id}" id="lenderCard${lender.id}"><div class="lender-logo-section d-flex flex-column align-items-center justify-content-center bg-white p-3 position-relative"><img src="/assets/images/${lender.lender_image}" alt="${lender.lender_name}" class="lender-logo img-fluid" data-lender-logo /></div><div class="loan-details-section flex-grow-1 bg-gradient-moneyme text-white d-flex flex-column justify-content-center small"><p class="fw-bold text-center">${lender.lender_name}</p><div class="loan-header d-flex justify-content-between align-items-center"><div class="from-label bg-purple px-2 py-1 rounded-top text-white small">FROM</div><div class="max-loan-label bg-orange px-2 py-1 rounded-top text-white small">MAX LOAN</div></div><div class="loan-amounts d-flex justify-content-between fw-bold"><div>$${lender.min_loan_amount}</div><div data-max-loan-amount>$${lender.max_loan_amount}</div></div><div class="loan-rates d-flex justify-content-between small"><div>From ${lender.credit_score}+ credit score</div></div></div><div class="expanded-content bg-light p-0"><div class="d-flex justify-content-between align-items-center" style="background: linear-gradient(90deg, #4a3f9a 0%, #6a5de8 100%);"><span class=" text-white" style="font-size:13px;margin:19px">Click here to finish on a call with a specialist.</span><span class="circle-btn"><span class="text-white">or</span></span><span class=" text-white" style="font-size:13px;margin:22px">Keep entering data to see your perfect match.</span></div></div></div></div>`;
                        $container.append(cardHtml);
                    });
                    $("#loader").hide();
                    $(".lender-cards").show();
                }, 1500);

                $("#applicable_lenders").val(JSON.stringify(data));
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

    $(".step-2").find("select, input").on("change input", triggerAjax);
    triggerAjax();

    $(".lender-cards").on("click", ".lender-card", function () {
        $(".lender-card").removeClass("expanded");
        $(this).addClass("expanded");
    });

    showStep(currentStep);

    $(".loan-option").click(function () {
        $(".loan-option").removeClass("selected");
        $(".btn-next-global").removeClass("btn-warning").addClass("btn-green");
        $(this).addClass("selected");
        selectedOption = $(this).data("next-step");
        $(".step-1 .error-message").remove();
    });

    $("#next_btn").click(function () {
        $(".btn-next-global").removeClass("btn-green").addClass("btn-warning");
    });

    function checkFields() {
        let allFilled = true;
        $("input[required], select[required]").each(function () {
            let value = $.trim($(this).val());
            let hasErrorClass = $(this).hasClass("is-invalid");
            if (value === "" || hasErrorClass) {
                allFilled = false;
            }
        });
        if (allFilled) {
            $(".btn-next-global")
                .removeClass("btn-warning")
                .addClass("btn-green");
        } else {
            $(".btn-next-global")
                .removeClass("btn-green")
                .addClass("btn-warning");
        }
    }

    $("select[required], input[required]").on("input change", checkFields);
    checkFields();

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

    function showStep(step) {
        $steps.removeClass("active").addClass("d-none");
        $steps.eq(step).removeClass("d-none").addClass("active");
    }

    // new js

    const step1Fields = [
        "company_name",
        "director_name",
        "director_email",
        "director_phone",
    ];
    const step2Fields = [
        "loan_amt",
        "monthly_revenue",
        "time_in_business",
        "credit_score",
        "negative_days",
        "number_of_dushonours",
        "asset_backed",
    ];

    showStep(currentStep);

    function showStep(step) {
        $(".step").removeClass("active").addClass("d-none");
        $(".step").eq(step).removeClass("d-none").addClass("active");
        currentStep = step;
    }

    function showError(id, msg = "This field is required.") {
        $(`#invalid_${id}`).text(msg).removeClass("d-none");
        return false;
    }

    function validateField(id) {
        const val = $(`#${id}`).val().trim();
        $(`#invalid_${id}`).addClass("d-none");

        switch (id) {
            case "company_name":
                return val !== "" || showError(id);
            case "director_name":
                return (
                    /^[A-Za-z\s]+$/.test(val) ||
                    showError(id, "Please enter a valid name (letters only).")
                );
            case "director_email":
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val) || showError(id);
            case "director_phone":
                return (
                    /^\+?[0-9\s\-().]{7,20}$/.test(val) ||
                    showError(id, "Please enter a valid phone number.")
                );
            case "loan_amt":
            case "monthly_revenue":
                return (
                    (/^[0-9]+$/.test(val) && parseInt(val) > 0) ||
                    showError(id, "Please enter a valid amount.")
                );
            case "time_in_business":
                return (
                    /^[0-9]+$/.test(val) ||
                    showError(id, "Please enter valid months.")
                );
            case "credit_score":
                return (
                    (/^[0-9]+$/.test(val) && val >= 0 && val <= 1200) ||
                    showError(id, "Please enter valid credit score (0–1200).")
                );
            case "negative_days":
            case "number_of_dushonours":
                return (
                    /^[0-9]+$/.test(val) ||
                    showError(id, "Please enter a valid number.")
                );
            case "asset_backed":
                return (
                    val === "Yes" ||
                    val === "No" ||
                    showError(id, "Please select a valid option.")
                );
        }

        return true;
    }

    function validateAll(fields) {
        return fields.every((id) => validateField(id));
    }

    // Validate only the currently changed field on input/change
    $("input, select").on("input change", function () {
        validateField(this.id);
        const allStep1Valid = [
            "company_name",
            "director_name",
            "director_email",
            "director_phone",
        ].every(validateField);

        $(".btn-next-global")
            .toggleClass("btn-green", allStep1Valid)
            .toggleClass("btn-warning", !allStep1Valid);
    });

    // Handle button click for next or submit
    $(".btn-next-global").on("click", function (e) {
        const fields = currentStep === 0 ? step1Fields : step2Fields;

        if (!validateAll(fields)) {
            e.preventDefault();
            $(this).removeClass("btn-green").addClass("btn-warning");
        } else {
            $(this).removeClass("btn-warning").addClass("btn-green");

            if (currentStep === 0) {
                // Move to step 2
                showStep(1);
                currentStep = 1;

                // Change button to submit type and update style
                $(this)
                    .attr("type", "submit")
                    .css({ width: "150px", height: "40px", color: "white" })
                    .html("Submit");
                $(this).removeClass("rounded-circle");
                $("#next_btn").addClass("d-none");
                $("#submit-btn").removeClass("d-none");
            }
            // For step 2, all validations passed, allow form to submit naturally (no e.preventDefault)
        }
    });
});
