<?php
class contactoController extends Controller
{
	public function __construct()
	{
		parent::__construct();	
	}

	public function index()
	{
		$this->_view->titulo = 'Contacto - Salta Shop';
		$this->_view->setCss(array('front/estilos_categorias'));

		$datos['ps'] = App\Models\Product::where('producto_estado','A')
			->orderBy('producto_id', 'desc')
			->limit(4)
			->get();

		$datos['top'] = App\Classes\TiendaService::most_selled(4);
		

		$this->_view->renderizar('layout/default/header');
		$this->_view->renderizar('contacto/index', $datos);
		$this->_view->renderizar('layout/default/footer');	
	}
}
?>