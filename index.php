<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasun Spice Export Pvt(Ltd) </title>
    <link rel="icon" href="resources/logo/icon.svg" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/headers.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">

</head>

<body>

    <div class="col-12 bg-dark">
        <?php include "header.php";
        ?>
    </div>
    <!-- Introduction Section -->

    <section id="introduction">
        <div class="row">
            <div class="container mt-5">
                <div class="col text-center">
                    <h1>Kasun Spice Export Pvt(Ltd)</h1>
                    <p>Welcome to Kasun Spice Export Pvt(Ltd), your premier destination for the finest spices from Sri
                        Lanka. We are dedicated to providing high-quality spices that enhance the flavor and aroma of
                        your
                        culinary creations.</p>
                    <p>With a commitment to excellence, we ensure that our spices are sourced from the best farms and
                        processed with utmost care to retain their natural goodness. Join us on a journey of taste and
                        tradition, and experience the rich flavors of Sri Lanka.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Images Slider Section -->
    <section id="slider">
        <div class="">
            <div id="spicesCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="resources/images/spice1.jpg" class="d-block w-100" alt="spice1.jpg not found.">
                        <div class="carousel-caption d-none d-md-block">
                            <h1 class="fw-bold ">Kasun Spice Export Pvt(Ltd)</h1>
                            <h4>We specialize in exporting the finest spices from Sri Lanka.</h4>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="resources/images/spice2.jpg" class="d-block w-100" alt="spice2.jpg not found">
                    </div>
                    <div class="carousel-item">
                        <img src="resources/images/spice3.jpg" class="d-block w-100" alt="spice3.jpg not found">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#spicesCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#spicesCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>


    <!-- Company Introduction Section -->
    <section id="company-intro">
        <div class="container">
            <h2>About Our Company</h2>
                  
        </div>
    </section>

    <!-- Company Introduction with Image and Videos -->
    <section id="about-us" class="container mt-5">
        <div class="row">
            <!-- Company Image -->
            <div class="col-md-6">
                <div class="mb-4">
                    <img src="resources/images/company.jpg" class="img-fluid" alt="Company Image">
                </div>
            </div>
            <!-- Company Introduction and Video -->
            <div class="col-md-6">
                <h2>About Kasun Spice Export Pvt(Ltd)</h2>
                <p>Kasun Spice Export Pvt(Ltd) is a leading exporter of high-quality spices from Sri Lanka. With over 20
                    years of experience, we are committed to bringing the best spices to the global market. Our spices
                    are sourced from the finest farms and processed with the utmost care to preserve their natural
                    flavor and aroma.</p>
                <p>We take pride in our traditional methods of spice cultivation and processing, which have been passed
                    down through generations. Our mission is to share the rich flavors of Sri Lankan spices with the
                    world while maintaining the highest standards of quality and sustainability.</p>
                <div class="mt-4">
                    <h3>Watch Our Story</h3>
                    <video width="100%" controls>
                        <source src="resources/videos/company_video.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Section -->
    <section id="products">
        <div class="container">
            <h2 class="text-center">Our Products</h2>
            <div class="row" id="product-list">
                <!-- Products will be dynamically loaded here -->
            </div>
        </div>
    </section>
    

    <!-- Footer -->
    <?php include "footer.php"; ?>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>