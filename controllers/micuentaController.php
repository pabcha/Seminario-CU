<?php
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
		/*if( !Session::get('autenticado') ) {
			$this->redireccionar('entrar');
		}

		if (Session::get('level') == 'administrador') {
			$this->redireccionar('entrar');
			exit;
		}*/

		/*if ( Session::get('autenticado') && Session::get('level') != 'usuario'){
			$this->redireccionar('entrar');
		}*/

		$ordenes = App\Models\User::findOrFail(Session::get('usuario')['id'])->ordenes()->get();

		//armar pdf
		
		$datos['ordenes'] = $ordenes;
		$this->_view->titulo = 'Mi cuenta - Salta Shop';
		$this->_view->setCss(array('front/estilos_categorias',
			'admin/orden_style'));
		$this->_view->setJs(array('front/fn_micuenta',
			'vendor/datatable1.10.6/jquery.dataTables.min'));

		$this->viewMake('micuenta/index', $datos);	
	}

	public function editar_informacion()
	{
		$this->_view->titulo = 'Editar informacion - Salta Shop';

		$this->_view->setCss(array('front/estilos_categorias'));
		$this->_view->setJs(array('front/fn_micuenta'));

		$this->viewMake('micuenta/editar_informacion');
	}

	public function editar_domicilio()
	{
		//informacion de contacto
		$this->_view->titulo = 'Editar domicilio - Salta Shop';

		$this->_view->setCss(array('front/estilos_categorias'));
		$this->_view->setJs(array('front/fn_micuenta'));

		$this->viewMake('micuenta/editar_domicilio');
	}
}
?>