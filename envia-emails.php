<?php 




require_once("./includes/class.phpmailer.php");
require_once("./includes/class.smtp.php");
require_once("./includes/phpmailer.lang-es.php");
require_once("./includes/mail_config.php");


$to 			= "name@email.com";
$to_name 		= "your company";

$subject 		= "Mail Test at " . strftime("%T", time());
$message 		= "This a test";
$Body			= "<h2>This a test</h2><p>an a paragraph</p>";


// PhpMailer SMTP
email_smtp($smtpHost, $smtpUsername, $smtpPassword, $from, $from_name, $to, $to_name, $subject, $Body);

// Classic way with headers
// email_classic($from, $from_name, $to, $to_name, $subject, $message);




// PhpMailer
function email_smtp($smtpHost, $smtpUsername, $smtpPassword, $from, $from_name, $to, $to_name, $subject, $Body){

	//SMTP Settings
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth   = true; 
	$mail->SMTPSecure = "tls"; 
	$mail->Port 		= "25";
	$mail->Host       = $smtpHost;
	$mail->Username   = $smtpUsername;
	$mail->Password   = $smtpPassword;
	
	// From
	$mail->SetFrom($from, $from_name); //from (verified email address)
	$mail->addReplyTo($from, $from_name);

	//message
	$mail->Subject = $subject;

	$mail->Body = $Body;
	$mail->IsHTML(true);
	// $mail->addAttachment("img/logo360.png");

	//recipient
	$mail->AddAddress($to, $to_name); 


	//send the message, check for errors
	if (!$mail->send()) {
	    echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
	    echo "Message sent!";
	}

}

// classic way
function email_classic($from, $from_name, $to, $to_name, $subject, $message){


	$headers = "From: {$from}\n";
	$headers .= "Reply-To: {$from}\n";
	// $headers .= "Cc: {$to}\n";
	// $headers .= "Bcc: {$to}\n";
	$headers .= "X-Mailer: PHP/".phpversion()."\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-Type: text/plain; charset=iso-8859-1";

	$result = mail($to, $subject, $message, $headers);

	echo $result ? 'Message sent!' : 'Mailer Error';
}

?>