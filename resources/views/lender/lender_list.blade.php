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
<!-- Main content starts here -->
<div class="row px-0">
    <div style="background: linear-gradient(90deg, #4a3f9a 0%, #d15de8 100%); border-top-left-radius: 15px;border-top-right-radius: 15px;height:76px" class="header">
        <h5 style="color: white; margin: 0; padding: 1rem;font-size:25px;font-weight:600;">Lender List</h5>
    </div>
    <div class="panel ai-loan-matching  shadow-sm" style="padding: 0; margin: 0;overflow-x: auto; width: 100%;">

        <!-- Left Panel -->
        <div class="col-lg-12 mb-4 ">


            <!-- <hr> -->
            <table id="lenderTable" class="table table-striped p-1">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Lender Name</th>
                        <th>Lender Logo</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Website</th>
                        <th>Products</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <!-- </div> -->
    </div>
    <!-- Lender Modal (Main List) -->
    <!-- Lender Modal (Background) -->
    <div class="modal fade" id="lenderModal" tabindex="-1" aria-labelledby="lenderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered"
            style="width: 97%; max-width: 1600px; z-index: 1050;">
            <div class="modal-content" style="min-height: 90vh;">

                <div class="modal-header">
                    <h5 class="modal-title" id="lenderModalLabel">Lender Products</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="panel ebroker-lender-panel p-4 rounded-3 shadow-sm">
                        <div class="lender-cards row g-3" id="applicableLenderCards">
                            <div id="loader" class="text-center my-4" style="display: none;">
                                <img src="{{ asset('assets/images/loader.gif') }}" alt="Loading...">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">

                    <button type="button" class="btn text-white" data-bs-dismiss="modal" style="background: linear-gradient(90deg, #4a3f9a 0%, #d15de8 100%);">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Lender Detail Modal (Overlay) -->
    <div id="lenderDetailModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered"
            style="width: 90%; max-width: 1500px; z-index: 1060;">
            <div class="modal-content" style="min-height: 80vh !important; margin-top: 2vh !important;padding:25px;max-height: 85vh;box-shadow: 0 0 15px rgba(133, 42, 163, 0.9);">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center position-relative" style="height: 80px; width: 80px;">
                        <!-- Loader (shown initially) -->
                        <span id="logoLoader" class="" role="status" style="width: 2rem; height: 2rem;">
                            <i class="fas fa-spinner fa-spin" style="font-size: 24px;"></i>
                        </span>

                        <!-- Lender Logo (hidden initially) -->
                        <img id="modalLenderLogo" src="" alt="Lender Logo"
                            style="height: 80px; width: auto; display: none;" class="me-3" />
                    </div>

                    <div class="mb-4 ml-4">
                        <p>
                            <a id="modalurl" href="#" target="_blank" style="text-decoration: none; cursor: pointer;">
                                <i class="fas fa-globe" style="color: #852aa3; font-size: 20px;"></i>
                                <span id="modalwebsite" style="color: black;">
                                    <i class="fas fa-spinner fa-spin" style="font-size: 14px;"></i>
                                </span>
                            </a>
                        </p>
                        <p class="mb-1">
                            <i class="fas fa-mobile" style="color: #852aa3; font-size: 20px;"></i>
                            <span id="modalPhone">
                                <i class="fas fa-spinner fa-spin" style="font-size: 14px;"></i>
                            </span>
                        </p>
                        <p class="mb-0">
                            <i class="fas fa-envelope" style="color: #852aa3; font-size: 20px;"></i>
                            <span id="modalEmail">
                                <i class="fas fa-spinner fa-spin" style="font-size: 14px;"></i>
                            </span>
                        </p>

                    </div>
                </div>

                <hr>

                <!-- Sub-product list will be injected into this container -->
                <div id="loanProductsContainer" class="row g-4 mb-3" style="overflow-y: auto;padding-left: 15px;padding-right:15px"></div>

                <!-- View Contacts Button -->
                <button type="button" id="lendercontactbuton" class="text-white m-3 view-lender-contacts-btn"
                    style="background: linear-gradient(90deg, #4a3f9a 0%, #d15de8 100%); border-radius: 20px; border: none; width: 185px; height: 28px; font-weight: 600;">
                    View Lender Contacts
                </button>

                <!-- Footer -->
                <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-outline-secondary text-white m-1" data-bs-dismiss="modal"
                        style="background: linear-gradient(90deg, #4a3f9a 0%, #d15de8 100%);">
                        ← Back to Lenders
                    </button>
                </div>
            </div>
        </div>
    </div>



    <div id="lenderContactModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered"
            style="width: 85%; max-width: 1400px;; z-index: 1070;">
            <div class="modal-content" style="min-height: 70vh !important; margin-top: 4vh !important;padding:25px;max-height: 78vh;box-shadow: 0 0 15px rgba(133, 42, 163, 0.9);margin-left: 18px;">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center position-relative" style="height: 80px; width: 80px;">
                        <!-- Loader (shown initially) -->
                        <span id="logoLoader2" class="" role="status" style="width: 2rem; height: 2rem;">
                            <i class="fas fa-spinner fa-spin" style="font-size: 24px;"></i>
                        </span>
                        <!-- Lender Logo (hidden initially) -->
                        <img id="modalLenderLogo2" src="" alt="Lender Logo"
                            style="height: 80px; width: auto; display: none;" class="me-3" />
                    </div>
                    <div class="mb-4 ml-4">
                        <p>
                            <a id="contactmodalurl" href="#" target="_blank" style="text-decoration: none; cursor: pointer;">
                                <i class="fas fa-globe" style="color: #852aa3; font-size: 20px;"></i>
                                <span id="contactmodalwebsite" style="color: black;">
                                    <i class="fas fa-spinner fa-spin" style="font-size: 14px;"></i>
                                </span>
                            </a>
                        </p>
                        <p class="mb-1">
                            <i class="fas fa-mobile" style="color: #852aa3; font-size: 20px;"></i>
                            <span id="phone">
                                <i class="fas fa-spinner fa-spin" style="font-size: 14px;"></i>
                            </span>
                        </p>
                        <p class="mb-0">
                            <i class="fas fa-envelope" style="color: #852aa3; font-size: 20px;"></i>
                            <span id="email">
                                <i class="fas fa-spinner fa-spin" style="font-size: 14px;"></i>
                            </span>
                        </p>
                    </div>
                </div>

                <hr />

                <!-- Contacts Table -->
                <div style="overflow-x: auto;">
                    <h4 style="color:#852aa3;font-size:25px;font-weight: bold">
                        BDM Contacts
                    </h4>
                    <table id="lenderContactTable" class="contact-table">

                        <!-- Dynamic contact rows will be injected here -->
                    </table>
                </div>

                <!-- Footer -->
                <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-outline-secondary text-white m-1" data-bs-dismiss="modal"
                        style="background: linear-gradient(90deg, #4a3f9a 0%, #d15de8 100%);">
                        ← Back to Lenders
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- lender edit modals -->

    <div id="Main_Lender_Edit_Modal" class="modal fade" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" style="width: 100%; max-width: 1660px; z-index: 1060;">

            <div class="modal-content" style="min-height: 80vh !important; margin-top: 2vh !important;padding:20px;max-height: 100vh;box-shadow: 0 0 15px rgba(133, 42, 163, 0.9);">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>

                <!-- 📝 Form Start -->
                <form id="MainLenderEditForm" action="{{ url('/update-main-lender-data') }}" method="POST" enctype="multipart/form-data">
                    <!-- CSRF Token (if using Laravel Blade) -->
                    @csrf

                    <!-- Header -->
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3">
                            <span id="main_lender_modal_logo" class="" role="status" style="width: 2rem; height: 2rem;">
                                <img src="{{ asset('assets/images/obi-loader.gif') }}" alt="Loading..." style="height: 50px;">
                            </span>
                            <img id="main_lender_logo" src="" style="height: 50px;" alt="">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="lender_logo" class="form-label">Lender Logo</label>
                            <div class="input-group">
                                <input type="file" id="lender_logo" name="lender_logo" class="form-control" autocomplete="off" />
                            </div>
                            <p class="text-danger d-none" id="invalid_lender_logo">Please upload valid name.</p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="lender_name" class="form-label">Lender Name</label>
                            <div class="input-group">
                                <input type="text" id="lender_name" name="lender_name" class="form-control" required autocomplete="off" />
                            </div>
                            <p class="text-danger d-none" id="invalid_lender_name">Please enter valid name.</p>
                        </div>

                        <div class="col-md-4 mb-3 visually-hidden">
                            <label for="lender_id" class="form-label">Lender id</label>
                            <div class="input-group">
                                <input type="text" id="lender_id" name="lender_id" class="form-control" required autocomplete="off" />
                            </div>
                            <p class="text-danger d-none" id="invalid_lender_id">Please enter valid name.</p>
                        </div>
                        <!-- s -->

                        <div class="col-md-4 mb-3">
                            <label for="lender_website" class="form-label"> Website</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                <input type="text" id="lender_website" name="lender_website" required class="form-control" />
                            </div>
                            <p class="text-danger d-none" id="invalid_lender_website">Please enter valid URL.</p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="lender_email" class="form-label"> Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" id="lender_email" name="lender_email" required class="form-control" />
                            </div>
                            <p class="text-danger d-none" id="invalid_lender_email">Please enter valid email.</p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="lender_mobile_number" class="form-label">Mobile Number</label>
                            <div class="input-group">
                                <input type="text" id="mobile_number" name="mobile_number" required class="form-control" autocomplete="off" />
                            </div>
                            <p class="text-danger d-none" id="invalid_mobile_number">Please enter valid mobile number.</p>
                        </div>
                        <div class=" col-md-4 mb-3">
                            <label class="form-label">Lender Product Guide</label>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="product_guide_type" id="guideFile" value="file" checked>
                                <label class="form-check-label" for="guideFile">Upload File</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="product_guide_type" id="guideUrl" value="url">
                                <label class="form-check-label" for="guideUrl">Enter URL</label>
                            </div>

                            <div id="fileInputGroup" class="input-group mt-2">
                                <span class="input-group-text"><i class="fas fa-image"></i></span>
                                <input type="file" id="product_guide_file" name="product_guide_file" class="form-control">
                            </div>
                            <p class="text-danger d-none" id="invalid_product_guide_file">Please upload a valid file or enter a valid URL.</p>

                            <div id="urlInputGroup" class="input-group mt-2" style="display:none;">
                                <span class="input-group-text"><i class="fas fa-link"></i></span>
                                <input type="url" id="product_guide_url" name="product_guide_url" class="form-control" placeholder="Enter URL">
                            </div>

                            <p class="text-danger d-none" id="invalid_product_guide_url">Please upload a valid file or enter a valid URL.</p>
                        </div>
                        <!-- <div class="col-md-4 mb-3">
                            <label for="lender_mobile_number" class="form-label"> </label>
                            <button type="submit" class="btn btn-success m-5">
                                Save Changes
                            </button>
                        </div> -->
                        <div class="col-md-4 mb-3">
                            <label for="lender_mobile_number" class="form-label"> </label>
                            <button type="submit" class="btn btn-success m-5 main_lender_edit_submit_btn" style="background: linear-gradient(90deg, #4a3f9a 0%, #d15de8 100%);border:none">
                                Save Changes
                            </button>
                        </div>
                </form>

            </div>

            <hr>
            <h5 class="text-center">Products</h5>
            <hr>

            <!-- Loan Products Container -->
            <div id="MainLenderloanProductsContainer" class="row g-4 mb-3" style="padding-left: 15px; padding-right:15px">
                <!-- Loader -->
                <div id="MainLenderModalloader" class="text-center my-4" style="display: none;">
                    <img src="{{ asset('assets/images/obi-loader.gif') }}" alt="Loading..." style="height: 200px;">
                </div>
                <!-- Product cards will be appended here dynamically -->
            </div>

            <!-- Footer -->
            <div class="modal-footer mt-4">
                <button type="button" class="btn btn-outline-secondary text-white m-1" data-bs-dismiss="modal"
                    style="background: linear-gradient(90deg, #4a3f9a 0%, #d15de8 100%);">
                    ← Back to Lenders
                </button>

            </div>

            <!-- 📝 Form End -->

        </div>
    </div>

