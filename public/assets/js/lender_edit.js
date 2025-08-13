$('input[name="product_guide_type"]').on("change", function () {
    if ($(this).val() === "file") {
        $("#fileInputGroup").show();
        $("#product_guide_file").attr("required", true);
        $("#urlInputGroup").hide();
        $("#product_guide_url").attr("required", false).val("");
    } else {
        $("#urlInputGroup").show();
        $("#product_guide_url").attr("required", true);
        $("#fileInputGroup").hide();
        $("#product_guide_file").attr("required", false).val("");
    }
});

$(document).on("click", ".edit-main-lender-info", function () {
    resetMainLenderModalInfo();
    const main_lender_id = $(this).data("main-lender-id");
    const modal = new bootstrap.Modal($("#Main_Lender_Edit_Modal")[0]);
    modal.show();
    getMainModalData(main_lender_id);
});
function getMainModalData(main_lender_id) {
    const formData = {
        pid: main_lender_id,
    };
    $.ajax({
        url: "/get-lender-products",
        method: "GET",
        data: formData,
        beforeSend: function () {
            $("#MainLenderloanProductsContainer")
                .children()
                .not("#MainLenderModalloader")
                .remove();

            $("#MainLenderModalloader").show();
        },
        success: function (data) {
            setTimeout(function () {
                const $container = $("#MainLenderloanProductsContainer");
                if (data.length < 1) {
                    $("#main_lender_modal_logo").hide();
                    final_url =
                        baseImageUrl + "/" + lender.lender_logo.toLowerCase();
                    $("#lender_name").val(lender.lender_name);
                    $("#lender_website").val(lender.website_url);
                    $("#lender_email").val(lender.email);
                    $("#mobile_number").val(lender.mobile_number);
                    $("#main_lender_logo").attr("src", final_url);
                } else {
                    const lender = data[0];
                    $("#main_lender_modal_logo").hide();
                    final_url =
                        baseImageUrl + "/" + lender.lender_logo.toLowerCase();
                    $("#lender_name").val(lender.lender_name);
                    $("#lender_website").val(lender.website_url);
                    $("#lender_email").val(lender.email);
                    $("#lender_id").val(lender.lender_id);
                    $("#mobile_number").val(lender.mobile_number);
                    $("#main_lender_logo").attr("src", final_url);
                    $(".view-contact-edit-btn").attr(
                        "data-main-lender-id",
                        lender.lender_id
                    );
                }
                data.forEach(function (lender) {
                    const productTypeIds = JSON.stringify(
                        lender.subproduct_ids
                    );
                    const cardHtml = `<div class="col-6 col-md-6 mb-2 d-flex justify-content-center view-product-edit-modal-btn" 
                            data-product-type-id='${productTypeIds}' data-product-id='${
                              lender.product_id
                            }'>
                         <div class="lender-box-container position-relative">
                       
                           <!-- Original Card Content -->
                           <div class="lender-box d-flex flex-column align-items-center justify-content-center p-3"
                                data-lender-sub-product-id="${
                                    lender.product_id
                                }" id="lenderCard${lender.product_id}" >
                                  
                             <img src="${baseImageUrl}/${lender.lender_logo.toLowerCase()}" 
                                  alt="${lender.lender_name}" 
                               class="img-fluid mb-3" 
                                  style="max-height: 60px; max-width: 130px;">
                                  
                             <h4 style="text-align: center;">${
                                 lender.product_name
                             }</h4>
                             
                             <a href="#" class="view-options text-decoration-underline" 
                                data-id="${lender.product_id}" 
                                                       style="font-size:15px; font-weight:700; color: #821a99">
                                View Options
                             </a>
                           </div>
                       
                           <!-- Shutter Panels -->
                           <div class="shutter left-shutter"></div>
                           <div class="shutter right-shutter"></div>
                       
                           <!-- Overlay Content -->
                           <div class="shutter-content d-flex flex-column align-items-center justify-content-center">
                             <i class="fas fa-pencil-alt fa-2x mb-2"></i>
                             <span>Edit Product Details</span>
                           </div>
                         </div>
                       </div>
                       `;

                    $container.append(cardHtml);
                });
                $("#MainLenderModalloader").hide();
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

function resetMainLenderModalInfo() {
    $("#main_lender_modal_logo").show();

    $("#lender_name").val("");
    $("#lender_website").val("");
    $("#lender_email").val("");
    $("#mobile_number").val("");
    $("#main_lender_logo").attr("src", "");
}

$(document).on("click", ".view-product-edit-modal-btn", function () {
    var product_id = $(this).attr("data-product-id");
    var sub_product_ids = $(this).attr("data-product-type-id");    
    const Product_Edit_Modal = new bootstrap.Modal($("#Product_Edit_Modal")[0]);
    Product_Edit_Modal.show();
    resetProductEditModalInfo();
    getProductDataWithSubProducts(product_id, sub_product_ids);
});

function getProductDataWithSubProducts(product_id, sub_product_ids) {
    const formData = {
        product_id: product_id,
        sub_product_ids: sub_product_ids,
    };

    $.ajax({
        url: "/get-product-data-with-subproducts",
        method: "GET",
        data: formData,
        beforeSend: function () {
            $("#ProductEditModalContainer")
                .children()
                .not("#ProductEditModalloader")
                .remove();
            $("#ProductEditModalloader").show();
        },
        success: function (data) {
            setTimeout(function () {
                const $container = $("#ProductEditModalContainer");
                if (data.length < 1) {
                    $("#product_edit_modal_lender_logo_spinner").hide();
                    final_url =
                        baseImageUrl + "/" + lender.lender_logo.toLowerCase();
                    $("#lender_name").val(lender.lender_name);
                    $("#lender_website").val(lender.website_url);
                    $("#lender_email").val(lender.email);
                    $("#mobile_number").val(lender.mobile_number);
                    $("#product_edit_modal_lender_logo").attr("src", final_url);
                } else {
                    const lender = data[0];
                    $("#product_edit_modal_lender_logo_spinner").hide();
                    final_url =
                        baseImageUrl + "/" + lender.lender_logo.toLowerCase();
                    $("#product_name").val(lender.product_name);
                    $("#product_id").val(lender.product_id);

                    $("#product_edit_modal_lender_logo").attr("src", final_url);
                }
                data.forEach(function (lender) {
                    const cardHtml = `<div class="col-md-4 view-sub-product-edit-modal-btn" data-sub-product-id="${
                        lender.subproduct_id
                    }">
                  <div class="card sub-product-card border p-3 h-100" style="background-color: #ffffff; height: 124px; width: 100%; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5); border-radius: 20px; text-align: center; position: relative;">
                    <div class="row">
                      <div class="col-md-2" style="width:100px">
                        <img src="${baseImageUrl}/${lender.lender_logo.toLowerCase()}" alt="" style="height: 33px;">
                      </div>
                      <div class="col-md-12">
                        <h5 class="fw-bold" style="color:#852aa3;">${
                            lender.product_name || "Product"
                        }</h5>
                        <h6 class="fw-bold" style="color:#852aa3;">${
                            lender.sub_product_name || ""
                        }</h6>
                        <p class="m-0" style="font-weight:500">$${
                            lender.min_loan_amount || 0
                        } - $${lender.max_loan_amount || 0}</p><br>
                                       <p class="m-0" style="font-weight:500">Minimum Score Required: ${
                                           lender.credit_score || "500+"
                                       }</p>
                        <p class="m-0" style="font-weight:600">APR: ${
                            parseFloat(lender.interest_rate).toFixed(2) || ""
                        }</p>
                        <small class="text-warning security_text d-none" style="font-weight:600">
                          security required for loan amounts over $${
                              lender.security_requirement
                          } in this tier
                        </small>
                      </div>
                    </div>
                    <div class="left-shutter"></div>
                    <div class="right-shutter"></div>
                    <div class="shutter-content d-flex flex-column align-items-center justify-content-center">
                      <i class="fas fa-pencil-alt"></i> Edit Subproduct
                    </div>
                  </div>
                </div>`;
                    $container.append(cardHtml);
                    const $newCard = $container.children().last();
                    $newCard
                        .find(".security_text")
                        .toggleClass(
                            "d-none",
                            lender.security_requirement <= 0
                        );
                    $newCard
                        .find(".security_text")
                        .toggleClass(
                            "d-block",
                            lender.security_requirement > 0
                        );
                });
                $("#ProductEditModalloader").hide();
                $("#product_edit_modal_lender_logo_spinner").hide();
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
function resetProductEditModalInfo() {
    $("#product_name").val("");
    $("#product_id").val("");
    $("#product_edit_modal_lender_logo").attr("src", "");
    $("#product_edit_modal_lender_logo_spinner").show();
    $("#lender_logo").val("");
    $("#product_guide_file").val("");
    $("#product_guide_url").val("");
}

$(document).on("click", ".view-sub-product-edit-modal-btn", function () {
    var sub_product_id = $(this).attr("data-sub-product-id");
    console.log(sub_product_id);
    const Sub_Product_Edit_Modal = new bootstrap.Modal(
        $("#Sub_Product_Edit_Modal")[0]
    );
    Sub_Product_Edit_Modal.show();
    resetSubProductEditModalInfo();
    getSubProductData(sub_product_id);
});

function getSubProductData(sub_product_id) {
    const formData = {
        sub_product_id: sub_product_id,
    };
    $.ajax({
        url: "/get-sub-product-data",
        method: "GET",
        data: formData,
        beforeSend: function () {
            $("#SubProductEditModalContainer")
                .children()
                .not("#SubProductModalloader")
                .remove();

            $("#SubProductModalloader").show();
        },
        success: function (data) {
            console.log(data);
            setTimeout(function () {
                const $container = $("#SubProductEditModalContainer");
                if (!data.rawresult || data.rawresult.length < 1) {
                    $("#sub_product_modal_lender_logo_spinner").hide();
                    final_url =
                        baseImageUrl + "/" + lender.lender_logo.toLowerCase();
                    $("#sub_product_modal_lender_logo").attr("src", final_url);
                } else {
                    const lender = data.rawresult[0];
                    $("#sub_product_modal_lender_logo_spinner").hide();
                    final_url =
                        baseImageUrl + "/" + lender.lender_logo.toLowerCase();
                    $("#sub_product_name").val(lender.sub_product_name);
                    $("#sub_product_id").val(lender.subproduct_id);
                    $("#trading_time").val(lender.trading_time);
                    $("#gst_time").val(lender.gst_time);
                    $("#min_loan_amount").val(lender.min_loan_amount);
                    $("#max_loan_amount").val(lender.max_loan_amount);
                    $("#annual_income").val(lender.annual_income);
                    $("#credit_score").val(lender.credit_score);
                    $("#number_of_dishonours").val(lender.number_of_dishonours);
                    $("#negative_days").val(lender.negative_days);
                    $("#interest_rate").val(lender.interest_rate);
                    $("#security_requirement").val(lender.security_requirement);
                    $("#sub_product_modal_lender_logo").attr("src", final_url);
                    if (
                        lender.property_owner === "Yes" ||
                        lender.property_owner === "No"
                    ) {
                        $("#property_owner").val(lender.property_owner);
                    } else {
                        $("#property_owner").val("");
                    }

                    if (
                        lender.GST_registration === "Yes" ||
                        lender.GST_registration === "No"
                    ) {
                        $("#gst_registration").val(lender.GST_registration);
                    } else {
                        $("#gst_registration").val("");
                    }

                    let selectedIndustries = [];
                    try {
                        const rawIndustries =
                            data.rawresult[0]?.restricted_industry;
                        if (rawIndustries) {
                            selectedIndustries = JSON.parse(rawIndustries);
                            if (Array.isArray(selectedIndustries)) {
                                selectedIndustries = selectedIndustries.map(
                                    (s) => s.trim()
                                );
                            } else {
                                selectedIndustries = [];
                            }
                        }
                    } catch (e) {
                        console.error("Invalid restricted_industry JSON:", e);
                    }
                    const $select = $("#restricted_industry");
                    $select.find('option:not([value="null"])').remove();
                    const addedValues = new Set();
                    data.restricted_industries.forEach((industry) => {
                        const trimmed = industry?.trim();
                        if (trimmed && !addedValues.has(trimmed)) {
                            $select.append(new Option(trimmed, trimmed));
                            addedValues.add(trimmed);
                        }
                    });
                    console.log("**All options**", data.restricted_industries);
                    console.log("**Selected options**", selectedIndustries);
                    $select.empty();

                    // 2. Add all options from `data.restricted_industries`
                    data.restricted_industries.forEach((industry) => {
                        // Check if this option is selected
                        const isSelected =
                            selectedIndustries.includes(industry);
                        const $option = new Option(
                            industry,
                            industry,
                            isSelected,
                            isSelected
                        );
                        $select.append($option);
                    });

                    // 3. Destroy previous Select2 (if any)
                    if (
                        $.fn.select2 &&
                        $select.hasClass("select2-hidden-accessible")
                    ) {
                        $select.select2("destroy");
                    }

                    // 4. Initialize Select2
                    $select.select2({
                        placeholder: "Select restricted industries",
                        allowClear: true,
                    });

                    // Set selected values *after* Select2 is initialized
                    if (selectedIndustries.length > 0) {
                        $("#restricted_industry")
                            .val(selectedIndustries)
                            .trigger("change");
                    }

                    $("#Sub_Product_Edit_Modal").on(
                        "shown.bs.modal",
                        function () {
                            $("#restricted_industry").select2({
                                placeholder: "Select restricted industries",
                                allowClear: true,
                                tags: true,
                            });
                        }
                    );

                    $("#SubProductModalloader").hide();
                    // $(".lender-cards").show();
                }
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

function resetSubProductEditModalInfo() {
    $("#sub_product_modal_lender_logo_spinner").show();
    $("#sub_product_name").val("");
    $("#sub_product_id").val("");
    $("#trading_time").val("");
    $("#gst_time").val("");
    $("#min_loan_amount").val("");
    $("#max_loan_amount").val("");
    $("#annual_income").val("");
    $("#credit_score").val("");
    $("#number_of_dishonours").val("");
    $("#negative_days").val("");
    $("#interest_rate").val("");
    $("#security_requirement").val("");
    $("#sub_product_modal_lender_logo").attr("src", "");
}

$(document).ready(function () {
    // Toggle between file and URL input
    $("input[name='product_guide_type']").change(function () {
        if (this.value === "file") {
            $("#fileInputGroup").show();
            $("#urlInputGroup").hide();
        } else {
            $("#fileInputGroup").hide();
            $("#urlInputGroup").show();
        }
    });

    // Custom Validation Function
    const validateField = (id, showErrorMessage = true) => {
        const $field = $(`#${CSS.escape(id)}`);
        let val = $field.val().trim(); // Get the field value safely

        // If the field is empty, no need to validate (only validate when it's not empty)
        if (
            !val &&
            (id === "product_guide_file" || id === "product_guide_url")
        ) {
            return true;
        }

        if (showErrorMessage) {
            $(`#invalid_${CSS.escape(id)}`).addClass("d-none");
        }

        switch (id) {
            case "lender_logo":
                // Validate file extension (jpg, jpeg, png, webp, gif)
                if (val) {
                    const validExtensions = /\.(jpg|jpeg|png|webp|gif)$/i;
                    return (
                        validExtensions.test(val) ||
                        (showErrorMessage &&
                            showError(
                                id,
                                "Only image files are allowed (jpg, jpeg, png, webp, gif)."
                            ))
                    );
                }
                return true;

            case "lender_name":
                // Lender name should be at least 2 characters
                return (
                    val.length >= 2 ||
                    (showErrorMessage &&
                        showError(id, "Please enter lender name."))
                );

            case "lender_id":
                // Lender ID should be a number
                return (
                    /^[0-9]+$/.test(val) ||
                    (showErrorMessage &&
                        showError(id, "Lender ID must be a number."))
                );

            case "lender_website":
                // Validate URL format
                const urlPattern = new RegExp(
                    "^(https?:\\/\\/)?([\\w\\d-]+\\.)+[a-z]{2,6}(\\/[^\\s]*)?$"
                );
                return (
                    urlPattern.test(val) ||
                    (showErrorMessage &&
                        showError(id, "Please enter a valid URL."))
                );

            case "lender_email":
                // Validate Email format
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return (
                    emailPattern.test(val) ||
                    (showErrorMessage &&
                        showError(id, "Please enter a valid email address."))
                );

            case "mobile_number":
                // Mobile number should be between 8 and 15 digits
                return (
                    /^\+?[0-9\s\-()]{5,20}$/.test(val) ||
                    (showErrorMessage &&
                        showError(
                            id,
                            "Mobile number must be between 5 and 20 digits."
                        ))
                );

            case "product_guide_file":
                // If file input is selected, check if it's a valid file extension (pdf, doc, docx, jpg, jpeg, png, gif, webp)
                if (
                    $("input[name='product_guide_type']:checked").val() ===
                        "file" &&
                    val
                ) {
                    const filePattern =
                        /\.(pdf|doc|docx|jpg|jpeg|png|gif|webp)$/i;
                    return (
                        filePattern.test(val) ||
                        (showErrorMessage &&
                            showError(
                                id,
                                "Only PDF, DOC or image files (jpg, png, gif, webp) are allowed."
                            ))
                    );
                }
                return true;

            case "product_guide_url":
                // If URL input is selected, validate the URL format
                if (
                    $("input[name='product_guide_type']:checked").val() ===
                        "url" &&
                    val
                ) {
                    const urlPattern = new RegExp(
                        "^(https?:\\/\\/)?([\\w\\d-]+\\.)+[a-z]{2,6}(\\/[^\\s]*)?$"
                    );
                    return (
                        urlPattern.test(val) ||
                        (showErrorMessage &&
                            showError(id, "Please enter a valid URL."))
                    );
                }
                return true;

            default:
                return true;
        }
    };

    // Show error message for the given field
    const showError = (id, message) => {
        const $errorContainer = $(`#invalid_${CSS.escape(id)}`);
        $errorContainer.removeClass("d-none").html(message);
        return false;
    };

    $(document).on("click", ".main_lender_edit_submit_btn", function (e) {
        e.preventDefault();

        let isValid = true;

        // Validate each field
        isValid &= validateField("lender_logo");
        isValid &= validateField("lender_name");
        isValid &= validateField("lender_id");
        isValid &= validateField("lender_website");
        isValid &= validateField("lender_email");
        isValid &= validateField("mobile_number");
        isValid &= validateField("product_guide_file");
        isValid &= validateField("product_guide_url");

        if (isValid) {
            const form = $("#MainLenderEditForm")[0];
            const formData = new FormData(form);

            $.ajax({
                url: $(form).attr("action"),
                method: $(form).attr("method") || "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    // You can customize success behavior here:
                    // e.g., close modal, show success toast

                    console.log(response);
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "success",
                        title: "Lender updated successfully!",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener(
                                "mouseenter",
                                Swal.stopTimer
                            );
                            toast.addEventListener(
                                "mouseleave",
                                Swal.resumeTimer
                            );
                        },
                    });

                    $("#Main_Lender_Edit_Modal").modal("hide");
                    refreshLenderTable();
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        // Show first error as toast
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

                        // Show inline errors too (if applicable)
                        $.each(errors, function (key, messages) {
                            $(`#invalid_${key}`)
                                .removeClass("d-none")
                                .text(messages[0]);
                        });

                        // 🔁 Keep modal open
                        $("#mainLenderModal").modal("show");
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                        });
                    }
                },
            });
        }
    });

    // Success toast

    // Error toast
});

function refreshLenderTable() {
    if (window.mainLenderTable) {
        window.mainLenderTable.ajax.reload(null, false); // false = stay on same page
    } else {
        console.warn("mainLenderTable is not defined.");
    }
}

$(document).ready(function () {
    // Validation function for fields in ProductEditForm
    const validateField = (id, showErrorMessage = true) => {
        const $field = $(`#${CSS.escape(id)}`);
        const val = $field.val().trim();

        // Hide error initially
        if (showErrorMessage) {
            $(`#invalid_${CSS.escape(id)}`).addClass("d-none");
        }

        switch (id) {
            case "product_name":
                // Product name required, at least 2 characters
                if (val.length >= 2) {
                    return true;
                } else {
                    if (showErrorMessage) {
                        $(`#invalid_${id}`)
                            .removeClass("d-none")
                            .text("Please enter a valid name.");
                    }
                    return false;
                }

            case "product_id":
                // Product ID should be numeric
                if (/^[0-9]+$/.test(val)) {
                    return true;
                } else {
                    if (showErrorMessage) {
                        $(`#invalid_${id}`)
                            .removeClass("d-none")
                            .text("Please enter a valid numeric ID.");
                    }
                    return false;
                }

            default:
                return true;
        }
    };

    // On form submit button click
    $(document).on("click", ".product_edit_submit_btn", function (e) {
        e.preventDefault();

        let isValid = true;

        // Validate required fields
        isValid &= validateField("product_name");
        isValid &= validateField("product_id");

        if (isValid) {
            const form = $("#ProductEditForm")[0];
            const formData = new FormData(form);

            $.ajax({
                url: $(form).attr("action"), // Make sure form action attribute is set properly
                method: $(form).attr("method") || "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "success",
                        title: "Product updated successfully!",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener(
                                "mouseenter",
                                Swal.stopTimer
                            );
                            toast.addEventListener(
                                "mouseleave",
                                Swal.resumeTimer
                            );
                        },
                    });

                    // Close modal if applicable
                    $("#Product_Edit_Modal").modal("hide");
                    $("#Main_Lender_Edit_Modal").modal("hide");
                    refreshLenderTable();
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        // Show first error as toast
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

                        // Show inline errors
                        $.each(errors, function (key, messages) {
                            $(`#invalid_${key}`)
                                .removeClass("d-none")
                                .text(messages[0]);
                        });

                        // Keep modal open
                        $("#ProductEditModal").modal("show");
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                        });
                    }
                },
            });
        }
    });
});

$(document).ready(function () {
    const validateField = (id, showErrorMessage = true) => {
        const $field = $(`#${CSS.escape(id)}`);
        const rawVal = $field.val();
        const val = Array.isArray(rawVal) ? rawVal : (rawVal || "").trim();
        if (showErrorMessage) {
            $(`#invalid_${CSS.escape(id)}`)
                .addClass("d-none")
                .text("");
        }

        switch (id) {
            case "sub_product_id":
                // optional numeric validation
                if (!val || /^[0-9]+$/.test(val)) {
                    return true;
                } else {
                    if (showErrorMessage) {
                        $(`#invalid_${id}`)
                            .removeClass("d-none")
                            .text("Please enter valid id.");
                    }
                    return false;
                }

            case "sub_product_name":
                if (val.length >= 2) {
                    return true;
                } else {
                    if (showErrorMessage) {
                        $(`#invalid_${id}`)
                            .removeClass("d-none")
                            .text("Please enter valid name.");
                    }
                    return false;
                }

            case "trading_time":
            case "gst_time":
            case "min_loan_amount":
            case "max_loan_amount":
            case "security_requirement":
            case "annual_income":
            case "credit_score":
            case "number_of_dishonours":
            case "negative_days":
            case "interest_rate":
                // Numeric fields, allow decimals where applicable (adjust regex if needed)
                if (val === "" || /^[0-9]+(\.[0-9]+)?$/.test(val)) {
                    return true;
                } else {
                    if (showErrorMessage) {
                        $(`#invalid_${id}`)
                            .removeClass("d-none")
                            .text(
                                `Please enter valid ${id.replace(/_/g, " ")}.`
                            );
                    }
                    return false;
                }

            case "gst_registration":
            case "property_owner":
                if (val === "Yes" || val === "No") {
                    return true;
                } else {
                    if (showErrorMessage) {
                        $(`#invalid_${id}`)
                            .removeClass("d-none")
                            .text("Please select valid option.");
                    }
                    return false;
                }

            case "restricted_industry":
                // select multiple validation: ensure at least one selected
                if ($(`#${id}`).val()?.length > 0) {
                    return true;
                } else {
                    if (showErrorMessage) {
                        $(`#invalid_${id}`)
                            .removeClass("d-none")
                            .text("Please select at least one option.");
                    }
                    return true;
                }

            default:
                return true;
        }
    };

    // On form submit
    $(document).on("click", ".sub_product_edit_submit_btn", function (e) {
        e.preventDefault();

        let isValid = true;

        // Validate all fields explicitly
        const fieldsToValidate = [
            "sub_product_id",
            "sub_product_name",
            "trading_time",
            "gst_registration",
            "gst_time",
            "min_loan_amount",
            "max_loan_amount",
            "annual_income",
            "credit_score",
            "property_owner",
            "number_of_dishonours",
            "negative_days",
            "interest_rate",
            "restricted_industry",
            "security_requirement",
        ];

        for (const field of fieldsToValidate) {
            isValid &= validateField(field);
        }

        if (isValid) {
            const form = $(this).closest("form")[0]; // ✅ Fix here
            const formData = new FormData(form);
            $.ajax({
                url: $(form).attr("action"),
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "success",
                        title: "Sub Product updated successfully!",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener(
                                "mouseenter",
                                Swal.stopTimer
                            );
                            toast.addEventListener(
                                "mouseleave",
                                Swal.resumeTimer
                            );
                        },
                    });

                    $("#Sub_Product_Edit_Modal").modal("hide");
                    $("#Product_Edit_Modal").modal("hide");
                    $("#Main_Lender_Edit_Modal").modal("hide");
                    refreshLenderTable();
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

                        // Show inline errors
                        $.each(errors, function (key, messages) {
                            $(`#invalid_${key}`)
                                .removeClass("d-none")
                                .text(messages[0]);
                        });

                        $("#Sub_Product_Edit_Modal").modal("show");
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                        });
                    }
                },
            });
        }
    });

    $(document).on("click", ".view-contact-edit-btn", function (e) {
        e.preventDefault();

        const dataId = $(this).attr("data-main-lender-id");
        console.log("Product Type IDs:", dataId);
        const modalElement = document.getElementById(
            "Lender_Contact_Edit_Modal"
        );

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
                $("#ContactEditModalloader").show();
                $("#contactsEditAccordion").hide();
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
                        $("#contact_edit_logo_loader").hide();
                        $("#ContactEditModalloader").hide();

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

                    // If data is grouped by state (object with keys)
                    if (
                        !Array.isArray(data) &&
                        typeof data === "object" &&
                        data !== null
                    ) {
                        $("#contact_edit_logo_loader").hide();

                        $("#contactsAccordion").html(`
                           <div class="text-center text-muted" style="font-style: italic;">
                               No contacts available.
                           </div>
                         `);

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
                            $("#contact_edit_logo").attr(
                                "src",
                                `${baseImageUrl}/${lenderInfo.lender_logo.toLowerCase()}`
                            );

                            $("#contact_edit_logo").css("display", "block");

                            $("#edit_lender_contact_search").attr(
                                "data-lender-id",
                                lenderInfo.lender_id
                            );
                        }

                        let finalHtml = "";

                        // Contacts with no state are in the "" key
                        const flatContacts = data[""] || [];

                        // Remove the empty key from state keys to process accordions only for states with names
                        const stateNames = stateKeys.filter(
                            (k) => k.trim() !== ""
                        );
                        $("#contactsEditAccordion").show();

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
                                     <div class="edit-contact">
                                       <i class="fas fa-pencil lender-contact-detail-edit-btn" style="cursor: pointer;" data-main-lender-id="${
                                           contact.contact_id
                                       }" ></i> 
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
                                      <div class="edit-contact">
                                       <i class="fas fa-pencil lender-contact-detail-edit-btn" style="cursor: pointer;" data-main-lender-id="${
                                           contact.contact_id
                                       }" ></i> 
                                     </div>
                                   </div>
                                 `;
                            });

                            flatHtml += `</div>`;
                            finalHtml += flatHtml;
                        }

                        // $("#ContactModalloader").hide();
                        $("#contactsEditAccordion").html(finalHtml);
                        $("#ContactEditModalloader").hide();
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

    $(document).on("input", "#edit_lender_contact_search", function () {
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
                var contacts = response; // array of contacts
                var search_value = $("#edit_lender_contact_search")
                    .val()
                    .trim();

                var mainAccordion = $("#contactsEditAccordion");
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
                         <div class="edit-contact">
                                       <i class="fas fa-pencil lender-contact-detail-edit-btn" style="cursor: pointer;" data-main-lender-id="${
                                           contact.contact_id
                                       }" ></i> 
                                     </div>
                    </div>
                `;
                            $("#searchResultsBody").append(contactHtml);
                        });
                    }
                } else {
                    // If no search value, show original state-wise accordion content (restore logic here)
                    renderStateWiseAccordion(contacts); // You can implement this function for default view
                }

                $("#ContactEditModalloader").hide();
            },

            error: function (xhr, status, error) {
                console.error("Error fetching lender contacts:", error);
                $("#loader").hide();
            },
        });
    });

    $(document).on("click", ".lender-contact-detail-edit-btn", function (e) {
        e.preventDefault();

        const dataId = $(this).attr("data-main-lender-id");
        console.log("Product Type IDs:", dataId);
        const modalElement = document.getElementById(
            "Lender_Contact_Detail_Edit_Modal"
        );

        const detailModal = new bootstrap.Modal(modalElement, {
            backdrop: false,
            keyboard: true,
        });

        detailModal.show();
        getLenderContactsDetailData(dataId);
    });

    function getLenderContactsDetailData(dataId) {
        $.ajax({
            type: "GET",
            url: "/search-contact-details",
            data: { contact_id: dataId },
            beforeSend: function () {},
            success: function (response) {
                console.log(response);
                const lender = response[0];

                $("#name").val(lender.name);
                $("#contact_id").val(lender.id);
                $("#state").val(lender.state);
                $("#email").val(lender.email);
                $("#title").val(lender.title);
                $("#contact_mobile_number").val(lender.mobile_number);
            },

            error: function (xhr, status, error) {
                console.error("Error fetching lender contacts:", error);
            },
        });
    }

    $(document).on("click", ".lender-contact-details-submit-btn", function (e) {
        e.preventDefault();

        let isValid = true;

        // Fields to validate explicitly
        const fieldsToValidate = [
            "name",
            "email",
            "contact_mobile_number", // this is the mobile number field
            "title", // Not mandatory but should be validated if it contains any value
            "state", // Not mandatory but should be validated if it contains any value
        ];

        // Validate mandatory fields
        const mandatoryFields = ["name", "email", "contact_mobile_number"];
        mandatoryFields.forEach((field) => {
            if (!validateLenderContactField(field)) {
                isValid = false;
            }
        });

        // Validate optional fields (only if they contain any value)
        fieldsToValidate.forEach((field) => {
            if (
                $("#" + field)
                    .val()
                    .trim() !== ""
            ) {
                if (!validateLenderContactField(field)) {
                    isValid = false;
                }
            }
        });

        // Proceed if all validations are successful
        if (isValid) {
            const form = $("#lender_contact_detail_edit_form")[0];
            const formData = new FormData(form);

            $.ajax({
                url: $(form).attr("action"),
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "success",
                        title: "Lender contact details updated successfully!",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener(
                                "mouseenter",
                                Swal.stopTimer
                            );
                            toast.addEventListener(
                                "mouseleave",
                                Swal.resumeTimer
                            );
                        },
                    });
                    $("#Main_Lender_Edit_Modal").modal("hide");
                    $("#Lender_Contact_Edit_Modal").modal("hide");
                    $("#Lender_Contact_Detail_Edit_Modal").modal("hide");
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

                        // Show inline errors
                        $.each(errors, function (key, messages) {
                            $(`#invalid_${key}`)
                                .removeClass("d-none")
                                .text(messages[0]);
                        });

                        // $("#Lender_Contact_Details_Modal").modal("show");
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                        });
                    }
                },
            });
        }
    });

    // Function to validate a field
    function validateLenderContactField(field) {
        let isValid = true;
        const value = $("#" + field)
            .val()
            .trim();

        // Check for mandatory fields
        if (field === "name" && value === "") {
            $("#invalid_name")
                .removeClass("d-none")
                .text("Please enter valid name.");
            isValid = false;
        } else if (field === "email" && !validateEmail(value)) {
            $("#invalid_email")
                .removeClass("d-none")
                .text("Please enter valid email.");
            isValid = false;
        } else if (
            field === "contact_mobile_number" &&
            value !== "" &&
            !validateMobileNumber(value)
        ) {
            // Only validate if the value is not empty
            $("#invalid_contact_mobile_number")
                .removeClass("d-none")
                .text("Please enter valid mobile number.");
            isValid = false;
        }

        // Optional validation for other fields
        if (field === "title" && value !== "" && value.length < 3) {
            $("#invalid_title")
                .removeClass("d-none")
                .text("Title must have at least 3 characters.");
            isValid = false;
        } else if (field === "state" && value !== "" && value.length < 3) {
            $("#invalid_state")
                .removeClass("d-none")
                .text("State must have at least 3 characters.");
            isValid = false;
        }

        // If no errors found, hide the error message
        if (isValid) {
            $("#invalid_" + field).addClass("d-none");
        }

        return isValid;
    }

    // Function to validate email format
    function validateEmail(email) {
        const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return regex.test(email);
    }

    // Function to validate mobile number format
    function validateMobileNumber(mobileNumber) {
        const regex = /^\+?[0-9\s\-()]{5,20}$/;
        return regex.test(mobileNumber);
    }
});
