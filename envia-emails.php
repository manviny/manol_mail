<?php 

// PhpMailer


require_once("./includes/class.phpmailer.php");
require_once("./includes/class.smtp.php");
require_once("./includes/phpmailer.lang-es.php");


//SMTP Settings
$mail = new PHPMailer();
$mail->IsSMTP();
// $mail->SMTPAuth   = true; 
// $mail->SMTPSecure = "tls"; 
$mail->Port = "25";
$mail->Host       = "";
$mail->Username   = "";
$mail->Password   = "";
//

$mail->SetFrom('info@email.com', 'Name First name'); //from (verified email address)
$mail->addReplyTo('info@email.com', 'Name First name');
$mail->Subject = "Mail Test at " . strftime("%T", time()); //subject

//message
$Body= "<h2>This a test</h2><p>an a paragraph</p>";
$mail->Body = $Body;
$mail->IsHTML(true);
$mail->addAttachment("img/logo360.png");

//recipient
$mail->AddAddress("name@name.es", "manol"); 


	//send the message, check for errors
	if (!$mail->send()) {
	    echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
	    echo "Message sent!";
	}







return;
	// old fashion email

	$to = "name@name.es, info@name.com";

	$subject = "Mail Test at " . strftime("%T", time());

	$message = "This a test";

	$from = "My name <info@name.com>";

	$headers = "From: {$from}\n";
	$headers .= "Reply-To: {$from}\n";
	// $headers .= "Cc: {$to}\n";
	// $headers .= "Bcc: {$to}\n";
	$headers .= "X-Mailer: PHP/".phpversion()."\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-Type: text/plain; charset=iso-8859-1";

	$result = mail($to, $subject, $message, $headers);

	echo $result ? 'Sent' : 'Error';

?>