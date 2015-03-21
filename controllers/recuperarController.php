<?php
class recuperarController extends Controller
{
	public function __construct()
	{
		parent::__construct();		
	}

	public function index()
	{
		$Usuario = $this->loadModel('usuario');

		if (Session::get('usuario')['autenticado'] && Session::get('usuario')['rol'] == 'usuario') 
		{
			$this->redireccionar('index');
		}

		//Validacion y Actualizacion
		if ( $Usuario->validar_form_recuperar_password() )
		{	
			$newpassword = $this->generate_password();
			$id_usuario = $Usuario->is_user( $_POST['inputCorreo'] )['id'];

			if ( $Usuario->update_password( $id_usuario, $newpassword ) === false )
			{
				echo "Ha ocurrido un error intente nuevamente.";
				exit;
			}

			if ( $this->send_email($_POST['inputCorreo'], $newpassword) === false)
			{
				echo "Ha ocurrido un error intente nuevamente.";
				exit;
			}
							
			$this->redireccionar('recuperar/exito');				
		}

		$datos['validador'] = $Usuario->getValidadorInstance();
		$datos['errors'] = $Usuario->getErrorsForm();

		$this->_view->titulo = 'Recuperar Contraseña - Salta Shop';

		$this->_view->renderizar('recuperar/index', $datos);
	}

	public function exito()
	{
		$this->_view->titulo = 'Recuperar Contraseña - Salta Shop';
		$this->_view->renderizar('recuperar/exito');
	}

	private function send_email($destino, $pass)
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
		$mail->Subject = 'Cambio de contraseña de la cuenta SaltaShop';

		$mail->Body    = '<table style="font-family:Verdana,sans-serif;font-size:11px;color:#374953;width:550px;">
		<tbody>
			<tr>
				<td style="background-color:#ff5e00;color:#fff;font-size:12px;font-weight:bold;padding:0.5em 1em;" align="left">Tu contraseña ha cambiado</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td align="left">
					Este es su correo y contraseña nueva. Ahora puede acceder a SaltaShop:<br><br> 
					Correo: <strong><span style="color:#ff5e00;">'.$destino.'</span></strong> <br>
					Contraseña: <strong>'.$pass.'</strong><br><br>
					Recuerde cambiar su contraseña por una que le sea mas facil recordar desde el area de usuarios.
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td align="left">
					Si tiene algun problema contactese con: saltashop_help@gmail.com.
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
		$mail->AltBody = 'Tu contraseña ha cambiado

			Este es su correo y contraseña nueva. Ahora puede acceder a SaltaShop: 

			Correo: '.$destino.'
			Contraseña: '.$pass.'

			Recuerde cambiar su contraseña por una que le sea mas facil recordar desde el area de usuarios.
		
			Si tiene algun problema contactese con: saltashop_help@gmail.com.
		
			atte. SaltaShop';

		return $mail->send();
	}

	private function generate_password()
	{
		$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$cad = "";

		for( $i=0; $i < 8; $i++ ) 
		{
			$cad .= substr($str, rand(0, 62), 1);
		}

		return $cad;
	}
}