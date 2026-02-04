$(document).ready(function () {
    function getCustomerData() {
        if (user_profile_picture) {
            profile_url =
                baseUserImageUrl + "/" + user_id + "/" + user_profile_picture;
        } else {
            profile_url = baseUserImageUrl + "/user_icon.webp";
        }

        $("#user_profile_picture").attr("src", profile_url);

        const status = $("#date_filter").val();
        const role = $("#role_filter").val();
        const action = $("#action_filter").val();
        $.ajax({
            url: "/get-activity-logs",
            method: "POST",
            data: {
                status: status,
                role: role,
                action: action,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                const tableBody = $("#activityLogTable tbody");
                $("#lenderTable").DataTable();
                // Destroy existing DataTable instance safely
                if ($.fn.DataTable.isDataTable("#activityLogTable")) {
                    $("#activityLogTable").DataTable().clear().destroy();
                }

                tableBody.empty();

                // Append your data rows
                if (data.length > 0) {
                    data.forEach((item, index) => {
                        const row = `
        <tr>

            <td>${item.admin_name || ""}</td>
            <td>${item.user_name || ""}</td>
            <td>${item.action || "--"}</td>
            <td>${item.description || "--"}</td>
            <td>${item.ip_address || "--"}</td>
            <td>${item.formatted_date || "--"}</td>
            
        </tr>`;
                        tableBody.append(row);
                    });
                }

                const table = $("#activityLogTable").DataTable({
                    searching: true,
                    ordering: false,
                    dom: "rtip",

                    autoWidth: false,
                    order: [[0, "desc"]],
                    columns: [
                        { width: "11%" },
                        { width: "15%" },
                        { width: "17%" },
                        { width: "19%" },
                        { width: "18%" },
                        { width: "12%" },
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

    $("#role_filter, #date_filter,#action_filter").on("change", function () {
        getCustomerData();
    });

    $("#clearfilter").on("click", function () {
        $("#date_filter").val("");
        $("#role_filter").val("");
        $("#action_filter").val("");
        getCustomerData();
    });
});
