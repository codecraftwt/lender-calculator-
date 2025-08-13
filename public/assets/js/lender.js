$(document).ready(function () {
    window.mainLenderTable = $("#lenderTable").DataTable({
        paging: true,
        lengthChange: false,
        searching: true,
        ordering: false,
        info: true,
        autoWidth: false,
        stripeClasses: ["odd", "even"],
        responsive: true,
        lengthMenu: [100, 120, 140, 160],
        pageLength: 80,
        dom: "Blfrtip",
        buttons: [
            {
                extend: "excelHtml5",
                text: "Export to Excel",
                exportOptions: { columns: [0, 1, 3, 4, 5] },
                title: "Lender List",
            },
            {
                extend: "print",
                text: "Print Table",
                exportOptions: { columns: [0, 1, 3, 4, 5] },
                title: "Lender List",
            },
        ],

        ajax: {
            url: "/get-lenders",
            dataSrc: "",
        },

        columns: [
            { data: null, render: (data, type, row, meta) => meta.row + 1 },
            { data: "lender_name" },
            {
                data: "lender_logo",
                render: function (data, type, row) {
                    return `<img src="${baseImageUrl}/${data.toLowerCase()}" alt="${
                        row.lender_name
                    }" class="img-fluid mb-3" style="max-height:60px; max-width:130px;">`;
                },
            },
            { data: "email" },
            { data: "mobile_number" },
            { data: "website_url" },
            {
                data: "product_ids",
                render: function (data) {
                    const product_id_arr = JSON.stringify(data).replace(
                        /'/g,
                        "&#39;"
                    );
                    return `<button type="button" data-id='${product_id_arr}' class="btn btn-sm btn-info view-btn" style="background: linear-gradient(90deg, #4a3f9a 0%, #d15de8 100%);color:white;border:1px solid #8455d9">View</button>`;
                },
            },
            {
                data: "product_ids",
                render: function (data) {
                    const product_id_arr = JSON.stringify(data).replace(
                        /'/g,
                        "&#39;"
                    );

                    if (userRole === "Admin") {
                        return `<button type="button" data-main-lender-id='${product_id_arr}' class="btn btn-sm btn-info edit-main-lender-info" style="color:white;"><i class="fas fa-pencil"></i></button>`;
                    } else {
                        return "";
                    }
                },
            },
        ],
    });

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
        resetMainModalLoader();

        triggerAjax(pidArray);
    });

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
                $("#MainModalloader").show();
            },
            success: function (data) {
                console.log(data);
                setTimeout(function () {
                    const $container = $("#applicableLenderCards");
                    $container.empty();

                    if (data.length < 1) {
                        $("#MainModalloader").hide();
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
                        );

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
                                     class="img-fluid mb-2" style="max-height: 60px; max-width: 130px;">
        
                               <h4 style="text-align: center;">${
                                   lender.product_name
                               }</h4>
                
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

        console.log("Product Type IDs:", productTypeIds);

        const modalElement = document.getElementById("lenderDetailModal");

        const detailModal = new bootstrap.Modal(modalElement, {
            backdrop: false,
            keyboard: true,
        });

        detailModal.show();

        resetlenderDetailModal();
        getSubProductData(productTypeIds, lenderId);
    });

    function getSubProductData(products, lenderId) {
        const formData = {
            product_ids: products,
            lenderId: lenderId,
        };

        console.log(formData);
        resetLenderContactInfo();

        $.ajax({
            url: "/get-lender-subproducts",
            method: "GET",
            data: formData,
            beforeSend: function () {
                $("#ProductEditModalContainer")
                    .children()
                    .not("#ProductModalloader")
                    .remove();

                $("#ProductModalloader").show();
            },
            success: function (data) {
                console.log("Lender detail data:", data);

                setTimeout(function () {
                    const $container = $("#loanProductsContainer");
                    $container.empty();

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

                    if (data.length > 3) {
                        let carouselHtml = `
                    <div id="productCarousel" class="carousel slide" data-bs-ride="false">
                        <div class="carousel-inner">`;

                        let slideIndex = 0;
                        for (let i = 0; i < data.length; i += 3) {
                            let isActive = slideIndex === 0 ? "active" : "";
                            carouselHtml += `<div class="carousel-item ${isActive}">
                         <div class="row g-3">`;

                            for (let j = i; j < i + 3 && j < data.length; j++) {
                                const product = data[j];
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

                    $("#product_modal_lender_logo_spinner").hide();
                    $("#ProductModalloader").hide();
                }, 2500);
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
        console.log("Product Type IDs:", dataId);
        const modalElement = document.getElementById("lenderContactModal");

        const detailModal = new bootstrap.Modal(modalElement, {
            backdrop: false,
            keyboard: true,
        });

        detailModal.show();
        resetLenderContactInfo2();

        getLenderContactsData(dataId);
    });
    function getLenderContactsData(lenderId) {
        $.ajax({
            url: "/get-lender-contacts",
            method: "GET",
            data: { lenderId },
            beforeSend() {
                $("#ContactModalloader").show();
                $("#contactsAccordion").empty();
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

                        let lenderInfo;
                        const stateKeys = Object.keys(data);
                        for (const key of stateKeys) {
                            if (data[key].length > 0) {
                                lenderInfo = data[key][0];
                                break;
                            }
                        }
                    }

                    if (
                        !Array.isArray(data) &&
                        typeof data === "object" &&
                        data !== null
                    ) {
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

                        const flatContacts = data[""] || [];

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
                                     <div class="contact-name">${
                                         contact.name
                                     }</div>
                                     <div class="contact-role">${
                                         contact.title
                                     }</div>
                                     <div class="contact-phone">
                                       <i class="fas fa-mobile"></i> ${
                                           contact.contact_mobile || "N/A"
                                       }
                                     </div>
                                     <div class="contact-email">
                                       <i class="fas fa-envelope"></i> ${
                                           contact.contact_email || "N/A"
                                       }
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
                                     <div class="contact-name">${
                                         contact.name
                                     }</div>
                                     <div class="contact-role">${
                                         contact.title
                                     }</div>
                                     <div class="contact-phone">
                                       <i class="fas fa-mobile"></i> ${
                                           contact.contact_mobile || "N/A"
                                       }
                                     </div>
                                     <div class="contact-email">
                                       <i class="fas fa-envelope"></i> ${
                                           contact.contact_email || "N/A"
                                       }
                                     </div>
                                   </div>
                                 `;
                            });

                            flatHtml += `</div>`;
                            finalHtml += flatHtml;
                        }

                        $("#ContactModalloader").hide();
                        $("#contactsAccordion").html(finalHtml);
                        $("#loader").hide();
                        $("#applicable_lenders").val(JSON.stringify(data));
                        return;
                    }
                }, 2500);
            },
            error(err) {
                console.error("Error fetching contacts:", err);
                $("#loader").hide();
            },
        });
    }

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
            beforeSend: function () {},
            success: function (response) {
                var contacts = response;
                var search_value = $("#search_contact").val().trim();

                var mainAccordion = $("#contactsAccordion");
                mainAccordion.empty();

                if (search_value !== "") {
                    $(".accordion-item").hide();

                    if (contacts.length === 0) {
                        mainAccordion.append("<p>No contacts found.</p>");
                    } else {
                        let accordionHtml = `
                             <div class="accordion-item">
                                 <h2 class="accordion-header" id="headingSearchResults">
                                     <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSearchResults" aria-expanded="true" aria-controls="collapseSearchResults">
                                         Search Results (${contacts.length})
                                     </button>
                                 </h2>
                                 <div id="collapseSearchResults" class="accordion-collapse collapse show" aria-labelledby="headingSearchResults" data-bs-parent="#contactsAccordion">
                                     <div class="accordion-body" id="searchResultsBody">
                                     </div>
                                 </div>
                             </div>
                             `;

                        mainAccordion.append(accordionHtml);

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
                    renderStateWiseAccordion(contacts);
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

function loadLenderLogo(imageUrl) {
    const $logoImg = $("#product_modal_lender_logo");
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
    $("#contactsAccordion").empty();
    $("#search_contact").val("");
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

function resetMainModalLoader() {
    $("#applicableLenderCards").empty();
    $("#MainModalloader").show();
}

function resetlenderDetailModal() {
    $("#product_modal_lender_logo_spinner").show();
    $("#product_modal_lender_logo").attr("src", "");
    $("#modalurl").val("");
    $("#modalPhone").val("");
    $("#modalEmail").val("");
    $("#ProductModalloader").show();
    $("#loanProductsContainer").empty();
}
