@extends('admin_layouts.admin_template_sidebar')



@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="row px-0">
                <div
                    class="panel ai-loan-matching shadow-sm"
                    style="padding: 0; margin: 20px; overflow-x: auto; width: 100%">
                    <!-- Left Panel -->
                    <div
                        class="col-lg-12 mb-4 p-4"
                        style="margin-left: auto; margin-right: auto">
                        <div
                            style="height: 76px"
                            class="header d-flex align-items-center ml-4">
                            <h3 class="m-2" style="font-weight: 600">Clients</h3>
                            <a href="{{ url('/index') }}"><button
                                    type="button"
                                    class="btn btn-gradient-primary btn-fw">
                                    <i class="fa fa-plus"></i> Add New
                                </button></a>
                            <div
                                id="CustomercustomSearchWrapper"
                                style="max-width: 500px; width: 100%"></div>

                            <button
                                style="margin-left: auto"
                                type="button"
                                class="btn btn-gradient-primary btn-fw">
                                <i class="fa fa-filter"></i> Filter
                            </button>
                        </div>



                        <div class="table-responsive">
                            <table class="table" id="lenderTable">
                                <thead>
                                    <tr>
                                        <th> Date </th>
                                        <th> Client Name </th>
                                        <th> Business Name </th>
                                        <th> Loan Amount </th>
                                        <th> Status </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <!-- <td>
                                            <img src="{{ url('assets/template_assets/images/faces/face1.jpg') }}" class="me-2" alt="image"> David Grey
                                        </td> -->
                                        <td> Dec 12, 2017 </td>
                                        <td> Jo Ilievski </td>


                                        <td> ILIEVSKI, JOANNE LEE </td>

                                        <td> $20,000 </td>
                                        <td>
                                            <label style="width: 90px;" class="badge badge-gradient-success">Converted</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <!-- <td>
                                            <img src="{{ url('assets/template_assets/images/faces/face2.jpg') }}" class="me-2" alt="image"> Stella Johnson
                                        </td> -->
                                        <td> Dec 12, 2017 </td>
                                        <td> David Longmuir </td>



                                        <td> LONGMUIR, DAVID </td>
                                        <td> $75,000 </td>
                                        <td>
                                            <label style="width: 90px;" class="badge badge-gradient-danger">In-progress</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <!-- <td>
                                            <img src="{{ url('assets/template_assets/images/faces/face3.jpg') }}" class="me-2" alt="image"> Marina Michel
                                        </td> -->
                                        <td> Dec 12, 2017 </td>
                                        <td>Natalie Matthews </td>



                                        <td> ILIEVSKI, JOANNE LEE</td>
                                        <td> $100,000 </td>
                                        <td>
                                            <label style="width: 90px;" class="badge badge-gradient-info">Choose Status</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <!-- <td>
                                            <img src="{{ url('assets/template_assets/images/faces/face4.jpg') }}" class="me-2" alt="image"> John Doe
                                        </td> -->
                                        <td> Dec 12, 2017 </td>
                                        <td> Tracyanne Hurst </td>



                                        <td>MATTHEWS, NATALIE </td>
                                        <td> $50,000 </td>
                                        <td>
                                            <label style="width: 90px;" class="badge badge-gradient-warning">Submitted</label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- </div> -->
                </div>

                <div
                    class="modal fade"
                    id="lenderModal"
                    tabindex="-1"
                    aria-labelledby="lenderModalLabel"
                    aria-hidden="true">
                    <div
                        class="modal-dialog modal-dialog-scrollable modal-dialog-centered"
                        style="width: 97%; max-width: 1600px; z-index: 1050">
                        <div class="modal-content" style="min-height: 90vh">
                            <div class="modal-header">
                                <h5 class="modal-title" id="lenderModalLabel">
                                    Applicable Lenders
                                </h5>
                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div
                                    class="panel ebroker-lender-panel p-4 rounded-3 shadow-sm">
                                    <div
                                        class="lender-cards row g-3"
                                        id="applicableLenderCards"></div>
                                    <div
                                        id="MainModalloader"
                                        class="text-center my-4"
                                        style="display: none">
                                        <img
                                            src="{{ asset('assets/images/obi-loader.gif') }}"
                                            alt="Loading..."
                                            style="height: 200px" />
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button
                                    type="button"
                                    class="btn text-white"
                                    data-bs-dismiss="modal"
                                    style="
                            background: linear-gradient(
                              90deg,
                              #4a3f9a 0%,
                              #d15de8 100%
                            );
                          ">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    id="lenderDetailModal"
                    class="modal fade"
                    tabindex="-1"
                    aria-hidden="true">
                    <div
                        class="modal-dialog modal-dialog-scrollable modal-dialog-centered"
                        style="width: 97%; max-width: 1600px; z-index: 1060">
                        <div class="modal-content p-5" style="min-height: 90vh">
                            <button
                                type="button"
                                class="btn-close position-absolute top-0 end-0 m-1"
                                data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            <!-- Header -->
                            <div
                                class="d-flex justify-content-between align-items-start mb-3">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div
                                            class="col-md-4 d-flex justify-content-center align-items-center h-100">
                                            <div
                                                class="d-flex align-items-center position-relative"
                                                style="height: 80px; width: 80px">
                                                <!-- Loader (shown initially) -->
                                                <span
                                                    id="product_modal_lender_logo_spinner"
                                                    class=""
                                                    role="status"
                                                    style="width: 2rem; height: 2rem">
                                                    <img
                                                        src="{{ asset('assets/images/obi-loader.gif') }}"
                                                        alt="Loading..."
                                                        style="height: 50px" />
                                                </span>

                                                <!-- Lender Logo (hidden initially) -->
                                                <img
                                                    id="modalLenderLogo"
                                                    src=""
                                                    alt="Lender Logo"
                                                    style="
                                    height: 80px;
                                    width: auto;
                                    display: none;
                                  "
                                                    class="me-3" />
                                            </div>
                                        </div>
                                        <div
                                            class="col-md-4 d-flex justify-content-center align-items-center h-100">
                                            <div style="display: flex" class="mt-3">
                                                <p>
                                                    <a
                                                        id="modalurl"
                                                        href="#"
                                                        target="_blank"
                                                        style="
                                      text-decoration: none;
                                      cursor: pointer;
                                    ">
                                                        <i
                                                            class="fas fa-globe"
                                                            style="color: #852aa3; font-size: 20px"></i>
                                                        <span
                                                            id="modalwebsite"
                                                            style="color: black">
                                                            <i
                                                                class="fas fa-spinner fa-spin"
                                                                style="font-size: 14px"></i>
                                                        </span>
                                                    </a>
                                                </p>
                                                &nbsp; &nbsp; &nbsp;
                                                <p class="mb-1">
                                                    <i
                                                        class="fas fa-mobile"
                                                        style="color: #852aa3; font-size: 20px"></i>
                                                    <span id="modalPhone">
                                                        <i
                                                            class="fas fa-spinner fa-spin"
                                                            style="font-size: 14px"></i>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <div
                                            class="col-md-4 justify-content-center align-items-center h-100">
                                            <p class="mb-0" style="margin-left: 17px">
                                                <i
                                                    class="fas fa-envelope"
                                                    style="color: #852aa3; font-size: 20px"></i>
                                                <span id="modalEmail">
                                                    <i
                                                        class="fas fa-spinner fa-spin"
                                                        style="font-size: 14px"></i>
                                                </span>
                                            </p>

                                            <button
                                                type="button"
                                                id="lendercontactbuton"
                                                class="text-white m-3 view-lender-contacts-btn"
                                                style="
                                  background: linear-gradient(
                                    90deg,
                                    #4a3f9a 0%,
                                    #d15de8 100%
                                  );
                                  border-radius: 20px;
                                  border: none;
                                  width: 185px;
                                  height: 28px;
                                  font-weight: 600;
                                "
                                                data-lender-id="">
                                                View Lender Contacts
                                            </button>
                                        </div>

                                        <!-- <div class="mb-4">



                            </div> -->
                                    </div>
                                </div>
                            </div>

                            <hr />

                            <!-- Sub-product list will be injected into this container -->
                            <div
                                id="loanProductsContainer"
                                style="
                          overflow-y: auto;
                          padding-left: 15px;
                          padding-right: 15px;
                        "
                                class="row g-4 mb-3"></div>

                            <div
                                id="ProductModalloader"
                                class="text-center my-4"
                                style="display: none">
                                <img
                                    src="{{ asset('assets/images/obi-loader.gif') }}"
                                    alt="Loading..."
                                    style="height: 200px" />
                            </div>

                            <!-- View Contacts Button -->

                            <!-- Footer -->
                            <div class="modal-footer mt-4">
                                <button
                                    type="button"
                                    class="btn btn-outline-secondary text-white m-1"
                                    data-bs-dismiss="modal"
                                    style="
                            background: linear-gradient(
                              90deg,
                              #4a3f9a 0%,
                              #d15de8 100%
                            );
                          ">
                                    ← Back to Lenders
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    id="lenderContactModal"
                    class="modal fade"
                    tabindex="-1"
                    aria-hidden="true">
                    <div
                        class="modal-dialog modal-dialog-scrollable modal-dialog-centered"
                        style="width: 97%; max-width: 1600px; z-index: 1060">
                        <div class="modal-content p-5" style="min-height: 90vh">
                            <button
                                type="button"
                                class="btn-close position-absolute top-0 end-0 m-1"
                                data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            <!-- Header -->
                            <div
                                class="d-flex justify-content-between align-items-start mb-3">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div
                                            class="col-md-4 d-flex justify-content-center align-items-center h-100">
                                            <div
                                                class="d-flex align-items-center position-relative"
                                                style="height: 80px; width: 80px">
                                                <!-- Loader (shown initially) -->
                                                <span
                                                    id="logoLoader2"
                                                    class=""
                                                    role="status"
                                                    style="width: 2rem; height: 2rem">
                                                    <img
                                                        src="{{ asset('assets/images/obi-loader.gif') }}"
                                                        alt="Loading..." />
                                                </span>

                                                <!-- Lender Logo (hidden initially) -->
                                                <img
                                                    id="modalLenderLogo2"
                                                    src=""
                                                    alt="Lender Logo"
                                                    style="
                                    height: 80px;
                                    width: auto;
                                    display: none;
                                  "
                                                    class="me-3" />
                                            </div>
                                        </div>
                                        <div
                                            class="col-md-4 d-flex justify-content-center align-items-center h-100">
                                            <div style="display: flex" class="mt-5">
                                                <p>
                                                    <a
                                                        id="contactmodalurl"
                                                        href="#"
                                                        target="_blank"
                                                        style="
                                      text-decoration: none;
                                      cursor: pointer;
                                    ">
                                                        <i
                                                            class="fas fa-globe"
                                                            style="color: #852aa3; font-size: 20px"></i>
                                                        <span
                                                            id="contactmodalwebsite"
                                                            style="color: black">
                                                            <i
                                                                class="fas fa-spinner fa-spin"
                                                                style="font-size: 14px"></i>
                                                        </span>
                                                    </a>
                                                </p>
                                                &nbsp;&nbsp;
                                                <p class="mb-1">
                                                    <i
                                                        class="fas fa-mobile"
                                                        style="color: #852aa3; font-size: 20px"></i>
                                                    <span id="phone">
                                                        <i
                                                            class="fas fa-spinner fa-spin"
                                                            style="font-size: 14px"></i>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr />

                            <div
                                class="container mt-3"
                                id="contacts_container"
                                style="max-width: 600px; overflow-y: auto">
                                <div
                                    id="ContactModalloader"
                                    class="text-center my-4"
                                    style="display: none">
                                    <img
                                        src="{{ asset('assets/images/obi-loader.gif') }}"
                                        alt="Loading..."
                                        style="height: 200px" />
                                </div>
                                <div
                                    class="bg-purple p-2 text-white fw-bold d-flex justify-content-between align-items-center"
                                    style="background-color: #6a4b8c">
                                    <span>CONTACTS</span>
                                    <input
                                        type="search"
                                        class="form-control form-control-sm"
                                        name="search_contact"
                                        id="search_contact"
                                        style="width: 200px"
                                        placeholder="Search"
                                        data-lender-id="" />
                                    <div
                                        class="visually-hidden"
                                        id="loader"
                                        style="display: none">
                                        Loading...
                                    </div>
                                    <div class="visually-hidden" id="results"></div>
                                </div>

                                <div class="accordion mt-2" id="contactsAccordion">
                                    <!-- New South Wales -->
                                    <div class="accordion-item">
                                        <h2
                                            class="accordion-header"
                                            id="headingNSW"
                                            class="headingNSW"></h2>
                                        <div
                                            id="collapseNSW"
                                            class="accordion-collapse collapse collapseNSW"
                                            aria-labelledby="headingNSW"
                                            data-bs-parent="#contactsAccordion"></button>
                                        </div>

                                        <div
                                            class="accordion mt-2"
                                            id="contactsAccordion"></div>
                                    </div>
                                </div>
                                <div
                                    id="ContactdetailsModalloader"
                                    class="text-center my-4"
                                    style="display: none">
                                    <img
                                        src="{{ asset('assets/images/obi-loader.gif') }}"
                                        alt="Loading..."
                                        style="height: 200px" />
                                </div>

                                <!-- Footer -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Basic Table</h4>
                    <p class="card-description">
                      Add class <code>.table</code>
                    </p>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Profile</th>
                          <th>VatNo.</th>
                          <th>Created</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Jacob</td>
                          <td>53275531</td>
                          <td>12 May 2017</td>
                          <td>
                            <label class="badge badge-danger">Pending</label>
                          </td>
                        </tr>
                        <tr>
                          <td>Messsy</td>
                          <td>53275532</td>
                          <td>15 May 2017</td>
                          <td>
                            <label class="badge badge-warning"
                              >In progress</label
                            >
                          </td>
                        </tr>
                        <tr>
                          <td>John</td>
                          <td>53275533</td>
                          <td>14 May 2017</td>
                          <td><label class="badge badge-info">Fixed</label></td>
                        </tr>
                        <tr>
                          <td>Peter</td>
                          <td>53275534</td>
                          <td>16 May 2017</td>
                          <td>
                            <label class="badge badge-success">Completed</label>
                          </td>
                        </tr>
                        <tr>
                          <td>Dave</td>
                          <td>53275535</td>
                          <td>20 May 2017</td>
                          <td>
                            <label class="badge badge-warning"
                              >In progress</label
                            >
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div> -->
                <!-- <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Striped Table</h4>
                    <p class="card-description"> Add class <code>.table-striped</code>
                    </p>
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> User </th>
                          <th> First name </th>
                          <th> Progress </th>
                          <th> Amount </th>
                          <th> Deadline </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="py-1">
                            <img src="../../assets/images/faces-clipart/pic-1.png" alt="image" />
                          </td>
                          <td> Herman Beck </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td> $ 77.99 </td>
                          <td> May 15, 2015 </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="../../assets/images/faces-clipart/pic-2.png" alt="image" />
                          </td>
                          <td> Messsy Adam </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td> $245.30 </td>
                          <td> July 1, 2015 </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="../../assets/images/faces-clipart/pic-3.png" alt="image" />
                          </td>
                          <td> John Richards </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-warning" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td> $138.00 </td>
                          <td> Apr 12, 2015 </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="../../assets/images/faces-clipart/pic-4.png" alt="image" />
                          </td>
                          <td> Peter Meggik </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td> $ 77.99 </td>
                          <td> May 15, 2015 </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="../../assets/images/faces-clipart/pic-1.png" alt="image" />
                          </td>
                          <td> Edward </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-danger" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td> $ 160.25 </td>
                          <td> May 03, 2015 </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="../../assets/images/faces-clipart/pic-2.png" alt="image" />
                          </td>
                          <td> John Doe </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-info" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td> $ 123.21 </td>
                          <td> April 05, 2015 </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="../../assets/images/faces-clipart/pic-3.png" alt="image" />
                          </td>
                          <td> Henry Tom </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td> $ 150.00 </td>
                          <td> June 16, 2015 </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div> -->
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




        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.toast').forEach(function(toastEl) {
                    const toast = new bootstrap.Toast(toastEl);
                    toast.show();
                });
            });
        </script>


        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/odometer.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

        <!-- <script src="{{ asset('assets/js/index.js') }}"></script> -->
        <!-- <script src="{{ asset('assets/js/customer.js') }}"></script> -->
        <script src="{{ url('assets/js/customer.js') }}"></script>


        <!-- Include jQuery (required for DataTables) and DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


        <!-- JSZip for Excel -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
            <div
                class="d-sm-flex justify-content-center justify-content-sm-between">
                <span
                    class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023
                    <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
                <span
                    class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with
                    <i class="mdi mdi-heart text-danger"></i></span>
            </div>
        </footer>
        <!-- partial -->
    </div>

    @endsection