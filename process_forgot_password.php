<?php
require_once __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email format.";
        header("Location: index.php");
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $token = bin2hex(random_bytes(50));
        $stmt = $conn->prepare("UPDATE users SET reset_token = ?, token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = ?");
        $stmt->bind_param("ss", $token, $email);
        $stmt->execute();

        $reset_link = "https://mahirealty.in/reset_password.php?token=" . urlencode($token);

        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'mail.webtechnoedgesolutions.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'clientmailer@webtechnoedgesolutions.com';
            $mail->Password   = 'mail@#$2025'; 
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            // Recipients
            $mail->setFrom('clientmailer@webtechnoedgesolutions.com', 'Mahi Realty');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Reset Your Password';
            $mail->Body    = "
                <h3>Password Reset Request</h3>
                <p>Click the link below to reset your password. This link will expire in 1 hour:</p>
                <p><a href='$reset_link'>$reset_link</a></p>
                <p>If you didn’t request this, you can safely ignore this email.</p>
            ";
            $mail->AltBody = "Click the link to reset your password: $reset_link";

            $mail->send();
            $_SESSION['message'] = "A password reset link has been sent to your email.";
        } catch (Exception $e) {
            $_SESSION['message'] = "Email could not be sent. Error: {$mail->ErrorInfo}";
        }
    } else {
        $_SESSION['message'] = "Email address not found.";
    }

    header("Location: index.php");
    exit();
}
?>
