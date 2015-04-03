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
			return static::update_quantity($producto);
		}

	}

	public static function insert_producto($producto)
	{
		array_push($_SESSION['carrito']['productos'], $producto);
	}

	public static function update_quantity($producto)
	{
		$idx = static::get_index($producto['producto_id']);

		if ( $idx > -1)
		{
			$sum = $_SESSION['carrito']['productos'][$idx]['cantidad'] + $producto['cantidad'];

			if ( $sum <= $producto['stock'])
			{
				$_SESSION['carrito']['productos'][$idx]['cantidad'] += $producto['cantidad'];
				static::update_total_quantity($producto['cantidad'], $producto['producto_precio']);
			}
			else
			{
				return false;
			}

			return true;
		}				
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

	protected static function get_index($id)
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
}