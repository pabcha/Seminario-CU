<?php
use App\Helpers\Email;

class recuperarController extends Controller
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
		
		$val = new App\Helpers\Validator();

		if ( App\Classes\RecoverPassService::validar($val) )
		{	
			$pass = App\Helpers\Utils::generate_password();
			$u = App\Models\User::exists($_POST['correo'])->first();

			$u->us_password = md5($pass);
			$u->save();

			$data = array(	    	
		    	'password' => $pass
		    );

		    $html = Email::get_template('recover_password', $data);
		    $Mailer = new PHPMailer();
		    $subject = 'Cambio de contraseña de la cuenta SaltaShop';

		    Email::send($_POST['correo'], $html, $Mailer, $subject);		    
			
			Session::set("exito", 1);
			$this->redireccionar('recuperar/exito');		
		}

		$datos['validador'] = $val;
		$datos['errors'] = $val->show_errors();

		$this->_view->titulo = 'Recuperar Contraseña - Salta Shop';
		$this->_view->renderizar('recuperar/index', $datos);
	}

	public function exito()
	{
		if ( Session::get('exito') !== 1)
		{
			$this->redireccionar('index');
		}
			
		Session::destroy('exito');

		$this->_view->titulo = 'Nueva contraseña - Salta Shop';
		$this->_view->renderizar('recuperar/exito');
	}
}