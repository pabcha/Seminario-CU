<?php
use App\Models\User;

class entrarController extends Controller
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

		$this->_view->titulo = 'Entrar - Salta Shop';
		$this->_view->renderizar('entrar/index');		
	}

	public function logear()
	{
		if (Session::get('usuario')['autenticado']) 
		{
			$this->redireccionar('index');
		}

		if ( $_SERVER['REQUEST_METHOD'] != 'POST' )
		{
			$this->redireccionar('index');
		}

		$u = User::isUser($_POST['inputCorreo'], md5($_POST['inputPassword']))
			->active()
			->first();

		if ( !empty($u) ) 
		{
			$_SESSION['usuario'] = array(
				'autenticado' => true,
				'nombre' => $u->us_nombre,
				'apellido' => $u->us_apellido,
				'correo' => $u->us_correo,
				'id' => $u->us_id,
				'tiempo' => time(),
			);

			$this->redireccionar('index');
			exit;			
		}

		Session::set('correo', $_POST['inputCorreo']);
		Session::set('errors', "Usuario/Contraseña incorrectos.");
		$this->redireccionar('entrar');
	}

	public function salir()
	{
		Session::destroy('usuario');
		$this->redireccionar('index');
	}
}
?>