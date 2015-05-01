<?php
use App\Helpers\Email;

class micuentaController extends Controller
{
	public function __construct()
	{
		parent::__construct();		
	}

	private function viewMake($str, $data = array())
	{
		$this->_view->renderizar('layout/default/header');
		$this->_view->renderizar($str, $data);
		$this->_view->renderizar('layout/default/footer');
	}

	public function index()
	{
		if( !Session::get('usuario')['autenticado'] ) {
			$this->redireccionar('entrar');
		}

		try {
			$ordenes = App\Models\User::findOrFail(Session::get('usuario')['id'])->ordenes()->get();
		} catch (Exception $e) {
			$this->redireccionar('error');
		}
		
		$datos['ordenes'] = $ordenes;

		$this->_view->titulo = 'Mi cuenta - Salta Shop';
		$this->_view->setCss(array('front/estilos_categorias',
			'admin/orden_style'));
		$this->_view->setJs(array('front/fn_micuenta',
			'vendor/datatable1.10.6/jquery.dataTables.min'));

		$this->viewMake('micuenta/index', $datos);	
	}

	public function orden($id)
	{
		if( !Session::get('usuario')['autenticado'] ) 
		{
			$this->redireccionar('entrar');
		}

		try {
			$o = App\Models\Order::findOrFail($id);
		} catch (Exception $e) {
			$this->redireccionar('error');
		}

		$datos['u'] = $o->usuario()->first();
		$datos['ps'] = App\Models\OrderDetail::where('ord_id', $o->ord_id)->get();

		$datos['id'] = $o->ord_id;
		$datos['titular'] = $o->ord_nombre_us;
		$datos['forma_pago'] = $o->ord_forma_pago;
		$datos['fecha'] = $o->ord_fecha;
		$datos['total'] = $o->ord_total;

		$html = App\Helpers\Pdf::get_template('pdf/orden', $datos);

		// disable DOMPDF's internal autoloader if you are using Composer
		define('DOMPDF_ENABLE_AUTOLOAD', false);

		// include DOMPDF's default configuration
		require_once ROOT.'vendor/dompdf/dompdf/dompdf_config.inc.php';

		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('orden.pdf');
	}

	public function editar_informacion()
	{
		if( !Session::get('usuario')['autenticado'] ) 
		{
			$this->redireccionar('entrar');
		}

		try {
			$u = App\Models\User::findOrFail( Session::get('usuario')['id'] );
		} 
		catch (Exception $e) 
		{
			$this->redireccionar('error');
		}

		$val = new App\Helpers\Validator();

		if ( App\Models\User::validateInfo($val) )
		{
			$u->us_nombre = $_POST['inputNombre'];
			$u->us_apellido = $_POST['inputApellido'];
			$u->us_dni = $_POST['inputDNI'];
			$u->us_provincia = $_POST['inputProvincia'];
			$u->us_ciudad = $_POST['inputCiudad'];
			$u->us_cpostal = $_POST['inputCPostal'];
			$u->us_domicilio = $_POST['inputDireccion'];
			$u->us_telefono = $_POST['inputTelefono'];
			$u->us_celular = $_POST['inputCelular'];

			$u->save();
			
			Session::set("exito", 1);
			$this->redireccionar('micuenta/exito');
			exit;
		}
		
		$datos['validador'] 	= $val;
		$datos['errors'] 		= $val->show_errors();
		$datos['u']				= $u;

		$this->_view->titulo = 'Editar informacion - Salta Shop';
		$this->_view->setCss(array('front/estilos_categorias'));

		$this->viewMake('micuenta/editar_informacion', $datos);		
	}

	public function cambiar_password()
	{
		if( !Session::get('usuario')['autenticado'] ) 
		{
			$this->redireccionar('entrar');
		}

		try {
			$u = App\Models\User::findOrFail( Session::get('usuario')['id'] );	
		} catch (Exception $e) {
			$this->redireccionar('error');
			exit();
		}		

		$val = new App\Helpers\Validator();

		if ( App\Models\User::validateEditPassword($val) )
		{
			$u->us_password = md5($_POST['inputPassword']);
			$u->save();

			$data = array(
		    	'titulo' => 'Tu contraseña ha cambiado',
		    	'view' => 'cambiar_password',
		    	'password' => $_POST['inputPassword']
		    );

		    $html = Email::get_template('template', $data);
		    $Mailer = new PHPMailer();
		    Email::send($u->us_correo, $html, $Mailer);
			
			Session::set("exito", 1);
			$this->redireccionar('micuenta/success_password');
			exit;
		}
		
		$datos['validador'] 	= $val;
		$datos['errors'] 		= $val->show_errors();
		$datos['u']				= $u;

		$this->_view->titulo = 'Cambiar password - Salta Shop';
		$this->_view->setCss(array('front/estilos_categorias',
			'front/estilos_micuenta'));

		$this->viewMake('micuenta/cambiar_password', $datos);
	}

	public function success_password()
	{
		if ( Session::get('exito') !== 1)
		{
			$this->redireccionar('index');
		}
			
		Session::destroy('exito');

	    $this->_view->titulo = 'Password cambiado - Salta Shop';
		$this->_view->setCss(array('front/estilos_categorias'));

		$this->viewMake('micuenta/success_password');
	}

	public function exito()
	{
		if ( Session::get('exito') !== 1)
		{
			$this->redireccionar('index');
		}
		
		Session::destroy('exito');

		try 
		{
			$u = App\Models\User::findOrFail( Session::get('usuario')['id'] );
		} 
		catch (Exception $e) 
		{
			$this->redireccionar('error');
		}

		$this->_view->titulo = 'Mi cuenta - Salta Shop';
		$this->_view->setCss(array('front/estilos_categorias'));

		$datos['u']	= $u;

		$this->viewMake('micuenta/exito', $datos);		
	}
}
?>