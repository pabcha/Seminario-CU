<?php 
namespace App\Classes;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderHistory;
use App\Models\Product;
use Illuminate\Database\Capsule\Manager as DB;
use App\Classes\Carrito;

class CajaService
{
	public static function saveOrder($forma_pago)
	{
		$fecha = DB::raw('now()');
		
		$orden_id = static::save_encabezado($forma_pago, $fecha);
		static::save_detalle($orden_id);
		static::save_history($orden_id, $fecha);		

		return $orden_id;
	}

	private static function save_encabezado($forma_pago, $fecha)
	{
		$o = new Order();

		$o->us_id = $_SESSION['usuario']['id'];
		$o->ord_nombre_us = $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellido'];
		$o->ord_forma_pago = $forma_pago;
		$o->ord_estado = 'Pedido';
		$o->ord_estado_fecha = $fecha;
		$o->ord_total = $_SESSION['carrito']['total'];
		$o->ord_fecha = $fecha;
		$o->ord_cantidad_vendida = $_SESSION['carrito']['cantidad'];

		$o->save();

		return $o->ord_id;
	}

	private static function save_detalle($orden_id)
	{
		$ps = Carrito::get_productos();

		foreach ($ps as $p) 
		{
			$od = new OrderDetail();
			$od->ord_id = $orden_id;
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
	}

	private static function save_history($orden_id, $fecha)
	{
		$oh = new OrderHistory();
		$oh->ord_id = $orden_id;
		$oh->historia_fecha = $fecha;
		$oh->historia_accion = 'Nuevo estado';
		$oh->historia_descripcion = 'Pedido';

		$oh->save();
	}
}