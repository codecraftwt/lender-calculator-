$(document).ready(function () {
    console.log("index.js Loaded...");
    const $steps = $(".multi-step-form .step"),
        $btnNext = $(".btn-next-global");
    // $btnPrev = $(".btn-prev-global");
    let currentStep = 0,
        selectedOption = null;

    // js for ajax

    function triggerAjax() {
        const formData = {
            trading_time: $("#time_in_business").val(),
            loan_amt: $("#loan_amt").val(),
            credit_score: $("#credit_score").val(),
            monthly_income: $("#monthly_revenue").val(),
            negative_days: $("#negative_days").val(),
            number_of_dishonours: $("#number_of_dishonours").val(),
            abn_gst: $("#abn_gst").val(),
            gst_date: $("#gst_date").val(),
            property_owner: $("#property_owner").val(),
            restricted_industry: $("#restricted_industry").val(),
            _token: $('meta[name="csrf-token"]').attr("content"),
        };
        console.log(formData);
        $.ajax({
            url: "/get-lender",
            method: "POST",
            data: formData,
            beforeSend: function () {
                $("#loader").show();
                const loaderHtml = `<div class="lender-cards-loader text-center w-100 py-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div><div class="mt-2 small text-white">Finding best lenders for you...</div></div>`;
                $(".lender-cards").html(loaderHtml);
            },
            success: function (data) {
                console.log(data);

                const $container = $(".lender-cards");
                const lendersArray = Object.values(data); // 👈 Convert object to array
                $("#matchedLenders").text(lendersArray.length);
                $container.empty();

                const lenderIds = lendersArray.map((item) => item.id);
                $("#applicable_lenders").val(JSON.stringify(lenderIds));

                // Optional: If you want to render lender cards, loop through lendersArray
                // lendersArray.forEach(lender => {
                //     // build and append HTML to $container
                // });
            },
            error: function (xhr, status, error) {
                if (xhr.status == 401) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        html: "<span style='color:red'>Your account is deactivated. Please contact admin!</span>",
                    });
                }
                console.error("Error fetching lenders:", error);
                $("#loader").hide();
                $(".lender-cards").html(
                    `<div class="text-danger text-center py-4">Unable to load lenders. Please try again.</div>`
                );
            },
        });
    }

    $(".loan-details").find("select, input").on("change input", triggerAjax);
    // triggerAjax();

    $(".lender-cards").on("click", ".lender-card", function () {
        $(".lender-card").removeClass("expanded");
        $(this).addClass("expanded");
    });

    function checkFields() {
        let allFilled = true;
        $(".multi-step-form")
            .find("input[required], select[required]")
            .each(function () {
                let value = $.trim($(this).val());
                let hasErrorClass = $(this).hasClass("is-invalid");
                if (value === "" || hasErrorClass) {
                    allFilled = false;
                }
            });
    }

    $(".multi-step-form")
        .find("select[required], input[required]")
        .on("input change", checkFields);
    checkFields();

    function showStep(step) {
        $steps.removeClass("active").addClass("d-none");
        $steps.eq(step).removeClass("d-none").addClass("active");
    }

    //   js for form validations
    //   js for form validations

    function showError(id, msg = "This field is required.") {
        $(`#invalid_${id}`).text(msg).removeClass("d-none");
        return false;
    }

    // validation check

    const stepFields = [
        "company_name",
        "director_name",
        "director_email",
        "director_phone",
        "loan_amt",
        "monthly_revenue",
        "time_in_business",
        "credit_score",
        "negative_days",
        "number_of_dishonours",
        "asset_backed",
        // Newly added fields:
        "abn_date",
        "entity_type",
        "company_credit_score",
        "property_owner",
        "industry_type",
        "restricted_industry",
        "abn_gst",
    ];

    const validateField = (id, showErrorMessage = true) => {
        const $field = $(`#${CSS.escape(id)}`);

        // Use `.val()` safely
        let val = $field.val();
        if (typeof val === "string") {
            val = val.trim();
        }

        if (showErrorMessage) {
            $(`#invalid_${CSS.escape(id)}`).addClass("d-none");
        }

        switch (id) {
            case "company_name":
                return (
                    val.length > 0 ||
                    (showErrorMessage &&
                        showError(id, "Company name is required."))
                );

            case "director_name":
                return (
                    /^[A-Za-z\s]+$/.test(val) ||
                    (showErrorMessage &&
                        showError(
                            id,
                            "Please enter a valid name (letters only)."
                        ))
                );

            case "director_email":
                return (
                    /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val) ||
                    (showErrorMessage &&
                        showError(id, "Invalid email address."))
                );

            case "director_phone":
                return (
                    /^\+?[0-9\s\-().]{7,20}$/.test(val) ||
                    (showErrorMessage &&
                        showError(id, "Please enter a valid phone number."))
                );

            case "loan_amt":
            case "monthly_revenue":
                return (
                    (/^[0-9]+$/.test(val) && parseInt(val) > 0) ||
                    (showErrorMessage &&
                        showError(id, "Please enter a valid amount."))
                );

            case "time_in_business":
                return (
                    /^[0-9]+$/.test(val) ||
                    (showErrorMessage &&
                        showError(id, "Please enter valid months."))
                );

            case "credit_score":
                return (
                    (/^[0-9]+$/.test(val) && val >= 0 && val <= 1200) ||
                    (showErrorMessage &&
                        showError(
                            id,
                            "Please enter a valid credit score (0–1200)."
                        ))
                );

            case "abn_date":
                const selectedDate = new Date(val);
                const currentDate = new Date();

                // Normalize time to compare date-only
                selectedDate.setHours(0, 0, 0, 0);
                currentDate.setHours(0, 0, 0, 0);

                const isValidDate = selectedDate < currentDate;

                if (isValidDate) {
                    // Difference in days
                    const timeDiff = selectedDate - currentDate;
                    const diffDays = Math.ceil(
                        Math.abs(timeDiff) / (1000 * 60 * 60 * 24)
                    );

                    // Approximate months, force non-negative
                    let diffMonths = Math.floor(diffDays / 30);
                    diffMonths = Math.max(diffMonths, 0); // Ensure no negatives
                    $("#time_in_business").val(diffMonths);
                }

                return (
                    isValidDate ||
                    (showErrorMessage &&
                        showError(
                            id,
                            "Please enter a valid ABN registration date."
                        ))
                );

            case "negative_days":
            case "number_of_dishonours":
                // Always validate (empty is invalid)
                return (
                    /^[0-9]+$/.test(val) ||
                    (showErrorMessage &&
                        showError(id, "Please enter a valid number."))
                );

            case "company_credit_score":
            case "property_owner":
            case "industry_type":
                return (
                    val !== "" ||
                    (showErrorMessage &&
                        showError(id, "Please select a valid option."))
                );

            case "abn_gst":
                const abnGstVal = val?.toLowerCase().trim(); // safely get and normalize value

                // ✅ Allow empty value — no error message
                if (!abnGstVal) {
                    return true;
                }

                // Step 2: If "yes", gst_date must be filled
                if (abnGstVal === "yes") {
                    const gstDateVal = $("#gst_date").val();
                    const isGstDateFilled =
                        gstDateVal && gstDateVal.trim() !== "";

                    return (
                        isGstDateFilled ||
                        (showErrorMessage &&
                            showError(
                                "gst_date",
                                "GST registration date is required when GST is 'Yes'."
                            ))
                    );
                }
                if (abnGstVal === "no") {
                    $(`#invalid_${id}`).addClass("d-none"); // hide abn_gst error if visible
                    $("#invalid_gst_date").addClass("d-none"); // also hide gst_date error if it was shown
                    return true;
                }
                // Step 3: If "no" or anything else, all good
                return true;

            case "abn_date":
                return (
                    val !== "" ||
                    (showErrorMessage &&
                        showError(id, "Please enter a valid date."))
                );

            default:
                return true;
        }
    };

    function validateAll(fields, showErrorMessage = false) {
        return fields.every((id) => validateField(id, showErrorMessage));
    }
    $("input, select").on("input change", function () {
        validateField(this.id, true);

        const allStep1Valid = validateAll(stepFields);
    });

    $btnNext.on("click", function (e) {
        const fields = $(".multi-step-form")
            .find("input[id], select[id]") // only elements WITH an id
            .not("textarea")
            .map(function () {
                return this.id;
            })
            .get()
            .filter((id) => id && id.trim() !== "");

        if (!validateAll(fields, true)) {
            e.preventDefault();
        } else {
            e.preventDefault();

            // ✅ Get values
            const companyName = $("#company_name").val();
            const directorName = $("#director_name").val();
            const directorEmail = $("#director_email").val();
            const directorPhone = $("#director_phone").val();
            const loanAmt = $("#loan_amt").val();
            const monthlyRevenue = $("#monthly_revenue").val();
            const timeInBusiness = $("#time_in_business").val();
            const creditScore = $("#credit_score").val();
            const negativeDays = $("#negative_days").val();
            const numberOfDishonours = $("#number_of_dishonours").val();
            const abn_gst = $("#abn_gst").val();
            const abnDate = $("#abn_date").val();
            const gstDate = $("#gst_date").val();
            const entityType = $("#entity_type").val();
            const companyCreditScore = $("#company_credit_score").val();
            const propertyOwner = $("#property_owner").val();
            const industryType = $("#industry_type").val();
            const restricted_industry = $("#restricted_industry").val();

            Swal.fire({
                title: "Please Check Your Details",
                showCancelButton: true,
                confirmButtonText: "Confirm & Submit",
                cancelButtonText: "Back",
                reverseButtons: true,
                width: 800,
                html: `
<div class="col-md-12" style="border: 1px solid black; padding: 10px; border-radius: 10px; font-size: 14px; color: #333;">
    <h5 style="color: #b47dee;"><i class="fa fa-user" style="font-size: 16px; color: #b47dee;"></i> Client Details</h5>
    <hr>
    <div class="row">
        ${inputGroup("Company Name", companyName, "fas fa-building")}
        ${inputGroup("Director Name", directorName, "fa-solid fa-user")}
        ${inputGroup("Email", directorEmail, "fas fa-envelope")}
        ${inputGroup("Phone", directorPhone, "fas fa-mobile-alt")}
        ${inputGroup(
            "ABN Registration Date",
            abnDate,
            "fa-solid fa-calendar-days"
        )}
        ${inputGroup("GST Registration", abn_gst)}
        ${inputGroup(
            "GST Registration Date",
            gstDate,
            "fa-solid fa-calendar-days"
        )}
        ${inputGroup("Entity Type", entityType)}
        ${inputGroup("Company Credit Score", companyCreditScore)}
        ${inputGroup("Property Owner", propertyOwner)}
        ${inputGroup("Industry", industryType)}
         ${inputGroup("Restricted Industry", restricted_industry)}
    </div>

    <hr>
    <h5 style="color: #b47dee;"><i class="fa fa-briefcase" style="font-size: 16px; color: #b47dee;"></i> Loan Details</h5>
    <hr>
    <div class="row">
        ${inputGroup("Loan Amount", "$" + loanAmt, "fa-solid fa-dollar-sign")}
        ${inputGroup(
            "Monthly Revenue",
            "$" + monthlyRevenue,
            "fa-solid fa-dollar-sign"
        )}
        ${inputGroup(
            "Time in Business (months)",
            timeInBusiness,
            "fa-solid fa-calendar"
        )}
        ${inputGroup("Credit Score", creditScore, "fa-solid fa-credit-card")}
        ${inputGroup(
            "Negative Days",
            negativeDays,
            "fa-solid fa-calendar-days"
        )}
        ${inputGroup("Dishonours", numberOfDishonours)}
    </div>
</div>
            `,
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#lender_form").submit();
                }
            });
        }
    });

    function inputGroup(label, value, icon = "") {
        return `
        <div class="col-md-6 form-group" style="margin-bottom:10px">
            <label style="font-weight:500;float:left">${label}:</label>
            <div class="input-group">
                ${
                    icon
                        ? `<span class="input-group-text"><i class="${icon}"></i></span>`
                        : ""
                }
                <input class="form-control" style="background-color:#e5e5e5" value="${value}" readonly />
            </div>
        </div>
    `;
    }

    const today = new Date();
    today.setDate(today.getDate() - 1);
    const maxDate = today.toISOString().split("T")[0];
    $("#abn_date, #gst_date").attr("max", maxDate);

    // $("#gst_date").on("input change", function () {
    //     const gstDateVal = $(this).val();
    //     const gstDate = new Date(gstDateVal);
    //     const today = new Date();

    //     // Debug logs
    //     console.log("GST Date Raw:", gstDateVal);
    //     console.log("Parsed GST Date:", gstDate);

    //     if (isNaN(gstDate.getTime())) {
    //         $("#invalid_gst_date")
    //             .removeClass("d-none")
    //             .text("Please enter a valid GST registration date.");
    //         $("#gst_time").val(""); // clear invalid value
    //         return;
    //     }

    //     // ✅ Calculate absolute months difference
    //     let months = Math.abs(
    //         (today.getFullYear() - gstDate.getFullYear()) * 12 +
    //             (today.getMonth() - gstDate.getMonth())
    //     );

    //     // Optionally adjust if the day is before today
    //     if (today.getDate() < gstDate.getDate()) {
    //         months = Math.max(0, months - 1);
    //     }

    //     // ✅ Set the calculated value
    //     $("#gst_time").val(`${months} month${months !== 1 ? "s" : ""}`);

    //     // ✅ Hide error if shown
    //     $("#invalid_gst_date").addClass("d-none");
    // });
});

