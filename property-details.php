<?php include('include/header.php') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php
include 'db_connection.php';
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: property.php");
    exit;
}

$id = intval($_GET['id']);
$propQuery = mysqli_query($conn, "SELECT * FROM property WHERE id = $id AND status = 1");
if (mysqli_num_rows($propQuery) == 0) {
    echo "Property not found!";
    exit;
}
$prop = mysqli_fetch_assoc($propQuery);
$images = explode(',', $prop['images']);
$category = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM category WHERE id = '{$prop['category']}'"));
$subcategory = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM subcategory WHERE id = '{$prop['subcategory']}'"));
?>


<div class="flat-section-v4" style="max-width: 1100px; margin: auto; box-shadow: rgba(17, 17, 26, 0.1) 0px 4px 16px, rgba(17, 17, 26, 0.05) 0px 8px 32px;">
    <div class="container">
        <div class="header-property-detail">
            <div class="content-top d-flex justify-content-between align-items-center">
                <h2 class="property-title"><?= htmlspecialchars($prop['property_name']) ?></h2>
                <div class="box-price d-flex align-items-end">
                    <h4 class="property-price mb-0">Price: ₹<?= number_format($prop['price']) ?></h4>
                </div>
            </div>


            <div class="content-bottom">
                <div class="box-left">
                    <div class="info-box">
                        <div class="label">Features</div>
                        <ul class="meta">
                            <li class="meta-item">
                                <i class="icon icon-bed"></i>
                                <span class="text-variant-1">Beds: <?= $prop['bedroom'] ?></span>
                            </li>
                            <li class="meta-item">
                                <i class="icon icon-bath"></i>
                                <span class="text-variant-1">Baths: <?= $prop['bathroom'] ?></span>
                            </li>
                            <li class="meta-item">
                                <i class="icon icon-sqft"></i>
                                <span class="text-variant-1"><?= $prop['size'] ?> Sqft</span>
                            </li>
                        </ul>
                    </div>
                    <div class="info-box">
                        <div class="label">Location</div>
                        <p class="property-location mb-0"><?= htmlspecialchars($prop['locality']) ?>, <?= htmlspecialchars($prop['city']) ?>, <?= htmlspecialchars($prop['state']) ?></p>
                    </div>
                </div>
               <?php
session_start();
$user_id = $_SESSION['user_id'] ?? null;



$property_id = $id;
$isWishlisted = false;
if ($user_id && $property_id) {
    $sql = "SELECT * FROM wishlist WHERE user_id = ? AND property_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $property_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $isWishlisted = $result->num_rows > 0;
}
?>

<div class="info-box">
  <div>
    <i class="fa-solid fa-heart wishlist-icon" 
       data-property="<?= $property_id ?>"  data-user="<?= isset($_SESSION['username']) ? $_SESSION['username'] : "1"; ?>"  
       style="color: <?= $isWishlisted ? 'red' : '#ccc'; ?>; font-size: 32px; cursor: pointer;">
    </i>
  </div>
</div>


            </div>
        </div>
    </div>
</div>

<!--  -->
<section class="flat-slider-detail-v1 px-10" style="max-width: 1100px; margin: auto; box-shadow: rgba(17, 17, 26, 0.1) 0px 4px 16px, rgba(17, 17, 26, 0.05) 0px 8px 32px;">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    <div class="container pt-4 pb-4">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php foreach ($images as $img): ?>
                    <?php if (!empty($img)): ?>
                        <div class="swiper-slide">
                            <a href="./admin/<?= $img ?>" data-fancybox="gallery">
                                <img src="./admin/<?= $img ?>" alt="Property Image" class="gallery-img" style="width:100%;  border-radius: 8px;">
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <!-- Navigation buttons -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>

</section>


