<?php include('include/header.php') ?>
<!-- Slider -->
<section class="flat-slider home-1">
    <div class="container relative">
        <div class="row">
            <div class="col-lg-12">
                <div class="slider-content">
                    <div class="heading text-center">
                        <h1 class="title-large text-white animationtext slide" style="text-shadow: 3px 1px #000;">
                            Find Your
                            <span class="tf-text s1 cd-words-wrapper">
                                <span class="item-text is-visible">Dream Home</span>
                                <span class="item-text is-hidden">Perfect Home</span>
                            </span>
                        </h1>
                        <p class="subtitle text-white body-2 wow fadeInUp" data-wow-delay=".2s">We are a real estate agency that will help you find the best residence you dream of, let’s discuss for your dream house?</p>
                    </div>
                    <div class="flat-tab flat-tab-form">
                        <ul class="nav-tab-form style-1 justify-content-center" role="tablist">
                            <li class="nav-tab-item" role="presentation">
                                <a href="#forRent" class="nav-link-item active" data-bs-toggle="tab">For Rent</a>
                            </li>
                            <li class="nav-tab-item" role="presentation">
                                <a href="#forSale" class="nav-link-item" data-bs-toggle="tab">For Buy</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" role="tabpanel">
                                <div class="form-sl">
                                    <form method="post">
                                        <div class="wd-find-select">
                                            <div class="inner-group">
                                                <div class="form-group-1 search-form form-style">
                                                    <div class="group-select">
                                                        <div class="nice-select" tabindex="0"><span class="current pt-5">All Property Type</span>
                                                            <ul class="list">
                                                                <li data-value class="option selected">
                                                                    Apartment</li>
                                                                <li data-value="villa" class="option">Flat</li>
                                                                <li data-value="studio" class="option">House</li>
                                                                <li data-value="office" class="option">Villa</li>
                                                                <li data-value="office" class="option">Shop</li>
                                                                <li data-value="office" class="option">Office</li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="box-btn-advanced">

                                                <div class="form-group-1 search-form form-style">
                                                    <div class="group-select srch">
                                                        <input type="text" placeholder="Search Properties">
                                                    </div>

                                                </div>
                                                <button type="submit" class="tf-btn btn-search primary">Search <i class="icon icon-search"></i> </button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="overlay"></div>
