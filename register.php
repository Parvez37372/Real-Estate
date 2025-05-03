<?php
include 'db_connection.php'; // Ensure this file connects to the database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required form fields are set
    if (isset($_POST["username"], $_POST["email"], $_POST["password"])) {

        // Sanitize input values
        $username = htmlspecialchars(trim($_POST["username"]));
        $email = htmlspecialchars(trim($_POST["email"]));
        $password = trim($_POST["password"]);

        if (!empty($username) && !empty($email) && !empty($password)) {
            // Check if the username already exists
            $sql = "SELECT id FROM users WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                echo "<script>alert('Username already exists!');</script>";
            } else {
                // Hash password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Insert new user
                $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $username, $email, $hashed_password);

                if ($stmt->execute()) {
                    echo "<script>
                        alert('Registration successful! Redirecting to login..');
                        window.location.href = 'index.php?registered=success';
                    </script>";
                    exit();
                } else {
                    echo "<script>alert('Registration failed!');</script>";
                }
            }
            $stmt->close();
        } else {
            echo "<script>alert('Please fill in all fields!');</script>";
        }
    }
    $conn->close();
}
?>
