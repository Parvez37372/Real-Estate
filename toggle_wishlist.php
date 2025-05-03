<?php
session_start();

include 'db_connection.php';

$user_id = $_SESSION['user_id'] ?? null;
$property_id = $_POST['property_id'] ?? null;

if ($user_id && $property_id) {
    // Check if already in wishlist
    $check = $conn->prepare("SELECT * FROM wishlist WHERE user_id = ? AND property_id = ?");
    $check->bind_param("ii", $user_id, $property_id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Remove from wishlist
        $delete = $conn->prepare("DELETE FROM wishlist WHERE user_id = ? AND property_id = ?");
        $delete->bind_param("ii", $user_id, $property_id);
        $delete->execute();
        echo "removed";
    } else {
        // Add to wishlist
        $insert = $conn->prepare("INSERT INTO wishlist (user_id, property_id) VALUES (?, ?)");
        $insert->bind_param("ii", $user_id, $property_id);
        $insert->execute();
        echo "added";
    }
}
?>