$(document).ready(function () {
    $("#industry_type").select2({
        placeholder: "Select or enter your industry",
        tags: true,
        allowClear: true,
        language: {
            noResults: function () {
                return "Can't find your industry? Start typing to add it manually.";
            },
        },
    });

    $(document).ready(function () {
        $("#restricted_industry").select2({
            placeholder: "Select industries",
            allowClear: true,
        });
    });

    // Apply CSS dynamically via JS to the Select2 container and elements
    const $container = $("#industry_type").next(".select2-container");

    // Style the main selection box
    $container.find(".select2-selection--single").css({
        height: "38px",
        padding: "6px 12px",
        border: "1px solid #ced4da",
        "border-radius": "0.375rem",
        "background-color": "#fff",
        "box-sizing": "border-box",
        cursor: "pointer",
        display: "flex",
        "align-items": "center",
    });

    // Style the displayed text inside selection box
    $container.find(".select2-selection__rendered").css({
        "line-height": "1.5",
        "padding-left": "0",
        "padding-right": "0",
        color: "#495057",
        width: "100%",
        "white-space": "nowrap",
        overflow: "hidden",
        "text-overflow": "ellipsis",
    });

    // Style the dropdown arrow container
    $container.find(".select2-selection__arrow").css({
        height: "100%",
        right: "10px",
        width: "20px",
    });

    // Make sure Select2 container fills parent width
    $container.css({
        width: "100%",
    });
});