</section>
<!-- End Slider -->
<!-- Recommended -->
<section class="flat-section flat-recommended">
    <div class="container">
        <div class="box-title text-center wow fadeInUp">
            <div class="text-subtitle text-primary">Featured Properties</div>
            <h3 class="mt-4 title">Recommended For You</h3>
        </div>

        <div class="flat-tab-recommended flat-animate-tab wow fadeInUp" data-wow-delay=".2s">
            <!-- Tabs -->
            <ul class="nav-tab-recommended justify-content-md-center" role="tablist">
                <li class="nav-tab-item" role="presentation">
                    <a href="#allData" class="nav-link-item active" data-bs-toggle="tab">View All</a>
                </li>
                <?php
                $subCat = mysqli_query($conn, "SELECT * FROM subcategory WHERE status > 0");
                while ($subData = mysqli_fetch_assoc($subCat)) {
                ?>
                    <li class="nav-tab-item" role="presentation">
                        <a href="#tab<?= $subData['id'] ?>" class="nav-link-item" data-bs-toggle="tab"><?= htmlspecialchars($subData['name']) ?></a>
                    </li>
                <?php } ?>
            </ul>

            <!-- Tab Contents -->
            <div class="tab-content">
                <!-- View All Tab -->
                <div class="tab-pane active fade show" id="allData" role="tabpanel">
                    <div class="row">
                        <?php
                        $allProps = mysqli_query($conn, "SELECT * FROM property WHERE status = 0 ORDER BY created_at DESC LIMIT 6");
                        while ($prop = mysqli_fetch_assoc($allProps)) {
                            $images = explode(',', $prop['images']);
                            $mainImage = !empty($images[0]) ? './admin/' . $images[0] : 'uploads/no-image.jpg';
                        ?>
                            <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="homelengo-box">
                                    <div class="archive-top">
                                        <a href="property-details.php?id=<?= $prop['id'] ?>" class="images-group">
                                            <div class="images-style">
                                                <img class="lazyload" data-src="<?= $mainImage ?>" src="<?= $mainImage ?>" alt="Property Image">
                                            </div>
                                            <div class="top">
                                                <ul class="d-flex gap-6">
                                                    <li class="flag-tag style-1"><?= ucfirst($prop['category']) ?></li>
                                                </ul>
                                            </div>
                                            <div class="bottom"><?= htmlspecialchars($prop['locality']) ?>, <?= htmlspecialchars($prop['city']) ?>, <?= htmlspecialchars($prop['state']) ?></div>
                                        </a>
                                    </div>
                                    <div class="archive-bottom">
                                        <div class="content-top">
                                            <h6 class="text-capitalize"><a href="property-details.php?id=<?= $prop['id'] ?>" class="link"><?= htmlspecialchars($prop['property_name']) ?></a></h6>
                                            <ul class="meta-list casa casa">
                                                <li class="item"><i class="icon icon-bed"></i><span class="text-variant-1">Beds:</span><span class="fw-6"><?= $prop['bedroom'] ?></span></li>
                                                <li class="item"><i class="icon icon-bath"></i><span class="text-variant-1">Baths:</span><span class="fw-6"><?= $prop['bathroom'] ?></span></li>
                                                <li class="item"><i class="icon icon-sqft"></i><span class="text-variant-1">Sqft:</span><span class="fw-6"><?= $prop['size'] ?></span></li>
                                            </ul>
                                        </div>
                                        <div class="content-bottom d-flex justify-content-between align-items-center">
                                            <a href="property-details.php?id=<?= $prop['id'] ?>" class="d-flex align-items-center gap-2">
                                                <div class="box-icon line w-44 round"><i class="icon icon-arrow-right2"></i></div>
                                                <b>More Details</b>
                                            </a>
                                            <h6 class="price">₹<?= number_format($prop['price']) ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="text-center mt-4">
                        <a href="property.php" class="tf-btn btn-view primary size-1 hover-btn-view">View All Properties <span class="icon icon-arrow-right2"></span></a>
                    </div>
                </div>

                <!-- Dynamic Subcategory Tabs -->
                <?php
                $subCat = mysqli_query($conn, "SELECT * FROM subcategory WHERE status > 0");
                while ($subData = mysqli_fetch_assoc($subCat)) {
                    $propQuery = mysqli_query($conn, "SELECT * FROM property WHERE subcategory = '{$subData['id']}' AND status = 0 ORDER BY created_at DESC LIMIT 6");
                ?>
                    <div class="tab-pane fade" id="tab<?= $subData['id'] ?>" role="tabpanel">
                        <div class="row">
                            <?php
                            if (mysqli_num_rows($propQuery) > 0) {
                                while ($prop = mysqli_fetch_assoc($propQuery)) {
                                    $images = explode(',', $prop['images']);
                                    $mainImage = !empty($images[0]) ? './admin/' . $images[0] : 'uploads/no-image.jpg';
                            ?>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <div class="homelengo-box">
                                            <div class="archive-top">
                                                <a href="property-details.php?id=<?= $prop['id'] ?>" class="images-group">
                                                    <div class="images-style">
                                                        <img class="lazyload" data-src="<?= $mainImage ?>" src="<?= $mainImage ?>" alt="Property Image">
                                                    </div>
                                                    <div class="top">
                                                        <ul class="d-flex gap-6">
                                                            <li class="flag-tag style-1"><?= ucfirst($prop['category']) ?></li>
                                                        </ul>
                                                    </div>
                                                    <div class="bottom"><?= htmlspecialchars($prop['locality']) ?>, <?= htmlspecialchars($prop['city']) ?>, <?= htmlspecialchars($prop['state']) ?></div>
                                                </a>
                                            </div>
                                            <div class="archive-bottom">
                                                <div class="content-top">
                                                    <h6 class="text-capitalize"><a href="property-details.php?id=<?= $prop['id'] ?>" class="link"><?= htmlspecialchars($prop['property_name']) ?></a></h6>
                                                    <ul class="meta-list casa casa">
                                                        <li class="item"><i class="icon icon-bed"></i><span class="text-variant-1">Beds:</span><span class="fw-6"><?= $prop['bedroom'] ?></span></li>
                                                        <li class="item"><i class="icon icon-bath"></i><span class="text-variant-1">Baths:</span><span class="fw-6"><?= $prop['bathroom'] ?></span></li>
                                                        <li class="item"><i class="icon icon-sqft"></i><span class="text-variant-1">Sqft:</span><span class="fw-6"><?= $prop['size'] ?></span></li>
                                                    </ul>
                                                </div>
                                                <div class="content-bottom d-flex justify-content-between align-items-center">
                                                    <a href="property-details.php?id=<?= $prop['id'] ?>" class="d-flex align-items-center gap-2">
                                                        <div class="box-icon line w-44 round"><i class="icon icon-arrow-right2"></i></div>
                                                        <b>More Details</b>
                                                    </a>
                                                    <h6 class="price">₹<?= number_format($prop['price']) ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php }
                            } else {
                                echo '<div class="col-12"><p>No properties found in this category.</p></div>';
                            } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>


<!-- End Recommended -->
<!-- Location -->
<section class="flat-location px-10">
    <div class="box-title text-center wow fadeInUp">
        <div class="text-subtitle text-primary">Explore Cities</div>
        <h3 class="mt-4 title">Our Location For You</h3>
    </div>
    <div class="wow fadeInUp" data-wow-delay=".2s">
        <div dir="ltr" class="swiper tf-sw-location" data-preview="6" data-tablet="3" data-mobile-sm="2" data-mobile="1" data-space-lg="8" data-space-md="8" data-space="8" data-pagination="1" data-pagination-sm="2" data-pagination-md="3" data-pagination-lg="3">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="box-location">
                        <a href="topmap-gridjavascript:void(0)" class="image img-style">
                            <img class="lazyload" data-src="images/location/location-1.jpg" src="images/location/location-1.jpg" alt="image-location">
                        </a>
                        <div class="content">
                            <div class="inner-left">
                                <span class="sub-title fw-6">321 Property</span>
                                <h6 class="title text-line-clamp-1 link">Naperville</h6>
                            </div>
                            <a href="topmap-gridjavascript:void(0)" class="box-icon line w-44 round"><i class="icon icon-arrow-right2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box-location">
                        <a href="topmap-gridjavascript:void(0)" class="image img-style">
                            <img class="lazyload" data-src="images/location/location-2.jpg" src="images/location/location-2.jpg" alt="image-location">
                        </a>
                        <div class="content">
                            <div class="inner-left">
                                <span class="sub-title fw-6">321 Property</span>
                                <h6 class="title text-line-clamp-1 link">Pembroke Pines</h6>
                            </div>
                            <a href="topmap-gridjavascript:void(0)" class="box-icon line w-44 round"><i class="icon icon-arrow-right2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box-location">
                        <a href="topmap-gridjavascript:void(0)" class="image img-style">
                            <img class="lazyload" data-src="images/location/location-3.jpg" src="images/location/location-3.jpg" alt="image-location">
                        </a>
                        <div class="content">
                            <div class="inner-left">
                                <span class="sub-title fw-6">321 Property</span>
                                <h6 class="title text-line-clamp-1 link">Toledo</h6>
                            </div>
                            <a href="topmap-gridjavascript:void(0)" class="box-icon line w-44 round"><i class="icon icon-arrow-right2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box-location">
                        <a href="topmap-gridjavascript:void(0)" class="image img-style">
                            <img class="lazyload" data-src="images/location/location-4.jpg" src="images/location/location-4.jpg" alt="image-location">
                        </a>
                        <div class="content">
                            <div class="inner-left">
                                <span class="sub-title fw-6">321 Property</span>
                                <h6 class="title text-line-clamp-1 link">Orange</h6>
                            </div>
                            <a href="topmap-gridjavascript:void(0)" class="box-icon line w-44 round"><i class="icon icon-arrow-right2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box-location">
                        <a href="topmap-gridjavascript:void(0)" class="image img-style">
                            <img class="lazyload" data-src="images/location/location-5.jpg" src="images/location/location-5.jpg" alt="image-location">
                        </a>
                        <div class="content">
                            <div class="inner-left">
                                <span class="sub-title fw-6">321 Property</span>
                                <h6 class="title text-line-clamp-1 link">Fairfield</h6>
                            </div>
                            <a href="topmap-gridjavascript:void(0)" class="box-icon line w-44 round"><i class="icon icon-arrow-right2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box-location">
                        <a href="topmap-gridjavascript:void(0)" class="image img-style">
                            <img class="lazyload" data-src="images/location/location-6.jpg" src="images/location/location-6.jpg" alt="image-location">
                        </a>
                        <div class="content">
                            <div class="inner-left">
                                <span class="sub-title fw-6">321 Property</span>
                                <h6 class="title text-line-clamp-1 link">Naperville</h6>
                            </div>
                            <a href="topmap-gridjavascript:void(0)" class="box-icon line w-44 round"><i class="icon icon-arrow-right2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box-location">
                        <a href="topmap-gridjavascript:void(0)" class="image img-style">
                            <img class="lazyload" data-src="images/location/location-1.jpg" src="images/location/location-1.jpg" alt="image-location">
                        </a>
                        <div class="content">
                            <div class="inner-left">
                                <span class="sub-title fw-6">321 Property</span>
                                <h6 class="title text-line-clamp-1 link">Austin</h6>
                            </div>
                            <a href="topmap-gridjavascript:void(0)" class="box-icon line w-44 round"><i class="icon icon-arrow-right2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sw-pagination sw-pagination-location text-center"></div>
        </div>
    </div>
</section>
<!-- End Location -->

<!-- Service  -->
<section class="flat-section">
    <div class="container">
        <div class="box-title text-center wow fadeInUp">
            <div class="text-subtitle text-primary">Our Services</div>
            <h3 class="mt-4 title">What We Do?</h3>
        </div>
        <div class="col-lg-8 tf-grid-layout md-col-2 wow fadeInUp mx-auto" data-wow-delay=".2s">
            <div class="box-service">
                <div class="image">
                    <img class="lazyload" data-src="images/service/home-1.png" src="images/service/home-1.png" alt="image-location">
                </div>
                <div class="content">
                    <h5 class="title">Buy A New Home</h5>
                    <p class="description">Discover your dream home effortlessly. Explore diverse properties and expert guidance for a seamless buying experience.</p>
                    <a href="sidebar-gridjavascript:void(0)" class="tf-btn btn-line">Learn More <span class="icon icon-arrow-right2"></span></a>
                </div>
            </div>

            <div class="box-service">
                <div class="image">
                    <img class="lazyload" data-src="images/service/home-3.png" src="images/service/home-3.png" alt="image-location">
                </div>
                <div class="content">
                    <h5 class="title">Rent a home</h5>
                    <p class="description">Discover your perfect rental effortlessly. Explore a diverse variety of listings tailored precisely to suit your unique lifestyle needs.</p>
                    <a href="sidebar-gridjavascript:void(0)" class="tf-btn btn-line">Learn More <span class="icon icon-arrow-right2"></span></a>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- End Service -->
<!-- Benefit -->
<section class="mx-5 bg-primary-new radius-30">
    <div class="flat-img-with-text">
        <div class="content-left img-animation wow">
            <img class="lazyload" data-src="images/banner/img-w-text1.jpg" src="images/banner/img-w-text1.jpg" alt="">
        </div>
        <div class="content-right">
            <div class="box-title wow fadeInUp">
                <div class="text-subtitle text-primary">Our Benifit</div>
                <h3 class="title mt-4">Why Choose HomeLengo</h3>
                <p class="desc text-variant-1">Our seasoned team excels in real estate with years of successful market <br> navigation, offering informed decisions and optimal results.</p>
            </div>
            <div class="flat-service wow fadeInUp" data-wow-delay=".2s">
                <a href="#" class="box-benefit hover-btn-view">
                    <div class="icon-box">
                        <span class="icon icon-proven"></span>
                    </div>
                    <div class="content">
                        <h5 class="title">Proven Expertise</h5>
                        <p class="description">Our seasoned team excels in real estate with years of successful market navigation, offering informed decisions and optimal results.</p>
                    </div>
                </a>
                <a href="#" class="box-benefit hover-btn-view">
                    <div class="icon-box">
                        <span class="icon icon-customize"></span>
                    </div>
                    <div class="content">
                        <h5 class="title">Customized Solutions</h5>
                        <p class="description">We pride ourselves on crafting personalized strategies to match your unique goals, ensuring a seamless real estate journey.</p>
                    </div>
                </a>
                <a href="#" class="box-benefit hover-btn-view">
                    <div class="icon-box">
                        <span class="icon icon-partnership"></span>
                    </div>
                    <div class="content">
                        <h5 class="title">Transparent Partnerships</h5>
                        <p class="description">Transparency is key in our client relationships. We prioritize clear communication and ethical practices, fostering trust and reliability throughout.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- End Benefit -->
<!-- Property  -->
<section class="flat-section">
    <div class="container">
        <div class="box-title">
            <div class="text-center wow fadeInUp">
                <!-- <div class="text-subtitle text-primary">Top Properties</div> -->
                <h3 class="title mt-4">Newly-added properties</h3>
            </div>
        </div>
        <div dir="ltr" class="wow fadeInUp swiper tf-sw-mobile" data-wow-delay=".2s" data-screen="767" data-preview="1" data-space="15">
            <div class="tf-layout-mobile-md xl-col-3 md-col-2 swiper-wrapper">
                <?php
                // Sample array of properties (in real-world, you would fetch this from a database)
                $properties = [
                    [
                        'image' => 'images/home/house-7.jpg',
                        'status_tags' => ['Featured', 'For Sale'],
                        'address' => '145 Brooklyn Ave, Califonia, New York',
                        'title' => 'Casa Lomas de Machalí Machas',
                        'beds' => 3,
                        'baths' => 2,
                        'sqft' => 1150,
                        'price' => '₹7250,00'
                    ],
                    // Add more properties here
                ];

                foreach ($properties as $property): ?>
                    <div class="swiper-slide">
                        <div class="homelengo-box">
                            <div class="archive-top">
                                <a href="property-details-v1.php" class="images-group">
                                    <div class="images-style">
                                        <img class="lazyload" data-src="<?= $property['image'] ?>" src="<?= $property['image'] ?>" alt="img">
                                    </div>
                                    <div class="top">
                                        <ul class="d-flex gap-6">
                                            <?php foreach ($property['status_tags'] as $i => $tag): ?>
                                                <li class="flag-tag <?= $i === 0 ? 'primary' : 'style-1' ?>"><?= htmlspecialchars($tag) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div class="bottom">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 7C10 7.53043 9.78929 8.03914 9.41421 8.41421C9.03914 8.78929 8.53043 9 8 9C7.46957 9 6.96086 8.78929 6.58579 8.41421C6.21071 8.03914 6 7.53043 6 7C6 6.46957 6.21071 5.96086 6.58579 5.58579C6.96086 5.21071 7.46957 5 8 5C8.53043 5 9.03914 5.21071 9.41421 5.58579C9.78929 5.96086 10 6.46957 10 7Z"
                                                stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M13 7C13 11.7613 8 14.5 8 14.5C8 14.5 3 11.7613 3 7C3 5.67392 3.52678 4.40215 4.46447 3.46447C5.40215 2.52678 6.67392 2 8 2C9.32608 2 10.5979 2.52678 11.5355 3.46447C12.4732 4.40215 13 5.67392 13 7Z"
                                                stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <?= htmlspecialchars($property['address']) ?>
                                    </div>
                                </a>
                            </div>
                            <div class="archive-bottom">
                                <div class="content-top">
                                    <h6 class="text-capitalize">
                                        <a href="property-details-v1.php" class="link"><?= htmlspecialchars($property['title']) ?></a>
                                    </h6>
                                    <ul class="meta-list casa">
                                        <li class="item">
                                            <i class="icon icon-bed"></i>
                                            <span class="text-variant-1">Beds:</span>
                                            <span class="fw-6"><?= $property['beds'] ?></span>
                                        </li>
                                        <li class="item">
                                            <i class="icon icon-bath"></i>
                                            <span class="text-variant-1">Baths:</span>
                                            <span class="fw-6"><?= $property['baths'] ?></span>
                                        </li>
                                        <li class="item">
                                            <i class="icon icon-sqft"></i>
                                            <span class="text-variant-1">Sqft:</span>
                                            <span class="fw-6"><?= $property['sqft'] ?></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="content-bottom">
                                    <div class="d-flex gap-8 align-items-center">
                                        <div class="avatar avt-40 round">
                                            <a href="topmap-grid.php" class="box-icon line w-44 round"><i class="icon icon-arrow-right2"></i></a>
                                        </div>
                                        <span>More Details</span>
                                    </div>
                                    <h6 class="price"><?= $property['price'] ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="swiper-slide">
                    <div class="homelengo-box">
                        <div class="archive-top">
                            <a href="property-details-v1javascript:void(0)" class="images-group">
                                <div class="images-style">
                                    <img class="lazyload" data-src="images/home/house-8.jpg" src="images/home/house-8.jpg" alt="img">
                                </div>
                                <div class="top">
                                    <ul class="d-flex gap-6">
                                        <li class="flag-tag primary">Featured</li>
                                        <li class="flag-tag style-1">For Sale</li>
                                    </ul>

                                </div>
                                <div class="bottom">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 7C10 7.53043 9.78929 8.03914 9.41421 8.41421C9.03914 8.78929 8.53043 9 8 9C7.46957 9 6.96086 8.78929 6.58579 8.41421C6.21071 8.03914 6 7.53043 6 7C6 6.46957 6.21071 5.96086 6.58579 5.58579C6.96086 5.21071 7.46957 5 8 5C8.53043 5 9.03914 5.21071 9.41421 5.58579C9.78929 5.96086 10 6.46957 10 7Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M13 7C13 11.7613 8 14.5 8 14.5C8 14.5 3 11.7613 3 7C3 5.67392 3.52678 4.40215 4.46447 3.46447C5.40215 2.52678 6.67392 2 8 2C9.32608 2 10.5979 2.52678 11.5355 3.46447C12.4732 4.40215 13 5.67392 13 7Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    145 Brooklyn Ave, Califonia, New York
                                </div>
                            </a>

                        </div>
                        <div class="archive-bottom">
                            <div class="content-top">
                                <h6 class="text-capitalize"><a href="property-details-v1javascript:void(0)" class="link"> Casa Lomas de Machalí Machas</a></h6>
                                <ul class="meta-list casa">
                                    <li class="item">
                                        <i class="icon icon-bed"></i>
                                        <span class="text-variant-1">Beds:</span>
                                        <span class="fw-6">3</span>
                                    </li>
                                    <li class="item">
                                        <i class="icon icon-bath"></i>
                                        <span class="text-variant-1">Baths:</span>
                                        <span class="fw-6">2</span>
                                    </li>
                                    <li class="item">
                                        <i class="icon icon-sqft"></i>
                                        <span class="text-variant-1">Sqft:</span>
                                        <span class="fw-6">1150</span>
                                    </li>
                                </ul>

                            </div>

                            <div class="content-bottom">
                                <div class="d-flex gap-8 align-items-center">
                                    <div class="avatar avt-40 round">
                                        <a href="topmap-gridjavascript:void(0)" class="box-icon line w-44 round"><i class="icon icon-arrow-right2"></i></a>
                                    </div>
                                    <span>More Details</span>
                                </div>
                                <h6 class="price">₹7250,00</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="homelengo-box">
                        <div class="archive-top">
                            <a href="property-details-v1javascript:void(0)" class="images-group">
                                <div class="images-style">
                                    <img class="lazyload" data-src="images/home/house-9.jpg" src="images/home/house-9.jpg" alt="img">
                                </div>
                                <div class="top">
                                    <ul class="d-flex gap-6">
                                        <li class="flag-tag primary">Featured</li>
                                        <li class="flag-tag style-1">For Sale</li>
                                    </ul>

                                </div>
                                <div class="bottom">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 7C10 7.53043 9.78929 8.03914 9.41421 8.41421C9.03914 8.78929 8.53043 9 8 9C7.46957 9 6.96086 8.78929 6.58579 8.41421C6.21071 8.03914 6 7.53043 6 7C6 6.46957 6.21071 5.96086 6.58579 5.58579C6.96086 5.21071 7.46957 5 8 5C8.53043 5 9.03914 5.21071 9.41421 5.58579C9.78929 5.96086 10 6.46957 10 7Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M13 7C13 11.7613 8 14.5 8 14.5C8 14.5 3 11.7613 3 7C3 5.67392 3.52678 4.40215 4.46447 3.46447C5.40215 2.52678 6.67392 2 8 2C9.32608 2 10.5979 2.52678 11.5355 3.46447C12.4732 4.40215 13 5.67392 13 7Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    145 Brooklyn Ave, Califonia, New York
                                </div>
                            </a>

                        </div>
                        <div class="archive-bottom">
                            <div class="content-top">
                                <h6 class="text-capitalize"><a href="property-details-v1javascript:void(0)" class="link"> Casa Lomas de Machalí Machas</a></h6>
                                <ul class="meta-list casa">
                                    <li class="item">
                                        <i class="icon icon-bed"></i>
                                        <span class="text-variant-1">Beds:</span>
                                        <span class="fw-6">3</span>
                                    </li>
                                    <li class="item">
                                        <i class="icon icon-bath"></i>
                                        <span class="text-variant-1">Baths:</span>
                                        <span class="fw-6">2</span>
                                    </li>
                                    <li class="item">
                                        <i class="icon icon-sqft"></i>
                                        <span class="text-variant-1">Sqft:</span>
                                        <span class="fw-6">1150</span>
                                    </li>
                                </ul>

                            </div>

                            <div class="content-bottom">
                                <div class="d-flex gap-8 align-items-center">
                                    <div class="avatar avt-40 round">
                                        <a href="topmap-gridjavascript:void(0)" class="box-icon line w-44 round"><i class="icon icon-arrow-right2"></i></a>
                                    </div>
                                    <span>More Details</span>
                                </div>
                                <h6 class="price">₹7250,00</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="homelengo-box">
                        <div class="archive-top">
                            <a href="property-details-v1javascript:void(0)" class="images-group">
                                <div class="images-style">
                                    <img class="lazyload" data-src="images/home/house-10.jpg" src="images/home/house-10.jpg" alt="img">
                                </div>
                                <div class="top">
                                    <ul class="d-flex gap-6">
                                        <li class="flag-tag primary">Featured</li>
                                        <li class="flag-tag style-1">For Sale</li>
                                    </ul>

                                </div>
                                <div class="bottom">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 7C10 7.53043 9.78929 8.03914 9.41421 8.41421C9.03914 8.78929 8.53043 9 8 9C7.46957 9 6.96086 8.78929 6.58579 8.41421C6.21071 8.03914 6 7.53043 6 7C6 6.46957 6.21071 5.96086 6.58579 5.58579C6.96086 5.21071 7.46957 5 8 5C8.53043 5 9.03914 5.21071 9.41421 5.58579C9.78929 5.96086 10 6.46957 10 7Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M13 7C13 11.7613 8 14.5 8 14.5C8 14.5 3 11.7613 3 7C3 5.67392 3.52678 4.40215 4.46447 3.46447C5.40215 2.52678 6.67392 2 8 2C9.32608 2 10.5979 2.52678 11.5355 3.46447C12.4732 4.40215 13 5.67392 13 7Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    145 Brooklyn Ave, Califonia, New York
                                </div>
                            </a>

                        </div>
                        <div class="archive-bottom">
                            <div class="content-top">
                                <h6 class="text-capitalize"><a href="property-details-v1javascript:void(0)" class="link"> Casa Lomas de Machalí Machas</a></h6>
                                <ul class="meta-list casa">
                                    <li class="item">
                                        <i class="icon icon-bed"></i>
                                        <span class="text-variant-1">Beds:</span>
                                        <span class="fw-6">3</span>
                                    </li>
                                    <li class="item">
                                        <i class="icon icon-bath"></i>
                                        <span class="text-variant-1">Baths:</span>
                                        <span class="fw-6">2</span>
                                    </li>
                                    <li class="item">
                                        <i class="icon icon-sqft"></i>
                                        <span class="text-variant-1">Sqft:</span>
                                        <span class="fw-6">1150</span>
                                    </li>
                                </ul>

                            </div>

                            <div class="content-bottom">
                                <div class="d-flex gap-8 align-items-center">
                                    <div class="avatar avt-40 round">
                                        <a href="topmap-gridjavascript:void(0)" class="box-icon line w-44 round"><i class="icon icon-arrow-right2"></i></a>
                                    </div>
                                    <span>More Details</span>
                                </div>
                                <h6 class="price">₹7250,00</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="homelengo-box">
                        <div class="archive-top">
                            <a href="property-details-v1javascript:void(0)" class="images-group">
                                <div class="images-style">
                                    <img class="lazyload" data-src="images/home/house-11.jpg" src="images/home/house-11.jpg" alt="img">
                                </div>
                                <div class="top">
                                    <ul class="d-flex gap-6">
                                        <li class="flag-tag primary">Featured</li>
                                        <li class="flag-tag style-1">For Sale</li>
                                    </ul>

                                </div>
                                <div class="bottom">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 7C10 7.53043 9.78929 8.03914 9.41421 8.41421C9.03914 8.78929 8.53043 9 8 9C7.46957 9 6.96086 8.78929 6.58579 8.41421C6.21071 8.03914 6 7.53043 6 7C6 6.46957 6.21071 5.96086 6.58579 5.58579C6.96086 5.21071 7.46957 5 8 5C8.53043 5 9.03914 5.21071 9.41421 5.58579C9.78929 5.96086 10 6.46957 10 7Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M13 7C13 11.7613 8 14.5 8 14.5C8 14.5 3 11.7613 3 7C3 5.67392 3.52678 4.40215 4.46447 3.46447C5.40215 2.52678 6.67392 2 8 2C9.32608 2 10.5979 2.52678 11.5355 3.46447C12.4732 4.40215 13 5.67392 13 7Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    145 Brooklyn Ave, Califonia, New York
                                </div>
                            </a>

                        </div>
                        <div class="archive-bottom">
                            <div class="content-top">
                                <h6 class="text-capitalize"><a href="property-details-v1javascript:void(0)" class="link"> Casa Lomas de Machalí Machas</a></h6>
                                <ul class="meta-list casa">
                                    <li class="item">
                                        <i class="icon icon-bed"></i>
                                        <span class="text-variant-1">Beds:</span>
                                        <span class="fw-6">3</span>
                                    </li>
                                    <li class="item">
                                        <i class="icon icon-bath"></i>
                                        <span class="text-variant-1">Baths:</span>
                                        <span class="fw-6">2</span>
                                    </li>
                                    <li class="item">
                                        <i class="icon icon-sqft"></i>
                                        <span class="text-variant-1">Sqft:</span>
                                        <span class="fw-6">1150</span>
                                    </li>
                                </ul>

                            </div>

                            <div class="content-bottom">
                                <div class="d-flex gap-8 align-items-center">
                                    <div class="avatar avt-40 round">
                                        <a href="topmap-gridjavascript:void(0)" class="box-icon line w-44 round"><i class="icon icon-arrow-right2"></i></a>
                                    </div>
                                    <span>More Details</span>
                                </div>
                                <h6 class="price">₹7250,00</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="homelengo-box">
                        <div class="archive-top">
                            <a href="property-details-v1javascript:void(0)" class="images-group">
                                <div class="images-style">
                                    <img class="lazyload" data-src="images/home/house-12.jpg" src="images/home/house-12.jpg" alt="img">
                                </div>
                                <div class="top">
                                    <ul class="d-flex gap-6">
                                        <li class="flag-tag primary">Featured</li>
                                        <li class="flag-tag style-1">For Sale</li>
                                    </ul>
                                </div>
                                <div class="bottom">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 7C10 7.53043 9.78929 8.03914 9.41421 8.41421C9.03914 8.78929 8.53043 9 8 9C7.46957 9 6.96086 8.78929 6.58579 8.41421C6.21071 8.03914 6 7.53043 6 7C6 6.46957 6.21071 5.96086 6.58579 5.58579C6.96086 5.21071 7.46957 5 8 5C8.53043 5 9.03914 5.21071 9.41421 5.58579C9.78929 5.96086 10 6.46957 10 7Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M13 7C13 11.7613 8 14.5 8 14.5C8 14.5 3 11.7613 3 7C3 5.67392 3.52678 4.40215 4.46447 3.46447C5.40215 2.52678 6.67392 2 8 2C9.32608 2 10.5979 2.52678 11.5355 3.46447C12.4732 4.40215 13 5.67392 13 7Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    145 Brooklyn Ave, Califonia, New York
                                </div>
                            </a>

                        </div>
                        <div class="archive-bottom">
                            <div class="content-top">
                                <h6 class="text-capitalize"><a href="property-details-v1javascript:void(0)" class="link"> Casa Lomas de Machalí Machas</a></h6>
                                <ul class="meta-list casa">
                                    <li class="item">
                                        <i class="icon icon-bed"></i>
                                        <span class="text-variant-1">Beds:</span>
                                        <span class="fw-6">3</span>
                                    </li>
                                    <li class="item">
                                        <i class="icon icon-bath"></i>
                                        <span class="text-variant-1">Baths:</span>
                                        <span class="fw-6">2</span>
                                    </li>
                                    <li class="item">
                                        <i class="icon icon-sqft"></i>
                                        <span class="text-variant-1">Sqft:</span>
                                        <span class="fw-6">1150</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="content-bottom">
                                <div class="d-flex gap-8 align-items-center">
                                    <div class="avatar avt-40 round">
                                        <a href="topmap-gridjavascript:void(0)" class="box-icon line w-44 round"><i class="icon icon-arrow-right2"></i></a>
                                    </div>
                                    <span>More Details</span>
                                </div>
                                <h6 class="price">₹7250,00</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sw-pagination sw-pagination-mb text-center d-md-none d-block"></div>
            <div class="text-center sec-btn">
                <a href="property.php" class="tf-btn btn-view primary size-1 hover-btn-view">View All Properties <span class="icon icon-arrow-right2"></span></a>
            </div>
        </div>
    </div>
</section>
<!-- End Property  -->
<!-- Testimonial -->
<section class="flat-section bg-primary-new flat-testimonial">
    <div class="box-title px-15 wow fadeInUp">
        <div class="text-center wow fadeInUpSmall" data-wow-delay=".2s" data-wow-duration="2000ms">
            <div class="text-subtitle text-primary">Our Testimonials</div>
            <h3 class="title mt-4">What’s people say’s</h3>
            <p class="desc text-variant-1">Our seasoned team excels in real estate with years of successful market navigation, offering informed decisions and optimal results.</p>
        </div>
    </div>
    <div dir="ltr" class="swiper tf-sw-testimonial wow fadeInUp" data-wow-delay=".2s" data-preview="4.5" data-tablet="2" data-mobile-sm="1" data-mobile="1" data-space="15" data-space-md="30" data-space-lg="30" data-centered="true" data-loop="true">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="box-tes-item">
                    <span class="icon icon-quote"></span>
                    <p class="note body-2">
                        "My experience with property management services has exceeded expectations. They efficiently manage properties with a professional and attentive approach in every situation. I feel reassured that any issue will be resolved promptly and effectively."
                    </p>
                    <div class="box-avt d-flex align-items-center gap-12">
                        <div class="info">
                            <h6>Courtney Henry</h6>
                            <p class="caption-2 text-variant-1 mt-4">CEO Themesflat</p>
                            <ul class="list-star">
                                <li class="icon icon-star"></li>
                                <li class="icon icon-star"></li>
                                <li class="icon icon-star"></li>
                                <li class="icon icon-star"></li>
                                <li class="icon icon-star"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="box-tes-item">
                    <span class="icon icon-quote"></span>
                    <p class="note body-2">
                        "My experience with property management services has exceeded expectations. They efficiently manage properties with a professional and attentive approach in every situation. I feel reassured that any issue will be resolved promptly and effectively."
                    </p>
                    <div class="box-avt d-flex align-items-center gap-12">
                        <div class="info">
                            <h6>Esther Howard</h6>
                            <p class="caption-2 text-variant-1 mt-4">CEO Themesflat</p>
                            <ul class="list-star">
                                <li class="icon icon-star"></li>
                                <li class="icon icon-star"></li>
                                <li class="icon icon-star"></li>
                                <li class="icon icon-star"></li>
                                <li class="icon icon-star"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="box-tes-item">
                    <span class="icon icon-quote"></span>
                    <p class="note body-2">
                        "My experience with property management services has exceeded expectations. They efficiently manage properties with a professional and attentive approach in every situation. I feel reassured that any issue will be resolved promptly and effectively."
                    </p>
                    <div class="box-avt d-flex align-items-center gap-12">
                        <div class="info">
                            <h6>Annette Black</h6>
                            <p class="caption-2 text-variant-1 mt-4">CEO Themesflat</p>
                            <ul class="list-star">
                                <li class="icon icon-star"></li>
                                <li class="icon icon-star"></li>
                                <li class="icon icon-star"></li>
                                <li class="icon icon-star"></li>
                                <li class="icon icon-star"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="box-tes-item">
                    <span class="icon icon-quote"></span>
                    <p class="note body-2">
                        "My experience with property management services has exceeded expectations. They efficiently manage properties with a professional and attentive approach in every situation. I feel reassured that any issue will be resolved promptly and effectively."
                    </p>
                    <div class="box-avt d-flex align-items-center gap-12">
                        <div class="info">
                            <h6>Bessie Cooper</h6>
                            <p class="caption-2 text-variant-1 mt-4">CEO Themesflat</p>
                            <ul class="list-star">
                                <li class="icon icon-star"></li>
                                <li class="icon icon-star"></li>
                                <li class="icon icon-star"></li>
                                <li class="icon icon-star"></li>
                                <li class="icon icon-star"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="box-tes-item">
                    <span class="icon icon-quote"></span>
                    <p class="note body-2">
                        "My experience with property management services has exceeded expectations. They efficiently manage properties with a professional and attentive approach in every situation. I feel reassured that any issue will be resolved promptly and effectively."
                    </p>
                    <div class="box-avt d-flex align-items-center gap-12">
                        <div class="info">
                            <h6>Courtney Henry</h6>
                            <p class="caption-2 text-variant-1 mt-4">CEO Themesflat</p>
                            <ul class="list-star">
                                <li class="icon icon-star"></li>
                                <li class="icon icon-star"></li>
                                <li class="icon icon-star"></li>
                                <li class="icon icon-star"></li>
                                <li class="icon icon-star"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="box-tes-item">
                    <span class="icon icon-quote"></span>
                    <p class="note body-2">
                        "My experience with property management services has exceeded expectations. They efficiently manage properties with a professional and attentive approach in every situation. I feel reassured that any issue will be resolved promptly and effectively."
                    </p>
                    <div class="box-avt d-flex align-items-center gap-12">
                        <div class="info">
                            <h6>Courtney Henry</h6>
                            <p class="caption-2 text-variant-1 mt-4">CEO Themesflat</p>
                            <ul class="list-star">
                                <li class="icon icon-star"></li>
                                <li class="icon icon-star"></li>
                                <li class="icon icon-star"></li>
                                <li class="icon icon-star"></li>
                                <li class="icon icon-star"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sw-pagination sw-pagination-testimonial text-center"></div>
    </div>
</section>

<?php include('include/footer.php') ?>



