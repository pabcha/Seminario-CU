<?php 
namespace App\Classes;

use App\Models\Category;

class ProductService
{
	public static function createTreeUpdate($producto_categoria_id, $id_categoria, $validate)
	{
		$sub = Category::where('producto_categoria_padre_id', $id_categoria)
			->where('producto_categoria_estado', '!=', 'B')
			->get();
		
		if ( ! $sub->isEmpty() ) 
		{
			echo '<ul>';
			foreach ($sub as $v) 
			{
				echo "<li><span><input type='radio' name='inputCategoria' value='"
					.$v['producto_categoria_id']."' "
					.$validate->set_radio('inputCategoria', $v['producto_categoria_id'], $v['producto_categoria_id'] == $producto_categoria_id)
					."></span>"
					.$v['producto_categoria_nombre'];

				static::createTreeUpdate($producto_categoria_id, $v['producto_categoria_id'], $validate);
			}
			echo "</ul>";
		}
	}
}