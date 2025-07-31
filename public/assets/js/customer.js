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
                    <td>${item.abn_date || ""}</td>
                     <td>${item.time_in_business || ""} Months</td>
                    <td>${
                        item.gst_time ? item.gst_time + " Months" : "Null"
                    }</td>
                     <td>${item.entity_type || ""}</td>
                     <td>${
                         item.company_credit_score && item.credit_score
                             ? item.company_credit_score +
                               " (" +
                               item.credit_score +
                               ")"
                             : ""
                     }</td>
                    <td>$${item.loan_amt_needed || ""}</td>
                    <td>$${item.monthly_revenue || ""}</td>
                    <td>${item.industry_type}</td>
                    <td>${
                        item.created_at ? item.created_at.substring(0, 10) : ""
                    }</td>
                    
                   
                    <td>
                       
                    <a href="/customer-edit/${item.id}"><button 
                            type="button" 
                            data-id='${applicableLendersStr}'
                            class="btn btn-sm btn-info"
                            style=" color:white;">
                            <i class="fas fa-pencil"></i>
                        </button><a>
                    </td>
                     <td>
                        <button 
                            type="button" 
                            data-id='${applicableLendersStr}'
                            class="btn btn-sm btn-info view-btn"
                            style="background: linear-gradient(90deg, #4a3f9a 0%, #d15de8 100%);color:white;border:1px solid #8455d9">
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
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                        },
                        title: "Customer List",
                    },
                    {
                        extend: "print",
                        text: "Print Table",
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
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

    //function to get the main lenders
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
                    // const $container = $(".lender-cards");
                    const $container = $("#applicableLenderCards");
                    $container.empty(); // before appending

                    // $("#matchedLenders").text(data.length);
                    // $container.empty();
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
                        const productTypeIds = JSON.stringify(
                            lender.product_type_ids
                        ); // Store array as JSON string

                        const cardHtml = `
        <div class="col-6 col-md-6 mb-4 d-flex justify-content-center view-product-btn" 
             data-product-type-id='${productTypeIds}'>
            <div class="lender-box d-flex flex-column align-items-center justify-content-center p-3"
                data-lender-id="${lender.lender_id}"
                id="lenderCard${lender.lender_id}"
                style="background-color: #ffffff; height: 124px; width: 319px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5); border-radius: 20px">
                
                <img src="${baseImageUrl}/${lender.lender_logo}" alt="${lender.lender_name}" 
    class="img-fluid mb-3" style="max-height: 60px; max-width: 130px;">
                
                <a href="#" class="view-options text-decoration-underline " 
                   data-id="${lender.lender_id}"
                   style="font-size:15px; font-weight:700; color: #821a99">
                   View Options
                </a>
            </div>
        </div>`;

                        $container.append(cardHtml); // append here
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

    // triggers the function to get the sub products
    $(document).on("click", ".view-product-btn", function (e) {
        e.preventDefault();

        // Step 1: Parse data-id as JSON array
        const dataId = $(this).attr("data-product-type-id");
        let productTypeIds = [];

        try {
            productTypeIds = JSON.parse(dataId);
        } catch (err) {
            console.error(
                "Invalid data-product-type-id format. Expected JSON array.",
                err
            );
            return;
        }

        console.log("Product Type IDs:", productTypeIds);

        // Step 2: Open lenderDetailModal OVER lenderModal
        const modalElement = document.getElementById("lenderDetailModal");

        // Bootstrap 5 way of initializing with options (prevent backdrop close conflict)
        const detailModal = new bootstrap.Modal(modalElement, {
            backdrop: false, // 🔑 allows stacking
            keyboard: true,
        });

        detailModal.show();

        // Step 3: Fetch product data
        getSubProductData(productTypeIds);
    });

    // function for the subproducts modal
    function getSubProductData(products) {
        const formData = {
            trading_time: $("#time_in_business").val(),
            loan_amt: $("#loan_amt").val(),
            credit_score: $("#credit_score").val(),
            monthly_income: $("#monthly_revenue").val(),
            negative_days: $("#negative_days").val(),
            number_of_dishonours: $("#number_of_dishonours").val(),
            asset_backed: $("#asset_backed").val(),
            product_ids: products,
        };

        console.log(formData); // Debugging the request payload

        $.ajax({
            url: "/get-sub-products",
            method: "GET",
            data: formData,
            beforeSend: function () {
                $("#loader").show();

                const loaderHtml = `
            <div class="lender-cards-loader text-center w-100 py-5">
                <div class="spinner-border text-primary" role="status" >
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="mt-2 small text-dark">Finding best lender options...</div>
            </div>`;
                $("#loanProductsContainer").html(loaderHtml);
            },
            success: function (data) {
                console.log("Lender detail data:", data);

                setTimeout(function () {
                    const $container = $("#loanProductsContainer");
                    $container.empty(); // Clear previous content

                    if (data.length < 1) {
                        $container.html(`
                    <div class="text-danger text-center py-4">
                        <div class="no-lenders-container">
                            <div class="emoji">❌</div>
                            <p style="font-size: 18px; margin-top: 12px; font-weight: 600;">No products found for this lender.</p>
                        </div>
                    </div>`);
                        return;
                    }

                    // Set top section (assuming all products belong to one lender)
                    const lender = data[0];

                    $("#modalLenderLogo").attr(
                        "src",
                        `${baseImageUrl}/${lender.lender_logo}`
                    );
                    // $("#modalLenderName").text(lender.lender_name || "Lender");

                    $("#modalWebsite").text(lender.website_url || "N/A");
                    $("#modalPhone").text(lender.mobile_number || "N/A");
                    $("#modalEmail").text(lender.email || "N/A");

                    // Loop through each sub-product and render
                    data.forEach(function (product) {
                        const productHtml = `
                    <div class="col-md-6">
                        <div class="card  border  p-3 h-100 " style="background-color: #ffffff; height: 124px; width: 100%; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5); border-radius: 20px;text-align: center;">
                            <h5 class="fw-bold" style="color:#852aa3;">${
                                product.product_name || "Product"
                            }</h5>
                            <h6 class="fw-bold" style="color:#852aa3;">${
                                product.sub_product_name || ""
                            }</h6>

                            <strong>$${product.min_amount || 0} - $${
                            product.max_amount || 0
                        }</strong>

                        <strong>Minimum Score Required:  ${
                            product.credit_score || "500+"
                        }</strong>

                           
                            
                            <a style="color:#852aa3;font-size:15px;margin-top:10px;font-weight:500" class="text-decoration-underline">View Product Guide <i class="fas fa-download"></i> </a>
                        </div>
                    </div>`;
                        $container.append(productHtml);
                    });

                    $("#loader").hide();
                }, 1000);

                $("#applicable_lenders").val(JSON.stringify(data));
            },
            error: function (xhr, status, error) {
                console.error("Error fetching sub-products:", error);
                $("#loader").hide();
                $("#loanProductsContainer").html(
                    `<div class="text-danger text-center py-4">Unable to load product details. Please try again.</div>`
                );
            },
        });
    }
});

//  <div class="row">
//                             <div class="col-md-6">
//                             <p><strong> </strong> $${
//                                 product.min_amount || 0
//                             }</p>
//                             </div>
//                             <div class="col-md-6">
//                             <p><strong> </strong> $${
//                                 product.max_amount || 0
//                             }</p> </div>
//                             </div>
//                               <strong>Credit Score: ${
//                                   product.credit_score || "500+"
//                               } </strong>
