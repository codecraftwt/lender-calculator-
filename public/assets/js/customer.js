$(document).ready(function () {
    $.ajax({
        url: "/get-customers",
        method: "GET",
        success: function (data) {
            const tableBody = $("#lenderTable tbody");

            var table = $("#lenderTable").DataTable();

            // Destroy DataTable before clearing rows
            if ($.fn.DataTable.isDataTable("#lenderTable")) {
                $("#lenderTable").DataTable().clear().destroy();
            }

            tableBody.empty(); // Clear existing rows

            if (data.length > 0) {
                data.forEach((item, index) => {
                    const applicableLendersStr = JSON.stringify(
                        item.applicable_lenders
                    ).replace(/'/g, "&#39;");

                    const row = `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.company_name || ""}</td>
                    <td>${item.director_name || ""}</td>
                    <td>${item.director_email || ""}</td>
                    <td>${item.director_phone || ""}</td>
                    <td>$${item.loan_amt_needed || ""}</td>
                    <td>$${item.monthly_revenue || ""}</td>
                    <td>${item.company_credit_score || ""}</td>
                    <td>${item.time_in_business || ""} Months</td>
                    <td>
                        <button 
                            type="button" 
                            data-id='${applicableLendersStr}'
                            class="btn btn-sm btn-info view-btn"
                            style="background-color:#8455d9;color:white;border:1px solid #8455d9">
                            View
                        </button>
                    </td>
                </tr>`;
                    tableBody.append(row);
                });
            } else {
                // table.clear().draw();
                // tableBody.append(
                //     `<tr><td colspan="10" class="text-center">No data found</td></tr>`
                // );
            }

            // Initialize DataTable only once
            $("#lenderTable").DataTable({
                paging: true,
                lengthChange: false,
                searching: true,
                ordering: false,
                info: true,
                autoWidth: false,
                responsive: true,
                lengthMenu: [100, 120, 140, 160],
                pageLength: 80,
                dom: "Blfrtip",
                buttons: [
                    {
                        extend: "excelHtml5",
                        text: "Export to Excel",
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8], // specify column indexes to include
                        },
                        title: "Customer List",
                    },
                    {
                        extend: "print",
                        text: "Print Table",
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8], // specify column indexes to include
                        },
                        title: "Customer List",
                    },
                ],
            });
        },
        error: function () {
            alert("Failed to fetch data.");
        },
    });

    $(document).on("click", ".view-btn", function () {
        const dataId = $(this).attr("data-id");
        console.log(dataId);
        let cidArray = [];

        try {
            cidArray = JSON.parse(dataId);
        } catch (e) {
            console.error("Invalid JSON in data-id", e);
        }

        console.log("Clicked IDs:", cidArray);

        const modal = new bootstrap.Modal(
            document.getElementById("lenderModal")
        );
        modal.show();

        // Call AJAX
        triggerAjax(cidArray);
    });

    function triggerAjax(cidArray) {
        const formData = {
            trading_time: $("#time_in_business").val(),
            loan_amt: $("#loan_amt").val(),
            credit_score: $("#credit_score").val(),
            monthly_income: $("#monthly_revenue").val(),
            negative_days: $("#negative_days").val(),
            number_of_dishonours: $("#number_of_dishonours").val(),
            asset_backed: $("#asset_backed").val(),
            cid: cidArray,
        };
        console.log(formData);
        $.ajax({
            url: "/get-applicable-lenders",
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
                            `<div class="text-danger text-center py-4"><div class="no-lenders-container"><div class="emoji">❌</div><p style="font-size: 18px; margin-top: 12px; font-weight: 600;">No lenders appicable.</p></div></div>`
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
});
