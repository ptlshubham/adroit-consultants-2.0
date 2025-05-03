<?php
namespace PortoContactForm;

session_cache_limiter('nocache');
header('Expires: ' . gmdate('r', 0));
header('Content-type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php-mailer/src/PHPMailer.php';
require 'php-mailer/src/SMTP.php';
require 'php-mailer/src/Exception.php';

error_log("Form Data: " . print_r($_POST, true));

$mail = new PHPMailer(true);

try {
    // SMTP config for Gmail
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'adroitbizservices@gmail.com'; // Your Gmail address
    $mail->Password   = 'ubob zwsr fktb pmjh'; // Your Gmail App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use STARTTLS
    $mail->Port       = 587; // Port for STARTTLS

    // Form input
    $form_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $contact_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $contact_number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
    $contact_message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    if (!filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email address');
    }
    if (empty($form_name) || empty($contact_message)) {
        throw new Exception('Name and message are required');
    }

    // Spam filter
    if (preg_match('/http|www|\.com|\.org|\.net/i', $contact_message) ||
        strtoupper($contact_message) === $contact_message ||
        strlen($contact_message) > 500) {
        throw new Exception('Invalid message content');
    }

    // reCAPTCHA
    $recaptcha_secret = '6LczriwrAAAAALgK2nTOIvJ31y-b5ErUPZ3PdrlK';
    $recaptcha_response = $_POST['g-recaptcha-response'];
    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret}&response={$recaptcha_response}");
    $recaptcha = json_decode($verify);
    if (!$recaptcha->success) {
        throw new Exception('CAPTCHA verification failed');
    }

    // Save to DB
    $conn = mysqli_connect("127.0.0.1:3306", "u768511311_adroit", "Adroit@2210", "u768511311_adroit");
    if (!$conn) throw new Exception("DB connection failed: " . mysqli_connect_error());

    $sql = "INSERT INTO `contact` (`name`, `email`, `number`, `message`) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $form_name, $contact_email, $contact_number, $contact_message);
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Database error: " . mysqli_error($conn));
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // Send email
    $mail->setFrom('adroitbizservices@gmail.com', 'Adroit Business Management');
    $mail->addAddress($contact_email, $form_name);
    $mail->addReplyTo('adroitbizservices@gmail.com', 'Adroit Business Management');
    $mail->addAddress('adroitbizservices@gmail.com'); // Internal copy

    $mail->isHTML(true);
    $mail->Subject = 'Thank You for Contacting Adroit Business Management';
    $mail->Body = '
    <html>
    <body style="font-family: sans-serif; background: #f2f2f2; padding: 20px;">
        <div style="max-width: 600px; background: white; padding: 20px; border-radius: 8px;">
            <img src="https://adroitconsultants.in/img/logo.png" alt="Logo" style="max-width: 150px;">
            <h2>Thank You for Reaching Out!</h2>
            <p>Dear ' . htmlspecialchars($form_name) . ',</p>
            <p>We’ve received your message and will get back to you soon.</p>
            <ul>
                <li><strong>Name:</strong> ' . htmlspecialchars($form_name) . '</li>
                <li><strong>Email:</strong> ' . htmlspecialchars($contact_email) . '</li>
                <li><strong>Message:</strong> ' . nl2br(htmlspecialchars($contact_message)) . '</li>
            </ul>
            <p>Best regards,<br>Adroit Business Management Team</p>
        </div>
    </body>
    </html>';

    $mail->send();

    echo json_encode(['success' => true, 'message' => 'Message sent successfully.']);

} catch (Exception $e) {
    error_log("Mail Error: " . $mail->ErrorInfo);
    error_log("Exception: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'Sorry, something went wrong. Please try again later.'
    ]);
}