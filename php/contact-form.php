<?php
namespace PortoContactForm;

session_cache_limiter('nocache');
header('Expires: ' . gmdate('r', 0));

header('Content-type: application/json');

use PHPMailer\PHPMailer\PHPMailer;

require 'php-mailer/src/PHPMailer.php';
require 'php-mailer/src/SMTP.php';
require 'php-mailer/src/Exception.php';

$mail = new PHPMailer();

// SMTP configuration for Hostinger
$mail->isSMTP();                                            // Send using SMTP
$mail->Host       = 'smtp.hostinger.com';                    // Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
$mail->Username   = 'info@adroitconsultants.in';       // SMTP username
$mail->Password   = "Adroit@2210";                           // SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
$mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

$form_name = $_REQUEST['name'];
$contact_email = $_REQUEST['email'];
$contact_phone = $_REQUEST['number'];
$contact_message = $_REQUEST['message'];

//Recipients
$mail->setFrom('info@adroitconsultants.in', 'Contact Us');
$mail->addAddress($contact_email, $form_name); 
$mail->addAddress('info@adroitconsultants.in', 'Contact Us'); 

// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "adroit";

 $servername = "127.0.0.1:3306";
 $username = "u768511311_adroit";
 $password = "Adroit@2210";
 $database = "u768511311_adroit";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
}else{
  echo "data successfully recorded";
}

 $sql = "INSERT INTO `contact` (`name`, `email` , `number`, `message`) VALUES
 ('$form_name', '$contact_email', '$contact_phone', '$contact_message');";
 if (mysqli_query($conn, $sql)) {
       echo "New record created successfully";
 } else {
       echo "Error: " . $sql . "<br>" . mysqli_error($conn);
 }
 mysqli_close($conn);

// Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Thanks for contacting us!';
$mail_body.='<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
			   <head>
				  <title>General Quries</title>
				  <meta http-equiv="X-UA-Compatible" content="IE=edge">
				  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
				  <meta name="viewport" content="width=device-width, initial-scale=1">
				  <style type="text/css"> span.productOldPrice { color: #A0131C; text-decoration: line-through;} #outlook a { padding: 0; } body { margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; } table, td { border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; } img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; } p { display: block; margin: 13px 0; } </style>
				  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,700" rel="stylesheet" type="text/css">
				  <style type="text/css"> @import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,700); </style>
				  <!--<![endif]--> 
				  <style type="text/css"> @media only screen and (min-width:480px) { .column-per-100 { width: 100% !important; max-width: 100%; } .column-per-25 { width: 25% !important; max-width: 25%; } .column-per-75 { width: 75% !important; max-width: 75%; } .column-per-48-4 { width: 48.4% !important; max-width: 48.4%; } .column-per-50 { width: 50% !important; max-width: 50%; } } </style>
				  <style type="text/css"> @media only screen and (max-width:480px) { table.full-width-mobile { width: 100% !important; } td.full-width-mobile { width: auto !important; } } noinput.menu-checkbox { display: block !important; max-height: none !important; visibility: visible !important; } @media only screen and (max-width:480px) { .menu-checkbox[type="checkbox"]~.inline-links { display: none !important; } .menu-checkbox[type="checkbox"]:checked~.inline-links, .menu-checkbox[type="checkbox"]~.menu-trigger { display: block !important; max-width: none !important; max-height: none !important; font-size: inherit !important; } .menu-checkbox[type="checkbox"]~.inline-links>a { display: block !important; } .menu-checkbox[type="checkbox"]:checked~.menu-trigger .menu-icon-close { display: block !important; } .menu-checkbox[type="checkbox"]:checked~.menu-trigger .menu-icon-open { display: none !important; } } </style>
				  <style type="text/css"> @media only screen and (min-width:481px) { .products-list-table img { width: 120px !important; display: block; } .products-list-table .image-column { width: 20% !important; } } a { color: #000; } .server-img img { width: 100% } .server-box-one a, .server-box-two a { text-decoration: underline; color: #2E9CC3; } .server-img img { width: 100% } .server-box-one a, .server-box-two a { text-decoration: underline; color: #2E9CC3; } .server-img img { width: 100% } .server-box-one a, .server-box-two a { text-decoration: underline; color: #2E9CC3; } </style>
			   </head>
			   <body style="background-color:#FFFFFF;">
				  <div style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; background-color: #FFFFFF;">
					 <div class="body-wrapper" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; padding-bottom: 20px; box-shadow: 0 4px 10px #ddd; background: #F2F2F2; background-color: #F2F2F2; margin: 0px auto; max-width: 600px; margin-bottom: 10px;">
						<table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#F2F2F2;background-color:#F2F2F2;width:100%;">
						   <tbody>
							  <tr>
								 <td style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; direction: ltr; font-size: 0px; padding: 10px 20px; text-align: center;" align="center">
									<div class="pre-header" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; height: 1px; overflow: hidden; margin: 0px auto; max-width: 560px;">
									   <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
										  <tbody>
											 <tr>
												<td style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; direction: ltr; font-size: 0px; padding: 0px; text-align: center;" align="center">
												   <div class="column-per-100 outlook-group-fix" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: top; width: 100%;">
													  <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
														 <tr>
															<td align="center" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; padding: 0; word-break: break-word;">
															   <div style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 1px; font-weight: 400; line-height: 0; text-align: center; color: #F2F2F2;"></div>
															</td>
														 </tr>
													  </table>
												   </div>
												</td>
											 </tr>
										  </tbody>
									   </table>
									</div>
								  
									<div class="header" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; line-height: 22px; padding: 15px 0; margin: 0px auto; max-width: 560px;">
									   <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
										  <tbody>
											 <tr>
												<td style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; direction: ltr; font-size: 0px; padding: 0px; text-align: center;" align="center">
												   <div class="column-per-25 outlook-group-fix" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: middle; width: 100%;">
													  <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:middle;" width="100%">
														 <tr>
															<td align="center" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; padding: 0; word-break: break-word;">
															   <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
																  <tbody>
																	 <tr>
																		<td style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif;width: 160px;" width="160"> <a href="https://adroitconsultants.in/" target="_blank" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; padding: 0 10px;"> <img alt="Arise Solar" height="auto" href="https://adroitconsultants.in/" src="https://adroitconsultants.in/img/logo.png" alt="Arise Solar" border="0" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" width="160"> </a> </td>
																	 </tr>
																  </tbody>
															   </table>
															</td>
														 </tr>
													  </table>
												   </div>
												</td>
											 </tr>
										  </tbody>
									   </table>
									</div>
									<div class="notice-wrap margin-bottom" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; margin: 0px auto; max-width: 560px; margin-bottom: 15px;">
									   <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
										  <tbody>
											 <tr>
												<td style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; direction: ltr; font-size: 0px; padding: 0px; text-align: center;" align="center">
												   <div class="column-per-100 outlook-group-fix" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: top; width: 100%;">
													  <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
														 <tbody>
															<tr>
															   <td style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; background-color: #ffffff; border-radius: 10px; vertical-align: top; padding: 30px 25px;" bgcolor="#ffffff" valign="top">
																  <table border="0" cellpadding="0" cellspacing="0" role="presentation" style width="100%">
																	 <tr>
																		<td align="left" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; padding: 0; word-break: break-word;">
																		   <div style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 26px; font-weight: bold; line-height: 30px; text-align: left; color: #4F4F4F;"></div>
																		</td>
																	 </tr>
																	 <tr>
																		<td align="left" class="link-wrap" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 0px; padding: 0; padding-bottom: 20px; word-break: break-word;">
																		   <div style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px; text-align: left; color: #4F4F4F;">
																		   Dear <b>'.$form_name.'</b><br>
																			  <br> Thank you for reaching out to us! We have received your message and will respond as soon as possible.<br><br>
																			  <ul>
																				 <li><strong>Name</strong> - '.$form_name.'</li>
																				 <li><strong>Email</strong> - '. $contact_email.'</li>
																				 <li><strong>Phone Number</strong> - '.$contact_phone.'</li>
																				 <li><strong>Message</strong> - '. $contact_message.'</li>
																			  </ul>
																			  <br>
																		   </div>
																		</td>
																	 </tr>
																  </table>
															   </td>
															</tr>
														 </tbody>
													  </table>
												   </div>
												</td>
											 </tr>
										  </tbody>
									   </table>
									</div>
								 </td>
							  </tr>
						   </tbody>
						</table>
					 </div>
					 <div class="footer-wrapper" style="margin: 0px auto; max-width: 600px;">
						<table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #FFFFFF; width: 100%;" width="100%" bgcolor="#FFFFFF">
						   <tbody>
							  <tr>
								 <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">
									<div class="footer-information" style="margin:0px auto;max-width:600px;">
									   <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #FFFFFF; width: 100%;" width="100%" bgcolor="#FFFFFF">
										  <tbody>
											 <tr>
												<td style="direction:ltr;font-size:0px;padding:0px;text-align:center;">
												   <div class="column-per-100 outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
													  <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #FFFFFF; vertical-align: top;" width="100%" valign="top" bgcolor="#FFFFFF">
														 <tbody>
															<tr>
															   <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
																  <div style="font-family:OpenSans, Helvetica, Tahoma, Arial, sans-serif;font-size:12px;font-weight:400;line-height:20px;text-align:center;color:#4F4F4F;">
																	 <br /> &copy; 2023 Arise Solar. All rights reserved.
																	 <br />
																  </div>
															   </td>
															</tr>
														 </tbody>
													  </table>
												   </div>
												</td>
											 </tr>
										  </tbody>
									   </table>
									</div>
								 </td>
							  </tr>
						   </tbody>
						</table>
					 </div>
				  </div>
			   </body>
			</html>';
$mail->Body  = $mail_body;

// Send email and redirect
if ($mail->send()) {
    echo '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>';
    echo '<script language="javascript">
      
        window.location.href = "https://adroitconsultants.in/";
    </script>';
    echo '</body></html>';
    exit();
} else {
    echo '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>';
    echo '<script language="javascript">
       
        window.location.href = "https://adroitconsultants.in/";
    </script>';
    echo '</body></html>';
    exit();
}
?>