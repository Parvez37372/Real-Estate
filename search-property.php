<?php
include('include/header.php');
include('db_connection.php');

$result = false; 

$categories = $conn->query("SELECT * FROM category");
$subcategories = $conn->query("SELECT * FROM subcategory");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_id = $_POST['category_id'] ?? '';
    $subcategory_id = $_POST['subcategory_id'] ?? '';
    $search_text = trim($_POST['search_text'] ?? '');
    $bhk = $_POST['bhk'] ?? '';
    $min_price = $_POST['min_price'] ?? '';
    $max_price = $_POST['max_price'] ?? '';
    
    $query = "SELECT * FROM property WHERE status = 1";

    if (!empty($category_id)) {
        $query .= " AND category = '$category_id'";
    }

    if (!empty($subcategory_id)) {
        $query .= " AND subcategory = '$subcategory_id'";
    }

    if (!empty($search_text)) {
        $safeText = $conn->real_escape_string($search_text);
        $query .= " AND (
            property_name LIKE '%$safeText%' 
            OR description LIKE '%$safeText%' 
            OR city LIKE '%$safeText%' 
            OR locality LIKE '%$safeText%'
        )";
    }

    if (!empty($bhk)) {
        $query .= " AND bedroom = '$bhk'";
    }

    if (!empty($min_price) && !empty($max_price)) {
        $query .= " AND price BETWEEN '$min_price' AND '$max_price'";
    }

    $result = $conn->query($query);
}
?>
<div class="container">
    <div class="bg-light shadow rounded p-3 mb-3">
    <form method="POST" action="search-property.php" id="searchForm">
        <div class="row mb-4">
            <div class="col-md-2">
                <select name="bhk" class="nice-select" onchange="document.getElementById('searchForm').submit();">
                    <option value="">BHK</option>
                    <option value="1" <?= isset($bhk) && $bhk == 1 ? 'selected' : '' ?>>1 BHK</option>
                    <option value="2" <?= isset($bhk) && $bhk == 2 ? 'selected' : '' ?>>2 BHK</option>
                    <option value="3" <?= isset($bhk) && $bhk == 3 ? 'selected' : '' ?>>3 BHK</option>
                    <option value="4" <?= isset($bhk) && $bhk == 4 ? 'selected' : '' ?>>4 BHK</option>
                </select>
            </div>

            <div class="col-md-3">
                <input type="number" name="min_price" placeholder="Min Price" class="form-control" value="<?= htmlspecialchars($min_price) ?>" onchange="document.getElementById('searchForm').submit();" />
            </div>

            <div class="col-md-3">
                <input type="number" name="max_price" placeholder="Max Price" class="form-control" value="<?= htmlspecialchars($max_price) ?>" onchange="document.getElementById('searchForm').submit();" />
            </div>

            <div class="col-md-4">
                <input type="text" name="search_text" placeholder="Search by name, city, locality" class="form-control" value="<?= htmlspecialchars($search_text) ?>" onchange="document.getElementById('searchForm').submit();" />
            </div>
        </div>
    </form>
    </div>
    <!-- Search Results -->
    <h5 class="mb-4">Search Results</h5>
    <div class="row">
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $images = explode(',', $row['images']);
                $mainImage = !empty($images[0]) ? './admin/' . $images[0] : 'uploads/no-image.jpg';

                $catName = '';
                $catRes = $conn->query("SELECT name FROM category WHERE id = '{$row['category']}'");
                if ($catRes && $catRow = $catRes->fetch_assoc()) {
                    $catName = $catRow['name'];
                }

                $subName = '';
                $subRes = $conn->query("SELECT name FROM subcategory WHERE id = '{$row['subcategory']}'");
                if ($subRes && $subRow = $subRes->fetch_assoc()) {
                    $subName = $subRow['name'];
                }
        ?>
                <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                    <div class="homelengo-box">
                        <div class="archive-top">
                            <a href="property-details.php?id=<?= $row['id'] ?>" class="images-group">
                                <div class="images-style">
                                    <img class="lazyload" data-src="<?= $mainImage ?>" src="<?= $mainImage ?>" alt="Property Image">
                                </div>
                                <div class="top">
                                    <ul class="d-flex gap-6">
                                        <li class="flag-tag style-1"><?= ucfirst($catName) ?></li>
                                        <li class="flag-tag style-1"><?= ucfirst($subName) ?></li>
                                    </ul>
                                </div>
                                <div class="bottom"><?= htmlspecialchars($row['locality']) ?>, <?= htmlspecialchars($row['city']) ?>, <?= htmlspecialchars($row['state']) ?></div>
                            </a>
                        </div>
                        <div class="archive-bottom">
                            <div class="content-top">
                                <h6 class="text-capitalize">
                                    <a href="property-details.php?id=<?= $row['id'] ?>" class="link">
                                        <?= htmlspecialchars($row['property_name']) ?>
                                    </a>
                                </h6>
                                <ul class="meta-list casa casa">
                                    <li class="item"><i class="icon icon-bed"></i><span class="text-variant-1">Beds:</span><span class="fw-6"><?= $row['bedroom'] ?></span></li>
                                    <li class="item"><i class="icon icon-bath"></i><span class="text-variant-1">Baths:</span><span class="fw-6"><?= $row['bathroom'] ?></span></li>
                                    <li class="item"><i class="icon icon-sqft"></i><span class="text-variant-1">Sqft:</span><span class="fw-6"><?= $row['size'] ?></span></li>
                                </ul>
                            </div>
                            <div class="content-bottom d-flex justify-content-between align-items-center">
                                <a href="property-details.php?id=<?= $row['id'] ?>" class="d-flex align-items-center gap-2">
                                    <div class="box-icon line w-44 round"><i class="icon icon-arrow-right2"></i></div>
                                    <b>More Details</b>
                                </a>
                                <h6 class="price">₹<?= number_format($row['price']) ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<div class='col-12'><p>No matching properties found.</p></div>";
        }
        ?>
    </div>
</div>

<?php include('include/footer.php') ?>
