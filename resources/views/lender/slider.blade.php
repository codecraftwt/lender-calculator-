    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Bootstrap 5 Carousel with Custom Cards</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
        <style>
            #multiItemCarousel {
                position: relative;
                max-width: 900px;
                margin: auto;
            }

            #multiItemCarousel .carousel-control-prev,
            #multiItemCarousel .carousel-control-next {
                width: 40px;
                height: 40px;
                top: 50%;
                transform: translateY(-50%);
                background-color: rgba(0, 0, 0, 0.3);
                border-radius: 50%;
            }

            #multiItemCarousel .carousel-control-prev {
                left: 10px;
            }

            #multiItemCarousel .carousel-control-next {
                right: 10px;
            }

            #multiItemCarousel .carousel-control-prev-icon,
            #multiItemCarousel .carousel-control-next-icon {
                filter: invert(1);
                width: 20px;
                height: 20px;
            }

            /* Your card styles (adjust if needed) */
            .sub-product-card {
                background-color: #ffffff;
                height: 124px;
                width: 100%;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
                border-radius: 20px;
                text-align: center;
                padding: 1rem;
                display: flex;
                align-items: center;
            }

            .sub-product-card .row {
                width: 100%;
                align-items: center;
                margin: 0;
            }

            .sub-product-card img {
                width: 73px;
                height: 35px;
                object-fit: contain;
            }

            .sub-product-card h5,
            .sub-product-card h6 {
                color: #852aa3;
                font-weight: 700;
                margin: 0 0 0.25rem 0;
            }

            .sub-product-card p {
                margin: 0;
                font-weight: 500;
            }

            .sub-product-card a {
                color: #852aa3;
                font-size: 15px;
                margin-top: 10px;
                font-weight: 500;
                display: inline-block;
                text-decoration: underline;
            }
        </style>
    </head>

    <body>

        <div id="multiItemCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="card sub-product-card border h-100">
                                <div class="row">
                                    <div class="col-md-2">
                                     </div>
                                    <div class="col-md-10 text-start ps-0">
                                        <h5 class="fw-bold">Product 1</h5>
                                        <h6 class="fw-bold">Sub-product A</h6>
                                        <p> $1000 - $5000 </p>
                                        <p>Minimum Score Required: 600+</p>
                                        <p style="font-weight:600;">APR: 5.25%</p>
                                        <small class="text-warning d-none" style="font-weight:600;">Security required for loan amounts over $2000 in this tier</small>
                                        <a href="#" target="_blank">View Product Guide <i class="fas fa-download"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card sub-product-card border h-100">
                                <div class="row">
                                    <div class="col-md-2">
                                     </div>
                                    <div class="col-md-10 text-start ps-0">
                                        <h5 class="fw-bold">Product 2</h5>
                                        <h6 class="fw-bold">Sub-product B</h6>
                                        <p> $1500 - $6000 </p>
                                        <p>Minimum Score Required: 620+</p>
                                        <p style="font-weight:600;">APR: 4.85%</p>
                                        <small class="text-warning d-none" style="font-weight:600;">Security required for loan amounts over $2500 in this tier</small>
                                        <a href="#" target="_blank">View Product Guide <i class="fas fa-download"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card sub-product-card border h-100">
                                <div class="row">
                                    <div class="col-md-2">
                                     </div>
                                    <div class="col-md-10 text-start ps-0">
                                        <h5 class="fw-bold">Product 3</h5>
                                        <h6 class="fw-bold">Sub-product C</h6>
                                        <p> $2000 - $7000 </p>
                                        <p>Minimum Score Required: 580+</p>
                                        <p style="font-weight:600;">APR: 6.00%</p>
                                        <small class="text-warning d-none" style="font-weight:600;">Security required for loan amounts over $3000 in this tier</small>
                                        <a href="#" target="_blank">View Product Guide <i class="fas fa-download"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="card sub-product-card border h-100">
                                <div class="row">
                                    <div class="col-md-2">
                                     </div>
                                    <div class="col-md-10 text-start ps-0">
                                        <h5 class="fw-bold">Product 4</h5>
                                        <h6 class="fw-bold">Sub-product D</h6>
                                        <p> $2500 - $8000 </p>
                                        <p>Minimum Score Required: 640+</p>
                                        <p style="font-weight:600;">APR: 4.50%</p>
                                        <small class="text-warning d-none" style="font-weight:600;">Security required for loan amounts over $3500 in this tier</small>
                                        <a href="#" target="_blank">View Product Guide <i class="fas fa-download"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card sub-product-card border h-100">
                                <div class="row">
                                    <div class="col-md-2">
                                     </div>
                                    <div class="col-md-10 text-start ps-0">
                                        <h5 class="fw-bold">Product 5</h5>
                                        <h6 class="fw-bold">Sub-product E</h6>
                                        <p> $3000 - $9000 </p>
                                        <p>Minimum Score Required: 610+</p>
                                        <p style="font-weight:600;">APR: 5.10%</p>
                                        <small class="text-warning d-none" style="font-weight:600;">Security required for loan amounts over $4000 in this tier</small>
                                        <a href="#" target="_blank">View Product Guide <i class="fas fa-download"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card sub-product-card border h-100">
                                <div class="row">
                                    <div class="col-md-2">
                                         
                                    </div>
                                    <div class="col-md-10 text-start ps-0">
                                        <h5 class="fw-bold">Product 6</h5>
                                        <h6 class="fw-bold">Sub-product F</h6>
                                        <p> $3500 - $10000 </p>
                                        <p>Minimum Score Required: 630+</p>
                                        <p style="font-weight:600;">APR: 4.75%</p>
                                        <small class="text-warning d-none" style="font-weight:600;">Security required for loan amounts over $4500 in this tier</small>
                                        <a href="#" target="_blank">View Product Guide <i class="fas fa-download"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Controls -->

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#multiItemCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class=" bg-danger">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#multiItemCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="bg-success">Next</span>
        </button>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- FontAwesome for download icon -->
 
    </body>

    </html>