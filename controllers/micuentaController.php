<?php
class micuentaController extends Controller
{
	public function __construct()
	{
		parent::__construct();		
	}

	public function index()
	{
		$this->_view->titulo = 'Mi cuenta - Salta Shop';

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
				
		$this->_view->renderizar('layout/default/header');
		$this->_view->renderizar('micuenta/index');
		$this->_view->renderizar('layout/default/footer');		
	}
}
?>