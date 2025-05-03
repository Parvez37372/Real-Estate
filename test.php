<?php
session_start();
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    // Redirect user to login page if not logged in
    $currentUrl = $_SERVER['REQUEST_URI'];
    header("Location: login.php?redirect=" . urlencode($currentUrl));
    exit;
}

$property_id = 101;
$isWishlisted = false;
if ($user_id && $property_id) {
    include 'db_connection.php';  // Make sure to include your database connection here

    // Check if the property is already in the wishlist
    $sql = "SELECT * FROM wishlist WHERE user_id = ? AND property_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $property_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $isWishlisted = $result->num_rows > 0;

    // If user is trying to add the property to the wishlist
    if (isset($_POST['add_to_wishlist']) && !$isWishlisted) {
        $sql = "INSERT INTO wishlist (user_id, property_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $property_id);
        $stmt->execute();
        $isWishlisted = true; // Update the status to reflect it's now wishlisted
    }

    // If user is trying to remove the property from the wishlist
    if (isset($_POST['remove_from_wishlist']) && $isWishlisted) {
        $sql = "DELETE FROM wishlist WHERE user_id = ? AND property_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $property_id);
        $stmt->execute();
        $isWishlisted = false; // Update the status to reflect it's no longer wishlisted
    }
}
?>

<div class="info-box">
    <div>
        <!-- Add or Remove from Wishlist -->
        <?php if ($isWishlisted): ?>
            <form method="POST">
                <button type="submit" name="remove_from_wishlist" style="background: none; border: none; cursor: pointer;">
                    <i class="fa-solid fa-heart" style="color: red; font-size: 32px;"></i> Remove from Wishlist
                </button>
            </form>
        <?php else: ?>
            <form method="POST">
                <button type="submit" name="add_to_wishlist" style="background: none; border: none; cursor: pointer;">
                    <i class="fa-solid fa-heart" style="color: #ccc; font-size: 32px;"></i> Add to Wishlist
                </button>
            </form>
        <?php endif; ?>
    </div>
</div>
