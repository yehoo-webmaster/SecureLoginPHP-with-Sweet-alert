<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Landing Page</title>
        <!-- Include Bootstrap CSS && jquery && fontawesome -->
<script src="./js/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="./bootstrap_4.5.2/bootstrap.min.css">
<script src="./bootstrap_4.5.2/bootstrap.min.js"></script>
<link rel="stylesheet" href="./fontawesome-free-5.15.4-web/css/all.min.css">
        <style>

            body {
                margin: 0;
                padding: 0;
                box-sizing: border-box; /*  background-image: url('./images/real.jpg'); Replace 'background.jpg' with your image file path 
        background-size: cover;
      background-repeat:no-repeat;
      background-position: right top;
        background-attachment: fixed; */
               
            }
  .navbar {
    background: #569E7F;
    padding: 12px;
    box-shadow: inset 0 -3em 3em rgba(0, 0, 0, 0.1), 0 0 0 2px rgb(255, 255, 255), 0.3em 0.3em 1em rgba(0, 0, 0, 0.3);
}

            /* Apply this CSS in your <style> tag or an external CSS file */

            /* Set a fixed aspect ratio for the carousel items */

            /* Ensure images fill the entire carousel item */
            .carousel-item img {
                object-fit: cover;
                width: 100%;
                max-height: 450px;
                padding-top: 9%;
                /* Set a maximum height as needed */
            }
            .card-img-top{
                background: #569E7F;
                color: white;
            }
          
            /* Adjust padding and margins for smaller screens */
            @media (max-width: 576px) {
                .card {
                    margin-top: 0;
                }

                .form-group {
                    margin-bottom: 15px;
                }
            }
            /* Adjust padding and margins for smaller screens */
            @media (max-width: 480px) {
                .card {
                    margin-top: 0;
                }

                .form-group {
                    margin-bottom: 15px;
                }
                .carousel-item img{
                    width: 100%;
                    padding-top: 56.25%;
                    /* 16:9 aspect ratio (9 / 16 * 100%) */
                    position: relative;
                    overflow: hidden;
                    max-height: 400px;
                    /* Set a maximum height as needed */

                }
  
          
                .card {
                    height: 300px;
                    margin-top: 15px;
                    /* Adjust the height as needed */
                }

                .card-body {
                    overflow-y: auto;
                    /* Add a vertical scrollbar if content exceeds card height */
                }
            }

            /* Define the shake animation */
            @keyframes shake {
                0%,
                60% {
                    transform: translateX(10);
                }
                10%,
                50%,
                70%,
                90% {
                    transform: translateX(-3px);
                }
                20%,
                60%,
                80%,
                85% {
                    transform: translateX(5px);
                }
            }

            /* Apply the shake animation to the .shake class */
            .shake {
                animation: shake 0.5s;
                animation-iteration-count: infinite;
            }
        </style>
    </head>
    <body>

        <div class="container">

            <!-- Navigation Bar -->
            <nav class="navbar navbar-expand-lg navbar-dark fixed-top">

                <a class="navbar-brand" href="index.php">
                    <i class="fas fa-hand-point-right text-danger shake mr-2"></i>
                    <!-- Green finger icon -->
                    Microfinance Company
                </a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link text-white" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="registration.php">Register</a>
                        </li>
                    </ul>
                </div>

            </nav>
            <div class="row">
                <div class="col">

                    <!-- Carousel (Image Slider) -->
                    <div id="imageSlider" class="carousel slide sm-12" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#imageSlider" data-slide-to="0" class="active"></li>
                            <li data-target="#imageSlider" data-slide-to="1"></li>
                            <li data-target="#imageSlider" data-slide-to="2"></li>
                        </ol>

                        <!-- Slides -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="./images/5240.jpg" alt="Image 1">
                                <div class="carousel-caption">
                                    <h3>Welcome to Microfinance Company</h3>
                                    <p>Your financial partner.</p>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <img
                                    src="./images/Stack of money and gold coins 3d cartoon style icon.jpg"
                                    alt="Image 3">
                                <div class="carousel-caption">
                                    <h3>Start Your Journey with Us</h3>
                                    <p>Experience financial growth.</p>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <img
                                    src="./images/Startup managers presenting and analyzing sales growth chart.jpg"
                                    alt="Image 3">
                                <div class="carousel-caption">
                                    <h3>End Your Journey with Us</h3>
                                    <p>Experience financial growth.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Controls -->
                        <a
                            class="carousel-control-prev"
                            href="#imageSlider"
                            role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon bg-success" aria-hidden="true"></span>
                            <span class="sr-only bg-dark">Previous</span>
                        </a>
                        <a
                            class="carousel-control-next"
                            href="#imageSlider"
                            role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon bg-success" aria-hidden="true"></span>
                            <span class="sr-only bg-dark">Next</span>
                        </a>
                    </div>
                </div>
            </div>



            <!-- start Footer section with text -->
            <footer class="contrast-footer footer-light-secondary footer-shadow-dark p-5">
                            <!--center div-->
<div class="card-group">
<div class="card">
    <div class="card-body bg-light">
    <p class="card-text">Welcome to Microfinance Company, your trusted financial partner. At Microfinance Company, we understand the importance of financial stability and growth. We offer a wide range of services, including secure money storage and convenient loan facilities, just like other SACCOs.</p>
    <p class="card-text">Our commitment is to empower individuals and businesses by providing access to financial solutions that promote prosperity. Join us on your financial journey, and let's achieve your goals together.</p>    
     <img src="" class="card-img-top" alt="">
        </div>  
</div>

            <!--end center div-->
                <div class="card-group">
                    <div class="card">
                        <img src="" class="card-img-top" alt="...1">
                        <div class="card-body bg-dark text-white">
                            <h5 class="card-title">Contact Us</h5>
                            <ul class="contact-footer">
                                <li class="location">
                                    Head Office : ,
                                </li>
                                <li>
                                    P.O BOX , Dar es salaam
                                </li>
                                <li>
                                    Email: info@.co.tz
                                </li>
                                <li>
                                    Toll Free :
                                </li>
                                <li>
                                    Fax :
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <img src="" class="card-img-top" alt="...2">
                        <div class="card-body bg-dark text-white">
                            <h5 class="card-title">Sponsors</h5>
                            <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                            <p class="card-text">
                                <small class="text-danger">Last updated 3 mins ago</small>
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="" class="card-img-top" alt="...3">
                        <div class="card-body bg-dark text-white">
                            <h5 class="card-title">Other links</h5>
                            <p class="card-text">This is a wider card with supporting text below as a
                                natural lead-in to additional content. This card has even longer content than
                                the first to show that equal height action.</p>
                            <p class="card-text">
                                <small class="text-danger">Last updated 3 mins ago</small>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Include Bootstrap JS and jQuery -->
        <script src="./js/jquery-3.5.1.slim.min.js"></script>
        <script
            src="./js/popperjs_core@2.5.3_dist_umd_popper.min.js"></script>
        <script
            src="./bootstrap_4.5.2/js/bootstrap.min.js"></script>

    </body>
</html>