</div>
<div id="Product_Edit_Modal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" style="width: 91%; max-width: 1660px; z-index: 2000;">
        <div class="modal-content" style="min-height: 80vh !important; margin-top: 2vh !important;padding:20px;height: 95vh;box-shadow: 0 0 15px rgba(133, 42, 163, 0.9);">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>

            <!-- 📝 Form Start -->
            <form id="ProductEditForm" action="{{ url('/update-product-data') }}" method="POST" enctype="multipart/form-data">
                <!-- CSRF Token (if using Laravel Blade) -->
                @csrf

                <!-- Header -->
                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <span id="product_modal_lender_logo_spinner" class="" role="status" style="width: 2rem; height: 2rem;">
                            <img src="{{ asset('assets/images/obi-loader.gif') }}" alt="Loading..." style="height: 40px;">
                        </span>
                        <img id="product_modal_lender_logo" src="" style="height: 50px;" alt="">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <div class="input-group">
                            <input type="text" id="product_name" name="product_name" class="form-control" required autocomplete="off" />
                        </div>
                        <p class="text-danger d-none" id="invalid_product_name">Please enter valid name.</p>
                    </div>

                    <div class="col-md-4 mb-3 visually-hidden">
                        <label for="product_id" class="form-label">Product id</label>
                        <div class="input-group">
                            <input type="text" id="product_id" name="product_id" class="form-control" required autocomplete="off" />
                        </div>
                        <p class="text-danger d-none" id="invalid_product_id">Please enter valid id.</p>
                    </div>
                    <div class="col-md-4 mb-3">

                        <button type="submit" class="btn btn-success m-5 product_edit_submit_btn" style="background: linear-gradient(90deg, #4a3f9a 0%, #d15de8 100%);border:none">
                            Save Changes
                        </button>
                    </div>

                </div>
            </form>
            <hr>
            <h5 class="text-center">Sub Products</h5>
            <hr>

            <!-- Loan Products Container -->
            <div id="ProductEditModalContainer" class="row g-4 mb-3 justify-content-center " style="padding-left: 15px; padding-right:15px;overflow-y:auto;padding-bottom: 30px;">
                <!-- Loader -->
                <div id="ProductModalloader" class="text-center my-4" style="display: none;">
                    <img src="{{ asset('assets/images/obi-loader.gif') }}" alt="Loading..." style="height: 200px;">
                </div>
                <!-- Product cards will be appended here dynamically -->
            </div>

            <!-- Footer -->
            <div class="modal-footer mt-4">
                <button type="button" class="btn btn-outline-secondary text-white m-1" data-bs-dismiss="modal"
                    style="background: linear-gradient(90deg, #4a3f9a 0%, #d15de8 100%);">
                    ← Back
                </button>

            </div>

            <!-- 📝 Form End -->

        </div>
    </div>
