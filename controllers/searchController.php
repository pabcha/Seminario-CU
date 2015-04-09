<?php

use App\Classes\Carrito;

class searchController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		Carrito::init();	
	}

	private function viewMake($str, $data = array())
	{
		$this->_view->renderizar('layout/default/header');
		$this->_view->renderizar($str, $data);
		$this->_view->renderizar('layout/default/footer');
	}

	public function index()
	{
		$this->_view->titulo = 'Buscar - Salta Shop';
		$this->_view->setCss(array('front/estilos_categorias'));
		
		$datos['categorias'] = App\Models\Category::padre(0)->active()->get();

		$q = ( !empty($_GET['q']) ? $_GET['q'] : '');
		$marcas = App\Models\Marca::all();
		$builder = App\Models\Product::where('producto_nombre', 'LIKE', '%'.$q.'%');

		if (!empty($_GET['min'])) 
		{
			$builder->where('producto_precio', '>=', $_GET['min']);
		}

		if (!empty($_GET['max'])) 
		{
			$builder->where('producto_precio', '<=', $_GET['max']);
		}

		if (!empty($_GET['marca'])) 
		{
			$builder->where('producto_marca_id', $_GET['marca']);
		}

		$datos['ps'] = $builder->get();
		$datos['marcas'] = $marcas;
		$datos['q'] = $q;
		$datos['i'] = 1; // for App\Helpers\Vista::is_first($i)
		$datos['j'] = 1; // for App\Helpers\Vista::is_first($j)

		//validar datos
		//remover de GET las variables q no se usan
		//indicar automaticamente la marca
		//q hacer con la interface busqueda

		$this->viewMake('search/index', $datos);
	}
}