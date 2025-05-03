<?php
include('include/header.php');
include('db_connection.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $categoryName = mysqli_real_escape_string($conn, $_GET['id']);

    $cat_query = "SELECT id, name FROM category WHERE id = '$categoryName' AND status = 1";
    $cat_result = $conn->query($cat_query);

    if ($cat_result && $cat_result->num_rows > 0) {
        $cat_row = $cat_result->fetch_assoc();
        $categoryId = $cat_row['id'];

        echo "<h4 class='text-center pt-3 pb-4' style='margin-top: 20px;'>" . htmlspecialchars($cat_row['name']) . "</h4>";

        $property_query = "SELECT * FROM property WHERE category = '$categoryName' ORDER BY id DESC";
        $property_result = $conn->query($property_query);

        if ($property_result && $property_result->num_rows > 0) {
            echo '<div class="container"><div class="row px-4 pb-5">';
            while ($prop = $property_result->fetch_assoc()) {
                $images = explode(',', $prop['images']);
                $mainImage = !empty($images[0]) ? './admin/' . $images[0] : 'uploads/no-image.jpg';

                echo '
                <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                    <div class="homelengo-box">
                        <div class="archive-top">
                            <a href="property-details.php?id=' . $prop['id'] . '" class="images-group">
                                <div class="images-style">
                                    <img class="lazyload" data-src="' . $mainImage . '" src="' . $mainImage . '" alt="Property Image">
                                </div>
                                <div class="top">
                                    <ul class="d-flex gap-6">
                                        <li class="flag-tag style-1">' . htmlspecialchars($cat_row['name']) . '</li>
                                    </ul>
                                </div>
                                <div class="bottom">' . htmlspecialchars($prop['locality']) . ', ' . htmlspecialchars($prop['city']) . ', ' . htmlspecialchars($prop['state']) . '</div>
                            </a>
                        </div>
                        <div class="archive-bottom">
                            <div class="content-top">
                                <h6 class="text-capitalize"><a href="property-details.php?id=' . $prop['id'] . '" class="link">' . htmlspecialchars($prop['property_name']) . '</a></h6>
                                <ul class="meta-list casa casa">
                                    <li class="item"><i class="icon icon-bed"></i><span class="text-variant-1">Beds:</span><span class="fw-6">' . htmlspecialchars($prop['bedroom']) . '</span></li>
                                    <li class="item"><i class="icon icon-bath"></i><span class="text-variant-1">Baths:</span><span class="fw-6">' . htmlspecialchars($prop['bathroom']) . '</span></li>
                                    <li class="item"><i class="icon icon-sqft"></i><span class="text-variant-1">Sqft:</span><span class="fw-6">' . htmlspecialchars($prop['size']) . '</span></li>
                                </ul>
                            </div>
                            <div class="content-bottom d-flex justify-content-between align-items-center">
                                <a href="property-details.php?id=' . $prop['id'] . '" class="d-flex align-items-center gap-2">
                                    <div class="box-icon line w-44 round"><i class="icon icon-arrow-right2"></i></div>
                                    <b>More Details</b>
                                </a>
                                <h6 class="price">₹' . number_format($prop['price']) . '</h6>
                            </div>
                        </div>
                    </div>
                </div>';
            }
            echo '</div></div>'; // Close row and container
        } else {
            echo "<p class='text-center'>No properties found in this category.</p>";
        }
    } else {
        echo "<p class='text-center'>Category not found.</p>";
    }
} else {
    echo "<p class='text-center'>No category selected.</p>";
}

include('include/footer.php');
?>
