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
                        if (status == 0) return "#787f79"; // Bootstrap warning
                        if (status == 1) return "#fcc110fa"; // Bootstrap danger
                        if (status == 2) return "#e35966"; // Bootstrap success
                        if (status == 3) return "#25f253"; // Bootstrap success
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
    
    <td>$${item.loan_amt_needed || ""}</td>
    <th><select name="status" 
        style="width: 127px; border-radius:25px; border:none; background-color:${getStatusColor(
            item.status
        )}; color:white; height:35px"
        class="btn no-arrow status" data-customer-id="${item.id}">
    <option value="0" ${
        item.status == 0 ? "selected" : ""
    }>choose status</option>
    <option value="3" ${item.status == 3 ? "selected" : ""}>settled</option>
    <option value="2" ${item.status == 2 ? "selected" : ""}>in-progress</option>
    <option value="1" ${item.status == 1 ? "selected" : ""}>submitted</option>
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
        $("#MainModalloader").show();

        $("#applicableLenderCards").hide();
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
                $("#MainModalloader").show();
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

                    $("#MainModalloader").hide();
                    $(".lender-cards").show();
                }, 2500);

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

        $("#product_modal_lender_logo_spinner").show();
        $("#ProductModalloader").show();
        $("#loanProductsContainer").empty();

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
                $("#ProductModalloader").show();
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
                    loadLenderLogo(
                        baseImageUrl + "/" + lender.lender_logo.toLowerCase()
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
                    // Check if we have more than 3 products
                    if (data.length > 3) {
                        let carouselHtml = `
                     <div id="productCarousel" class="carousel slide" data-bs-ride="false">
                         <div class="carousel-inner">`;

                        let slideIndex = 0;
                        for (let i = 0; i < data.length; i += 3) {
                            let isActive = slideIndex === 0 ? "active" : ""; // Make the first slide active
                            carouselHtml += `<div class="carousel-item ${isActive}">
                         <div class="row g-3">`;

                            for (let j = i; j < i + 3 && j < data.length; j++) {
                                const product = data[j]; // Ensure `product` is inside the loop
                                const guideUrl = product.product_guide
                                    ? /^https?:\/\//i.test(
                                          product.product_guide
                                      )
                                        ? product.product_guide
                                        : `${base_product_guide_url}/${encodeURIComponent(
                                              product.product_guide
                                          )}`
                                    : "#";

                                carouselHtml += `
                          <div class="col-md-4 mb-3">
                          <div class="card sub-product-card border h-100 p-3" style="background-color: #ffffff; height: 300px !important; width: 100%; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5); border-radius: 20px; text-align: center;">
                        <div class="row">
                            <div class="col-md-12 m-3 ps-0 justify-content-center text-center">
                                <img src="${baseImageUrl}/${data[0].lender_logo.toLowerCase()}" class="img-fluid mb-3" alt="Lender Logo" style="width: 73px; height: 35px;">
                                <h5 class="fw-bold" style="color: #852aa3;">${
                                    product.product_name || "Product"
                                }</h5>
                                <h6 class="fw-bold" style="color: #852aa3;">${
                                    product.sub_product_name || ""
                                }</h6>
                                <p class="m-0" style="font-weight:500">$$${
                                    product.min_amount || 0
                                } - $$${product.max_amount || 0}</p>
                                <p class="m-0" style="font-weight:500">Minimum Score Required: ${
                                    product.credit_score || "500+"
                                }</p>
                                <p class="m-0" style="font-weight:600">APR: ${
                                    parseFloat(product.interest_rate).toFixed(
                                        2
                                    ) || ""
                                }</p>
                                <small class="security_text text-warning ${
                                    product.security_requirement > 0
                                        ? "d-block"
                                        : "d-none"
                                }" style="font-weight:600">
                                    Security required for loan amounts over $$${
                                        product.security_requirement
                                    }
                                </small><br>
                                <a href="${guideUrl}" target="_blank" style="color:#852aa3; font-size:15px; margin-top:10px; font-weight:500" class="text-decoration-underline">
                                    View Product Guide <i class="fas fa-download"></i>
                                </a>
                            </div>
                                           </div>
                                       </div>
                                   </div>`;
                            }

                            carouselHtml += `
                               </div>
                           </div>`;

                            slideIndex++;
                        }

                        carouselHtml += `
                             </div>
                             <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev" style="width:100px !important;height:50px !important;margin-left: -52px;margin-top: 121px;">
                                 <span class="carousel-control-prev-icon rounded text-black" style="font-size:30px"><</span>
                             </button>
                             <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next" style="width:100px !important;height:50px !important;margin-right: -52px;margin-top: 121px;">
                                 <span class="carousel-control-next-icon rounded text-black" style="font-size:30px">></span>
                             </button>
                         </div>`;

                        $container.append(carouselHtml);
                    } else {
                        // If 3 or fewer products, just append them normally
                        data.forEach(function (product) {
                            let guideUrl = "#";
                            const guide = product.product_guide;
                            if (guide) {
                                if (/^https?:\/\//i.test(guide)) {
                                    guideUrl = guide;
                                } else {
                                    guideUrl = `${base_product_guide_url}/${encodeURIComponent(
                                        guide
                                    )}`;
                                }
                            }

                            const productHtml = `
                           <div class="col-md-4 mb-3">
                           <div class="card sub-product-card border h-100 p-3 " style="background-color: #ffffff; height: 300px !important; width: 100%; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5); border-radius: 20px; text-align: center;">
                            <div class="row">
                                
                                   
                               
                                <div class="col-md-10 m-3 ps-0 justify-content-center text-center">
                                 <img src="${baseImageUrl}/${data[0].lender_logo.toLowerCase()}" class="img-fluid" alt="Lender Logo" style="width: 73px; height: 35px;">
                             <h5 class="fw-bold" style="color: #852aa3;">${
                                 product.product_name || "Product"
                             }</h5>
                             <h6 class="fw-bold" style="color: #852aa3;">${
                                 product.sub_product_name || ""
                             }</h6>
                             <p class="m-0" style="font-weight:500">$$${
                                 product.min_amount || 0
                             } - $${product.max_amount || 0}</p>
                             <p class="m-0" style="font-weight:500">Minimum Score Required: ${
                                 product.credit_score || "500+"
                             }</p>
                             <p class="m-0" style="font-weight:600">APR: ${
                                 parseFloat(product.interest_rate).toFixed(2) ||
                                 ""
                             }</p>
                             <small class="security_text text-warning ${
                                 product.security_requirement > 0
                                     ? "d-block"
                                     : "d-none"
                             }" style="font-weight:600">
                                                   Security required for loan amounts over $${
                                                       product.security_requirement
                                                   }
                                               </small><br>
                             <a href="${guideUrl}" target="_blank" style="color:#852aa3;font-size:15px;margin-top:10px;font-weight:500" class="text-decoration-underline">View Product Guide <i class="fas fa-download"></i></a>
                           </div>

                            </div>
                        </div>
                    </div>`;
                            $container.append(productHtml);
                        });
                    }

                    // Hide loader
                    $("#product_modal_lender_logo_spinner").hide();
                    $("#ProductModalloader").hide();
                }, 2500);
            },
            error: function (xhr, status, error) {
                console.error("Error fetching sub-products:", error);
                $("#loader").hide();
                $("#loanProductsContainer").html(`
            <div class="text-danger text-center py-4">Unable to load product details. Please try again.</div>`);
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
        resetLenderContactInfo2();
        $("#ContactdetailsModalloader").show();
        $("#contactsAccordion").empty();

        getLenderContactsData(dataId);
    });

    function getLenderContactsData(lenderId) {
        const formData = {
            lenderId: lenderId,
        };

        console.log(formData);

        $.ajax({
            url: "/get-lender-contacts",
            method: "GET",
            data: formData,
            beforeSend: function () {
                $("#ContactdetailsModalloader").show();
            },
            success: function (data) {
                console.log("Lender detail data:", data);

                setTimeout(function () {
                    if (
                        !data ||
                        (Array.isArray(data) && data.length === 0) ||
                        (typeof data === "object" &&
                            Object.keys(data).length === 0)
                    ) {
                        $("#logoLoader2").hide();
                        $("#contactmodalwebsite").hide();
                        $("#phone").hide();
                        $("#ContactModalloader").hide();

                        $("#contactsAccordion").html(`
                           <div class="text-center text-muted" style="font-style: italic;">
                               No contacts available.
                           </div>
                         `);
                        return;
                    }

                    // If data is grouped by state (object with keys)
                    if (
                        !Array.isArray(data) &&
                        typeof data === "object" &&
                        data !== null
                    ) {
                        // Extract lender info from first contact of any group (if needed)
                        let lenderInfo;
                        const stateKeys = Object.keys(data);
                        for (const key of stateKeys) {
                            if (data[key].length > 0) {
                                lenderInfo = data[key][0];
                                break;
                            }
                        }

                        if (lenderInfo) {
                            loadLenderLogo2(
                                baseImageUrl +
                                    "/" +
                                    lenderInfo.lender_logo.toLowerCase()
                            );
                            $("#LenderLogo").attr(
                                "src",
                                `${baseImageUrl}/${lenderInfo.lender_logo.toLowerCase()}`
                            );
                            const websiteUrl =
                                lenderInfo.website_url?.trim() || "";
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
                            $("#search_contact").attr(
                                "data-lender-id",
                                lenderInfo.lender_id
                            );

                            $("#email").text(lenderInfo.lender_email || "N/A");
                        }

                        let finalHtml = "";

                        // Contacts with no state are in the "" key
                        const flatContacts = data[""] || [];

                        // Remove the empty key from state keys to process accordions only for states with names
                        const stateNames = stateKeys.filter(
                            (k) => k.trim() !== ""
                        );

                        stateNames.forEach((stateName) => {
                            const contacts = data[stateName];
                            const slug = stateName
                                .toLowerCase()
                                .replace(/\s+/g, "-")
                                .replace(/[^a-z0-9\-]/g, "");
                            let contactHtml = "";

                            contacts.forEach((contact) => {
                                contactHtml += `
          <div class="contact-row">
            <div class="contact-name">${contact.name}</div>
            <div class="contact-role">${contact.title}</div>
            <div class="contact-phone">
              <i class="fas fa-mobile"></i> ${contact.contact_mobile || "N/A"}
            </div>
            <div class="contact-email">
              <i class="fas fa-envelope"></i> ${contact.contact_email || "N/A"}
            </div>
          </div>
        `;
                            });

                            finalHtml += `
        <div class="accordion-item">
          <h2 class="accordion-header" id="heading-${slug}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-${slug}" aria-expanded="false" aria-controls="collapse-${slug}">
              ${stateName}
            </button>
          </h2>
          <div id="collapse-${slug}" class="accordion-collapse collapse" aria-labelledby="heading-${slug}" data-bs-parent="#contactsAccordion">
            <div class="accordion-body">
              ${contactHtml}
            </div>
          </div>
        </div>
      `;
                        });

                        if (flatContacts.length > 0) {
                            let flatHtml = `<div class="flat-contact-list mt-4">`;

                            flatContacts.forEach((contact) => {
                                flatHtml += `
          <div class="contact-row">
            <div class="contact-name">${contact.name}</div>
            <div class="contact-role">${contact.title}</div>
            <div class="contact-phone">
              <i class="fas fa-mobile"></i> ${contact.contact_mobile || "N/A"}
            </div>
            <div class="contact-email">
              <i class="fas fa-envelope"></i> ${contact.contact_email || "N/A"}
            </div>
          </div>
        `;
                            });

                            flatHtml += `</div>`;
                            finalHtml += flatHtml;
                        }

                        $("#contactsAccordion").html(finalHtml);
                        $("#loader").hide();
                        $("#ContactdetailsModalloader").hide();
                        $("#applicable_lenders").val(JSON.stringify(data));
                        return;
                    }
                }, 2500);
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

    $(document).on("input", "#search_contact", function () {
        var search_value = $(this).val();
        var lender_id = $(this).attr("data-lender-id");

        if (!search_value) {
            return getLenderContactsData(lender_id);
        }

        $.ajax({
            type: "GET",
            url: "/search-contact",
            data: { search: search_value, lender_id: lender_id },
            beforeSend: function () {
                $("#loader").show();
            },
            success: function (response) {
                var contacts = response; // array of contacts
                var search_value = $("#search_contact").val().trim();

                var mainAccordion = $("#contactsAccordion");
                mainAccordion.empty(); // Clear the existing accordion content

                if (search_value !== "") {
                    // Hide regular state-wise accordions if any were rendered elsewhere
                    $(".accordion-item").hide();

                    if (contacts.length === 0) {
                        mainAccordion.append("<p>No contacts found.</p>");
                    } else {
                        // Create the Search Results accordion section
                        let accordionHtml = `
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSearchResults">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSearchResults" aria-expanded="true" aria-controls="collapseSearchResults">
                         Results (${contacts.length})
                        </button>
                    </h2>
                    <div id="collapseSearchResults" class="accordion-collapse collapse show" aria-labelledby="headingSearchResults" data-bs-parent="#contactsAccordion">
                        <div class="accordion-body" id="searchResultsBody">
                        </div>
                    </div>
                </div>
            `;

                        mainAccordion.append(accordionHtml);

                        // Now bind each contact as an inner accordion-like item (or a styled row)
                        contacts.forEach(function (contact, index) {
                            var contactHtml = `
                    <div class="contact-row mb-3 p-2 border rounded">
                        <div class="contact-name"><strong>${
                            contact.name
                        }</strong></div>
                        <div class="contact-role">${contact.title}</div>
                        <div class="contact-phone"><i class="fas fa-mobile"></i> ${
                            contact.contact_mobile || "N/A"
                        }</div>
                        <div class="contact-email"><i class="fas fa-envelope"></i> ${
                            contact.contact_email || "N/A"
                        }</div>
                    </div>
                `;
                            $("#searchResultsBody").append(contactHtml);
                        });
                    }
                } else {
                    // If no search value, show original state-wise accordion content (restore logic here)
                    renderStateWiseAccordion(contacts); // You can implement this function for default view
                }

                $("#loader").hide();
            },

            error: function (xhr, status, error) {
                console.error("Error fetching lender contacts:", error);
                $("#loader").hide();
            },
        });
    });
});
