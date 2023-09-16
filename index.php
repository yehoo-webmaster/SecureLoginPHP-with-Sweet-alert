<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Landing Page</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        
        body {
        background-image: url('./images/real.jpg'); /* Replace 'background.jpg' with your image file path */
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed; /* Keeps the background image fixed while scrolling */
    }
        .carousel-inner img {
            display: block;
            margin: 0 auto;
            max-width: 980vh; /* Adjust the width as needed */
            height: auto; /* Maintain aspect ratio */
            max-height: 80vh; /* Adjust the height as needed, using viewport height (vh) */
        }
/* Define the shake animation */
@keyframes shake {
    0%, 60% {
        transform: translateX(10);
    }
    10%, 50%, 70%, 90% {
        transform: translateX(-3px);
    }
    20%, 60%, 80%, 85% {
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

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">
        <i class="fas fa-hand-point-right text-danger shake mr-2"></i> <!-- Green finger icon -->
            Microfinance Company
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="registration.php">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Carousel (Image Slider) -->
<div id="imageSlider" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#imageSlider" data-slide-to="0" class="active"></li>
        <li data-target="#imageSlider" data-slide-to="1"></li>
        <li data-target="#imageSlider" data-slide-to="2"></li>
    </ol>
  
    <!-- Slides -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="./images/finance.webp" alt="Image 1">
            <div class="carousel-caption">
                <h3>Welcome to Microfinance Company</h3>
                <p>Your financial partner.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="./images/money.jpg" alt="Image 2">
            <div class="carousel-caption">
                <h3>Secure and Convenient Services</h3>
                <p>Join us for a better future.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="./images/rupiah.webp" alt="Image 3">
            <div class="carousel-caption">
                <h3>Start Your Journey with Us</h3>
                <p>Experience financial growth.</p>
            </div>
        </div>
    </div>
  
    <!-- Controls -->
    <a class="carousel-control-prev" href="#imageSlider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#imageSlider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- Footer section with text -->
<footer class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <p>&copy; 2023 Microfinance Company. All Rights Reserved.</p>
                <p>Main Programmer: YehoshaphatJ</p>
            </div>
        </div>
    </div>
</footer>



<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
