<?php 
namespace App\Helpers;

class Email
{
	public static function get_template($file, array $data = array())
	{
		ob_start();
		extract($data);
		include ROOT.'templates/email/'.$file.'.php';
		return ob_get_clean();
	}

	public static function send($destino, $mensaje, $mail)
	{
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587; 
		$mail->SMTPAuth = true;
		$mail->Username = EMAIL_USERNAME;
		$mail->Password = EMAIL_PASSWORD;
		$mail->SMTPSecure = 'tls';
		$mail->CharSet = 'UTF-8';

		$mail->From = EMAIL_USERNAME;
		$mail->FromName = EMAIL_EMISOR;

		$mail->addAddress( $destino );
		$mail->isHTML(true);
		$mail->Subject = 'Comunicado '.EMAIL_EMISOR;

		$mail->Body = $mensaje;
		$mail->AltBody = $mensaje;

		return $mail->send();
	}
}