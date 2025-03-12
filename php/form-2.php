<?php
namespace PortoContactForm;

session_cache_limiter('nocache');
header('Expires: ' . gmdate('r', 0));
// Change this to text/html to allow JavaScript execution
header('Content-type: text/html');

use PHPMailer\PHPMailer\PHPMailer;

require 'php-mailer/src/PHPMailer.php';
require 'php-mailer/src/SMTP.php';
require 'php-mailer/src/Exception.php';

$mail = new PHPMailer();

// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "u768511311_arise";

// SMTP configuration for Hostinger
$mail->isSMTP();
$mail->Host       = 'smtp.hostinger.com';
$mail->SMTPAuth   = true;
$mail->Username   = 'info@adroitconsultants.in';
$mail->Password   = "Adminadroite@2210";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Port       = 465;

$form_name = $_REQUEST['name'];
$contact_email = $_REQUEST['email'];
$contact_phone = $_REQUEST['number'];

// Recipients
$mail->setFrom('info@adroitconsultants.in', 'Contact Us');
$mail->addAddress($contact_email, $form_name);
$mail->addAddress('info@adroitconsultants.in', 'Contact Us');

$servername = "localhost";
$username = "root";
$password = "";
$database = "adroit";

// Database connection
// $servername = "127.0.0.1:3306";
// $username = "u768511311_adroit";
// $password = "Adroit@2210";
// $database = "u768511311_adroit";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO `contact` (`name`, `number`, `email`) VALUES ('$form_name', '$contact_phone', '$contact_email')";
mysqli_query($conn, $sql);
mysqli_close($conn);

// Email content
$mail->isHTML(true);
$mail->Subject = 'Thanks for contacting us!';
$mail_body = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Confirmation</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap");
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: "Poppins", sans-serif; line-height: 1.6; background-color: #f5f5f5; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #2ecc71, #27ae60); padding: 30px 20px; text-align: center; color: white; }
        .header img { max-width: 150px; height: auto; }
        .content { padding: 30px; }
        .greeting { font-size: 24px; font-weight: 600; color: #333; margin-bottom: 20px; }
        .info-box { background: #f8f9fa; padding: 20px; border-radius: 10px; margin: 20px 0; }
        .info-item { margin: 10px 0; color: #555; }
        .info-item strong { color: #2ecc71; }
        .footer { background: #333; color: white; text-align: center; padding: 20px; font-size: 12px; }
        .btn { display: inline-block; padding: 12px 25px; background: #2ecc71; color: white; text-decoration: none; border-radius: 25px; margin-top: 20px; }
        @media (max-width: 480px) { 
            .container { margin: 10px; }
            .content { padding: 20px; }
            .greeting { font-size: 20px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://adroitconsultants.in/img/logo.png" alt="Adroit Consultants" onerror="this.style.display=\'none\'">
        </div>
        <div class="content">
            <div class="greeting">Hello ' . $form_name . ',</div>
            <p style="color: #666;">Thank you for reaching out to us! We’ve received your message and our team will get back to you as soon as possible.</p>
            <div class="info-box">
                <div class="info-item"><strong>Name:</strong> ' . $form_name . '</div>
                <div class="info-item"><strong>Email:</strong> ' . $contact_email . '</div>
                <div class="info-item"><strong>Phone:</strong> ' . $contact_phone . '</div>
            </div>
            <p style="color: #666;">We appreciate your patience and look forward to assisting you!</p>
            <a href="https://test.adroitconsultants.in/" class="btn">Visit Our Website</a>
        </div>
        <div class="footer">
            <p>© ' . date('Y') . ' Adroit Consultants. All Rights Reserved.</p>
            <p>Connecting Excellence with Opportunity</p>
        </div>
    </div>
</body>
</html>';

$mail->Body = $mail_body;

// Send email and redirect
if ($mail->send()) {
    echo '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>';
    echo '<script language="javascript">
      
        window.location.href = "https://test.adroitconsultants.in/";
    </script>';
    echo '</body></html>';
    exit();
} else {
    echo '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>';
    echo '<script language="javascript">
       
        window.location.href = "https://test.adroitconsultants.in/";
    </script>';
    echo '</body></html>';
    exit();
}
?>