<?php

use App\Classes\Carrito;

class carritoController extends Controller
{
	public function __construct()
	{
		parent::__construct();		
	}

	public function index()
	{
		/*$Carrito = $this->loadModel('carrito');
		$datos['productos'] = $Carrito->get_productos();*/
		Carrito::init();
		$datos['productos'] = Carrito::get_productos();
		//$datos['Carrito'] = $Carrito;

		$this->_view->titulo = 'Mi carrito - Salta Shop';
		$this->_view->setCss(array('front/estilos_categorias',
			'vendor/notifit'));
		$this->_view->setJs(array('common/helpers',
			'front/fn_carro',
			'vendor/notifit'));

		$this->_view->renderizar('layout/default/header');
		$this->_view->renderizar('carrito/index', $datos);
		$this->_view->renderizar('layout/default/footer');
	}

	public function updateC($producto_id)
	{
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' )
		{
			try 
			{
				$cantidad = $_POST['cantidad'];
				Carrito::init();

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

	public function deleteC($producto_id)
	{
		Carrito::init();
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

	public function update()
	{
		$pass = true; //bandera para stock
		$Carrito = $this->loadModel('carrito');
		$Producto = $this->loadModel('producto');

		foreach ($_POST as $producto_id => $cantidad) 
		{
			$producto = $Producto->getProductoById($producto_id);//$producto['cantidad'] => disponible
			
			if ($cantidad > $producto['cantidad'])
			{
				$mensaje = "La cantidad solicitada no está disponible. Solo quedan <b>"
					. $producto['cantidad'] 
					." productos</b> disponibles en <b>"
					. $producto['nombre']
					."</b>";

				Session::set("mensaje_err", $mensaje);
				$pass = false;
				break;			
			}	
		}

		if ( $pass )
		{
			foreach ($_POST as $producto_id => $cantidad) 
			{
				$producto = $Producto->getProductoById($producto_id);
				
				if ($cantidad <= $producto['cantidad'])
				{					
					$Carrito->update_quantity($producto_id, $cantidad);
				} 				
			}

			Session::set("mensaje_exito", "El producto ha sido agregado al carrito!");
		}
		
		$this->redireccionar('carrito');
	}

	public function delete($categoria_id)
	{
		//Validar que existe, sino ignorar
		//borrar del array session
		//modificar cantidad de session
		//recalcular total
		$categoria_id = intval($categoria_id);
		$Carrito = $this->loadModel('carrito');
		$Carrito->remove_producto($categoria_id);
		
		$this->redireccionar('carrito');
	}
}