<?php 
namespace App\Classes;

use App\Models\Category;

class TiendaService
{
	public static function createTree($id_categoria)
	{
		$subcategorias = Category::where('producto_categoria_padre_id', $id_categoria)
			->where('producto_categoria_estado', 'A')
			->get();

		if ( ! $subcategorias->isEmpty() ) 
		{
			echo '<ul class="children">';
			foreach ($subcategorias as $s) 
			{
				echo "<li><a href='".BASE_URL."index/categoria/".$s['producto_categoria_id']."/1'>".$s['producto_categoria_nombre']."</a>";
				static::createTree( $s['producto_categoria_id'] );
				echo "</li>";
			}
			echo "</ul>";
		} 	
	}
}