<section class="flat-section-v3 flat-property-detail" style="max-width: 1100px; margin: auto;">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7 pt-5 pb-5" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 4px 16px, rgba(17, 17, 26, 0.05) 0px 8px 32px; padding-left: 30px;">
                <div class="single-property-element single-property-desc">
                    <h5 class="fw-6 title">Description</h5>
                    <p><?= nl2br(htmlspecialchars($prop['description'])) ?></p>
                </div>
                <div class="single-property-element single-property-overview">
                    <h6 class="title fw-6">Overview</h6>
                    <ul class="info-box">
                        <!-- Property Size -->
                        <li class="item">
                            <a href="#" class="box-icon w-52"><i class="icon icon-crop"></i></a>
                            <div class="content">
                                <span class="label">Size:</span>
                                <span><?= htmlspecialchars($prop['size']) ?> Sqft</span>
                            </div>
                        </li>

                        <!-- Category -->
                        <li class="item">
                            <a href="#" class="box-icon w-52"><i class="icon icon-sliders-horizontal"></i></a>
                            <div class="content">
                                <span class="label">Category:</span>
                                <span><?= htmlspecialchars($category['name']) ?></span>
                            </div>
                        </li>

                        <!-- Subcategory -->
                        <li class="item">
                            <a href="#" class="box-icon w-52"><i class="icon icon-home"></i></a>
                            <div class="content">
                                <span class="label">Subcategory:</span>
                                <span><?= htmlspecialchars($subcategory['name']) ?></span>
                            </div>
                        </li>

                        <!-- Bedrooms -->
                        <li class="item">
                            <a href="#" class="box-icon w-52"><i class="icon icon-bed1"></i></a>
                            <div class="content">
                                <span class="label">Bedrooms:</span>
                                <span><?= htmlspecialchars($prop['bedroom']) ?> Rooms</span>
                            </div>
                        </li>

                        <!-- Bathrooms -->
                        <li class="item">
                            <a href="#" class="box-icon w-52"><i class="icon icon-bathtub"></i></a>
                            <div class="content">
                                <span class="label">Bathrooms:</span>
                                <span><?= htmlspecialchars($prop['bathroom']) ?> Rooms</span>
                            </div>
                        </li>

                    </ul>
                </div>

                <!-- <div class="single-property-element single-property-video">
                    <h5 class="title fw-6">Photos Tour this project virtually</h5>

                    <div dir="ltr" class="swiper tf-sw-location"
                        data-preview="3" data-tablet="2" data-mobile-sm="2" data-mobile="1"
                        data-space-lg="10" data-space-md="10" data-space="10"
                        data-pagination="1" data-pagination-sm="2" data-pagination-md="2" data-pagination-lg="3">

                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <a href="images/banner/banner-property-1.jpg" data-fancybox="gallery" class="box-img-detail d-block">
                                    <img src="images/banner/banner-property-1.jpg" alt="img-property">
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="images/banner/banner-property-3.jpg" data-fancybox="gallery" class="box-img-detail d-block">
                                    <img src="images/banner/banner-property-3.jpg" alt="img-property">
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="images/banner/banner-property-2.jpg" data-fancybox="gallery" class="box-img-detail d-block">
                                    <img src="images/banner/banner-property-2.jpg" alt="img-property">
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="images/banner/banner-property-1.jpg" data-fancybox="gallery" class="box-img-detail d-block">
                                    <img src="images/banner/banner-property-1.jpg" alt="img-property">
                                </a>
                            </div>
                        </div>

                        <div class="sw-pagination sw-pagination-location text-center"></div>
                    </div>
                </div> -->

                <div class="single-property-element single-property-feature">
                    <h5 class="title fw-6">Amenities and features</h5>

                    <?php
                    $query = "
