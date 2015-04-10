<?php

use App\Classes\Carrito;
use App\Classes\CategoryService;

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
		$this->_view->setJs(array('front/fn_search'));
		$this->_view->setCss(array('front/estilos_categorias'));
		
		$datos['categorias'] = App\Models\Category::padre(0)->active()->get();

		$q = ( !empty($_GET['q']) ? $_GET['q'] : '');
		$marcas = App\Models\Marca::all();
		$builder = App\Models\Product::where('producto_nombre', 'LIKE', '%'.$q.'%');


		/*if (isset($_GET['min']) AND isset($_GET['max']))
		{
			if (is_numeric($_GET['min']) AND is_numeric($_GET['max']) )
			{
				if ($_GET['min'] >= $_GET['max'])
				{
					echo "El minimo debe ser menor que el maximo.";
				}
			}
		}*/

		if (isset($_GET['min'])) 
		{
			if (is_numeric($_GET['min']))
			{
				$builder->where('producto_precio', '>=', $_GET['min']);
			}
		}

		if (isset($_GET['max'])) 
		{
			if (is_numeric($_GET['max']))
			{
				$builder->where('producto_precio', '<=', $_GET['max']);
			}
		}

		if (isset($_GET['marca']) and $_GET['marca'] != 0) 
		{
			$builder->where('producto_marca_id', $_GET['marca']);
		}

		//die();

		//pagination stuffs
		$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
		$per_page = 12;
		$count = $builder->count();
		$paginator = new App\Helpers\Pagination($page, $per_page, $count);

		CategoryService::getFilterProducts($builder, $per_page, $paginator->offset());

		$datos['pag'] = $paginator;
		$datos['ps'] = $builder->get();
		$datos['marcas'] = $marcas;
		$datos['q'] = $q; //ver si dejar
		$datos['i'] = 1; // for App\Helpers\Vista::is_first($i)

		//d($count);
		//die();

		//validar datos
		//remover de GET las variables q no se usan
		//q hacer con la interface busqueda

		$this->viewMake('search/index', $datos);
	}
}