@extends('layouts.app')

@section('title', 'matrix Loan Matching')

@section('content')
<!-- Main content starts here -->
<div class="row gx-4">
    <!-- Left Panel -->
    <div class="col-lg-2 mb-4"></div>
    <div class="col-lg-8 mb-4">
        <div class="panel ai-loan-matching shadow-sm" style="border-radius:20px;margin-top: 20px;">

            <div class="multi-step-form " style="margin: 0; padding:0;box-shadow: 5px 5px 5px 2px #878787; ">
                <div class="header" style="height:62px">
                    <h5 style="border-bottom: none;color:white">Form To Edit Lender Data</h5>
                </div>
                <form method="POST" action="{{ url('/save_data') }}" id="lender_form" class="car-bike-boat-form p-4">
                    @csrf
                    <div class="col-12 step active" data-step="1">
                        <div class="row">
                            <h5 class="text-center section-title">Lender Details</h5>
                            <hr>

                            <div class="col-md-6 mb-3">
                                <label for="lender_name" class="form-label">Lender Name</label>
                                <div class="input-group">
                                    <input type="text" id="lender_name" name="lender_name" class="form-control" value="{{ $lender_data[0]['lender_name'] }}" autocomplete="off" />
                                </div>
                                <p class="text-danger d-none" id="invalid_lender_name">Please enter valid Name.</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="lender_website" class="form-label">Lender Website</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                    <input type="text" id="lender_website" name="lender_website" class="form-control" value="{{ $lender_data[0]['website_url'] }}" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_lender_website">Please enter valid ur.</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="lender_email" class="form-label">Lender Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="text" id="lender_email" name="lender_email" class="form-control" value="{{ $lender_data[0]['email'] }}" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_lender_email">Please enter valid email.</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="lender_mobile_number" class="form-label">Lender Mobile Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-mobile"></i></span>
                                    <input type="text" id="lender_mobile_number" name="lender_mobile_number" class="form-control" value="{{ $lender_data[0]['mobile_number'] }}" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_lender_mobile_number">Please enter valid Mobile Number.</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="lender_logo" class="form-label">Lender Logo</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-image"></i></span>
                                    <input type="file" id="lender_logo" name="lender_logo" class="form-control" required>
                                </div>
                                <p class="text-danger d-none" id="invalid_lender_lender_logo">Please upload valid image.</p>
                                <br>
                                <div style="border: 1px solid  #c4b86c;width: 24%;padding: 10px;">

                                    <img src="{{ url('assets/images/' . $lender_data[0]['lender_logo']) }}" style="width:100px;height:45px" alt="">
                                </div>
                                <small class="text-bold" style="color: #6858aa;font-weight: 500px;"> &nbsp; &nbsp; Existing logo</small>
                            </div>

                            <div class=" col-md-6 mb-3">
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
                                    <input type="file" id="product_guide_file" name="product_guide_file" class="form-control" required>
                                </div>

                                <div id="urlInputGroup" class="input-group mt-2" style="display:none;">
                                    <span class="input-group-text"><i class="fas fa-link"></i></span>
                                    <input type="url" id="product_guide_url" name="product_guide_url" class="form-control" placeholder="Enter URL">
                                </div>

                                <p class="text-danger d-none" id="invalid_product_guide">Please upload a valid file or enter a valid URL.</p>
                            </div>


                            <!-- <div class="col-md-6 mb-3 loan-details">
                                <label for="property_owner" class="form-label">Are you a property owner? </label>
                                <select id="property_owner" name="property_owner" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                                <p class="text-danger d-none" id="invalid_property_owner">Please select valid option.</p>
                            </div> -->
                        </div>
                        <!-- <p>To edit the product details , please click on the edit button below.</p> -->
                    </div>

                    <div class="col-12 step active" data-step="2">
                        <div class="row">

                        </div>
                    </div>
                    <div class="loan-navigation d-flex justify-content-between align-items-center mt-4 p-4">
                        <div class="loan-info d-flex gap-2"></div>
                        <button type="submit" class="btn btn-submit btn-next-global">
                            <span id="next-btn">Submit</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-2 mb-4"></div>
</div>

<!-- Internal CSS -->



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



<!-- Odometer JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/odometer.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

<!-- <script src="{{ asset('assets/js/index.js') }}"></script> -->
<script src="{{ url('assets/js/lender_edit.js') }}"></script>
<!-- Main content ends here -->
@endsection