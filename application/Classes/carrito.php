<?php
namespace App\Classes;

use Underscore\Types\Arrays;

class Carrito 
{
	public static function init()
	{
		if (! isset($_SESSION['carrito']) )
		{
			$_SESSION['carrito'] = array(
					'productos' => array(),	
					'cantidad' => 0,
					'total' => 0.00, 			
				);
		}
	}

	public static function get_productos()
	{
		return $_SESSION['carrito']['productos'];
	}

	public static function add_producto($producto)
	{
		if ( ! is_array($producto) ) return;

		if ( !static::existe($producto['producto_id']) )
		{
			static::insert_producto($producto);
			static::update_total_quantity($producto['cantidad'], $producto['producto_precio']);
			return true;
		}

		if ( static::existe($producto['producto_id']) )
		{
			$indice = static::get_index( $producto['producto_id'] );
			static::update_quantity($producto, $indice);
			static::update_total_quantity($producto['cantidad'], $producto['producto_precio']);
			return true;
		}
	}

	public static function insert_producto($producto)
	{
		array_push($_SESSION['carrito']['productos'], $producto);
	}

	public static function update_quantity($producto, $indice)
	{
		$_SESSION['carrito']['productos'][$indice]['cantidad'] += $producto['cantidad'];		
	}

	public static function is_less($producto_id, $cantidad, $stock)
	{
		$idx = static::get_index($producto_id);

		if ( $idx > -1)
		{
			$sum = $_SESSION['carrito']['productos'][$idx]['cantidad'] + $cantidad;

			if ( $sum > $stock)
			{
				return true;
			}
		}

		return false;
	}

	public static function update_total_quantity($cantidad, $precio)
	{
		$_SESSION['carrito']['cantidad'] += $cantidad;
		$_SESSION['carrito']['total'] += ($cantidad * $precio);
	}

	public static function existe($id)
	{
		$temp = Arrays::pluck($_SESSION['carrito']['productos'], 'producto_id');

		return Arrays::contains($temp, $id);
	}

	public static function get_index($id)
	{
		$carrito = $_SESSION['carrito']['productos'];
		$index = 0;

		foreach ($carrito as $producto)			
		{
			if ( $producto['producto_id'] == $id ) 
			{
				return $index;
			}
			$index++;
		}
		
		return -1;
	}

	public static function get_total()
	{
		return $_SESSION['carrito']['total'];
	}

	//

	public static function set_quantity($id, $value)
	{
		$index = static::get_index($id);
		
		if ( $value > 0 ) 
		{
			$_SESSION['carrito']['productos'][$index]['cantidad'] = intval($value);	
		} 

		static::recalcular();
	}

	public function remove_producto($index)
	{		
		array_splice($_SESSION['carrito']['productos'], $index, 1);
	}

	public static function recalcular()
	{
		$cantidad = 0;
		$total = 0;

		foreach ($_SESSION['carrito']['productos'] as $producto) 
		{
			$cantidad += $producto['cantidad'];
			$total += ($producto['cantidad'] * $producto['producto_precio']);
		}

		$_SESSION['carrito']['cantidad'] = $cantidad;
		$_SESSION['carrito']['total'] = $total;
	}
}