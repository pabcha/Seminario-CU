<?php

use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderHistory;
use App\Models\Product;
use Illuminate\Database\Capsule\Manager as DB;
use App\Classes\Carrito;

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

		if (Session::get('usuario')['autenticado']) 
		{
			$this->redireccionar('caja/pago_y_envio');
			exit;
		}
		else
		{
			$this->viewMake('caja/index');
			exit;
		}
	}

	public function pago_y_envio()
	{
		if ( !Session::get('usuario')['autenticado'] ) 
		{
			$this->redireccionar('caja');
			exit;
		}

		$this->_view->titulo = 'Pago y Envio - Salta Shop';
		$this->_view->setCss(array('front/estilos_categorias'));

		$datos['u'] = User::find( Session::get('usuario')['id'] );
		
		$this->viewMake('caja/pago_y_envio', $datos);
	}

	public function confirmacion()
	{
		if ( !Session::get('usuario')['autenticado'] ) 
		{
			$this->redireccionar('caja');
			exit;
		}

		if ( Carrito::isEmpty() )
		{
			$this->redireccionar('index');
			exit;
		}

		if ( empty($_GET['forma_pago']) )
		{
			$this->redireccionar('error');
			exit;
		}
		else
		{
			$values = ['transferencia', 'paypal'];
			if ( !in_array($_GET['forma_pago'], $values) ) 
			{
				$this->redireccionar('error');
				exit;
			}
		}

		$this->_view->titulo = 'Felicidades - Salta Shop';
		$this->_view->setCss(array('front/estilos_categorias',
			'front/estilos_congrats'));

		$fecha = DB::raw('now()');

		$o = new Order();
		$o->us_id = Session::get('usuario')['id'];
		$o->ord_nombre_us = Session::get('usuario')['nombre'].' '.Session::get('usuario')['apellido'];
		$o->ord_forma_pago = 'Transferencia bancaria';
		$o->ord_estado = 'Pedido';
		$o->ord_estado_fecha = $fecha;
		$o->ord_total = $_SESSION['carrito']['total'];
		$o->ord_fecha = $fecha;
		$o->ord_cantidad_vendida = $_SESSION['carrito']['cantidad'];

		if ( $o->save() )
		{
			//detalle de orden
			$ps = Carrito::get_productos();

			foreach ($ps as $p) 
			{
				$od = new OrderDetail();
				$od->ord_id = $o->ord_id;
				$od->producto_id = $p['producto_id'];
				$od->producto_cantidad = $p['cantidad'];
				$od->producto_precio = $p['producto_precio'];
				$od->producto_subtotal = $p['producto_precio'] * $p['cantidad'];
				$od->producto_nombre = $p['producto_nombre'];

				$od->save();

				//reducir stock
				$producto = Product::find($p['producto_id']);
				$producto->producto_cantidad = $producto->producto_cantidad - $p['cantidad'];
				$producto->producto_cantidad_comprada = $producto->producto_cantidad_comprada + $p['cantidad'];
				$producto->save();
			}

			//historia	
			$oh = new OrderHistory();
			$oh->ord_id = $o->ord_id;
			$oh->historia_fecha = $fecha;
			$oh->historia_accion = 'Nuevo estado';
			$oh->historia_descripcion = 'Pedido';

			$oh->save();
		}

		$datos['id'] = $o->ord_id;
		//$datos['id'] = 18;
		$datos['ps'] = $ps;
		// $datos['ps'] = Carrito::get_productos();
		$datos['carrito_total'] = App\Classes\Carrito::get_total();

		//personal info
		$u = User::find( Session::get('usuario')['id'] );
		$datos['nombre'] = $u->us_nombre.' '.$u->us_apellido;
		$datos['telefono'] = $u->us_telefono;
		$datos['correo'] = $u->us_correo;
		$datos['domicilio'] = $u->us_domicilio;
		$datos['pago'] = 'Transferencia bancaria';


		//finalizado la insercion el carrito se tiene que vaciar
		Session::destroy('carrito');

		//aumentar cantidad comprada

		$this->_view->renderizar('caja/confirmacion', $datos);
	}
}