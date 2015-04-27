<?php 
namespace App\Classes;

class OrdenService
{
	public static function get_estado($id)
	{
		switch ($id) 
		{
			case '1':
				return 'Pedido';
				break;
			case '2':
				return 'Esperando pago';
				break;
			case '3':
				return 'Pago aceptado';
				break;
			case '4':
				return 'Enviado';
				break;
			case '5':
				return 'Recibido';
				break;
			case '6':
				return 'Cancelado';
				break;				
			default:
				//codigo no valido
				$this->redireccionar('error');
				break;
		}
	}

	public static function enviar_correo($destino, $mensaje)
	{
		$this->getLibrary('PHPMailer-master/PHPMailerAutoload');

		$mail = new PHPMailer;

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

		$mail->Body    = '<table style="font-family:Verdana,sans-serif;font-size:11px;color:#374953;width:550px;">
		<tbody>	
			<tr>
				<td align="left">
					'.nl2br($mensaje).'
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td style="font-size:10px;border-top:1px solid #D9DADE;" align="center">
					<a style="color:#ff5e00;font-weight:bold;text-decoration:none;" href="'.BASE_URL.'" target="_blank">SaltaShop.com</a></a>
				</td>
			</tr>
		</tbody>
		</table>';
		//Si no soporta HTML
		$mail->AltBody = $mensaje;

		return $mail->send();
	}
}