SELECT a.*
FROM amenities a
JOIN property_amenities pa ON a.id = pa.amenity_id
WHERE pa.property_id = $id
";

                    $query = "SELECT * FROM amenities";
                    $result = mysqli_query($conn, $query);

                    $columns = [[], [], []];
                    $index = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $columns[$index % 3][] = $row;
                        $index++;
                    }
                    ?>

                    <div class="wrap-feature">
                        <?php foreach ($columns as $column): ?>
                            <div class="box-feature">
                                <ul>
                                    <?php foreach ($column as $amenity): ?>
                                        <li class="feature-item">
                                            <?php if (!empty($amenity['image'])): ?>
                                                <img src="./admin/<?= htmlspecialchars($amenity['image']) ?>" style="height: 30px; width: 30px; object-fit: cover; margin-right: 10px;">
                                            <?php endif; ?>
                                            <?= htmlspecialchars($amenity['amenity_name']) ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>

                <?php

                $id = $_GET['id'];

                $query = "SELECT latitude, longitude FROM property WHERE id = $id";
                $result = mysqli_query($conn, $query);

                $embed_url = ""; 
                $api_key = "YOUR_REAL_API_KEY";

                if ($row = mysqli_fetch_assoc($result)) {
                    $lat = floatval(trim($row['latitude']));
                    $lng = floatval(trim($row['longitude']));
                    $zoom = 14;

                    if ($lat != 0 && $lng != 0) {
                        $embed_url = "https://www.google.com/maps?q=$lat,$lng&hl=es;z%3D14&amp;output=embed";
                    } else {
                        $embed_url = "https://www.google.com/maps/embed?pb=..."; 
                    }
                }
                ?>
                <div class="single-property-element single-property-map">
                    <h5 class="title fw-6">Map location</h5>
                    <iframe
                        class="map"
                        src="<?= $embed_url ?>"
                        height="478"
                        style="border:0;"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>


                <?php
                $propertyId = $prop['id'];

                $query = "SELECT * FROM nearby_places WHERE property_id = $propertyId";
                $result = mysqli_query($conn, $query);
                ?>

                <div class="single-property-element single-property-nearby">
                    <!-- <h5 class="title fw-6">What’s nearby?</h5> -->
                    <div class="row box-nearby">
                        <div class="col-md-5">
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <div class="nearby mt-4">
                                    <h5 class="title fw-6">What’s nearby?</h5>
                                    <ul>
                                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                            <li><?= htmlspecialchars($row['place_name']) ?> - <?= htmlspecialchars($row['distance']) ?></li>
                                        <?php endwhile; ?>
                                    </ul>
                                </div>
                            <?php else: ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>


                <section >
                <div class="container"> 
                    <div class="tf-faq">
                        <div class="box-title style-1 text-center wow fadeInUpSmall" data-wow-delay=".2s" data-wow-duration="2000ms">
                        <h5 class="title fw-6 text-start">Frequently Asked Questions</h5>
                        </div>
                        <ul class="box-faq" id="wrapper-faq">
                            <li class="faq-item">
                                <a href="#accordion-faq-one" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-one">
                                   1. What types of properties does Mahi Realty deal with?
                                </a>
                                <div id="accordion-faq-one" class="collapse" data-bs-parent="#wrapper-faq">
                                    <p class="faq-body">
                                        We deal with a wide variety of properties, including residential, commercial, and industrial properties. Whether you're looking to buy your dream home, invest in commercial spaces, or explore industrial property options, we have something to suit your needs.

                                    </p>
                                </div>
                            </li>
                            <li class="faq-item active">
                                <a href="#accordion-faq-two" class="faq-header" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-two">
                                   2. How can I schedule a property viewing?
                                </a>
                                <div id="accordion-faq-two" class="collapse show" data-bs-parent="#wrapper-faq">
                                    <p class="faq-body">
                                       You can schedule a property viewing by contacting us through our website or by calling our customer support team. We will arrange a time that is convenient for you to visit and explore the property in person.

                                    </p>
                                </div>
                            </li>
                            <li class="faq-item">
                                <a href="#accordion-faq-three" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-three">
                                  3. Can I get financing or mortgage assistance through Mahi Realty?
                                </a>
                                <div id="accordion-faq-three" class="collapse" data-bs-parent="#wrapper-faq">
                                    <p class="faq-body">
                                       While we do not directly offer financing or mortgages, we work closely with a network of trusted financial institutions and lenders. We can refer you to reliable partners who can assist with financing options.

                                    </p>
                                </div>
                            </li>
                            <li class="faq-item">
                                <a href="#accordion-faq-four" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-four">
                                  4. How do I make a payment for a property?
                                </a>
                                <div id="accordion-faq-four" class="collapse" data-bs-parent="#wrapper-faq">
                                    <p class="faq-body">
                                        Payments for properties can be made through the payment methods specified in the sale agreement. You will receive detailed instructions once your purchase agreement is finalized.

                                    </p>
                                </div>
                            </li>
                            <li class="faq-item">
                                <a href="#accordion-faq-five" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-five">
                                 5. Are the prices listed on the website negotiable?

                                </a>
                                <div id="accordion-faq-five" class="collapse" data-bs-parent="#wrapper-faq">
                                    <p class="faq-body">
                                       Prices for properties listed on our website are generally fixed, but in some cases, there may be room for negotiation depending on the property and the seller’s terms. We encourage you to discuss this with our team during the buying process.
                                    </p>
                                </div>
                            </li>
                            
                          <!--   <li class="faq-item">-->
                          <!--      <a href="#accordion-faq-six" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-five">-->
                          <!--      6. What should I do if I’m interested in purchasing a property?-->


                          <!--      </a>-->
                          <!--      <div id="accordion-faq-seven" class="collapse" data-bs-parent="#wrapper-faq">-->
                          <!--          <p class="faq-body">-->
                          <!--            If you’re interested in a property, simply contact us to express your interest. Our team will guide you through the next steps, including property viewings, paperwork, and negotiations. We will assist you throughout the entire process.-->
                          <!--          </p>-->
                          <!--      </div>-->
                          <!--  </li>-->
                            
                          <!--   <li class="faq-item">-->
                          <!--      <a href="#accordion-faq-five" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-five">-->
                          <!--  7. Are the properties listed on the website available for immediate sale?-->

                          <!--      </a>-->
                          <!--      <div id="accordion-faq-five" class="collapse" data-bs-parent="#wrapper-faq">-->
                          <!--          <p class="faq-body">-->
                          <!--            While we strive to keep our listings up to date, the availability of properties may change. It’s always a good idea to check with us directly to confirm that a specific property is still available for purchase.-->

                          <!--          </p>-->
                          <!--      </div>-->
                          <!--  </li>-->
                            
                          <!--     <li class="faq-item">-->
                          <!--      <a href="#accordion-faq-five" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-five">-->
                          <!--8. What happens if I change my mind after signing a purchase agreement?-->


                          <!--      </a>-->
                          <!--      <div id="accordion-faq-five" class="collapse" data-bs-parent="#wrapper-faq">-->
                          <!--          <p class="faq-body">-->
                          <!--            Once a purchase agreement is signed, it is legally binding. However, the terms of the agreement will outline any conditions for cancellations or changes, such as deposit forfeiture or specific cancellation clauses. We strongly recommend reviewing the agreement carefully before signing.-->

                          <!--          </p>-->
                          <!--      </div>-->
                          <!--  </li>-->
                            
                          <!--    <li class="faq-item">-->
                          <!--      <a href="#accordion-faq-five" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-five">-->
                          <!--     9. Can I sell my property through Mahi Realty?-->


                          <!--      </a>-->
                          <!--      <div id="accordion-faq-five" class="collapse" data-bs-parent="#wrapper-faq">-->
                          <!--          <p class="faq-body">-->
                          <!--             Yes, we offer property sales services for sellers. If you wish to sell your property, please contact us to discuss how we can assist you in listing and selling your property.-->

                          <!--          </p>-->
                          <!--      </div>-->
                          <!--  </li>-->
                            
                          <!--    <li class="faq-item">-->
                          <!--      <a href="#accordion-faq-five" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-five">-->
                          <!--   10. How do I contact Mahi Realty if I have further questions?-->


                          <!--      </a>-->
                          <!--      <div id="accordion-faq-five" class="collapse" data-bs-parent="#wrapper-faq">-->
                          <!--          <p class="faq-body">-->
                          <!--            You can reach us by phone, email, or through our website's contact form. Our team is always available to help answer any questions you may have.-->

                          <!--          </p>-->
                          <!--      </div>-->
                          <!--  </li>-->
                            
                          <!--    <li class="faq-item">-->
                          <!--      <a href="#accordion-faq-five" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-five">-->
                          <!--     11. Is Mahi Realty involved in property management services?-->


                          <!--      </a>-->
                          <!--      <div id="accordion-faq-five" class="collapse" data-bs-parent="#wrapper-faq">-->
                          <!--          <p class="faq-body">-->
                          <!--            At the moment, we focus primarily on property sales and purchases. We do not currently offer property management services, but we can refer you to trusted partners if you are seeking property management assistance.-->

                          <!--          </p>-->
                          <!--      </div>-->
                          <!--  </li>-->
                            
                          <!--    <li class="faq-item">-->
                          <!--      <a href="#accordion-faq-five" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-five">-->
                          <!--    12. Do you offer any warranty or guarantee on the properties you sell?-->


                          <!--      </a>-->
                          <!--      <div id="accordion-faq-five" class="collapse" data-bs-parent="#wrapper-faq">-->
                          <!--          <p class="faq-body">-->
                          <!--            While we ensure that all properties listed are inspected and meet required standards, we do not offer specific warranties or guarantees. It is always recommended to conduct a thorough inspection before finalizing any purchase.-->
                          <!--          </p>-->
                          <!--      </div>-->
                          <!--  </li>-->
                        </ul>
                        
                    </div>
                </div>
            </section>



            </div>
            <?php


