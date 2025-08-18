$(document).ready(function () {
    function getCustomerData() {
        $.ajax({
            url: "/get-users",
            method: "GET",
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
                                        <label class="switch">
                                           <input type="checkbox" class="status-toggle"
                                             data-id="${item.id}"
                                             ${
                                                 item.deleted_flag == 0
                                                     ? "checked"
                                                     : ""
                                             }>
                                           <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <button
                                             type="button"
                                             data-id=' ${item.id}'
                                             class="btn btn-sm me-1 user-edit-btn"
                                             style="color:white; background-color: rgb(86 66 161) !important;">
                                             <i class="fas fa-pencil"></i>
                                        </button>
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

                getCustomerDatas(); // refresh UI if needed
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
            type: "GET",
            url: "/get-user-data",
            data: {
                user_id: user_id,
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

        const user_id = $("#user_id").val().trim();
        const name = $("#name").val().trim();
        const email = $("#email").val().trim();
        const role = $("#role").val();

        let isValid = true;

        // Clear old errors
        $(".text-danger").addClass("d-none");

        // Name validation
        if (name === "") {
            $("#invalid_name")
                .removeClass("d-none")
                .text("Please enter valid name.");
            isValid = false;
        }

        // Email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === "" || !emailRegex.test(email)) {
            $("#invalid_email")
                .removeClass("d-none")
                .text("Please enter valid email.");
            isValid = false;
        }

        // Role validation
        if (role === "") {
            $("#invalid_role")
                .removeClass("d-none")
                .text("Please select valid option.");
            isValid = false;
        }

        if (!isValid) return; // stop submission if invalid

        // Prepare form data
        const form = $("#user_detail_edit_form")[0];
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
                $("#User_Edit_Modal").modal("hide");

                getCustomerData();
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
