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
                // setTimeout(function () {
                const $container = $(".lender-cards");
                $("#matchedLenders").text(data.length);
                $container.empty();

                const lenderIds = data.map((item) => item.id);
                $("#applicable_lenders").val(JSON.stringify(lenderIds));
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
    ];

    function validateField(id, showErrorMessage = true) {
        if (!id || typeof id !== "string" || id.trim() === "") return true;

        const $field = $(`#${CSS.escape(id)}`);
        const val = $field.val().trim();

        if (showErrorMessage)
            $(`#invalid_${CSS.escape(id)}`).addClass("d-none");

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

            case "negative_days":
            case "number_of_dishonours":
                return (
                    /^[0-9]+$/.test(val) ||
                    (showErrorMessage &&
                        showError(id, "Please enter a valid number."))
                );

            case "abn_gst":
                return (
                    val === "Yes" ||
                    val === "No" ||
                    (showErrorMessage &&
                        showError(id, "Please select a valid option."))
                );

            default:
                return true;
        }
    }

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
            .filter((id) => id && id.trim() !== ""); // remove any empty/blank

        if (!validateAll(fields, true)) {
            e.preventDefault();
        } else {
            e.preventDefault();

            // ✅ Get values OUTSIDE of template string
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

            // ✅ SweetAlert with values injected safely
            Swal.fire({
                title: "Please Check Your Details",
                showCancelButton: true,
                confirmButtonText: "Confirm & Submit",
                cancelButtonText: "Back",
                reverseButtons: true,
                width: 800,
                customClass: {},
                html: `
<div class="col-md-12" style="border: 1px solid black; padding: 10px; border-radius: 10px; font-size: 14px; color: #333;">
    <h5 style="color: #b47dee;"><i class="fa fa-user" style="font-size: 16px; color: #b47dee;"></i> Client Details</h5>
    <hr>
    <div class="row">
        <div class="col-md-6 form-group" style="margin-bottom:10px">
            <label style="font-weight:500;float:left">Company Name:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-building"></i></span>
                <input class="form-control" style="background-color:#e5e5e5" value="${companyName}" readonly />
            </div>
        </div>
        <div class="col-md-6 form-group" style="margin-bottom:10px">
            <label style="font-weight:500;float:left">Director Name:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                <input class="form-control" style="background-color:#e5e5e5" value="${directorName}" readonly />
            </div>
        </div>
        <div class="col-md-6 form-group" style="margin-bottom:10px">
            <label style="font-weight:500;float:left">Email:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input class="form-control" style="background-color:#e5e5e5" value="${directorEmail}" readonly />
            </div>
        </div>
        <div class="col-md-6 form-group" style="margin-bottom:10px">
            <label style="font-weight:500;float:left">Phone:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                <input class="form-control" style="background-color:#e5e5e5" value="${directorPhone}" readonly />
            </div>
        </div>
    </div>

    <hr>

    <h5 style="color: #b47dee;"><i class="fa fa-briefcase" style="font-size: 16px; color: #b47dee;"></i> Loan Details</h5>
    <hr>
    <div class="row">
        <div class="col-md-6 form-group" style="margin-bottom:10px">
            <label style="font-weight:500;float:left">Loan Amount:</label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input class="form-control" style="background-color:#e5e5e5" value="${
                    "$" + loanAmt
                }" readonly />
            </div>
        </div>
        <div class="col-md-6 form-group" style="margin-bottom:10px">
            <label style="font-weight:500;float:left">Monthly Revenue:</label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input class="form-control" style="background-color:#e5e5e5" value="${
                    "$" + monthlyRevenue
                }" readonly />
            </div>
        </div>
        <div class="col-md-6 form-group" style="margin-bottom:10px">
            <label style="font-weight:500;float:left">Time in Business (months):</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                <input class="form-control" style="background-color:#e5e5e5" value="${timeInBusiness}" readonly />
            </div>
        </div>
        <div class="col-md-6 form-group" style="margin-bottom:10px">
            <label style="font-weight:500;float:left">Credit Score:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-credit-card"></i></span>
                <input class="form-control" style="background-color:#e5e5e5" value="${creditScore}" readonly />
            </div>
        </div>
        <div class="col-md-6 form-group" style="margin-bottom:10px">
            <label style="font-weight:500;float:left">Negative Days:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                <input class="form-control" style="background-color:#e5e5e5" value="${negativeDays}" readonly />
            </div>
        </div>
        <div class="col-md-6 form-group" style="margin-bottom:10px">
            <label style="font-weight:500;float:left">Dishonours:</label>
            <input class="form-control" style="background-color:#e5e5e5" value="${numberOfDishonours}" readonly />
        </div>
        <div class="col-md-6 form-group" style="margin-bottom:10px">
            <label style="font-weight:500;float:left">GST Registration:</label>
            <input class="form-control" style="background-color:#e5e5e5" value="${abn_gst}" readonly />
        </div>
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
});
