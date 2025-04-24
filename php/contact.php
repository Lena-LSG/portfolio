<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include Composer's autoloader
require '../vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

header('Content-Type: application/json');
session_start();

// Basic rate limiting
if (isset($_SESSION['last_submission']) && time() - $_SESSION['last_submission'] < 300) {
    http_response_code(429);
    echo json_encode(['error' => 'Please wait 5 minutes between submissions']);
    exit;
}

// Validate request method
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(['error' => 'Invalid request method']);
    exit;
}

// Validate inputs
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

// Check required fields
if (!$name || !$email || !$message) {
    http_response_code(400);
    echo json_encode(['error' => 'All fields are required']);
    exit;
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid email format']);
    exit;
}

// Create PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Server settings
    // $mail->SMTPDebug = 2; // Enable verbose debug output for troubleshooting
    $mail->isSMTP();
    $mail->Host       = $_ENV['SMTP_HOST'];                // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                              // Enable SMTP authentication
    $mail->Username   = $_ENV['SMTP_USERNAME'];            // SMTP username
    $mail->Password   = $_ENV['SMTP_PASSWORD'];            // SMTP password or App Password
    $mail->SMTPSecure = $_ENV['SMTP_ENCRYPTION'];          // Enable TLS encryption
    $mail->Port       = $_ENV['SMTP_PORT'];                // TCP port to connect to

    // Recipients
    $mail->setFrom($_ENV['CONTACT_EMAIL'], 'Your Portfolio');
    $mail->addAddress($_ENV['CONTACT_EMAIL'], 'Lena Gibson'); // Add a recipient
    $mail->addReplyTo($email, $name);

    // Content
    $mail->isHTML(true);
    $mail->Subject = "Portfolio Contact: {$name}";
    $mail->Body    = "
    <!DOCTYPE html>
    <html>
    <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
        <h2>New Contact Form Submission</h2>
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Message:</strong></p>
        <p>" . nl2br(htmlspecialchars($message)) . "</p>
    </body>
    </html>";
    $mail->AltBody = "New Contact Form Submission\n\nName: {$name}\nEmail: {$email}\nMessage:\n{$message}";

    $mail->send();
    echo json_encode(['success' => 'Message sent successfully!']);
    $_SESSION['last_submission'] = time();
} catch (Exception $e) {
    // Log error to a file
    error_log('Mailer Error: ' . $mail->ErrorInfo . "\n", 3, __DIR__ . '/logs/error.log');
    http_response_code(500);
    echo json_encode(['error' => 'There was an error sending your message. Please try again later.']);
}
?>