// abn api
const input = document.getElementById("company_name");
const spinner = document.getElementById("loading-spinner");
const companyList = document.getElementById("company_list");

$(document).ready(function () {
    let debounceTimer = null;
    let currentRequest = null;

    $("#company_name").on("input", function () {
        const query = $(this).val().trim();
        const companyList = $("#company_list");

        // Clear previous debounce timer
        clearTimeout(debounceTimer);

        // Abort previous request if still running
        if (currentRequest && currentRequest.readyState !== 4) {
            currentRequest.abort();
        }

        companyList.empty();

        if (query.length < 3) {
            // If less than 3 chars, don't call API or show spinner
            return;
        }

        // Show spinner immediately when user starts typing
        companyList.html(`
      <div class="d-flex justify-content-center align-items-center py-2">
        <div class="spinner-border text-primary" role="status" style="width: 1.5rem; height: 1.5rem;">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
    `);

        // Set debounce timer - only send API request after 500ms pause
        debounceTimer = setTimeout(() => {
            currentRequest = $.ajax({
                url: "/api/abn-lookup",
                method: "GET",
                data: { query: query },
                dataType: "json",
                success: function (companies) {
                    if (!companies.length) {
                        companyList.html(
                            '<div class="list-group-item">No matches found</div>'
                        );
                        return;
                    }

                    let html = "";
                    $.each(companies, function (index, item) {
                        html += `<a href="#" class="list-group-item list-group-item-action d-flex" data-abn="${item.Abn}">
  <span style="font-weight:600">${item.Name}</span> 
  <span style="color:#666666" class="ms-auto">
    [ <small>ABN: </small> ${item.Abn} ]
  </span>
</a>`;
                    });

                    companyList.html(html);
                },
                error: function (xhr, status) {
                    if (status !== "abort") {
                        companyList.html(
                            '<div class="list-group-item text-danger">Error fetching data</div>'
                        );
                    }
                },
            });
        }, 500); // 500ms debounce delay
    });

    // Handle click on company name to populate input and fetch details with spinner
    $("#company_list").on("click", "a.list-group-item-action", function (e) {
        e.preventDefault();
        const abn = $(this).data("abn");
        const companyList = $("#company_list");

        companyList.html(`
      <div class="d-flex justify-content-center align-items-center py-2">
        <div class="spinner-border text-primary" role="status" style="width: 1.5rem; height: 1.5rem;">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
    `);

        fetch(`/api/abn-details?abn=${abn}`)
            .then((res) => {
                if (!res.ok) {
                    throw new Error(`HTTP error! status: ${res.status}`);
                }
                return res.json();
            })
            .then((data) => {
                $("#company_name").val(data.EntityName || "");

                if (data) {
                    console.log(data);
                    $("#abn_date").val(data.AbnStatusEffectiveFrom || "");
                    $("#gst_date").val(data.Gst || "");
                    $("#abn_gst").val(data.Gst ? "Yes" : "No");
                    $("#entity_type").val(data.EntityTypeName || "");

                    if (data.AbnStatusEffectiveFrom) {
                        const abnDate = new Date(data.AbnStatusEffectiveFrom);
                        const today = new Date();
                        const months =
                            (today.getFullYear() - abnDate.getFullYear()) * 12 +
                            (today.getMonth() - abnDate.getMonth());
                        $("#time_in_business").val(months);

                        if (data.Gst) {
                            let gst_date_raw = data.Gst;

                            if (gst_date_raw) {
                                const gst_date = new Date(gst_date_raw);
                                const today = new Date();

                                if (!isNaN(gst_date.getTime())) {
                                    // ✅ Calculate absolute months difference
                                    let gst_months = Math.abs(
                                        (today.getFullYear() -
                                            gst_date.getFullYear()) *
                                            12 +
                                            (today.getMonth() -
                                                gst_date.getMonth())
                                    );

                                    // Optionally adjust if the day is before today
                                    if (today.getDate() < gst_date.getDate()) {
                                        gst_months = Math.max(
                                            0,
                                            gst_months - 1
                                        );
                                    }

                                    // ✅ Set the calculated value
                                    $("#gst_time").val(`${gst_months}`);
                                } else {
                                    console.error(
                                        "Invalid GST date format:",
                                        gst_date_raw
                                    );
                                    $("#gst_time").val(""); // Clear value on error
                                }
                            } else {
                                console.warn("No GST date returned in data.");
                                $("#gst_time").val(""); // Clear value if GST is missing
                            }
                        }

                        // ✅ Hide error if shown
                        $("#invalid_gst_date").addClass("d-none");
                    } else {
                        $("#time_in_business").val("");
                    }
                }

                companyList.empty(); // Clear spinner and list after loading
            })
            .catch((err) => {
                console.error("Error loading ABN details:", err);
                companyList.html(
                    '<div class="list-group-item text-danger">Error loading details</div>'
                );
            });
    });

    $("#submit-document-id").on("click", function () {
        var document_id = $("#document_id").val();
        // console.log(document_id);

        const button = document.getElementById("submit-document-id");
        const spinner = button.querySelector(".spinner");
        const btnText = document.getElementById("btn-text");
        btnText.style.display = "none";
        spinner.style.display = "inline-block";

        $.ajax({
            url: "fetch-bank-statement",
            method: "GET",
            data: { document_id: document_id },
            dataType: "json",
            // success: function (response) {
            //     spinner.style.display = "none";
            //     btnText.style.display = "inline-block";
            //     button.style.opacity = 0.5;
            //     button.disabled = true;
            //     console.log(response);
            // },
            // success: function (response) {
            //     spinner.style.display = "none";
            //     btnText.style.display = "inline-block";
            //     console.log(response);

            //     if (!response.success) {
            //         Swal.fire("Error", "Failed to fetch Illion data", "error");
            //         return;
            //     }

            //     const data = response.data || {};
            //     const metrics = data.decisionMetrics || []; // array of {id,name,type,value,...}

            //     // helper to find metric object (returns undefined if not found)
            //     function getMetric(id) {
            //         return metrics.find((m) => m.id === id);
            //     }

            //     // helper to get numeric or object value
            //     function metricValue(id) {
            //         const m = getMetric(id);
            //         if (!m) return null;
            //         return m.value;
            //     }

            //     // If the metric value is an object with months, return formatted string and numeric helpers
            //     function formatMonthlyMetric(metricObj) {
            //         // metricObj is either a string/number OR an object like { "Month 1": "1126.94", ... }
            //         if (metricObj == null)
            //             return { display: "N/A", average: 0, total: 0 };

            //         if (typeof metricObj === "object") {
            //             const months = Object.values(metricObj).map(
            //                 (v) => parseFloat(v) || 0
            //             );
            //             const total = months.reduce((s, n) => s + n, 0);
            //             const avg = months.length ? total / months.length : 0;
            //             // create friendly small HTML/text for months
            //             const monthParts = Object.entries(metricObj).map(
            //                 ([k, v]) => `${k}: ${parseFloat(v).toFixed(2)}`
            //             );
            //             return {
            //                 display: monthParts.join(" | "),
            //                 average: avg,
            //                 total: total,
            //             };
            //         } else {
            //             // string or number
            //             const n = parseFloat(metricObj) || 0;
            //             return {
            //                 display: parseFloat(metricObj).toFixed(2),
            //                 average: n,
            //                 total: n,
            //             };
            //         }
            //     }

            //     // populate basic info
            //     $("#ref").text(data.reference || "N/A");
            //     $("#sub_time").text(data.submissionTime || "N/A");

            //     // Monthly Income BF002 (object -> month map)
            //     const bf002 = metricValue("BF002");
            //     const bf002Res = formatMonthlyMetric(bf002);
            //     $("#monthly_income").text(bf002Res.display);

            //     // Monthly Turnover BM001
            //     const bm001 = metricValue("BM001");
            //     const bm001Res = formatMonthlyMetric(bm001);
            //     $("#monthly_turnover").text(bm001Res.display);

            //     // Annual Income = average monthly income * 12 (use bf002 average if available)
            //     const annualIncome = (bf002Res.average || 0) * 12;
            //     $("#annual_income").text(
            //         annualIncome ? annualIncome.toFixed(2) : "0.00"
            //     );

            //     // Dishonours: check decisionMetrics AB007 or EBP009 (some responses use AB/EBP variants)
            //     const dishonourMetric =
            //         metricValue("EBP009") ??
            //         metricValue("AB007") ??
            //         metricValue("EB007");
            //     // if dishonourMetric is object/number handle
            //     if (typeof dishonourMetric === "object") {
            //         $("#dishonours").text(JSON.stringify(dishonourMetric));
            //     } else {
            //         $("#dishonours").text(
            //             dishonourMetric !== null &&
            //                 dishonourMetric !== undefined
            //                 ? dishonourMetric
            //                 : "0"
            //         );
            //     }

            //     // Loans
            //     $("#sacc_loans").text(metricValue("DM091") ?? "0");
            //     $("#non_sacc_loans").text(metricValue("DM079") ?? "0");
            //     $("#cashflow_loans").text(metricValue("BF017") ?? "N/A");

            //     // DAYS IN NEGATIVE and DAYS < $500
            //     // We prefer statementSummary.dayEndBalances which holds per-day balances for an account (array of {date, balance})
            //     // The API may have multiple accounts. We'll try to find the first account with statementSummary.dayEndBalances.
            //     const banks = data.banks || [];
            //     let dayEndBalancesAll = []; // array of {date: 'YYYY-MM-DD', balance: '123.45' or number}

            //     for (const bank of banks) {
            //         const bankAccounts = bank.bankAccounts || [];
            //         for (const acc of bankAccounts) {
            //             const ss = acc.statementSummary;
            //             if (ss && Array.isArray(ss.dayEndBalances)) {
            //                 // append with account identifier if you want - for now just push entries
            //                 dayEndBalancesAll = dayEndBalancesAll.concat(
            //                     ss.dayEndBalances
            //                 );
            //             }
            //         }
            //     }

            //     // helper to count days where balance < threshold and optionally within lastDays
            //     function countDaysBelow(threshold, lastDays) {
            //         if (!dayEndBalancesAll.length) return 0;
            //         // convert to array of objects with date and numeric balance
            //         const arr = dayEndBalancesAll.map((d) => ({
            //             date: new Date(d.date),
            //             bal:
            //                 parseFloat(
            //                     String(d.balance).replace(/[^0-9\.-]/g, "")
            //                 ) || 0,
            //         }));
            //         // if lastDays supplied, compute cutoff date
            //         let cutoff = null;
            //         if (lastDays) {
            //             const latestDate = arr.reduce(
            //                 (a, b) => (a.date > b.date ? a : b),
            //                 arr[0]
            //             ).date;
            //             cutoff = new Date(latestDate);
            //             cutoff.setDate(cutoff.getDate() - lastDays + 1); // inclusive lastDays
            //         }
            //         return arr.filter(
            //             (d) =>
            //                 d.bal < threshold && (!cutoff || d.date >= cutoff)
            //         ).length;
            //     }

            //     // fill days negative (total & last 30/60/90/180)
            //     const daysNegTotal = dayEndBalancesAll.length
            //         ? countDaysBelow(0, null)
            //         : data.daysInNegative ?? "N/A";
            //     const daysNeg30 = countDaysBelow(0, 30);
            //     const daysNeg60 = countDaysBelow(0, 60);
            //     const daysNeg90 = countDaysBelow(0, 90);
            //     const daysNeg180 = countDaysBelow(0, 180);

            //     $("#days_negative").text(
            //         `Total: ${daysNegTotal} | 30d: ${daysNeg30} | 60d: ${daysNeg60} | 90d: ${daysNeg90} | 180d: ${daysNeg180}`
            //     );

            //     // fill days with EOD < $500 similarly
            //     const daysUnder500Total = countDaysBelow(500, null);
            //     const under500_30 = countDaysBelow(500, 30);
            //     const under500_60 = countDaysBelow(500, 60);
            //     const under500_90 = countDaysBelow(500, 90);
            //     const under500_180 = countDaysBelow(500, 180);

            //     // append or show elsewhere; here we append to modal body (you can create dedicated fields)
            //     $("#ending_under_500").remove(); // avoid duplicates
            //     $("#illion-summary").append(
            //         `<div id="ending_under_500" class="col-12"><b>Days EOD < $500:</b> Total: ${daysUnder500Total} | 30d: ${under500_30} | 60d: ${under500_60} | 90d: ${under500_90} | 180d: ${under500_180}</div>`
            //     );

            //     // Show modal
            //     $("#illionModal").modal("show");

            //     // optionally make the raw metrics viewable (for debugging)
            //     // console.log("decisionMetrics:", metrics);
            // },
            success: function (response) {
                spinner.style.display = "none";
                btnText.style.display = "inline-block";
                console.log(response);
                $("#doc_id").html(response.data.documentId);

                if (!response.success) {
                    Swal.fire("Error", "Failed to fetch Illion data", "error");
                    return;
                }

                const data = response.data || {};
                const metrics = data.decisionMetrics || []; // array of {id,name,type,value,...}

                // helper to find metric object (returns undefined if not found)
                function getMetric(id) {
                    return metrics.find((m) => m.id === id);
                }

                // helper to get numeric or object value
                function metricValue(id) {
                    const m = getMetric(id);
                    if (!m) return null;
                    return m.value;
                }

                // If the metric value is an object with months, return formatted string and numeric helpers
                function formatMonthlyMetric(metricObj) {
                    if (metricObj == null)
                        return { display: "N/A", average: 0, total: 0 };

                    if (typeof metricObj === "object") {
                        const months = Object.values(metricObj).map(
                            (v) => parseFloat(v) || 0
                        );
                        const total = months.reduce((s, n) => s + n, 0);
                        const avg = months.length ? total / months.length : 0;
                        const monthParts = Object.entries(metricObj).map(
                            ([k, v]) => `${k}: ${parseFloat(v).toFixed(2)}`
                        );
                        return {
                            display: monthParts.join(" | "),
                            average: avg,
                            total: total,
                        };
                    } else {
                        const n = parseFloat(metricObj) || 0;
                        return {
                            display: n.toFixed(2),
                            average: n,
                            total: n,
                        };
                    }
                }

                // populate basic info
                $("#ref").text(data.reference || "N/A");
                $("#sub_time").text(data.submissionTime || "N/A");

                // Monthly Income (BF002)
                const bf002 = metricValue("BF002");
                const bf002Res = formatMonthlyMetric(bf002);
                $("#monthly_income").text(bf002Res.display);

                // Monthly Turnover (BM001)
                const bm001 = metricValue("BM001");
                const bm001Res = formatMonthlyMetric(bm001);
                $("#monthly_turnover").text(bm001Res.display);

                // Annual Income & Turnover
                const annualIncome = (bf002Res.average || 0) * 12;
                const annualTurnover = (bm001Res.average || 0) * 12;
                $("#annual_income").text(
                    annualIncome ? annualIncome.toFixed(2) : "0.00"
                );
                $("#annual_turnover").text(
                    annualTurnover ? annualTurnover.toFixed(2) : "0.00"
                );

                // Dishonours (EBP009)
                const dishonourMetric = metricValue("EBP009");
                if (typeof dishonourMetric === "object") {
                    const dishonourParts = Object.entries(dishonourMetric).map(
                        ([k, v]) => `${k}: ${v}`
                    );
                    $("#dishonours").text(dishonourParts.join(" | "));
                } else {
                    $("#dishonours").text(dishonourMetric ?? "0");
                }

                // Loans
                $("#non_sacc_loans").text(metricValue("DM079") ?? "0");
                $("#ongoing_non_sacc_loans").text(metricValue("DM090") ?? "0");
                $("#sacc_loans").text(metricValue("DM091") ?? "0");
                $("#ongoing_sacc_loans").text(metricValue("DM042") ?? "0");
                $("#cashflow_loans").text(metricValue("BF017") ?? "0");

                // Overdraws & Overdrawn Fees
                $("#overdraw_count").text(metricValue("AB006") ?? "0");
                $("#overdraw_30").text(metricValue("FN006") ?? "0");
                $("#overdraw_90").text(metricValue("FN007") ?? "0");
                $("#overdraw_180").text(metricValue("FN008") ?? "0");

                // DAYS IN NEGATIVE and DAYS < $500
                const banks = data.banks || [];
                let dayEndBalancesAll = [];

                for (const bank of banks) {
                    const bankAccounts = bank.bankAccounts || [];
                    for (const acc of bankAccounts) {
                        const ss = acc.statementSummary;
                        if (ss && Array.isArray(ss.dayEndBalances)) {
                            dayEndBalancesAll = dayEndBalancesAll.concat(
                                ss.dayEndBalances
                            );
                        }
                    }
                }

                // helper to count days where balance < threshold and optionally within lastDays
                function countDaysBelow(threshold, lastDays = null) {
                    if (!dayEndBalancesAll?.length) return 0;

                    // Convert balances and dates safely
                    const arr = dayEndBalancesAll.map((d) => ({
                        date: new Date(d.date),
                        bal:
                            parseFloat(
                                String(d.balance).replace(/[^0-9.-]/g, "")
                            ) || 0,
                    }));

                    // Determine cutoff date if counting for last X days
                    let cutoff = null;
                    if (lastDays) {
                        const latestDate = arr.reduce(
                            (a, b) => (a.date > b.date ? a : b),
                            arr[0]
                        ).date;
                        cutoff = new Date(latestDate);
                        cutoff.setDate(cutoff.getDate() - lastDays + 1);
                    }

                    // Count number of days with balance below threshold (e.g., 0)
                    return arr.filter(
                        (d) =>
                            d.bal < threshold && (!cutoff || d.date >= cutoff)
                    ).length;
                }

                // ---------------------------
                // Days in Negative Summary
                // ---------------------------
                const daysNegTotal = countDaysBelow(0); // Total negative days
                const daysNeg30 = countDaysBelow(0, 30); // Last 30 days
                const daysNeg60 = countDaysBelow(0, 60); // Last 60 days
                const daysNeg90 = countDaysBelow(0, 90); // Last 90 days
                const daysNeg180 = countDaysBelow(0, 180); // Last 180 days

                // Display nicely in UI
                $("#days_negative").text(
                    `Total: ${daysNegTotal} | 30d: ${daysNeg30} | 60d: ${daysNeg60} | 90d: ${daysNeg90} | 180d: ${daysNeg180}`
                );

                // Ending Daily Balances < $500
                const daysUnder500Total = countDaysBelow(500, null);
                const under500_30 = countDaysBelow(500, 30);
                const under500_60 = countDaysBelow(500, 60);
                const under500_90 = countDaysBelow(500, 90);
                const under500_180 = countDaysBelow(500, 180);

                $("#ending_under_500").remove();
                $("#illion-summary").append(
                    `<div id="ending_under_500" class="col-12"><b>Days EOD < $500:</b> Total: ${daysUnder500Total} | 30d: ${under500_30} | 60d: ${under500_60} | 90d: ${under500_90} | 180d: ${under500_180}</div>`
                );

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });

                // Convert monthly metric objects to arrays of numeric values
                function objectToValues(obj) {
                    if (!obj || typeof obj !== "object") return [];
                    return Object.values(obj).map((v) => parseFloat(v) || 0);
                }

                $.ajax({
                    url: "/store-illion-data",
                    method: "POST",
                    data: {
                        monthly_income: objectToValues(bf002),
                        monthly_turnover: objectToValues(bm001),
                        annual_income: annualIncome.toFixed(2),
                        annual_turnover: annualTurnover.toFixed(2),
                        dishonours: objectToValues(dishonourMetric),
                    },
                    success: function (res) {
                        console.log("Google Sheet update:", res);
                        if (res.status === "success") {
                            Swal.fire(
                                "Success",
                                "Data synced to Google Sheet!",
                                "success"
                            );
                        } else {
                            Swal.fire("Error", res.message, "error");
                        }
                    },
                    error: function (xhr) {
                        Swal.fire(
                            "Error",
                            "Failed to send data  to Google Sheet.",
                            "error"
                        );
                        console.error(xhr.responseText);
                    },
                });

                // Show modal
                $("#illionModal").modal("show");
            },
            error: function (xhr, status) {
                spinner.style.display = "none";
                btnText.style.display = "inline-block";
                button.disabled = false;

                // Check if there's an error message from the server
                let errorMessage =
                    xhr.responseJSON && xhr.responseJSON.message
                        ? xhr.responseJSON.message // If the response has a message
                        : "Something went wrong, please try again."; // Default error message

                // Show SweetAlert with the error message
                Swal.fire({
                    icon: "error", // This shows an error icon
                    title: "Oops...",
                    text: errorMessage, // Display the error message from the server or a default message
                    confirmButtonText: "OK",
                });
            },
        });
    });

    $("#document_id").on("input", function () {
        $("#btn-text").css("display", "inline-block");
        const button = document.getElementById("submit-document-id");
        button.disabled = false;
        button.style.opacity = 1;
        // console.log("hellos");
    });
});
