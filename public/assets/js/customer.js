$(document).ready(function () {
    function getCustomerData() {
        $.ajax({
            url: "/get-customers",
            method: "GET",
            success: function (data) {
                const tableBody = $("#lenderTable tbody");

                // Destroy existing DataTable instance safely
                if ($.fn.DataTable.isDataTable("#lenderTable")) {
                    $("#lenderTable").DataTable().clear().destroy();
                }

                tableBody.empty();

                // Append your data rows
                if (data.length > 0) {
                    const getStatusColor = (status) => {
                        if (status == 0) return "#fcc110fa"; // Bootstrap warning
                        if (status == 1) return "#e35966"; // Bootstrap danger
                        if (status == 2) return "#25f253"; // Bootstrap success
                        return "#6af56ab0"; // default
                    };

                    data.forEach((item, index) => {
                        const applicableLendersStr = JSON.stringify(
                            item.applicable_lenders
                        ).replace(/'/g, "&#39;");

                        const row = `
    <tr>
    <td>${item.created_at ? item.created_at.substring(0, 10) : ""}</td>
    <td>${item.director_name || ""}</td>
    <td>${item.company_name || ""}</td>
    <td>${item.director_email || ""}</td>
    <td>${item.director_phone || ""}</td>
    <td>$${item.loan_amt_needed || ""}</td>
    <th><select name="status" 
        style="width: 107px; border-radius:25px; border:none; background-color:${getStatusColor(
            item.status
        )}; color:white; height:35px"
        class="btn no-arrow status" data-customer-id="${item.id}">
    <option value="2" ${item.status == 2 ? "selected" : ""}>settled</option>
    <option value="1" ${item.status == 1 ? "selected" : ""}>in-progress</option>
    <option value="0" ${item.status == 0 ? "selected" : ""}>submitted</option>
 </select></th>
    <td>
        <a href="/customer-edit/${item.id}">
            <button
                type="button"
                data-id='${applicableLendersStr}'
                class="btn btn-sm me-1"
                style="color:rgb(86 66 161);">
                <i class="fas fa-pencil"></i>
            </button></a>
            <button
    type="button"
    data-id="${item.id}"
    class="btn btn-sm delete-btn"
    style="color:rgb(86 66 161);">
    <i class="fas fa-trash"></i>
 </button>
    </td>
    <td>
        <button
            type="button"
            data-id='${applicableLendersStr}'
            class="btn btn-sm btn-info view-btn"
            style="background: rgb(86 66 161);
                   color:white;
                   border:1px solid #8455d9">
            View
        </button>
    </td>
    </tr>`;

                        tableBody.append(row);
                    });
                }

                // ✅ Reinitialize DataTable with search enabled
                const table = $("#lenderTable").DataTable({
                    searching: true,
                    dom: "rtip", // 'f' removed to hide default search
                    columnDefs: [
                        { targets: 0, width: "50px" }, // Date
                        { targets: 1, width: "50px" }, // Director Name
                        { targets: 2, width: "50px" }, // Company
                        { targets: 3, width: "50px" }, // Email
                        { targets: 4, width: "50px" }, // Phone
                        { targets: 5, width: "50px" }, // Loan Amount
                        { targets: 6, width: "50px" }, // Status
                        { targets: 7, width: "50px" }, // Actions
                        { targets: 8, width: "50px" }, // View
                    ],
                    autoWidth: false,
                });

                // ✅ Create custom search box
                const $customSearch = $(`
            <div class="search-input-wrapper position-relative d-inline-block">
                <i class="fa fa-search position-absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #777;"></i>
                <input type="search" id="customSearchInput"  class="form-control" style="padding-left: 30px; height: 36px; border-radius: 25px; border: 1px solid #ccc;">
            </div>
        `);

                // ✅ Insert it into placeholder
                $("#customSearchWrapper").html($customSearch);

                // ✅ Wire search input to DataTable instance
                $("#customSearchInput").on("keyup", function () {
                    table.search(this.value).draw();
                });
            },
            error: function () {
                alert("Failed to fetch data.");
            },
        });
    }

    getCustomerData();

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
                style="background-color: #ffffff; height: 150px; width: 319px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5); border-radius: 20px">
                <p style="color: #821a99;font-weight:700">${
                    lender.product_type_ids.length
                } Products Matched !</p>
               <img src="${baseImageUrl}/${lender.lender_logo.toLowerCase()}" alt="${
                            lender.lender_name
                        }" 
    class="img-fluid mb-3" style="max-height: 60px; max-width: 130px;">
                
                <a href="#"  style="text-decoration:none"><button class="view-options" 
                   data-id="${lender.lender_id}"
                   style="font-size:15px; font-weight:700; color:white ;border-radius:10px;background-color:#821a99;border:none;width:170px">
                   View Options</button>
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
                    <div class="col-md-4">
                    
                   
                        <div class="card sub-product-card border col-md-12  p-3 h-100 " style="background-color: #ffffff; height: 124px; width: 100%; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5); border-radius: 20px;text-align: center;">
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

                            <p class="m-0" style="font-weight:500">$${
                                product.min_amount || 0
                            } - $${product.max_amount || 0}</p>

                        <p class="m-0" style="font-weight:500">Minimum Score Required:  ${
                            product.credit_score || "500+"
                        }</p>
                        </p ><pclass="m-0" style="font-weight:600">APR: ${
                            parseFloat(product.interest_rate).toFixed(2) || ""
                        }</p >  <small class="text-warning security_text d-none" style="font-weight:600">
                          security required for loan amounts over $${
                              product.security_requirement
                          } in this tier
                        </small> <br>
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

                        const $newCard = $container.children().last();
                        $newCard
                            .find(".security_text")
                            .toggleClass(
                                "d-none",
                                product.security_requirement <= 0
                            );
                        $newCard
                            .find(".security_text")
                            .toggleClass(
                                "d-block",
                                product.security_requirement > 0
                            );
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
            .html(
                '<i class="fas fa-spinner fa-spin" style="font-size: 24px;"></i>'
            )
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
            .html(
                '<i class="fas fa-spinner fa-spin" style="font-size: 24px;"></i>'
            )
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

    $(document).ready(function () {
        const table = $("#lenderTable").DataTable({
            // your DataTable config
            searching: true,
            dom: "lrtip", // 'f' removed so default search isn't shown
        });

        // Get the default search input (this still exists even with dom: 'lrtip')
        const $defaultInput = $(
            '<input type="search"  aria-controls="lenderTable" class="form-control">'
        );

        // Listen to search manually
        $defaultInput.on("keyup", function () {
            table.search(this.value).draw();
        });

        // Create the wrapper with icon
        const $customSearch = $(`
    <div class="search-input-wrapper position-relative d-inline-block">
      <i class="fa fa-search position-absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #777;"></i>
    </div>
  `);

        // Style input and append it
        $defaultInput
            .css({
                paddingLeft: "30px",
                height: "36px",
                borderRadius: "25px",
                border: "1px solid #ccc",
            })
            .appendTo($customSearch);

        // Place the custom search in your wrapper
        $("#customSearchWrapper").html($customSearch);
    });

    $(document).on("click", ".delete-btn", function () {
        const customerId = $(this).data("id");

        Swal.fire({
            title: "Are you sure?",
            text: "This action will delete the customer!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to delete route
                window.location.href = `/customer-delete/${customerId}`;
            }
        });
    });

    $(document).on("change", ".status", function () {
        const status = $(this).val();
        const customerId = $(this).data("customer-id");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/update-customer-status",
            method: "POST",
            data: {
                status: status,
                customer_id: customerId,
            },
            success: function (response) {
                console.log(response);
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    icon: "success",
                    title: "Customer Status updated successfully!",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener("mouseenter", Swal.stopTimer);
                        toast.addEventListener("mouseleave", Swal.resumeTimer);
                    },
                });
                getCustomerData();
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    const firstError = Object.values(errors)[0][0];
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "error",
                        title: firstError || "Validation failed!",
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                    });

                    $.each(errors, function (key, messages) {
                        $(`#invalid_${key}`)
                            .removeClass("d-none")
                            .text(messages[0]);
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    });
                }
            },
        });
    });
});
