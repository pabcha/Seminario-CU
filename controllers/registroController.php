<?php
use App\Helpers\Email;

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

			$data = array(
		    	'name' => $_POST['nombre'].' '.$_POST['apellido'],
		    	'destino' => $_POST['correo'],		    	
		    	'password' => $_POST['password']
		    );

		    $html = Email::get_template('new_account', $data);
		    $Mailer = new PHPMailer();
		    $subject = '¡Bienvenido a saltashop!';

		    Email::send($_POST['correo'], $html, $Mailer, $subject);		    
			
			Session::set("exito", 1);
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
		if ( Session::get('exito') !== 1)
		{
			$this->redireccionar('index');
		}
			
		Session::destroy('exito');

		$this->_view->renderizar('registro/thanks');
	}
}