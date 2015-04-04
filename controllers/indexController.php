<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Classes\Carrito;
use Underscore\Types\Arrays;

class indexController extends Controller
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
		$this->_view->titulo = 'Salta Shop';
		$this->_view->setCss(array('front/estilos_categorias'));
		//$this->_view->setJs(array('func_index'));

		$datos['ps'] = App\Models\Product::where('producto_estado','A')
			->orderBy('producto_id', 'desc')
			->limit(8)
			->get();

		$datos['top'] = App\Models\Product::where('producto_estado','A')
			->orderBy('producto_cantidad_comprada', 'desc')
			->limit(8)
			->get();
		
		$datos['categorias'] = App\Models\Category::where('producto_categoria_padre_id', 0)
			->where('producto_categoria_estado', 'A')
			->get();

		$datos['i'] = 1; // for App\Helpers\Vista::is_first($i)
		$datos['j'] = 1; // for App\Helpers\Vista::is_first($j)

		$this->_view->renderizar('layout/default/header');
		$this->_view->renderizar('index/index', $datos);
		$this->_view->renderizar('layout/default/footer');
	}

	public function categoria($id_categoria)
	{
		try {

			$categoria = App\Models\Category::where('producto_categoria_estado', 'A')
				->where('producto_categoria_id', $id_categoria)
				->firstOrFail();

			$datos['ps'] = $categoria->productos()->get();
			$datos['subcategorias'] = $categoria->get_subcategories();

			$datos['categorias'] = App\Models\Category::where('producto_categoria_padre_id', 0)
				->where('producto_categoria_estado', 'A')
				->get();

			$datos['categoria_nombre'] =$categoria->producto_categoria_nombre;

			$datos['i'] = 1; // for App\Helpers\Vista::is_first($i)

			$this->_view->titulo = $datos['categoria_nombre'].' - Salta Shop';
			$this->_view->setCss(array('front/estilos_categorias'));

			$this->viewMake('index/categoria', $datos);

		} catch (Exception $e) {
			$this->redireccionar('error');
		}
	}

	public function producto($producto_id)
	{
		try {
			/*unset($_SESSION['carrito']);
			die();*/
			$producto = App\Models\Product::where("producto_id", $producto_id)
				->where("producto_estado", 'A')
				->firstOrFail();

			$imagenes = $producto->images()->get();

			$datos['categorias'] = App\Models\Category::where('producto_categoria_padre_id', 0)
				->where('producto_categoria_estado', 'A')
				->get();

			$this->_view->titulo = $producto->producto_nombre.' - Salta Shop';
			$this->_view->setJs(array('vendor/jquery.flexslider-min',
				'common/helpers',
				'front/fn_producto',
				'vendor/notifit'));
			$this->_view->setCss(array('vendor/flexslider',
				'front/estilos_categorias',
				'vendor/notifit'));

			$datos['p'] = $producto;
			$datos['imagenes'] = $imagenes;

			$this->viewMake('index/producto', $datos);
		} catch (Exception $e) {
			$this->redireccionar('error');
		}
		
	}

	public function add_producto($producto_id)
	{
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' )
		{
			$producto = App\Models\Product::where("producto_id", $producto_id)
					->select('producto_id', 
						'producto_nombre', 
						'producto_cantidad as stock', 
						'producto_precio')
					->where("producto_estado", 'A')
					->first();

			$result = array();
			Carrito::init();

			if ( $_POST['cantidad'] > $producto['stock'] || Carrito::is_less($producto_id, $_POST['cantidad'], $producto['stock']) )
			{
				$result['status'] = 'error';
				echo json_encode($result);
				exit;
			}

			$producto['cantidad'] = $_POST['cantidad'];
			$producto['imagen'] = $producto->getDefaultImg()->producto_img_nombre;

			Carrito::add_producto($producto->toArray());

			$result = array(
					'cantidad' => $_SESSION['carrito']['cantidad'],
					'total' => $_SESSION['carrito']['total'],
					'status' => 'success'
				);

			echo json_encode($result);
		}
	}
}
?>