$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $p_id = htmlspecialchars(trim($_POST["p_id"]));
    $name = htmlspecialchars(trim($_POST["name"]));
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $email = htmlspecialchars(trim($_POST["email"]));

    if ($name && $phone && $email) {
        $stmt = $conn->prepare("INSERT INTO contacts (name, phone, email,property_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $phone, $email, $p_id);

        if ($stmt->execute()) {
            $message = "Contact submitted successfully!";
        } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $message = "All fields are required.";
    }
}
?>

<!-- HTML Contact Form -->
<div class="col-xl-4 col-lg-5" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 4px 16px, rgba(17, 17, 26, 0.05) 0px 8px 32px;">
    <div class="single-sidebar fixed-sidebar pb-4">
        <div class="widget-box single-property-contact">
            <h5 class="title fw-6">Contact Sellers</h5>

            <?php if (!empty($message)): ?>
                <div class="alert alert-info mt-3"><?php echo $message; ?></div>
            <?php endif; ?>

            <form action="" method="post" class="contact-form mt-3">
                <input type="hidden" name="p_id" value="<?=$_GET['id']?>">
                <div class="ip-group">
                    <input type="text" name="name" placeholder="Name" class="form-control" required>
                </div>
                <div class="ip-group">
                    <input type="text" name="phone" placeholder="Phone" class="form-control" minlength="8" maxlength="10"   required>
                </div>
                <div class="ip-group">
                    <input type="email" name="email" placeholder="Email" class="form-control" required>
                </div>

                <button type="submit" class="tf-btn btn-view primary hover-btn-view w-100">Find Properties <span class="icon icon-arrow-right2"></span></button>
            </form>
        </div>
    </div>
