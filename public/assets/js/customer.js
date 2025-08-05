$(document).ready(function () {
    $.ajax({
        url: "/get-customers",
        method: "GET",
        success: function (data) {
            const tableBody = $("#lenderTable tbody");

            var table = $("#lenderTable").DataTable();

            if ($.fn.DataTable.isDataTable("#lenderTable")) {
                $("#lenderTable").DataTable().clear().destroy();
            }

            tableBody.empty();

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
            }

            $("#lenderTable").DataTable({
                paging: true,
                lengthChange: false,
                searching: true,
                ordering: false,
                info: true,
                autoWidth: false, // IMPORTANT: disables automatic width calculation
                responsive: true,
                lengthMenu: [100, 120, 140, 160],
                pageLength: 80,
                dom: "Blfrtip",
                columnDefs: [
                    { width: "40px", targets: 0 },
                    { width: "150px", targets: 1 },
                    { width: "120px", targets: 2 },
                    { width: "150px", targets: 3 },
                    { width: "100px", targets: 4 },
                    { width: "100px", targets: 5 },
                    { width: "100px", targets: 6 },
                    { width: "100px", targets: 7 },
                    { width: "120px", targets: 8 },
                    { width: "130px", targets: 9 },
                    { width: "100px", targets: 10 },
                    { width: "100px", targets: 11 },
                    { width: "130px", targets: 12 },
                    { width: "100px", targets: 13 },
                    { width: "60px", targets: 14 },
                    { width: "60px", targets: 15 },
                ],
                buttons: [
                    {
                        extend: "excelHtml5",
                        text: "Export to Excel",
                        exportOptions: {
                            columns: [
                                0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13,
                            ],
                        },
                        title: "Customer List",
                    },
                    {
                        extend: "print",
                        text: "Print Table",
                        orientation: "landscape",
                        exportOptions: {
                            columns: [
                                0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13,
                            ],
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
                    const $container = $("#applicableLenderCards");
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
                        const productTypeIds = JSON.stringify(
                            lender.product_type_ids
                        );
                        const cardHtml = `
        <div class="col-6 col-md-6 mb-4 d-flex justify-content-center view-product-btn" 
             data-product-type-id='${productTypeIds}'>
            <div class="lender-box d-flex flex-column align-items-center justify-content-center p-3"
                data-lender-id="${lender.lender_id}"
                id="lenderCard${lender.lender_id}"
                style="background-color: #ffffff; height: 124px; width: 319px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5); border-radius: 20px">
                
               <img src="${baseImageUrl}/${lender.lender_logo.toLowerCase()}" alt="${
                            lender.lender_name
                        }" 
    class="img-fluid mb-3" style="max-height: 60px; max-width: 130px;">
                
                <a href="#" class="view-options text-decoration-underline " 
                   data-id="${lender.lender_id}"
                   style="font-size:15px; font-weight:700; color: #821a99">
                   View Options
                </a>
            </div>
        </div>`;

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

    $(document).on("click", ".view-product-btn", function (e) {
        e.preventDefault();

        const dataId = $(this).attr("data-product-type-id");
        let productTypeIds = [];
        const lenderId = $(this).find(".lender-box").data("lender-id");

        try {
            productTypeIds = JSON.parse(dataId);
        } catch (err) {
            console.error(
                "Invalid data-product-type-id format. Expected JSON array.",
                err
            );
            return;
        }

        const modalElement = document.getElementById("lenderDetailModal");

        const detailModal = new bootstrap.Modal(modalElement, {
            backdrop: false, // 🔑 allows stacking
            keyboard: true,
        });

        detailModal.show();

        getSubProductData(productTypeIds, lenderId);
    });

    // function for the subproducts modal
    function getSubProductData(products, lenderId) {
        const formData = {
            trading_time: $("#time_in_business").val(),
            loan_amt: $("#loan_amt").val(),
            credit_score: $("#credit_score").val(),
            monthly_income: $("#monthly_revenue").val(),
            negative_days: $("#negative_days").val(),
            number_of_dishonours: $("#number_of_dishonours").val(),
            asset_backed: $("#asset_backed").val(),
            product_ids: products,
            lenderId: lenderId,
        };

        console.log(formData); // Debugging the request payload
        resetLenderContactInfo();

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

                    const lender = data[0];

                    $("#modalLenderLogo").attr(
                        "src",
                        `${baseImageUrl}/${lender.lender_logo.toLowerCase()}`
                    );
                    const websiteUrl = lender.website_url
                        ? lender.website_url.trim()
                        : "";

                    $("#modalurl").attr(
                        "href",
                        websiteUrl
                            ? websiteUrl.startsWith("http")
                                ? websiteUrl
                                : "https://" + websiteUrl
                            : "#"
                    );
                    $("#modalwebsite").text(lender.website_url);
                    $("#modalPhone").text(lender.mobile_number || "N/A");
                    $("#modalEmail").text(lender.email || "N/A");

                    const btn = document.querySelector(
                        ".view-lender-contacts-btn"
                    );

                    btn.setAttribute("data-lender-id", lender.lender_id);

                    data.forEach(function (product) {
                        let guideUrl = "#"; // Default if guide is not available
                        const guide = product.product_guide;

                        if (guide) {
                            if (/^https?:\/\//i.test(guide)) {
                                guideUrl = guide;
                            } else {
                                const encodedFileName =
                                    encodeURIComponent(guide);
                                guideUrl = `${base_product_guide_url}/${encodedFileName}`;
                            }
                        }

                        loadLenderLogo(
                            baseImageUrl +
                                "/" +
                                lender.lender_logo.toLowerCase()
                        );
                        const productHtml = `
                    <div class="col-md-6">
                    
                   
                        <div class="card sub-product-card border col-md-10  p-3 h-100 " style="background-color: #ffffff; height: 124px; width: 100%; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5); border-radius: 20px;text-align: center;">
                        <div class="row">
                         <div class="col-md-2">
                          <img src="${baseImageUrl}/${lender.lender_logo.toLowerCase()}" class="" alt" style="width: 73px;height: 35px;">
                         </div>
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
                              <a href="${guideUrl}" 
                          target="_blank" 
                          style="color:#852aa3;font-size:15px;margin-top:10px;font-weight:500" 
                          class="text-decoration-underline">
                          View Product Guide <i class="fas fa-download"></i>
                       </a>
                        </div>
                        </div>
                    </div>`;
                        $container.append(productHtml);
                    });

                    // ====== ADD BDM CONTACTS SECTION =======
                    // Assuming you have an array of contacts in the ajax response (example: lender.contacts)
                    // If your data structure is different, adjust accordingly

                    if (lender.contacts && lender.contacts.length > 0) {
                        let contactsHtml = `<table style="width: 100%; font-family: 'Times New Roman', Times, serif; font-size: 15px; border-collapse: collapse;"> 
                        <th style="color:#852aa3;font-size:25px">BDM Contacts </th>`;

                        lender.contacts.forEach((contact) => {
                            contactsHtml += `
                           <tr>
                            <td><strong>${contact.name}</strong>, ${
                                contact.title
                            }</td>
                             <td style="margin"><i class="fas fa-mobile" style="color: #852aa3;"></i> ${
                                 contact.mobile_number || "N/A"
                             }</td>
                             <td><i class="fas fa-envelope" style="color: #852aa3;"></i> ${
                                 contact.email || "N/A"
                             }</td>
                           </tr>`;
                        });

                        $("#lendercontactbuton").css("display", "block");

                        contactsHtml += `</table>`;
                        $container.append(contactsHtml);
                        $("#lendercontactbuton").css("display", "block");
                    } else {
                        // Optional: if no contacts
                        $container.append(`
            <p class="text-muted mt-3" style="font-style: italic;">No contacts available.</p>
            `);
                        $("#lendercontactbuton").css("display", "none");
                    }

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

    $(document).on("click", ".view-lender-contacts-btn", function (e) {
        e.preventDefault();

        const dataId = $(this).attr("data-lender-id");
        // console.log("Product Type IDs:", dataId);
        const modalElement = document.getElementById("lenderContactModal");
        const detailModal = new bootstrap.Modal(modalElement, {
            backdrop: false,
            keyboard: true,
        });

        detailModal.show();

        getLenderContactsData(dataId);
    });

    function getLenderContactsData(lenderId) {
        const formData = {
            lenderId: lenderId,
        };

        console.log(formData);
        resetLenderContactInfo2();

        $.ajax({
            url: "/get-lender-contacts",
            method: "GET",
            data: formData,
            beforeSend: function () {
                $("#loader").show();
            },
            success: function (data) {
                console.log("Lender detail data:", data);

                setTimeout(function () {
                    if (!Array.isArray(data) || data.length === 0) {
                        $("#lenderContactTable").html(`
                    <tr>
                        <td colspan="3" class="text-center text-muted" style="font-style: italic;">
                            No contacts available.
                        </td>
                    </tr>
                `);
                        $("#loader").hide();
                        return;
                    }

                    const lenderInfo = data[0];

                    loadLenderLogo2(
                        baseImageUrl +
                            "/" +
                            lenderInfo.lender_logo.toLowerCase()
                    );

                    // Populate lender info
                    $("#LenderLogo").attr(
                        "src",
                        `${baseImageUrl}/${lenderInfo.lender_logo.toLowerCase()}`
                    );
                    const websiteUrl = lenderInfo.website_url?.trim() || "";
                    $("#contactmodalurl").attr(
                        "href",
                        websiteUrl.startsWith("http")
                            ? websiteUrl
                            : `https://${websiteUrl}`
                    );
                    $("#contactmodalwebsite").text(
                        lenderInfo.website_url || "N/A"
                    );
                    $("#phone").text(lenderInfo.lender_mobile || "N/A");
                    $("#email").text(lenderInfo.lender_email || "N/A");

                    // Build contact rows
                    let rowsHtml = "";
                    data.forEach((contact) => {
                        rowsHtml += `
                    <tr>
                        <td><strong>${contact.name}</strong>, ${
                            contact.title
                        }</td>
                        <td><i class="fas fa-mobile" style="color: #852aa3;"></i> ${
                            contact.contact_mobile || "N/A"
                        }</td>
                        <td><i class="fas fa-envelope" style="color: #852aa3;"></i> ${
                            contact.contact_email || "N/A"
                        }</td>
                    </tr>`;
                    });

                    $("#lenderContactTable").html(rowsHtml);
                    $("#loader").hide();
                }, 1000);

                $("#applicable_lenders").val(JSON.stringify(data));
            },
            error: function (xhr, status, error) {
                console.error("Error fetching lender contacts:", error);
                $("#loader").hide();
            },
        });
    }
});

function loadLenderLogo(imageUrl) {
    const $logoImg = $("#modalLenderLogo");
    const $loader = $("#logoLoader");

    $logoImg.hide();
    $logoImg.attr("src", imageUrl);

    $logoImg
        .on("load", function () {
            $loader.hide();
            $logoImg.show();
        })
        .on("error", function () {
            $loader.hide();
            $logoImg.hide();
        });
}

function loadLenderLogo2(imageUrl) {
    const $logoImg = $("#modalLenderLogo2");
    const $loader = $("#logoLoader2");

    $logoImg.hide();
    $logoImg.attr("src", imageUrl);

    $logoImg
        .on("load", function () {
            $loader.hide();
            $logoImg.show();
        })
        .on("error", function () {
            $loader.hide();
            $logoImg.hide();
        });
}

function resetLenderContactInfo2() {
    console.log("asdfj");

    $("#modalLenderLogo2").hide();
    $("#logoLoader2")
        .html('<i class="fas fa-spinner fa-spin" style="font-size: 24px;"></i>')
        .show();

    $("#contactmodalwebsite").html(
        '<i class="fas fa-spinner fa-spin" style="font-size: 14px;"></i>'
    );
    $("#contactmodalurl").attr("href", "#");

    $("#phone").html(
        '<i class="fas fa-spinner fa-spin" style="font-size: 14px;"></i>'
    );

    $("#email").html(
        '<i class="fas fa-spinner fa-spin" style="font-size: 14px;"></i>'
    );
}

function resetLenderContactInfo() {
    $("#modalLenderLogo").hide();
    $("#logoLoader")
        .html('<i class="fas fa-spinner fa-spin" style="font-size: 24px;"></i>')
        .show();

    $("#modalwebsite").html(
        '<i class="fas fa-spinner fa-spin" style="font-size: 14px;"></i>'
    );
    $("#modalurl").attr("href", "#");

    $("#modalPhone").html(
        '<i class="fas fa-spinner fa-spin" style="font-size: 14px;"></i>'
    );

    $("#modalEmail").html(
        '<i class="fas fa-spinner fa-spin" style="font-size: 14px;"></i>'
    );
}