</div>


<div id="Sub_Product_Edit_Modal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" style="width: 84%; max-width: 1560px; z-index: 2050;">
        <div class="modal-content" style="min-height: 80vh !important; margin-top: 3vh !important;padding:20px;max-height: 86vh;box-shadow: 0 0 15px rgba(133, 42, 163, 0.9);">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>

            <!-- 📝 Form Start -->
            <form id="SubProductEditForm" method="POST" action="{{ url('/update-sub-product-data') }}" enctype="multipart/form-data">
                <!-- CSRF Token (if using Laravel Blade) -->
                @csrf

                <!-- Header -->
                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <span id="sub_product_modal_lender_logo_spinner" class="" role="status" style="width: 2rem; height: 2rem;">
                            <img src="{{ asset('assets/images/obi-loader.gif') }}" alt="Loading..." style="height: 40px;">
                        </span>
                        <img id="sub_product_modal_lender_logo" src="" style="height: 50px;" alt="">
                    </div>


                    <div class="col-md-4 mb-3 visually-hidden">
                        <label for="sub_product_id" class="form-label">Sub Product id</label>
                        <div class="input-group">
                            <input type="text" id="sub_product_id" name="sub_product_id" class="form-control" autocomplete="off" />
                        </div>
                        <p class="text-danger d-none" id="invalid_sub_product_id">Please enter valid id.</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="sub_product_name" class="form-label">Sub Product Name</label>
                        <div class="input-group">
                            <input type="text" id="sub_product_name" name="sub_product_name" class="form-control" autocomplete="off" />
                        </div>
                        <p class="text-danger d-none" id="invalid_sub_product_name">Please enter valid name.</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="trading_time" class="form-label"> Min Trading Time (months)</label>
                        <div class="input-group">
                            <input type="text" id="trading_time" name="trading_time" class="form-control" autocomplete="off" />
                        </div>
                        <p class="text-danger d-none" id="invalid_trading_time">Please enter valid trading time</p>
                    </div>

                    <div class="col-md-4 mb-3 loan-details">
                        <label for="gst_registration" class="form-label">GST registration required ? </label>
                        <select id="gst_registration" name="gst_registration" class="form-control" required>
                            <option value="">Select</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                        <p class="text-danger d-none" id="invalid_gst_registration">Please select valid option.</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="gst_time" class="form-label">Time from GST registration (Months)</label>
                        <div class="input-group">
                            <input type="text" id="gst_time" name="gst_time" class="form-control" autocomplete="off" />
                        </div>
                        <p class="text-danger d-none" id="invalid_gst_time">Please enter valid gst time.</p>
                    </div>


                    <div class="col-md-4 mb-3">
                        <label for="min_loan_amount" class="form-label">Min Loan Amount</label>
                        <div class="input-group">
                            <input type="text" id="min_loan_amount" name="min_loan_amount" class="form-control" autocomplete="off" />
                        </div>
                        <p class="text-danger d-none" id="invalid_min_loan_amount">Please enter valid amount.</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="max_loan_amount" class="form-label">Max Loan Amount</label>
                        <div class="input-group">
                            <input type="text" id="max_loan_amount" name="max_loan_amount" class="form-control" autocomplete="off" />
                        </div>
                        <p class="text-danger d-none" id="invalid_max_loan_amount">Please enter valid amount.</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="annual_income" class="form-label">Annual Income</label>
                        <div class="input-group">
                            <input type="text" id="annual_income" name="annual_income" class="form-control" autocomplete="off" />
                        </div>
                        <p class="text-danger d-none" id="invalid_annual_income">Please enter valid annual income</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="credit_score" class="form-label">Credit Score</label>
                        <div class="input-group">
                            <input type="text" id="credit_score" name="credit_score" class="form-control" autocomplete="off" />
                        </div>
                        <p class="text-danger d-none" id="invalid_credit_score">Please enter valid credit score.</p>
                    </div>

                    <div class="col-md-4 mb-3 loan-details">
                        <label for="property_owner" class="form-label">Property Owner Required?</label>
                        <select id="property_owner" name="property_owner" class="form-control" required>
                            <option value="">Select</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                        <p class="text-danger d-none" id="invalid_property_owner">Please select a valid option.</p>
                    </div>


                    <div class="col-md-4 mb-3">
                        <label for="number_of_dishonours" class="form-label">Max No. of dishonours allowed</label>
                        <div class="input-group">
                            <input type="text" id="number_of_dishonours" name="number_of_dishonours" class="form-control" autocomplete="off" />
                        </div>
                        <p class="text-danger d-none" id="invalid_number_of_dishonours">Please enter valid number of dishonours.</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="negative_days" class="form-label">Max No. of negative days allowed</label>
                        <div class="input-group">
                            <input type="text" id="negative_days" name="negative_days" class="form-control" autocomplete="off" />
                        </div>
                        <p class="text-danger d-none" id="invalid_negative_days">Please enter valid negative days</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="interest_rate" class="form-label">Interest Rate</label>
                        <div class="input-group">
                            <input type="text" id="interest_rate" name="interest_rate" class="form-control" autocomplete="off" />
                        </div>
                        <p class="text-danger d-none" id="invalid_interest_rate">Please enter valid interest rate.</p>
                    </div>

                    <div class="col-md-4 mb-3 loan-details">
                        <label for="restricted_industry" class="form-label">
                            Restricted or excluded industries:
                        </label>
                        <select id="restricted_industry" name="restricted_industry[]" class="form-control select2" multiple required>

                            <option value=""></option>

                        </select>
                        <p class="text-danger d-none" id="invalid_restricted_industry">Please select at least one option.</p>
                    </div>


                    <div class="col-md-4 mb-3">

                        <button type="submit" class="btn btn-success m-5 sub_product_edit_submit_btn" style="background: linear-gradient(90deg, #4a3f9a 0%, #d15de8 100%);border:none">
                            Save Changes
                        </button>
                    </div>

                </div>
            </form>


            <!-- Loan Products Container -->
            <!-- <div id="SubProductEditModalContainer" class="row g-4 mb-3 justify-content-center " style="padding-left: 15px; padding-right:15px;overflow-y:auto;padding-bottom: 30px;">
                <div id="SubProductModalloader" class="text-center my-4" style="display: none;">
                    <img src="{{ asset('assets/images/obi-loader.gif') }}" alt="Loading..." style="height: 200px;">
                </div>
            </div> -->


            <div class="modal-footer mt-1">
                <button type="button" class="btn btn-outline-secondary text-white m-1" data-bs-dismiss="modal"
                    style="background: linear-gradient(90deg, #4a3f9a 0%, #d15de8 100%);">
                    ← Back
                </button>

            </div>

            <!-- 📝 Form End -->

        </div>
    </div>
</div>
@php
$baseImageUrl = "{{ url('assets/images') }}";
$base_product_guide_url = "{{ url('assets/product-guides') }}";
@endphp

<script>
    const baseImageUrl = "{{ url('assets/images') }}";
    const base_product_guide_url = "{{ url('assets/product_guide') }}";
</script>


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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toast').forEach(function(toastEl) {
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modals = ['#lenderModal', '#lenderDetailModal', '#lenderContactModal'];

        modals.forEach((modalId) => {
            const modalEl = document.querySelector(modalId);
            modalEl.addEventListener('show.bs.modal', function() {
                document.body.classList.add('modal-open');
            });
        });
    });
</script>


<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/odometer.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



<!-- Include jQuery (required for DataTables) and DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ url('assets/js/lender.js') }}"></script>
<script src="{{ url('assets/js/lender_edit.js') }}"></script>



<!-- JSZip for Excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>


<!-- Main content ends here -->
@endsection