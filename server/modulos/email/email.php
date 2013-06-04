<?php
require_once("../../lib/phpmailer/class.phpmailer.php");

function enviar_email($assunto, $msg, $enviar_email="macielcr7@gmail.com") {  
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = "ssl";
	$mail->Port       = 465;  
	$mail->Host       = "smtp.gmail.com";
	$mail->Username = "macielc.ronaldo@gmail.com";
	$mail->Password = "webmasterphp";
	$mail->From     = "macielc.ronaldo@gmail.com";
	$mail->FromName = "Framework 2.3.1"; 
	$mail->AddAddress($enviar_email); 
	$mail->IsHTML(true);
	$mail->Subject = $assunto;
	$mail->Body    = $msg;
	$send=$mail->Send();
	$mail->ClearAddresses();
	if(!$send) {
		return false;
	} 
	else {
		return true;
	}
}

?>