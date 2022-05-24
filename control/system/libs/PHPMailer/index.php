<?php
require 'class.phpmailer.php';
require 'PHPMailerAutoload.php';

$mail = new PHPMailer();
$mail->IsSMTP(true);
$mail->From     = "info@webcozumyeri.com";
$mail->Sender   = "info@webcozumyeri.com";
$mail->AddReplyTo =("info@webcozumyeri.com");
$mail->FromName = "dene";
$mail->Host     = "mail.webcozumyeri.com";
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Port     = 587;

$mail->SMTPOptions = array(
	'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
	)
);

$mail->CharSet  = 'UTF-8';
$mail->Username = "info@webcozumyeri.com";
$mail->Password = "PEjp97Z3";
$mail->WordWrap = 50;
$mail->IsHTML(true);
$mail->Subject  = "konu";
$mail->AddAddress("nasirusta@hotmail.com.tr","Mail gönderimi");
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
if(!$mail->send()) {
    echo $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
