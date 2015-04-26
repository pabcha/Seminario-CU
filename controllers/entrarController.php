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
		//$Usuario = $this->loadModel('usuario');

		/*if (Session::get('usuario')['autenticado'] && Session::get('usuario')['rol'] == 'usuario') 
		{
			$this->redireccionar('index');
		}*/

		$Val = new App\Helpers\Validator();

		/*$a = User::isUser('pablochavez15@hotmail.com', '1234567')->active()->first();

		d($a);
		exit;*/

		if ( User::validate($Val) )
		{
			//redireccionar a otro metodo que haga el trabajo			
			$u = User::isUser($_POST['inputCorreo'], $_POST['inputPassword'])->active()->first();

			$_SESSION['usuario'] = array(
					'autenticado' => true,
					'rol' => 'usuario',
					'nombre' => $u->us_nombre,
					'apellido' => $u->us_apellido,
					'correo' => $u->us_correo,
					'id' => $u->us_id,
					'tiempo' => time(),
				);

			$this->redireccionar('index');
		}		

		/*if( $this->getInt('enviar') == 1 ) {	
			
			if( Session::get('autenticado') ) {
				//Si sos administrador y te logeas con cuenta de usuario, borro session anterior e inicio como usuario	
				Session::destroy('autenticado');
				Session::destroy('level');
				Session::destroy('op_nombre');
				Session::destroy('op_correo');
				Session::destroy('op_id');
				Session::destroy('tiempo');
			}
			
			Session::set('autenticado',true);
			Session::set( 'level',	$cliente->cl_rol );
			Session::set( 'cliente_correo',	$cliente->cl_correo );
			Session::set( 'cliente_id',	$cliente->cl_id );
			Session::set('tiempo',	time() );

			$this->redireccionar('micuenta');
		}*/

		//Validacion y Actualizacion
		/*if ( $Usuario->validar_user() )
		{
			$user = $Usuario->identify_user($_POST['inputCorreo'], $_POST['inputPassword']);

			$_SESSION['usuario'] = array(
					'autenticado' => true,
					'rol' => 'usuario',
					'nombre' => $user['nombre'],
					'apellido' => $user['apellido'],
					'correo' => $user['correo'],
					'id' => $user['id'],
					'tiempo' => time(),
				);

			$this->redireccionar('index');
		}*/

		$datos['validador'] 	= $Val;
		$datos['errors'] 		= $Val->show_errors();

		$this->_view->titulo = 'Entrar - Salta Shop';

		$this->_view->renderizar('entrar/index', $datos);		
	}

	public function salir()
	{
		Session::destroy('usuario');
		$this->redireccionar('index');
	}
}
?>