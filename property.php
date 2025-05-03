<?php include('include/header.php') ?>
<section class="pt-5 flat-recommended">
    <div class="container">
        <div class="box-title text-center wow fadeInUp">
            <h3 class="mt-4 title">All Properties</h3>
        </div>

        <div class="flat-tab-recommended flat-animate-tab wow fadeInUp" data-wow-delay=".2s">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="allData">
                    <div class="row">
                        <?php
                        $allProps = mysqli_query($conn, "SELECT * FROM property WHERE status = 1 ORDER BY created_at DESC");
                        if (mysqli_num_rows($allProps) > 0) {
                            while ($prop = mysqli_fetch_assoc($allProps)) {
                                $images = explode(',', $prop['images']);
                                $mainImage = !empty($images[0]) ? './admin/' . $images[0] : 'uploads/no-image.jpg';
                                $categoryData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM category WHERE id='{$prop['category']}'"));
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
                                                    <li class="flag-tag style-1"><?= ucfirst($categoryData['name']) ?></li>
                                                </ul>
                                            </div>
                                            <div class="bottom">
                                                <?= htmlspecialchars($prop['locality']) ?>,
                                                <?= htmlspecialchars($prop['city']) ?>,
                                                <?= htmlspecialchars($prop['state']) ?>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="archive-bottom">
                                        <div class="content-top">
                                            <h6 class="text-capitalize">
                                                <a href="property-details.php?id=<?= $prop['id'] ?>" class="link"><?= htmlspecialchars($prop['property_name']) ?></a>
                                            </h6>
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
                        <?php
                            }
                        } else {
                            echo '<div class="col-12"><p>No properties found.</p></div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('include/footer.php') ?>
