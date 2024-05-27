<?php include "include/header.php";?>
<div id="slideshow" class="carousel slide">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#slideshow" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="/img/sasuke.jpg" class="d-block w-100" alt="...">
            <div class="overlay"></div>
            <div class="carousel-caption">
                <h1>MULTIPLE FORMATS</h1>
                <p>DST, EXP, HUS, JEF, PES, VP3, XXX</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="/img/tanjiro.jpg" class="d-block w-100" alt="...">
            <div class="overlay"></div>
            <div class="carousel-caption">
                <h1>CUSTOM DIGITIZING</h1>
                <p>Just starting out and having troubles with digitizing? We got you!</p>
                <a href="cdigitizing.php">
                    <button class="cdbtn"><h5>Contact Us</h5></button>
                </a>
            </div>
        </div>
        <div class="carousel-item">
            <img src="/img/yes.png" class="d-block w-100" alt="...">
            <div class="overlay"></div>
            <div class="carousel-caption">
                <h1>Instant Download</h1>
                <a href="catalog">
                    <button class="cdbtn"><h5>Shop</h5></button>
                </a>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#slideshow" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#slideshow" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<div class="container py-5">
    <div class="py-5">
        <h1><strong>Featured Designs</strong></h1>
        </div>
        <div class="row">
            <?php
                $products = ProductShowcaseIndex::getAllProducts($db);
                foreach ($products as $product) {
                    $product->renderProductShowcaseIndex();
                }
            ?>
        </div>
    </div>
    <div class="container pb-2">
        <div class="row justify-content-center">
            <div class="col-auto">
                <a href="catalog">
                    <button class="viewbtn"><h5>View All</h5></button>
                </a>
            </div>
        </div>
    </div>
    <hr>
    <div class="container">
        <div class="row justify-content-center text-center py-5">
            <h1>
                <strong>OtaruWear Embroidery</strong>
            </h1>
            <p class="pt-3">
            Affordable anime designs from our instagram page! We decided to help out the small business owners that <br>
            are starting in this industry to get our designs for the best prices on the market!
            </p>
            <div class="col-auto">
                <a href="catalog">
                    <button class="viewbtn"><h5>SHOP NOW</h5></button>
                </a>
            </div>
        </div>
    </div>
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="indimg" style="position: relative; overflow: hidden;">
                    <div style="padding-top: 82.86%; /* 525/630 aspect ratio */">
                        <img src="/img/22.jpg" alt="" class="img-fluid" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="ps-5 pt-5">
                    <h1><strong>Unique Designs</strong></h1>
                    <br>
                    <p>All of our designs are original and created by us which <br>
                    means you will only find them on our page!</p>
                    <p>What separates us from others? We actually own an <br> embroidery machine and embroider all of our designs!</p>
                    <p>Every design on our page was tested and embroidered to <br> ensure the best quality for our customers.</p>
                    <h5><strong>New designs every week!</strong></h5>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "include/footer.php";?>