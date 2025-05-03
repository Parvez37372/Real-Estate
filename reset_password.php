<?php
session_start();
include 'db_connection.php';
include('include/header.php');

// Get token from URL
$token = $_GET['token'] ?? '';

// If no token provided
if (empty($token)) {
    echo "<p>Invalid request. No token provided.</p>";
    exit();
}

// Validate token and expiry
$stmt = $conn->prepare("SELECT id FROM users WHERE reset_token = ? AND token_expiry > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    echo "<p>Invalid or expired token.</p>";
    exit();
}

// (Optionally) fetch user ID
$user = $res->fetch_assoc();
$userId = $user['id'];
?>

<div class="container d-flex align-items-center justify-content-center pt-3 pb-3">
    <div class="card shadow-lg p-4 rounded-4" style="max-width: 450px; width: 100%;">
        <h4 class="text-center mb-4">🔐 Reset Your Password</h4>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-info text-center"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
        <?php endif; ?>

        <form action="process_reset_password.php" method="POST">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" name="password" id="password" class="form-control rounded-pill" placeholder="Enter new password" required>
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control rounded-pill" placeholder="Confirm new password" required>
            </div>

            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-dark rounded-pill">Reset Password</button>
                <a href="index.php" class="btn btn-outline-secondary rounded-pill">Back to Login</a>
            </div>
        </form>
    </div>
</div>

<?php include('include/footer.php') ?>
