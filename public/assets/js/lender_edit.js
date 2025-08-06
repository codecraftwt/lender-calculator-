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

    console.log(main_lender_id);

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
            console.log(data);

            setTimeout(function () {
                const $container = $("#MainLenderloanProductsContainer");
                // $container.empty();

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
                    $("#mobile_number").val(lender.mobile_number);
                    $("#main_lender_logo").attr("src", final_url);
                }
                data.forEach(function (lender) {
                    const productTypeIds = JSON.stringify(
                        lender.subproduct_ids
                    );

                    const cardHtml = `
                                                   <div class="col-6 col-md-6 mb-4 d-flex justify-content-center view-product-btn" 
                            data-product-type-id='${productTypeIds}'>
                         <div class="lender-box-container position-relative">
                       
                           <!-- Original Card Content -->
                           <div class="lender-box d-flex flex-column align-items-center justify-content-center p-3"
                                data-lender-sub-product-id="${
                                    lender.product_id
                                }"
                                                       id="lenderCard${
                                                           lender.product_id
                                                       }">
                                                       
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

function resetMainLenderModalInfo() {
    $("#main_lender_modal_logo").show();

    $("#lender_name").val("");
    $("#lender_website").val("");
    $("#lender_email").val("");
    $("#mobile_number").val("");
    $("#main_lender_logo").attr("src", "");
}
