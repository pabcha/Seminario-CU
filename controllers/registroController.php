<?php
class registroController extends Controller
{
	public function __construct()
	{
		parent::__construct();		
	}

	public function index()
	{
		if (Session::get('usuario')['autenticado']) 
		{
			$this->redireccionar('index');
		}

		$this->_view->renderizar('registro/index');		
	}

	public function store()
	{
		if (Session::get('usuario')['autenticado']) 
		{
			$this->redireccionar('index');
		}

		if ( $_SERVER['REQUEST_METHOD'] != 'POST' )
		{
			$this->redireccionar('index');
		}

		$val = new App\Helpers\Validator();

		if ( App\Classes\RegistroService::validar($val) )
		{
			App\Classes\RegistroService::createUser();
			//Mandar mail

			$this->redireccionar('registro/thanks');
		}

		
		Session::set('errors', $val->show_errors());
		
		Session::set('correo', $_POST['correo']);
		Session::set('nombre', $_POST['nombre']);
		Session::set('apellido', $_POST['apellido']);
		Session::set('dni', $_POST['dni']);
		Session::set('provincia', $_POST['provincia']);
		Session::set('ciudad', $_POST['ciudad']);
		Session::set('cpostal', $_POST['cpostal']);
		Session::set('domicilio', $_POST['domicilio']);
		Session::set('telefono', $_POST['telefono']);
		Session::set('celular', $_POST['celular']);
		$this->redireccionar('registro');
	}

	public function thanks()
	{
		/*if (Session::get('usuario')['autenticado']) 
		{
			$this->redireccionar('index');
		}*/

		$this->_view->renderizar('registro/thanks');
	}

	private function send_email($destino, $pass, $nombre, $apellido)
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
		$mail->Subject = '¡Bienvenido a saltashop!';

		$mail->Body    = '<table style="font-family:Verdana,sans-serif;font-size:11px;color:#374953;width:550px;">
		<tbody>	
			<tr>
				<td align="left">Hola <strong style="color:#ff5e00;">'.$nombre.' '.$apellido.'</strong>,</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td style="background-color:#ff5e00;color:#fff;font-size:12px;font-weight:bold;padding:0.5em 1em;" align="left">Detalles de su cuenta</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td align="left">
					<strong>Gracias por crear una cuenta de cliente en Salta Shop.</strong><br><br> 
					Estos son sus datos de acceso:<br><br> 
					Correo: <strong><span style="color:#ff5e00;">'.$destino.'</span></strong> <br>
					Contraseña: <strong>'.$pass.'</strong>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td align="left">
					Ahora podrá realizar pedidos en nuestra tienda: <a href="'.BASE_URL.'" target="_blank">Salta Shop</a>.
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
		$mail->AltBody = 'Hola '.$nombre.' '.$apellido.',

		Detalles de su cuenta:

		Gracias por crear una cuenta de cliente en Salta Shop. 

		Estos son sus datos de acceso: 
		Correo: '.$destino.'
		Contraseña: '.$pass.'

		Ahora podrá realizar pedidos en nuestra tienda: Salta Shop.';

		$mail->send();
	}
}