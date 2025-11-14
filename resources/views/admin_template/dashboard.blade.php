@extends('admin_layouts.admin_template_sidebar')



@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Dashboard
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{ url('assets/template_assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Requested Loan Amount <i class="mdi mdi-chart-line mdi-24px float-end"></i>
                        </h4>
                        <h2 class="mb-5">$ 15,000,000</h2>
                        <h6 class="card-text">by total 52 clients</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{ url('assets/template_assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Available Lenders <i class="mdi mdi-bookmark-outline mdi-24px float-end"></i>
                        </h4>
                        <h2 class="mb-5">19</h2>
                        <!-- <h6 class="card-text">Decreased by 10%</h6> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{ url('assets/template_assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Active Users <i class="mdi mdi-diamond mdi-24px float-end"></i>
                        </h4>
                        <h2 class="mb-5">10</h2>
                        <!-- <h6 class="card-text">Increased by 5%</h6> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="clearfix">
                            <h4 class="card-title float-start">Clients Status Statistics</h4>
                            <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-end">
                                <ul>
                                    <li>
                                        <span style="background-color: rgba(218, 140, 255, 1)"></span> Submitted
                                    </li>
                                    <li>
                                        <span style="background-color: rgba(54, 215, 232, 1)"></span> In-progress
                                    </li>
                                    <li>
                                        <span style="background-color: rgba(255, 191, 150, 1)"></span> Converted
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <canvas id="visit-sale-chart" class="mt-4"></canvas>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Traffic Sources</h4>
                        <div class="doughnutjs-wrapper d-flex justify-content-center">
                            <canvas id="traffic-chart"></canvas>
                        </div>
                        <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Recently Added Clients</h4>
                        <div class="table-responsive">
                            <table class="table">
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
                                            <label class="badge badge-gradient-success">Converted</label>
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
                                            <label class="badge badge-gradient-danger">In-progress</label>
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
                                            <label class="badge badge-gradient-info">Choose Status</label>
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
                                            <label class="badge badge-gradient-warning">Submit</label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
        </div>
    </footer>
    <!-- partial -->
</div>

@endsection