$(document).ready(function () {
    $.ajax({
        url: "/get-lenders",
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
                console.log(data);
                data.forEach((item, index) => {
                    const product_id_arr = JSON.stringify(
                        item.product_ids
                    ).replace(/'/g, "&#39;");
                    const row = `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.lender_name || ""}</td>
                    <td><img src="${baseImageUrl}/${item.lender_logo.toLowerCase()}" alt="${
                        item.lender_name
                    }" 
    class="img-fluid mb-3" style="max-height: 60px; max-width: 130px;"></td>
                    <td>${item.email || ""}</td>
                    <td>${item.mobile_number || ""}</td>
                    <td>${item.website_url || ""}</td>
                     <td>
                        <button 
                            type="button" 
                            data-id='${product_id_arr}'
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
                            columns: [0, 1, 3, 4, 5],
                        },
                        title: "Lender List",
                    },
                    {
                        extend: "print",
                        text: "Print Table",
                        exportOptions: {
                            columns: [0, 1, 3, 4, 5],
                        },
                        title: "Lender List",
                    },
                ],
            });
        },
        error: function () {
            alert("Failed to fetch data.");
        },
    });

    // js to view products modal

    $(document).on("click", ".view-btn", function () {
        const dataId = $(this).attr("data-id");
        console.log(dataId);
        let pidArray = [];

        try {
            pidArray = JSON.parse(dataId);
        } catch (e) {
            console.error("Invalid JSON in data-id", e);
        }

        console.log("Clicked IDs:", pidArray);

        const modal = new bootstrap.Modal(
            document.getElementById("lenderModal")
        );
        modal.show();

        // Call AJAX
        triggerAjax(pidArray);
    });

    // js to get products data from server
    function triggerAjax(pidArray) {
        const formData = {
            pid: pidArray,
        };
        console.log(formData);
        $.ajax({
            url: "/get-lender-products",
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
                            `<div class="text-danger text-center py-4"><div class="no-lenders-container"><div class="emoji">❌</div><p style="font-size: 18px; margin-top: 12px; font-weight: 600;">No Products Available.</p></div></div>`
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
                            lender.subproduct_ids
                        ); // Store array as JSON string

                        const cardHtml = `
        <div class="col-6 col-md-6 mb-4 d-flex justify-content-center view-product-btn" 
             data-product-type-id='${productTypeIds}'>
            <div class="lender-box d-flex flex-column align-items-center justify-content-center p-3"
                data-lender-id="${lender.product_id}"
                id="lenderCard${lender.product_id}"
                style="background-color: #ffffff; height: 162px; width: 319px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5); border-radius: 20px">
                
               <img src="${baseImageUrl}/${lender.lender_logo.toLowerCase()}" alt="${
                            lender.lender_name
                        }" 
    class="img-fluid mb-3" style="max-height: 60px; max-width: 130px;">

                <h4 style="text-align: center;">${lender.product_name}</h4>
                
                <a href="#" class="view-options text-decoration-underline " 
                   data-id="${lender.product_id}"
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

    // js to view subproduct modal
    $(document).on("click", ".view-product-btn", function (e) {
        e.preventDefault();

        // Step 1: Parse data-id as JSON array
        const dataId = $(this).attr("data-product-type-id");
        let productTypeIds = [];
        const lenderId = $(this).find(".lender-box").data("lender-id");
        // console.log("Lender ID:", lenderId);

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
        getSubProductData(productTypeIds, lenderId);
    });

    //  js to get subproduct data from the server
    function getSubProductData(products, lenderId) {
        const formData = {
            product_ids: products,
            lenderId: lenderId,
        };

        console.log(formData); // Debugging the request payload

        $.ajax({
            url: "/get-lender-subproducts",
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
                    <p style="font-size: 18px; margin-top: 12px; font-weight: 600;">No sub products found for this lender.</p>
                </div>
            </div>`);
                        return;
                    }

                    // Set top section (assuming all products belong to one lender)
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

                    // Loop through each sub-product and render
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

                        const btn = document.querySelector(
                            ".view-lender-contacts-btn"
                        );

                        // Set the data attribute dynamically
                        btn.setAttribute("data-lender-id", product.lender_id);

                        const productHtml = `
            <div class="col-md-6">
                <div class="card sub-product-card border p-3 h-100" style="background-color: #ffffff; height: 124px; width: 100%; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5); border-radius: 20px; text-align: center;">
                    <div class="row">
                        <div class="col-md-2" style="width:100px">
                            <img src="${baseImageUrl}/${lender.lender_logo.toLowerCase()}" alt="" style="height: 33px;">
                        </div>
                        <div class="col-md-10">
                            <h5 class="fw-bold" style="color:#852aa3;">${
                                product.product_name || "Product"
                            }</h5>
                            <h6 class="fw-bold" style="color:#852aa3;">${
                                product.sub_product_name || ""
                            }</h6>
                            <strong>$${product.min_amount || 0} - $${
                            product.max_amount || 0
                        }</strong><br>
                            <strong>Minimum Score Required: ${
                                product.credit_score || "500+"
                            }</strong><br>
                            <a href="${guideUrl}" target="_blank" style="color:#852aa3; font-size: 15px; margin-top: 10px; font-weight: 500;" class="text-decoration-underline">
                                View Product Guide <i class="fas fa-download"></i>
                            </a>
                        </div>
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
      <td><strong>${contact.name}</strong>, ${contact.title}</td>
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

        // Step 1: Parse data-id as JSON array
        const dataId = $(this).attr("data-lender-id");
        // let productTypeIds = [];

        // console.log("Lender ID:", lenderId);

        // try {
        //     productTypeIds = JSON.parse(dataId);
        // } catch (err) {
        //     console.error(
        //         "Invalid data-product-type-id format. Expected JSON array.",
        //         err
        //     );
        //     return;
        // }

        console.log("Product Type IDs:", dataId);

        // Step 2: Open lenderDetailModal OVER lenderModal
        const modalElement = document.getElementById("lenderContactModal");

        // Bootstrap 5 way of initializing with options (prevent backdrop close conflict)
        const detailModal = new bootstrap.Modal(modalElement, {
            backdrop: false, // 🔑 allows stacking
            keyboard: true,
        });

        detailModal.show();

        // Step 3: Fetch product data
        getLenderContactsData(dataId);
    });
    function getLenderContactsData(lenderId) {
        $.ajax({
            url: "/get-lender-contacts",
            method: "GET",
            data: { lenderId },
            beforeSend() {
                $("#loader").show();
            },
            success(data) {
                console.log("Lender details:", data);
                if (!Array.isArray(data) || data.length === 0) {
                    $("#lenderContactTable").html(`<tr>
          <td colspan="3" class="text-center text-muted" style="font-style: italic;">
            No contacts available.
          </td>
        </tr>`);
                    $("#loader").hide();
                    return;
                }

                // First record for lender info
                const lenderInfo = data[0];
                $("#LenderLogo").attr(
                    "src",
                    `${baseImageUrl}/${lenderInfo.lender_logo.toLowerCase()}`
                );
                const web = lenderInfo.website_url?.trim() || "";
                $("#contactmodalurl").attr(
                    "href",
                    web.startsWith("http") ? web : `https://${web}`
                );
                $("#contactmodalwebsite").text(lenderInfo.website_url || "N/A");
                $("#phone").text(
                    lenderInfo.lender_mobile || lenderInfo.lender_mobile
                );
                $("#email").text(
                    lenderInfo.lender_email || lenderInfo.lender_email
                );

                // Build table rows
                let rowsHtml = "";
                data.forEach((contact) => {
                    rowsHtml += `<tr>
          <td><strong>${contact.name}</strong>, ${contact.title}</td>
          <td><i class="fas fa-mobile" style="color:#852aa3;"></i> ${
              contact.contact_mobile || "N/A"
          }</td>
          <td><i class="fas fa-envelope" style="color:#852aa3;"></i> ${
              contact.contact_email || "N/A"
          }</td>
        </tr>`;
                });

                $("#lenderContactTable").html(rowsHtml);
                $("#loader").hide();
            },
            error(err) {
                console.error("Error fetching contacts:", err);
                $("#loader").hide();
            },
        });
    }
});
