<?php
class blogController extends Controller
{
	public function __construct()
	{
		parent::__construct();		
	}

	public function index()
	{
		$this->_view->titulo = 'Blog - Salta Shop';
		$this->_view->setCss(array('front/estilos_categorias'));

		$datos['ps'] = App\Models\Product::where('producto_estado','A')
			->orderBy('producto_id', 'desc')
			->limit(4)
			->get();

		$datos['top'] = App\Models\Product::where('producto_estado','A')
			->orderBy('producto_cantidad_comprada', 'desc')
			->limit(4)
			->get();

		$this->_view->renderizar('layout/default/header');
		$this->_view->renderizar('blog/index', $datos);	
		$this->_view->renderizar('layout/default/footer');	
	}
}
?>