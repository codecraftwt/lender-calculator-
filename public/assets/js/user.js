$(document).ready(function () {
    function getCustomerData() {
        if (user_profile_picture) {
            profile_url =
                baseUserImageUrl + "/" + user_id + "/" + user_profile_picture;
        } else {
            profile_url = baseUserImageUrl + "/user_icon.webp";
        }

        $("#user_profile_picture").attr("src", profile_url);

        const status = $("#status_filter").val();
        const role = $("#role_filter").val();
        $.ajax({
            url: "/get-users",
            method: "POST",
            data: {
                status: status,
                role: role,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                const tableBody = $("#userTable tbody");
                $("#lenderTable").DataTable();
                // Destroy existing DataTable instance safely
                if ($.fn.DataTable.isDataTable("#userTable")) {
                    $("#userTable").DataTable().clear().destroy();
                }

                tableBody.empty();

                // Append your data rows
                if (data.length > 0) {
                    data.forEach((item, index) => {
                        const row = `
        <tr>

            <td>${item.name || ""}</td>
            <td>${item.email || ""}</td>
            <td>${item.role || "--"}</td>
            <td>
                ${
                    (item.deleted_flag == 0 && item.master_account == "No") ||
                    (item.deleted_flag == 1 && item.master_account == "No")
                        ? `<label class="switch">
                    <input type="checkbox" class="status-toggle" data-id="${
                        item.id
                    }"
                        ${
                            item.deleted_flag == 0 &&
                            item.master_account == "No"
                                ? "checked"
                                : ""
                        }>
                    <span class="slider round"></span>
                </label>`
                        : ""
                }

            </td>
            <td>

                ${
                    item.master_account === "No"
                        ? `<button
                    type="button"
                    data-id=' ${item.id}'
                    class="btn btn-sm me-1 user-edit-btn"
                    style="color:white; background-color: rgb(86 66 161) !important;">
                    <i class="fas fa-pencil"></i>
                </button>`
                        : ""
                }

            </td>

        </tr>`;
                        tableBody.append(row);
                    });
                }

                const table = $("#userTable").DataTable({
                    searching: true,
                    ordering: false,
                    dom: "rtip",

                    autoWidth: false,
                    order: [[0, "desc"]],
                    columns: [
                        { width: "17%" },
                        { width: "17%" },
                        { width: "25%" },
                        { width: "17%" },
                        { width: "16%" },
                    ],
                });

                const $customSearch = $(`
            <div class="search-input-wrapper position-relative d-inline-block">
                <i class="fa fa-search position-absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #777;"></i>
                <input type="search" id="customSearchInput"  class="form-control" style="padding-left: 45px; height: 36px; border-radius: 25px; border: 1px solid #ccc;">
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

    $(document).on("change", ".status-toggle", function () {
        const checkbox = $(this);
        const id = checkbox.data("id");

        // map: checked => 0 (active), unchecked => 1 (inactive)
        const newStatus = checkbox.is(":checked") ? 0 : 1;

        $.ajax({
            url: "/update-user-status",
            method: "POST",
            data: {
                id: id,
                deleted_flag: newStatus,
                _token: $('meta[name="csrf-token"]').attr("content"), // ✅ CSRF token
            },
            success: function (response) {
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    icon: "success",
                    title: response.message || "Status updated successfully!",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });

                getCustomerData(); // refresh UI if needed
            },
            error: function (xhr, status, error) {
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

                // revert checkbox state if request failed
                checkbox.prop("checked", !checkbox.is(":checked"));
            },
        });
    });

    $(document).on("click", ".user-edit-btn", function (e) {
        e.preventDefault();

        const user_id = $(this).attr("data-id");

        const modalElement = document.getElementById("User_Edit_Modal");
        const detailModal = new bootstrap.Modal(modalElement, {
            backdrop: false,
            keyboard: true,
        });

        detailModal.show();

        getUserData(user_id);
    });

    function getUserData(user_id) {
        $.ajax({
            type: "POST",
            url: "/get-user-data",
            data: {
                user_id: user_id,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                $("#name").val(response.name);
                $("#email").val(response.email);
                $("#role").val(response.role);
                $("#user_id").val(response.id);
            },
            error: function (xhr, status, error) {
                console.error(xhr, status, error);
            },
        });
    }

    $(document).on("click", ".user-details-submit-btn", function (e) {
        e.preventDefault();

        const submitBtn = $(this);

        const user_id = $("#user_id").val().trim();
        const name = $("#name").val().trim();
        const email = $("#email").val().trim();
        const role = $("#role").val();

        let isValid = true;

        $(".text-danger").addClass("d-none");

        if (name === "") {
            $("#invalid_name")
                .removeClass("d-none")
                .text("Please enter valid name.");
            isValid = false;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === "" || !emailRegex.test(email)) {
            $("#invalid_email")
                .removeClass("d-none")
                .text("Please enter valid email.");
            isValid = false;
        }

        if (role === "") {
            $("#invalid_role")
                .removeClass("d-none")
                .text("Please select valid option.");
            isValid = false;
        }

        if (!isValid) return;

        const form = $("#user_detail_edit_form")[0];
        const formData = new FormData(form);

        // 🔄 SHOW LOADER
        Swal.fire({
            title: "Updating user...",
            text: "Please wait while we save the changes.",
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading();
            },
        });

        submitBtn.prop("disabled", true);

        $.ajax({
            url: $(form).attr("action"),
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,

            success: function (response) {
                Swal.close(); // ❌ close loader

                Swal.fire({
                    toast: true,
                    position: "top-end",
                    icon: "success",
                    title:
                        response.message ||
                        "User details updated successfully!",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });

                $("#User_Edit_Modal").modal("hide");
                getCustomerData();
            },

            error: function (error) {
                Swal.close(); // ❌ close loader

                if (error.status === 422) {
                    const errors = error.responseJSON.errors;
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
                        text: "Something went wrong. Please try again.",
                    });
                }
            },

            complete: function () {
                submitBtn.prop("disabled", false); // 🔓 re-enable button
            },
        });
    });

    $("select").on("change", function () {
        getCustomerData();
    });

    $("#clearfilter").on("click", function () {
        $("#status_filter").val("");
        $("#role_filter").val("");
        getCustomerData();
    });

    $(document).on("click", ".open-profile-modal-btn", function () {
        const user_id = $(this).attr("data-user-id");
        const modalElement = document.getElementById("profile_modal");
        const detailModal = new bootstrap.Modal(modalElement, {
            backdrop: false,
            keyboard: true,
        });

        detailModal.show();
        getLoggedInUserData(user_id);
    });

    function getLoggedInUserData(user_id) {
        $.ajax({
            type: "POST",
            url: "/get-user-data",
            data: {
                user_id: user_id,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.user_image) {
                    final_url =
                        baseUserImageUrl +
                        "/" +
                        response.id +
                        "/" +
                        response.user_image;
                } else {
                    final_url = baseUserImageUrl + "/user_icon.webp";
                }

                $("#user_name").val(response.name);
                $("#user_email").val(response.email);
                $("#user_role").val(response.role);
                $("#logged_user_id").val(response.id);
                $("#profile_picture").attr("src", final_url);
            },
            error: function (xhr, status, error) {
                console.error(xhr, status, error);
            },
        });
    }

    // update user data

    $(document).on("click", ".user-details-edit-submit-btn", function (e) {
        e.preventDefault();
        e.stopPropagation();

        const user_id = $("#logged_user_id").val().trim();
        const name = $("#user_name").val().trim();
        const email = $("#user_email").val().trim();
        const role = $("#user_role").val();
        const profile_picture = $("#profile_picture").val();

        let isValid = true;

        // Clear old errors
        $(".text-danger").addClass("d-none");

        // Name validation
        if (name === "") {
            $("#invalid_user_name")
                .removeClass("d-none")
                .text("Please enter valid name.");
            isValid = false;
        }

        // Email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === "" || !emailRegex.test(email)) {
            $("#invalid_user_email")
                .removeClass("d-none")
                .text("Please enter valid email.");
            isValid = false;
        }

        // Role validation
        if (role === "") {
            $("#invalid_user_role")
                .removeClass("d-none")
                .text("Please select valid option.");
            isValid = false;
        }

        if (profile_picture !== "") {
            // Allowed file types for image
            const allowedTypes = [
                "image/jpeg",
                "image/png",
                "image/webp",
                "image/jpg",
            ];

            const file = document.getElementById("profile_picture").files[0]; // Get the file

            // Check if file is selected and if the file type is valid
            if (file && !allowedTypes.includes(file.type)) {
                $("#invalid_profile_image")
                    .removeClass("d-none")
                    .text(
                        "Please select a valid image (JPG, JPEG, PNG, WEBP).",
                    );
                isValid = false;
            }
        }

        if (!isValid) return; // stop submission if invalid

        // Prepare form data
        const form = $("#user_profile_edit_form")[0];
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
                    title:
                        response.message ||
                        "User Details updated successfully!",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });

                // Optional: close modal if inside modal
                $("#profile_modal").modal("hide");

                getCustomerData();
                // location.reload();
                // window.location.reload(true);
            },
            error: function (error) {
                if (error.status === 422) {
                    const errors = error.responseJSON.errors;
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

                    // Show individual errors
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

$(document).ready(function () {
    $("#filterToggleBtn").click(function () {
        $("#filterRow").toggleClass("d-none"); // toggles the class
    });
});

// function getUserDataToChangePassword(user_id) {
//     $.ajax({
//         type: "GET",
//         url: "/get-user-data",
//         data: {
//             user_id: user_id,
//         },
//         success: function (response) {
//             $("#change_password_user_email").val(response.email);
//             $("#change_password_user_id").val(response.id);
//         },
//         error: function (xhr, status, error) {
//             console.error(xhr, status, error);
//         },
//     });
// }

// $(document).on("click", ".request-otp-btn", function () {
//     const user_id = $("#change_password_user_id").val();
//     const user_mail = $("#change_password_user_email").val();

//     $.ajax({
//         type: "POST",
//         url: "/send-password-change-otp",
//         data: {
//             user_id: user_id,
//             user_mail: user_mail,
//         },
//         headers: {
//             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Get the CSRF token from the meta tag
//         },
//         success: function (response) {
//             $("#otp_text").toggleClass("d-none");
//             $("#otp_field").toggleClass("d-none");
//             $(".otp_btn").toggleClass("d-none");

//             Swal.fire({
//                 toast: true,
//                 position: "top-end",
//                 icon: "success",
//                 title: response.message || "OTP Sent Successfully",
//                 showConfirmButton: false,
//                 timer: 3000,
//                 timerProgressBar: true,
//             });

//             // $("#otp_text").addClass("d-block");
//         },
//         error: function (xhr, status, error) {
//             if (error.status === 422) {
//                 const errors = error.responseJSON.errors;
//                 const firstError = Object.values(errors)[0][0];
//                 Swal.fire({
//                     toast: true,
//                     position: "top-end",
//                     icon: "error",
//                     title: firstError || "Validation failed!",
//                     showConfirmButton: false,
//                     timer: 4000,
//                     timerProgressBar: true,
//                 });

//                 // Show individual errors
//                 $.each(errors, function (key, messages) {
//                     $(`#invalid_${key}`)
//                         .removeClass("d-none")
//                         .text(messages[0]);
//                 });
//             } else {
//                 Swal.fire({
//                     icon: "error",
//                     title: "Oops...",
//                     text: "Something went wrong!",
//                 });
//             }
//         },
//     });
// });
