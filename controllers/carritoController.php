<?php

use App\Classes\Carrito;

class carritoController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		Carrito::init();		
	}

	public function index()
	{
		$datos['productos'] = Carrito::get_productos();

		$this->_view->titulo = 'Mi carrito - Salta Shop';
		$this->_view->setCss(array('front/estilos_categorias',
			'vendor/notifIt'));
		$this->_view->setJs(array('common/helpers',
			'front/fn_carro',
			'vendor/notifIt'));

		$this->_view->renderizar('layout/default/header');
		$this->_view->renderizar('carrito/index', $datos);
		$this->_view->renderizar('layout/default/footer');
	}

	public function update($producto_id)
	{
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' )
		{
			try 
			{
				$cantidad = $_POST['cantidad'];

				$producto = App\Models\Product::where("producto_id", $producto_id)
							->select('producto_id', 
								'producto_nombre', 
								'producto_cantidad as stock', 
								'producto_precio')
							->where("producto_estado", 'A')
							->firstOrFail();

				if ( $cantidad > $producto['stock'] )
				{
					$result['stock'] = $producto['stock'];
					$result['status'] = 'error';
					echo json_encode($result);
					exit;
				}

				Carrito::set_quantity($producto_id, $cantidad);

				$result = array(
					'subtotal' => ($cantidad * $producto['producto_precio']),//del producto
					'cantidad' => $_SESSION['carrito']['cantidad'],//del canasto
					'total' => $_SESSION['carrito']['total'],//del canasto
					'status' => 'success'
				);

				echo json_encode($result);
			} 
			catch (Exception $e) 
			{
				header('HTTP/1.1 500 Internal Server');
		        header('Content-Type: application/json; charset=UTF-8');
		        die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
			}
			
		}
	}

	public function delete($producto_id)
	{
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' )
		{
			$index = Carrito::get_index($producto_id);

			if ( $index > -1)
			{
				Carrito::remove_producto($index);
				Carrito::recalcular();

				$result = array(
					'cantidad' => $_SESSION['carrito']['cantidad'],
					'total' => $_SESSION['carrito']['total'],
					'status' => 'success'
				);

				echo json_encode($result);			
			}
			else
			{
				header('HTTP/1.1 404 Not Found');
			    header('Content-Type: application/json; charset=UTF-8');
			    die(json_encode(array('message' => 'ERROR')));
			}
		}
	}

	public function drop()
	{
		Session::destroy('carrito');
		$this->redireccionar('carrito');
	}
}