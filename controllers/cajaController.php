<?php
class cajaController extends Controller
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
		$this->_view->titulo = 'Checkout - Salta Shop';
		$this->_view->setCss(array('front/estilos_categorias'));
		
		$this->viewMake('caja/index');
	}

	public function pago_y_envio()
	{
		$this->_view->titulo = 'Checkout - Salta Shop';
		$this->_view->setCss(array('front/estilos_categorias'));
		
		$this->viewMake('caja/pago_y_envio');
	}
}