<?
$account="sebastian.mira@regus.com";
$password="Welcome.24281";
$to="sebastian.mira@regus.com";
$from="sebastian.mira@regus.com";
$from_name="sebastian Mira";
$msg="<strong>This is a bold text.</strong>"; // HTML message
$subject="HTML message";
/*End Config*/

include("phpmailer/class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->CharSet = 'UTF-8';
$mail->Host = "smtp.live.com";
$mail->SMTPAuth= true;
$mail->Port = 587;
$mail->Username= $account;
$mail->Password= $password;
$mail->SMTPSecure = 'tls';
$mail->From = $from;
$mail->FromName= $from_name;
$mail->isHTML(true);
$mail->Subject = $subject;
$mail->Body = $msg;
$mail->addAddress($to);
if(!$mail->send()){
 echo "Mailer Error: " . $mail->ErrorInfo;
}else{
 echo "E-Mail has been sent";
}
?>
