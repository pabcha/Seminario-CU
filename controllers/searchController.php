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
		$paginator = null;
		$this->_view->titulo = 'Buscar - Salta Shop';
		$this->_view->setCss(array('front/estilos_categorias',
			'front/estilos_search'));
		
		$datos['categorias'] = App\Models\Category::padre(0)->active()->get();

		$q = ( !empty($_GET['q']) ? $_GET['q'] : '');

		if ( $q === '')
		{
			$datos['ps'] = App\Models\Product::where('producto_nombre', '')->get();			
		} 
		else
		{
			$builder = App\Models\Product::where('producto_nombre', 'LIKE', '%'.$q.'%');	

			//pagination stuffs
			$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
			$per_page = 12;
			$count = $builder->count();
			$paginator = new App\Helpers\Pagination($page, $per_page, $count);

			$builder->limit( $per_page )->offset( $paginator->offset() );
			$datos['ps'] = $builder->get();
		}				

		$datos['pag'] = $paginator;		
		$datos['i'] = 1; // for App\Helpers\Vista::is_first($i)

		$this->viewMake('search/index', $datos);
	}

	public function advanced()
	{
		$paginator = null;

		$this->_view->titulo = 'Buscar - Salta Shop';
		$this->_view->setJs(array('front/fn_search'));
		$this->_view->setCss(array('front/estilos_categorias',
			'front/estilos_search'));

		$datos['categorias'] = App\Models\Category::padre(0)->active()->get();

		$q = ( !empty($_GET['q']) ? $_GET['q'] : '');
		$marcas = App\Models\Marca::all();
		$builder = App\Models\Product::where('producto_nombre', 'LIKE', '%'.$q.'%');

		if ( $q === '')
		{
			$datos['ps'] = App\Models\Product::where('producto_nombre', '')->get();			
		} 
		else
		{
			$builder = App\Models\Product::where('producto_nombre', 'LIKE', '%'.$q.'%');

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

			//pagination stuffs
			$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
			$per_page = 12;
			$count = $builder->count();
			$paginator = new App\Helpers\Pagination($page, $per_page, $count);

			$builder->limit( $per_page )->offset( $paginator->offset() );

			

			$datos['ps'] = $builder->get();
		}

		$datos['pag'] = $paginator;
		$datos['marcas'] = $marcas;
		$datos['i'] = 1; // for App\Helpers\Vista::is_first($i)

		$this->viewMake('search/advanced', $datos);
	}
}