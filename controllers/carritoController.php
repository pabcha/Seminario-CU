<?php
class carritoController extends Controller
{
	public function __construct()
	{
		parent::__construct();		
	}

	public function index()
	{
		$Carrito = $this->loadModel('carrito');
		$datos['productos'] = $Carrito->get_productos();
		$datos['Carrito'] = $Carrito;

		$this->_view->titulo = 'Mi carrito - Salta Shop';
		$this->_view->setCss(array('estilos_categorias'));
		$this->_view->setJs(array('func_carro'));

		$this->_view->renderizar('layout/default/header');
		$this->_view->renderizar('carrito/index', $datos);
		$this->_view->renderizar('layout/default/footer');
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