</div>

        </div>

    </div>

</section>
<script>
    const accordionItemh = document.querySelectorAll(".ko-accordion-item-header");
    accordionItemh.forEach((accordionItemh) => {
        accordionItemh.addEventListener("click", (event) => {
            accordionItemh.classList.toggle("active");
            const accordionItemBody = accordionItemh.nextElementSibling;
            if (accordionItemh.classList.contains("active")) {
                accordionItemBody.style.maxHeight = accordionItemBody.scrollHeight + "px";
            } else {
                accordionItemBody.style.maxHeight = 0;
            }
        });
    });
</script>

<!-- slider -->

<script>
    const swiper = new Swiper('.mySwiper', {
        slidesPerView: 3,
        spaceBetween: 10,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            1024: {
                slidesPerView: 3,
            },
            768: {
                slidesPerView: 2,
            },
            480: {
                slidesPerView: 1,
            }
        }
    });
</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
  $(".wishlist-icon").click(function(){
    var icon = $(this);
    var propertyId = icon.data("property");
    var userId = icon.data("user");
    if(userId == 1){
        $('#modalLogin').modal('show');
    }else{
    $.ajax({
      url: "toggle_wishlist.php",
      type: "POST",
      data: { property_id: propertyId },
      success: function(response) {
        if(response === "added") {
          icon.css("color", "red");
          alert('Add to Wishlist SuccessFully');
        } else if(response === "removed") {
          icon.css("color", "#ccc");
          alert('Remove From Wishlist SuccessFully');
        }
      }
    });
  }
  });
});
</script>


<?php include('include/footer.php') ?>