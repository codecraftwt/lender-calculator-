@extends('layouts.app')

@section('title', 'matrix Loan Matching')

@section('content')
<style>
    .select2-container {
        z-index: 9999 !important;
    }

    .select2-dropdown {
        z-index: 9999 !important;
    }
</style>

<div class="row px-0">
    <div style="background: linear-gradient(90deg, #4a3f9a 0%, #d15de8 100%); border-top-left-radius: 15px;border-top-right-radius: 15px;height:76px" class="header">
        <h5 style="color: white; margin: 0; padding: 1rem;font-size:25px;font-weight:600;">User List</h5>
    </div>
    <div class="panel ai-loan-matching  shadow-sm" style="padding: 0; margin: 0;overflow-x: auto; width: 100%;">
        <div class="col-lg-12 mb-4 p-4 " style="background-color: #dedede;min-width:1500px;margin-left:auto;margin-right:auto">
            <div style="height:76px;" class="header d-flex align-items-center ml-4">
                <h3 class="m-2" style="color:rgb(48 30 119);font-weight:600">Activity Logs</h3>

                <div id="customSearchWrapper" style="max-width: 500px; width: 100%;"></div>
                <button id="filterToggleBtn" style="border: none; background-color: rgb(86 66 161); width: 100px; height: 41px; margin-left:auto" class="  rounded border-none text-white p-1">
                    <small style="color: white;">
                        <i class="fas fa-filter"></i> Filter</small>
                </button>
            </div>
            <table id="activityLogTable" class="table  p-1">
                <thead>


                    <tr id="filterRow" class="d-none ">


                        <th style="width: 300px !important;"><label for="">Select User</label>
                            <select name="" id="role_filter" name="role_filter" class=" form-control" style="border-radius: 0.375rem !important">
                                <option value="">Select</option>
                                @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach

                            </select>
                        </th>
                        <th style="width: 300px !important;"><label for="">Select Action</label>
                            <select name="" id="action_filter" name="action_filter" class=" form-control" style="border-radius: 0.375rem !important">
                                <option value="">Select</option>
                                @foreach($actions as $action)
                                <option value="{{$action}}">{{$action}}</option>
                                @endforeach

                            </select>
                        </th>
                        <th><label for="">Select Date</label>
                            <input type="date" id="date_filter" name="date_filter" class=" form-control" style="border-radius: 0.375rem !important">
                        </th>
                        <th> <button id="clearfilter" style="border: none; background-color: rgb(86 66 161); width: 95px; height: 36px; margin-left:20px;padding:2px" class="  rounded border-none text-white p-1">
                                <small style="color: white;">
                                    Clear Filter</small>
                            </button></th>

                        <th></th>
                        <th></th>


                    </tr>
                    <tr>

                        <th> Admin Name</th>
                        <th>User Name</th>
                        <th>Action</th>
                        <th>Description</th>
                        <th>IP Address</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div class="position-fixed  p-3" style="z-index: 2000;top:0px;right:0px">
        @if(session('success'))
        <div id="sessionToast_success" class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div id="sessionToast_error" class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('error') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        @endif
    </div>


    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/odometer.min.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Include jQuery (required for DataTables) and DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- <script src="{{ url('assets/js/user.js') }}"></script> -->


    <!-- JSZip for Excel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <!-- Main content ends here -->
    @endsection